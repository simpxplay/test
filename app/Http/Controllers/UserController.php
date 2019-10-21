<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function createUser(Request $request){
        //в валидаторе может быть побольше правил
        $validatedData = $request->validate([
            'email' => 'required|email|max:255',
            'password' => 'required',
        ]);
        $user = new User();
        $user->fill($request->all());
        //если будет подключена бд то еще $user->save();
        $result = !empty($user) ? ['status'=>'ok','user'=>$user] : ['status'=>'error'] ;
        return json_encode($result);
    }

    public function getUser(Request $request){
        //При подключенной бд использовать приведение типов (в параметрах метода User $user)
        //Или $user = User::find($request->id);
        //ну и $result = !empty($user) ? ['status'=>'ok','user'=>$user] : ['status'=>'error'] ;
        $user = $request->id == 1 ? new User() : null;
        if (!empty($user)){
            $user->email = 'email';
            $user->name = 'name';
        }
        $result = !empty($user) ? ['status'=>'ok','user'=>$user] : ['status'=>'error'];
        return json_encode($result);
    }

    public function deleteUser(Request $request){
        $user = User::find($request->id);
        $result = empty($user) ? ['status'=>'error'] : ['status'=>'ok'];
        $user->delete();
        return json_encode($result);
    }
}
