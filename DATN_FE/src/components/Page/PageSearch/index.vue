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
                                <span>{{ key_tim.key}}</span>
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
                                        <div class="col-lg-12 col-md-12 col-sm-6">
                                            <div class="section-title">
                                                <h4>Từ khoá Tìm: {{ key_tim.key }}</h4>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="row">
                                    <template v-for="(v,k) in list_phim">
                                        <div class="col-lg-4 col-md-6 col-sm-6">
                                        <div class="product__item">
                                           <router-link :to="`/de-list/${v.slug_phim}`"  >
                                                <div class="product__item__pic set-bg"
                                                v-bind:style="{'background-image': 'url(' + v.hinh_anh + ')',}">
                                                <div v-if="v.ten_loai_phim === 'Phim Bộ'" class="ep">1??/99</div>
                                                <div v-else-if="v.ten_loai_phim === 'Phim Chiếu Rap'" class="ep">Movie</div>
                                                <div v-else class="ep">1/1</div>
                                                    <div class="comment"><i class="fa fa-comments"></i> 11</div>
                                                    <div class="view"><i class="fa fa-eye"></i> 9141</div>
                                                </div>
                                           </router-link>
                                            <div class="product__item__text">
                                                <ul>
                                                    <li>{{ v.ten_the_loai }}</li>
                                                     <li>{{ v.ten_loai_phim }}</li>
                                                </ul>
                                                <h5>
                                                            <router-link :to="`/de-list/${v.slug_phim}`">
                                                        <a v-bind:href="'/de-list' + v.id">
                                                        {{ v.ten_phim }}</a></router-link>
                                                     </h5>
                                            </div>
                                        </div>
                                    </div>

                                    </template>

                                </div>
                            </div>
                            <div class="product__pagination">
                                <a href="#" class="current-page">1</a>
                                <a href="#">2</a>
                                <a href="#">3</a>
                                <a href="#">4</a>
                                <a href="#">5</a>
                                <a href="#"><i class="fa fa-angle-double-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-8">
                            <div class="product__sidebar">

                                <div class="product__sidebar__comment">
                                    <div class="section-title">
                                        <h5>Hot Phim</h5>
                                    </div>
                                    <template v-for="(v,k) in list_9_phim ">
                                <div class="product__sidebar__comment__item">

                                    <router-link  :to="`/de-list/${v.slug_phim}`" >
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
                                            <a v-bind:href="'/de-list' + v.slug_phim">
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


    <!-- </template> -->


</template>
<script>
    import axios from "axios"
    import baseRequest from '../../../core/baseRequest';
    import { createToaster } from "@meforma/vue-toaster";
    const toaster = createToaster({
        position: "top-right",
    });

    export default {
        data() {
            return {
                key_tim         : {key : this.$route.params.id},
                list_phim       : [],
                list_9_phim     : [],

            };
        },
        mounted() {
            this.laydataPhim();
            this.searchPhim();
        },
        methods: {

            laydataPhim() {
                axios
                    .get("https://wietfe216.trangchudulich.com/api/phim/lay-du-lieu-show")
                    .then((res) => {
                        this.list_phim = res.data.phim;
                        this.list_9_phim = res.data.phim_9_obj;

                    });
            },
            laydataLoaiPhim() {
                axios
                    .get("https://wietfe216.trangchudulich.com/api/loai-phim/lay-du-lieu-show")
                    .then((res) => {
                        this.list_loai_phim = res.data.loai_phim;
                    });
            },
            searchPhim() {
                axios
                    .post("https://wietfe216.trangchudulich.com/api/phim/thong-tin-tim",this.key_tim)
                    .then((res) => {
                        this.list_phim = res.data.phim;
                    });
            },

        },
    };
</script>
<style></style>
