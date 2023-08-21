<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Brands;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brand = Brands::orderBy('id','DESC')->get();
        return view('backend.brand.index',compact('brand'));
    }
    public function __invoke(Request $request){
        if($request->mode=='true'){
            DB::table('brands')->where('id', $request->id)->update(['status'=> 'Active']);
        }
        else{
            DB::table('brands')->where('id', $request->id)->update(['status'=> 'Inactive']);
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
        return view('backend.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'title'=>'required',
            'image'=>'required|mimes:jpeg,png,jpg|file|max:2048',
            'status'=>'required',
        ]);
        $image =$request->image;
        $imageName = time().'.'.$image->getClientOriginalExtension();
        $request->image->move('backend/assets/images', $imageName);
        
        $slug = Str::slug($request->input('title'));
        $slug_count =Brands::where('slug',$slug)->count();
        if($slug_count>0){
            $slug=time().'-'.$slug;
        }

        $data = $request->all();
        $data['slug'] =$slug;
        $data['photo'] =$imageName;
        $status = Brands::create($data);
        if($status){
            return redirect()->back()->with('message','Brand SuccessFully added');

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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $brand =Brands::find($id);
        if($brand){
         return view('backend.brand.edit',compact('brand'));
        }
        else{
         return back()->with('brand', 'Data not Found');
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
        $brand = Brands::find($id);

        $validate = $request->validate([
            'title'=>'required',
            'image'=>'nullable|mimes:jpeg,png,jpg|file|max:2048',
            'status'=>'required',
        ]);
        $data = $request->all();
        $image =$request->image;
        if($image){
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $request->image->move('backend/assets/images', $imageName);
            $data['photo'] =$imageName;
        }

        
        $status = $brand->fill($data)->save();
        if($status){
           return redirect()->route('brand.index')->with('massage', 'Brand successfully updated');
        }else{
           return redirect()->back()->with('message','Something went Wrpng');

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
        $brand = Brands::find($id);

        if (!$brand) {
            return redirect()->back()->with('message', 'Brand not found');
        } else {
            $photoPath = public_path('backend/assets/images/' . $brand->photo);
        
            // Delete the associated photo file from the directory
            if (file_exists($photoPath)) {
                unlink($photoPath);
            }
        
            // Delete the brand object from the database
            $brand->delete();
        
            return redirect()->route('brand.index')->with('message', 'Brand and photo successfully Deleted');
        }
    }
}
