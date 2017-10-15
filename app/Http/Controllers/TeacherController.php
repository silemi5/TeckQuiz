<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\UserProfile;
use App\Classe;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $teachers = User::with('user_profile', 'classe')
            ->where('permissions', 1)
            ->get();
        // return $teachers;
        return view('manage.teachers', compact('teachers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $out = User::create([
            'usr' => $request->input('usr'),
            'permissions' => 1,
            'password' => bcrypt($request->input('password')),
        ]);

        $usr = User::select('usr_id')->where('usr', $request->input('usr'))->first();
        
        UserProfile::create([
            'usr_id' => $usr->usr_id,
            'given_name' => $request->input('n_given'),
            'family_name' => $request->input('n_family'),
            'middle_name' => $request->input('n_middle'),
            'ext_name' => $request->input('n_ext'),
        ]);

        return redirect('/teachers');
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        if ($request->input('update_type') == 1){
            $user = User::find($id);
            $user->password = bcrypt("password");
            $user->save();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        User::destroy($id);
    }
}
