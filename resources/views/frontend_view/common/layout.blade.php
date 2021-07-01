{{-- @php
    dd($all_pro->toArray());
@endphp --}}
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>KHAN GROUP</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->

    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('frontend/img/fav/favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('frontend/img/fav/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('frontend/img/fav/favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('frontend/img/fav/favicon/site.webmanifest') }}">

    <!-- Favicon -->

    <!-- CSS
    ========================= -->
    <!--bootstrap min css-->
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }} ">
    <!--owl carousel min css-->
    <link rel="stylesheet" href="{{ asset('frontend/css/owl.carousel.min.css') }}">
    <!--slick min css-->
    <link rel="stylesheet" href="{{ asset('frontend/css/slick.css') }}">
    <!--magnific popup min css-->
    <link rel="stylesheet" href="{{ asset('frontend/css/magnific-popup.css') }}">
    <!--font awesome css-->
    <link rel="stylesheet" href="{{ asset('frontend/css/font.awesome.css') }}">
    <!--ionicons min css-->
    <link rel="stylesheet" href="{{ asset('frontend/css/ionicons.min.css') }}">
    <!--animate css-->
    <link rel="stylesheet" href="{{ asset('frontend/css/animate.css') }}">
    <!--jquery ui min css-->
    <link rel="stylesheet" href="{{ asset('frontend/css/jquery-ui.min.css') }}">
    <!--slinky menu css-->
    <link rel="stylesheet" href="{{ asset('frontend/css/slinky.menu.css') }}">
    <!-- Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/css/plugins.css') }}">

    <!-- Main Style CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">

    <!-- Custom Style CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/css/custom.css') }}">

    <!--modernizr min js here-->
    <script src="{{ asset('frontend/js/vendor/modernizr-3.7.1.min.js') }}"></script>

</head>

