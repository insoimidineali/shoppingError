<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Command;
use App\Models\Slider;
use App\Models\Cart;
use App\Models\Client;
use Facade\FlareClient\Http\Client as HttpClient;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Srmklive\PayPal\Services\ExpressCheckout;
// use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    //
    public function home(){
        $slider = Slider::where("status",1)->get();
        $product = Product::where("status",1)->get();
        return view("client.home")->with('sliders', $slider)->with("products", $product);
    }
    public function shop(){
        $product = Product::where("status",1)->get();
        return view("client.shop")->with("products", $product);
    }
    public function cart(){
        return view("client.cart");
    }
    public function checkout(){
        if(Session::has('client')) return view("client.checkout");
        return redirect('/signin');
    }
    public function register(){
        return view("client.register");
    }

    //   Creat Acount
       public function createaccount(Request $request){
        
        $this->validate($request, [
            "email"=>"email|required|unique:clients",
            "password"=>"required|min:4"

        ]);

        $client = NEW Client();
        $client->email = $request->input('email');
        $client->password = bcrypt($request->input('password'));

        $client->save();

        return back()->with("status", 'Your account has been successfully created');

       }
        
       public function accessaccount(Request $request){
                $this->validate($request, [
                    "email"=>"email|required",      
                ]);
                    $client = Client::where("email", $request->email)->first();
                if($client){
                    if(Hash::check($request->input("password"), $client->password)){
                        Session::put("client", $client);
                        return redirect("/shop");
                    }
                    return back()->with("error", "Wrong email or password");

                }
                return back()->with("error", " You don't have an account with this email");
    }
     

    public function signin(){
        return view("client.signin");
    }

    public function logout(){
        Session::forget("client");
        return back();
    }

    public function addtocart($id){
        $product= Product::find($id);

        $oldCart = Session::has("cart") ? Session::get('cart') : null;
        $cart = new Cart($oldCart);

        $cart->add($product);
        Session::put('cart', $cart);
        Session::put('topCart', $cart->items);

        return back();
        // dd(Session::get('cart'));
        // print($product);
    }

    public function updateqty(Request $request, $id){
        $product= Product::find($id);

        $oldCart = Session::has("cart") ? Session::get('cart') : null;
        $cart = new Cart($oldCart);

        $cart->updateQty($id, $request->qty);
        Session::put('cart', $cart);
        Session::put('topCart', $cart->items);

        return back();
    }

    public function removeitem($id){
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $cart->removeItem($id);

        Session::put('cart', $cart);
        Session::put('topCart', $cart->items);

        return back();

    }

    public function tobuy(Request $request){

        try{

            $oldCart = Session::has("cart") ? Session::get('cart') : null;
            $cart = new Cart($oldCart);
            
            $comand = new Command();
            $comand->name = $request->input('firstname'). " ".$request->input("lastname");
            $comand->address = $request->input("address");
            $comand->cart = serialize($cart);

            Session::put('order', $comand);

            $checkoutData = $this->checkoutData();

            $provider = new ExpressCheckout();
    
            $response = $provider->setExpressCheckout($checkoutData);
    
            return redirect($response['paypal_link']);

        }
               catch(\Exception $e){
               return redirect('/cart')->with('status', $e->getMessage());
        }
        
    }
    private function checkoutData(){

                $oldCart = Session::has('cart')? Session::get('cart'):null;
                $cart = new Cart($oldCart);

                $data['items'] = [];

                foreach($cart->items as $item ){
                        $itemDetails=[
                        'name' => $item['product_name'],
                        'price' => $item['product_price'],
                        'qty' => $item['qty']
                        ];

                    $data['items'][] = $itemDetails;            
                }

                $checkoutData = [
                    'items' => $data['items'],
                    'return_url' => url('/paymentSuccess'),
                    'cancel_url' => url('/cart'),
                    'invoice_id' => uniqid(),
                    'invoice_description' => "order description",
                    'total' => Session::get('cart')->totalPrice
                ];

                return $checkoutData;
    }

    public function paymentSuccess(Request $request){

        try{

		    $token = $request->get('token');
        	$payerId = $request->get('PayerID');
        	$checkoutData = $this->checkoutData();

        	$provider = new ExpressCheckout();
        	$response = $provider->getExpressCheckoutDetails($token);
        	$response = $provider->doExpressCheckoutPayment($checkoutData, $token, $payerId);

            Session::get('order')->save();

            Session::forget('cart');
            Session::forget('topCart');
            return redirect('/cart')->with('status', 'Votre commande a été effectuée avec succès !! ');
        }
        catch(\Exception $e){
            return redirect('/cart')->with('status', $e->getMessage());
        }
    }


}
