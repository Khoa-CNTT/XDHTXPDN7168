<template>

    <!-- Login Section Begin -->
    <section class="login spad" style="background-image: url(https://wallpapers.com/images/hd/4098x2304-anime-universe-image-anime-characters-hd-wallpaper-and-background-6q0wwu9gf52hvl9h.jpg); height: 100%;  ">
        <div class="container" style="background-color: rgba(10, 9, 9, 0.7); padding: 50px; ; margin-bottom: 100px;">
            <div class="row">
                <div class="col-lg-6">
                    <div class="login__form">
                        <div class="row">
                            <div class="col-12">
                               <h3>Đặt Lại Mật Khẩu! </h3>
                            </div>
                            
                        </div>
                        <div >
                            <div class="input__item">
                                <input v-model="doi_mat_khau.password" type="password" placeholder="Nhập mật khẩu mới!" >
                                <span class="icon_lock"></span>
                            </div>
                            <div class="input__item">
                                <input v-model="doi_mat_khau.re_password" type="password" placeholder="Nhập lại mật khẩu!" >
                                <span class="icon_lock"></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                  <button @click="doiMatKhau()" style="width: 100%;" class="site-btn">ĐỔI MẬT KHẨU</button>
                            </div>
                            
                        </div>
                       
                                
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="login__register">
                            <router-link to="/login">
                                <a href="#" class="btn btn-sm  text-info"><i class="fa-solid fa-left-long"></i>Đăng Nhập</a>
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
import { createToaster } from "@meforma/vue-toaster";
import baseRequestUser from '../../../core/baseRequestUser';
const toaster = createToaster({ position: "top-right" });
export default {
    data() {
        return {
            doi_mat_khau    :   {},
        }
    },
    mounted() {
        this.checkHashPass();
        console.log(this.hash);
    },
    methods: {
        checkHashPass() {
            this.doi_mat_khau.hash_quen_mat_khau   =    this.$route.params.hash;
            baseRequestUser
                .post('kiem-tra-quen-hash-pass', this.doi_mat_khau)
                .then((res) =>  {
                    if(res.data.status == true) {
                        toaster.success(res.data.message);
                    } else {
                        toaster.error(res.data.message);
                        this.$router.push('/login');
                    }
                });
        },
        doiMatKhau() {
            baseRequestUser
                .post('dat-lai-mat-khau', this.doi_mat_khau)
                .then((res) =>  {
                    if(res.data.status == true) {
                        toaster.success( res.data.message);
                        this.$router.push('/login');
                    } else {
                        toaster.error( res.data.message);
                        this.$router.push('/login');
                    }
                });
        }
        
    },
}
</script>
<style></style>