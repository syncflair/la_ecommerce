@extends('template.dashboard_layout')
@section('title', 'All order | Laravel')

@section('extra_page-style')
        	<!-- Extra Css files Here -->
@endsection

@section('content')


<ul class="breadcrumb">
	<li>
		<i class="icon-home"></i>
		<a href="index.html">Home</a> 
		<i class="icon-angle-right"></i>
	</li>
	<li><a href="#">Order details</a></li>
</ul>


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



<div class="row-fluid sortable">
	<div class="box span6">
		<div class="box-header">
			<h2><i class="halflings-icon align-justify"></i><span class="break"></span>Customer Details</h2>
		</div>
		<div class="box-content">
			<table class="table">				     
				  <tbody>
				  	<tr>
						<td>Order ID:</td>
						<td class="center">{{ $order_by_id_view->order_id }}</td>	
					</tr>
					<tr>
						<td>Name:</td>
						<td class="center">{{ $order_by_id_view->customer_name }}</td>
					</tr>
					<tr>
						<td>Email:</td>
						<td class="center">{{ $order_by_id_view->customer_email }}</td>	
					</tr>
					<tr>
						<td>Email:</td>
						<td class="center">{{ $order_by_id_view->mobile_number }}</td>	
					</tr>
					<tr>
						<td>Payment Method:</td>
						<td class="center">{{ $order_by_id_view->payment_method }}</td>	
					</tr>
					<tr>
						<td>Date:</td>
						<td class="center">{{ $order_by_id_view->created_at }}</td>	
					</tr>				                                  
				  </tbody>
			 </table>     
		</div>
	</div><!--/span-->
	
	<div class="box span6">
		<div class="box-header">
			<h2><i class="halflings-icon align-justify"></i><span class="break"></span>Shipping to...</h2>
		</div>
		<div class="box-content">
			<table class="table table-striped">				    
				  <tbody>
					<tbody>
					<tr>
						<td>Name:</td>
						<td class="center">{{ $order_by_id_view->ship_name }}</td>	
					</tr>
					<tr>
						<td>Email:</td>
						<td class="center">{{ $order_by_id_view->ship_email }}</td>	
					</tr>
					<tr>
						<td>Phone:</td>
						<td class="center">{{ $order_by_id_view->ship_mobile_phone }}</td>	                                     
					</tr>
					<tr>
						<td>Address:</td>
						<td class="center">{{ $order_by_id_view->ship_address }} , {{ $order_by_id_view->ship_city }} , {{ $order_by_id_view->zip_code }}</td>	                                     
					</tr>				                                  
				  </tbody>
					                                   
				  </tbody>
			 </table>    
		</div>
		

	</div><!--/span-->
</div><!--/row-->


<div class="row-fluid sortable">	
	<div class="box span12">
		<div class="box-header">
			<h2><i class="halflings-icon align-justify"></i><span class="break"></span>Product Details</h2>		
		</div>


		<?php

    	$order_details_by_id = DB::table('tbl_order_details')
    			->join('tbl_order', 'tbl_order_details.order_id', '=' , 'tbl_order.order_id')
    			->join('tbl_products', 'tbl_order_details.product_id', '=' , 'tbl_products.product_id')
                ->where('tbl_order_details.order_id', $order_by_id_view->order_id)
                ->select('tbl_order_details.*')
                ->get(); // get all row from table


		?>


		<div class="box-content">
			<table class="table table-bordered table-striped table-condensed">
				  <thead>
					  <tr>
						  <th>Product ID</th>
						  <th>Name</th>						  
						  <th>Price</th>
						  <th>Qty</th>
						  <th>Total</th>                                           
					  </tr>
				  </thead>   
				  <tbody>

				  	@foreach($order_details_by_id as $product_details)
					<tr>
						<td>{{ $product_details->product_id }}</td>
						<td class="center">{{ $product_details->product_name }}</td>
						<td class="center">{{ $product_details->product_price }}</td>
						<td class="center">{{ $product_details->product_sales_qty }}</td>
						<td class="center"> {{ $product_details->product_price * $product_details->product_sales_qty}} </td>                                       
					</tr>
					     
					@endforeach                             
				  </tbody>
				  <tfoot>				  	
				  	<tr>
						<td></td>
						<td></td>
						<td></td>
						<td>Total Price: </td>
						<td class="center" style="font-weight: bold;">{{ $order_by_id_view->order_total }}</td>           
					</tr>
				  </tfoot>
			 </table>  
			     
		</div>
	</div><!--/span-->
</div><!--/row-->


<!--<div class="row-fluid sortable">
	<div class="box-content" style="text-align: right;">		
		<h1> Total: {{ $order_by_id_view->order_total }} </h1>
	</div>
</div>--><!--/row-->

@endsection()


@section('extra_page_script')

<!--Extra Script here-->

<!--BootBox Use for alert function-->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>

	 <script>  
        $(document).on("click", "#delete", function(e){
             e.preventDefault();
             var link = $(this).attr("href");

             bootbox.confirm("Are you want to delete!! ", function(confirmed){

             	if(confirmed){

             		window.location.href =link;
             	}

             });                
        });
    </script>	
<!--BootBox End-->
@endsection