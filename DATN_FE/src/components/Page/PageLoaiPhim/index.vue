<template>
    <template v-for="(v,k) in list_loai_phim">
        <template v-if="v.id == id">
            <!-- Breadcrumb Begin -->
            <div class="breadcrumb-option" style="background-color: #0b0c2a">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="breadcrumb__links">
                                <router-link to="/"><i class="fa fa-home"></i> Home</router-link>
                                <router-link to="/"> Loại Phim</router-link>
                                <a href=""> {{ v.ten_loai_phim }}</a>
                                <span>{{ v.ten_phim }}</span>
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
                                                <h4>{{ v.ten_loai_phim }}</h4>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-6">
                                            <div class="product__page__filter">
                                                <p>Order by:</p>
                                                <select style="display: none;">
                                                    <option value="">A-Z</option>
                                                    <option value="">1-10</option>
                                                    <option value="">10-50</option>
                                                </select>
                                                <div class="nice-select" tabindex="0"><span class="current">A-Z</span>
                                                    <ul class="list">
                                                        <li data-value="" class="option selected">A-Z</li>
                                                        <li data-value="" class="option">1-10</li>
                                                        <li data-value="" class="option">10-50</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <template v-for="(v1,k1) in list_phim">
                                        <div v-if="v1.id_loai_phim == v.id" class="col-lg-4 col-md-6 col-sm-6">
                                        <div class="product__item">
                                            <div class="product__item__pic set-bg"
                                            v-bind:style="{'background-image': 'url(' + v1.hinh_anh + ')',}">
                                                <div v-if="v1.ten_loai_phim === 'Phim Bộ'" class="ep">1??/99</div>
                                                <div class="comment"><i class="fa fa-comments"></i> 11</div>
                                                <div class="view"><i class="fa fa-eye"></i> 9141</div>
                                            </div>
                                            <div class="product__item__text">
                                                <ul>
                                                    <li>{{ v1.ten_the_loai }}</li>
                                                     <li>{{ v1.ten_loai_phim }}</li>
                                                </ul>
                                                <h5>
                                                            <router-link :to="`/index2/${v1.id}`">
                                                        <a v-bind:href="'/index2' + v1.id">
                                                        {{ v1.ten_phim }}</a></router-link>
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
                                    <template v-for="(v,k) in Show8object ">
                                <div class="product__sidebar__comment__item">
                                <div class="product__sidebar__comment__item__pic">
                                    <img v-bind:src="v.hinh_anh" style="width: 99px ;" alt="" />
                                </div>
                                <div class="product__sidebar__comment__item__text">
                                    <ul>
                                    <li>{{ v.ten_the_loai }}</li>
                                    <li>{{ v.ten_loai_phim }}</li>
                                    </ul>
                                    <h5>
                                    <router-link :to="`/index2/${v.id}`">
                                            <a v-bind:href="'/index2' + v.id">
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
        
    </template>


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
                id: this.$route.params.id,
                list_loai_phim: [],
                list_the_loai: [],
                list_tac_gia: [],
                list_phim: [],
            };
        },
        mounted() {
            this.laydataLoaiPhim();
            this.loaddataTheLoai();
            this.laydataPhim();
        },
        computed: {
            // Tính toán để lấy ba phần tử cuối cùng của mảng items
            Show8object() {
                const totalItems = this.list_phim.length;
                // Sử dụng slice để lấy ba phần tử cuối cùng của mảng
                return this.list_phim.slice(totalItems - 8, totalItems);
            },
            
        },
        methods: {
            laydataPhim() {
                baseRequest
                    .get("admin/phim/lay-du-lieu")
                    .then((res) => {
                        this.list_phim = res.data.phim;
                    });
            },
            laydataLoaiPhim() {
                axios
                    .get("http://127.0.0.1:8000/api/admin/loai-phim/lay-du-lieu")
                    .then((res) => {
                        this.list_loai_phim = res.data.loai_phim;
                    });
            },
            loaddataTheLoai() {
                axios
                    .get("http://127.0.0.1:8000/api/admin/the-loai/lay-du-lieu")
                    .then((res) => {
                        this.list_the_loai = res.data.the_loai;
                    });
            },

        },
    };
</script>
<style></style>