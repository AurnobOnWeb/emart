<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('id','DESC')->get();
        return view('backend.user.index',compact('users'));
    }
    public function __invoke(Request $request){
        if($request->mode=='true'){
            DB::table('users')->where('id', $request->id)->update(['status'=> 'Active']);
        }
        else{
            DB::table('users')->where('id', $request->id)->update(['status'=> 'Inactive']);
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
        return view('backend.user.create');
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
            'full_name'=>'string|required',
            'user_name'=>'nullable|unique:users,user_name',
            'phone'=>'nullable',
            'address'=>'nullable',
            'email'=>'required|email|unique:users,email',
            'password'=>'min:8|required|confirmed',
            'password_confirmation'=>'min:8|required',
            'image'=>'nullable|mimes:jpeg,png,jpg|file|max:2048',
            'role'=>'required',
            'status'=>'required',
        ]);

        $data = $request->all();

        $data ['password'] = Hash::make($request->password);
        //image
         $image =$request->image;
         if($image){
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $request->image->move('backend/assets/images', $imageName);
            $data['photo'] =$imageName;

         }

         $status = User::create($data);
         if($status){
            return redirect()->route('user.index')->with('massage', 'User successfully Created');
         }else{
            return redirect()->back()->with('message','Something went Wrpng');

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
        $user =User::find($id);
        if($user){
         return view('backend.user.edit',compact('user'));
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
        $user = User::find($id);
        if($user) {
            $this->validate($request,[
            'full_name'=>'string|required',
            'user_name'=>'nullable|exists:users,user_name',
            'phone'=>'nullable',
            'address'=>'nullable',
            'email'=>'required|email|exists:users,email',
            'image'=>'nullable|mimes:jpeg,png,jpg|file|max:2048',
            'role'=>'required',
            'status'=>'required',
           ]);
            $data = $request->all();
            $image =$request->image;
            if($image){
                $imageName = time().'.'.$image->getClientOriginalExtension();
                $request->image->move('backend/assets/images', $imageName);
                $data['photo'] =$imageName;
            }
            $status = $user->fill($data)->save();
            if($status){
               return redirect()->route('user.index')->with('massage', 'User successfully updated');
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
        $user = User::find($id);

        if (!$user) {
            return redirect()->back()->with('message', 'User not found');
        } else {
            if($user->photo){
                $photoPath = public_path('backend/assets/images/' . $user->photo);
        
                // Delete the associated photo file from the directory
                if (file_exists($photoPath)) {
                    unlink($photoPath);
                }
            
                // Delete the user object from the database
                $user->delete();
            
                return redirect()->route('user.index')->with('message', 'User and photo successfully Deleted');
            }
            else{
                $user->delete();
            
                return redirect()->route('user.index')->with('message', 'User successfully Deleted');
            }
           
        }
    }
}
