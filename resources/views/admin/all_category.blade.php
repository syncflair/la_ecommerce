@extends('template.dashboard_layout')
@section('title', 'All Category | Laravel')

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
	<li><a href="#">All Category</a></li>
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
			<h2><i class="halflings-icon user"></i><span class="break"></span>All Category</h2>
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
					  <th>Category ID</th>
					  <th>Category Name</th>
					  <th>Description</th>
					  <th>Status</th>
					  <th>Actions</th>
				  </tr>
			  </thead>   
			 

			  <!--blade loop, variable get from CateroryController-->
			  @foreach( $all_category_info_view as $v_category)

			   	<tbody>	
					<tr>
						<td>{{ $v_category->category_id }}</td>
						<td class="center">{{ $v_category->category_name }}</td>
						<td class="center">{{ $v_category->category_description }}</td>
						
						<td class="center">

							@if($v_category->pub_status == 1)
								<span class="label label-success">Active</span>
							@else
								<span class="label label-danger">Unactive</span>
							@endif
						</td>
						

						
						
						<td class="center">
							@if($v_category->pub_status == 1)
								<a class="btn btn-danger" title="Click to Unactive" href="{{URL::to('/unactive-category/'.$v_category->category_id)}}">								
									<i class="halflings-icon white thumbs-down"></i>
								</a>
							@else
								<a class="btn btn-success" title="Click to Active" href="{{URL::to('/active-category/'.$v_category->category_id)}}">								
									<i class="halflings-icon white thumbs-up"></i>
								</a>
							@endif


							<a class="btn btn-info" href="{{URL::to('/edit-category/'.$v_category->category_id)}}">
								<i class="halflings-icon white edit"></i>  
							</a>
							<a class="btn btn-danger" id="delete" href="{{URL::to('/delete-category/'.$v_category->category_id)}}">
								<i class="halflings-icon white trash"></i> 
							</a>
						</td>
					</tr>
				<tbody>
				@endforeach		

				

				<!--
				<tr>
					<td>Alphonse Ivo</td>
					<td class="center">2012/01/01</td>
					<td class="center">Member</td>
					<td class="center">
						<span class="label label-success">Active</span>
					</td>
					<td class="center">
						<a class="btn btn-success" href="#">
							<i class="halflings-icon white zoom-in"></i>  
						</a>
						<a class="btn btn-info" href="#">
							<i class="halflings-icon white edit"></i>  
						</a>
						<a class="btn btn-danger" href="#">
							<i class="halflings-icon white trash"></i> 
						</a>
					</td>
				</tr>
				<tr>
					<td>Thancmar Theophanes</td>
					<td class="center">2012/01/01</td>
					<td class="center">Member</td>
					<td class="center">
						<span class="label label-success">Active</span>
					</td>
					<td class="center">
						<a class="btn btn-success" href="#">
							<i class="halflings-icon white zoom-in"></i>  
						</a>
						<a class="btn btn-info" href="#">
							<i class="halflings-icon white edit"></i>  
						</a>
						<a class="btn btn-danger" href="#">
							<i class="halflings-icon white trash"></i> 
						</a>
					</td>
					</td>
				</tr>
			
			
				
				<tr>
					<td>Sana Amrin</td>
					<td class="center">2012/08/23</td>
					<td class="center">Staff</td>
					<td class="center">
						<span class="label label-important">Banned</span>
					</td>
					<td class="center">
						<a class="btn btn-success" href="#">
							<i class="halflings-icon white zoom-in"></i>                                            
						</a>
						<a class="btn btn-info" href="#">
							<i class="halflings-icon white edit"></i>                                            
						</a>
						<a class="btn btn-danger" href="#">
							<i class="halflings-icon white trash"></i> 
						</a>
					</td>
				</tr>
				<tr>
					<td>Adinah Ralph</td>
					<td class="center">2012/06/01</td>
					<td class="center">Admin</td>
					<td class="center">
						<span class="label">Inactive</span>
					</td>
					<td class="center">
						<a class="btn btn-success" href="#">
							<i class="halflings-icon white zoom-in"></i>                                            
						</a>
						<a class="btn btn-info" href="#">
							<i class="halflings-icon white edit"></i>                                            
						</a>
						<a class="btn btn-danger" href="#">
							<i class="halflings-icon white trash"></i> 
						</a>
					</td>
				</tr>
				<tr>
					<td>Dederick Mihail</td>
					<td class="center">2012/06/01</td>
					<td class="center">Admin</td>
					<td class="center">
						<span class="label">Inactive</span>
					</td>
					<td class="center">
						<a class="btn btn-success" href="#">
							<i class="halflings-icon white zoom-in"></i>                                            
						</a>
						<a class="btn btn-info" href="#">
							<i class="halflings-icon white edit"></i>                                            
						</a>
						<a class="btn btn-danger" href="#">
							<i class="halflings-icon white trash"></i> 
						</a>
					</td>
				</tr>
				<tr>
					<td>Hipólito András</td>
					<td class="center">2012/03/01</td>
					<td class="center">Member</td>
					<td class="center">
						<span class="label label-warning">Pending</span>
					</td>
					<td class="center">
						<a class="btn btn-success" href="#">
							<i class="halflings-icon white zoom-in"></i>                                            
						</a>
						<a class="btn btn-info" href="#">
							<i class="halflings-icon white edit"></i>                                            
						</a>
						<a class="btn btn-danger" href="#">
							<i class="halflings-icon white trash"></i> 
							
						</a>
					</td>
				</tr>
				<tr>
					<td>Fricis Arieh</td>
					<td class="center">2012/03/01</td>
					<td class="center">Member</td>
					<td class="center">
						<span class="label label-warning">Pending</span>
					</td>
					<td class="center">
						<a class="btn btn-success" href="#">
							<i class="halflings-icon white zoom-in"></i>                                            
						</a>
						<a class="btn btn-info" href="#">
							<i class="halflings-icon white edit"></i>                                            
						</a>
						<a class="btn btn-danger" href="#">
							<i class="halflings-icon white trash"></i> 
							
						</a>
					</td>
				</tr>			
			  </tbody>
			  -->


		  </table>            
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