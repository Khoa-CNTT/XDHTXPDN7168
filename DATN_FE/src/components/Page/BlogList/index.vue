<template>
    <section class="normal-breadcrumb set-bg" data-setbg="img/normal-breadcrumb.jpg" style="
      background-image: url(https://themewagon.github.io/anime/img/normal-breadcrumb.jpg);
      background-color: #0b0c2a;
    ">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="normal__breadcrumb__text">
                        <h2>BLOG</h2>
                        <p>Chào mừng bạn đến với blog Anime.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Blog Section Begin -->
    <section style="background-color: #0b0c2a" class="blog spad">
        <div class="container mt-3">
            <div class="row">
                <div class="col-lg-12">
                    <div class="trending__product">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <ul class="nav nav-tabs section-title" style="
                    border-bottom: 1px solid #f8f6f6;
                    background-color: #0b0c2a;
                    display: flex;
                    justify-content: center;
                  " id="myTab" role="tablist">
                                    <template v-for="(v, k) in list_chuyen_muc" :key="k">
                                        <template v-if="k == 0">
                                            <li class="nav-item" role="presentation">
                                                <button @click="changeChuyenMuc(v.id, 1)" style="
                            background-color: rgba(35, 33, 33, 0.4);
                            width: 180px;
                          " class="nav-link active" id="home-tab" data-bs-toggle="tab"
                                                    v-bind:data-bs-target="'#home-tab-pane' + k" type="button"
                                                    role="tab" aria-selected="true">
                                                    <h5>{{ v.ten_chuyen_muc }}</h5>
                                                </button>
                                            </li>
                                        </template>
                                        <template v-else>
                                            <li class="nav-item" role="presentation">
                                                <button @click="changeChuyenMuc(v.id, 1)" style="
                            background-color: rgba(35, 33, 33, 0.4);
                            width: 180px;
                          " class="nav-link" id="profile-tab" data-bs-toggle="tab"
                                                    v-bind:data-bs-target="'#profile-tab-pane' + k" type="button"
                                                    role="tab" aria-selected="false">
                                                    <h5>{{ v.ten_chuyen_muc }}</h5>
                                                </button>
                                            </li>
                                        </template>
                                    </template>
                                </ul>
                            </div>
                        </div>
                        <div class="row">
                            <div id="myTabContent" class="tab-content ">
                                <template v-for="(v, k) in list_chuyen_muc" :key="k">
                                    <template v-if="k == 0">
                                        <div class="tab-pane fade show active" v-bind:id="'home-tab-pane' + k"
                                            role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                                            <div class="row">
                                                <template v-for="(v1, k1) in list_blog" :key="k1">
                                                    <div v-if="v1.id_chuyen_muc == v.id"
                                                        class="col-lg-4 col-md-6 col-sm-6">
                                                        <router-link :to="`/blog/${v1.slug_tieu_de}`">
                                                            <div class="blog__item small__item set-bg" v-bind:style="{
                                                                'background-image':
                                                                    'url(' + v1.hinh_anh + ')',
                                                            }">
                                                                <div style="
                                    background-color: rgba(35, 33, 33, 0.7);
                                    top: 194px;
                                    bottom: 0;
                                  " class="blog__item__text">
                                                                    <p>
                                                                        <span class="icon_calendar"></span> 21 March
                                                                        2023
                                                                    </p>
                                                                    <h4>
                                                                        <router-link :to="`/blog/${v1.slug_tieu_de}`">
                                                                            <a v-bind:href="'/blog' + v1.slug_tieu_de">
                                                                                {{ v1.tieu_de }}</a></router-link>
                                                                    </h4>
                                                                </div>
                                                            </div>
                                                        </router-link>
                                                    </div>
                                                </template>
                                            </div>
                                        </div>
                                    </template>
                                    <template v-else>
                                        <div class="tab-pane fade" v-bind:id="'profile-tab-pane' + k" role="tabpanel"
                                            aria-labelledby="profile-tab" tabindex="0">
                                            <div class="row">
                                                <template v-for="(v1, k1) in list_blog" :key="k1">
                                                    <div v-if="v1.id_chuyen_muc == v.id"
                                                        class="col-lg-4 col-md-6 col-sm-6">
                                                        <router-link :to="`/blog/${v1.slug_tieu_de}`">
                                                            <div class="blog__item small__item set-bg" v-bind:style="{
                                                                'background-image':
                                                                    'url(' + v1.hinh_anh + ')',
                                                            }">
                                                                <div style="
                                    background-color: rgba(35, 33, 33, 0.7);
                                    top: 194px;
                                    bottom: 0;
                                  " class="blog__item__text">
                                                                    <p>
                                                                        <span class="icon_calendar"></span> 21 March
                                                                        2023
                                                                    </p>
                                                                    <h4>
                                                                        <router-link :to="`/blog/${v1.slug_tieu_de}`">
                                                                            <a v-bind:href="'/blog' + v1.id">
                                                                                {{ v1.tieu_de }}</a></router-link>
                                                                    </h4>
                                                                </div>
                                                            </div>
                                                        </router-link>
                                                    </div>
                                                </template>
                                            </div>
                                        </div>
                                    </template>
                                </template>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
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
    </section>
    <!-- Blog Section End -->
</template>
<script>
import axios from "axios";
import { getPageNumbers } from "../../../core/paginationUtils.js";
import { createToaster } from "@meforma/vue-toaster";
const toaster = createToaster({
    position: "top-right",
});
export default {
    data() {
        return {
            check_id_cm: 1,
            list_blog: [],
            list_chuyen_muc: [],
            isLoading: true,
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
        this.laydataLoaiBlog(1);
        this.loaddataChuyenMuc();
    },

    methods: {
        changPage(page) {
            if (this.check_page == 0) {
                this.laydataLoaiBlog(page);
            } else if (this.check_page == 1) {
                this.changeChuyenMuc(this.check_id_cm, page);
            }
        },
        laydataLoaiBlog(page) {
            axios
                .get("https://wopai-be.dzfullstack.edu.vn/api/bai-viet/lay-du-lieu-show?page=" + page)
                .then((res) => {
                    this.list_blog = res.data.bai_viet.dataAdmin.data;
                    this.pagination = res.data.bai_viet.pagination;
                    this.$store.dispatch('hideLoader');

                }).catch(() => {
                    this.$store.dispatch('hideLoader'); // Ẩn loader nếu có lỗi
                });
        },
        loaddataChuyenMuc() {
            axios
                .get("https://wopai-be.dzfullstack.edu.vn/api/chuyen-muc/lay-du-lieu-show")
                .then((res) => {
                    this.list_chuyen_muc = res.data.chuyen_muc;
                });
        },
        changeChuyenMuc(id_chuyen_muc, page) {
            this.check_id_cm = id_chuyen_muc;
            this.check_page = 1;
            var payload = {
                'id_chuyen_muc': id_chuyen_muc
            };
            axios
                .post("https://wopai-be.dzfullstack.edu.vn/api/bai-viet/change-chuyen-muc?page=" + page, payload)
                .then((res) => {
                    this.list_blog = res.data.bai_viet.dataAdmin.data;
                    this.pagination = res.data.bai_viet.pagination;
                    window.scrollTo(0, 0);

                });
        },
    },
};
</script>
<style></style>
