<?php

namespace App\Http\Controllers;

use App\Jobs\MailThanhToanLoiQueue;
use App\Jobs\MailThanhToanQueue;
use App\Models\GiaoDich;
use App\Models\GoiVip;
use App\Models\HoaDon;
use App\Models\KhachHang;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class VNPayController extends Controller
{

    public function viewVNPayPayment()
    {
        return view('payment-success');
    }
    private function createHoaDon($goi, $user)
    {
        $hoaDon = HoaDon::create([
            'id_goi'        => $goi->id,
            'id_khach_hang' => $user->id,
            'tong_tien'     => $goi->tien_sale > 0 ? $goi->tien_sale : $goi->tien_goc,
            'ngay_bat_dau'  => Carbon::now('Asia/Ho_Chi_Minh'),
            'ngay_ket_thuc' => Carbon::now('Asia/Ho_Chi_Minh')->addMonths($goi->thoi_han),
            'tinh_trang'    => 0, // Mặc định là chưa thanh toán
        ]);

        $hoaDon->ma_hoa_don = 'HD0' . substr(md5($hoaDon->id . time()), 0, 5);
        $hoaDon->save();

        return $hoaDon;
    }
    public function createVnpayPayment(Request $request)
    {
        try {
            // Validate request
            $user = $this->isUser();
            if (!$user) {
                return response()->json([
                    'status' => false,
                    'message' => 'Bạn chưa đăng nhập'
                ], 401);
            }

            $request->validate([
                'id_goi' => 'required|exists:goi_vips,id'
            ]);

            $goiVip = GoiVip::find($request->id_goi);
            if (!$goiVip) {
                return response()->json([
                    'status' => false,
                    'message' => 'Không tìm thấy gói VIP'
                ], 404);
            }
            $hoaDon = $this->createHoaDon($goiVip, $user);

            date_default_timezone_set('Asia/Ho_Chi_Minh');

            $vnp_TmnCode = env('VNPAY_TMN_CODE', 'NJJ0R8FS');
            $vnp_HashSecret = env('VNPAY_HASH_SECRET', 'BYKJBHPPZKQMKBIBGGXIYKWYFAYSJXCW');
            $vnp_Url = env('VNPAY_URL', 'https://sandbox.vnpayment.vn/paymentv2/vpcpay.html');
            $vnp_ReturnUrl = route('vnpay.payment.callback') . "?type=vnpay";

            // Create payment data
            $vnp_TxnRef = $hoaDon->ma_hoa_don; // Mã đơn hàng
            $vnp_OrderInfo = "Thanh toán gói VIP: " . $goiVip->ten_goi;
            $vnp_OrderType = 'billpayment';
            $vnp_Amount = $goiVip->tien_sale * 100;
            $vnp_Locale = 'vn';
            $vnp_BankCode = 'NCB';
            $vnp_IpAddr = $request->ip();

            // Set expire time
            $startTime = date("YmdHis");
            $expire = date('YmdHis', strtotime('+15 minutes', strtotime($startTime)));

            $inputData = [
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
                "vnp_ReturnUrl" => $vnp_ReturnUrl,
                "vnp_TxnRef" => $vnp_TxnRef,
                "vnp_ExpireDate" => $expire
            ];

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
                $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
                $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
            }

            return response()->json([
                'status' => true,
                'payUrl' => $vnp_Url
            ]);
        } catch (\Exception $e) {
            Log::error('VNPAY payment error: ' . $e->getMessage());
            return response()->json([
                'status' => false,
                'message' => 'Có lỗi xảy ra: ' . $e->getMessage()
            ], 500);
        }
    }

    public function checkPayment($request)
    {
        $hoaDon = HoaDon::where('ma_hoa_don', $request['orderInfo'])->first();

        if (!$hoaDon) {
            return response()->json([
                'status' => false,
                'message' => 'Không tìm thấy hóa đơn'
            ], 404);
        }
        $khachHang = KhachHang::find($hoaDon->id_khach_hang);
        $ma_hoa_don = $hoaDon->ma_hoa_don;
        if ($request['responseCode'] === "00" || $request['responseCode'] === "0") {
            $hoaDon->update([
                'tinh_trang' => 1,
                'so_tien_da_thanh_toan' => $request['amount'],
                'loai_thanh_toan' => $request['paymentType'],
            ]);
            $hoaDon->save();
            $khachHang->update([
                'id_goi_vip' => $hoaDon->id_goi
            ]);
            $khachHang->save();
            $data = [
                'ho_ten'                => $khachHang->ho_va_ten,
                'ma_hoa_don'            => $ma_hoa_don,
                'so_tien_chuyen_khoan'  => $request['amount'],
                'so_tien_da_thanh_toan' => $hoaDon->so_tien_da_thanh_toan,
                'email'                 => $khachHang->email,
            ];

            // Kiểm tra trạng thái thanh toán
            if ($hoaDon->so_tien_da_thanh_toan >= $hoaDon->tong_tien) {
                // Đã thanh toán đủ
                $hoaDon->update(['tinh_trang' => true]);
                $data['so_tien_du'] = $hoaDon->so_tien_da_thanh_toan - $hoaDon->tong_tien; // Tiền thừa (nếu có)
                MailThanhToanQueue::dispatch($data);
            } else {
                // Chưa thanh toán đủ
                $soTienThieu = $hoaDon->tong_tien - $hoaDon->so_tien_da_thanh_toan;
                $data['so_tien_can_thanh_toan'] = $hoaDon->tong_tien;
                $data['tien_thieu'] = $soTienThieu;
                $data['qr_url'] = 'https://img.vietqr.io/image/mb-0708585120-compact2.jpg?amount='
                    . $soTienThieu
                    . '&addInfo=' . $hoaDon->ma_hoa_don
                    . '&accountName=VO_VAN_VIET';
                MailThanhToanLoiQueue::dispatch($data);
            }

            return response()->json([
                'status' => true,
                'message' => 'Thanh toán thành công',
                'hoaDon' => $hoaDon
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Thanh toán không thành công',
            'hoaDon' => $hoaDon
        ]);
    }

    public function vnpayCallback(Request $request)
    {
        if ($request->vnp_ResponseCode == "00") {
            $customer_id = auth()->user()->id ?? null;

            // Lưu vào database
            DB::table('vnpay_transactions')->insert([
                'customer_id' => $customer_id,
                'vnp_amount' => $request->vnp_Amount / 100,
                'vnp_txnref' => $request->vnp_TxnRef,
                'vnp_orderinfo' => $request->vnp_OrderInfo,
                'vnp_response_code' => $request->vnp_ResponseCode,
                'vnp_transaction_no' => $request->vnp_TransactionNo,
                'vnp_bank_code' => $request->vnp_BankCode,
                'vnp_payment_type' => $request->vnp_PaymentType,
                'status' => 'success',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return redirect()->route('home')->with('success', 'Thanh toán VNPAY thành công.');
        }

        return redirect()->route('home')->with('error', 'Lỗi trong quá trình thanh toán VNPAY.');
    }


    protected $errorMessages = [
        // Mã lỗi VNPAY
        "00" => "Giao dịch thành công",
        // Mã lỗi MOMO
        "0" => "Giao dịch thành công",
        // Thêm các mã lỗi khác từ tài liệu VNPAY
    ];

    public function showPaymentResult(Request $request)
    {
        $paymentInfo = [
            'amount' => 0,
            'orderInfo' => '',
            'transactionNo' => '',
            'paymentType' => '',
            'responseCode' => '',
            'transactionStatus' => ''
        ];



        // Kiểm tra xem là thanh toán MOMO hay VNPAY
        if ($request->query('type') === 'momo') {
            // Xử lý response MOMO
            $paymentInfo = [
                'amount' => (int)$request->query('amount'),
                'orderInfo' => $request->query('orderId'),
                'transactionNo' => $request->query('transId'),
                'paymentType' => 'momo',
                'responseCode' => $request->query('resultCode'),
                'orderId' => $request->query('orderId')
            ];
        } elseif ($request->query('type') === 'vnpay') {
            // Xử lý response VNPAY
            $paymentInfo = [
                'amount' => (int)$request->query('vnp_Amount') / 100,
                'orderInfo' => $request->query('vnp_TxnRef'),
                'transactionNo' => $request->query('vnp_TransactionNo'),
                'paymentType' => 'vnpay',
                'responseCode' => $request->query('vnp_ResponseCode'),
                'bankCode' => $request->query('vnp_BankCode')
            ];
        }
        // Kiểm tra trạng thái thanh toán
        $isPaymentSuccess = $paymentInfo['paymentType'] === 'momo'
            ? $paymentInfo['responseCode'] === "0"
            : $paymentInfo['responseCode'] === "00";
        $hoaDon = HoaDon::where('ma_hoa_don', $paymentInfo['orderInfo'])->first();
        // Gọi API kiểm tra thanh toán
        $giaoDich = GiaoDich::create([
            'id_Khach_hang' => $hoaDon->id_khach_hang,
            'ma_giao_dich' => $paymentInfo['orderInfo'],
            'orderInfo' => $paymentInfo['orderInfo'],
            'transactionNo' => $paymentInfo['transactionNo'],
            'paymentType' => $paymentInfo['paymentType'],
            'responseCode' => $paymentInfo['responseCode'],
            'tinh_trang' => $isPaymentSuccess ? "đã thanh toán" : "chưa thanh toán"
        ]);
        $this->checkPayment($paymentInfo);

        return view('payment_success', [
            'paymentInfo' => $paymentInfo,
            'isPaymentSuccess' => $isPaymentSuccess,
            'errorMessage' => $this->getErrorMessage($paymentInfo['responseCode'])
        ]);
    }

    private function getErrorMessage($code)
    {
        return $this->errorMessages[$code] ?? "Lỗi không xác định (Mã: {$code})";
    }


}
