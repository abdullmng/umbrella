@extends('layouts.users')
@section('title', $post->name)
@section('content')
<div class="row justify-content-lg-center">
    <div class="col-lg-8">
      <!-- Media -->
      <div class="d-flex align-items-center mb-4">
        <div class="flex-shrink-0">
          <img class="avatar avatar-circle" src="{{ $post->user->image ?? '/assets/img/160x160/img10.jpg' }}" alt="Image Description">
        </div>

        <div class="flex-grow-1 ms-3">
          <h6 class="mb-0">
            <a class="link link-dark" href="#">{{ $post->user->name }}</a>
          </h6>
          <span class="d-block fs-5 text-muted">{{ $post->created_at->format('Y-m-d h:i:s') }}</span>
        </div>
      </div>
      <!-- End Media -->

      <div class="mb-6">
        <h1 class="h2">{{ $post->name }}</h1>
        <p class="lead">{{ $post->description }}</p>
      </div>
    </div>
    <!-- End Col -->
  </div>
  <!-- End Row -->

  <div class="row justify-content-lg-center">
    <div class="col-lg-10">
      <img class="img-fluid" src="{{ $post->image ?? '/assets/img/1920x1080/img3.jpg' }}" alt="Image Description">
    </div>
    <!-- End Col -->
  </div>
  <!-- End Row -->
</div>
</div>
<!-- End Hero -->

<!-- Description -->
<div class="container content-space-2 content-space-lg-3">
<div class="row mb-3">
  <div class="col-10 col-md-8 col-lg-6 offset-1 offset-md-2 offset-lg-3">
    {!! $post->content !!}
  </div>
  <!-- End Col -->
</div>
<!-- End Row -->
</div>
<!-- End Description -->

@if ($related_posts->count() > 0)
<!-- Card Grid -->
<div class="container content-space-b-2 content-space-b-lg-3">
<!-- Heading -->
<div class="w-lg-65 text-center mx-lg-auto mb-7">
  <h3>Related Posts</h3>
</div>
<!-- End Heading -->

<div class="row">
@foreach ($related_posts as $related)
  <div class="col-sm-6 col-md-4 mb-5 mb-md-0">
    <!-- Card -->
    <a class="card card-ghost card-transition-zoom h-100" href="/hub/post/{{ $related->id }}">
      <div class="card-transition-zoom-item">
        <img class="card-img" src="{{ $related->image ?? '/assets/img/1920x1080/img3.jpg' }}" alt="Image Description">
      </div>

      <div class="card-body">
        <h4>{{ $related->name }}</h4>
        <p class="card-text">{{ $related->description }}</p>
      </div>

      <div class="card-footer">
        <span class="card-link">Read more</span>
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
@endif

<!-- Comment -->
<div class="container content-space-2 content-space-lg-3">
<!-- Heading -->
<div class="w-lg-65 text-center mx-lg-auto mb-7">
  <h3>{{ $post->comments_count }} comments</h3>
</div>
<!-- End Heading -->

<div class="row justify-content-lg-center">
  <div class="col-lg-8">
    <!-- Comment -->
    <ul class="list-comment">
    @foreach ($post->comments as $comment)
      <!-- Item -->
      <li class="list-comment-item">
        <!-- Media -->
        <div class="d-flex align-items-center mb-3">
          <div class="flex-shrink-0">
            <img class="avatar avatar-circle" src="{{  $comment->user->image ?? '/assets/img/160x160/img10.jpg'  }}" alt="Image Description">
          </div>

          <div class="flex-grow-1 ms-3">
            <div class="d-flex justify-content-between align-items-center">
              <h6>{{ $comment->user->name }}</h6>
              <span class="d-block small text-muted">{{ $comment->created_at->format('Y-m-d h:i:s') }}</span>
            </div>
          </div>
        </div>
        <!-- End Media -->

        <p>{{ $comment->comment }}</p>

        ({{ $comment->replies_count }} replies) <a class="link rpl" href="#comment" data-comment_id="{{ $comment->id }}">Reply</a>

        <!-- Comment -->
        <ul class="list-comment">
          @foreach ($comment->replies as $reply)
          <!-- Item -->
          <li class="list-comment-item">
            <!-- Media -->
            <div class="d-flex align-items-center mb-3">
              <div class="flex-shrink-0">
                <img class="avatar avatar-circle" src="{{ $reply->user->image ?? '/assets/img/160x160/img10.jpg' }}" alt="Image Description">
              </div>

              <div class="flex-grow-1 ms-3">
                <div class="d-flex justify-content-between align-items-center">
                  <h6>{{ $reply->user->name }}</h6>
                  <span class="d-block small text-muted">{{ $reply->created_at->format('Y-m-d h:i:s') }}</span>
                </div>
              </div>
            </div>
            <!-- End Media -->

            <p>{{ $reply->reply }}</p>
          </li>
          <!-- End Item -->
          @endforeach
        </ul>
        <!-- End Comment -->
      </li>
      <!-- End Item -->
    @endforeach
    </ul>
    <!-- End Comment -->
  </div>
  <!-- End Col -->
</div>
<!-- End Row -->
</div>
<!-- End Comment -->

<!-- Post a Comment -->
<div class="container">
<!-- Heading -->
<div class="w-lg-65 text-center mx-lg-auto mb-7">
  <h3>Post a comment</h3>
</div>
<!-- End Heading -->

<div class="row justify-content-lg-center" id="comment">
  <div class="col-lg-8">
    <!-- Card -->
    <div class="card card-lg card-bordered shadow-none">
      <div class="card-body">
        @if (auth()->check())
        <form method="post">
            @csrf
          <div class="d-grid gap-4">
            <!-- Form -->
            <input type="hidden" name="user_id" value="{{ auth()->id() }}">
            <input type="hidden" name="comment_id" id="comment_id">
            <span class="d-block">
              <label class="form-label" for="blogContactsFormComment">Comment</label>
              <textarea class="form-control" id="blogContactsFormComment" name="comment" placeholder="Leave your comment here..." aria-label="Leave your comment here..." rows="5"></textarea>
            </span>
            <!-- End Form -->

            <div class="d-grid">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </div>
        </form>
        @else
            <div class="alert alert-light">Please <a href="{{ route('user.login') }}">login</a> to post comment</div>
        @endif
      </div>
    </div>
    <!-- End Card -->
  </div>
  <!-- End Col -->
</div>
<!-- End Row -->
</div>
<!-- End Post a Comment -->
@endsection

@section('scripts')
    <script>
        $('body').on('click', '.rpl', function () {
            let id = $(this).data('comment_id')
            $('#comment_id').val(id)
        })
    </script>
@endsection
