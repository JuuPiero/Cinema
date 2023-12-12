<?php 

namespace App\Wrapper;

class Momo {

    public static function createPayment($data = null) {
        $partnerCode =  "MOMOBKUN20180529";
        $accessKey = "klm05TvNBzhg7h7j";
        $secretKey =  "at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa";

        $endpoint = "https://test-payment.momo.vn/gw_payment/transactionProcessor";
        $orderInfo = "Thanh toán qua MoMo";
        $amount = "10000";
        $orderId = time() ."";
        $returnUrl = "http://localhost:8000/atm/result_atm.php";
        $notifyurl = "http://localhost:8000/atm/ipn_momo.php";
        $bankCode = "SML";
        $orderid = time()."";
        $orderInfo = $_POST["orderInfo"];
        $amount = $_POST["amount"];
        $bankCode = $_POST['bankCode'];
        $returnUrl = $_POST['returnUrl'];
        $requestId = time()."";
        $requestType = "payWithMoMoATM";
        $extraData = "";

        $rawHashArr =  [
            'partnerCode' => $partnerCode,
            'accessKey' => $accessKey,
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderid,
            'orderInfo' => $orderInfo,
            'bankCode' => $bankCode,
            'returnUrl' => $returnUrl,
            'notifyUrl' => $notifyurl,
            'extraData' => $extraData,
            'requestType' => $requestType
        ];
        $rawHash = "partnerCode=".$partnerCode."&accessKey=".$accessKey."&requestId=".$requestId."&bankCode=".$bankCode."&amount=".$amount."&orderId=".$orderid."&orderInfo=".$orderInfo."&returnUrl=".$returnUrl."&notifyUrl=".$notifyurl."&extraData=".$extraData."&requestType=".$requestType;
        $signature = hash_hmac("sha256", $rawHash, $secretKey);

        $rawHash = "partnerCode=".$partnerCode."&accessKey=".$accessKey."&requestId=".$requestId."&bankCode=".$bankCode."&amount=".$amount."&orderId=".$orderid."&orderInfo=".$orderInfo."&returnUrl=".$returnUrl."&notifyUrl=".$notifyurl."&extraData=".$extraData."&requestType=".$requestType;
         $signature = hash_hmac("sha256", $rawHash, $secretKey);

         $data =  array('partnerCode' => $partnerCode,
                        'accessKey' => $accessKey,
                        'requestId' => $requestId,
                        'amount' => $amount,
                        'orderId' => $orderid,
                        'orderInfo' => $orderInfo,
                        'returnUrl' => $returnUrl,
                        'bankCode' => $bankCode,
                        'notifyUrl' => $notifyurl,
                        'extraData' => $extraData,
                        'requestType' => $requestType,
                        'signature' => $signature);
         $result = execPostRequest($endpoint, json_encode($data));
         $jsonResult = json_decode($result,true);  // decode json
         
         error_log( print_r( $jsonResult, true ) );
         header('Location: '.$jsonResult['payUrl']);
    }
}