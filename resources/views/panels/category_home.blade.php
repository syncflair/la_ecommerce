
<h2>Category</h2>
<div class="panel-group category-products" id="accordian"><!--category-productsr-->
    <?php 
        //show all category
        $all_category_info = DB::table('tbl_category')->where('pub_status', 1)->get();

        foreach($all_category_info as $v_category){                                
    ?>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title"><a href="{{URL::to('/product-by-category/'.$v_category->category_id)}}">{{ $v_category->category_name }} 

	            <span><!--Product count by category-->
		           <?php $count_product = DB::table('tbl_products')->where('category_id', $v_category->category_id)->where('pub_status',1)->count(); 
		            ?>
		            ({{ $count_product }})
	        	</span>
	        </a></h4>
        </div>
    </div>
    <?php } ?>


    <!--<div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordian" href="#sportswear">
                    <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                    Sportswear
                </a>
            </h4>
        </div>
        <div id="sportswear" class="panel-collapse collapse">
            <div class="panel-body">
                <ul>
                    <li><a href="#">Nike </a></li>
                    <li><a href="#">Under Armour </a></li>
                    <li><a href="#">Adidas </a></li>
                    <li><a href="#">Puma</a></li>
                    <li><a href="#">ASICS </a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordian" href="#mens">
                    <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                    Mens
                </a>
            </h4>
        </div>
        <div id="mens" class="panel-collapse collapse">
            <div class="panel-body">
                <ul>
                    <li><a href="#">Fendi</a></li>
                    <li><a href="#">Guess</a></li>
                    <li><a href="#">Valentino</a></li>
                    <li><a href="#">Dior</a></li>
                    <li><a href="#">Versace</a></li>
                    <li><a href="#">Armani</a></li>
                    <li><a href="#">Prada</a></li>
                    <li><a href="#">Dolce and Gabbana</a></li>
                    <li><a href="#">Chanel</a></li>
                    <li><a href="#">Gucci</a></li>
                </ul>
            </div>
        </div>
    </div>
    
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordian" href="#womens">
                    <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                    Womens
                </a>
            </h4>
        </div>
        <div id="womens" class="panel-collapse collapse">
            <div class="panel-body">
                <ul>
                    <li><a href="#">Fendi</a></li>
                    <li><a href="#">Guess</a></li>
                    <li><a href="#">Valentino</a></li>
                    <li><a href="#">Dior</a></li>
                    <li><a href="#">Versace</a></li>
                </ul>
            </div>
        </div>
    </div>-->
    
   
    <!--<div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title"><a href="#">Clothing</a></h4>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title"><a href="#">Bags</a></h4>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title"><a href="#">Shoes</a></h4>
        </div>
    </div>-->
</div><!--/category-products-->