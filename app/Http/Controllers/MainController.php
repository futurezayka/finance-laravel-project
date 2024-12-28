<?php

namespace App\Http\Controllers;

use App\Services\RateService;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index(RateService $rateService)
    {
        $rates = $rateService->getRates();
        return view('home', ['rates' => $rates]);
    }
}
