@extends('backend.layouts.master')
@section('title')
E-mart | Show All User
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
                            <p class="float-right" style="margin-right: 1%"> <a href="{{ route('user.create') }}" class="btn btn-outline-primary" style="margin: 5px">
                                    <i class="fas fa-plus" aria-hidden="true"></i> Add User</a></p>
                            All User Information Are Here.
                        </h2>

                        <br>
                        <p style="color: gray; font-style:inherit; margin-right: 2%; margin-top:10px" class="float-right">Total Users - {{ \App\Models\User::count() }}</p>
                        <p class="pageheader-text">Check Out the user</p>
                        <div class="page-breadcrumb">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('admin') }}" class="breadcrumb-link">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Users</li>
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
                                        <th>Full Name</th>
                                        <th>user_name</th>
                                        <th>Photo</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Phone</th>
                                        <th>Address</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                @if(session()->has('message'))
                                <x-alert type="danger" message="message" />
                                @endif
                                @if(session()->has('massage'))
                                <x-alert type="primary" message="massage" />
                                @endif
                                <tbody>
                                    @foreach($users as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->full_name }}</td>
                                        <td>{{ $item->user_name }}</td>
                                        <td> <img src="{{ url('backend/assets/images/',$item->photo) }}" alt="UserPhoto" class="rounded-circle" height="70px" width="70px"></td>
                                        <td>{{ $item->email }}</td>
                                        <td>
                                            @if( $item->role == 'customer')
                                            <span class="badge badge-primary">Customer</span>
                                            @elseif(( $item->role == 'vendor'))
                                            <span class="badge badge-success">Vendor</span>
                                            @else
                                            <span class="badge badge-info">Admin</span>
                                            @endif
                                        <td>{{ $item->phone }}</td>
                                        <td>{{ $item->address }}</td>
                                        <td>
                                            <input type="checkbox" name="toggle" {{ $item->status == 'Active' ? 'checked' : '' }} data-toggle="toggle" value="{{ $item->id }}" data-on="Active" data-off="Inactive" data-onstyle="primary" data-offstyle="danger">
                                        </td>
                                        <td>
                                            <a href="" type="button" title="Delete" class="btn btn-outline-success" data-toggle="modal" data-target="#showmodal{{ $item->id }}">
                                                <i class="fa fa-eye"></i>
                                                <a href="{{ route('user.edit',$item->id) }}" class="btn btn-outline-primary" style="margin: 5px">
                                                    <i class="fas fa-pencil-alt" aria-hidden="true"></i></a>
                                                <a href="" type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#myModal{{ $item->id }}">
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
    @foreach($users as $item)
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
                    <span style="color: brown"> {{ $item->full_name }} - Users Data</span>
                    <br>
                    Are You Sure ?
                    <br>If you delete the data, you will not able to recover the data
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <form method="POST" action="{{ route('user.destroy',$item->id) }}">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-primary">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    @foreach($users as $item)
    <div class="modal fade" id="showmodal{{ $item->id }}">
        <div class="modal-dialog">
            <!-- Modal Header -->
            <div style="background-color:white">
                <div class="modal-body">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mt-10 mt-4 ">
                        <div class="card card-fluid">
                            <!-- .card-body -->
                            <div class="card-body text-center">
                                <!-- .user-avatar -->
                                <a href="user-profile.html" class="user-avatar my-3">
                                    <img src="{{ url('backend/assets/images/',$item->photo) }}" alt="User Avatar" class="rounded-circle user-avatar-xl">
                                </a>
                                <!-- /.user-avatar -->
                                <h3 class="card-title mb-2 text-truncate">
                                    <a href="user-profile.html">{{ $item->full_name }} </a>
                                </h3>
                                <h6 class="card-subtitle text-muted mb-3">
                                    @if($item->user_name)
                                    User Name : {{ $item->user_name }}
                                    @endif
                                </h6>
                                <br>
                                <br>
                                <!-- .skills -->
                                <div class="container">
                                    <div class="row">
                                        <div class="col-sm">
                                            Email - <br>{{ $item->email }}
                                        </div>
                                        <div class="col-sm">
                                            Phone - <br>{{ $item->phone }}
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="container">
                                    <div class="row">
                                        <div class="col-sm">
                                            Address - <br>{{ $item->address }}
                                        </div>
                                        <div class="col-sm">
                                            Status - <br>
                                            @if( $item->status == 'Active')
                                            <span class="badge badge-primary">Active</span>
                                            @else
                                            <span class="badge badge-danger">InActive</span>
                                            @endif</td>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="container">
                                    <div class="row">
                                        <div class="col-sm">
                                            Role - @if( $item->role == 'customer')
                                            <span class="badge badge-primary">Customer</span>
                                            @elseif(( $item->role == 'customer'))
                                            <span class="badge badge-success">Vendor</span>
                                            @else
                                            <span class="badge badge-info">Admin</span>
                                            @endif
                                        </div>
                                        <div class="col-sm">
                                        </div>
                                    </div>
                                </div>

                                <!-- /.skills -->
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>



                    <br>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>

                </div>
            </div>
            <!-- Modal body -->

        </div>
    </div>
    @endforeach
</div>
<script>
    $(document).ready(function() {
        $('input[name=toggle]').change(function() {
            var mode = $(this).prop('checked');
            var id = $(this).val();
            var token = '{{ csrf_token() }}'; // Assuming the token is echoed from server-side code

            $.ajax({
                url: "{{ route('update.user.status') }}"
                , type: "POST"
                , data: {
                    _token: token
                    , mode: mode
                    , id: id
                }
                , success: function(response) {
                    if (response.status) {
                        alert(response.msg);
                    } else {
                        alert('Please Try Again');
                    }
                }
                , error: function() {
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
