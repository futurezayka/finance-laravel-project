<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Transaction;
use App\Services\AccountService;
use App\Services\RateService;
use App\Services\TransactionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function view(TransactionService $transactionService)
    {
        $transactions = $transactionService->getUserTransactions();

        return view('transactions.transactions', ['transactions' => $transactions]);
    }

    public function createIncome(AccountService $accountService)
    {
        $accounts = $accountService->getAccountsOfUser();

        return view('transactions.transaction-income', ['accounts' => $accounts]);
    }

    public function createIncomeSubmit(Request $request, TransactionService $transactionService)
    {
        $transactionService->createIncome($request);

        return redirect()->route('transactions');
    }

    public function createExpense(AccountService $accountService)
    {
        $accounts = $accountService->getAccountsOfUser();

        return view('transactions.transaction-expense', ['accounts' => $accounts]);
    }

    public function createExpenseSubmit(Request $request, TransactionService $transactionService)
    {

        $transactionService->createExpence($request);

        return redirect()->route('transactions');
    }

    public function createBetween(AccountService $accountService)
    {
        $accounts = $accountService->getAccountsOfUser();

        return view('transactions.transaction-between', ['accounts' => $accounts]);
    }

    public function createBetweenSubmit(Request $request, TransactionService $transactionService)
    {

        $transactionService->createBetweenAcc($request);

        return redirect()->route('transactions');
    }
}
