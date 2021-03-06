@extends('template.dashboard_layout')
@section('title', 'Add Slider | Laravel')

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
	<li>
		<i class="icon-edit"></i>
		<a href="#">Add Slider</a> with form validation
	</li>
</ul>

<a href="{{URL::to('/all-slider')}}" class="btn btn-primary">All slider</a>
<br>

<!--From Validation error Message Show-->
	@if( count($errors) > 0)
		@foreach($errors->all() as $error)
			<p class="alert alert-danger">{{ $error }}</p>
		@endforeach
	@endif 
<!--From Validation Error Message Show-->

<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header" data-original-title>
			<h2><i class="halflings-icon edit"></i><span class="break"></span>Add Slider</h2>
			<div class="box-icon">
				<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
				<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
				<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
			</div>
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


		<div class="box-content">
			<form class="form-horizontal" action="{{URL::to('/save-slider')}}" method="post" method="post" enctype="multipart/form-data">
				{{ csrf_field() }}
			  <fieldset>
				
				<div class="control-group">
				  <label class="control-label" for="date01">Slider Name</label>
				  <div class="controls">
					<input type="text" class="input-xlarge" name="slider_name" value="">
				  </div>
				</div>

				<div class="control-group">
				  <label class="control-label" for="date01">Publication Status</label>
				  <div class="controls">
					<input type="checkbox" class="input-xlarge" name="slider_status" value="1">
				  </div>
				</div>

				<div class="control-group">
				  <label class="control-label" for="fileInput">Slider Image</label>
				  <div class="controls">
					<input class="input-file uniform_on" id="fileInput" type="file" name="slider_image">
				  </div>
				</div> 


				<div class="form-actions">
				  <button type="submit" class="btn btn-primary">Add slider</button>
				  <button type="reset" class="btn">Cancel</button>
				</div>
			  </fieldset>
			</form>   

		</div>
	</div><!--/span-->

</div><!--/row-->




@endsection()


@section('extra_page_script')
  		<!--Extra Script here-->
@endsection