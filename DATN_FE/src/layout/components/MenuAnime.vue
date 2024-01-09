<template>
    <header class="header">
        <div class="container">
            <div class="row">
                <div class="col-lg-2">
                    <div class="header__logo">
                        <router-link to="/">
                            <a href="./index.html">
                                <img src="../../assets/assets_Anime/img/logo.png" alt="">
                            </a>
                        </router-link>

                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="header__nav">
                        <nav class="header__menu mobile-menu">
                            <ul>
                                <router-link to="/">
                                    <li class="menu active">
                                        <a href="/">Trang Chủ</a>
                                    </li>
                                </router-link>
                                <!-- <router-link :to="`/index1/${1}`"> -->
                                <li class="menu"><a v-bind:href="'/index1/' +  '1'">Thể Loại <span
                                            class="arrow_carrot-down"></span></a>
                                    <ul class="dropdown">
                                        <template v-for="(v,k) in list_the_loai">
                                            <li class="menu" v-if="v.tinh_trang == 1">
                                                <!-- <router-link :to="`/index1/${v.id}`">
                                                        {{  v.ten_the_loai }}
                                                </router-link> -->
                                                <a v-bind:href="'/index1/' + v.id"> {{ v.ten_the_loai }}</a>
                                            </li>
                                        </template>
                                    </ul>
                                </li>
                                <!-- </router-link> -->
                                <!-- <router-link to="/index6"> -->
                                <li class="menu"><a v-bind:href="'/index6/' +  '1'">Loại Phim <span
                                            class="arrow_carrot-down"></span></a>
                                    <ul class="dropdown">
                                        <template v-for="(v,k) in list_loai_phim">
                                            <li class="menu" v-if="v.tinh_trang == 1">
                                                <!-- <router-link :to="`/index6/${v.id}`">
                                                    {{  v.ten_loai_phim }}
                                                </router-link> -->
                                                <a v-bind:href="'/index6/' + v.id">{{ v.ten_loai_phim }}</a>
                                            </li>
                                        </template>
                                    </ul>
                                </li>
                                <!-- </router-link> -->
                                <router-link to="/index4">
                                    <li class="menu active"><a href="#"> Blog</a></li>
                                </router-link>

                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="header__right">
                        <div class="dropdown-center">
                            <a class="dropdown-toggle" type="button" data-bs-toggle="modal" data-bs-target="#TimKiem">
                                <i class="fa-solid fa-magnifying-glass fa-xl"></i>
                            </a>
                            <!-- người dùng -->
                            <a type="button" class=" dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-user fa-xl"></i>
                            </a>

                            <ul class="dropdown-menu" style=" background-color: rgba(35, 33, 33, 0.9);">
                                <!-- Dropdown menu links -->
                                <li class="user-avatar" v-show="is_login == false">
                                    <router-link to="/login" class="with-100">
                                        <a class="dropdown-item " type="button"><i
                                                class="fa-solid fa-user me-1"></i><span>Đăng Nhập</span></a>
                                    </router-link>
                                </li>
                                <li class="user-avatar">
                                    <router-link to="/profile">
                                            <a v-show="is_login" class="dropdown-item text-center  "
                                                type="button">
                                                <div class="d-flex align-items-center">
                                                    <div class="chat-user-online">
                                                        <img v-bind:src="img" width="45" height="45" class="rounded-circle" alt="">
                                                    </div>
                                                    <div class="flex-grow-1 ms-2">
                                                        <b class="mb-0">{{  user_name }}</b>
                                                    </div>
                                                </div>
                                                <!-- <div class="row">
                                                    <div class="col">
                                                        <img style="width: 40px; height: 40px; margin: 0;" v-bind:src="img"
                                                            class="user-img " alt="user avatar">
                                                    </div>
                                                    <div class="col">
                                                        <span> </span>
                                                    </div>
                                                </div> -->

                                            </a>
                                    </router-link>
                                   
                                </li>
                                <li class="user-avatar mt-2">
                                    <a v-show="is_login" class="dropdown-item" data-bs-toggle="modal" type="button"
                                        @click="laydataYeuThich()" data-bs-target="#DanhSachYT"><i class="fa-solid fa-heart fa-xl me-1"></i><span>Yêu thích</span></a>
                                </li>

                                <li class="user-avatar mt-2 ">
                                    <router-link to="/" v-show="is_login" class="with-100">
                                        <a @click="removeToken()" class="dropdown-item"><i class="fa-solid fa-power-off fa-xl me-1"></i><span>Đăng xuất</span></a>
                                    </router-link>
                                </li>

                            </ul>
                        </div>
                    </div>
                    <!-- Modal Danh Sach yêu thích -->
                    <div class="modal fade" id="DanhSachYT" data-bs-keyboard="false" tabindex="-1"
                        aria-labelledby="DanhSachYTLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div style="background-color: rgba(35, 33, 33, 0.8);" class="modal-content">
                                <div class="modal-body ">
                                    <div class="product__sidebar__comment">
                                        <div class="section-title ">
                                            <h5>Danh Sách Phim Yêu Thích Của Bạn</h5>
                                        </div>
                                        <div class="row sctrollspy-example" data-bs-spy="sctroll">
                                            <template v-for="(v,k) in list_yeu_thich ">
                                                <div v-if="v.id_khach_hang == id_user" class="row ">
                                                    <div class="col-10">
                                                        <div class="product__sidebar__comment__item">
                                                            <a v-bind:href="'/index2/' + v.id_phim">
                                                                <div class="product__sidebar__comment__item__pic">
                                                                    <img v-bind:src="v.hinh_anh" style="width: 99px ;" alt="" />
                                                                </div>
                                                            </a>
                                                            <div class="product__sidebar__comment__item__text">
                                                                <ul>
                                                                    <li>hành động</li>
                                                                    <li>phim lẻ</li>
                                                                </ul>
                                                                <h5>
                                                                    <!-- <router-link :to="`/index2/${v.id}`"> -->
                                                                    <a v-bind:href="'/index2/' + v.id_phim">
                                                                        {{ v.ten_phim }}</a>
                                                                    <!-- </router-link> -->
                                                                </h5>
                                                                <span><i class="fa fa-eye"></i> 19.141 Viewes</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-2">
                                                        <a @click="xoaYeuThich(v)" type="button" class="mt-5 text-danger">
                                                            <h4 style="color: red;"><i class="fa-solid fa-trash"></i></h4>
                                                        </a>
                                                    </div>
                                                </div>
                                             </template>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Đóng</button>
                                </div> -->
                            </div>
                        </div>
                    </div>
                    <!-- Modal Tìm Kiếm  -->
                    <div class="modal fade" id="TimKiem" data-bs-keyboard="false" tabindex="-1"
                        aria-labelledby="DTimKiemLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div style="background-color: rgba(35, 33, 33, 0.9);" class="modal-content">
                                <div class="modal-body ">
                                    <div class="product__sidebar__comment">
                                        <div class="section-title ">
                                            <div class="input-group mb-3">
                                                <a v-bind:href="'/tim-kiem/' + key_tim.key" @click="searchPhim()" type="button"  class="input-group-text serch" >
                                                <i class="fa-solid fa-magnifying-glass"></i></a>
                                                
                                                <input v-on:keyup="searchPhim()" v-model="key_tim.key" class="form-control" list="datalistOptions" id="exampleDataList"
                                                    placeholder="Tìm kiếm phim..">
                                                <datalist id="datalistOptions">
                                                    <option value="chuyển sinh thành máy bán nước"></option>
                                                </datalist>
                                            </div>
                                        </div>
                                        <div class="row sctrollspy-example" data-bs-spy="sctroll">
                                            <template v-for="(v,k) in list_phim_search ">
                                                <div   class="row ">
                                                    <div class="col-10">
                                                        <div class="product__sidebar__comment__item">
                                                            <a v-bind:href="'/index2/' + v.id">
                                                                <div class="product__sidebar__comment__item__pic">
                                                                    <img v-bind:src="v.hinh_anh" style="width: 99px ;" alt="" />
                                                                </div>
                                                            </a>
                                                        
                                                            <div class="product__sidebar__comment__item__text">
                                                                <ul>
                                                                    <li>hành động</li>
                                                                    <li>phim lẻ</li>
                                                                </ul>
                                                                <h5>
                                                                    <!-- <router-link :to="`/index2/${v.id}`"> -->
                                                                    <a v-bind:href="'/index2/' + v.id">
                                                                        {{ v.ten_phim }}</a>
                                                                    <!-- </router-link> -->
                                                                </h5>
                                                                <span><i class="fa fa-eye"></i> 19.141 Viewes</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </template>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div id="mobile-menu-wrap">
                <div id="mobile-menu-wrap">
                    <div class="slicknav_menu">
                        <a href="#" aria-haspopup="true" role="button" tabindex="0" class="slicknav_btn slicknav_open"
                            style="outline: none;"><span class="slicknav_menutxt">MENU</span><span
                                class="slicknav_icon"><span class="slicknav_icon-bar"></span><span
                                    class="slicknav_icon-bar"></span><span class="slicknav_icon-bar"></span></span></a>
                        <nav style="display: none;" class="slicknav_nav" aria-hidden="false" role="menu">
                            <ul>
                                <li class="active"><a href="./index.html" role="menuitem">Homepage</a></li>
                                <li class="slicknav_collapsed slicknav_parent"><a href="#" role="menuitem"
                                        aria-haspopup="true" tabindex="-1" class="slicknav_item slicknav_row"
                                        style="outline: none;"><a href="./categories.html">Categories <span
                                                class="arrow_carrot-down"></span></a>
                                        <span class="slicknav_arrow">►</span></a>
                                    <ul class="dropdown slicknav_hidden" role="menu" aria-hidden="true"
                                        style="display: none;">
                                        <li><a href="./categories.html" role="menuitem" tabindex="-1">Categories</a>
                                        </li>
                                        <li><a href="./anime-details.html" role="menuitem" tabindex="-1">Anime
                                                Details</a></li>
                                        <li><a href="./anime-watching.html" role="menuitem" tabindex="-1">Anime
                                                Watching</a></li>
                                        <li><a href="./blog-details.html" role="menuitem" tabindex="-1">Blog Details</a>
                                        </li>
                                        <li><a href="./signup.html" role="menuitem" tabindex="-1">Sign Up</a></li>
                                        <li><a href="./login.html" role="menuitem" tabindex="-1">Login</a></li>
                                    </ul>
                                </li>
                                <li><a href="./blog.html" role="menuitem">Our Blog</a></li>
                                <li><a href="#" role="menuitem">Contacts</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

    </header>




