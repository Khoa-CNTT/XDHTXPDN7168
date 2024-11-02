<template>
    <div class="breadcrumb-option" style="background-color: #0b0c2a">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <router-link to="/"><i class="fa fa-home"></i> Home</router-link>
                        <!-- <router-link :to="{ name: 'PageList', params: { id: v.id_tl, slug: v.slug_the_loai }}"> {{  v.ten_the_loai }}</router-link> -->
                        <span>{{ obj_phim.ten_phim }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Anime Section Begin -->
    <section class="anime-details spad" style="background-color: #0b0c2a">
        <div class="container">
            <div class="anime__details__content">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="anime__details__pic set-bg" v-bind:style="{
                            'background-image': 'url(' + obj_phim.hinh_anh + ')',
                        }" data-setbg="../../../assets/assets_Anime/img/anime/details-pic.jpg"></div>
                    </div>
                    <div class="col-lg-9">
                        <div class="anime__details__text">
                            <div class="anime__details__title mb-4">
                                <h3 style="padding-right: 168px;">{{ obj_phim.ten_phim }}</h3>
                                <p>
                                    <span>{{ obj_phim.dao_dien }}</span>
                                </p>
                            </div>
                            <div class="anime__details__rating" type="button">
                                <div class="rating" data-bs-toggle="modal" data-bs-target="#ratingFilm">
                                    <a v-for="star in 5" :key="star">
                                        <i class="fa" :class="{
                                            'fa-star': star <= Math.floor(averageRating), // Full stars for whole numbers
                                            'fa-star-half-o':
                                                star === Math.ceil(averageRating) &&
                                                averageRating % 1 !== 0, // Half star if the rating has a fraction
                                            'fa-star-o': star > averageRating, // Empty stars
                                        }"></i>
                                    </a>
                                </div>
                                <span>({{ ratingCount }} lượt, đánh giá:
                                    {{ averageRating.toFixed(1) }}/5)</span>
                            </div>
                            <p class="protection" v-html="obj_phim.mo_ta"></p>
                            <div class="anime__details__widget">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <ul>
                                            <li><span>Quốc gia:</span> {{ obj_phim.quoc_gia }}</li>
                                            <li>
                                                <span>Loại Phim:</span>{{ obj_phim.ten_loai_phim }}
                                            </li>

                                            <li>
                                                <span>Trạng Thái:</span>
                                                {{
                                                    (obj_phim.tong_tap = obj_phim.so_tap_phim
                                                        ? "Đang cập nhật"
                                                        : "Đã hoàn thành")
                                                }}
                                            </li>
                                            <li>
                                                <span>Thể Loại:</span> {{ obj_phim.ten_the_loais }},
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <ul>
                                            <li>
                                                <span>Tổng Số Tập:</span> {{ obj_phim.so_tap_phim }}
                                            </li>
                                            <li>
                                                <span>Thời Lượng:</span>
                                                {{ obj_phim.thoi_gian_chieu }} phút/tập
                                            </li>
                                            <li><span>Chất lượng:</span>1080 P</li>
                                            <li>
                                                <span>Luợt Xem:</span> {{ obj_phim.tong_luong_xem }}
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="anime__details__btn">
                                <button v-if="isFollow" type="button" @click="anTheoDoi()" class="unfollow-btn">
                                    <i class="fa fa-heart-o"></i> Theo Dõi
                                </button>
                                <button v-else type="button" @click="unTheoDoi()" class="follow-btn">
                                    <i class="fa-solid fa-heart"></i> Bỏ Theo Dõi
                                </button>
                                <template v-if="isUserTurmed == false">
                                    <a data-bs-toggle="modal" type="button" @click="checkUserTerm()" data-bs-target="#"
                                        class="watch-btn"><span>Xem
                                            Ngay</span>
                                    </a>
                                </template>
                                <template v-else>
                                    <router-link :to="`/${obj_phim.slug_phim}/${tap_phim.slug_tap_phim}`">
                                        <a v-bind:href="obj_phim.slug_phim" class="watch-btn"><span>Xem
                                                Ngay</span>
                                        </a>
                                    </router-link>
                                </template>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 col-md-8">
                    <div class="anime__details__review">
                        <div class="section-title">
                            <h5>Các Đánh Giá</h5>
                        </div>
                        <template v-for="(v, k) in list_cmt" :key="k">
                            <div v-if="v.id_phim == obj_phim.id" class="anime__review__item">
                                <div class="anime__review__item__pic">
                                    <img v-bind:src="v.avatar" alt="" />
                                </div>
                                <div class="anime__review__item__text">
                                    <div class="row">
                                        <div class="col-12">
                                            <h6>
                                                {{ v.ho_va_ten
                                                }}<span style="font-size: 0.9rem">
                                                    - {{ fromNow(v.created_at) }}</span><span style="font-size: 0.9rem"
                                                    v-if="v.updated_at > v.created_at">
                                                    ( Đã chỉnh sửa )</span>
                                            </h6>
                                            <p v-if="editingCommentId !== v.id" class="textwrap">
                                                {{ v.noi_dung }}
                                            </p>
                                            <textarea v-if="editingCommentId === v.id" v-model="obj_update_cmt.noi_dung"
                                                placeholder="Nhập bình luận" class="form-control"></textarea>
                                            <div style="float: right" class="mt-1">
                                                <template v-if="id_user == v.id_khach_hang">
                                                    <a type="button" class="text-primary mr-3" style="font-size: 1rem"
                                                        v-if="editingCommentId !== v.id"
                                                        v-on::click.prevent="beginEdit(v)"><i
                                                            class="fa-solid fa-pen mt-4"></i></a>
                                                </template>
                                                <template v-if="id_user == v.id_khach_hang">
                                                    <a type="button" v-on::click="Object.assign(obj_xoa_cmt, v)"
                                                        data-bs-toggle="modal" data-bs-target="#delCMT"
                                                        style="font-size: 1rem" class="mr-3 text-danger"
                                                        v-if="editingCommentId !== v.id"><i
                                                            class="fa-solid fa-trash mt-4"></i></a>
                                                </template>
                                                <div class="container" v-if="editingCommentId === v.id">
                                                    <a type="button" class="mr-3 text-primary" style="font-size: 1rem"
                                                        v-on::click.prevent="cancelEdit()">Hủy</a>
                                                    <a type="button" class="mr-3 text-primary" style="font-size: 1rem"
                                                        v-on::click.prevent="updateRating()">Lưu</a>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- <div class="col-1">
                                            <a v-if="v.id_khach_hang == id_user" type="button"
                                                click="Object.assign(obj_xoa_cmt, v)" data-bs-toggle="modal"
                                                data-bs-target="#delCMT" style="color: red;"><i
                                                    class="fa-solid fa-trash fa-sm mt-4 "></i></a>

                                        </div> -->
                                    </div>
                                </div>
                            </div>
                        </template>
                        <div class="text-center" v-if="list_cmt.length === 0">
                            <h4 class="text-light">Không có đánh giá</h4>
                        </div>
                        <!-- Nút Tải thêm bình luận -->
                        <div class="text-center mt-3" v-if="hasMoreComments">
                            <button @click="taiThemCMT()" class="btn btn-primary">Tải thêm bình luận</button>
                        </div>
                    </div>
                    <!-- <div class="anime__details__form">
                        <div class="section-title">
                            <h5>Bình Luận của Bạn</h5>
                        </div>
                        <form action="#">
                            <textarea v-model="obj_cmt_phim.noi_dung" placeholder="Nhập bình luận"></textarea>
                            <button click="addRating()" type="button"><i class="fa fa-location-arrow"></i>
                                Gửi</button>
                        </form>
                    </div> -->
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="anime__details__sidebar">
                        <div class="section-title">
                            <h5>hot phim</h5>
                        </div>
                        <template v-for="(v, k) in list_5_phim" :key="k">
                            <div class="product__sidebar__comment__item">
                                <router-link :to="v.slug_phim">
                                    <a v-bind:href="v.slug_phim">
                                        <div class="product__sidebar__comment__item__pic">
                                            <img v-bind:src="v.hinh_anh" style="width: 99px" alt="" />
                                        </div>
                                    </a>
                                </router-link>

                                <div style="" class="product__sidebar__comment__item__text">
                                    <ul>
                                        <!-- <li >{{ v.ten_loai_phim }}</li> -->
                                        <template v-for="(value, key) in v.ten_the_loais" :key="key">
                                            <li>{{ value }}</li>
                                        </template>
                                    </ul>
                                    <h5>
                                        <router-link :to="v.slug_phim">
                                            {{ v.ten_phim }}
                                        </router-link>
                                    </h5>
                                    <div style="color: #b7b7b7">
                                        Số Tập: {{ v.tong_tap }} / {{ v.so_tap_phim }}
                                    </div>
                                    <span><i class="fa fa-eye"></i> {{ v.tong_luong_xem }} lượt
                                        xem</span>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
                <!-- Modal xoa binh luan -->
                <div class="modal fade" id="delCMT" tabindex="-1" aria-labelledby="delCMTLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div style="background-color: rgba(35, 33, 33, 1)" class="modal-content">
                            <div class="modal-body text-white">
                                Bạn có chắc muốn xoá bình luận?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                    Đóng
                                </button>
                                <button type="button" v-on:click="deleteRating()" class="btn btn-primary"
                                    data-bs-dismiss="modal">
                                    Xoá
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal Rating Phim -->
                <div class="modal fade" id="ratingFilm" tabindex="-1" aria-labelledby="ratingFilmLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div style="background-color: rgba(35, 33, 33, 1)" class="modal-content">
                            <div class="modal-body text-white">
                                <div class="product__sidebar__comment">
                                    <div class="section-title">
                                        <h5>ĐÁNH GIÁ</h5>
                                    </div>
                                    <div class="rating-container">
                                        <div class="stars">
                                            <span v-for="star in stars" :key="star"
                                                :class="{ 'star-active': star <= rating }" @click="setRating(star)"
                                                @mouseover="hoverRating(star)" @mouseleave="resetRating">
                                                &#9733;
                                            </span>
                                        </div>
                                        Đánh giá: {{ rating }} sao
                                    </div>
                                    <textarea v-model="obj_cmt_phim.noi_dung" placeholder="Nhập đánh giá của bạn!"
                                        class="form-control w-100 mt-3"></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                    Đóng
                                </button>
                                <button type="button" @click="addRating()" class="btn btn-primary"
                                    data-bs-dismiss="modal">
                                    Đánh Giá
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modalBuyVip" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="modalBuyVipLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div style="background-color: rgba(35, 33, 33, 0.8);" class="modal-content">
                    <div class="modal-body ">
                        <div class="product__sidebar__comment">
                            <div class="section-title ">
                                <h5>Danh Sách Phim Yêu Thích Của Bạn</h5>
                            </div>
                            <div class="row sctrollspy-example" data-bs-spy="sctroll">

                            </div>
                        </div>
                    </div>
                    <!-- <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Đóng</button>
                                </div> -->
                </div>
            </div>
        </div>
    </section>
    <!-- Anime Section End -->
