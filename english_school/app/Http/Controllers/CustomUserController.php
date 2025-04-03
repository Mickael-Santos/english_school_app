<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomUser;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class CustomUserController extends Controller
{
    public function index()
    {
        $users = DB::select('SELECT * FROM CUSTOM_USERS WHERE SCHOOL_ID = ?', [auth()->user()->school_id]);
        
        return view('custom_users.dashboard', [
            'users' => $users
        ]);
    }

    public function create()
    {
        return view('custom_users.create');
    }

    public function store(Request $request)
    {
        $user = DB::select(
            'SELECT * FROM CUSTOM_USERS WHERE email = ?',
            [$request->email]
        );

        if(count($user) > 0) {
            return redirect('/custom_users/create')->with('msg', 'Email já cadastrado!');
        }

        $user = new CustomUser;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->school_id = auth()->user()->school_id;
        $user->save();

        return redirect('/custom_users')->with('msg', 'Usuário criado com sucesso!');
    }

    public function edit($id)
    {
        $user = CustomUser::findOrFail($id);

        return view('custom_users.edit', [
            'user' => $user
        ]);
    }

    public function update(Request $request, $id)
    {
        $user = CustomUser::findOrFail($id);
    
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return redirect('/custom_users')->with('msg', 'Usuário atualizado com sucesso!');
    }

    public function delete($id)
    {
        $user = CustomUser::findOrFail($id);

        return view('custom_users.delete', [
            'user' => $user
        ]);
    }

    public function destroy($id)
    {
        $user = CustomUser::findOrFail($id);

        $user->delete();

        return redirect('/custom_users')->with('msg', 'Usuário excluído com sucesso!');
    }

    public function show($id)
    {
        $user = CustomUser::findOrFail($id);


        return view('custom_users.show', [
            'user' => $user
        ]);
    }
}
