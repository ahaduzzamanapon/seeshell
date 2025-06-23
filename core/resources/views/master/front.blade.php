<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    @if (url()->current() == route('front.index'))
        <title>@yield('hometitle')</title>
    @else
        <title>{{ $setting->title }} -@yield('title')</title>
    @endif

    <!-- SEO Meta Tags-->
    @if (url()->current() == route('front.index'))
        <meta name="author" content="GeniusDevs">
        <meta name="distribution" content="web">
        <meta name="description" content="{{ $setting->meta_description }}">
        <meta name="keywords" content="{{ $setting->meta_keywords }}">
        <meta name="image" content="{{ url('/core/public/storage/images/' . $setting->meta_image) }}">
        <meta property="og:title" content="{{ $setting->title }}">
        <meta property="og:description" content="{{ $setting->meta_description }}">
        <meta property="og:image" content="{{ url('/core/public/storage/images/' . $setting->meta_image) }}">
        <meta property="og:image:secure_url"
            content="{{ url('/core/public/storage/images/' . $setting->meta_image) }}" />
        <meta property="og:image:type" content="image/jpeg" />
        <meta property="og:image:width" content="1200" />
        <meta property="og:image:height" content="627" />
        <meta property="og:url" content="{{ url()->current() }}">
        <meta property="og:site_name" content="{{ $setting->title }}">
        <meta property="og:type" content="website">
    @else
        @yield('meta')
    @endif

    <!-- Mobile Specific Meta Tag-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <!-- Favicon Icons-->
    <link rel="icon" type="image/png" href="{{ url('/core/public/storage/images/' . $setting->favicon) }}">
    <link rel="apple-touch-icon" href="{{ url('/core/public/storage/images/' . $setting->favicon) }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ url('/core/public/storage/images/' . $setting->favicon) }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ url('/core/public/storage/images/' . $setting->favicon) }}">
    <link rel="apple-touch-icon" sizes="167x167" href="{{ url('/core/public/storage/images/' . $setting->favicon) }}">

    <!-- Vendor Styles including: Bootstrap, Font Icons, Plugins, etc.-->
    <link rel="stylesheet" media="screen" href="{{ asset('assets/front/css/plugins.min.css') }}">

    @yield('styleplugins')

    <link id="mainStyles" rel="stylesheet" media="screen" href="{{ asset('assets/front/css/styles.min.css') }}">

    <link id="mainStyles" rel="stylesheet" media="screen" href="{{ asset('assets/front/css/responsive.css') }}">
    <!-- Color css -->
    <link
        href="{{ asset('assets/front/css/color.php?primary_color=') . str_replace('#', '', $setting->primary_color) }}"
        rel="stylesheet">

    <!-- Modernizr-->
    <script src="{{ asset('assets/front/js/modernizr.min.js') }}"></script>

    @if (DB::table('languages')->where('is_default', 1)->first()->rtl == 1)
        <link rel="stylesheet" href="{{ asset('assets/front/css/rtl.css') }}">
    @endif
    <style>
        {{ $setting->custom_css }}
    </style>
    {{-- Google AdSense Start --}}
    @if ($setting->is_google_adsense == '1')
        {!! $setting->google_adsense !!}
    @endif
    {{-- Google AdSense End --}}

    {{-- Google AnalyTics Start --}}
    @if ($setting->is_google_analytics == '1')
        {!! $setting->google_analytics !!}
    @endif
    {{-- Google AnalyTics End --}}

    {{-- Facebook pixel  Start --}}
    @if ($setting->is_facebook_pixel == '1')
        {!! $setting->facebook_pixel !!}
    @endif
    {{-- Facebook pixel End --}}

</head>
<!-- Body-->

<body
    class="
