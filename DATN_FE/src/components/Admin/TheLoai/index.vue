<template>
    <div class="row">
        <div class="col-3">
            <div class="card border-5 border-primary border-top">
                <div class="card-header">
                    <b>THÊM THỂ LOẠI</b>
                </div>
                <div class="card-body">
                    <div class="mb-3 mt-1">
                        <label for="" class="form-label mb-1 mt-1">
                            <b>Tên Thể Loại</b>
                        </label>
                        <input v-model="obj_add_the_loai.ten_the_loai" v-on:keyup="addSlug()"
                            v-on:change="kiemTraSlug()" type="text" class="form-control"
                            placeholder="nhập thể loại..." />
                    </div>
                    <div class="mb-3 mt-1">
                        <label for="" class="form-label mb-1 mt-1">
                            <b>Slug Thể Loại</b>
                        </label>
                        <input v-model="obj_add_the_loai.slug_the_loai" type="text" disabled class="form-control"
                            placeholder="slug the loai.." />
                    </div>
                    <div class="mb-3">
                        <label class="form-label mb-1 mt-1">
                            <b>Danh Mục</b>
                        </label>
                        <select v-model="obj_add_the_loai.id_danh_muc" name="" id="" class="form-control">
                            <template v-for="(v,k) in list_danh_muc" :key="k">
                                <option v-bind:value="v.id">{{ v.ten_danh_muc }}</option>
                            </template>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label mb-1 mt-1">
                            <b>Tình Trạng</b>
                        </label>
                        <select v-model="obj_add_the_loai.tinh_trang" name="" id="" class="form-control">
                            <option value="0">Tạm Dừng</option>
                            <option value="1">Hoạt động</option>
                        </select>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <button v-if="is_create == 0" disabled class="btn btn-danger">Thêm Mới</button>
                    <button v-else v-on:click="taoDataTheLoai()" class="btn btn-primary">Thêm Mới</button>
                </div>
            </div>
        </div>
        <div class="col-8">
            <div class="card border-5 border-primary border-top">
                <div class="card-header">
                    <b>DANH SÁCH THỂ LOẠI</b>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th colspan="100%">
                                        <div class="input-group mb-3">
                                            <input v-on:keyup.enter="searchTheLoai(1)" v-model="key_tim.key" type="text"
                                                class="form-control" placeholder="Nhập thông tin cần tìm" />
                                            <button class="btn btn-primary" v-on:click="searchTheLoai(1)">
                                                <i class="fa-solid fa-magnifying-glass"></i>
                                            </button>
                                        </div>
                                    </th>
                                </tr>
                                <tr class="text-center">
                                    <th class="text-center align-middle text-nowrap">#</th>
                                    <th class="text-center align-middle text-nowrap">
                                        Tên Thể Loại
                                    </th>
                                    <th class="text-center align-middle text-nowrap">
                                        Slug Thể Loại
                                    </th>
                                    <th class="text-center align-middle text-nowrap">
                                        Danh Mục
                                    </th>
                                    <th class="text-center align-middle text-nowrap">
                                        Tình Trạng
                                    </th>
                                    <th class="text-center align-middle text-nowrap">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(v, k) in list_the_loai" class="text-center" :key="k">
                                    <td class="text-center align-middle text-nowrap">
                                        {{ k + 1 }}
                                    </td>
                                    <td class="text-center align-middle text-nowrap">
                                        {{ v.ten_the_loai }}
                                    </td>
                                    <td class="text-center align-middle text-nowrap">
                                        {{ v.slug_the_loai }}
                                    </td>
                                    <td class="text-center align-middle text-nowrap">
                                        {{ v.ten_danh_muc }}
                                    </td>
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

                                    <td class="text-center align-middle text-nowrap text-center">
                                        <button @click="Object.assign(obj_update_the_loai, v)" type="button"
                                            class="btn btn-success me-1" data-bs-toggle="modal"
                                            data-bs-target="#Chinhsua">
                                            Chỉnh Sửa
                                        </button>

                                        <button @click="Object.assign(obj_delete_the_loai, v)" data-bs-target="#Xoa"
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
                    <div class="modal fade" id="Chinhsua" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title fs-5" id="exampleModalLabel">
                                        <b>CHỈNH SỬA THỂ LOẠI</b>
                                    </h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3 mt-1">
                                        <label for="" class="form-label mb-1 mt-1">
                                            <b>Tên Thể Loại</b>
                                        </label>
                                        <input v-model="obj_update_the_loai.ten_the_loai" v-on:keyup="addSlugUpdate()"
                                            v-on:change="kiemTraSlugUpdate()" type="text" class="form-control"
                                            placeholder="nhập thể loại..." />
                                    </div>
                                    <div class="mb-3 mt-1">
                                        <label for="" class="form-label mb-1 mt-1">
                                            <b>Slug Thể Loại</b>
                                        </label>
                                        <input v-model="obj_update_the_loai.slug_the_loai" disabled type="text"
                                            class="form-control" placeholder="nhập slug thể loại..." />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label mb-1 mt-1">
                                            <b>Tình Trạng</b>
                                        </label>
                                        <select v-model="obj_update_the_loai.tinh_trang" name="" id=""
                                            class="form-control">
                                            <option value="0">Tạm Dừng</option>
                                            <option value="1">Hoạt động</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                                        Đóng
                                    </button>
                                    <button v-if="is_update == 0" disabled class="btn btn-danger">Thêm Mới</button>
                                    <button v-else v-on:click="updateTheLoai()" class="btn btn-primary" data-bs-dismiss="modal">Thêm Mới</button>
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
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">
                                        Xoá Thể Loại Phim
                                    </h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body text-start">
                                    <div class="alert alert-danger" role="alert">
                                        Bạn muốn xoá thể loại phim
                                        <b>{{ obj_delete_the_loai.ten_the_loai }}</b> !!!
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">
                                        Đóng
                                    </button>
                                    <button @click="deleteTheLoai()" type="button" data-bs-dismiss="modal"
                                        class="btn btn-danger">
                                        Vẫn Xoá
                                    </button>
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
import baseRequest from "../../../core/baseRequest";
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
            list_the_loai: [],
            list_danh_muc: [],
            key_tim: {},
            obj_add_the_loai: {},
            obj_update_the_loai: {},
            obj_delete_the_loai: {},
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
        this.loaddataTheLoai(1);
    },
    methods: {
        changPage(page) {
            if (this.check_page == 0) {
                this.loaddataTheLoai(page);
            } else if (this.check_page == 1) {
                this.searchTheLoai(page);
            }
        },
        convertToSlug(str) {
            str = str.toLowerCase();
            str = str.normalize("NFD").replace(/[\u0300-\u036f]/g, "");
            str = str.replace(/[đĐ]/g, "d");
            str = str.replace(/([^0-9a-z-\s])/g, "");
            str = str.replace(/(\s+)/g, "-");
            str = str.replace(/-+/g, "-");
            str = str.replace(/^-+|-+$/g, "");
            return str;
        },
        addSlug() {
            this.obj_add_the_loai.slug_the_loai = this.convertToSlug(
                this.obj_add_the_loai.ten_the_loai
            );
        },

        addSlugUpdate() {
            this.obj_update_the_loai.slug_the_loai = this.convertToSlug(
                this.obj_update_the_loai.ten_the_loai
            );
        },

        kiemTraSlug() {
            var payload = {
                slug: this.obj_add_the_loai.slug_the_loai,
            };
            baseRequest.post("admin/the-loai/kiem-tra-slug", payload).then((res) => {
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
                slug: this.obj_update_the_loai.slug_the_loai,
                id: this.obj_update_the_loai.id,
            };
            baseRequest
                .post("admin/the-loai/kiem-tra-slug-update", payload)
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
        loaddataTheLoai(page) {
            baseRequest.get("admin/the-loai/lay-du-lieu?page=" + page).then((res) => {
                this.list_the_loai = res.data.the_loai.dataAdmin.data;
                this.pagination = res.data.the_loai.pagination;
                this.list_danh_muc = res.data.list_danh_muc;
            });
        },
        taoDataTheLoai() {
            baseRequest
                .post("admin/the-loai/thong-tin-tao", this.obj_add_the_loai)
                .then((res) => {
                    if (res.data.status == true) {
                        this.obj_add_the_loai = {};
                        toaster.success(res.data.message);
                        this.loaddataTheLoai(this.pagination.last_page);
                    } else {
                        toaster.error(res.data.message);
                    }
                });
        },
        searchTheLoai(page) {
            this.check_page == 1;
            baseRequest
                .post("admin/the-loai/thong-tin-tim?page=" + page, this.key_tim)
                .then((res) => {
                    this.list_the_loai = res.data.the_loai.dataAdmin.data;
                    this.pagination = res.data.the_loai.pagination;
                    this.list_danh_muc = res.data.list_danh_muc;
                });
        },
        deleteTheLoai() {
            baseRequest
                .delete("admin/the-loai/thong-tin-xoa/" + this.obj_delete_the_loai.id)
                .then((res) => {
                    if (res.data.status == true) {
                        toaster.success("Thông báo<br>" + res.data.message);
                        this.changPage(this.pagination.current_page);
                    } else {
                        toaster.danger("Thông báo<br>" + res.data.message);
                    }
                });
        },
        updateTheLoai() {
            baseRequest
                .put("admin/the-loai/thong-tin-cap-nhat", this.obj_update_the_loai)
                .then((res) => {
                    if (res.data.status == true) {
                        toaster.success("Thông báo<br>" + res.data.message);
                        this.changPage(this.pagination.current_page);
                    } else {
                        toaster.danger("Thông báo<br>" + res.data.message);
                    }
                });
        },

        doiTrangThai(xyz) {
            baseRequest
                .put("admin/the-loai/thong-tin-thay-doi-trang-thai", xyz)
                .then((res) => {
                    if (res.data.status == true) {
                        toaster.success("Thông báo<br>" + res.data.message);
                        this.changPage(this.pagination.current_page);
                    } else {
                        toaster.error(res.data.message);
                    }
                });
        },
    },
};
</script>
<style lang=""></style>
