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
                                <input v-model="dang_nhap.email" type="text" placeholder="Nhập Email để đổi mật khẩu!">
                                <span class="icon_mail"></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                  <button @click="dangNhap()" style="width: 100%;" class="site-btn">GỬI</button>
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
                                <a href="#" class="btn btn-sm  text-info"><i class="fa-solid fa-left-long"></i>Trang Chủ </a>
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
                .post('http://127.0.0.1:8000/api/khach-hang/register', this.dang_ky)
                .then((res) => {
                    toaster.success( res.data.message);
                });
        },
        dangNhap() {
            axios
                .post('http://127.0.0.1:8000/api/khach-hang/login', this.dang_nhap)
                .then((res) => {
                    if (res.data.status) {
                        toaster.success( res.data.message);
                        var arr = res.data.token.split("|");
                        localStorage.setItem('token_user', arr[1]);
                        console.log(arr[1]);
                        this.checkToken();
                    } else {
                        toaster.error( res.data.message);
                    }
                });
        },
        checkToken() {
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
                    localStorage.setItem('id_user', res.data.id_user);
                    if (res.status === 200) {
                        this.is_login = true;
                        // this.list_token = res.data.list;
                        this.$router.push('/');

                    }

                })
                .catch(() => {
                    this.is_login = false;
                });
        },
        // removeToken() {
        //     axios
        //         .delete('http://127.0.0.1:8000/api/khach-hang/thong-tin-xoa/'+ this.remove_token.id)
        //         .then((res) => {
        //             if (res.data.status == true) {
        //                 toaster.success( res.data.message);
        //                 this.list_token = [],
        //                     this.checkToken();
        //             }
        //         })
        // },
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