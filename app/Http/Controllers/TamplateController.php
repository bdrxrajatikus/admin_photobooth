<?php

namespace App\Http\Controllers;

use App\Models\Template;
use Illuminate\Http\Request;

class TemplateController extends Controller
{
    public function index()
    {
        $templates = Template::all();
        return view('templates.index', ['templates' => $templates]);
    }

    public function create()
    {
        return view('templates.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $template = new Template();
        $template->name = $request->input('name');

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $template->image = $imageName;
        }

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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $template->name = $request->input('name');

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
        $template = Template::find($id);

        if (!$template) {
            return redirect()->route('templates.index')->with('error', 'Template not found');
        }

        $template->delete();

        return redirect()->route('templates.index')->with('success', 'Template deleted successfully');
    }
}
