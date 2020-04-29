<!-- Button trigger modal -->
<!--<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
  Launch demo modal
</button>-->

<!-- Modal -->
<div class="modal fade" id="form_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close close-form" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Title</h4>
      </div>
      <div class="modal-body">
        
        <!--<form class="form-horizontal" method="post" data-toogle="validator">-->
        <form class="form-horizontal" method="post" enctype="multipart/form-data">
        	{{ csrf_field() }}  <!--@method('PATCH') {{ method_field('POST') }}-->
        	<input type="hidden" id="input_method" name="_method" value="PATCH">

        	<span id="errors_output"></span>

        	<input type="hidden" name="form_action" id="form_action" value="" />
        	<input type="hidden" name="id" id="id" value="" />

		  <div class="form-group">
		    <label  class="col-sm-2 control-label">Name</label>
		    <div class="col-sm-10">
		      <input type="text" class="form-control" id="contact_name" name="contact_name"  placeholder="Contact name" value="" />
		    </div>
		  </div>

		  <div class="form-group">
		    <label  class="col-sm-2 control-label">Email</label>
		    <div class="col-sm-10">
		      <input type="email" class="form-control" id="contact_email" name="contact_email"  placeholder="Contact email" value="">
		    </div>
		  </div>

		  <div class="form-group">
		    <label  class="col-sm-2 control-label">Phone</label>
		    <div class="col-sm-10">
		      <input type="text" class="form-control" id="contact_phone" name="contact_phone"  placeholder="Contact name" value="">
		    </div>
		  </div>

		  <div class="form-group">
		    <label  class="col-sm-2 control-label">Image</label>
		    <div class="col-sm-10">
		      <!--<input type="text" class="form-control" name="contact_image">-->
		      <input class="input-file uniform_on form-control" id="fileInput" type="file" name="contact_image">
		    </div>
		  </div>

		  <div class="form-group">
		    <label  class="col-sm-2 control-label">Status</label>
		    <div class="col-sm-10">
		      <input type="checkbox" id="contact_status" class="form-control" name="contact_status" value="0" />
		    </div>
		  </div>

		  

      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default close-form" data-dismiss="modal">Close</button>
        <button type="submit" id="insertbutton" class="btn btn-primary">Save changes</button>
       
      </div>

      </form>

    </div>
  </div>
</div>