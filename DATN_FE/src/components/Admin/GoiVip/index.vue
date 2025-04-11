<template>
    <div class="modal fade" id="themMoiModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Thêm Gói Vip</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3 mt-1">
                        <label for="" class="form-label mb-1 mt-1">
                            <b>Tên Gói Vip</b>
                        </label>
                        <input v-model="obj_add_goi_vip.ten_goi" v-on:keyup="addSlug()" v-on:change="kiemTraSlug()"
                            type="text" class="form-control" placeholder="nhập gói vip..." />
                    </div>
                    <div class="mb-3 mt-1">
                        <label for="" class="form-label mb-1 mt-1">
                            <b>Thời hạn (Tính theo tháng)</b>
                        </label>
                        <input v-model="obj_add_goi_vip.thoi_han" type="number" class="form-control"
                            placeholder="nhập thời hạn..." />
                    </div>
                    <div class="mb-3 mt-1">
                        <label for="" class="form-label mb-1 mt-1">
                            <b>Tiền gốc</b>
                        </label>
                        <input v-model="obj_add_goi_vip.tien_goc" type="number" class="form-control"
                            placeholder="nhập giá gốc ..." />
                    </div>
                    <div class="mb-3 mt-1">
                        <label for="" class="form-label mb-1 mt-1">
                            <b>Tiền Sale</b>
                        </label>
                        <input v-model="obj_add_goi_vip.tien_sale" type="number" class="form-control"
                            placeholder="nhập giá sale ..." />
                    </div>
                    <div class="mb-3">
                        <label class="form-label mb-1 mt-1">
                            <b>Tình Trạng</b>
                        </label>
                        <select v-model="obj_add_goi_vip.tinh_trang" name="" id="" class="form-control">
                            <option value="0">Tạm Dừng</option>
                            <option value="1">Hoạt động</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Thoát
                    </button>
                    <button v-on:click="taodataGoiVip()" class="btn btn-primary" data-bs-dismiss="modal">
                        Thêm Mới
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card border-5 border-primary border-top">
                <div class="card-header d-flex justify-content-between">
                    <h5><b>DANH SÁCH GÓI VIP</b></h5>
                    <div></div>
                    <button class="btn btn-outline-primary px-4 py-0" data-bs-toggle="modal"
                        data-bs-target="#themMoiModal">
                        <b>Thêm Mới</b>
                    </button>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th colspan="100%">
                                    <div class="input-group mb-3">
                                        <input v-on:keyup.enter="searchGoiVip()" v-model="key_tim.key" type="text"
                                            class="form-control" placeholder="Nhập thông tin cần tìm" />
                                        <button class="btn btn-primary" v-on:click="searchGoiVip()">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                        </button>
                                    </div>
                                </th>
                            </tr>
                            <tr class="text-center">
                                <th class="text-center align-middle text-nowrap">#</th>
                                <th class="text-center align-middle text-nowrap">
                                    Tên gói
                                </th>
                                <th class="text-center align-middle text-nowrap">
                                    Thời hạn
                                </th>
                                <th class="text-center align-middle text-nowrap">
                                    Tiền gốc
                                </th>
                                <th class="text-center align-middle text-nowrap">
                                    Tiền sale
                                </th>
                                <th class="text-center align-middle text-nowrap">Tình Trạng</th>
                                <th class="text-center align-middle text-nowrap">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(v, k) in list_goi_vip" class="text-center" :key="k">
                                <td class="text-center align-middle text-nowrap">
                                    {{ k + 1 }}
                                </td>
                                <td class="text-center align-middle text-nowrap">
                                    {{ v.ten_goi }}
                                </td>
                                <td class="text-center align-middle text-nowrap">
                                    {{ v.thoi_han }} tháng
                                </td>
                                <td class="text-center align-middle text-nowrap">
                                    {{ convertToVnd(v.tien_goc) }}
                                </td>
                                <td class="text-center align-middle text-nowrap">
                                    {{ convertToVnd(v.tien_sale) }}
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
                                        Tạm Dừng
                                    </button>
                                </td>
                                <td class="text-center align-middle text-nowrap">
                                    <button @click="Object.assign(obj_update_goi_vip, v)" type="button"
                                        class="btn btn-success me-1" data-bs-toggle="modal" data-bs-target="#Chinhsua">
                                        Chỉnh Sửa
                                    </button>

                                    <button @click="Object.assign(obj_delete_goi_vip, v)" data-bs-target="#Xoa"
                                        data-bs-toggle="modal" class="btn btn-danger">
                                        Xoá
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="modal fade" id="Chinhsua" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title fs-5" id="exampleModalLabel">
                                        <b>CHỈNH Sửa GÓI VIP</b>
                                    </h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3 mt-1">
                                        <label for="" class="form-label mb-1 mt-1">
                                            <b>Tên Gói Vip</b>
                                        </label>
                                        <input v-model="obj_update_goi_vip.ten_goi" v-on:keyup="addSlugUpdate()"
                                            v-on:change="kiemTraSlugUpdate()" type="text" class="form-control"
                                            placeholder="nhập gói vip..." />
                                    </div>
                                    <div class="mb-3 mt-1">
                                        <label for="" class="form-label mb-1 mt-1">
                                            <b>Thời hạn (Tính theo tháng)</b>
                                        </label>
                                        <input v-model="obj_update_goi_vip.thoi_han" type="number" class="form-control"
                                            placeholder="nhập thời hạn..." />
                                    </div>
                                    <div class="mb-3 mt-1">
                                        <label for="" class="form-label mb-1 mt-1">
                                            <b>Tiền gốc</b>
                                        </label>
                                        <input v-model="obj_update_goi_vip.tien_goc" type="number" class="form-control"
                                            placeholder="nhập giá gốc ..." />
                                    </div>
                                    <div class="mb-3 mt-1">
                                        <label for="" class="form-label mb-1 mt-1">
                                            <b>Tiền Sale</b>
                                        </label>
                                        <input v-model="obj_update_goi_vip.tien_sale" type="number" class="form-control"
                                            placeholder="nhập giá sale ..." />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label mb-1 mt-1">
                                            <b>Tình Trạng</b>
                                        </label>
                                        <select v-model="obj_update_goi_vip.tinh_trang" name="" id=""
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
                                    <button @click="updateGoiVip()" type="button" class="btn btn-success"
                                        data-bs-dismiss="modal">
                                        Xong
                                    </button>
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
                                        Bạn muốn xoá gói vip phim
                                        <b>{{ obj_delete_goi_vip.ten_goi }}</b> !!!
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">
                                        Đóng
                                    </button>
                                    <button @click="deleteGoiVip()" type="button" data-bs-dismiss="modal"
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
import { createToaster } from "@meforma/vue-toaster";
const toaster = createToaster({
    position: "top-right",
});
export default {
    data() {
        return {
            is_create: 0,
            list_goi_vip: [],
            key_tim: {},
            obj_add_goi_vip: {},
            obj_update_goi_vip: {},
            obj_delete_goi_vip: {},
        };
    },
    mounted() {
        this.loaddataGoiVip();
    },
    methods: {
        convertToVnd(money) {
            return money.toLocaleString('en-US', { style: 'currency', currency: 'VND' });
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
            this.obj_add_goi_vip.slug_goi_vip = this.convertToSlug(
                this.obj_add_goi_vip.ten_goi
            );
        },

        addSlugUpdate() {
            this.obj_update_goi_vip.slug_goi_vip = this.convertToSlug(
                this.obj_update_goi_vip.ten_goi
            );
        },

        kiemTraSlug() {
            var payload = {
                slug: this.obj_add_goi_vip.slug_goi_vip,
            };
            baseRequest.post("admin/goi-vip/kiem-tra-slug", payload).then((res) => {
                if (res.data.status) {
                    toaster.success(res.data.message);
                    this.is_create = 1;
                } else {
                    toaster.error(res.data.message);
                    this.is_create = 0;
                }
            })
                .catch((res) => {
                    var errors = Object.values(res.response.data.errors);
                    toaster.error(errors[0]);
                });
        },

        kiemTraSlugUpdate() {
            var payload = {
                slug: this.obj_update_goi_vip.slug_goi_vip,
                id: this.obj_update_goi_vip.id,
            };
            baseRequest
                .post("admin/goi-vip/kiem-tra-slug-update", payload)
                .then((res) => {
                    if (res.data.status) {
                        toaster.success(res.data.message);
                    } else {
                        toaster.error(res.data.message);
                    }
                })
                .catch((res) => {
                    var errors = Object.values(res.response.data.errors);
                    toaster.error(errors[0]);
                });
        },
        loaddataGoiVip() {
            baseRequest.get("admin/goi-vip/lay-du-lieu").then((res) => {
                this.list_goi_vip = res.data.goi_vips.dataAdmin.data;
                this.pagination = res.data.goi_vips.pagination;
            })
                .catch((res) => {
                    var errors = Object.values(res.response.data.errors);
                    toaster.error(errors[0]);
                });
        },
        taodataGoiVip() {
            baseRequest
                .post("admin/goi-vip/thong-tin-tao", this.obj_add_goi_vip)
                .then((res) => {
                    if (res.data.status == true) {
                        this.obj_add_goi_vip = {};
                        this.is_create = 0;
                        toaster.success(res.data.message);
                        this.loaddataGoiVip();
                    } else {
                        toaster.error(res.data.message);
                    }
                })
                .catch((res) => {
                    var errors = Object.values(res.response.data.errors);
                    toaster.error(errors[0]);
                });
        },
        searchGoiVip() {
            baseRequest
                .post("admin/goi-vip/thong-tin-tim", this.key_tim)
                .then((res) => {
                    this.list_goi_vip = res.data.goi_vips.dataAdmin.data;
                    this.pagination = res.data.goi_vips.pagination;
                })
                .catch((res) => {
                    var errors = Object.values(res.response.data.errors);
                    toaster.error(errors[0]);
                });
        },
        deleteGoiVip() {
            baseRequest
                .delete("admin/goi-vip/thong-tin-xoa/" + this.obj_delete_goi_vip.id)
                .then((res) => {
                    if (res.data.status == true) {
                        toaster.success("Thông báo<br>" + res.data.message);
                        this.loaddataGoiVip();
                    } else {
                        toaster.danger("Thông báo<br>" + res.data.message);
                    }
                })
                .catch((res) => {
                    var errors = Object.values(res.response.data.errors);
                    toaster.error(errors[0]);
                });
        },
        updateGoiVip() {
            baseRequest
                .put("admin/goi-vip/thong-tin-cap-nhat", this.obj_update_goi_vip)
                .then((res) => {
                    if (res.data.status == true) {
                        toaster.success("Thông báo<br>" + res.data.message);
                        this.loaddataGoiVip();
                    } else {
                        toaster.danger("Thông báo<br>" + res.data.message);
                    }
                })
                .catch((res) => {
                    var errors = Object.values(res.response.data.errors);
                    toaster.error(errors[0]);
                });
        },

        doiTrangThai(xyz) {
            baseRequest
                .put("admin/goi-vip/thong-tin-thay-doi-trang-thai", xyz)
                .then((res) => {
                    if (res.data.status == true) {
                        toaster.success("Thông báo<br>" + res.data.message);
                        this.loaddataGoiVip();
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
