@extends('admin.admin_master')

@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title">About Form</h4>

                <form method="POST" action="{{route('update.about')}}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{$aboutdata->id}}"/>
                <div class="row mb-3">
                    <label for="example-text-input" class="col-sm-2 col-form-label">Title</label>
                    <div class="col-sm-10">
                        <input class="form-control" name="title" type="text" value="{{$aboutdata->title}}" id="title">
                    </div>
                </div>
                <!-- end row -->

                <div class="row mb-3">
                    <label for="example-text-input" class="col-sm-2 col-form-label">Short Title</label>
                    <div class="col-sm-10">
                        <input class="form-control" name="short_title" type="text" value="{{$aboutdata->short_title}}" id="short_title">
                    </div>
                </div>
                <!-- end row -->


                <div class="row mb-3">
                    <label for="example-text-input" class="col-sm-2 col-form-label">Short Description</label>
                    <div class="col-sm-10">
                        <textarea id="short_desccription" name="short_description" class="form-control" maxlength="225" rows="3" placeholder="This textarea has a limit of 225 chars.">{{$aboutdata->short_description}}</textarea>
                    </div>
                </div>
                <!-- end row -->

                <div class="row mb-3">
                    <label for="example-text-input" class="col-sm-2 col-form-label">Long Description</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" id="long_description" name="long_description" aria-hidden="true" style="">{{$aboutdata->long_description}}</textarea>
                    </div>
                </div>
                <!-- end row -->




                <div class="row mb-3">
                    <label for="example-text-input" class="col-sm-2 col-form-label">About Image</label>
                    <div class="col-sm-10">
                        <input class="form-control" name="about_image" type="file" id="image">
                    </div>
                </div>
                <!-- end row -->
                <div class="row mb-3">
                    <label for="example-text-input" class="col-sm-2 col-form-label">Chosen Image</label>

                    <div class="col-sm-10">
                        <img id="chosenImage" class="rounded  avatar-lg" src="{{!empty($aboutdata->about_image)?asset($aboutdata->about_image):asset('upload/no_image.jpg')}}" alt="About Image">
                    </div>
                </div>
                <!-- end row -->




<center>
                <input type="submit" class="btn btn-info btn-rounded waves-effect waves-light" value="Update About"/>
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
