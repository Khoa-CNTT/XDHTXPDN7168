<template>
    <div class="payment-error">
      <div class="error-container">
        <div class="icon-container">
          <i class="fas fa-times-circle error-icon"></i>
        </div>
        <h2 class="title">LỖI THANH TOÁN</h2>
        <p class="message">
          Chúng tôi rất tiếc, giao dịch của bạn không thành công.
        </p>
        <p class="message">
          Vui lòng kiểm tra lại thông tin thanh toán hoặc thử lại sau.
        </p>
        <p class="message">
          Nếu bạn gặp vấn đề, vui lòng liên hệ với chúng tôi để được hỗ trợ:
        </p>
        <p class="message">
          Email: <a href="mailto:vietdev2106@gmail.com">vietdev2106@gmail.com</a>
        </p>
        <p class="message">SĐT: 0905.123.456</p>
        <router-link :to="'/platform/checkout/process/' + $route.params.id_goi" class="btn btn-danger">
          Thử lại thanh toán
        </router-link>
        <router-link :to="'/'" class="btn btn-secondary">
          Trở về trang chủ
        </router-link>
      </div>
    </div>
  </template>

  <script>
  export default {
    name: "ThanhToanLoi",
    data() {
      return {};
    },
  };
  </script>

  <style scoped>
  .payment-error {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background-color: #f8d7da;
    font-family: Arial, sans-serif;
  }

  .error-container {
    text-align: center;
    padding: 100px;
    background: #ffffff;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
  }

  .icon-container {
    font-size: 60px;
    color: #dc3545;
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

  .btn {
    display: inline-block;
    padding: 10px 20px;
    border-radius: 5px;
    text-decoration: none;
    font-size: 16px;
    margin: 5px;
  }

  .btn-danger {
    background-color: #dc3545;
    color: #fff;
    border-color: #dc3545;
  }

  .btn-danger:hover {
    background-color: #c82333;
    border-color: #bd2130;
  }

  .btn-secondary {
    background-color: #6c757d;
    color: #fff;
    border-color: #6c757d;
  }

  .btn-secondary:hover {
    background-color: #5a6268;
    border-color: #545b62;
  }

  .error-icon {
    font-size: 70px;
    color: #dc3545;
  }
  </style>
