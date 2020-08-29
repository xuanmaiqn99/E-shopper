@extends('admin_layout')
@section('admin_content')

<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Add products
            </header>
            <?php
            $message = Session::get('message');
                if($message){
                    echo '<span class="text-alert">',$message,'</span>';
                    Session::put('message',null);
                };
            ?>
            <div class="panel-body">
                <div class="position-center">
                    <form role="form" action="{{URL::to('/save-product')}}" method="post" enctype="multipart/form-data"> 
                                                                                            <!-- dung them anh -->
                    {{csrf_field()}}    
                        <div class="form-group">
                            <label for="">Ten san pham</label>
                            <input type="text" name="product_name" class="form-control" id="exampleInputEmail1" placeholder="Ten san pham">
                        </div>
                        <div class="form-group">
                            <label for="">Gia san pham</label>
                            <input type="text" name="product_price" class="form-control" id="exampleInputEmail1" placeholder="Gia san pham">
                        </div>
                        <div class="form-group">
                            <label for="">Hinh anh san pham</label>
                            <input type="file" name="product_image" class="form-control" id="exampleInputEmail1">
                        </div>
                        <div class="form-group">
                            <label for="">Mo ta san pham</label>
                            <textarea style="resize:none" rows="5" class="form-control" name="product_desc" id="exampleInputPassword1" placeholder="Mo ta san pham"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Noi dung san pham</label>
                            <textarea style="resize:none" rows="5" class="form-control" name="product_content" id="exampleInputPassword1" placeholder="Noi dung san pham"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Danh muc san pham</label>
                            <select name="product_cate" class="form-control input-sm m-bot15">
                                @foreach($cate_product as $key =>$cate)
                                    <option value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Thuong hieu</label>
                            <select name="product_brand" class="form-control input-sm m-bot15">
                                @foreach($brand_product as $key =>$brand)
                                    <option value="{{$brand->brand_id }}">{{$brand->brand_name}}</option>
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
                </div>

            </div>
        </section>

    </div>

    @endsection