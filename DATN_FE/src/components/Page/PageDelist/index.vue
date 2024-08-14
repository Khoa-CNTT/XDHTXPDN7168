<template>
  <div class="breadcrumb-option" style="background-color: #0b0c2a">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <router-link to="/"><i class="fa fa-home"></i> Home</router-link>
                        <router-link to="/"> Thể Loại</router-link>
                        <!-- <router-link :to="{ name: 'PageList', params: { id: v.id_tl, slug: v.slug_the_loai }}"> {{  v.ten_the_loai }}</router-link> -->
                        <span>{{  obj_phim.ten_phim }}</span>
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
                        <div class="anime__details__pic set-bg" v-bind:style="{'background-image': 'url(' + obj_phim.hinh_anh + ')',}" data-setbg="../../../assets/assets_Anime/img/anime/details-pic.jpg">
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="anime__details__text">
                            <div class="anime__details__title">
                                <h3>{{  obj_phim.ten_phim }}</h3>
                                <span>{{  obj_phim.ten_tac_gia }}</span>
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
                            <p>{{  obj_phim.mo_ta }}</p>
                            <div class="anime__details__widget">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <ul>
                                            <li><span>Type:</span> TV Series</li>
                                            <li><span>Studios:</span> Lerche</li>
                                            <li><span>Date aired:</span> Oct 02, 2023 to ?</li>
                                            <li><span>Status:</span> Airing</li>
                                            <li><span>Genre:</span> {{ obj_phim.ten_the_loai }}</li>
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
                                 <button   v-if="isFollow == false" type="button"  @click="anTheoDoi()  " class="unfollow-btn"><i class="fa fa-heart-o"></i> Theo Dõi</button>
                                 <button   v-else type="button" @click="unTheoDoi()" class="follow-btn"><i class="fa-solid fa-heart"></i> Bỏ Theo Dõi</button>
                                    <router-link :to="`/watching/${obj_phim.slug_phim}`">
                                        <a v-bind:href="'/watching/' + obj_phim.slug_phim" class="watch-btn"><span>Xem Ngay</span> </a>
                                    </router-link>

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
                                        <div class="row">
                                            <div class="col-11"><h6>Chris Curry - <span>1 giờ trước</span></h6>
                                                <p>Phim đã hay mà admin còn đẹp trai nữa còn gì bằng !!!</p>
                                            </div>
                                        </div>

                                    </div>

                            </div>
                            <template v-for="(v,k) in list_cmt" :key="k">
                                <div v-if="v.id_phim == obj_phim.id " class="anime__review__item">
                                    <div class="anime__review__item__pic">
                                        <img v-bind:src="v.avatar" alt="">
                                    </div>
                                    <div class="anime__review__item__text">
                                        <div class="row">
                                            <div class="col-11"><h6>{{ v.ho_va_ten }} - <span>1 phút trước</span></h6>
                                                <p>{{ v.noi_dung }} !!!</p>
                                            </div>
                                            <div class="col-1">
                                        <a v-if="v.id_khach_hang == id_user " type="button" @click="Object.assign(obj_xoa_cmt,v)" data-bs-toggle="modal" data-bs-target="#exampleModal" style="color: red;"><i class="fa-solid fa-trash fa-sm mt-4 "></i></a>

                                            </div>
                                        </div>
                                    </div>
                                 </div>
                            </template>
                        </div>
                        <div class="anime__details__form">
                            <div class="section-title">
                                <h5>Bình Luận của Bạn</h5>
                            </div>
                            <form action="#">
                                <textarea v-model="obj_cmt_phim.noi_dung"  placeholder="Nhập bình luận"></textarea>
                                <button @click="themBinhLuan()" type="button"><i class="fa fa-location-arrow"></i> Gửi</button>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="anime__details__sidebar">
                            <div class="section-title">
                                <h5>hot phim</h5>
                            </div>
                            <template v-for="(v,k) in list_5_phim " :key="k">
                                <div class="product__sidebar__comment__item">
                                    <router-link :to="{ name: 'PageDelist', params: { id: v.id, slug: v.slug_phim }}">
                                        <a v-bind:href="'/de-list/' + v.slug_phim" >
                                            <div class="product__sidebar__comment__item__pic">
                                                <img v-bind:src="v.hinh_anh" style="width: 99px ;" alt="" />
                                            </div>
                                        </a>
                                    </router-link>

                                <div class="product__sidebar__comment__item__text">
                                    <ul>
                                    <li>{{ v.ten_the_loai }}</li>
                                    <li>{{ v.ten_loai_phim }}</li>
                                    </ul>
                                    <h5>
                                            <router-link :to="{ name: 'PageDelist', params: { id: v.id, slug: v.slug_phim }}">
                                                {{ v.ten_phim }}
                                            </router-link>
                                    </h5>
                                    <span><i class="fa fa-eye"></i> 19.141 lượt xem</span>
                                </div>
                                </div>
                                </template>
                        </div>
                    </div>
                     <!-- Modal xoa binh luan -->
                     <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div style="background-color: rgba(35, 33, 33,  1.0);" class="modal-content">
                                            <div class="modal-body text-white">
                                                Bạn có chắc muốn xoá bình luận?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                                <button type="button" @click="deleteBinhLuan()" class="btn btn-primary" data-bs-dismiss="modal"> Xoá</button>
                                            </div>
                                            </div>
                                        </div>
                    </div>
                </div>
            </div>
    </section>
        <!-- Anime Section End -->


