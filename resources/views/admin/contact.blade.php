@extends('template.dashboard_layout')
@section('title', 'Contact | Laravel') 

@section('extra_meta_tag')
<!--Make sure to add this in the meta tag of your view -->
<meta name="csrf-token" content="{{ csrf_token() }}" >

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
					  <th><button type="button" id="bulk_delete" class="btn btn-warning">Delete</button></th>
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
//this code solve token mismatch problem. but must be add meta csrf at top
/*$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'), 'Content-Type': 'application/json'
    }
   // headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'), 'Content-Type': 'application/json' }
}); //*/




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
          {data:'action', name:'action', orderable: false, searchable: false },
          {data:'checkbox', name:'checkbox', orderable: false, searchable: false },
          /*{data:'checkbox', name:'checkbox',
          		render: function(data, type, full, meta){          		
          			return '<form type="post">{{ csrf_field() }}<input type="checkbox" name="contact_checkbox[]" class="contact_checkbox" id="'+full.id+'" value="" /></form>';
          		},
          		orderable: false, searchable: false
          }, //this code also work//*/
          
        
        ]
	});


//});

$('.close-form').on('click', function(){
	$('#form_modal form')[0].reset();
	$('#fileInput').val(null);
	$('#errors_output').html('');	
	//$('#form_modal form')[0].trigger("reset");
})

//Call modal frome
function addForm() {
	//alert('ok');
    //save_method = "add";
    $('#form_action').val("Add");
    //$('input[name_method]').val('POST');
    $('#contact_status').prop('checked', false);
    $('#form_modal form')[0].reset();
    //$('#contact_status').val(3);
  	//$('#contact_status').removeAttr('checked');
  	
    //$('.modal-title').text('Add Contact');
    //$('#insertbutton').text('Add Contact');//*/
    $("#input_method").val("POST"); //change hidden method type to POST default is PATCH
    
    $('#form_modal').modal('show');
  }


  //Insert/UPdate data by Ajax  	
 $(function(){
    //$('#form_modal form').validator().on('submit', function (e) {	    	
    $('#form_modal form').on('submit', function (e) {
    	e.preventDefault(); // this prevents the form from submitting
    	
    	/*
    	var id = $('#id').val(); 
     	if($('#form_action').val() == 'Add'){
       			url = "{{ route('all-contact.store') }}"; 
   		}
       if($('#form_action').val() == 'Update'){ var urlTo = "{{ route('all-contact.update', ':id') }}" ;
				url = urlTo.replace(':id', id ); 				
			}*/

		if($('#form_action').val() == 'Add'){
            $.ajax({	                
                type : "POST", //find store method if type=POST	              
                url : "{{ route('all-contact.store') }}",                         
            	data: new FormData($("#form_modal form")[0]),
                //data : $('#form_modal form').serialize(),
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
	                   
	                }
	                if(data.success){
	                	//$('#errors_output').html('<h1>'+data.message+'</h1>');           	
	                	//
	                	$('#contact_status').val(0);
	                	$('#contact_status').prop('checked', false);
	                	$('#fileInput').val(null);
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
	                }	                  
                }
            });
            //return false;
        }//end Insert check //*/
       
       if($('#form_action').val() == 'Update'){ 
        	//var csrf_token = $('input[name="_token"]').val();
        	var id = $('#id').val(); 
        	var urlTo = "{{ route('all-contact.update', ':id') }}" ;
			urlTo = urlTo.replace(':id', id ); //resource rout not work without this 
			
			$.ajax({	  
               // type: "PATCH",	
                type: 'POST',              
                url : urlTo,  
                data:  new FormData($("#form_modal form")[0]),           
                //data: { id:id, },
                //data : $("#form_modal form").serialize(),
                cache:false,
               	contentType: false,
               	processData: false,
               	headers: {
		            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'), '_method': 'PATCH'
		        },
               	dataType: 'json', //work without dataType
                success : function(data) {	
                	 if(data.errors)
	                {
	                    var error_html = '';
	                    for(var count = 0; count < data.errors.length; count++)
	                    {
	                        error_html += '<p class="alert alert-danger">'+data.errors[count]+'</p>';
	                    }
	                    $('#errors_output').html(error_html);	                   
	                }
	                if(data.success){
	                	//$('#errors_output').html('<h1>'+data.message+'</h1>');           	
	                	//
	                	$('#contact_status').val(0);
	                	$('#contact_status').prop('checked', false);
	                	$('#fileInput').val(null);
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
	                }                                     
                }//end success
            });

       }//end update check//*/


    });
});


