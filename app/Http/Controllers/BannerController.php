<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banners = Banner::ordered()->get();
        return view('admin.banners.index', compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.banners.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'url' => 'nullable|url',
                'position' => 'required|in:home,detail,both',
                'sort_order' => 'required|integer|min:0',
                'is_active' => 'boolean'
            ]);

            // Handle image upload
            if ($request->hasFile('image')) {
                $imageName = time() . '.' . $request->image->extension();
                $request->image->storeAs('public/banners', $imageName);
            } else {
                return redirect()->back()->with('error', 'Please select an image file.');
            }

            // Create banner
            $banner = Banner::create([
                'title' => $request->title,
                'image' => $imageName,
                'url' => $request->url,
                'position' => $request->position,
                'sort_order' => $request->sort_order,
                'is_active' => $request->has('is_active') ? 1 : 0
            ]);

            if ($banner) {
                return redirect()->route('admin.banners.index')->with('success', 'Banner created successfully!');
            } else {
                return redirect()->back()->with('error', 'Failed to create banner. Please try again.');
            }
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Banner $banner)
    {
        return view('admin.banners.show', compact('banner'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Banner $banner)
    {
        return view('admin.banners.edit', compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Banner $banner)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'url' => 'nullable|url',
            'position' => 'required|in:home,detail,both',
            'sort_order' => 'required|integer|min:0',
            'is_active' => 'boolean'
        ]);

        $data = [
            'title' => $request->title,
            'url' => $request->url,
            'position' => $request->position,
            'sort_order' => $request->sort_order,
            'is_active' => $request->has('is_active')
        ];

        // Handle image update
        if ($request->hasFile('image')) {
            // Delete old image
            if ($banner->image && Storage::exists('public/banners/' . $banner->image)) {
                Storage::delete('public/banners/' . $banner->image);
            }

            $imageName = time() . '.' . $request->image->extension();
            $request->image->storeAs('public/banners', $imageName);
            $data['image'] = $imageName;
        }

        $banner->update($data);

        return redirect()->route('admin.banners.index')->with('success', 'Banner updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Banner $banner)
    {
        // Delete image file
        if ($banner->image && Storage::exists('public/banners/' . $banner->image)) {
            Storage::delete('public/banners/' . $banner->image);
        }

        $banner->delete();

        return redirect()->route('admin.banners.index')->with('success', 'Banner deleted successfully!');
    }

    /**
     * Toggle banner status
     */
    public function toggleStatus(Banner $banner)
    {
        $banner->update(['is_active' => !$banner->is_active]);
        
        $status = $banner->is_active ? 'activated' : 'deactivated';
        return response()->json(['success' => true, 'message' => "Banner {$status} successfully!"]);
    }
}
