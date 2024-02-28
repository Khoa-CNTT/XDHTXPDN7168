<template>
    <!-- <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    ĐĂNG KÝ
                </div>
                <div class="card-body">
                    <label class="mb-2 mt-1 "><b>Họ Và Tên</b></label>
                    <input v-model="dang_ky.ho_va_ten" type="text" class="form-control">
                    <label class="mb-2 mt-1"><b>Email</b></label>
                    <input v-model="dang_ky.email" type="email" class="form-control">
                    <label class="mb-2  mt-1"><b>Mật Khẩu</b></label>
                    <input v-model="dang_ky.password" type="text" class="form-control">
                    <label for="mb-2 mt-1" class="form-label mb-1 mt-1">
                        <b>Ảnh Đại Diện</b>
                    </label>
                    <input type="file" @change="handleFileChange" class="form-control" />
                </div>
                <div class="card-footer text-end">
                    <button v-on:click="dangKy()" class="btn btn-primary">Đăng Ký</button>
                </div>
            </div>
        </div>
        <div class="col-lg-4" v-if="is_login == false">
            <div class="card">
                <div class="card-header">
                    ĐĂNG NHẬP
                </div>
                <div class="card-body">
                    <label class="mb-2">Email</label>
                    <input v-model="dang_nhap.email" type="email" class="form-control">
                    <label class="mb-2">Mật Khẩu</label>
                    <input v-model="dang_nhap.password" type="text" class="form-control">
                </div>
                <div class="card-footer text-end">
                    <button v-on:click="dangNhap()" class="btn btn-danger">Đăng Nhập</button>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    CHECK TOKEN
                </div>
                <div class="card-body">
                    <label class="mb-2">Token</label>
                    <input v-model="check_token.token" type="text" class="form-control">
                </div>
                <div class="card-footer text-end">
                    <button v-on:click="checkToken()" class="btn btn-warning">Check Login</button>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    DANH SÁCH ABC
                </div>
                <div class="card-body">
                    <div class="table-responsive">

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">Id</th>
                                    <th class="text-center">Device</th>
                                    <th class="text-center">Browser</th>
                                    <th class="text-center">Ip</th>
                                    <th class="text-center">Os</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(v, k) in list_token">
                                    <th class="text-center align-middle">{{ v.id }}</th>
                                    <td class="align-middle">{{ v.device }}</td>
                                    <td class="align-middle">{{ v.trinh_duyet }}</td>
                                    <td class="align-middle">{{ v.ip }}</td>
                                    <td class="align-middle">{{ v.os }}</td>
                                    <td class="text-center align-middle">
                                        <button class="btn btn-danger" @:click="remove_token = v" data-bs-toggle="modal"
                                            data-bs-target="#xoaModal">Remove</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal fade" id="xoaModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Xóa Token</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div
                                        class="alert alert-warning border-0 bg-warning alert-dismissible fade show py-2">
                                        <div class="d-flex align-items-center">
                                            <div class="font-35 text-dark"><i class="bx bx-info-circle"></i>
                                            </div>
                                            <div class="ms-3">
                                                <h6 class="mb-0 text-dark">Warning</h6>
                                                <div class="text-dark">
                                                    <p>Bạn có muốn xóa token <b></b>
                                                        này không?
                                                    </p>
                                                    <p>
                                                        <b>Lưu ý:</b> Điều này không thể hoàn tác!
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Thoát</button>
                                    <button type="button" class="btn btn-danger" v-on:click="removeToken()"
                                        data-bs-dismiss="modal">Xóa</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
        <div class="col mx-auto">
            <div class="mb-4 text-center">
                <!-- <img src="../../assets/assets_rocker/images/logo-img.png" width="180" alt="" /> -->
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="border p-4 rounded">
                        <div class="text-center">
                            <h3 class="mb-3">Đăng Nhập</h3>
                            <!-- <p>Bạn đã có tài khoản? -->
                                <!-- <router-link to="register">

                                    <a href="admin/registerl">Đăng ký?</a>
                                </router-link> -->
                            <!-- </p> -->
                        </div>
                       
                        <div class="form-body">
                            <form class="row g-3">
                                <div class="col-12">
                                    <label for="inputEmailAddress" class="form-label">Địa Chỉ Email</label>
                                    <input type="email" v-model="dang_nhap.email" class="form-control"
                                        id="inputEmailAddress" placeholder="Nhập Email">
                                </div>
                                <div class="col-12">
                                    <label for="inputChoosePassword" class="form-label">Mật Khẩu</label>
                                    <input type="password" v-model="dang_nhap.password" class="form-control"
                                        id="inputEmailAddress" placeholder="Nhập Mật Khẩu">
                                </div>
                                <div class="col-md-6 text-end">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
                                        <label class="form-check-label" for="flexSwitchCheckChecked">Nhớ Mật Khẩu</label>
                                    </div>
                                </div>
                                <div class="col-md-6 text-end">
                                    <router-link to="">
                                        <a href="authentication-forgot-password.html">Forgot
                                            Password ?
                                        </a>
                                    </router-link>
                                </div>
                                <div class="col-12">
                                    <div class="d-grid">
                                        <button type="button" @:click="dangNhap()" class="btn btn-primary"><i class="bx bxs-lock-open"></i>Đăng Nhập</button>
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
                .post('http://127.0.0.1:8000/api/register', this.dang_ky)
                .then((res) => {
                    toaster.success(res.data.message);
                });
        },
        dangNhap() {
            axios
                .post('http://127.0.0.1:8000/api/login', this.dang_nhap)
                .then((res) => {
                    if (res.data.status == true) {
                        toaster.success(res.data.message);
                        var arr = res.data.token.split("|");
                        localStorage.setItem('token', arr[1]);
                        console.log(arr[1]);
                        this.checkToken();
                    } else {
                        toaster.error(res.data.message);
                    }
                });
        },
        checkToken() {
            axios
                .post('http://127.0.0.1:8000/api/check', {}, {
                    headers: {
                        Authorization: 'Bearer ' + localStorage.getItem('token')
                    }
                })
                .then((res) => {
                    console.log(res.data);
                    localStorage.setItem('ho_ten', res.data.ho_ten);
                    localStorage.setItem('id_admin', res.data.id_admin);
                    localStorage.setItem('hinh_anh', res.data.hinh_anh);
                    if (res.status === 200) {
                        this.is_login = true;
                        this.list_token = res.data.list;
                        this.$router.push('/admin/anime');
                    }

                })
                .catch(() => {
                    this.is_login = false;
                });
        },
        removeToken() {
            axios
                .delete('http://127.0.0.1:8000/api/thong-tin-xoa/'+ this.remove_token.id)
                .then((res) => {
                    if (res.data.status == true) {
                        toaster.success(res.data.message);
                        this.list_token = [],
                            this.checkToken();
                    }
                })
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