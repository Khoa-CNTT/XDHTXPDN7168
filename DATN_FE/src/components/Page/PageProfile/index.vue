<template>
    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option" style="background-color: #0b0c2a">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <router-link to="/"><i class="fa fa-home"></i> Home</router-link>
                        <router-link to="/profile"> Profile</router-link>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <section class="product-page spad" style="background-color: #0b0c2a; padding-bottom: 400px">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body" style="background-color: #0b0c2adb">
                            <div class="d-flex flex-column align-items-center text-white text-center">
                                <a type="button" onclick="document.getElementById('fileInput').click();">
                                    <img v-if="is_avt"
                                        src="https://static.vecteezy.com/system/resources/previews/009/292/244/original/default-avatar-icon-of-social-media-user-vector.jpg"
                                        alt="Admin" class="rounded-circle p-1 bg-primary custom-button" width="110" />
                                    <img v-else v-bind:src="hinh_anh_user" alt=""
                                        class="rounded-circle p-1 bg-primary custom-button" width="110" height="110" />
                                </a>
                                <div class="mt-3">
                                    <h4>{{ ho_ten_user }}</h4>
                                    <p class="text-secondary mb-1">Thành viên của WAnime</p>

                                    <input id="fileInput" type="file" @change="handleFile($event, true)"
                                        class="form-control-sm" style="display: none;" />
                                </div>
                            </div>
                            <hr class="my-1" />
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body text-white" style="background-color: #0b0c2adb">
                            <div class="trending__product" style="margin-bottom: 0px">
                                <div class="row">
                                    <div class="col-lg-8 col-md-8 col-sm-8">
                                        <div class="section-title">
                                            <h4>CẬP NHẬT TÀI KHOẢN</h4>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                        <div class="section-title"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3 mt-1">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Họ Và Tên</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input v-model="obj_update_tt.ho_va_ten" type="text" disabled
                                        class="form-control" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Email</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input v-model="obj_update_tt.email" type="text" disabled class="form-control" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Số điện thoại</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input v-model="obj_update_tt.so_dien_thoai" type="text" disabled
                                        class="form-control" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3"></div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="button" class="btn btn-danger px-4 me-5" data-bs-toggle="modal"
                                        data-bs-target="#thayDoiThongTin" value="Sửa Thông Tin" />
                                    <input data-bs-toggle="modal" data-bs-target="#doiMatKhau" type="button"
                                        class="btn btn-danger px-4 me-5 " value="Đổi Mật Khẩu" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="thayDoiThongTin" data-bs-keyboard="false" tabindex="-1"
                    aria-labelledby="DthayDoiThongTinLabel" aria-hidden="true">
                    <div class="modal-dialog ">
                        <div style="background-color: rgba(35, 33, 33, 0.9)" class="modal-content">
                            <div class="modal-body">
                                <div class="product__sidebar__comment">
                                    <div class="section-title" style="color: aliceblue;">
                                        <h4> Sửa Thông Tin</h4>
                                    </div>
                                    <div class="row mb-3 mt-1">
                                        <div class="col-sm-3 ">
                                            <h6 class="mb-0 text-white mt-2">Họ Và Tên</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input v-model="obj_update_tt.ho_va_ten" type="text" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="row mb-3 mt-1">
                                        <div class="col-sm-3 ">
                                            <h6 class="mb-0 text-white mt-2">Số điện thoại</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input v-model="obj_update_tt.so_dien_thoai" type="text"
                                                class="form-control" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-3"></div>
                                        <div class="col-sm-9 text-secondary">
                                            <input @click="DoiThongTin()" type="button" data-bs-dismiss="modal"
                                                class="btn btn-danger px-4 me-5" value="Lưu Thông Tin" />
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Đóng</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                <button type="button" class="btn btn-primary">Lưu</button>
                            </div> -->
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="doiMatKhau" data-bs-keyboard="false" tabindex="-1"
                    aria-labelledby="doiMatKhau" aria-hidden="true">
                    <div class="modal-dialog ">
                        <div style="background-color: rgba(35, 33, 33, 0.9)" class="modal-content">
                            <div class="modal-body">
                                <div class="product__sidebar__comment">
                                    <div class="section-title" style="color: aliceblue;">
                                        <h4> Đổi mật khẩu</h4>
                                    </div>
                                    <div class="row mb-3 ">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0 text-white mt-2">Mật khẩu cũ</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input v-model="obj_doi_pass.old_pass" type="password"
                                                class="form-control" />
                                        </div>
                                    </div>
                                    <div class="row mb-3 ">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0 text-white mt-2">Mật khẩu mới</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input v-model="obj_doi_pass.new_pass" type="password"
                                                class="form-control" />
                                        </div>
                                    </div>
                                    <div class="row mb-3 ">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0 text-white mt-2">Nhập mật khẩu mới</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input v-model="obj_doi_pass.re_new_pass" type="password"
                                                class="form-control" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-3"></div>
                                        <div class="col-sm-9 text-secondary">
                                            <input @click="DoiPass()" type="button" data-bs-dismiss="modal"
                                                class="btn btn-danger px-4 me-5" value="Đổi mật khẩu" />
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Đóng</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                <button type="button" class="btn btn-primary">Lưu</button>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
<script>
import axios from "axios";
import baseRequest from "../../../core/baseRequestUser";
import { createToaster } from "@meforma/vue-toaster";
const toaster = createToaster({
    position: "top-right",
});

