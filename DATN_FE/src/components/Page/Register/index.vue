<template>
    <!-- Signup Section Begin -->
    <section class="signup spad" style="background-color: #263238;">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="login__form">
                        <h3>Đăng Ký</h3>
                        <form action="#">
                            <div class="input__item">
                                <input type="text" placeholder="Nhập địa chỉ Email">
                                <span class="icon_mail"></span>
                            </div>
                            <div class="input__item">
                                <input type="text" placeholder="Tên của bạn">
                                <span class="icon_profile"></span>
                            </div>
                            <div class="input__item">
                                <input type="text" placeholder="Mật khấu">
                                <span class="icon_lock"></span>
                            </div>
                            <button type="submit" class="site-btn">Đăng Ký</button>
                        </form>
                        <h5>Bạn đã có tài khoản? <a href="#">Đăng Nhập!</a></h5>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="login__social__links">
                        <h3>Đăng Nhập với:</h3>
                        <ul>
                                 <li><a href="#" class="facebook"><i class="fa-brands fa-facebook"></i> Đăng Nhập Bằng
                                Facebook</a></li>
                                <li><a href="#" class="google"><i class="fa-brands fa-google"></i> Đăng Nhập Bằng Google</a></li>
                                <li><a href="#" class="twitter"><i class="fa-brands fa-twitter"></i> Đăng Nhập Bằng Twitter</a>
                                </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    
    
</template>
<script>
import axios from 'axios';
import { createToaster } from "@meforma/vue-toaster";
const toaster = createToaster({ position: "top-right" });
export default {
    data(){
        return{
            dang_ky: {},
        }
    },
    methods: {
        dangKy() {
            axios
                .post('http://127.0.0.1:8000/api/register', this.dang_ky)
                .then((res) => {
                    toaster.success('Thông báo<br>' + res.data.message);
                    this.dang_ky = {};
                });
        },
           /// file base 64
      async imageToBase64(file) {
        return new Promise((resolve, reject) => {
          const reader = new FileReader();
          reader.readAsDataURL(file);
  
          reader.onload = () => resolve(reader.result);
          reader.onerror = (error) => reject(error);
        });
      },
  
      async handleFileChange(event) {
        const file = event.target.files[0];
  
        if (file) {
          try {
            const base64Data = await this.imageToBase64(file);
            console.log('Base64 Data:', base64Data);
            this.dang_ky.hinh_anh = base64Data;
            // Thực hiện các hành động khác với base64Data ở đây
          } catch (error) {
            console.error('Error converting image to base64:', error);
          }
        }
      },
    },
}
</script>
<style></style>