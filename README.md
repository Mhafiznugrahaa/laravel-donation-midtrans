# 🧾 Catatan Integrasi Midtrans di Laravel (via Ngrok Sandbox)

## 📍 1. Tujuan
Integrasi sistem donasi Laravel dengan **Midtrans Snap API (Sandbox)** untuk memproses pembayaran otomatis dan menyimpan data transaksi ke database.  
Aplikasi berjalan **lokal di Laragon**, dan **Ngrok** digunakan untuk membuat endpoint webhook Midtrans bisa diakses secara publik.

---

## ⚙️ 2. Persiapan Awal

### 🔹 a. Daftar & Konfigurasi Midtrans
1. Masuk ke [https://dashboard.sandbox.midtrans.com](https://dashboard.sandbox.midtrans.com)  
2. Masuk ke menu **Settings → Access Keys**  
3. Catat dan masukkan ke file `.env`:

   ```env
   MIDTRANS_SERVER_KEY=SB-Mid-server-KU3THhhdilQY5xzCN-TsNob3
   MIDTRANS_CLIENT_KEY=SB-Mid-client-fb-R5KtAmwkYBzka
   MIDTRANS_MERCHANT_ID=G975616972
   ```

4. Pastikan environment-nya **sandbox**, bukan production.

---

### 🔹 b. Jalankan aplikasi Laravel di lokal
```bash
php artisan serve
```

### 🔹 c. Aktifkan Ngrok agar webhook bisa diakses
```bash
ngrok http 8000
```
Ngrok akan memberikan URL publik seperti:
```
https://d9a2-125-162-12-1.ngrok-free.app
```

---

## 🌐 3. Routing Laravel untuk Midtrans
Tambahkan pada `routes/web.php`:
```php
Route::post('api/webhook/midtrans', [PaymentController::class, 'webhook']);
Route::post('ngamal/{donation}', [PaymentController::class, 'store']);
Route::get('payment/finish', [PaymentController::class, 'finishTransaction']);
Route::get('payment/unfinish', [PaymentController::class, 'unfinishTransaction']);
Route::get('payment/error', [PaymentController::class, 'errorTransaction']);
```

---

## 🧠 4. Controller: `PaymentController.php`
Versi final dan sudah diperbaiki:

```php
<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    public function store(Request $request, Donation $donation)
    {
        $request->validate(['nominal' => 'required|numeric|min:10000']);

        $params = [
            'transaction_details' => [
                'order_id' => 'donation-' . explode('@', Auth::user()->email)[0] . '-' . Str::uuid(),
                'gross_amount' => $request->nominal
            ],
            'item_details' => [[
                'price' => $request->nominal,
                'quantity' => 1,
                'name' => $donation->title
            ]],
            'customer_details' => [
                'first_name' => Auth::user()->name,
                'email' => Auth::user()->email
            ],
            'enabled_payments' => [
                'credit_card', 'bri_va', 'bni_va', 'bca_va',
                'gopay', 'indomaret', 'danamon_online',
                'akulaku', 'shopeepay', 'kredivo', 'uob_ezpay', 'other_qris'
            ]
        ];

        $serverKey = env('MIDTRANS_SERVER_KEY');
        $auth = base64_encode($serverKey . ':');

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => "Basic $auth"
        ])->post('https://app.sandbox.midtrans.com/snap/v1/transactions', $params);

        $response = json_decode($response->body());

        Payment::create([
            'user_id' => Auth::user()->id,
            'donation_id' => $donation->id,
            'order_id' => $params['transaction_details']['order_id'],
            'status' => 'pending',
            'nominal' => $request->nominal,
            'checkout_link' => $response->redirect_url
        ]);

        return redirect($response->redirect_url);
    }

    public function webhook(Request $request)
    {
        $serverKey = env('MIDTRANS_SERVER_KEY');
        $auth = base64_encode($serverKey . ':');

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => "Basic $auth",
        ])->get("https://api.sandbox.midtrans.com/v2/$request->order_id/status");

        $response = json_decode($response->body());
        $payment = Payment::where('order_id', $request->order_id)->firstOrFail();

        if (in_array($payment->status, ['capture', 'settlement'])) {
            return response()->json(['message' => 'already processed']);
        }

        $payment->status = $response->transaction_status ?? 'unknown';
        $payment->save();

        return response()->json(['message' => 'success']);
    }

    public function finishTransaction() { return view('transactions.finish'); }
    public function unfinishTransaction() { return view('transactions.unfinish'); }
    public function errorTransaction() { return view('transactions.error'); }
}
```

---

## 🔐 5. Penjelasan Penting
| Bagian | Fungsi |
|--------|---------|
| Server Key | Untuk autentikasi antar server (backend → Midtrans) |
| Client Key | Digunakan di frontend (Snap.js) |
| Authorization | `Basic base64_encode(<server-key> + ":")` |
| Endpoint | `https://app.sandbox.midtrans.com/snap/v1/transactions` |
| Webhook URL | `https://<ngrok>.ngrok-free.app/api/webhook/midtrans` |
| Response sukses | Mengembalikan `token` dan `redirect_url` |

---

## 🧩 6. Testing Alur Lengkap
1. Jalankan Laravel (`php artisan serve`)
2. Jalankan Ngrok (`ngrok http 8000`)
3. Masukkan URL webhook ke Dashboard Midtrans → **Settings → Configuration → Notification URL**
4. Jalankan transaksi donasi di `ngamal/{donation}`
5. Midtrans mengembalikan token dan redirect ke Snap UI
6. Webhook mengupdate status pembayaran ke database

---

## ✅ 7. Hasil Akhir
- ✅ Laravel terhubung ke Midtrans Sandbox  
- ✅ Transaksi donasi berhasil dibuat  
- ✅ Webhook aktif melalui Ngrok  
- ✅ Tidak ada lagi error “Unauthorized transaction” / “Bad Request”

---

## 🧠 8. Catatan Tambahan
- Gunakan Job/Queue untuk proses webhook
- Simpan semua log transaksi
- Pindah ke Production mode saat rilis
- Hindari hardcode server key — selalu pakai `.env`