export default {
    data() {
        return {
            is_avt: true,
            obj_doi_pass: {},
            obj_update_tt: {},
            obj_avt: {},
            ho_ten_user: localStorage.getItem("ho_ten_user"),
            hinh_anh_user: '',
            id_user: localStorage.getItem("id_user"),
        };
    },
    mounted() {
        this.laydataAdmin();
        this.$store.dispatch('showLoader');
        // console.log(this.id_user);
    },
    methods: {
        laydataAdmin() {
            axios
                .get("http://127.0.0.1:8000/api/khach-hang/lay-du-lieu-profile", {
                    params: {
                        id_khach_hang: this.id_user,
                    },
                    headers: {
                        Authorization: "Bearer " + localStorage.getItem("token_user"),
                    },
                })
                .then((res) => {
                    // console.log(res.data);
                    //  this.hinh_anh_user = localStorage.getItem("hinh_anh_user"),
                    this.obj_doi_pass = res.data.obj_user;
                    this.obj_update_tt = res.data.obj_user;
                    if (this.obj_doi_pass.avatar == '') {
                        this.is_avt = true;
                    }
                    else {
                        this.is_avt = false;
                        this.hinh_anh_user = this.obj_doi_pass.avatar
                    }
                    this.$store.dispatch('hideLoader'); // Ẩn loader nếu có lỗi
                }).catch(() => {
                    this.$store.dispatch('hideLoader'); // Ẩn loader nếu có lỗi
                });
        },
        DoiPass() {
            baseRequest
                .put("khach-hang/doi-mat-khau", this.obj_doi_pass)
                .then((res) => {
                    // console.log(res.data);
                    if (res.data.status == true) {
                        toaster.success(res.data.message);
                        this.laydataAdmin();
                    } else {
                        toaster.error(res.data.message);
                    }
                })
                .catch((res) => {
                    var errors = Object.values(res.response.data.errors);
                    toaster.error(errors[0]);
                });
        },
        DoiThongTin() {
            baseRequest
                .put("khach-hang/doi-thong-tin", this.obj_update_tt)
                .then((res) => {
                    if (res.data.status == true) {
                        toaster.success(res.data.message);
                        this.ho_ten_user = res.data.ho_ten_user;
                        localStorage.setItem("ho_ten_user", res.data.ho_ten_user);
                        this.laydataAdmin();
                    } else {
                        toaster.error(res.data.message);
                    }
                })
                .catch((res) => {
                    var errors = Object.values(res.response.data.errors);
                    toaster.error(errors[0]);
                });
        },
        handleFile(e, isCreate) {
            let files = e.target.files || e.dataTransfer.files;
            this.file = files;
            if (!files.length) return;
            // File type validation
            const validImageTypes = ['image/gif', 'image/jpeg', 'image/png', 'image/webp'];
            if (!validImageTypes.includes(files[0].type)) {
                alert('Vui lòng chọn đúng file hình ảnh');
                return;
            }
            else {
                this.createImage(files[0], isCreate);
            }
        },
        createImage(file, isCreate) {
            let reader = new FileReader();
            let vm = this;
            reader.onload = (e) => {
                // vm.banner = e.target.result;
                if (isCreate == true) {
                    vm.obj_avt.hinh_anh = file;
                } else {
                    vm.obj_update_bai_viet.hinh_anh = file;
                }
            };
            reader.readAsDataURL(file);

            setTimeout(() => {
                this.themAvatar();
            }, 500);
        },
        themAvatar() {
            const formData = new FormData();
            for (let key in this.obj_avt) {
                formData.append(key, this.obj_avt[key]);
            }
            baseRequest
                .post(
                    "khach-hang/doi-avatar",
                    formData
                )
                .then((res) => {
                    if (res.data.status == true) {
                        toaster.success(res.data.message);
                        // this.obj_avt = {};
                        // this.is_create = 0;
                        // this.laydataAdmin();
                        window.location.reload();
                    } else {
                        toaster.error(res.data.message);
                    }
                });
        },
    },
};
</script>

<style>
.custom-button {
    transition: opacity 0.3s ease;
}

.custom-button:hover {
    opacity: 0.7;
}
</style>
