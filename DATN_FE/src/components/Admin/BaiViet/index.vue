<template>
    <div class="modal fade" id="themMoiModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Thêm Mới Bài Viêt</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="row">
                            <div class="col-6">
                                <label for="" class="form-label mb-1 mt-1">
                                    <b>Tiêu Đề</b>
                                </label>
                                <input v-model="obj_add_bai_viet.tieu_de" @keyup="addSlug()" @change="kiemTraSlug()"
                                    type="text" class="form-control" placeholder="nhập tiêu đề..." />
                            </div>
                            <div class="col-6">
                                <label for="" class="form-label mb-1 mt-1">
                                    <b>Mô Tả</b>
                                </label>
                                <input v-model="obj_add_bai_viet.mo_ta" type="text" class="form-control"
                                    placeholder="nhập mô tả..." />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <label for="" class="form-label mb-1 mt-1">
                                    <b>Slug Bài Viêt</b>
                                </label>
                                <input v-model="obj_add_bai_viet.slug_tieu_de" disabled class="form-control"
                                    type="text">
                            </div>


                            <div class="col-6">
                                <label for="" class="form-label mb-1 mt-1">
                                    <b>Hình Ảnh</b>
                                </label>
                                <input type="file" @change="handleFile($event, true)" class="form-control" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <label class="form-label mb-1 mt-1">
                                    <b>Tình Trạng</b>
                                </label>
                                <select v-model="obj_add_bai_viet.tinh_trang" class="form-control mb-3">
                                    <option value="0">Tạm Dừng</option>
                                    <option value="1">Hiển Thị</option>
                                </select>
                            </div>
                            <div class="col-6">
                                <label for="" class="form-label mb-1 mt-1">
                                    <b>Chuyên Mục</b>
                                </label>
                                <select v-model="obj_add_bai_viet.id_chuyen_muc" class="form-control mb-3">
                                    <template v-for="(v, k) in list_chuyen_muc" :key="k">
                                        <option v-bind:value="v.id">{{ v.ten_chuyen_muc }}</option>
                                    </template>
                                </select>
                            </div>
                            <div class="col-6">
                                <label for="" class="form-label mb-1 mt-1">
                                    <b>Mô Tả Chi Tiết</b>
                                </label>
                                <textarea class="form-control" v-model="obj_add_bai_viet.mo_ta_chi_tiet"
                                    id="exampleFormControlTextarea1" rows="3"></textarea>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Thoát</button>
                    <button v-if="is_create == 0" disabled class="btn btn-danger">Thêm Mới</button>
                    <button v-else v-on:click="taoDataBaiViet()" class="btn btn-primary" data-bs-dismiss="modal">Thêm Mới</button>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card border-5 border-primary border-top">
                <div class="card-header d-flex justify-content-between">
                    <h5><b>DANH SÁCH BÀI VIẾT</b></h5>
                    <div></div>
                    <button class="btn btn-outline-primary px-4 py-0" data-bs-toggle="modal"
                        data-bs-target="#themMoiModal">
                        <b>Thêm Mới</b>
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-responsive ">
                            <thead>
                                <tr>
                                    <th colspan="100%">
                                        <div class="input-group mb-3">
                                            <input v-on:keyup.enter="searchBaiViet(1)" v-model="key_tim.key" type="text"
                                                class="form-control" placeholder="Nhập thông tin cần tìm">
                                            <button class="btn btn-primary" v-on:click="searchBaiViet(1)">
                                                <i class="fa-solid fa-magnifying-glass"></i>
                                            </button>
                                        </div>
                                    </th>
                                </tr>
                                <tr class="text-center">
                                    <th>#</th>
                                    <th class=" align-middle text-nowrap">Tiều Đề</th>
                                    <th class=" align-middle text-nowrap">Slug Tiêu Đề</th>
                                    <th class=" align-middle text-nowrap">Chuyên Mục</th>
                                    <th class=" align-middle text-nowrap">Mô Tả</th>
                                    <th class=" align-middle text-nowrap">Mô Tả Chi Tiết</th>
                                    <th class=" align-middle text-nowrap">Hình Ảnh</th>
                                    <th class=" align-middle text-nowrap">Tình Trạng</th>
                                    <th class=" align-middle text-nowrap">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(v, k) in list_bai_viet" class="" :key="k">
                                    <td class=" align-middle text-nowrap">{{ k + 1 }}</td>
                                    <td class=" align-middle text-wrap">{{ v.tieu_de }}</td>
                                    <td class=" align-middle text-wrap">{{ v.slug_tieu_de }}</td>
                                    <td class=" align-middle text-nowrap">{{ v.ten_chuyen_muc }}</td>
                                    <td class=" align-middle text-wrap">{{ v.mo_ta }}</td>
                                    <td class="text-center align-middle text-nowrap">
                                        <button @click="Object.assign(obj_mo_ta, v)" type="button" class="btn text-info"
                                            data-bs-toggle="modal" data-bs-target="#exampleModal"><i
                                                class="fa-solid fa-info"></i>
                                        </button>
                                    </td>
                                    <td class=" align-middle text-nowrap">
                                        <img v-bind:src="v.hinh_anh" class="img-fluid"
                                            style="width: 70px; height: auto;" alt="">
                                    </td>

                                    <td class=" align-middle text-nowrap">
                                        <button @click="doiTrangThai(v)" v-if="v.tinh_trang == 1"
                                            class="btn btn-success">
                                            Hoạt Động
                                        </button>
                                        <button @click="doiTrangThai(v)" v-if="v.tinh_trang == 0"
                                            class="btn btn-warning">
                                            Tạm Dừng
                                        </button>
                                    </td>
                                    <td class=" align-middle text-nowrap">
                                        <button @click="Object.assign(obj_update_bai_viet, v)" type="button"
                                            class="btn btn-warning me-1" data-bs-toggle="modal"
                                            data-bs-target="#Chinhsua">
                                            Chỉnh Sửa
                                        </button>

                                        <button @click="Object.assign(obj_delete_bai_viet, v)" data-bs-target="#Xoa"
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
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Mô Tả</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    {{ obj_mo_ta.mo_ta_chi_tiet }}
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Đóng</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="Chinhsua" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">CHỈNH Sửa BÀI VIẾT
                                    </h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="row">
                                            <div class="col-6">
                                                <label for="" class="form-label mb-1 mt-1">
                                                    <b>Tiêu Đề</b>
                                                </label>
                                                <input v-model="obj_update_bai_viet.tieu_de" @keyup="addSlugUpdate()"
                                                    @change="kiemTraSlugUpdate()" type="text" class="form-control"
                                                    placeholder="nhập tiêu đề..." />
                                            </div>
                                            <div class="col-6">
                                                <label for="" class="form-label mb-1 mt-1">
                                                    <b>Mô Tả</b>
                                                </label>
                                                <input v-model="obj_update_bai_viet.mo_ta" type="text"
                                                    class="form-control" placeholder="nhập mô tả..." />
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <label for="" class="form-label mb-1 mt-1">
                                                    <b>Slug Bài Viêt</b>
                                                </label>
                                                <input v-model="obj_update_bai_viet.slug_tieu_de" disabled
                                                    class="form-control" type="text">
                                            </div>


                                            <div class="col-6">
                                                <label for="" class="form-label mb-1 mt-1">
                                                    <b>Hình Ảnh</b>
                                                </label>
                                                <input type="file" @change="handleFile($event, false)" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <label class="form-label mb-1 mt-1">
                                                    <b>Tình Trạng</b>
                                                </label>
                                                <select v-model="obj_update_bai_viet.tinh_trang"
                                                    class="form-control mb-3">
                                                    <option value="0">Tạm Dừng</option>
                                                    <option value="1">Hiển Thị</option>
                                                </select>
                                            </div>
                                            <div class="col-6">
                                                <label for="" class="form-label mb-1 mt-1">
                                                    <b>Chuyên Mục</b>
                                                </label>
                                                <select v-model="obj_update_bai_viet.id_chuyen_muc"
                                                    class="form-control mb-3">
                                                    <template v-for="(v, k) in list_chuyen_muc" :key="k">
                                                        <option v-bind:value="v.id">{{ v.ten_chuyen_muc }}</option>
                                                    </template>
                                                </select>
                                            </div>
                                            <div class="col-6">
                                                <label for="" class="form-label mb-1 mt-1">
                                                    <b>Mô Tả Chi Tiết</b>
                                                </label>
                                                <textarea class="form-control"
                                                    v-model="obj_update_bai_viet.mo_ta_chi_tiet"
                                                    id="exampleFormControlTextarea1" rows="3"></textarea>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Đóng
                                    </button>
                                    <button v-if="is_update == 0" disabled class="btn btn-danger">Cập Nhật</button>
                                    <button v-else v-on:click="updateBaiViet()" class="btn btn-primary"  data-bs-dismiss="modal">Cập Nhật</button>

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
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Thêm Chức
                                        Năng
                                    </h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body text-start">
                                    <div class="alert alert-danger" role="alert">
                                        Bạn có muốn xoá Bài Viết <b>{{ obj_delete_bai_viet.tieu_de }}</b>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Đóng </button>
                                    <button @click="deleteBaiViet()" type="button" class="btn btn-danger"
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
import { createToaster } from "@meforma/vue-toaster";
import { getPageNumbers } from "../../../core/paginationUtils.js";
const toaster = createToaster({
    position: "top-right",
});
export default {
    data() {
        return {
            is_create: 0,
            is_update: 1,
            obj_mo_ta: {},
            list_bai_viet: [],
            list_chuyen_muc: [],
            obj_add_bai_viet: {},
            key_tim: {},
            obj_update_bai_viet: {},
            obj_delete_bai_viet: {},
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
        this.laydataBaiViet(1);
    },
    methods: {
        handleFile(e, isCreate) {
            let files = e.target.files || e.dataTransfer.files;
            this.file = files;
            if (!files.length) return;
            // File type validation
            const validImageTypes = ['image/gif', 'image/jpeg', 'image/png', 'image/webp'];
            if (!validImageTypes.includes(files[0].type)) {
                alert('Vui lòng chọn đúng file hình ảnh');
                return;
            }
            else{
                this.createImage(files[0], isCreate);
            }
        },
        createImage(file, isCreate) {
            let reader = new FileReader();
            let vm = this;
            reader.onload = (e) => {
                // vm.banner = e.target.result;
                if (isCreate == true) {
                    vm.obj_add_bai_viet.hinh_anh = file;
                } else {
                    vm.obj_update_bai_viet.hinh_anh = file;
                }
            };
            reader.readAsDataURL(file);
        },
        changPage(page) {
            if (this.check_page == 0) {
                this.laydataBaiViet(page);
            } else if (this.check_page == 1) {
                this.searchBaiViet(page);
            }
        },
        convertToSlug(str) {
            str = str.toLowerCase();
            str = str
                .normalize('NFD')
                .replace(/[\u0300-\u036f]/g, '');
            str = str.replace(/[đĐ]/g, 'd');
            str = str.replace(/([^0-9a-z-\s])/g, '');
            str = str.replace(/(\s+)/g, '-');
            str = str.replace(/-+/g, '-');
            str = str.replace(/^-+|-+$/g, '');
            return str;
        },
        addSlug() {
            this.obj_add_bai_viet.slug_tieu_de = this.convertToSlug(this.obj_add_bai_viet.tieu_de);
        },

        addSlugUpdate() {
            this.obj_update_bai_viet.slug_tieu_de = this.convertToSlug(this.obj_update_bai_viet.tieu_de);
        },

        kiemTraSlug() {
            var payload = {
                'slug': this.obj_add_bai_viet.slug_tieu_de
            }
            baseRequest
                .post('admin/bai-viet/kiem-tra-slug', payload)
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
                'slug': this.obj_update_bai_viet.slug_tieu_de,
                'id': this.obj_update_bai_viet.id
            }
            baseRequest
                .post('admin/bai-viet/kiem-tra-slug-update', payload)
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
        laydataBaiViet(page) {
            baseRequest
                .get("admin/bai-viet/lay-du-lieu?page=" + page)
                .then((res) => {
                    this.list_bai_viet = res.data.bai_viet_admin.dataAdmin.data;
                    this.pagination = res.data.bai_viet_admin.pagination;
                    this.list_chuyen_muc = res.data.chuyen_muc_admin;
                });
        },
        taoDataBaiViet() {
            const formData = new FormData();
            for (let key in this.obj_add_bai_viet) {
                formData.append(key, this.obj_add_bai_viet[key]);
            }
            baseRequest
                .post(
                    "admin/bai-viet/thong-tin-tao",
                    formData
                )
                .then((res) => {
                    if (res.data.status == true) {
                        toaster.success(res.data.message);
                        this.obj_add_bai_viet = {};
                        this.is_create = 0;
                        this.laydataBaiViet(this.pagination.last_page);
                    } else {
                        toaster.error(res.data.message);
                    }
                });
        },
        searchBaiViet(page) {
            th
            baseRequest
                .post('admin/bai-viet/thong-tin-tim?page=' + page, this.key_tim)
                .then((res) => {
                    this.list_bai_viet = res.data.bai_viet_admin.dataAdmin.data;
                    this.pagination = res.data.bai_viet_admin.pagination;
                });
        },
        deleteBaiViet() {
            baseRequest
                .delete('admin/bai-viet/thong-tin-xoa/' + this.obj_delete_bai_viet.id)
                .then((res) => {
                    if (res.data.status == true) {
                        toaster.success('Thông báo<br>' + res.data.message);
                        this.laydataBaiViet(this.pagination.current_page);

                    }
                    else {
                        toaster.danger('Thông báo<br>' + res.data.message);
                    }
                });
        },
        updateBaiViet() {
            const formData = new FormData();
            for (let key in this.obj_update_bai_viet) {
                formData.append(key, this.obj_update_bai_viet[key]);
            }
            baseRequest
                .post('admin/bai-viet/thong-tin-cap-nhat', formData)
                .then((res) => {
                    if (res.data.status == true) {
                        toaster.success('Thông báo<br>' + res.data.message);
                        this.is_update = 1;
                        this.laydataBaiViet(this.pagination.current_page);
                    } else {
                        toaster.danger('Thông báo<br>' + res.data.message);
                    }
                });
        },

        doiTrangThai(xyz) {
            baseRequest
                .put('admin/bai-viet/thong-tin-thay-doi-trang-thai', xyz)
                .then((res) => {
                    if (res.data.status == true) {
                        toaster.success('Thông báo<br>' + res.data.message);
                        this.laydataBaiViet(1);
                    } else {
                        toaster.error(res.data.message);
                    }
                });
        },
        //
        // handleFile(event) {
        //     const file = event.target.files[0];
        //     const cloudName = 'dltbjoii4';
        //     const uploadPreset = 'yvvll2k0';

        //     const formData = new FormData();
        //     formData.append('file', file);
        //     formData.append('upload_preset', uploadPreset);

        //     fetch(`https://api.cloudinary.com/v1_1/${cloudName}/image/upload`, {
        //         method: 'POST',
        //         body: formData,
        //     })
        //         .then((response) => response.json())
        //         .then((data) => {
        //             this.imageUrl = data.secure_url;
        //             this.obj_add_bai_viet.hinh_anh = data.secure_url;
        //             toaster.success('Thêm ảnh thành công!');

        //         })
        //         .catch((error) => {
        //             console.error('Error uploading image:', error);
        //             toaster.error('Thêm không ảnh thành công!');

        //         });
        // },
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
                    this.imageUrl = data.secure_url;
                    this.obj_update_bai_viet.hinh_anh = data.secure_url;
                    toaster.success('Thêm ảnh thành công!');

                })
                .catch((error) => {
                    console.error('Error uploading image:', error);
                    toaster.error('Thêm không ảnh thành công!');

                });
        },
    },

};
</script>
<style lang=""></style>
