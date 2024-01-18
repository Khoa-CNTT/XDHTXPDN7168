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
            <h3>Đăng Ký</h3>
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
                <input v-model="dang_ky.password" type="text" placeholder="Mật khấu" /><span
                  class="icon_lock"
                ></span>
              </div>
              <div>
                <input
                  class="form-control form-control-sm"
                  type="file"
                  style="width: 369px" @change="handleFileUpload"
                /><!-- <span class="icon_lock"></span> -->
              </div>
              <button @click="dangKy()" class="site-btn">Đăng Ký</button>
              <router-link to="/login"
                ><a href="#" class="forget_pass">Đăng Nhập?</a></router-link
              >
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
    dangKy() {
      axios
        .post(
          "http://127.0.0.1:8000/api/khach-hang/register",
          this.dang_ky
        )
        .then((res) => {
          toaster.success("Thông báo<br>" + res.data.message);
          this.dang_ky = {};
          this.$router.push('/login');
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
      handleFileUpload(event) {
            const file = event.target.files[0];
            const cloudName = 'dltbjoii4';
            const uploadPreset = 'yvvll2k0';

            const formData = new FormData();
            formData.append('file', file);
            formData.append('upload_preset', uploadPreset);

            fetch(`https://api.cloudinary.com/v1_1/${cloudName}/image/upload`, {
              method: 'POST',
              body: formData,
            })
            .then((response) => response.json())
            .then((data) => {
              // Set the imageUrl to the URL of the uploaded image.
              this.imageUrl = data.secure_url;
              // console.log(this.imageUrl);
              this.dang_ky.hinh_anh = data.secure_url;
            })
            .catch((error) => {
              console.error('Error uploading image:', error);
            });
        },   
        
      },
    };
</script>
<style></style>
