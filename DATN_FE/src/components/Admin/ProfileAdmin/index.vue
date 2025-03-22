<template>
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center text-white text-center">
                            <a type="button" onclick="document.getElementById('fileInput').click();">
                                <img v-if="obj_admin.hinh_anh" v-bind:src="obj_admin.hinh_anh" alt=""
                                    class="rounded-circle p-1 bg-primary custom-button" width="110" height="110" />
                                <img v-else
                                    src="https://static.vecteezy.com/system/resources/previews/009/292/244/original/default-avatar-icon-of-social-media-user-vector.jpg"
                                    alt="Admin" class="rounded-circle p-1 bg-primary custom-button" width="110" />
                            </a>
                            <div class="mt-3">
                                <h4>{{ obj_admin.ho_va_ten }}</h4>
                                <p class="text-secondary mb-1">{{ obj_admin.ten_chuc_vu }}</p>

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
                    <div class="card-body text-white">
                        <div class="trending__product" style="margin-bottom: 0px">
                            <div class="row">
                                <div class="col-lg-8 col-md-8 col-sm-8">
                                    <div class="section-title">
                                        <h4>THÔNG TIN TÀI KHOẢN</h4>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    <div class="section-title"></div>
                                </div>
                            </div>
                        </div>
                        <hr />
                        <div class="row mb-3 mt-1">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Họ Và Tên</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <input v-model="obj_admin.ho_va_ten" type="text" disabled class="form-control" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Email</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <input v-model="obj_admin.email" type="text" disabled class="form-control" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Số điện thoại</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <input v-model="obj_admin.so_dien_thoai" type="text" disabled class="form-control" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-9 text-secondary">
                                <input @click="Object.assign(obj_update_tt, obj_admin)" type="button"
                                    class="btn btn-primary px-4 me-5" data-bs-toggle="modal"
                                    data-bs-target="#thayDoiThongTin" value="Cập Nhập Thông Tin" />
                                <input data-bs-toggle="modal" data-bs-target="#doiMatKhau" type="button"
                                    class="btn btn-primary px-4 me-5 " value="Đổi Mật Khẩu" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="thayDoiThongTin" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="DthayDoiThongTinLabel" aria-hidden="true">
                <div class="modal-dialog ">

                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title fs-5">CẬP NHẬP THÔNG TIN
                            </h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="product__sidebar__comment">
                                <div class="row mb-3 mt-1">
                                    <div class="col-sm-3 ">
                                        <h6 class="mb-0  mt-2">Họ Và Tên</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input v-model="obj_update_tt.ho_va_ten" type="text" class="form-control" />
                                    </div>
                                </div>
                                <div class="row mb-3 mt-1">
                                    <div class="col-sm-3 ">
                                        <h6 class="mb-0  mt-2">Email</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input disabled v-model="obj_update_tt.email" type="text"
                                            class="form-control" />
                                    </div>
                                </div>
                                <div class="row mb-3 mt-1">
                                    <div class="col-sm-3 ">
                                        <h6 class="mb-0  mt-2">Số điện thoại</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input v-model="obj_update_tt.so_dien_thoai" type="text" class="form-control" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-9 text-secondary">
                                        <input @click="DoiThongTin()" type="button" data-bs-dismiss="modal"
                                            class="btn btn-primary px-4 me-5" value="Lưu Thông Tin" />
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
            <div class="modal fade" id="doiMatKhau" data-bs-keyboard="false" tabindex="-1" aria-labelledby="doiMatKhau"
                aria-hidden="true">
                <div class="modal-dialog ">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title fs-5">ĐỔI MẬT KHẨU
                            </h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="product__sidebar__comment">
                                <div class="row mb-3 ">
                                    <div class="col-sm-4">
                                        <h6 class="mb-0 text-nowrap mt-2">Mật khẩu cũ</h6>
                                    </div>
                                    <div class="col-sm-8 text-secondary">
                                        <input v-model="obj_doi_pass.old_pass" type="password" class="form-control" />
                                    </div>
                                </div>
                                <div class="row mb-3 ">
                                    <div class="col-sm-4">
                                        <h6 class="mb-0 text-nowrap mt-2">Mật khẩu mới</h6>
                                    </div>
                                    <div class="col-sm-8 text-secondary">
                                        <input v-model="obj_doi_pass.new_pass" type="password" class="form-control" />
                                    </div>
                                </div>
                                <div class="row mb-3 ">
                                    <div class="col-sm-4">
                                        <h6 class="mb-0 text-nowrap mt-2">Nhập mật khẩu mới</h6>
                                    </div>
                                    <div class="col-sm-8 text-secondary">
                                        <input v-model="obj_doi_pass.re_new_pass" type="password"
                                            class="form-control" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4"></div>
                                    <div class="col-sm-8 text-secondary">
                                        <input @click="DoiPass()" type="button" data-bs-dismiss="modal"
                                            class="btn btn-primary px-4 me-5" value="Đổi mật khẩu" />
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
</template>
<script>
import axios from "axios";
import baseRequest from "../../../core/baseRequest";
import { createToaster } from "@meforma/vue-toaster";
const toaster = createToaster({
    position: "top-right",
});

export default {
    data() {
        return {
            is_avt: true,
            obj_doi_pass: {},
            obj_avt: {},
            obj_update_tt: {},
            obj_admin: {},
            // name_admin: localStorage.getItem("name_admin"),
            avt_admin: localStorage.getItem("avt_admin"),
            // id_user: localStorage.getItem("id_user"),
            // ten_chuc_vu: localStorage.getItem("ten_chuc_vu"),
        };
    },
    mounted() {
        this.laydataAdmin();
        // console.log(this.id_user);
    },
    methods: {
        laydataAdmin() {
            baseRequest
                .get("admin/admin/lay-du-lieu-profile")
                .then((res) => {
                    this.obj_doi_pass = res.data.obj_admin;
                    this.obj_admin = res.data.obj_admin;
                    this.$store.dispatch('updateAvatar', avatarUrl);
                    localStorage.setItem('avt_admin', obj_admin.hinh_anh);
                    localStorage.setItem('name_admin', obj_admin.ho_va_ten);
                });
        },
        DoiPass() {
            baseRequest
                .put("admin/admin/doi-mat-khau-profile", this.obj_doi_pass)
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
                .put("admin/admin/doi-thong-tin", this.obj_update_tt)
                .then((res) => {
                    if (res.data.status == true) {
                        toaster.success(res.data.message);
                        localStorage.removeItem('name_admin');
                        localStorage.setItem('name_admin', res.data.name_admin);
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
                    "admin/admin/doi-avatar",
                    formData
                )
                .then((res) => {
                    if (res.data.status == true) {
                        toaster.success(res.data.message);
                        this.obj_avt = {};
                        localStorage.removeItem('avt_admin');
                        localStorage.setItem('avt_admin', res.data.avatar);
                        this.$store.dispatch('updateAvatar', res.data.avatar);
                        this.laydataAdmin();
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
