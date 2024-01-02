<template>
    <!-- Blog Details Section Begin -->
    <template v-for="(v,k) in list_blog">
        <template v-if="v.id == id">
            <div class="breadcrumb-option" style="background-color: #0b0c2a">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="breadcrumb__links">
                                <router-link to="/"><i class="fa fa-home"></i> Home</router-link>
                                <router-link to="/index4"> Blog</router-link>
                                <span>{{  v.tieu_de }}</span>
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
                        <h6>{{ v.ten_chuyen_muc }} <span>- March 21, 2023</span></h6>
                        <h2>{{ v.tieu_de}}</h2>
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
                            <p>{{ v.mo_ta }}</p>
                        </div>
                    <div class="blog__details__pic">
                        <img v-bind:src="v.hinh_anh" alt="">
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="blog__details__content">
                       
                       
                        <div class="blog__details__item__text">
                            <h4>{{ v.tieu_de }}</h4>
                            <p>{{ v.mo_ta_chi_tiet }}</p>
                        </div>
                        
                        <div class="blog__details__tags">
                            <a href="#">Healthfood</a>
                            <a href="#">Sport</a>
                            <a href="#">{{ v.ten_chuyen_muc }}</a>
                        </div>
                        <div class="blog__details__btns">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="blog__details__btns__item">
                                        <h5><a href="#"><span class="arrow_left"></span> Building a Better LiA...</a>
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="blog__details__btns__item next__btn">
                                        <h5><a href="#">Mugen no Juunin: Immortal – 21 <span
                                            class="arrow_right"></span></a></h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="blog__details__comment">
                                <h4>Bình Luận</h4>
                                <template v-for="(v,k) in list_cmt">
                                    <div v-if="v.id_bai_viet == id " class="anime__review__item">
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
                            <div class="blog__details__form">
                                <h4>Thêm Bình Luận</h4>
                                <form action="#">
                                    <div class="row">
                                        
                                        <div class="col-lg-12">
                                            <textarea v-model="obj_cmt_blog.noi_dung" placeholder="bình luận..."></textarea>
                                            <button @click="themBinhLuan()" type="button" class="site-btn">Gửi</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
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
                </div>
            </div>
         </section>
        </template>
    </template>
 </template>
 <script>
 import axios from "axios"
 import baseRequest from '../../../core/baseRequestUser';
 import { createToaster } from "@meforma/vue-toaster";
 const toaster = createToaster({
     position: "top-right",
 });

 export default {
     data() {
         return {
             id : this.$route.params.id,
             id_user        : localStorage.getItem('id_user'), 
             list_blog : [],
             list_cmt       : [],
             obj_cmt_blog   : { 'id_khach_hang' : localStorage.getItem('id_user'), 'id_bai_viet' : this.$route.params.id,},
             obj_xoa_cmt    : {},

        };
     },
     mounted() {
         this.laydataBlog();
         this.laydataCMT();
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
         laydataBlog() {
             baseRequest
             .get("admin/bai-viet/lay-du-lieu")
             .then((res) => {
                 this.list_blog = res.data.bai_viet;
             });
         },
         laydataCMT() {
                axios
                .get("http://127.0.0.1:8000/api/admin/binh-luan-blog/lay-du-lieu")
                .then((res) => {
                    this.list_cmt = res.data.binh_luan_bai_viet;
                });
        },
        themBinhLuan(){
                baseRequest
                .post("admin/binh-luan-blog/thong-tin-tao" , this.obj_cmt_blog
                )
                .then((res) => {
                if (res.data.status == true) {
                    toaster.success(res.data.message);
                    this.obj_cmt_blog   = { 'id_khach_hang' : localStorage.getItem('id_user'), 'id_bai_viet' : this.$route.params.id, 'noi_dung' : ''};
                    this.laydataCMT();
                } else {
                    toaster.error(res.data.message);
                }
                });
            },
        deleteBinhLuan() {
                baseRequest
                .delete('admin/binh-luan-blog/thong-tin-xoa/' + this.obj_xoa_cmt.id)
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