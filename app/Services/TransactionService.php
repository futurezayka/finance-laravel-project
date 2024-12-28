<?php

namespace App\Services;

use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Services\RateService;

class TransactionService
{
    protected $user;

    public function construct(){

        $this->user = Auth::user();

    }

    public function getUserTransactions()
    {
        $result = DB::table('transactions')
            ->select('transactions.*', 'transactions.id as tr_id', 'accounts.name as account')
            ->leftJoin('accounts', 'accounts.id', '=', 'transactions.account_id')
            ->where('transactions.user_id', '=', Auth::user()->id);

        $result = DB::table('accounts')
            ->select('*','accounts.name as account2')
            ->rightJoinSub($result, 'account_id2', function (JoinClause $join){
            $join->on( 'accounts.id','=','account_id2');
        })->get();

        return $result;
    }

    public function createIncome($request){
        $accountService = new AccountService();
        $transaction = new Transaction();

        $transaction->user_id = Auth::user()->id;
        $transaction->account_id = $request->account;
        $transaction->type = 'income';
        $transaction->currency = $request->currency;
        $transaction->count = $request->count;
        $transaction->save();

        $accountService->addToAccount($request);

    }

    public function createExpence($request){
        $accountService = new AccountService();

        if($accountService->removeFromAccount($request)){
            $transaction = new Transaction();
            $transaction->user_id = Auth::user()->id;
            $transaction->account_id = $request->account;
            $transaction->type = 'expense';
            $transaction->currency = $request->currency;
            $transaction->count = $request->count;
            $transaction->save();
        };
    }

    public function createBetweenAcc($request){

        $accountService = new AccountService();
        $transaction = new Transaction();
        $rateService = new RateService();

        $acc1 = Account::where('id', $request->account)->first();
        $acc2 = Account::where('id', $request->account2)->first();

        $accountService->transactionBetweenAcc($acc1,$acc2,$request->count);

        $transaction->user_id = Auth::user()->id;
        $transaction->account_id = $request->account;
        $transaction->account_id2 = $request->account2;
        $transaction->type = 'between_acc';
        $transaction->currency = $acc1->currency;
        $transaction->currency2 = $acc2->currency;
        $transaction->count = $request->count;
        $transaction->count2 = $rateService->convert($acc1->currency, $acc2->currency, $request->count);
        $transaction->save();
    }

}
