<template>
  <div class="payment-success">
    <div class="success-container">
      <div class="icon-container">
        <i :class="paymentStatus.icon" :style="{color: paymentStatus.color}"></i>
      </div>
      <h2 class="title">{{ paymentStatus.title }}</h2>
      <p class="message">{{ paymentStatus.message }}</p>
      
      <div v-if="isPaymentSuccess" class="details">
        <p><strong>Số tiền:</strong> {{ formatCurrency(paymentInfo.amount) }}</p>
        <p><strong>Mã giao dịch:</strong> {{ paymentInfo.transactionNo }}</p>
        <p v-if="paymentInfo.paymentType === 'vnpay'">
          <strong>Ngân hàng:</strong> {{ paymentInfo.bankCode }}
        </p>
        <p><strong>Phương thức:</strong> {{ paymentInfo.paymentType === 'momo' ? 'Ví MOMO' : 'VNPAY' }}</p>
        <p><strong>Thông tin đơn hàng:</strong> {{ paymentInfo.orderInfo }}</p>
      </div>
      
      <p class="message">Nếu bạn có vấn đề, vui lòng liên hệ với chúng tôi:</p>
      <p class="message">Email: <a href="mailto:vietdev2106@gmail.com">vietdev2106@gmail.com</a></p>
      <p class="message">SĐT: 0905.123.456</p>
      <router-link :to="'/'" class="btn btn-primary">
        Trở về trang chủ
      </router-link>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import baseRequestUser from '../../../core/baseRequestUser';

export default {
  name: "ThanhToanThanhCong",
  data() {
    return {
      query: this.$route.query,
      paymentInfo: {
        amount: 0,
        orderInfo: '',
        transactionNo: '',
        paymentType: '',
        responseCode: '',
        transactionStatus: ''
      },
      errorMessages: {
        // Mã lỗi VNPAY
        "00": "Giao dịch thành công",
        // Mã lỗi MOMO
        "0": "Giao dịch thành công",
        // Thêm các mã lỗi khác từ tài liệu VNPAY
      }
    };
  },
  computed: {
    isPaymentSuccess() {
      return this.paymentInfo.paymentType === 'momo' 
        ? this.paymentInfo.responseCode === "0"
        : this.paymentInfo.responseCode === "00";
    },
    paymentStatus() {
      if (this.isPaymentSuccess) {
        return {
          icon: "fas fa-check-circle success-icon",
          color: "#28a745",
          title: "CẢM ƠN BẠN ĐÃ THANH TOÁN",
          message: "Chúng tôi đã nhận được thanh toán từ bạn. Chúng tôi sẽ gửi hóa đơn qua email của bạn."
        };
      } else {
        return {
          icon: "fas fa-times-circle",
          color: "#dc3545",
          title: "THANH TOÁN KHÔNG THÀNH CÔNG",
          message: this.getErrorMessage()
        };
      }
    }
  },
  mounted() {
    const urlParams = new URLSearchParams(window.location.search);
    console.log(this.$route.query);
    // Kiểm tra xem là thanh toán MOMO hay VNPAY
    if (urlParams.get('type') === 'momo') {
      // Xử lý response MOMO
      this.paymentInfo = {
        amount: parseInt(urlParams.get('amount')),
        orderInfo: urlParams.get('orderId'),
        transactionNo: urlParams.get('transId'),
        paymentType: 'momo',
        responseCode: urlParams.get('resultCode'),
        orderId: urlParams.get('orderId')
      };
      this.checkPayMent();

    } else if (urlParams.get('type') === 'vnpay') {
      // Xử lý response VNPAY
      this.paymentInfo = {
        amount: parseInt(urlParams.get('vnp_Amount')) / 100,
        orderInfo: urlParams.get('vnp_OrderInfo'),
        transactionNo: urlParams.get('vnp_TransactionNo'),
        paymentType: 'vnpay',
        responseCode: urlParams.get('vnp_ResponseCode'),
        bankCode: urlParams.get('vnp_BankCode')
      };
      this.checkPayMent();

    }
  },
  methods: {
    formatCurrency(amount) {
      return new Intl.NumberFormat("vi-VN", {
        style: "currency",
        currency: "VND",
      }).format(amount);
    },
    getErrorMessage() {
      const code = this.paymentInfo.responseCode;
      return this.errorMessages[code] || `Lỗi không xác định (Mã: ${code})`;
    },
    checkPayMent() {
      baseRequestUser
                .post("khach-hang/thanh-toan/vnpay/check-payment", this.paymentInfo)
                .then((res) => {
                    console.log(res);
                })
                .catch((res) => {
                    var errors = Object.values(res.response.data.errors);
                    toaster.error(errors[0]);
      });
    } 
  },
};
</script>

<style scoped>
/* Giữ nguyên CSS của bạn và thêm một số style cho trạng thái lỗi */
.payment-success {
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 100vh;
  background-color: #f5f9fc;
  font-family: Arial, sans-serif;
}

.success-container {
  text-align: center;
  padding: 50px;
  background: #ffffff;
  border-radius: 10px;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
  max-width: 600px;
  width: 90%;
}

.icon-container {
  font-size: 60px;
  margin-bottom: 30px;
}

.title {
  font-size: 28px;
  color: #333;
  margin-bottom: 15px;
}

.message {
  font-size: 18px;
  color: #666;
  margin-bottom: 20px;
}

.details {
  margin: 25px 0;
  text-align: left;
  background-color: #f8f9fa;
  padding: 15px;
  border-radius: 5px;
  border-left: 4px solid #007bff;
}

.details p {
  font-size: 16px;
  margin: 10px 0;
}

.btn {
  display: inline-block;
  padding: 10px 20px;
  background-color: #007bff;
  color: #fff;
  border-radius: 5px;
  text-decoration: none;
  font-size: 16px;
  margin-top: 10px;
}

.btn:hover {
  background-color: #0056b3;
}

.success-icon {
  font-size: 70px;
}

.btn-primary {
  background-color: #007bff;
  border-color: #007bff;
  color: #fff;
}

.btn-primary:hover {
  background-color: #0056b3;
  border-color: #0056b3;
}
</style>