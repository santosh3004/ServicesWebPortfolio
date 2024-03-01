@extends('admin.admin_master')

@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title">Edit Portfolio</h4>

                <form method="POST" action="{{route('update.portfolio')}}" enctype="multipart/form-data">
                    @csrf
                    <input hidden name="id" value="{{$portfolio->id}}"/>
                <div class="row mb-3">
                    <label for="example-text-input" class="col-sm-2 col-form-label">Portfolio Name</label>
                    <div class="col-sm-10">
                        <input class="form-control" name="portfolio_name" type="text" value="{{$portfolio->portfolio_name}}"  id="title">
                        @error('portfolio_name')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <!-- end row -->

                <div class="row mb-3">
                    <label for="example-text-input" class="col-sm-2 col-form-label">Portfolio Title</label>
                    <div class="col-sm-10">
                        <input class="form-control" name="portfolio_title" type="text" value="{{$portfolio->portfolio_title}}"  id="short_title">
                        @error('portfolio_title')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <!-- end row -->


                <div class="row mb-3">
                    <label for="example-text-input" class="col-sm-2 col-form-label">Portfolio Description</label>
                    <div class="col-sm-10">
                        <textarea id="portfolio_desccription" name="portfolio_description" class="form-control" maxlength="225" rows="3" placeholder="This textarea has a limit of 225 chars.">{!!$portfolio->portfolio_description!!}</textarea>
                        @error('portfolio_description')
                            <span class="text-danger">{{$message}}</span>

                        @enderror
                    </div>
                </div>
                <!-- end row -->

                <div class="row mb-3">
                    <label for="example-text-input" class="col-sm-2 col-form-label">Portfolio Image</label>
                    <div class="col-sm-10">
                        <input class="form-control" name="portfolio_image" type="file" id="image">
                        @error('portfolio_image')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <!-- end row -->
                <div class="row mb-3">
                    <label for="example-text-input" class="col-sm-2 col-form-label">Chosen Image</label>

                    <div class="col-sm-10">
                        <img id="chosenImage" class="rounded  avatar-lg" src="{{!empty($portfolio->portfolio_image)?asset($portfolio->portfolio_image):asset('upload/no_image.jpg')}}" alt="About Image">
                    </div>
                </div>
                <!-- end row -->




<center>
                <input type="submit" class="btn btn-info btn-rounded waves-effect waves-light" value="Update Portfolio"/>
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
