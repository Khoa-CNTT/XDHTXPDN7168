<template>
    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option" style="background-color: #0b0c2a">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <router-link to="/"><i class="fa fa-home"></i> Home</router-link>
                        <span> <router-link :to="'/' + slugMovie">{{ obj_phim.ten_phim }} </router-link> Tập {{ obj_tap_phim.so_tap }}</span>
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
                            <a v-if="v.id_phim == obj_phim.id"
                                @click="Object.assign(obj_tap_phim, v); navigateToEpisode(v)" type="button"
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
                            <div v-if="v.id_tap_phim == obj_tap_phim.id" class="anime__review__item">
                                <div class="anime__review__item__pic">
                                    <img v-bind:src="v.avatar" alt="" />
                                </div>
                                <div class="anime__review__item__text">
                                    <div class="row">
                                        <div class="col-12">
                                            <h6>
                                                {{ v.ho_va_ten
                                                }}<span style="font-size: 0.9rem">
                                                    - {{ fromNow(v.created_at) }}</span><span style="font-size: 0.9rem"
                                                    v-if="v.updated_at > v.created_at">
                                                    ( Đã chỉnh sửa )</span>
                                            </h6>
                                            <p v-if="editingCommentId !== v.id" class="textwrap">
                                                {{ v.noi_dung }}
                                            </p>
                                            <textarea v-if="editingCommentId === v.id" v-model="obj_cmt_update.noi_dung"
                                                placeholder="Nhập bình luận" class="form-control"></textarea>
                                            <div style="float: right" class="mt-1">
                                                <template v-if="id_user == v.id_khach_hang">
                                                    <a type="button" class="text-primary mr-3" style="font-size: 1rem"
                                                        v-if="editingCommentId !== v.id"
                                                        v-on::click.prevent="beginEdit(v)"><i
                                                            class="fa-solid fa-pen mt-4"></i></a>
                                                </template>
                                                <template v-if="id_user == v.id_khach_hang">
                                                    <a type="button" v-on::click="Object.assign(obj_xoa_cmt, v)"
                                                        data-bs-toggle="modal" data-bs-target="#delCMT"
                                                        style="font-size: 1rem" class="mr-3 text-danger"
                                                        v-if="editingCommentId !== v.id"><i
                                                            class="fa-solid fa-trash mt-4"></i></a>
                                                </template>
                                                <div class="container" v-if="editingCommentId === v.id">
                                                    <a type="button" class="mr-3 text-primary" style="font-size: 1rem"
                                                        v-on::click.prevent="cancelEdit()">Hủy</a>
                                                    <a type="button" class="mr-3 text-primary" style="font-size: 1rem"
                                                        v-on::click.prevent="updateBinhLuan()">Lưu</a>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- <div class="col-1">
                                            <a v-if="v.id_khach_hang == id_user" type="button"
                                                click="Object.assign(obj_xoa_cmt, v)" data-bs-toggle="modal"
                                                data-bs-target="#delCMT" style="color: red;"><i
                                                    class="fa-solid fa-trash fa-sm mt-4 "></i></a>

                                        </div> -->
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
                <div class="modal fade" id="delCMT" tabindex="-1" aria-labelledby="exampleModalLabel"
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
import moment from 'moment';
import 'moment/locale/vi';
import axios from "axios";
import baseRequest from '../../../core/baseRequestUser';
import { createToaster } from "@meforma/vue-toaster";

