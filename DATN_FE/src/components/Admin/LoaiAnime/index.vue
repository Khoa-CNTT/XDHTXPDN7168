<template>
    <div class="row">
        <div class="col-3">
            <div class="card border-5 border-primary border-top">
                <div class="card-header">
                    <b>THÊM LOẠI PHIM</b>
                </div>
                <div class="card-body">
                    <div class="mb-3 mt-1">
                        <label for="" class="form-label mb-1 mt-1">
                            <b>Tên Loại Phim</b>
                        </label>
                        <input v-model="obj_add_loai_phim.ten_loai_phim" type="text" @keyup="addSlug()"
                            @change="kiemTraSlug()" class="form-control" placeholder="nhập loai phim..." />
                    </div>
                    <div class="mb-3 mt-1">
                        <label for="" class="form-label mb-1 mt-1">
                            <b>Slug Loại Phim</b>
                        </label>
                        <input v-model="obj_add_loai_phim.slug_loai_phim" disabled type="text" class="form-control"
                            placeholder="nhập slug loai phim..." />
                    </div>
                    <div class="mb-3">
                        <label class="form-label mb-1 mt-1">
                            <b>Tình Trạng</b>
                        </label>
                        <select v-model="obj_add_loai_phim.tinh_trang" name="" id="" class="form-control">
                            <option value="0">Tạm Dừng</option>
                            <option value="1">Hoạt động</option>
                        </select>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <button @click="taoDataLoaiPhim()" class="btn btn-primary">Thêm Mới</button>
                </div>
            </div>
        </div>
        <div class="col-8">
            <div class="card border-5 border-primary border-top">
                <div class="card-header">
                    <b>DANH SÁCH LOẠI PHIM</b>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th colspan="100%">
                                        <div class="input-group mb-3">
                                            <input v-on:keyup.enter="searchLoaiPhim(1)" v-model="key_tim.key" type="text"
                                                class="form-control" placeholder="Nhập thông tin cần tìm">
                                            <button class="btn btn-primary" v-on:click="searchLoaiPhim(1)">
                                                <i class="fa-solid fa-magnifying-glass"></i>
                                            </button>
                                        </div>
                                    </th>
                                </tr>
                                <tr class="text-center">
                                    <th class="text-center align-middle text-nowrap">#</th>
                                    <th class="text-center align-middle text-nowrap">Tên Loại Phim</th>
                                    <th class="text-center align-middle text-nowrap">Slug Loại Phim</th>
                                    <th class="text-center align-middle text-nowrap">Tình Trạng</th>
                                    <th class="text-center align-middle text-nowrap">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(v, k) in list_loai_phim" :key="k">
                                    <td class=" align-middle text-nowrap">{{ k + 1 }}</td>
                                    <td class=" align-middle text-nowrap">{{ v.ten_loai_phim }}</td>
                                    <td class=" align-middle text-nowrap">{{ v.slug_loai_phim }}</td>

                                    <td class=" align-middle text-nowrap">
                                        <button @click="doiTrangThai(v)" v-if="v.tinh_trang == 1" class="btn btn-success">
                                            Hoạt Động
                                        </button>
                                        <button @click="doiTrangThai(v)" v-if="v.tinh_trang == 0" class="btn btn-warning">
                                            Tạm Dừng
                                        </button>
                                    </td>
                                    <td class=" align-middle text-nowrap">
                                        <button @click="Object.assign(obj_update_loai_phim, v)" type="button"
                                            class="btn btn-success me-1" data-bs-toggle="modal" data-bs-target="#ThemMoi">
                                            Chỉnh Sữa
                                        </button>

                                        <button @click="Object.assign(obj_delete_loai_phim, v)" data-bs-target="#Xoa"
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
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">CHỈNH SỮA LOẠI PHIM
                                    </h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body text-start">
                                    <div class="mb-3 mt-1">
                                        <label for="" class="form-label mb-1 mt-1">
                                            <b>Tên Loại Phim</b>
                                        </label>
                                        <input v-model="obj_update_loai_phim.ten_loai_phim" @keyup="addSlugUpdate()"
                                            @change="kiemTraSlugUpdate()" type="text" class="form-control"
                                            placeholder="nhập loại phim...">
                                    </div>
                                    <div class="mb-3 mt-1">
                                        <label for="" class="form-label mb-1 mt-1">
                                            <b>Slug Loại Phim</b>
                                        </label>
                                        <input v-model="obj_update_loai_phim.slug_loai_phim" disabled type="text"
                                            class="form-control" placeholder="nhập slug loai phim...">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label mb-1 mt-1">
                                            <b>Tình Trạng</b>
                                        </label>
                                        <select v-model="obj_update_loai_phim.tinh_trang" name="" id=""
                                            class="form-control">
                                            <option value="0">Tạm Dừng</option>
                                            <option value="1">Hoạt động</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Đóng
                                    </button>
                                    <button @click="updateLoaiPhim()" type="button" class="btn btn-success"
                                        data-bs-dismiss="modal">Xong</button>
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
                                        Bạn có muốn xoá <b>{{ obj_delete_loai_phim.ten_loai_phim }}</b>!!!
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Đóng </button>
                                    <button @click="deleteLoaiPhim()" type="button" class="btn btn-danger"
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
import { getPageNumbers } from "../../../core/paginationUtils.js";
import { createToaster } from "@meforma/vue-toaster";
const toaster = createToaster({
    position: "top-right",
});
export default {
    data() {
        return {
            list_loai_phim: [],
            obj_add_loai_phim: {},
            key_tim: {},
            obj_add_loai_phim: {},
            obj_update_loai_phim: {},
            obj_delete_loai_phim: {},
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
        this.laydataLoaiPhim(1);
    },
    methods: {
        changPage(page) {
            if (this.check_page == 0) {
                this.laydataLoaiPhim(page);
            } else if (this.check_page == 1) {
                this.searchLoaiPhim(page);
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
            this.obj_add_loai_phim.slug_loai_phim = this.convertToSlug(this.obj_add_loai_phim.ten_loai_phim);
        },

        addSlugUpdate() {
            this.obj_update_loai_phim.slug_loai_phim = this.convertToSlug(this.obj_update_loai_phim.ten_loai_phim);
        },

        kiemTraSlug() {
            var payload = {
                'slug': this.obj_add_loai_phim.slug_loai_phim
            }
            baseRequest
                .post('admin/loai-phim/kiem-tra-slug', payload)
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
                'slug': this.obj_update_loai_phim.slug_loai_phim,
                'id': this.obj_update_loai_phim.id
            }
            baseRequest
                .post('admin/loai-phim/kiem-tra-slug-update', payload)
                .then((res) => {
                    if (res.data.status) {
                        toaster.success(res.data.message);
                    } else {
                        toaster.error(res.data.message);
                    }
                });
        },
        laydataLoaiPhim(page) {
            baseRequest
                .get("admin/loai-phim/lay-du-lieu?page=" + page)
                .then((res) => {
                    this.list_loai_phim = res.data.loai_phim_admin.dataAdmin.data;
                    this.pagination = res.data.loai_phim_admin.pagination;
                });
        },
        taoDataLoaiPhim() {
            baseRequest
                .post(
                    "admin/loai-phim/thong-tin-tao",
                    this.obj_add_loai_phim
                )
                .then((res) => {
                    if (res.data.status == true) {
                        toaster.success(res.data.message);
                        this.obj_add_loai_phim = {};
                        this.laydataLoaiPhim(1);
                    } else {
                        toaster.error(res.data.message);
                    }
                });
        },
        searchLoaiPhim(page) {
            this.check_page == 1;
            baseRequest
                .post('admin/loai-phim/thong-tin-tim?page=' + page, this.key_tim)
                .then((res) => {
                    this.list_loai_phim = res.data.loai_phim_admin.dataAdmin.data;
                    this.pagination = res.data.loai_phim_admin.pagination;
                });
        },
        deleteLoaiPhim() {
            baseRequest
                .delete('admin/loai-phim/thong-tin-xoa/' + this.obj_delete_loai_phim.id)
                .then((res) => {
                    if (res.data.status == true) {
                        toaster.success('Thông báo<br>' + res.data.message);
                        this.laydataLoaiPhim(this.pagination.last_page);
                    }
                    else {
                        toaster.danger('Thông báo<br>' + res.data.message);
                    }
                });
        },
        updateLoaiPhim() {
            baseRequest
                .put('admin/loai-phim/thong-tin-cap-nhat', this.obj_update_loai_phim)
                .then((res) => {
                    if (res.data.status == true) {
                        toaster.success('Thông báo<br>' + res.data.message);
                        this.laydataLoaiPhim(1);
                    } else {
                        toaster.danger('Thông báo<br>' + res.data.message);
                    }
                });
        },

        doiTrangThai(xyz) {
            baseRequest
                .put('admin/loai-phim/thong-tin-thay-doi-trang-thai', xyz)
                .then((res) => {
                    if (res.data.status == true) {
                        toaster.success('Thông báo<br>' + res.data.message);
                        this.laydataLoaiPhim(1);
                    } else {
                        toaster.error(res.data.message);
                    }
                });
        }
    },

};
</script>
<style lang=""></style>
