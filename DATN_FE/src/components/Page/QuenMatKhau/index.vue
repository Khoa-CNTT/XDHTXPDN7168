<template>

    <!-- Login Section Begin -->
    <section class="login spad" style="background-image: url(https://wallpapers.com/images/hd/4098x2304-anime-universe-image-anime-characters-hd-wallpaper-and-background-6q0wwu9gf52hvl9h.jpg); height: 100%;  ">
        <div class="container" style="background-color: rgba(10, 9, 9, 0.7); padding: 50px; ; margin-bottom: 100px;">
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
                                  <button @click="quenMatKhau()" style="width: 100%;" class="site-btn">GỬI</button>
                            </div>
                            <div class="col-12 text-center mt-1 text-white" >
                                <b>Or</b>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-6">
                                <router-link to="/login">
                                     <button  style="width: 100%; background: rgb(223, 68, 68); " class="site-btn btn">Đăng nhập</button>
                                </router-link>
                            </div>
                            <div class="col-6">
                                <router-link to="/register">
                                     <button  style="width: 100%; background: rgb(75, 46, 207); " class="site-btn btn">Đăng ký</button>
                                </router-link>
                            </div>
                        </div>




                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="login__register">
                            <router-link to="/">
                                <a class="btn btn-sm  text-info"><i class="fa-solid fa-left-long"></i>Trang Chủ </a>
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
                        toaster.success( res.data.message);
                        this.$router.push('/login');
                    } else {
                        toaster.error( res.data.message);
                    }
                })
                .catch((res) => {
                    var errors  = Object.values(res.response.data.errors);
                    errors.forEach(function(v,k){
                            toaster.error(v[0]);
                    });
                });
        }
    }
}
</script>
<style></style>
