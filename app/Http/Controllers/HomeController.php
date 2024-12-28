<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\User;
use App\Services\RateService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function profile(RateService $rateService)
    {

        $total = $rateService->getTotal();
        return view('profile.profile', ['accounts' => Account::where('user_id', Auth::user()->id)->get(), 'total' => $total]);
    }

    public function profileUpdate()
    {

        return view('profile.profile-update', ['data' => Auth::user()]);
    }

    public function profileUpdateSubmit(Request $request)
    {
        $user = User::where('id', Auth::user()->id)->first();

        $user->currency = $request->currency;
        $user->name = $request->name;
        $user->surname = $request->surname;

        $user->save();

        return redirect()->route('profile');
    }


}