</template>
<script>
import moment from "moment";
import "moment/locale/vi"; // Import ngôn ngữ tiếng Việt nếu cần
import axios from "axios";
import baseRequest from "../../../core/baseRequestUser";
import { createToaster } from "@meforma/vue-toaster";
const toaster = createToaster({
    position: "top-right",
});

export default {
    props: ["slug"],
    beforeRouteUpdate(to, from, next) {
        this.limit = 2;    // Số lượng bình luận muốn tải mỗi lần
        this.slug = to.params.slug;
        //   this.id_phim   = this.id;
        this.obj_yt_phim = { id_khach_hang: localStorage.getItem("id_user") };
        this.obj_cmt_phim = { id_khach_hang: localStorage.getItem("id_user") };
        this.laydataCMT();
        this.laydataDelistPhim();
        this.checkYeuThich();
        next();
    },
    data() {
        return {
            limit: 2,    // Số lượng bình luận muốn tải mỗi lần
            hasMoreComments: true, // Kiểm tra xem có còn bình luận để tải không
            isUserTurmed: false,
            ratingCount: 0,
            averageRating: 0,
            rating: 0,
            tempRating: 0,
            stars: [1, 2, 3, 4, 5], // 5 ngôi sao
            isRatingSelected: false,
            editingCommentId: null,
            slug: this.$route.params.slug,
            id_phim: "",
            id_user: localStorage.getItem("id_user"),
            obj_yt_phim: { id_khach_hang: localStorage.getItem("id_user") },
            obj_cmt_phim: { id_khach_hang: localStorage.getItem("id_user") },
            obj_xoa_cmt: {},
            tap_phim: {},
            obj_update_cmt: {},
            list_5_phim: [],
            obj_phim: {},
            list_cmt: [],
            isFollow: true,
        };
    },
    mounted() {
        this.$store.dispatch('showLoader');
        this.checkYeuThich();
        this.laydataCMT();
        this.laydataDelistPhim();
    },
    methods: {
        checkUserTerm() {
            baseRequest
                .post("check-user-term")
                .then((res) => {
                    if (res.data.status === 0) {
                        toaster.error(res.data.message);
                        this.$router.push('/login'); // Ẩn loader nếu có listring
                    }
                    else if (res.data.status === 2) {
                        $("#modalBuyVip").modal("show");
                        toaster.warning(res.data.message);

                    }
                    else {
                        alert("Đã xảy ra lỗi, vui lòng thử lại sau");
                        window.location.reload();
                    }

                })
        },
        fromNow: function (datetime) {
            moment.locale("vi");
            return moment(datetime).fromNow();
        },
        beginEdit(comment) {
            this.editingCommentId = comment.id;
            this.obj_update_cmt = Object.assign({}, comment);
        },
        cancelEdit() {
            this.editingCommentId = null;
            this.obj_update_cmt = {};
        },
        // Khi người dùng nhấp vào ngôi sao, set giá trị rating đã chọn
        setRating(star) {
            this.rating = star;
            this.isRatingSelected = true; // Đánh dấu đã chọn số sao
        },
        // Khi hover, chỉ hiển thị giá trị rating tạm thời (hover) nếu chưa chọn số sao
        hoverRating(star) {
            if (!this.isRatingSelected) {
                this.hoverRatingValue = star; // Hiển thị giá trị khi hover
            }
        },
        // Khi di chuột ra khỏi các ngôi sao, reset về giá trị rating đã chọn trước đó
        resetRating() {
            if (!this.isRatingSelected) {
                this.hoverRatingValue = 0; // Reset giá trị tạm thời khi hover
            }
        },
        scrollToTop() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth', // Thêm hiệu ứng cuộn
            });
        },
        laydataDelistPhim() {
            var params = {
                slug: this.slug,
            };
            baseRequest
                .post("phim/lay-data-delist", params)
                .then((res) => {
                    this.obj_phim = res.data.phim;
                    this.tap_phim = res.data.tap;
                    this.obj_cmt_phim.id_phim = res.data.phim.id;
                    this.obj_yt_phim.id_phim = res.data.phim.id;
                    this.list_5_phim = res.data.phim_5_obj;
                    this.list_5_phim.forEach((value, index) => {
                        value.ten_the_loais = value.ten_the_loais.split(",");
                    });
                    this.$store.dispatch('hideLoader');
                    this.scrollToTop();
                    this.isUserTurmed = res.data.isUserTurmed;

                }).catch(() => {
                    this.$router.push('/'); // Ẩn loader nếu có listring
                    this.$store.dispatch('hideLoader'); // Ẩn loader nếu có lỗi
                });
        },
        taiThemCMT() {
            this.limit += this.limit;
            this.laydataCMT();
        },
        laydataCMT() {
            axios
                .get("http://127.0.0.1:8000/api/binh-luan-phim/lay-du-lieu-show", {
                    params: {
                        limit: this.limit,
                        slug: this.slug,
                    },
                })
                .then((res) => {
                    var countCMTend = Number(res.data?.rate?.[0]?.tong_so_luot_danh_gia) || 0;
                    var countCMTbegin = Array.isArray(res.data?.binh_luan_phim) ? res.data.binh_luan_phim.length : 0;

                    if (countCMTbegin >= countCMTend) {
                        this.hasMoreComments = false;
                    }

                    this.list_cmt = Array.isArray(res.data?.binh_luan_phim) ? res.data.binh_luan_phim : [];

                    if (res.data?.rate?.[0]) {
                        this.ratingCount = res.data.rate[0].tong_so_luot_danh_gia;
                        this.averageRating = Number(res.data.rate[0].so_sao_trung_binh);
                    } else {
                        this.ratingCount = 0;
                        this.averageRating = 0;
                    }

                }).catch(() => {
                    toaster.warning("Đã xảy ra lỗi, vui lòng thử lại sau");
                    this.$router.push('/'); // Ẩn loader nếu có listring
                });
        },
        checkYeuThich() {
            var payload = {
                slug: this.slug,
            };
            baseRequest
                .post("khach-hang/yeu-thich/kiem-tra", payload)
                .then((res) => {
                    if (res.data.status == true) {
                        this.isFollow = false;
                    } else {
                        this.isFollow = true;
                    }
                });
        },
        anTheoDoi() {
            var payload = {
                id_phim: this.obj_phim.id,
            };
            baseRequest
                .post("khach-hang/yeu-thich/thong-tin-tao", payload)
                .then((res) => {
                    if (res.data.status == true) {
                        toaster.success(res.data.message);
                        this.checkYeuThich();
                    } else {
                        toaster.error(res.data.message);
                        this.$router.push('/login');
                    }
                    this.scrollToTop();
                });
        },

        unTheoDoi() {
            baseRequest
                .post("khach-hang/yeu-thich/thong-tin-xoa", this.obj_yt_phim)
                .then((res) => {
                    if (res.data.status == true) {
                        toaster.success(res.data.message);
                        this.checkYeuThich();
                    } else {
                        toaster.danger(res.data.message);
                        this.$router.push('/login');
                    }
                    this.scrollToTop();
                });
        },
        addRating() {
            var payload = {
                id_phim: this.obj_phim.id,
                noi_dung: this.obj_cmt_phim.noi_dung,
                so_sao: this.rating,
            };
            baseRequest
                .post("khach-hang/binh-luan-phim/thong-tin-tao", payload)
                .then((res) => {
                    if (res.data.status == true) {
                        toaster.success(res.data.message);
                        this.limit = 2;
                        this.hasMoreComments = true;
                        this.obj_cmt_phim = {};
                        this.rating = 0;
                        this.laydataCMT();
                    } else {
                        toaster.error(res.data.message);
                    }
                    this.scrollToTop();
                }).catch((res) => {
                    var errors = Object.values(res.response.data.errors);
                    toaster.error(errors[0]);
                });
        },
        deleteRating() {
            baseRequest
                .post(
                    "khach-hang/binh-luan-phim/thong-tin-xoa", this.obj_xoa_cmt
                )
                .then((res) => {
                    if (res.data.status == true) {
                        // toaster.success(res.data.message);
                        this.laydataCMT();
                        // window.location.reload();
                    } else {
                        toaster.danger(res.data.message);
                    }
                }).catch((res) => {
                    var errors = Object.values(res.response.data.errors);
                    toaster.error(errors[0]);
                });
        },
        updateRating() {
            baseRequest
                .put("khach-hang/binh-luan-phim/thong-tin-sua", this.obj_update_cmt)
                .then((res) => {
                    if (res.data.status == true) {
                        toaster.success(res.data.message);
                        this.cancelEdit();
                        this.laydataCMT();
                    } else {
                        toaster.danger(res.data.message);
                    }
                }).catch((res) => {
                    var errors = Object.values(res.response.data.errors);
                    toaster.error(errors[0]);
                });
        },
    },
};
</script>
<style>
.product__sidebar__comment__item__text h5 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: normal;
}

.protection {
    display: -webkit-box;
    -webkit-line-clamp: 7;
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: normal;
}

.anime_details_title h3 {
    word-wrap: break-word;
    white-space: normal;
}


.rating-container {
    display: inline-block;
}

.stars {
    display: flex;
    gap: 5px;
    font-size: 40px;
}

.stars span {
    cursor: pointer;
    color: lightgray;
    transition: color 0.2s ease;
}

.stars span.star-active {
    color: gold;
}

.textwrap {
    word-wrap: break-word;
    /* Tự động xuống dòng khi từ quá dài */
    word-break: break-word;
    /* Cắt từ khi cần thiết để không tràn khỏi vùng chứa */
    white-space: normal;
    /* Cho phép xuống hàng tự động */
}
</style>
