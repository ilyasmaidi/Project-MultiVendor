<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ad;
use App\Models\Category;
use App\Models\Setting;

class AdController extends Controller
{
    public function index()
    {
        $ads = Ad::active()->latest()->paginate(20);
        return view('ads.index', compact('ads'));
    }

    public function create()
    {
        if (!auth()->user()->canCreateMoreAds()) {
            return redirect()->back()->with('error', 'لقد وصلت للحد الأقصى من الإعلانات (30 إعلان)');
        }

        $categories = Category::active()->root()->with('children')->get();
        return view('ads.create', compact('categories'));
    }

    public function store(Request $request)
    {
        if (!auth()->user()->canCreateMoreAds()) {
            return redirect()->back()->with('error', 'لقد وصلت للحد الأقصى من الإعلانات');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'price' => 'nullable|numeric|min:0',
            'price_type' => 'required|in:fixed,negotiable,free',
            'condition' => 'required|in:new,used,refurbished',
            'location' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'contact_phone' => 'nullable|string|max:20',
            'contact_whatsapp' => 'nullable|string|max:20',
            'images.*' => 'nullable|image|max:2048',
        ]);

        $ad = Ad::create([
            ...$validated,
            'user_id' => auth()->id(),
            'store_id' => auth()->user()->store?->id,
            'status' => 'pending',
            'template' => $this->getTemplateForCategory($request->category_id),
        ]);

        // Handle images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('ads/' . $ad->id, 'public');
                $ad->images()->create([
                    'image_path' => $path,
                    'is_primary' => $index === 0,
                    'sort_order' => $index,
                ]);
            }
        }

        return redirect()->route('ads.show', $ad->slug)
            ->with('success', 'تم إنشاء الإعلان بنجاح وهو قيد المراجعة');
    }

    public function show($slug)
    {
        $ad = Ad::where('slug', $slug)
            ->with(['user', 'store', 'category', 'images', 'attributes'])
            ->firstOrFail();

        $ad->incrementViews();

        $template = 'ads.show-' . $ad->template;
        if (!view()->exists($template)) {
            $template = 'ads.show-general';
        }

        return view($template, compact('ad'));
    }

    public function edit(Ad $ad)
    {
        $this->authorize('update', $ad);

        $categories = Category::active()->root()->with('children')->get();
        return view('ads.edit', compact('ad', 'categories'));
    }

    public function update(Request $request, Ad $ad)
    {
        $this->authorize('update', $ad);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'nullable|numeric|min:0',
            'price_type' => 'required|in:fixed,negotiable,free',
            'condition' => 'required|in:new,used,refurbished',
            'location' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'contact_phone' => 'nullable|string|max:20',
            'contact_whatsapp' => 'nullable|string|max:20',
            'status' => 'required|in:pending,active,sold,archived',
        ]);

        $ad->update($validated);

        return redirect()->route('ads.show', $ad->slug)
            ->with('success', 'تم تحديث الإعلان بنجاح');
    }

    public function destroy(Ad $ad)
    {
        $this->authorize('delete', $ad);

        $ad->delete();

        return redirect()->route('my-ads')
            ->with('success', 'تم حذف الإعلان بنجاح');
    }

    public function myAds()
    {
        $ads = auth()->user()->ads()
            ->with('category', 'images')
            ->latest()
            ->paginate(20);

        return view('ads.my-ads', compact('ads'));
    }

    private function getTemplateForCategory($categoryId)
    {
        $category = Category::find($categoryId);
        return $category?->type ?? 'general';
    }
}
