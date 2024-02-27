@extends('admin.admin_master')

@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title">Home Slide</h4>

                <form method="POST" action="{{route('update.slider')}}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{$homeslide->id}}"/>
                <div class="row mb-3">
                    <label for="example-text-input" class="col-sm-2 col-form-label">Title</label>
                    <div class="col-sm-10">
                        <input class="form-control" name="title" type="text" value="{{$homeslide->title}}" id="title">
                    </div>
                </div>
                <!-- end row -->

                <div class="row mb-3">
                    <label for="example-text-input" class="col-sm-2 col-form-label">Short Title</label>
                    <div class="col-sm-10">
                        <input class="form-control" name="short_title" type="text" value="{{$homeslide->short_title}}" id="title">
                    </div>
                </div>
                <!-- end row -->


                <div class="row mb-3">
                    <label for="example-text-input" class="col-sm-2 col-form-label">Video Url</label>
                    <div class="col-sm-10">
                        <input class="form-control" name="video_url" type="text" value="{{$homeslide->video_url}}" id="title">
                    </div>
                </div>
                <!-- end row -->




                <div class="row mb-3">
                    <label for="example-text-input" class="col-sm-2 col-form-label">Home Slider</label>
                    <div class="col-sm-10">
                        <input class="form-control" name="home_slider" type="file" id="image">
                    </div>
                </div>
                <!-- end row -->
                <div class="row mb-3">
                    <label for="example-text-input" class="col-sm-2 col-form-label">Chosen Image</label>

                    <div class="col-sm-10">
                        <img id="chosenImage" class="rounded  avatar-lg" src="{{!empty($homeslide->home_slide)?asset($homeslide->home_slide):asset('upload/no_image.jpg')}}" alt="Home Slider Image">
                    </div>
                </div>
                <!-- end row -->




<center>
                <input type="submit" class="btn btn-info btn-rounded waves-effect waves-light" value="Update Home Slider"/>
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
