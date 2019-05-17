<!DOCTYPE html>
<html lang="vi">
<head>
  <!-- Basic page needs -->
  <meta charset="utf-8">
<!--[if IE]>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<![endif]-->
<meta http-equiv="x-ua-compatible" content="ie=edge">
<meta name="description" content="{{ $description }}">
<meta name="keyword" content="{{ $keyword }}">
<meta property="fb:app_id" content="{{ $configs['site_fb_appID'] }}" />
<title>{{ $title }}</title>
<meta property="og:image" content="{{ !empty($og_image)?$og_image:asset('images/org.jpg') }}" />
<meta property="og:url" content="{{ \Request::fullUrl() }}" />
<meta property="og:type" content="Website" />
<meta property="og:title" content="{{ $title }}" />
<meta property="og:description" content="{{ $description }}" />
<!-- Mobile specific metas  -->
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Favicons Icon -->
<link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
<link rel="stylesheet" href="{{ asset($theme_asset.'/style.css')}}" media="all" />
@stack('styles')
<link rel="stylesheet" href="{{ asset('css/app.css') }}" type="text/css">
</head>
<body>
  <!--2019 NHAN update not Load Facebook SDK for JavaScript -->
<!-- <div id="fb-root"></div>
<script>
  (function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = '//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.8&appId={{ $configs['site_fb_appID'] }}';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script> -->
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->

<!-- mobile menu -->
<div id="mobile-menu">
  <ul>
    @foreach ($categories as $category)
    <li><a href="{{ url('shop/'.ktc_str_convert($category->name).'_'.$category->id.'.html') }}">{{ $category->name }}</a>
      @if (count($category->getChildrens($category->id))>0)
      <ul>
        @foreach ($category->getChildrens($category->id) as $cateChild)
        <li>
          <a href="{{ url('shop/'.ktc_str_convert($cateChild->name).'_'.$cateChild->id.'.html') }}">{{ $cateChild->name }}</a>
        </li>
        @endforeach
      </ul>
      @endif
    </li>
    <!-- /.div -->
    @endforeach
  </ul>
</div>
<!-- end mobile menu -->
<div id="page">
  <!-- Header -->
  <header>
    <div class="header-container">
      <div class="header-top">
        <div class="container">
          <div class="row">
            <!-- top links -->
            <div class="headerlinkmenu col-md-8 col-sm-8 col-xs-12"> <span class="phone  hidden-xs hidden-sm">Hotline: {{ $configs['site_phone'] }}</span>
              <ul class="links">
               @guest
               <li>
                <a class="login" href="{{ url('login.html') }}" rel="nofollow" title="Đăng nhập tài khoản">
                  Đăng nhập
                </a>
              </li>
              @else
              <li>
                <a class="login" href="{{ route('logout') }}" rel="nofollow" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                Đăng xuất
              </a>
            </li>
            <li>
              <a href="{{ url('profile.html') }}" title="Trang quản lý" rel="nofollow"><i class="fa fa-user left"></i> Chào {{ Auth::user()->name }}</a>
            </li>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              {{ csrf_field() }}
            </form>
            @endguest
          </ul>
        </div>
      </div>
    </div>
  </div>
  <!-- header inner -->
  <div class="header-inner">
    <div class="container">
      <div class="row">
        <div class="col-sm-3 col-xs-12 jtv-logo-block">
          <!-- Header Logo -->
          <div class="logo"><a title="e-commerce" href="{{ url('/') }}"><img alt="Ecommerce-laravel2019" title="Ecommerce-laravel2019" src="{{ asset('documents/website') }}/{{ $logo->image }}" style="max-height: 90px;"></a> </div>
        </div>
        <div class="col-xs-12 col-sm-5 col-md-6 jtv-top-search">
          <!-- Search -->
          <div class="top-search">
            <div id="search">
              <form id="searchbox" method="get" action="{{ url('tim-kiem.html') }}" >
                <div class="input-group">
                  <input type="text" class="form-control" placeholder="Tìm kiếm sản phẩm" name="keyword">
                  <button class="btn-search" type="submit" ><i class="fa fa-search"></i></button>
                </div>
              </form>
            </div>
          </div>
          <!-- End Search -->
        </div>
      </div>
    </div>
  </div>
</div>
</header>
<!-- end header -->
<nav class="navbar navbar-fixed-top nav-header-top">
  <div class="container">
    <div class="row">
      <div class="mm-toggle-wrap">
        <div class="mm-toggle"><i class="fa fa-align-justify"></i> </div>
        <span class="mm-label">Danh mục sản phẩm</span>
      </div>
      <div class="col-md-3 col-sm-3 mega-container hidden-xs">
        <div class="navleft-container">
          <div class="mega-menu-title">
            <h3><span>Danh mục sản phẩm</span></h3>
          </div>

          <div class="mega-menu-category" style="display: none !important;">
            <!-- Shop by category -->
            <ul class="nav">
              @foreach ($categories as $category)
              <li><a href="{{ url('shop/'.ktc_str_convert($category->name).'_'.$category->id.'.html') }}">{{ $category->name }}</a>
                @if (count($category->getChildrens($category->id))>0)
                <div class="wrap-popup column1">
                  <div class="popup">
                    <ul class="nav">
                      @foreach ($category->getChildrens($category->id) as $cateChild)
                      <li>
                        <a href="{{ url('shop/'.ktc_str_convert($cateChild->name).'_'.$cateChild->id.'.html') }}">{{ $cateChild->name }}</a>
                      </li>
                      @endforeach
                    </ul>
                  </div>
                </div>
                @endif
              </li>
              <!-- /.div -->
              @endforeach
            </ul>
          </div>
        </div>
      </div>
      <div class="col-md-9 col-sm-9 jtv-megamenu">
        <div class="mtmegamenu">
          <ul class="hidden-xs">
            <li class="mt-root demo_custom_link_cms">
              <div class="mt-root-item"><a href="{{ url('/') }}">
                <div class="title title_font"><span class="title-text">Home</span></div>
              </a></div>
            {{-- </li> --}}
            <li class="mt-root">
              <div class="mt-root-item"><a href="{{ url('san-pham.html') }}">
                <div class="title title_font"><span class="title-text">Tất cả sản phẩm</span></div>
              </a></div>
            </li>
            <li class="mt-root">
              <div class="mt-root-item"><a href="{{ url('gioi-thieu.html') }}">
                <div class="title title_font"><span class="title-text">Giới thiệu</span></div>
              </a></div>
            </li>
           <!--  <li class="mt-root demo_custom_link_cms">
              <div class="mt-root-item"><a href="{{ url('blogs.html') }}">
                <div class="title title_font"><span class="title-text">Blog</span></div>
              </a></div>
            </li> -->
            <li class="mt-root demo_custom_link_cms">
              <div class="mt-root-item">
                <a href="{{ url('lien-he.html') }}">
                  <div class="title title_font">
                    <span class="title-text">Liên hệ
                    </span>
                  </div>
                </a>
              </div>
            </li>
            <!-- Nhan update design top cart & checkout -->
            <li class="mt-root demo_custom_link_cms">
              <!-- view like -->
              <div class="mt-root-item top-cart">
                <div class="cart-icon">
                  <span class="wishlist shopping-wishlist" id="count_wishlist">{{ Cart::instance('wishlist')->count() }}</span>
                </div>
                <div class="link-wishlist">
                  <a href="{{ url('wishlist.html') }}"> <i class="icon-heart icons" data-toggle="tooltip" title="Wishlist"></i>
                  </a>
                </div>
              </div>
              <div class="mt-root-item top-cart">
                <!-- Show list top cart contain hover,click event  -->
                <div class="top-cart-contain">
                  <!-- view cart -->
                  <div class="mini-cart">
                    <div data-toggle="dropdown" data-hover="dropdown" class="basket dropdown-toggle"> <a href="{{ url('gio-hang.html') }}">
                      <div class="cart-icon" data-toggle="tooltip" title="My cart">
                        <i class="icon-basket-loaded icons"></i>
                        <span class="cart-total shopping-cart" id="count_cart">{{ Cart::instance('default')->count() }}
                        </span>
                      </div>
                    </a>
                  </div>
                  <!-- Show list cart -->
                  <div>
                    @php
                    $cart      = Cart::content();
                    @endphp
                    <div class="top-cart-content">
                      <div class="block-subtitle hidden">Recently added items</div>
                      <ul id="cart-sidebar" class="mini-products-list">
                        @if (count($cart) ==0)
                        <div style="text-align: center;">Giỏ hàng trống</div>
                        @else
                        @foreach($cart as $item)
                        @php
                        $product = App\Models\ShopProduct::find($item->id);
                        @endphp
                        <li class="item odd"> <a href="{{ url('san-pham/'.ktc_str_convert($item->name).'_'.$item->id.'.html') }}" title="{{ $item->name }}" class="product-image"><img src="{{ asset('documents/website/'.$product->image) }}" alt="{{ $item->name }}" width="65"></a>
                          <div class="product-details"> <a href="{{url("removeItem/$item->rowId")}}" title="Xóa" class="remove-cart"><i class="pe-7s-trash"></i></a>
                            <p class="product-name"><a href="{{ url('san-pham/'.ktc_str_convert($item->name).'_'.$item->id.'.html') }}">{{ $item->name }}</a> </p>
                            <strong>{{ $item->qty }}</strong> x <span class="price">{{ number_format($item->price) }}</span> </div>
                          </li>
                          @endforeach
                          @endif
                        </ul>
                        @if (count($cart) == 0)
                        @php
                        $style="display:none;";
                        @endphp
                        @else
                        @php
                        $style="display:block;";
                        @endphp
                        @endif
                        <div class="top-subtotal" style="{{ $style }}">Subtotal: <span class="price subtotal">{{ number_format(Cart::subtotal()) }} {!! config('lfm.unit_price') !!}</span></div>
                        <div class="actions" style="{{ $style }}">
                          <button class="btn-checkout" type="button" onClick="location.href='{{ url('gio-hang.html') }}'"><i class="fa fa-check"></i><span>Checkout</span></button>
                          <button class="view-cart" type="button" onClick="location.href='{{ url('gio-hang.html') }}'"><i class="fa fa-shopping-cart"></i><span>View Cart</span>
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- End show list top cart contain hover,click event  -->
              </div>

              <div class="mt-root-item top-cart">
                <a class="login" href="{{ url('login.html') }}" rel="nofollow" title="Đăng nhập tài khoản">
                  Đăng nhập
                </a>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</nav>

@if(Session::has('message'))
<div class="alert alert-success">{!! Session::get('message') !!}</div>
@endif
@if(Session::has('error'))
<div class="alert alert-danger">{!! Session::get('error') !!}</div>
@endif

@if ($configs['site_status'])
@yield('banner')
@yield('notice')
@yield('breadcrumb')
@yield('content')
@else
<div id="columns" class="container"  style="color:red;text-align: center;">
  <img src="{{ asset('images/maintenance.png') }}"><br>
  <h3><i class="fas fa-exclamation"></i>Xin lỗi, website đang bảo trì!</h3>
  <!-- /.col -->
</div>
@endif

<!-- service section -->
{{--   <div class="jtv-service-area">
  <div class="container">
    <div class="row">
      <div class="col col-md-3 col-sm-6 col-xs-12">
        <div class="block-wrapper ship">
          <div class="text-des">
            <div class="icon-wrapper"><i class="fa fa-paper-plane"></i></div>
            <div class="service-wrapper">
              <h3>World-Wide Shipping</h3>
              <p>On order over $99</p>
            </div>
          </div>
        </div>
      </div>
      <div class="col col-md-3 col-sm-6 col-xs-12 ">
        <div class="block-wrapper return">
          <div class="text-des">
            <div class="icon-wrapper"><i class="fa fa-rotate-right"></i></div>
            <div class="service-wrapper">
              <h3>30 Days Return</h3>
              <p>Moneyback guarantee </p>
            </div>
          </div>
        </div>
      </div>
      <div class="col col-md-3 col-sm-6 col-xs-12">
        <div class="block-wrapper support">
          <div class="text-des">
            <div class="icon-wrapper"><i class="fa fa-umbrella"></i></div>
            <div class="service-wrapper">
             <h3>Support {!! config('lfm.email_contact') !!}</h3>
             <p>Liên hệ: {{ $configs['site_phone'] }}</p>
           </div>
         </div>
       </div>
     </div>
     <div class="col col-md-3 col-sm-6 col-xs-12">
      <div class="block-wrapper user">
        <div class="text-des">
          <div class="icon-wrapper"><i class="fa fa-tags"></i></div>
          <div class="service-wrapper">
            <h3>Member Discount</h3>
            <p>25% on order over $199</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div> --}}

<!-- Footer -->
<footer>
  <div class="container">
    <div class="row">
      <div class="col-sm-6 col-md-4 col-xs-12">
        <div class="footer-logo"><a href="{{ url('/') }}"><img src="{{ asset('documents/website') }}/{{ $logo->image }}" alt="fotter logo"></a> </div>
      </div>

      <div class="col-sm-3 col-md-4 col-xs-12 collapsed-block">
        <div class="footer-links">
          <h3 class="links-title">LIÊN HỆ CHÚNG TÔI<a class="expander visible-xs" href="#TabBlock-4">+</a></h3>
          <div class="tabBlock" id="TabBlock-4">
            <div class="fb-page" data-href="https://www.facebook.com/nhannit.84" data-tabs="timeline" data-width="500" data-height="200" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/nhannit.84"><a href="https://www.facebook.com/nhannit.84">Ecommerce-laravel2019</a></blockquote></div></div>
          </div>
        </div>
      </div>
      <div class="col-sm-3 col-md-4 col-xs-12 collapsed-block">
        <div class="footer-links">
          <h3 class="links-title">Thông tin về {{ $configs['site_title'] }}<a class="expander visible-xs" href="#TabBlock-5">+</a></h3>
          <div class="tabBlock" id="TabBlock-5">
            <div class="footer-description"><b>Địa chỉ:</b> {{ $configs['site_address'] }}</div>
            <div class="footer-description"> <b>SDT:</b> {{ $configs['site_phone_long'] }}<br>
              <b>Email:</b> {{ $configs['site_email'] }}<br>
            </div>
          </div>
          <div class="fb-like" data-href="{{ url('/') }}" data-layout="button_count" data-action="like" data-size="large" data-show-faces="true" data-share="true"></div>
        </div>
      </div>
    </div>
  </div>
  <div class="footer-coppyright">
    <div class="container">
      <div class="row">
        <div class="col-sm-6 col-xs-12 coppyright"> Copyright © 2019 <a href="#"> nhanitk14dev@gmail.com </a>. All Rights Reserved. </div>
        <div class="col-sm-6 col-xs-12">
          <ul class="footer-company-links">
            <li> <a href="https://www.facebook.com/nhannit.84">Ecommerce-laravel 2019</a> - website laravel ecommercy </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</footer>
<a href="#" id="back-to-top" title="Back to top"><i class="fa fa-angle-up"></i></a>
<!-- <div class="phonering-alo-phone phonering-alo-green phonering-alo-show" id="phonering-alo-phoneIcon">
  <div class="phonering-alo-ph-circle"></div>
  <div class="phonering-alo-ph-circle-fill"></div>
  <a href="tel:{{ $configs['site_phone'] }}" class="pps-btn-img" title="Liên hệ">
   <div class="phonering-alo-ph-img-circle"></div> -->
 </a>
</div>

<!-- JS -->
<!-- jquery js -->
<script type="text/javascript" src="{{ asset($theme_asset.'/js/jquery.min.js')}}"></script>
<!-- bootstrap js -->
<script type="text/javascript" src="{{ asset($theme_asset.'/js/bootstrap.min.js')}}"></script>
<!-- owl.carousel.min js -->
<script type="text/javascript" src="{{ asset($theme_asset.'/js/owl.carousel.min.js')}}"></script>
<!-- jquery.mobile-menu js -->
<script type="text/javascript" src="{{ asset($theme_asset.'/js/mobile-menu.js')}}"></script>
<!--jquery-ui.min js -->
<script type="text/javascript" src="{{ asset($theme_asset.'/js/jquery-ui.js')}}"></script>
<!-- main js -->
<script type="text/javascript" src="{{ asset($theme_asset.'/js/main.js')}}"></script>
<!-- countdown js -->
<script type="text/javascript" src="{{ asset($theme_asset.'/js/countdown.js')}}"></script>
<script type="text/javascript" src="/vendor/laravel-admin/sweetalert2/dist/sweetalert2.all.js"></script>
@stack('scripts')
<script type="text/javascript">
  function formatNumber (num) {
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
  }
  // $('#total').html(formatNumber(parseInt({{ Cart::subtotal() }})+ parseInt($('#shipping').val())));
  $('#shipping').change(function(){
    var subtotal = parseInt($('.price .subtotal').html());
    var shipping = $('#shipping').val();
    $('#total').html(formatNumber(subtotal)+ parseInt(shipping));
  });
</script>

<script type="text/javascript">
  function addToCart(id,instance = null){
    if(instance == null || instance ==''){
      var cart = $('.shopping-cart');
    }else{
      var cart = $('.shopping-'+instance);
    }
    var imgtodrag = $('.product-box-'+id).find("img").eq(0);
    if (imgtodrag) {
      var imgclone = imgtodrag.clone()
      .offset({
        top: imgtodrag.offset().top,
        left: imgtodrag.offset().left
      })
      .css({
        'opacity': '0.5',
        'position': 'absolute',
        'width': '150px',
        'z-index': '99999999'
      })
      .appendTo($('body'))
      .animate({
        'top': cart.offset().top,
        'left': cart.offset().left,
        'width': 75,
        'height': 75
      }, 1000, 'easeInOutExpo');
      imgclone.animate({
        'width': 0,
        'height': 0
      }, function () {
        $(this).detach()
      });
    }
    $.ajax({
      url: '{{ action('Shop@addToCart') }}',
      type: 'POST',
      dataType: 'json',
      data: {id: id,instance:instance, _token:'{{ csrf_token() }}'},
      success: function(data){
        console.log(data);
        flg= parseInt(data.flg);
        if(flg ===1)
        {
          setTimeout(function () {
            if(data.instance =='default'){
              $('#count_cart').html(data.count_cart);
              $('#cart-sidebar').html(data.htmlCart);
              $('.subtotal').html(data.subtotal);
              $('.top-subtotal').show();
              $('.actions').show();
            }else{
              $('#count_'+data.instance).html(data.count_cart);
            }

          }, 1000);
        }else{
          alert(data.error);
        }
      }
    });
  }
</script>

<!-- Your customer chat code -->
<div class="fb-customerchat"
attribution=setup_tool
page_id="2036829946643288"
logged_in_greeting="Xin chào!"
logged_out_greeting="Xin chào!">
</div>
</body>
</html>
