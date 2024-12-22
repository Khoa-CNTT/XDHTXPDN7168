  <template>
    <div class="payment-success">
      <div class="success-container">
        <div class="icon-container">
          <i class="fas fa-check-circle success-icon"></i>
        </div>
        <h2 class="title">CẢM ƠN BẠN ĐÃ THANH TOÁN</h2>
        <p class="message">
          Chúng tôi đã nhận được thanh toán từ bạn. Chúng tôi sẽ gửi hóa đơn qua email:
          <span class="email text-primary">{{ $route.params.email }}</span>
        </p>
        <p class="message">Vui lòng kiểm tra email của bạn để xem hoá đơn.</p>
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
  export default {
    name: "ThanhToanThanhCong",
    data() {
      return {

      };
    },
    methods: {
      formatCurrency(amount) {
        return new Intl.NumberFormat("vi-VN", {
          style: "currency",
          currency: "VND",
        }).format(amount);
      },

    },
  };
  </script>

  <style scoped>
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
    padding: 100px;
    background: #ffffff;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
  }

  .icon-container {
    font-size: 60px;
    color: #28a745;
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
    margin-bottom: 20px;
    text-align: left;
  }

  .details p {
    font-size: 16px;
    margin: 5px 0;
  }

  .btn {
    display: inline-block;
    padding: 10px 20px;
    background-color: #007bff;
    color: #fff;
    border-radius: 5px;
    text-decoration: none;
    font-size: 16px;
  }

  .btn:hover {
    background-color: #0056b3;
  }

  .success-icon {
    font-size: 70px;
    color: #28a745;
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

