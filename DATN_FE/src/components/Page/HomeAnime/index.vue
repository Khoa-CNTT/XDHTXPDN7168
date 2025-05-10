<template>
    <div>
        <!-- Hero Banner Section -->
        <div class="hero-banner">
            <div v-for="(slide, index) in list_slide" :key="index" class="hero-banner-slide"
                :class="{ active: index === activeSlide }">
                <div class="hero-banner-backdrop" :style="{ backgroundImage: `url(${slide.poster_img})` }"></div>
                <div class="hero-banner-overlay"></div>
                <div class="container hero-banner-content">
                    <div class="hero-banner-info">
                        <h1 class="hero-banner-title">{{ slide.ten_phim }}</h1>
                        <div class="hero-banner-meta">
                            <div class="meta-item imdb">
                                <span class="imdb-logo">IMDb</span> {{ generateRandomRating() }}
                            </div>
                            <div class="meta-item">{{ new Date().getFullYear() }}</div>
                            <div class="meta-item">Phần {{ Math.floor(Math.random() * 3) + 1 }}</div>
                            <div class="meta-item">Tập {{ Math.floor(Math.random() * 10) + 1 }}</div>
                        </div>
                        <p class="hero-banner-description">{{ slide.mo_ta }}</p>
                        <div class="hero-banner-categories">
                            <span class="category-tag">Chính Kịch</span>
                            <span class="category-tag">Hành Động</span>
                            <span class="category-tag">Kỳ Ảo</span>
                            <span class="category-tag">Phiêu Lưu</span>
                        </div>
                        <div class="hero-banner-actions">
                            <router-link :to="slide.slug_phim" class="btn-watch">
                                <i class="fa fa-play-circle"></i> Xem ngay
                            </router-link>
                            <button class="btn-circle">
                                <i class="fa fa-heart"></i>
                            </button>
                            <button class="btn-circle">
                                <i class="fa fa-info-circle"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Thumbnails at the bottom for navigation -->
                <div class="hero-thumbnails">
                    <div class="container">
                        <div class="thumbnails-wrapper">
                            <div v-for="(thumb, i) in Math.min(6, list_slide.length)" :key="i" class="hero-thumbnail"
                                :class="{ active: i === activeSlide }" @click="setActiveSlide(i)">
                                <img :src="list_slide[i]?.poster_img || ''" alt="Thumbnail" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Navigation Controls -->
            <div class="hero-controls">
                <button @click="prevSlide" class="hero-control prev">
                    <i class="fa fa-angle-left"></i>
                </button>
                <button @click="nextSlide" class="hero-control next">
                    <i class="fa fa-angle-right"></i>
                </button>
            </div>

            <!-- Indicators -->
            <div class="hero-indicators">
                <button v-for="(slide, i) in list_slide" :key="i" @click="setActiveSlide(i)"
                    :class="{ active: i === activeSlide }" class="hero-indicator"></button>
            </div>
        </div>

        <!-- Product Section Begin -->
        <section class="product spad" style="background-color: #0b0c2a">
            <div class="container">
                <div class="row custom-row">
                    <div class="col-lg-8 col-md-12">
                        <!-- Phim Mới Cập Nhật Section -->
                        <div class="trending__product">
                            <div class="row align-items-center">
                                <div class="col-lg-8 col-md-8 col-sm-12">
                                    <div class="section-title">
                                        <h4>Phim Mới Cập Nhật</h4>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 d-none d-md-block text-end">
                                    <div class="btn__all">
                                        <router-link to="/tat-ca-phim">
                                            <a class="primary-btn">Xem tất cả <span class="arrow_right"></span></a>
                                        </router-link>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <template v-for="(v, k) in phim_moi_cap_nhats" :key="k">
                                    <div v-show="v.tong_tap > 0 && k < 6" class="col-lg-4 col-md-4 col-sm-6 col-6">
                                        <router-link :to="v.slug_phim">
                                            <div class="product__item">
                                                <div class="product__item__pic set-bg">
                                                    <img style="width: 100%; height: 100%; object-fit: cover;"
                                                        v-bind:src="v.hinh_anh" loading="lazy" alt="" />
                                                    <div class="ep">{{ v.tong_tap }}/{{ v.so_tap_phim }}
                                                        <span v-if="v.tong_tap == v.so_tap_phim">FULL</span>
                                                    </div>
                                                    <div class="comment b">{{ v.ten_loai_phim }}</div>
                                                    <div class="view"><i class="fa fa-eye"></i> {{
                                                        formatNumber(v.tong_luot_xem) }}</div>
                                                </div>
                                                <div class="product__item__text">
                                                    <ul>
                                                        <template v-for="(item, key) in v.ten_the_loais" :key="key">
                                                            <li v-show="key < 3">{{ item }}</li>
                                                        </template>
                                                    </ul>
                                                    <h5><a style="color: #ffffff;"
                                                            href="http://127.0.0.1:8002/dai-tieu-thu-vuot-qua-chong-gai">{{
                                                            tenPhimLimited_1(v.ten_phim) }}</a></h5>
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
                                                v-bind:style="{
                                                    'background-image': 'url(' + v.poster_img + ')',
                                                }">
                                                <div class="ep">{{ v.tong_tap }}/{{ v.so_tap_phim }} <span
                                                        v-show="v.tong_tap == v.so_tap_phim">FULL</span></div>

                                                <div class="view"><i class="fa fa-eye"></i> {{
                                                    formatNumber(v.tong_luot_xem) }}</div>
                                                <h5><a v-bind:href="v.slug_phim">{{ tenPhimLimited(v.ten_phim) }}</a>
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
                                <template v-for="(v, k) in list_recomender" :key="k">
                                    <div class="product__sidebar__comment__item">
                                        <router-link :to="v.slug">
                                            <a v-bind:href="v.slug">
                                                <div class="product__sidebar__comment__item__pic">
                                                    <img v-bind:src="v.poster_url" style="width: 99px" alt="" />
                                                </div>
                                            </a>
                                        </router-link>

                                        <div style="" class="product__sidebar__comment__item__text">
                                            <ul>
                                                <!-- <li >{{ v.ten_loai_phim }}</li> -->
                                                <template v-for="(value, key) in v.genres" :key="key">
                                                    <li>{{ value }}</li>
                                                </template>
                                            </ul>
                                            <h5>
                                                <router-link :to="v.slug">
                                                    {{ v.title }}
                                                </router-link>
                                            </h5>
                                            <div style="color: #b7b7b7">
                                                <!-- Số Tập: {{ v.tong_tap }} / {{ v.so_tap_phim }} -->
                                            </div>
                                            <!-- <span><i class="fa fa-eye"></i> {{ formatNumber(v.tong_luot_xem) }} lượt
                                                xem</span> -->
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
            activeSlide: 0,
            list_slide: [],
            slideTimer: null,
            config: {
                autoplay: 2000,
                wrapAround: true,
                pauseAutoplayOnHover: true,
            },
            list_loai_phim: [],
            list_the_loai: [],
            tat_ca_phim: [],
            list_recomender: [],
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
        this.laydataPhim();
        this.getdataSlide();
        this.getdataRecomender();
        // Auto slide rotation
        this.startSlideTimer();
    },
    beforeUnmount() {
        this.stopSlideTimer();
    },
    methods: {
        startSlideTimer() {
            this.stopSlideTimer(); // Clear any existing timer
            this.slideTimer = setInterval(() => {
                this.nextSlide();
            }, 7000);
        },
        stopSlideTimer() {
            if (this.slideTimer) {
                clearInterval(this.slideTimer);
                this.slideTimer = null;
            }
        },
        nextSlide() {
            this.activeSlide = (this.activeSlide + 1) % (this.list_slide.length || 1);
            this.startSlideTimer(); // Reset the timer
        },
        prevSlide() {
            this.activeSlide = (this.activeSlide - 1 + this.list_slide.length) % this.list_slide.length;
            this.startSlideTimer(); // Reset the timer
        },
        setActiveSlide(index) {
            this.activeSlide = index;
            this.startSlideTimer(); // Reset the timer
        },
        generateRandomRating() {
            return (Math.random() * 3 + 7).toFixed(1);
        },
        formatNumber(num) {
            if (num >= 1000000) {
                return (num / 1000000).toFixed(1) + 'M';
            } else if (num >= 1000) {
                return (num / 1000).toFixed(1) + 'K';
            }
            return num;
        },
        tenPhimLimited(tenphim) {
            return tenphim.length > 30 ? tenphim.substring(0, 30) + '...' : tenphim;
        },
        tenPhimLimited_1(tenphim) {
            return tenphim.length > 42 ? tenphim.substring(0, 42) + '...' : tenphim;
        },
        async getdataSlide() {
            const res = await axios.get(import.meta.env.VITE_API_URL + 'lay-data-slide-homepage');
            this.list_slide = res.data.data.map(slide => {
                slide.mo_ta = slide.mo_ta.length > 150 ? slide.mo_ta.substring(0, 150) + '...' : slide.mo_ta;
                slide.ten_phim = slide.ten_phim.length > 40 ? slide.ten_phim.substring(0, 40) + '...' : slide.ten_phim;
                return slide;
            });
            this.$store.dispatch('hideLoader');
        },
        async getdataRecomender() {
            var chatPreferences = localStorage.getItem("chatPreferences");
            var payload = JSON.parse(chatPreferences);
            const res = await axios.post(import.meta.env.VITE_CHATBOT_API + '/recommendations', payload ,{
                headers: {
                        'Content-Type': 'application/json',
                        'Authorization': "Bearer " + localStorage.getItem("token_user"),
                    },
            });
            this.list_recomender = res.data.recommendations;
            this.list_recomender.forEach((value, index) => {
                value.genres = value.genres.split('|');
            });
            this.$store.dispatch('hideLoader');
        },
        laydataPhim() {
            axios
                .get(import.meta.env.VITE_API_URL + 'phim/lay-du-lieu-show', {
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
            baseRequest
                .get("loai-phim/lay-du-lieu-show")
                .then((res) => {
                    this.list_loai_phim = res.data.loai_phim;
                });
        },
        loaddataTheLoai() {
            baseRequest
                .get("the-loai/lay-du-lieu-show")
                .then((res) => {
                    this.list_the_loai = res.data.the_loai;
                    this.list_phim = res.data.phim_theo_the_loai;
                });
        },
    },
};
</script>
<style scoped>
/* Hero Banner Styles */
.hero-banner {
    position: relative;
    height: 760px;
    overflow: hidden;
}

.hero-banner-slide {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    opacity: 0;
    visibility: hidden;
    transition: opacity 0.8s ease, visibility 0.8s ease;
}

.hero-banner-slide.active {
    opacity: 1;
    visibility: visible;
}

.hero-banner-backdrop {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-size: cover;
    background-position: center;
    transform: scale(1.05);
    transition: transform 7s ease;
}

.hero-banner-slide.active .hero-banner-backdrop {
    transform: scale(1.15);
}

.hero-banner-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(to bottom, rgba(0, 0, 0, 0.2), rgba(11, 12, 42, 0.95));
}

