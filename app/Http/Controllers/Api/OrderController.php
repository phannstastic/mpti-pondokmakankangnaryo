<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    // Simpan pesanan baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'total' => 'required|numeric',
            'cart' => 'required|array',
            'cart.*.id' => 'required|integer|exists:menu_items,id',
            'cart.*.quantity' => 'required|integer|min:1',
            'cart.*.price' => 'required|numeric',
        ]);

        DB::beginTransaction();
        try {
            $order = Order::create([
                'customer_name' => $validated['customer_name'],
                'total_price' => $validated['total'],
            ]);

            foreach ($validated['cart'] as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'menu_item_id' => $item['id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ]);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Pesanan berhasil disimpan.',
                'data' => $order
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Order creation failed: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menyimpan pesanan.'
            ], 500);
        }
    }

    // Ambil semua pesanan
    public function index()
    {
        $orders = Order::with('items.menuItem')->latest()->get();
        return response()->json(['success' => true, 'data' => $orders]);
    }

    // Ambil 1 pesanan berdasarkan ID
    public function show($id)
    {
        $order = Order::with('items.menuItem')->find($id);

        if (!$order) {
            return response()->json([
                'success' => false,
                'message' => 'Pesanan tidak ditemukan.'
            ], 404);
        }

        return response()->json(['success' => true, 'data' => $order]);
    }

    // Hapus pesanan
    public function destroy($id)
    {
        $order = Order::find($id);

        if (!$order) {
            return response()->json([
                'success' => false,
                'message' => 'Pesanan tidak ditemukan.'
            ], 404);
        }

        // Hapus relasi item terlebih dahulu
        $order->items()->delete();
        $order->delete();

        return response()->json(['success' => true, 'message' => 'Pesanan berhasil dihapus.']);
    }
}
