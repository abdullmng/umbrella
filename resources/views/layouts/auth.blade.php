
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required Meta Tags Always Come First -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Title -->
  <title>{{ config('app.name') }}| @yield('title')</title>

  <!-- Favicon -->
  <link rel="shortcut icon" href="./favicon.ico">

  <!-- Font -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

  <!-- CSS Implementing Plugins -->
  <link rel="stylesheet" href="/assets/vendor/bootstrap-icons/font/bootstrap-icons.css">

  <!-- CSS Unify Template -->
  <link rel="stylesheet" href="/assets/css/theme.min.css">
</head>

<body class="d-flex align-items-center min-h-100 bg-dark">
  <!-- ========== MAIN CONTENT ========== -->
  <main id="content" role="main" class="flex-grow-1 overflow-hidden">
    <!-- Content -->
    <div class="container content-space-t-1 content-space-b-2">
      <div class="mx-lg-auto" style="max-width: 55rem;">
        <div class="d-flex justify-content-center align-items-center flex-column min-vh-lg-100">
          <!-- ========== HEADER ========== -->
          <header id="header" class="navbar navbar-height navbar-light mb-3">
            <div class="container">
              <a class="navbar-brand mx-auto" href="/" aria-label="{{ config('app.name') }}">
                <img class="navbar-brand-logo" src="/assets/svg/logos/logo-white.png" alt="Image Description">
              </a>
            </div>
          </header>
          <!-- ========== END HEADER ========== -->

          <div class="position-relative">
            <!-- Card -->
            <div class="card card-shadow card-login">
              <div class="row">
                <div class="col-md-8">
                  <div class="card-body">
                    <!-- Form -->
                    @yield('content')
                    <!-- End Form -->
                  </div>
                </div>
                <!-- End Col -->
                  
                <div class="col-md-4 d-md-flex justify-content-center flex-column bg-soft-primary p-8 p-md-5" style="background-image: url(/assets/svg/components/wave-pattern.svg);">
                  <h5 class="mb-4">Build your skills with:</h5>

                   <!--List Checked -->
                  <ul class="list-checked list-checked-primary list-py-2">
                    <li class="list-checked-item">Our self paced courses</li>
                    <li class="list-checked-item">Readily available resources</li>
                  </ul>
                  <!-- End List Checked--> 

                  <span class="d-block">
                    <a class="link link-pointer" href="#">Learn more</a>
                  </span> 
                <!--</div>-->
                <!-- End Col -->
              </div>
              <!-- End Row -->
            </div>
            <!-- End Card -->

            <!-- SVG Shape -->
            <figure class="position-absolute top-0 end-0 zi-n1 d-none d-sm-block mt-n7 me-n10" style="width: 4rem;">
              <img class="img-fluid" src="/assets/svg/components/pointer-up.svg" alt="Image Description">
            </figure>
            <!-- End SVG Shape -->

            <!-- SVG Shape -->
            <figure class="position-absolute bottom-0 start-0 d-none d-sm-block ms-n10 mb-n10" style="width: 15rem;">
              <img class="img-fluid" src="/assets/svg/components/curved-shape.svg" alt="Image Description">
            </figure>
            <!-- End SVG Shape -->
          </div>
        </div>
      </div>
    </div>
    <!-- End Content -->
  </main>
  <!-- ========== END MAIN CONTENT ========== -->

  <!-- JS Global Compulsory  -->
  <script src="/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

  <!-- JS Implementing Plugins -->
  <script src="/assets/vendor/hs-toggle-password/dist/js/hs-toggle-password.js"></script>

  <!-- JS Unify -->
  <script src="/assets/js/theme.min.js"></script>

  <!-- JS Plugins Init. -->
  <script>
    (function() {
      // INITIALIZATION OF BOOTSTRAP VALIDATION
      // =======================================================
      HSBsValidation.init('.js-validate', {
        onSubmit: data => {
          data.event.preventDefault()
          alert('Submited')
        }
      })


      // INITIALIZATION OF TOGGLE PASSWORD
      // =======================================================
      new HSTogglePassword('.js-toggle-password')
    })()
  </script>
</body>
</html>
