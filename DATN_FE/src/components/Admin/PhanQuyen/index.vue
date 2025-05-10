<template>
    <div class="row">
        <!-- Card Danh Sách Chức Vụ -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Danh Sách Chức Vụ</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="table-light">
                                <tr class="text-center">
                                    <th style="width: 60px">#</th>
                                    <th>Tên Chức Vụ</th>
                                    <th style="width: 120px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(v, k) in listChucVu" 
                                    :key="k" 
                                    :class="{'table-active': chucVu.id === v.id}"
                                    class="align-middle">
                                    <td class="text-center">{{ k + 1 }}</td>
                                    <td>{{ v.ten_chuc_vu }}</td>
                                    <td class="text-center">
                                        <button v-on:click="selectChucVu(v)" 
                                                class="btn btn-info btn-sm text-white">
                                            <i class='bx bx-key me-1'></i> Phân Quyền
                                        </button>
                                    </td>
                                </tr>
                                <tr v-if="listChucVu.length === 0">
                                    <td colspan="3" class="text-center">Không có dữ liệu</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card Danh Sách Chức Năng -->
        <div class="col-lg-5">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Danh Sách Chức Năng</h5>
                    <span v-if="!chucVu.id" class="text-muted">
                        <i class='bx bx-info-circle'></i> Vui lòng chọn chức vụ
                    </span>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="table-light">
                                <tr class="text-center">
                                    <th style="width: 60px">#</th>
                                    <th>Tên Chức Năng</th>
                                    <th style="width: 120px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(v, k) in availableChucNang" 
                                    :key="k" 
                                    class="align-middle">
                                    <td class="text-center">{{ k + 1 }}</td>
                                    <td>{{ v.ten_chuc_nang }}</td>
                                    <td class="text-center">
                                        <button v-on:click="createPhanQuyen(v.id)" 
                                                class="btn btn-primary btn-sm"
                                                :disabled="!chucVu.id">
                                            <i class='bx bx-plus-circle me-1'></i> Cấp Quyền
                                        </button>
                                    </td>
                                </tr>
                                <tr v-if="listChucNang.length === 0">
                                    <td colspan="3" class="text-center">Không có dữ liệu</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card Quyền Đã Cấp -->
        <div class="col-lg-3">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        Quyền Đã Cấp
                        <small class="d-block text-danger mt-1">
                            {{ chucVu.ten_chuc_vu || 'Chưa chọn chức vụ' }}
                        </small>
                    </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="table-light">
                                <tr class="text-center">
                                    <th style="width: 60px">#</th>
                                    <th>Tên Quyền</th>
                                    <th style="width: 80px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(v, k) in phan_quyen" 
                                    :key="k" 
                                    class="align-middle">
                                    <td class="text-center">{{ k + 1 }}</td>
                                    <td>{{ v.ten_chuc_nang }}</td>
                                    <td class="text-center">
                                        <button class="btn btn-danger btn-sm" 
                                                v-on:click="xoaPhanQuyen(v)">
                                            <i class='bx bx-trash'></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr v-if="phan_quyen.length === 0">
                                    <td colspan="3" class="text-center">
                                        {{ chucVu.id ? 'Chưa có quyền nào được cấp' : 'Vui lòng chọn chức vụ' }}
                                    </td>
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
import axios from 'axios';
import baseRequest from '../../../core/baseRequest';
import { createToaster } from "@meforma/vue-toaster";
const toaster = createToaster({ position: "top-right" });

export default {
    data() {
        return {
            listChucNang: [],
            listChucVu: [],
            chucVu: {},
            phan_quyen: [],
        }
    },
    computed: {
        // Lọc ra các chức năng chưa được cấp quyền
        availableChucNang() {
            if (!this.chucVu.id) return this.listChucNang;
            return this.listChucNang.filter(cn => 
                !this.phan_quyen.some(pq => pq.id_chuc_nang === cn.id)
            );
        }
    },
    mounted() {
        this.getData();
    },
    methods: {
        getData() {
            baseRequest.get('admin/phan-quyen/lay-du-lieu')
                .then((res) => {
                    this.listChucNang = res.data.listChucNang;
                    this.listChucVu = res.data.listChucVu;
                })
                .catch((error) => {
                    toaster.error('Không thể tải dữ liệu');
                });
        },

        selectChucVu(chucVu) {
            this.chucVu = chucVu;
            this.getChucNang();
        },

        createPhanQuyen(id) {
            if (!this.chucVu.id) {
                toaster.error('Vui lòng chọn chức vụ trước');
                return;
            }

            const payload = {
                'id_chuc_nang': id,
                'id_chuc_vu': this.chucVu.id,
            };

            baseRequest.post('admin/phan-quyen/create', payload)
                .then((res) => {
                    if (res.data.status) {
                        toaster.success(res.data.message);
                        this.getChucNang();
                    } else {
                        toaster.error(res.data.message);
                    }
                })
                .catch((error) => {
                    const message = error.response?.data?.errors 
                        ? Object.values(error.response.data.errors)[0]
                        : 'Có lỗi xảy ra';
                    toaster.error(message);
                });
        },

        getChucNang() {
            if (!this.chucVu.id) return;

            baseRequest.post('admin/phan-quyen/get-chuc-nang', this.chucVu)
                .then((res) => {
                    this.phan_quyen = res.data.data;
                })
                .catch((error) => {
                    const message = error.response?.data?.errors 
                        ? Object.values(error.response.data.errors)[0]
                        : 'Có lỗi xảy ra';
                    toaster.error(message);
                });
        },

        xoaPhanQuyen(value) {
            baseRequest.delete('admin/phan-quyen/xoa-phan-quyen/' + value.id)
                .then((res) => {
                    if (res.data.status) {
                        toaster.success(res.data.message);
                        this.getChucNang();
                    } else {
                        toaster.error(res.data.message);
                    }
                })
                .catch((error) => {
                    const message = error.response?.data?.errors 
                        ? Object.values(error.response.data.errors)[0]
                        : 'Có lỗi xảy ra';
                    toaster.error(message);
                });
        },
    },
}
</script>

<style scoped>
.table-active {
    background-color: rgba(0,123,255,0.1) !important;
}

.card {
    margin-bottom: 1rem;
}

.btn-sm {
    padding: 0.25rem 0.5rem;
}

.table td, .table th {
    padding: 0.75rem;
}
</style>
