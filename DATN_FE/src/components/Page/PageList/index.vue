<template>
    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option" style="background-color: #0b0c2a">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <router-link to="/"><i class="fa fa-home"></i> Home</router-link>
                        <router-link to="/"> Thể Loại</router-link>
                        <span>{{ the_loai.ten_the_loai }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <section class="product-page spad" style="background-color: #0b0c2a">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="product__page__content">
                        <div class="product__page__title">
                            <div class="row">
                                <div class="col-lg-8 col-md-8 col-sm-6">
                                    <div class="section-title">
                                        <h4>{{ the_loai.ten_the_loai }}</h4>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-6">
                                    <div class="product__page__filter">
                                        <p>Sắp xếp theo:</p>
                                        <select v-model="bien" @change="Sapxep(1)">
                                            <option value="ASC">A-Z</option>
                                            <option value="DESC">Z-A</option>
                                        </select>
                                        <!-- <div class="nice-select" tabindex="0"><span class="current">A-Z</span>
                            <ul class="list">
                              <li data-value="" class="option selected">A-Z</li>
                              <li data-value="" class="option">1-10</li>
                              <li data-value="" class="option">10-50</li>
                            </ul>
                          </div> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <template v-for="(v, k) in list_phim" :key="k">
                                <div v-show="v.tong_tap > 0" class="col-lg-4 col-md-4 col-sm-6 col-6">
                                    <router-link :to="`/${v.slug_phim}`">
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
                                                        tenPhimLimited(v.ten_phim) }}</a>
                                                </h5>
                                            </div>
                                        </div>
                                    </router-link>
                                </div>
                            </template>

                        </div>
                    </div>
                    <div class="product__pagination text-center">
                        <a @click="changPage(1)" type="button"><i class="fa fa-angle-double-left"></i></a>

                        <a type="button" :class="{ current_page: page === pagination.current_page }"
                            v-for="page in pageNumbers" :key="page" @click="page !== '...' && changPage(page)">
                            {{ page }}
                        </a>

                        <a @click="changPage(pagination.last_page)" type="button"><i
                                class="fa fa-angle-double-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-8">
                    <div class="product__sidebar">

                        <div class="product__sidebar__comment">
                            <div class="section-title">
                                <h5>Hot Phim</h5>
                            </div>
                            <template v-for="(v, k) in list_9_phim" :key="k">
                                <div class="product__sidebar__comment__item">
                                    <router-link :to="`/${v.slug_phim}`">
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
                                            <router-link :to="`${v.slug_phim}`">
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
</template>
<script>
import axios from "axios"
import baseRequest from '../../../core/baseRequest';
import { createToaster } from "@meforma/vue-toaster";
import { getPageNumbers } from "../../../core/paginationUtils.js";
const toaster = createToaster({
    position: "top-right",
});

export default {
    // props: {
    //     slug: {
    //         type: String,
    //         required: true, // Hoặc true nếu bắt buộc
    //     },
    // },
    data() {
        return {
            // id: this.$route.params.id,
            the_loai: {},
            list_the_loai: [],
            list_tac_gia: [],
            list_9_phim: [],
            list_phim: [],
            bien: '',
            slug: this.$route.params.slug,
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
        this.$store.dispatch('showLoader');
        this.loadataTheLoaiAndPhim(1);
        this.slug = this.$route.params.slug;

    },
    // watch: {
    //     $route(to, from) {
    //         this.loadataTheLoaiAndPhim(1);
    //     }
    // },
    beforeRouteUpdate(to, from, next) {
        this.$store.dispatch('showLoader');
        this.slug = to.params.slug;
        this.loadataTheLoaiAndPhim(1);
        next();
    },
    methods: {
        tenPhimLimited(tenphim) {
            return tenphim.length > 42 ? tenphim.substring(0, 42) + '...' : tenphim;
        },
        scrollToTop() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth', // Thêm hiệu ứng cuộn
            });
        },
        loadataTheLoaiAndPhim(page) {
            axios
                .get('http://127.0.0.1:8000/api/the-loai/lay-du-lieu/' + this.slug + '?page=' + page, {})
                .then((res) => {
                    if (res.data.status == false) {
                        this.$router.push('/');
                        this.$store.dispatch('error', {description: res.data.message});
                    }
                    this.the_loai = res.data.the_loai;
                    this.list_9_phim = res.data.phim_9_obj;
                    this.pagination = res.data.phim.pagination;
                    this.list_phim = res.data.phim.dataPhim.data;
                    this.list_phim.forEach((value, index) => {
                        value.ten_the_loais = value.ten_the_loais.split(',');
                    });
                    this.list_9_phim.forEach((value, index) => {
                        value.ten_the_loais = value.ten_the_loais.split(',');
                    });
                    this.scrollToTop();
                    this.$store.dispatch('hideLoader'); // Ẩn loader nếu có lỗi
                }).catch(() => {
                    this.$store.dispatch('hideLoader'); // Ẩn loader nếu có lỗi
                });
        },
        changPage(page) {
            if (this.check_page == 0) {
                this.loadataTheLoaiAndPhim(page);
            } else if (this.check_page == 1) {
                this.Sapxep(page);
            }
        },
        Sapxep(page) {
            this.check_page = 1;
            axios
                .get("http://127.0.0.1:8000/api/the-loai/sap-xep/" + this.the_loai.slug_the_loai + "/" + this.bien + '?page=' + page)
                .then((res) => {
                    this.list_phim = res.data.phim.dataPhim.data;
                    this.list_phim.forEach((value, index) => {
                        value.ten_the_loais = value.ten_the_loais.split(',');
                    });
                    this.pagination = res.data.phim.pagination;

                    this.scrollToTop();
                    this.$store.dispatch('hideLoader'); // Ẩn loader nếu có lỗi
                }).catch(() => {
                    this.$store.dispatch('hideLoader'); // Ẩn loader nếu có lỗi
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
