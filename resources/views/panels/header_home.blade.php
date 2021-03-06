<header id="header"><!--header-->
    <div class="header_top"><!--header_top-->
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="contactinfo">
                        <ul class="nav nav-pills">
                            <li><a href="#"><i class="fa fa-phone"></i> +2 95 01 88 821</a></li>
                            <li><a href="#"><i class="fa fa-envelope"></i> info@domain.com</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="social-icons pull-right">
                        <ul class="nav navbar-nav">
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header_top-->
    
    <div class="header-middle"><!--header-middle-->
        <div class="container">
            <div class="row">
                <div class="col-md-4 clearfix">
                    <div class="logo pull-left">
                        <a href="index.html"><img src="{{URL::to('frontend/images/home/logo.png')}}" alt="" /></a>
                    </div>
                    <div class="btn-group pull-right clearfix">
                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
                                USA
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="">Canada</a></li>
                                <li><a href="">UK</a></li>
                            </ul>
                        </div>
                        
                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
                                DOLLAR
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="">Canadian Dollar</a></li>
                                <li><a href="">Bangladeshi TK</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 clearfix">
                    <div class="shop-menu clearfix pull-right">
                        <ul class="nav navbar-nav">
                            <li><a href="{{URL::to('/account')}}"><i class="fa fa-user"></i> Account</a></li>
                            <li><a href=""><i class="fa fa-star"></i> Wishlist</a></li>



                            <li><a href="{{URL::to('/cart')}}"><i class="fa fa-shopping-cart"></i> Cart</a></li>

                            <!--If a customer shipping address exist then route to payment section -->
                            <?php 
                               
                                

                                
                                if( Session::get('ship_id') != NULL ){
                                   $ship_id =Session::get('ship_id'); 
                               }else{
                                    $customer_id =Session::get('customer_id');
                                    $shipping_id_exist = DB::table('tbl_shipping')->where('customer_id', $customer_id)->first();
                                    @$ship_id = $shipping_id_exist->ship_id;
                                }

                            ?>
                                

                            <?php if( Session::get('customer_id') != NULL && $ship_id  == NULL ){ ?> 

                                <li><a href="{{url('/checkout')}}"><i class="fa fa-crosshairs"></i> Checkout</a></li>

                                <li><a href="{{url('/customer-logout')}}"><i class="fa fa-lock"></i>Logout</a></li> 
                            
                            <?php }elseif( Session::get('customer_id') != NULL && $ship_id  != NULL ){ ?>  

                                <li><a href="{{url('/go-to-payment')}} "><i class="fa fa-crosshairs"></i> Checkout</a></li>

                                <li><a href="{{url('/customer-logout')}}"><i class="fa fa-lock"></i>Logout</a></li> 
                            
                            <?php }else{ ?>

                                <li><a href="{{url('/go-to-login')}} "><i class="fa fa-crosshairs"></i> Checkout</a></li>
                                <li><a href="{{url('/go-to-login')}}"><i class="fa fa-lock"></i>Login</a></li>
                            
                            <?php } ?>

                            
                            

                            

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header-middle-->

    <div class="header-bottom"><!--header-bottom-->
        <div class="container">
            <div class="row">
                <div class="col-sm-9">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="mainmenu pull-left">
                        <ul class="nav navbar-nav collapse navbar-collapse">
                            <li><a href="/" class="active">Home</a></li>
                            <li class="dropdown"><a href="{{URL::to('/shop')}}">Shop<i class="fa fa-angle-down"></i></a>
                                <ul role="menu" class="sub-menu">
                                    <li><a href="{{URL::to('/shop')}}">Products</a></li>
                                    <li><a href="{{URL::to('/checkout')}}">Checkout</a></li> 
                                    <li><a href="{{URL::to('/Cart')}}">Cart</a></li> 
                                    <li><a href="{{URL::to('/customer-login')}}">Login</a></li> 
                                </ul>
                            </li> 
                            <li class="dropdown"><a href="#">Blog<i class="fa fa-angle-down"></i></a>
                                <ul role="menu" class="sub-menu">
                                    <li><a href="blog.html">Blog List</a></li>
                                    <li><a href="blog-single.html">Blog Single</a></li>
                                </ul>
                            </li> 
                            <li><a href="404.html">404</a></li>
                            <li><a href="contact-us.html">Contact</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="search_box pull-right">
                        <input type="text" placeholder="Search"/>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header-bottom-->
</header><!--/header-->