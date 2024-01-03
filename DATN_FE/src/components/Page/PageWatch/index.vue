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
                <div class="row">
                    <div class="col-lg-12">
                        <div class="anime__video__player text-center">
                            <YoutubeVideo v-bind:videoId="v.url" />  
                            <!-- <div tabindex="0" class="plyr plyr--full-ui plyr--video plyr--html5 plyr--fullscreen-enabled plyr--pip-supported plyr--captions-enabled plyr__poster-enabled plyr--paused"><div class="plyr__controls"><button class="plyr__controls__item plyr__control" type="button" data-plyr="play" aria-label="Play"><svg class="icon--pressed" aria-hidden="true" focusable="false"><use xlink:href="#plyr-pause"></use></svg><svg class="icon--not-pressed" aria-hidden="true" focusable="false"><use xlink:href="#plyr-play"></use></svg><span class="label--pressed plyr__sr-only">Pause</span><span class="label--not-pressed plyr__sr-only">Play</span></button><div class="plyr__controls__item plyr__progress__container"><div class="plyr__progress"><input data-plyr="seek" type="range" min="0" max="100" step="0.01" value="0" autocomplete="off" role="slider" aria-label="Seek" aria-valuemin="0" aria-valuemax="100" aria-valuenow="6.135536" id="plyr-seek-9447" aria-valuetext="00:06 of 03:57" style="--value: 2.58%;" seek-value="42.1700323059168"><progress class="plyr__progress__buffer" min="0" max="100" value="100" role="progressbar" aria-hidden="true">% buffered</progress><span class="plyr__tooltip" style="left: 41.9822%;">01:39</span></div></div><div class="plyr__controls__item plyr__time--current plyr__time" aria-label="Current time">-03:51</div><div class="plyr__controls__item plyr__volume"><button type="button" class="plyr__control plyr__control--pressed" data-plyr="mute"><svg class="icon--pressed" aria-hidden="true" focusable="false"><use xlink:href="#plyr-muted"></use></svg><svg class="icon--not-pressed" aria-hidden="true" focusable="false"><use xlink:href="#plyr-volume"></use></svg><span class="label--pressed plyr__sr-only">Unmute</span><span class="label--not-pressed plyr__sr-only">Mute</span></button></div><button class="plyr__controls__item plyr__control" type="button" data-plyr="captions"><svg class="icon--pressed" aria-hidden="true" focusable="false"><use xlink:href="#plyr-captions-on"></use></svg><svg class="icon--not-pressed" aria-hidden="true" focusable="false"><use xlink:href="#plyr-captions-off"></use></svg><span class="label--pressed plyr__sr-only">Disable captions</span><span class="label--not-pressed plyr__sr-only">Enable captions</span></button><div class="plyr__controls__item plyr__menu"><button aria-haspopup="true" aria-controls="plyr-settings-9447" aria-expanded="false" type="button" class="plyr__control" data-plyr="settings"><svg aria-hidden="true" focusable="false"><use xlink:href="#plyr-settings"></use></svg><span class="plyr__sr-only">Settings</span></button><div class="plyr__menu__container" id="plyr-settings-9447" hidden=""><div><div id="plyr-settings-9447-home"><div role="menu"><button data-plyr="settings" type="button" class="plyr__control plyr__control--forward" role="menuitem" aria-haspopup="true"><span>Captions<span class="plyr__menu__value">Disabled</span></span></button><button data-plyr="settings" type="button" class="plyr__control plyr__control--forward" role="menuitem" aria-haspopup="true" hidden=""><span>Quality<span class="plyr__menu__value">undefined</span></span></button><button data-plyr="settings" type="button" class="plyr__control plyr__control--forward" role="menuitem" aria-haspopup="true"><span>Speed<span class="plyr__menu__value">Normal</span></span></button></div></div><div id="plyr-settings-9447-captions" hidden=""><button type="button" class="plyr__control plyr__control--back"><span aria-hidden="true">Captions</span><span class="plyr__sr-only">Go back to previous menu</span></button><div role="menu"><button data-plyr="language" type="button" role="menuitemradio" class="plyr__control" aria-checked="true" value="-1"><span>Disabled</span></button><button data-plyr="language" type="button" role="menuitemradio" class="plyr__control" aria-checked="false" value="0"><span>English captions<span class="plyr__menu__value"><span class="plyr__badge">EN</span></span></span></button></div></div><div id="plyr-settings-9447-quality" hidden=""><button type="button" class="plyr__control plyr__control--back"><span aria-hidden="true">Quality</span><span class="plyr__sr-only">Go back to previous menu</span></button><div role="menu"></div></div><div id="plyr-settings-9447-speed" hidden=""><button type="button" class="plyr__control plyr__control--back"><span aria-hidden="true">Speed</span><span class="plyr__sr-only">Go back to previous menu</span></button><div role="menu"><button data-plyr="speed" type="button" role="menuitemradio" class="plyr__control" aria-checked="false" value="0.5"><span>0.5×</span></button><button data-plyr="speed" type="button" role="menuitemradio" class="plyr__control" aria-checked="false" value="0.75"><span>0.75×</span></button><button data-plyr="speed" type="button" role="menuitemradio" class="plyr__control" aria-checked="true" value="1"><span>Normal</span></button><button data-plyr="speed" type="button" role="menuitemradio" class="plyr__control" aria-checked="false" value="1.25"><span>1.25×</span></button><button data-plyr="speed" type="button" role="menuitemradio" class="plyr__control" aria-checked="false" value="1.5"><span>1.5×</span></button><button data-plyr="speed" type="button" role="menuitemradio" class="plyr__control" aria-checked="false" value="1.75"><span>1.75×</span></button><button data-plyr="speed" type="button" role="menuitemradio" class="plyr__control" aria-checked="false" value="2"><span>2×</span></button><button data-plyr="speed" type="button" role="menuitemradio" class="plyr__control" aria-checked="false" value="4"><span>4×</span></button></div></div></div></div></div><button class="plyr__controls__item plyr__control" type="button" data-plyr="fullscreen"><svg class="icon--pressed" aria-hidden="true" focusable="false"><use xlink:href="#plyr-exit-fullscreen"></use></svg><svg class="icon--not-pressed" aria-hidden="true" focusable="false"><use xlink:href="#plyr-enter-fullscreen"></use></svg><span class="label--pressed plyr__sr-only">Exit fullscreen</span><span class="label--not-pressed plyr__sr-only">Enter fullscreen</span></button></div><div class="plyr__video-wrapper"><video id="player" playsinline="" data-poster="./videos/anime-watch.jpg">
                                <source src="../../../assets/assets_Anime/videos/1.mp4" type="video/mp4">
                                <track kind="captions" label="English captions" src="#" srclang="en" default="">
                            </video><div class="plyr__poster" style="background-image: url(https://themewagon.github.io/anime/videos/anime-watch.jpg);"></div></div><div class="plyr__captions"></div><button type="button" class="plyr__control plyr__control--overlaid" data-plyr="play" aria-label="Play"><svg aria-hidden="true" focusable="false"><use xlink:href="#plyr-play"></use></svg><span class="plyr__sr-only">Play</span></button></div> -->
                        </div>
                        <div class="anime__details__episodes">
                            <div class="section-title">
                                <h5> {{ v.ten_phim }}</h5>
                            </div >
                            <template v-if="v.ten_loai_phim === 'Phim Bộ'">
                                <a href="#">Ep 01</a>
                                <a href="#">Ep 02</a>
                                <a href="#">Ep 03</a>
                                <a href="#">Ep 04</a>
                                <a href="#">Ep 05</a>
                                <a href="#">Ep 06</a>
                                <a href="#">Ep 07</a>
                                <a href="#">Ep 08</a>
                                <a href="#">Ep 09</a>
                                <a href="#">Ep 10</a>
                                <a href="#">Ep 11</a>
                                <a href="#">Ep 12</a>
                                <a href="#">Ep 13</a>
                                <a href="#">Ep 14</a>
                                <a href="#">Ep 15</a>
                                <a href="#">Ep 16</a>
                                <a href="#">Ep 17</a>
                                <a href="#">Ep 18</a>
                                <a href="#">Ep 19</a>
                            </template>
                            <template v-else>
                                <a href="#">Movie 1</a>
                                <a href="#">Movie 2</a>
                                <a href="#">Movie 3</a>
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
                                <div v-if="v.id_phim == id " class="anime__review__item">
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
        


    </template>


