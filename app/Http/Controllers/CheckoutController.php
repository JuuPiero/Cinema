<?php

namespace App\Http\Controllers;

use App\Helper\CartAjax;
use App\Models\BookTicket;
use App\Models\BookTicketDetail;
use App\Wrapper\Vnpay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
{
    public function checkout(CartAjax $cart){
        return view('checkout', compact('cart'));
    }

    public function post_checkout(Request $request, CartAjax $cart) {
        if(empty($cart->content()) && empty($cart->content_food())){
            return redirect()->back()->with('error', 'You must buy at least 1 item!');
        }
        $bookTicket = BookTicket::create([
            'user_id'=>Auth::user()->id,
            'amount'=>$cart->get_total_amount(),
            'price'=>$cart->get_total_price(),
        ]);
        foreach($cart->content() as $key => $item){
            BookTicketDetail::create([
                'book_ticket_id'=> $bookTicket->id,
                'time_id'=>$key,
                'chair'=>json_encode($item['seat']),
                'quantity'=>$item['qty'],
                'price'=>$item['price'],
            ]);
        }
        foreach($cart->content_food() as $key => $item){
            BookTicketDetail::create([
                'book_ticket_id'=> $bookTicket->id,
                'food_id'=>$key,
                'quantity'=>$item['qty'],
                'price'=>$item['price']
            ]);
        }
        $user = Auth::user();

        Mail::send('mail.checkout', compact('cart'), function($email) use($user) {
            $email->subject('Boleto-cart');
            $email->to($user->email);
        });
        $cart->clear();
        return redirect()->route('index')->with('success', 'Thank you for buying!');
    }

    public function vnpay_checkout(Request $request, CartAjax $cart) {
        if(empty($cart->content()) && empty($cart->content_food())){
            return redirect()->back()->with('error', 'You must buy at least 1 item!');
        }
        $data = $request->all();
        $bookTicket = BookTicket::create([
            'user_id'=>Auth::user()->id,
            'amount'=>$cart->get_total_amount(),
            'price'=>$cart->get_total_price(),
            'payment' => $data['payment-type']
        ]);
       
        foreach($cart->content() as $key => $item){
            BookTicketDetail::create([
                'book_ticket_id'=> $bookTicket->id,
                'time_id'=>$key,
                'chair'=>json_encode($item['seat']),
                'quantity'=>$item['qty'],
                'price'=>$item['price'],
            ]);
        }
        foreach($cart->content_food() as $key => $item){
            BookTicketDetail::create([
                'book_ticket_id'=> $bookTicket->id,
                'food_id'=>$key,
                'quantity'=>$item['qty'],
                'price'=>$item['price']
            ]);
        }

        $user = Auth::user();

        // $data = $request->all();
        Vnpay::createPayment($data);

    }


    public function vnpay_return(Request $request, CartAjax $cart) {
        $data = $request->all();
        $bookTicket = BookTicket::latest()->first();
        $bookTicket->update([
            'status' => 2
        ]);
       
        $user = Auth::user();
        Mail::send('mail.checkout', compact('cart'), function($email) use($user) {
            $email->subject('Boleto-cart');
            $email->to($user->email);
        });
        $cart->clear();
        $data = [
            'Amount' => $data['vnp_Amount']. " VND",
            'BankCode' => $data['vnp_BankCode'],
            'BankTranNo' => $data['vnp_BankTranNo'],
            'CardType' => $data['vnp_CardType'],
            'PayDate' => $data['vnp_PayDate'],
            'TransactionNo' => $data['vnp_TransactionNo'],
             'TransactionStatus' => $data['vnp_TransactionStatus']
        ];
        return view('client.checkout.vnpay-return')->with([
            'data' => $data
        ]);
    }



    public function momo_checkout(Request $request, CartAjax $cart) {
        if(empty($cart->content()) && empty($cart->content_food())){
            return redirect()->back()->with('error', 'You must buy at least 1 item!');
        }
        $data = $request->all();
        $bookTicket = BookTicket::create([
            'user_id'=>Auth::user()->id,
            'amount'=>$cart->get_total_amount(),
            'price'=>$cart->get_total_price(),
            'payment' => $data['payment-type']
        ]);
       
        foreach($cart->content() as $key => $item){
            BookTicketDetail::create([
                'book_ticket_id'=> $bookTicket->id,
                'time_id'=>$key,
                'chair'=>json_encode($item['seat']),
                'quantity'=>$item['qty'],
                'price'=>$item['price'],
            ]);
        }
        foreach($cart->content_food() as $key => $item){
            BookTicketDetail::create([
                'book_ticket_id'=> $bookTicket->id,
                'food_id'=>$key,
                'quantity'=>$item['qty'],
                'price'=>$item['price']
            ]);
        }

        $user = Auth::user();

        // $data = $request->all();
        Vnpay::createPayment($data);

    }
}
