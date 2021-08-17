<?php

namespace App\Http\Controllers;

use App\Payment\PagSeguro\CreditCard;
use App\Payment\PagSeguro\Notification;
use Illuminate\Http\Request;
use App\Store;
use App\UserOrder;
use Ramsey\Uuid\Uuid;

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
        $reference = Uuid::uuid4();
    
        $creditCardPayment = new CreditCard($cartItems,$user,$dataPOST, $reference);

        $result = $creditCardPayment->doPayment();
    
        $userOrder =[
            'reference' => $reference,
            'pagseguro_code'=> $result->getCode(),
            'pagseguro_status'=> $result->getStatus(),
            'items' => serialize($cartItems),
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

    public function notification()
    {
        try {
            $notification = new Notification();
            $notification =  $notification->getTransaction();
    

            $reference = base64_decode($notification->getReference());
            $userOrder= UserOrder::whereReference($reference);
            $userOrder->update([
                'pagseguro_status' => $notification->getStatus()
            ]);
    
            //TodoList:
            /*
             Notify User when status equals 3; Email;
             Notify Sellers when status equal 3;Email and notification;
             */
    
             return response()->json([],203);
        } catch (\Exception $e) {
            $message = env('APP_DEBUG') ? $e->getMessage() : [];
            return response()->json(['error'=> $message],500);
        }

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