</template>
<script>
    import baseRequest from '../../core/baseRequestUser';
    import axios from "axios";
    import { createToaster } from "@meforma/vue-toaster";
    const toaster = createToaster({
        position: "top-right",
    });
    export default {
        data() {
            return {
                list_the_loai: [],
                list_loai_phim: [],
                list_phim: [],
                list_yeu_thich: [],
                list_phim_search : [],
                key_tim        : {},
                is_login: false,
                user_name: {},
                id_user: {},
                img: 'https://static.vecteezy.com/system/resources/thumbnails/007/407/996/small/user-icon-person-icon-client-symbol-login-head-sign-icon-design-vector.jpg',
            };
        },
        mounted() {
            this.laydataLoaiPhim();
            this.loaddataTheLoai();
            this.laydataPhim();
            this.checkToken();
            this.laydataYeuThich();
        },
        methods: {
            laydataPhim() {
                axios
                    .get("http://127.0.0.1:8000/api/phim/lay-du-lieu-show")
                    .then((res) => {
                        this.list_phim = res.data.phim;
                    });
            },
            laydataYeuThich() {
                baseRequest
                    .get("admin/yeu-thich/lay-du-lieu")
                    .then((res) => {
                        this.list_yeu_thich = res.data.yeu_thich;
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
            removeToken() {
                localStorage.removeItem('token_user');
                localStorage.removeItem('hinh_anh_user');
                localStorage.removeItem('ho_ten_user');
                localStorage.removeItem('id_user');
                this.img = 'https://media.istockphoto.com/id/1198413547/vi/vec-to/bi%E1%BB%83u-t%C6%B0%E1%BB%A3ng-ch%E1%BB%A7-%C4%91%E1%BB%81-d%E1%BA%A5u-ch%E1%BA%A5m-h%E1%BB%8Fi-vector-v%E1%BB%9Bi-bi%E1%BB%83u-t%C6%B0%E1%BB%A3ng-avatar-h%E1%BB%93-s%C6%A1-ng%C6%B0%E1%BB%9Di-d%C3%B9ng-nam-%C4%91%E1%BB%83-%C4%91%C6%B0%E1%BB%A3c-tr%E1%BB%A3.jpg?s=612x612&w=0&k=20&c=0QXMNF-sT-EZsZBbae0ZYlN07LUFPwqV8JSzUT9eoxw=',
                    this.checkToken()
                toaster.success("Đăng xuất thành công");
            },
            checkToken() {
                axios
                    .post('http://127.0.0.1:8000/api/khach-hang/check', {}, {
                        headers: {
                            Authorization: 'Bearer ' + localStorage.getItem('token_user')
                        }
                    })
                    .then((res) => {
                        // localStorage.setItem('ho_ten', res.data.ho_ten);
                        // localStorage.setItem('hinh_anh', res.data.hinh_anh);
                        if (res.status === 200) {
                            this.is_login = true;
                            this.img = localStorage.getItem('hinh_anh_user');
                            this.user_name = localStorage.getItem('ho_ten_user');
                            this.id_user = localStorage.getItem('id_user');
                            // this.list_token = res.data.list;
                            // this.$router.push('/');

                        }

                    })
                    .catch(() => {
                        this.is_login = false;
                    });
            },
            xoaYeuThich(v) {
                baseRequest
                    .post('admin/yeu-thich/thong-tin-xoa', v)
                    .then((res) => {
                        if (res.data.status == true) {
                            toaster.success(res.data.message);
                            this.laydataYeuThich();
                        }
                        else {
                            toaster.danger(res.data.message);
                        }
                    });
            },
            searchPhim() {
                axios
                    .post("http://127.0.0.1:8000/api/phim/thong-tin-tim",this.key_tim)
                    .then((res) => {
                        this.list_phim_search = res.data.phim;
                    });
            },

        },



    };
</script>
<style>
    .sctrollspy-example {
        height: 400px;
        overflow-y: auto;
    }
    /* Mặc định */
    li {
        color: #000;
        /* Màu chữ mặc định */
    }

    /* Hover */
    .menu:hover {
        cursor: pointer;
        background-color: #e53637;
        color: #000;

    }

    /* Mặc định cho thẻ a bên trong thẻ li */
    li a {
        color: #000;
        /* Màu chữ mặc định */
    }

    /* Hover cho thẻ a bên trong thẻ li */
    li:hover a {
        color: #000;
        /* Màu chữ khi hover (màu đen) */
    }

    /* Mặc định cho thẻ a có class arrow_carrot-down */
    li a.arrow_carrot-down {
        color: #000;
        /* Màu chữ mặc định */
    }

    /* Hover cho thẻ a có class arrow_carrot-down */
    li:hover a.arrow_carrot-down {
        color: #000;
        /* Màu chữ khi hover (màu đen) */
    }

    .with-100 {
        width: 100%;
    }
</style>