@if ($setting->theme == 'theme1') body_theme1
@elseif($setting->theme == 'theme2')
body_theme2
@elseif($setting->theme == 'theme3')
body_theme3
@elseif($setting->theme == 'theme4')
body_theme4 @endif
">
    @if ($setting->is_loader == 1)
        <!-- Preloader Start -->
        @if ($setting->is_loader == 1)
            <div id="preloader">
                <img src="{{ url('/core/public/storage/images/' . $setting->loader) }}" alt="{{ __('Loading...') }}">
            </div>
        @endif

        <!-- Preloader endif -->
    @endif

    <!-- Header-->

    <header class="site-header navbar-sticky">
        <div class="menu-top-area">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="t-m-s-a">
                            <a class="track-order-link" href="{{ route('front.order.track') }}"><i
                                    class="icon-map-pin"></i>{{ __('Track Order') }}</a>
                            <a class="track-order-link compare-mobile d-lg-none"
                                href="{{ route('fornt.compare.index') }}">{{ __('Compare') }}</a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <style>
                            .verticalflip {
                                background-color: black;
                                color: white;
                                height: 25px;
                                overflow: hidden;
                                position: relative;
                            }

                            .verticalflip p {
                                /* height: 40px; */
                                line-height: 25px;
                                margin: 0;
                                text-align: center;
                                position: absolute;
                                width: 100%;
                                opacity: 0;
                                animation: verticalFlip 9s linear infinite;
                            }

                            .verticalflip p:nth-child(1) {
                                animation-delay: 0s;
                            }

                            .verticalflip p:nth-child(2) {
                                animation-delay: 3s;
                            }

                            .verticalflip p:nth-child(3) {
                                animation-delay: 6s;
                            }

                            @keyframes verticalFlip {
                                0% {
                                    opacity: 0;
                                    transform: translateY(100%);
                                }

                                10% {
                                    opacity: 1;
                                    transform: translateY(0);
                                }

                                30% {
                                    opacity: 1;
                                    transform: translateY(0);
                                }

                                40% {
                                    opacity: 0;
                                    transform: translateY(-100%);
                                }

                                100% {
                                    opacity: 0;
                                }
                            }
                        </style>

                        <div class="verticalflip">
                            <p>𝐅𝐫𝐞𝐞 𝐃𝐞𝐥𝐢𝐯𝐞𝐫𝐲 𝐨𝐧 𝐀𝐥𝐥 𝐏𝐫𝐨𝐝𝐮𝐜𝐭𝐬</p>
                            <p>𝐂𝐥𝐞𝐚𝐫𝐚𝐧𝐜𝐞 𝐒𝐚𝐥𝐞&nbsp;𝐨𝐟&nbsp;𝐭𝐡𝐞&nbsp;𝐒𝐞𝐚𝐬𝐨𝐧</p>
                            <p>𝐅𝐚𝐬𝐭𝐞𝐬𝐭 𝐃𝐞𝐥𝐢𝐯𝐞𝐫𝐲&nbsp;𝐅𝐫𝐨𝐦&nbsp;𝐖𝐚𝐫𝐞𝐡𝐨𝐮𝐬𝐞</p>
                        </div>

                    </div>
                    <div class="col-md-4">
                        <div class="right-area">
                            <div class="login-register ">
                                @if (!Auth::user())
                                    <a class="track-order-link mr-0" href="{{ route('user.login') }}">
                                        {{ __('Login') }}
                                    </a>
                                @else
                                    <div class="t-h-dropdown">
                                        <div class="main-link">
                                            <i class="icon-user pr-2"></i> <span
                                                class="text-label">{{ Auth::user()->first_name }}</span>
                                        </div>
                                        <div class="t-h-dropdown-menu">
                                            <a href="{{ route('user.dashboard') }}"><i
                                                    class="icon-chevron-right pr-2"></i>{{ __('Dashboard') }}</a>
                                            <a href="{{ route('user.logout') }}"><i
                                                    class="icon-chevron-right pr-2"></i>{{ __('Logout') }}</a>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Topbar-->
        <style>
            /* .sub-link:hover {
                color: black !important;
            } */
            .sub-link>a:hover {
                color: black !important;
            }


            .navbar {
                background-color: #fff;
                border-bottom: 1px solid #eee;
                padding: 16px 0;
            }


            .site-menu {
                display: flex;
                justify-content: center;
                width: 100%;
            }

            .main-menu {
                list-style: none;
                display: flex;
                gap: 40px;
                justify-content: center;
            }

            .main-menu>li>a {
                text-decoration: none;
                color: #222;
                font-weight: 600;
                font-size: 16px;
                padding: 10px;
                display: inline-block;
            }

            .menu-item.has-dropdown {
                position: relative;
            }

            .menu-link:hover {
                color: red !important;
            }

            .menu-item.has-dropdown:hover>.dropdown {
                display: flex;
                /* animation: fadeIn 1.3s ease-in-out; */
            }

            .dropdown {
                position: fixed;
                top: 120px;
                left: 50%;
                transform: translateX(-50%);
                width: 1000px;
                background: #ffffff;
                box-shadow: 0 12px 40px rgba(0, 0, 0, 0.1);
                padding: 30px 40px;
                z-index: 1000;

                opacity: 0;
                visibility: hidden;
                transition: opacity 0.4s ease, visibility 0.4s ease;
                pointer-events: none;
            }
            .menu-item.has-dropdown:hover > .dropdown {
    opacity: 1;
    visibility: visible;
    pointer-events: auto;
}


            /*
.dropdown {
    opacity: 0;
    pointer-events: none;
    transition: opacity 0.3s ease;
}

.menu-item.has-dropdown:hover > .dropdown {
    display: block;
    opacity: 1;
    pointer-events: auto;
} */

            .dropdown-inner {
                display: flex;
                justify-content: space-between;
                gap: 20px;
                flex-wrap: wrap;
            }

            /* Grid Area */
            .dropdown-grid {
                display: grid;
                grid-template-columns: repeat(3, 1fr);
                gap: 30px;
                flex: 1;
            }

            .dropdown-col h4 {
                font-size: 16px;
                font-weight: 600;
                color: #3819e7;
                margin-bottom: 10px;
            }

            .dropdown-col ul {
                list-style: none;
            }

            .dropdown-col li {
                margin-bottom: 8px;
            }

            .dropdown-col a {
                text-decoration: none;
                color: #333;
                font-weight: 500;
                transition: all 0.2s ease-in-out;
            }

            .dropdown-col a:hover {
                color: #3819e7;
            }

            /* Right Side Image */
            .dropdown-image {
                width: 300px;
                flex-shrink: 0;
            }

            .dropdown-image img {
                width: 100%;
                height: auto;
                border-radius: 10px;
                object-fit: cover;
            }


            /* Black & White Anchor Styling */
            .dropdown_link_style {
                font-size: 18px;
                color: #333;
                /* Dark gray text */
                font-family: inherit;
                font-weight: 800;
                cursor: pointer;
                position: relative;
                border: none;
                background: none;
                text-transform: uppercase;
                text-decoration: none;
                transition: color 400ms cubic-bezier(0.25, 0.8, 0.25, 1);
            }

            .dropdown_link_style:focus,
            .dropdown_link_style:hover {
                color: #000;
                /* Pure black on hover */
            }

            .dropdown_link_style:after {
                content: "";
                pointer-events: none;
                bottom: -2px;
                left: 50%;
                position: absolute;
                width: 0%;
                height: 2px;
                background-color: #000;
                /* Black underline */
                transition: width 400ms cubic-bezier(0.25, 0.8, 0.25, 1), left 400ms cubic-bezier(0.25, 0.8, 0.25, 1);
            }

            .dropdown_link_style:focus:after,
            .dropdown_link_style:hover:after {
                width: 100%;
                left: 0%;
            }


            /* Animation */
            @keyframes fadeIn {
                from {
                    opacity: 0;
                    transform: translateY(10px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
        </style>
        <div class="topbar">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="d-flex justify-content-between">
                            <!-- Logo-->
                            <div class="site-branding"><a class="site-logo align-self-center"
                                    href="{{ route('front.index') }}"><img
                                        src="{{ url('/core/public/storage/images/' . $setting->logo) }}"
                                        alt="{{ $setting->title }}"></a></div>
                            <!-- Search / Categories-->
                            <div class="hidden-on-mobile" style="align-content: center;">
                                <ul class="main-menu" style="margin-bottom: 0;">
                                    @php
                                        $categories = App\Models\Category::with([
                                            'subcategory.childcategory', // Nested eager loading
                                        ])
                                            ->where('status', 1)
                                            ->orderBy('serial', 'asc')
                                            ->get();
                                    @endphp


                                    @foreach ($categories as $category)
                                        <li class="menu-item has-dropdown">
                                            <a class="dropdown_link_style"
                                                href="{{ route('front.catalog') . '?category=' . $category->slug }}"
                                                style="font-size: 17px;font-weight: bolder;"><span class="menu-link"
                                                    style="text-transform: uppercase;">{{ $category->name }}</span></a>




                                            <div class="dropdown">
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="col-lg-8 col-md-7">
                                                            <div class="dropdown-grid">

                                                                <ul
                                                                    style="list-style: none">
                                                                    @php
                                                                        $i = 0;
                                                                    @endphp

                                                                    @foreach ($category->subcategory as $subcategory)
                                                                        @if ($i > 7)
                                                                            @php
                                                                                $i = 0;
                                                                            @endphp
                                                                </ul>
                                                                <ul
                                                                    style="list-style: none;border-left: 1px solid #e5e5e5;">
                                    @endif
                                    @php
                                        $i++;
                                    @endphp
                                    <li>
                                        <a href="{{ route('front.catalog') . '?subcategory=' . $subcategory->slug }}"
                                            style="color: Black!important;font-size: 1.2rem;font-weight: 500;font-family: 'futura-pt';text-transform: uppercase;">{{ $subcategory->name }}</a>
                                    </li>
                                    @foreach ($subcategory->childcategory as $childcategory)
                                        @if ($i > 7)
                                            @php
                                                $i = 0;
                                            @endphp
                                </ul>
                                <ul style="list-style: none;border-left: 1px solid #e5e5e5;">
                                    @endif
                                    @php
                                        $i++;
                                    @endphp
                                    <li class="sub-link">
                                        <a style="color: gray;font-size: 1rem;font-family: 'futura-pt';"
                                            href="{{ route('front.catalog') . '?childcategory=' . $childcategory->slug }}">
                                            {{ $childcategory->name }}
                                        </a>
                                    </li>
                                    @endforeach
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-5">
                            <!-- Right Image -->
                            <div class="dropdown-image">
                                <img src="{{ $category->photo ? url('/core/public/storage/images/' . $category->photo) : url('/core/public/storage/images/placeholder.png') }}"
                                    alt="{{ $category->name }} Image">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </li>
            @endforeach
            </ul>
        </div>

        <!-- Toolbar-->
        <div class="toolbar d-flex">

            <div class="toolbar-item close-m-serch" id="search_btn">
                <a href="#">
                    <div>
                        <i class="icon-search"></i>
                    </div>
                </a>
            </div>
            <div class="toolbar-item visible-on-mobile mobile-menu-toggle"><a href="#">
                    <div><i class="icon-menu"></i><span class="text-label">{{ __('Menu') }}</span></div>
                </a>
            </div>


            @if (Auth::check())
                <div class="toolbar-item hidden-on-mobile"><a href="{{ route('user.wishlist.index') }}">
                        <div><span class="compare-icon"><i class="icon-heart"></i><span
                                    class="count-label wishlist_count">{{ Auth::user()->wishlists->count() }}</span></span><span
                                class="text-label">{{ __('Wishlist') }}</span></div>
                    </a>
                </div>
            @else
                <div class="toolbar-item hidden-on-mobile"><a href="{{ route('user.wishlist.index') }}">
                        <div><span class="compare-icon"><i class="icon-heart"></i></span><span
                                class="text-label">{{ __('Wishlist') }}</span></div>
                    </a>
                </div>
            @endif
            <div class="toolbar-item"><a href="{{ route('front.cart') }}">
                    <div><span class="cart-icon"><i class="icon-shopping-cart"></i><span
                                class="count-label cart_count">{{ Session::has('cart') ? count(Session::get('cart')) : '0' }}
                            </span></span><span class="text-label">{{ __('Cart') }}</span>
                    </div>
                </a>
                <div class="toolbar-dropdown cart-dropdown widget-cart  cart_view_header" id="header_cart_load"
                    data-target="{{ route('front.header.cart') }}">
                    @include('includes.header_cart')
                </div>
            </div>
        </div>

        <!-- Mobile Menu-->
        <div class="mobile-menu">
            <!-- Slideable (Mobile) Menu-->
            <div class="mm-heading-area">
                <h4>{{ __('Navigation') }}</h4>
                <div class="toolbar-item visible-on-mobile mobile-menu-toggle mm-t-two">
                    <a href="#">
                        <div> <i class="icon-x"></i></div>
                    </a>
                </div>
            </div>
            <ul class="nav nav-tabs" role="tablist">
                {{-- <li class="nav-item" role="presentation99">
                                        <span class="active" id="mmenu-tab" data-bs-toggle="tab"
                                            data-bs-target="#mmenu" role="tab" aria-controls="mmenu"
                                            aria-selected="true">{{ __('Menu') }}</span>
                                    </li> --}}
                <li class="nav-item" role="presentation99">
                    <span class="" id="mcat-tab" data-bs-toggle="tab" data-bs-target="#mcat" role="tab"
                        aria-controls="mcat" aria-selected="false">{{ __('Category') }}</span>
                </li>

            </ul>
            <div class="tab-content p-0">
                <div class="tab-pane fade " id="mmenu" role="tabpanel" aria-labelledby="mmenu-tab">
                    <nav class="slideable-menu">
                        <ul>

                    </nav>
                </div>
                <div class="tab-pane fade show active" id="mcat" role="tabpanel" aria-labelledby="mcat-tab">
                    <nav class="slideable-menu">
                        @include('includes.mobile-category')
                    </nav>
                </div>
            </div>
        </div>
        </div>
        </div>
        </div>
        </div>
        </div>


        <style>
            @media (max-width: 991px) {
                .m_navbar {
                    display: block !important;
                }
            }
        </style>


        <div class="navbar d-none m_navbar" style="position: absolute;">
            <div class="container">
                <nav class="site-menu" style="place-items: center;padding: 10px;">
                    <form class="input-group" style="width: 50%;" id="header_search_form"
                        action="{{ route('front.catalog') }}" method="get">
                        <input type="hidden" name="category" value="" id="search__category">
                        <span class="input-group-btn">
                            <button type="submit"><i class="icon-search"></i></button>
                        </span>
                        <input class="form-control" type="text" data-target="{{ route('front.search.suggest') }}"
                            id="__product__search" name="search" placeholder="{{ __('Search by product name') }}">
                        <div class="serch-result d-none">
                        </div>
                    </form>
                </nav>
            </div>
        </div>












    </header>
    <!-- Page Content-->
    @yield('content')

    <!--    announcement banner section start   -->
    <a class="announcement-banner" href="#announcement-modal"></a>
    <div id="announcement-modal" class="mfp-hide white-popup">
        @if ($setting->announcement_type == 'newletter')
            <div class="announcement-with-content">
                <div class="left-area">
                    <img src="{{ url('/core/public/storage/images/' . $setting->announcement) }}" alt="">
                </div>
                <div class="right-area">
                    <h3 class="">{{ $setting->announcement_title }}</h3>
                    <p>{{ $setting->announcement_details }}</p>
                    <form class="subscriber-form" action="{{ route('front.subscriber.submit') }}" method="post">
                        @csrf
                        <div class="input-group">
                            <input class="form-control" type="email" name="email"
                                placeholder="{{ __('Your e-mail') }}">
                            <span class="input-group-addon"><i class="icon-mail"></i></span>
                        </div>
                        <div aria-hidden="true">
                            <input type="hidden" name="b_c7103e2c981361a6639545bd5_1194bb7544" tabindex="-1">
                        </div>

                        <button class="btn btn-primary btn-block mt-2" type="submit">
                            <span>{{ __('Subscribe') }}</span>
                        </button>
                    </form>
                </div>
            </div>
        @else
            <a href="{{ $setting->announcement_link }}">
                <img src="{{ url('/core/public/storage/images/' . $setting->announcement) }}" alt="">
            </a>
        @endif


    </div>
    <!--    announcement banner section end   -->

    <!-- Site Footer-->
    <footer class="site-footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <!-- Contact Info-->
                    <section class="widget widget-light-skin">
                        <h3 class="widget-title">{{ __('Get In Touch') }}</h3>
                        <p class="mb-1"><strong>{{ __('Address') }}: </strong> {{ $setting->footer_address }}</p>
                        <p class="mb-1"><strong>{{ __('Phone') }}: </strong> {{ $setting->footer_phone }}</p>
                        <p class="mb-1"><strong>{{ __('Email') }}: </strong> {{ $setting->footer_email }}</p>
                        <ul class="list-unstyled text-sm">
                            <li><span class=""><strong>{{ $setting->working_days_from_to }}:
                                    </strong></span>{{ $setting->friday_start }} - {{ $setting->friday_end }}</li>
                        </ul>
                        @php
                            $links = json_decode($setting->social_link, true)['links'];
                            $icons = json_decode($setting->social_link, true)['icons'];

                        @endphp
                        <div class="footer-social-links">
                            @foreach ($links as $link_key => $link)
                                <a href="{{ $link }}"><span><i
                                            class="{{ $icons[$link_key] }}"></i></span></a>
                            @endforeach
                        </div>
                    </section>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <!-- Customer Info-->
                    <div class="widget widget-links widget-light-skin">
                        <h3 class="widget-title">{{ __('Usefull Links') }}</h3>
                        <ul>
                            @if ($setting->is_faq == 1)
                                <li>
                                    <a class="" href="{{ route('front.faq') }}">{{ __('Faq') }}</a>
                                </li>
                            @endif
                            @foreach (DB::table('pages')->wherePos(2)->orwhere('pos', 1)->get() as $page)
                                <li><a href="{{ route('front.page', $page->slug) }}">{{ $page->title }}</a></li>
                            @endforeach

                        </ul>
                    </div>
                </div>
                <div class="col-lg-4">
                    <!-- Subscription-->
                    <section class="widget">
                        <h3 class="widget-title">{{ __('Newsletter') }}</h3>
                        <form class="row subscriber-form" action="{{ route('front.subscriber.submit') }}"
                            method="post">
                            @csrf
                            <div class="col-sm-12">
                                <div class="input-group">
                                    <input class="form-control" type="email" name="email"
                                        placeholder="{{ __('Your e-mail') }}">
                                    <span class="input-group-addon"><i class="icon-mail"></i></span>
                                </div>
                                <div aria-hidden="true">
                                    <input type="hidden" name="b_c7103e2c981361a6639545bd5_1194bb7544"
                                        tabindex="-1">
                                </div>

                            </div>
                            <div class="col-sm-12">
                                <button class="btn btn-primary btn-block mt-2" type="submit">
                                    <span>{{ __('Subscribe') }}</span>
                                </button>
                            </div>
                            <div class="col-lg-12">
                                <p class="text-sm opacity-80 pt-2">
                                    {{ __('Subscribe to our Newsletter to receive early discount offers, latest news, sales and promo information.') }}
                                </p>
                            </div>
                        </form>
                        <div class="pt-3"><img class="d-block gateway_image"
                                src="{{ $setting->footer_gateway_img ? url('/core/public/storage/images/' . $setting->footer_gateway_img) : asset('system/resources/assets/images/placeholder.png') }}">
                        </div>
                    </section>
                </div>
            </div>
            <!-- Copyright-->
            <p class="footer-copyright"> {{ $setting->copy_right }}</p>
        </div>
    </footer>

    <!-- Back To Top Button-->
    <a class="scroll-to-top-btn" href="#">
        <i class="icon-chevron-up"></i>
    </a>
    <!-- Backdrop-->
    <div class="site-backdrop"></div>

    <!-- Cookie alert dialog  -->
    @if ($setting->is_cookie == 1)
        @include('cookie-consent::index')
    @endif
    <!-- Cookie alert dialog  -->


    @php
        $mainbs = [];
        $mainbs['is_announcement'] = $setting->is_announcement;
        $mainbs['announcement_delay'] = $setting->announcement_delay;
        $mainbs['overlay'] = $setting->overlay;
        $mainbs = json_encode($mainbs);
    @endphp

    <script>
        var mainbs = {!! $mainbs !!};
        var decimal_separator = '{!! $setting->decimal_separator !!}';
        var thousand_separator = '{!! $setting->thousand_separator !!}';
    </script>

    <script>
        let language = {
            Days: '{{ __('Days') }}',
            Hrs: '{{ __('Hrs') }}',
            Min: '{{ __('Min') }}',
            Sec: '{{ __('Sec') }}',
        }
    </script>



    <!-- JavaScript (jQuery) libraries, plugins and custom scripts-->
    <script type="text/javascript" src="{{ asset('assets/front/js/plugins.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/back/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}">
    </script>
    <script type="text/javascript" src="{{ asset('assets/front/js/scripts.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/front/js/lazy.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/front/js/lazy.plugin.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/front/js/myscript.js') }}"></script>
    @yield('script')

    @if ($setting->is_facebook_messenger == '1')
        <!-- Messenger Chat Plugin Code -->
        <div id="fb-root"></div>

        <!-- Your Chat Plugin code -->
        <div id="fb-customer-chat" class="fb-customerchat">
        </div>

        <script>
            var chatbox = document.getElementById('fb-customer-chat');
            chatbox.setAttribute("page_id", "{{ $setting->facebook_messenger }}");
            chatbox.setAttribute("attribution", "biz_inbox");
            window.fbAsyncInit = function() {
                FB.init({
                    xfbml: true,
                    version: 'v11.0'
                });
            };

            (function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) return;
                js = d.createElement(s);
                js.id = id;
                js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
        </script>
    @endif



    <script type="text/javascript">
        let mainurl = '{{ route('front.index') }}';

        let view_extra_index = 0;
        // Notifications
        function SuccessNotification(title) {
            $.notify({
                title: ` <strong>${title}</strong>`,
                message: '',
                icon: 'fas fa-check-circle'
            }, {
                element: 'body',
                position: null,
                type: "success",
                allow_dismiss: true,
                newest_on_top: false,
                showProgressbar: false,
                placement: {
                    from: "top",
                    align: "right"
                },
                offset: 20,
                spacing: 10,
                z_index: 1031,
                delay: 5000,
                timer: 1000,
                url_target: '_blank',
                mouse_over: null,
                animate: {
                    enter: 'animated fadeInDown',
                    exit: 'animated fadeOutUp'
                },
                onShow: null,
                onShown: null,
                onClose: null,
                onClosed: null,
                icon_type: 'class'
            });
        }

        function DangerNotification(title) {
            $.notify({
                // options
                title: ` <strong>${title}</strong>`,
                message: '',
                icon: 'fas fa-exclamation-triangle'
            }, {
                // settings
                element: 'body',
                position: null,
                type: "danger",
                allow_dismiss: true,
                newest_on_top: false,
                showProgressbar: false,
                placement: {
                    from: "top",
                    align: "right"
                },
                offset: 20,
                spacing: 10,
                z_index: 1031,
                delay: 5000,
                timer: 1000,
                url_target: '_blank',
                mouse_over: null,
                animate: {
                    enter: 'animated fadeInDown',
                    exit: 'animated fadeOutUp'
                },
                onShow: null,
                onShown: null,
                onClose: null,
                onClosed: null,
                icon_type: 'class'
            });
        }
        // Notifications Ends
    </script>

    @if (Session::has('error'))
        <script>
            $(document).ready(function() {
                DangerNotification('{{ Session::get('error') }}')
            })
        </script>
    @endif
    @if (Session::has('success'))
        <script>
            $(document).ready(function() {
                SuccessNotification('{{ Session::get('success') }}');
            })
        </script>
    @endif
    @yield('footer_scripts')

    <script>
        $(document).ready(function() {
            $('.navbar').toggleClass('m_navbar');

            $('#search_btn').click(function() {
                $('.navbar').toggleClass('d-none');
                $('.navbar').toggleClass('m_navbar');
                $('#__product__search').focus();
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('.product-thumb').find('img').click(function() {
                var $productCard = $(this).closest('.product-card');
                
                var $productTitleAnchor = $productCard.find('.product-title a');
                console.log($productTitleAnchor.attr('href'));
                
                window.location.href = $productTitleAnchor.attr('href');
                
                // window.location.href = $(this).closest('.product-title').find('a').attr('href');
            });
        });
    </script>



</body>

</html>
