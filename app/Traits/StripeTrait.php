<?php

namespace App\Traits;

use Exception;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\Log;
use Stripe\Stripe;
use Stripe\Token;

trait StripeTrait
{
    use ApiResponse;

    protected $Stripe;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->Stripe = new \Stripe\StripeClient(
                \config('constants.STRIPE_SECRET')
            );
            return $next($request);
        });
    }

    public function serchCustomer($email)
    {
        $error = array();
        try {
            // $respo = $this->Stripe->customers->retrieveSource($cus_id, $card_id, []);
            $respo = $this->Stripe->customers->search([
                'query' => 'email:\'$email\' AND metadata[\'foo\']:\'bar\'',
            ]);
        } catch (\Stripe\Exception\CardException $e) {
            $error['status'] = $e->getHttpStatus();
            $error['code'] = $e->getError()->code;
            $error['param'] = $e->getError()->param;
            $error['message'] = $e->getError()->message;
        } catch (Exception $e) {
            $error[] = $e;
        }

        if (sizeof($error) > 0) {
            return $error;
        }
        return $respo;
    }

    public function createCard($cus_id, $card_token)
    {
        $error = array();

        try {
            $respo = $this->Stripe->customers->createSource(
                $cus_id,
                ['source' => $card_token]
            );

        } catch (\Stripe\Exception\InvalidRequestException $e) {
            $error['status'] = $e->getHttpStatus();
            $error['code'] = $e->getError()->code;
            $error['param'] = $e->getError()->param;
            $error['message'] = $e->getMessage();
        } catch (\Stripe\Exception\CardException $e) {
            $error['status'] = $e->getHttpStatus();
            $error['code'] = $e->getError()->code;
            $error['param'] = $e->getError()->param;
            $error['message'] = $e->getError()->message;
        } catch (Exception $e) {
            // $error[] = $e;
            $error['status'] = false;
            $error['message'] = $e->getMessage();
        }

        if (sizeof($error) > 0) {
            return $error;
        }

        return $respo;
    }

    public function customerCardList($cus_id, $limit)
    {
        $error = array();
        try {
            $respo = $this->Stripe->customers->allSources(
                $cus_id,
                ['object' => 'card', 'limit' => $limit]
            );
        } catch (\Stripe\Exception\InvalidRequestException $e) {
            $error['status'] = $e->getHttpStatus();
            $error['code'] = $e->getError()->code;
            $error['param'] = $e->getError()->param;
            $error['message'] = $e->getError()->message;
        } catch (Exception $e) {
            $error[] = $e;
        }

        if (sizeof($error) > 0) {
            return $error;
        }
        return $respo;
    }

    public function createCardCharge($amount, $cus_id, $card_id, $currency, ...$args)
    {
        Log::info("createCardCharge");
        Log::info(json_encode([$amount, $cus_id, $card_id]));
        $error = array();
        try {
            $respo = $this->Stripe->charges->create(array_merge([
                'amount' => $amount,
                'currency' => $currency,
                "customer" => $cus_id,
                'source' => $card_id,
            ], ...$args));
            Log::info(json_encode($respo));
            Log::info("charge response");
        } catch (\Stripe\Exception\InvalidRequestException $e) {
            $error['status'] = $e->getHttpStatus();
            $error['code'] = $e->getError()->code;
            $error['param'] = $e->getError()->param;
            $error['message'] = $e->getError()->message;
        } catch (Exception $e) {
            $error[] = $e;
        }

        if (sizeof($error) > 0) {
            return $error;
        }

        return $respo;
    }


    public function createCharge($amount, $stripe_token, $cart_id)
    {
        $error = array();
        try {

            $respo = $this->Stripe->charges->create([
                'amount' => $amount,
                'currency' => 'usd',
                'source' => $stripe_token,
                'description' => $cart_id,
            ]);

        } catch (\Stripe\Exception\InvalidRequestException $e) {
            $error['status'] = $e->getHttpStatus();
            $error['code'] = $e->getError()->code;
            $error['param'] = $e->getError()->param;
            $error['message'] = $e->getError()->message;
        } catch (\Stripe\Exception\CardException $e) {
            $error['status'] = $e->getHttpStatus();
            $error['code'] = $e->getError()->code;
            $error['param'] = $e->getError()->param;
            $error['message'] = $e->getError()->message;
        } catch (Exception $e) {
            $error[] = $e;
        }

        if (sizeof($error) > 0) {
            return $error;
        }

        return $respo;
    }

    public function createCardChargeWithOtherAccount($amount, $cus_id, $source, $currency, $other_details = [], $stripe_accounts = null): mixed
    {
        Log::info("createCardCharge");
        Log::info(json_encode([$amount, $cus_id, $source, $currency, $other_details, $stripe_accounts]));
        $error = array();
        try {
            $respo = $this->Stripe->charges->create(array_merge([
                'amount' => $amount,
                'currency' => $currency,
                'source' => $source,
            ], $other_details), ['stripe_account' => $stripe_accounts]);
        } catch (\Stripe\Exception\InvalidRequestException $e) {
            $error['status'] = $e->getHttpStatus();
            $error['code'] = $e->getError()->code;
            $error['param'] = $e->getError()->param;
            $error['message'] = $e->getError()->message;
        } catch (Exception $e) {
            $error[] = $e;
        }

        if (sizeof($error) > 0) {
            return $error;
        }

        return $respo;
    }

    public function createCustomer($email, $name)
    {
        $error = array();
        try {
            $respo = $this->Stripe->customers->create([
                'email' => $email,
                'name' => $name,
            ]);
        } catch (\Stripe\Exception\InvalidRequestException $e) {
            $error['status'] = $e->getHttpStatus();
            $error['code'] = $e->getError()->code;
            $error['param'] = $e->getError()->param;
            $error['message'] = $e->getError()->message;
        } catch (Exception $e) {
            $error[] = $e;
        }

        if (sizeof($error) > 0) {
            return $error;
        }
        return $respo;
    }

    public function deleteCustomerCard($cus_id, $card_id)
    {
        $error = array();
        try {
            $respo = $this->Stripe->customers->deleteSource($cus_id, $card_id, []);
        } catch (\Stripe\Exception\CardException $e) {
            $error['status'] = $e->getHttpStatus();
            $error['code'] = $e->getError()->code;
            $error['param'] = $e->getError()->param;
            $error['message'] = $e->getError()->message;
        } catch (Exception $e) {
            $error[] = $e;
        }

        if (sizeof($error) > 0) {
            return $error;
        }

        return $respo;
    }

    public function retrieveCustomerCard($cus_id, $card_id)
    {
        $error = array();
        try {
            $respo = $this->Stripe->customers->retrieveSource($cus_id, $card_id, []);
        } catch (\Stripe\Exception\CardException $e) {
            $error['status'] = $e->getHttpStatus();
            $error['code'] = $e->getError()->code;
            $error['param'] = $e->getError()->param;
            $error['message'] = $e->getError()->message;
        } catch (Exception $e) {
            $error[] = $e;
        }

        if (sizeof($error) > 0) {
            return $error;
        }

        return $respo;
    }

    public function updatedCustomerCard($cus_id, $card_id, $array)
    {
        $error = array();
        try {
            $respo = $this->Stripe->customers->updateSource($cus_id, $card_id, $array);
        } catch (\Stripe\Exception\CardException $e) {
            $error['status'] = $e->getHttpStatus();
            $error['code'] = $e->getError()->code;
            $error['param'] = $e->getError()->param;
            $error['message'] = $e->getError()->message;
        } catch (Exception $e) {
            $error[] = $e;
        }

        if (sizeof($error) > 0) {
            return $error;
        }

        return $respo;
    }

    public function updateCustomer($cus_id, $array)
    {
        $error = array();
        try {
            $respo = $this->Stripe->customers->update($cus_id, $array);
        } catch (\Stripe\Exception\CardException $e) {
            $error['status'] = $e->getHttpStatus();
            $error['code'] = $e->getError()->code;
            $error['param'] = $e->getError()->param;
            $error['message'] = $e->getError()->message;
        } catch (Exception $e) {
            $error[] = $e;
        }

        if (sizeof($error) > 0) {
            return $error;
        }

        return $respo;
    }

    public function retrieveCustomer($cus_id)
    {
        $error = array();
        try {
            $respo = $this->Stripe->customers->retrieve($cus_id, []);
        } catch (\Stripe\Exception\CardException $e) {
            $error['status'] = $e->getHttpStatus();
            $error['code'] = $e->getError()->code;
            $error['param'] = $e->getError()->param;
            $error['message'] = $e->getError()->message;
        } catch (Exception $e) {
            $error[] = $e;
        }

        if (sizeof($error) > 0) {
            return $error;
        }

        return $respo;
    }

    public function createAccount($array)
    {
        $error = array();
        try {
            $respo = $this->Stripe->accounts->create($array);
            Log::info(json_encode($respo, JSON_THROW_ON_ERROR));
        } catch (\Stripe\Exception\ApiErrorException $e) {
            Log::info("ApiErrorException");
            Log::info(json_encode($e, JSON_THROW_ON_ERROR));
            $error['error'] = true;
            $error['status'] = $e->getHttpStatus();
            $error['code'] = $e->getError()->code;
            $error['param'] = $e->getError()->param;
            $error['message'] = $e->getError()->message;
            Log::info(json_encode($error));
        } catch (Exception $e) {
            Log::info("Exception");
            Log::info(json_encode($e, JSON_THROW_ON_ERROR));
            $error[] = $e;
        }
        if (sizeof($error) > 0) {
            return $error;
        }
        return $respo;
    }

    public function AccountLink($array)
    {
        $error = array();
        try {
            $respo = $this->Stripe->accountLinks->create($array);
        } catch (\Stripe\Exception\ApiErrorException $e) {
            // dd($e);
            $error['error'] = true;
            $error['status'] = $e->getHttpStatus();
            $error['code'] = $e->getError()->code;
            $error['param'] = $e->getError()->param;
            $error['message'] = $e->getError()->message;
        } catch (Exception $e) {
            $error[] = $e;
        }

        if (sizeof($error) > 0) {
            return $error;
        }

        return $respo;
    }

    public function updateAccount($acc_id, $array)
    {
        $error = array();
        try {
            $respo = $this->Stripe->accounts->update($acc_id, $array);
        } catch (\Stripe\Exception\ApiErrorException $e) {
            $error['status'] = $e->getHttpStatus();
            $error['code'] = $e->getError()->code;
            $error['param'] = $e->getError()->param;
            $error['message'] = $e->getError()->message;
        } catch (Exception $e) {
            $error[] = $e;
        }

        if (sizeof($error) > 0) {
            return $error;
        }

        return $respo;
    }

    public function retrieveAccount($acc_id): mixed
    {
        $error = array();
        try {
            $respo = $this->Stripe->accounts->retrieve($acc_id, []);
        } catch (\Stripe\Exception\ApiErrorException $e) {
            $error['status'] = $e->getHttpStatus();
            $error['code'] = $e->getError()->code;
            $error['param'] = $e->getError()->param;
            $error['message'] = $e->getError()->message;
        } catch (Exception $e) {
            $error[] = $e;
        }

        if (sizeof($error) > 0) {
            return $error;
        }

        return $respo;
    }

    public function createTrasfer($amount, $currency, $destination, array ...$args)
    {
        Log::info("array");
        Log::info(json_encode([$amount, $currency, $destination, ...$args], JSON_THROW_ON_ERROR));
        $error = array();
        try {
            \Stripe\Stripe::setApiKey(\config('constants . STRIPE_SECRET'));
            $respo = $this->Stripe->transfers->create(array_merge([
                'amount' => $amount,
                'currency' => $currency,
                'destination' => $destination,
            ], ...$args));
        } catch (\Stripe\Exception\CardException $e) {
            Log::info("CardException");
            Log::info($e);
            $error['status'] = $e->getHttpStatus();
            $error['code'] = $e->getError()->code;
            $error['param'] = $e->getError()->param;
            $error['message'] = $e->getError()->message;
        } catch (Exception $e) {
            Log::info("Exception");
            Log::info($e);
            $error[] = $e;
        }

        if (sizeof($error) > 0) {
            return null;
        }

        return $respo;

    }

    public function createPayout($array)
    {
        $error = array();
        try {
            $respo = $this->Stripe->payouts->create($array);
        } catch (\Stripe\Exception\CardException $e) {
            $error['status'] = $e->getHttpStatus();
            $error['code'] = $e->getError()->code;
            $error['param'] = $e->getError()->param;
            $error['message'] = $e->getError()->message;
        } catch (Exception $e) {
            $error[] = $e;
        }

        if (sizeof($error) > 0) {
            return $error;
        }

        return $respo;
    }

    public function createFile($filepath, $purpose)
    {
        $error = array();
        try {
            $respo = $this->Stripe->files->create([
                'purpose' => $purpose,
                'file' => fopen(base_path() . $filepath, 'r')
            ]);
        } catch (\Stripe\Exception\CardException $e) {
            $error['status'] = $e->getHttpStatus();
            $error['code'] = $e->getError()->code;
            $error['param'] = $e->getError()->param;
            $error['message'] = $e->getError()->message;
        } catch (Exception $e) {
            $error[] = $e;
        }

        if (sizeof($error) > 0) {
            return $error;
        }

        return $respo;
    }

    public function paymentIntent($amount)
    {
        $error = array();
        try {

            $respo = $this->Stripe->paymentIntents->create([
                'amount' => $amount,
                'currency' => 'usd',
                'automatic_payment_methods' => [
                    'enabled' => true,
                ],
            ]);

        } catch (\Stripe\Exception\InvalidRequestException $e) {
            $error['status'] = $e->getHttpStatus();
            $error['code'] = $e->getError()->code;
            $error['param'] = $e->getError()->param;
            $error['message'] = $e->getError()->message;
        } catch (Exception $e) {
            $error[] = $e;
        }

        if (sizeof($error) > 0) {
            return $error;
        }
        return $respo;
    }

    public function getBalance()
    {
        $error = array();
        try {
            \Stripe\Stripe::setApiKey(\config('constants . STRIPE_SECRET'));
            $respo = $this->Stripe->balance->retrieve([]);
            Log::info(json_encode($respo));
        } catch (\Stripe\Exception\CardException $e) {
            Log::info("CardException");
            Log::info($e);
            $error['status'] = $e->getHttpStatus();
            $error['code'] = $e->getError()->code;
            $error['param'] = $e->getError()->param;
            $error['message'] = $e->getError()->message;
        } catch (Exception $e) {
            Log::info("Exception");
            Log::info($e);
            $error[] = $e;
        }

        if (sizeof($error) > 0) {
            return $error;
        }

        return $respo;

    }

}
