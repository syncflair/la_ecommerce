@extends('template.dashboard_layout')
@section('title', 'Edit Product | Laravel')

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
		<a href="#">Update Product</a>
	</li>
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
			<h2><i class="halflings-icon edit"></i><span class="break"></span>Update Product</h2>
			<div class="box-icon">
				<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
				<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
				<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
			</div>
		</div>


		<div class="box-content">
			<form class="form-horizontal" action="{{URL::to('/update-product/'.$product_info_view->product_id)}}" method="post" enctype="multipart/form-data">
				{{ csrf_field() }}
			  <fieldset>
				
				<div class="control-group">
				  <label class="control-label" for="date01">Product Name</label>
				  <div class="controls">
					<input type="text" class="input-xlarge" name="pro_name" value="{{$product_info_view->pro_name}}" required="">
				  </div>
				</div>

				<div class="control-group">
					<label class="control-label" for="selectError3">Product Category</label>
					<div class="controls">
					  <select id="selectError3" name="category_id">
					  	<option>Select Category</option>
					  	<?php 
                            //show all Brand
                            $all_published_category = DB::table('tbl_category')->where('pub_status', 1)->get();

                            foreach($all_published_category as $v_category){                                
                        ?>

							<option value="{{$v_category->category_id}}" 
									@if( $v_category->category_id == $product_info_view->category_id) selected="selected" @endif >
								{{$v_category->category_name}}
							</option>

						<?php } ?>

					  </select>
					</div>
				  </div>

				<div class="control-group">
				  <label class="control-label" for="date01">Product Brand</label>
				  <div class="controls">
					<select id="selectError3" name="brand_id">
						<option>Select Brand</option>
						<?php 
                            //show all Brand
                            $all_published_brand = DB::table('tbl_brand')->where('pub_status', 1)->get();

                            foreach($all_published_brand as $v_brand){                              
                        ?>
						
							<option value="{{$v_brand->brand_id}}" @if($v_brand->brand_id ==$product_info_view->brand_id ) selected="selected" @endif >     							{{$v_brand->brand_name}}
							</option>
						
						<?php } ?>

					  </select>
				  </div>
				</div>

				

				<div class="control-group">
				  <label class="control-label" for="date01">Product Color</label>
				  <div class="controls">
					<input type="text" class="input-xlarge" name="pro_color" value="{{$product_info_view->pro_color}}">
				  </div>
				</div>

				<div class="control-group">
				  <label class="control-label" for="date01">Product Size</label>
				  <div class="controls">
					<input type="text" class="input-xlarge" name="pro_size" value="{{$product_info_view->pro_size}}" >
				  </div>
				</div>

				<div class="control-group">
				  <label class="control-label" for="date01">Product Price</label>
				  <div class="controls">
					<input type="text" class="input-xlarge" name="pro_price" value="{{$product_info_view->pro_price}}" >
				  </div>
				</div>

				<!--<div class="control-group">
				  <label class="control-label" for="date01">Publication Status</label>
				  <div class="controls">
					<input type="checkbox" class="input-xlarge" name="pub_status" value="1">
				  </div>
				</div>-->
				<div class="control-group">
				  <label class="control-label" for="fileInput">Product Image</label>
				  <div class="controls">
					<input class="input-file uniform_on" id="fileInput" type="file" name="pro_image">
				  </div>
				  <div> <img class="img-thumbnail" style="width: 80px; height: 80px; padding: 5px;" src="{{URL::to($product_info_view->pro_image) }}"> </div>
				</div> 


				<div class="control-group hidden-phone">
				  <label class="control-label" for="textarea2">Product Description</label>
				  <div class="controls">
					<textarea class="cleditor" name="pro_desc" rows="2" >{{$product_info_view->pro_desc}}</textarea>
				  </div>
				</div>


				<div class="form-actions">
				  <button type="submit" class="btn btn-primary">Update product</button>
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