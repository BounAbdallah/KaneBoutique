<?php

/////////// Configuration du controller pour les Commandes Utilisateurs //////////

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserOrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // Récupère toutes les commandes de l'utilisateur connecté
        $orders = Order::where('customer_email', auth()->user()->email)->get();
        return view('orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        // Vérifie que la commande appartient bien à l'utilisateur connecté
        if ($order->customer_email !== auth()->user()->email) {
            abort(403, 'Unauthorized action.');
        }

        // Récupère les articles de la commande
        $orderItems = $order->orderItems;  // Utiliser orderItems au lieu de items
        return view('orders.show', compact('order', 'orderItems'));
    }

    public function store(Request $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Votre panier est vide.');
        }

        DB::beginTransaction();

        try {
            $total = $this->calculateTotal($cart);

            $order = Order::create([
                'customer_name' => auth()->user()->name,
                'customer_email' => auth()->user()->email,
                'status' => 'pending',
                'total' => $total,
            ]);

            foreach ($cart as $productId => $details) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $productId,
                    'quantity' => $details['quantity'],
                    'price' => $details['price'],
                ]);
            }

            DB::commit();
            session()->forget('cart');

            return redirect()->route('orders.index')->with('success', 'Commande passée avec succès.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('cart.index')->with('error', 'Une erreur est survenue lors de la création de la commande.');
        }
    }

    public function destroy(Order $order)
    {
        // Vérifie que la commande appartient bien à l'utilisateur connecté
        if ($order->customer_email !== auth()->user()->email) {
            abort(403, 'Unauthorized action.');
        }

        // Vérifie que la commande n'est pas en attente avant de la supprimer
        if ($order->status === 'pending') {
            return redirect()->route('orders.index')->with('error', 'Les commandes en attente ne peuvent pas être supprimées.');
        }

        // Supprime la commande
        $order->delete();
        return redirect()->route('orders.index')->with('success', 'Commande supprimée.');
    }

    private function calculateTotal($cart)
    {
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return $total;
    }
}
