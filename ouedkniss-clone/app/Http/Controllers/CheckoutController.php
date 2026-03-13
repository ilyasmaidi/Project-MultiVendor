<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    /**
     * عرض صفحة إتمام الشراء (الدفع)
     */
    public function index()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'سلتك فارغة، لا يمكنك إتمام الشراء!');
        }

        return view('checkout.index', compact('cart'));
    }

    /**
     * معالجة وحفظ الطلب في قاعدة البيانات
     */
    public function store(Request $request)
    {
        // 1. التحقق من بيانات المشتري (الهاتف والعنوان)
        $request->validate([
            'phone'            => 'required|string',
            'shipping_address' => 'required|string|min:10',
        ]);

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('home')->with('error', 'حدث خطأ في الجلسة، السلة فارغة.');
        }

        // 2. استخدام Transaction لضمان حفظ كل شيء أو لا شيء (لحماية البيانات)
        DB::beginTransaction();

        try {
            foreach ($cart as $item) {
                // جلب بيانات المنتج من قاعدة البيانات للتأكد من السعر والبائع
                $listing = Listing::findOrFail($item['id']);

                Order::create([
                    'buyer_id'         => auth()->id(),            // معرف المشتري الحالي
                    'listing_id'       => $item['id'],             // معرف قطعة الملابس
                    'seller_id'        => $listing->user_id,       // صاحب القطعة (البائع)
                    'size'             => $item['size'],           // المقاس المختار
                    'color'            => $item['color'],          // اللون المختار
                    'quantity'         => $item['quantity'],       // الكمية
                    'total_price'      => $item['price'] * $item['quantity'],
                    'status'           => 'pending',               // حالة الطلب (قيد الانتظار)
                    'phone'            => $request->phone,         // هاتف المشتري
                    'shipping_address' => $request->shipping_address, // عنوان التوصيل
                ]);
            }

            DB::commit();

            // 3. مسح السلة بعد نجاح الطلب
            session()->forget('cart');

            return redirect()->route('checkout.success')->with('success', 'تم تسجيل طلبك بنجاح في تريكو! سيتواصل معك البائع قريباً.');

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'حدث خطأ أثناء معالجة الطلب: ' . $e->getMessage());
        }
    }

    /**
     * صفحة نجاح الطلب
     */
    public function success()
    {
        return view('checkout.success');
    }
}