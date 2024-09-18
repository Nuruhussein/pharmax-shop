<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Models\Medicine; 
 use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use DB;


class CartController extends Controller
{
  
 
    public function cart()
    {
        return view('ecommerce.cart.index');
    }
    public function addToCart($id)
    {
        $medicine = Medicine::findOrFail($id);
 
        $cart = session()->get('cart', []);
 
        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        }  else {
            $cart[$id] = [
                "name" => $medicine->name,
                "image" => $medicine->image,
                "price" => $medicine->price,
                "quantity" => 1
            ];
        }
 
        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'medicene added to cart successfully!');
    }
 
    public function update(Request $request)
    {
        if($request->id && $request->quantity){
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cart successfully updated!');
        }
    }
 
    public function remove(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'medicene successfully removed!');
        }
    }


 public function checkout(Request $request)
    {
        DB::beginTransaction();

        try {
            // Retrieve cart from session
            $cart = session('cart');
            if (!$cart || count($cart) == 0) {
                return redirect()->back()->with('error', 'Your cart is empty.');
            }

            // Create an order
            $order = Order::create([
                'user_id' => Auth::id(),
                'order_code' => Str::uuid(), // Unique order code
                'status' => 'pending',
                'total_amount' => $this->calculateTotal($cart), // Calculate total amount
            ]);

            // Create order items
            foreach ($cart as $id => $details) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'medicine_id' => $id,
                    'quantity' => $details['quantity'],
                    'price' => $details['price'],
                ]);
            }

            // Commit the transaction
            DB::commit();

            // Clear the cart after successful checkout
            session()->forget('cart');

            return redirect()->route('orders.show', $order->id)->with('success', 'Order placed successfully!');
        } catch (\Exception $e) {
            DB::rollBack(); // Rollback the transaction if something goes wrong
            return redirect()->back()->with('error', 'Failed to place the order.');
        }
    }

    // Calculate the total price of the cart
    private function calculateTotal($cart)
    {
        $total = 0;
        foreach ($cart as $id => $details) {
            $total += $details['price'] * $details['quantity'];
        }
        return $total;
    }

}