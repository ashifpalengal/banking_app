<?php

namespace App\Http\Services;

use App\Models\User;
use App\Traits\StatementsTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class TransactionServices
{
    use StatementsTrait;
    protected $user_id, $user;
    public function __construct()
    {
        $this->user_id = Auth::user()->id;
        $this->user = User::where('id', $this->user_id)->with('account')->first();
    }

    public function validateAmount($request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'amount' => 'required|numeric|min:0'
            ]
        );

        if ($validator->fails()) {
            return ['success' => false, 'errorMsg' => 'Invalid Amount !'];
        }
        return ['success' => true];
    }

    public function depositAmount($request)
    {
        try {
            DB::beginTransaction();
            $this->user->account->balance += $request->amount;
            $this->user->account->save();

            $statement = [
                'account_id' => $this->user->account->id,
                'amount'=> $request->amount,
                'balance'=> $this->user->account->balance,
                'description'=> 'Deposit',
                'type'=> 0,
            ];

            $this->recordStatement($statement);

            DB::commit();
            return ['success' => true, 'message' => 'Deposited successfully !'];
        } catch (\Exception $e) {
            DB::rollBack();
            return ['success' => false, 'errorMsg' => $e->getMessage()];
        }
    }

    public function withdrawAmount($request)
    {
        try {
            DB::beginTransaction();
            if ($request->amount <= 0) {
                return ['success' => false, 'errorMsg' => 'Invalid amount !'];
            }

            if ($this->user->account->balance <= 0 || $this->user->account->balance < $request->amount) {
                return ['success' => false, 'errorMsg' => 'Insufficient balance !'];
            }

            $this->user->account->balance -= $request->amount;
            $this->user->account->save();

            $statement = [
                'account_id' => $this->user->account->id,
                'amount'=> $request->amount,
                'balance'=> $this->user->account->balance,
                'description'=> 'Withdrwan',
                'type'=> 1,
            ];

            $this->recordStatement($statement);

            DB::commit();
            return ['success' => true, 'message' => 'withdrawn successfully !'];
        } catch (\Exception $e) {
            DB::rollBack();
            return ['success' => false, 'errorMsg' => $e->getMessage()];
        }
    }

    public function getUserData($email)
    {
        $user = User::where('email', $email)->with('account')->first();
        if (!isset($user)) {
            return ['success' => false, 'errorMsg' => 'User Not fount !'];
        }

        $response_data = [
            'id' => $user->id,
            'name' => $user->name,
            'account_number' => "*****" . substr($user->account->account_number, -3),
            'account_type' => $user->account->account_type
        ];
        return ['success' => true, 'data' => $response_data];
    }

    public function getUser($id)
    {
        return User::where('id',$id)->with('account')->first();
    }

    public function transferMoney(User $reciever, $amount)
    {

        try {
            DB::beginTransaction();
            if ($amount <= 0) {
                return ['success' => false, 'errorMsg' => 'Invalid amount !'];
            }

            if ($this->user->account->balance <= 0 || $this->user->account->balance < $amount) {
                return ['success' => false, 'errorMsg' => 'Insufficient balance !'];
            }

            $this->user->account->balance -= $amount;
            $this->user->account->save();

            $statement = [
                'account_id' => $this->user->account->id,
                'amount'=> $amount,
                'balance'=> $this->user->account->balance,
                'description' => 'Transfer to ' . $reciever->email,
                'type'=> 1,
            ];

            $this->recordStatement($statement);

            $reciever->account->balance += $amount;
            $reciever->account->save();

            $statement = [
                'account_id' => $reciever->account->id,
                'amount'=> $amount,
                'balance'=> $reciever->account->balance,
                'description' => 'Transfer from ' . $this->user->email,
                'type'=> 0,
            ];

            $this->recordStatement($statement);

            DB::commit();
            return ['success' => true, 'message' => 'Amount tranfered successfully'];

        } catch (\Exception $e) {
            DB::rollBack();
            return ['success' => false, 'errorMsg' => $e->getMessage()];
        }
    }

    public function validayeUserEmail($request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'email' => 'required|email|unique:users,email,' . Auth::user()->id,
                'photo' => 'nullable|mimes:png,jpg,jpeg|max:2048',
            ]
        );

        if ($validator->fails()) {
            return ['success' => false, 'errorMsg' => $validator->errors()->first()];
        }

        return ['success' => true];
    }

    public function updateProfile($request)
    {
        try {
            DB::beginTransaction();
            $this->user->name = $request->name;
            $this->user->email = $request->email;
            if ($request->file('photo')) {
                if ($this->user->photo) {
                    @unlink(public_path($this->user->photo));
                    $file = $request->file('photo');
                    $file_name = time() . $file->getClientOriginalName();
                    $file->move(public_path('/photo/'), $file_name);
                    $this->user->photo = 'photo/' . $file_name;
                } else {
                    $file = $request->file('photo');
                    $file_name = time() . $file->getClientOriginalName();
                    $file->move(public_path('/photo/'), $file_name);
                    $this->user->photo = 'photo/' . $file_name;
                }
            }
            $this->user->save();
            DB::commit();
            return ['success' => true, 'message' => 'Profile updated successfully !'];
        } catch (\Exception $e) {
            DB::rollBack();
            return ['success' => false, 'errorMsg' => $e->getMessage()];
        }
    }

    public function validatePassword($request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'current_password' => 'required',
                'new_password' => 'required|min:8',
                'confirm_password' => 'required|min:8|same:new_password'
            ]
        );

        if ($validator->fails()) {
            return ['success' => false, 'errorMsg' => $validator->errors()->first()];
        }

        return ['success' => true];
    }

    public function updatePassword($request)
    {

        if (!Hash::check($request->input('current_password'), $this->user->password)) {
            return ['success' => false, 'errorMsg' => 'Incorrect Password !'];
        }

        try {
            DB::beginTransaction();
            $this->user->password = Hash::make($request->new_password);
            $this->user->save();
            DB::commit();
            return ['success' => true, 'message' => 'Password updated successfully !'];
        } catch (\Exception $e) {
            DB::rollBack();
            return ['success' => false, 'errorMsg' => $e->getMessage()];
        }
    }
}