.hero-banner-content {
    position: relative;
    height: 100%;
    display: flex;
    align-items: center;
    padding-bottom: 80px;
    z-index: 2;
}

.hero-banner-info {
    max-width: 620px;
    opacity: 0;
    transform: translateY(30px);
    transition: opacity 0.8s ease, transform 0.8s ease;
}

.hero-banner-slide.active .hero-banner-info {
    opacity: 1;
    transform: translateY(0);
}

.hero-banner-title {
    font-size: 48px;
    font-weight: 700;
    line-height: 1.2;
    margin-bottom: 20px;
    color: white;
}

.hero-banner-meta {
    display: flex;
    flex-wrap: wrap;
    gap: 15px;
    margin-bottom: 20px;
}

.meta-item {
    background: rgba(255, 255, 255, 0.15);
    border-radius: 4px;
    padding: 6px 12px;
    color: white;
    font-size: 14px;
    font-weight: 500;
    display: flex;
    align-items: center;
}

.meta-item.imdb {
    color: #ffffff;
}

.imdb-logo {
    background-color: #f5c518;
    color: #000000;
    font-weight: 700;
    padding: 2px 4px;
    border-radius: 2px;
    margin-right: 6px;
    font-size: 12px;
}

.hero-banner-description {
    font-size: 16px;
    line-height: 1.6;
    color: rgba(255, 255, 255, 0.85);
    margin-bottom: 25px;
}

