<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\Template;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;

class SettingApiController extends Controller
{
    public function index()
    {
        $settings = Setting::all();
        return response()->json($settings, Response::HTTP_OK);
    }

    public function show($id)
    {
        $setting = Setting::find($id);

        if (!$setting) {
            return response()->json(['message' => 'Setting not found'], Response::HTTP_NOT_FOUND);
        }

        $templates = Template::where('settings_id', $id)->get();
        return response()->json([
            'id' => $setting->id,
            'application_name' => $setting->application_name,
            'master_price' => $setting->master_price,
            'homepage_image' => $setting->homepage_image,
            'created_at' => $setting->created_at,
            'updated_at' => $setting->updated_at,
            'templates' => $templates
        ], Response::HTTP_OK);
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
            $path = $image->storeAs('public/images', $imageName);
            $data['homepage_image'] = $path;
        }

        Setting::create($data);

        return response()->json(['message' => 'Setting berhasil ditambahkan'], Response::HTTP_CREATED);
    }

    public function update(Request $request, $id)
    {
        $setting = Setting::find($id);

        if (!$setting) {
            return response()->json(['message' => 'Setting not found'], Response::HTTP_NOT_FOUND);
        }

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
            $path = $image->storeAs('public/images', $imageName);
            $data['homepage_image'] = $path;
        }

        $setting->update($data);

        return response()->json(['message' => 'Setting berhasil diperbarui'], Response::HTTP_OK);
    }

    public function destroy($id)
    {
        $setting = Setting::find($id);

        if (!$setting) {
            return response()->json(['message' => 'Setting not found'], Response::HTTP_NOT_FOUND);
        }

        $setting->delete();

        return response()->json(['message' => 'Setting berhasil dihapus'], Response::HTTP_NO_CONTENT);
    }
}
