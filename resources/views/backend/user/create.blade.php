@extends('backend.layouts.master')
@section('title')
E-mart | Create User
@endsection
@section('content')
<div class="dashboard-wrapper">
    <div class="container-fluid  dashboard-content">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="page-header">
                    <h2 class="pageheader-title">Create User </h2>
                    <p class="pageheader-text">Fill The form and submit to database Asap.</p>
                    <div class="page-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin') }}" class="breadcrumb-link">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('user.index') }}" class="breadcrumb-link">USer</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Add User</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- ============================================================== -->
            <!-- valifation types -->
            <!-- ============================================================== -->
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card">
                    <h5 class="card-header">User Add Form </h5>
                    <div class="card-body">
                        <form id="validationform" method="post" action="{{ route('user.store') }}"  enctype="multipart/form-data" data-parsley-validate="" novalidate="">
                            {{ csrf_field() }}
                            @method('post')
                            @if(session()->has('message'))
                             <x-alert type="primary" message="message"/> 
                            @endif 
                            <x-input type="text" name="full_name" label="Full name" value="{{ old('full_name') }}" ph="Enter Full Name" id="ntg"  require="required" />
                            <x-input type="text" name="user_name" label="User name" value="{{ old('user_name') }}" ph="Enter User Name" id="ntg"  require="" />
                            <x-input type="email" name="email" label="Email" value="{{ old('email') }}" ph="Enter Your email" id="ntg"  require="required" />
                            <x-input type="password" name="password" label="Password" value="{{ old('password') }}" ph="Enter Your password" id="inputPassword"  require="required" />
                            <div class="form-group row">
                                <label class="col-12 col-sm-3 col-form-label text-sm-right">Confirm Password</label>
                                <div class="col-12 col-sm-8 col-lg-6">
                                        <input id="inputRepeatPassword" data-parsley-equalto="#inputPassword" type="password" name="password_confirmation" required="" placeholder="Password" class="form-control">
                                    @error( 'password_confirmation' )
                                    <br>
                                    <span style="color: red">{{ $message }}</span>
                                    @enderror 
                                </div>
                            </div>
                           
                            <x-textarea require="" name="address" ph="Your Address" label="Address" val="{{ old('address') }}" />
                            <x-input type="number" name="phone" label="Phone Number" value="{{ old('phone') }}" ph="Enter Your Phone Number" id="ntg"  require="" />


                            <div class="form-group row">
                                <label class="col-12 col-sm-3 col-form-label text-sm-right">Profile Photo</label>
                                <div class="col-12 col-sm-8 col-lg-6">
                                    <input type="file" name="image" id="imageInput" >
                                    @error( 'image' )
                                    <br>
                                    <span style="color: red">{{ $message }}</span>
                                    @enderror 
                                    <br>
                                    <br>
                                    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12" id="imagePreviewContainer" style="display: none;">
                                        <div class="card card-figure">
                                            <figure class="figure">
                                                <div class="figure-attachment">
                                                    <img class="img" id="imagePreview" alt="Uploaded Image" style="max-height:190px; max-width:250px" >
                                                </div>
                                            </figure>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-12 col-sm-3 col-form-label text-sm-right">Role</label>
                                <div class="col-12 col-sm-8 col-lg-6">
                                    <select class="selectpicker" required="" name="role">
                                        <option value="" >-- Select Role --</option>
                                        <option value="admin" {{ old('role')=='admin' ? 'selected' :'' }}>Admin</option>
                                        <option value="vendor" {{ old('role')=='vendor' ? 'selected' :'' }}>Vendor</option>
                                        <option value="customer" {{ old('role')=='customer' ? 'selected' :'' }}>Customer</option>
                                    </select>
                                    @error( 'role' )
                                    <br>
                                    <span style="color: red">{{ $message }}</span>
                                    @enderror 
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-12 col-sm-3 col-form-label text-sm-right">Status</label>
                                <div class="col-12 col-sm-8 col-lg-6">
                                    <select class="selectpicker" required="" name="status">
                                        <option value="" >-- Select Status --</option>
                                        <option value="Active" {{ old('status')=='Active' ? 'selected' :'' }}>Active</option>
                                        <option value="Inactive" {{ old('status')=='Inactive' ? 'selected' :'' }}>Inactive</option>
                                    </select>
                                    @error( 'status' )
                                    <br>
                                    <span style="color: red">{{ $message }}</span>
                                    @enderror 
                                </div>
                            </div>
                            <div class="form-group row text-right">
                                <div class="col col-sm-10 col-lg-9 offset-sm-1 offset-lg-0">
                                    <button type="submit" class="btn btn-space btn-primary">Submit</button>
                                    <a href="{{ route('user.index') }}" class="btn btn-space btn-secondary" style="color: white">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- end valifation types -->
            <!-- ============================================================== -->
        </div>
    </div>
    
    <script>
        const imageInput = document.getElementById('imageInput');
        const imagePreview = document.getElementById('imagePreview');
        const imagePreviewContainer = document.getElementById('imagePreviewContainer');
    
        imageInput.addEventListener('change', function () {
            if (this.files && this.files[0]) {
                const reader = new FileReader();
    
                reader.onload = function (e) {
                    imagePreview.src = e.target.result;
                    imagePreviewContainer.style.display = 'block';
                };
    
                reader.readAsDataURL(this.files[0]);
            }
        });
    </script>
    @include('backend.layouts.foot')
</div>
@endsection
