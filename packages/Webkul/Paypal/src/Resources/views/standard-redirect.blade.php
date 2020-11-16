<?php $paypalStandard = app('Webkul\Paypal\Payment\Standard');?>
<!DOCTYPE html>
<html>
<head>
<title>Payment e-Shop Camaleón</title>
<!-- custom-theme -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
		function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- //custom-theme -->
<link href="{{asset('css/style.css')}}" rel="stylesheet" type="text/css" media="all" />
<link rel="stylesheet" href="{{asset('css/creditly.css')}}" type="text/css" media="all" />
<link rel="stylesheet" href="{{asset('css/easy-responsive-tabs.css')}}">
<script src="{{asset('js/jquery.min.js')}}"></script>
<link href="//fonts.googleapis.com/css?family=Overpass:100,100i,200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;subset=latin-ext" rel="stylesheet">
</head>
<body>
	<div class="main">	
		<h1>e-Shop Camaleón</h1>
		<div class="w3_agile_main_grids">
			<div class="agile_main_top_grid">
				<div class="agileits_w3layouts_main_top_grid_left">
					<a href="#"><img src="{{asset('images/1.png')}}" alt=" " /></a>
				</div>
				<div class="w3_agileits_main_top_grid_right">
					<h3>Formulario de pago</h3>
				</div>
				<div class="clear"> </div>
				<div class="wthree_total">
					<h2>Total de la compra <span>Q{{ number_format($cart->grand_total, 2) }}</span></h2>
				</div>
			</div>
			<div class="agileinfo_main_bottom_grid">
				<div id="horizontalTab">
					<ul class="resp-tabs-list">
						<li><img src="{{asset('images/1.jpg')}}" alt=" " /></li>
					</ul>
					<div class="resp-tabs-container">
						<div class="agileits_w3layouts_tab1">
							<form action="{{ route('paypal.standard.validar') }}" method="post" class="creditly-card-form agileinfo_form">
                                @csrf()
                                @foreach ($paypalStandard->getFormFields() as $name => $value)
                                <input type="hidden" id="{{ $name }}" name="{{ $name }}" value="{{ $value }}">
                                @endforeach
                                <section class="creditly-wrapper wthree, w3_agileits_wrapper">
									<div class="credit-card-wrapper">
										<div class="first-row form-group">
											<div class="controls">
												<label class="control-label">Nombre en Tarjeta</label>
                                                <input class="billing-address-name form-control" type="text" name="name" placeholder="John Smith">
                                                <input class="card-type" type="hidden" name="card-type">
											</div>
											<div class="w3_agileits_card_number_grids">
												<div class="w3_agileits_card_number_grid_left">
													<div class="controls">
														<label class="control-label">Número de tarjeta</label>
														<input class="number credit-card-number form-control" type="text" name="number"
																	  inputmode="numeric" autocomplete="cc-number" autocompletetype="cc-number" x-autocompletetype="cc-number"
																	  placeholder="&#149;&#149;&#149;&#149; &#149;&#149;&#149;&#149; &#149;&#149;&#149;&#149; &#149;&#149;&#149;&#149;">
													</div>
												</div>
												<div class="w3_agileits_card_number_grid_right">
													<div class="controls">
														<label class="control-label">CVV</label>
														<input class="security-code form-control"
																	  inputmode="numeric"
																	  type="text" name="security-code"
                                                                      placeholder="&#149;&#149;&#149;">
                                                                    </div>
                                                                </div>
												<div class="clear"> </div>
											</div>
											<div class="controls">
												<label class="control-label">Fecha de expiración</label>
												<input class="expiration-month-and-year form-control" type="text" name="expiration-month-and-year" placeholder="MM / YY">
											</div>
										</div>
										<button class="submit"><span>Realizar pago</span></button>
									</div>
								</section>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="agileits_copyright">
			<p>© 2020 Corporación Camaleón S. A. - Todos los derechos reservados.</p>
		</div>
	</div>
	<!-- credit-card -->
		<script type="text/javascript" src="{{asset('js/creditly.js')}}"></script>
		<script type="text/javascript" src="{{asset('js/jquery.creditCardValidator.js')}}"></script>
		<script type="text/javascript">
			$(function() {
			  var creditly = Creditly.initialize(
				  '.creditly-wrapper .expiration-month-and-year',
				  '.creditly-wrapper .credit-card-number',
				  '.creditly-wrapper .security-code',
				  '.creditly-wrapper .card-type');

			  $(".creditly-card-form .submit").click(function(e) {
				e.preventDefault();
				var output = creditly.validate();
				if (output) {
				  // Your validated credit card output
                  console.log(output);
                  $(".creditly-card-form").submit();
				}
			  });
            });
           
    $(function() {
        $('input.credit-card-number').validateCreditCard(function(result) {
            $('.card-type').val((result.card_type == null ? '' : result.card_type.name));
        });
    });
		</script>
    
</body>
</html>