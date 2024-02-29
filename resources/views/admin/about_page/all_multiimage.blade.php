@extends('admin.admin_master')

@section('admin')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title">About Page All Images</h4>
                <br>



                    <table id="datatable" class="table table-bordered dt-responsive nowrap dataTable no-footer dtr-inline collapsed" style="border-collapse: collapse; border-spacing: 0px; width: 100%;" role="grid" aria-describedby="datatable_info">
                    <thead>
                    <tr role="row">
                        <th class="sorting_asc" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 135.2px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">SN</th>
                        <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 209.2px;" aria-label="Position: activate to sort column ascending">Image</th>
                        <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 95.2px;" aria-label="Office: activate to sort column ascending">Action</th>
                       </tr>
                    </thead>
                    <tbody>
                        @php
                            $i=1
                        @endphp
                        @foreach($images as $image)
                        <tr class="odd">
                        <td >{{$i++}}</td>
                        <td><img src="{{asset($image->multi_image)}}" alt="" width="100" srcset=""></td>
                        <td>
                            <a href="{{route('about.edit.multiimage',$image->id)}}" class="btn btn-info sm" title="Edit Data"><i class="fas fa-edit"></i></a>
                            <a href="{{route('about.delete.multiimage',$image->id)}}" id="delete" class="btn btn-danger sm" title="Delete Data"><i class="fas fa-trash-alt"></i></a>
                        </td>



                    </tr>  @endforeach
                </tbody>
                </table>
            </div>
        </div>
    </div> <!-- end col -->
</div>




@endsection
