<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ad;
use App\Models\Category;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = Ad::query()->with('category', 'images', 'user');
        
        // Text search
        if ($request->filled('q')) {
            $searchTerm = $request->q;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'like', "%{$searchTerm}%")
                  ->orWhere('description', 'like', "%{$searchTerm}%")
                  ->orWhere('city', 'like', "%{$searchTerm}%");
            });
        }
        
        // Category filter
        if ($request->filled('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category)
                  ->orWhere('id', $request->category);
            });
        }
        
        // Price range
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }
        
        // Condition
        if ($request->filled('condition')) {
            $query->where('condition', $request->condition);
        }
        
        // City
        if ($request->filled('city')) {
            $query->where('city', $request->city);
        }
        
        // Sort
        $sort = $request->get('sort', 'newest');
        switch ($sort) {
            case 'oldest':
                $query->oldest();
                break;
            case 'price_low':
                $query->orderBy('price', 'asc');
                break;
            case 'price_high':
                $query->orderBy('price', 'desc');
                break;
            default:
                $query->latest();
        }
        
        // Only active ads
        $query->where('status', 'active');
        
        $ads = $query->paginate(24)->withQueryString();
        
        // Get categories for filter
        $categories = Category::active()->root()->with('children')->get();
        
        // Get cities for filter (distinct cities from active ads)
        $cities = Ad::where('status', 'active')
            ->whereNotNull('city')
            ->distinct()
            ->pluck('city')
            ->sort()
            ->values();
        
        return view('search.index', compact('ads', 'categories', 'cities'));
    }
    
    public function suggestions(Request $request)
    {
        $request->validate([
            'q' => 'required|string|min:2|max:50',
        ]);
        
        $searchTerm = $request->q;
        
        $suggestions = Ad::where('status', 'active')
            ->where(function ($query) use ($searchTerm) {
                $query->where('title', 'like', "%{$searchTerm}%")
                      ->orWhere('city', 'like', "%{$searchTerm}%");
            })
            ->select('title', 'slug')
            ->limit(5)
            ->get();
        
        return response()->json($suggestions);
    }
}
