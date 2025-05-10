<template>

    <div class="row">
        <div class="col-lg-12">
            <div class="card border-5 border-primary border-top">
                <div class="card-header d-flex justify-content-between">
                    <h5><b>DANH SÁCH THANH TOÁN</b></h5>
                    <div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="search-filters mb-4">
                        <div class="row g-3">
                            <!-- Tìm kiếm -->
                            <div class="col-md-3">
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-search"></i>
                                    </span>
                                    <input type="text" class="form-control" v-model="filters.search"
                                        @input="handleSearch" placeholder="Tìm theo mã HD, tên KH...">
                                </div>
                            </div>

                            <!-- Loại thanh toán -->
                            <div class="col-md-2">
                                <select class="form-select" v-model="filters.loai_thanh_toan" @change="handleFilter">
                                    <option value="">Tất cả phương thức</option>
                                    <option value="vnpay">VNPay</option>
                                    <option value="momo">Momo</option>
                                    <option value="mbbank">Mbbank</option>
                                </select>
                            </div>

                            <!-- Trạng thái -->
                            <div class="col-md-2">
                                <select class="form-select" v-model="filters.tinh_trang" @change="handleFilter">
                                    <option value="">Tất cả trạng thái</option>
                                    <option value="1">Đã thanh toán</option>
                                    <option value="0">Chưa thanh toán</option>
                                </select>
                            </div>

                            <!-- Loại gói -->
                            <div class="col-md-2">
                                <select class="form-select" v-model="filters.id_goi" @change="handleFilter">
                                    <option value="">Tất cả gói</option>
                                    <option v-for="goi in listGoi" :key="goi.id" :value="goi.id">
                                        {{ goi.ten_goi }}
                                    </option>
                                </select>
                            </div>

                            <!-- Thời gian -->
                            <div class="col-md-2">
                                <select class="form-select" v-model="filters.time_range" @change="handleFilter">
                                    <option value="">Tất cả thời gian</option>
                                    <option value="today">Hôm nay</option>
                                    <option value="week">Tuần này</option>
                                    <option value="month">Tháng này</option>
                                    <option value="custom">Tùy chỉnh</option>
                                </select>
                            </div>

                            <!-- Reset filters -->
                            <div class="col-auto">
                                <button class="btn btn-secondary" @click="resetFilters">
                                    <i class="fas fa-redo-alt me-1"></i> Đặt lại
                                </button>
                            </div>
                        </div>

                        <!-- Custom date range (hiển thị khi chọn tùy chỉnh) -->
                        <div class="row mt-3" v-if="filters.time_range === 'custom'">
                            <div class="col-md-3">
                                <div class="input-group">
                                    <span class="input-group-text">Từ</span>
                                    <input type="date" class="form-control" v-model="filters.date_from"
                                        @change="handleFilter">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="input-group">
                                    <span class="input-group-text">Đến</span>
                                    <input type="date" class="form-control" v-model="filters.date_to"
                                        @change="handleFilter">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive" bis_skin_checked="1">
                        <table class="table mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-center">Id</th>
                                    <th class="text-center">Mã Hóa Đơn</th>
                                    <th class="text-center">Tên Gói</th>
                                    <th class="text-center">Tên Khách Hàng</th>
                                    <th class="text-center">Tổng Tiền</th>
                                    <th class="text-center">Loại Thanh Toán</th>
                                    <th class="text-center">Trạng Thái</th>
                                    <th class="text-center">Ngày Thanh toán</th>
                                    <th class="text-center">Chi tiết</th>
                                </tr>
                            </thead>
                            <tbody>
                                <template v-for="(v, k) in list_hoa_don" :key="k">
                                    <tr class="text-center">
                                        <td>
                                            {{ k + 1 }}
                                        </td>
                                        <td>{{ v.ma_hoa_don }}</td>
                                        <td>{{ v.ten_goi }}</td>
                                        <td>{{ v.ho_va_ten }}</td>
                                        <td>{{ v.tong_tien }}</td>
                                        <td>{{ v.loai_thanh_toan == null ? "Mb bank" : v.loai_thanh_toan }}</td>
                                        <td><button v-if="v.tinh_trang == 1"
                                                class="badge rounded-pill text-success bg-light-success p-2 text-uppercase px-3"
                                                style="border: none;"><i class="bx bxs-circle me-1"></i>Đã Thanh
                                                Toán</button>
                                            <button v-else
                                                class="badge rounded-pill text-warning bg-light-success p-2 text-uppercase px-3"
                                                style="border: none;"><i class="bx bxs-circle me-1"></i>Đang xử
                                                lý</button>
                                        </td>
                                        <td>{{ convertDate(v.created_at) }}</td>
                                        <td><button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#modalChiTiet" @click="showChiTiet(v)">Chi
                                                tiết</button></td>
                                    </tr>
                                </template>

                            </tbody>
                        </table>
                        <div class="modal fade" id="modalChiTiet" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header ">
                                        <h5 class="modal-title " id="exampleModalLabel">
                                            CHI TIẾT THANH TOÁN
                                        </h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <table class="table table-bordered">
                                                    <tbody>
                                                        <tr>
                                                            <th class="bg-light" width="40%">Mã Hóa Đơn</th>
                                                            <td>{{ obj_edit.ma_hoa_don }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="bg-light">Khách Hàng</th>
                                                            <td>{{ obj_edit.ho_va_ten }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="bg-light">Gói Đăng Ký</th>
                                                            <td>{{ obj_edit.ten_goi }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="bg-light">Tổng Tiền</th>
                                                            <td class="text-danger fw-bold">{{
                                                                formatCurrency(obj_edit.tong_tien) }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="bg-light">Đã Thanh Toán</th>
                                                            <td class="text-success fw-bold">{{
                                                                formatCurrency(obj_edit.so_tien_da_thanh_toan)
                                                            }}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="col-md-6">
                                                <table class="table table-bordered">
                                                    <tbody>
                                                        <tr>
                                                            <th class="bg-light" width="40%">Thời Hạn</th>
                                                            <td>
                                                                {{ formatDate(obj_edit.ngay_bat_dau) }} - {{
                                                                    formatDate(obj_edit.ngay_ket_thuc)
                                                                }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th class="bg-light">Phương Thức</th>
                                                            <td>
                                                                <span class="badge"
                                                                    :class="getPaymentBadgeClass(obj_edit.loai_thanh_toan)">
                                                                    {{ getPaymentMethod(obj_edit.loai_thanh_toan) == ""
                                                                        ? "Mb bank" :
                                                                        getPaymentMethod(obj_edit.loai_thanh_toan) }}
                                                                </span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th class="bg-light">Mã Giao Dịch</th>
                                                            <td>{{ obj_edit.transactionNo || 'N/A' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="bg-light">Trạng Thái</th>
                                                            <td>
                                                                <span class="badge"
                                                                    :class="getStatusBadgeClass(obj_edit.tinh_trang)">
                                                                    {{ getStatus(obj_edit.tinh_trang) }}
                                                                </span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th class="bg-light">OrderInfo</th>
                                                            <td>{{ obj_edit.orderInfo || 'N/A' }}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Đóng</button>
                                    </div>
                                </div>
                            </div>
                        </div>
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
            hoa_don: {},
            obj_edit: {},
            filters: {
                search: '',
                loai_thanh_toan: '',
                tinh_trang: '',
                id_goi: '',
                time_range: '',
                date_from: '',
                date_to: ''
            },
            searchTimeout: null,
            listGoi: [],
        };
    },
    computed: {
        pageNumbers() {
            return getPageNumbers(this.pagination);
        },
    },
    mounted() {
        this.loadData({}, 1);
        this.loadGoiThanhToan();
    },
    methods: {
        convertDate(date) {
            return new Date(date).toLocaleDateString('vi-VN');
        },
        changPage(page) {
            let params = {
                search: this.filters.search || '',
                loai_thanh_toan: this.filters.loai_thanh_toan || '',
                tinh_trang: this.filters.tinh_trang || '',
                id_goi: this.filters.id_goi || '',
            };

            if (this.filters.date_from && this.filters.date_to) {
                params.date_from = this.filters.date_from;
                params.date_to = this.filters.date_to;
            }

            this.loadData(params, page);
        },
        loadData(params, page) {
            let url = 'admin/hoa-don/thong-tin-tim-kiem?page=' + page;
            
            // Thêm các params vào URL
            if (params.search) url += '&search=' + params.search;
            if (params.loai_thanh_toan) url += '&loai_thanh_toan=' + params.loai_thanh_toan;
            if (params.tinh_trang) url += '&tinh_trang=' + params.tinh_trang;
            if (params.id_goi) url += '&id_goi=' + params.id_goi;
            if (params.date_from) url += '&date_from=' + params.date_from;
            if (params.date_to) url += '&date_to=' + params.date_to;

            baseRequest.get(url)
                .then((res) => {
                    if (res.data.status) {
                        this.list_hoa_don = res.data.data.dataAdmin.data;
                        this.pagination = res.data.data.pagination;
                    } else {
                        toaster.error(res.data.message || 'Có lỗi xảy ra');
                    }
                })
                .catch((res) => {
                    var errors = Object.values(res.response.data.errors);
                    toaster.error(errors[0]);
                });
        },
        showChiTiet(value) {
            baseRequest.get("admin/hoa-don/thong-tin-chi-tiet/" + value.id)
                .then((res) => {
                    this.obj_edit = res.data.data;
                });
        },
        formatCurrency(value) {
            return new Intl.NumberFormat('vi-VN', {
                style: 'currency',
                currency: 'VND'
            }).format(value);
        },
        formatDate(date) {
            return new Date(date).toLocaleDateString('vi-VN');
        },
        getPaymentMethod(type) {
            const methods = {
                'vnpay': 'VNPay',
                'momo': 'Momo',
                'mbbank': 'Mbbank'
            };
            return methods[type] || type;
        },
        getPaymentBadgeClass(type) {
            const classes = {
                'vnpay': 'bg-primary',
                'momo': 'bg-danger',
                'mbbank': 'bg-info'
            };
            return classes[type] || 'bg-secondary';
        },
        getStatus(status) {
            const statuses = {
                0: 'Chưa thanh toán',
                1: 'Đã thanh toán',
            };
            return statuses[status] || 'Không xác định';
        },
        getStatusBadgeClass(status) {
            const classes = {
                0: 'bg-warning',
                1: 'bg-success',
            };
            return classes[status] || 'bg-secondary';
        },
        async loadGoiThanhToan() {
            try {
                const response = await baseRequest.get('lay-data-goi-vip-open');
                if (response.data.status) {
                    this.listGoi = response.data.data;
                }
            } catch (error) {
                console.error('Error loading goi thanh toan:', error);
                toaster.error('Không thể tải danh sách gói');
            }
        },
        handleSearch() {
            if (this.searchTimeout) clearTimeout(this.searchTimeout);
            this.searchTimeout = setTimeout(() => {
                this.handleFilter();
            }, 300);
        },
        handleFilter() {
            let params = {
                search: this.filters.search || '',
                loai_thanh_toan: this.filters.loai_thanh_toan || '',
                tinh_trang: this.filters.tinh_trang || '',
                id_goi: this.filters.id_goi || '',
            };

            // Xử lý thời gian
            if (this.filters.time_range) {
                const today = new Date();
                switch (this.filters.time_range) {
                    case 'today':
                        params.date_from = today.toISOString().split('T')[0];
                        params.date_to = today.toISOString().split('T')[0];
                        break;
                    case 'week':
                        const firstDayOfWeek = new Date(today);
                        firstDayOfWeek.setDate(today.getDate() - today.getDay());
                        params.date_from = firstDayOfWeek.toISOString().split('T')[0];
                        params.date_to = today.toISOString().split('T')[0];
                        break;
                    case 'month':
                        const firstDayOfMonth = new Date(today.getFullYear(), today.getMonth(), 1);
                        params.date_from = firstDayOfMonth.toISOString().split('T')[0];
                        params.date_to = today.toISOString().split('T')[0];
                        break;
                    case 'custom':
                        if (this.filters.date_from && this.filters.date_to) {
                            params.date_from = this.filters.date_from;
                            params.date_to = this.filters.date_to;
                        }
                        break;
                }
            }

            this.loadData(params, 1);
        },
        resetFilters() {
            this.filters = {
                search: '',
                loai_thanh_toan: '',
                tinh_trang: '',
                id_goi: '',
                time_range: '',
                date_from: '',
                date_to: ''
            };
            this.loadData({}, 1);
        },
    },
};
</script>
<style lang=""></style>
