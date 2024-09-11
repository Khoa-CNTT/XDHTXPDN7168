<template>
    <div class="row mb-3">
        <div class="col-12 text-end">
            <button class="btn btn-outline-primary px-5 radius-30" data-bs-toggle="modal"
                data-bs-target="#themMoiModal">
                <b>Thêm Mới</b>
            </button>
        </div>
    </div>
    <div class="modal fade" id="themMoiModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Thêm Mới Tài Khoan Admin</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="row">
                            <div class="col-12">
                                <label class="form-label">Họ Và Tên</label>
                                <input type="text" v-model="obj_add_admin.ho_va_ten" class="form-control"
                                    placeholder="Họ Và Tên">
                            </div>
                            <div class="col-12">
                                <label class="form-label">Số điện thoại</label>
                                <input type="text" v-model="obj_add_admin.so_dien_thoai" class="form-control"
                                    placeholder="Nhập số điện thoại">
                            </div>

                            <div class="col-12">
                                <label class="form-label">Email</label>
                                <input type="email" v-model="obj_add_admin.email" class="form-control"
                                    placeholder="example@user.com">
                            </div>
                            <div class="col-12">
                                <label for="inputChoosePassword" class="form-label">Chức Vụ</label>
                                <select v-model="obj_add_admin.id_chuc_vu" name="" id="" class="form-control">
                                    <template v-for="(v, k) in list_chuc_vu" :key="k">
                                        <option v-bind:value="v.id">{{ v.ten_chuc_vu }}</option>
                                    </template>
                                </select>
                            </div>
                            <div class="col-12">
                                <label for="mb-2 mt-1" class="form-label mb-1 mt-1">
                                    Ảnh Đại Diện
                                </label>
                                <input type="file" @change="handleFile($event, true)" class="form-control" />
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Thoát</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal"
                        v-on:click="taoDataAdmin()">Thêm
                        Mới</button>
                </div>
            </div>
        </div>
    </div>
    <div class="row">

        <div class="col-12">
            <div class="card border-5 border-primary border-top">
                <div class="card-header">
                    <b>DANH SÁCH TÀI KHOẢN ADMIN</b>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered  ">
                            <thead>
                                <tr>
                                    <th colspan="100%">
                                        <div class="input-group mb-3">
                                            <input v-on:keyup.enter="searchAdmin(1)" v-model="key_tim.key" type="text"
                                                class="form-control" placeholder="Nhập thông tin cần tìm">
                                            <button class="btn btn-primary" v-on:click="searchAdmin(1)">
                                                <i class="fa-solid fa-magnifying-glass"></i>
                                            </button>
                                        </div>
                                    </th>
                                </tr>
                                <tr class="text-center">
                                    <th>#</th>
                                    <th class="text-center align-middle text-nowrap">Họ Và Tên</th>
                                    <th class="text-center align-middle text-nowrap">Email</th>
                                    <th class="text-center align-middle text-nowrap">Số điện thoại</th>
                                    <th class="text-center align-middle text-nowrap">Chức Vụ</th>
                                    <th class="text-center align-middle text-nowrap">Ảnh Đại Diện</th>
                                    <th class="text-center align-middle text-nowrap">Tình trạng</th>
                                    <th class="text-center align-middle text-nowrap">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(v, k) in list_admin" class="text-center" :key="k">
                                    <td class="text-center align-middle text-nowrap">{{ k + 1 }}</td>
                                    <td class=" align-middle text-nowrap">{{ v.ho_va_ten }}</td>
                                    <td class=" align-middle text-nowrap">{{ v.email }}</td>
                                    <td class=" align-middle text-nowrap">{{ v.so_dien_thoai }}</td>
                                    <td class=" align-middle text-nowrap">{{ v.ten_chuc_vu }}</td>
                                    <td style="text-align: center; vertical-align: middle;">
                                        <img v-bind:src="v.hinh_anh" class="product-img-2 "
                                            style="display: inline-block;" alt="no-image">
                                    </td>
                                    <td class="text-center align-middle text-nowrap text-center">
                                        <button @click="doiTrangThai(v)" v-if="v.tinh_trang == 1"
                                            class="badge rounded-pill text-success bg-light-success p-2 text-uppercase px-3"
                                            style="border: none;">
                                            Hoạt Động
                                        </button>
                                        <button @click="doiTrangThai(v)" v-if="v.tinh_trang == 0"
                                            class="badge rounded-pill text-warning bg-light-success p-2 text-uppercase px-3"
                                            style="border: none;">
                                            Chặn
                                        </button>
                                    </td>
                                    <td class="text-center align-middle text-nowrap">
                                        <i @click="Object.assign(obj_update_admin, v)" type="button"
                                            data-bs-toggle="modal" data-bs-target="#Chinhsua"
                                            class="fa-solid fa-pen-to-square fa-2x text-warning me-2"></i>

                                        <i @click="Object.assign(obj_delete_admin, v)" data-bs-target="#Xoa"
                                            type="button" data-bs-toggle="modal"
                                            class="fa-solid fa-trash fa-2x text-danger"></i>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <nav aria-label="Table Paging" class="mb-0 text-headings">
                            <div class="card-footer text-end text-nowrap">
                                <button @click="changPage(pagination.current_page - 1)"
                                    :disabled="pagination.current_page <= 1" class="btn btn-secondary btn-sm me-2">
                                    Previous
                                </button>
                                <button class="btn btn-secondary btn-sm me-2" v-for="page in pageNumbers" :key="page"
                                    @click="page !== '...' && changPage(page)"
                                    :class="{ active: page === pagination.current_page }">
                                    {{ page }}
                                </button>
                                <button @click="changPage(pagination.current_page + 1)"
                                    :disabled="pagination.current_page >= pagination.last_page"
                                    class="btn btn-secondary btn-sm me-2">
                                    Next
                                </button>
                            </div>
                        </nav>
                    </div>

                    <!-- modal chinh sua -->
                    <div class="modal fade" id="Chinhsua" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog ">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5">Chỉnh Sữa Admin</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label">Họ Và Tên</label>
                                            <input type="text" v-model="obj_update_admin.ho_va_ten" class="form-control"
                                                placeholder="Họ Và Tên">
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">Số điện thoại</label>
                                            <input type="text" v-model="obj_update_admin.so_dien_thoai"
                                                class="form-control" placeholder="Nhập số điện thoại">
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label">Email</label>
                                            <input type="email" v-model="obj_update_admin.email" class="form-control"
                                                placeholder="example@user.com">
                                        </div>
                                        <div class="col-12">
                                            <label for="inputChoosePassword" class="form-label">Chức Vụ</label>
                                            <select v-model="obj_update_admin.id_chuc_vu" name="" id=""
                                                class="form-control">
                                                <template v-for="(v, k) in list_chuc_vu" :key="k">
                                                    <option v-bind:value="v.id">{{ v.ten_chuc_vu }}</option>
                                                </template>
                                            </select>
                                        </div>
                                        <div class="col-12">
                                            <label for="mb-2 mt-1" class="form-label mb-1 mt-1">
                                                Ảnh Đại Diện
                                            </label>
                                            <input type="file" @change="handleFile($event, false)"
                                                class="form-control" />
                                        </div>

                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Thoát</button>
                                    <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                        data-bs-target="#doiPass">Đổi mật khẩu</button>
                                    <button type="button" class="btn btn-warning" data-bs-dismiss="modal"
                                        v-on:click="updateAdmin()">Xong</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- modal doi mat khau -->
                    <div class="modal fade" id="doiPass" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog ">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5">Đổi Mật Khẩu <span class="text-danger">{{
                                    obj_update_admin.ho_va_ten }}</span></h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label">Mật khẩu</label>
                                            <input type="password" v-model="obj_doi_pass.password" class="form-control"
                                                placeholder="Nhập mật khẩu">
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">Nhập lại mật khẩu</label>
                                            <input type="password" v-model="obj_doi_pass.re_password"
                                                class="form-control" placeholder="Nhập lại mật khẩu">
                                        </div>

                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-dark" data-bs-toggle="modal"
                                        data-bs-target="#Chinhsua" @click="obj_doi_pass = {}">Thoát</button>
                                    <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                        data-bs-target="#Chinhsua" v-on:click="DoiPass()">Đổi mật khẩu</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- {{-- // modal xoa --}} -->
                    <div class="modal fade" id="Xoa" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body text-start">
                                    <div class="alert alert-danger" role="alert">
                                        Bạn có muốn xoá tài khoản <b class="text-danger">{{ obj_delete_admin.ho_va_ten
                                            }}</b>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Đóng </button>
                                    <button @click="deleteAdmin()" type="button" class="btn btn-danger"
                                        data-bs-dismiss="modal">Vẫn
                                        Xoá</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import axios from "axios";
import baseRequest from '../../../core/baseRequest';
import { createToaster } from "@meforma/vue-toaster";
import functionBasic from "../../../core/functionBasic";
import { getPageNumbers } from "../../../core/paginationUtils.js";
const toaster = createToaster({
    position: "top-right",
});
export default {
    data() {
        return {
            list_admin: [],
            list_chuc_vu: [],
            obj_add_admin: {},
            key_tim: {},
            obj_update_admin: {},
            obj_doi_pass: {},
            obj_delete_admin: {},
            pagination: {
                last_page: "",
                per_page: "",
                current_page: "",
                last_page: "",
                from: "",
                to: "",
            },
            check_page: 0,
        };
    },
    computed: {
        pageNumbers() {
            return getPageNumbers(this.pagination);
        },
    },
    mounted() {
        this.laydataAdmin(1);
    },
    methods: {
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
                    vm.obj_add_admin.hinh_anh = file;
                } else {
                    vm.obj_update_admin.hinh_anh = file;
                }
            };
            reader.readAsDataURL(file);
        },
        changPage(page) {
            if (this.check_page == 0) {
                this.laydataAdmin(page);
            } else if (this.check_page == 1) {
                this.searchAdmin(page);
            }
        },
        laydataAdmin(page) {
            baseRequest
                .get("admin/admin/lay-du-lieu?page=" + page)
                .then((res) => {
                    this.list_admin = res.data.admin.dataAdmin.data;
                    this.pagination = res.data.admin.pagination;
                    this.list_chuc_vu = res.data.chuc_vu_admin;
                });
        },
        taoDataAdmin() {
            const formData = new FormData();
            for (let key in this.obj_add_admin) {
                formData.append(key, this.obj_add_admin[key]);
            }
            baseRequest
                .post(
                    "admin/admin/thong-tin-tao", formData
                )
                .then((res) => {
                    if (res.data.status == true) {
                        toaster.success(res.data.message);
                        this.obj_add_admin = {};
                        this.laydataAdmin(1);
                    } else {
                        toaster.error(res.data.message);
                    }
                });
        },
        searchAdmin(page) {
            this.check_page == 1
            baseRequest
                .post('admin/admin/thong-tin-tim?page=' + page, this.key_tim)
                .then((res) => {
                    this.list_admin = res.data.admin.dataAdmin.data;
                    this.pagination = res.data.admin.pagination;
                    this.list_chuc_vu = res.data.chuc_vu_admin;
                });
        },
        deleteAdmin() {
            baseRequest
                .delete('admin/admin/thong-tin-xoa/' + this.obj_delete_admin.id)
                .then((res) => {
                    if (res.data.status == true) {
                        toaster.success(res.data.message);
                        this.laydataAdmin(1);
                    }
                    else {
                        toaster.error(res.data.message);
                    }
                });
        },
        updateAdmin() {
            const formData = new FormData();
            for (let key in this.obj_update_admin) {
                formData.append(key, this.obj_update_admin[key]);
            }
            baseRequest
                .post('admin/admin/thong-tin-cap-nhat', formData)
                .then((res) => {
                    if (res.data.status == true) {
                        toaster.success(res.data.message);
                        localStorage.setItem('hinh_anh', this.obj_update_admin.hinh_anh);
                        localStorage.setItem('ho_ten', this.obj_update_admin.ho_va_ten);
                        this.laydataAdmin(1);
                    } else {
                        toaster.error(res.data.message);
                    }
                });
        },

        doiTrangThai(xyz) {
            baseRequest
                .put('admin/admin/thong-tin-thay-doi-trang-thai', xyz)
                .then((res) => {
                    if (res.data.status == true) {
                        toaster.success(res.data.message);
                        this.laydataAdmin(1);
                    } else {
                        toaster.error(res.data.message);
                    }
                });
        },
        DoiPass() {
            var payload = {
                'password': this.obj_doi_pass.password,
                're_password': this.obj_doi_pass.re_password,
                'id': this.obj_update_admin.id,
            };
            baseRequest
                .put("admin/admin/doi-mat-khau", payload)
                .then((res) => {
                    if (res.data.status == true) {
                        toaster.success(res.data.message);
                        this.obj_doi_pass = {};
                    } else {
                        toaster.error(res.data.message);
                        this.obj_doi_pass = {};
                    }
                })
                .catch((res) => {
                    var errors = Object.values(res.response.data.errors);
                    errors.forEach(function (v, k) {
                        toaster.error(v[0]);
                    });
                });
        },
        // handleFile(event) {
        //     const file = event.target.files[0];
        //     const cloudName = 'dltbjoii4';
        //     const uploadPreset = 'yvvll2k0';

        //     const formData = new FormData();
        //     formData.append('file', file);
        //     formData.append('upload_preset', uploadPreset);

        //     fetch(`https://api.cloudinary.com/v1_1/${cloudName}/image/upload`, {
        //         method: 'POST',
        //         body: formData,
        //     })
        //         .then((response) => response.json())
        //         .then((data) => {
        //             // Set the imageUrl to the URL of the uploaded image.
        //             this.imageUrl = data.secure_url;
        //             // console.log(this.imageUrl);
        //             this.obj_add_admin.hinh_anh = data.secure_url;
        //             toaster.success('Thêm ảnh thành công!');
        //         })
        //         .catch((error) => {
        //             toaster.error('Thêm ảnh không thành công!');
        //             console.error('Error uploading image:', error);
        //         });
        // },
        // handleFileUpload(event) {
        //     const file = event.target.files[0];
        //     const cloudName = 'dltbjoii4';
        //     const uploadPreset = 'yvvll2k0';

        //     const formData = new FormData();
        //     formData.append('file', file);
        //     formData.append('upload_preset', uploadPreset);

        //     fetch(`https://api.cloudinary.com/v1_1/${cloudName}/image/upload`, {
        //         method: 'POST',
        //         body: formData,
        //     })
        //         .then((response) => response.json())
        //         .then((data) => {
        //             this.obj_update_admin.hinh_anh = data.secure_url;
        //             toaster.success('Thêm ảnh thành công!');
        //         })
        //         .catch((error) => {
        //             console.error('Error uploading image:', error);
        //             toaster.error('Thêm ảnh không thành công!');
        //         });
        // },
    },

};
</script>
<style lang=""></style>