.hero-banner-categories {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin-bottom: 30px;
}

.category-tag {
    background: rgba(255, 255, 255, 0.15);
    border-radius: 20px;
    padding: 6px 14px;
    color: white;
    font-size: 14px;
}

.hero-banner-actions {
    display: flex;
    align-items: center;
    gap: 15px;
}

.btn-watch {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    background: #e53637;
    color: white;
    border: none;
    border-radius: 4px;
    padding: 12px 25px;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    text-decoration: none;
}

.btn-watch:hover {
    background: #c81c1d;
    transform: translateY(-2px);
}

.btn-circle {
    width: 44px;
    height: 44px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.15);
    border: none;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn-circle:hover {
    background: rgba(255, 255, 255, 0.25);
}

/* Hero Controls */
.hero-controls {
    position: absolute;
    top: 50%;
    left: 0;
    right: 0;
    transform: translateY(-50%);
    display: flex;
    justify-content: space-between;
    padding: 0 30px;
    z-index: 5;
}

.hero-control {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: rgba(0, 0, 0, 0.3);
    border: 2px solid rgba(255, 255, 255, 0.3);
    color: white;
    font-size: 24px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
}

.hero-control:hover {
    background: rgba(229, 54, 55, 0.8);
    border-color: rgba(255, 255, 255, 0.8);
}

