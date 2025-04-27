<template>

    <!-- Normal Breadcrumb Begin -->
    <section class="normal-breadcrumb set-bg" data-setbg="../../../assets/assets_Anime/img/hero/hero-1.jpg">
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
                        <h2>ĐĂNG NHẬP</h2>
                        <p style="font-size: 18px;color: #fff;margin-top: 10px;">Chào mừng đến với WOPAI</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Normal Breadcrumb End -->

    <!-- Login Section Begin -->
    <section class="login spad" style="padding-top: 110px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="login__form">
                        <h3>Đăng nhập</h3>
                        <form action="#">
                            <div class="input__item">
                                <input type="text" placeholder="Nhập email" v-model="user.email">
                                <span class="icon_mail"></span>
                            </div>
                            <div class="input__item">
                                <input type="password" placeholder="Nhập mật khẩu" v-model="user.password"
                                    id="inputPassword">
                                <span class="icon_lock" style="cursor: pointer" id="btnHidePassword"></span>
                            </div>
                            <button type="button" @click="dangNhap()" class="site-btn">Đăng nhập</button>
                        </form>
                        <router-link to="/home/forget-password">
                            <a class="forget_pass">Quên mật khẩu ?</a>
                        </router-link>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="login__register">
                        <h3>Chưa có tài khoản?</h3>
                        <router-link to="/register">
                            <a class="primary-btn text-white">Đăng ký ngay</a>
                        </router-link>
                    </div>
                </div>
            </div>
            <div class="login__social">
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-6">
                        <div class="login__social__links">
                            <span>hoặc</span>
                            <ul>
                                <li><a href="#" @click="signInWithGoogle" class="google"><i class="fa fa-google"></i>
                                        Đăng nhập với Google</a></li>
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
import { auth } from '../../../firebase/config.js'
import { GoogleAuthProvider, signInWithPopup } from 'firebase/auth'
const toaster = createToaster({ position: "top-right" });
export default {
    data() {
        return {
            dang_ky: { is_done: 0, },
            user: {},
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

        async signInWithGoogle() {
            try {
                const provider = new GoogleAuthProvider();
                    provider.setCustomParameters({
                        prompt: 'select_account'
                    });
                const result = await signInWithPopup(auth, provider)

                // Lấy thông tin user từ Google
                const userData = {
                    id_token: await result.user.getIdToken(),
                    email: result.user.email,
                    name: result.user.displayName,
                    avatar: result.user.photoURL,
                    google_id: result.user.uid
                }

                // Gửi thông tin đến Laravel backend
                const res = await axios.post(import.meta.env.VITE_API_URL + 'google/callback', userData)
                console.log(userData);
                if (res.data.status) {
                    var arr = res.data.token.split("|");
                    localStorage.setItem('token_user', arr[1]);
                    this.checkToken();
                    this.$store.dispatch('showSuccess', { description: res.data.message, });
                } else {
                    this.$store.dispatch('showError', { description: res.data.message, });
                }
            } catch (error) {
                console.error('Lỗi đăng nhập Google:', error)
                this.$store.dispatch('showError', {
                    description: "Đăng nhập thất bại!"
                });
            }
        },
        dangNhap() {
            axios
                .post(import.meta.env.VITE_API_URL + 'khach-hang/login', this.user)
                .then((res) => {
                    if (res.data.status) {
                        var arr = res.data.token.split("|");
                        localStorage.setItem('token_user', arr[1]);
                        this.checkToken();
                        this.$store.dispatch('showSuccess', { description: res.data.message, });
                    } else {
                        this.$store.dispatch('showError', { description: res.data.message, });
                    }
                })
                .catch((res) => {
                    var errors = Object.values(res.response.data.errors);
                    this.$store.dispatch('showError', { description: errors[0], });
                });
        },
        checkToken() {
            axios
                .post(import.meta.env.VITE_API_URL + 'khach-hang/check', {}, {
                    headers: {
                        Authorization: 'Bearer ' + localStorage.getItem('token_user')
                    }
                })
                .then((res) => {
                    console.log(res.data);
                    localStorage.setItem('ho_ten_user', res.data.ho_ten_user);
                    localStorage.setItem('hinh_anh_user', res.data.hinh_anh_user);
                    localStorage.setItem('id_user', res.data.id_user);
                    if (res.status === 200) {
                        this.is_login = true;
                        // this.$router.push('/');
                        setTimeout(() => {
                            window.location.href = '/';
                        }, 1000);

                    }

                })
                .catch(() => {
                    this.is_login = false;
                });
        },

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
}

@media only screen and (max-width: 768px) {
    .login {
        padding-top: 80px;
        padding-bottom: 80px;
    }

    .login__social__links ul li a {
        width: 100%;
        max-width: 460px;
    }

    .login__form .forget_pass {
        position: static;
        display: block;
        margin-top: 20px;
        text-align: center;
    }

    .normal__breadcrumb__text h2 {
        font-size: 30px;
    }

    .normal__breadcrumb__text p {
        font-size: 16px;
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
}
</style>
