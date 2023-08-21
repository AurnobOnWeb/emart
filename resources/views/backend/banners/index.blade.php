@extends('backend.layouts.master')
@section('title')
E-mart | Show All Banner 
@endsection
@section('content')
<div class="dashboard-wrapper">
    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content ">
            <!-- ============================================================== -->
            <!-- pageheader  -->
            <!-- ============================================================== -->
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="page-header">
                        
                        <h2 class="pageheader-title">
                            <p class="float-right"  style="margin-right: 1%"> <a href="{{ route('banner.create') }}" class="btn btn-outline-primary" style="margin: 5px">
                                <i class="fas fa-plus" aria-hidden="true"></i> Add Banner</a></p> 
                            All Banner & Promo Are Here.   
                        </h2>
                       
                            <br>
                        <p style="color: gray; font-style:inherit; margin-right: 2%; margin-top:10px" class="float-right" >Total Banner - {{ \App\Models\Banner::count() }}</p> 
                        <p class="pageheader-text">Check Out the Banners</p>
                        <div class="page-breadcrumb">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('admin') }}" class="breadcrumb-link">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Banner</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- end pageheader  -->
            <!-- ============================================================== -->
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered second text-center" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Slug</th>
                                        <th>Banner/Promo</th>
                                        <th>Conditon</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                @if(session()->has('message'))
                                <x-alert type="danger" message="message"/> 
                               @endif 
                               @if(session()->has('massage'))
                               <x-alert type="primary" message="massage"/> 
                              @endif 
                                <tbody>
                                    @foreach($banner as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->title }}</td>
                                        <td>{{ $item->description }}</td>
                                        <td>{{ $item->slug }}</td>
                                        <td> <img src="{{ url('backend/assets/images/',$item->photo) }}" alt="Banner/Promo" style="max-height: 90px; max-width:120px;"></td>
                                        <td>
                                            @if($item->condition == 'banner')
                                                <span class="badge badge-primary">Banner</span>
                                            @else
                                            <span class="badge badge-success">Promo</span>
                                            @endif
                                         </td>
                                         <td>
                                            <input type="checkbox" name="toggle" {{ $item->status == 'Active' ? 'checked' : '' }} data-toggle="toggle" value="{{ $item->id }}" data-on="Active" data-off="Inactive" data-onstyle="primary" data-offstyle="danger">
                                         </td>
                                        <td>
                                            <a href="{{ route('banner.edit',$item->id) }}" class="btn btn-outline-primary" style="margin: 5px">
                                                <i class="fas fa-pencil-alt" aria-hidden="true"></i></a>
                                            <a href="{{ route('banner.edit',$item->id) }}" type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#myModal{{ $item->id }}">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </td>
                                        @endforeach
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @foreach($banner as $item)
    <div class="modal fade" id="myModal{{ $item->id }}">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fas fa-exclamation-circle" style="color: red; "></i> Delete This Data?</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    {{ $item->title }}
                    <br>
                    Are You Sure ?  
                     <br>If you delete the data, you will not able to recover the data
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <form method="POST" action="{{ route('banner.destroy',$item->id) }}">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-primary">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
 @endforeach
    <script>
        $(document).ready(function() {
            $('input[name=toggle]').change(function() {
                var mode = $(this).prop('checked');
                var id = $(this).val();
                var token = '{{ csrf_token() }}'; // Assuming the token is echoed from server-side code
    
                $.ajax({
                    url: "{{ route('update.banner.status') }}",
                    type: "POST",
                    data: {
                        _token: token,
                        mode: mode,
                        id: id
                    },
                    success: function(response) {
                        if (response.status) {
                            alert(response.msg);
                        } else {
                            alert('Please Try Again');
                        }
                    },
                    error: function() {
                        alert('An error occurred during the request. Please try again later.');
                    }
                });
    
            });
        });
    </script>
    <!-- ============================================================== -->
    <!-- footer -->
    <!-- ============================================================== -->
    @include('backend.layouts.foot')
    <!-- ============================================================== -->
    <!-- end footer -->
    <!-- ============================================================== -->
</div>
@endsection
