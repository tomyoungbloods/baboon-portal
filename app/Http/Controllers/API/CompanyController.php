<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Company;
use Illuminate\Support\Facades\Hash;

class CompanyController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (\Gate::allows('isAdmin') || \Gate::allows('isAuthor')) {
            return Company::latest()->paginate(10);
        }
        
    }
    public function update(Request $request, $id)
    {
        $user = Company::findorfail($id);

        $this->validate($request,[
            // 'name' => 'required|string|max:191',
            // 'email' => 'required|string|email|max:191|unique:users,email,' .$user->id,
            // 'password' => 'sometimes|required|min:6',
        ]);

        $currentPhoto = $user->photo;
        if ($request->photo != $currentPhoto) {
            $name = time().'.' . explode('/', explode(':', substr($request->photo, 0, strpos($request->photo, ';')))[1])[1];

            \Image::make($request->photo)->save(public_path('img/profile/').$name);
            $request->merge(['photo' => $name]);

            $userPhoto = public_path('img/profile/').$currentPhoto;

            //Delete old picture
            if(file_exists($userPhoto)){
                @unlink($userPhoto);
            }
        } 

        
        

        // When the password is empty take old password
        if(!empty($request->password)){
            $request->merge(['password' => Hash::make($request['password'])]);
        }

        $user->update($request->all());
        return $user;
        
    }

    // /**
    //  * Store a newly created resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
    //  */
    public function store(Request $request)
    {
        $company = Company::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'tel' => $request['tel'],
            'web' => $request['web'],
            'bio' => $request['bio'],
        ]);

        $currentPhoto = $company->photo;
        if ($request->photo != $currentPhoto) {
            $name = time().'.' . explode('/', explode(':', substr($request->photo, 0, strpos($request->photo, ';')))[1])[1];

            \Image::make($request->photo)->save(public_path('img/profile/').$name);
            $request->merge(['photo' => $name]);

            $userPhoto = public_path('img/profile/').$currentPhoto;

            //Delete old picture
            if(file_exists($userPhoto)){
                @unlink($userPhoto);
            }
        } 

        return $company->update($request->all());
    }

   
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('isAdmin');
        $company = Company::findOrFail($id);

        //Delete the compan$company

        $company->delete();

        return ['message' => 'compan$company Deleted'];
    }
}
