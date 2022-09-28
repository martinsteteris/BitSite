<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Wallet;
use App\Rules\ValidateFiatAmount;
use App\Rules\ValidateWalletQuantity;
use App\Services\ListSingleCoinService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    private ListSingleCoinService $listSingleCoinService;

    public function __construct(ListSingleCoinService $listSingleCoinService)
    {
        $this->listSingleCoinService = $listSingleCoinService;
    }

    public function portfolio() {
        $asset = DB::table('wallets')
        ->join('assets', 'wallets.name', '=', 'assets.symbol')
        ->select('wallets.*', 'assets.price')
        ->where('wallets.user_id', '=', Auth::id())
        ->get();

        return view('users.portfolio', [
            'wallets' => $asset,
            'balance' => User::where('id' , '=', Auth::id())->value('fiat_wallet'),
            ]);
    }

    public function addFiat(Request $request, User $user) {
        $id = Auth::id();
        $input = $request->input('fiat');
        $balance = $user->
            where("id", "=", $id)->
            value('fiat_wallet') + $input;

        $user->where("id", "=", $id)->
        update(['fiat_wallet' => $balance]);

        return redirect('/user/portfolio');
    }

    public function show() {
        return view('coin-listings.show', [
                'coin' => $this->listSingleCoinService->execute(),
            ]
        );
    }

//    public function buy(Request $request, User $user, Wallet $wallet, Transaction $transaction)
//    {
//        $price = $this->listSingleCoinService->execute()->getPriceCurrent();
//        $name = $this->listSingleCoinService->execute()->getSymbol();
//        $userWallet = $wallet->where('name', '=', $name);
//        $id = Auth::id();
//        $input = $request->input('buy');
//        $amount = $input * $price;
//        $fiatWallet = $user->where("id", "=", $id)->value('fiat_wallet');
//        $x=$fiatWallet*$price;
//
//
//        $balance = $user->
//            where("id", "=", $id)->
//            value('fiat_wallet') - $amount;
//
//
//        $coinQuantity = $wallet->where('name', '=', $name)->value('quantity') + $input;
//        $request->validate(['buy' => "required|numeric|min:{$x}|not_in:0"]);
//
//        $validator = Validator::make($request->all(), [
//            'buy' => ['required',new ValidateFiatAmount($this->listSingleCoinService,$request),'required','numeric','min:0','not_in:0'],
//
//        ]);
//
//        if ($validator->fails())
//        {
//            return back()->withInput()->withErrors($validator);
//        }
//        else {
//            $user->where("id", "=", $id)->
//            update(['fiat_wallet' => $balance]);
//
//            if ($wallet->where('name', '=', $name)->exists()) {
//                $wallet->where("name", "=", $name)->
//                update(['quantity' => $coinQuantity,]);
//            } else {
//                $fields = [
//                    'name' => $name,
//                    'quantity' => $input,
//                    'user_id' => $id,
//                ];
//                $wallet->create($fields);
//            }
//            $data = ['name' => $name,
//                'quantity' => $input,
//                'user_id' => $id,
//                'price' => $price,
//                'status' => 'buy'
//            ];
//            $transaction->create($data);
//        }
//        return redirect('/user/portfolio');
//
//    }
    public function buy(Request $request, User $user, Wallet $wallet, Transaction $transaction)
    {

        $price = $this->listSingleCoinService->execute()->getPriceCurrent();
        $name = $this->listSingleCoinService->execute()->getSymbol();
        $id = Auth::id();
        $input = $request->input('buy');
        $amount = $input * $price;
        $balance = $user->
            where("id", "=", $id)->
            value('fiat_wallet') - $amount;
        $quantity = $wallet->
            where("name", "=", $name)->
            value('quantity') + $input;

        $validator = Validator::make($request->all(), [
            'buy' => ['required', new ValidateFiatAmount($this->listSingleCoinService, $request), 'required', 'numeric', 'min:0', 'not_in:0'],

        ]);


        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {
            $user->where("id", "=", $id)->
            update(['fiat_wallet' => $balance]);

            if ($wallet->where('name', '=', $name)->exists()) {
                $wallet->where("name", "=", $name)->
                update(['quantity' => $quantity,]);
            } else {
                $fields = [
                    'name' => $name,
                    'quantity' => $input,
                    'user_id' => $id,
                ];
                $wallet->create($fields);
            }
            $data = ['name' => $name,
                'quantity' => $input,
                'user_id' => $id,
                'price' => $price,
                'status' => 'buy'
            ];
            $transaction->create($data);
        }

        return redirect('/user/portfolio');


    }


    public function sell(Request $request, User $user, Wallet $wallet, Transaction $transaction)
    {
        $price = $this->listSingleCoinService->execute()->getPriceCurrent();
        $name = $this->listSingleCoinService->execute()->getSymbol();
        $id = Auth::id();

        $input = $request->input('sell');
        $amount = $input * $price;
        $balance = $user->
            where("id", "=", $id)->
            value('fiat_wallet') + $amount;


        $quantity = $wallet->
            where("name", "=", $name)->
            value('quantity') - $input;
        $validator = Validator::make($request->all(), [
            'sell' => [new ValidateWalletQuantity($request, $wallet, $this->listSingleCoinService), 'numeric', 'min:0', 'not_in:0'],

        ]);


        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {
            $user->where("id", "=", $id)->
            update(['fiat_wallet' => $balance]);

            if ($wallet->where('name', '=', $name)->exists()) {
                $wallet->where("name", "=", $name)->
                update(['quantity' => $quantity,]);
            } else {
                $fields = [
                    'name' => $name,
                    'quantity' => $input,
                    'user_id' => $id,
                ];
                $wallet->create($fields);
            }
            $data = ['name' => $name,
                'quantity' => $input,
                'user_id' => $id,
                'price' => $price,
                'status' => 'sell'
            ];
            $transaction->create($data);
        }

//        $wallet
//            ->where('name', '=', $name)
//            ->where('user_id', '=', $id)
//            ->update(['quantity' => $coinQuantity]);
//
//        $fields=[
//            'name'=>$name,
//            'quantity'=>$input,
//            'user_id'=>$id,
//            'price' => $price,
//            'status' => 'sell'
//        ];
//        $transaction->create($fields);

        return redirect('/user/portfolio');
    }

    public function transactions(User $user) {
        $transactions = DB::table('transactions')
        ->where('user_id', '=', Auth::id())
        ->get();
        return view('users.transactions', [
            'transactions' => $transactions
        ]);
    }

    public function search(Request $request)
    {
        $search = $request->input('search');

        $coins = Asset::query()
            ->where('symbol', 'LIKE', "%{$search}%")
            ->get();

        return view('users.search', ['transactions'=>$coins]);
    }



}
