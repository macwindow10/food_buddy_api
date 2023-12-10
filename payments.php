<?php

//echo '1';

require_once 'stripe-php/init.php';
require_once 'secrets.php';

//echo '2';
$stripe = new \Stripe\StripeClient($stripeSecretKey);

//echo '3';
//header('Content-Type: application/json');

// Use an existing Customer ID if this is a returning customer.
$customer = $stripe->customers->create();
//echo '4';
//echo $customer;

$ephemeralKey = $stripe->ephemeralKeys->create([
  'customer' => $customer->id,
], [
  'stripe_version' => '2022-08-01',
]);
//echo '5';
//echo $ephemeralKey;

$paymentIntent = $stripe->paymentIntents->create([
  'amount' => 1099,
  'currency' => 'eur',
  'customer' => $customer->id,
  'payment_method_types' => ['card'],
]);

//echo '6';
//echo $paymentIntent;

$arr = [
    "paymentIntent" => $paymentIntent->client_secret,
    "ephemeralKey" => $ephemeralKey->secret,
    "customer" => $customer->id,
    "publishableKey" => "pk_test_51OLKPfKCP8INzgGfuvWEZuWQqnhj4ozyUJdPj4nOogAf8XJ4kA621tKS160rb0ZUUoYSTc1hE0suJ7CvxhSInmYr000kxkWt14"
];
//echo '7';
//echo $arr;
echo json_encode($arr);

http_response_code(200);

?>