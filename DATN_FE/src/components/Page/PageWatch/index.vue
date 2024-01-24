<template>
                <!-- Breadcrumb Begin -->
        <div class="breadcrumb-option" style="background-color: #0b0c2a">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="breadcrumb__links">
                            <router-link to="/"><i class="fa fa-home"></i> Home</router-link>
                            <router-link :to="`/the-loai/${obj_phim.id_the_loai}`"> Thể Loại</router-link>
                            <router-link :to="`/the-loai/${obj_phim.id_the_loai}`"> {{  obj_phim.ten_the_loai }}</router-link>
                            <span>{{  obj_phim.ten_phim }}</span>
                        </div>
                </div>
                </div>
            </div>
        </div>
        <!-- Breadcrumb End -->

        <!-- Anime Section Begin -->
        <section class="anime-details spad" style="background-color: #0b0c2a; padding-top: 15px;">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="anime__video__player" style="margin-bottom: 30px;">
                            <iframe width="1140px" height="654px"  v-bind:style="{'background-image': 'url(' + obj_phim.hinh_anh + ')', }" v-bind:src="obj_tap_phim.url" frameborder="0" allow="autoplay" allowfullscreen></iframe>
                        </div>
                        <div class="anime__details__episodes">
                            <div class="section-title">
                                <h5> {{ obj_phim.ten_phim }}</h5>
                            </div >
                            <template v-for="(v,k) in list_tap_phim">
                                <template v-if="v.id_phim == obj_phim.id">
                                    <a @click="Object.assign(obj_tap_phim,v)" type="button" class="text-white" >{{ v.ten_tap_phim }}</a>
                                </template>
                            </template>
                        </div>
                        
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-9 col-md-8">
                        <div class="anime__details__review">
                            <div class="section-title">
                                <h5>Bình Luận</h5>
                            </div>
                            <template v-for="(v,k) in list_cmt">
                                <div v-if="v.id_phim == obj_phim.id " class="anime__review__item">
                                    <div class="anime__review__item__pic">
                                        <img v-bind:src="v.hinh_anh" alt="">
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
  import axios from "axios";
  import baseRequest from '../../../core/baseRequestUser';
  import { createToaster } from "@meforma/vue-toaster";

  const toaster = createToaster({
    position: "top-right",
  });
  export default {
    data() {
      return {
        list_tap_phim  : [],
        obj_phim       : {},
        obj_tap_phim   : {},
        id_user        : localStorage.getItem('id_user'), 
        list_cmt       : [],
        obj_cmt_phim    : { },
        obj_xoa_cmt     : {},
      };
    },
    mounted() {
      this.LaydataDeXem();
      this.laydataTapPhim();
      this.laydataCMT();
    },
    

    methods: {
        LaydataDeXem() {
                    var payload = {
                    'slug': this.$route.params.slug
                }
                baseRequest
            .post("lay-data-watch", payload)
            .then((res) => {
              this.obj_phim = res.data.phim;
            });
        },
      laydataTapPhim() {
                baseRequest
            .get("tap-phim/lay-du-lieu-show")
            .then((res) => {
              this.list_tap_phim = res.data.tap_phim;
            });
        },
      laydataCMT() {
                 baseRequest
                .get("binh-luan-phim/lay-du-lieu-show")
                .then((res) => {
                    this.list_cmt = res.data.binh_luan_phim;
                });
        },
        themBinhLuan(){
            var payload = {
                    'id_phim': this.obj_phim.id,
                    'id_khach_hang' : localStorage.getItem('id_user'),
                    'noi_dung'      : this.obj_cmt_phim.noi_dung
                }
                baseRequest
                .post("admin/binh-luan-phim/thong-tin-tao" , payload
                )
                .then((res) => {
                if (res.data.status == true) {
                    toaster.success(res.data.message);
                    this.obj_cmt_phim   = {};
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