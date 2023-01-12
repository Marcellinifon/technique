<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
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
    public function index()
    {
        try {
            $transactions = User::find(Auth::user()->id)->transaction;
            $transactions_reveived = Transaction::where("receive_id","=",Auth::user()->id)->get();
            return view('home',[
                'transactions'=>$transactions,
                'transactions_reveived'=>$transactions_reveived,
            ]);
        } catch (\Exception $e) {
            dd($e);
            abort(404);
        }
    }
}
