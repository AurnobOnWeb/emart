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
                                        <td>{{ number_format($item->price, 2) }} Tk</td>
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
                                            
                                            <a href="" type="button"  title="Delete" class="btn btn-outline-success" data-toggle="modal" data-target="#showmodal{{ $item->id }}">
                                                <i class="fa fa-eye"></i>
                                            <a href="{{ route('product.edit',$item->id) }}" class="btn btn-outline-primary" style="margin: 5px" data-toggle="tooltip" data-placement="top" title="Edit">
                                                <i class="fas fa-pencil-alt" aria-hidden="true"></i></a>
                                            <a href="" type="button"  title="Delete" class="btn btn-outline-danger" data-toggle="modal" data-target="#myModal{{ $item->id }}">
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
    <div class="modal fade" id="showmodal{{ $item->id }}">
        <div class="modal-dialog">
                <!-- Modal Header -->
               
                <!-- Modal body -->
                <div class="modal-body" >
                        <div class="product" style="background-color:white " >
                          
                            <div class="popup-card" style="background-color:white ">
                              <div class="product-img">
                                <img src="{{ url('backend/assets/images/',$item->photo) }}" alt="" height="250px" width="320px">
                              </div>
                              <div class="info">
                                <h2>{{ $item->title }}<br>
                                    <br>
                                    <span> Category : {{ \App\Models\Category::where('id',$item->cat_id)->value('title') }}</span><br>
                                    <span>  Child Category : {{ \App\Models\Category::where('id',$item->child_cat_id)->value('title') }}</span><br>                
                                    <span> Brand : {{ \App\Models\Brands::where('id',$item->brand_id)->value('title') }}</span>
                                    <span> Slug : {{ $item->slug }}</span>
                                    <br>
                                    <span> Stock : {{ $item->stock }}</span></h2>
                                </h2>
                                <p><h4><b style="color: black">Summary </b></h4>- {{ $item->summary }}</p>
                                <p><h4><b style="color: black">Description </b></h4>- {{ $item->description }}</p>

                                 <h3>
                                    <div class="row">
                                        <div class="col-md-4">
                                            Price <br><del> {{ $item->price }}</del> Tk
                                        </div>
                                        <div class="col-md-4">
                                            Discount {{ $item->discount }} %
                                        </div>
                                        <div class="col-md-4">
                                            OfferPrice {{ $item->offer_price }} Tk
                                        </div>
                                    </div>
                                 </h3>
                                 <h3>
                                    <div class="row">
                                        <div class="col-md-4">
                                            Size <br><span class="badge badge-success">{{ $item->size }}</span>
                                        </div>
                                        <div class="col-md-4">
                                            Condition <br>   @if($item->condition == 'summar')
                                            <span class="badge badge-primary">Summer</span>
                                            @elseif($item->condition == 'winter')
                                            <span class="badge badge-info">Winter</span>
                                            @elseif($item->condition == 'new')
                                             <span class="badge badge-success">New</span>
                                            @else
                                            <span class="badge badge-brand">Popular</span>
                                            @endif
                                        </div>
                                        <div class="col-md-4">
                                            OfferPrice  @if($item->status == 'Active')
                                            <span class="badge badge-primary">Active</span>
                                            @else($item->status == 'Inactive')
                                            <span class="badge badge-info">Inactive</span>
                                            @endif
                                        </div>
                                    </div>
                                 </h3>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                </div>
                              </div>
                            </div>
                        </div>  
                </div>   
        </div>
    </div>
    @endforeach


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

    <script type="text/javascript">

         var popupViews = document.querySelectorAll('.popup-view');
        var popupBtns = document.querySelectorAll('.popup-btn');
        var closeBtns = document.querySelectorAll('.close-btn');
    
        //javascript for quick view button
        var popup = function(popupClick){
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
