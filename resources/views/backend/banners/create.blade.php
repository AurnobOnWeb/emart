@extends('backend.layouts.master')
@section('title')
E-mart | Create Banner
@endsection
@section('content')
<div class="dashboard-wrapper">
    <div class="container-fluid  dashboard-content">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="page-header">
                    <h2 class="pageheader-title">Create Banner </h2>
                    <p class="pageheader-text">Fill The form and submit to database Asap.</p>
                    <div class="page-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin') }}" class="breadcrumb-link">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('banner.index') }}" class="breadcrumb-link">Banner</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Add Banner</li>
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
                    <h5 class="card-header">Banner Add Form </h5>
                    <div class="card-body">
                        <form id="validationform" method="post" action="{{ route('banner.store') }}"  enctype="multipart/form-data" data-parsley-validate="" novalidate="">
                            {{ csrf_field() }}
                            @method('post')
                            @if(session()->has('message'))
                             <x-alert type="primary" message="message"/> 
                            @endif 
                            <x-input type="text" name="title" label="Title" value="{{ old('title') }}" ph="Enter title" id="ntg"  require="required" />
                            <x-textarea name="description" ph="Write something" label="Description" val="{{ old('description') }}"  require="required" />
                            <div class="form-group row">
                                <label class="col-12 col-sm-3 col-form-label text-sm-right">Banner / Promo</label>
                                <div class="col-12 col-sm-8 col-lg-6">
                                    <input type="file" name="image" id="imageInput" required>
                                    @error( 'image' )
                                    <br>
                                    <span style="color: red">Image is required</span>
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
                                <label class="col-12 col-sm-3 col-form-label text-sm-right">Condition</label>
                                <div class="col-12 col-sm-8 col-lg-6">
                                    <select class="selectpicker" required="" name="condition">
                                        <option value="" >-- Select Condition --</option>
                                        <option value="banner" {{ old('condition')=='banner' ? 'selected' :'' }}>Banner</option>
                                        <option value="promo" {{ old('condition')=='promo' ? 'selected' :'' }}>Promo</option>
                                    </select>
                                    @error( 'condition' )
                                    <br>
                                    <span style="color: red">condition is required</span>
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
                                    <span style="color: red">status is required</span>
                                    @enderror 
                                </div>
                            </div>
                            <div class="form-group row text-right">
                                <div class="col col-sm-10 col-lg-9 offset-sm-1 offset-lg-0">
                                    <button type="submit" class="btn btn-space btn-primary">Submit</button>
                                    <a href="{{ route('banner.index') }}" class="btn btn-space btn-secondary" style="color: white">Cancel</a>
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