<body>

    <!-- Main Wrapper Start -->
    <!--header area start-->
    <header class="header_area">
        <!--header top start-->
        <div class="header_top">
            <div class="container">
                <div class="top_inner">
                    <div class="row align-items-center">
                        <div class="col-lg-9 col-md-9">
                            <div class="follow_us">
                                <label>Follow Us:</label>
                                <ul class="follow_link">

                                @if(!empty($general->toArray()) && is_array($general->toArray()))
                                    @foreach ($general as $row_general)
                                        @php
                                            //dd($row_general);
                                            $social_data = json_decode($row_general->social_links,TRUE);
                                            foreach($social_data as $row_social){
                                                //dd($row_social[0]['facebook']);
                                                //echo $row_social[0]['facebook'];
                                                //dd($row_social);
                                                if($row_social[0]['facebook'] != null){
                                                    echo '<li><a href="'.$row_social[0]['facebook'].'"><i class="ion-social-facebook"></i></a></li>';
                                                }
                                                if($row_social[0]['twiter'] != null){
                                                    echo '<li><a href="'.$row_social[0]['twiter'].'"><i class="ion-social-twitter"></i></a></li>';
                                                }
                                                if($row_social[0]['googleplus'] != null){
                                                    echo '<li><a href="'.$row_social[0]['googleplus'].'"><i class="ion-social-googleplus"></i></a></li>';
                                                }
                                                if($row_social[0]['linkedin'] != null){
                                                    echo '<li><a href="'.$row_social[0]['linkedin'].'"><i class="ion-social-linkedin"></i></a></li>';
                                                }
                                                if($row_social[0]['youtube'] != null){
                                                    echo '<li><a href="'.$row_social[0]['youtube'].'"><i class="ion-social-youtube"></i></a></li>';
                                                }
                                            }
                                        @endphp
                                    @endforeach
                                @endif

                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3">
                            <div class="top_right text-right my-account-cus-style">
                                <ul>
                                @if(!empty(Auth::user()))
                                    <li class="top_links">
                                        <a href="javascript:void(0);">
                                            <i class="fa fa-user" aria-hidden="true"></i>
                                            {{Auth::user()->name}} <i class="ion-ios-arrow-down"></i>
                                        </a>
                                        <ul class="dropdown_currency">
                                        <li><a href="{{route('profile.create')}}"> Admin Dashboard</a></li>
                                        </ul>
                                    </li>
                                @else

                                    <li class="top_links">
                                        <a href="{{ route('login') }}">
                                            <i class="fa fa-sign-in" aria-hidden="true"></i> Login
                                        </a>
                                    </li>
                                @endif

                                    @php /*
                                    <li class="top_links">
                                        <a href="{{ route('register') }}">
                                            <i class="fa fa-user-plus" aria-hidden="true"></i> Registeration
                                        </a>
                                    </li>
                                    */
                                    @endphp
                                </ul>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--header top start-->

        <!--header middel start-->
        <div class="header_middle">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-6">
                        <div class="logo">

                        @if(!empty($general->toArray()) && is_array($general->toArray()))
                            @foreach ($general as $row_general)
                                @php
                                    $logo_data = json_decode($row_general->logos,TRUE);
                                    foreach($logo_data as $key => $row_logo){
                                        //dd($row_logo);
                                        if($row_logo[0]){
                                            echo '<img src="'.asset('storage/company_logo_images/'.$row_logo[0]).'" alt="logo">';
                                        }else{
                                            echo '<a href="javascript:;"><img src="'.asset('frontend/img/logo/khan-white-logo.png').'" alt="logo"></a>';
                                        }
                                    }
                                @endphp
                            @endforeach
                        @else
                            @php
                                echo '<a href="javascript:;"><img src="'.asset('frontend/img/logo/khan-white-logo.png').'" alt="logo"></a>';
                            @endphp
                        @endif

                        </div>
                    </div>
                    <div class="col-lg-9 col-md-6">
                        <div class="middel_right">
                            <div class="search-container">
                                <form action="javascript:;">
                                    <div class="search_box">
                                        <input placeholder="Search entire store here ..." type="text">
                                        <button type="submit"><i class="ion-ios-search-strong"></i></button>
                                    </div>
                                </form>
                            </div>
                            <div class="middel_right_info">

                                <!-- <div class="header_wishlist">
                                    <a href="javascript:;"><span class="lnr lnr-heart"></span> Wish list </a>
                                    <span class="wishlist_quantity">3</span>
                                </div> -->

                                @php
                                    $total_cart_no = 0;
                                    $value = session('cartArr');
                                    if(!empty($value)){
                                        $total_cart_no = count($value);
                                    }
                                @endphp

                                <div class="mini_cart_wrapper">
                                    <a href="javascript:void(0)"><span class="lnr lnr-cart"></span>My Cart </a>
                                <span class="cart_quantity countofthecart">{{$total_cart_no}}</span>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--header middel end-->

        <!--mini cart-->
        <div class="mini_cart">
            <div class="cart_close">
                <div class="cart_text">
                    <h3>cart</h3>
                </div>
                <div class="mini_cart_close">
                    <a href="javascript:void(0)"><i class="ion-android-close"></i></a>
                </div>
            </div>

            {{-- <div class="carholder"></div> --}}

            @php
                $vatPrice = 0;
                $vat_with_price= 0;
                $subtotal = 0;
                $value = session('cartArr');
            @endphp
            @if(!empty($value))
                @foreach ($value as $key => $item)
                {{-- {{$item['price']}} --}}
                @php
                    $vatPrice += $item['justVat'];
                    $vat_with_price += $item['vat_with_price'];
                    $subtotal += $item['price'];
                @endphp

            <div class="cart_item">
                <div class="cart_img">
                    <a href="javascript:;"><img src="{{asset('storage/product_images/'.$item['img'])}}" alt=""></a>
                </div>
                <div class="cart_info">
                    <a href="javascript:;">{{$item['description']}}</a>

                    <span class="quantity">Qty: {{$item['runtimeQnt']}}</span>
                    <span class="price_cart">{{$item['price']}} AED</span>

                </div>
                <div class="cart_remove">
                    <a href="/removeItem/{{$key}}"><i class="ion-android-close"></i></a>
                </div>
            </div>
                @endforeach
            @endif

            <div class="mini_cart_table">
                <div class="cart_total">
                    <span>VAT:</span>
                    <span class="price cartSubTotal">{{$vatPrice}} AED</span>
                </div>
                <div class="cart_total mt-10">
                    <span>Sub total:</span>
                    <span class="price cartSubTotal">{{$subtotal}} AED</span>
                </div>
                <div class="cart_total mt-10">
                    <span>total:</span>
                    <span class="price cartTotal">{{$vatPrice+$subtotal}} AED</span>
                </div>
            </div>
            <div class="mini_cart_footer">
                <div class="cart_button">
                    <a href="{{route('view_cart')}}">View cart</a>
                </div>
                <div class="cart_button">
                    <a class="active" href="{{route('check_out')}}">Checkout</a>
                </div>

            </div>

        </div>
        <!--mini cart end-->
    </header>
    <!--header area end-->


    @yield('content')



    <!--footer area start-->
    <footer class="footer_widgets">
        <div class="container">
            <div class="footer_top">
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="widgets_container contact_us">
                            <div class="footer_logo">

                            @if(!empty($general->toArray()) && is_array($general->toArray()))
                                @foreach ($general as $row_general)
                                    @php
                                        $logo_data = json_decode($row_general->logos,TRUE);
                                        foreach($logo_data as $row_logo){
                                            //dd($row_logo[1]);
                                            if($row_logo[1]){
                                                echo '<img src="'.asset('storage/company_logo_images/'.$row_logo[1]).'" alt="logo" style="height: 75px !important;">';
                                            }else{
                                                echo '<a href="javascript:;"><img src="'.asset('frontend/img/logo/khan-logo.png').'" alt="" style="height: 75px !important;"></a>';
                                            }
                                        }
                                    @endphp
                                @endforeach
                            @else
                                @php
                                    echo '<a href="javascript:;"><img src="'.asset('frontend/img/logo/khan-logo.png').'" alt="" style="height: 75px !important;"></a>';
                                @endphp
                            @endif

                            </div>
                            <div class="footer_contact">


                                {{-- <p> <strong> Our mission </strong> is to provide the challenging price, to satisfy the customers needs, to meet their demands and to provide the best service possible under a friendly atmosphere.</p> --}}
                                @php
                                    if(!empty($row_general)){
                                        $result = substr($row_general->company_intro, 0, 11);
                                        echo '<strong>'.$result.'</strong>';
                                        echo substr($row_general->company_intro, 11, 1000);
                                    }
                                @endphp

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6 col-sm-6">
                        <div class="widgets_container widget_menu">
                            <h3>Information</h3>
                            <div class="footer_menu">
                                <ul>
                                    <li><a href="javascript:;">About Us</a></li>
                                    <li><a href="javascript:;">Delivery Information</a></li>
                                    <li><a href="javascript:;">privacy policy</a></li>
                                    <li><a href="javascript:;">Coming Soon</a></li>
                                    <li><a href="javascript:;">Terms & Conditions</a></li>
                                    <li><a href="javascript:;">Returns</a></li>
                                    <li><a href="javascript:;">Gift Certificates</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6 col-sm-6">
                        <div class="widgets_container widget_menu">
                            <h3>Extras</h3>
                            <div class="footer_menu">
                                <ul>
                                    <li><a href="javascript:;">Returns</a></li>
                                    <li><a href="javascript:;">Order History</a></li>
                                    <li><a href="javascript:;">Wish List</a></li>
                                    <li><a href="javascript:;">Newsletter</a></li>
                                    <li><a href="javascript:;">Affiliate</a></li>
                                    <li><a href="javascript:;">Specials</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="widgets_container">
                            <div class="footer_contact">

                                @if(!empty($general->toArray()) && is_array($general->toArray()))
                                    @foreach ($general as $row_general)
                                        @php
                                            //dd($row_general);
                                            $address_data = json_decode($row_general->address_contact,TRUE);
                                            //dd($address_data['address'][0]);
                                            $address = $address_data['address'][0];
                                            $contact = $address_data['contact'][0];

                                            echo '<p><span>Address <small style="font-size:10px">( Head Office )</small></span>'.$address.' </p>';
                                            echo '<p><span>Need Help?</span>Call: <a href="tel:'.$contact.'"> '.$contact.' </a></p>';

                                        @endphp
                                    @endforeach
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer_bottom">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="copyright_area">
                            <p>Copyright &copy; <?php echo date("Y"); ?> <a href="javascript:;">KHANGROUP</a> All Right Reserved.</p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="footer_payment text-right">
                            <!-- <a href="javascript:;"><img src="../assets/img/icon/payment.png" alt=""></a> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!--footer area end-->

    <!-- JS
