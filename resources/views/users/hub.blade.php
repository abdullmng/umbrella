@extends('layouts.users')
@section('title', config('app.name')." Hub")
@section('page-desc', 'Stay updated with the latest happenings on umbrella hub')
@section('content')
      <div class="w-lg-50 text-center mx-lg-auto mb-5">
        <form>
          <div class="position-relative">
            <!-- Input Card -->
            <div class="input-card input-card-sm">
              <div class="input-card-form">
                <label for="searchForm" class="form-label visually-hidden">Search article</label>
                <input type="text" class="form-control form-control-lg" name="s" id="searchForm" placeholder="Search article" aria-label="Search article">
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

  <!-- Tags -->
  <div class="container content-space-b-2">
    <div class="text-center">
      @foreach ($topics as $topic)
        <a class="btn btn-white btn-sm m-1" href="/hub/topic/{{ $topic->id }}"> {{ $topic->name }}</a>
      @endforeach
    </div>
  </div>
  <!-- End Tags -->

  <!-- Card Grid -->
  <div class="container content-space-b-2 content-space-b-lg-3 overflow-hidden">
    <div class="row row-cols-1 row-cols-sm-2 gx-7">
    @foreach ($posts as $post)
      <div class="col mb-7 mb-md-10">
        <!-- Card -->
        <a class="card card-ghost h-100" href="/hub/post/{{ $post->id }}">
          <div class="row">
            <div class="col-lg-5 mb-3 mb-lg-0">
              <img class="card-img" src="{{ $post->image ?? '/assets/img/1920x1080/img3.jpg' }}" alt="Image Description">
            </div>
            <!-- End Col -->

            <div class="col-lg-7">
              <h4>{{ $post->name }}</h4>
              <p class="card-text">{{ $post->description }}</p>
              <span class="card-link">Read more</span>
            </div>
            <!-- End Col -->
          </div>
          <!-- End Row -->
        </a>
        <!-- End Card -->
      </div>
      <!-- End Col -->
    @endforeach

    </div>
    <!-- End Row -->

    <!-- Pagination -->
    <nav class="d-flex justify-content-center" aria-label="Page navigation">
      {{ $posts->links() }}
    </nav>
    <!-- End Pagination -->
  </div>
  <!-- End Card Grid -->
@endsection
