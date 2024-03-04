@extends('admin.admin_master')

@section('admin')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title">Add Blog Category</h4>
<br>
                <form method="POST" action="{{route('store.blog.category')}}" >
                    @csrf

                <div class="row mb-3">
                    <label for="example-text-input" class="col-sm-2 col-form-label">Blog Category Name</label>
                    <div class="col-sm-10">
                        <input class="form-control" name="blog_category" type="text"  id="title">
                        @error('blog_category')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <!-- end row -->





<center>
                <input type="submit" class="btn btn-info btn-rounded waves-effect waves-light" value="Add Blog Category"/>
</center>
            </form>
            </div>
        </div>
    </div> <!-- end col -->
</div>


@endsection
