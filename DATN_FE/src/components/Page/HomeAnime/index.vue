<template>
    <div>
        <!-- Hero Section Begin -->
        <!-- <section class="hero" style="background-color: #0b0c2a">
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
        </section> -->
        <!-- Hero Section End -->
        <div class="slide_container container mt-3">
            <Carousel v-bind="config">
                <Slide v-for="(slide, index) in list_slide" :key="index">
                    <div class="carousel__item" :style="{ backgroundImage: `url(${slide.poster_img})` }">
                        <div class="hero__text">
                            <h2>{{ slide.ten_phim }}</h2>
                            <p>{{ slide.mo_ta }}
                            </p>
                            <router-link :to="slide.slug_phim">
                                Xem ngay
                            </router-link>

                        </div>
                    </div>
                </Slide>

                <template #addons>
                    <Navigation class="carousel__navigation">
                        <button class="prev"><i class="fa fa-chevron-left"></i></button>
                        <button class="next"><i class="fa fa-chevron-right"></i></button>
                    </Navigation>
                </template>
            </Carousel>
        </div>

        <!-- Product Section Begin -->
        <section class="product spad" style="background-color: #0b0c2a">
            <div class="container">
                <div class="row custom-row">
                    <div class="col-lg-8 col-md-12">
                        <div class="trending__product">
                            <div class="row align-items-center">
                                <!-- Cột 1 -->
                                <div class="col-lg-8 col-md-8 col-sm-12">
                                    <div class="section-title">
                                        <h4>Phim Mới Cập Nhật</h4>
                                    </div>
                                </div>
                                <!-- Cột 2 -->
                                <div class="col-lg-4 col-md-4 d-none d-md-block text-end">
                                    <div class="btn__all">
                                        <router-link to="/tat-ca-phim">
                                            <a class="primary-btn">View All <span class="arrow_right"></span></a>
                                        </router-link>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <template v-for="(v, k) in phim_moi_cap_nhats" :key="k">
                                    <div v-show="v.tong_tap > 0 && k < 6" class="col-lg-4 col-md-4 col-sm-6 col-6">
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
                                                    <div class="view"><i class="fa fa-eye"></i> {{ v.tong_luot_xem }}
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
                                    <div v-show="v.tong_tap > 0 && k < 6" class="col-lg-4 col-md-4 col-sm-6 col-6">
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
                                                    <div class="view"><i class="fa fa-eye"></i> {{ v.tong_luot_xem }}
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
                                    <div v-show="v.tong_tap > 0 && k < 6" class="col-lg-4 col-md-4 col-sm-6 col-6">
                                        <router-link :to="v.slug_phim">
                                            <div class="product__item">
                                                <div class="product__item__pic set-bg"
                                                    style="background-image: url('undefined')">
                                                    <a><img style="height: 100%; width: 230px" v-bind:src="v.hinh_anh"
                                                            loading="lazy" alt="" /></a>
                                                    <div class="ep">{{ v.tong_tap }}/{{ v.so_tap_phim }}
                                                        <span v-if="v.tong_tap == v.so_tap_phim">FULL</span>
                                                    </div>
                                                    <div class="comment b">{{ v.ten_loai_phim }}</div>
                                                    <div class="view"><i class="fa fa-eye"></i> {{ v.tong_luot_xem }}
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
                    <div class="col-lg-4 col-md-12">
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
                                                    'background-image': 'url(' + v.poster_img + ')',
                                                }">
                                                <div class="ep">{{ v.tong_tap }}/{{ v.so_tap_phim }} <span
                                                        v-show="v.tong_tap == v.so_tap_phim">FULL</span></div>

                                                <div class="view"><i class="fa fa-eye"></i> {{ v.tong_luot_xem }}</div>
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
                                    <h5>ĐỀ XUẤT CHO BẠN</h5>
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
                                            <span><i class="fa fa-eye"></i> {{ v.tong_luot_xem }} lượt
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
import 'vue3-carousel/dist/carousel.css';
import { Carousel, Slide, Navigation } from 'vue3-carousel';
import axios from "axios";
import baseRequest from "../../../core/baseRequest";
import { createToaster } from "@meforma/vue-toaster";
const toaster = createToaster({
    position: "top-right",
});
export default {
    components: {
        Carousel, Slide, Navigation
    },
    data() {
        return {
            list_slide: [],
            config: {
                autoplay: 2000,
                wrapAround: true,
                pauseAutoplayOnHover: true,
            },
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
            windowWidth: window.innerWidth,

        };
    },
    mounted() {
        this.$store.dispatch('showLoader');
        //   this.laydataLoaiPhim();
        //   this.loaddataTheLoai();
        this.laydataPhim();
        this.getdataSlide();
    },
    methods: {
        tenPhimLimited(tenphim) {
            return tenphim.length > 30 ? tenphim.substring(0, 30) + '...' : tenphim;
        },
        tenPhimLimited_1(tenphim) {
            return tenphim.length > 42 ? tenphim.substring(0, 42) + '...' : tenphim;
        },
        async getdataSlide() {
            const res = await axios.get("http://127.0.0.1:8000/api/lay-data-slide-homepage");
            this.list_slide = res.data.data.map(slide => {
                slide.mo_ta = slide.mo_ta.length > 150 ? slide.mo_ta.substring(0, 150) + '...' : slide.mo_ta;
                slide.ten_phim = slide.ten_phim.length > 25 ? slide.ten_phim.substring(0, 25) + '...' : slide.ten_phim;
                return slide;


            });
            this.$store.dispatch('hideLoader');
        },
        laydataPhim() {
            axios
                .get("http://127.0.0.1:8000/api/phim/lay-du-lieu-show", {
                    headers: {
                        Authorization: "Bearer " + localStorage.getItem("token_user"),
                    },
                })
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
<style scoped>
button.carousel__prev.carousel__navigation {
    background-color: red !important;
}

.carousel__item {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 585px;
    width: 100%;
    background-size: cover;
    background-position: center;
    position: relative;
    border-radius: 12px;
    box-shadow: 0px 6px 25px rgba(0, 0, 0, 0.4);
    overflow: hidden;
    transition: transform 0.3s, box-shadow 0.3s;
}

.carousel__item:hover {
    transform: scale(1.01);
    box-shadow: 0px 8px 30px rgba(0, 0, 0, 0.5);
    cursor: pointer;
}

.carousel__item::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(to bottom, rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0.4));
    border-radius: 12px;
    z-index: 1;
}

.hero__text {
    position: absolute;
    bottom: 0px;
    left: 0;
    color: #fff;
    z-index: 2;
    text-shadow: 2px 2px 6px rgba(0, 0, 0, 0.8);
    /* text-align: left; */
    font-family: 'Lobster', cursive;
    max-width: 50%;
}

.hero__text h2 {
    font-size: 42px;
    font-weight: 700;
    margin: 0 0 30px;
    opacity: 0.9;
    text-transform: uppercase;
    display: flex;
    justify-content: center;
    align-items: center;
    overflow: hidden;
    text-overflow: ellipsis;
}

.hero__text p {
    font-size: 18px;
    /* Adjust font size for the paragraph */
    line-height: 1.6;
    /* margin: 5px 0 -60px; */
    /* Less margin between title and paragraph */
    opacity: 0.9;
    padding: 0 50px;
    /* Add padding to both sides to prevent long text from overflowing */
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
    text-align: justify;
}

.hero__text a {
    opacity: 0.9;
    background-color: #ff4757;
    border: none;
    border-radius: 8px;
    padding: 12px 24px;
    color: white;
    font-size: 18px;
    font-weight: 600;
    cursor: pointer;
    transition: background-color 0.4s, transform 0.3s, box-shadow 0.3s;
    box-shadow: 0px 5px 20px rgba(255, 71, 87, 0.5);
    z-index: 3;
}

.hero__text a:hover {
    background-color: #d32f39;
    transform: scale(1.1);
    box-shadow: 0px 8px 30px rgba(211, 47, 57, 0.7);
}

.hero__text a:active {
    transform: scale(1.05);
    box-shadow: 0px 5px 20px rgba(211, 47, 57, 0.6);
}

.carousel__navigation button {
    background: rgba(0, 0, 0, 0.4);
    /* Slightly transparent background */
    color: white;
    border: none;
    border-radius: 50%;
    width: 50px;
    /* Larger button size */
    height: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: background-color 0.3s, transform 0.3s;
}

.carousel__navigation button:hover {
    background: rgba(255, 255, 255, 0.8);
    color: #ff4757;
    transform: scale(1.1);
}

.custom-row {
    display: flex;
    flex-wrap: wrap;
}

.custom-row>div {
    order: 0;
    /* Thứ tự mặc định */
}

.carousel__navigation .prev {
    position: absolute;
    left: 20px;
    /* Adjust to align with carousel edges */
    top: 50%;
    transform: translateY(-50%);
    z-index: 4;
}

.carousel__navigation .next {
    position: absolute;
    right: 20px;
    /* Adjust to align with carousel edges */
    top: 50%;
    transform: translateY(-50%);
    z-index: 4;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(10px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@media only screen and (max-width: 768px) {
    .carousel__item {
        margin: 0 -15px;
        border-radius: 0;
    }

    .product  {
        margin-top: 45px;
    }

    .custom-row>.col-lg-4 {
        order: -1;
        /* Đưa col-4 lên trước */
    }

    .slide_container {
        display: none;
    }

    .hero__text {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
    }

    .hero__text h2 {
        font-size: 24px;
        margin-bottom: 10px;
        padding: 0 10px;
    }

    .hero__text p {
        -webkit-line-clamp: 2;
        margin-bottom: 15px;
    }

    .product__item {
        max-width: 300px;
        margin: 0 auto 20px;
    }

    .section-title {
        margin-bottom: 15px;
    }

    .btn__all {
        display: none;
    }
}

@media only screen and (max-width: 575px) {
    .product__item:hover {
        transform: translateY(-5px);
        transition: transform 0.3s ease;
    }

    .slide_container {
        display: none;
    }

    .product__sidebar__view__item:hover {
        transform: scale(1.02);
        transition: transform 0.3s ease;
    }
}
</style>