</template>

<script>
  import axios from "axios";
  import baseRequest from '../../../core/baseRequestUser';
  import { createToaster } from "@meforma/vue-toaster";
  import YoutubeVideo from '../../core/index.vue';

  const toaster = createToaster({
    position: "top-right",
  });
  export default {
    components : {
            YoutubeVideo
        },
    data() {
      return {
        list_loai_phim  : [],
        id_user        : localStorage.getItem('id_user'), 
        list_the_loai   : [],
        list_cmt       : [],
        obj_cmt_phim    : { 'id_khach_hang' : localStorage.getItem('id_user'), 'id_phim' : this.$route.params.id,},
        obj_xoa_cmt     : {},
        list_phim: [],
		id : this.$route.params.id,
        // list_phimHD     : [],
      };
    },
    mounted() {

      this.laydataLoaiPhim();
      this.loaddataTheLoai();
      this.laydataPhim();
      this.laydataCMT();
    },
    

    methods: {

      laydataPhim() {
        axios
          .get("http://127.0.0.1:8000/api/phim/lay-du-lieu-show")
          .then((res) => {
            this.list_phim = res.data.phim;
          });
      },
      laydataLoaiPhim() {
        axios
          .get("http://127.0.0.1:8000/api/loai-phim/lay-du-lieu-show")
          .then((res) => {
            this.list_loai_phim = res.data.loai_phim;
          });
      },
      loaddataTheLoai() {
        axios
          .get("http://127.0.0.1:8000/api/the-loai/lay-du-lieu-show")
          .then((res) => {
            this.list_the_loai = res.data.the_loai;
          });
      },
      laydataCMT() {
                axios
                .get("http://127.0.0.1:8000/api/binh-luan-phim/lay-du-lieu-show")
                .then((res) => {
                    this.list_cmt = res.data.binh_luan_phim;
                });
        },
        themBinhLuan(){
                baseRequest
                .post("admin/binh-luan-phim/thong-tin-tao" , this.obj_cmt_phim
                )
                .then((res) => {
                if (res.data.status == true) {
                    toaster.success(res.data.message);
                    this.obj_cmt_phim   = { 'id_khach_hang' : localStorage.getItem('id_user'), 'id_phim' : this.$route.params.id, 'noi_dung' : ''};
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