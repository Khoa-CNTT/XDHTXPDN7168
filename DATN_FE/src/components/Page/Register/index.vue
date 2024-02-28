<template>
  <!-- Signup Section Begin -->
  <section
    class="signup spad"
    style="
      background-image: url('https://wallpapers.com/images/hd/4098x2304-anime-universe-image-anime-characters-hd-wallpaper-and-background-6q0wwu9gf52hvl9h.jpg');
    "
  >
    <div
      class="container"
      style="
        background-color: rgba(10, 9, 9, 0.7);
        padding: 50px;
        margin-bottom: 100px;
      "
    >
      <div class="row">
        <div class="col-lg-6">
          <div class="login__form">
            <div class="row">
                            <div class="col-5">
                               <h3>Đăng Ký</h3>
                            </div>
                            <div class="col-7">
                                <router-link to="login" >
                                    <a > <h3 style="color: #17a2b8" ><i class="fa-solid fa-caret-left"></i>Đăng Nhập </h3></a>
                                     
                                </router-link>
                            </div>
                        </div>
            <div>
              <div class="input__item">
                <input v-model="dang_ky.email" type="text" placeholder="Nhập địa chỉ Email" /><span
                  class="icon_mail"
                ></span>
              </div>
              <div class="input__item">
                <input v-model="dang_ky.ho_va_ten" type="text" placeholder="Tên của bạn" /><span
                  class="icon_profile"
                ></span>
              </div>
              <div class="input__item">
                <input v-model="dang_ky.password" type="password" placeholder="Mật khấu" /><span
                  class="icon_lock"
                ></span>
              </div>
              <div class="input__item">
                <input type="date" v-model="dang_ky.ngay_sinh" class="form-control"  placeholder="Mật khấu"  /><span
                  class="icon_menu-circle_alt2"
                ></span>
              </div>
              <!-- <div>
                <input
                  class="form-control form-control-sm"
                  type="file"
                  style="width: 369px" @change="handleFileUpload"
                /><span class="icon_lock"></span>
              </div> -->
              <button @click="dangKy()" style="width: 100%;" class="site-btn mt-3">Đăng Ký</button>
              
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="login__social__links">
            <h3 class="text-center">OR</h3>
            <ul style="margin-top: 40px">
              <li>
                <a href="#" class="facebook"
                  ><i class="fa fa-facebook"></i> Sign in With Facebook</a
                >
              </li>
              <li>
                <a href="#" class="google"
                  ><i class="fa fa-google"></i> Sign in With Google</a
                >
              </li>
              <li>
                <a href="#" class="twitter"
                  ><i class="fa fa-twitter"></i> Sign in With Twitter</a
                >
              </li>
            </ul>
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
      dang_ky: {is_done : 0, hinh_anh : 'https://cdn-icons-png.flaticon.com/512/666/666201.png',},
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
                .then((res) =>  {
                    if(res.data.status == true) {
                        toaster.success( res.data.message);
                        // this.$router.push('/login');
                    } else {
                        toaster.error( res.data.message);
                    }
                });
        },
    dangKy() {
      baseRequest
        .post("khach-hang/register",this.dang_ky)
        .then((res) => {
          this.kichHoatTK();
          this.dang_ky = {};
          this.$router.push('/login');
        })
        .catch((res) => {
                    var errors  = Object.values(res.response.data.errors);
                    errors.forEach(function(v,k){
                            toaster.error(v[0]);
                    });
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
                    if (res.status === 200) {
                        this.is_login = true;
                        this.list_token = res.data.list;
                        this.$router.push('/');
                    }

                })
                .catch(() => {
                    this.is_login = false;
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
<style></style>
