<template>
    <div class="row">
        <div class="col-3">
            <div class="card border-5 border-primary border-top">
                <div class="card-header">
                    <b>THÊM DANH MỤC</b>
                </div>
                <div class="card-body">
                    <div class="mb-3 mt-1">
                        <label for="" class="form-label mb-1 mt-1">
                            <b>Tên Danh Mục</b>
                        </label>
                        <input v-model="obj_add_danh_muc.ten_danh_muc" type="text" @keyup="addSlug()"
                            @change="kiemTraSlug()" class="form-control" placeholder="nhập loai phim..." />
                    </div>
                    <div class="mb-3 mt-1">
                        <label for="" class="form-label mb-1 mt-1">
                            <b>Slug Danh Mục</b>
                        </label>
                        <input v-model="obj_add_danh_muc.slug_danh_muc" disabled type="text" class="form-control"
                            placeholder="nhập slug loai phim..." />
                    </div>
                    <div class="mb-3 mt-1">
                        <label for="" class="form-label mb-1 mt-1">
                            <b>Danh Mục Cha</b>
                        </label>
                        <select v-model="obj_add_danh_muc.id_danh_muc_cha" name="" id="" class="form-control">
                            <option value="0">Root</option>
                            <template v-for="(v,k) in list_danh_muc" :key="k" >
                                <option v-bind:value="v.id">{{ v.ten_danh_muc }}</option>
                            </template>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label mb-1 mt-1">
                            <b>Tình Trạng</b>
                        </label>
                        <select v-model="obj_add_danh_muc.tinh_trang" name="" id="" class="form-control">
                            <option value="0">Tạm Dừng</option>
                            <option value="1">Hoạt động</option>
                        </select>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <button v-if="is_create == 0" disabled class="btn btn-danger">Thêm Mới</button>
                    <button v-else v-on:click="taoDataDanhMuc()" class="btn btn-primary">Thêm Mới</button>

                </div>
            </div>
        </div>
        <div class="col-8">
            <div class="card border-5 border-primary border-top">
                <div class="card-header">
                    <b>DANH SÁCH DANH MỤC</b>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th colspan="100%">
                                        <div class="input-group mb-3">
                                            <input v-on:keyup.enter="searchDanhMuc(1)" v-model="key_tim.key" type="text"
                                                class="form-control" placeholder="Nhập thông tin cần tìm">
                                            <button class="btn btn-primary" v-on:click="searchDanhMuc(1)">
                                                <i class="fa-solid fa-magnifying-glass"></i>
                                            </button>
                                        </div>
                                    </th>
                                </tr>
                                <tr class="text-center">
                                    <th class="text-center align-middle text-nowrap">#</th>
                                    <th class="text-center align-middle text-nowrap">Tên Danh Mục</th>
                                    <th class="text-center align-middle text-nowrap">Slug Danh Mục</th>
                                    <th class="text-center align-middle text-nowrap">Tên Danh Mục Cha</th>
                                    <th class="text-center align-middle text-nowrap">Tình Trạng</th>
                                    <th class="text-center align-middle text-nowrap">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(v, k) in list_danh_muc" :key="k">
                                    <td class=" align-middle text-nowrap">{{ k + 1 }}</td>
                                    <td class=" align-middle text-nowrap">{{ v.ten_danh_muc }}</td>
                                    <td class=" align-middle text-nowrap">{{ v.slug_danh_muc }}</td>
                                    <td v-if="v.ten_danh_muc_cha == null" class=" align-middle text-nowrap">Root</td>
                                    <td v-else  class=" align-middle text-nowrap">{{ v.ten_danh_muc_cha }}</td>

                                    <td class="text-center align-middle text-nowrap text-center">
                                        <button @click="doiTrangThai(v)" v-if="v.tinh_trang == 1"
                                            class="badge rounded-pill text-success bg-light-success p-2 text-uppercase px-3"
                                            style="border: none;">
                                            Hoạt Động
                                        </button>
                                        <button @click="doiTrangThai(v)" v-if="v.tinh_trang == 0"
                                            class="badge rounded-pill text-warning bg-light-success p-2 text-uppercase px-3"
                                            style="border: none;">
                                            Tạm Dừng
                                        </button>
                                    </td>
                                    <td class=" align-middle text-nowrap text-center">
                                        <button @click="Object.assign(obj_update_danh_muc, v)" type="button"
                                            class="btn btn-success me-1" data-bs-toggle="modal"
                                            data-bs-target="#ThemMoi">
                                            Chỉnh Sửa
                                        </button>

                                        <button @click="Object.assign(obj_delete_danh_muc, v)" data-bs-target="#Xoa"
                                            data-bs-toggle="modal" class="btn btn-danger">
                                            Xoá
                                        </button>
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
                    <div class="modal fade" id="ThemMoi" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">CHỈNH Sửa DANH MỤC
                                    </h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body text-start">
                                    <div class="mb-3 mt-1">
                                        <label for="" class="form-label mb-1 mt-1">
                                            <b>Tên Danh Mục</b>
                                        </label>
                                        <input v-model="obj_update_danh_muc.ten_danh_muc" @keyup="addSlugUpdate()"
                                            @change="kiemTraSlugUpdate()" type="text" class="form-control"
                                            placeholder="nhập loại phim...">
                                    </div>
                                    <div class="mb-3 mt-1">
                                        <label for="" class="form-label mb-1 mt-1">
                                            <b>Slug Danh Mục</b>
                                        </label>
                                        <input v-model="obj_update_danh_muc.slug_danh_muc" disabled type="text"
                                            class="form-control" placeholder="nhập slug loai phim...">
                                    </div>
                                    <div class="mb-3 mt-1">
                                        <label for="" class="form-label mb-1 mt-1">
                                            <b>Danh Mục Cha</b>
                                        </label>
                                        <select v-model="obj_update_danh_muc.id_danh_muc_cha" name="" id="" class="form-control">
                                            <template v-for="(v,k) in list_danh_muc" :key="k" >
                                                <option v-bind:value="v.id">{{ v.ten_danh_muc }}</option>
                                            </template>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label mb-1 mt-1">
                                            <b>Tình Trạng</b>
                                        </label>
                                        <select v-model="obj_update_danh_muc.tinh_trang" name="" id=""
                                            class="form-control">
                                            <option value="0">Tạm Dừng</option>
                                            <option value="1">Hoạt động</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Đóng
                                    </button>
                                    <button v-if="is_update == 0" disabled class="btn btn-danger">Xong</button>
                                    <button v-else v-on:click="updateDanhMuc()" data-bs-dismiss="modal"
                                        class="btn btn-primary">Xong</button>
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
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Thêm Chức
                                        Năng
                                    </h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body text-start">
                                    <div class="alert alert-danger" role="alert">
                                        Bạn có muốn xoá <b>{{ obj_delete_danh_muc.ten_danh_muc }}</b>!!!
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Đóng </button>
                                    <button @click="deleteDanhMuc()" type="button" class="btn btn-danger"
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
import functionBasic from "../../../core/functionBasic";
import baseRequest from '../../../core/baseRequest';
import { getPageNumbers } from "../../../core/paginationUtils.js";
import { createToaster } from "@meforma/vue-toaster";
const toaster = createToaster({
    position: "top-right",
});
export default {
    data() {
        return {
            is_create: 0,
            is_update: 1,
            list_danh_muc: [],
            obj_add_danh_muc: {},
            key_tim: {},
            obj_add_danh_muc: {},
            obj_update_danh_muc: {},
            obj_delete_danh_muc: {},
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
        this.laydataDanhMuc(1);
    },
    methods: {
        changPage(page) {
            if (this.check_page == 0) {
                this.laydataDanhMuc(page);
            } else if (this.check_page == 1) {
                this.searchDanhMuc(page);
            }
        },
        convertToSlug(str) {
            str = str.toLowerCase();
            str = str
                .normalize('NFD')
                .replace(/[\u0300-\u036f]/g, '');
            str = str.replace(/[đĐ]/g, 'd');
            str = str.replace(/([^0-9a-z-\s])/g, '');
            str = str.replace(/(\s+)/g, '-');
            str = str.replace(/-+/g, '-');
            str = str.replace(/^-+|-+$/g, '');
            return str;
        },
        addSlug() {
            this.obj_add_danh_muc.slug_danh_muc = this.convertToSlug(this.obj_add_danh_muc.ten_danh_muc);
        },

        addSlugUpdate() {
            this.obj_update_danh_muc.slug_danh_muc = this.convertToSlug(this.obj_update_danh_muc.ten_danh_muc);
        },

        kiemTraSlug() {
            var payload = {
                'slug': this.obj_add_danh_muc.slug_danh_muc
            }
            baseRequest
                .post('admin/danh-muc/kiem-tra-slug', payload)
                .then((res) => {
                    if (res.data.status) {
                        toaster.success(res.data.message);
                        this.is_create = 1;
                    } else {
                        toaster.error(res.data.message);
                        this.is_create = 0;
                    }
                });
        },

        kiemTraSlugUpdate() {
            var payload = {
                'slug': this.obj_update_danh_muc.slug_danh_muc,
                'id': this.obj_update_danh_muc.id
            }
            baseRequest
                .post('admin/danh-muc/kiem-tra-slug-update', payload)
                .then((res) => {
                    if (res.data.status) {
                        toaster.success(res.data.message);
                        this.is_update = 1;

                    } else {
                        toaster.error(res.data.message);
                        this.is_update = 0;

                    }
                });
        },
        laydataDanhMuc(page) {
            baseRequest
                .get("admin/danh-muc/lay-du-lieu?page=" + page)
                .then((res) => {
                    this.list_danh_muc = res.data.danh_muc_admin.dataAdmin.data;
                    this.pagination = res.data.danh_muc_admin.pagination;
                });
        },
        taoDataDanhMuc() {
            baseRequest
                .post(
                    "admin/danh-muc/thong-tin-tao",
                    this.obj_add_danh_muc
                )
                .then((res) => {
                    if (res.data.status == true) {
                        toaster.success(res.data.message);
                        this.obj_add_danh_muc = {};
                        this.laydataDanhMuc(1);
                    } else {
                        toaster.error(res.data.message);
                    }
                });
        },
        searchDanhMuc(page) {
            this.check_page == 1;
            baseRequest
                .post('admin/danh-muc/thong-tin-tim?page=' + page, this.key_tim)
                .then((res) => {
                    this.list_danh_muc = res.data.danh_muc_admin.dataAdmin.data;
                    this.pagination = res.data.danh_muc_admin.pagination;
                });
        },
        deleteDanhMuc() {
            baseRequest
                .delete('admin/danh-muc/thong-tin-xoa/' + this.obj_delete_danh_muc.id)
                .then((res) => {
                    if (res.data.status == true) {
                        toaster.success('Thông báo<br>' + res.data.message);
                        this.laydataDanhMuc(this.pagination.last_page);
                    }
                    else {
                        toaster.danger('Thông báo<br>' + res.data.message);
                    }
                });
        },
        updateDanhMuc() {
            baseRequest
                .put('admin/danh-muc/thong-tin-cap-nhat', this.obj_update_danh_muc)
                .then((res) => {
                    if (res.data.status == true) {
                        toaster.success('Thông báo<br>' + res.data.message);
                        this.laydataDanhMuc(1);
                    } else {
                        toaster.danger('Thông báo<br>' + res.data.message);
                    }
                });
        },

        doiTrangThai(xyz) {
            baseRequest
                .put('admin/danh-muc/thong-tin-thay-doi-trang-thai', xyz)
                .then((res) => {
                    if (res.data.status == true) {
                        toaster.success('Thông báo<br>' + res.data.message);
                        this.laydataDanhMuc(1);
                    } else {
                        toaster.error(res.data.message);
                    }
                });
        }
    },

};
</script>
<style lang=""></style>
