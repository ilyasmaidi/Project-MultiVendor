<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Store;

class StoreController extends Controller
{
    public function index()
    {
        $stores = Store::active()->verified()->with('user')->paginate(20);
        return view('stores.index', compact('stores'));
    }

    public function show($slug)
    {
        $store = Store::where('slug', $slug)
            ->with(['user', 'ads' => function ($query) {
                $query->active()->latest();
            }])
            ->firstOrFail();

        return view('stores.show', compact('store'));
    }
}
