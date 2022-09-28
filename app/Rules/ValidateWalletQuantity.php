<?php

namespace App\Rules;

use App\Models\Wallet;
use App\Services\ListSingleCoinService;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ValidateWalletQuantity implements Rule
{
    private Request $request;
    private Wallet $wallet;
    private ListSingleCoinService $listSingleCoinService;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(Request $request, Wallet $wallet, ListSingleCoinService $listSingleCoinService)
    {
        //
        $this->request = $request;
        $this->wallet = $wallet;
        $this->listSingleCoinService = $listSingleCoinService;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $name = $this->listSingleCoinService->execute()->getSymbol();
        $inputQuantity = $this->request->input('sell');
        $walletQuantity = $this->wallet->where("name", "=", $name)->value('quantity');
        return $walletQuantity>$inputQuantity;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'You do not have enough coins!';
    }
}
