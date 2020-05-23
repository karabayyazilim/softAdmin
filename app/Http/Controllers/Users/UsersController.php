<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function getUsers()
    {
        $users = User::all();
        return view('backend.users.users')->with('users', $users);
    }

    public function getUsersAdd()
    {
        $roles = Role::all();
        return view('backend.users.user-add')->with('roles', $roles);
    }

    public function getUsersEdit($userId)
    {
        $roles = Role::all();
        $user = User::where('id',$userId)->first();
        return view('backend.users.user-edit')->with('roles', $roles)->with('user', $user);
    }

    public function postUsers(Request $request)
    {
        if (isset($request->delete)) {
            try {
                User::where('id', $request->id)->delete();
                return response(['status' => 'success', 'title' => 'Başarılı', 'content' => 'Kullanıcı Silindi']);
            } catch (\Exception $e) {
                return response(['status' => 'error', 'title' => 'Başarısız', 'content' => 'Kullanıcı Silinemedi']);
            }
        } elseif (isset($request->user_status)) {
            try {
                User::where('id', $request->id)->update($request->all());
                return response(['status' => 'success', 'title' => 'Başarılı', 'content' => 'Kullanıcı Durumu Değiştirildi']);
            } catch (\Exception $e) {
                return response(['status' => 'error', 'title' => 'Başarısız', 'content' => 'Kullanıcı Durumu Değiştirilemedi']);
            }
        }
    }

    public function postUsersAdd(Request $request)
    {
        try {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'rolId' => $request->rolId,
                'user_status' => $request->user_status == 'on' ? 'on' : 'off',
            ]);
            return response(['status' => 'success', 'title' => 'Başarılı', 'content' => 'Kullanıcı Eklendi']);
        } catch (\Exception $e) {
            return response(['status' => 'error', 'title' => 'Başarısız', 'content' => 'Kullanıcı Eklenemedi']);
        }

    }

    public function postUsersEdit(Request $request,$userId)
    {
        try {
            User::where('id',$userId)->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'rolId' => $request->rolId,
                'user_status' => $request->user_status == 'on' ? 'on' : 'off',
            ]);
            return response(['status' => 'success', 'title' => 'Başarılı', 'content' => 'Kullanıcı Güncellendi']);
        } catch (\Exception $e) {
            return response(['status' => 'error', 'title' => 'Başarısız', 'content' => 'Kullanıcı Güncellenemedi']);
        }
    }
}
