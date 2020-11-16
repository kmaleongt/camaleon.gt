<?php

namespace Webkul\Paypal\Http\Controllers;

use App\Http\Requests\CCardForm;
use DateTime;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Webkul\Checkout\Facades\Cart;
use Webkul\Sales\Repositories\OrderRepository;
use Webkul\Paypal\Helpers\Ipn;
use Illuminate\Support\Facades\Http;

class StandardController extends Controller
{
    /**
     * OrderRepository object
     *
     * @var \Webkul\Sales\Repositories\OrderRepository
     */
    protected $orderRepository;

    /**
     * Ipn object
     *
     * @var \Webkul\Paypal\Helpers\Ipn
     */
    protected $ipnHelper;

    /**
     * Create a new controller instance.
     *
     * @param  \Webkul\Attribute\Repositories\OrderRepository  $orderRepository
     * @param  \Webkul\Paypal\Helpers\Ipn  $ipnHelper
     * @return void
     */
    public function __construct(
        OrderRepository $orderRepository,
        Ipn $ipnHelper
    )
    {
        $this->orderRepository = $orderRepository;

        $this->ipnHelper = $ipnHelper;
    }

    /**
     * Redirects to the paypal.
     *
     * @return \Illuminate\View\View
     */
    public function redirect()
    {
        $cart = Cart::getCart();
        // dd($cart);
        return view('paypal::standard-redirect', compact('cart'));
    }

    public function validar(Request $request)
    {
        $fecha = new DateTime();
        $qpayRadarID = 'cUXvdB6hHu';
        //dd(Auth::user());
        //dd([
        //     'x_login' => 'visanetgt_qpay',
        //     'x_private_key' => '88888888888',
        //     'x_api_secret' => '99999999999',
        //     'x_description' => $request->get('x_description'),
        //     'x_amount' => $request->get('x_amount'),
        //     'x_line_item' => $request->get('x_line_item'),
        //     'x_freight' => '',
        //     'x_currency_code' => 'GTQ',
        //     'x_product_id' => $request->get('x_product_id'),
        //     'x_audit_number' => $request->get('x_audit_number'),
        //     'x_email' => $request->get('x_email'),
        //     'x_fp_sequence' => $request->get('id'),
        //     'x_fp_timestamp' => $fecha->getTimestamp(),
        //     'x_invoice_num' => $request->get('x_invoice_num'),
        //     'x_first_name' => $request->get('x_first_name'),
        //     'x_last_name' => $request->get('x_last_name'),
        //     'x_company' => 'C/F',
        //     'x_address' => $request->get('x_address'),
        //     'x_city' => $request->get('x_city'),
        //     'x_state' => $request->get('x_state'),
        //     'x_zip' => $request->get('x_zip'),
        //     'x_country' => $request->get('x_country'),
        //     'x_ship_to_first_name' => $request->get('x_first_name'),
        //     'x_ship_to_last_name' => $request->get('x_last_name'),
        //     'x_phone' => '',
        //     'x_ship_to_address' => $request->get('x_address'),
        //     'x_ship_to_city' => $request->get('x_city'),
        //     'x_ship_to_state' => $request->get('x_state'),
        //     'x_ship_to_zip' => $request->get('x_zip'),
        //     'x_ship_to_country' => $request->get('x_country'),
        //     'x_relay_response' => '1',
        //     'x_relay_url' => '1',
        //     'x_type' => 'AUTH_ONLY',
        //     'x_method' => 'CC',
        //     'visaencuotas' => 0,
        //     'cc_number' => $request->get('number'),
        //     'cc_exp' => $request->get('expiration-month-and-year'),
        //     'cc_cvv2' => $request->get('security-code'),
        //     'cc_name' => $request->get('name'),
        //     'cc_type' => $request->get('card-type'),
        //     'device_fingerprint_id' => session()->getId(),
        //     'finger' => session()->getId(),
        // ]);
        $response = Http::post('https://sandbox.qpaypro.com/payment/api_v1', [
            'x_login' => 'visanetgt_qpay',
            'x_private_key' => '88888888888',
            'x_api_secret' => '99999999999',
            'x_description' => $request->get('x_description'),
            'x_amount' => $request->get('x_amount'),
            'x_line_item' => "T-Shirt Live Dreams<|>w01<|><|>1<|>85.00<|>N",
            'x_freight' => '',
            'x_currency_code' => 'GTQ',
            'x_product_id' => $request->get('x_product_id'),
            'x_audit_number' => $request->get('x_audit_number'),
            'x_email' => $request->get('x_email'),
            'x_fp_sequence' => $request->get('id'),
            'x_fp_timestamp' => $fecha->getTimestamp(),
            'x_invoice_num' => $request->get('x_invoice_num'),
            'x_first_name' => $request->get('x_first_name'),
            'x_last_name' => $request->get('x_last_name'),
            'x_company' => 'C/F',
            'x_address' => $request->get('x_address'),
            'x_city' => $request->get('x_city'),
            'x_state' => $request->get('x_state'),
            'x_zip' => $request->get('x_zip'),
            'x_country' => $request->get('x_country'),
            'x_ship_to_first_name' => $request->get('x_first_name'),
            'x_ship_to_last_name' => $request->get('x_last_name'),
            'x_phone' => '58585858',
            'x_ship_to_address' => $request->get('x_address'),
            'x_ship_to_city' => $request->get('x_city'),
            'x_ship_to_state' => $request->get('x_state'),
            'x_ship_to_zip' => $request->get('x_zip'),
            'x_ship_to_country' => $request->get('x_country'),
            'x_relay_response' => 'none',
            'x_relay_url' => 'none',
            'x_type' => 'AUTH_ONLY',
            'x_method' => 'CC',
            'visaencuotas' => 0,
            'cc_number' => $request->get('number'),
            'cc_exp' => $request->get('expiration-month-and-year'),
            'cc_cvv2' => $request->get('security-code'),
            'cc_name' => $request->get('name'),
            'cc_type' => $request->get('card-type'),
            'device_fingerprint_id' => session()->getId(),
            'finger' => session()->getId(),
        ]);

        //dd($response);
        if ($response->successful()) {
            session()->flash('success', 'El Pago se realizo correctamente.');
            return redirect()->route('shop.checkout.cart.index');
        }
        if ($response->serverError()) {
            session()->flash('error', 'El Pago no se realizo correctamente debido a un fallo.');
            return redirect()->route('paypal.standard.redirect');
        }
    }

    /**
     * Cancel payment from paypal.
     *
     * @return \Illuminate\Http\Response
     */
    public function cancel()
    {
        session()->flash('error', 'Paypal payment has been canceled.');

        return redirect()->route('shop.checkout.cart.index');
    }

    /**
     * Success payment
     *
     * @return \Illuminate\Http\Response
     */
    public function success()
    {
        $order = $this->orderRepository->create(Cart::prepareDataForOrder());

        Cart::deActivateCart();

        session()->flash('order', $order);

        return redirect()->route('shop.checkout.success');
    }

    /**
     * Paypal Ipn listener
     *
     * @return \Illuminate\Http\Response
     */
    public function ipn()
    {
        $this->ipnHelper->processIpn(request()->all());
    }
}