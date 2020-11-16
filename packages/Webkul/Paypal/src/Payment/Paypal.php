<?php

namespace Webkul\Paypal\Payment;

use DateTime;
use Illuminate\Support\Facades\Config;
use Webkul\Payment\Payment\Payment;

abstract class Paypal extends Payment
{
    /**
     * PayPal web URL generic getter
     *
     * @param  array  $params
     * @return string
     */
    public function getPaypalUrl($params = [])
    {
        // return sprintf('https://www.%spaypal.com/cgi-bin/webscr%s',
        // https://sandbox.qpaypro.com/payment/api_v1
        // https://payments.qpaypro.com/checkout/api_v1
        return sprintf('https://%sqpaypro.com/payment/api_v1',
            $this->getConfigData('sandbox') ? 'sandbox.' : '',
            $params ? '?' . http_build_query($params) : ''
        );
    }

    /**
     * Add order item fields
     *
     * @param  array  $fields
     * @param  int  $i
     * @return void
     */
    protected function addLineItemsFields(&$fields, $i = 1)
    {
        $cartItems = $this->getCartItems();
        //dd($this->getCart());
        foreach ($cartItems as $item) {
            foreach ($this->itemFieldsFormat as $modelField => $paypalField) {
                $fields[sprintf($paypalField, $i)] = $item->{$modelField};
            }

            $i++;
        }
    }

    // protected function addLineItemsFieldsText(&$fields, $i = 1)
    // {
    //     $cartItems = $this->getCartItems();
    //     //dd($cartItems);
    //     $textField = "";
    //     foreach ($cartItems as $item) {
    //         $textField .= $item->name . '<|>' . $item->sku . '<|>' . $item->quantity . '<|>' . number_format($item->price, 2) . '<|>\n';
    //     }
    //     $fields['x_line_item'] = $textField;
    // }

    /**
     * Add billing address fields
     *
     * @param  array  $fields
     * @return void
     */
    protected function addAddressFields(&$fields)
    {
        $fecha = new DateTime();
        $qpayRadarID = 'cUXvdB6hHu';
        $cart = $this->getCart();

        $billingAddress = $cart->billing_address;

        $fields = array_merge($fields, [
            'x_login' => 'visanetgt_qpay',
            'x_private_key' => '88888888888',
            'x_api_secret' => '99999999999',
            'x_description' => sprintf('Pedido #:%d de fecha: %s', $cart['id'], $fecha->format('d/m/yy h:i:s')),
            'x_amount' => number_format($cart['grand_total'], 2),
            'x_freight' => '',
            'x_currency_code' => 'GTQ',
            'x_product_id' => $cart['id'],
            'x_audit_number' => $cart['id'],
            'x_email' => $billingAddress->email,
            'x_fp_sequence' => $cart['id'],
            'x_fp_timestamp' => $fecha->getTimestamp(),
            'x_invoice_num' => $cart['id'],
            'x_first_name' => $billingAddress->first_name,
            'x_last_name' => $billingAddress->last_name,
            'x_company' => 'C/F',
            'x_address' => $billingAddress->address1,
            'x_city' => $billingAddress->city,
            'x_state' => $billingAddress->state,
            'x_zip' => $billingAddress->postcode,
            'x_country' => $billingAddress->country,
            'x_ship_to_first_name' => 1,
            'x_ship_to_last_name' => 1,
            'x_phone' => 1,
            'x_ship_to_address' => 1,
            'x_ship_to_city' => 1,
            'x_ship_to_state' => 1,
            'x_ship_to_zip' => 1,
            'x_ship_to_country' => 1,
            'x_relay_response' => 1,
            'x_relay_url' => '1',
            'x_type' => 'AUTH_ONLY',
            'x_method' => 'CC',
            'visaencuotas' => 1,
            'cc_number' => 1,
            'cc_exp' => 1,
            'cc_cvv2' => 1,
            'cc_name' => 1,
            'cc_type' => 1,
            'device_fingerprint_id' => 1,
            'finger' => 1,
        ]);
    }

    /**
     * Checks if line items enabled or not
     *
     * @return bool
     */
    public function getIsLineItemsEnabled()
    {
        return true;
    }
}