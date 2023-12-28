<template>
 <template v-for="(v,k) in list_phim">
    <template v-if="v.id == id">
          <!-- Breadcrumb Begin -->
  <div class="breadcrumb-option" style="background-color: #0b0c2a">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <router-link to="/"><i class="fa fa-home"></i> Home</router-link>
                        <router-link :to="`/index1/${v.id_the_loai}`"> Thể Loại</router-link>
                        <router-link :to="`/index1/${v.id_the_loai}`"> {{  v.ten_the_loai }}</router-link>
                        <span>{{  v.ten_phim }}</span>
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
                        <div class="anime__details__pic set-bg" v-bind:style="{'background-image': 'url(' + v.hinh_anh + ')',}" data-setbg="../../../assets/assets_Anime/img/anime/details-pic.jpg">
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="anime__details__text">
                            <div class="anime__details__title">
                                <h3>{{  v.ten_phim }}</h3>
                                <span>{{  v.ten_tac_gia }}</span>
                            </div>
                            <div class="anime__details__rating">
                                <div class="rating">
                                    <a href="#"><i class="fa fa-star"></i></a>
                                    <a href="#"><i class="fa fa-star"></i></a>
                                    <a href="#"><i class="fa fa-star"></i></a>
                                    <a href="#"><i class="fa fa-star"></i></a>
                                    <a href="#"><i class="fa fa-star-half-o"></i></a>
                                </div>
                                <span>1.029 Votes</span>
                            </div>
                            <p>{{  v.mo_ta }}</p>
                            <div class="anime__details__widget">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <ul>
                                            <li><span>Type:</span> TV Series</li>
                                            <li><span>Studios:</span> Lerche</li>
                                            <li><span>Date aired:</span> Oct 02, 2019 to ?</li>
                                            <li><span>Status:</span> Airing</li>
                                            <li><span>Genre:</span> Action, Adventure, Fantasy, Magic</li>
                                        </ul>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <ul>
                                            <li><span>Scores:</span> 7.31 / 1,515</li>
                                            <li><span>Rating:</span> 8.5 / 161 times</li>
                                            <li><span>Duration:</span> 24 min/ep</li>
                                            <li><span>Quality:</span> HD</li>
                                            <li><span>Views:</span> 131,541</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="anime__details__btn">
                                <a href="#" class="follow-btn"><i class="fa fa-heart-o"></i> Follow</a>
                                <a href="#" class="watch-btn"><span>Watch Now</span> </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 col-md-8">
                        <div class="anime__details__review">
                            <div class="section-title">
                                <h5>Đánh Giá</h5>
                            </div>
                            <div class="anime__review__item">
                                <div class="anime__review__item__pic">
                                    <img src="../../../assets/assets_Anime/img/anime/review-1.jpg" alt="">
                                </div>
                                <div class="anime__review__item__text">
                                    <h6>Chris Curry - <span>1 giờ trước</span></h6>
                                    <p>whachikan Mới để ý thấy có người xếp cái này vào thể loại "quỷ" LOL</p>
                                </div>
                            </div>
                            <div class="anime__review__item">
                                <div class="anime__review__item__pic">
                                    <img src="../../../assets/assets_Anime/img/anime/review-2.jpg" alt="">
                                </div>
                                <div class="anime__review__item__text">
                                    <h6>Lewis Mann - <span>5 giờ trước</span></h6>
                                    <p>Cuối cùng nó đã xuất hiện từ lâu rồi</p>
                                </div>
                            </div>
                            <div class="anime__review__item">
                                <div class="anime__review__item__pic">
                                    <img src="../../../assets/assets_Anime/img/anime/review-3.jpg" alt="">
                                </div>
                                <div class="anime__review__item__text">
                                    <h6>Louis Tyler - <span>20 giờ trước</span></h6>
                                    <p>Tập 15 ở đâu vậy Cập nhật chậm! Tch</p>
                                </div>
                            </div>
                            <div class="anime__review__item">
                                <div class="anime__review__item__pic">
                                    <img src="../../../assets/assets_Anime/img/anime/review-4.jpg" alt="">
                                </div>
                                <div class="anime__review__item__text">
                                    <h6>Chris Curry - <span>1 giờ trước</span></h6>
                                    <p>whachikan Mới để ý thấy có người xếp cái này vào thể loại "quỷ" LOL</p>
                                </div>
                            </div>
                            <div class="anime__review__item">
                                <div class="anime__review__item__pic">
                                    <img src="../../../assets/assets_Anime/img/anime/review-5.jpg" alt="">
                                </div>
                                <div class="anime__review__item__text">
                                    <h6>Lewis Mann - <span>5 giờ trước</span></h6>
                                    <p>Cuối cùng nó đã xuất hiện từ lâu rồi</p>
                                </div>
                            </div>
                            <div class="anime__review__item">
                                <div class="anime__review__item__pic">
                                    <img src="../../../assets/assets_Anime/img/anime/review-6.jpg" alt="">
                                </div>
                                <div class="anime__review__item__text">
                                    <h6>Louis Tyler - <span>20 giờ trước</span></h6>
                                    <p>Tập 15 ở đâu vậy Cập nhật chậm! Tch</p>
                                </div>
                            </div>
                        </div>
                        <div class="anime__details__form">
                            <div class="section-title">
                                <h5>Bình Luận của Bạn</h5>
                            </div>
                            <form action="#">
                                <textarea placeholder="Nhập bình luận"></textarea>
                                <button type="submit"><i class="fa fa-location-arrow"></i> Review</button>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="anime__details__sidebar">
                            <div class="section-title">
                                <h5>hot phim</h5>
                            </div>
                            <template v-for="(v,k) in Show5object ">
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
    </section>
        <!-- Anime Section End -->

        <!-- Footer Section Begin -->
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
				id : this.$route.params.id,
                        list_loai_phim : [],
                obj_mo_ta      : {},
                list_the_loai  : [],
                list_tac_gia   : [],
                list_phim      : [],
                    };
        },
        mounted() {
            this.laydataLoaiPhim();
            this.loaddataTheLoai();
            this.laydataPhim();
        },
        computed: {
            // Tính toán để lấy ba phần tử cuối cùng của mảng items
            Show5object() {
                const totalItems = this.list_phim.length;
                // Sử dụng slice để lấy ba phần tử cuối cùng của mảng
                return this.list_phim.slice(totalItems - 5, totalItems);
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