const toaster = createToaster({
    position: "top-right",
});
export default {
    props: ["slugMovie", "slugEpisode"],
    beforeRouteUpdate(to, from, next) {
        this.slugMovie = to.params.slugMovie;
        this.slugEpisode = to.params.slugEpisode;
        this.LaydataDeXem();
        this.laydataCMT();
        next();
    },
    data() {
        return {
            slugEpisode: this.$route.params.slugEpisode,
            slugMovie: this.$route.params.slugMovie,
            editingCommentId: null,
            list_tap_phim: [],
            obj_phim: {},
            obj_tap_phim: {},
            id_user: localStorage.getItem('id_user'),
            list_cmt: [],
            obj_cmt_phim: {},
            obj_cmt_update: {},
            obj_xoa_cmt: {},
        };
    },
    mounted() {
        this.$store.dispatch('showLoader');
        this.$route.params.slugEpisode,
            this.LaydataDeXem();
        this.laydataCMT();
    },


    methods: {
        fromNow: function (datetime) {
            moment.locale('vi'); // Đảm bảo ngôn ngữ được cài đặt là 'vi'
            return moment(datetime).fromNow();
        },
        beginEdit(comment) {
            this.editingCommentId = comment.id;
            this.obj_cmt_update = Object.assign({}, comment);
        },
        cancelEdit() {
            this.editingCommentId = null;
            this.obj_cmt_update = {};
        },
        navigateToEpisode(v) {
            this.$store.dispatch('showLoader');
            // Chuyển hướng trang
            this.$router.push(`/${this.obj_phim.slug_phim}/${v.slug_tap_phim}`);
            this.laydataCMT();
        },
        LaydataDeXem() {
            var payload = {
                'slugMovie': this.slugMovie,
                'slugEpisode': this.slugEpisode,
            }
            baseRequest
                .post("lay-data-watch", payload)
                .then((res) => {
                    // if (res.data.status === 0) {
                    //     toaster.error(res.data.message);

                    // }
                    this.obj_phim = res.data.phim || {}; // Gán {} nếu không có dữ liệu
                    this.obj_tap_phim = res.data.tap || {};
                    this.list_tap_phim = res.data.tap_phims || [];
                    this.$store.dispatch('hideLoader');
                })
                .catch(() => {
                    this.$router.push('/'); // Ẩn loader nếu có lỗi
                    toaster.warning("Đã xảy ra lỗi, vui lòng thử lại sau");
                    toaster.error(errors[0]);
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
            this.$store.dispatch('showLoader');
            var params = {
                'slug': this.slugEpisode,
            }
            baseRequest
                .get("binh-luan-tap-phim/lay-du-lieu", params)
                .then((res) => {
                    this.list_cmt = res.data.binh_luan_tap_phim;
                    this.$store.dispatch('hideLoader');

                }).catch(() => {
                    // this.$router.push('/'); // Ẩn loader nếu có lỗi
                    this.$store.dispatch('hideLoader'); // Ẩn loader nếu có lỗi
                    toaster.error(errors[0]);
                });
        },
        themBinhLuan() {
            var payload = {
                'id_tap_phim': this.obj_tap_phim.id,
                'noi_dung': this.obj_cmt_phim.noi_dung
            }
            baseRequest
                .post("khach-hang/binh-luan-tap-phim/thong-tin-tao", payload
                )
                .then((res) => {
                    if (res.data.status == true) {
                        toaster.success(res.data.message);
                        this.obj_cmt_phim = {};
                        this.laydataCMT();
                    } else {
                        toaster.error(res.data.message);
                    }
                }).catch((res) => {
                    toaster.error(errors[0]);
                });
        },
        deleteBinhLuan() {
            baseRequest
                .post('khach-hang/binh-luan-tap-phim/thong-tin-xoa', this.obj_xoa_cmt)
                .then((res) => {
                    if (res.data.status == true) {
                        this.laydataCMT();
                    }
                    else {
                        toaster.danger(res.data.message);
                    }
                }).catch((res) => {
                    toaster.error(errors[0]);
                });
        },
        updateBinhLuan() {
            baseRequest
                .put("khach-hang/binh-luan-tap-phim/thong-tin-sua", this.obj_cmt_update)
                .then((res) => {
                    if (res.data.status == true) {
                        toaster.success(res.data.message);
                        this.cancelEdit();
                        this.laydataCMT();
                    } else {
                        toaster.error(res.data.message);
                    }
                }).catch((res) => {
                    toaster.error(errors[0]);
                });
        },

    },

};
</script>
<style>
.textwrap {
    word-wrap: break-word;
    /* Tự động xuống dòng khi từ quá dài */
    word-break: break-word;
    /* Cắt từ khi cần thiết để không tràn khỏi vùng chứa */
    white-space: normal;
    /* Cho phép xuống hàng tự động */
}
</style>
