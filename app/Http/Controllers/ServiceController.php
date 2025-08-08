<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::latest()->paginate(10);
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'icon' => 'required',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Service::create([
            'icon' => $request->icon,
            'name' => $request->name,
            'description' => $request->description,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('services.index')->with('success', 'خدمت جدید با موفقیت ایجاد شد.');
    }

    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $request->validate([
            'icon' => 'required',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $service->update([
            'icon' => $request->icon,
            'name' => $request->name,
            'description' => $request->description,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('services.index')->with('success', 'خدمت با موفقیت بروزرسانی شد.');
    }

    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('services.index')->with('success', 'خدمت حذف شد.');
    }
}
