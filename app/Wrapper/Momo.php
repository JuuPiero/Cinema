<?php 

namespace App\Wrapper;

// https://developers.momo.vn/v3/vi/download/ app test
// https://developers.momo.vn/v3/vi/docs/payment/onboarding/test-instructions/ test tuto
class Momo {

    //ATM
    public static function createPayment($data) {

        $endpoint = env('MOMO_ENDPOINT');
        $partnerCode = env('MOMO_PARTNER_CODE');
        $accessKey = env('MOMO_ACCESS_KEY');
        $secretKey = env('MOMO_SECRET_KEY');
        $orderId = time() . "";
        $redirectUrl = route('checkout.momo.return');
        $ipnUrl = route('checkout.momo.return');
        $extraData = '';
      
        $orderInfo = $data['card-note'];
        $amount = $data['total-price'] * 24000; //VND
        $requestId = time() . "";
        $requestType = "payWithATM";
        //before sign HMAC SHA256 signature
        $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
        $signature = hash_hmac("sha256", $rawHash, $secretKey);
        $data = [
            'partnerCode' => $partnerCode,
            'partnerName' => "Test",
            "storeId" => "MomoTestStore",
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'redirectUrl' => $redirectUrl,
            'ipnUrl' => $ipnUrl,
            'lang' => 'vi',
            'extraData' => $extraData,
            'requestType' => $requestType,
            'signature' => $signature
        ];
        $result = execPostRequest($endpoint, json_encode($data));
        $jsonResult = json_decode($result, true);  // decode json
        if($jsonResult['resultCode'] == 22) {
            die( '<h1>' . $jsonResult['message'] . '</h1>');
        }
        if( isset($jsonResult['payUrl'])) {
            header('Location: ' . $jsonResult['payUrl']);
            die();
        }
        else {
            return redirect()->back();
        }
    }

    //QR
    public static function createPaymentQr($data)
    {
        $endpoint = env('MOMO_ENDPOINT');
        $partnerCode = 'MOMOBKUN20180529'; // also use env like atm
        $accessKey = 'klm05TvNBzhg7h7j'; // also use env like atm
        $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa'; // also use env like atm
        $amount = $data['total-price'] * 24000; 
        $orderId = time() . "";
        $redirectUrl = route('checkout.momo.return');
        $ipnUrl = route('checkout.momo.return');
        $extraData = "";
        $orderInfo = $data['card-note'];
        $extraData = '';
 
        $requestId = time() . "";
        $requestType = "captureWallet";
    
        $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
        $signature = hash_hmac("sha256", $rawHash, $secretKey);
        $data = array('partnerCode' => $partnerCode,
            'partnerName' => "Test",
            "storeId" => "MomoTestStore",
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'redirectUrl' => $redirectUrl,
            'ipnUrl' => $ipnUrl,
            'lang' => 'vi',
            'extraData' => $extraData,
            'requestType' => $requestType,
            'signature' => $signature
        );
        $result = execPostRequest($endpoint, json_encode($data));
        $jsonResult = json_decode($result, true);  // decode json
        if( isset($jsonResult['payUrl'])) {
            header('Location: ' . $jsonResult['payUrl']);
            die();
        }
        else {
            return redirect()->back();
        }
    }
}