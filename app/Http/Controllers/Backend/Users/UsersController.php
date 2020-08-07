<?php

namespace App\Http\Controllers\Backend\Users;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

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
                $users =  User::where('id',$request->id)->first();
                File::delete(public_path($users->avatar));
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
            $date = Str::slug(Carbon::now());
            $imageName = Str::slug($request->name) . '-' . $date;
            Image::make($request->file('image'))->save(public_path('/uploads/users/') . $imageName . '.jpg')->encode('jpg','50');

            User::create([
                'avatar' => '/uploads/users/' . $imageName . '.jpg',
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
            $users =  User::where('id',$userId)->first();
            if ($request->hasFile('avatar')) {
                File::delete(public_path($users->avatar));
                $date = Str::slug(Carbon::now());
                $imageName = Str::slug($request->name) . '-' . $date;
                Image::make($request->file('avatar'))->save(public_path('/uploads/users/') . $imageName . '.jpg')->encode('jpg', '50');
            }

            User::where('id',$userId)->update([
                'avatar' => $request->hasFile('avatar') ? '/uploads/users/' . $imageName . '.jpg' : $users->avatar,
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password ==  $users->password ? $users->password : Hash::make($request->password),
                'rolId' => $request->rolId,
                'user_status' => $request->user_status == 'on' ? 'on' : 'off',
            ]);
            return response(['status' => 'success', 'title' => 'Başarılı', 'content' => 'Kullanıcı Güncellendi']);
        } catch (\Exception $e) {
            return response(['status' => 'error', 'title' => 'Başarısız', 'content' => 'Kullanıcı Güncellenemedi']);
        }
    }
}