</template>
<script>
    import axios from "axios"
    import baseRequest from '../../../core/baseRequestUser';
    import { createToaster } from "@meforma/vue-toaster";
    const toaster = createToaster({
        position: "top-right",
    });

    export default {
         props : [ 'slug'],
        data() {
            return {
				// id : this.$route.params.id,
                id_phim        : '',
                id_user        : localStorage.getItem('id_user'),
                obj_yt_phim    : { 'id_khach_hang' : localStorage.getItem('id_user'),},
                obj_cmt_phim   : { 'id_khach_hang' : localStorage.getItem('id_user'),},
                obj_xoa_cmt    : {},
                list_5_phim    :  [],
                obj_phim      : {},
                list_cmt       : [],
                isFollow       : {},
             };
        },
        mounted() {
            this.checkYeuThich();
            this.laydataCMT();
            this.laydataDelistPhim();


        },
        watch: {
        $route(to, from){
          this.laydataDelistPhim();
        //   this.id_phim   = this.id;
          this.obj_yt_phim    = { 'id_khach_hang' : localStorage.getItem('id_user'),};
          this.obj_cmt_phim   = { 'id_khach_hang' : localStorage.getItem('id_user'),};
          this.laydataCMT();
          this.checkYeuThich();
        }
      },
        methods: {
            laydataDelistPhim() {
                axios
                .get("http://127.0.0.1:8000/api/phim/lay-data-delist", {
                    params :{
                    slug : this.slug,
                    } })
                .then((res) => {
                    this.obj_phim = res.data.phim;
                    this.obj_cmt_phim.id_phim = res.data.phim.id;
                    this.obj_yt_phim.id_phim = res.data.phim.id;
                    this.list_5_phim = res.data.phim_5_obj;

                });
            },
            laydataCMT() {
                axios
                .get("http://127.0.0.1:8000/api/binh-luan-phim/lay-du-lieu-show")
                .then((res) => {
                    this.list_cmt = res.data.binh_luan_phim;
                });
            },
            checkYeuThich()
            {
                baseRequest
                        .post("admin/yeu-thich/kiem-tra", this.obj_yt_phim)
                        .then((res) => {
                        if (res.data.status == true) {
                            this.isFollow = true;
                        } else {
                            this.isFollow = false;
                        }
                        });
            },
            anTheoDoi(){
                baseRequest
                .post("admin/yeu-thich/thong-tin-tao" , this.obj_yt_phim)
                .then((res) => {
                if (res.data.status == true) {
                    toaster.success(res.data.message);
                     this.checkYeuThich();

                } else {
                    toaster.error(res.data.message);
                }
                });
            },

            unTheoDoi() {
                baseRequest
                    .post('admin/yeu-thich/thong-tin-xoa' , this.obj_yt_phim)
                    .then((res) => {
                    if (res.data.status == true) {
                        toaster.success(res.data.message);
                        this.checkYeuThich();


                    }
                    else {
                        toaster.danger(res.data.message);
                    }
                    });
            },
            themBinhLuan(){
                baseRequest
                .post("admin/binh-luan-phim/thong-tin-tao" , this.obj_cmt_phim
                )
                .then((res) => {
                if (res.data.status == true) {
                    toaster.success(res.data.message);
                    this.obj_cmt_phim   = { 'id_khach_hang' : localStorage.getItem('id_user'), 'id_phim' : this.id, 'noi_dung' : ''};
                    this.laydataCMT();
                } else {
                    toaster.error(res.data.message);
                }
                });
            },
            deleteBinhLuan() {
                baseRequest
                .delete('admin/binh-luan-phim/thong-tin-xoa/' + this.obj_xoa_cmt.id)
                .then((res) => {
                    if (res.data.status == true) {
                    toaster.success(  res.data.message);
                    this.laydataCMT();
                    }
                    else {
                    toaster.danger(  res.data.message);
                    }
                });
            },

        },
    };
</script>
<style></style>
