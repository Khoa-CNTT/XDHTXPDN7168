<template>
    <div class="row">
        <div class="col-3">
            <div class="card border-5 border-primary border-top">
                <div class="card-header">
                    <b>THÊM ĐẠO DIỄN</b>
                </div>
                <div class="card-body">
                    <div class="mb-3 mt-1">
                        <label for="" class="form-label mb-1 mt-1">
                            <b>Tên Đạo Diễn</b>
                        </label>
                        <input v-model="obj_add_tac_gia.ten_tac_gia" v-on:keyup="addSlug()" v-on:change="kiemTraSlug()"
                            type="text" class="form-control" placeholder="slug tác giả..." />
                    </div>
                    <div class="mb-3 mt-1">
                        <label for="" class="form-label mb-1 mt-1">
                            <b>Slug Đạo Diễn</b>
                        </label>
                        <input v-model="obj_add_tac_gia.slug_tac_gia" type="text" disabled class="form-control"
                            placeholder="nhập tác giả..." />
                    </div>
                    <div class="mb-3">
                        <label class="form-label mb-1 mt-1">
                            <b>Tình Trạng</b>
                        </label>
                        <select v-model="obj_add_tac_gia.tinh_trang" name="" id="" class="form-control">
                            <option value="0">Tạm Dừng</option>
                            <option value="1">Hoạt động</option>
                        </select>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <button v-if="is_create == 0" disabled class="btn btn-danger">Thêm Mới</button>
                    <button v-else v-on:click="taoDataTacGia()" class="btn btn-primary">Thêm Mới</button>
                </div>
            </div>
        </div>
        <div class="col-8">
            <div class="card border-5 border-primary border-top">
                <div class="card-header">
                    <b>DANH SÁCH ĐẠO DIỄN</b>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th colspan="100%">
                                    <div class="input-group mb-3">
                                        <input v-on:keyup.enter="searchTacGia(1)" v-model="key_tim.key" type="text"
                                            class="form-control" placeholder="Nhập thông tin cần tìm">
                                        <button class="btn btn-primary" v-on:click="searchTacGia(1)">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                        </button>
                                    </div>
                                </th>
                            </tr>
                            <tr class="text-center">
                                <th class="text-center align-middle text-nowrap">#</th>
                                <th class="text-center align-middle text-nowrap">Tên Đạo Diễn</th>
                                <th class="text-center align-middle text-nowrap">Slug Đạo Diễn</th>
                                <th class="text-center align-middle text-nowrap">Tình Trạng</th>
                                <th class="text-center align-middle text-nowrap">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr v-for="(v, k) in list_tac_gia" class="" :key="k">
                                <td class=" align-middle text-nowrap">{{ k + 1 }}</td>
                                <td class=" align-middle text-nowrap">{{ v.ten_tac_gia }}</td>
                                <td class=" align-middle text-nowrap">{{ v.slug_tac_gia }}</td>
                                <td class="text-center align-middle text-nowrap text-center">
                                        <button @click="doiTrangThai(v)" v-if="v.tinh_trang == 1"
                                            class="badge rounded-pill text-success bg-light-success p-2 text-uppercase px-3" style="border: none;">
                                            Hoạt Động
                                        </button>
                                        <button @click="doiTrangThai(v)" v-if="v.tinh_trang == 0"
                                            class="badge rounded-pill text-warning bg-light-success p-2 text-uppercase px-3" style="border: none;">
                                            Tạm Dừng
                                        </button>
                                    </td>
                                <td class="text-center align-middle text-nowrap">
                                    <button @click="Object.assign(obj_update_tac_gia, v)" type="button"
                                        class="btn btn-success me-1" data-bs-toggle="modal" data-bs-target="#Chinhsua">
                                        Chỉnh Sửa
                                    </button>

                                    <button @click="Object.assign(obj_delete_tac_gia, v)" data-bs-target="#Xoa"
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
                    <div class="modal fade" id="Chinhsua" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">

                                    <h4 class="modal-title fs-5" id="exampleModalLabel"><b>CHỈNH Sửa ĐẠO DIỄN</b>
                                    </h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body ">
                                    <div class="mb-3 mt-1">
                                        <label for="" class="form-label mb-1 mt-1">
                                            <b>Tên Đạo Diễn</b>
                                        </label>
                                        <input v-model="obj_update_tac_gia.ten_tac_gia" v-on:keyup="addSlugUpdate()"
                                            v-on:change="kiemTraSlugUpdate()" type="text" class="form-control"
                                            placeholder="nhập thể loại..." />
                                    </div>
                                    <div class="mb-3 mt-1">
                                        <label for="" class="form-label mb-1 mt-1">
                                            <b>Slug Đạo Diễn</b>
                                        </label>
                                        <input v-model="obj_update_tac_gia.slug_tac_gia" type="text" disabled
                                            class="form-control" placeholder="slug tác giả..." />
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label mb-1 mt-1">
                                            <b>Tình Trạng</b>
                                        </label>
                                        <select v-model="obj_update_tac_gia.tinh_trang" name="" id=""
                                            class="form-control">
                                            <option value="0">Tạm Dừng</option>
                                            <option value="1">Hoạt động</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Đóng
                                    </button>
                                    <button v-if="is_update == 0" disabled class="btn btn-danger">Lưu</button>
                                    <button v-else v-on:click="updateTacGia()" class="btn btn-primary" data-bs-dismiss="modal">Lưu</button>
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
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Xoá Đạo Diễn
                                    </h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body text-start">
                                    <div class="alert alert-danger" role="alert">
                                        Bạn muốn xoá đạo diễn: <b>{{ obj_delete_tac_gia.ten_tac_gia }}</b> !!!
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Đóng </button>
                                    <button @click="deleteTacGia()" type="button" data-bs-dismiss="modal"
                                        class="btn btn-danger">Vẫn
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
            is_create: 0,
            is_update: 1,
            list_tac_gia: [],
            key_tim: {},
            obj_add_tac_gia: {},
            obj_update_tac_gia: {},
            obj_delete_tac_gia: {},
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
        this.loaddataTacGia(1);
    },
    computed: {
        pageNumbers() {
            return getPageNumbers(this.pagination);
        },
    },
    methods: {
        changPage(page) {
            if (this.check_page == 0) {
                this.loaddataTacGia(page);
            } else if (this.check_page == 1) {
                this.searchTacGia(page);
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
            this.obj_add_tac_gia.slug_tac_gia = this.convertToSlug(this.obj_add_tac_gia.ten_tac_gia);
        },

        addSlugUpdate() {
            this.obj_update_tac_gia.slug_tac_gia = this.convertToSlug(this.obj_update_tac_gia.ten_tac_gia);
        },

        kiemTraSlug() {
            var payload = {
                'slug': this.obj_add_tac_gia.slug_tac_gia
            }
            baseRequest
                .post('admin/tac-gia/kiem-tra-slug', payload)
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
                'slug': this.obj_update_tac_gia.slug_tac_gia,
                'id': this.obj_update_tac_gia.id
            }
            baseRequest
                .post('admin/tac-gia/kiem-tra-slug-update', payload)
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
        loaddataTacGia(page) {
            baseRequest
                .get("admin/tac-gia/lay-du-lieu?page=" + page)
                .then((res) => {
                    this.list_tac_gia = res.data.tac_gia_admin.dataAdmin.data;
                    this.pagination = res.data.tac_gia_admin.pagination;
                });
        },
        taoDataTacGia() {
            baseRequest
                .post(
                    "admin/tac-gia/thong-tin-tao",
                    this.obj_add_tac_gia
                )
                .then((res) => {
                    if (res.data.status == true) {
                        this.obj_add_tac_gia = {};
                        toaster.success(res.data.message);
                        this.loaddataTacGia(1);
                    } else {
                        toaster.error(res.data.message);
                    }
                });
        },
        searchTacGia(page) {
            this.check_page == 1
            baseRequest
                .post('admin/tac-gia/thong-tin-tim?page=' + page, this.key_tim)
                .then((res) => {
                    this.list_tac_gia = res.data.tac_gia_admin.dataAdmin.data;
                    this.pagination = res.data.tac_gia_admin.pagination;
                });
        },
        deleteTacGia() {
            baseRequest
                .delete('admin/tac-gia/thong-tin-xoa/' + this.obj_delete_tac_gia.id)
                .then((res) => {
                    if (res.data.status == true) {
                        toaster.success('Thông báo<br>' + res.data.message);
                        this.loaddataTacGia(1);
                    }
                    else {
                        toaster.danger('Thông báo<br>' + res.data.message);
                    }
                });
        },
        updateTacGia() {
            baseRequest
                .put('admin/tac-gia/thong-tin-cap-nhat', this.obj_update_tac_gia)
                .then((res) => {
                    if (res.data.status == true) {
                        toaster.success('Thông báo<br>' + res.data.message);
                        this.loaddataTacGia(1);
                    } else {
                        toaster.danger('Thông báo<br>' + res.data.message);
                    }
                });
        },

        doiTrangThai(xyz) {
            baseRequest
                .put('admin/tac-gia/thong-tin-thay-doi-trang-thai', xyz)
                .then((res) => {
                    if (res.data.status == true) {
                        toaster.success('Thông báo<br>' + res.data.message);
                        this.loaddataTacGia(1);
                    } else {
                        toaster.error(res.data.message);
                    }
                });
        }
    },
};
</script>
<style lang=""></style>
