<template>
    <div class="row mt-1">
        <div class="col-12">
            <div class="card border-5 border-primary border-top">
                <div class="card-header d-flex justify-content-between">
                    <h5><b>DANH SÁCH PHIM CẦN LEECH TRÊN OPHIM</b></h5>
                    <div></div>
                    <h5><b>Tổng phim:</b> <span class="text-danger">{{ pagination.totalItems }}</span></h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-responsive">
                            <thead>
                                <tr>
                                    <th class="text-center align-middle text-nowrap">Thêm phim</th>
                                    <th class="text-left">Tên phim</th>
                                    <th class="text-center align-middle text-nowrap">Thumb</th>
                                    <th class="text-center align-middle text-nowrap">Poster</th>
                                    <th class="text-center align-middle text-nowrap">Ngày update</th>
                                    <th class="text-center align-middle text-nowrap">Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(v, k) in list_phim" :key="k">
                                    <td class="text-center align-middle text-nowrap">
                                        <button v-if="v.is_check == false" @click="leechStore(v.slug)"
                                            class="btn btn-primary btn-sm radius-30 px-4 ms-2" type="button">Thêm
                                            phim</button>
                                        <button v-else class="btn btn-secondary btn-sm radius-30 px-4 ms-2"
                                            type="button" data-bs-toggle="modal" data-bs-target="#XoaPhim">Đã
                                            Thêm</button>
                                        <!-- <button v-else @click="Object.assign(obj_delete_phim, v)"
                                            class="btn btn-danger btn-sm radius-30 px-4 ms-2" type="button"
                                            data-bs-toggle="modal" data-bs-target="#XoaPhim">Xoá phim</button> -->
                                    </td>
                                    <td class="align-middle text-wrap">{{ v.name }}</td>
                                    <td class="text-center align-middle">
                                        <img v-bind:src="pathImage + v.thumb_url" class="img-fluid" width="50"
                                            height="100" alt="product img">
                                    </td>
                                    <td class="text-center align-middle">
                                        <img v-bind:src="pathImage + v.poster_url" class="img-fluid" width="100"
                                            height="50" alt="product img">
                                    </td>
                                    <td class="align-middle text-wrap text-center">{{ convertDate(v.modified.time) }}
                                    </td>
                                    <td class="text-center align-middle text-wrap d-flex flex-column">
                                        <button @click="laydelistPhim(v.slug)" class="btn btn-info btn-sm  mb-2"
                                            type="button" data-bs-toggle="modal" data-bs-target="#ChiTiet">Chi
                                            tiết</button>
                                        <button v-show="v.is_check == true" @click="laytapPhim(v.slug)"
                                            data-bs-toggle="modal" data-bs-target="#ThemTap"
                                            class="btn btn-danger btn-sm  " type="button">Thêm
                                            Tập</button>

                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <nav aria-label="Table Paging" class="mb-0 text-headings">
                            <div class="card-footer text-end text-nowrap">
                                <button @click="changPage(pagination.currentPage - 1)"
                                    :disabled="pagination.currentPage <= 1" class="btn btn-secondary btn-sm me-2">
                                    Previous
                                </button>
                                <button class="btn btn-secondary btn-sm me-2" v-for="page in pageNumbers" :key="page"
                                    @click="page !== '...' && changPage(page)"
                                    :class="{ active: page === pagination.currentPage }">
                                    {{ page }}
                                </button>
                                <button @click="changPage(pagination.currentPage + 1)"
                                    :disabled="pagination.currentPage >= pagination.totalPages"
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
                                    <h1 class="modal-title fs-5" id="ChiTietLabel">Phim : <b class="text-primary">{{
                                        obj_chi_tiet.name }}</b></h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <th class="text-nowrap" scope="row">Thumbail</th>
                                                <td>
                                                    <img v-bind:src="obj_chi_tiet.thumb_url" class="img" alt="..."
                                                        style="max-height: 200px; max-width: 100px;">
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="text-nowrap" scope="row">Tên phim</th>
                                                <td colspan="6" class="text-wrap">{{ obj_chi_tiet.name }}</td>
                                            </tr>
                                            <tr>
                                                <th class="text-nowrap" scope="row">Thời lượng</th>
                                                <td colspan="6">{{ obj_chi_tiet.time }}</td>
                                            </tr>
                                            <tr>
                                                <th class="text-nowrap" scope="row">Năm sản xuất</th>
                                                <td colspan="6">{{ obj_chi_tiet.year }}</td>
                                            </tr>
                                            <tr>
                                                <th class="text-nowrap" scope="row">Số lượng tập</th>
                                                <td colspan="6">{{ obj_chi_tiet.episode_total }}</td>
                                            </tr>
                                            <tr>
                                                <th class="text-nowrap" scope="row">Loại phim</th>
                                                <td colspan="6">{{ obj_chi_tiet.type }}</td>
                                            </tr>
                                            <tr>
                                                <th class="text-nowrap" scope="row">Is phim chiếu rạp</th>
                                                <td colspan="6" class="text-wrap">{{ obj_chi_tiet.chieurap }}</td>
                                            </tr>
                                            <tr>
                                                <th class="text-nowrap" scope="row">Mô tả</th>
                                                <td colspan="6" class="text-wrap">{{ obj_chi_tiet.content }}</td>
                                            </tr>
                                            <tr>
                                                <th class="text-nowrap" scope="row">Đạo diễn</th>
                                                <td colspan="6">{{ obj_chi_tiet.director && obj_chi_tiet.director.length
                                                    > 0 ? obj_chi_tiet.director[0] : 'Đang cập nhật' }}</td>
                                            </tr>
                                            <tr>
                                                <th class="text-nowrap" scope="row">Trailer</th>
                                                <td colspan="6">{{ obj_chi_tiet.trailer_url ? obj_chi_tiet.trailer_url : 'Đang cập nhật' }}</td>
                                            </tr>

                                            <tr>
                                                <th class="text-nowrap" scope="row">Quốc gia</th>
                                                <td colspan="6">{{ obj_chi_tiet.country && obj_chi_tiet.country.length >
                                                    0 ? obj_chi_tiet.country[0].name : 'Đang cập nhật' }}</td>
                                            </tr>
                                            <tr>
                                                <th class="text-nowrap" scope="row">Thể loại</th>
                                                <td colspan="6">
                                                    <template v-for="(v, k) in obj_chi_tiet.category" :key="k">
                                                        {{ v.name }},
                                                    </template>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="text-nowrap" scope="row">Ngôn ngữ</th>
                                                <td colspan="6">{{ obj_chi_tiet.lang }}</td>
                                            </tr>
                                            <tr>
                                                <th class="text-nowrap" scope="row">Trạng thái</th>
                                                <td colspan="6">
                                                    <a class="text">{{ obj_chi_tiet.status }} </a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="XoaPhim" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">
                                        Xoá Phim <b class="text-danger">{{ obj_delete_phim.name }}</b>
                                    </h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body text-start">
                                    <div class="alert alert-danger" role="alert">
                                        <h6>Khi xoá phim sẽ xoá tất cả tập phim của phim đó</h6>
                                        Bạn có muốn xoá Phim?
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
                    <div class="modal fade" id="ThemTap" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">
                                        Thêm tập Phim : <b class="text-primary">{{ obj_chi_tiet.name }}</b>
                                    </h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <table class="table table-hover table-responsive table-bordered">
                                                        <template v-for="(v, k) in list_tap_phim" :key="k">
                                                            <thead>
                                                                <tr class="table-active">
                                                                    <th class="text-center align-middle">Sever Phim
                                                                    </th>
                                                                    <th class="text-center align-middle">Tên phim</th>
                                                                    <th class="text-center align-middle">Tổng Số tập
                                                                    </th>
                                                                    <th class="text-center align-middle">Trạng thái</th>
                                                                    <th class="text-center align-middle">Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <th class=" text-nowrap">
                                                                        <template v-for="(v1, k1) in v.server_data"
                                                                            :key="k1">
                                                                            <ul
                                                                                style="list-style-type: none;padding-left:0">
                                                                                <li
                                                                                    style="margin-bottom: 10px;display:flex;align-items:center">
                                                                                    <span style="margin-right:10px">Tập
                                                                                        {{ v1.name }}</span>
                                                                                    <input type="text"
                                                                                        class="form-control"
                                                                                        v-model="v1.link_embed">
                                                                                </li>
                                                                            </ul>
                                                                        </template>
                                                                    </th>
                                                                    <td class=" text-wrap">{{
                                                                        obj_chi_tiet.name }}</td>
                                                                    <td class="text-center">{{
                                                                        obj_chi_tiet.episode_total }}</td>
                                                                    <td class="text-center text-nowrap text-center">
                                                                        <button
                                                                            v-if="obj_chi_tiet.status === 'completed'"
                                                                            class="badge rounded-pill text-success bg-light-success p-2 text-uppercase px-3"
                                                                            style="border: none">
                                                                            Hoàn Thành
                                                                        </button>
                                                                        <button v-else
                                                                            class="badge rounded-pill text-warning bg-light-success p-2 text-uppercase px-3"
                                                                            style="border: none">
                                                                            Chưa Hoàn Thành
                                                                        </button>
                                                                    </td>
                                                                    <td class="text-center text-nowrap">
                                                                        <button class="btn btn-primary btn-sm" @click="leechTapStore(obj_chi_tiet.slug)"> Thêm Tập
                                                                            Phim</button>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </template>

                                                    </table>
                                                    <!-- <nav aria-label="Table Paging" class="mb-0 text-headings">
                                                        <div class="card-footer text-end text-nowrap">
                                                            <button
                                                                @click="changPageTapPhim(pagination_tap_phim.current_page - 1)"
                                                                :disabled="pagination_tap_phim.current_page <= 1"
                                                                class="btn btn-secondary btn-sm me-2">
                                                                Previous
                                                            </button>
                                                            <button class="btn btn-secondary btn-sm me-2"
                                                                v-for="page in pageNumbersTapPhim" :key="page"
                                                                @click="page !== '...' && changPageTapPhim(page)"
                                                                :class="{ active: page === pagination_tap_phim.current_page }">
                                                                {{ page }}
                                                            </button>
                                                            <button
                                                                @click="changPageTapPhim(pagination_tap_phim.current_page + 1)"
                                                                :disabled="pagination_tap_phim.current_page >= pagination_tap_phim.last_page"
                                                                class="btn btn-secondary btn-sm me-2">
                                                                Next
                                                            </button>
                                                        </div>
                                                    </nav> -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                        Đóng
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
            obj_chi_tiet: {},
            list_phim_check: [],
            list_phim: [],
            list_tap_phim: [],
            obj_delete_phim: {},
            pagination: {
                totalPages: "",
                per_page: "",
                currentPage: 1,
                totalPages: "",
                from: "",
                to: "",
            },
            check_page: 0,
            maxChars: 30,
            pathImage: ""
        };
    },
    computed: {
        pageNumbers() {
            let pages = [];
            for (let i = 1; i <= this.pagination.totalPages; i++) {
                pages.push(i);
            }
            return pages;
        },

        // Tính toán các số trang để hiển thị
        pageNumbers() {
            let pages = [];
            if (this.pagination.totalPages <= 3) {
                // Nếu tổng số trang <= 3, hiển thị tất cả các trang
                for (let i = 1; i <= this.pagination.totalPages; i++) {
                    pages.push(i);
                }
            } else {
                if (this.pagination.currentPage <= 3) {
                    // Người dùng đang ở ba trang đầu
                    let maxPage = Math.min(3, this.pagination.totalPages); // Đảm bảo không vượt quá tổng số trang
                    for (let i = 1; i <= maxPage; i++) {
                        pages.push(i);
                    }
                    if (this.pagination.totalPages > 3) {
                        pages.push("...");
                        pages.push(this.pagination.totalPages);
                    }
                } else if (
                    this.pagination.currentPage >=
                    this.pagination.totalPages - 2
                ) {
                    // Người dùng đang ở ba trang cuối
                    pages.push(1);
                    if (this.pagination.totalPages > 3) {
                        pages.push("...");
                    }
                    let minPage = Math.max(this.pagination.totalPages - 3, 1); // Đảm bảo không nhỏ hơn trang đầu tiên
                    for (let i = minPage; i <= this.pagination.totalPages; i++) {
                        pages.push(i);
                    }
                } else {
                    // Người dùng đang ở các trang giữa
                    pages.push(1);
                    pages.push("...");
                    for (
                        let i = this.pagination.currentPage - 1;
                        i <= this.pagination.currentPage + 1;
                        i++
                    ) {
                        pages.push(i);
                    }
                    pages.push("...");
                    pages.push(this.pagination.totalPages);
                }
            }
            return pages;
        },
    },
    async mounted() {
        await this.laydataPhimCheck();
        this.laydataPhim(1);
    },
    methods: {
        convertDate(dateString) {
            let date = new Date(dateString);
            let day = ("0" + date.getDate()).slice(-2);
            let month = ("0" + (date.getMonth() + 1)).slice(-2);
            let year = date.getFullYear();
            let hours = ("0" + date.getHours()).slice(-2);
            let minutes = ("0" + date.getMinutes()).slice(-2);
            let seconds = ("0" + date.getSeconds()).slice(-2);

            return `${day}/${month}/${year} `;
        },
        tenphimLimited(tenphim) {
            if (tenphim.length > this.maxChars) {
                return tenphim.substring(0, this.maxChars) + '...';
            }
            return tenphim;
        },
        tenLimited(tenqg) {
            if (tenqg && tenqg.length > this.maxChars) {
                return tenqg.substring(0, 30) + '...';
            }
            return tenqg || ''; // Return an empty string if tenqg is undefined or null
        },
        theloaisLimited(theLoais) {
            if (!Array.isArray(theLoais)) {
                return ''; // Hoặc một giá trị mặc định khác nếu theLoais không phải là mảng
            }

            let concatenatedString = theLoais.map(t => t.ten_the_loai).join(', ');
            if (concatenatedString.length > this.maxChars) {
                return concatenatedString.substring(0, this.maxChars) + '...';
            }
            return concatenatedString;
        },
        changPage(page) {
            if (this.check_page == 0) {
                this.laydataPhim(page);
            } else if (this.check_page == 1) {
                this.searchPhim(page);
            }
        },
        laydataPhimCheck() {
            return baseRequest
                .get("admin/leech-phim/phim-data")
                .then((res) => {
                    this.list_phim_check = res.data.data;
                })
                .catch((res) => {
                    const errors = Object.values(res.response.data.errors);
                    toaster.error(errors[0]);
                });
        },
        async laydataPhim(page) {
            try {
                const res = await axios.get(`https://ophim1.com/danh-sach/phim-moi-cap-nhat?page=${page}`);

                if (!res.data.status) {
                    toaster.error(res.data.message);
                    return;
                }

                this.list_phim = res.data.items;

                // Sử dụng Set để tối ưu hóa việc kiểm tra `slug_phim`
                const checkedSlugs = new Set(this.list_phim_check.map(item => item.slug_phim));

                this.list_phim.forEach((value) => {
                    value.is_check = checkedSlugs.has(value.slug);
                });

                this.pagination = res.data.pagination;
                this.pathImage = res.data.pathImage;

            } catch (error) {
                toaster.error("Không thể tải dữ liệu phim.");
            }
        },

        async laydelistPhim(slug) {
            try {
                const res = await axios.get(`https://ophim1.com/phim/${slug}`);

                if (!res.data.status) {
                    toaster.error(res.data.message);
                    return;
                }

                this.obj_chi_tiet = res.data.movie || {};

            } catch (error) {
                toaster.error("Không thể tải chi tiết phim.");
            }
        },
        async laytapPhim(slug) {
            try {
                const res = await axios.get(`https://ophim1.com/phim/${slug}`);

                if (!res.data.status) {
                    toaster.error(res.data.message);
                    return;
                }

                this.list_tap_phim = res.data.episodes || [];
                this.obj_chi_tiet = res.data.movie || {};


            } catch (error) {
                toaster.error("Không thể tải chi tiết phim.");
            }
        },

        async leechStore(slug) {
            try {
                const payload = { slug };
                const res = await baseRequest.post("admin/leech-phim/store", payload);

                if (res.data.status) {
                    toaster.success(res.data.message);
                    await this.laydataPhimCheck();
                    await this.laydataPhim(this.pagination.currentPage);
                } else {
                    toaster.error(res.data.message);

                }

            } catch (error) {
                const errors = Object.values(error.response?.data?.errors || []);
                await this.laydataPhimCheck();
                await this.laydataPhim(this.pagination.currentPage);
                toaster.error(errors[0] || "Lỗi không xác định.");
            }
        },

        async leechTapStore(slug) {
            try {
                const payload = { slug };
                const res = await baseRequest.post("admin/leech-phim/store-tap-phim", payload);

                if (res.data.status) {
                    toaster.success(res.data.message);
                    await this.laydataPhim(this.pagination.currentPage);
                } else {
                    toaster.error(res.data.message);
                }

            } catch (error) {
                const errors = Object.values(error.response?.data?.errors || []);
                toaster.error(errors[0] || "Lỗi không xác định.");
            }
        },

        deletePhim() {
            baseRequest
                .post("admin/leech-phim/xoa-phim", this.obj_delete_phim)
                .then((res) => {
                    if (res.data.status == true) {
                        toaster.success("Thông báo<br>" + res.data.message);
                        this.changPage(this.pagination.current_page);
                    } else {
                        toaster.danger("Thông báo<br>" + res.data.message);
                    }
                });
        },

    },
};
</script>
<style></style>
