@extends('template.home_layout')

@section('content')
    
<?php //echo Session::get('customer_id');?>

<div class="breadcrumbs">
	<ol class="breadcrumb">
	  <li><a href="#">Home</a></li>
	  <li class="active">Success</li>
	</ol>
</div>



<section id="cart_items">
	<div class="container">
		
		<!--Show Error Message Start-->
		<p class="alert-success">
		<?php 
		//show error message
			$message =Session::get('message'); //get message from session
			if($message){ //get message from session
				echo '<h2 class="alert alert-success">'.$message.'</h2>'; //show message
				Session::put('message', null); //put null message session after showing message
			}
		?></p>
		<!--Show Error Message End-->

		<br><br><br><br>
	</div>
</section><!--/#do_action-->



@endsection