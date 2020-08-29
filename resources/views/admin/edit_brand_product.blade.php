@extends('admin_layout')
@section('admin_content')

<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Update brand list
            </header>
            <?php
            $message = Session::get('message');
            if ($message) {
                echo '<span class="text-alert">', $message, '</span>';
                Session::put('message', null);
            };
            ?>
            <div class="panel-body">
                @foreach($edit_brand_product as $key => $edit_value)
                <div class="position-center">
                    <form role="form" action="{{URL::to('/update-brand-product/'.$edit_value->brand_id)}}" method="post">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="">Ten thuong hieu</label>
                            <input type="text" value="{{$edit_value->brand_name}}" name="brand_product_name" class="form-control" id="exampleInputEmail1" placeholder="Ten thuong hieu">
                        </div>
                        <div class="form-group">
                            <label for="">Mo ta thuong hieu</label>
                            <textarea style="resize:none" rows="5" class="form-control" name="brand_product_desc" id="exampleInputPassword1" placeholder="Mo ta thuong hieu">
                            {{$edit_value->brand_desc}}
                            </textarea>

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
                        <button type="submit" name="update_brand_product" class="btn btn-info">Update</button>
                    </form>
                </div>
                @endforeach
            </div>
        </section>
    </div>
    @endsection