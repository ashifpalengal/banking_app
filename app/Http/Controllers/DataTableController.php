<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Statement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class DataTableController extends Controller
{
    public function getStatementData()
    {
        $account = Account::where('user_id', Auth::user()->id)
            ->with(['statements' => function ($query) {
                $query->orderBy('created_at', 'desc');
            }])
            ->first();

        return DataTables::of($account->statements)
        ->addColumn('id', function ($statement) {
            return $statement->id;
        })
        ->addColumn('time', function ($statement) {
            return $statement->created_at->format('d M, Y h:i A');
        })
        ->addColumn('amount', function ($statement) {
            return $statement->amount;
        })
        ->addColumn('type', function ($statement) {
            $html = '';
            if ($statement->type == 1) {
                $html = '<span class="badge badge-danger">Debited</span>' ;
            } else {
                $html = '<span class="badge badge-success">Credited</span>' ;
            }
            return $html;
        })
        ->addColumn('details', function ($statement) {
            return $statement->description;
        })
        ->addColumn('balance', function ($statement) {
            return $statement->balance;
        })

        ->rawColumns(['id', 'time', 'amount', 'type', 'details', 'balance'])
        ->make(true);
    }
}
