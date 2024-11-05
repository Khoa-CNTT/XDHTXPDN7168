<template>
    <div>
        <!-- Hero Section Begin -->
        <section class="hero" style="background-color: #0b0c2a">
            <div class="container">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active" data-interval="2000">
                            <img src="https://s199.imacdn.com/vg/2023/10/15/db226b83e19a0db4_de40f7bcb1b25a83_38908116973670493118684.jpg"
                                class="d-block w-100" alt="..." />
                        </div>
                        <div class="carousel-item" data-interval="2000">
                            <img src="https://s199.imacdn.com/vg/2023/12/28/f4e15980a7b1abbf_fdd63a20e3d8d9cf_1945637170376963341.jpg"
                                class="d-block w-100" alt="..." />
                        </div>
                        <div class="carousel-item" data-interval="2000">
                            <img src="https://s199.imacdn.com/vg/2023/10/25/3bf3b03a63b3cacc_996e45a57ccb35dd_30496816982129028118684.jpg"
                                class="d-block w-100" alt="..." />
                        </div>
                        <div class="carousel-item" data-interval="2000">
                            <img src="https://s199.imacdn.com/vg/2023/10/15/3fbae7beddcc5654_997100d400a26fe7_29875616973672775118684.jpg"
                                class="d-block w-100" alt="..." />
                        </div>
                        <div class="carousel-item" data-interval="2000">
                            <img src="https://s199.imacdn.com/vg/2023/10/15/a1e02d861cfd2757_b37b7dd1c0ade623_32888916973670718118684.jpg"
                                class="d-block w-100" alt="..." />
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </section>
        <!-- Hero Section End -->

        <!-- Product Section Begin -->
        <section class="product spad" style="background-color: #0b0c2a">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="trending__product">
                            <div class="row">
                                <div class="col-lg-8 col-md-8 col-sm-8">
                                    <div class="section-title">
                                        <h4>Phim Mới Cập Nhật</h4>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    <div class="btn__all">
                                        <router-link to="/tat-ca-phim">
                                            <a class="primary-btn">View All <span class="arrow_right"></span></a>
                                        </router-link>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <template v-for="(v, k) in phim_moi_cap_nhats" :key="k">
                                    <div v-show="v.tong_tap > 0 && k < 6" class="col-lg-4 col-md-6 col-sm-6">
                                        <router-link :to="v.slug_phim">
                                            <div class="product__item">
                                                <div class="product__item__pic set-bg"
                                                    style="background-image: url('undefined')">
                                                    <a><img style="height: 100%; width: 230px" v-bind:src="v.hinh_anh"
                                                            alt="" /></a>
                                                    <div class="ep">{{ v.tong_tap }}/{{ v.so_tap_phim }}
                                                        <span v-if="v.tong_tap == v.so_tap_phim">FULL</span>
                                                    </div>
                                                    <div class="comment b">{{ v.ten_loai_phim }}</div>
                                                    <div class="view"><i class="fa fa-eye"></i> {{ v.tong_luong_xem }}
                                                    </div>
                                                </div>
                                                <div class="product__item__text">
                                                    <ul>
                                                        <template v-for="(item, key) in v.ten_the_loais" :key="key">
                                                            <li v-show="key < 3">{{ item }}</li>
                                                        </template>
                                                    </ul>

                                                    <h5>
                                                        <a href="http://127.0.0.1:8002/dai-tieu-thu-vuot-qua-chong-gai">{{
                                                            tenPhimLimited_1(v.ten_phim) }}</a>
                                                    </h5>
                                                </div>
                                            </div>
                                        </router-link>
                                    </div>
                                </template>
                            </div>
                        </div>
                        <div class="trending__product">
                            <div class="row">
                                <div class="col-lg-8 col-md-8 col-sm-8">
                                    <div class="section-title">
                                        <h4>Tất Cả Phim</h4>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    <div class="btn__all">
                                        <router-link to="/tat-ca-phim">
                                            <a class="primary-btn">View All <span class="arrow_right"></span></a>
                                        </router-link>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <template v-for="(v, k) in tat_ca_phim" :key="k">
                                    <div v-show="v.tong_tap > 0 && k < 6" class="col-lg-4 col-md-6 col-sm-6">
                                        <router-link :to="v.slug_phim">
                                            <div class="product__item">
                                                <div class="product__item__pic set-bg"
                                                    style="background-image: url('undefined')">
                                                    <a><img style="height: 100%; width: 230px" v-bind:src="v.hinh_anh"
                                                            alt="" /></a>
                                                    <div class="ep">{{ v.tong_tap }}/{{ v.so_tap_phim }}
                                                        <span v-if="v.tong_tap == v.so_tap_phim">FULL</span>
                                                    </div>
                                                    <div class="comment b">{{ v.ten_loai_phim }}</div>
                                                    <div class="view"><i class="fa fa-eye"></i> {{ v.tong_luong_xem }}
                                                    </div>
                                                </div>
                                                <div class="product__item__text">
                                                    <ul>
                                                        <template v-for="(item, key) in v.ten_the_loais" :key="key">
                                                            <li v-show="key < 3">{{ item }}</li>
                                                        </template>
                                                    </ul>

                                                    <h5>
                                                        <a href="http://127.0.0.1:8002/dai-tieu-thu-vuot-qua-chong-gai">{{
                                                            tenPhimLimited_1(v.ten_phim) }}</a>
                                                    </h5>
                                                </div>
                                            </div>
                                        </router-link>
                                    </div>
                                </template>
                            </div>
                        </div>
                        <div class="trending__product">
                            <div class="row">
                                <div class="col-lg-8 col-md-8 col-sm-8">
                                    <div class="section-title">
                                        <h4>Phim Đã Hoàn Thành</h4>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    <div class="btn__all">
                                        <router-link to="/tat-ca-phim">
                                            <a class="primary-btn">View All <span class="arrow_right"></span></a>
                                        </router-link>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <template v-for="(v, k) in tat_ca_phim_hoan_thanh" :key="k">
                                    <div v-show="v.tong_tap > 0 && k < 6" class="col-lg-4 col-md-6 col-sm-6">
                                        <router-link
                                        :to="v.slug_phim">
                                            <div class="product__item">
                                                <div class="product__item__pic set-bg"
                                                    style="background-image: url('undefined')">
                                                    <a><img style="height: 100%; width: 230px" v-bind:src="v.hinh_anh" loading="lazy"
                                                            alt="" /></a>
                                                    <div class="ep">{{ v.tong_tap }}/{{ v.so_tap_phim }}
                                                        <span v-if="v.tong_tap == v.so_tap_phim">FULL</span>
                                                    </div>
                                                    <div class="comment b">{{ v.ten_loai_phim }}</div>
                                                    <div class="view"><i class="fa fa-eye"></i> {{ v.tong_luong_xem }}
                                                    </div>
                                                </div>
                                                <div class="product__item__text">
                                                    <ul>
                                                        <template v-for="(item, key) in v.ten_the_loais" :key="key">
                                                            <li v-show="key < 3">{{ item }}</li>
                                                        </template>
                                                    </ul>

                                                    <h5>
                                                        <a href="http://127.0.0.1:8002/dai-tieu-thu-vuot-qua-chong-gai">{{
                                                            tenPhimLimited_1(v.ten_phim) }}</a>
                                                    </h5>
                                                </div>
                                            </div>
                                        </router-link>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-8">
                        <div class="product__sidebar">
                            <div class="product__sidebar__view">
                                <div class="section-title">
                                    <h5>Xem Nhiều Nhất</h5>
                                </div>

                                <div class="filter__gallery" id="MixItUpF5B6EA">
                                    <template v-for="(v, k) in phim_xem_nhieu_nhat" :key="k">
                                        <router-link :to="v.slug_phim">
                                            <div class="product__sidebar__view__item set-bg mix month week"
                                                data-setbg="img/sidebar/tv-2.jpg" v-bind:style="{
                                                    'background-image': 'url(' + v.hinh_anh + ')',
                                                }">
                                                <div class="ep">{{ v.tong_tap }}/{{ v.so_tap_phim }} <span
                                                        v-show="v.tong_tap == v.so_tap_phim">FULL</span></div>

                                                <div class="view"><i class="fa fa-eye"></i> {{ v.tong_luong_xem }}</div>
                                                <h5
                                                    style="background-color: rgba(35, 33, 33, 0.7);padding-bottom: 0px;padding: -59px 8px;padding-top: 3px;">
                                                    <a v-bind:href="v.slug_phim">
                                                        {{ tenPhimLimited(v.ten_phim) }}</a>
                                                </h5>
                                            </div>
                                        </router-link>
                                    </template>
                                </div>
                            </div>
                            <div class="product__sidebar__comment">
                                <div class="section-title">
                                    <h5>Hot trong tuần</h5>
                                </div>
                                <template v-for="(v, k) in phim_hot" :key="k">
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
                    </div>
                </div>
            </div>
        </section>
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
            list_the_loai: [],
            tat_ca_phim: [],
            list_hot_trong_thang: [],
            tat_ca_phim_hoan_thanh: [],
            phim_xem_nhieu_nhat: [],
            phim_hot: [],
            phim_moi_cap_nhats: [],
            so_luong_tap: [],
            list_phim: [],

        };
    },
    mounted() {
        this.$store.dispatch('showLoader');
        //   this.laydataLoaiPhim();
        //   this.loaddataTheLoai();
        this.laydataPhim();
    },
    methods: {
        tenPhimLimited(tenphim) {
            return tenphim.length > 30 ? tenphim.substring(0, 30) + '...' : tenphim;
        },
        tenPhimLimited_1(tenphim) {
            return tenphim.length > 42 ? tenphim.substring(0, 42) + '...' : tenphim;
        },
        laydataPhim() {
            axios
                .get("http://127.0.0.1:8000/api/phim/lay-du-lieu-show")
                .then((res) => {
                    this.list_hot_trong_thang = res.data.top_view_thang;
                    this.tat_ca_phim = res.data.tat_ca_phim;
                    this.tat_ca_phim.forEach((value, index) => {
                        value.ten_the_loais = value.ten_the_loais.split(',');
                    });
                    this.phim_moi_cap_nhats = res.data.phim_moi_cap_nhats;
                    this.phim_moi_cap_nhats.forEach((value, index) => {
                        value.ten_the_loais = value.ten_the_loais.split(',');
                    });
                    this.tat_ca_phim_hoan_thanh = res.data.tat_ca_phim_hoan_thanh;
                    this.tat_ca_phim_hoan_thanh.forEach((value, index) => {
                        value.ten_the_loais = value.ten_the_loais.split(',');
                    });
                    this.phim_xem_nhieu_nhat = res.data.phim_xem_nhieu_nhat;
                    this.phim_xem_nhieu_nhat.forEach((value, index) => {
                        value.ten_the_loais = value.ten_the_loais.split(',');
                    });
                    this.phim_hot = res.data.phim_hot;
                    this.phim_hot.forEach((value, index) => {
                        value.ten_the_loais = value.ten_the_loais.split(',');
                    });
                    this.$store.dispatch('hideLoader');
                }).catch(() => {
                    this.$store.dispatch('hideLoader'); // Ẩn loader nếu có lỗi
                });
        },
        laydataLoaiPhim() {
            axios
                .get("http://127.0.0.1:8000/api/loai-phim/lay-du-lieu-show")
                .then((res) => {
                    this.list_loai_phim = res.data.loai_phim;
                });
        },
        loaddataTheLoai() {
            axios
                .get("http://127.0.0.1:8000/api/the-loai/lay-du-lieu-show")
                .then((res) => {
                    this.list_the_loai = res.data.the_loai;
                    this.list_phim = res.data.phim_theo_the_loai;
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
</style>
