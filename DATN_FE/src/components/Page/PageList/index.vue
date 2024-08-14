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
                                        <select v-model="bien" @change="Sapxep(the_loai.id)">
                                            <option value="az">A-Z</option>
                                            <option value="za">Z-A</option>
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
                            <template v-for="(v1, k1) in list_phim" :key="k1">
                                <div class="col-lg-4 col-md-6 col-sm-6">
                                    <div class="product__item">
                                        <router-link
                                            :to="{ name: 'PageDelist', params: { id: v1.id, slug: v1.slug_phim } }">
                                            <div class="product__item__pic set-bg"
                                                v-bind:style="{ 'background-image': 'url(' + v1.hinh_anh + ')', }">
                                                <div v-if="v1.ten_loai_phim === 'Phim Bộ'" class="ep">
                                                    ??/{{ v1.so_tap_phim }}
                                                </div>
                                                <div v-else-if="v1.ten_loai_phim === 'Phim Lẻ'" class="ep">
                                                    Movie
                                                </div>
                                                <div v-else class="ep">RAW</div>
                                                <div class="comment"><i class="fa fa-comments"></i> 1</div>
                                                <div class="view"><i class="fa fa-eye"></i> 9141</div>
                                            </div>
                                        </router-link>
                                        <div class="product__item__text">
                                            <ul>
                                                <li>{{ v1.ten_the_loai }}</li>
                                                <li>{{ v1.ten_loai_phim }}</li>
                                            </ul>
                                            <h5>
                                                <router-link :to="`/de-list/${v1.slug_phim}`">
                                                    <a v-bind:href="'/de-list' + v1.id">
                                                        {{ v1.ten_phim }}</a></router-link>
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                            </template>

                        </div>
                    </div>
                    <div class="product__pagination text-center">
                        <a @click="changPage(1)" type="button" ><i class="fa fa-angle-double-left"></i></a>

                        <a type="button" :class="{ current_page: page === pagination.current_page }" v-for="page in pageNumbers" :key="page"  @click="page !== '...' && changPage(page)">
                            {{ page }}
                        </a>

                        <a @click="changPage(pagination.last_page)" type="button" ><i class="fa fa-angle-double-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-8">
                    <div class="product__sidebar">

                        <div class="product__sidebar__comment">
                            <div class="section-title">
                                <h5>Hot Phim</h5>
                            </div>
                            <template v-for="(v, k) in list_9_phim " :key="k">
                                <div class="product__sidebar__comment__item">
                                    <router-link :to="{ name: 'PageDelist', params: { id: v.id, slug: v.slug_phim } }">
                                        <div class="product__sidebar__comment__item__pic">
                                            <img v-bind:src="v.hinh_anh" style="width: 99px ;" alt="" />
                                        </div>
                                    </router-link>

                                    <div class="product__sidebar__comment__item__text">
                                        <ul>
                                            <li>{{ v.ten_the_loai }}</li>
                                            <li>{{ v.ten_loai_phim }}</li>
                                        </ul>
                                        <h5>
                                            <router-link :to="`/de-list/${v.slug_phim}`">
                                                <a v-bind:href="'/de-list' + v.id">
                                                    {{ v.ten_phim }}</a></router-link>
                                        </h5>
                                        <span><i class="fa fa-eye"></i> 19.141 Viewes</span>
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
    props: ['slug'],
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
        this.loadataTheLoaiAndPhim(1);
        this.slug = this.$route.params.slug;

    },
    // watch: {
    //     $route(to, from) {
    //         this.loadataTheLoaiAndPhim(1);
    //     }
    // },
    beforeRouteUpdate(to, from, next) {
        this.slug = to.params.slug;
        this.loadataTheLoaiAndPhim(1);
        next();
    },
    methods: {
        loadataTheLoaiAndPhim(page, type) {
            var payload = {
                'type_get'  : 0,
                'slug'      : this.slug,
                // ''
            };
            axios
                .post('http://127.0.0.1:8000/api/the-loai/lay-du-lieu?page=' + page, payload)
                .then((res) => {
                    this.the_loai = res.data.the_loai;
                    this.list_9_phim = res.data.phim_9_obj;
                    this.pagination = res.data.phim.pagination;
                    this.list_phim = res.data.phim.dataPhim.data;
                    window.scrollTo(0, 0);
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
                .get("http://127.0.0.1:8000/api/the-loai/sap-xep/"+ this.the_loai.id +"/" + this.bien + '?page=' + page, {})
                .then((res) => {
                    this.list_phim = res.data.phim.dataPhim.data;
                    this.pagination = res.data.phim.pagination;

                });
        },



    },
};
</script>
<style></style>
