<template>
    <div class="modal fade" id="themMoiModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Thêm Mới Phim</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="row">
                            <div class="col-6">
                                <label for="" class="form-label mb-1 mt-1">
                                    <b>Tên Phim</b>
                                </label>
                                <input v-model="obj_add_phim.ten_phim" @keyup="addSlug()" @change="kiemTraSlug()"
                                    type="text" class="form-control" placeholder="nhập phim..." />
                            </div>
                            <div class="col-6">
                                <label for="" class="form-label mb-1 mt-1">
                                    <b>Mô Tả</b>
                                </label>
                                <input v-model="obj_add_phim.mo_ta" type="text" class="form-control"
                                    placeholder="nhập mô tả..." />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <label for="" class="form-label mb-1 mt-1">
                                    <b>Slug Phim</b>
                                </label>
                                <input v-model="obj_add_phim.slug_phim" type="text" disabled class="form-control"
                                    placeholder="slug phim..." />
                            </div>
                            <div class="col-6">
                                <label for="" class="form-label mb-1 mt-1">
                                    <b>Hình Ảnh</b>
                                </label>
                                <input type="file" @change="handleFile" class="form-control" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <label class="form-label mb-1 mt-1">
                                    <b>Loại Phim</b>
                                </label>
                                <select v-model="obj_add_phim.id_loai_phim" name="" id="" class="form-control">
                                    <template v-for="(v, k) in list_loai_phim" :key="k">
                                        <option v-bind:value="v.id">{{ v.ten_loai_phim }}</option>
                                    </template>
                                </select>
                            </div>
                            <div class="col-6">
                                <label class="form-label mb-1 mt-1">
                                    <b>Thể Loại</b>
                                </label>
                                <select v-model="obj_add_phim.id_the_loai" name="" id="" class="form-control">
                                    <template v-for="(v, k) in list_the_loai" :key="k">
                                        <option v-bind:value="v.id">{{ v.ten_the_loai }}</option>
                                    </template>
                                </select>
                            </div>
                            <div class="col-6">
                                <label class="form-label mb-1 mt-1">
                                    <b>Tác Giả</b>
                                </label>
                                <select v-model="obj_add_phim.id_tac_gia" name="" id="" class="form-control">
                                    <template v-for="(v, k) in list_tac_gia" :key="k">
                                        <option v-bind:value="v.id">{{ v.ten_tac_gia }}</option>
                                    </template>
                                </select>
                            </div>
                            <div class="col-6">
                                <div class="row">
                                    <div class="col-6">
                                        <label class="form-label mb-1 mt-1">
                                            <b>Tình Trạng</b>
                                        </label>
                                        <select v-model="obj_add_phim.tinh_trang" class="form-control mb-3">
                                            <option value="0">Tạm Dừng</option>
                                            <option value="1">Hiển Thị</option>
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label mb-1 mt-1">
                                            <b>Số Tập</b>
                                        </label>
                                        <input v-model="obj_add_phim.so_tap_phim" class="form-control" type="number" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Thoát
                    </button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal" v-on:click="taoDataPhim()">
                        Thêm Mới
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-1">
        <div class="col-12">
            <div class="card border-5 border-primary border-top">
                <div class="card-header d-flex justify-content-between">
                    <h5><b>DANH SÁCH PHIM</b></h5>
                    <div></div>
                    <button class="btn btn-outline-primary px-4 py-0" data-bs-toggle="modal"
                        data-bs-target="#themMoiModal">
                        <b>Thêm Mới</b>
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-responsive">
                            <thead>
                                <tr>
                                    <th colspan="100%">
                                        <div class="input-group mb-3">
                                            <input v-on:keyup="searchPhim(1)" v-model="key_tim.key" type="text"
                                                class="form-control" placeholder="Nhập thông tin cần tìm" />
                                            <button class="btn btn-primary" v-on:click="searchPhim(1)">
                                                <i class="fa-solid fa-magnifying-glass"></i>
                                            </button>
                                        </div>
                                    </th>
                                </tr>
                                <tr class="text-center">
                                    <th>#</th>
                                    <th class="text-center align-middle text-nowrap">Tên Phim</th>
                                    <th class="text-center align-middle text-nowrap">
                                        Slug Phim
                                    </th>
                                    <th class="text-center align-middle text-nowrap">Mô Tả</th>
                                    <th class="text-center align-middle text-nowrap">Hình Ảnh</th>
                                    <th class="text-center align-middle text-nowrap">
                                        Loại Phim
                                    </th>
                                    <th class="text-center align-middle text-nowrap">Thể Loại</th>
                                    <th class="text-center align-middle text-nowrap">Tác Giả</th>
                                    <th class="text-center align-middle text-nowrap">Số Tập</th>
                                    <th class="text-center align-middle text-nowrap">
                                        Tình Trạng
                                    </th>
                                    <th class="text-center align-middle text-nowrap">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(v, k) in list_phim" :key="k">
                                    <td class="text-center align-middle text-nowrap">
                                        {{ k + 1 }}
                                    </td>
                                    <td class="align-middle text-nowrap">{{ v.ten_phim }}</td>
                                    <td class="align-middle text-nowrap">{{ v.slug_phim }}</td>
                                    <td class="text-center align-middle text-nowrap">
                                        <button @click="Object.assign(obj_mo_ta, v)" type="button" class="btn text-info"
                                            data-bs-toggle="modal" data-bs-target="#exampleModal">
                                            <i class="fa-solid fa-info"></i>
                                        </button>
                                    </td>
                                    <td class="text-center align-middle text-nowrap">
                                        <img v-bind:src="v.hinh_anh" class="img-fluid" style="width: 70px; height: auto"
                                            alt="" />
                                    </td>
                                    <td class="align-middle text-nowrap">
                                        {{ v.ten_loai_phim }}
                                    </td>
                                    <td class="align-middle text-nowrap">{{ v.ten_the_loai }}</td>
                                    <td class="align-middle text-nowrap">{{ v.ten_tac_gia }}</td>
                                    <td class="text-center align-middle text-nowrap">
                                        {{ v.so_tap_phim }}
                                    </td>

                                    <td class="text-center align-middle text-nowrap">
                                        <i @click="doiTrangThai(v)" v-if="v.tinh_trang == 1" type="button"
                                            class="fa-solid fa-square-check fa-2x text-success"></i>
                                        <i @click="doiTrangThai(v)" v-if="v.tinh_trang == 0" type="button"
                                            class="fa-regular fa-square-check text-dark fa-2x"></i>
                                    </td>
                                    <td class="text-center align-middle text-nowrap">
                                        <i @click="Object.assign(obj_update_phim, v)" type="button"
                                            data-bs-toggle="modal" data-bs-target="#Chinhsua"
                                            class="fa-solid fa-pen-to-square fa-2x text-warning me-2"></i>

                                        <i @click="Object.assign(obj_delete_phim, v)" data-bs-target="#Xoa"
                                            type="button" data-bs-toggle="modal"
                                            class="fa-solid fa-trash fa-2x text-danger"></i>
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
                                    {{ obj_mo_ta.mo_ta }}
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">
                                        Đóng
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="Chinhsua" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">
                                        CHỈNH SỮA PHIM
                                    </h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="row">
                                            <div class="col-6">
                                                <label for="" class="form-label mb-1 mt-1">
                                                    <b>Tên Phim</b>
                                                </label>
                                                <input v-model="obj_update_phim.ten_phim" @keyup="addSlugUpdate()"
                                                    @change="kiemTraSlugUpdate()" type="text" class="form-control"
                                                    placeholder="nhập phim..." />
                                            </div>
                                            <div class="col-6">
                                                <label for="" class="form-label mb-1 mt-1">
                                                    <b>Mô Tả</b>
                                                </label>
                                                <input v-model="obj_update_phim.mo_ta" type="text" class="form-control"
                                                    placeholder="nhập mô tả..." />
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <label for="" class="form-label mb-1 mt-1">
                                                    <b>Slug Phim</b>
                                                </label>
                                                <input v-model="obj_update_phim.slug_phim" type="text" disabled
                                                    class="form-control" placeholder="slug phim..." />
                                            </div>
                                            <div class="col-6">
                                                <label for="" class="form-label mb-1 mt-1">
                                                    <b>Hình Ảnh</b>
                                                </label>
                                                <input type="file" @change="handleFileUpload" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <label class="form-label mb-1 mt-1">
                                                    <b>Loại Phim</b>
                                                </label>
                                                <select v-model="obj_update_phim.id_loai_phim" name="" id=""
                                                    class="form-control">
                                                    <template v-for="(v, k) in list_loai_phim" :key="k">
                                                        <option v-bind:value="v.id">
                                                            {{ v.ten_loai_phim }}
                                                        </option>
                                                    </template>
                                                </select>
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label mb-1 mt-1">
                                                    <b>Thể Loại</b>
                                                </label>
                                                <select v-model="obj_update_phim.id_the_loai" name="" id=""
                                                    class="form-control">
                                                    <template v-for="(v, k) in list_the_loai" :key="k">
                                                        <option v-bind:value="v.id">
                                                            {{ v.ten_the_loai }}
                                                        </option>
                                                    </template>
                                                </select>
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label mb-1 mt-1">
                                                    <b>Tác Giả</b>
                                                </label>
                                                <select v-model="obj_update_phim.id_tac_gia" name="" id=""
                                                    class="form-control">
                                                    <template v-for="(v, k) in list_tac_gia" :key="k">
                                                        <option v-bind:value="v.id">
                                                            {{ v.ten_tac_gia }}
                                                        </option>
                                                    </template>
                                                </select>
                                            </div>
                                            <div class="col-6">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <label class="form-label mb-1 mt-1">
                                                            <b>Tình Trạng</b>
                                                        </label>
                                                        <select v-model="obj_update_phim.tinh_trang"
                                                            class="form-control mb-3">
                                                            <option value="0">Tạm Dừng</option>
                                                            <option value="1">Hiển Thị</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-6">
                                                        <label class="form-label mb-1 mt-1">
                                                            <b>Số Tập</b>
                                                        </label>
                                                        <input v-model="obj_update_phim.so_tap_phim"
                                                            class="form-control" type="number" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                                        Đóng
                                    </button>
                                    <button @click="updatePhim()" type="button" class="btn btn-success"
                                        data-bs-dismiss="modal">
                                        Lưu
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
                                        Xoá Phim
                                    </h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body text-start">
                                    <div class="alert alert-danger" role="alert">
                                        Bạn có muốn xoá Phim <b>{{ obj_delete_phim.ten_phim }}</b>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">
                                        Đóng
                                    </button>
                                    <button @click="deletePhim()" type="button" class="btn btn-danger"
                                        data-bs-dismiss="modal">
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
import baseRequest from "../../../core/baseRequest";
import { createToaster } from "@meforma/vue-toaster";
const toaster = createToaster({
    position: "top-right",
});
export default {
    data() {
        return {
            list_loai_phim: [],
            obj_mo_ta: {},
            list_the_loai: [],
            list_tac_gia: [],
            list_phim: [],
            obj_add_phim: {},
            key_tim: {},
            obj_update_phim: {},
            obj_delete_phim: {},
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
            let pages = [];
            for (let i = 1; i <= this.pagination.last_page; i++) {
                pages.push(i);
            }
            return pages;
        },

        // Tính toán các số trang để hiển thị
        pageNumbers() {
            let pages = [];
            if (this.pagination.last_page <= 3) {
                // Nếu tổng số trang <= 3, hiển thị tất cả các trang
                for (let i = 1; i <= this.pagination.last_page; i++) {
                    pages.push(i);
                }
            } else {
                if (this.pagination.current_page <= 3) {
                    // Người dùng đang ở ba trang đầu
                    let maxPage = Math.min(3, this.pagination.last_page); // Đảm bảo không vượt quá tổng số trang
                    for (let i = 1; i <= maxPage; i++) {
                        pages.push(i);
                    }
                    if (this.pagination.last_page > 3) {
                        pages.push("...");
                        pages.push(this.pagination.last_page);
                    }
                } else if (
                    this.pagination.current_page >=
                    this.pagination.last_page - 2
                ) {
                    // Người dùng đang ở ba trang cuối
                    pages.push(1);
                    if (this.pagination.last_page > 3) {
                        pages.push("...");
                    }
                    let minPage = Math.max(this.pagination.last_page - 3, 1); // Đảm bảo không nhỏ hơn trang đầu tiên
                    for (let i = minPage; i <= this.pagination.last_page; i++) {
                        pages.push(i);
                    }
                } else {
                    // Người dùng đang ở các trang giữa
                    pages.push(1);
                    pages.push("...");
                    for (
                        let i = this.pagination.current_page - 1;
                        i <= this.pagination.current_page + 1;
                        i++
                    ) {
                        pages.push(i);
                    }
                    pages.push("...");
                    pages.push(this.pagination.last_page);
                }
            }
            return pages;
        },
    },
    mounted() {
        this.laydataPhim(1);
    },
    methods: {
        changPage(page) {
            if (this.check_page == 0) {
                this.laydataPhim(page);
            } else if (this.check_page == 1) {
                this.searchPhim(page);
            }
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
            this.obj_add_phim.slug_phim = this.convertToSlug(
                this.obj_add_phim.ten_phim
            );
        },

        addSlugUpdate() {
            this.obj_update_phim.slug_phim = this.convertToSlug(
                this.obj_update_phim.ten_phim
            );
        },

        kiemTraSlug() {
            var payload = {
                slug: this.obj_add_phim.slug_phim,
            };
            baseRequest.post("admin/phim/kiem-tra-slug", payload).then((res) => {
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
                slug: this.obj_update_phim.slug_phim,
                id: this.obj_update_phim.id,
            };
            baseRequest
                .post("admin/phim/kiem-tra-slug-update", payload)
                .then((res) => {
                    if (res.data.status) {
                        toaster.success(res.data.message);
                    } else {
                        toaster.error(res.data.message);
                    }
                });
        },
        laydataPhim(page) {
            baseRequest.get("admin/phim/lay-du-lieu?page=" + page).then((res) => {
                if (res.data.status == false) {
                    toaster.error(res.data.message);
                } else {
                    this.list_phim = res.data.phim_admin.dataAdmin.data;
                    this.pagination = res.data.phim_admin.pagination;
                    this.list_the_loai = res.data.the_loai_admin;
                    this.list_tac_gia = res.data.tac_gia_admin;
                    this.list_loai_phim = res.data.loai_phim_admin;
                }
            });
        },
        taoDataPhim() {
            baseRequest
                .post("admin/phim/thong-tin-tao", this.obj_add_phim)
                .then((res) => {
                    if (res.data.status == true) {
                        toaster.success(res.data.message);
                        this.obj_add_phim = {};
                        this.laydataPhim(this.pagination.last_page);
                    } else {
                        toaster.error(res.data.message);
                    }
                });
        },
        searchPhim(page) {
            this.check_page = 1;
            baseRequest
                .post("admin/phim/thong-tin-tim?page=" + page, this.key_tim)
                .then((res) => {
                    this.list_phim = res.data.phim_admin.dataAdmin.data;
                    this.pagination = res.data.phim_admin.pagination;
                    this.list_the_loai = res.data.the_loai_admin;
                    this.list_tac_gia = res.data.tac_gia_admin;
                    this.list_loai_phim = res.data.loai_phim_admin;
                });
        },
        deletePhim() {
            baseRequest
                .delete("admin/phim/thong-tin-xoa/" + this.obj_delete_phim.id)
                .then((res) => {
                    if (res.data.status == true) {
                        toaster.success("Thông báo<br>" + res.data.message);
                        this.laydataPhim(1);
                    } else {
                        toaster.danger("Thông báo<br>" + res.data.message);
                    }
                });
        },
        updatePhim() {
            baseRequest
                .put("admin/phim/thong-tin-cap-nhat", this.obj_update_phim)
                .then((res) => {
                    if (res.data.status == true) {
                        toaster.success("Thông báo<br>" + res.data.message);
                        this.laydataPhim(1);
                    } else {
                        toaster.danger("Thông báo<br>" + res.data.message);
                    }
                });
        },

        doiTrangThai(xyz) {
            baseRequest
                .put("admin/phim/thong-tin-thay-doi-trang-thai", xyz)
                .then((res) => {
                    if (res.data.status == true) {
                        toaster.success("Thông báo<br>" + res.data.message);
                        this.laydataPhim(1);
                    } else {
                        toaster.error(res.data.message);
                    }
                });
        },
        handleFile(event) {
            const file = event.target.files[0];
            const cloudName = "dltbjoii4";
            const uploadPreset = "yvvll2k0";

            const formData = new FormData();
            formData.append("file", file);
            formData.append("upload_preset", uploadPreset);

            fetch(`https://api.cloudinary.com/v1_1/${cloudName}/image/upload`, {
                method: "POST",
                body: formData,
            })
                .then((response) => response.json())
                .then((data) => {
                    // Set the imageUrl to the URL of the uploaded image.
                    this.imageUrl = data.secure_url;
                    // console.log(this.imageUrl);
                    this.obj_add_phim.hinh_anh = data.secure_url;
                    toaster.success("Thêm ảnh thành công!");
                })
                .catch((error) => {
                    toaster.error("Thêm ảnh không thành công!");
                    console.error("Error uploading image:", error);
                });
        },
        handleFileUpload(event) {
            const file = event.target.files[0];
            const cloudName = "dltbjoii4";
            const uploadPreset = "yvvll2k0";
            const formData = new FormData();
            formData.append("file", file);
            formData.append("upload_preset", uploadPreset);

            fetch(`https://api.cloudinary.com/v1_1/${cloudName}/image/upload`, {
                method: "POST",
                body: formData,
            })
                .then((response) => response.json())
                .then((data) => {
                    this.imageUrl = data.secure_url;
                    this.obj_update_phim.hinh_anh = data.secure_url;
                    toaster.success("Thêm ảnh thành công!");
                })
                .catch((error) => {
                    console.error("Error uploading image:", error);
                    toaster.error("Thêm ảnh không thành công!");
                });
        },
    },
};
</script>
<style lang=""></style>
