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
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Thêm Mới Tập Phim</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="row">
                            <div class="col-6">
                                <label class="form-label mb-1 mt-1">
                                    <b>Chọn Phim</b>
                                </label>
                                <select v-model="obj_add_tap_phim.id_phim" @change="layTenPhim()" name="" id=""
                                    class="form-control">
                                    <template v-for="(v, k) in list_phim" :key="k">
                                        <option v-bind:value="v.id">{{ v.ten_phim }}</option>
                                    </template>
                                </select>
                            </div>
                            <div class="col-6">
                                <label for="" class="form-label mb-1 mt-1">
                                    <b>Loại Phim</b>
                                </label>
                                <input v-model="obj_tap_phim.ten_loai_phim" type="text" disabled class="form-control"
                                    placeholder="loai_phim..." />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <label for="" class="form-label mb-1 mt-1">
                                    <b>Tập Phim</b>
                                </label>
                                <input v-model="obj_add_tap_phim.ten_tap_phim" @keyup="addSlug()"
                                    @change="kiemTraSlug()" type="text" class="form-control"
                                    placeholder="VD: TẬP 1, MOVIE 1, RAW 1" />
                            </div>
                            <div class="col-6">
                                <label for="" class="form-label mb-1 mt-1">
                                    <b>Slug Tập Phim</b>
                                </label>
                                <input v-model="obj_add_tap_phim.slug_tap_phim" type="text" disabled
                                    class="form-control" placeholder="slug phim..." />
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <label for="" class="form-label mb-1 mt-1">
                                    <b>Video</b>
                                </label>
                                <input type="file" @change="handleFileCreateVideo" class="form-control" />
                            </div>
                            <div class="col-6">
                                <label class="form-label mb-1 mt-1">
                                    <b>Tình Trạng</b>
                                </label>
                                <select v-model="obj_add_tap_phim.tinh_trang" class="form-control mb-2">
                                    <option value="0">Tạm Dừng</option>
                                    <option value="1">Hiển Thị</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Thoát</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal"
                        v-on:click="taoDataTapPhim()">Thêm
                        Mới</button>
                </div>
            </div>
        </div>
    </div>
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
                                        <input v-on:keyup="searchTapPhim(1)" v-model="key_tim.key" type="text"
                                            class="form-control" placeholder="Nhập thông tin cần tìm">
                                        <button class="btn btn-primary" v-on:click="searchTapPhim(1)">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                        </button>
                                    </div>
                                </th>
                            </tr>
                            <tr class="text-center">
                                <th>#</th>
                                <th class="text-center align-middle text-nowrap">Tên Phim</th>
                                <th class="text-center align-middle text-nowrap">Tập Phim</th>
                                <th class="text-center align-middle text-nowrap">Slug Tập Phim</th>
                                <th class="text-center align-middle text-nowrap">Link Video</th>
                                <th class="text-center align-middle text-nowrap">Tình Trạng</th>
                                <th class="text-center align-middle text-nowrap">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(v, k) in list_tap_phim" class="" :key="k">
                                <td class="text-center align-middle text-nowrap">{{ k + 1 }}</td>
                                <td class=" align-middle text-nowrap">{{ v.ten_phim }}</td>
                                <td class=" align-middle text-nowrap">{{ v.ten_tap_phim }}</td>
                                <td class=" align-middle text-nowrap">{{ v.slug_tap_phim }}</td>
                                <td class=" align-middle text-nowrap">{{ v.url }}</td>
                                <td class="text-center align-middle text-nowrap">
                                    <i @click="doiTrangThai(v)" v-if="v.tinh_trang == 1" type="button"
                                        class="fa-solid fa-square-check fa-2x  text-success"></i>
                                    <i @click="doiTrangThai(v)" v-if="v.tinh_trang == 0" type="button"
                                        class="fa-regular fa-square-check text-dark fa-2x"></i>
                                </td>
                                <td class="text-center align-middle text-nowrap">

                                    <i @click="Object.assign(obj_update_tap_phim, v)" type="button"
                                        data-bs-toggle="modal" data-bs-target="#Chinhsua"
                                        class="fa-solid fa-pen-to-square fa-2x text-warning me-2"></i>

                                    <i @click="Object.assign(obj_delete_tap_phim, v)" data-bs-target="#Xoa" type="button"
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
                    <div class="modal fade" id="Chinhsua" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">CHỈNH SỮA PHIM
                                    </h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="row">
                                            <div class="col-6">
                                                <label class="form-label mb-1 mt-1">
                                                    <b>Chọn Phim</b>
                                                </label>
                                                <select v-model="obj_update_tap_phim.id_phim"
                                                    @change="layTenPhimUpdate()" name="" id="" class="form-control">
                                                    <template v-for="(v, k) in list_phim" :key="k">
                                                        <option v-bind:value="v.id">{{ v.ten_phim }}</option>
                                                    </template>
                                                </select>
                                            </div>
                                            <div class="col-6">
                                                <label for="" class="form-label mb-1 mt-1">
                                                    <b>Loại Phim</b>
                                                </label>
                                                <input v-model="obj_tap_phim.ten_loai_phim" type="text" disabled
                                                    class="form-control" placeholder="loai_phim..." />
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <label for="" class="form-label mb-1 mt-1">
                                                    <b>Tập Phim</b>
                                                </label>
                                                <input v-model="obj_update_tap_phim.ten_tap_phim"
                                                    @keyup="addSlugUpdate()" @change="kiemTraSlugUpdate()" type="text"
                                                    class="form-control" placeholder="nhập tên tập phim..." />
                                            </div>
                                            <div class="col-6">
                                                <label for="" class="form-label mb-1 mt-1">
                                                    <b>Slug Tập Phim</b>
                                                </label>
                                                <input v-model="obj_update_tap_phim.slug_tap_phim" type="text" disabled
                                                    class="form-control" placeholder="slug phim..." />
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-6">
                                                <label for="" class="form-label mb-1 mt-1">
                                                    <b>Video</b>
                                                </label>
                                                <input type="file" @change="handleFileCreateVideo"
                                                    class="form-control" />
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label mb-1 mt-1">
                                                    <b>Tình Trạng</b>
                                                </label>
                                                <select v-model="obj_update_tap_phim.tinh_trang"
                                                    class="form-control mb-2">
                                                    <option value="0">Tạm Dừng</option>
                                                    <option value="1">Hiển Thị</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Đóng
                                    </button>
                                    <button @click="updateTapPhim()" type="button" class="btn btn-success"
                                        data-bs-dismiss="modal">Lưu</button>
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
                                    <h1 class="modal-title fs-5" id="exampleModalLabel"> Xoá Phim
                                    </h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body text-start">
                                    <div class="alert alert-danger" role="alert">
                                        Bạn có muốn xoá Phim <b>{{ obj_delete_tap_phim.ten_tap_phim }}</b>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Đóng </button>
                                    <button @click="deletePhim()" type="button" class="btn btn-danger"
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
            list_phim: [],
            list_tap_phim: [],
            obj_add_tap_phim: {},
            key_tim: {},
            obj_update_tap_phim: {},
            obj_mo_ta: {},
            obj_tap_phim: {},
            obj_delete_tap_phim: {},
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
        this.laydataTapPhim();
        this.laydataPhim();
    },
    methods: {
        changPage(page) {
            if (this.check_page == 0) {
                this.laydataTapPhim(page);
            } else if (this.check_page == 1) {
                this.searchTapPhim(page);
            }
        },
        layTenPhim() {
            var payload = {
                'id_phim': this.obj_add_tap_phim.id_phim
            }
            baseRequest
                .post('admin/tap-phim/lay-ten-phim', payload)
                .then((res) => {
                    if (res.data.status) {
                        this.obj_tap_phim = res.data.ten_phim;
                        toaster.success(res.data.message);
                    } else {
                        toaster.error(res.data.message);
                    }
                });
        },
        layTenPhimUpdate() {
            var payload = {
                'id_phim': this.obj_update_tap_phim.id_phim,
            }
            baseRequest
                .post('admin/tap-phim/lay-ten-phim-update', payload)
                .then((res) => {
                    if (res.data.status) {
                        this.obj_tap_phim = res.data.ten_phim;
                        toaster.success(res.data.message);
                    } else {
                        toaster.error(res.data.message);
                    }
                });
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
            return this.obj_tap_phim.slug_phim + '-' + str;
        },

        addSlug() {
            this.obj_add_tap_phim.slug_tap_phim = this.convertToSlug(this.obj_add_tap_phim.ten_tap_phim);
        },

        addSlugUpdate() {
            this.obj_update_tap_phim.slug_tap_phim = this.convertToSlug(this.obj_update_tap_phim.ten_tap_phim);
        },

        kiemTraSlug() {
            var payload = {
                'slug': this.obj_add_tap_phim.slug_tap_phim
            }
            baseRequest
                .post('admin/tap-phim/kiem-tra-slug', payload)
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
                'slug': this.obj_update_tap_phim.slug_tap_phim,
                'id': this.obj_update_tap_phim.id
            }
            baseRequest
                .post('admin/tap-phim/kiem-tra-slug-update', payload)
                .then((res) => {
                    if (res.data.status) {
                        toaster.success(res.data.message);
                    } else {
                        toaster.error(res.data.message);
                    }
                });
        },
        laydataPhim() {
            baseRequest
                .get("admin/phim/lay-du-lieu")
                .then((res) => {
                    this.list_phim = res.data.phim_admin;
                });
        },

        laydataTapPhim(page) {
            baseRequest
                .get("admin/tap-phim/lay-du-lieu?page=" + page)
                .then((res) => {
                    this.list_tap_phim = res.data.tap_phim_admin.dataAdmin.data;
                    this.pagination = res.data.tap_phim_admin.pagination;
                });
        },
        taoDataTapPhim() {
            baseRequest
                .post(
                    "admin/tap-phim/thong-tin-tao",
                    this.obj_add_tap_phim
                )
                .then((res) => {
                    if (res.data.status == true) {
                        toaster.success(res.data.message);
                        this.obj_add_tap_phim = {};
                        this.laydataTapPhim();
                    } else {
                        toaster.error(res.data.message);
                    }
                });
        },
        searchTapPhim(page) {
            this.check_page = 1;
            baseRequest
                .post('admin/tap-phim/thong-tin-tim?page=' + page, this.key_tim)
                .then((res) => {
                    this.list_tap_phim = res.data.tap_phim_admin.dataAdmin.data;
                    this.pagination = res.data.tap_phim_admin.pagination;
                });
        },
        deleteTapPhim() {
            baseRequest
                .delete('admin/tap-phim/thong-tin-xoa/' + this.obj_delete_phim.id)
                .then((res) => {
                    if (res.data.status == true) {
                        toaster.success('Thông báo<br>' + res.data.message);
                        this.laydataTapPhim();
                    }
                    else {
                        toaster.danger('Thông báo<br>' + res.data.message);
                    }
                });
        },
        updateTapPhim() {
            baseRequest
                .put('admin/tap-phim/thong-tin-cap-nhat', this.obj_update_tap_phim)
                .then((res) => {
                    if (res.data.status == true) {
                        toaster.success('Thông báo<br>' + res.data.message);
                        this.laydataTapPhim();
                    } else {
                        toaster.danger('Thông báo<br>' + res.data.message);
                    }
                });
        },

        doiTrangThai(xyz) {
            baseRequest
                .put('admin/tap-phim/thong-tin-thay-doi-trang-thai', xyz)
                .then((res) => {
                    if (res.data.status == true) {
                        toaster.success('Thông báo<br>' + res.data.message);
                        this.laydataTapPhim();
                    } else {
                        toaster.error(res.data.message);
                    }
                });
        },
        handleFileCreateVideo(event) {
            const file = event.target.files[0];

            // Replace 'YOUR_CLOUD_NAME' and 'YOUR_UPLOAD_PRESET' with your actual Cloudinary cloud name and upload preset.
            const cloudName = 'dltbjoii4';
            const uploadPreset = 'yvvll2k0';

            const formData = new FormData();
            formData.append('file', file);
            formData.append('upload_preset', uploadPreset);

            fetch(`https://api.cloudinary.com/v1_1/${cloudName}/video/upload`, {
                method: 'POST',
                body: formData,
            })
                .then((response) => response.json())
                .then((data) => {
                    // Set the videoUrl to the URL of the uploaded video.
                    this.obj_add_tap_phim.url = data.secure_url;
                    toaster.success('Thêm video thành công!');
                })
                .catch((error) => {
                    console.error('Error uploading video:', error);
                    toaster.error('Thêm video không thành công!');
                });
        },
        handleFileUploadVideo(event) {
            const file = event.target.files[0];

            // Replace 'YOUR_CLOUD_NAME' and 'YOUR_UPLOAD_PRESET' with your actual Cloudinary cloud name and upload preset.
            const cloudName = 'dltbjoii4';
            const uploadPreset = 'yvvll2k0';

            const formData = new FormData();
            formData.append('file', file);
            formData.append('upload_preset', uploadPreset);

            fetch(`https://api.cloudinary.com/v1_1/${cloudName}/video/upload`, {
                method: 'POST',
                body: formData,
            })
                .then((response) => response.json())
                .then((data) => {
                    // Set the videoUrl to the URL of the uploaded video.
                    this.obj_update_tap_phim.url = data.secure_url;
                    toaster.success('Thêm video thành công!');
                })
                .catch((error) => {
                    console.error('Error uploading video:', error);
                    toaster.error('Thêm video không thành công!');
                });
        },
    },

};
</script>
<style lang=""></style>
