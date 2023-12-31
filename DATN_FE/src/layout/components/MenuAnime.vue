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
                                      <li class="active">
                                        <a href="/">Trang Chủ</a>
                                      </li>
                                </router-link>
                                <!-- <router-link :to="`/index1/${1}`"> -->
                                    <li><a v-bind:href="'/index1/' +  '1'">Thể Loại <span class="arrow_carrot-down"></span></a>
                                        <ul class="dropdown">
                                        <template v-for="(v,k) in Showobject()">
                                            <li >
                                                <!-- <router-link :to="`/index1/${v.id}`">
                                                        {{  v.ten_the_loai }}
                                                </router-link> -->
                                                <a  v-bind:href="'/index1/' + v.id"> {{ v.ten_the_loai }}</a>
                                            </li>
                                        </template>
                                        </ul>
                                    </li>
                                <!-- </router-link> -->
                                <!-- <router-link to="/index6"> -->
                                    <li><a v-bind:href="'/index6/' +  '1'">Loại Phim <span class="arrow_carrot-down"></span></a>
                                        <ul class="dropdown">
                                        <template v-for="(v,k) in list_loai_phim">
                                            <li >
                                                <!-- <router-link :to="`/index6/${v.id}`">
                                                    {{  v.ten_loai_phim }}
                                                </router-link> -->
                                                <a  v-bind:href="'/index6/' + v.id">{{ v.ten_loai_phim }}</a>
                                            </li>
                                        </template>
                                        </ul>
                                    </li>
                                <!-- </router-link> -->
                                <router-link to="/index4">
                                <li class="active"><a href="#"> Blog</a></li>
                                </router-link>

                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="header__right">
                        <!-- <router-link to="/login" class="dropdown-link "> -->
                                <a @click="btnDoiDisplay" class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret " href="#" role="button" data-bs-toggle="dropdown" >
                                    <img  style="width: 40px; height: 40px;"  v-bind:src="img" class="user-img " alt="user avatar"> 

						        </a>
                                <ul :style="{ display: isDropdownVisible ? 'block' : 'none', }" style=" background-color: rgba(35, 33, 33, 0.7); font: 15px; top: 15%; left: 99px " class="dropdown-menu dropdown-menu-end show" data-bs-popper="static">
                                    <li v-show="is_login == false">
                                        <router-link to="/login">
                                         <a  class="dropdown-item"><i class="fa-solid fa-user me-1"></i><span>Đăng Nhập</span></a>
                                        </router-link>
                                    </li>
                                    <li>
                                        <a v-show="is_login" class="dropdown-item"><i class="fa-regular fa-heart me-1"></i><span>Yêu Thích</span></a>
                                    </li>
                                    <li>
                                        <a v-show="is_login" class="dropdown-item"><i class="fa-solid fa-upload me-1"></i><span>Đăng Blog Mới</span></a>
                                    </li>
                                    <li>
                                        <a v-show="is_login" @click="removeToken()"  class="dropdown-item"><i class="fa-solid fa-arrow-right-from-bracket me-1"></i><span>Đăng xuất</span></a>
                                    </li>
                                </ul>
                        <!-- </router-link> -->

                            
                                
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
                        <nav style="display: none;"  class="slicknav_nav" aria-hidden="false" role="menu" >
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
        <!-- <div class="search-model">
            <div class="h-100 d-flex align-items-center justify-content-center">
                <div class="search-close-switch"><i class="icon_close"></i></div>
                <form class="search-model-form">
                    <input type="text" id="search-input" placeholder="Search here.....">
                </form>
            </div>
        </div> -->
    </header>


