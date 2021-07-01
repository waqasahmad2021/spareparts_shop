@extends('frontend_view.common.layout')

@section('content')

<div class="shopping_cart_area product_d_info">
    <div class="container">
    <form method="post" action="{{route('update_cart')}}">
        @csrf
            <div class="row">
                <div class="col-12">
                    <div class="table_desc product_d_inner">
                        <div class="cart_page table-responsive">
                            <table>
                                <thead>
                                    <tr>
                                        <th class="product_remove">Delete</th>
                                        <th class="product_thumb">Image</th>
                                        <th class="product_name">Product</th>
                                        <th class="product_name">Description</th>
                                        <th class="product-price">Price</th>
                                        <th class="product_quantity">Quantity</th>
                                        <th class="product_total">Total</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @php
                                        $vatPrice = 0;
                                        $vat_with_price= 0;
                                        $subtotal = 0;
                                        $value = session('cartArr');
                                        // dd($value);
                                    @endphp
                                    @if(!empty($value))
                                        @foreach ($value as $key => $item)
                                        {{-- {{$item['price']}} --}}
                                        @php
                                            $vatPrice += $item['justVat'];
                                            $vat_with_price += $item['vat_with_price'];
                                            $subtotal += $item['price'];
                                        @endphp

                                    <tr>
                                        <td class="product_remove"><a href="/removeItem/{{$key}}"><i class="fa fa-trash-o"></i></a></td>
                                        <td class="product_thumb"><a href="#"><img src="{{asset('storage/product_images/'.$item['img'])}}" alt=""></a></td>
                                        <td class="product_name"><a href="#">{{$item['product_name']}}</a></td>
                                        <td class="product_name"><a href="#">{{$item['description']}}</a></td>
                                        <td class="product-price">{{$item['org_price']}} AED</td>
                                        <td class="product_quantity"><label>Quantity</label> <input min="1" max="100" id="updateqnt" name="updateqnt[]" value="{{$item['runtimeQnt']}}" type="number"></td>
                                        <td class="product_total">{{$item['price']}} AED
                                            <input type="hidden" id="proid" name="proid[]" value="{{$item['productOrgID']}}" />
                                        </td>
                                    </tr>

                                    @endforeach
                                    @endif

                                </tbody>
                            </table>
                        </div>
                        <div class="cart_submit">
                            <button type="submit">update cart</button>
                        </div>
                    </div>
                </div>
            </div>
            <!--coupon code area start-->
            <div class="coupon_area product_d_inner">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="coupon_code right">
                            <h3>Cart Totals</h3>
                            <div class="coupon_inner">
                                <div class="cart_subtotal">
                                    <p>Subtotal</p>
                                    <p class="cart_amount"> {{$subtotal}} AED </p>
                                </div>
                                <div class="cart_subtotal ">
                                    <p>&nbsp;</p>
                                    <p class="cart_amount"><span>VAT:</span> {{$vatPrice}} AED </p>
                                </div>
                                <a href="#">&nbsp;</a>

                                <div class="cart_subtotal">
                                    <p>Total</p>
                                    <p class="cart_amount">{{$vatPrice+$subtotal}} AED</p>
                                </div>
                                <div class="checkout_btn">
                                    <a href="#">Proceed to Checkout</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--coupon code area end-->
        </form>
    </div>
</div>


@endsection
