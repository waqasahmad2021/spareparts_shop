@extends('admin_view.app-inc.templatebody')

@section('content')
    <section id="multiple-column-form">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Add Product</h4>
                    </div>
                    <div class="card-body">
                        <form class="form" action="{{route('shopApp.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="pro_img">Product image</label>
                                        <input type="file" id="pro_img" class="form-control" placeholder="Product image" name="pro_img">
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="brand">Brand</label>
                                        <select class="form-control" id="brand" name="brand">
                                            <option value="0">--Select Any--</option>
                                            <option value="toyota">Toyota</option>
                                            <option value="nisan">Nisan</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="model">Model</label>
                                        <input type="text" id="model" class="form-control" placeholder="Model" name="model">
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="year">Year</label>
                                        <input type="text" id="year" class="form-control" placeholder="Year" name="year">
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="vin_vds">VIN / VDS</label>
                                        <input type="text" id="vin_vds" class="form-control" placeholder="VIN / VDS" name="vin_vds">
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="catalog_code">Catalog Code</label>
                                        <input type="text" id="catalog_code" class="form-control" placeholder="Catalog Code" name="catalog_code">
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="frame_no">Frame No</label>
                                        <input type="text" id="frame_no" class="form-control" placeholder="Frame No" name="frame_no">
                                    </div>
                                </div>
                                
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="partno">Part No</label>
                                        <input type="text" id="partno" class="form-control" placeholder="Part Number" name="partno">
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="price">Price</label>
                                        <input type="number" id="price" class="form-control" placeholder="Price" name="price">
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="quantity">Quantity</label>
                                        <input type="number" id="quantity" class="form-control" placeholder="Quantity" name="quantity">
                                    </div>
                                </div>
                                <div class="col-md-12 col-12">
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea id="description" class="form-control" name="description" ></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary mr-1 waves-effect waves-float waves-light">Submit</button>
                                    <button type="reset" class="btn btn-outline-secondary waves-effect">Reset</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection