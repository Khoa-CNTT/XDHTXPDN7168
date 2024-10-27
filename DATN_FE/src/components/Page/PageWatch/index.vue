<template>
    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option" style="background-color: #0b0c2a">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <router-link to="/"><i class="fa fa-home"></i> Home</router-link>
                        <span>{{ obj_phim.ten_phim }} - Tập {{ obj_tap_phim.so_tap }}</span>
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
                        <!-- Sử dụng `v-bind` để thêm hình nền và URL video từ `obj_tap_phim` -->
                        <iframe width="1140px" height="654px" :src="obj_tap_phim.url" frameborder="0" allow="autoplay"
                            allowfullscreen>
                        </iframe>
                    </div>

                    <div class="anime__details__episodes">
                        <div class="section-title">
                            <!-- Hiển thị tên phim -->
                            <h5>{{ obj_phim.ten_phim }} - Tập {{ obj_tap_phim.so_tap }}</h5>
                        </div>

                        <!-- Lặp qua danh sách tập phim, chỉ hiển thị tập của phim hiện tại -->
                        <template v-for="(v, k) in list_tap_phim" :key="k">
                            <!-- <router-link :to="`/${obj_phim.slug_phim}/${obj_tap_phim.slug_tap_phim}`"> -->
                                <a v-if="v.id_phim == obj_phim.id" @click="Object.assign(obj_tap_phim, v);navigateToEpisode(v)" type="button"
                                    class="text-white" :class="{ 'bg-secondary': obj_tap_phim.id === v.id }">
                                    Tập {{ v.so_tap }}
                                </a>
                            <!-- </router-link> -->
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
                        <template v-for="(v, k) in list_cmt" :key="k">
                            <div v-if="v.id_phim == obj_phim.id" class="anime__review__item">
                                <div class="anime__review__item__pic">
                                    <img v-bind:src="v.avatar" alt="">
                                </div>
                                <div class="anime__review__item__text">
                                    <div class="row">
                                        <div class="col-11">
                                            <h6>{{ v.ho_va_ten }} - <span>1 phút trước</span></h6>
                                            <p>{{ v.noi_dung }} !!!</p>
                                        </div>
                                        <div class="col-1">
                                            <a v-if="v.id_khach_hang == id_user" type="button"
                                                @click="Object.assign(obj_xoa_cmt, v);" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal" style="color: red;"><i
                                                    class="fa-solid fa-trash fa-sm mt-4 "></i></a>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>
                    <div class="anime__details__form">
                        <div class="section-title">
                            <h5>Viết Bình Luận </h5>
                        </div>
                        <form action="#">
                            <textarea v-model="obj_cmt_phim.noi_dung" placeholder="Nhập bình luận"></textarea>
                            <button @click="themBinhLuan()" type="button"><i class="fa fa-location-arrow"></i>
                                Gửi</button>
                        </form>
                    </div>
                </div>

                <!-- Modal xoa binh luan -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div style="background-color: rgba(35, 33, 33,  1.0);" class="modal-content">
                            <div class="modal-body text-white">
                                Bạn có chắc muốn xoá bình luận?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                <button type="button" @click="deleteBinhLuan()" class="btn btn-primary"
                                    data-bs-dismiss="modal">
                                    Xoá</button>
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
    props: ["slugMovie", "slugEpisode"],
    data() {
        return {
            list_tap_phim: [],
            obj_phim: {},
            obj_tap_phim: {},
            id_user: localStorage.getItem('id_user'),
            list_cmt: [],
            obj_cmt_phim: {},
            obj_xoa_cmt: {},
        };
    },
    mounted() {
        this.$store.dispatch('showLoader');
        this.LaydataDeXem();
        this.laydataCMT();
    },


    methods: {
        navigateToEpisode(v) {

            // Chuyển hướng trang
            this.$router.push(`/${this.obj_phim.slug_phim}/${v.slug_tap_phim}`);
        },
        LaydataDeXem() {
            var payload = {
                'slugMovie': this.slugMovie,
                'slugEpisode': this.slugEpisode,
            }
            baseRequest
                .post("lay-data-watch", payload)
                .then((res) => {
                    this.obj_phim = res.data.phim;
                    this.obj_tap_phim = res.data.tap;
                    this.list_tap_phim = res.data.tap_phims;
                    this.$store.dispatch('hideLoader');
                })
                .catch(() => {
                    this.$router.push('/'); // Ẩn loader nếu có lỗi
                    this.$store.dispatch('hideLoader'); // Ẩn loader nếu có lỗi
                });

        },
        // laydataTapPhim() {
        //     baseRequest
        //         .get("tap-phim/lay-du-lieu-show")
        //         .then((res) => {
        //             this.list_tap_phim = res.data.tap_phim;
        //         });
        // },
        laydataCMT() {
            baseRequest
                .get("binh-luan-phim/lay-du-lieu-show")
                .then((res) => {
                    this.list_cmt = res.data.binh_luan_phim;
                });
        },
        themBinhLuan() {
            var payload = {
                'id_phim': this.obj_phim.id,
                'id_khach_hang': localStorage.getItem('id_user'),
                'noi_dung': this.obj_cmt_phim.noi_dung
            }
            baseRequest
                .post("admin/binh-luan-phim/thong-tin-tao", payload
                )
                .then((res) => {
                    if (res.data.status == true) {
                        toaster.success(res.data.message);
                        this.obj_cmt_phim = {};
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
                        toaster.success(res.data.message);
                        this.laydataCMT();
                    }
                    else {
                        toaster.danger(res.data.message);
                    }
                });
        },

    },

};
</script>
<style></style>
