
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required Meta Tags Always Come First -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Title -->
  <title>{{ config('app.name') }} | @yield('title')</title>

  <!-- Favicon -->
  <link rel="shortcut icon" href="/favicon.ico">

  <!-- Font -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

  <!-- CSS Implementing Plugins -->
  <link rel="stylesheet" href="/assets/vendor/bootstrap-icons/font/bootstrap-icons.css">
  <link rel="stylesheet" href="/assets/vendor/hs-mega-menu/dist/hs-mega-menu.min.css">

  <!-- CSS Unify Template -->
  <link rel="stylesheet" href="/assets/css/theme.min.css">
</head>

<body>
  <!-- ========== HEADER ========== -->
  <header id="header" class="navbar navbar-expand-lg navbar-light bg-white">
    <div class="container">
      <nav class="js-mega-menu navbar-nav-wrap">
        <!-- Default Logo -->
        <a class="navbar-brand" href="/" aria-label="Unify">
          <img class="navbar-brand-logo" src="/assets/svg/logos/logo.png" alt="Image Description">
        </a>
        <!-- End Default Logo -->

        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-default">
            <i class="bi-list"></i>
          </span>
          <span class="navbar-toggler-toggled">
            <i class="bi-x"></i>
          </span>
        </button>
        <!-- End Toggler -->

        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav nav-pills">
            <!-- Landings -->
            <li class="hs-has-mega-menu nav-item">
              <a class="nav-link {{ request()->routeIs('home.courses') ? 'active': '' }}" href="/courses">Courses</a>
            </li>
            <li class="hs-has-mega-menu nav-item">
              <a class="nav-link {{ request()->routeIs('home.get_coupons') ? 'active': '' }}" href="/coupons">Get Coupon</a>
            </li>
            <li class="hs-has-mega-menu nav-item">
              <a class="nav-link {{ request()->routeIs('home.tasks') ? 'active': '' }}" href="/tasks">Tasks</a>
            </li>
            <li class="hs-has-mega-menu nav-item">
              <a class="nav-link {{ request()->routeIs('home.top_sellers') ? 'active': '' }}" href="/top-sellers">Top Sellers</a>
            </li>
            @if (auth()->check())
              <li class="hs-has-mega-menu nav-item">
                <a class="nav-link {{ request()->routeIs('user.dashboard') ? 'active': '' }}" href="/users/dashboard">My Account</a>
              </li>
              @if (auth()->user()->role == 'vendor')
                <li class="hs-has-mega-menu nav-item">
                  <a class="nav-link {{ request()->routeIs('vendor.dashboard') ? 'active': '' }}" href="/users/vendor/dashboard">Merchant Dashboard</a>
                </li>
              @endif
              @if (auth()->user()->role == 'user-admin')
                <li class="hs-has-mega-menu nav-item">
                  <a class="nav-link {{ request()->routeIs('super.verify_socials') ? 'active': (request()->routeIs('super.verify_user_socials') ? 'active' : '' ) }}" href="/users/super/verify-socials">Verify Socials</a>
                </li>
              @endif
            @endif
            <!-- End Landings -->
            <!-- End Blog -->

            <!-- Log in -->
            @if (!auth()->check())
            <li class="nav-item ms-lg-auto">
              <a class="btn btn-ghost-dark me-2 me-lg-0" href="/users/login">Log in</a>
              <a class="btn btn-dark d-lg-none" href="/users/register">Sign up</a>
            </li>
            <!-- End Log in -->

            <!-- Sign up -->
            <li class="nav-item">
              <a class="btn btn-dark d-none d-lg-inline-block" href="/users/register">Sign up</a>
            </li>
            @else
            <li class="nav-item ms-lg-auto">
              <a class="btn btn-dark d-lg-inline-block" href="/users/logout">Logout</a>
            </li>
            @endif
            <!-- End Sign up -->
          </ul>
        </div>
        <!-- End Collapse -->
      </nav>
    </div>
  </header>

  <!-- ========== END HEADER ========== -->

  <!-- ========== MAIN CONTENT ========== -->
  <main id="content" role="main">
    <!-- User Profile -->
    <div class="container content-space-2">
        @if (!request()->routeIs("home"))
            <div class="w-lg-65 text-center mx-lg-auto mb-5 mb-sm-7 mb-lg-10">
                <h1 class="display-4">@yield('title')</h1>
                <p class="lead">@yield('page-desc')</p>
            </div>
        @endif
      @yield('content')
      <!-- End Row -->
    </div>
    <!-- End User Profile -->
  </main>
  <!-- ========== END MAIN CONTENT ========== -->

  @yield('modals')

  <!-- ========== FOOTER ========== -->
  <footer class="bg-dark">
    <div class="container">
      <div class="row align-items-center pt-8 pb-4">
        <div class="col-md mb-5 mb-md-0">
          <h2 class="fw-medium text-white-70 mb-0">Join the thriving<br><span class="fw-bold text-white">{{ config('app.name') }}</span> Business</h2>
        </div>
        <!-- End Col -->

        <div class="col-md-auto">
          <div class="d-grid d-sm-flex gap-3">
            <a class="btn btn-primary" href="{{ route('user.login') }}">Login</a>
            <a class="btn btn-ghost-light btn-pointer" href="{{ route('user.register') }}">Sign up</a>
          </div>
        </div>
        <!-- End Col -->
      </div>
      <!-- End Row -->

      <div class="border-bottom border-white-10">
        <div class="row py-6">

            <div class="col-6 col-sm-4 col-lg">
                <span class="text-cap text-white">Umbrella Features</span>

                <!-- List -->
                <ul class="list-unstyled list-py-2 mb-0">

                    <li><a class="link link-light link-light-75" href="#">
                        <div class="flex-grow-1 ms-2">
                        <span>Umbrella Hub</span>
                        </div>
                    </a></li>
                    <li><a class="link link-light link-light-75" href="#">
                        <div class="flex-grow-1 ms-2">
                        <span>Play 2 Earn (P2E)</span>
                        </div>
                    </a></li>
                    <li><a class="link link-light link-light-75" href="#">
                        <div class="flex-grow-1 ms-2">
                        <span>Tasks 2 Earn (T2E)</span>
                        </div>
                    </a></li>
                    <li><a class="link link-light link-light-75" href="#">
                        <div class="flex-grow-1 ms-2">
                        <span>Market Place</span>
                        </div>
                    </a></li>
                </ul>
                <!-- End List -->
              </div>
              <!-- End Col -->

          <div class="col-6 col-sm-4 col-lg">
            <span class="text-cap text-white">Follow us</span>

            <!-- List -->
            <ul class="list-unstyled list-py-2 mb-0">

                <li><a class="link link-light link-light-75" href="https://twitter.com/ng_umbrella">
                    <div class="d-flex">
                      <div class="flex-shrink-0">
                        <i class="bi-twitter"></i>
                      </div>

                      <div class="flex-grow-1 ms-2">
                        <span>Twitter/ X</span>
                      </div>
                    </div>
                </a></li>


                <li><a class="link link-light link-light-75" href="https://instagram.com/umbrella.ng">
                    <div class="d-flex">
                      <div class="flex-shrink-0">
                        <i class="bi-instagram"></i>
                      </div>

                      <div class="flex-grow-1 ms-2">
                        <span>Instagram</span>
                      </div>
                    </div>
                </a></li>

                <li><a class="link link-light link-light-75" href="https://t.me/umbrellang1">
                    <div class="d-flex">
                      <div class="flex-shrink-0">
                        <i class="bi-telegram"></i>
                      </div>

                      <div class="flex-grow-1 ms-2">
                        <span>Telegram</span>
                      </div>
                    </div>
                </a></li>

                <li><a class="link link-light link-light-75" href="https://www.facebook.com/connectumbrella">
                    <div class="d-flex">
                      <div class="flex-shrink-0">
                        <i class="bi-facebook"></i>
                      </div>

                      <div class="flex-grow-1 ms-2">
                        <span>Facebook</span>
                      </div>
                    </div>
                </a></li>

                <li><a class="link link-light link-light-75" href="https://wa.me/+2347025925703">
                    <div class="d-flex">
                      <div class="flex-shrink-0">
                        <i class="bi-whatsapp"></i>
                      </div>

                      <div class="flex-grow-1 ms-2">
                        <span>WhatsApp</span>
                      </div>
                    </div>
                </a></li>


                <li><a class="link link-light link-light-75" href="https://www.tiktok.com/@umbrella.ng">
                    <div class="d-flex">
                      <div class="flex-shrink-0">
                        <i class="bi-tiktok"></i>
                      </div>

                      <div class="flex-grow-1 ms-2">
                        <span>Tik-Tok</span>
                      </div>
                    </div>
                </a></li>
            </ul>
            <!-- End List -->
          </div>
          <!-- End Col -->
        </div>
        <!-- End Row -->
      </div>

      <div class="row align-items-md-center py-6">
        <div class="col-md mb-3 mb-md-0">
          <!-- List -->
          <ul class="list-inline list-px-2 mb-0">
            <li class="list-inline-item"><a class="link link-light link-light-75" href="#">Privacy and Policy</a></li>
            <li class="list-inline-item"><a class="link link-light link-light-75" href="#">Terms</a></li>
            <li class="list-inline-item"><a class="link link-light link-light-75" href="#">Status</a></li>
          </ul>
          <!-- End List -->
        </div>
        <!-- End Col -->

        <div class="col-md-auto">
          <p class="fs-5 text-white-70 mb-0">&copy; {{ config('app.name') }}. <script>document.write(new Date().getFullYear())</script></p>
        </div>
        <!-- End Col -->
      </div>
      <!-- End Row -->
    </div>
  </footer>
  <!-- ========== END FOOTER ========== -->

  <!-- ========== SECONDARY CONTENTS ========== -->
  <!-- Go To -->
  <a class="js-go-to go-to position-fixed" href="javascript:;" style="visibility: hidden;"
     data-hs-go-to-options='{
       "offsetTop": 700,
       "position": {
         "init": {
           "right": "2rem"
         },
         "show": {
           "bottom": "2rem"
         },
         "hide": {
           "bottom": "-2rem"
         }
       }
     }'>
    <i class="bi-chevron-up"></i>
  </a>
  <!-- ========== END SECONDARY CONTENTS ========== -->
  <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
  <!-- JS Global Compulsory  -->
  <script src="/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

  <!-- JS Implementing Plugins -->
  <script src="/assets/vendor/hs-header/dist/hs-header.min.js"></script>
  <script src="/assets/vendor/hs-mega-menu/dist/hs-mega-menu.min.js"></script>
  <script src="/assets/vendor/hs-go-to/dist/hs-go-to.min.js"></script>

  <!-- JS Unify -->
  <script src="/assets/js/theme.min.js"></script>

  <!-- JS Plugins Init. -->
  <script>
    $('img').addClass('img-fluid');
    (function() {
      // INITIALIZATION OF NAVBAR
      // =======================================================
      new HSHeader('#header').init()


      // INITIALIZATION OF MEGA MENU
      // =======================================================
      const megaMenu = new HSMegaMenu('.js-mega-menu', {
        desktop: {
          position: 'left'
        }
      })


      // INITIALIZATION OF GO TO
      // =======================================================
      new HSGoTo('.js-go-to')
    })()
  </script>
  @yield('scripts')
</body>
</html>
