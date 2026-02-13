<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::latest()->get();

        return view('admin.roles.index', compact('roles'));
    }

    public function create()
    {
        return view('admin.roles.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|unique:roles,name',
            'description' => 'nullable|string',
            'status' => 'required|boolean',
        ]);

        Role::create([
            'id' => (string) Str::uuid(),
            'name' => $data['name'],
            'description' => $data['description'] ?? null,
            'status' => $data['status'],
        ]);

        return redirect()
            ->route('admin.roles.index')
            ->with('success', 'Role created successfully');
    }

    public function edit(Role $role)
    {
        return view('admin.roles.edit', compact('role'));
    }

    public function update(Request $request, Role $role)
    {
        $data = $request->validate([
            'name' => 'required|unique:roles,name,' . $role->id . ',id',
            'description' => 'nullable|string',
            'status' => 'required|boolean',
        ]);

        $role->update($data);

        return redirect()
            ->route('admin.roles.index')
            ->with('success', 'Role updated successfully');
    }
    public function deleted()
{
    $roles = Role::onlyTrashed()->latest()->paginate(10);
    return view('admin.roles.deleted', compact('roles'));
}
public function restore($id)
{
    Role::withTrashed()->findOrFail($id)->restore();

    return redirect()->back()->with('success', 'Role restored successfully');
}
public function forceDelete($id)
{
    Role::withTrashed()->findOrFail($id)->forceDelete();

    return redirect()->back()->with('success', 'Role permanently deleted');
}

    public function destroy(Role $role)
    {
        $role->delete();

        return redirect()
            ->route('admin.roles.index')
            ->with('success', 'Role deleted successfully');
    }
}
