<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Chapa\Chapa\Facades\Chapa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDF;
use Illuminate\Support\Facades\Storage;

class PaymentController extends Controller
{
//   public function callback($reference)
// {
//     try {
//         // Verify the transaction using the reference
//         $response = Chapa::verifyTransaction($reference);

//         if ($response['status'] === 'success') {
//             DB::beginTransaction();

//             try {
//                 // Retrieve the existing order based on the reference
//                 $order = Order::where('order_code', $reference)->first();

//                 if (!$order) {
//                     return redirect()->route('cart.index')->with('error', 'Order not found.');
//                 }

//                 // Update the order status to 'completed' after successful payment
//                 $order->update(['status' => 'completed']);

//                 // Commit the transaction
//                 DB::commit();

//                 // Clear the cart after successful payment and order completion
//                 session()->forget('cart');

//                 return view('payment-success'); // Show payment success page

//             } catch (\Exception $e) {
//                 DB::rollBack();
//                 return redirect()->route('cart.index')->with('error', 'Failed to update the order: ' . $e->getMessage());
//             }
//         }

//         return view('payment-failed'); // Show payment failed page if payment was unsuccessful

//     } catch (\Exception $e) {
//         return redirect()->route('orders.index')->with('error', 'Failed to verify the payment. Please try again.');
//     }
// }
 public function downloadReceipt($orderCode)
    {
        $order = Order::where('order_code', $orderCode)->firstOrFail();

        // Generate the receipt PDF (you can use a package like Dompdf or Snappy)
        $pdf = PDF::loadView('ecommerce.receipts.order', compact('order'));

        // Save the PDF to storage (optional)
        $pdfPath = 'receipts/' . $orderCode . '.pdf';
        Storage::put($pdfPath, $pdf->output());

        // Return the PDF for download
        return $pdf->download('receipt_' . $orderCode . '.pdf');
    }


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
