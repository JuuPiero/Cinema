<?php 

namespace App\Wrapper;

// https://sandbox.vnpayment.vn/apis/vnpay-demo/ acc test
class Vnpay {

    public static function createPayment($data = null) {
        
        $vnp_TmnCode = env('VNP_TMN_CODE');
        $vnp_Url = env('VNP_URL');
        $vnp_HashSecret = env('VNP_HASH_SECRET');

        $vnp_TxnRef = generateRandomString(15); //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = $data['card-note'];
        $vnp_OrderType = 3; // 3 cho vnpay
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        $vnp_Amount = $data['total-price'] * 24000 * 100; // * với tỷ giá đô la
        $vnp_Locale = $data['language'];
        $vnp_BankCode = $data['bankcode'];
        $vnp_Returnurl = route('checkout.vnpay.return');
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
            );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        // $returnData = array('code' => '00',
        //                     'message' => 'success', 
        //                     'data' => $vnp_Url);
        header('Location: ' . $vnp_Url);
        die();
    }
}

