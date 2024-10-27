<template>

    <!-- Login Section Begin -->
    <section class="login spad" style="background-image: url(https://wallpapers.com/images/hd/4098x2304-anime-universe-image-anime-characters-hd-wallpaper-and-background-6q0wwu9gf52hvl9h.jpg); height: 100%;  ">
        <div class="container" style="background-color: rgba(10, 9, 9, 0.7); padding: 50px; ; margin-bottom: 100px;">
            <div class="row">
                <div class="col-lg-10">
                    <div class="login__form">
                        <div class="row">
                            <div class="col-12">
                               <h3>Tài khoản <b class="text-warning">{{ obj_user.email }} </b> đã kích hoạt thành công! </h3>
                               <h3 class="text-center">VUI LÒNG ĐĂNG NHẬP! </h3>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-12 mb-3">
                                <router-link to="/login">
                                    <button  style="width: 100%;" class="site-btn">ĐĂNG NHẬP</button>
                                </router-link>
                            </div>
                            <div class="col-12 text-center mt-1 text-white" >
                            </div>

                        </div>
                        <div class="mb-5">
                        </div>





                    </div>
                </div>
                <!-- <div class="col-lg-5">
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

                </div> -->
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
            obj_user: {},
        }
    },
    mounted() {
        this.checkHashLogin();
    },
    methods: {
        checkHashLogin() {
            this.obj_user.hash_active   =    this.$route.params.hash;
            baseRequest
                .post('kiem-tra-hash-kich-hoat', this.obj_user)
                .then((res) =>  {
                    if(res.data.status == true) {
                        toaster.success(res.data.message);
                        this.obj_user.email   = res.data.email;
                    } else {
                        toaster.error(res.data.message);
                        this.$router.push('/login');
                    }
                });
        },
    }
}
</script>
<style></style>
