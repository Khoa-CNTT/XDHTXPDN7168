<template>
    <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-2">
        <div class="col mx-auto">
            <div class="my-4 text-center">
                <img src="../../assets/assets_rocker/images/logo-img.png" width="180" alt="" />
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="border p-4 rounded">
                        <div class="text-center">
                            <h3 class="">Đăng Ký</h3>
                            <p>Bạn đã có tài khoản? 
                                <router-link to="login">
                                    <a href="admin/login">Đăng Nhập</a>
                                </router-link>
                            </p>
                        </div>
                        
                        
                        <div class="form-body">
                            <form class="row g-3">
                                <div class="col-12">
                                    <label for="inputFirstName" class="form-label">Họ Và Tên</label>
                                    <input type="text" v-model="dang_ky.ho_va_ten" class="form-control" id="inputFirstName" placeholder="Họ Và Tên">
                                </div>
                                
                                <div class="col-12">
                                    <label for="inputEmailAddress" class="form-label">Email</label>
                                    <input type="email" v-model="dang_ky.email" class="form-control" id="inputEmailAddress"
                                        placeholder="example@user.com">
                                </div>
                                <div class="col-12">
                                    <label for="inputChoosePassword" class="form-label">Mật Khẩu</label>
                                    <input type="password" v-model="dang_ky.password" class="form-control" id=""
                                        placeholder="Password">
                                </div>
                                <div class="col-12">
                                    <label for="mb-2 mt-1" class="form-label mb-1 mt-1">
                                        Ảnh Đại Diện
                                        </label>
                                    <input type="file" @change="handleFileChange" class="form-control" />
                                </div>
                                
                                <div class="col-12">
                                    <div class="d-grid">
                                        <button type="button" @:click="dangKy()" class="btn btn-primary"><i class='bx bx-user'></i> Đăng Ký</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import axios from 'axios';
import { createToaster } from "@meforma/vue-toaster";
const toaster = createToaster({ position: "top-right" });
export default {
    data(){
        return{
            dang_ky: {},
        }
    },
    methods: {
        dangKy() {
            axios
                .post('http://127.0.0.1:8000/api/register', this.dang_ky)
                .then((res) => {
                    toaster.success(res.data.message);
                    this.dang_ky = {};
                    // this.$route.push('/login');
                });
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
            toaster.success('Thêm ảnh thành công!');
            // Thực hiện các hành động khác với base64Data ở đây
          } catch (error) {
            console.error('Error converting image to base64:', error);
            toaster.error('Thêm không ảnh thành công!');

          }
        }
      },
    },
}
</script>
<style></style>