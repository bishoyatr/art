<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    public function index()
    {
        $categories = Type::all();
        return view('dashboard.type.type')->with(['categories'=>$categories]);
    }

    public function create()
    {
        return view('dashboard.type.create');
    }

    public function store(Request $request)
    {

        Type::create($request->except('_token'));

        return redirect()->route('types.index')->with(['success' => 'Type is added successfully']);
    }



    public function edit($category_id)
    {
        $category=Type::find($category_id);
        if (!$category)
        {
            return redirect()->route('types.index')->with('error','هذا القسم غير موجود');

        }
        return view('dashboard.type.edit')->with(['category'=>$category]);
    }

    public function update($category_id,Request $request)
    {

        $category=Type::findOrfail($category_id);
        $category->update($request->except('_token'));


        return redirect()->route('types.index')->with('success', 'Type updated successfully');
    }

    public function destroy($category_id)
    {
        $category=Type::findOrfail($category_id);

        $category->delete();

        return redirect()->route('types.index')->with('success', 'Type deleted successfully');

    }
}
