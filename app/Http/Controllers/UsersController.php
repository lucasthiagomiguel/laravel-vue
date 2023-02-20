<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function __construct(Users $user)
    {
        $this->users = $user;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->users->all();
        return  response()->json($users,200); 
    }
 

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         
        $request->validate($this->users->rules(),$this->users->feedback());
       $user = $this->users->create($request->all());
        return response()->json($user,201); 
    }

    /**
     * Display the specified resource.
     *
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $users = $this->users->find($id);
        if($users === null){
            return response()->json(['error' => 'Not exist'],404); 
            
        }
        return response()->json($users,200); 
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $users = $this->users->find($id);
        if($users === null){
            return response()->json(['error' => 'User not   exist'],404);
        }
        if($request->method() === 'PATCH'){
            $ruleDinamic = array();

            //testing all rules of model users
            foreach($users->rules() as $input => $rules){
                $ruleDinamic[$input] = $rules;
            }

            $request->validate($ruleDinamic,$this->users->feedback());
        }else{
            $request->validate($this->users->rules(),$this->users->feedback());
        }
        $users->update($request->all());
        return response()->json($users,200); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $users = $this->users->find($id);
        $users->update($request->all());
        return $users;
    }
}
