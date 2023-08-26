@extends('backend.layouts.master')
@section('title')
E-mart | Update Product
@endsection
@section('content')
<div class="dashboard-wrapper">
    <div class="container-fluid  dashboard-content">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="page-header">
                    <h2 class="pageheader-title">Update Product </h2>
                    <p class="pageheader-text">Fill The form and submit to database Asap.</p>
                    <div class="page-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin') }}" class="breadcrumb-link">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('product.index') }}" class="breadcrumb-link">Product</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Update Product</li>
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
                    <h5 class="card-header">Product Update Form </h5>
                    <div class="card-body">
                        <form id="validationform" method="post" action="{{ route('product.update',$product->id) }}" enctype="multipart/form-data" data-parsley-validate="" novalidate="">
                            {{ csrf_field() }}
                            @method('patch')
                            @if(session()->has('message'))
                            <x-alert type="primary" message="message" />
                            @endif
                            <x-input type="text" name="title" label="Title" value="{{ $product->title }}" ph="Enter title" id="ntg" require="required" />
                            <x-textarea require="" name="description" ph="Write something" label="Description" val="{{ $product->description }}" />
                            <x-textarea name="summary" ph="Write summary" label="Summary" val="{{ $product->summary }}" require="required" />
                            <x-input type="number" name="stock" label="Stock" value="{{ $product->stock }}" ph="Enter Stock" id="ntg" require="required" />
                            <x-input type="number" name="price" label="price" value="{{ $product->price }}" ph="Enter price" id="price" require="required" />
                            <x-input type="number" name="discount" label="Discount" value="{{ $product->discount }}" ph="Enter Discount" id="discount" require="n" />
                            <div class="form-group row">
                                <label class="col-12 col-sm-3 col-form-label text-sm-right">Category</label>
                                <div class="col-sm-4 col-lg-3 mb-3 mb-sm-0">
                                    <select class="selectpicker" data-live-search="true" required="" name="cat_id" id="cat_id">
                                        <option value="">-- Select Category --</option>
                                        @foreach(\App\Models\Category::where('is_parent','1')->get() as $item)
                                        <option value="{{ $item->id }}" {{ $product->cat_id==$item->id ? 'selected' :'' }}>{{ $item->title }}</option>
                                        @endforeach
                                    </select>
                                    @error( 'cat_id' )
                                    <br>
                                    <span style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-sm-4 col-lg-3 @if(!$product->child_cat_id)
                                       d-none
                                    @endif" id="child_cat_div">
                                    <select class="form-control" name="child_cat_id" id="child_cat_id">
                                        <option value="{{ $product->child_cat_id }}">{{  \App\Models\Category::where('id' ,$product->child_cat_id)->value('title')}}</option>
                                    </select>
                                    @error('child_cat_id')
                                    <br>
                                    <span style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row">
                                <label class="col-12 col-sm-3 col-form-label text-sm-right">Brand</label>
                                <div class="col-sm-4 col-lg-3 mb-3 mb-sm-0">
                                    <select class="selectpicker" data-live-search="true" name="brand_id">
                                        <option value="">-- Select Condition --</option>
                                        @foreach(\App\Models\Brands::get() as $item)
                                        <option value="{{ $item->id }}" {{ $product->brand_id==$item->id ? 'selected' :'' }}>{{ $item->title }}</option>
                                        @endforeach
                                    </select>
                                    @error( 'brand_id' )
                                    <br>
                                    <span style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-sm-4 col-lg-3 ">
                                    <select class="selectpicker" name="size">
                                        <option value="">-- Select Size --</option>
                                        <option value="S" {{ $product->size=='S' ? 'selected' :'' }}>Small</option>
                                        <option value="M" {{ $product->size=='M' ? 'selected' :'' }}>Medium</option>
                                        <option value="L" {{ $product->size=='L' ? 'selected' :'' }}>Large</option>
                                    </select>
                                    @error( 'size' )
                                    <br>
                                    <span style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-12 col-sm-3 col-form-label text-sm-right">Condition</label>
                                <div class="col-sm-4 col-lg-3 mb-3 mb-sm-0">
                                    <select class="selectpicker" name="condition">
                                        <option value="">-- Select Condition --</option>
                                        <option value="new" {{ $product->condition=='new' ? 'selected' :'' }}>New</option>
                                        <option value="popular" {{ $product->condition=='popular' ? 'selected' :'' }}>Popular</option>
                                        <option value="summar" {{ $product->condition=='summar' ? 'selected' :'' }}>Summer</option>
                                        <option value="winter" {{ $product->condition=='winter' ? 'selected' :'' }}>Winter</option>
                                    </select>
                                    @error( 'condition' )
                                    <br>
                                    <span style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-sm-4 col-lg-3 ">
                                    <select class="selectpicker" data-live-search="true" name="vendor_id">
                                        <option value="">-- Select Vendor --</option>
                                        @foreach(\App\Models\User::where('role','vendor')->get() as $item)
                                        <option value="{{ $item->id }}" {{ $product->vendor_id==$item->id ? 'selected' :'' }}>{{ $item->full_name }}</option>
                                        @endforeach
                                    </select>
                                    @error( 'vendor_id' )
                                    <br>
                                    <span style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-12 col-sm-3 col-form-label text-sm-right">Status</label>
                                <div class="col-12 col-sm-8 col-lg-6">
                                    <select class="selectpicker" required="" name="status">
                                        <option value="">-- Select Status --</option>
                                        <option value="Active" {{ $product->status=='Active' ? 'selected' :'' }}>Active</option>
                                        <option value="Inactive" {{ $product->status=='Inactive' ? 'selected' :'' }}>Inactive</option>
                                    </select>
                                    @error( 'status' )
                                    <br>
                                    <span style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-12 col-sm-3 col-form-label text-sm-right">Previous Image</label>
                                <div class="col-12 col-sm-8 col-lg-6">
                                    @if($product->photo)
                                    <img class="img" src="{{ url('backend/assets/images/',$product->photo) }}" alt="Show Image" style="max-height:190px; max-width:250px;margin-left:10px">
                                    @endif
                                    @if($product->photoTwo)
                                    <img class="img" src="{{ url('backend/assets/images/',$product->photoTwo) }}" alt="Show Image" style="max-height:190px; max-width:250px; margin-left:10px">
                                    @endif
                                    @if($product->photothree)
                                    <img class="img" src="{{ url('backend/assets/images/',$product->photothree) }}" alt="Show Image" style="max-height:190px; max-width:250px;margin-left:10px">
                                    @endif
                                </div>
                            </div>



                            <div class="form-group row" id="img">
                                <label class="col-12 col-sm-3 col-form-label text-sm-right"> Product Photo 1 </label>
                                <div class="col-12 col-sm-8 col-lg-6">
                                    <input type="file" name="photo" id="imageInput1">
                                    <a class="btn btn-space btn-success " style="color: white; margin-left: 10px;" id="addMore">+</a>
                                    <a class="btn btn-space btn-danger d-none " style="color: white; margin-left: 10px" id="remove">-</a>

                                    @error( 'photo' )
                                    <br>
                                    <span style="color: red">{{ $message }}</span>
                                    @enderror

                                </div>
                            </div>
                            <div class="form-group row d-none" id="img2">
                                <label class="col-12 col-sm-3 col-form-label text-sm-right">Product Photo 2</label>
                                <div class="col-12 col-sm-8 col-lg-6">
                                    <input type="file" name="photoTwo" id="imageInput2">
                                    @error( 'photoTwo' )
                                    <br>
                                    <span style="color: red">{{ $message }}</span>
                                    @enderror

                                </div>
                            </div>
                            <div class="form-group row d-none" id="img3">
                                <label class="col-12 col-sm-3 col-form-label text-sm-right">Product Photo 3</label>
                                <div class="col-12 col-sm-8 col-lg-6">
                                    <input type="file" name="photothree" id="imageInput3">
                                    @error( 'photothree' )
                                    <br>
                                    <span style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row d-none imagePreviewContainer" id="imagePreviewContainer">
                                <label class="col-12 col-sm-3 col-form-label text-sm-right">Selected Picture</label>
                                <div class="col-6 col-sm-8 col-lg-6">
                                    <div class="row">
                                        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                                            <div class="card card-figure">
                                                <figure class="figure">
                                                    <div class="figure-attachment">
                                                        <img class="img" id="imagePreview1" alt="Uploaded Image" style="max-height:200px; max-width:220px;">
                                                    </div>
                                                    <figcaption class="figure-caption">
                                                        <h6 class="figure-title"> First Image </h6>
                                                        <a id="remove1" class="btn btn-light" style="float: right; color:black; "> <i class="fas fa-window-close"></i></a>
                                                    </figcaption>
                                                </figure>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12 d-none" id="images2">
                                            <div class="card card-figure">
                                                <figure class="figure">
                                                    <div class="figure-attachment">
                                                        <img class="img " id="imagePreview2" alt="Uploaded Image" style="max-height:200px; max-width:220px;">
                                                    </div>
                                                    <figcaption class="figure-caption">
                                                        <h6 class="figure-title"> Second Image </h6>
                                                        <a id="remove2" class="btn btn-light" style="float: right; color:black; "> <i class="fas fa-window-close"></i></a>

                                                    </figcaption>
                                                </figure>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12 d-none" id="images3">
                                            <div class="card card-figure">
                                                <figure class="figure">
                                                    <div class="figure-attachment">
                                                        <img class="img" id="imagePreview3" alt="Uploaded Image" style="max-height:200px; max-width:220px;">
                                                    </div>
                                                    <figcaption class="figure-caption">
                                                        <h6 class="figure-title"> Third Image </h6>
                                                        <h6 class="figure-title" style="float: left;"><i>X</i></h6>
                                                        <a id="remove3" class="btn btn-light" style="float: right; color:black; "> <i class="fas fa-window-close"></i></a>
                                                    </figcaption>
                                                </figure>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>




                            <div class="form-group row text-right">
                                <div class="col col-sm-10 col-lg-9 offset-sm-1 offset-lg-0">
                                    <button type="submit" class="btn btn-space btn-primary">Update</button>
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
        document.addEventListener("DOMContentLoaded", function() {
            let imageCounter = 1;

            const addMoreButton = document.getElementById("addMore");
            const image2 = document.getElementById("img2");
            const image3 = document.getElementById("img3");
            const btn1 = document.getElementById("remove");

            addMoreButton.addEventListener("click", function() {
                if (imageCounter === 1) {
                    image2.classList.remove('d-none');
                    btn1.classList.remove('d-none');
                } else if (imageCounter === 2) {
                    image3.classList.remove('d-none');
                } else {
                    addMoreButton.style.pointerEvents = "none";
                    addMoreButton.style.cursor = "default";
                    addMoreButton.textContent = "Max Images Reached";
                    alert("You can't add more than 3 images.");
                    imageCounter = 2;
                }
                imageCounter++;
                console.log(imageCounter);
            });

            btn1.addEventListener("click", function() {
                if (imageCounter === 3) {
                    image3.classList.add('d-none');
                    addMoreButton.style.pointerEvents = "auto";
                    addMoreButton.style.cursor = "pointer";
                    addMoreButton.textContent = "+";
                } else if (imageCounter === 2) {
                    image2.classList.add('d-none');
                    btn1.classList.add('d-none');
                }
                imageCounter--;
            });
        });

    </script>
    <script>
        const imageInput1 = document.getElementById('imageInput1');
        const imagePreview1 = document.getElementById('imagePreview1');
        const imageInput2 = document.getElementById('imageInput2');
        const imagePreview2 = document.getElementById('imagePreview2');
        const imageInput3 = document.getElementById('imageInput3');
        const imagePreview3 = document.getElementById('imagePreview3');
        const imagePreviewContainer = document.getElementById('imagePreviewContainer');
        const img2 = document.getElementById('images2');
        const img3 = document.getElementById('images3');
        const clearButton1 = document.getElementById('remove1');
        const clearButton2 = document.getElementById('remove2');
        const clearButton3 = document.getElementById('remove3');

        // FUNCTION OF GETTING VIEW IMAGE

        function setupImageInput(inputElement, previewElement, containerElement) {
            inputElement.addEventListener('change', function() {
                if (this.files && this.files[0]) {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        previewElement.classList.remove('d-none');
                        previewElement.src = e.target.result;
                        containerElement.classList.remove('d-none');
                    };

                    reader.readAsDataURL(this.files[0]);
                }
            });
        }

        setupImageInput(imageInput1, imagePreview1, imagePreviewContainer);
        setupImageInput(imageInput2, imagePreview2, img2);
        setupImageInput(imageInput3, imagePreview3, img3);


        // Add a click event listener to the clear button
        clearButton1.addEventListener('click', () => {
            // Reset the value of the file input, effectively clearing the selected file
            imageInput1.value = '';
            imagePreview1.classList.add('d-none');

        });
        clearButton2.addEventListener('click', () => {
            // Reset the value of the file input, effectively clearing the selected file
            imageInput2.value = '';
            img2.classList.add('d-none');

        });
        clearButton3.addEventListener('click', () => {
            // Reset the value of the file input, effectively clearing the selected file
            imageInput3.value = '';
            img3.classList.add('d-none');

        });

    </script>
    <script>
        $(document).ready(function() {
            $('#cat_id').change(function() {
                var cat_id = $(this).val();

                if (cat_id !== "") {
                    $.ajax({
                        url: "/admin/category/" + cat_id + "/child"
                        , type: "POST"
                        , data: {
                            _token: "{{ csrf_token() }}"
                            , cat_id: cat_id
                        }
                        , success: function(response) {
                            var childCatDropdown = $('#child_cat_id');
                            childCatDropdown.empty(); 
                             // Clear existing options
                            if (response.status && response.data.length > 0) {
                                $('#child_cat_div').removeClass('d-none');

                                // Append each child category option to the dropdown
                                $.each(response.data, function(index, category) {
                                    childCatDropdown.append($('<option>', {
                                        value: category.id
                                        , text: category.title
                                    }));
                                });
                            } else {
                                $('#child_cat_div').addClass('d-none');
                            }
                        }
                        , error: function(xhr, status, error) {
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