//Call Edit Form with Data
function editForm(id){
	event.preventDefault();  //this is importent
	//var id = id; 	
	var urlTo = "{{ route('all-contact.edit', ':id') }}" 
	urlTo = urlTo.replace(':id', id ); //resource rout not work without this 
    
    //$('#form_modal form')[0].reset();
	$.ajax({
		type : "GET", //'_method': 'DELETE' not require in data section
		dataType:"JSON",
		url : urlTo,
		success : function(data) {	

			///$('input[name=_method]').val('PATCH');  		
			$('.modal-title').text('Edit Contact');
    		$('#insertbutton').text('Update Data');
    		$('#form_action').val('Update');
    		//$("#form_modal form").attr("method", "PATCH");
    		$("#input_method").val("PATCH");

    		$('#id').val(data.id);
            $('#contact_name').val(data.contact_name);
            $('#contact_phone').val(data.contact_phone);
            $('#contact_email').val(data.contact_email);
            //$('#contact_status').val(data.contact_status).prop('checked', true);
            if(data.contact_status == 1){
            	$('#contact_status').val(data.contact_status);
            	//$('#contact_status').attr("checked", "checked");
            	$('#contact_status').prop("checked", true);
            }else{
            	$('#contact_status').val(data.contact_status);
            	$('#contact_status').removeAttr("checked");
            }  
            $('#form_modal').modal('show'); //*/         
		}
	});
}


//Display Single Data
function showData(id) {
	event.preventDefault();  //this is importent
	//var csrf_token = $('meta[name="csrf-token"]').attr('content');
	//var id = id; 	
	var urlTo = "{{ route('all-contact.show', ':id') }}" 
	urlTo = urlTo.replace(':id', id ); //resource rout not work without this 

	$.ajax({
		type : "GET", //'_method': 'DELETE' not require in data section
		url : urlTo,
		//data : {"_token": csrf_token}, //csrf token is must be use
		success : function(data) {
			if(data.success){ //alert(data.success);				
			  	Swal.fire(
				  'success!',
				   data.success,
				  'success'
				)
		  	}
		}
	});

}


//delete ajax request are here
function deleteData(id){
	event.preventDefault();  //this is importent
	var csrf_token = $('meta[name="csrf-token"]').attr('content');
	var id = id; //alert('deleteData '+id);
	
	var urlTo = "{{ route('all-contact.destroy', ':id') }}" 
	urlTo = urlTo.replace(':id', id ); //resource rout not work without this 

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
				type : "DELETE", //'_method': 'DELETE' not require in data section
				//type : "POST", //'_method': 'DELETE', must be use in data section
				//url:"all-contact/destroy/"+id,
				url : urlTo,
				data : {"_token": csrf_token}, //csrf token is must be use
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


//Delete multiple Data
$(document).on('click','#bulk_delete', function(){
	event.preventDefault();
	var csrf_token = $('meta[name="csrf-token"]').attr('content');
	var id = []; 

	Swal.fire({
	  title: 'Are you sure to Delete Contact?',
	  text: "You won't be able to revert this!",
	  icon: 'warning',
	  showCancelButton: true,
	  confirmButtonColor: '#3085d6',
	  cancelButtonColor: '#d33',	
	  confirmButtonText: 'Yes, delete it!'
	}).then( (result) => {

		if ( result.value ) {
			//get all data and push into id array
			$('.contact_checkbox:checked').each(function(){
				id.push($(this).val());
			});

			if(id.length > 0){
				$.ajax({
					method:"get",
					url: "{{ route('all-contact.destroybulk') }}", 
					//url:"all-contact/destroybulk",
					data: {id:id, "_token": csrf_token},				
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
				//alert('Please select at last one Contact');
				Swal.fire(
				  'Opps!',
				   'Please select at last one Contact',
				  'error'
				)				
			}

		}/*else{
			Swal.fire({
				icon: 'info',
				text: 'Your data is safe!'
			})
		}//*/
	})



	/*
	//using Alert
	if(confirm("Are you sure you want to delete this Data?")){

		$('.contact_checkbox:checked').each(function(){
			id.push($(this).val());
		});

		if(id.length > 0){
			//alert (id);
			$.ajax({
				//type : "POST",
				method:"get",
				url: "{{ route('all-contact.destroybulk') }}", 
				//url:"all-contact/destroybulk",
				data: {id:id, "_token": csrf_token},
				success:function(data){
					alert(data.success);
					table1.ajax.reload();
				}

			})

		}else{
			alert('Please select at last one checkbox');
		}
	}//*/


});

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