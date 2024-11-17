<template>
    <div class="row">
        <div class="col-12">
            <div class="card border-5 border-primary border-top">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><b>DANH SÁCH SLIDE </b></h5>
                    <div class="d-flex gap-2">
                        <button @click="laydataPhim(1)" data-bs-toggle="modal" data-bs-target="#themSlide"
                            class="btn btn-primary btn-sm text-white px-2 py-1 rounded-pill">
                            <i class="fa-solid fa-plus me-1"></i>Thêm Slide
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th colspan="100%">
                                        <div class="input-group mb-3">
                                            <input v-on:keyup.enter="searchSlide(1)" v-model="key_tim.key" type="text"
                                                class="form-control" placeholder="Nhập thông tin cần tìm">
                                            <button class="btn btn-primary" v-on:click="searchSlide(1)">
                                                <i class="fa-solid fa-magnifying-glass"></i>
                                            </button>
                                        </div>
                                    </th>
                                </tr>
                                <tr class="text-center">
                                    <th class="text-center align-middle text-nowrap">#</th>
                                    <th class="text-center align-middle text-nowrap">Slide</th>
                                    <th class="text-center align-middle text-nowrap">Phim</th>
                                    <th class="text-center align-middle text-nowrap">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(v, k) in list_slide" :key="k">
                                    <th class=" text-center align-middle text-nowrap">{{ k + 1 }}</th>
                                    <td class="text-center align-middle text-nowrap">
                                        <img class="img-fluid" v-bind:src="v.poster_img" width="150" alt="">
                                    </td>
                                    <td class="align-middle text-nowrap">{{ v.ten_phim }}</td>
                                    <!-- <td class="text-center align-middle text-nowrap text-center">
                                        <button @click="doiTrangThai(v)" v-if="v.is_slide == 1"
                                            class="badge rounded-pill text-success bg-light-success p-2 text-uppercase px-3"
                                            style="border: none;">
                                            Đã hiển thị
                                        </button>
                                        <button @click="doiTrangThai(v)" v-if="v.is_slide == 0"
                                            class="badge rounded-pill text-secondary bg-light-secondary p-2 text-uppercase px-3"
                                            style="border: none;">
                                            Chưa hiển thị
                                        </button>
                                    </td> -->
                                    <td class="text-center align-middle text-nowrap">
                                        <i @click="Object.assign(obj_delete_slide, v)" data-bs-target="#Xoa"
                                            type="button" data-bs-toggle="modal"
                                            class="fa-solid fa-trash fa-2x text-danger"></i>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <nav aria-label="Table Paging" class="mb-0 text-headings">
                            <div class="card-footer text-end text-nowrap">
                                <button @click="changPageSlide(pagination_slide.current_page - 1)"
                                    :disabled="pagination_slide.current_page <= 1"
                                    class="btn btn-secondary btn-sm me-2">
                                    Previous
                                </button>
                                <button class="btn btn-secondary btn-sm me-2" v-for="page in pageNumbersSlide"
                                    :key="page" @click="page !== '...' && changPageSlide(page)"
                                    :class="{ active: page === pagination_slide.current_page }">
                                    {{ page }}
                                </button>
                                <button @click="changPageSlide(pagination_slide.current_page + 1)"
                                    :disabled="pagination_slide.current_page >= pagination_slide.last_page"
                                    class="btn btn-secondary btn-sm me-2">
                                    Next
                                </button>
                            </div>
                        </nav>
                    </div>

                    <!-- {{-- // modol xoa --}} -->
                    <div class="modal fade" id="Xoa" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Xoá Slide Phim <span
                                            class="text-primary">{{ obj_delete_slide.ten_phim }}</span>
                                    </h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body text-start">
                                    <div class="alert alert-danger" role="alert">
                                        Bạn có muốn xoá slide <b>{{ obj_delete_slide.ten_phim }}</b>!!!
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng
                                    </button>
                                    <button @click="deleteSlide()" type="button" class="btn btn-danger"
                                        data-bs-dismiss="modal">Vẫn
                                        Xoá</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Thêm Slide -->
                    <div class="modal fade" id="themSlide" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Thêm Slide
                                    </h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body text-start">
                                    <div class="mb-3">
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th colspan="100%">
                                                            <div class="input-group mb-3">
                                                                <input v-on:keyup.enter="searchPhim(1)"
                                                                    v-model="key_tim_phim.key" type="text"
                                                                    class="form-control"
                                                                    placeholder="Nhập thông tin cần tìm">
                                                                <button class="btn btn-primary"
                                                                    v-on:click="searchPhim(1)">
                                                                    <i class="fa-solid fa-magnifying-glass"></i>
                                                                </button>
                                                            </div>
                                                        </th>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-center align-middle text-nowrap">#</th>
                                                        <th class="text-center align-middle text-nowrap">Slide</th>
                                                        <th class="text-center align-middle text-nowrap">Phim</th>
                                                        <th class="text-center align-middle text-nowrap">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <template v-for="(v, i) in list_phim" :key="i">
                                                        <tr>
                                                            <th>{{ i + 1 }}</th>
                                                            <td class="text-center align-middle">
                                                                <img class="img-fluid" width="150" :src="v.poster_img"
                                                                    alt="">
                                                            </td>
                                                            <td class="align-middle text-nowrap">{{ v.ten_phim }}</td>
                                                            <td class="text-center align-middle">
                                                                <i type="button" @click="taoDataSlide(v)"
                                                                    class="fa-solid fa-plus fa-2x text-success"></i>
                                                            </td>
                                                        </tr>
                                                    </template>
                                                    <tr>

                                                    </tr>
                                                </tbody>
                                            </table>
                                            <nav aria-label="Table Paging" class="mb-0 text-headings">
                                                <div class="card-footer text-end text-nowrap">
                                                    <button @click="changPage(pagination.current_page - 1)"
                                                        :disabled="pagination.current_page <= 1"
                                                        class="btn btn-secondary btn-sm me-2">
                                                        Previous
                                                    </button>
                                                    <button class="btn btn-secondary btn-sm me-2"
                                                        v-for="page in pageNumbers" :key="page"
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

                                    </div>
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
import { getPageNumbers_2 } from "../../../core/paginationUtils_2";
import { createToaster } from "@meforma/vue-toaster";
import { post } from "jquery";
const toaster = createToaster({
    position: "top-right",
});
export default {
    data() {
        return {
            list_slide: [],
            list_phim: [],
            key_tim: {},
            key_tim_phim: {},
            obj_update_danh_muc: {},
            obj_delete_slide: {},
            obj_add_slide: {},
            pagination: {
                last_page: "",
                per_page: "",
                current_page: "",
                last_page: "",
                from: "",
                to: "",
            },
            pagination_slide: {
                last_page: "",
                per_page: "",
                current_page: "",
                last_page: "",
                from: "",
                to: "",
            },
            check_slide: 0,
            check_phim: 0,
        };
    },
    computed: {
        pageNumbers() {
            return getPageNumbers(this.pagination);
        },
        pageNumbersSlide() {
            return getPageNumbers_2(this.pagination_slide);
        },
    },
    mounted() {
        this.laydataSlide(1);
    },
    methods: {
        changPage(page) {
            if (this.check_phim == 0) {
                this.laydataPhim(page);
            } else if (this.check_phim == 1) {
                this.searchPhim(page);
            }
        },
        changPageSlide(page) {
            if (this.check_slide == 0) {
                this.laydataSlide(page);
            } else if (this.check_slide == 1) {
                this.searchSlide(page);
            }
        },

        laydataSlide(page) {
            baseRequest
                .get("admin/config-slide/lay-du-lieu?page=" + page)
                .then((res) => {
                    this.list_slide = res.data.slide_admin.dataAdmin.data;
                    this.pagination_slide = res.data.slide_admin.pagination;
                });
        },
        laydataPhim(page) {
            baseRequest
                .get("admin/config-slide/lay-du-lieu-open?page=" + page)
                .then((res) => {
                    this.list_phim = res.data.phim_admin.dataAdmin.data;
                    this.pagination = res.data.phim_admin.pagination;
                });
        },
        taoDataSlide(value) {
            var payload = {
                id: value.id
            };
            baseRequest
                .post(
                    "admin/config-slide/thong-tin-tao", payload
                )
                .then((res) => {
                    if (res.data.status == true) {
                        toaster.success(res.data.message);
                        this.changPage(this.pagination.current_page);
                        this.changPageSlide(this.pagination_slide.current_page);

                    } else {
                        toaster.error(res.data.message);
                    }
                })
                .catch((res) => {
                    var errors = Object.values(res.response.data.errors);
                    toaster.error(errors[0]);
                });
        },
        searchSlide(page) {
            this.check_slide = 1;
            baseRequest
                .post("admin/config-slide/thong-tin-tim?page=" + page, this.key_tim)
                .then((res) => {
                    this.list_slide = res.data.slide_admin.dataAdmin.data;
                    this.pagination_slide = res.data.slide_admin.pagination;
                });
        },
        searchPhim(page) {
            this.check_phim = 1;
            baseRequest
                .post("admin/config-slide/thong-tin-tim-open?page=" + page, this.key_tim_phim)
                .then((res) => {
                    this.list_phim = res.data.phim_admin.dataAdmin.data;
                    this.pagination = res.data.phim_admin.pagination;
                });
        },
        deleteSlide() {
            baseRequest
                .delete("admin/config-slide/thong-tin-xoa/" + this.obj_delete_slide.id)
                .then((res) => {
                    if (res.data.status == true) {
                        toaster.success(res.data.message);
                        this.changPageSlide(this.pagination_slide.current_page);
                    } else {
                        toaster.danger(res.data.message);
                    }
                });
        },


    },

};
</script>
<style lang=""></style>
