@extends('frontend_view.common.layout')

@section('content')

    <!-- Section filter start -->
    <div class="product_d_info">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="product_d_inner">
                        <div class="product_info_button tabs-main-body-cus-style">
                            <ul class="nav" role="tablist" id="nav-tab">
                                <li>
                                    <a class="active" data-toggle="tab" href="#bypart" role="tab" aria-controls="info" aria-selected="true">By Part</a>
                                </li>

                                @php
                                    /*
                                <li>
                                    <a data-toggle="tab" href="#bycarmodel" role="tab" aria-controls="sheet" aria-selected="false" class="">By Car Model</a>
                                </li>
                                    */
                                @endphp

                            </ul>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane fade active show tab-content-body-cus-style" id="bypart" role="tabpanel">
                                <div class="product_info_content mb-50">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12">
                                            <div class="search-container">
                                                <form method="post" action="{{route('partno')}}">
                                                    @csrf
                                                    <div class="search_box search-by-part-number-cus-style">
                                                    <input placeholder="Search by part number ..." type="text" name="search_part_no" id="search_part_no" value="{{old('search_part_no')}}"  autocomplete="search_part_no" autofocus="" >
                                                    @error('search_part_no')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                    <button type="submit" class="search_part_no_event"><i class="ion-ios-search-strong"></i></button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- title of the part start -->
                                @if(Session::has('message'))
                                {{-- <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p> --}}
                                    <div class="search-title-holder toggle_event" >
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="section_title  justify-content-center">
                                                <h2> <span> <strong class="partno_title"> Search </strong class="partno_description"> {{$search_val}} </span></h2>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <!-- title of the part end -->

                                <!-- part list start -->
                                    <div class="wishlist_area mt-30">
                                        <div class="container">
                                            @yield('content')


                            <div class="row">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="scroll-note mt-10">
                                                <p class="note-text">
                                                    &nbsp; <i class="fa fa-arrow-circle-left cus-color-icon" aria-hidden="true"></i> &nbsp;
                                                    <span class="small-text"> Please scroll left side for more info ... </span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="table_desc wishlist mb-0">
                                        <div class="cart_page table-responsive">
                                        <input type="hidden" id="runtimeqnt" name="runtimeqnt" value="" />
                                        <input type="hidden" id="totalHide" name="totalHide" value="" />
                                        @php
                                            //dd($all_pro->toArray())
                                        @endphp

                                        @php
                                            // $value = session('cartArr');
                                            // dd($value);
                                            // $key = array_search(6, array_column($value, 'productOrgID'), true);
                                            // dd($key);
                                        @endphp

                                            <table>
                                                <thead>
                                                    <tr>
                                                        <th class="product_thumb">Image</th>
                                                        <th class="product_name">Brand</th>
                                                        <th class="product-price">Part number</th>
                                                        <th class="product_quantity">Description</th>
                                                        <th class="product_quantity">Price</th>
                                                        <th class="product_quantity">Availability</th>
                                                        <th class="product_quantity">Quantity</th>
                                                        <th class="product_total">Add To Cart</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="search_result_html">

                                                {{-- @php
                                                    dd($all_pro);
                                                @endphp --}}

                                                @if(!empty($all_pro->toArray() && is_array($all_pro->toArray()) ))
                                                    @foreach ( $all_pro as $row )
                                                    {{-- {{$row->brand}} --}}
                                                        <tr>
                                                            <td class="product_thumb"><a href="#">
                                                                @php
                                                                    if($row->image != ""){
                                                                        echo '<img src="'.asset('storage/product_images/'.$row->image).'" alt="users avatar" class="user-avatar users-avatar-shadow rounded mr-2 my-25 cursor-pointer" height="90" width="90">';
                                                                    }else{
                                                                        echo '<img  src="'.asset('admin/dummy/noimage.gif').'" alt="users avatar" class="user-avatar users-avatar-shadow rounded mr-2 my-25 cursor-pointer" height="90" width="90">';
                                                                    }
                                                                @endphp
                                                                {{-- <img src=" {{ asset('frontend/img/product/product1.jpg') }}" alt=""> --}}
                                                            </a></td>
                                                            <td class="product_name"><a href="#">{{$row->brand}}</a></td>
                                                            <td class="product-price">{{$row->partno}}</td>
                                                            <td><span class="small-text">{{$row->description}}</span></td>
                                                            <td class="product-price">{{$row->price}} <label class="small-text">AED</label></td>
                                                            <td class="product-price"> {{$row->quantity}} <label class="small-text">In Stock</label></td>
                                                            <td class="product_quantity"><label class="small-text" >Quantity</label> <input class="chkevent" data_val="{{$row->quantity}}"  min="1" max="100" id="pro_qnt" name="pro_qnt" value="" placeholder="0" type="number" /></td>
                                                            <td data-url= "{{route('edit',$row->id)}}"  data_org_qnt="{{$row->quantity}}"  class="product_total get_array_of_index test afteraddDone_{{$row->id}}"><a href="javascript:;">Add To Cart</a></td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                        <tr>
                                                            <td colspan="8"><h3 style="padding: 30px;color: #ccc;">Sorry! No Search Result Found.</h3></td>
                                                        </tr>
                                                @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
<!-- part list end -->
                </div>

@php
/*

<div class="tab-pane fade" id="bycarmodel" role="tabpanel">
<div class="product_info_content">
<label>by car model</label>
</div>
</div>

*/
@endphp


                </div>
                </div>
                </div>
                </div>
                </div>
                </div>
<!-- Section filter end -->
@endsection
