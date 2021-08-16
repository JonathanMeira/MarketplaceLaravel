<?php

namespace App\Http\Controllers;

use App\Payment\PagSeguro\CreditCard;
use Illuminate\Http\Request;
use App\Store;

class CheckoutController extends Controller
{
    public function index()
    {
        if(!auth()->check()){
            return redirect()->route('login');
        }
        
        if(!session()->has('cart')){
            return redirect()->route('home');
        }
        //session()->forget('pagseguro_session_code');
        
        $this -> makePagSeguroSession();
        

        $cartItems = array_map(function($line){
            return $line['amount'] * $line['price'];
        }, session()->get('cart'));

        $cartItems = array_sum($cartItems);

        return view('checkout', compact('cartItems'));
    }

    public function proccess(Request $request)      
    {
        try {
            
        $dataPOST = $request -> all();
        $user = auth()->user();
        $cartItems = session()->get('cart');
        $stores = array_unique(array_column($cartItems,'store_id'));
        $reference = 'XPTO';
    
        $creditCardPayment = new CreditCard($cartItems,$user,$dataPOST, $reference);

        $result = $creditCardPayment->doPayment();
    
        $userOrder =[
            'reference' => $reference,
            'pagseguro_code'=> $result->getCode(),
            'pagseguro_status'=> $result->getStatus(),
            'items' => serialize($cartItems),
            'store_id'=> 1
        ];
    
        $userOrder = $user-> orders()->create($userOrder);
        $userOrder->stores()->sync($stores);

        $store = (new Store())->notifyStoreOwners($stores);



        session()->forget('cart');
        session()->forget('pagseguro_session_code');

        return response()->json([
            'data' =>[
                'status' => true,
                'message' => 'Order placement was successful' ,
                'order'   => $reference  
            ]
            ]);

        } catch (\Exception $e) {
            $message = env('APP_DEBUG') ? $e->getMessage() : 'Error occurred!';
            return response()->json([
                'data' =>[
                    'status' => false,
                    'message' => $message 
                ]
                ], 401);
        }
    }

    public function thanks()
    {
        return view('thanks');
    }





    private function makePagSeguroSession()
    {
		if(!session()->has('pagseguro_session_code')) {

			$sessionCode = \PagSeguro\Services\Session::create(
				\PagSeguro\Configuration\Configure::getAccountCredentials()
			);

			return session()->put('pagseguro_session_code', $sessionCode->getResult());
		}
    }

}