/* Hero Indicators */
.hero-indicators {
    position: absolute;
    bottom: 25px;
    left: 0;
    right: 0;
    display: flex;
    justify-content: center;
    gap: 10px;
    z-index: 5;
}

.hero-indicator {
    width: 10px;
    height: 10px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.3);
    border: none;
    padding: 0;
    cursor: pointer;
    transition: all 0.3s ease;
}

.hero-indicator.active {
    background: #e53637;
    transform: scale(1.3);
}

/* Hero Thumbnails */
.hero-thumbnails {
    position: absolute;
    bottom: 60px;
    left: 0;
    width: 100%;
    z-index: 5;
}

.thumbnails-wrapper {
    display: flex;
    justify-content: center;
    gap: 10px;
}

.hero-thumbnail {
    width: 120px;
    height: 68px;
    border-radius: 4px;
    overflow: hidden;
    border: 2px solid transparent;
    opacity: 0.6;
    cursor: pointer;
    transition: all 0.3s ease;
}

.hero-thumbnail img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.hero-thumbnail.active {
    border-color: #e53637;
    opacity: 1;
}

.hero-thumbnail:hover {
    opacity: 0.9;
    transform: translateY(-3px);
}

/* Responsive styles */
@media (max-width: 991px) {
    .hero-banner {
        height: 540px;
    }

    .hero-banner-title {
        font-size: 38px;
    }

    .hero-thumbnails {
        display: none;
    }
}

@media (max-width: 767px) {
    .hero-banner {
        height: 480px;
    }

    .hero-banner-title {
        font-size: 32px;
    }

    .hero-banner-description {
        font-size: 14px;
    }

    .hero-control {
        width: 40px;
        height: 40px;
        font-size: 20px;
    }
}

@media (max-width: 575px) {
    .hero-banner {
        height: 420px;
    }

    .hero-banner-title {
        font-size: 28px;
        margin-bottom: 15px;
    }

    .hero-banner-description {
        margin-bottom: 15px;
    }

    .hero-banner-categories {
        margin-bottom: 20px;
    }

    .category-tag {
        padding: 4px 10px;
        font-size: 12px;
    }

    .btn-watch {
        padding: 10px 20px;
        font-size: 14px;
    }

    .btn-circle {
        width: 38px;
        height: 38px;
    }
}
</style>
