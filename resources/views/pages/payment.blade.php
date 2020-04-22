@extends('template.home_layout')

@section('content')
    
<?php //echo Session::get('customer_id');?>

<div class="breadcrumbs">
	<ol class="breadcrumb">
	  <li><a href="#">Home</a></li>
	  <li class="active">Payment method</li>
	</ol>
</div>

<!--Show Error Message Start-->
<p class="alert-success">
<?php 
//show error message
	$message =Session::get('message'); //get message from session
	if($message){ //get message from session
		echo $message; //show message
		Session::put('message', null); //put null message session after showing message
	}
?></p>
<!--Show Error Message End-->



<section id="cart_items">
	<div class="container">
		
		<?php
			//get data from Cart 
			$CartContent = Cart::content();	

			/*echo '<pre>';
			print_r($CartContent);//*/
		?>

		<div class="table-responsive cart_info">
			<table class="table table-condensed">
				<thead>
					<tr class="cart_menu">
						<td class="image">Image</td>
						<td class="name">Name</td>
						<td class="price">Price</td>
						<td class="quantity">Quantity</td>
						<td class="total">Total</td>
						<td></td>
					</tr>
				</thead>
				<tbody>

					<?php foreach($CartContent as $cart_data){ ?>
					<tr>				

						<td class="cart_image">
							<a href=""><img src="{{ $cart_data->options->image }}" alt="" style="height: 80px; width: 80px;"></a>
						</td>
						<td class="cart_name">
							<h4><a href="">{{$cart_data->name}}</a></h4>
							<!--<p>Web ID: 1089772</p> -->
						</td>
						<td class="cart_price">
							<p>{{$cart_data->price}} Tk</p>
						</td>
						<td class="cart_quantity">
							<div class="cart_quantity_button">
								<form action="{{url('/update-cart')}}" method="post">
									{{ csrf_field() }}
									<!--<a class="cart_quantity_up" href=""> + </a>-->
									<input type="hidden" name="rowId" value="{{$cart_data->rowId}}" >
									<input class="cart_quantity_input" type="text" name="quantity" value="{{$cart_data->qty}}" autocomplete="off" size="2">
									<!--<a class="cart_quantity_down" href=""> - </a> -->
									<input type="submit" value="Update" name="submit" class="btn btn-sm btn-default">
								</form>
							</div>
						</td>
						<td class="cart_total">
							<p class="cart_total_price">{{$cart_data->total}}  Tk</p>
						</td>
						<td class="cart_delete">
							<a class="cart_quantity_delete" href="{{URL::to('/delete-to-cart/'.$cart_data->rowId)}}"><i class="fa fa-times"></i></a>
						</td>
					</tr>

					<?php } ?>

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
		
		<div class="paymentCont col-sm-8">
					<div class="headingWrap">
							<h3 class="headingTop text-center">Select Your Payment Method</h3>	
							<p class="text-center">Created with bootsrap button and using radio button</p>
					</div>

					<br><br>
					<form action="{{url('make-payment')}}" method="post">
						{{csrf_field()}}
						<div class="paymentWrap">
							<div class="btn-group paymentBtnGroup btn-group-justified" data-toggle="buttons">
					            

					            <label class="btn paymentMethod active">
				            		<div class="method cash-on-delivery"> Cash on delivery</div>
					                <input type="radio" name="payment_method" value="cash_on_delivery" checked> 
					            </label> 

					       		<label class="btn paymentMethod">
				             		<div class="method Bkash"> Bkash </div>
					                <input type="radio" name="payment_method" value="Bkash"> 
					            </label>
					            <label class="btn paymentMethod">
					            	<div class="method master-card"> Master Card </div>
					                <input type="radio" name="payment_method" value="master_card"> 
					            </label>
					         
					        </div>        
						</div>
						<br><br>
						<input type="submit" name="Make Payment" class="btn btn-success ">
					</form>

					<br><br>
				</div>
	</div>
</section><!--/#do_action-->



@endsection