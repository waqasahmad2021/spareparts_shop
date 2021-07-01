@extends('admin_view.app-inc.templatebody')

@section('content')

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

    <section class="app-user-edit">
        <div class="card">
            <div class="card-body">
            {{-- <ul class="nav nav-pills" role="tablist">
                <li class="nav-item">
                <a class="nav-link d-flex align-items-center active" id="account-tab" data-toggle="tab" href="#account" aria-controls="account" role="tab" aria-selected="true">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg><span class="d-none d-sm-block">Account</span>
                </a>
                </li>
                <li class="nav-item">
                <a class="nav-link d-flex align-items-center" id="information-tab" data-toggle="tab" href="#information" aria-controls="information" role="tab" aria-selected="false">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-info"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg><span class="d-none d-sm-block">Information</span>
                </a>
                </li>
                <li class="nav-item">
                <a class="nav-link d-flex align-items-center" id="social-tab" data-toggle="tab" href="#social" aria-controls="social" role="tab" aria-selected="false">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-share-2"><circle cx="18" cy="5" r="3"></circle><circle cx="6" cy="12" r="3"></circle><circle cx="18" cy="19" r="3"></circle><line x1="8.59" y1="13.51" x2="15.42" y2="17.49"></line><line x1="15.41" y1="6.51" x2="8.59" y2="10.49"></line></svg><span class="d-none d-sm-block">Social</span>
                </a>
                </li>
            </ul> --}}
            <div class="tab-content">
                <!-- Account Tab starts -->
                <div class="tab-pane active" id="account" aria-labelledby="account-tab" role="tabpanel">
                <form class="form-validate" novalidate="novalidate" action="{{route('profile.update',$single_user->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                <!-- users edit media object start -->
                    <div class="media mb-2">
                    @php
                        if($single_user->image != ""){
                            echo '<img src="'.asset('storage/profile_images/'.$single_user->image).'" alt="users avatar" class="user-avatar users-avatar-shadow rounded mr-2 my-25 cursor-pointer" height="90" width="90">';
                        }else{
                            echo '<img  src="'.asset('admin/dummy/noimage.gif').'" alt="users avatar" class="user-avatar users-avatar-shadow rounded mr-2 my-25 cursor-pointer" height="90" width="90">';
                        }
                    @endphp
                        <div class="media-body mt-50">
                            <h4>{{$single_user->name}}</h4>
                            <div class="col-12 d-flex mt-1 px-0">
                                <label class="btn btn-primary mr-75 mb-0 waves-effect waves-float waves-light" for="change-picture">
                                <span class="d-none d-sm-block">Change</span>
                                <input class="form-control" type="file" id="change-picture" name="profileimg" hidden="" accept="image/png, image/jpeg, image/jpg">
                                <span class="d-block d-sm-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit mr-0"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                </span>
                                </label>
                                {{-- <button class="btn btn-outline-secondary d-none d-sm-block waves-effect">Remove</button> --}}
                                <button class="btn btn-outline-secondary d-block d-sm-none waves-effect">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 mr-0"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                </button>
                            </div>
                        </div>
                    </div>
                <!-- users edit media object ends -->
                <!-- users edit account form start -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                            <label for="firstname">Fisrt name</label>
                            <input type="text" class="form-control" placeholder="First name" value="{{$single_user->firstname}}" name="firstname" id="firstname" aria-invalid="false">
                            @error('firstname')
                                <div class="alert alert-danger p-1">{{ $message }}</div>
                            @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                            <label for="lastname">Last name</label>
                            <input type="text" class="form-control" placeholder="Last name" value="{{$single_user->lastname}}" name="lastname" id="lastname" aria-invalid="false">
                            @error('lastname')
                                <div class="alert alert-danger p-1">{{ $message }}</div>
                            @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                            <label for="email">E-mail</label>
                            <input type="email" class="form-control" placeholder="Email" value="{{$single_user->email}}" name="email" id="email" aria-invalid="false">
                            @error('email')
                                <div class="alert alert-danger p-1">{{ $message }}</div>
                            @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                            <label for="contact">Contact</label>
                            <input type="text" class="form-control" value="{{$single_user->contact}}" placeholder="Contact" id="contact" name="contact" aria-invalid="false">
                            @error('contact')
                                <div class="alert alert-danger p-1">{{ $message }}</div>
                            @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                            <label for="address">Address</label>
                            <textarea class="form-control" id="address" name="address" aria-invalid="false">{{$single_user->address}}</textarea>
                            @error('address')
                                <div class="alert alert-danger p-1">{{ $message }}</div>
                            @enderror
                            </div>
                        </div>
                    </div>

                    <hr/>

                    @if(Auth::user()->choices == "0")
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="table-responsive border rounded mt-1">
                                    <h6 class="py-1 mx-1 mb-0 font-medium-2">
                                        <svg xmlns="" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock font-medium-3 mr-25"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                                        <span class="align-middle">Permission</span>
                                    </h6>
                                    <table class="table table-striped table-borderless">
                                        <thead class="thead-light">
                                        <tr>
                                            <th>Module</th>
                                            <th>Read</th>
                                            <th>Add</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                    @php
                                        $permission = json_decode($single_user->permission);
                                        //dd($permission);
                                        $pro_read = "no";
                                        $pro_add = "no";
                                        $pro_edit = "no";
                                        $pro_delete = "no";

                                        $user_read = "no";
                                        $user_add = "no";
                                        $user_edit = "no";
                                        $user_delete = "no";

                                        $general_read = "no";
                                        $general_add = "no";
                                        $general_edit = "no";
                                        $general_delete = "no";
                                    @endphp

                                    @if(!empty($permission))
                                        @foreach($permission as $row_per)
                                            @if(!empty($row_per->product))
                                                @php
                                                    if($row_per->product == "read"){
                                                        $pro_read = "yes";
                                                    }
                                                    if($row_per->product == "add"){
                                                        $pro_add = "yes";
                                                    }
                                                    if($row_per->product == "edit"){
                                                        $pro_edit = "yes";
                                                    }
                                                    if($row_per->product == "delete"){
                                                        $pro_delete = "yes";
                                                    }
                                                @endphp
                                            @endif
                                        @endforeach
                                    @endif

                                        <tr>
                                            <td>Products</td>
                                            <td>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="product-read" name="permission_pro[]" value="read" @if($pro_read == "yes")? {{"checked"}} : {{""}} @endif>
                                                    <label class="custom-control-label" for="product-read"></label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="product-write" name="permission_pro[]" value="add" @if($pro_add == "yes")? {{"checked"}} : {{""}} @endif>
                                                    <label class="custom-control-label" for="product-write"></label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="product-create" name="permission_pro[]" value="edit" @if($pro_edit == "yes")? {{"checked"}} : {{""}} @endif>
                                                    <label class="custom-control-label" for="product-create"></label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="product-delete" name="permission_pro[]" value="delete" @if($pro_delete == "yes")? {{"checked"}} : {{""}} @endif>
                                                    <label class="custom-control-label" for="product-delete"></label>
                                                </div>
                                            </td>
                                        </tr>

                                    @if(!empty($permission))
                                        @foreach($permission as $row_per)
                                            @if(!empty($row_per->users))
                                                @php
                                                    if($row_per->users == "read"){
                                                        $user_read = "yes";
                                                    }
                                                    if($row_per->users == "add"){
                                                        $user_add = "yes";
                                                    }
                                                    if($row_per->users == "edit"){
                                                        $user_edit = "yes";
                                                    }
                                                    if($row_per->users == "delete"){
                                                        $user_delete = "yes";
                                                    }
                                                @endphp
                                            @endif
                                        @endforeach
                                    @endif

                                        <tr>
                                            <td>User Registeration</td>
                                            <td>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="users-read" name="permission_user[]" value="read" @if($user_read == "yes")? {{"checked"}} : {{""}} @endif >
                                                    <label class="custom-control-label" for="users-read"></label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="users-write" name="permission_user[]" value="add" @if($user_add == "yes")? {{"checked"}} : {{""}} @endif >
                                                    <label class="custom-control-label" for="users-write"></label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="users-create" name="permission_user[]" value="edit" @if($user_edit == "yes")? {{"checked"}} : {{""}} @endif >
                                                    <label class="custom-control-label" for="users-create"></label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="users-delete" name="permission_user[]" value="delete" @if($user_delete == "yes")? {{"checked"}} : {{""}} @endif >
                                                    <label class="custom-control-label" for="users-delete"></label>
                                                </div>
                                            </td>
                                        </tr>

                                        @if(!empty($permission))
                                            @foreach($permission as $row_per)
                                                @if(!empty($row_per->general))
                                                    @php
                                                        if($row_per->general == "read"){
                                                            $general_read = "yes";
                                                        }
                                                        if($row_per->general == "add"){
                                                            $general_add = "yes";
                                                        }
                                                        if($row_per->general == "edit"){
                                                            $general_edit = "yes";
                                                        }
                                                        if($row_per->general == "delete"){
                                                            $general_delete = "yes";
                                                        }
                                                    @endphp
                                                @endif
                                            @endforeach
                                        @endif

                                        <tr>
                                            <td>General Setting</td>
                                            <td>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="general-read" name="permission_general[]" value="read" @if($general_read == "yes")? {{"checked"}} : {{""}} @endif>
                                                    <label class="custom-control-label" for="general-read"></label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="general-write" name="permission_general[]" value="add" @if($general_add == "yes")? {{"checked"}} : {{""}} @endif>
                                                    <label class="custom-control-label" for="general-write"></label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="general-create" name="permission_general[]" value="edit" @if($general_edit == "yes")? {{"checked"}} : {{""}} @endif >
                                                    <label class="custom-control-label" for="general-create"></label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="general-delete" name="permission_general[]" value="delete" @if($general_delete == "yes")? {{"checked"}} : {{""}} @endif>
                                                    <label class="custom-control-label" for="general-delete"></label>
                                                </div>
                                            </td>
                                        </tr>

                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                        <hr/>
                    @endif

                    <div class="row">
                        <div class="col-12 d-flex flex-sm-row flex-column mt-2">
                            <input type="hidden" name="_method" value="PUT"/>
                            <input type="hidden" name="profile_img_hidden" id="profile_img_hidden" value="{{$single_user->image}}" />
                            <button type="submit" class="btn btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1 waves-effect waves-float waves-light">Save Changes</button>
                            <button type="reset" class="btn btn-outline-secondary waves-effect">Reset</button>
                        </div>
                    </div>

                </form>
                <!-- users edit account form ends -->
                </div>
                <!-- Account Tab ends -->

                {{--
                <!-- Information Tab starts -->
                <div class="tab-pane" id="information" aria-labelledby="information-tab" role="tabpanel">
                <!-- users edit Info form start -->
                <form class="form-validate" novalidate="novalidate">
                    <div class="row mt-1">
                    <div class="col-12">
                        <h4 class="mb-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user font-medium-4 mr-25"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                        <span class="align-middle">Personal Information</span>
                        </h4>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="form-group">
                        <label for="birth">Birth date</label>
                        <input id="birth" type="text" class="form-control birthdate-picker flatpickr-input" name="dob" placeholder="YYYY-MM-DD" readonly="readonly">
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="form-group">
                        <label for="mobile">Mobile</label>
                        <input id="mobile" type="text" class="form-control" value="+6595895857" name="phone">
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="form-group">
                        <label for="website">Website</label>
                        <input id="website" type="text" class="form-control" placeholder="Website here..." value="https://rowboat.com/insititious/Angelo" name="website">
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="form-group">
                        <label for="languages">Languages</label>
                        <select id="languages" class="form-control">
                            <option value="English">English</option>
                            <option value="Spanish">Spanish</option>
                            <option value="French" selected="">French</option>
                            <option value="Russian">Russian</option>
                            <option value="German">German</option>
                            <option value="Arabic">Arabic</option>
                            <option value="Sanskrit">Sanskrit</option>
                        </select>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="form-group">
                        <label class="d-block mb-1">Gender</label>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="male" name="gender" class="custom-control-input">
                            <label class="custom-control-label" for="male">Male</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="female" name="gender" class="custom-control-input" checked="">
                            <label class="custom-control-label" for="female">Female</label>
                        </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="form-group">
                        <label class="d-block mb-1">Contact Options</label>
                        <div class="custom-control custom-checkbox custom-control-inline">
                            <input type="checkbox" class="custom-control-input" id="email-cb" checked="">
                            <label class="custom-control-label" for="email-cb">Email</label>
                        </div>
                        <div class="custom-control custom-checkbox custom-control-inline">
                            <input type="checkbox" class="custom-control-input" id="message" checked="">
                            <label class="custom-control-label" for="message">Message</label>
                        </div>
                        <div class="custom-control custom-checkbox custom-control-inline">
                            <input type="checkbox" class="custom-control-input" id="phone">
                            <label class="custom-control-label" for="phone">Phone</label>
                        </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <h4 class="mb-1 mt-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-map-pin font-medium-4 mr-25"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                        <span class="align-middle">Address</span>
                        </h4>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="form-group">
                        <label for="address-1">Address Line 1</label>
                        <input id="address-1" type="text" class="form-control" value="A-65, Belvedere Streets" name="address">
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="form-group">
                        <label for="address-2">Address Line 2</label>
                        <input id="address-2" type="text" class="form-control" placeholder="T-78, Groove Street">
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="form-group">
                        <label for="postcode">Postcode</label>
                        <input id="postcode" type="text" class="form-control" placeholder="597626" name="zip">
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="form-group">
                        <label for="city">City</label>
                        <input id="city" type="text" class="form-control" value="New York" name="city">
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="form-group">
                        <label for="state">State</label>
                        <input id="state" type="text" class="form-control" name="state" placeholder="Manhattan">
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="form-group">
                        <label for="country">Country</label>
                        <input id="country" type="text" class="form-control" name="country" placeholder="United States">
                        </div>
                    </div>
                    <div class="col-12 d-flex flex-sm-row flex-column mt-2">
                        <button type="submit" class="btn btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1 waves-effect waves-float waves-light">Save Changes</button>
                        <button type="reset" class="btn btn-outline-secondary waves-effect">Reset</button>
                    </div>
                    </div>
                </form>
                <!-- users edit Info form ends -->
                </div>
                <!-- Information Tab ends -->

                <!-- Social Tab starts -->
                <div class="tab-pane" id="social" aria-labelledby="social-tab" role="tabpanel">
                <!-- users edit social form start -->
                <form class="form-validate" novalidate="novalidate">
                    <div class="row">
                    <div class="col-lg-4 col-md-6 form-group">
                        <label for="twitter-input">Twitter</label>
                        <div class="input-group input-group-merge">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-twitter font-medium-2"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path></svg>
                            </span>
                        </div>
                        <input id="twitter-input" type="text" class="form-control" value="https://www.twitter.com/adoptionism744" placeholder="https://www.twitter.com/" aria-describedby="basic-addon3">
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 form-group">
                        <label for="facebook-input">Facebook</label>
                        <div class="input-group input-group-merge">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-facebook font-medium-2"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg>
                            </span>
                        </div>
                        <input id="facebook-input" type="text" class="form-control" value="https://www.facebook.com/adoptionism664" placeholder="https://www.facebook.com/" aria-describedby="basic-addon4">
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 form-group">
                        <label for="instagram-input">Instagram</label>
                        <div class="input-group input-group-merge">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon5">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-instagram font-medium-2"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>
                            </span>
                        </div>
                        <input id="instagram-input" type="text" class="form-control" value="https://www.instagram.com/adopt-ionism744" placeholder="https://www.instagram.com/" aria-describedby="basic-addon5">
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 form-group">
                        <label for="github-input">Github</label>
                        <div class="input-group input-group-merge">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon9">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-github font-medium-2"><path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22"></path></svg>
                            </span>
                        </div>
                        <input id="github-input" type="text" class="form-control" value="https://www.github.com/madop818" placeholder="https://www.github.com/" aria-describedby="basic-addon9">
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 form-group">
                        <label for="codepen-input">Codepen</label>
                        <div class="input-group input-group-merge">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon12">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-codepen font-medium-2"><polygon points="12 2 22 8.5 22 15.5 12 22 2 15.5 2 8.5 12 2"></polygon><line x1="12" y1="22" x2="12" y2="15.5"></line><polyline points="22 8.5 12 15.5 2 8.5"></polyline><polyline points="2 15.5 12 8.5 22 15.5"></polyline><line x1="12" y1="2" x2="12" y2="8.5"></line></svg>
                            </span>
                        </div>
                        <input id="codepen-input" type="text" class="form-control" value="https://www.codepen.com/adoptism243" placeholder="https://www.codepen.com/" aria-describedby="basic-addon12">
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 form-group">
                        <label for="slack-input">Slack</label>
                        <div class="input-group input-group-merge">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon11">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-slack font-medium-2"><path d="M14.5 10c-.83 0-1.5-.67-1.5-1.5v-5c0-.83.67-1.5 1.5-1.5s1.5.67 1.5 1.5v5c0 .83-.67 1.5-1.5 1.5z"></path><path d="M20.5 10H19V8.5c0-.83.67-1.5 1.5-1.5s1.5.67 1.5 1.5-.67 1.5-1.5 1.5z"></path><path d="M9.5 14c.83 0 1.5.67 1.5 1.5v5c0 .83-.67 1.5-1.5 1.5S8 21.33 8 20.5v-5c0-.83.67-1.5 1.5-1.5z"></path><path d="M3.5 14H5v1.5c0 .83-.67 1.5-1.5 1.5S2 16.33 2 15.5 2.67 14 3.5 14z"></path><path d="M14 14.5c0-.83.67-1.5 1.5-1.5h5c.83 0 1.5.67 1.5 1.5s-.67 1.5-1.5 1.5h-5c-.83 0-1.5-.67-1.5-1.5z"></path><path d="M15.5 19H14v1.5c0 .83.67 1.5 1.5 1.5s1.5-.67 1.5-1.5-.67-1.5-1.5-1.5z"></path><path d="M10 9.5C10 8.67 9.33 8 8.5 8h-5C2.67 8 2 8.67 2 9.5S2.67 11 3.5 11h5c.83 0 1.5-.67 1.5-1.5z"></path><path d="M8.5 5H10V3.5C10 2.67 9.33 2 8.5 2S7 2.67 7 3.5 7.67 5 8.5 5z"></path></svg>
                            </span>
                        </div>
                        <input id="slack-input" type="text" class="form-control" value="@adoptionism744" placeholder="https://www.slack.com/" aria-describedby="basic-addon11">
                        </div>
                    </div>

                    <div class="col-12 d-flex flex-sm-row flex-column mt-2">
                        <button type="submit" class="btn btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1 waves-effect waves-float waves-light">Save Changes</button>
                        <button type="reset" class="btn btn-outline-secondary waves-effect">Reset</button>
                    </div>
                    </div>
                </form>
                <!-- users edit social form ends -->
                </div>
                <!-- Social Tab ends -->
                --}}

            </div>
            </div>
        </div>
    </section>

@endsection

