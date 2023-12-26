<template>
    <header class="header">
        <div class="container">
            <div class="row">
                <div class="col-lg-2">
                    <div class="header__logo">
                        <a href="./index.html">
                            <img src="../../assets/assets_Anime/img/logo.png" alt="">
                        </a>
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
                                <router-link to="/index1">
                                    <li><a href="/index1">Thể Loại <span class="arrow_carrot-down"></span></a>
                                        <ul class="dropdown">
                                        <template v-for="(v,k) in list_the_loai">
                                        <li><a href="./categories.html">{{ v.ten_the_loai }}</a></li>
                                        </template>
                                        </ul>
                                    </li>
                                </router-link>
                                <router-link to="/index2">
                                    <li><a href="/index2">Loại Phim <span class="arrow_carrot-down"></span></a>
                                        <ul class="dropdown">
                                        <template v-for="(v,k) in list_loai_phim">
                                        <li><a href="/index2">{{ v.ten_loai_phim }}</a></li>
                                        </template>
                                        </ul>
                                    </li>
                                </router-link>
                                <router-link to="/index5">
                                <li class="active"><a href="#"> Blog</a></li>
                                </router-link>

                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="header__right">
                        <a href="#" class="search-switch"><span class="icon_search"></span></a>
                        <a href="./login.html"><span class="icon_profile"></span></a>

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
                        <nav  class="slicknav_nav" aria-hidden="false" role="menu" style="">
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
    };
  },
  mounted() {
    this.laydataLoaiPhim();
    this.loaddataTheLoai();

  },
  methods: {
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
    background-color: #e53637; /* Màu nền khi hover (màu đỏ) */
    color: #000; /* Màu chữ khi hover (màu đen) */
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