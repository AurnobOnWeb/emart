<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CateygoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::orderBy('id','DESC')->get();
        return view('backend.category.index',compact('category'));
    }

    public function __invoke(Request $request){
        if($request->mode=='true'){
            DB::table('categories')->where('id', $request->id)->update(['status'=> 'Active']);
        }
        else{
            DB::table('categories')->where('id', $request->id)->update(['status'=> 'Inactive']);
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
        $parent_cat =Category::where('is_parent',1)->orderBy('title','ASC')->get();
        return view('backend.category.create' , compact('parent_cat'));
        
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
        'summary'=> 'string|nullable',
        'is_parent'=> 'sometimes|in:1' ,
        'parent_id'=> 'nullable',
        'status'=> 'nullable|in:Active,Inactive',
         ]);
         $image =$request->image;
         $imageName = time().'.'.$image->getClientOriginalExtension();
         $request->image->move('backend/assets/images', $imageName);
         
         $slug = Str::slug($request->input('title'));
         $slug_count =Category::where('slug',$slug)->count();
         if($slug_count>0){
             $slug=time().'-'.$slug;
         }
         
         $data = $request->all();
         $data['slug'] =$slug;
         $data['photo'] =$imageName;
         if($request->parent_id == null){
         $data['is_parent'] = 1 ;
         }else{
         $data['is_parent'] = 0 ;
         }
         $status = Category::create($data);
         if($status){
             return redirect()->back()->with('message','Category SuccessFully added');

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
        $parent_cat =Category::where('is_parent',1)->orderBy('title','ASC')->get();
        $category =Category::find($id);
        if($category){
            return view('backend.category.edit',compact('category','parent_cat'));
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
        $category =Category::find($id);
            $this->validate($request,[
            'title'=> 'string|required',
            'summary'=> 'string|nullable',
            'is_parent'=> 'sometimes|in:1' ,
            'parent_id'=> 'nullable|',
            'status'=> 'nullable|in:Active,Inactive',
             ]);
          
             $data = $request->all();
            //image
             $image =$request->image;
             if($image){
                $imageName = time().'.'.$image->getClientOriginalExtension();
                $request->image->move('backend/assets/images', $imageName);
                $data['photo'] =$imageName;

             }
             if($request->is_parent == 1){
                  $data['parent_id'] = null;
                  $data['is_parent'] = 1;

             }else{
                $data['parent_id'] = $request->parent_id;
                $data['is_parent'] = 0;
             }
             
             $status = $category->fill($data)->save();
             if($status){
                return redirect()->route('category.index')->with('massage', 'Category successfully updated');
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
        
        $category = Category::find($id);
        $child_cat_id= Category::where('parent_id',$id)->pluck('id');
        if (!$category) {
            return redirect()->back()->with('message', 'Category not found');
        } else {
           // Delete the category object from the database
            $status =$category->delete();
            $photoPath = public_path('backend/assets/images/' . $category->photo);
        
            // Delete the associated photo file from the directory
            if (file_exists($photoPath)) {
                unlink($photoPath);
            }
            if($status){
                if(count($child_cat_id)>0){
                    Category::shiftChild($child_cat_id);
                }
            }
            return redirect()->route('category.index')->with('message', 'Category and photo successfully Deleted ');
        }
    }

    public  function getChildByParentID(Request $request, $id)
    {
        $category = Category::find($id); // Use self:: instead of Category::
        
        if ($category) {
            $child_ids = Category::getChildByParent($id); // Use self:: instead of Category::
            
            if (count($child_ids) <= 0) {
                return response()->json(['status' => false, 'data' => null, 'msg' => 'No child categories found.']);
            }
            
            return response()->json(['status' => true, 'data' => $child_ids, 'msg' => 'Child categories found.']);
        } else {
            return response()->json(['status' => false, 'data' => null, 'msg' => 'Parent category not found.']);
        }
    }
}
