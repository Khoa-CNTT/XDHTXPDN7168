<template>
        <div class="pricing-container">
            <div class="pricing-header">
                <h2>Gói Premium</h2>
                <div class="popover-container">
                    <a class="popover-button text-dark " >Quyền lợi Prenium</a>
                    <div class="popover-content">
                        <div class="premium-container">
                        <div class="premium-header">
                            <span>Dành cho Premium</span>
                            <span class="arrow-icon">&#8250;</span>
                        </div>
                        <div  class="premium-feature">
                            <div class="icon icon-hd premium-feature-icon"></div>
                            <div class="premium-feature-text">Độ phân giải cao</div>
                        </div>
                        <div class="premium-feature">
                            <div class="icon icon-download premium-feature-icon"></div>
                            <div class="premium-feature-text">Tải video miễn phí</div>
                        </div>
                        <div class="premium-feature">
                            <div class="icon icon-badge premium-feature-icon"></div>
                            <div class="premium-feature-text">Biểu tượng độc quyền</div>
                        </div>
                        <div class="premium-feature">
                            <div class="icon icon-decoration premium-feature-icon"></div>
                            <div class="premium-feature-text">Gói trang trí độc quyền</div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pricing-cards">
                <div role="button" class="card">
                <h3>Premium 1 tháng</h3>
                <p class="price">₫57000.00</p>
                </div>
                <div role="button" class="card">
                <h3>Premium 3 tháng</h3>
                <p class="price">₫160000.00</p>
                </div>
                <div role="button" class="card">
                <h3>Premium 1 năm</h3>
                <p class="price">₫549000.00</p>
                </div>
            </div>
            <div class="payment-methods">
                <button class="btn-payment nganluong">VN PAY</button>
                <button class="btn-payment epay">MB BANK</button>
                <button class="btn-payment paypal">MOMO</button>
            </div>
            <button class="btn-buy-now">Mua ngay</button>
            <div class="terms">
                <p>Thỏa thuận Cung cấp Dịch vụ Premium BiliBili</p>
            </div>
        </div>
</template>
<script>
      import axios from "axios"
      import baseRequest from '../../../core/baseRequestUser';
      import { createToaster } from "@meforma/vue-toaster";
      const toaster = createToaster({
          position: "top-right",
      });

      export default {
           props : [ 'slug'],
          data() {
              return {
                  // id : this.$route.params.id,

               };
          },
          mounted() {


          },
          methods: {

          },
      };
</script>
<style>
body {
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  /* background: #333842; */
  background: #070720; /* Dark background */
  color: #ffffff;
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}
.popover-container {
  position: relative;
  display: inline-block;
}

.popover-content {
  display: none;
  position: absolute;
  z-index: 1;
  top: 100%;
  left: 50%;
  transform: translateX(-50%);
  padding: 10px;
  background-color: #f9f9f9;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  border-radius: 5px;
  color: black;
}

.popover-container:hover .popover-content {
  display: block;
}
.pricing-container {
  max-width: 960px;
  margin: 40px auto;
  background-color: #e7dede;
  padding: 25px;
  border-radius: 12px;
  box-shadow: 0 4px 20px rgba(0,0,0,0.1);
}

.pricing-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 30px;
  padding: 0 15px;
}

.pricing-cards {
  display: flex;
  justify-content: space-between;
  margin-bottom: 30px;
}

.card {
  border: 1px solid #ff00aa;
  padding: 20px;
  border-radius: 12px;
  width: 30%;
  text-align: center;
  box-shadow: 0 4px 8px rgba(255,0,170,0.2);
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card:hover {
  transform: translateY(-5px);
  box-shadow: 0 6px 12px rgba(255,0,170,0.3);
}

.card h3 {
  color: #333;
  margin-bottom: 15px;
}

.price {
  color: #d6006f;
  font-size: 2em;
  font-weight: bold;
  margin-bottom: 15px;
}

.payment-methods {
  text-align: center;
  margin-bottom: 30px;
}

.btn-payment {
  background-color: #fff;
  color: #d6006f;
  padding: 10px 20px;
  border: 2px solid #d6006f;
  border-radius: 20px;
  margin: 0 10px;
  cursor: pointer;
  transition: background-color 0.3s, color 0.3s;
}

.btn-payment:hover {
  background-color: #d6006f;
  color: #fff;
}

.btn-buy-now {
  background-color: #d6006f;
  color: #fff;
  padding: 20px 40px;
  border: none;
  border-radius: 20px;
  width: 100%;
  cursor: pointer;
  transition: background-color 0.3s;
}

.btn-buy-now:hover {
  background-color: #bb005f;
}

.btn-change {
  background-color: #ff00aa;
  color: #fff;
  padding: 10px 20px;
  border: none;
  border-radius: 20px;
  cursor: pointer;
  transition: background-color 0.3s;
}

.btn-change:hover {
  background-color: #e30095;
}

.terms p {
  font-size: 0.85em;
  text-align: center;
  margin-top: 20px;
  color: #666;
}
.premium-container {
    font-family: Arial, sans-serif;
    background-color: #fff;
    color: #333;
    border: 1px solid #eee;
    border-radius: 10px;
    padding: 20px;
    width: 300px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
  }
  .premium-header {
    color: #d10069;
    font-size: 18px;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    justify-content: space-between;
  }
  .premium-feature {
    display: flex;
    align-items: center;
    margin-bottom: 15px;
  }
  .premium-feature-icon {
    margin-right: 10px;
    color: #d10069;
  }
  .premium-feature-text {
    font-size: 14px;
    color: #555;
  }
  .arrow-icon {
    font-size: 20px;
    color: #d10069;
    cursor: pointer;
  }
  /* Replace with actual icons */
  .icon {
    width: 20px;
    height: 20px;
    background-color: #d10069;
    display: inline-block;
    mask-size: contain;
    mask-repeat: no-repeat;
    mask-position: center;
  }
  .icon-hd {
    mask-image: url('path-to-hd-icon.png');
  }
  .icon-download {
    mask-image: url('path-to-download-icon.png');
  }
  .icon-badge {
    mask-image: url('path-to-badge-icon.png');
  }
  .icon-decoration {
    mask-image: url('path-to-decoration-icon.png');
  }

@media (max-width: 768px) {
  .pricing-cards {
    flex-direction: column;
  }
  .card {
    width: 100%;
    margin-bottom: 20px;
  }

  .btn-buy-now {
    padding: 15px;
  }
}

</style>
