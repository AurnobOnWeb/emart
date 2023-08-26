@extends('backend.layouts.master')
@section('title')
E-mart | Show All Product
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
                            <p class="float-right" style="margin-right: 1%"> <a href="{{ route('product.create') }}" class="btn btn-outline-primary" style="margin: 5px">
                                    <i class="fas fa-plus" aria-hidden="true"></i> Add Product</a></p>
                            All Products Are Here.
                        </h2>

                        <br>
                        <p style="color: gray; font-style:inherit; margin-right: 2%; margin-top:10px" class="float-right">Total Product - {{ \App\Models\Product::count() }}</p>
                        <p class="pageheader-text">Check Out the Products</p>
                        <div class="page-breadcrumb">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('admin') }}" class="breadcrumb-link">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Product</li>
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
                                        <th>Photo</th>
                                        <th>Price</th>
                                        <th>Discount</th>
                                        <th>offer Price</th>
                                        <th>Stock</th>
                                        <th>Vendor</th>
                                        <th>Condition</th>
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
                                    @foreach($product as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->title }}</td>
                                        <td> <img src="{{ url('backend/assets/images/',$item->photo) }}" alt="Product-photo" style="max-height: 90px; max-width:120px;"></td>
                                        <td>{{ number_format($item->price, 2) }} Tk</td>
                                        <td>{{ $item->discount }} %</td>
                                        <td>{{ number_format($item->offer_price, 2) }} Tk</td>
                                        <td>{{ $item->stock }}</td>

                                        <td>{{ \App\Models\User::where('id',$item->vendor_id)->value('full_name') }}</td>
                                        <td>
                                            @if($item->condition == 'summar')
                                            <span class="badge badge-primary">Summer</span>
                                            @elseif($item->condition == 'winter')
                                            <span class="badge badge-info">Winter</span>
                                            @elseif($item->condition == 'new')
                                            <span class="badge badge-success">New</span>
                                            @else
                                            <span class="badge badge-brand">Popular</span>
                                            @endif
                                        </td>
                                        <td>
                                            <input type="checkbox" name="toggle" {{ $item->status == 'Active' ? 'checked' : '' }} data-toggle="toggle" value="{{ $item->id }}" data-on="Active" data-off="Inactive" data-onstyle="primary" data-offstyle="danger">
                                        </td>
                                        <td>

                                            <a href="" type="button" title="Delete" class="btn btn-outline-success" data-toggle="modal" data-target="#showmodal{{ $item->id }}">
                                                <i class="fa fa-eye"></i>
                                                <a href="{{ route('product.edit',$item->id) }}" class="btn btn-outline-primary" style="margin: 5px" data-toggle="tooltip" data-placement="top" title="Edit">
                                                    <i class="fas fa-pencil-alt" aria-hidden="true"></i></a>
                                                <a href="" type="button" title="Delete" class="btn btn-outline-danger" data-toggle="modal" data-target="#myModal{{ $item->id }}">
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


    @foreach($product as $item)
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
                    <form method="POST" action="{{ route('product.destroy',$item->id) }}">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-primary">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach


    @foreach($product as $item)
    <div class="modal fade bd-example-modal-lg" id="showmodal{{ $item->id }}">
        <div class="modal-dialog modal-lg">
            <!-- Modal Header -->
            <div style="background-color:white">
                <div class="modal-body">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mt-10 mt-4 ">
                        <div class="card card-fluid">
                            <!-- .card-body -->
                            <div class="card-body text-center">
                                <!-- .user-avatar -->
                                <div class="container">
                                    <div class="row">
                                        <div class="col-sm">
                                            <img src="{{ url('backend/assets/images/',$item->photo) }}" alt="User Avatar" class="img-thumbnail mr-3" style="max-height: 150px; max-width:180px;">

                                        </div>
                                        <div class="col-sm">
                                            <img src="{{ url('backend/assets/images/',$item->photoTwo) }}" alt="User Avatar" class="img-thumbnail mr-3" style="max-height: 150px; max-width:180px;">

                                        </div>
                                        <div class="col-sm">
                                            <img src="{{ url('backend/assets/images/',$item->photothree) }}" alt="User Avatar" class="img-thumbnail mr-3" style="max-height: 150px; max-width:180px;">

                                        </div>
                                    </div>
                                </div>
                                <!-- /.user-avatar -->
                                <h3 class="card-title mb-2 text-truncate">
                                    <br>
                                    Product name - {{ $item->title }}
                                </h3>
                                <h6 class="card-subtitle text-muted mb-3">
                                    @if($item->slug)
                                    Slug : {{ $item->slug }}
                                    @endif
                                </h6>
                                <br>
                                <br>
                                <!-- .skills -->
                                <div class="container">
                                    <div class="row">
                                        <div class="col-sm">
                                            <span><b>Category</b> : {{ \App\Models\Category::where('id',$item->cat_id)->value('title') }}</span>

                                        </div>
                                        <div class="col-sm">

                                            <span><b>Child Category</b> :@if( \App\Models\Category::where('id',$item->child_cat_id)->value('title'))
                                                {{ \App\Models\Category::where('id',$item->child_cat_id)->value('title') }}
                                                @else
                                                <span style="color: red">None!</span>
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="container">
                                    <div class="row">
                                        <div class="col-sm">
                                            <span><b>Brand</b> : {{ \App\Models\Brands::where('id',$item->brand_id)->value('title') }}</span>
                                        </div>
                                        <div class="col-sm">
                                            <span> <b>Stock</b> : {{ $item->stock }}</span></h2>
                                        </div>
                                        <div class="col-sm">
                                            <span> <b>Vendor</b> : {{ \App\Models\User::where('id',$item->vendor_id)->value('full_name') }}</span></h2>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="container">
                                    <div class="row">
                                        <div class="col-sm">
                                            <b>Price</b> - <del>{{ $item->price }}</del> Tk
                                        </div>
                                        <div class="col-sm">
                                            <b>Discount</b> - {{ $item->discount }} %
                                        </div>
                                        <div class="col-sm">
                                            <b>Offer Price</b> - {{ $item->offer_price }} Tk
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="container">
                                    <div class="row">
                                        <div class="col-sm">
                                            <b>Size</b> - <span class="badge badge-success">{{ $item->size }}</span>
                                        </div>
                                        <div class="col-sm">
                                            <b>Condition</b> - @if($item->condition == 'summar')
                                            <span class="badge badge-primary">Summer</span>
                                            @elseif($item->condition == 'winter')
                                            <span class="badge badge-info">Winter</span>
                                            @elseif($item->condition == 'new')
                                             <span class="badge badge-success">New</span>
                                            @else
                                            <span class="badge badge-brand">Popular</span>
                                            @endif
                                        </div>
                                        <div class="col-sm">
                                            <b>Status</b>  @if($item->status == 'Active')
                                            <span class="badge badge-primary">Active</span>
                                            @else($item->status == 'Inactive')
                                            <span class="badge badge-info">Inactive</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="container">
                                    <div class="row">
                                        <div class="col-sm">
                                            <h4>Summary</h4><br>
                                            <p>{{ $item->summary }}</p>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="container">
                                    <div class="row">
                                        <div class="col-sm">
                                            <h4>Description</h4><br>
                                            <p>{{ $item->description }}</p>
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
    <script type="text/javascript">
        var popupViews = document.querySelectorAll('.popup-view');
        var popupBtns = document.querySelectorAll('.popup-btn');
        var closeBtns = document.querySelectorAll('.close-btn');

        //javascript for quick view button
        var popup = function(popupClick) {
            popupViews[popupClick].classList.add('active');
        }

        popupBtns.forEach((popupBtn, i) => {
            popupBtn.addEventListener("click", () => {
                popup(i);
            });
        });

        //javascript for close button
        closeBtns.forEach((closeBtn) => {
            closeBtn.addEventListener("click", () => {
                popupViews.forEach((popupView) => {
                    popupView.classList.remove('active');
                });
            });
        });


        $(document).ready(function() {
            $('input[name=toggle]').change(function() {
                var mode = $(this).prop('checked');
                var id = $(this).val();
                var token = '{{ csrf_token() }}'; // Assuming the token is echoed from server-side code

                $.ajax({
                    url: "{{ route('update.product.status') }}"
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
