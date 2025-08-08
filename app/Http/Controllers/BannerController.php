<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::orderBy('order')->paginate(10);
        return view('admin.banners.index', compact('banners'));
    }

    public function create()
    {
        return view('admin.banners.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'link' => 'nullable|url',
            'order' => 'nullable|integer',
            'image' => 'required|image|max:2048',
        ]);

        $file = $request->file('image');
        $filename = time() . '_' . $file->getClientOriginalName();
        $destinationPath = public_path('uploads/banners');
        $file->move($destinationPath, $filename);
        $validated['image'] = 'uploads/banners/' . $filename;

        $validated['is_active'] = $request->has('is_active');

        Banner::create($validated);

        return redirect()->route('banners.index')->with('success', 'بنر با موفقیت ایجاد شد.');
    }

    public function edit(Banner $banner)
    {
        return view('admin.banners.edit', compact('banner'));
    }

    public function update(Request $request, Banner $Banner)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'link' => 'nullable|url',
            'order' => 'nullable|integer',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {

            $imagePath = public_path($Banner->image);
            if (file_exists($imagePath)) {
                @unlink($imagePath);
            }

            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('uploads/banners');
            $file->move($destinationPath, $filename);
            $validated['image'] = 'uploads/banners/' . $filename;
        }

        $validated['is_active'] = $request->has('is_active');
        $Banner->update($validated);

        return redirect()->route('banners.index')->with('success', 'بنر با موفقیت بروزرسانی شد.');
    }

    public function destroy(Banner $banner)
    {
        $imagePath = public_path($banner->image);
        if (file_exists($imagePath)) {
            @unlink($imagePath);
        }

        $banner->delete();
        return redirect()->route('banners.index')->with('success', 'بنر حذف شد.');
    }

}