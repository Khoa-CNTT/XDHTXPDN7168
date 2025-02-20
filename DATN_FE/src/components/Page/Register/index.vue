<template>
    <!-- Normal Breadcrumb Begin -->
    <section class="normal-breadcrumb set-bg" data-setbg="../../../assets/assets_Anime/img/normal-breadcrumb.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="normal__breadcrumb__text" style="
                    font-family: 'Baloo Da 2', cursive;
                    font-weight: 600;
                    font-size: 36px;
                    line-height: 1.2;
                    color: #fff;
                    text-transform: uppercase;
                    letter-spacing: 1px;
                ">
                    <h2>ĐĂNG ký</h2>
                    <p style="font-size: 18px;color: #fff;margin-top: 10px;">Chào mừng đến với WOPAI</p>
                </div>
            </div>
        </div>
    </div>
</section>

    <!-- Normal Breadcrumb End -->

    <!-- Login Section Begin -->
    <section class="login spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="login__form">
                        <h3>Đăng Ký</h3>
                        <form action="#">
                            <div class="input__item">
                                <input type="text" placeholder="Nhập email" v-model="dang_ky.email">
                                <span class="icon_mail"></span>
                            </div>
                            <div class="input__item">
                                <input type="text" placeholder="Nhập họ và tên" v-model="dang_ky.ho_va_ten">
                                <span class="icon_mail"></span>
                            </div>
                            <div class="input__item">
                                <input type="password" placeholder="Nhập mật khẩu" v-model="dang_ky.password"
                                    id="inputPassword">
                                <span class="icon_lock" style="cursor: pointer" id="btnHidePassword"></span>
                            </div>
                            <div class="input__item">
                                <input type="password" placeholder="Nhập lại mật khấu" v-model="dang_ky.re_password"
                                    id="inputPassword">
                                <span class="icon_lock" style="cursor: pointer" id="btnHidePassword"></span>
                            </div>
                            <button type="button" @click="dangKy()" class="site-btn">Đăng ký ngay</button>
                        </form>
                        <h5 style="font-size: 15px; color: #ffffff" class="text-white mt-4">Đã có tài khoản?
                            <router-link to="/login">
                                <a class="text-danger ml-1" type="button" style="font-size: 17px;"> Đăng nhập!</a>
                            </router-link>
                        </h5>
                        <router-link to="/home/forget-password">
                            <a class="forget_pass"></a>

                        </router-link>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="login__register">
                        <h3>Đăng nhập với:</h3>
                        <div class="login__social">
                            <div class="col-lg-6">
                                <div class="login__social__links">
                                    <ul>
                                        <li><a href="http://127.0.0.1:8000/api/auth/google" type="button"
                                                class="google"><i class="fa fa-google"></i>
                                                Đăng nhập với Google</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</template>
<script>
import axios from "axios";
import { createToaster } from "@meforma/vue-toaster";
import baseRequest from '../../../core/baseRequestUser';
const toaster = createToaster({ position: "top-right" });
export default {
    data() {
        return {
            dang_ky: {},
            imageUrl: {},
        };
    },
    mounted() {
        this.checkToken();
    },
    methods: {
        kichHoatTK() {
            baseRequest
                .post('gui-mail-kich-hoat', this.dang_ky)
                .then((res) => {
                    if (res.data.status == true) {
                        this.$store.dispatch('showSuccess', { description: res.data.message, });
                        this.$router.push('/login');
                    } else {
                        this.$store.dispatch('showError', { description: res.data.message, });
                    }
                });
        },
        dangKy() {
            baseRequest
                .post("khach-hang/register", this.dang_ky)
                .then((res) => {
                    this.kichHoatTK();
                })
                .catch((res) => {
                    var errors = Object.values(res.response.data.errors);
                    this.$store.dispatch('showError', { description: errors[0], });
                });
        },
        checkToken() {
            this.$store.dispatch('showLoader');
            axios
                .post('http://127.0.0.1:8000/api/khach-hang/check', {}, {
                    headers: {
                        Authorization: 'Bearer ' + localStorage.getItem('token_user')
                    }
                })
                .then((res) => {
                    console.log(res.data);
                    localStorage.setItem('ho_ten_user', res.data.ho_ten_user);
                    localStorage.setItem('hinh_anh_user', res.data.hinh_anh_user);
                    if (res.status === 200) {
                        this.is_login = true;
                        this.list_token = res.data.list;
                        this.dang_ky = {};
                        this.$router.push('/');
                    }
                    this.$store.dispatch('hideLoader');


                })
                .catch(() => {
                    this.is_login = false;
                    this.$store.dispatch('hideLoader');

                });
        },
        // handleFileUpload(event) {
        //       const file = event.target.files[0];
        //       const cloudName = 'dltbjoii4';
        //       const uploadPreset = 'yvvll2k0';

        //       const formData = new FormData();
        //       formData.append('file', file);
        //       formData.append('upload_preset', uploadPreset);

        //       fetch(`https://api.cloudinary.com/v1_1/${cloudName}/image/upload`, {
        //         method: 'POST',
        //         body: formData,
        //       })
        //       .then((response) => response.json())
        //       .then((data) => {
        //         // Set the imageUrl to the URL of the uploaded image.
        //         this.imageUrl = data.secure_url;
        //         // console.log(this.imageUrl);
        //         this.dang_ky.hinh_anh = data.secure_url;
        //         toaster.success('upload ảnh thành công!');
        //       })
        //       .catch((error) => {
        //         console.error('Error uploading image:', error);
        //       });
        //   },

    },
};
</script>
<style>
.login {
    padding-top: 130px;
    padding-bottom: 120px;
}