</template>
<script>
import axios from "axios";
import { createToaster } from "@meforma/vue-toaster";
const toaster = createToaster({
  position: "top-right",
});
export default {
  data() {
    return {
        list_the_loai    : [],
        list_loai_phim: [],
        isDropdownVisible: false,
        is_login : false,
        img      : 'https://media.istockphoto.com/id/1198413547/vi/vec-to/bi%E1%BB%83u-t%C6%B0%E1%BB%A3ng-ch%E1%BB%A7-%C4%91%E1%BB%81-d%E1%BA%A5u-ch%E1%BA%A5m-h%E1%BB%8Fi-vector-v%E1%BB%9Bi-bi%E1%BB%83u-t%C6%B0%E1%BB%A3ng-avatar-h%E1%BB%93-s%C6%A1-ng%C6%B0%E1%BB%9Di-d%C3%B9ng-nam-%C4%91%E1%BB%83-%C4%91%C6%B0%E1%BB%A3c-tr%E1%BB%A3.jpg?s=612x612&w=0&k=20&c=0QXMNF-sT-EZsZBbae0ZYlN07LUFPwqV8JSzUT9eoxw=',
    };
  },
  mounted() {
    this.laydataLoaiPhim();
    this.loaddataTheLoai();
    this.checkToken();
  },
  methods: {
    reloadPage() {
      // Sử dụng location.reload() để tải lại trang
      location.reload();
    },
    Showobject() {
        const totalItems = this.list_the_loai.length;
        // Sử dụng slice để lấy ba phần tử cuối cùng của mảng
        return this.list_the_loai.slice(0, totalItems);
      },
      btnDoiDisplay() {
                // Khi click, đảo ngược giá trị của isDropdownVisible
                this.isDropdownVisible = !this.isDropdownVisible;
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
      removeToken() {
        localStorage.removeItem('token_user');
        localStorage.removeItem('hinh_anh_user');
        this.img      = 'https://media.istockphoto.com/id/1198413547/vi/vec-to/bi%E1%BB%83u-t%C6%B0%E1%BB%A3ng-ch%E1%BB%A7-%C4%91%E1%BB%81-d%E1%BA%A5u-ch%E1%BA%A5m-h%E1%BB%8Fi-vector-v%E1%BB%9Bi-bi%E1%BB%83u-t%C6%B0%E1%BB%A3ng-avatar-h%E1%BB%93-s%C6%A1-ng%C6%B0%E1%BB%9Di-d%C3%B9ng-nam-%C4%91%E1%BB%83-%C4%91%C6%B0%E1%BB%A3c-tr%E1%BB%A3.jpg?s=612x612&w=0&k=20&c=0QXMNF-sT-EZsZBbae0ZYlN07LUFPwqV8JSzUT9eoxw=',
        this.checkToken()
      },
      checkToken() {
            axios
                .post('http://127.0.0.1:8000/api/khach-hang/check', {}, {
                    headers: {
                        Authorization: 'Bearer ' + localStorage.getItem('token_user')
                    }
                })
                .then((res) => {
                    console.log(res.data);
                    // localStorage.setItem('ho_ten', res.data.ho_ten);
                    // localStorage.setItem('hinh_anh', res.data.hinh_anh);
                    if (res.status === 200) {
                        this.is_login = true;
                        this.img = localStorage.getItem('hinh_anh_user');
                        // this.list_token = res.data.list;
                        // this.$router.push('/');

                    }

                })
                .catch(() => {
                    this.is_login = false;
                });
        },
    
  },
  
  

        };
        </script>
        <style>
                        /* Mặc định */
                li {
                    color: #000; /* Màu chữ mặc định */
                }

                /* Hover */
                li:hover {
                    cursor: pointer;
                    background-color: #e53637; 
                    color: #000; 
                    
                }

                /* Mặc định cho thẻ a bên trong thẻ li */
                li a {
                    color: #000; /* Màu chữ mặc định */
                }

                /* Hover cho thẻ a bên trong thẻ li */
                li:hover a {
                    color: #000; /* Màu chữ khi hover (màu đen) */
                }

                /* Mặc định cho thẻ a có class arrow_carrot-down */
                li a.arrow_carrot-down {
                    color: #000; /* Màu chữ mặc định */
                }

                /* Hover cho thẻ a có class arrow_carrot-down */
                li:hover a.arrow_carrot-down {
                    color: #000; /* Màu chữ khi hover (màu đen) */
                }
                
                
                
               

</style>