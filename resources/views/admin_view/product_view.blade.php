@extends('admin_view.app-inc.templatebody')

@section('content')
    @php
        //dd($all_pro->toArray());
    @endphp

@if(!empty(Auth::user()))
        @php
            $permission = json_decode(Auth::user()->permission);
            //dd($permission);
            $give_permission_read = "no";
            $give_permission_add = "no";
            $give_permission_edit = "no";
            $give_permission_delete = "no";
        @endphp
        @if(!empty($permission))
            @foreach($permission as $pro_row)
                @if(!empty($pro_row->product))
                    @php
                        if($pro_row->product == "read"){
                            $give_permission_read = "yes";
                        }
                        if($pro_row->product == "add"){
                            $give_permission_add = "yes";
                        }
                        if($pro_row->product == "edit"){
                            $give_permission_edit = "yes";
                        }
                        if($pro_row->product == "delete"){
                            $give_permission_delete = "yes";
                        }
                    @endphp
                @endif
            @endforeach
        @endif
@endif


   <div class="row" id="table-striped">
        <div class="col-12">
            <div class="card">
                <div class="row">
                    <div class="col-7">
                        <div class="card-header">
                            <h4 class="card-title">Product List</h4>
                        </div>
                    </div>
                    @if($give_permission_add == "yes" || Auth::user()->choices == "0")
                    <div class="col-5">
                        <div class="submit-btn m-1">
                            <i class="fas fa-plus"></i>
                            <a href="{{route('shopApp.create')}}" class="btn btn-primary waves-effect waves-float waves-light">Add</a>
                            <a href="{{route('csv_view')}}" class="btn btn-primary waves-effect waves-float waves-light">Import CSV</a>
                            <a href="{{route('export')}}" class="btn btn-primary waves-effect waves-float waves-light">Export CSV</a>
                        </div>
                    </div>
                    @endif

                </div>
                <div class="table-responsive">
                @if($give_permission_read == "yes" || Auth::user()->choices == "0")
                    <table class="table table-striped">
                        <thead>
                            <tr>
                            <th>Image</th>
                            <th>Brand</th>
                            <th>Part#</th>
                            <th>Price</th>
                            <th>Availability</th>
                            <th>Description</th>
                            <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($all_pro->toArray() as $row )
                                <tr>
                                    <td>
                                        {{-- <img src="storage/product_images/{{$row['image']}}" class="mr-75" height="40" width="40" alt="{{$row['brand']}}"> --}}

                                        @if($row['image'] != "" && $row["image"] != "noimage.gif")
                                            <img src="{{asset('storage/product_images/'.$row['image'])}}" class="mr-75" alt="{{$row['brand']}}" height="40" width="40">
                                        @else
                                            <img  src="{{asset('admin/dummy/noimage.gif')}}" alt="no image" class="mr-75" height="40" width="40">
                                        @endif

                                    </td>
                                    <td>{{$row['brand']}}</td>
                                    <td>{{$row['partno']}}</td>
                                    <td>{{$row['price']}}</td>
                                    <td>{{$row['quantity']}}</td>
                                    <td>{{$row['description']}}</td>
                                    <td>
                                        <div class="dropdown">
                                            @if($give_permission_edit == "yes" || $give_permission_delete == "yes" || Auth::user()->choices == "0")
                                                <button type="button" class="btn btn-sm dropdown-toggle hide-arrow waves-effect waves-float waves-light" data-toggle="dropdown" aria-expanded="false">
                                                    <svg xmlns="" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg>
                                                </button>
                                                <div class="dropdown-menu" style="">

                                                    @if($give_permission_edit == "yes" || Auth::user()->choices == "0")
                                                        <a class="dropdown-item" href="{{route('shopApp.edit',$row['id'])}}">
                                                        <svg xmlns="" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 mr-50"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                                                        <span>Edit</span>
                                                        </a>
                                                    @endif

                                                    {{-- <form action="{{route('shopApp.destroy',$row['id'])}}" method="post" > --}}
                                                        {{-- @csrf --}}

                                                    @if($give_permission_delete == "yes" || Auth::user()->choices == "0")
                                                        <a class="dropdown-item" href="/delete_product/{{$row['id']}}">
                                                            <svg xmlns="" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash mr-50"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                                                            <span>Delete</span>
                                                        </a>
                                                    @endif
                                                        {{-- <input type="hidden" name="_method" value="delete"> --}}
                                                    {{-- </form> --}}
                                                </div>
                                            @endif

                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif

                </div>
            </div>
        </div>
    </div>

@endsection

