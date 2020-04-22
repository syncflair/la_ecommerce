@extends('template.dashboard_layout')
@section('title', 'Edit Brand | Laravel')

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
		<a href="#">Update Brand</a>
	</li>
</ul>

<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header" data-original-title>
			<h2><i class="halflings-icon edit"></i><span class="break"></span>Update Brand</h2>
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
			<form class="form-horizontal" action="{{URL::to('/update-brand/'.$brand_info_view->brand_id)}}" method="post">
				{{ csrf_field() }}
			  <fieldset>

			  					
				<div class="control-group">
				  <label class="control-label" for="date01">Brand Name</label>
				  <div class="controls">
					<input type="text" class="input-xlarge" name="brand_name" value="{{$brand_info_view->brand_name}}" >
				  </div>
				</div>

				<div class="control-group hidden-phone">
				  <label class="control-label" for="textarea2">Brand Description</label>
				  <div class="controls">
					<textarea class="cleditor" name="brand_desc" rows="2" >{{$brand_info_view->brand_desc}}</textarea>
				  </div>
				</div>


				<div class="form-actions">
				  <button type="submit" class="btn btn-primary">Update</button>
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