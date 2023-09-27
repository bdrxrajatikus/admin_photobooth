<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Menambahkan middleware auth untuk melindungi rute
    }

    public function index()
    {
        $users = User::all();
        $title = 'Account';
        return view('users.index', compact('users', 'title'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => ['required', 'string', 'min:6'],
            'level' => 'required|in:admin,user',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        $user = new User([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'level' => $request->input('level'),
        ]);
    
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images_profile'), $imageName);
            $user->image = 'images_profile/' . $imageName;
        } else {
            // Jika pengguna tidak mengunggah gambar, gunakan nilai default
            $user->image = 'images_profile/default.jpg';
        }
    
        $user->save();
    
        return redirect('users')->with('success', 'User berhasil dibuat!');
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'level' => 'required|in:admin,user',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'level' => $request->input('level'),
        ]);
    
        if ($request->hasFile('image')) {
            // Menghapus gambar profil lama jika ada
            if ($user->image && $user->image !== 'images_profile/default.jpg') {
                Storage::delete('public/' . $user->image);
            }
    
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images_profile'), $imageName);
            $user->image = 'images_profile/' . $imageName;
        }
    
        // Periksa apakah password diubah
        if ($request->filled('password')) {
            $user->update([
                'password' => Hash::make($request->input('password')),
            ]);
        }
    
        $user->save();
    
        return redirect('users')->with('success', 'User berhasil diperbarui!');
    }

}
