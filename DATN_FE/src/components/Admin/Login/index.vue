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
                    <div class="border p-4 rounded shadow-sm">
                        <div class="text-center">
                            <h3 class="mb-3">ĐĂNG NHẬP ADMIN</h3>
                            <!-- <p>Bạn đã có tài khoản? -->
                            <!-- <router-link to="register">

                                    <a href="admin/registerl">Đăng ký?</a>
                                </router-link> -->
                            <!-- </p> -->
                        </div>

                        <div class="form-body">
                            <form class="row g-3 needs-validation">
                                <div class="col-12">
                                    <label class="form-label">Địa Chỉ Email</label>
                                    <input type="text" v-model="dang_nhap.email" placeholder="Nhập Email" :class="[
                                        'form-control',
                                        check_validate ? 'is-invalid' : '',
                                    ]" />
                                    <div class="invalid-feedback">{{ errors.email }}</div>
                                </div>
                                <div class="col-12">
                                    <label  class="form-label">Mật Khẩu</label>
                                    <input v-on:keyup.enter="dangNhap()" type="password" v-model="dang_nhap.password"
                                        class="form-control" placeholder="Nhập Mật Khẩu" />
                                </div>
                                <div class="col-12 mt-4">
                                    <div class="d-grid">
                                        <button type="button" @:click="dangNhap()" class="btn btn-primary">
                                            <i class="bx bxs-lock-open"></i>Đăng Nhập
                                        </button>
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
import axios from "axios";
import { createToaster } from "@meforma/vue-toaster";
import functionBasic from "../../../core/functionBasic";
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
            check_validate: false,
            errors: {},
        };
    },
    mounted() {
        // this.is_login = false;
        this.checkToken();
    },
    methods: {
        dangNhap() {
            axios
                .post("https://wopai-be.dzfullstack.edu.vn/api/login", this.dang_nhap)
                .then((res) => {
                    if (res.data.status == true) {
                        toaster.success(res.data.message);
                        var arr = res.data.token.split("|");
                        localStorage.setItem("token", arr[1]);
                        localStorage.setItem("avt_admin", res.data.avt_admin);
                        localStorage.setItem("name_admin", res.data.name_admin);
                        localStorage.setItem("ten_chuc_vu", res.data.chuc_vu);
                        // console.log(arr[1]);
                        this.checkToken();
                    } else {
                        toaster.error(res.data.message);
                    }
                })
                .catch((res) => {
                    this.check_validate = true;
                    this.errors = res.response.data.errors;
                    // errors.forEach(function(v,k){
                    //         toaster.error(v[0]);
                    // });
                });
        },
        checkToken() {
            axios
                .post(
                    "https://wopai-be.dzfullstack.edu.vn/api/check",
                    {},
                    {
                        headers: {
                            Authorization: "Bearer " + localStorage.getItem("token"),
                        },
                    }
                )
                .then((res) => {
                    if (res.status === 200) {
                        this.is_login = true;
                        this.$router.push("/admin");
                    }
                })
                .catch(() => {
                    this.is_login = false;
                });
        },
        removeToken() {
            axios
                .delete(
                    "https://wopai-be.dzfullstack.edu.vn/api/thong-tin-xoa/" + this.remove_token.id
                )
                .then((res) => {
                    if (res.data.status == true) {
                        toaster.success(res.data.message);
                        (this.list_token = []), this.checkToken();
                    }
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
                    console.log("Base64 Data:", base64Data);
                    this.dang_ky.hinh_anh = base64Data;
                    // Thực hiện các hành động khác với base64Data ở đây
                } catch (error) {
                    console.error("Error converting image to base64:", error);
                }
            }
        },
    },
};
</script>
<style></style>
