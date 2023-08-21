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
        $this->validate($request,[
            'title'=> 'string|required',
            'summary'=> 'string|required',
            'description'=> 'string|nullable' ,
            'stock'=> 'nullable|numeric',
            'price'=> 'nullable|numeric',
            'discount'=> 'nullable|numeric',
            'image'=> 'required',
            'cat_id' => 'required|exists:categories,id',
            'child_cat_id' => 'nullable|exists:categories,id',
            'size'=> 'nullable',
            'condition'=> 'required',
            'status'=> 'nullable|in:Active,Inactive',
            'vendor_id'=> 'nullable',
            'brand_id'=> 'nullable',

        ]);
        $data=$request->all();
        $slug = Str::slug($request->input('title'));
        $slug_count =Product::where('slug',$slug)->count();
        if($slug_count>0){
            $slug=time().'-'.$slug;
        }
        $image =$request->image;
        $imageName = time().'.'.$image->getClientOriginalExtension();
        $request->image->move('backend/assets/images', $imageName);
        $data['slug'] =$slug;
        $data['photo'] =$imageName;
        $price = $request->price;
        $discount = $request->discount;
        $data['offer_price'] =($price-(($price*$discount)/100));
        $status = Product::create($data);
        if($status){
            return redirect()->back()->with('message','Product SuccessFully added');

        }else{
           return redirect()->back()->with('massage','Something went Wrpng');

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
       $product =Product::find($id);
       if($product){
        $this->validate($request,[
            'title'=> 'string|required',
            'summary'=> 'string|required',
            'description'=> 'string|nullable' ,
            'stock'=> 'nullable|numeric',
            'price'=> 'nullable|numeric',
            'discount'=> 'nullable|numeric',
            'image'=> 'nullable',
            'cat_id' => 'required|exists:categories,id',
            'child_cat_id' => 'nullable|exists:categories,id',
            'size'=> 'nullable',
            'condition'=> 'required',
            'status'=> 'nullable|in:Active,Inactive',
            'vendor_id'=> 'nullable',
            'brand_id'=> 'nullable',
        ]);
        $data = $request->all();
        //image if user select
         $image =$request->image;
         if($image){
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $request->image->move('backend/assets/images', $imageName);
            $data['photo'] =$imageName;
         }

         $price = $request->price;
         $discount = $request->discount;
         $data['offer_price'] = ($price-(($price*$discount)/100));
         $status = $product->fill($data)->save();
         if($status){
            return redirect()->route('product.index')->with('massage', 'Product successfully updated');
         }else{
            return redirect()->back()->with('message','Something went Wrong');
         }
       }else{
        return redirect()->back()->with('message','Data Not found');
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
        } else {
            $photoPath = public_path('backend/assets/images/' . $product->photo);
        
            // Delete the associated photo file from the directory
            if (file_exists($photoPath)) {
                unlink($photoPath);
            }
        
            // Delete the banner object from the database
            $product->delete();
        
            return redirect()->route('product.index')->with('message', 'product and photo successfully Deleted');
        }
    }
}
