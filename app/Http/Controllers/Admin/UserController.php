<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $categories = User::all();
        return view('dashboard.user.user')->with(['categories' => $categories]);
    }

    public function create()
    {
        return view('dashboard.user.create');
    }

    public function store(Request $request)
    {

        $req = $request->except('_token');

        $req['is_active'] = ($request->has('is_active') && $request->is_active == "1")?1:0;
        $req['pdf_allowed'] = ($request->has('pdf_allowed') && $request->pdf_allowed == "1")?1:0;
        $user = User::create($req);
        $tokenStr = $user->createToken('remember_token')->accessToken;
        $user->remember_token = $tokenStr->token;
        $user->save();
        return redirect()->route('users.index')->with(['success' => 'User is added successfully']);
    }


    public function edit($category_id)
    {
        $category = User::find($category_id);
        if (!$category) {
            return redirect()->route('users.index')->with('error', 'هذا القسم غير موجود');

        }
        return view('dashboard.user.edit')->with(['category' => $category]);
    }

    public function update($category_id, Request $request)
    {
        $req = $request->except('_token');
        $req['is_active'] = ($request->has('is_active') && $request->is_active == "on")?1:0;
        $req['pdf_allowed'] = ($request->has('pdf_allowed') && $request->pdf_allowed == "on")?1:0;

        $category = User::findOrfail($category_id);
        if ($request->has('password') && !empty($request->password))
            $category->update($req);
        else{
            unset($req['password']);
            $category->update($req)  ;

        }

        return redirect()->route('users.index')->with('success', 'User updated successfully');
    }

    public function destroy($category_id)
    {
        $category = User::findOrfail($category_id);

        $category->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully');

    }
}
