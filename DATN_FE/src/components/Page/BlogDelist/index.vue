<template>
    <!-- Blog Details Section Begin -->
    <div class="breadcrumb-option" style="background-color: #0b0c2a">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <router-link to="/"><i class="fa fa-home"></i> Home</router-link>
                        <router-link to="/blog"> Blog</router-link>
                        <span>{{ obj_blog.tieu_de }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section style="background-color: #0b0c2a" class="blog-details spad">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-8">
                    <div class="blog__details__title">
                        <h6>{{ obj_blog.ten_chuyen_muc }} <span>- {{ obj_blog.updated_at }}</span></h6>
                        <h2>{{ obj_blog.tieu_de }}</h2>
                        <div class="blog__details__social">
                            <a href="#" class="facebook"><i class="fa fa-facebook-square"></i> Facebook</a>
                            <a href="#" class="pinterest"><i class="fa fa-pinterest"></i> Pinterest</a>
                            <a href="#" class="linkedin"><i class="fa fa-linkedin-square"></i> Linkedin</a>
                            <a href="#" class="twitter"><i class="fa fa-twitter-square"></i> Twitter</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="blog__details__text tex">
                        <p>{{ obj_blog.mo_ta }}</p>
                    </div>
                    <div class="blog__details__pic">
                        <img v-bind:src="obj_blog.hinh_anh" alt="" />
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="blog__details__content">
                        <div class="blog__details__item__text">
                            <h4>{{ obj_blog.tieu_de }}</h4>
                            <p>{{ obj_blog.mo_ta_chi_tiet }}</p>
                        </div>

                        <div class="blog__details__tags">
                            <a href="#">Healthfood</a>
                            <a href="#">Sport</a>
                            <a href="#">{{ obj_blog.ten_chuyen_muc }}</a>
                        </div>
                        <div class="blog__details__comment">
                            <h4>Bình Luận</h4>
                            <template v-for="(v, k) in list_cmt" :key="k">
                                <div v-if="v.id_bai_viet == obj_blog.id" class="anime__review__item">
                                    <div class="anime__review__item__pic">
                                        <img v-bind:src="v.avatar" alt="" />
                                    </div>
                                    <div class="anime__review__item__text">
                                        <div class="row">
                                            <div class="col-12">
                                                <h6>
                                                    {{ v.ho_va_ten
                                                    }}<span style="font-size: 0.9rem">
                                                        - {{ fromNow(v.created_at) }}</span><span
                                                        style="font-size: 0.9rem" v-if="v.updated_at > v.created_at">
                                                        ( Đã chỉnh sửa )</span>
                                                </h6>
                                                <p v-if="editingCommentId !== v.id" class="textwrap">
                                                    {{ v.noi_dung }}
                                                </p>
                                                <textarea v-if="editingCommentId === v.id"
                                                    v-model="obj_update_cmt.noi_dung" placeholder="Nhập bình luận"
                                                    class="form-control"></textarea>
                                                <div style="float: right" class="mt-1">
                                                    <template v-if="id_user == v.id_khach_hang">
                                                        <a type="button" class="text-primary mr-3"
                                                            style="font-size: 1rem" v-if="editingCommentId !== v.id"
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
                                                        <a type="button" class="mr-3 text-primary"
                                                            style="font-size: 1rem"
                                                            v-on::click.prevent="cancelEdit()">Hủy</a>
                                                        <a type="button" class="mr-3 text-primary"
                                                            style="font-size: 1rem"
                                                            v-on::click.prevent="updateCMT()">Lưu</a>
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
                        <div class="blog__details__form">
                            <h4>Thêm Bình Luận</h4>
                            <form action="#">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <textarea v-model="obj_cmt_blog.noi_dung" placeholder="bình luận..."></textarea>
                                        <button @click="themBinhLuan()" type="button" class="site-btn">
                                            Gửi
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal fade" id="delCMT" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div style="background-color: rgba(35, 33, 33, 1)" class="modal-content">
                                    <div class="modal-body text-white">
                                        Bạn có chắc muốn xoá bình luận?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                            Đóng
                                        </button>
                                        <button type="button" @click="deleteBinhLuan()" class="btn btn-primary"
                                            data-bs-dismiss="modal">
                                            Xoá
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
<script>
import moment from "moment";
import "moment/locale/vi"; // Import ngôn ngữ tiếng Việt nếu cần
import axios from "axios";
import baseRequest from "../../../core/baseRequestUser";
import { createToaster } from "@meforma/vue-toaster";
const toaster = createToaster({
    position: "top-right",
});

export default {
    data() {
        return {
            isRatingSelected: false,
            editingCommentId: null,
            id_user: localStorage.getItem("id_user"),
            obj_update_cmt: {},
            obj_blog: {},
            list_cmt: [],
            obj_cmt_blog: {
                id_bai_viet: this.$route.params.id,
            },
            obj_xoa_cmt: {},
        };
    },
    mounted() {
        this.$store.dispatch('showLoader');
        this.laydataDelistBlog();
        this.laydataCMT();


    },
    methods: {
        fromNow: function (datetime) {
            moment.locale("vi");
            return moment(datetime).fromNow();
        },
        beginEdit(comment) {
            this.editingCommentId = comment.id;
            this.obj_update_cmt = Object.assign({}, comment);
        },
        cancelEdit() {
            this.editingCommentId = null;
            this.obj_update_cmt = {};
        },
        laydataDelistBlog() {
            var payload = {
                'slug': this.$route.params.slug
            }
            axios
                .post("http://127.0.0.1:8000/api/bai-viet/lay-du-lieu-delist-blog", payload)
                .then((res) => {
                    this.obj_blog = res.data.bai_viet;
                    let date = new Date(this.obj_blog.updated_at);
                    let options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
                    let formattedDate = date.toLocaleDateString('vi-VN', options);
                    // console.log(formattedDate);
                    this.obj_blog.updated_at = formattedDate;
                    this.$store.dispatch('hideLoader'); // Ẩn loader nếu có lỗi
                })
                .catch(() => {
                    // this.$router.push('/'); // Ẩn loader nếu có lỗi
                    this.$store.dispatch('hideLoader'); // Ẩn loader nếu có lỗi

                });
        },
        laydataCMT() {
            axios
                .get("http://127.0.0.1:8000/api/binh-luan-blog/lay-du-lieu-show")
                .then((res) => {
                    this.list_cmt = res.data.binh_luan_bai_viet;
                })
                .catch((res) => {
                    this.$router.push('/'); // Ẩn loader nếu có lỗi
                    this.$store.dispatch('hideLoader'); // Ẩn loader nếu có lỗi
                    var errors = Object.values(res.response.data.errors);
                    this.$store.dispatch('showError', {description: errors[0],});
                });
        },
        themBinhLuan() {
            var payload = {
                'id_bai_viet': this.obj_blog.id,
                'id_khach_hang': localStorage.getItem('id_user'),
                'noi_dung': this.obj_cmt_blog.noi_dung
            }
            baseRequest
                .post("khach-hang/binh-luan-blog/thong-tin-tao", payload)
                .then((res) => {
                    if (res.data.status == true) {
                        this.$store.dispatch('showSuccess', {description: res.data.message,});
                        this.obj_cmt_blog = {};
                        this.laydataCMT();
                    } else {
                        this.$store.dispatch('showError', {description: res.data.message,});
                    }
                })
                .catch((res) => {
                    var errors = Object.values(res.response.data.errors);
                    this.$store.dispatch('showError', {description: errors[0],});
                });
        },
        updateCMT() {
            baseRequest
                .put("khach-hang/binh-luan-blog/thong-tin-sua", this.obj_update_cmt)
                .then((res) => {
                    if (res.data.status == true) {
                        this.$store.dispatch('showSuccess', {description: res.data.message,});
                        this.cancelEdit();
                        this.laydataCMT();
                    } else {
                        this.$store.dispatch('showError', {description: res.data.message,});
                    }
                }).catch((res) => {
                    var errors = Object.values(res.response.data.errors);
                    this.$store.dispatch('showError', {description: errors[0],});
                });

        },
        deleteBinhLuan() {
            baseRequest
                .post("khach-hang/binh-luan-blog/thong-tin-xoa", this.obj_xoa_cmt)
                .then((res) => {
                    if (res.data.status == true) {
                        this.laydataCMT();
                    } else {
                        this.$store.dispatch('showError', {description: res.data.message,});
                    }
                })
                .catch((res) => {
                    var errors = Object.values(res.response.data.errors);
                    this.$store.dispatch('showError', {description: errors[0],});
                });
        },
    },
};
</script>
<style></style>
