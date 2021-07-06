@php
    $gs = \App\Models\GeneralSetting::first();
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>{{ env('APP_NAME') }} @yield('title')</title>

  @if (!isset($post))
  <meta content="{{ $gs->description }}" name="description">
  <meta content="{{ env('APP_NAME') }}" name="keywords">

  <!-- Schema.org markup for Google+ -->
  <meta itemprop="name" content="{{ config('app.name', 'Laravel') }}">
  <meta itemprop="description" content="{{ $gs->description }}">
  <meta itemprop="image" content="{{ storedAsset($gs->logo) }}">

  <!-- Twitter Card data -->
  <meta name="twitter:card" content="product">
  <meta name="twitter:site" content="@publisher_handle">
  <meta name="twitter:title" content="{{ config('app.name', 'Laravel') }}">
  <meta name="twitter:description" content="{{ $gs->description }}">
  <meta name="twitter:creator" content="@author_handle">
  <meta name="twitter:image" content="{{ storedAsset($gs->logo) }}">

  <!-- Open Graph data -->
  <meta property="og:title" content="{{ config('app.name', 'Laravel') }}"/>
  <meta property="og:type" content="Blog Site"/>
  <meta property="og:url" content="{{ route('home') }}"/>
  <meta property="og:image" content="{{ storedAsset($gs->logo) }}"/>
  <meta property="og:description" content="{{ $gs->description }}"/>
  <meta property="og:site_name" content="{{ env('APP_NAME') }}"/>
  @endif

  @yield('meta')

  <!-- Favicons -->
  <link href="{{ asset('public/assets/img/favicon.png') }}" rel="icon">
  <link href="{{ asset('public/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('public/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('public/assets/vendor/icofont/icofont.min.css') }}" rel="stylesheet">
  <link href="{{ asset('public/assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('public/assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
  <link href="{{ asset('public/assets/vendor/venobox/venobox.css') }}" rel="stylesheet">
  <link href="{{ asset('public/assets/vendor/owl.carousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

  <!-- Template Main CSS File -->
  <link href="{{ asset('public/assets/css/style.css') }}" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Tempo - v2.2.1
  * Template URL: https://bootstrapmade.com/tempo-free-onepage-bootstrap-theme/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top header-inner-pages">
    <div class="container d-flex align-items-center">

      <h1 class="logo mr-auto"><a href="index.html">Tempo</a></h1>

      <nav class="nav-menu d-none d-lg-block">
        <ul>
          <li><a href="{{ url('/') }}">Home</a></li>
          <li><a href="#about">About</a></li>
          <li><a href="#services">Services</a></li>
          <li><a href="#portfolio">Portfolio</a></li>
          <li><a href="#team">Team</a></li>
          <li class="active"><a href="{{ route('blogs') }}">Blog</a></li>
          <li class="drop-down"><a href="">Drop Down</a>
            <ul>
              <li><a href="#">Drop Down 1</a></li>
              <li class="drop-down"><a href="#">Deep Drop Down</a>
                <ul>
                  <li><a href="#">Deep Drop Down 1</a></li>
                  <li><a href="#">Deep Drop Down 2</a></li>
                  <li><a href="#">Deep Drop Down 3</a></li>
                  <li><a href="#">Deep Drop Down 4</a></li>
                  <li><a href="#">Deep Drop Down 5</a></li>
                </ul>
              </li>
              <li><a href="#">Drop Down 2</a></li>
              <li><a href="#">Drop Down 3</a></li>
              <li><a href="#">Drop Down 4</a></li>
            </ul>
          </li>
          <li><a href="#contact">Contact</a></li>

        </ul>
      </nav><!-- .nav-menu -->

    </div>
  </header><!-- End Header -->

  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <ol>
          <li><a href="{{ url('/') }}" style="color: #444444">Home</a></li>
          @yield('maps')
        </ol>
        <h2>Blog</h2>

      </div>
    </section>
    <!-- End Breadcrumbs -->
    <section id="blog" class="blog">
        <div class="container">
          <div class="row">
            @yield('content')


            <div class="col-lg-4">

              <div class="sidebar">
    
                <h3 class="sidebar-title">Search</h3>
                <div class="sidebar-item search-form">
                  <form action="">
                    <input type="text">
                    <button type="submit"><i class="icofont-search"></i></button>
                  </form>
    
                </div><!-- End sidebar search formn-->
    
                <h3 class="sidebar-title">Categories</h3>
                @php
                    $categories = \App\Models\Category::with('post')->get();
                @endphp
                <div class="sidebar-item categories">
                  <ul>
                    @foreach ($categories as $ctg)
                      <li><a href="#" style="text-transform: uppercase">{{ $ctg->name }} <span>({{ $ctg->post->count() }})</span></a></li>
                    @endforeach
                  </ul>
    
                </div><!-- End sidebar categories-->
    
                <h3 class="sidebar-title">Recent Posts</h3>
                <div class="sidebar-item recent-posts">
                  <div class="post-item clearfix">
                    <img src="{{ asset('public/assets/img/blog-recent-1.jpg') }}" alt="">
                    <h4><a href="blog-single.html">Nihil blanditiis at in nihil autem</a></h4>
                    <time datetime="2020-01-01">Jan 1, 2020</time>
                  </div>
    
                  <div class="post-item clearfix">
                    <img src="{{ asset('public/assets/img/blog-recent-2.jpg') }}" alt="">
                    <h4><a href="blog-single.html">Quidem autem et impedit</a></h4>
                    <time datetime="2020-01-01">Jan 1, 2020</time>
                  </div>
    
                  <div class="post-item clearfix">
                    <img src="{{ asset('public/assets/img/blog-recent-3.jpg') }}" alt="">
                    <h4><a href="blog-single.html">Id quia et et ut maxime similique occaecati ut</a></h4>
                    <time datetime="2020-01-01">Jan 1, 2020</time>
                  </div>
    
                  <div class="post-item clearfix">
                    <img src="{{ asset('public/assets/img/blog-recent-4.jpg') }}" alt="">
                    <h4><a href="blog-single.html">Laborum corporis quo dara net para</a></h4>
                    <time datetime="2020-01-01">Jan 1, 2020</time>
                  </div>
    
                  <div class="post-item clearfix">
                    <img src="{{ asset('public/assets/img/blog-recent-5.jpg') }}" alt="">
                    <h4><a href="blog-single.html">Et dolores corrupti quae illo quod dolor</a></h4>
                    <time datetime="2020-01-01">Jan 1, 2020</time>
                  </div>
    
                </div><!-- End sidebar recent posts-->
    
                <h3 class="sidebar-title">Tags</h3>
                <div class="sidebar-item tags">
                  <ul>
                    <li><a href="#">App</a></li>
                    <li><a href="#">IT</a></li>
                    <li><a href="#">Business</a></li>
                    <li><a href="#">Business</a></li>
                    <li><a href="#">Mac</a></li>
                    <li><a href="#">Design</a></li>
                    <li><a href="#">Office</a></li>
                    <li><a href="#">Creative</a></li>
                    <li><a href="#">Studio</a></li>
                    <li><a href="#">Smart</a></li>
                    <li><a href="#">Tips</a></li>
                    <li><a href="#">Marketing</a></li>
                  </ul>
    
                </div><!-- End sidebar tags-->
    
              </div><!-- End sidebar -->
    
            </div><!-- End blog sidebar -->
    
        </div>
      </div>
    </section>
  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">

    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6 footer-contact">
            <h3>Tempo</h3>
            <p>
              A108 Adam Street <br>
              New York, NY 535022<br>
              United States <br><br>
              <strong>Phone:</strong> +1 5589 55488 55<br>
              <strong>Email:</strong> info@example.com<br>
            </p>
          </div>

          <div class="col-lg-2 col-md-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Home</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">About us</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Services</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Terms of service</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Privacy policy</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Our Services</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Web Design</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Web Development</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Product Management</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Marketing</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Graphic Design</a></li>
            </ul>
          </div>

          <div class="col-lg-4 col-md-6 footer-newsletter">
            <h4>Join Our Newsletter</h4>
            <p>Tamen quem nulla quae legam multos aute sint culpa legam noster magna</p>
            <form action="" method="post">
              <input type="email" name="email"><input type="submit" value="Subscribe">
            </form>
          </div>

        </div>
      </div>
    </div>

    <div class="container d-md-flex py-4">

      <div class="mr-md-auto text-center text-md-left">
        <div class="copyright">
          &copy; Copyright <strong><span>Tempo</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
          <!-- All the links in the footer should remain intact. -->
          <!-- You can delete the links only if you purchased the pro version. -->
          <!-- Licensing information: https://bootstrapmade.com/license/ -->
          <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/tempo-free-onepage-bootstrap-theme/ -->
          Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
        </div>
      </div>
      <div class="social-links text-center text-md-right pt-3 pt-md-0">
        <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
        <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
        <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
        <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
        <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top"><i class="ri-arrow-up-line"></i></a>

  <!-- Vendor JS Files -->
    <script src="{{ asset('js\jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('public/js\popper.js') }}"></script>
    <script src="{{ asset('public/js\bootstrap.min.js') }}"></script>
    <script src="{{ asset("public/plugins/easing/easing.js") }}"></script>
    <script src="{{ asset('public/assets/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('public/assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('public/assets/vendor/venobox/venobox.min.js') }}"></script>
    <script src="{{ asset('public/assets/vendor/owl.carousel/owl.carousel.min.js') }}"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
    
    {{-- notify --}}
    <script src="{{ asset('public/assets/vendor/notify.min.js') }}"></script>

    <script src="{{ asset('public/assets/js/main.js') }}"></script>

    <script>
      @foreach (session('flash_notification', collect())->toArray() as $message)
        notification("{{ $message['message'] }}", "{{ $message['level'] }}");
      @endforeach

      function notification(message,type) {
          type = type == 'danger' ? 'error' : type;
          type = type == 'warning' ? 'warn' : type;
          $.notify(message, { className: type });
      }
    </script>
    
    @stack('scripts')


  <!-- Template Main JS File -->

</body>

</html>