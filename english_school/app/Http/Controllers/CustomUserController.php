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
        $search = request('search');
        $searchTerm = '%'.$search.'%';

        $user = auth()->user();

        if($search)
        {
            $users = DB::select('SELECT * FROM CUSTOM_USERS WHERE SCHOOL_ID = ? 
            AND (NAME LIKE ? OR EMAIL LIKE ? )', [$user->school_id, $searchTerm, $searchTerm]);

            return view('custom_users.dashboard', [
                'users' => $users,
                'search' => $search
            ]);
        }

        $users = DB::select('SELECT * FROM CUSTOM_USERS WHERE SCHOOL_ID = ?', [auth()->user()->school_id]);
        
        return view('custom_users.dashboard', [
            'users' => $users,
            'search' => $search
        ]);
    }

    public function create()
    {
        if(auth()->user()->admin == false || auth()->user()->admin == null) {
            return redirect('/custom_users');
        }

        return view('custom_users.create');
    }

    public function store(Request $request)
    {
        if(auth()->user()->admin == false || auth()->user()->admin == null) {
            return redirect('/custom_users');
        }

        $user = DB::select(
            'SELECT * FROM CUSTOM_USERS WHERE email = ?
            AND school_id = ?',
            [$request->email, auth()->user()->school_id]
        );

        if(count($user) > 0) {
            return redirect('/custom_users/create')->with('msg', 'Email já cadastrado!');
        }

        $user = new CustomUser;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->school_id = auth()->user()->school_id;
        $user->admin = false;
        $user->save();

        return redirect('/custom_users')->with('msg', 'Usuário criado com sucesso!');
    }

    public function edit($id)
    {
        if(auth()->user()->admin == false || auth()->user()->admin == null) {
            return redirect('/custom_users');
        }

        $user = CustomUser::findOrFail($id);

        return view('custom_users.edit', [
            'user' => $user
        ]);
    }

    public function update(Request $request, $id)
    {
        if(auth()->user()->admin == false || auth()->user()->admin == null) {
            return redirect('/custom_users');
        }

        $user = CustomUser::findOrFail($id);
    
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return redirect('/custom_users')->with('msg', 'Usuário atualizado com sucesso!');
    }

    public function delete($id)
    {
        if(auth()->user()->admin == false || auth()->user()->admin == null) {
            return redirect('/custom_users');
        }
        
        $user = CustomUser::findOrFail($id);

        if($user->id == auth()->user()->id) {
            return redirect('/custom_users')->with('msg', 'Você não pode excluir a si mesmo!');
        }

        return view('custom_users.delete', [
            'user' => $user
        ]);
    }

    public function destroy($id)
    {
        if(auth()->user()->admin == false || auth()->user()->admin == null) {
            return redirect('/custom_users');
        }
        
        $user = CustomUser::findOrFail($id);

        if($user->id == auth()->user()->id) {
            return redirect('/custom_users')->with('msg', 'Você não pode excluir a si mesmo!');
        }

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
