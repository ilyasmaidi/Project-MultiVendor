<div class="card p-4">
    <h3>بيانات التوصيل</h3>
    <form action="{{ route('checkout.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>رقم الهاتف (ضروري للتواصل):</label>
            <input type="text" name="phone" class="form-control" placeholder="0XXXXXXXXX" required>
        </div>
        
        <div class="mb-3">
            <label>العنوان الكامل (الولاية، البلدية، الشارع):</label>
            <textarea name="shipping_address" class="form-control" rows="3" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary w-100">تأكيد الطلب الآن</button>
    </form>
</div>