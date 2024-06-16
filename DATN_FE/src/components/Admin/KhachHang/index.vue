<template>
    <div class="row mb-3">
        <div class="col-12 text-end">
            <button class="btn btn-outline-primary px-5 radius-30" data-bs-toggle="modal"
                data-bs-target="#themMoiModal">
                <b>Thêm Mới</b>
            </button>
        </div>
    </div>
    <div class="modal fade" id="themMoiModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Thêm Mới Khách Hàng </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="row">
                            <div class="col-12">
                                <label for="inputFirstName" class="form-label">Họ Và Tên</label>
                                <input type="text" v-model="obj_add_user.ho_va_ten" class="form-control"
                                    id="inputFirstName" placeholder="Họ Và Tên">
                            </div>

                            <div class="col-12">
                                <label for="inputEmailAddress" class="form-label">Email</label>
                                <input type="email" v-model="obj_add_user.email" class="form-control"
                                    id="inputEmailAddress" placeholder="example@user.com">
                            </div>
                            <div class="col-12">
                                <label for="inputChoosePassword" class="form-label">Password</label>
                                <input type="Password" v-model="obj_add_user.password" class="form-control" id=""
                                    placeholder="Password">
                            </div>
                            <div class="col-12">
                                <label for="inputChoosePassword" class="form-label">Ngày sinh</label>
                                <input type="date" v-model="obj_add_user.ngay_sinh" class="form-control" id=""
                                    placeholder="Password">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Thoát</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal"
                        v-on:click="taoDataAdmin()">Thêm
                        Mới</button>
                </div>
            </div>
        </div>
    </div>
    <div class="row">

        <div class="col-12">
            <div class="card border-5 border-primary border-top">
                <div class="card-header">
                    <b>DANH SÁCH KHÁCH HÀNG </b>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered  ">
                            <thead>
                                <tr>
                                    <th colspan="100%">
                                        <div class="input-group mb-3">
                                            <input v-on:keyup.enter="searchAdmin(1)" v-model="key_tim.key" type="text"
                                                class="form-control" placeholder="Nhập thông tin cần tìm">
                                            <button class="btn btn-primary" v-on:click="searchAdmin(1)">
                                                <i class="fa-solid fa-magnifying-glass"></i>
                                            </button>
                                        </div>
                                    </th>
                                </tr>
                                <tr class="text-center">
                                    <th>#</th>
                                    <th class="text-center align-middle text-nowrap">Họ Và Tên</th>
                                    <th class="text-center align-middle text-nowrap">Email</th>
                                    <th class="text-center align-middle text-nowrap">Ảnh Đại Diện</th>
                                    <th class="text-center align-middle text-nowrap">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(v, k) in list_khach_khach" class="text-center" :key="k">
                                    <td class="text-center align-middle text-nowrap">{{ k + 1 }}</td>
                                    <td class="text-center align-middle text-nowrap">{{ v.ho_va_ten }}</td>
                                    <td class="text-center align-middle text-nowrap">{{ v.email }}</td>
                                    <td class="text-center align-middle text-nowrap">
                                        <img v-bind:src="v.hinh_anh" class="img-fluid" style="width: 70px; height: auto;"
                                            alt="">
                                    </td>


                                    <td class="text-center align-middle text-nowrap">
                                        <button @click="Object.assign(obj_update_admin, v)" type="button"
                                            class="btn btn-warning me-1" data-bs-toggle="modal" data-bs-target="#Chinhsua">
                                            Chỉnh Sữa
                                        </button>

                                        <button @click="Object.assign(obj_delete_admin, v)" data-bs-target="#Xoa"
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
                        <div class="modal-dialog ">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Chỉnh Sữa Khách Hàng Admin</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="row">
                                            <div class="col-12">
                                                <label for="inputFirstName" class="form-label">Họ Và Tên</label>
                                                <input type="text" v-model="obj_update_admin.ho_va_ten"
                                                    class="form-control" id="inputFirstName" placeholder="Họ Và Tên">
                                            </div>

                                            <div class="col-12">
                                                <label for="inputEmailAddress" class="form-label">Email</label>
                                                <input type="email" v-model="obj_update_admin.email"
                                                    class="form-control" id="inputEmailAddress"
                                                    placeholder="example@user.com">
                                            </div>
                                            <div class="col-12">
                                                <label for="inputChoosePassword" class="form-label">Ngày sinh</label>
                                                <input type="date" v-model="obj_update_admin.ngay_sinh"
                                                    class="form-control" id="" placeholder="Password">
                                            </div>
                                            <div class="col-12">
                                                <label for="mb-2 mt-1" class="form-label mb-1 mt-1">
                                                    Ảnh Đại Diện
                                                </label>
                                                <input type="file" @change="handleFileUpload" class="form-control" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Thoát</button>
                                    <button type="button" class="btn btn-warning" data-bs-dismiss="modal"
                                        v-on:click="updateAdmin()">Xong</button>
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
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Xoá Tài Khoản Admin
                                    </h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body text-start">
                                    <div class="alert alert-danger" role="alert">
                                        Bạn có muốn xoá tài khoản <b>{{ obj_delete_admin.ho_va_ten }}</b>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Đóng </button>
                                    <button @click="deleteAdmin()" type="button" class="btn btn-danger"
                                        data-bs-dismiss="modal">Vẫn
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
            list_khach_khach: [],
            obj_add_user: { is_done: 1, hinh_anh: 'https://cdn-icons-png.flaticon.com/512/666/666201.png', },
            key_tim: {},
            obj_update_admin: {},
            obj_delete_admin: {},
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
        this.laydataAdmin(1);

    },
    computed: {
        pageNumbers() {
            return getPageNumbers(this.pagination);
        },
    },
    methods: {

        laydataAdmin(page) {
            baseRequest
                .get("admin/khach-hang/lay-du-lieu?page=" + page)
                .then((res) => {
                    this.list_khach_khach = res.data.khach_hang.dataAdmin.data;
                    this.pagination = res.data.khach_hang.pagination;
                });
        },
        taoDataAdmin() {
            baseRequest
                .post(
                    "admin/khach-hang/thong-tin-tao",
                    this.obj_add_user
                )
                .then((res) => {
                    if (res.data.status == true) {
                        toaster.success(res.data.message);
                        this.obj_add_user = {};
                        this.laydataAdmin(this.pagination.per_page);
                    } else {
                        toaster.error(res.data.message);
                    }
                });
        },
        searchAdmin(page) {
            this.check_page == 1;
            baseRequest
                .post('admin/khach-hang/thong-tin-tim?page='+ page, this.key_tim)
                .then((res) => {
                    this.list_khach_khach = res.data.khach_hang.dataAdmin.data;
                    this.pagination = res.data.khach_hang.pagination;
                });
        },
        deleteAdmin() {
            baseRequest
                .delete('admin/khach-hang/thong-tin-xoa/' + this.obj_delete_admin.id)
                .then((res) => {
                    if (res.data.status == true) {
                        toaster.success('Thông báo<br>' + res.data.message);
                        this.laydataAdmin(1);
                    }
                    else {
                        toaster.danger('Thông báo<br>' + res.data.message);
                    }
                });
        },
        updateAdmin() {
            baseRequest
                .put('admin/khach-hang/thong-tin-cap-nhat', this.obj_update_admin)
                .then((res) => {
                    if (res.data.status == true) {
                        toaster.success('Thông báo<br>' + res.data.message);
                        this.laydataAdmin(1);
                    } else {
                        toaster.danger('Thông báo<br>' + res.data.message);
                    }
                });
        },

        //     handleFile(event) {
        //     const file = event.target.files[0];
        //     const cloudName = 'dltbjoii4';
        //     const uploadPreset = 'yvvll2k0';

        //     const formData = new FormData();
        //     formData.append('file', file);
        //     formData.append('upload_preset', uploadPreset);

        //     fetch(`https://api.cloudinary.com/v1_1/${cloudName}/image/upload`, {
        //       method: 'POST',
        //       body: formData,
        //     })
        //       .then((response) => response.json())
        //       .then((data) => {
        //         // Set the imageUrl to the URL of the uploaded image.
        //         this.imageUrl = data.secure_url;
        //         // console.log(this.imageUrl);
        //         this.obj_add_user.hinh_anh = data.secure_url;
        //         toaster.success('Thêm ảnh thành công!');
        //       })
        //       .catch((error) => {
        //         toaster.error('Thêm ảnh không thành công!');
        //         console.error('Error uploading image:', error);
        //       });
        //   },
        handleFileUpload(event) {
            const file = event.target.files[0];
            const cloudName = 'dltbjoii4';
            const uploadPreset = 'yvvll2k0';

            const formData = new FormData();
            formData.append('file', file);
            formData.append('upload_preset', uploadPreset);

            fetch(`https://api.cloudinary.com/v1_1/${cloudName}/image/upload`, {
                method: 'POST',
                body: formData,
            })
                .then((response) => response.json())
                .then((data) => {
                    this.obj_update_admin.hinh_anh = data.secure_url;
                    toaster.success('Thêm ảnh thành công!');
                })
                .catch((error) => {
                    console.error('Error uploading image:', error);
                    toaster.error('Thêm ảnh không thành công!');
                });
        },
    },

};
</script>
<style lang=""></style>
