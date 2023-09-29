@extends('layouts.users')
@section('title', 'Home')
@section('content')
<div class="row justify-content-lg-between align-items-lg-center">
    <div class="col-lg-5 mb-5 mb-lg-0">
      <div class="mb-5">
        <h1 class="display-4 text-dark mb-5">Start your journey with <span class="text-primary">{{ config('app.name') }}</span></h1>
        <p class="fs-3">Build your skills with:
            Our self paced courses and
            Readily available resources</p>
      </div>

      <div class="d-grid d-sm-flex gap-3 mb-5">
        <a class="btn btn-primary" href="/users/register">Sign Up Now</a>
        <a class="btn btn-ghost-dark btn-pointer" href="/courses">Learn with ease</a>
      </div>
    </div>
    <!-- End Col -->

    <div class="col-lg-6">
      <div class="position-relative">
        <div class="position-relative">
          <img class="img-fluid" src="/homefeats.png" alt="Image Description">

          <div class="position-absolute bottom-0 end-0">
            <img class="w-100" src="./assets/svg/illustrations/cubics.svg" alt="SVG" style="max-width: 30rem;">
          </div>
        </div>

        <!-- Media -->
        <div class="d-inline-block position-absolute top-0 start-0 bg-white w-100 rounded-pill shadow-sm p-2 mt-5 ms-n5" style="max-width: 12rem;">
          <div class="d-flex align-items-center">
            <div class="flex-shrink-0">
              <span class="avatar avatar-sm avatar-circle">
                <img class="avatar-img" src="/img1.jpg" alt="Image Description">
              </span>
            </div>
            <div class="flex-grow-1 ms-2">
              <div class="fs-5 fw-bold mb-0">John</div>
              <span class="d-block fs-6">Fantastic Courses!</span>
            </div>
          </div>
        </div>
        <!-- End Media -->

        <!-- Media -->
        <div class="d-inline-block position-absolute bottom-0 start-0 bg-warning w-100 rounded-pill shadow-sm p-2 mb-10 ms-n10" style="max-width: 16rem;">
          <div class="d-flex align-items-center">
            <div class="flex-shrink-0">
              <span class="avatar avatar-sm avatar-circle">
                <img class="avatar-img" src="/img1.jpg" alt="Image Description">
              </span>
            </div>
            <div class="flex-grow-1 ms-2">
              <div class="fs-5 fw-bold text-dark mb-0">Michael</div>
              <span class="d-block fs-6 text-dark">Excellent Tutors 🔥👋</span>
            </div>
          </div>
        </div>
        <!-- End Media -->
      </div>
    </div>
    <!-- End Col -->
  </div>
  <!-- End Row -->
</div>
<!-- End Hero -->

<!-- Icon Blocks -->
<div class="container content-space-t-2 content-space-t-lg-3">
  <div class="row">
    <div class="col-sm-6 col-lg mb-5 mb-lg-0">
      <!-- Icon Block -->
      <div class="text-center">
        <div class="mb-3">
          <i class="bi-people fs-1 text-dark"></i>
        </div>

        <h5>Community</h5>
        <span class="d-block">A community to learn, improve and advance</span>
      </div>
      <!-- End Icon Block -->
    </div>
    <!-- End Col -->

    <div class="col-sm-6 col-lg mb-5 mb-lg-0">
      <!-- Icon Block -->
      <div class="text-center">
        <div class="mb-3">
          <i class="bi-gift fs-1 text-dark"></i>
        </div>

        <h5>Umbrella Innovations</h5>
        <span class="d-block">Get rewarded for learning</span>
      </div>
      <!-- End Icon Block -->
    </div>
    <!-- End Col -->

   {{-- <div class="col-sm-6 col-lg mb-5 mb-sm-0">
      <!-- Icon Block -->
      <div class="text-center">
        <div class="mb-3">
          <i class="bi-file-earmark-text fs-1 text-dark"></i>
        </div>

        <h5>Documentation</h5>
        <span class="d-block">Every component and plugin is well documented</span>
      </div>
      <!-- End Icon Block -->
    </div>
    <!-- End Col -->

    <div class="col-sm-6 col-lg">
      <!-- Icon Block -->
      <div class="text-center">
        <div class="mb-3">
          <i class="bi-chat-right-dots fs-1 text-dark"></i>
        </div>

        <h5>24/7 Support</h5>
        <span class="d-block">Contact us 24 hours a day, 7 days a week.</span>
      </div>
      <!-- End Icon Block -->
    </div> --}}
    <!-- End Col -->
  </div>
  <!-- End Row -->
</div>
<!-- End Icon Blocks -->

