<?php $paypalStandard = app('Webkul\Paypal\Payment\Standard');?>

<!DOCTYPE html>
<html>

<head>
    <title>Proceso de pago - e-Shop Camaleón</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="" />
    <script type="application/x-javascript">
        addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } 
    </script>
    <!--Custom Theme files-->
    <link href="{{asset('css/checkout.css')}}" rel="stylesheet" type="text/css" media="all" />
    <!--//Custom Theme files -->
    <!--web font-->
    <link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
    <!--web font-->
    <!--//web font-->
</head>

<body>
    <!-- main -->
    <div class="main">
        <h1>e-Shop Camaleón</h1>
        <div class="container">
            <div class="main-info">
                <div class="form-left">
                    <!--radio-buttons-->
                    <div class="grid-radio">
                        <img src="{{asset('vendor/webkul/ui/assets/images/favicon.png')}}" alt="Logo">
                    </div>
                </div>
                <div class="form-right">
                    <div class="top-text">
                        <h3>Total a pagar</h3>
                        <span class="price">Q{{ number_format($cart->grand_total, 2) }}</span>
                        <div class="clear"> </div>
                    </div>
                    <p>Carrito de compras: {{ $cart->items_count }} productos</p>
                    <div class="account">
                        <form action="{{ route('paypal.standard.validar') }}" id="paypal_standard_checkout" method="POST">
                            @csrf()
                            @foreach ($paypalStandard->getFormFields() as $name => $value)
                            <input type="hidden" id="{{ $name }}" name="{{ $name }}" value="{{ $value }}">
                            @endforeach

                            <input type="text" name="card_name" id="card_name" class="checkout name" value="{{ old('card_name') }}" placeholder="Nombre">
                            @error('card_name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <input type="text" name="card_month" id="card_month" class="checkout month" value="{{ old('card_month') }}" placeholder="MM" maxlength="2">
                            @error('card_month')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <input type="text" name="card_year" id="card_year" class="checkout month" value="{{ old('card_year') }}" placeholder="YY" maxlength="2">
                            @error('card_year')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <input type="text" name="card_number" id="card_number" class="checkout pin" value="{{ old('card_number') }}" placeholder="4444 1111 3333 2222" maxlength="16">
                            @error('card_number')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <input type="text" name="card_ccv" id="card_ccv" class="checkout month" value="{{ old('card_ccv') }}" placeholder="CVC" maxlength="3">
                            @error('card_ccv')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <input type="submit" value="Checkout con tarjeta de crédito">
                        </form>
                    </div>
                </div>
                <div class="clear"> </div>
            </div>
        </div>
    </div>
    <!--//main -->
    <!--copyright-->
    <div class="copyright">
        <p> &copy; 2020 Corporación Camaleón S. A. - Todos los derechos reservados</p>
    </div>
    <!--//copyright-->
</body>

</html>