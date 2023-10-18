<?php

namespace App\Http\Controllers;

use App\Models\Template;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;

class TemplateApiController extends Controller
{
    public function index()
    {
        $templates = Template::all();
        return response()->json(['templates' => $templates], Response::HTTP_OK);
    }

    public function show($id)
    {
        $template = Template::find($id);

        if (!$template) {
            return response()->json(['error' => 'Template not found'], Response::HTTP_NOT_FOUND);
        }

        return response()->json(['template' => $template], Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'type' => [
                'required',
                'in:payment,how_to_use,contact,frame',
                Rule::unique('templates', 'type'),
            ],
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);


        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $template->image = $imageName;
        }

        $template = new Template();
        $template->name = $request->input('name');
        $template->type = $request->input('type');
        $template->image = $imageName;

        $template->save();

        return response()->json(['message' => 'Template created successfully'], Response::HTTP_CREATED);
    }

    public function update(Request $request, $id)
    {
        $template = Template::find($id);

        if (!$template) {
            return response()->json(['error' => 'Template not found'], Response::HTTP_NOT_FOUND);
        }

        $request->validate([
            'name' => 'required|string',
            'type' => [
                'required',
                'in:payment,how_to_use,contact,frame',
                Rule::unique('templates', 'type'),
            ],
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);


        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $template->image = $imageName;
        }

        $template->name = $request->input('name');
        $template->type = $request->input('type');
        $template->image = $imageName;
        $template->save();

        return response()->json(['message' => 'Template updated successfully'], Response::HTTP_OK);
    }

    public function destroy($id)
    {
        $template = Template::find($id);

        if (!$template) {
            return response()->json(['error' => 'Template not found'], Response::HTTP_NOT_FOUND);
        }

        $template->delete();

        return response()->json(['message' => 'Template deleted successfully'], Response::HTTP_NO_CONTENT);
    }
}
