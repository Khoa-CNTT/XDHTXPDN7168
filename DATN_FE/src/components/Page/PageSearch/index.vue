<template>
    <!-- <template v-if="v.id == id"> -->
    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option" style="background-color: #0b0c2a">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <router-link to="/"><i class="fa fa-home"></i> Home</router-link>
                        <router-link to="/"> Tìm Kiếm</router-link>
                        <span>{{ key_tim.key }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <section class="product-page spad" style="background-color: #0b0c2a">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="product__page__content">
                        <div class="product__page__title">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="section-title">
                                        <h4>Từ khoá Tìm Kiếm: {{ key_tim.key }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <template v-for="(v, k) in list_phim" :key="k">
                                <div v-show="v.tong_tap > 0" class="col-lg-3 col-md-6 col-sm-12">
                                    <router-link :to="`/${v.slug_phim}`">
                                        <div class="product__item">
                                            <div class="product__item__pic set-bg"
                                                style="background-image: url('undefined')">
                                                <a><img style="height: 105%; width: 275px" v-bind:src="v.hinh_anh"
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
            </div>
        </div>
    </section>

    <!-- </template> -->


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
    data() {
        return {
            key_tim: { key: this.$route.params.id },
            list_phim: [],
            list_9_phim: [],
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

    mounted() {
        this.searchPhim();
    },
    computed: {
        pageNumbers() {
            return getPageNumbers(this.pagination);
        },
    },
    methods: {
        tenPhimLimited(tenphim) {
            return tenphim.length > 42 ? tenphim.substring(0, 42) + '...' : tenphim;
        },
        changPage(page) {
            if (this.check_page == 0) {
                this.searchPhim(page);
            }
        },
        searchPhim(page) {
            axios
                .post("http://127.0.0.1:8000/api/phim/load-thong-tin-tim/?page=" + page, this.key_tim)
                .then((res) => {
                    // this.list_9_phim = res.data.phim_9_obj;
                    this.pagination = res.data.phim.pagination;
                    this.list_phim = res.data.phim.dataPhim.data;
                    this.list_phim.forEach((value, index) => {
                        value.ten_the_loais = value.ten_the_loais.split(',');
                    });
                });
        },

    },
};
</script>
<style></style>
