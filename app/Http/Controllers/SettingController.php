<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; 

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::all();
        $title = 'Master Photobooth';
        return view('settings.index', compact('settings', 'title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'application_name' => 'required|string|max:255',
            'master_price' => 'required|numeric',
            'homepage_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        // Upload gambar homepage_image jika ada
        if ($request->hasFile('homepage_image')) {
            $image = $request->file('homepage_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();

            // Simpan gambar menggunakan Storage
            $image->move(public_path('images'), $imageName);
            $data['homepage_image'] = $imageName;
        }

        Setting::create($data);

        return redirect()->route('settings.index')
            ->with('success', 'Setting berhasil ditambahkan.');
    }

    public function edit(Setting $setting)
    {
        return view('settings.edit', compact('setting'));
    }

    public function update(Request $request, Setting $setting)
    {
        $request->validate([
            'application_name' => 'required|string|max:255',
            'master_price' => 'required|numeric',
            'homepage_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        // Upload gambar homepage_image jika ada
        if ($request->hasFile('homepage_image')) {
            $image = $request->file('homepage_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();

            // Simpan gambar menggunakan Storage
            $image->move(public_path('images'), $imageName);
            $data['homepage_image'] = $imageName;
        }

        $setting->update($data);

        return redirect()->route('settings.index')
            ->with('success', 'Setting berhasil diperbarui.');
    }

    public function destroy(Setting $setting)
    {
        $setting->delete();

        return redirect()->route('settings.index')
            ->with('success', 'Setting berhasil dihapus.');
    }
}
