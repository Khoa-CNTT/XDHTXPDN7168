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
                    <div class="video-container">
                        <!-- Sử dụng `v-bind` để thêm hình nền và URL video từ `obj_tap_phim` -->
                        <iframe :src="obj_tap_phim.url" frameborder="0" allow="autoplay; fullscreen"
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
    // props: ["slugMovie", "slugEpisode"],
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
                    //     this.$store.dispatch('showSuccess', {description: res.data.message,});

                    // }
                    this.obj_phim = res.data.phim || {}; // Gán {} nếu không có dữ liệu
                    this.obj_tap_phim = res.data.tap || {};
                    this.list_tap_phim = res.data.tap_phims || [];
                    this.$store.dispatch('hideLoader');
                })
                .catch(() => {
                    this.$router.push('/'); // Ẩn loader nếu có lỗi
                    this.$store.dispatch('showWarning', {description: "Đã xảy ra lỗi, vui lòng thử lại sau",});

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
                    this.$store.dispatch('showError', {description: errors[0],});
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
                        this.$store.dispatch('showSuccess', {description: res.data.message,});
                        this.obj_cmt_phim = {};
                        this.laydataCMT();
                    } else {
                        this.$store.dispatch('showError', {description: res.data.message,});
                    }
                }).catch((res) => {
                    this.$store.dispatch('showError', {description: errors[0],});
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
                        this.$store.dispatch('showError', {description: res.data.message,});
                    }
                }).catch((res) => {
                    this.$store.dispatch('showError', {description: errors[0],});
                });
        },
        updateBinhLuan() {
            baseRequest
                .put("khach-hang/binh-luan-tap-phim/thong-tin-sua", this.obj_cmt_update)
                .then((res) => {
                    if (res.data.status == true) {
                        this.$store.dispatch('showSuccess', {description: res.data.message,});
                        this.cancelEdit();
                        this.laydataCMT();
                    } else {
                        this.$store.dispatch('showError', {description: res.data.message,});
                    }
                }).catch((res) => {
                    this.$store.dispatch('showError', {description: errors[0],});
                });
        },

    },

};
</script>
<style>
.textwrap {
    word-wrap: break-word;
    word-break: break-word;
    white-space: normal;
}

/* Video container styles */
.video-container {
    position: relative;
    width: 100%;
    padding-top: 56.25%;
    margin-bottom: 20px;
    background: #000;
    border-radius: 8px;
    overflow: hidden;
}

.video-container iframe {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    border: none;
}

/* Episode navigation */
.anime__details__episodes {
    margin: 15px 0;
    padding: 15px;
    background: rgba(255, 255, 255, 0.05);
    border-radius: 8px;
}

.anime__details__episodes .section-title {
    margin-bottom: 15px;
}

.anime__details__episodes .section-title h5 {
    color: #ffffff;
    font-size: 20px;
    font-weight: 700;
    margin-bottom: 0;
}

.anime__details__episodes a {
    display: inline-block;
    padding: 6px 15px;
    margin: 5px;
    background: rgba(255, 255, 255, 0.08);
    border-radius: 5px;
    color: #ffffff;
    font-size: 14px;
    transition: all 0.3s;
}

.anime__details__episodes a:hover,
.anime__details__episodes a.bg-secondary {
    background: #e53637 !important;
}

/* Comments section */
.anime__details__review {
    margin-top: 25px;
}

.anime__review__item {
    display: flex;
    gap: 15px;
    background: rgba(255, 255, 255, 0.05);
    padding: 15px;
    border-radius: 8px;
    margin-bottom: 15px;
}

.anime__review__item__pic img {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    object-fit: cover;
}

.anime__review__item__text {
    flex: 1;
}

.anime__review__item__text h6 {
    font-size: 15px;
    margin-bottom: 5px;
    color: #ffffff;
}

/* Comment form */
.anime__details__form {
    margin-top: 25px;
}

.anime__details__form textarea {
    width: 100%;
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 8px;
    padding: 12px;
    color: #fff;
    margin-bottom: 15px;
    resize: vertical;
    min-height: 100px;
}

.anime__details__form button {
    background: #e53637;
    color: #fff;
    border: none;
    padding: 8px 20px;
    border-radius: 5px;
    font-weight: 500;
}

/* Responsive Styles */
@media (min-width: 1400px) {
    .container {
        max-width: 1320px;
    }
}

@media (max-width: 1200px) {
    .container {
        max-width: 1140px;
        padding: 0 15px;
    }
}

@media (max-width: 992px) {
    .container {
        max-width: 960px;
    }
    
    .video-container {
        padding-top: 60%;
    }

    .anime__details__episodes .section-title h5 {
        font-size: 18px;
    }
}

@media (max-width: 768px) {
    .container {
        max-width: 720px;
    }

    .video-container {
        padding-top: 65%;
        border-radius: 0;
        margin: 0 -15px 15px;
    }

    .anime__details__episodes {
        padding: 12px;
    }

    .anime__details__episodes a {
        padding: 5px 12px;
        margin: 3px;
    }

    .anime__review__item {
        padding: 12px;
    }
}

@media (max-width: 576px) {
    .container {
        max-width: 540px;
    }

    .breadcrumb-option {
        padding: 10px 0;
    }

    .video-container {
        padding-top: 70%;
    }

    .anime__details__episodes .section-title h5 {
        font-size: 16px;
    }

    .anime__details__episodes a {
        padding: 4px 10px;
        font-size: 13px;
    }

    .anime__review__item {
        flex-direction: column;
        gap: 10px;
    }

    .anime__review__item__pic {
        align-self: flex-start;
    }

    .anime__details__form button {
        width: 100%;
    }
}

@media (max-width: 375px) {
    .anime__details__episodes a {
        padding: 4px 8px;
        font-size: 12px;
        margin: 2px;
    }

    .anime__review__item__text h6 {
        font-size: 14px;
    }
}
</style>

        font-size: 14px;
