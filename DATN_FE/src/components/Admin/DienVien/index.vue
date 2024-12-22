<template>
    <div class="modal fade" id="themMoiModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Thêm Mới Diễn Viên</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="row">
                            <div class="col-12">
                                <label for="" class="form-label mb-1 mt-1">
                                    <b>Tên Diễn Viên</b>
                                </label>
                                <input v-model="obj_add_dien_vien.ten_dv"
                                    type="text" class="form-control" placeholder="Nhập tên diễn viên..." />
                            </div>
                            <div class="col-12">
                                <label for="" class="form-label mb-1 mt-1">
                                    <b>Mô Tả</b>
                                </label>
                                <textarea v-model="obj_add_dien_vien.mo_ta" class="form-control"
                                    placeholder="Nhập mô tả..."></textarea>
                            </div>
                            <div class="col-12">
                                <label class="form-label mb-1 mt-1">
                                    <b>Năm sinh</b>
                                </label>
                                <select v-model="obj_add_dien_vien.nam_sinh" class="form-control">
                                    <option v-for="year in getYearsRange()" :value="year" :key="year">
                                        {{ year }}
                                    </option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label mb-1 mt-1">
                                    <b>Tình trạng</b>
                                </label>
                                <select v-model="obj_add_dien_vien.tinh_trang" class="form-control">
                                   <option value="1">Hoạt động</option>
                                   <option value="0">Tạm Dừng</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label mb-1 mt-1">
                                    <b>Phim tham gia</b>
                                </label>
                                <select v-model="choice" class="form-control" v-on:change="addPhim()">
                                    <template v-for="(v, k) in list_phim" :key="k">
                                        <option v-bind:value="v.id">{{ v.ten_phim }}</option>
                                    </template>
                                </select>
                                <hr>
                                <template v-for="(value, index) in list_phim" :key="index">
                                    <div class="chip" v-if="list_chon.includes(value.id)"> {{ value.ten_phim }}
                                        <span class="closebtn" v-on:click="removePhim(list_chon.indexOf(value.id))"
                                            onclick="this.parentElement.style.display='none'">×</span>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Thoát
                    </button>
                    <!-- <button v-if="is_create == 0" disabled class="btn btn-danger">Thêm Mới</button> -->
                    <button v-on:click="taoDataDienVien()" class="btn btn-primary" data-bs-dismiss="modal">Thêm
                        Mới</button>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-1">
        <div class="col-12">
            <div class="card border-5 border-primary border-top">
                <div class="card-header d-flex justify-content-between">
                    <h5><b>DANH SÁCH DIỄN VIÊN</b></h5>
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
                                            <input v-on:keyup.enter="searchDienVien(1)" v-model="key_tim.key" type="text"
                                                class="form-control" placeholder="Nhập thông tin cần tìm" />
                                            <button class="btn btn-primary" v-on:click="searchDienVien(1)">
                                                <i class="fa-solid fa-magnifying-glass"></i>
                                            </button>
                                        </div>
                                    </th>
                                </tr>
                                <tr>
                                    <th class="text-center align-middle text-nowrap">#</th>
                                    <th class="text-left">Tên diễn viên</th>
                                    <th class="text-center align-middle text-nowrap">Năm sinh</th>
                                    <th class="text-center align-middle text-nowrap">Phim tham gia</th>
                                    <th class="text-center align-middle text-nowrap">Tình trạng</th>
                                    <th class="text-center align-middle text-nowrap">Xem chi tiết</th>
                                    <th class="text-center align-middle text-nowrap">Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(v, k) in list_dien_vien" :key="k">
                                    <td class="text-center align-middle text-nowrap">
                                        {{ k + 1 }}
                                    </td>
                                    <td class="align-middle text-wrap">{{ tenLimited(v.ten_dv) }}</td>
                                    <td class="align-middle text-wrap text-center">{{ v.nam_sinh }}</td>
                                    <td class="align-middle text-wrap text-primary">{{ phimsLimited(v.phims) }}</td>
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
                                        <button @click="Object.assign(obj_chi_tiet, v)" type="button"
                                            data-bs-toggle="modal" data-bs-target="#ChiTiet"
                                            class="btn btn-primary btn-sm radius-30 px-4">Xem chi
                                            tiết</button>
                                    </td>
                                    <td class="text-center align-middle text-nowrap">
                                        <i @click="Object.assign(obj_update_dien_vien, v);list_chon_update = v.idS;" type="button"
                                            data-bs-toggle="modal" data-bs-target="#Chinhsua"
                                            class="fa-solid fa-pen-to-square fa-2x text-warning me-2"></i>

                                        <i @click="Object.assign(obj_delete_dien_vien, v)" data-bs-target="#Xoa"
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
                    <div class="modal fade" id="ChiTiet" tabindex="-1" aria-labelledby="ChiTietLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="ChiTietLabel">Chi Tiết Diễn Viên</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <th class="text-nowrap" scope="row">Tên diễn viên</th>
                                                <td colspan="6" class="text-wrap">{{ obj_chi_tiet.ten_dv}}</td>
                                            </tr>
                                            <tr>
                                                <th class="text-nowrap" scope="row">Năm sinh</th>
                                                <td colspan="6">{{ obj_chi_tiet.nam_sinh }}</td>
                                            </tr>
                                            <tr>
                                                <th class="text-nowrap" scope="row">Phim tham gia</th>
                                                <td colspan="6">
                                                    <template v-for="(v, k) in obj_chi_tiet.phims" :key="k">
                                                        {{ v.ten_phim }},
                                                     </template>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="text-nowrap" scope="row">Trạng thái</th>
                                                <td colspan="6">
                                                    <a class="text">{{ obj_chi_tiet.tinh_trang == 1 ? 'Hoạt động' : 'Tạm tắt' }} </a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="Chinhsua" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">
                                        CHỈNH SỬA DIỄN VIÊN
                                    </h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="row">
                                            <div class="col-12">
                                                <label for="" class="form-label mb-1 mt-1">
                                                    <b>Tên Diễn Viên</b>
                                                </label>
                                                <input v-model="obj_update_dien_vien.ten_dv"
                                                    type="text" class="form-control" placeholder="Nhập tên diễn viên..." />
                                            </div>
                                            <div class="col-12">
                                                <label for="" class="form-label mb-1 mt-1">
                                                    <b>Mô Tả</b>
                                                </label>
                                                <textarea v-model="obj_update_dien_vien.mo_ta" class="form-control"
                                                    placeholder="Nhập mô tả..."></textarea>
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label mb-1 mt-1">
                                                    <b>Năm sinh</b>
                                                </label>
                                                <select v-model="obj_update_dien_vien.nam_sinh" class="form-control">
                                                    <option v-for="year in getYearsRange()" :value="year" :key="year">
                                                        {{ year }}
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label mb-1 mt-1">
                                                    <b>Tình trạng</b>
                                                </label>
                                                <select v-model="obj_update_dien_vien.tinh_trang" class="form-control">
                                                <option value="1">Hoạt động</option>
                                                <option value="0">Tạm Dừng</option>
                                                </select>
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label mb-1 mt-1">
                                                    <b>Phim tham gia</b>
                                                </label>
                                                <select v-model="choice" class="form-control" v-on:change="addPhimUpdate()">
                                                    <template v-for="(v, k) in list_phim" :key="k">
                                                        <option v-bind:value="v.id">{{ v.ten_phim }}</option>
                                                    </template>
                                                </select>
                                                <hr>
                                                <template v-for="(value, index) in list_phim" :key="index">
                                                    <div class="chip" v-if="list_chon_update.includes(value.id)"> {{ value.ten_phim }}
                                                        <span class="closebtn" v-on:click="removePhimUpdate(list_chon.indexOf(value.id))"
                                                            onclick="this.parentElement.style.display='none'">×</span>
                                                    </div>
                                                </template>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                                        Đóng
                                    </button>
                                    <button v-if="is_update == 0" disabled class="btn btn-danger">Lưu</button>
                                    <button v-else v-on:click="updateDienVien()" class="btn btn-primary"
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
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">
                                        Xoá Diễn Viên
                                    </h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body text-start">
                                    <div class="alert alert-danger" role="alert">
                                        Bạn có muốn xoá Diễn Viên <b>{{ obj_delete_dien_vien.ten_dv }}</b>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">
                                        Đóng
                                    </button>
                                    <button @click="deleteDienVien()" type="button" class="btn btn-danger"
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
import functionBasic from "../../../core/functionBasic";
import { createToaster } from "@meforma/vue-toaster";
const toaster = createToaster({
    position: "top-right",
});
export default {
    data() {
        return {
            is_create: 0,
            is_update: 1,
            choice: 0,
            list_chon: [],
            list_chon_update: [],
            list_phim: [],
            obj_chi_tiet: {},
            list_the_loai: [],
            list_tac_gia: [],
            list_dien_vien: [],
            obj_add_dien_vien: {},
            key_tim: {},
            obj_update_dien_vien: {},
            obj_delete_dien_vien: {},
            pagination: {
                last_page: "",
                per_page: "",
                current_page: "",
                last_page: "",
                from: "",
                to: "",
            },
            check_page: 0,
            maxChars: 20
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
        this.laydataDienVien(1);
    },
    methods: {
         getYearsRange() {
                const currentYear = new Date().getFullYear();
                const years = [];
                for (let year = 1960; year <= currentYear; year++) {
                    years.push(year);
                }
                return years;
            },
        addPhim() {
            if (!this.list_chon.includes(this.choice)) {
                this.list_chon.push(this.choice);
            }
        },
        addPhimUpdate() {
            if (!this.list_chon_update.includes(this.choice)) {
                this.list_chon_update.push(this.choice);
            }
        },
        removePhim(index) {
            this.list_chon.splice(index, 1)
        },
        removePhimUpdate(index) {
            this.list_chon_update.splice(index, 1)
        },
        tenphimLimited(tenphim) {
            if (tenphim.length > this.maxChars) {
                return tenphim.substring(0, this.maxChars) + '...';
            }
            return tenphim;
        },
        tenLimited(tenqg) {
            if (tenqg && tenqg.length > this.maxChars) {
                return tenqg.substring(0, 15) + '...';
            }
            return tenqg || ''; // Return an empty string if tenqg is undefined or null
        },
        phimsLimited(phims) {
                if (!Array.isArray(phims)) {
                    return ''; // Hoặc một giá trị mặc định khác nếu phims không phải là mảng
                }

                let concatenatedString = phims.map(t => t.ten_phim).join(', ');
                if (concatenatedString.length > this.maxChars) {
                    return concatenatedString.substring(0, this.maxChars) + '...';
                }
                return concatenatedString;
            },
        changPage(page) {
            if (this.check_page == 0) {
                this.laydataDienVien(page);
            } else if (this.check_page == 1) {
                this.searchDienVien(page);
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
            this.obj_add_dien_vien.slug_dien_vien = this.convertToSlug(
                this.obj_add_dien_vien.ten_dien_vien
            );
        },

        addSlugUpdate() {
            this.obj_update_dien_vien.slug_dien_vien = this.convertToSlug(
                this.obj_update_dien_vien.ten_dien_vien
            );
        },

        kiemTraSlug() {
            var payload = {
                slug: this.obj_add_dien_vien.slug_dien_vien,
            };
            baseRequest.post("admin/dien-vien/kiem-tra-slug", payload).then((res) => {
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
                slug: this.obj_update_dien_vien.slug_dien_vien,
                id: this.obj_update_dien_vien.id,
            };
            baseRequest
                .post("admin/dien-vien/kiem-tra-slug-update", payload)
                .then((res) => {
                    if (res.data.status) {
                        toaster.success(res.data.message);
                        this.is_update = 1;

                    } else {
                        toaster.error(res.data.message);
                        this.is_update = 1;

                    }
                });
        },
        laydataDienVien(page) {
            baseRequest.get("admin/dien-vien/lay-du-lieu?page=" + page).then((res) => {
                if (res.data.status == false) {
                    toaster.error(res.data.message);
                } else {
                    this.list_dien_vien = res.data.dien_vien_admin.dataAdmin.data;
                    this.pagination = res.data.dien_vien_admin.pagination;
                    this.list_phim = res.data.dataPhim;
                    this.list_dien_vien.forEach((value, index) => {
                        value.idS = value.phims.map(obj => obj.id_phim);
                    });
                }
            });
        },
        taoDataDienVien() {
            this.obj_add_dien_vien.phims = this.list_chon;
            baseRequest
                .post("admin/dien-vien/thong-tin-tao", this.obj_add_dien_vien)
                .then((res) => {
                    if (res.data.status == true) {
                        toaster.success(res.data.message);
                        this.obj_add_dien_vien = {};
                        this.laydataDienVien(this.pagination.last_page);
                    } else {
                        toaster.error(res.data.message);
                    }
                }).catch((err) => {
                    functionBasic.displayErrors(err);
                })
        },
        searchDienVien(page) {
            this.check_page = 1;
            baseRequest
                .post("admin/dien-vien/thong-tin-tim?page=" + page, this.key_tim)
                .then((res) => {
                    if (res.data.status == false) {
                    toaster.error(res.data.message);
                    } else {
                        this.list_dien_vien = res.data.dien_vien_admin.dataAdmin.data;
                        this.pagination = res.data.dien_vien_admin.pagination;
                        this.list_phim = res.data.dataPhim;
                        this.list_dien_vien.forEach((value, index) => {
                            value.idS = value.phims.map(obj => obj.id_phim);
                        });
                    }
                });
        },
        deleteDienVien() {
            baseRequest
                .delete("admin/dien-vien/thong-tin-xoa/" + this.obj_delete_dien_vien.id)
                .then((res) => {
                    if (res.data.status == true) {
                        toaster.success("Thông báo<br>" + res.data.message);
                        this.changPage(this.pagination.current_page);

                    } else {
                        toaster.danger("Thông báo<br>" + res.data.message);
                    }
                });
        },
        updateDienVien() {
            this.obj_update_dien_vien.phims = this.list_chon_update;
            baseRequest
                .post("admin/dien-vien/thong-tin-cap-nhat", this.obj_update_dien_vien)
                .then((res) => {
                    if (res.data.status == true) {
                        toaster.success("Thông báo<br>" + res.data.message);
                        this.changPage(this.pagination.current_page);
                    } else {
                        toaster.danger("Thông báo<br>" + res.data.message);
                    }
                }).catch((err) => {
                    functionBasic.displayErrors(err);
                })
        },

        doiTrangThai(xyz) {

            baseRequest
                .put("admin/dien-vien/thong-tin-thay-doi-trang-thai", xyz)
                .then((res) => {
                    if (res.data.status == true) {
                        toaster.success("Thông báo<br>" + res.data.message);
                        this.changPage(this.pagination.current_page);
                    } else {
                        toaster.error(res.data.message);
                    }
                });
        },
    },
};
</script>
<style lang=""></style>
