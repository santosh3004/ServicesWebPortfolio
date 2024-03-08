@extends('admin.admin_master')

@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title">Footer</h4>

                <form method="POST" action="{{route('update.footer')}}">
                    @csrf
                    <input type="hidden" name="id" value="{{$footerdetails->id}}"/>
                <div class="row mb-3">
                    <label for="example-text-input" class="col-sm-2 col-form-label">Number</label>
                    <div class="col-sm-10">
                        <input class="form-control" name="number" type="text" value="{{$footerdetails->number}}" id="number">
                    </div>
                </div>
                <!-- end row -->


                <div class="row mb-3">
                    <label for="example-text-input" class="col-sm-2 col-form-label">Short Description</label>
                    <div class="col-sm-10">
                        <textarea id="desccription" name="description" class="form-control" maxlength="225" rows="3" placeholder="This textarea has a limit of 225 chars.">{{$footerdetails->description}}</textarea>
                    </div>
                </div>
                <!-- end row -->

                <div class="row mb-3">
                    <label for="example-text-input" class="col-sm-2 col-form-label">Address</label>
                    <div class="col-sm-10">
                        <input class="form-control" name="address" type="text" value="{{$footerdetails->address}}" id="address">
                    </div>
                </div>
                <!-- end row -->

                <div class="row mb-3">
                    <label for="example-text-input" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input class="form-control" name="email" type="email" value="{{$footerdetails->email}}" id="email">
                    </div>
                </div>
                <!-- end row -->

                <div class="row mb-3">
                    <label for="example-text-input" class="col-sm-2 col-form-label">Facebook</label>
                    <div class="col-sm-10">
                        <input class="form-control" name="facebook" type="text" value="{{$footerdetails->facebook}}" id="facebook">
                    </div>
                </div>
                <!-- end row -->

                <div class="row mb-3">
                    <label for="example-text-input" class="col-sm-2 col-form-label">Twitter</label>
                    <div class="col-sm-10">
                        <input class="form-control" name="twitter" type="text" value="{{$footerdetails->twitter}}" id="twitter">
                    </div>
                </div>
                <!-- end row -->

                <div class="row mb-3">
                    <label for="example-text-input" class="col-sm-2 col-form-label">Copyright</label>
                    <div class="col-sm-10">
                        <input class="form-control" name="copy_right" type="text" value="{{$footerdetails->copy_right}}" id="copy_right">
                    </div>
                </div>
                <!-- end row -->



<center>
                <input type="submit" class="btn btn-info btn-rounded waves-effect waves-light" value="Update Footer"/>
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
