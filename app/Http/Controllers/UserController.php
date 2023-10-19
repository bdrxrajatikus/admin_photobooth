<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
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
        $title = 'Create User'; // Tambahkan ini
        return view('users.create', compact('title'));
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

        return redirect()->route('users.index')->with('success', 'User berhasil dibuat!');
    }

    public function edit(User $user)
    {
        $title = 'Edit User'; // Tambahkan ini
        return view('users.edit', compact('user', 'title'));
    }

    public function profile()
    {
        $user = Auth::user();
        $title = 'Profile';
        return view('users.profile', compact('user', 'title'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($user->id),
            ],
            'level' => 'required|in:admin,user',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'new_password' => 'nullable|string|min:6|confirmed',
            'current_password' => 'nullable|string',
        ]);

        $userData = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'level' => $request->input('level'),
        ];

        if ($request->filled('new_password')) {
            if (!Hash::check($request->input('current_password'), $user->password)) {
                return redirect()->back()->with('error', 'Password lama tidak sesuai.');
            }
            $userData['password'] = Hash::make($request->input('new_password'));
        }

        // Tambahkan kode berikut untuk mengganti gambar profil jika ada
        if ($request->hasFile('image')) {
            if ($user->image && $user->image !== 'images_profile/default.jpg') {
                Storage::delete('public/' . $user->image);
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images_profile'), $imageName);
            $userData['image'] = 'images_profile/' . $imageName;
        }

        $user->update($userData);

        return redirect()->route('users.index')->with('success', 'User berhasil diperbarui!');
    }

}
