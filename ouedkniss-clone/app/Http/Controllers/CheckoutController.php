<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Ad; // قمنا باعتماد Ad كموديل أساسي
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    /**
     * عرض صفحة إتمام الشراء (الدفع)
     */
    public function index(Request $request)
    {
        // 1. جلب المنتج باستخدام موديل Ad
        $listing = Ad::findOrFail($request->ad_id);
        
        // 2. استلام الخيارات المختارة
        $selectedSize = $request->query('size', 'M');
        $selectedColor = $request->query('color', 'أسود');

        // 3. تجهيز بيانات الجلسة
        $cart = [[
            'id'       => $listing->id,
            'title'    => $listing->title,
            'price'    => $listing->price,
            'size'     => $selectedSize,
            'color'    => $selectedColor,
            // التأكد من جلب الصورة الأساسية
            'image'    => $listing->images->where('is_primary', true)->first()->image_path ?? '',
            'quantity' => 1
        ]];

        session(['cart' => $cart]);

        return view('checkout.index', compact('cart'));
    }

    /**
     * حفظ الطلب في قاعدة البيانات
     */
    public function store(Request $request)
    {
        $request->validate([
            'phone'            => 'required|string|min:10|max:15',
            'city'             => 'required|string',
            'shipping_address' => 'required|string|min:10',
            'notes'            => 'nullable|string|max:500',
        ]);

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('home')->with('error', 'السلة فارغة.');
        }

        DB::beginTransaction();

        try {
            foreach ($cart as $item) {
                $ad = Ad::findOrFail($item['id']);

                Order::create([
                    'buyer_id'         => auth()->id(),
                    'listing_id'       => $item['id'],
                    'seller_id'        => $ad->user_id, // تأكد أن الحقل في جدول ads هو user_id
                    'size'             => $item['size'],
                    'color'            => $item['color'],
                    'quantity'         => $item['quantity'],
                    'total_price'      => $item['price'] * $item['quantity'],
                    'status'           => 'pending',
                    'phone'            => $request->phone,
                    'city'             => $request->city,
                    'shipping_address' => $request->shipping_address,
                    'notes'            => $request->notes,
                ]);
            }

            DB::commit();
            session()->forget('cart');

            return redirect()->route('checkout.success');

        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Checkout Error: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'خطأ: ' . $e->getMessage());
        }
    }

    public function success()
    {
        return view('checkout.success');
    }

    public function updateStatus(Request $request, Order $order)
    {
        if (auth()->id() !== $order->seller_id) abort(403);
        $order->update(['status' => $request->status]);
        return back()->with('success', 'تم التحديث');
    }


    public function myOrders()
{
    // جلب طلبات المستخدم الحالي مع بيانات الإعلان (listing)
    $orders = Order::where('buyer_id', Auth::id())
        ->with('listing') // تأكد من وجود علاقة listing في موديل Order
        ->latest()
        ->get();

    return view('orders.index', compact('orders'));
}

    public function vendorOrders()
    {
        // جلب طلبات البائع الحالي مع بيانات الإعلان (listing) والمشتري (buyer)
        $orders = Order::where('seller_id', Auth::id())
            ->with(['listing', 'buyer']) // تأكد من وجود علاقات listing و buyer في موديل Order
            ->latest()
            ->get();

        return view('vendor.orders.index', compact('orders'));
    }




}