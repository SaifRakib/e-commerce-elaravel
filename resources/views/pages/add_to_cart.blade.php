@extends('index')
@section('content')

<section id="cart_items">
		<div class="container col-sm-12">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Shopping Cart</li>
				</ol>
			</div>
			<div class="table-responsive cart_info">
				@php
				$contents = Cart::getContent();
				


				@endphp


				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Image</td>
							<td class="name">Name</td>
							<td class="price">Price</td>
							<td class="quantity">Quantity</td>
							<td class="total">Total</td>
							<td class="action">Actions</td>
						</tr>
					</thead>
					<tbody>
						@foreach($contents as $v_content)
						<tr>
							<td class="cart_product">
								<a href=""><img src="{{URL::to($v_content->attributes->images)}}" style="height: 80px; width: 80px;" alt=""></a>
							</td>
							<td class="cart_description">
								<h4><a href="">{{$v_content->name}}</a></h4>
								<p>PD {{$v_content->id}}</p>
							</td>
							<td class="cart_price">
								<p>{{$v_content->price}} Tk</p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
									<form action="{{URL::to('update-cart')}}" method="post">
										@csrf
									<input class="cart_quantity_input" type="text" name="quantity" value="{{$v_content->quantity}}" autocomplete="off" size="2">
									<input type="hidden" name="id" value="{{$v_content->id}}">
									<input type="submit" name="submit" value="update" class="btn btn-success">
									</form>
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">{{$v_content->getPriceSum()}}</p>
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" href="{{URL::to('/delete-to-cart/'.$v_content->id)}}"><i class="fa fa-times"></i></a>
							</td>
						</tr>
						@endforeach

					</tbody>
				</table>
			</div>
		</div>
	</section> <!--/#cart_items-->

	<section id="do_action">
		<div class="container">
			<div class="heading">
				<h3>What would you like to do next?</h3>
				<p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
			</div>
			<div class="row">
				<div class="col-sm-6">
				
				</div>
				<div class="col-sm-8">
					<div class="total_area">
						<ul>
							<li>Cart Sub Total <span>{{Cart::getSubTotal()}}</span></li>
							<li>Eco Tax <span>0</span></li>
							<li>Shipping Cost <span>Free</span></li>
							<li>Total <span>{{Cart::getTotal()}}</span></li>
						</ul>
							<a class="btn btn-default update" href="">Update</a>
							@php
								$customer_id = Session::get('customer_id');
							@endphp
							@if($customer_id != NULL)
								 <a class="btn btn-default check_out" href="{{URL::to('/checkout')}}">Check Out</a>
							@else
							<a class="btn btn-default check_out" href="{{URL::to('/login-check')}}">Check Out</a>
							@endif
					</div>
				</div>
			</div>
		</div>
	</section><!--/#do_action-->


@endsection