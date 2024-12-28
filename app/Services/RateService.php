<?php

namespace App\Services;

use App\Models\Account;
use Illuminate\Support\Facades\Auth;
use function MongoDB\BSON\fromJSON;

class RateService
{
    protected $link = 'https://api.privatbank.ua/p24api/pubinfo?exchange&coursid=11';

    protected $rates = [];

    public function __construct()
    {
        $data = file_get_contents($this->link);
        $this->rates = json_decode($data, true);
    }

    public function getRates()
    {
        return $this->rates;
    }

    public function getRate($name)
    {
        foreach ($this->rates as $rate) {
            if ($rate['ccy'] == $name){
                return $rate;
            }
        }
        throw new \Exception( message: 'Incorrect currency', code: 404);
    }

    public function getTotal(){
        $user = Auth::user();
        $default_currency = $user->currency;
        $accounts = Account::where('user_id', $user->id)->get();
        $total = 0;

        foreach ($accounts as $account) {
            /*if ($account->currency == $default_currency){
                $total += $account->count;
            } elseif($account->currency == 'UAH') {
                $rate = $this->getRate($default_currency);
                $total += $account->count / $rate['sale'];
            } elseif($default_currency == 'UAH') {
                $total += $account->count * $this->getRate($account->currency)['sale'];
            } else {
                $rate1 = $this->getRate($default_currency)['sale'];
                $rate2 = $this->getRate($account->currency)['sale'];
                $total += $account->count * ($rate2/$rate1);
            }*/
            $total += $this->convert($account->currency, $default_currency, $account->count);
        }
        return number_format($total,2);
    }

    public function convert($curFrom, $curTo, $count)
    {
        if ($curFrom == $curTo){
            return $count;
        } elseif($curTo == 'UAH') {
            $rate = $this->getRate($curFrom);
            return $count * $rate['sale'];
        } elseif($curFrom == 'UAH') {
            return $count / $this->getRate($curTo)['sale'];
        } else {
            $rate1 = $this->getRate($curFrom)['sale'];
            $rate2 = $this->getRate($curTo)['sale'];
            return $count * ($rate1/$rate2);
        }
    }
}
