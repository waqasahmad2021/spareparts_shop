@extends('admin_view.app-inc.templatebody')

@section('content')
    <section id="multiple-column-form">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Update General Setting</h4>
                    </div>
                    <div class="card-body">
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

                    @if( !empty($general->toArray()) && is_array($general->toArray()) )

                        <form class="form" action="{{route('general.update',$general['id'])}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-1 col-12">
                                    <div class="white-logo-cus-style">
                                        @php
                                            $logo_data =  json_decode($general['logos']);
                                            //dd($logo_data);
                                            foreach ($logo_data as $row_logo){
                                                if($row_logo[0]){
                                                    echo '<img src="'.asset('storage/company_logo_images/'.$row_logo[0]).'" alt="logo" width="80" height="75">';
                                                }else{
                                                    echo '<a href="javascript:;"><img src="'.asset('admin/dummy/noimage.gif').'" alt="logo" width="80" height="75"></a>';
                                                }
                                            }
                                        @endphp
                                    </div>    
                                </div>
                                <div class="col-md-5 col-12">
                                    <div class="form-group">
                                        <label for="top_logo">Header Logo *</label>
                                        <input type="file" id="top_logo" class="form-control" placeholder="Header Logo" name="logo[]">
                                        {{-- @error('logo') --}}
                                        @error('logo')
                                            <div class="alert alert-danger p-1">{{ $message }}</div>
                                        @enderror
                                        {{-- @if($errors->any())
                                            <div class="alert alert-danger">
                                                <p><strong>Opps Something went wrong</strong></p>
                                                <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                                </ul>
                                            </div>
                                        @endif --}}
                                        {{-- @foreach($errors->all() as $error)
                                            @if($error=="doc,pdf,docx,txt,zip,jpeg,jpg,png are allowed.")
                                                    <span class="help-block"><strong>{{$error}}</strong></span>
                                            @endif
                                        @endforeach --}}
                                        {{-- @enderror --}}
                                    </div>
                                </div>
                                <div class="col-md-1 col-12">
                                    <div class="white-logo-cus-style">
                                        @php
                                            $logo_data =  json_decode($general['logos']);
                                            //dd($logo_data);
                                            foreach ($logo_data as $row_logo){
                                                if($row_logo[0]){
                                                    echo '<img src="'.asset('storage/company_logo_images/'.$row_logo[1]).'" alt="logo" width="80" height="75">';
                                                }else{
                                                    echo '<a href="javascript:;"><img src="'.asset('admin/dummy/noimage.gif').'" alt="logo" width="80" height="75"></a>';
                                                }
                                            }
                                        @endphp
                                    </div>
                                </div>
                                <div class="col-md-5 col-12">
                                    <div class="form-group">
                                        <label for="footer_logo">Footer Logo *</label>
                                        <input type="file" id="footer_logo" class="form-control" placeholder="Footer Logo" name="logo[]">
                                        @error('logo')
                                            <div class="alert alert-danger p-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12 col-12">
                                    <div class="form-group">
                                        <label for="company_intro">Company Small Intro *</label>
                                        <textarea id="company_intro" class="form-control" placeholder="Company Small Introduction ..." name="company_intro" >{{$general['company_intro']}}</textarea>
                                        @error('company_intro')
                                            <div class="alert alert-danger p-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12 col-12">
                                    <div class="form-group">
                                        <div class="card-header">
                                            <h4 class="card-title">Add Multiple Address <small> Total Address <strong class="totle_no_apended style-count-no"> 1 </strong> </small></h4>
                                            <p class="text-right">
                                                <button type="button" class="btn btn-icon btn-primary waves-effect waves-float waves-light get_addressphone_html" type="button" data-repeater-create="">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus mr-25"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                                                    <span>Add New</span>
                                                </button>
                                            </p>    
                                        </div>
                                    </div>
                                </div>        

                                @php
                                    $add_cont_data =  json_decode($general['address_contact'],TRUE);
                                    //dd(count($add_cont_data));
                                @endphp    
                                @for($add=0; $add<count($add_cont_data); $add++)   
                                    {{-- <div class="row"> --}}
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="address">Address *</label>
                                                <input type="text" id="address" class="form-control" value="{{ $add_cont_data['address'][$add] }}" placeholder="Address" name="address[]">
                                                @error('address.'.$add)
                                                    {{-- <div class="alert alert-danger p-1">{{ $message }}</div> --}}
                                                    <div class="alert alert-danger p-1">Atleast one address is required.</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="contact">Contact *</label>
                                                <input type="text" id="contact" class="form-control" value="{{ $add_cont_data['contact'][$add] }}" placeholder="Contact" name="contact[]">
                                                @error('contact.'.$add)
                                                    <div class="alert alert-danger p-1">Atleast one contact / phone is required & must be an integer.</div>
                                                @enderror
                                            </div>
                                        </div>
                                    {{-- </div> --}}
                                @endfor
                                <div class="col-md-12 col-12">
                                    <div class="form-group">
                                        <div class="address_contact_html_holder">
                                            <div class="row count_the_html">
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="address">Address *</label>
                                                        <input type="text" id="address" class="form-control" value="{{ old('address.0') }}" placeholder="Address" name="address[]">
                                                        @error('address.2')
                                                            {{-- <div class="alert alert-danger p-1">{{ $message }}</div> --}}
                                                            <div class="alert alert-danger p-1">Atleast one address is required.</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="contact">Contact *</label>
                                                        <input type="text" id="contact" class="form-control" value="{{ old('contact.0') }}" placeholder="Contact" name="contact[]">
                                                        @error('contact.2')
                                                            <div class="alert alert-danger p-1">Atleast one contact / phone is required & must be an integer.</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>  
                                        </div>
                                        <div class="address_contact_destinationHtml_holder"></div>
                                    </div>
                                </div>


                                <div class="col-md-12 col-12">
                                    <div class="form-group">
                                        <div class="card-header">
                                            <h4 class="card-title">Social Media Links</h4>  
                                        </div>
                                    </div>
                                </div>    

                                @php
                                    $social_data = json_decode($general['social_links'],TRUE);
                                @endphp  
                                @foreach($social_data as $row_social)
                                    @if($row_social[0]['facebook'] != null)
                                        <div class="col-md-3 col-12">
                                            <div class="form-group">
                                                <label for="facebook">Facebook Link</label>
                                                <input type="text" id="facebook" value="{{$row_social[0]['facebook']}}" class="form-control" placeholder="Facebook Link" name="facebook">
                                            </div>
                                        </div> 
                                    @endif
                                    @if($row_social[0]['twiter'] != null)
                                        <div class="col-md-3 col-12">
                                            <div class="form-group">
                                                <label for="twiter">Twiter Link</label>
                                                <input type="text" id="twiter" value="{{$row_social[0]['twiter']}}" class="form-control" placeholder="Twiter Link" name="twiter">
                                            </div>
                                        </div> 
                                    @endif
                                    @if($row_social[0]['linkedin'] != null)
                                        <div class="col-md-3 col-12">
                                            <div class="form-group">
                                                <label for="linkedin">LinkedIn Link</label>
                                                <input type="text" id="linkedin" value="{{$row_social[0]['linkedin']}}" class="form-control" placeholder="LinkedIn Link" name="linkedin">
                                            </div>
                                        </div> 
                                    @endif
                                    @if($row_social[0]['youtube'] != null)
                                        <div class="col-md-3 col-12">
                                            <div class="form-group">
                                                <label for="youtube">Youtube Link</label>
                                                <input type="text" id="youtube" value="{{$row_social[0]['youtube']}}" class="form-control" placeholder="Youtube Link" name="youtube">
                                            </div>
                                        </div> 
                                    @endif
                                @endforeach
                                

                                <div class="col-12 mt-3">
                                    <input type="hidden" name="_method" value="PUT"/>

                                    @php
                                        $logo_data =  json_decode($general['logos'],TRUE);
                                        //dd(count($logo_data['logos']));
                                    @endphp
                                    @for ($logoCount = 0; $logoCount < count($logo_data['logos']); $logoCount++)
                                        <input type="hidden" name="logo_img_hidden[]" id="logo_img_hidden" value="{{$logo_data['logos'][$logoCount]}}" />
                                    @endfor

                                    

                                    <button type="submit" class="btn btn-primary mr-1 waves-effect waves-float waves-light">Update</button>
                                    <button type="reset" class="btn btn-outline-secondary waves-effect">Reset</button>
                                </div>
                            </div>
                        </form>

                    @endif

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection