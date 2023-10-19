<?php

namespace App\Http\Controllers;

use App\Models\Template;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Setting;

class TemplateController extends Controller
{
    public function index()
    {
        $templates = Template::select('templates.*', 'settings.application_name as photobooth_name')
        ->leftJoin('settings', 'templates.settings_id', '=', 'settings.id')
        ->get();
        $settings = Setting::all();
        $title = 'Voucher';
        return view('templates.index', ['templates' => $templates, 'title' => $title, 'settings' => $settings]);
    }

    public function create()
    {
        return view('templates.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'settings_id' => 'nullable|integer',
            'type' => [
                'required',
                'in:payment,how_to_use,contact,frame',
            ],
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
        } else {
            $imageName = null;
        }

        $template = new Template();
        $template->name = $request->input('name');
        $template->type = $request->input('type');
        $template->settings_id = $request->input('settings_id') ?: null;
        $template->image = $imageName;

        $template->save();

        return redirect()->route('templates.index')->with('success', 'Template created successfully');
    }

    public function edit($id)
    {
        $template = Template::find($id);

        if (!$template) {
            return redirect()->route('templates.index')->with('error', 'Template not found');
        }

        return view('templates.edit', ['template' => $template]);
    }

    public function update(Request $request, $id)
    {
        $template = Template::find($id);

        if (!$template) {
            return redirect()->route('templates.index')->with('error', 'Template not found');
        }

        $request->validate([
            'name' => 'required|string',
            'settings_id' => 'nullable|integer',
            'type' => [
                'required',
                'in:payment,how_to_use,contact,frame',
            ],
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $template->name = $request->input('name');
        $template->settings_id = $request->input('settings_id') ?: null;
        
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $template->image = $imageName;
        }

        $template->save();

        return redirect()->route('templates.index')->with('success', 'Template updated successfully');
    }

    public function destroy($id)
    {
        $template = Template::findOrfail($id);
        $template->delete();

        return redirect()->route('templates.index')->with('success', 'Template deleted successfully');
    }
}
