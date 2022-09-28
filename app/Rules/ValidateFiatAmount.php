<?php
namespace App\Rules;

use App\Models\User;
use App\Services\ListSingleCoinService;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ValidateFiatAmount implements Rule
{
private ListSingleCoinService $listSingleCoinService;
private Request $request;

/**
* Create a new rule instance.
*
* @return void
*/
public function __construct(ListSingleCoinService $listSingleCoinService,Request $request)
{
//
$this->listSingleCoinService = $listSingleCoinService;
$this->request = $request;
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
$price = $this->listSingleCoinService->execute()->getPriceCurrent();
$input = $this->request->input('buy');
$amount = $input * $price;
return User::where("id", "=", Auth::id())->value('fiat_wallet')>$amount;
}

/**
* Get the validation error message.
*
* @return string
*/
public function message()
{
return 'Buy amount exceeds your fiat wallet funds!';
}
}
