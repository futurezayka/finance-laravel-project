<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Transaction;
use App\Services\AccountService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AccountController extends Controller
{
    public function view()
    {
        return view('accounts.accounts',['accounts' => Account::where('user_id', Auth::user()->id)->get()]);
    }
    public function create()
    {
        return view('accounts.account-create');
    }

    public function createSubmit(Request $request, AccountService $accountService)
    {
        $accountNames = $accountService->getArrayOfAccountsByUser(Auth::user()->id);

        $validated = $request->validate([
            'name' => 'required|not_in:' . $accountNames
        ]);

        $accountService->createAccount($request);

        return redirect()->route('profile');
    }

    public function edit($id)
    {
        $account = Account::where('id', $id)->first();

        return view('accounts.account-edit', ['account' => $account]);
    }

    public function editSubmit(Request $request, $id, AccountService $accountService)
    {
        $accountNames = $accountService->getArrayOfAccountsByUser(Auth::user()->id);

        $validated = $request->validate([
            'name' => 'required|not_in:' . $accountNames
        ]);

        $accountService->editAccount($request, $id);

        return redirect()->route('accounts');
    }
}
