@extends('admin_view.app-inc.templatebody')

@section('content')
    @php
        //dd($general->toArray());
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
                @if(!empty($pro_row->general))
                    @php
                        if($pro_row->general == "read"){
                            $give_permission_read = "yes";
                        }
                        if($pro_row->general == "add"){
                            $give_permission_add = "yes";
                        }
                        if($pro_row->general == "edit"){
                            $give_permission_edit = "yes";
                        }
                        if($pro_row->general == "delete"){
                            $give_permission_delete = "yes";
                        }
                    @endphp
                @endif
            @endforeach
        @endif
@endif


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
                            <h4 class="card-title">General Setting List</h4>
                        </div>
                    </div>
                    @if($give_permission_add == "yes" || Auth::user()->choices == "0")
                        <div class="col-2">
                            <div class="submit-btn m-1">
                                <i class="fas fa-plus"></i>
                                <a href="{{route('general.create')}}" class="btn btn-primary waves-effect waves-float waves-light">Add</a>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="table-responsive">
                @php
                    $company_intro = "";
                    $contact_address_data = "";
                @endphp

                @if($give_permission_read == "yes" || Auth::user()->choices == "0")
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Header Logo</th>
                                <th>Footer Logo</th>
                                <th>Social Links</th>
                                <th>Address & Contact</th>
                                <th>Company Intro</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if( !empty($general->toArray()) && is_array($general->toArray()) )
                            @foreach ($general as $row)
                                @php
                                    $company_intro = $row->company_intro;
                                    $logo_data = json_decode($row['logos'],TRUE);
                                    $social_data = json_decode($row['social_links'],TRUE);
                                    $contact_address_data = json_decode($row['address_contact'],TRUE);


                                    //dd($social_data);
                                    foreach($logo_data as $row_logo){
                                        $header_logo = $row_logo[0];
                                        $footer_logo = $row_logo[1];
                                    }

                                    foreach($social_data as $row_social){
                                        if($row_social[0]['facebook'] != null){
                                            $facebook = $row_social[0]['facebook'];
                                        }
                                        if($row_social[0]['twiter'] != null){
                                            $twiter = $row_social[0]['twiter'];
                                        }
                                        if($row_social[0]['linkedin'] != null){
                                            $linkedin = $row_social[0]['linkedin'];
                                        }
                                        if($row_social[0]['youtube'] != null){
                                            $youtube = $row_social[0]['youtube'];
                                        }
                                    }

                                @endphp

                            @endforeach
                        @endif
                            <tr>
                                <td>
                                    @php
                                        if($row_logo[1]){
                                            echo '<img src="'.asset('storage/company_logo_images/'.$header_logo).'" class="white-logo-cus-style" height="104" width="104" alt="Header logo avatar">';
                                        }else{
                                            echo '<img class="img-fluid rounded" src="'.asset('admin/dummy/noimage.gif').'" class="white-logo-cus-style" height="104" width="104" alt="Header logo avatar">';
                                        }
                                    @endphp
                                </td>
                                <td>
                                    @php
                                        if($row_logo[1]){
                                            echo '<img src="'.asset('storage/company_logo_images/'.$footer_logo).'" class="white-logo-cus-style" height="104" width="104" alt="Footer logo avatar">';
                                        }else{
                                            echo '<img class="img-fluid rounded" src="'.asset('admin/dummy/noimage.gif').'" class="white-logo-cus-style" height="104" width="104" alt="Footer logo avatar">';
                                        }
                                    @endphp
                                </td>
                                <td>
                                    <div class="social-box-holder">
                                        <ul>
                                            <li>
                                                <a href="{{$facebook}}">
                                                    <div class="card-body social-admin-general-style">
                                                        <div class="icon-wrapper" style="display: inline-flex;">
                                                            <svg xmlns="" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-facebook icon-size-cus-style">
                                                                <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                                                            </svg>
                                                            &nbsp;
                                                            {{-- <p class="icon-name text-truncate mb-0 mt-0" style="font: small-caption;">Facebook</p> --}}
                                                        </div>
                                                    </div>
                                                </a>

                                                <a href="{{$linkedin}}">
                                                    <div class="card-body social-admin-general-style">
                                                        <div class="icon-wrapper" style="display: inline-flex;">
                                                            <svg xmlns="" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-linkedin icon-size-cus-style">
                                                                <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path>
                                                                <rect x="2" y="9" width="4" height="12"></rect><circle cx="4" cy="4" r="2"></circle>
                                                            </svg>
                                                            &nbsp;
                                                            {{-- <p class="icon-name text-truncate mb-0 mt-0" style="font: small-caption;">Linkedin</p> --}}
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{$twiter}}">
                                                    <div class="card-body social-admin-general-style">
                                                        <div class="icon-wrapper" style="display: inline-flex;">
                                                            <svg xmlns="" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-twitter icon-size-cus-style">
                                                                <path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path>
                                                            </svg>
                                                            &nbsp;
                                                            {{-- <p class="icon-name text-truncate mb-0 mt-0" style="font: small-caption;">Facebook</p> --}}
                                                        </div>
                                                    </div>
                                                </a>

                                                <a href="{{$youtube}}">
                                                    <div class="card-body social-admin-general-style">
                                                        <div class="icon-wrapper" style="display: inline-flex;">
                                                            <svg xmlns="" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-youtube icon-size-cus-style">
                                                                <path d="M22.54 6.42a2.78 2.78 0 0 0-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 0 0-1.94 2A29 29 0 0 0 1 11.75a29 29 0 0 0 .46 5.33A2.78 2.78 0 0 0 3.4 19c1.72.46 8.6.46 8.6.46s6.88 0 8.6-.46a2.78 2.78 0 0 0 1.94-2 29 29 0 0 0 .46-5.25 29 29 0 0 0-.46-5.33z"></path>
                                                                <polygon points="9.75 15.02 15.5 11.75 9.75 8.48 9.75 15.02"></polygon>
                                                            </svg>
                                                            &nbsp;
                                                            {{-- <p class="icon-name text-truncate mb-0 mt-0" style="font: small-caption;">Facebook</p> --}}
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                                <td>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-outline-success waves-effect" data-toggle="modal" data-target="#success">
                                        Address & Contact
                                    </button>
                                </td>
                                <td>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-outline-info waves-effect" data-toggle="modal" data-target="#info">Company Intro</button>
                                </td>
                                <td>
                                    @if($give_permission_edit == "yes" || Auth::user()->choices == "0")
                                        <a class="dropdown-item" href="{{route('general.edit', $row['id'])}}">
                                            <svg xmlns="" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 mr-50"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                                            <span>Edit</span>
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                @endif
                </div>
            </div>
        </div>
    </div>