<!-- Features -->
<div class="overflow-hidden">
  <div class="container content-space-2 content-space-lg-3">
    <div class="row align-items-lg-center">
      <div class="col-lg-7 me-auto ms-lg-n10 mb-5 mb-lg-0">
        <div class="row align-items-center">
          <div class="col-4">
            <img class="img-fluid rounded-3" src="./assets/img/580x480/img1.jpg" alt="Image Description">
          </div>
          <!-- End Col -->

          <div class="col-3">
            <img class="img-fluid rounded-3" src="./assets/img/350x700/img1.jpg" alt="Image Description">
          </div>
          <!-- End Col -->

          <div class="col-5">
            <img class="img-fluid rounded-3" src="./assets/img/400x700/img1.jpg" alt="Image Description">
          </div>
          <!-- End Col -->
        </div>
        <!-- End Row -->
      </div>
      <!-- End Col -->

      <div class="col-lg-5">
        <div class="mb-5">
          <h2>Enhanced tools designed for marketing and sales</h2>
          {{-- <p>Use our tools to explore your ideas and make your vision come true. Then share your work easily.</p> --}}
        </div>

        <!-- List Checked -->
        <ul class="list-checked list-checked-soft-bg-primary list-checked-lg">
          <li class="list-checked-item"><span class="fw-bold">Less routine</span> – more creativity</li>
          <li class="list-checked-item">Thousands of active users</li>
          <li class="list-checked-item">User friendly <span class="fw-bold">Budget</span></li>
        </ul>
        <!-- End List Checked -->
      </div>
      <!-- End Col -->
    </div>
    <!-- End Row -->
  </div>
</div>
<!-- End Features -->

<!-- Icon Blocks -->
<div class="container">
  <div class="row">
    <div class="col-sm-6 col-lg-4 mb-5">
      <div class="text-center px-md-5">
        <div class="mb-3">
          <i class="bi-tablet-landscape fs-1 text-dark"></i>
        </div>
        <p>Umbrella Innovations is an <span class="fw-bold">incredibly beautiful</span> and mobile-first project on the web.</p>
      </div>
    </div>
    <!-- End Col -->

    <div class="col-sm-6 col-lg-4 mb-5">
      <div class="text-center px-md-5">
        <div class="mb-3">
          <i class="bi-shield-check fs-1 text-dark"></i>
        </div>
        <p>Umbrella Innovations is designed for learning, sales and marketing</p>
      </div>
    </div>
    <!-- End Col -->

    <div class="col-sm-6 col-lg-4 mb-5">
      <div class="text-center px-md-5">
        <div class="mb-3">
          <i class="bi-hdd-network fs-1 text-dark"></i>
        </div>
        <p>Whether you're a starter or a Pro, learn how to integrate with Umbrella.</p>
      </div>
    </div>
    <!-- End Col -->

    <div class="col-sm-6 col-lg-4 mb-5 mb-lg-0">
      <div class="text-center px-md-5">
        <div class="mb-3">
          <i class="bi-gear fs-1 text-dark"></i>
        </div>
        <p>Use Umbrella to promote your business or skills, we help you dominate the Media.</p>
      </div>
    </div>
    <!-- End Col -->

    <div class="col-sm-6 col-lg-4 mb-5 mb-sm-0">
      <div class="text-center px-md-5">
        <div class="mb-3">
          <i class="bi-sliders fs-1 text-dark"></i>
        </div>
        <p>You can use umbrella to promote your contents on social media at user friendly budget.</p>
      </div>
    </div>
    <!-- End Col -->

    <div class="col-sm-6 col-lg-4">
      <div class="text-center px-md-5">
        <div class="mb-3">
          <i class="bi-journal-text fs-1 text-dark"></i>
        </div>
        <p>Interact and relate with other intellects on Umbrella Blog.</p>
      </div>
    </div>
    <!-- End Col -->
  </div>
  <!-- End Row -->
</div>
<!-- End Icon Blocks -->

<!-- Features -->
<div class="container content-space-t-2 content-space-t-lg-3">
  <div class="row justify-content-lg-between align-items-lg-center">
    <div class="col-lg-6 mb-5 mb-lg-0">
      <img class="img-fluid rounded-3" src="./assets/img/950x950/img2.jpg" alt="Image Description">
    </div>
    <!-- End Col -->

    <div class="col-lg-5">
      <div class="mb-5">
        <h2>Why choose to startup with Umbrella?</h2>
        <p>Umbrella Innovation is created to help you broaden your knowledge by learning digital skills, soft skills and vocational skills, these skills  will help you earn an income.</p>
      </div>

      <!-- List Checked -->
      <ul class="list-checked list-checked-soft-bg-primary list-checked-lg mb-5">
        <li class="list-checked-item">Get rewarded for learning, and withdraw your earnings as cash.</li>
        <li class="list-checked-item">Incentives for members under the Umbrella</li>
        <li class="list-checked-item">Financial Freedom and Independence</li>
      </ul>
      <!-- End List Checked -->

      <a class="btn btn-primary" href="/about">Our services</a>
    </div>
    <!-- End Col -->
  </div>
  <!-- End Row -->
</div>
<!-- End Features -->

<!-- Stats -->
<div class="container content-space-2 content-space-lg-3">
  <div class="row justify-content-lg-between align-items-lg-center">
    <div class="col-lg-5 mb-9 mb-lg-0">
      <div class="mb-6">
        <h2>It's all about speed</h2>
        <p>We provide you with a test account that can be set up in seconds. Our main focus is getting responses to you as soon as we can.</p>
      </div>

      <!-- Blockquote -->
      <figure>
        <blockquote class="blockquote"><em>The beautiful thing about learning is that no one can take it away from you.</em></blockquote>

        <figcaption class="blockquote-footer">
          <div class="d-flex align-items-center">
            <div class="flex-shrink-0">
              <img class="avatar avatar-circle" src="/img1.jpg" alt="Image Description">
            </div>

            <div class="flex-grow-1 ms-3">
              -BB King
              <span class="blockquote-footer-source">Director Payments &amp; Risk | Airbnb</span>
            </div>
          </div>
        </figcaption>
      </figure>
      <!-- End Blockquote -->
    </div>
    <!-- End Col -->

    <div class="col-lg-6">
      <!-- List -->
      <ul class="list-equal-height list-equal-height-2-cols">
        <li class="list-equal-height-item">
          <h4 class="display-5">45k+</h4>
          <p class="mb-0">users - from new startups to public companies</p>
        </li>

        <li class="list-equal-height-item">
          <h4 class="display-5"><sub><i class="bi-arrow-up-short text-primary ms-n2"></i></sub>23%</h4>
          <p class="mb-0">increase in traffic on webpages with Looms</p>
        </li>

        <li class="list-equal-height-item">
          <h4 class="display-5"><sub><i class="bi-arrow-up-short text-primary ms-n2"></i></sub>9.3%</h4>
          <p class="mb-0">boost in reply rates across sales outreach</p>
        </li>

        <li class="list-equal-height-item">
          <h4 class="display-5">2x</h4>
          <p class="mb-0">faster than previous Unify versions</p>
        </li>
      </ul>
      <!-- End List -->
    </div>
    <!-- End Col -->
  </div>
  <!-- End Row -->
</div>
<!-- End Stats -->

<!-- Clients -->
<div class="container">
  <!-- Swiper Slider -->
  <div class="js-swiper-clients swiper text-center">
    <div class="swiper-wrapper">
      <div class="swiper-slide">
        <img class="avatar avatar-lg avatar-4x3" src="./assets/svg/brands/mailchimp-dark.svg" alt="Logo">
      </div>
      <!-- End Slide -->

      <div class="swiper-slide">
        <img class="avatar avatar-lg avatar-4x3" src="./assets/svg/brands/sass-dark.svg" alt="Logo">
      </div>
      <!-- End Slide -->

      <div class="swiper-slide">
        <img class="avatar avatar-lg avatar-4x3" src="./assets/svg/brands/forbes-dark.svg" alt="Logo">
      </div>
      <!-- End Slide -->

      <div class="swiper-slide">
        <img class="avatar avatar-lg avatar-4x3" src="./assets/svg/brands/gitlab-dark.svg" alt="Logo">
      </div>
      <!-- End Slide -->

      <div class="swiper-slide">
        <img class="avatar avatar-lg avatar-4x3" src="./assets/svg/brands/hubspot-dark.svg" alt="Logo">
      </div>
      <!-- End Slide -->
    </div>
  </div>
  <!-- End Swiper Slider -->
</div>
<!-- End Clients -->

<!-- Card Grid -->
<div class="container content-space-2 content-space-lg-3">
  <!-- Heading -->
  <div class="w-lg-65 text-center mx-lg-auto mb-5 mb-sm-7 mb-lg-10">
    <h2>Latest Courses</h2>
    <p>Explore our latest addition to the course pool.</p>
  </div>
  <!-- End Heading -->

  <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3">
    @foreach ($courses as $course)
    <div class="col mb-5 mb-md-0">
      <!-- Card -->
      <a class="card card-ghost card-transition-zoom h-100" href="/courses/{{ $course->id }}">
        <div class="card-transition-zoom-item">
          <img class="card-img" src="{{ $course->image ?? '/assets/img/1920x1080/img3.jpg' }}" alt="Image Description">
        </div>

        <div class="card-body">
          <h4>{{ $course->name }}</h4>
          <p class="card-text">{{ $course->short_description }}</p>
        </div>

        <div class="card-footer">
          <span class="card-link">View details</span>
        </div>
      </a>
      <!-- End Card -->
    </div>
    <!-- End Col -->
    @endforeach
  </div>
  <!-- End Row -->
</div>
<!-- End Card Grid -->

@endsection
