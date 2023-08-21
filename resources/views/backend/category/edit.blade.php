@extends('backend.layouts.master')
@section('title')
E-mart | Edit Category
@endsection
@section('content')
<div class="dashboard-wrapper">
    <div class="container-fluid  dashboard-content">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="page-header">
                    <h2 class="pageheader-title">Update Category </h2>
                    <p class="pageheader-text">Fill The form and submit to database Asap to update.</p>
                    <div class="page-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin') }}" class="breadcrumb-link">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('category.index') }}" class="breadcrumb-link">Category</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Update Category</li>
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
                    <h5 class="card-header">Category Update Form </h5>
                    <div class="card-body">
                        <form id="validationform" method="post" action="{{ route('category.update',$category->id) }}"  enctype="multipart/form-data" data-parsley-validate="" novalidate="">
                            {{ csrf_field() }}
                            @method('put')
                            @if(session()->has('message'))
                             <x-alert type="primary" message="message"/> 
                            @endif 
                            @if(session()->has('massage'))
                               <x-alert type="danger" message="massage"/> 
                              @endif 
                            <x-input type="text" name="title" label="Title" value="{{ $category->title }}" ph="Enter title" id="ntg" require="required" />
                            <x-textarea name="summary" ph="Write summary" label="Summary" val="{{$category->summary }}" require="required" />
                            <div class="form-group row">
                                <label class="col-12 col-sm-3 col-form-label text-sm-right">Previous Image</label>
                                <div class="col-12 col-sm-8 col-lg-6">
                            @if($category->photo)
                            <img class="img" src="{{ url('backend/assets/images/',$category->photo) }}"  alt="Show Image" style="max-height:190px; max-width:250px" >
                            
                            @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-12 col-sm-3 col-form-label text-sm-right"> New Category Image</label>
                                <div class="col-12 col-sm-8 col-lg-6">
                                    <input type="file" name="image" id="imageInput" >
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
                                <label class="col-12 col-sm-3 col-form-label text-sm-right">Is parent </label>
                                <div class="col-12 col-sm-8 col-lg-6">
                                    <label class="custom-control custom-checkbox">
                                        <input type="checkbox" value="1"  {{ $category->is_parent=='1' ? 'checked' :'' }} id="is_parent" name="is_parent"  class="custom-control-input"><span class="custom-control-label">Yes</span>
                                    </label>
                                </div>
                            </div>

                            <div class="form-group row  {{ $category->is_parent=='1' ? 'd-none' :'' }}" id="parent_cat_div">
                                <label class="col-12 col-sm-3 col-form-label text-sm-right">Parent Category</label>
                                <div class="col-12 col-sm-8 col-lg-6">
                                    <select id="parent_category" class="selectpicker"  name="parent_id">
                                        <option value="" >-- Parent Category --</option>
                                       @foreach($parent_cat->where('is_parent', 1) as $items)
                                       <option value="{{ $items->id }}" {{ $items->id==$category->parent_id ? 'selected' :'' }} >{{ $items->title }}</option>
                                       @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-12 col-sm-3 col-form-label text-sm-right">Status</label>
                                <div class="col-12 col-sm-8 col-lg-6">
                                    <select class="selectpicker" required="" name="status">
                                        <option value="" >-- Select Status --</option>
                                        <option value="Active" {{ $category->status=='Active' ? 'selected' :'' }}>Active</option>
                                        <option value="Inactive" {{ $category->status=='Inactive' ? 'selected' :'' }}>Inactive</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row text-right">
                                <div class="col col-sm-10 col-lg-9 offset-sm-1 offset-lg-0">
                                    <button type="submit" class="btn btn-space btn-primary">Submit</button>
                                    <a href="{{ route('category.index') }}" class="btn btn-space btn-secondary" style="color: white">Cancel</a>
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
        //for show parent category
        $('#is_parent').change(function(e){
            e.preventDefault();
            var is_checked = $('#is_parent').prop('checked');
          //  alert(is_checked);
          if(is_checked){
            $('#parent_cat_div').addClass('d-none');
            
          }else{
            $('#parent_cat_div').removeClass('d-none');
          }
        })
    </script>
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
