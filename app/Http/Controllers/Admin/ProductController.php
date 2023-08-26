<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::orderBy('id','DESC')->get();
        return view('backend.product.index',compact('product'));
    }

    public function __invoke(Request $request){
        if($request->mode=='true'){
            DB::table('products')->where('id', $request->id)->update(['status'=> 'Active']);
        }
        else{
            DB::table('products')->where('id', $request->id)->update(['status'=> 'Inactive']);
        }
        return response()->json(['msg' => 'Succesfully updated', 'status'=>'true']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'string|required',
            'summary' => 'string|required',
            'description' => 'string|nullable',
            'stock' => 'nullable|numeric',
            'price' => 'nullable|numeric',
            'discount' => 'nullable|numeric',
            'photo' => 'required|mimes:jpeg,png,jpg|file|max:2048',
            'photoTwo' => 'nullable|mimes:jpeg,png,jpg|file|max:2048',
            'photothree' => 'nullable|mimes:jpeg,png,jpg|file|max:2048',
            'cat_id' => 'required|exists:categories,id',
            'child_cat_id' => 'nullable|exists:categories,id',
            'size' => 'nullable',
            'condition' => 'required',
            'status' => 'nullable|in:Active,Inactive',
            'vendor_id' => 'nullable',
            'brand_id' => 'nullable',
        ]);
    
        // Generate and check the slug
        $slug = Str::slug($validatedData['title']);
        $slug_count = Product::where('slug', $slug)->count();
        if ($slug_count > 0) {
            $slug = time() . '-' . $slug;
        }
    
        // Upload and save photos
        $photoPaths = [];
        foreach (['photo', 'photoTwo', 'photothree'] as $photoNameKey) {
            if ($request->hasFile($photoNameKey)) {
                $photo = $request->file($photoNameKey);
                $photoName = time() . '_' . $photoNameKey . '.' . $photo->getClientOriginalExtension();
                $photo->move('backend/assets/images', $photoName);
                $photoPaths[$photoNameKey] = $photoName;
            }
        }
    
        $price = $validatedData['price'];
        $discount = $validatedData['discount'];
        $offer_price = ($price - (($price * $discount) / 100));
    
        $product = new Product();
        $product->title = $validatedData['title'];
        $product->summary = $validatedData['summary'];
        $product->description = $validatedData['description'];
        $product->stock = $validatedData['stock'] ?? null;
        $product->price =  $validatedData['price']  ?? null;
        $product->discount = $validatedData['discount'] ?? null;
        $product->offer_price = $offer_price;
        $product->photo = $photoPaths['photo'];
        $product->photoTwo = $photoPaths['photoTwo'] ?? null;
        $product->photothree = $photoPaths['photothree'] ?? null;
        $product->cat_id = $validatedData['cat_id'];
        $product->child_cat_id = $validatedData['child_cat_id'] ?? null;
        $product->size = $validatedData['size'] ?? null;
        $product->condition = $validatedData['condition'];
        $product->status = $validatedData['status'] ?? null;
        $product->vendor_id = $validatedData['vendor_id'] ?? null;
        $product->brand_id = $validatedData['brand_id'] ?? null;
        $product->slug = $slug;
        $status = $product->save();
    
        if ($status) {
            return redirect()->back()->with('message', 'Product Successfully added');
        } else {
            return redirect()->back()->with('message', 'Something went Wrong');
        }
    }
    
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product =Product::find($id);
        if($product){
         return view('backend.product.edit',compact('product'));
        }
        else{
         return back()->with('product', 'Product Data not Found');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return  redirect()->back()->with('message', 'Data not found');
        }
    
        $validatedData = $request->validate([
            'title' => 'required|string',
            'summary' => 'required|string',
            'description' => 'nullable|string',
            'stock' => 'nullable|numeric',
            'price' => 'nullable|numeric',
            'discount' => 'nullable|numeric',
            'photo' => 'nullable|mimes:jpeg,png,jpg|file|max:2048',
            'photoTwo' => 'nullable|mimes:jpeg,png,jpg|file|max:2048',
            'photothree' => 'nullable|mimes:jpeg,png,jpg|file|max:2048',
            'cat_id' => 'required|exists:categories,id',
            'child_cat_id' => 'nullable|exists:categories,id',
            'size' => 'nullable',
            'condition' => 'required',
            'status' => 'nullable|in:Active,Inactive',
            'vendor_id' => 'nullable',
            'brand_id' => 'nullable',
        ]);
    
        $photoPaths = [];
    
        foreach (['photo', 'photoTwo', 'photothree'] as $photoNameKey) {
            if ($request->hasFile($photoNameKey)) {
                $photo = $request->file($photoNameKey);
                $photoName = time() . '_' . $photoNameKey . '.' . $photo->getClientOriginalExtension();
                $photo->move('backend/assets/images', $photoName);
                $photoPaths[$photoNameKey] = $photoName;
            }
        }
    
        $price = $validatedData['price'];
        $discount = $validatedData['discount'];
        $offer_price = ($price - (($price * $discount) / 100));
    
        $product->title = $validatedData['title'];
        $product->summary = $validatedData['summary'];
        $product->description = $validatedData['description'];
        $product->stock = $validatedData['stock'] ?? null;
        $product->price = $validatedData['price'] ?? null;
        $product->discount = $validatedData['discount'] ?? null;
        $product->offer_price = $offer_price;
    
        if (isset($photoPaths['photo'])) {
            $product->photo = $photoPaths['photo'];
        }
        if (isset($photoPaths['photoTwo'])) {
            $product->photoTwo = $photoPaths['photoTwo'];
        }
        if (isset($photoPaths['photothree'])) {
            $product->photothree = $photoPaths['photothree'];
        }
    
        $product->cat_id = $validatedData['cat_id'];
        $product->child_cat_id = $validatedData['child_cat_id'] ?? null;
        $product->size = $validatedData['size'] ?? null;
        $product->condition = $validatedData['condition'];
        $product->status = $validatedData['status'] ?? null;
        $product->vendor_id = $validatedData['vendor_id'] ?? null;
        $product->brand_id = $validatedData['brand_id'] ?? null;
    
        if ($product->save()) {
            return redirect()->route('product.index')->with('massage', 'Product successfully updated');
        } else {
            return redirect()->back()->with('message', 'Something went wrong');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);

    if (!$product) {
        return redirect()->back()->with('message', 'Product not found');
    }

    $photoProperties = ['photo', 'photoTwo', 'photothree'];
    $deletedPhotos = [];

    foreach ($photoProperties as $photoProperty) {
        if ($product->$photoProperty) {
            $photoPath = public_path('backend/assets/images/' . $product->$photoProperty);
            
            if (file_exists($photoPath)) {
                if (unlink($photoPath)) {
                    $deletedPhotos[] = $photoProperty;
                } else {
                    return redirect()->back()->with('message', 'Error deleting photos');
                }
            }
        }
    }

    try {
        $product->delete();
        $message = 'Product successfully deleted';
        
        if (!empty($deletedPhotos)) {
            $message .= ' along with photos';
        }
        
        return redirect()->route('product.index')->with('message', $message);
    } catch (\Exception $e) {
        return redirect()->back()->with('message', 'Error deleting product: ' . $e->getMessage());
    }
    }
}
