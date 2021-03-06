<?php

namespace App\Payment\PagSeguro;

use App\Cep;

class CreditCard 
{
  private $items;
  private $user;
  private $cardInfo;
  private $reference;

  public function __construct($items, $user, $cardInfo, $reference)
  {
    $this->items = $items;
    $this->user = $user;
    $this->cardInfo = $cardInfo;
    $this->reference = $reference;
  }

  public function doPayment()
  {
    $creditCard = new \PagSeguro\Domains\Requests\DirectPayment\CreditCard();
    $creditCard->setReceiverEmail(env('PAGSEGURO_EMAIL'));

    $creditCard->setReference($this->reference);
    $creditCard->setCurrency("BRL");

    foreach($this->items as $item) {
      $creditCard->addItems()->withParameters(
          $this->reference,
          $item['name'],
          $item['quantity'],
          $item['price']
      );
    }

    $creditCard->setSender()->setName($this->user->name);
    $creditCard->setSender()->setEmail(env('PAGSEGURO_ENV') === 'sandbox' ? 'c27502433980450200227@sandbox.pagseguro.com.br' : $this->user->email);
    $creditCard->setSender()->setPhone()->withParameters(
      ...explode(' ', preg_replace('/(\(|\)|-)/', '', $this->user->phone))
    );
    $creditCard->setSender()->setDocument()->withParameters(
        'CPF',
        $this->user->cpf
    );
    $creditCard->setSender()->setHash($this->cardInfo['hash']);

    $creditCard->setSender()->setIp('127.0.0.0');

    $shippingAddress = $this->user->address->address();
    $creditCard->setShipping()->setAddress()->withParameters(
        $shippingAddress->logradouro,
        $shippingAddress->number,
        $shippingAddress->bairro,
        str_replace('-', '', $shippingAddress->cep),
        $shippingAddress->localidade,
        $shippingAddress->uf,
        'BRA',
        $shippingAddress->apto ? 'apto. ' . $shippingAddress->apto : null
    );

    $billingAddress = new Cep(['cep' => $this->cardInfo['cep']]);
    $billingAddress = (object)array_merge((array)$billingAddress->address(), [
      'number' => $this->cardInfo['number'],
      'apto'   => $this->cardInfo['apto'] ? 'apto. ' . $this->cardInfo['apto'] : null
    ]);
    $creditCard->setBilling()->setAddress()->withParameters(
        $billingAddress->logradouro,
        $billingAddress->number,
        $billingAddress->bairro,
        str_replace('-', '', $billingAddress->cep),
        $billingAddress->localidade,
        $billingAddress->uf,
        'BRA',
        $billingAddress->apto
    );

    // Set credit card token
    $creditCard->setToken($this->cardInfo['token']);
    [$quantity, $installmentAmount] = explode('|', $this->cardInfo['installment']);
    $installmentAmount = number_format($installmentAmount, 2, '.', '');
    $creditCard->setInstallment()->withParameters($quantity, $installmentAmount);

    // Set the credit card holder information
    $creditCard->setHolder()->setBirthdate($this->cardInfo['birthdate']);
    $creditCard->setHolder()->setName($this->cardInfo['name']); // Equals in Credit Card

    $creditCard->setHolder()->setDocument()->withParameters(
        'CPF',
        $this->cardInfo['cpf']
    );

    $creditCard->setMode('DEFAULT');

    return $creditCard->register(
      \PagSeguro\Configuration\Configure::getAccountCredentials()
    );
  }
}