.login__form {
    position: relative;
    padding-left: 145px;
}

.login__form:after {
    position: absolute;
    right: -14px;
    top: -40px;
    height: 330px;
    width: 1px;
    background: rgba(255, 255, 255, 0.2);
    content: "";
}

.login__form h3 {
    color: #ffffff;
    font-weight: 700;
    font-family: "Oswald", sans-serif;
    margin-bottom: 30px;
}

.login__form form .input__item {
    position: relative;
    width: 370px;
    margin-bottom: 20px;
}

.login__form form .input__item:before {
    position: absolute;
    left: 50px;
    top: 10px;
    height: 30px;
    width: 1px;
    background: #b7b7b7;
    content: "";
}

.login__form form .input__item input {
    height: 50px;
    width: 100%;
    font-size: 15px;
    color: #b7b7b7;
    background: #ffffff;
    border: none;
    padding-left: 76px;
}

.login__form form .input__item input::-webkit-input-placeholder {
    color: #b7b7b7;
}

.login__form form .input__item input::-moz-placeholder {
    color: #b7b7b7;
}

.login__form form .input__item input:-ms-input-placeholder {
    color: #b7b7b7;
}

.login__form form .input__item input::-ms-input-placeholder {
    color: #b7b7b7;
}

.login__form form .input__item input::placeholder {
    color: #b7b7b7;
}

.login__form form .input__item span {
    color: #b7b7b7;
    font-size: 20px;
    position: absolute;
    left: 15px;
    top: 13px;
}

.login__form form button {
    border-radius: 0;
    margin-top: 10px;
}

.login__form .forget_pass {
    font-size: 15px;
    color: #ffffff;
    display: inline-block;
    position: absolute;
    right: 60px;
    bottom: 12px;
}

.login__register {
    padding-left: 30px;
}

.login__register h3 {
    color: #ffffff;
    font-weight: 700;
    font-family: "Oswald", sans-serif;
    margin-bottom: 30px;
}

.login__register .primary-btn {
    background: #e53637;
    padding: 12px 42px;
}

.login__social {
    padding-top: 52px;
}

.login__social__links {
    text-align: center;
}

.login__social__links span {
    color: #ffffff;
    display: block;
    font-size: 13px;
    font-weight: 700;
    letter-spacing: 2px;
    text-transform: uppercase;
    margin-bottom: 30px;
}

.login__social__links ul li {
    list-style: none;
    margin-bottom: 15px;
}

.login__social__links ul li:last-child {
    margin-bottom: 0;
}

.login__social__links ul li a {
    color: #ffffff;
    display: block;
    font-size: 13px;
    font-weight: 700;
    letter-spacing: 2px;
    text-transform: uppercase;
    width: 460px;
    padding: 14px 0;
    position: relative;
    margin: 0 auto;
}

.login__social__links ul li a.facebook {
    background: #4267b2;
}

.login__social__links ul li a.google {
    background: #ff4343;
}

.login__social__links ul li a.twitter {
    background: #1da1f2;
}

.login__social__links ul li a i {
    font-size: 20px;
    position: absolute;
    left: 32px;
    top: 14px;
}

/*---------------------
  Sign Up
-----------------------*/

.signup {
    padding-top: 130px;
    padding-bottom: 150px;
}

.signup .login__form:after {
    height: 450px;
}

.signup .login__form h5 {
    font-size: 15px;
    color: #ffffff;
    margin-top: 36px;
}

.signup .login__form h5 a {
    color: #e53637;
    font-weight: 700;
}

.signup .login__social__links {
    text-align: left;
    padding-left: 40px;
}

.signup .login__social__links h3 {
    color: #ffffff;
    font-weight: 700;
    font-family: "Oswald", sans-serif;
    margin-bottom: 30px;
}

.signup .login__social__links ul li a {
    margin: 0;
    text-align: center;
}

@media only screen and (max-width: 991px) {
    .login__form {
        padding-left: 0;
        margin-bottom: 40px;
    }

    .login__form:after {
        display: none;
    }

    .login__form form .input__item {
        width: 100%;
        max-width: 370px;
        margin: 0 auto 20px;
    }

    .login__register {
        padding-left: 0;
        text-align: center;
    }

    .login__social {
        padding-top: 30px;
    }
}

@media only screen and (max-width: 768px) {
    .signup {
        padding-top: 80px;
        padding-bottom: 80px;
    }

    .login__social__links ul li a {
        width: 100%;
        max-width: 460px;
    }

    .normal__breadcrumb__text h2 {
        font-size: 30px;
    }

    .normal__breadcrumb__text p {
        font-size: 16px;
    }

    .login__form h5 {
        text-align: center;
    }
}

@media only screen and (max-width: 576px) {
    .login__social__links ul li a {
        font-size: 12px;
        padding: 12px 0;
    }

    .login__social__links ul li a i {
        font-size: 16px;
        left: 20px;
        top: 12px;
    }

    .login__form form .input__item input {
        padding-left: 55px;
    }
}
</style>
