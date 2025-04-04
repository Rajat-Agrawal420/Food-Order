<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMail;
use App\Models\BillingAddress;
use App\Notifications\NotifyUser;
use App\Models\User;
use App\Models\Order;

class Vegyfood extends Controller
{
    //

    function index($id)
    {
        return view('products', ['id' => $id]);
    }

    function product_single($id)
    {
        $result = Product::find($id);
        return view('product-single', ['result' => $result]);
    }

    function addCart(Request $req)
    {
        $qty = $req->quantity;
        $user_id = Auth::id();  // id of logged in user
        $id = $req->product_id;

        $r = Cart::create([
            'user_id' => $user_id,
            'item_id' => $id,
            'quantity' => $qty
        ]);

        // echo $r;
        if ($r) {
            return redirect()->route('cart');
        } else {
            return back();
        }
    }

    function subscribe(Request $req)
    {

        $email = $req->email;
        $id = Auth::id();

        if (is_null($id)) {
            return response('0');
        } else {
            // Mail::to('rajatagrawal9394@gmail.com')->send(new WelcomeMail('Site Subscribed', $email));

            $user = User::find($id);
            $user->notify(new NotifyUser("A new User has Subscibed your application."));
            return response('1');
        }
    }

    function logout()
    {

        Auth::logout();

    }

    function billSubmit(Request $req)
    {

        $user_id = Auth::id();

        $product_ids = $qtys = '';

        $result = Cart::where(
            function ($query) use ($user_id) {
                if ($user_id)
                    $query->where('user_id', '=', $user_id);
                else
                    $query->where('user_id', '=', '-1');
            }
        )->get();

        $subTotal = $totalDiscount = $ship_charge = 0;
        $netTotal = 0;

        foreach ($result as $item) {

            if ($product_ids == '')
                $product_ids = $product_ids . $item->item_id;
            else
                $product_ids = $product_ids . ',' . $item->item_id;

            if ($qtys == '')
                $qtys = $qtys . $item->quantity;
            else
                $qtys = $qtys . ',' . $item->quantity;

            $detail = Product::find($item->item_id);

            $Total = $item->quantity * $detail->price;
            $subTotal += $Total;
        };

        $netTotal = $subTotal - ($totalDiscount + $ship_charge);

        BillingAddress::create([

            'user_id' => Auth::id(),
            'first_name' =>  $req->first_name,
            'last_name' => $req->last_name,
            'country' => $req->country,
            'street_address' =>  $req->street_address,
            'city' =>  $req->city,
            'zip_code' =>  $req->zip_code,
            'phone' =>    $req->phone,
            'email' =>   $req->email
        ]);

        Order::create([

            'product_id' => $product_ids,
            'user_id' => Auth::id(),
            'qty' => $qtys,
            'amount' => $netTotal,
            'discount' =>  $totalDiscount,
            'payment_method' => $req->optradio
        ]);

        $res = Cart::where(
            function ($query) use ($user_id) {
                if ($user_id)
                    $query->where('user_id', '=', $user_id);
                else
                    $query->where('user_id', '=', '-1');
            }
        )->delete();

        // return back();

        return redirect()->route('my-orders');
    }

    function showProducts(){

        $result=Product::get();

        return view('admin.products',['data'=> $result]);
    }

    function addProduct(Request $req){

        $filename = time() . "." . $req->file('newfile')->getClientOriginalExtension();
        $path=$req->file('newfile')->storeAs('public/img', $filename);

        $result=Product::create(
            [
                'product_name'=>    $req->name,
                'category' =>  $req->category,
                'price' => $req->price,
                'stock'=> $req->stock,
                'image' => $filename,
                'description' => $req->desc
            ]
            );

        return redirect()->route('shop');

    }
}
