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
                            placeholder="Nhập cần tìm..."> <span
                            class="position-absolute top-50 search-show translate-middle-y"><i
                                class='bx bx-search'></i></span>
                        <span class="position-absolute top-50 search-close translate-middle-y"><i
                                class='bx bx-x'></i></span>
                    </div>
                </div>
                <div class="top-menu ms-auto">
                    <ul class="navbar-nav align-items-center">
                        <li class="nav-item mobile-search-icon">
                            <a class="nav-link" href="#"> <i class='bx bx-search'></i>
                            </a>
                        </li>
                        <li class="nav-item dropdown dropdown-large">
                            <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="#"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false"> <i
                                    class='bx bx-category'></i>
                            </a>
                            
                        </li>
                        <li class="nav-item dropdown dropdown-large">
                            <a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative"
                                href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="alert-count">7</span>
                                <i class='bx bx-bell'></i>
                            </a>
                            
                        </li>
                        <li class="nav-item dropdown dropdown-large">
                            <a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative"
                                href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false"> <span class="alert-count">8</span>
                                <i class='bx bx-comment'></i>
                            </a>
                           
                        </li>
                    </ul>
                </div>
                <div class="user-box dropdown">
                    <a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret"
                        href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img v-bind:src="img" class="user-img" alt="user avatar">
                        <div class="user-info ps-3">
                            <p class="user-name mb-0">{{ user }}</p>
                            <p class="designattion mb-0">Admin WAnime</p>
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <!-- <li><a class="dropdown-item" href="javascript:;"><i
                                    class="bx bx-user"></i><span>Profile</span></a>
                        </li> -->
                       
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
    export default {
        
        data() {
            return {
                user : 'chưa dang nhap',
                img : '',
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
                    this.checkToken()
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