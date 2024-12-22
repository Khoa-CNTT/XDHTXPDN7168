<template>
    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-6">
                            Danh Sách Chức Vụ
                        </div>
                        <!-- <div class="col-lg-6 text-end">
                            <button class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#themMoiModal">Thêm Quyền</button>
                        </div> -->
                        <div class="modal fade" id="themMoiModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Thêm Mới Quyền</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="col-12 mb-2">
                                            <label class="form-label">Tên Quyền</label>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Tạo Mới</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="text-center align-middle">
                                <tr>
                                    <th>#</th>
                                    <th>Tên Chức Vụ</th>
                                    <th>Action</th>
                                    <!-- <th>Action</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(v, k) in listChucVu" class="align-middle" :key="k">
                                    <th class="text-center">{{ k + 1 }}</th>
                                    <td> {{ v.ten_chuc_vu }}</td>
                                    <td class="text-center">
                                        <button v-on:click="chucVu = v; getChucNang()" class="btn btn-info text-white">Phân Quyền</button>
                                    </td>
                                    <!-- <td class="text-center">
                                        <i class="fa-solid fa-square-pen fa-3x text-primary me-2" data-bs-toggle="modal"
                                            data-bs-target="#updateModal"></i>
                                        <i class="fa-solid fa-trash fa-3x text-danger" data-bs-toggle="modal"
                                            data-bs-target="#xoaModal"></i>
                                    </td> -->
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Cập Nhật Quyền</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="col-12 mb-2">
                                        <label class="form-label">Tên Quyền</label>
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Xác Nhận</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="xoaModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Xóa Quyền</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div
                                        class="alert alert-warning border-0 bg-warning alert-dismissible fade show py-2">
                                        <div class="d-flex align-items-center">
                                            <div class="font-35 text-dark"><i class="bx bx-info-circle"></i>
                                            </div>
                                            <div class="ms-3">
                                                <h6 class="mb-0 text-dark">Warning</h6>
                                                <div class="text-dark">
                                                    <p>Bạn có muốn xóa quyền <b>xxx</b> này không?
                                                    </p>
                                                    <p>
                                                        <b>Lưu ý:</b> Điều này không thể hoàn tác!
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" >Xóa</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-5">
            <div class="card">
                <div class="card-header">
                    Danh Sách Chức Năng
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr class="text-center text-nowrap align-middle">
                                        <th>#</th>
                                        <th>Tên Chức Năng</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(v, k) in listChucNang" class="align-middle" :key="k">
                                        <th class="text-center">{{ k + 1 }}</th>
                                        <td> {{ v.ten_chuc_nang }}</td>
                                        <td class="text-center">
                                            <button v-on:click="createPhanQuyen(v.id)" class="btn btn-primary">Cấp Quyền</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="card">
                <div class="card-header">
                    Đang Phân Quyền Cho <b class="text-danger"> {{ chucVu.ten_chuc_vu }}</b>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr class="text-center text-nowrap align-middle">
                                        <th>#</th>
                                        <th>Tên Quyền</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(v, k) in phan_quyen" class="align-middle" :key="k">
                                        <th class="text-center">{{ k + 1 }}</th>
                                        <td>{{ v.ten_chuc_nang }}</td>
                                        <td class="text-center">
                                            <button class="btn btn-danger" v-on:click="xoaPhanQuyen(v)">Xoá</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
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
import functionBasic from "../../../core/functionBasic";
const toaster = createToaster({ position: "top-right" });
export default {
    data() {
        return {
            listChucNang    :   [],
            listChucVu      :   [],
            chucVu          :   {},
            phan_quyen      :   [],
        }
    },
    mounted() {
        this.getData();
    },
    methods: {
        getData() {
            baseRequest
                .get('admin/phan-quyen/lay-du-lieu')
                .then((res) => {
                    this.listChucNang   = res.data.listChucNang;
                    this.listChucVu     = res.data.listChucVu;
                });
        },
        createPhanQuyen(id) {
            const payload = {
                'id_chuc_nang'  :   id,
                'id_chuc_vu'    :   this.chucVu.id,
            };
            baseRequest
                .post('admin/phan-quyen/create', payload)
                .then((res) => {
                    if(res.data.status) {

                        toaster.success('Thông báo<br>' + res.data.message);
                        this.getChucNang();
                    } else {
                        toaster.error('Có Lỗi<br>' + res.data.message);
                    }
                })
                .catch((res) => {
                    var errors = Object.values(res.response.data.errors);
                    errors.forEach(function(v, k) {
                        toaster.error('Có Lỗi<br>' + v[0]);
                    });
                });
        },
        getChucNang() {
            baseRequest
                .post('admin/phan-quyen/get-chuc-nang', this.chucVu)
                .then((res) => {
                    this.phan_quyen = res.data.data;
                })
                .catch((res) => {
                    var errors = Object.values(res.response.data.errors);
                    errors.forEach(function(v, k) {
                        toaster.error('Có Lỗi<br>' + v[0]);
                    });
                });
        },

        xoaPhanQuyen(value) {
            baseRequest
                .delete('admin/phan-quyen/xoa-phan-quyen/' + value.id)
                .then((res) => {
                    if(res.data.status) {
                        toaster.success('Thông báo<br>' + res.data.message);
                        this.getChucNang();
                    } else {
                        toaster.error('Có Lỗi<br>' + res.data.message);
                    }
                })
                .catch((res) => {
                    var errors = Object.values(res.response.data.errors);
                    errors.forEach(function(v, k) {
                        toaster.error('Có Lỗi<br>' + v[0]);
                    });
                });
        },

    },
}
</script>
<style>

</style>
