@extends('index')
@section('content')
<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Check out</li>
				</ol>
			</div><!--/breadcrums-->

			<div class="shopper-informations">
				<div class="row">
					<div class="col-sm-12 clearfix">
						<div class="bill-to">
							<p>Bill To</p>
							<div class="form-one">
								<form action="{{URL::to('/save-shipping-method')}}" method="post"> 
									@csrf
									
									<input type="text" name="shipping_first_name" placeholder="First Name">
									<input type="text" name="shipping_last_name" placeholder="Last Name">
									<input type="text" name="shipping_email" placeholder="Email">
									<input type="text" name="shipping_address" placeholder="Address">
                                    <input type="text" name="shipping_mobile_number" placeholder="Mobile Number">
									<input type="text" name="shipping_city" placeholder="City">
                                    <input type="submit" name="submit"  class="btn btn-default">
								</form>
							</div>
							
						</div>
					</div>
				
			</div>
		</div>
	</section> <!--/#cart_items-->



@endsection