<?php

namespace App\Payment\PagSeguro;

class CreditCard{

    private $items;
    private $user;
    private $cardInfo;
    private $reference;


    public function __construct($items,$user, $cardInfo, $reference)
    {
        $this-> items = $items;
        $this-> user = $user;
        $this-> cardInfo = $cardInfo;
        $this -> reference = $reference;
    }

    public function doPayment()
    {

        $creditCard = new \PagSeguro\Domains\Requests\DirectPayment\CreditCard();
    
        $creditCard->setReceiverEmail(env('PAGSEGURO_EMAIL'));
    
        $creditCard->setReference($this->reference);
    
        // Set the currency
        $creditCard->setCurrency("BRL");
    
        // Add items for this payment request
    
        foreach($this->items as  $item){
            $creditCard->addItems()->withParameters(
                $this->reference,
                $item['name'],
                $item['amount'],
                $item['price']
            );
        }
    
        // Set your customer information.
        // If you using SANDBOX you must use an email @sandbox.pagseguro.com.br
    
        $user = $this->user;
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
    
        $creditCard->setSender()->setHash($this->cardInfo['hash']);
    
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
        $creditCard->setToken($this->cardInfo['card_token']);
    
        //Set payment installment
        list($quantity,$installmentAmount ) = explode('|', $this->cardInfo['installment']);
        
        $installmentAmount = number_format($installmentAmount,2,'.','');
        
        $creditCard->setInstallment()->withParameters($quantity, $installmentAmount);
    
        // Set the credit card holder information
        //This is an example that can be changed to future implementations
        $creditCard->setHolder()->setBirthdate('01/10/1979');
    
        $creditCard->setHolder()->setName($this->cardInfo['card_name']);
      
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
    
        return $result;
    }


}