============================================ -->
    <!--jquery min js-->
    <script src="{{ asset('frontend/js/vendor/jquery-3.4.1.min.js') }}"></script>
    <!--popper min js-->
    <script src="{{ asset('frontend/js/popper.js') }}"></script>
    <!--bootstrap min js-->
    <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
    <!--owl carousel min js-->
    <script src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script>
    <!--slick min js-->
    <script src="{{ asset('frontend/js/slick.min.js') }}"></script>
    <!--magnific popup min js-->
    <script src="{{ asset('frontend/js/jquery.magnific-popup.min.js') }}"></script>
    <!--jquery countdown min js-->
    <script src="{{ asset('frontend/js/jquery.countdown.js') }}"></script>
    <!--jquery ui min js-->
    <script src="{{ asset('frontend/js/jquery.ui.js') }}"></script>
    <!--jquery elevatezoom min js-->
    <script src="{{ asset('frontend/js/jquery.elevatezoom.js') }}"></script>
    <!--isotope packaged min js-->
    <script src="{{ asset('frontend/js/isotope.pkgd.min.js') }}"></script>
    <!--slinky menu js-->
    <script src="{{ asset('frontend/js/slinky.menu.js') }}"></script>
    <!-- Plugins JS -->
    <script src="{{ asset('frontend/js/plugins.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('frontend/js/main.js') }}"></script>

    <!-- custom JS -->
    <script src="{{ asset('frontend/js/custom.js') }}"></script>



</body>

</html>
