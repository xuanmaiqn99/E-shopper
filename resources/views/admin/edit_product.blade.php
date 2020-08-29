@extends('admin_layout')
@section('admin_content')

<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Update products
            </header>
            <?php
            $message = Session::get('message');
            if ($message) {
                echo '<span class="text-alert">', $message, '</span>';
                Session::put('message', null);
            };
            ?>
            <div class="panel-body">
                <div class="position-center">
                    @foreach($edit_product as $key=>$pro)
                    <form role="form" action="{{URL::to('/update-product/'.$pro->product_id)}}" method="post" enctype="multipart/form-data">
                                                                                                                 <!-- dung them anh -->
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="">Ten san pham</label>
                            <input type="text" name="product_name" class="form-control" value="{{$pro->product_name}}" id="exampleInputEmail1">
                        </div>
                        <div class="form-group">
                            <label for="">Gia san pham</label>
                            <input type="text" name="product_price" class="form-control" value="{{$pro->product_price}}" id="exampleInputEmail1">
                        </div>
                        <div class="form-group">
                            <label for="">Hinh anh san pham</label>
                            <input type="file" name="product_image" class="form-control" id="exampleInputEmail1">
                            <img src="{{URl::to('uploads/product/'.$pro->product_image)}}" height="100" width="100" alt="">
                        </div>
                        <div class="form-group">
                            <label for="">Mo ta san pham</label>
                            <textarea style="resize:none" rows="5" class="form-control" name="product_desc" id="exampleInputPassword1">{{$pro->product_desc}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Noi dung san pham</label>
                            <textarea style="resize:none" rows="5" class="form-control" name="product_content" id="exampleInputPassword1">{{$pro->product_content}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Danh muc san pham</label>
                            <select name="product_cate" class="form-control input-sm m-bot15">
                                @foreach($cate_product as $key =>$cate)
                                @if($cate->category_id==$pro->category_id)
                                <option selected value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                @else
                                <option value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Thuong hieu</label>
                            <select name="product_brand" class="form-control input-sm m-bot15">
                                @foreach($brand_product as $key =>$brand)
                                @if($brand->brand_id==$pro->brand_id)
                                <option selected value="{{$brand->brand_id }}">{{$brand->brand_name}}</option>
                                @else
                                <option value="{{$brand->brand_id }}">{{$brand->brand_name}}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Hien thi</label>
                            <select name="product_status" class="form-control input-sm m-bot15">
                                <option value="0">An</option>
                                <option value="1">Hien Thi</option>
                            </select>
                        </div>
                        <!-- <div class="form-group">
                            <label for="exampleInputFile">File input</label>
                            <input type="file" id="exampleInputFile">
                            <p class="help-block">Example block-level help text here.</p>
                        </div> -->
                        <!-- <div class="checkbox">
                            <label>
                                <input type="checkbox"> Check me out
                            </label>
                        </div> -->
                        <button type="submit" name="add_product" class="btn btn-info">Submit</button>
                    </form>
                    @endforeach
                </div>

            </div>
        </section>

    </div>

    @endsection