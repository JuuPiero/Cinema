<?php 

namespace App\Wrapper;

// https://developers.momo.vn/v3/vi/docs/payment/onboarding/test-instructions/ acc momo test
class Momo {

    public static function createPayment($data) {

        $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
        $partnerCode = 'MOMOBKUN20180529';
        $accessKey = 'klm05TvNBzhg7h7j';
        $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';

        $orderInfo = "Thanh toán qua ATM MoMo";
        $orderId = time() . "";
        $redirectUrl = route('checkout.momo.return');
        $ipnUrl = route('checkout.momo.return');

        $extraData = "";
       
        $orderId = generateRandomString(15); // Mã đơn hàng
        $orderInfo = $data['card-note'];
        $amount = $data['total-price'] * 24000;

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
        if( isset($jsonResult['payUrl'])) {
            header('Location: ' . $jsonResult['payUrl']);
            die();
        }
        else {
            return redirect()->back();
        }
    }
}