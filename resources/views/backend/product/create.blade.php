@extends('backend.layouts.master')
@section('title')
E-mart | Create Product
@endsection
@section('content')
<div class="dashboard-wrapper">
    <div class="container-fluid  dashboard-content">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="page-header">
                    <h2 class="pageheader-title">Create Product </h2>
                    <p class="pageheader-text">Fill The form and submit to database Asap.</p>
                    <div class="page-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin') }}" class="breadcrumb-link">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('product.index') }}" class="breadcrumb-link">Product</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Add Product</li>
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
                    <h5 class="card-header">Product Add Form </h5>
                    <div class="card-body">
                        <form id="validationform" method="post" action="{{ route('product.store') }}" enctype="multipart/form-data" data-parsley-validate="" novalidate="">
                            {{ csrf_field() }}
                            @method('post')
                            @if(session()->has('message'))
                            <x-alert type="primary" message="message" />
                            @endif
                            <x-input type="text" name="title" label="Title" value="{{ old('title') }}" ph="Enter title" id="ntg" require="required" />
                            <x-textarea require="" name="description" ph="Write something" label="Description" val="{{ old('description') }}" />
                            <x-textarea name="summary" ph="Write summary" label="Summary" val="{{ old('summary') }}" require="required" />
                            <x-input type="number" name="stock" label="Stock" value="{{ old('stock') }}" ph="Enter Stock" id="ntg" require="required" />
                            <x-input type="number" name="price" label="price" value="{{ old('price') }}" ph="Enter price" id="price" require="required" />
                            <x-input type="number" name="discount" label="Discount" value="{{ old('discount') }}" ph="Enter Discount" id="discount" require="n" />

                            <div class="form-group row">
                                <label class="col-12 col-sm-3 col-form-label text-sm-right">Brand</label>
                                <div class="col-12 col-sm-8 col-lg-6">
                                    <select class="selectpicker" data-live-search="true"  name="brand_id">
                                        <option value="">-- Select Condition --</option>
                                        @foreach(\App\Models\Brands::get() as $item)
                                        <option value="{{ $item->id }}" {{ old('brand_id')==$item->id ? 'selected' :'' }} >{{ $item->title }}</option>
                                        @endforeach
                                    </select>
                                    @error( 'brand_id' )
                                    <br>
                                    <span style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-12 col-sm-3 col-form-label text-sm-right">Category</label>
                                <div class="col-12 col-sm-8 col-lg-6">
                                    <select class="selectpicker" data-live-search="true" required="" name="cat_id" id="cat_id">
                                        <option value="">-- Select Category --</option>
                                        @foreach(\App\Models\Category::where('is_parent','1')->get() as $item)
                                        <option value="{{ $item->id }}" {{ old('cat_id')==$item->id ? 'selected' :'' }} >{{ $item->title }}</option>
                                        @endforeach
                                    </select>
                                    @error( 'cat_id' )
                                    <br>
                                    <span style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row d-none " id="child_cat_div">
                                <label class="col-12 col-sm-3 col-form-label text-sm-right">Child Category</label>
                                <div class="col-12 col-sm-8 col-lg-6">
                                    <select class="form-control"  name="child_cat_id" id="child_cat_id">
                                        <option value="">--- Child Category ---</option>
                                    </select>
                                    @error('child_cat_id')
                                    <br>
                                    <span style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label class="col-12 col-sm-3 col-form-label text-sm-right">Size</label>
                                <div class="col-12 col-sm-8 col-lg-6">
                                    <select class="selectpicker"  name="size">
                                        <option value="">-- Select Size --</option>
                                        <option value="S" {{ old('condition')=='S' ? 'selected' :'' }}>Small</option>
                                        <option value="M" {{ old('condition')=='M' ? 'selected' :'' }}>Medium</option>
                                        <option value="L" {{ old('condition')=='L' ? 'selected' :'' }}>Large</option>
                                    </select>
                                    @error( 'size' )
                                    <br>
                                    <span style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-12 col-sm-3 col-form-label text-sm-right">Condition</label>
                                <div class="col-12 col-sm-8 col-lg-6">
                                    <select class="selectpicker"  name="condition">
                                        <option value="">-- Select Condition --</option>
                                        <option value="new" {{ old('condition')=='new' ? 'selected' :'' }}>New</option>
                                        <option value="popular" {{ old('condition')=='popular' ? 'selected' :'' }}>Popular</option>
                                        <option value="summar" {{ old('condition')=='summar' ? 'selected' :'' }}>Summer</option>
                                        <option value="winter" {{ old('condition')=='winter' ? 'selected' :'' }}>Winter</option>
                                    </select>
                                    @error( 'condition' )
                                    <br>
                                    <span style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-12 col-sm-3 col-form-label text-sm-right">Vendor</label>
                                <div class="col-12 col-sm-8 col-lg-6">
                                    <select class="selectpicker" data-live-search="true" name="vendor_id">
                                        <option value="">-- Select Vendor --</option>
                                        @foreach(\App\Models\User::where('role','vendor')->get() as $item)
                                        <option value="{{ $item->id }}" {{ old('vendor_id')==$item->id ? 'selected' :'' }}>{{ $item->full_name }}</option>
                                        @endforeach
                                    </select>
                                    @error( 'vendor_id' )
                                    <br>
                                    <span style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-12 col-sm-3 col-form-label text-sm-right">Image Photo</label>
                                <div class="col-12 col-sm-8 col-lg-6">
                                    <input type="file" name="image" id="imageInput" required>
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
                                                    <img class="img" id="imagePreview" alt="Uploaded Image" style="max-height:190px; max-width:250px">
                                                </div>
                                            </figure>
                                        </div>
                                    </div>
                                </div>
                            </div>


                           
                            <div class="form-group row">
                                <label class="col-12 col-sm-3 col-form-label text-sm-right">Status</label>
                                <div class="col-12 col-sm-8 col-lg-6">
                                    <select class="selectpicker" required="" name="status">
                                        <option value="">-- Select Status --</option>
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
                                    <a href="{{ route('product.index') }}" class="btn btn-space btn-secondary" style="color: white">Cancel</a>
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

        imageInput.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    imagePreviewContainer.style.display = 'block';
                };

                reader.readAsDataURL(this.files[0]);
            }
        });

    </script>
   <script>
    $(document).ready(function () {
        $('#cat_id').change(function () {
            var cat_id = $(this).val();

            if (cat_id !== "") {
                $.ajax({
                    url: "/admin/category/" + cat_id + "/child",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        cat_id: cat_id
                    },
                    success: function (response) {
                        var childCatDropdown = $('#child_cat_id');
                        childCatDropdown.empty(); // Clear existing options

                        if (response.status && response.data.length > 0) {
                            $('#child_cat_div').removeClass('d-none');

                            // Append each child category option to the dropdown
                            $.each(response.data, function (index, category) {
                                childCatDropdown.append($('<option>', {
                                    value: category.id,
                                    text: category.title
                                }));
                            });
                        } else {
                            $('#child_cat_div').addClass('d-none');
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error(error); // Log any errors for debugging
                    }
                });
            } else {
                $('#child_cat_div').addClass('d-none');
                $('#child_cat_id').empty(); // Clear child category dropdown
            }
        });
    });
</script>

    
    @include('backend.layouts.foot')
</div>
@endsection
