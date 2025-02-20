<template>

    <!-- Login Section Begin -->
    <section class="login spad" style="background-image: url(https://wallpapers.com/images/hd/4098x2304-anime-universe-image-anime-characters-hd-wallpaper-and-background-6q0wwu9gf52hvl9h.jpg); height: 100%;  ">
        <div class="container forget-password-container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="login__form">
                        <div class="row">
                            <div class="col-12">
                               <h3>Quên Mật Khẩu! </h3>
                            </div>

                        </div>
                        <div >
                            <div class="input__item">
                                <input v-model="obj_quen_mk.email" type="text" placeholder="Nhập Email để đổi mật khẩu!">
                                <span class="icon_mail"></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                  <button @click="quenMatKhau()" class="site-btn w-100">GỬI</button>
                            </div>
                            <div class="col-12 text-center mt-1 text-white" >
                                <b>Or</b>
                            </div>

                        </div>
                        <div class="row button-group">
                            <div class="col-sm-6 mb-2 mb-sm-0">
                                <router-link to="/login">
                                     <button class="site-btn btn w-100 btn-login">Đăng nhập</button>
                                </router-link>
                            </div>
                            <div class="col-sm-6">
                                <router-link to="/register">
                                     <button class="site-btn btn w-100 btn-register">Đăng ký</button>
                                </router-link>
                            </div>
                        </div>




                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="login__register">
                            <router-link to="/">
                                <a class="btn btn-sm text-info home-link"><i class="fa-solid fa-left-long me-2"></i>Trang Chủ</a>
                            </router-link>
                    </div>
                    <div class="login__social__links">
                            <ul style="margin-top: 30px;">
                                <li class="li_social"><a href="#" class="facebook"><i class="fa fa-facebook"></i> Sign in With Facebook</a></li>
                                <li class="li_social"><a href="#" class="google"><i class="fa fa-google"></i> Sign in With Google</a></li>
                                <li class="li_social"><a href="#" class="twitter"><i class="fa fa-twitter"></i> Sign in With Twitter</a>
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
import baseRequest from '../../../core/baseRequestUser';
import { createToaster } from "@meforma/vue-toaster";
const toaster = createToaster({ position: "top-right" });
export default {
    data() {
        return {
            obj_quen_mk: {},
            check_token: {},
        }
    },
    mounted() {
    },
    methods: {
        quenMatKhau() {
            const payload = {
                'email' : this.obj_quen_mk.email
            };
            baseRequest
                .post('quen-mat-khau', payload)
                .then((res) =>  {
                    if(res.data.status == true) {
                        this.$store.dispatch('showSuccess', {description: res.data.message,});
                        this.$router.push('/login');
                    } else {
                        this.$store.dispatch('showError', {description: res.data.message,});
                    }
                })
                .catch((res) => {
                    var errors  = Object.values(res.response.data.errors);
                    this.$store.dispatch('showError', {description: errors[0],});
                });
        }
    }
}
</script>
<style scoped>
.forget-password-container {
    background-color: rgba(10, 9, 9, 0.7);
    padding: 50px;
    margin-bottom: 100px;
    border-radius: 10px;
}

.btn-login {
    background: rgb(223, 68, 68);
}

.btn-register {
    background: rgb(75, 46, 207);
}

.home-link {
    transition: all 0.3s ease;
}

.home-link:hover {
    transform: translateX(-5px);
}

.li_social {
    margin-bottom: 15px;
}

.li_social a {
    width: 100%;
    max-width: 460px;
    margin: 0 auto;
    display: block;
    padding: 14px 0;
    text-align: center;
    position: relative;
    font-weight: 700;
    transition: all 0.3s ease;
}

.li_social a i {
    position: absolute;
    left: 32px;
    top: 50%;
    transform: translateY(-50%);
}

@media only screen and (max-width: 991px) {
    .forget-password-container {
        padding: 30px;
    }

    .login__form {
        margin-bottom: 40px;
    }

    .login__register {
        text-align: center;
    }
}

@media only screen and (max-width: 768px) {
    .forget-password-container {
        padding: 20px;
        margin-bottom: 50px;
    }

    .login__social__links {
        padding-top: 30px;
    }

    .li_social a {
        font-size: 13px;
        padding: 12px 0;
    }

    .li_social a i {
        font-size: 16px;
        left: 20px;
    }
}

@media only screen and (max-width: 576px) {
    .forget-password-container {
        padding: 15px;
    }

    .button-group {
        margin: 0 -5px;
    }

    .button-group > div {
        padding: 0 5px;
    }

    .li_social a {
        font-size: 12px;
        padding: 10px 0;
    }

    .input__item input {
        font-size: 14px;
    }
}
</style>
