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
                        <form class="form" action="{{route('common_users.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">

                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="choices">User Choice</label>
                                        <select class="form-control @error('choices') is-invalid @enderror" id="choices" name="choices">
                                            <option value="" @if(old('choices') == "") {{ "selected" }} @endif >--Select Any--</option>
                                            <option value="0" @if(old('choices') == "0") {{ "selected" }} @endif>Admin User</option>
                                            <option value="1" @if(old('choices') == "1") {{ "selected" }} @endif>Normal User</option>
                                        </select>
                                        @error('choices')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="name">User Name</label>
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{old('name')}}"  autocomplete="name" autofocus="">
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="email">E-Mail Address</label>
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror " name="email" value="{{old('email')}}"  autocomplete="email">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror "  name="password"  autocomplete="new-password">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="password_confirmation">Confirm Password</label>
                                        <input id="password-confirm" type="password" class="form-control @error('password_confirmation') is-invalid @enderror " name="password_confirmation"  autocomplete="new-password">
                                        @error('password_confirmation')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
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

                                                <tr>
                                                    <td>Products</td>
                                                    <td>
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="product-read" name="permission_pro[]" value="read" >
                                                            <label class="custom-control-label" for="product-read"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="product-write" name="permission_pro[]" value="add" >
                                                            <label class="custom-control-label" for="product-write"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="product-create" name="permission_pro[]" value="edit" >
                                                            <label class="custom-control-label" for="product-create"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="product-delete" name="permission_pro[]" value="delete" >
                                                            <label class="custom-control-label" for="product-delete"></label>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>User Registeration</td>
                                                    <td>
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="users-read" name="permission_user[]" value="read" >
                                                            <label class="custom-control-label" for="users-read"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="users-write" name="permission_user[]" value="add" >
                                                            <label class="custom-control-label" for="users-write"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="users-create" name="permission_user[]" value="edit" >
                                                            <label class="custom-control-label" for="users-create"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="users-delete" name="permission_user[]" value="delete" >
                                                            <label class="custom-control-label" for="users-delete"></label>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>General Setting</td>
                                                    <td>
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="general-read" name="permission_general[]" value="read" >
                                                            <label class="custom-control-label" for="general-read"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="general-write" name="permission_general[]" value="add" >
                                                            <label class="custom-control-label" for="general-write"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="general-create" name="permission_general[]" value="edit" >
                                                            <label class="custom-control-label" for="general-create"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="general-delete" name="permission_general[]" value="delete" >
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
