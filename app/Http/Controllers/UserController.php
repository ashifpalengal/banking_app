<?php

namespace App\Http\Controllers;

use App\Http\Services\TransactionServices;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function dashboard()
    {
        return view('users.dashboard');
    }

    public function viewDeposit()
    {
        return view('users.deposit');
    }

    public function addDeposit(Request $request, TransactionServices $service)
    {
        $validate = $service->validateAmount($request);

        if (!$validate['success']) {
            return redirect()->back()->with('error', $validate['errorMsg']);
        }

        $response = $service->depositAmount($request);

        if ($response['success']) {
            return redirect()->route('user.dashboard')->with('success', $response['message']);
        } else {
            return redirect()->back()->with('error', $response['errorMsg']);
        }
    }

    public function viewWithdraw()
    {
        return view('users.withdraw');
    }

    public function addWithdraw(Request $request, TransactionServices $service)
    {
        $validate = $service->validateAmount($request);

        if (!$validate['success']) {
            return redirect()->back()->with('error', $validate['errorMsg']);
        }

        $response = $service->withdrawAmount($request);

        if ($response['success']) {
            return redirect()->route('user.dashboard')->with('success', $response['message']);
        } else {
            return redirect()->back()->with('error', $response['errorMsg']);
        }
    }


    public function viewTransfer()
    {
        return view('users.transfer');
    }

    public function addTransfer(Request $request, TransactionServices $service)
    {
        $validate = $service->validateAmount($request);

        if (!$validate['success']) {
            return redirect()->back()->with('error', $validate['errorMsg']);
        }

        $user = $service->getUser($request->user_id);
        if (!isset($user->id)) {
            return redirect()->back()->with('error', 'Invalid User Id !');
        }

        $response = $service->transferMoney($user, $request->amount);

        if ($response['success']) {
            return redirect()->route('user.dashboard')->with('success', $response['message']);
        } else {
            return redirect()->back()->with('error', $response['errorMsg']);
        }
    }

    public function getUserData(Request $request, TransactionServices $service)
    {
        return $service->getUserData($request->email);
    }

    public function viewStatements()
    {
        return view('users.statements');
    }

    public function editProfile()
    {
        return view('users.profile');
    }

    public function updateProfile(Request $request, TransactionServices $service)
    {
        $validation = $service->validayeUserEmail($request);

        if (!$validation['success']) {
            return redirect()->back()->with('error', $validation['errorMsg']);
        }

        $response = $service->updateProfile($request);

        if ($response['success']) {
            return redirect()->back()->with('success', $response['message']);
        }
        return redirect()->back()->with('error', $response['errorMsg']);
    }

    public function updatePassword(Request $request, TransactionServices $service)
    {
        $validation = $service->validatePassword($request);

        if (!$validation['success']) {
            return redirect()->back()->with('error', $validation['errorMsg']);
        }

        $response = $service->updatePassword($request);

        if ($response['success']) {
            return redirect()->back()->with('success', $response['message']);
        }
        return redirect()->back()->with('error', $response['errorMsg']);
    }
}
