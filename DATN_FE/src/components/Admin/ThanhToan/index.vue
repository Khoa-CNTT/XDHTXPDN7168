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
                                <template v-for="(v, k) in list_hoa_don" :key="k">
                                    <tr class="text-center">
                                        <td>
                                            <div class="d-flex align-items-center" bis_skin_checked="1">
                                                <div class="ms-2" bis_skin_checked="1">
                                                    <h6 class="mb-0 font-14">{{ k + 1 }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ v.ma_hoa_don }}</td>
                                        <td>{{ v.ten_goi }}</td>
                                        <td>{{ v.ho_va_ten }}</td>
                                        <td>{{ v.tong_tien }}</td>
                                        <td><button v-if="v.tinh_trang == 1"
                                                class="badge rounded-pill text-success bg-light-success p-2 text-uppercase px-3"
                                                style="border: none;"><i class="bx bxs-circle me-1"></i>Đã Thanh
                                                Toán</button>
                                            <button v-else
                                                class="badge rounded-pill text-warning bg-light-success p-2 text-uppercase px-3"
                                                style="border: none;"><i class="bx bxs-circle me-1"></i>Đang xử
                                                lý</button>
                                        </td>
                                        <td>{{ v.ngay_bat_dau }}</td>
                                        <td>{{ v.ngay_bat_dau }}</td>
                                    </tr>
                                </template>

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
            list_hoa_don: [],
            key_tim: {},
            obj_add_goi_vip: {},
            obj_update_goi_vip: {},
            obj_delete_goi_vip: {},
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
        this.loadDataHoaDon();
    },
    methods: {
        changPage(page) {
            if (this.check_page == 0) {
                this.loadDataHoaDon(page);
            } else if (this.check_page == 1) {
                this.searchDienVien(page);
            }
        },
        loadDataHoaDon(page) {
            baseRequest.get("admin/hoa-don/lay-du-lieu?page=" + page)
                .then((res) => {
                    this.list_hoa_don = res.data.data.dataAdmin.data;
                    this.pagination = res.data.data.pagination;
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
