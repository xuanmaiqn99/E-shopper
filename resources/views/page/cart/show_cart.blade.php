@extends('layout')
@section('content')
<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="{{URL::to('/')}}">Home</a></li>
				  <li class="active">Shopping Cart</li>
				</ol>
			</div>
			<div class="table-responsive cart_info">
                <?php
                $content = Cart::content();
                // echo '<pre>';
                // print_r($content);
                // echo '</pre>';
                ?>
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Image</td>
							<td class="description">Description</td>
							<td class="price">Price</td>
							<td class="quantity">Quantity</td>
							<td class="total">Total</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
                        @foreach($content as $key=>$value_content)
						<tr>
							<td class="cart_product">
								<a href="">
                                    <img src="{{URL::to('uploads/product/'.$value_content->options->image)}}" width="50" alt="" />
                                </a>
							</td>
							<td class="cart_description">
								<h4><a href="">{{$value_content->name}}</a></h4>
								<p></p>
							</td>
							<td class="cart_price">
								<p>{{number_format($value_content->price).'đ'}}</p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
								<form action="{{URL::to('update-cart-quantity')}}" method="POST">
								{{csrf_field()}}
									<input class="cart_quantity_input" type="number" min="1" name="cart_quantity" value="{{$value_content->qty}}" size="2">
									<input type="hidden" value="{{$value_content->rowId}}" name="rowId_cart" class="form-control">
									<input type="submit" value="Update" name="update_qty" class="btn btn-default btn-sm">
								</form>
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">
                                    <?php
                                    $subtotal = $value_content->price * $value_content->qty;
                                    echo number_format($subtotal).'đ';
                                    ?>
                                </p>
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" href="{{URL::to('delete-cart/'.$value_content->rowId)}}"><i class="fa fa-times"></i></a>
							</td>
                        </tr>
                        @endforeach
					</tbody>
				</table>
			</div>
		</div>
    </section> <!--/#cart_items-->
    
    
	<section id="do_action">
		<div class="container">
			<div class="heading">
				<!-- <h3>What would you like to do next?</h3>
				<p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p> -->
				<h2>CHECK OUT</h2>
			</div>
			<div class="row">
				<div class="col-sm-6">
					<div class="total_area">
						<ul>
							<li>Cart Sub Total <span>{{Cart::subtotal().'đ'}}</span></li>
							<li>Tax <span>{{Cart::tax().'đ'}}</span></li>
							<li>Shipping Cost <span>Free</span></li>
							<li>Total <span>{{Cart::total().'đ'}}</span></li>
						</ul>
							<!-- <a class="btn btn-default update" href="">Update</a> -->
							<a class="btn btn-default check_out" href="{{URL::to('/login-checkout')}}">Check Out</a>
					</div>
				</div>
			</div>
		</div>
	</section><!--/#do_action-->
@endsection