@endsection

<!-- Modal -->
<div class="d-inline-block">
    <div class="modal fade modal-info text-left" id="info" tabindex="-1" aria-labelledby="myModalLabel130" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel130">Company Short Discription.</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body show-the-content">
            {{$company_intro}}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info waves-effect waves-float waves-light" data-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
    </div>
</div>

<div class="d-inline-block">
    <!-- Modal -->
    <div class="modal fade text-left modal-success" id="success" tabindex="-1" aria-labelledby="myModalLabel110" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel110">Khan Group Different Branches</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">

            <div class="col-lg-12 col-12">
                <div class="card card-user-timeline">
                    <div class="card-body">
                        <ul class="timeline ml-50">
                        @php
                            if($contact_address_data != ""){
                                for($i=0;$i<count($contact_address_data['address']);$i++){
                                    if($i%2==0){
                                        $point_color = "timeline-point-warning";
                                    }else{
                                        $point_color = "";
                                    }
                                    echo '<li class="timeline-item">
                                        <span class="timeline-point '.$point_color.' timeline-point-indicator"></span>
                                        <div class="timeline-event">
                                        <div class="d-flex justify-content-between flex-sm-row flex-column mb-sm-0 mb-1">
                                            <h6>Address</h6>
                                        </div>
                                        <p>'.$contact_address_data['address'][$i].'<br></p>
                                        <div class="media align-items-center">
                                            <div class="media-body">
                                                <h6 class="mb-0">Contact</h6>
                                                <p class="mb-0">'.$contact_address_data['contact'][$i].'</p>
                                            </div>
                                        </div>
                                        </div>
                                    </li>';
                                }
                            }
                        @endphp
                        </ul>
                    </div>
                </div>
            </div>

                {{-- @php
                    for($i=0;$i<count($contact_address_data);$i++){
                        echo $contact_address_data['address'][$i]."<br>";
                    }
                @endphp --}}

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success waves-effect waves-float waves-light" data-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
    </div>
</div>


