<?php

namespace App\Services;

use App\Models\Account;
use App\Models\Transaction;
use App\Services\RateService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AccountService
{

    protected $user;

    public function __construct(){
        $this->user = Auth::user();
    }

    public function getAccountsOfUser(){
        return Account::where('user_id', Auth::user()->id)->get();
    }

    public function getAccountById($id)
    {
        return Account::where('id', $id)->first();
    }


    public function getArrayOfAccountsByUser($user_id){
        $accounts= DB::table('accounts')
            ->select('accounts.name')
            ->where('user_id', '=', $user_id)
            ->get();

        $accountNames = '';

        foreach ($accounts as $name){
            $accountNames .= $name->name . ',';
        }
        return substr($accountNames,0,-1);

    }

    public function createAccount($request){
        $account = new Account();

        $account->user_id = $this->user->id;
        $account->name = $request->name;
        $account->currency = $request->currency;
        $account->count = 0;

        $account->save();

        if($request->count != 0){
            $account = Account::where('name', $request->name)->where('user_id', $this->user->id)->orderBy('id', 'desc')->first();
            $request->account = $account->id;
            $transactionService = new TransactionService();
            $transactionService->createIncome($request);
        }
    }

    public function addToAccount($request){
        $rateService = new RateService();
        $account = Account::where('id', $request->account)->first();
        $account->count += $rateService->convert($request->currency, $account->currency, $request->count);
        $account->save();
    }

    public function removeFromAccount($request){
        $rateService = new RateService();
        $account = Account::where('id', $request->account)->first();
        if(($account->count - $rateService->convert($request->currency, $account->currency, $request->count) < 0)){
            return false;

        };
        $account->count -= $rateService->convert($request->currency, $account->currency, $request->count);
        $account->save();
        return true;
    }

    public function transactionBetweenAcc($acc1, $acc2, $count)
    {
        $rateService = new RateService();

        if(($acc1->count - $count) < 0 ) {
            return false;
        }
        /*DB::transaction(function(){
            DB::update('update accounts set count=$count1 where id=$id1');
            DB::update('update accounts set count=$count2 where id=$id2');
        });*/

        $acc1->count -= $count;
        $acc2->count += $rateService->convert($acc1->currency, $acc2->currency, $count);;
        $acc1->save();
        $acc2->save();
        return true;
    }


    public function editAccount($request, $id){

        $account = $this->getAccountById($id);

        $account->name = $request->name;

        $account->save();
    }

}
