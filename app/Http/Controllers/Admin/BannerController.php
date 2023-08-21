<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banner = Banner::orderBy('id','DESC')->get();
        return view('backend.banners.index',compact('banner'));
    }

    /**
     * Summary of __invoke
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function __invoke(Request $request){
        if($request->mode=='true'){
            DB::table('banners')->where('id', $request->id)->update(['status'=> 'Active']);
        }
        else{
            DB::table('banners')->where('id', $request->id)->update(['status'=> 'Inactive']);
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
        return view('backend.banners.create');
        //
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
                'description'=>'required',
                'image'=>'required|mimes:jpeg,png,jpg|file|max:2048',
                'condition'=>'required',
                'status'=>'required',
            ]);
           
            $image =$request->image;
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $request->image->move('backend/assets/images', $imageName);
            
            $slug = Str::slug($request->input('title'));
            $slug_count =Banner::where('slug',$slug)->count();
            if($slug_count>0){
                $slug=time().'-'.$slug;
            }
            $data['slug'] =$slug;

            $banner = new Banner();
             $banner->title = $validate['title'];
             $banner->description = $validate['description'];
             $banner->condition = $validate['condition'];
             $banner->status = $validate['status'];
             $banner->slug = $slug;
             $banner->photo =$imageName;
             $banner->save();
             return redirect()->back()->with('message','Banner SuccessFully added');


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
       $banner =Banner::find($id);
       if($banner){
        return view('backend.banners.edit',compact('banner'));
       }
       else{
        return back()->with('message', 'Data not Found');
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
        $validate = $request->validate([
            'title'=>'required',
            'description'=>'required',
            'image'=>'nullable|mimes:jpeg,png,jpg|file|max:2048',
            'condition'=>'required',
            'status'=>'required',
        ]);

        if($image =$request->image){ 
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $request->image->move('backend/assets/images', $imageName);
        }
            
            $banner = Banner::find($id);

        if (!$banner) {
            return redirect()->back()->with('message', 'Banner not found');
        }else{
            $banner->title = $validate['title'];
            $banner->description = $validate['description'];
            $banner->condition = $validate['condition'];
            $banner->status = $validate['status'];
        
            if (!empty($imageName)) {
                $banner->photo = $imageName;
            }
            $banner->save();
            return redirect()->route('banner.index')->with('massage', 'Banner successfully updated');
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
        $banner = Banner::find($id);

        if (!$banner) {
            return redirect()->back()->with('message', 'Banner not found');
        } else {
            $photoPath = public_path('backend/assets/images/' . $banner->photo);
        
            // Delete the associated photo file from the directory
            if (file_exists($photoPath)) {
                unlink($photoPath);
            }
        
            // Delete the banner object from the database
            $banner->delete();
        
            return redirect()->route('banner.index')->with('message', 'Banner and photo successfully Deleted');
        }
        
    }
}
