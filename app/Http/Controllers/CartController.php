<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Models\Medicine; 
 use App\Models\Order;
use App\Models\OrderItem;
use Chapa\Chapa\Facades\Chapa as Chapa;
use Illuminate\Support\Facades\Auth;



use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;




class CartController extends Controller
{
    protected $reference;

    public function __construct(){
        $this->reference = Chapa::generateReference();

    }
 
    public function cart()
    {
        return view('ecommerce.cart.index');
    }
public function addToCart(Request $request, $id)
{
    $medicine = Medicine::find($id);

    $cart = session()->get('cart', []);

    if(isset($cart[$id])) {
        $cart[$id]['quantity']++;
    } else {
        $cart[$id] = [
            "name" => $medicine->name,
            "image" => $medicine->image,
            "price" => $medicine->price,
            "quantity" => 1
        ];
    }

    session()->put('cart', $cart);

    return response()->json(['cart_count' => count($cart), 'message' => 'Medicine added to cart successfully!']);
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

    $reference = $this->reference;
    
    $cart = session('cart');
    if (!$cart || count($cart) == 0) {
        return redirect()->back()->with('error', 'Your cart is empty.');
    }

    DB::beginTransaction();

    try {
        // Generate a unique payment reference
//    $reference = Chapa::generateTransactionReference();

        // Create an order
        $order = Order::create([
            'user_id' => Auth::id(),
            'order_code' => $reference,
            'status' => 'pending',
            'total_amount' => $this->calculateTotal($cart),
        ]);

        // Create order items
        foreach ($cart as $id => $details) {
            $medicine = Medicine::find($id);

            if (!$medicine) {
                return redirect()->back()->with('error', 'One of the items in your cart does not exist.');
            }

            if ($medicine->quantity < $details['quantity']) {
                return redirect()->back()->with('error', 'Insufficient stock for ' . $medicine->name . '. Only ' . $medicine->quantity . ' left.');
            }
        
            OrderItem::create([
                'order_id' => $order->id,
                'medicine_id' => $id,
                'quantity' => $details['quantity'],
                'price' => $details['price'],
            ]);
        }

        // Commit the order creation
        DB::commit();
        // Prepare payment data
        $data = [
            'amount' => $this->calculateTotal($cart),
            'email' => Auth::user()->email,
            'tx_ref' => $reference,
            'currency' => 'ETB',
            'return_url' => route('cart.payment.success', $reference), // Set the return URL
            'first_name' => Auth::user()->name,
            'last_name' => '', // Add if available
            'customization' => [
                'title' => 'Order Payment',
                'description' => 'Payment for your cart items.',
            ],
        ];

        // Initialize payment
        $payment = Chapa::initializePayment($data);

        if ($payment['status'] === 'success') {
            return redirect($payment['data']['checkout_url']);
        } else {
            return redirect()->back()->with('error', 'Failed to initialize payment.');
        }

    } catch (\Exception $e) {
        DB::rollBack();
        return redirect()->back()->with('error', 'There was an error processing your order: ' . $e->getMessage());
    }
}

public function paymentSuccess($reference)
{
    try {
        // Verify the transaction using the reference
        $response = Chapa::verifyTransaction($reference);

        if ($response['status'] === 'success') {
            DB::beginTransaction();

            try {
                // Retrieve the existing order based on the reference
                $order = Order::where('order_code', $reference)->first();

                if (!$order) {
                    return redirect()->route('cart.index')->with('error', 'Order not found.');
                }

                // Update the order status to 'completed'
                $order->update([
                    'status' => 'completed',
                ]);

                // Commit the transaction
                DB::commit();

                // Clear the cart after successful payment and order completion
                session()->forget('cart');

                return view('payment-success', ['order' => $order]); // Redirect to success page

            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->route('cart.index')->with('error', 'Failed to update the order: ' . $e->getMessage());
            }
        }

        return view('payment-failed'); // Show payment failed page if payment was unsuccessful

    } catch (\Exception $e) {
        return redirect()->route('orders.index')->with('error', 'Failed to verify the payment. Please try again.');
    }
}

    // public function callback($reference)
    // {
    //     $data = Chapa::verifyTransaction($reference);

    //     // If payment is successful
    //     if ($data['status'] == 'success') {
    //         try {
    //             DB::beginTransaction();

    //             // Retrieve the existing order based on the reference
    //             $order = Order::where('order_code', $reference)->first();

    //             if (!$order) {
    //                 return redirect()->route('cart.index')->with('error', 'Order not found.');
    //             }

    //             // Update the order status to 'completed' after successful payment
    //             $order->update(['status' => 'completed']);

    //             // Commit the transaction
    //             DB::commit();

    //             // Clear the cart after successful payment and order completion
    //             session()->forget('cart');

    //             return view('payment-success'); // Show payment success page

    //         } catch (\Exception $e) {
    //             DB::rollBack();
    //             return redirect()->route('cart.index')->with('error', 'Failed to update the order: ' . $e->getMessage());
    //         }
    //     } else {
    //         // Handle failed payment
    //         return view('payment-failed'); // Redirect to failure view
    //     }
    // }

    // Function to calculate total amount
    private function calculateTotal($cart)
    {
        $total = 0;
        foreach ($cart as $details) {
            $total += $details['price'] * $details['quantity'];
        }
        return $total;
    }
}


  

