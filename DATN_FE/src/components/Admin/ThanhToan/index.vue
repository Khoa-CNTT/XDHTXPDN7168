<template>

    <div class="row">
        <div class="col-lg-12">
            <div class="card border-5 border-primary border-top">
                <div class="card-header d-flex justify-content-between">
                    <h5><b>DANH SÁCH THANH TOÁN</b></h5>
                    <div></div>
                </div>
                <div class="card-body">
                    <div class="table-responsive" bis_skin_checked="1">
                        <table class="table mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-center">Id</th>
                                    <th class="text-center">Mã Hóa Đơn</th>
                                    <th class="text-center">Tên Gói</th>
                                    <th class="text-center">Tên Khách Hàng</th>
                                    <th class="text-center">Tổng Tiền</th>
                                    <th class="text-center">Trạng Thái</th>
                                    <th class="text-center">Ngày Bắt Đầu</th>
                                    <th class="text-center">Ngày Kết Thúc</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="text-center">
                                    <td>
                                        <div class="d-flex align-items-center" bis_skin_checked="1">
                                            <div class="ms-2" bis_skin_checked="1">
                                                <h6 class="mb-0 font-14">1</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>HD00037</td>
                                    <td>gói 6 tháng</td>
                                    <td>Hiền Lê</td>
                                    <td>12000</td>
                                    <td><button
                                            class="badge rounded-pill text-success bg-light-success p-2 text-uppercase px-3"
                                            style="border: none;"><i class="bx bxs-circle me-1"></i>Đã Thanh
                                            Toán</button></td>
                                    <td>2024-05-23</td>
                                    <td>2024-11-23</td>
                                </tr>
                                <tr class="text-center">
                                    <td>
                                        <div class="d-flex align-items-center" bis_skin_checked="1">
                                            <div class="ms-2" bis_skin_checked="1">
                                                <h6 class="mb-0 font-14">2</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>HD00038</td>
                                    <td>gói 6 tháng</td>
                                    <td>Anh Thư</td>
                                    <td>12000</td>
                                    <td><button
                                            class="badge rounded-pill text-success bg-light-success p-2 text-uppercase px-3"
                                            style="border: none;"><i class="bx bxs-circle me-1"></i>Đã Thanh
                                            Toán</button></td>
                                    <td>2024-05-21</td>
                                    <td>2024-11-21</td>
                                </tr>
                                <tr class="text-center">
                                    <td>
                                        <div class="d-flex align-items-center" bis_skin_checked="1">
                                            <div class="ms-2" bis_skin_checked="1">
                                                <h6 class="mb-0 font-14">3</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>HD00039</td>
                                    <td>gói 6 tháng</td>
                                    <td>Hiền Lê</td>
                                    <td>12000</td>
                                    <td><button
                                            class="badge rounded-pill text-success bg-light-success p-2 text-uppercase px-3"
                                            style="border: none;"><i class="bx bxs-circle me-1"></i>Đã Thanh
                                            Toán</button></td>
                                    <td>2024-05-24</td>
                                    <td>2024-11-24</td>
                                </tr>
                                <tr class="text-center">
                                    <td>
                                        <div class="d-flex align-items-center" bis_skin_checked="1">
                                            <div class="ms-2" bis_skin_checked="1">
                                                <h6 class="mb-0 font-14">4</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>HD00041</td>
                                    <td>Gói 3 tháng</td>
                                    <td>Văn Việt</td>
                                    <td>11000</td>
                                    <td><button
                                            class="badge rounded-pill text-success bg-light-success p-2 text-uppercase px-3"
                                            style="border: none;"><i class="bx bxs-circle me-1"></i>Đã Thanh
                                            Toán</button></td>
                                    <td>2024-10-08</td>
                                    <td>2025-01-08</td>
                                </tr>
                            </tbody>
                        </table>
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
