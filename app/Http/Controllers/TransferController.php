<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\Solde;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("SendMoney.dashboard");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */



     public function checkUserAmount($id,$sendingAmount)
     {
        try {
            $amount = Solde::find($id);

            if($sendingAmount <= $amount->amount){
                return [true,$amount->amount];
            }else{
                return [false,''];
            }
        } catch (\Exception $e) {
            return [false,''];
        }
     }
     public function receiverCurrentAmount($id,$amountToBeReceived)
     {
        try {
            $amount = Solde::find($id);
            return doubleval($amount->amount + $amountToBeReceived);
        } catch (\Exception $e) {
            return 0;
        }
     }
    public function store(Request $request)
    {
        try {
            $sendingAmount = $request->amount;
            $user_id = $request->receive_id;
            $devise_id = $request->devise_id;
            $sender_id = $request->sender_id;
            $receiverAmount = $this->receiverCurrentAmount($user_id,$sendingAmount);
            $check = $this->checkUserAmount($sender_id,$sendingAmount);
            if ($check[0]) {
                $tansaction = new Transaction();
                $tansaction->user_id = $sender_id;
                $tansaction->receive_id = $user_id;
                $tansaction->amount = $sendingAmount;
                $tansaction->save();

                DB::update('update soldes set amount = ? where user_id=?',[doubleval(($check[1]-$sendingAmount)),$sender_id]);
                DB::update('update soldes set amount = ? where user_id=?',[$receiverAmount,$user_id]);

            // DB::transaction(function ($check,$sendingAmount,$sender_id) {

            // });
            return [
                'status'=>true,
                'msg'=>"Envoie effectué avec succès",
            ];;
            }else{
                return [
                    'status'=>false,
                    'msg'=>"Votre solde est insuffisant veuillez recharger votre compte",
                ];
            }
        } catch (\Throwable $e) {
            return [
                'status'=>false,
                'msg'=>$e->getMessage(),
            ];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return response()->json([
            'users'=>User::all(),
            'devise'=>Device::all(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getBalance($id)
    {
        $balance = Solde::where("user_id","=",$id)->first();
        return $balance;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
