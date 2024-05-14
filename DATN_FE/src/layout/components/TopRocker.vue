<template>
    <header>
        <div class="topbar d-flex align-items-center">
            <nav class="navbar navbar-expand">
                <div class="topbar-logo-header">
                    <div class="">
                    </div>
                    <div class="">
                        <h4 class="logo-text text-danger">ADMIN</h4>
                    </div>
                </div>
                <div class="mobile-toggle-menu"><i class='bx bx-menu'></i></div>
                <div class="search-bar flex-grow-1">
                    <div class="position-relative search-bar-box">
                        <input type="text" class="form-control search-control"
                            > <span
                            class="position-absolute top-50 search-show translate-middle-y"><i
                                class='bx bx-search'></i></span>
                        <span class="position-absolute top-50 search-close translate-middle-y"><i
                                class='bx bx-x'></i></span>
                    </div>
                </div>
                <div class="top-menu ms-auto">
                </div>
                <div class="user-box dropdown">
                    <a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret"
                        href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img :src="img" class="user-img" alt="user avatar">
                        <div class="user-info ps-3">
                            <p class="user-name mb-0"><b>{{ user }}</b></p>
                            <p class="designattion mb-0">{{  }}</p>
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <router-link to="/admin/profile">
                                <a class="dropdown-item" href="javascript:;"><i class="bx bx-user"></i><span>Profile</span></a>
                            </router-link>
                        </li>

                        <li><a @click="removeToken()" class="dropdown-item" href="javascript:;"><i class='bx bx-log-out-circle'></i><span>Logout</span></a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </header>
    </template>
    <script>
    import axios from "axios";
    import { createToaster } from "@meforma/vue-toaster";
    const toaster = createToaster({ position: "top-right" });
    export default {

        data() {
            return {
                user : 'chưa dang nhap',
                img : 'https://scontent.fsgn2-6.fna.fbcdn.net/v/t39.30808-6/438223092_924978372646480_8892922029517455750_n.jpg?_nc_cat=111&ccb=1-7&_nc_sid=5f2048&_nc_ohc=1M_bsPbrCFAQ7kNvgFx_sSo&_nc_ht=scontent.fsgn2-6.fna&oh=00_AfAK4f4KmvMgcb_wJwjzxOqtkSWXMdaTIqYWIyTbbaxS8g&oe=663FBF44',
            }
        },
        mounted() {
            this.user = localStorage.getItem('ho_ten');
            this.img = localStorage.getItem('hinh_anh');
        },
        methods: {
            removeToken() {
                    localStorage.removeItem('token');
                    localStorage.removeItem('hinh_anh');
                    localStorage.removeItem('id_admin');
                    this.$router.push('/admin/login');
                    toaster.success('Bạn đã đăng xuất thành công!');
                    // this.checkToken()
              },
            checkToken() {
                    axios
                        .post('http://127.0.0.1:8000/api/admin/check', {}, {
                            headers: {
                                Authorization: 'Bearer ' + localStorage.getItem('token')
                            }
                        })
                        .then((res) => {
                            console.log(res.data);
                            // localStorage.setItem('ho_ten', res.data.ho_ten);
                            // localStorage.setItem('hinh_anh', res.data.hinh_anh);
                            if (res.status === 200) {
                                // this.list_token = res.data.list;
                            }

                        })
                        .catch(() => {
                            this.$router.push('/admin/anime');

                        });
        },
        },

    }
    </script>
    <style>

    </style>
