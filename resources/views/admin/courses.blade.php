@extends('layouts.admin')
@section('title', 'Courses')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            @if ($errors->any())
                @foreach ($errors->all() as $err)
                    <div class="alert alert-danger">{{ $err }}</div>
                @endforeach
            @endif
            @if (session()->has('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">
                        Courses
                    </h4>
                    <div class="mb-4">
                        <div class="mb-4">
                            <button class="btn btn-primary" data-toggle="modal" data-target="#course-modal">Add Course</button>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-striped table-hover tb">
                                <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Duration</th>
                                        <th>Amount</th>
                                        <th>Short Description</th>
                                        <th>Description</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($courses as $course)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td><img src="{{ $course->image }}" alt="" class="img-fluid" width="30"></td>
                                            <td>{{ $course->name }}</td>
                                            <td>{{ $course->duration }}</td>
                                            <td>{{ $course->amount }}</td>
                                            <td>{{ $course->short_description }}</td>
                                            <td><a href="#" data-desc="{!! $course->description !!}" data-name="{{ $course->name }}" data-image="{{ $course->image }}" class="btn btn-link desc">View Description</a></td>
                                            <td><a href="/admin/courses/delete/{{ $course->id }}" onclick="return confirm('are you sure, this cannot be undone')" class="btn btn-danger">Delete <i class="mdi mdi-trash-can"></i></a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('modals')
<div class="modal fade" id="course-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    Add Course
                </h4>
                <a href="#" data-dismiss="modal" class="close">&times;</a>
            </div>
            <div class="modal-body">
                <form action="" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">Course Name</label>
                        <input type="text" name="name" id="name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="slug">Slug/Acronym</label>
                        <input type="text" name="slug" id="slug" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="duration">Duration in (Hrs)</label>
                        <input type="text" name="duration" id="duration" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="amount">Amount</label>
                        <input type="number" name="amount" id="amount" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="short_desc">Short Description</label>
                        <textarea name="short_description" id="short_desc" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="quil-snow">Description</label>
                        <textarea name="description" id="quil-snow" data-quiljs class="quil-snow"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" name="image" id="image" class="form-control">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            Add Course
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="desc-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title course-name">

                </h4>
                <a href="#" data-dismiss="modal" class="close">&times;</a>
            </div>
            <div class="modal-body">
                <img src="" alt="" class="img-fluid desc-image mb-4">
                <div class="description-details"></div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script src="/other/quill-textarea.js"></script>
    <script>
        (function() {
            quilljs_textarea('.quil-snow', {
                modules: {
                    'toolbar': [[{ 'font': [] }, { 'size': [] }], ['bold', 'italic', 'underline', 'strike'], [{ 'color': [] }, { 'background': [] }], [{ 'script': 'super' }, { 'script': 'sub' }], [{ 'header': [false, 1, 2, 3, 4, 5, 6] }, 'blockquote', 'code-block'], [{ 'list': 'ordered' }, { 'list': 'bullet' }, { 'indent': '-1' }, { 'indent': '+1' }], ['direction', { 'align': [] }], ['link', 'image', 'video', 'formula'], ['clean']]
                },
                theme: 'snow',
            });
        })();

        $('body').on('click', '.desc', function () {
            let desc = $(this).data('desc')
            let name = $(this).data('name')
            let image = $(this).data('image')
            $('.description-details').html(desc)
            $('.course-name').html(name)
            $('.desc-image').attr('src', image)
            let modal = $('#desc-modal')
            modal.modal('show')
        })

        /*$('form').submit(function (e) {
            e.preventDefault()
            let desc = $('#desc').val(JSON.stringify(quill.getContents()))
            console.log(JSON.stringify(quill.getContents()))
        })*/
        $('.tb').DataTable()
    </script>
@endsection
