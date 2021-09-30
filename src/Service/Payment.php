<?php
/**
 * User: Yohann
 * Date: 03/09/2021
 * Time: 22:33
 */

namespace App\Service;


use App\Entity\Order;
use App\Entity\Service;
use App\Entity\User;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\DecoderInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Stripe\Stripe;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpClient\ScopingHttpClient;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;


class Payment
{
    private $entityManager;
    private $mailer;
    private $user;
    private $sandbox_account_test;
    private $paypal_client_id_test;
    private $paypal_secret_test;
    private $client;

    public function __construct(EntityManagerInterface $em,$sandbox_account_test, $paypal_client_id_test , $paypal_secret_test, HttpClientInterface $client )
    {
        $this->em = $em;
        $this->client = $client;
        $this->sandbox_account_test = $sandbox_account_test;
        $this->paypal_client_id_test = $paypal_client_id_test;
        $this->paypal_secret_test = $paypal_secret_test;
    }

    /* get env var Paypal*/
    public function getPaypalSandbox()
    {
        return $this->sandbox_account_test;
    }

    public function getPaypalClientIdTest()
    {
        return $this->paypal_client_id_test;
    }

    public function getPaypalSecretTest()
    {
        return $this->paypal_secret_test;
    }
    /* end get env var Paypal */

    //////////////////
    // Paypal
    //////////////////

    /*
     * get env var and request Paypal API
     * return token
     */
    public function connectPaypal() {
        // https://developer.paypal.com/docs/platforms/get-started/#step-1-get-api-credentials

        $response = $this->client->request('POST', 'https://api.sandbox.paypal.com/v1/oauth2/token', [ // sandbox = dev                                                        
        //$response = $this->client->request('POST', 'https://api.paypal.com/v1/oauth2/token', [ // for prod
            'headers' => [
                'Accept' => 'application/json, application/x-www-form-urlencoded',
                'Accept-Language' => 'en_US',
            ],
            'auth_basic' =>  [$this->getPaypalClientIdTest(),$this->getPaypalSecretTest()],
            'body' => ['grant_type' => 'client_credentials']
        ]);
        $content = $response->getContent(); // get Content
        $contentJson = json_decode($content); // get Json

        $tokenPaypalAcces = $contentJson->access_token; // get value "acces_token"
        //dump($tokenPaypalAcces);

        // token
        return $tokenPaypalAcces;
    }

    /* 
    * payment request with $price
    */
    public function getPay($price) {

        $tokenAccesPaypal =  $this->connectPaypal() ;

        // I think is not good request for payment 
        $ch = curl_init('https://api-m.sandbox.paypal.com/v2/checkout/orders'); // sendbox = prod
        //$ch = curl_init('https://api.sandbox.paypal.com/v2/checkout/orders/'.$orderId.'/capture');  // sendbox = dev  


        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization: Bearer ' . $tokenAccesPaypal,
            'Accept: application/json',
            'Content-Type: application/json',
            //'PayPal-Request-Id : 7b92603e-77ed-4896-8e78-5dea2050476a'
            //'PayPal-Partner-Attribution-Id:  BN-Code'
        ));
        // SSL certificat
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        $payloadData = '
        {
          "intent" : "CAPTURE",
          "purchase_units" :[
            {
              "amount" :{
                "currency_code" : "USD",
                "value" : "'.$price.'"
              }
            }
          ]
        }';

        curl_setopt($ch, CURLOPT_POSTFIELDS, $payloadData); // send JSON
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // return caracter


        $result = curl_exec($ch);
        //dump($result);  // no json

        // get error
        // $err = curl_error($ch); // dump($err) ;
        curl_close($ch);

        $resultJson = json_decode($result);


        /*
        curl -v -X POST https://api-m.sandbox.paypal.com/v2/checkout/orders \
        -H "Content-Type: application/json" \
        -H "Authorization: Bearer Access-Token" \
        -d '{
        "intent": "CAPTURE",
        "purchase_units": [
            {
            "amount": {
                "currency_code": "USD",
                "value": "100.00"
            }
            }
        ]
        }'
        */ 

    // To do : pay  $price
    return $resultJson ;

    }
}