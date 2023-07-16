@extends('layouts.users')
@section('title', 'My Account')
@section('content')
<div class="row justify-content-md-center mb-5">
    <div class="col-md-8">
      <div class="text-center">
        @if ($errors->any())
          @foreach ($errors->all() as   $err)
            <div class="alert alert-soft-danger">{{ $err }}</div>
          @endforeach
        @endif
        <img class="avatar avatar-xxl avatar-circle mb-3 {{ is_null($user->image) ? 'pic' : '' }}" src="{{ $user->image ?? '/assets/img/160x160/img10.jpg' }}" alt="Image Description">
        <div style="display: none" class="mb-3 form">
            <form action="" enctype="multipart/form-data" method="post">
              @csrf
              <div class="input-group">
                <input type="file" name="image" id="image" class="form-control">
                <button class="btn btn-primary">Upload</button>
              </div>
            </form>
        </div>

        <div class="mb-4">
          <h3>{{ $user->name }}</h3>
          <span class="d-block mb-1">{{ '@'.$user->username }}</span>
          <p>
            <div id="copy-result"></div>
            <div class="input-group">
                <input type="text" id="link" class="form-control" value="https://{{ request()->getHost().'/users/register?ref='.$user->username }}" readonly>
                <button class="btn btn-primary cp" id="cp">Copy</button>
                <div id="copy-result"></div>
            </div>
          </p>
        </div>

        <a href="/users/bank" class="btn btn-outline-primary btn-sm">My Bank Info</a>
        <a href="/users/socials" class="btn btn-outline-info btn-sm">My Social Media profiles</a>
      </div>
    </div>
    <!-- End Col -->
  </div>

  <div class="row justify-content-md-center mb-5">
    <div class="col-md-8">
      <div class="text-center">
        <div class="mb-4">
            <h4>Earnings Table</h4>
            <div class="table-responsive mb-4">
                <table class="table table-striped">
                    <tr>
                        <th>Sales Commission (NGN)</th>
                        <th>Actvity Points</th>
                    </tr>
                    <tr>
                        <td>
                            {{ number_format($user->referral_bal) }}
                        </td>
                        <td>
                          {{ number_format($user->activity_bal) }}
                        </td>
                    </tr>
                </table>
            </div>
            <div class="mb-4 text-center">
              <a href="/users/withdrawals" class="btn btn-outline-danger btn-sm">Withdrawals</a>
              <a href="/users/activity" class="btn btn-outline-success btn-sm">Activity History</a>
            </div>
        </div>
      </div>
    </div>

    <div class="row justify-content-md-center mb-5">
      <div class="col-md-8">
        <div class="">
          <div class="mb-4">
              <h4 class="text-center">My Courses</h4>

              @foreach ($user->user_courses as $course)
                <!-- Card -->
                <a class="card card-ghost card-transition-zoom" href="/courses/{{ $course->course->id }}">
                  <div class="card-transition-zoom-item">
                    <img class="card-img" src="{{ $course->course->image ?? '/assets/img/1920x1080/img3.jpg' }}" alt="Image Description">
                  </div>

                  <div class="card-body">
                    <h4>{{ $course->course->name }}</h4>
                    <p class="card-text">{{ $course->course->short_description }}</p>
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
@endsection

@section('scripts')
  <script>
    document.getElementById('cp').addEventListener('click', function () {
      document.getElementById('link').select()
      document.execCommand('copy')
      document.getElementById('copy-result').innerHTML = `<div class="alert alert-soft-success alert-dismissible"><a class="btn-close" href="javascript:void" data-bs-dismiss="alert"></a> Link Copied</div>`
      setTimeout(() => {
        document.getElementById('copy-result').innerHTML = ""
      }, 2000);
    })

    $('.pic').click(function () {
      $('.form').show()
    })
  </script>
@endsection
