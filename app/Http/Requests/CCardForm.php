<?php

namespace App\Http\Requests;

use LVR\CreditCard\CardCvc;
use LVR\CreditCard\CardNumber;
use LVR\CreditCard\CardExpirationYear;
use LVR\CreditCard\CardExpirationMonth;
use Illuminate\Foundation\Http\FormRequest;

class CCardForm extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required'],
            'number' => ['required', new CardNumber],
            'expiration_year' => ['required', new CardExpirationYear(explode($this->get('expiration-month-and-year'),' / ')[1])],
            'expiration_month' => ['required', new CardExpirationMonth(explode($this->get('expiration-month-and-year'),' / ')[0])],
            'cvc' => ['required', new CardCvc($this->get('security-code'))]
        ];
    }
}
