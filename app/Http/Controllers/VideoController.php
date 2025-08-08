<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
     public function index()
    {
        $videos = Video::latest()->paginate(15);
        return view('admin.videos.index', compact('videos'));
    }

    public function create()
    {
        return view('admin.videos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'video' => 'required|string',
            'subtitle' => 'required|string',
        ]);

        Video::create($request->only(['title', 'video', 'subtitle']));

        return redirect()->route('videos.index')->with('success', 'ویدیو با موفقیت اضافه شد.');
    }

    public function edit(Video $video)
    {
        return view('admin.videos.edit', compact('video'));
    }

    public function update(Request $request, Video $video)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'video' => 'required|string',
            'subtitle' => 'required|string',
        ]);

        $video->update($request->only(['title', 'video', 'subtitle']));

        return redirect()->route('videos.index')->with('success', 'ویدیو با موفقیت ویرایش شد.');
    }

    public function destroy(Video $video)
    {
        $video->delete();
        return redirect()->route('videos.index')->with('success', 'ویدیو حذف شد.');
    }
}
