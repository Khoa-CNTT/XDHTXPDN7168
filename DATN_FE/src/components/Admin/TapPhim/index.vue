<template>
    <div class="row">
        <div class="col-12">
            <div class="card border-5 border-primary border-top">
                <div class="card-header">
                    <b>DANH SÁCH PHIM</b>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-responsive">
                        <thead>
                            <tr>
                                <th colspan="100%">
                                    <div class="input-group mb-3">
                                        <input v-on:keyup.enter="searchPhim(1)" v-model="key_tim.key" type="text"
                                            class="form-control" placeholder="Nhập thông tin cần tìm" />
                                        <button class="btn btn-primary" v-on:click="searchPhim(1)">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                        </button>
                                    </div>
                                </th>
                            </tr>
                            <tr class="text-center">
                                <th class="text-center align-middle text-nowrap">#</th>
                                <th class="text-left">Tên phim</th>
                                <th class="text-center align-middle text-nowrap">Hình ảnh</th>
                                <th class="text-center align-middle text-nowrap">Thời lượng</th>
                                <th class="text-center align-middle text-nowrap">Số tập</th>
                                <th class="text-center align-middle text-nowrap">Tình trạng</th>
                                <th class="text-center align-middle text-nowrap">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(v, k) in list_phim" class="" :key="k">
                                <td class="text-center align-middle text-nowrap">
                                    {{ k + 1 }}
                                </td>
                                <td class="align-middle text-wrap">
                                    {{ tenLimited(v.ten_phim) }}
                                </td>
                                <td style="
                    display: flex;
                    justify-content: center;
                    align-items: center;
                  ">
                                    <img v-bind:src="v.hinh_anh" class="product-img-2" alt="product img" />
                                </td>
                                <td class="align-middle text-nowrap text-center">
                                    {{ v.thoi_gian_chieu }} phút
                                </td>
                                <td :class="v.tong_tap == v.so_tap_phim ? 'text-success' : 'text-danger'
                                    " class="align-middle text-nowrap text-center">
                                    {{ v.tong_tap }}/{{ v.so_tap_phim }}
                                </td>
                                <td class="text-center align-middle text-nowrap text-center">
                                    <button @click="doiTrangThaiPhim(v)" v-if="v.tinh_trang == 1"
                                        class="badge rounded-pill text-success bg-light-success p-2 text-uppercase px-3"
                                        style="border: none">
                                        Hoạt Động
                                    </button>
                                    <button @click="doiTrangThaiPhim(v)" v-if="v.tinh_trang == 0"
                                        class="badge rounded-pill text-warning bg-light-success p-2 text-uppercase px-3"
                                        style="border: none">
                                        Tạm Dừng
                                    </button>
                                </td>
                                <td class="text-center align-middle text-nowrap">
                                    <i @click="Object.assign(obj_tap_phim, v); obj_them_tap.id = v.id;obj_update_tap_phim={}; is_check_show = false; laydataTapPhim(1, v.id);"
                                        type="button" data-bs-toggle="modal" data-bs-target="#ThemTap"
                                        class="fa-solid fa-folder-plus fa-2x text-warning me-2"></i>

                                    <i @click="Object.assign(obj_xoa_all, v)" data-bs-target="#XoaAllTap" type="button"
                                        data-bs-toggle="modal" class="fa-solid fa-trash fa-2x text-danger"></i>
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

                    <!-- modal Thêm Tập -->
                    <div class="modal fade" id="ThemTap" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">
                                        {{ obj_tap_phim.ten_phim }}
                                    </h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <!-- Show thêm tâp -->
                                            <div v-show="is_check_show == false" class="card">
                                                <div class="card-header">
                                                    <h5>Thêm tập phim</h5>
                                                </div>
                                                <div class="card-body">
                                                    <label for="" class="form-label mb-2 mt-2">
                                                        Link Tập
                                                    </label>
                                                    <input v-model="obj_them_tap.url" type="text" class="form-control"
                                                        placeholder="Nhập link tập..." />
                                                    <label for="" class="form-label mb-2 mt-2">
                                                        Số Tập
                                                    </label>
                                                    <input v-model="obj_them_tap.so_tap" type="number"
                                                        class="form-control" placeholder="Nhập số tập..." />
                                                    <label class="form-label mb-2 mt-2">
                                                        Trạng thái
                                                    </label>
                                                    <select v-model="obj_them_tap.tinh_trang" class="form-control">
                                                        <option value="1">Hiện thị</option>
                                                        <option value="0">Tạm tắt</option>
                                                    </select>
                                                </div>
                                                <div class="card-footer text-end">
                                                    <button class="btn btn-primary" @click="themTapPhim()">Thêm
                                                        Tập</button>
                                                </div>
                                            </div>
                                            <!-- Show cập nhập -->
                                            <div v-show="is_check_show == true" class="card">
                                                <div class="card-header">
                                                    <h5>Cập nhập tập phim</h5>
                                                </div>
                                                <div class="card-body">
                                                    <label for="" class="form-label mb-2 mt-2">
                                                        Link Tập
                                                    </label>
                                                    <input v-model="obj_update_tap_phim.url" type="text"
                                                        class="form-control" placeholder="Nhập link tập..." />
                                                    <label for="" class="form-label mb-2 mt-2">
                                                        Số Tập
                                                    </label>
                                                    <input v-model="obj_update_tap_phim.so_tap" type="number" disabled
                                                        class="form-control" placeholder="Nhập số tập..." />
                                                    <label class="form-label mb-2 mt-2">
                                                        Trạng thái
                                                    </label>
                                                    <select v-model="obj_update_tap_phim.tinh_trang"
                                                        class="form-control">
                                                        <option value="1">Hiện thị</option>
                                                        <option value="0">Tạm tắt</option>
                                                    </select>
                                                </div>
                                                <div class="card-footer text-end">
                                                    <button class="btn btn-secondary me-2"
                                                        @click="is_check_show = false">Đóng</button>
                                                    <button class="btn btn-success" @click="capNhapTapPhim()">Cập
                                                        Nhập</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="card">
                                                <div class="card-body">
                                                    <table class="table table-hover table-responsive">
                                                        <thead>
                                                            <tr class="table-active">
                                                                <th class="text-center align-middle">Số tập</th>
                                                                <th class="text-center align-middle">Slug_tap</th>
                                                                <th class="text-center align-middle">Trạng thái</th>
                                                                <th class="text-center align-middle">Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr v-for="(v, k) in list_tap_phim" :key="k">
                                                                <th class="text-center align-middle">{{ v.so_tap }}</th>
                                                                <td class="text-center align-middle">{{ v.slug_tap_phim
                                                                    }}</td>
                                                                <td
                                                                    class="text-center align-middle text-nowrap text-center">
                                                                    <button @click="doiTrangThaiPhim(v)"
                                                                        v-if="v.tinh_trang == 1"
                                                                        class="badge rounded-pill text-success bg-light-success p-2 text-uppercase px-3"
                                                                        style="border: none">
                                                                        Hiện Thị
                                                                    </button>
                                                                    <button @click="doiTrangThaiPhim(v)"
                                                                        v-if="v.tinh_trang == 0"
                                                                        class="badge rounded-pill text-warning bg-light-success p-2 text-uppercase px-3"
                                                                        style="border: none">
                                                                        Tạm Tắt
                                                                    </button>
                                                                </td>
                                                                <td class="text-center align-middle text-nowrap">
                                                                    <i @click="Object.assign(obj_update_tap_phim, v); is_check_show = true"
                                                                        type="button"
                                                                        class="fa-solid fa-pen-to-square fa-2x text-warning me-2"></i>

                                                                    <i data-bs-target="#XoaTapPhim"
                                                                        @click="Object.assign(obj_delete_1_tap, v)"
                                                                        type="button" data-bs-toggle="modal"
                                                                        class="fa-solid fa-trash fa-2x text-danger"></i>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <nav aria-label="Table Paging" class="mb-0 text-headings">
                                                        <div class="card-footer text-end text-nowrap">
                                                            <button
                                                                @click="changPageTapPhim(pagination_tap_phim.current_page - 1)"
                                                                :disabled="pagination_tap_phim.current_page <= 1"
                                                                class="btn btn-secondary btn-sm me-2">
                                                                Previous
                                                            </button>
                                                            <button class="btn btn-secondary btn-sm me-2"
                                                                v-for="page in pageNumbersTapPhim" :key="page"
                                                                @click="page !== '...' && changPageTapPhim(page)"
                                                                :class="{ active: page === pagination_tap_phim.current_page }">
                                                                {{ page }}
                                                            </button>
                                                            <button
                                                                @click="changPageTapPhim(pagination_tap_phim.current_page + 1)"
                                                                :disabled="pagination_tap_phim.current_page >= pagination_tap_phim.last_page"
                                                                class="btn btn-secondary btn-sm me-2">
                                                                Next
                                                            </button>
                                                        </div>
                                                    </nav>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                        Đóng
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- {{-- // modol xoa 1 tập phim --}} -->
                    <div class="modal fade" id="XoaTapPhim" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">
                                        {{ obj_tap_phim.ten_phim }}
                                    </h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body text-start">
                                    <div class="alert alert-danger" role="alert">
                                        Bạn muốn xoá Tập
                                        <b class="text-danger">{{ obj_delete_1_tap.so_tap }}</b>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-dark" data-bs-target="#ThemTap"
                                        data-bs-toggle="modal">
                                        Đóng
                                    </button>
                                    <button @click="delete1TapPhim()" type="button" data-bs-target="#ThemTap"
                                        data-bs-toggle="modal" class="btn btn-danger">
                                        Vẫn Xoá
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- {{-- // modol xoa tất cả các tập phim --}} -->
                    <div class="modal fade" id="XoaAllTap" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">
                                        Xoá tất cả Tập
                                    </h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body text-start">
                                    <div class="alert alert-danger" role="alert">
                                        Bạn có muốn xoá tất cấc của tập của Phim
                                        <b class="text-danger">{{ obj_xoa_all.ten_phim }}</b>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-dark" data-bs-target="#ThemTap"
                                        data-bs-toggle="modal">
                                        Đóng
                                    </button>
                                    <button @click="deleteAllTapPhim()" type="button"
                                        data-bs-toggle="modal" class="btn btn-danger">
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
import baseRequest from "../../../core/baseRequest";
import functionBasic from "../../../core/functionBasic";
import { getPageNumbers } from "../../../core/paginationUtils.js";
import { getPageNumbers_2 } from "../../../core/paginationUtils_2";
import { createToaster } from "@meforma/vue-toaster";
const toaster = createToaster({
    position: "top-right",
});
export default {
    data() {
        return {
            is_create: 0,
            is_update: 1,
            is_check_show: false,
            list_phim: [],
            list_tap_phim: [],
            obj_update_tap_phim: {},
            key_tim: {},
            obj_them_tap: {},
            obj_mo_ta: {},
            obj_tap_phim: {},
            obj_delete_tap_phim: {},
            obj_delete_1_tap: {},
            obj_xoa_all: {},
            pagination: {
                last_page: "",
                per_page: "",
                current_page: "",
                last_page: "",
                from: "",
                to: "",
            },
            pagination_tap_phim: {
                last_page: "",
                per_page: "",
                current_page: "",
                last_page: "",
                from: "",
                to: "",
            },
            check_page: 0,
            maxChars: 20,
        };
    },
    computed: {
        pageNumbers() {
            return getPageNumbers(this.pagination);
        },
        pageNumbersTapPhim() {
            return getPageNumbers_2(this.pagination_tap_phim);
        },
    },
    mounted() {

        this.laydataPhim(1);

    },
    methods: {
        changPage(page) {
            if (this.check_page == 0) {
                this.laydataPhim(page);
            } else if (this.check_page == 1) {
                this.searchPhim(page);
            }
        },
        changPageTapPhim(page) {
            this.laydataTapPhim(page, this.obj_tap_phim.id);
            console.log(this.check_page);
        },
        convertToSlug(str) {
            str = str.toLowerCase();
            str = str.normalize("NFD").replace(/[\u0300-\u036f]/g, "");
            str = str.replace(/[đĐ]/g, "d");
            str = str.replace(/([^0-9a-z-\s])/g, "");
            str = str.replace(/(\s+)/g, "-");
            str = str.replace(/-+/g, "-");
            str = str.replace(/^-+|-+$/g, "");
            return this.obj_tap_phim.slug_phim + "-" + str;
        },

        addSlugUpdate() {
            this.obj_them_tap.slug_tap_phim = this.convertToSlug(
                this.obj_them_tap.ten_tap_phim
            );
        },

        kiemTraSlug() {
            var payload = {
                slug: this.obj_update_tap_phim.slug_tap_phim,
            };
            baseRequest
                .post("admin/tap-phim/kiem-tra-slug", payload)
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
                slug: this.obj_them_tap.slug_tap_phim,
                id: this.obj_them_tap.id,
            };
            baseRequest
                .post("admin/tap-phim/kiem-tra-slug-update", payload)
                .then((res) => {
                    if (res.data.status) {
                        toaster.success(res.data.message);
                        this.is_update = 1;
                    } else {
                        toaster.error(res.data.message);
                        this.is_update = 0;
                    }
                })
                .catch((res) => {
                    var errors = Object.values(res.response.data.errors);
                    toaster.error(errors[0]);
                });
        },
        tenLimited(tenqg) {
            if (tenqg && tenqg.length > this.maxChars) {
                return tenqg.substring(0, 15) + "...";
            }
            return tenqg || ""; // Return an empty string if tenqg is undefined or null
        },
        laydataTapPhim(page, id) {
            var payload = {
                'id_phim': id
            };
            baseRequest
                .post("admin/tap-phim/lay-du-lieu?page=" + page, payload)
                .then((res) => {
                    this.list_tap_phim = res.data.tap_phim_admin.dataAdmin.data;
                    this.pagination_tap_phim = res.data.tap_phim_admin.pagination;
                    // this.list_phim = res.data.phim_admin;
                })
                .catch((res) => {
                    var errors = Object.values(res.response.data.errors);
                    toaster.error(errors[0]);
                });
        },
        laydataPhim(page) {
            baseRequest
                .get("admin/phim/lay-du-lieu-theo-tap?page=" + page)
                .then((res) => {
                    if (res.data.status == false) {
                        toaster.error(res.data.message);
                    } else {
                        this.list_phim = res.data.phim_admin.dataAdmin.data;
                        this.pagination = res.data.phim_admin.pagination;
                    }
                })
                .catch((res) => {
                    var errors = Object.values(res.response.data.errors);
                    toaster.error(errors[0]);
                });
        },
        searchPhim(page) {
            this.check_page = 1;
            baseRequest
                .post("admin/phim/thong-tin-tim-theo-tap?page=" + page, this.key_tim)
                .then((res) => {
                    this.list_phim = res.data.phim_admin.dataAdmin.data;
                    this.pagination = res.data.phim_admin.pagination;
                })
                .catch((res) => {
                    var errors = Object.values(res.response.data.errors);
                    toaster.error(errors[0]);
                });
        },
        searchTapPhim(page) {
            this.check_page = 1;
            baseRequest
                .post("admin/tap-phim/thong-tin-tim?page=" + page, this.key_tim)
                .then((res) => {
                    this.list_tap_phim = res.data.tap_phim_admin.dataAdmin.data;
                    this.pagination = res.data.tap_phim_admin.pagination;
                })
                .catch((res) => {
                    var errors = Object.values(res.response.data.errors);
                    toaster.error(errors[0]);
                });
        },
        themTapPhim() {
            baseRequest
                .post("admin/tap-phim/thong-tin-tao", this.obj_them_tap)
                .then((res) => {
                    if (res.data.status == true) {
                        toaster.success(res.data.message);
                        this.obj_them_tap = { 'id': this.obj_tap_phim.id, };
                        this.laydataTapPhim(1, this.obj_tap_phim.id);
                        this.laydataPhim(this.pagination.current_page);

                    } else {
                        toaster.error(res.data.message);
                        this.obj_them_tap = { 'id': this.obj_tap_phim.id, };
                    }
                }).catch((err) => {
                    functionBasic.displayErrors(err);
                })
        },

        delete1TapPhim() {
            baseRequest
                .delete("admin/tap-phim/thong-tin-xoa/" + this.obj_delete_1_tap.id)
                .then((res) => {
                    if (res.data.status == true) {
                        toaster.success(res.data.message);
                        this.laydataTapPhim(1, this.obj_tap_phim.id);
                        this.laydataPhim(this.pagination.current_page);
                    } else {
                        toaster.error(res.data.message);
                    }
                })
                .catch((res) => {
                    var errors = Object.values(res.response.data.errors);
                    toaster.error(errors[0]);
                });
        },
        deleteAllTapPhim() {
            baseRequest
                .delete("admin/tap-phim/thong-tin-xoa-all-tap/" + this.obj_xoa_all.id)
                .then((res) => {
                    if (res.data.status == true) {
                        toaster.success(res.data.message);
                        this.laydataTapPhim(1, this.obj_tap_phim.id);
                        this.laydataPhim(this.pagination.current_page);
                    } else {
                        toaster.error(res.data.message);
                    }
                })
                .catch((res) => {
                    var errors = Object.values(res.response.data.errors);
                    toaster.error(errors[0]);
                });
        },
        capNhapTapPhim() {
            baseRequest
                .put("admin/tap-phim/thong-tin-cap-nhat", this.obj_update_tap_phim)
                .then((res) => {
                    if (res.data.status == true) {
                        toaster.success(res.data.message);
                        this.laydataTapPhim(1, this.obj_tap_phim.id);
                        this.laydataPhim(this.pagination.current_page);


                    } else {
                        toaster.error(res.data.message);
                    }
                })
                .catch((res) => {
                    var errors = Object.values(res.response.data.errors);
                    toaster.error(errors[0]);
                });
        },

        doiTrangThaiPhim(xyz) {
            baseRequest
                .put("admin/tap-phim/thong-tin-thay-doi-trang-thai", xyz)
                .then((res) => {
                    if (res.data.status == true) {
                        toaster.success(res.data.message);
                        this.laydataTapPhim(1, this.obj_tap_phim.id);

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
<style></style>
