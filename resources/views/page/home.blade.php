@extends('layout')
@section('content')
<div class="features_items">    <!--features_items-->
    <h2 class="title text-center">New Product</h2>
    @foreach($all_product as $key=>$product)
    <div class="col-sm-4">
        <div class="product-image-wrapper">
            <div class="single-products">
                <div class="productinfo text-center">
                    <img src="{{URL::to('uploads/product/'.$product->product_image)}}" alt="" />      
                    <h2>{{$product->product_name}}</h2>
                    <h4>{{number_format($product->product_price).' đ'}}</h4>
                    <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                </div>
                <!-- <div class="product-overlay">
                    <div class="overlay-content">
                        <h2>{{number_format($product->product_price).' đ'}}</h2>
                        <p>{{$product->product_name}}</p>
                        <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                    </div>
                </div> -->
            </div>
            <div class="choose">
                <ul class="nav nav-pills nav-justified">
                    <li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li> 
                    <!-- them yeu thich -->
                    <li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
                    <!-- so sanh -->
                </ul>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection