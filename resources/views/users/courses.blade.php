@extends('layouts.users')
@section('title', 'Courses')
@section('content')
<div class="w-lg-50 text-center mx-lg-auto">
    <!-- Heading -->
    <div class="mb-5">
      <h1 class="display-4">Courses</h1>
      <p>Expand your knowledge with our wide range of courses.</p>
    </div>
    <!-- End Heading -->

    <form method="GET">
      <div class="position-relative">
        <!-- Input Card -->
        <div class="input-card input-card-sm">
          <div class="input-card-form">
            <label for="searchForm" class="form-label visually-hidden">Search Course</label>
            <input type="text" class="form-control form-control-lg" name="s" id="searchForm" placeholder="Search Course" aria-label="Search Course">
          </div>
          <button type="submit" class="btn btn-primary btn-lg"><i class="bi-search"></i></button>
        </div>
        <!-- End Input Card -->

        <!-- SVG Shape -->
        <figure class="position-absolute top-0 end-0 d-none d-sm-block zi-n1 mt-n7 me-n10" style="width: 4rem;">
          <img class="img-fluid" src="/assets/svg/components/pointer-up.svg" alt="Image Description">
        </figure>
        <!-- End SVG Shape -->

        <!-- SVG Shape -->
        <figure class="position-absolute bottom-0 start-0 zi-n1 mb-n7" style="width: 12rem; margin-left: -10rem;">
          <img class="img-fluid" src="/assets/svg/components/curved-shape.svg" alt="Image Description">
        </figure>
        <!-- End SVG Shape -->
      </div>
    </form>
  </div>
</div>
</div>
<!-- End Hero -->


<!-- Card Grid -->
<div class="container content-space-b-2 content-space-b-lg-3 overflow-hidden">
    <div class="row justify-content-md-center mb-5">
        <div class="col-md-8">
            <div class="">
            <div class="mb-4">
                @foreach ($courses as $course)
                    <!-- Card -->
                    <a class="card card-ghost card-transition-zoom" href="/courses/{{ $course->id }}">
                    <div class="card-transition-zoom-item">
                        <img class="card-img" src="/assets/img/1920x1080/img3.jpg" alt="Image Description">
                    </div>

                    <div class="card-body">
                        <h4>{{ $course->name }}</h4>
                        <p class="card-text">{{ $course->short_description }}</p>
                    </div>

                    <div class="card-footer">
                        <span class="card-link">View Details</span>
                    </div>
                    </a>
                    <!-- End Card -->
                @endforeach
            </div>
            </div>
        </div>
        <!-- End Col -->
    </div>

    <!-- Pagination -->
    <nav class="d-flex justify-content-center" aria-label="Page navigation">
    {{ $courses->links() }}
    <!-- End Col -->
    </nav>
    <!-- End Pagination -->
</div>
@endsection