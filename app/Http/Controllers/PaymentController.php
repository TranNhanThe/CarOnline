<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Users;
class PaymentController extends Controller
{
    public function vnpay_payment(Request $request){
        
$data=$request->all();
$vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
$vnp_Returnurl = "http://127.0.0.1:8000/rental/credit";
$vnp_TmnCode = "SK0KPZAM";//Mã website tại VNPAY 
$vnp_HashSecret = "NTQGYABJRFYVGMNDRXOPSWNRBDZSVLQQ"; //Chuỗi bí mật

$vnp_TxnRef = time(); //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
$vnp_OrderInfo = "Thanh toán hóa đơn";
$vnp_OrderType = "Barber Shop";
$vnp_Amount = ($data['credit'] * 100);
$vnp_Locale = "VN";
$vnp_BankCode = "NCB";
$vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
//Add Params of 2.0.1 Version

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


//var_dump($inputData);
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
$returnData = array('code' => '00'
    , 'message' => 'success',
    'msg', 'Thêm Credit thành công'
    , 'data' => $vnp_Url);
    if (isset($_POST['redirect'])) {
        $data = [
            'credit' => Auth::user()->credit + $request->credit/100
        ];
        $iduser = Auth::id();
        
        Users::where('id', $iduser)->update($data);
        
        return redirect()->away($vnp_Url)->with('msg', 'Thêm Credit thành công');
        
    } else {
        echo json_encode($returnData);
    }
	// vui lòng tham khảo thêm tại code demo
    
    }
    
}
