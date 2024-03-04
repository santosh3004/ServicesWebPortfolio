@extends('admin.admin_master')

@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title">Add Blog</h4>

                <form method="POST" action="{{route('store.blog')}}" enctype="multipart/form-data">
                    @csrf

                <div class="row mb-3">
                    <label for="example-text-input" class="col-sm-2 col-form-label">Blog Title</label>
                    <div class="col-sm-10">
                        <input class="form-control" name="blog_title" type="text"  id="title">
                        @error('blog_title')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <!-- end row -->

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Blog Category</label>
                    <div class="col-sm-10">
                        <select class="form-select" name="blog_category" aria-label="Default select example">
                            <option selected="">Open this select menu</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                            </select>
                    </div>
                    @error('blog_category')
                    <span class="text-danger">{{$message}}</span>
                @enderror
                </div>
                <!-- end row -->

                <div class="row mb-3">
                    <label for="example-text-input" class="col-sm-2 col-form-label">Blog Tags</label>
                    <div class="col-sm-10">
                        <input class="form-control" name="blog_tags" type="text"  id="title">
                        
                    </div>
                </div>
                <!-- end row -->

                <div class="row mb-3">
                    <label for="example-text-input" class="col-sm-2 col-form-label">Blog Description</label>
                    <div class="col-sm-10">
                        <textarea id="blog_desccription" name="blog_description" class="form-control" maxlength="225" rows="3" placeholder="This textarea has a limit of 225 chars."></textarea>
                        @error('blog_description')
                            <span class="text-danger">{{$message}}</span>

                        @enderror
                    </div>
                </div>
                <!-- end row -->

                <div class="row mb-3">
                    <label for="example-text-input" class="col-sm-2 col-form-label">Blog Image</label>
                    <div class="col-sm-10">
                        <input class="form-control" name="blog_image" type="file" id="image">
                        @error('blog_image')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <!-- end row -->
                <div class="row mb-3">
                    <label for="example-text-input" class="col-sm-2 col-form-label">Chosen Image</label>

                    <div class="col-sm-10">
                        <img id="chosenImage" class="rounded  avatar-lg" src="{{asset('upload/no_image.jpg')}}" alt="Blog Image">
                    </div>
                </div>
                <!-- end row -->




<center>
                <input type="submit" class="btn btn-info btn-rounded waves-effect waves-light" value="Add Blog"/>
</center>
            </form>
            </div>
        </div>
    </div> <!-- end col -->
</div>

<script type="text/javascript">
$(document).ready(function(){

    $('#image').change(function(e){
        var reader=new FileReader();
        reader.onload=function(e){
            $('#chosenImage').attr('src',e.target.result);
        }
        reader.readAsDataURL(e.target.files['0']);
    });
}
);
</script>
@endsection
