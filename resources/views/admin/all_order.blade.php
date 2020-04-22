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
	<li><a href="#">All order</a></li>
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
	<div class="box span12">
		<div class="box-header" data-original-title>
			<h2><i class="halflings-icon user"></i><span class="break"></span>All order</h2>
			<div class="box-icon">
				<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
				<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
				<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
			</div>
		</div>

		<div class="box-content">
			<table class="table table-striped table-bordered bootstrap-datatable datatable">
			  <thead>
				  <tr>
					  <th>Order ID</th>
					  <th>Customer Name</th>
					  
					  <th>Total</th>
					  <th>Status</th>
					  <th>Payment Methode</th>
					  <th>Date</th>
					  <th>Actions</th>
				  </tr>
			  </thead>   
			 

			  <!--blade loop, variable get from CateroryController-->
			  @foreach( $all_order_info_view as $v_order)

			   	<tbody>	
					<tr>
						<td>{{ $v_order->order_id }}</td>
						<td class="center">{{ $v_order->customer_name }}</td>					
						<td class="center">{{ $v_order->order_total }} Tk</td>				
						<td class="center">
							@if($v_order->order_status == 'Pending')
								<span class="label label-success">Pending</span>
							@else
								<span class="label label-danger">Paid</span>
							@endif
						</td>
						<td class="center">{{ $v_order->payment_method }}</td>
						<!--<td class="center"><img style="width:60px; height:60px; " src=""></td>-->
						<td class="center">{{ $v_order->created_at }}</td>
						

						
						
						<td class="center">
							@if($v_order->order_status == 'Pending')
								<a class="btn btn-danger" title="Click to Paid" href="{{URL::to('/paid-order/'.$v_order->order_id)}}">								
									<i class="halflings-icon white thumbs-down"></i>
								</a>
							@else
								<a class="btn btn-success" title="Click to Pending" href="{{URL::to('/pending-order/'.$v_order->order_id)}}">								
									<i class="halflings-icon white thumbs-up"></i>
								</a>
							@endif


							<a class="btn btn-info" href="{{URL::to('/edit-order/'.$v_order->order_id)}}">
								<i class="halflings-icon white edit"></i>  
							</a>
							<a class="btn btn-info" href="{{URL::to('/view-order/'.$v_order->order_id)}}">
								<i class="halflings-icon white view"></i>  
							</a>
							<a class="btn btn-danger" id="delete" href="{{URL::to('/delete-order/'.$v_order->order_id)}}">
								<i class="halflings-icon white trash"></i> 
							</a>
						</td>
					</tr>
				<tbody>
				@endforeach
			  	
				


		  </table>

		 
		  	<!--Use Bootstrap Pagination-->
		 	<nav aria-label="Page navigation example">
			  <ul class="pagination">
			    {{ $all_order_info_view->links() }}
			  </ul>
			</nav>


		</div>
	</div><!--/span-->

</div><!--/row-->



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