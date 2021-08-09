<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        if(!auth()->check()){
            return redirect()->route('login');
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

    $dataPOST = $request -> all();
    $reference = 'XPTO';

    $creditCard = new \PagSeguro\Domains\Requests\DirectPayment\CreditCard();

    $creditCard->setReceiverEmail(env('PAGSEGURO_EMAIL'));

    $creditCard->setReference($reference);

    // Set the currency
    $creditCard->setCurrency("BRL");

    // Add items for this payment request

    $cartItems = session()->get('cart');

    foreach($cartItems as  $item){
        $creditCard->addItems()->withParameters(
            $reference,
            $item['name'],
            $item['amount'],
            $item['price']
        );
    }

    // Set your customer information.
    // If you using SANDBOX you must use an email @sandbox.pagseguro.com.br

    $user = auth()->user();
    $email = env('PAGSEGURO_ENV') == 'sandbox' ? 'c53281149833065927639@sandbox.pagseguro.com.br' : $user->email;

    $creditCard->setSender()->setName($user->name);
    $creditCard->setSender()->setEmail($email);

    //This is an example that can be changed to future implementations
    $creditCard->setSender()->setPhone()->withParameters(
        11,
        56273440
    );

    //This is an example that can be changed to future implementations
    $creditCard->setSender()->setDocument()->withParameters(
        'CPF',
        '38883880749'
    );

    $creditCard->setSender()->setHash($dataPOST['hash']);

    //This is an example that can be changed to future implementations
    $creditCard->setSender()->setIp('127.0.0.0');

    // Set shipping information for this payment request
    //This is an example that can be changed to future implementations
    $creditCard->setShipping()->setAddress()->withParameters(
        'Av. Brig. Faria Lima',
        '1384',
        'Jardim Paulistano',
        '01452002',
        'São Paulo',
        'SP',
        'BRA',
        'apto. 114'
    );

    //Set billing information for credit card 
    //This is an example that can be changed to future implementations
    $creditCard->setBilling()->setAddress()->withParameters(
        'Av. Brig. Faria Lima',
        '1384',
        'Jardim Paulistano',
        '01452002',
        'São Paulo',
        'SP',
        'BRA',
        'apto. 114'
    );

    // Set credit card token
    $creditCard->setToken($dataPOST['card_token']);

    //Set payment installment
    list($quantity,$installmentAmount ) = explode('|', $dataPOST['installment']);
    
    $installmentAmount = number_format($installmentAmount,2,'.','');
    
    $creditCard->setInstallment()->withParameters($quantity, $installmentAmount);

    // Set the credit card holder information
    //This is an example that can be changed to future implementations
    $creditCard->setHolder()->setBirthdate('01/10/1979');

    $creditCard->setHolder()->setName($dataPOST['card_name']);
  
    //This is an example that can be changed to future implementations
    $creditCard->setHolder()->setPhone()->withParameters(
        11,
        56273440
    );

    //This is an example that can be changed to future implementations
    $creditCard->setHolder()->setDocument()->withParameters(
        'CPF',
        '38883880749'
    );

    $creditCard->setMode('DEFAULT');

    $result = $creditCard->register(
        \PagSeguro\Configuration\Configure::getAccountCredentials()
    );

    var_dump($result);
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
