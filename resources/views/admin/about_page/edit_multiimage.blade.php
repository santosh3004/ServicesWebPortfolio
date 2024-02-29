@extends('admin.admin_master')

@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title">Edit Multi Image</h4>

                <form method="POST" action="{{route('update.multiimage')}}" enctype="multipart/form-data">
                    @csrf
                    <input hidden name="id" value="{{$images->id}}"/>

                <div class="row mb-3">
                    <label for="example-text-input" class="col-sm-2 col-form-label">About Multi Image</label>
                    <div class="col-sm-10">
                        <input class="form-control" name="multi_image" type="file" id="image">
                    </div>
                </div>
                <!-- end row -->
                <div class="row mb-3">
                    <label for="example-text-input" class="col-sm-2 col-form-label">Chosen Image</label>

                    <div class="col-sm-10">
                        <img id="chosenImage" class="rounded  avatar-lg" src="{{!empty($images->multi_image)?asset($images->multi_image):asset('upload/no_image.jpg')}}" alt="About Image">
                    </div>
                </div>
                <!-- end row -->




<center>
                <input type="submit" class="btn btn-info btn-rounded waves-effect waves-light" value="Update Multi Image"/>
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
