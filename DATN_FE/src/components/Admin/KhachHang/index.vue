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
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Thêm Mới Khách Hàng </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="row">
                            <div class="col-12 mb-2">
                                <label for="inputFirstName" class="form-label">Họ Và Tên</label>
                                <input type="text" v-model="obj_add_user.ho_va_ten" class="form-control"
                                     placeholder="Họ Và Tên">
                            </div>

                            <div class="col-12 mb-2">
                                <label  class="form-label">Email</label>
                                <input type="email" v-model="obj_add_user.email" class="form-control"
                                    placeholder="example@user.com">
                            </div>
                            <div class="col-12 mb-2">
                                <label  class="form-label">Số điện thoại</label>
                                <input type="text" v-model="obj_add_user.so_dien_thoai" class="form-control"
                                     placeholder="Số điện thoại">
                            </div>
                            <div class="col-12 mb-2">
                                <label  class="form-label">Password</label>
                                <input type="Password" v-model="obj_add_user.password" class="form-control"
                                    placeholder="Password">
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
                        v-on:click="taoDataUser()">Thêm
                        Mới</button>
                </div>
            </div>
        </div>
    </div>
    <div class="row">

        <div class="col-12">
            <div class="card border-5 border-primary border-top">
                <div class="card-header">
                    <b>DANH SÁCH KHÁCH HÀNG </b>
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
                                    <th class="text-center align-middle text-nowrap">Ảnh Đại Diện</th>
                                    <th class="text-center align-middle text-nowrap">Is Active</th>
                                    <th class="text-center align-middle text-nowrap">Tình trạng</th>
                                    <th class="text-center align-middle text-nowrap">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(v, k) in list_khach_khach" class="text-center" :key="k">
                                    <td class="text-center align-middle text-nowrap">{{ k + 1 }}</td>
                                    <td class=" align-middle text-nowrap">{{ v.ho_va_ten }}</td>
                                    <td class=" align-middle text-nowrap">{{ v.email }}</td>
                                    <td class=" align-middle text-nowrap">{{ v.so_dien_thoai }}</td>
                                    <td style="text-align: center; vertical-align: middle;">
                                        <img v-bind:src="v.avatar" class="product-img-2 rounded-circle"
                                            style="display: inline-block;" alt="no-image">
                                    </td>
                                    <td class="text-center align-middle text-nowrap text-center">
                                        <button @click="kichHoat(v)" v-if="v.is_active == 1"
                                            class="badge rounded-pill text-success bg-light-success p-2 text-uppercase px-3"
                                            style="border: none;">
                                            Đã kích hoạt
                                        </button>
                                        <button @click="kichHoat(v)" v-if="v.is_active == 0"
                                            class="badge rounded-pill text-warning bg-light-success p-2 text-uppercase px-3"
                                            style="border: none;">
                                            Chưa kích hoạt
                                        </button>
                                    </td>
                                    <td class="text-center align-middle text-nowrap text-center">
                                        <button @click="doiTrangThai(v)" v-if="v.is_block == 1"
                                            class="badge rounded-pill text-success bg-light-success p-2 text-uppercase px-3"
                                            style="border: none;">
                                            Hoạt Động
                                        </button>
                                        <button @click="doiTrangThai(v)" v-if="v.is_block == 0"
                                            class="badge rounded-pill text-warning bg-light-success p-2 text-uppercase px-3"
                                            style="border: none;">
                                            Chặn
                                        </button>
                                    </td>
                                    <td class="text-center align-middle text-nowrap">
                                        <i @click="Object.assign(obj_update_user, v)" type="button"
                                            data-bs-toggle="modal" data-bs-target="#Chinhsua"
                                            class="fa-solid fa-pen-to-square fa-2x text-warning me-2"></i>

                                        <!-- <i @click="Object.assign(obj_delete_user, v)" data-bs-target="#Xoa"
                                            type="button" data-bs-toggle="modal"
                                            class="fa-solid fa-trash fa-2x text-danger"></i> -->
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
                    <div class="modal fade" id="Chinhsua" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog ">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Chỉnh Sửa Khách Hàng </h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="row">
                                            <div class="col-12 mb-2">
                                                <label for="inputFirstName" class="form-label">Họ Và Tên</label>
                                                <input type="text" v-model="obj_update_user.ho_va_ten"
                                                    class="form-control"  placeholder="Họ Và Tên">
                                            </div>

                                            <div class="col-12 mb-2">
                                                <label  class="form-label">Email</label>
                                                <input type="email" v-model="obj_update_user.email" class="form-control"
                                                    placeholder="example@user.com">
                                            </div>
                                            <div class="col-12 mb-2">
                                                <label  class="form-label">Số điện thoại</label>
                                                <input type="email" v-model="obj_update_user.so_dien_thoai"
                                                    class="form-control"
                                                    placeholder="Số điện thoại">
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
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Thoát</button>
                                    <button type="button" class="btn btn-warning" data-bs-dismiss="modal"
                                        v-on:click="updateAdmin()">Xong</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- {{-- // modol xoa --}} -->
                    <div class="modal fade" id="Xoa" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Xoá Tài Khoản Admin
                                    </h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body text-start">
                                    <div class="alert alert-danger" role="alert">
                                        Bạn có muốn xoá tài khoản <b>{{ obj_delete_user.ho_va_ten }}</b>
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
import functionBasic from "../../../core/functionBasic";
import { getPageNumbers } from "../../../core/paginationUtils.js";
import { createToaster } from "@meforma/vue-toaster";
const toaster = createToaster({
    position: "top-right",
});
export default {
    data() {
        return {
            list_khach_khach: [],
            obj_add_user: { },
            key_tim: {},
            obj_update_user: {},
            obj_delete_user: {},
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
    mounted() {
        this.laydataUser(1);

    },
    computed: {
        pageNumbers() {
            return getPageNumbers(this.pagination);
        },
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
                    vm.obj_add_user.avatar = file;
                } else {
                    vm.obj_update_user.avatar = file;
                }
            };
            reader.readAsDataURL(file);
        },

        laydataUser(page) {
            baseRequest
                .get("admin/khach-hang/lay-du-lieu?page=" + page)
                .then((res) => {
                    this.list_khach_khach = res.data.khach_hang.dataAdmin.data;
                    this.pagination = res.data.khach_hang.pagination;
                })
                .catch((res) => {
                    var errors = Object.values(res.response.data.errors);
                    toaster.error(errors[0]);
                });
        },
        taoDataUser() {
            const formData = new FormData();
            for (let key in this.obj_add_user) {
                formData.append(key, this.obj_add_user[key]);
            }
            baseRequest
                .post(
                    "admin/khach-hang/thong-tin-tao", formData
                )
                .then((res) => {
                    if (res.data.status == true) {
                        toaster.success(res.data.message);
                        this.laydataUser(1);
                        this.obj_add_user = {};
                    } else {
                        toaster.error(res.data.message);
                    }
                })
                .catch((res) => {
                    var errors = Object.values(res.response.data.errors);
                    toaster.error(errors[0]);
                });
        },
        searchAdmin(page) {
            this.check_page == 1;
            baseRequest
                .post('admin/khach-hang/thong-tin-tim?page=' + page, this.key_tim)
                .then((res) => {
                    this.list_khach_khach = res.data.khach_hang.dataAdmin.data;
                    this.pagination = res.data.khach_hang.pagination;
                })
                .catch((res) => {
                    var errors = Object.values(res.response.data.errors);
                    toaster.error(errors[0]);
                });
        },
        deleteAdmin() {
            baseRequest
                .delete('admin/khach-hang/thong-tin-xoa/' + this.obj_delete_user.id)
                .then((res) => {
                    if (res.data.status == true) {
                        toaster.success('Thông báo<br>' + res.data.message);
                        this.laydataUser(1);
                    }
                    else {
                        toaster.danger('Thông báo<br>' + res.data.message);
                    }
                })
                .catch((res) => {
                    var errors = Object.values(res.response.data.errors);
                    toaster.error(errors[0]);
                });
        },
        updateAdmin() {
            const formData = new FormData();
            for (let key in this.obj_update_user) {
                formData.append(key, this.obj_update_user[key]);
            }
                baseRequest
                    .post('admin/khach-hang/thong-tin-cap-nhat', formData)
                    .then((res) => {
                        if (res.data.status == true) {
                            toaster.success('Thông báo<br>' + res.data.message);
                            this.laydataUser(1);
                        } else {
                            toaster.danger('Thông báo<br>' + res.data.message);
                        }
                    })
                    .catch((res) => {
                    var errors = Object.values(res.response.data.errors);
                    toaster.error(errors[0]);
                });
            },
        doiTrangThai(xyz) {
            baseRequest
                .post('admin/khach-hang/thong-tin-thay-doi-trang-thai', xyz)
                .then((res) => {
                    if (res.data.status == true) {
                        toaster.success( res.data.message);
                        this.laydataUser(1);
                    } else {
                        toaster.error(res.data.message);
                    }
                })
                .catch((res) => {
                    var errors = Object.values(res.response.data.errors);
                    toaster.error(errors[0]);
                });
        },
        kichHoat(xyz) {
            baseRequest
                .post('admin/khach-hang/kich-hoat-tai-khoan', xyz)
                .then((res) => {
                    if (res.data.status == true) {
                        toaster.success( res.data.message);
                        this.laydataUser(1);
                    } else {
                        toaster.error(res.data.message);
                    }
                })
                .catch((res) => {
                    var errors = Object.values(res.response.data.errors);
                    toaster.error(errors[0]);
                });
        },

        },

    };
</script>
<style lang=""></style>
