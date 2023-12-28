<template>
    

    

   

    <!-- Login Section Begin -->
    <section class="login spad" style=" background-image: url(); background-color: #263238;">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="login__form">
                        <h3>Đăng Nhập</h3>
                        <form action="#">
                            <div class="input__item">
                                <input type="text" placeholder="Địa chỉ email">
                                <span class="icon_mail"></span>
                            </div>
                            <div class="input__item">
                                <input type="text" placeholder="Mật khẩu">
                                <span class="icon_lock"></span>
                            </div>
                            <button type="submit" class="site-btn">Đăng Nhập</button>
                        </form>
                        <a href="#" class="forget_pass">Quên mật khẩu?</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="login__register">
                        <h3>Bạn Không Có Tài Khoản?</h3>
                        <a href="#" class="primary-btn">Đăng Ký</a>
                    </div>
                </div>
            </div>
            <div class="login__social">
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-6">
                        <div class="login__social__links">
                            <span>or</span>
                            <ul>
                                <li><a href="#" class="facebook"><i class="fa-brands fa-facebook"></i> Đăng Nhập với
                                Facebook</a></li>
                                <li><a href="#" class="google"><i class="fa-brands fa-google"></i> Đăng Nhập Bằng Google</a></li>
                                <li><a href="#" class="twitter"><i class="fa-brands fa-twitter"></i> Đăng Nhập Bằng Twitter</a>
                                </li>
                            </ul>
                        </div>
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
    data() {
        return {
            dang_ky: {},
            dang_nhap: {},
            check_token: {},
            is_login: true,
            list_token: [],
            remove_token: {},
        }
    },
    mounted() {
        // this.is_login = false;
        this.checkToken();
    },
    methods: {
        dangKy() {
            axios
                .post('http://127.0.0.1:8000/api/register', this.dang_ky)
                .then((res) => {
                    toaster.success('Thông báo<br>' + res.data.message);
                });
        },
        dangNhap() {
            axios
                .post('http://127.0.0.1:8000/api/login', this.dang_nhap)
                .then((res) => {
                    if (res.data.status) {
                        toaster.success('Thông báo<br>' + res.data.message);
                        var arr = res.data.token.split("|");
                        localStorage.setItem('token', arr[1]);
                        console.log(arr[1]);
                        this.checkToken();
                    } else {
                        toaster.error('Thông báo<br>' + res.data.message);
                    }
                });
        },
        checkToken() {
            axios
                .post('http://127.0.0.1:8000/api/check', {}, {
                    headers: {
                        Authorization: 'Bearer ' + localStorage.getItem('token')
                    }
                })
                .then((res) => {
                    console.log(res.data);
                    localStorage.setItem('ho_ten', res.data.ho_ten);
                    localStorage.setItem('hinh_anh', res.data.hinh_anh);
                    if (res.status === 200) {
                        this.is_login = true;
                        this.list_token = res.data.list;
                        this.$router.push('/admin/anime');

                    }

                })
                .catch(() => {
                    this.is_login = false;
                });
        },
        removeToken() {
            axios
                .delete('http://127.0.0.1:8000/api/thong-tin-xoa/'+ this.remove_token.id)
                .then((res) => {
                    if (res.data.status == true) {
                        toaster.success('Thông báo<br>' + res.data.message);
                        this.list_token = [],
                            this.checkToken();
                    }
                })
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