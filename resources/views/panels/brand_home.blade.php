<div class="brands_products"><!--brands_products-->
    <h2>Brands</h2>
    <div class="brands-name">
        <ul class="nav nav-pills nav-stacked">
            <?php 
                //show all Brand
                $all_brand_info = DB::table('tbl_brand')->where('pub_status', 1)->get();

                foreach($all_brand_info as $v_brand){                                
            ?>
                <li><a href="{{'/product-by-brand/'.$v_brand->brand_id}}"> 

                    <span class="pull-right">
                        <!--Count product by brand-->
                       <?php $count_product_by_brand = DB::table('tbl_products')->where('brand_id', $v_brand->brand_id)->where('pub_status',1)->count(); 
                        ?>
                        ({{ $count_product_by_brand }})
                    
                    </span>


                {{$v_brand->brand_name}}</a></li>

            <?php } ?>

            <!--
            <li><a href="#"> <span class="pull-right">(56)</span>Grüne Erde</a></li>
            <li><a href="#"> <span class="pull-right">(27)</span>Albiro</a></li>
            <li><a href="#"> <span class="pull-right">(32)</span>Ronhill</a></li>
            <li><a href="#"> <span class="pull-right">(5)</span>Oddmolly</a></li>
            <li><a href="#"> <span class="pull-right">(9)</span>Boudestijn</a></li>
            <li><a href="#"> <span class="pull-right">(4)</span>Rösch creative culture</a></li>-->
        </ul>
    </div>
</div><!--/brands_products-->