@extends('template.dashboard_layout')
@section('title', 'Contact | Laravel') 

@section('extra_meta_tag')
<!--Make sure to add this in the meta tag of your view -->
 <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('extra_page_style')
        	<!-- Extra Css files Here -->

   <!--dataTable Css-->
   <link href="{{ asset('/datatables/css/dataTables.bootstrap.min.css') }}" rel="stylesheet" type="text/css">

   <!--Sweet Alert 2 -->
   <!--<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script> -->

   <!--Sweet Alert -->
   <!--<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>-->
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

   <style>
 	.pagination{list-style: none !important; display: inline-table; margin: 20px 0;}
 	.pagination li{float: left; padding: 0.5em 1em; color: #333 !important;
    border: 1px solid transparent; border-radius: 2px;}
 	.pagination li .active{background: black; color: #ffffff;}
 	</style>

@endsection

@section('content')


<ul class="breadcrumb">
	<li>
		<i class="icon-home"></i>
		<a href="index.html">Home</a> 
		<i class="icon-angle-right"></i>
	</li>
	<li><a href="#">All Contact</a></li>
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

		<div class="col-md-10 table-responsive" style="padding: 15px !important;">
			<a onclick="addForm()" class="btn btn-primary pull-right" >Add Contact</a>
            <br>

			<table id="contact_table" class="table table-striped table-bordered display">
			  <thead>
				  <tr>
					  <th>ID</th>
					  <th>Name</th>
					  <th>Email</th>
					  <th>Phone</th>
					  <th>Image</th>
					  <th>Status</th>
					  <th>Actions</th>
				  </tr>
			  </thead>   
			 

			  <!--blade loop, variable get from CateroryController-->
			

			   	<!--<tbody>	
					
				<tbody>-->
		  </table>            
		</div>

		@include('panels.modal_form') <!--Bootstrap Contact form include here-->


@endsection()

@section('extra_page_script')
<!--Extra Script here-->

<!--dataTable JS-->
<!--ipt src="{{ asset('dataTables/js/jquery.dataTables.min.js') }}"></script>--><!--Use in main template-->
<script src="{{ asset('dataTables/js/dataTables.bootstrap.min.js') }}"></script>
<!--<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.js"></script>-->
<script src="{{ asset('/backend/validator/validator.min.js') }}"></script>

<script>

$.fn.dataTable.ext.errMode = 'none'; //scape error message
//$(document).ready(function(){

	//show data in table
	var table1 = $('#contact_table').DataTable({		
		processing:true,
		serverSide:true,
		//dom: 'lrtip',
		//ajax: 'data.json',	// this line may solve id releted errror	
    	searching: true,
    	//paging: true,
    	//pagingType: 'full_numbers',
    	order: [ 0, 'desc' ], //for asc desc order of table data
    	//scrollY: 400,
    	//select: true,
		ajax:{ url: "{{ route('all-contact.index') }}" },
		//ajax: "{{ route('all-contact.index') }}",
		 columns: [
          {data:'id', name:'id'},
          {data:'contact_name', name:'contact_name'},
          {data:'contact_email', name:'contact_email'},
          {data:'contact_phone', name:'contact_phone'},
          {data:'contact_image', name:'contact_image',
          		render: function(data, type, full, meta){
          			if(data!= null){
          				return '<img src="'+data+'"  class="img-thumbnail" style="width:35px; height:35px;" />';
          			}else{
          				return '<img src="{{URL::to('/UploadImage/common/no-img.png')}}"  class="img-thumbnail" style="width:35px; height:35px;" />';
          			}
          		},
          		orderable: false, searchable: false
          },
          {data:'contact_status', name:'contact_status'},
          {data:'action', name:'action', orderable: false, searchable: false }
        ]
	});


//});

//Call modal frome
function addForm() {
	//alert('ok');
    //save_method = "add";
    $('input[name_method]').val('POST');
    $('#form_modal').modal('show');
    $('#form_modal form')[0].reset();
    $('.modal-title').text('Add Contact');
    $('#insertbutton').text('Add Contact');//*/
  }


  //Insert data by Ajax
	 $(function(){
	    //$('#form_modal form').validator().on('submit', function (e) {	    	
	    $('#form_modal form').on('submit', function (e) {
	    	e.preventDefault(); // this prevents the form from submitting

	       // if (!e.isDefaultPrevented()){
	            /*var id = $('#id').val();
	            if (save_method == 'add') url = "{{ url('all-contact') }}";
	            else url = "{{ url('all-contact') . '/' }}" + id;//*/
	            $.ajax({	                
	                type : "POST", //find store method if type=POST
	                //url : url,
	                //url : "{{ url('all-contact') }}",	 
	                url : "{{ route('all-contact.store') }}",               
	                data: new FormData($("#form_modal form")[0]),
	                cache:false,
	               	contentType: false,
	               	processData: false,
	               	//dataType: 'json', //work without dataType
	                success : function(data) {	
	                   if(data.errors)
		                {
		                    var error_html = '';
		                    for(var count = 0; count < data.errors.length; count++)
		                    {
		                        error_html += '<p class="alert alert-danger">'+data.errors[count]+'</p>';
		                    }

		                    $('#errors_output').html(error_html);
		                   /* Swal.fire({	                   	
		                      title: "Opps..!",
		                      html: '<h2>'+error_html+'</h2>',
		                      icon: "error",
		                      button: "Great!",
		                    });//*/
		                }
		                if(data.success){
		                	//$('#errors_output').html('<h1>'+data.message+'</h1>');           	
		                	//
		                	$('#contact_status').val(0).prop('checked', false);
		                	$('#form_modal form')[0].reset();
		                	$('#form_modal').modal('hide');
		                	
		                	Swal.fire({	                   	
		                      title: "Good job!",
		                      html: '<h2>'+data.success+'</h2>',
		                      icon: "success",
		                      button: "Great!",
		                    });
		                    //$("#form_modal form #checkbox").prop("checked", false);
		                   // $("#checkbox").prop("checked", false);
		                   	
		                	//$("#form_modal form ").trigger('reset');
		                	$('#errors_output').html('');
		                	table1.ajax.reload( null, false );               
		                    
		                	//$('#errors_output').html(data.success);
		                }//*/	                  
	                }/*,
	                error : function(data){
	                    Swal.fire({
	                    	//position: 'top-end',
	                    	icon: "error",
	                        title: 'Oops, Something wrong..',
	                        icon: "success",
	                        html: '<p>'+data.errors+'</p>',
	                        timer: '1500'
	                    })
	                }//*/
	            });
	            //return false;
	       // }


	    });
	});

function showData(id) {
	alert('showForm '+id);
	//$('#contact_table').dataTable().ajax.reload();
	
	/*var id = id;
	//alert(id);
	swal({
	  title: "Show Contact Information!",
	  text: "Your contact id is - "+ id,
	  icon: "success",
	  button: "Done!",
	});//*/

}

//delete ajax request are here
function editForm(id){
	var id = id; alert('editForm '+id);

}

//delete ajax request are here
function deleteData(id){
	event.preventDefault();  //this is importent
	//var csrf_token = $('meta[name="csrf-token"]').attr('content');
	var id = id; //alert('deleteData '+id);

	Swal.fire({
	  title: 'Are you sure to Delete?',
	  text: "You won't be able to revert this!",
	  icon: 'warning',
	  showCancelButton: true,
	  confirmButtonColor: '#3085d6',
	  cancelButtonColor: '#d33',	
	  confirmButtonText: 'Yes, delete it!'
	}).then( (result) => {

		if ( result.value ) {
			//alert('work');

			$.ajax({
				url:"all-contact/destroy/"+id,
				success : function(data) {
					if(data.success){ //alert(data.success);
						table1.ajax.reload();
					  	Swal.fire(
						  'Deleted!',
						   data.success,
						  'success'
						)
				  	}
				  	if(data.errors){
				  		Swal.fire(
						  'Opps!',
						   data.errors,
						  'error'
						)
				  	}
				}
			}); 

		}else{
			Swal.fire({
				icon: 'info',
				text: 'Your imaginary file is safe!'
			})
		}
	})

}//end deleteData


//Change Checkbox value for all form
$('form').on('change', 'input[type=checkbox]', function() {
	this.checked ? this.value = 1 : this.value = 0; //this.checked ? this.value = 1 : this.value = 0;
});


</script>



<!--BootBox Use for alert function-->
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>
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
    </script>	-->
<!--BootBox End-->

@endsection