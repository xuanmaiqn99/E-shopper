@extends('admin_layout')
@section('admin_content')

<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Add brand product
            </header>
            <div class="panel-body">
            <?php
            $message = Session::get('message');
                if($message){
                    echo '<span class="text-alert">',$message,'</span>';
                    Session::put('message',null);
                };
            ?>
                <div class="position-center">
                    <form role="form" action="{{URL::to('/save-brand-product')}}" method="post">
                    {{csrf_field()}}    
                        <div class="form-group">
                            <label for="">Ten thuong hieu</label>
                            <input type="text" name="brand_product_name" class="form-control" id="exampleInputEmail1" placeholder="Ten danh muc">
                        </div>
                        <div class="form-group">
                            <label for="">Mo ta thuong hieu</label>
                            <textarea style="resize:none" rows="5" class="form-control" name="brand_product_desc" id="exampleInputPassword1" placeholder="Mo ta danh muc"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Hien thi</label>
                            <select name="brand_product_status" class="form-control input-sm m-bot15">
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
                        <button type="submit" name="add_brand_product" class="btn btn-info">Submit</button>
                    </form>
                </div>

            </div>
        </section>

    </div>

    @endsection