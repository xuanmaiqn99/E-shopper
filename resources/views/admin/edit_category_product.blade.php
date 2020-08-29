@extends('admin_layout')
@section('admin_content')

<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Update product list
            </header>
            <?php
            $message = Session::get('message');
            if ($message) {
                echo '<span class="text-alert">', $message, '</span>';
                Session::put('message', null);
            };
            ?>
            <div class="panel-body">
                @foreach($edit_category_product as $key => $edit_value)
                <div class="position-center">
                    <form role="form" action="{{URL::to('/update-category-product/'.$edit_value->category_id)}}" method="post">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="">Ten danh muc</label>
                            <input type="text" value="{{$edit_value->category_name}}" name="category_product_name" class="form-control" id="exampleInputEmail1" placeholder="Ten danh muc">
                        </div>
                        <div class="form-group">
                            <label for="">Mo ta danh muc</label>
                            <textarea style="resize:none" rows="5" class="form-control" name="category_product_desc" id="exampleInputPassword1" placeholder="Mo ta danh muc">
                            {{$edit_value->category_desc}}
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
                        <button type="submit" name="update_category_product" class="btn btn-info">Update</button>
                    </form>
                </div>
                @endforeach
            </div>
        </section>

    </div>

    @endsection