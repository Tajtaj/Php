<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<head>
	<title>Free Home Shoppe Website Template | Home :: w3layouts</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	{{ HTML::style('assets/css/style.css'); }}
	{{ HTML::style('assets/css/slider.css'); }}
	{{ HTML::style('assets/css/easy-responsive-tabs.css'); }}
	{{ HTML::style('assets/css/global.css'); }}
	<!--{{ HTML::style('assets/packages/bootstrap/css/bootstrap.min.css'); }}
    -->

	{{ HTML::script('assets/js/jquery-1.7.2.min.js'); }}
	{{ HTML::script('assets/js/move-top.js'); }}
	{{ HTML::script('assets/js/easing.js'); }}
	{{ HTML::script('assets/js/startstop-slider.js'); }}
	{{ HTML::script('assets/js/easyResponsiveTabs.js'); }}
	{{ HTML::script('assets/js/slides.min.jquery.js'); }}
	{{ HTML::script('assets/js/nice-scroll/jquery.nicescroll.min.js'); }}
	

</head>
<body>
	<div class="wrap">
		<div class="header">
			<div class="headertop_desc">
				<div class="call">
					<p><span>Need help?</span> call us <span class="number">1-22-3456789</span></span></p>
				</div>
				<div class="account_desc">
					<ul>
						<li><a href="#">Register</a></li>
						<li><a href="#">Login</a></li>
						<li><a href="#">Delivery</a></li>
						<li><a href="#">Checkout</a></li>
						<li><a href="#">My Account</a></li>
					</ul>
				</div>
				<div class="clear"></div>
			</div>
			<div class="header_top">
				<div class="logo">
					<a href="index.html"><img src="{{URL::to('/').'/assets/images/logo.png'}}" alt="" /></a>
				</div>
				<div class="cart">
					<p>Welcome to our Online Store! <span>Cart:</span>
						<div id="dd" class="wrapper-dropdown-2"> <span id="cartItems">{{Cart::count(false);}}</span> item(s) - $<span id="cartTotal">{{Cart::total();}}</span>
						<ul class="dropdown cart-dropdown">
							@if(Cart::count(false) != 0)
							
							
							{{-- */$contents=Cart::content();/* --}}
							
							@foreach($contents as $content)
							<li>{{$content->name}} {{$content->qty}} {{$content->price}}{{$content->price * $content->qty}}<a href="#" class="removeitem" rowId="{{$content->rowid}}">Remove</a></li>
							
							@endForeach
							<li class='payment'><a href="{{ URL::route('payment') }}" >payment</a></li>
							@endIf
						</ul></div></p>
					</div>
					<script type="text/javascript">
					function DropDown(el) {
						this.dd = el;
						this.initEvents();
					}
					DropDown.prototype = {
						initEvents : function() {
							var obj = this;

							obj.dd.on('click', function(event){
								$(this).toggleClass('active');
								event.stopPropagation();
							});	
						}
					}

					$(function() {

						var dd = new DropDown( $('#dd') );

						$(document).click(function() {
					// all dropdowns
					$('.wrapper-dropdown-2').removeClass('active');
				});

					});

					</script>
					<div class="clear"></div>
				</div>
				<div class="header_bottom">
					<div class="menu">
						<ul>
							<li class="active"><a href="{{ URL::route('home') }}">Home</a></li>
							<li><a href="about.html">About</a></li>
							<li><a href="delivery.html">Delivery</a></li>
							<li><a href="news.html">News</a></li>
							<li><a href="contact.html">Contact</a></li>
							<div class="clear"></div>
						</ul>
					</div>
					<div class="search_box">
						<form>
							<input type="text" value="Search" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search';}"><input type="submit" value="">
						</form>
					</div>
					<div class="clear"></div>

				</div>	     
		
			</div>
               @yield('content')


		</div>
	</div>
</div>

<div class="footer">
	<div class="wrap">	
		<div class="section group">
			<div class="col_1_of_4 span_1_of_4">
				<h4>Information</h4>
				<ul>
					<li><a href="about.html">About Us</a></li>
					<li><a href="contact.html">Customer Service</a></li>
					<li><a href="#">Advanced Search</a></li>
					<li><a href="delivery.html">Orders and Returns</a></li>
					<li><a href="contact.html">Contact Us</a></li>
				</ul>
			</div>
			<div class="col_1_of_4 span_1_of_4">
				<h4>Why buy from us</h4>
				<ul>
					<li><a href="about.html">About Us</a></li>
					<li><a href="contact.html">Customer Service</a></li>
					<li><a href="#">Privacy Policy</a></li>
					<li><a href="contact.html">Site Map</a></li>
					<li><a href="#">Search Terms</a></li>
				</ul>
			</div>
			<div class="col_1_of_4 span_1_of_4">
				<h4>My account</h4>
				<ul>
					<li><a href="contact.html">Sign In</a></li>
					<li><a href="index.html">View Cart</a></li>
					<li><a href="#">My Wishlist</a></li>
					<li><a href="#">Track My Order</a></li>
					<li><a href="contact.html">Help</a></li>
				</ul>
			</div>
			<div class="col_1_of_4 span_1_of_4">
				<h4>Contact</h4>
				<ul>
					<li><span>+91-123-456789</span></li>
					<li><span>+00-123-000000</span></li>
				</ul>
				<div class="social-icons">
					<h4>Follow Us</h4>
					<ul>
						<li><a href="#" target="_blank"><img src="images/facebook.png" alt="" /></a></li>
						<li><a href="#" target="_blank"><img src="images/twitter.png" alt="" /></a></li>
						<li><a href="#" target="_blank"><img src="images/skype.png" alt="" /> </a></li>
						<li><a href="#" target="_blank"> <img src="images/dribbble.png" alt="" /></a></li>
						<li><a href="#" target="_blank"> <img src="images/linkedin.png" alt="" /></a></li>
						<div class="clear"></div>
					</ul>
				</div>
			</div>
		</div>			
	</div>
	<div class="copy_right">
		<p>Company Name © All rights Reseverd | Design by  <a href="http://w3layouts.com">W3Layouts</a> </p>
	</div>
</div>

<a href="#" id="toTop"><span id="toTopHover"> </span></a>

</body>
<script type="text/javascript">
$(document).ready(function() {			
	$().UItoTop({ easingType: 'easeOutQuart' });
	$(".removeitem").click(function(e) {
		e.preventDefault();
		var url = "{{URL::route('removeItem')}}";

        var rowid = $(this).attr("rowid");
        $(this).parent().remove();
        $.ajax({
            url: url,
            type: 'POST',
            data: {rowid: rowid},
            dataType: 'json',
            success: function (result) {
            	$("#cartItems").html(result.count);
            	$("#cartTotal").html(result.price);
                if(result.count == 0){
                	$('.payment').remove();
                	
                }
            }
        });
    });

});
</script>

</html>

