@extends('admin_view.app-inc.templatebody')

@section('content')
    @php
        //dd($all_pro->toArray());
    @endphp

    <div class="row">
        <div class="col-md-12 col-12">
            @if ($message = Session::get('success'))

                <div class="alert alert-success alert-block">

                    <button type="button" class="close" data-dismiss="alert">×</button>

                    <strong>{{ $message }}</strong>

                </div>
            @endif
        </div>
    </div>

   <div class="row" id="table-striped">
        <div class="col-12">
            <div class="card">
                <div class="row">
                    <div class="col-10">
                        <div class="card-header">
                            <h4 class="card-title">Users List</h4>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="submit-btn m-1">
                            <i class="fas fa-plus"></i>
                            <a href="{{route('common_users.create')}}" class="btn btn-primary waves-effect waves-float waves-light">Add</a>
                        </div>    
                    </div>
                </div>	
                <div class="table-responsive">
                    <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Username</th>
                            <th>Full Name</th>
                            <th>For More Info</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                    @php
                        //dd($allusers->toArray());
                    @endphp
                    
                    @if(!empty($allusers->toArray()))
                        @foreach($allusers->toArray() as $row)
                            <tr>
                                <td>
                                    @if($row['image'] != "")
                                        <img src="{{asset('storage/profile_images/'.$row['image'])}}" alt="users avatar" class="user-avatar users-avatar-shadow rounded mr-2 my-25 cursor-pointer" height="90" width="90">
                                    @else
                                        <img  src="{{asset('admin/dummy/noimage.gif')}}" alt="users avatar" class="user-avatar users-avatar-shadow rounded mr-2 my-25 cursor-pointer" height="90" width="90">
                                    @endif
                                </td>
                                <td>{{$row['name']}}</td>
                                <td>{{$row['firstname']}} {{$row['lastname']}}</td>
                                <td>
                                    <button type="button" class="btn btn-outline-primary waves-effect userMoreInfo" data-toggle="modal" data-target="#large" data_email ="{{$row['email']}}" data_contact="{{$row['contact']}}" data_address="{{$row['address']}}"> Click Me</button>
                                </td>
                                <td>
                                    @if( $row['sts'] == "0")
                                        <div class="badge badge-glow badge-primary">
                                            <span>{{"Active"}}</span>
                                        </div>
                                    @else
                                        <div class="badge badge-glow badge-danger">
                                            <span>{{"Deactive"}}</span>
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <div class="dropdown">
                                    <button type="button" class="btn btn-sm dropdown-toggle hide-arrow waves-effect waves-float waves-light" data-toggle="dropdown">
                                        <svg xmlns="" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg>
                                    </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{route('common_users.edit',$row['id'])}}">
                                            <svg xmlns="" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 mr-50"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                                            <span>Edit</span>
                                            </a>
                                            <a class="dropdown-item" href="/delete_user/{{$row['id']}}">
                                            <svg xmlns="" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash mr-50"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                                            <span>Delete</span>
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endif    
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection


<!-- Modal -->
<div class="modal fade text-left" id="large" tabindex="-1" aria-labelledby="myModalLabel17" style="display: none;" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel17">User Informations.</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">×</span>
        </button>
    </div>
    <div class="modal-body">


                        <div class="row" id="basic-table">
                            <div class="col-12">
                                <div class="card">
                                
                                <div class="table-responsive">
                                    <table class="table">
                                    <thead>
                                        <tr>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Address</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <span class="email_model"></span>
                                            </td>
                                            <td>
                                                <span class="contact_model"></span>
                                            </td>
                                            <td>
                                                <p class="address_model"></p>
                                            </td>
                                        </tr>
                                    </tbody>
                                    </table>
                                </div>
                                </div>
                            </div>
                        </div>



    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-primary waves-effect waves-float waves-light" data-dismiss="modal">Accept</button>
    </div>
    </div>
</div>
</div>