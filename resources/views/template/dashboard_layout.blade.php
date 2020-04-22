@include('panels.head_dashboard') <!--Include Dashboard head-->

<body>
	<!-- start: Header -->
	@include('panels.header_dashboard') <!--Include header here-->
	<!-- start: Header -->
	
		<div class="container-fluid-full">
		<div class="row-fluid">
				
			<!-- start: Main Menu -->
			@include('panels.side_menu_dashboard') <!--Include Side menu here-->
			<!-- end: Main Menu -->
			
			<noscript>
				<div class="alert alert-block span10">
					<h4 class="alert-heading">Warning!</h4>
					<p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
				</div>
			</noscript>
			
			<!-- start: Content -->
			<div id="content" class="span10">
			
			<!--@include('panels.breadcrumb_dashboard') Include breadcrumb here-->
			
			@yield('content')	
			
			
			
       

	</div><!--/.fluid-container-->
	
			<!-- end: Content -->

		</div><!--/#content.span10-->
		</div><!--/fluid-row-->
		
	<div class="modal hide fade" id="myModal">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">×</button>
			<h3>Settings</h3>
		</div>
		<div class="modal-body">
			<p>Here settings can be configured...</p>
		</div>
		<div class="modal-footer">
			<a href="#" class="btn" data-dismiss="modal">Close</a>
			<a href="#" class="btn btn-primary">Save changes</a>
		</div>
	</div>
	
	<div class="clearfix"></div>
	

	@include('panels.footer_dashboard') <!--Include footer here-->
