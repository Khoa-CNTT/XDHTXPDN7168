<template>
    <header>
        <div class="topbar d-flex align-items-center">
            <nav class="navbar navbar-expand">
                <div class="mobile-toggle-menu"><i class='bx bx-menu'></i>
                </div>
                <div class="search-bar flex-grow-1">
                    <!-- {{-- <div class="position-relative search-bar-box">
                    <input type="text" class="form-control search-control" placeholder="Type to search..."> <span
                        class="position-absolute top-50 search-show translate-middle-y"><i
                            class='bx bx-search'></i></span>
                    <span class="position-absolute top-50 search-close translate-middle-y"><i
                            class='bx bx-x'></i></span>
                </div> --}} -->
                </div>
                <div class="top-menu ms-auto">
                    <ul class="navbar-nav align-items-center">
                        <li class="nav-item mobile-search-icon">
                            <a class="nav-link" href="#"> <i class='bx bx-search'></i>
                            </a>
                        </li>

                    </ul>
                </div>
                <div class="user-box dropdown">
                    <a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret" href="#"
                        role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img v-bind:src="img_admin" class="user-img" alt="user avatar">
                        <div class="user-info ps-3">
                            <p class="user-name mb-0">{{ user }}</p>

                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <router-link to="/admin/profile">
                            <li><a type="button"  class="dropdown-item" ><i
                                          class='bx bx-user'></i><span>Profile</span></a>
                            </li>
                        </router-link>
                        <li><a type="button" @click="logout()" class="dropdown-item" ><i
                                      class='bx bx-log-out-circle'></i><span>Logout</span></a>
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
            user: 'chưa dang nhap',
            img_admin: 'https://www.vecteezy.com/free-vector/default-user',
        }
    },
    mounted() {
        this.user = localStorage.getItem('name_admin');
        this.img_admin = localStorage.getItem('avt_admin');
    },
    methods: {
        logout() {
            axios
                .post('http://127.0.0.1:8000/api/logout',{}, {
                    headers: {
                        Authorization: 'Bearer ' + localStorage.getItem('token')
                    }
                })
                .then((res) => {
                    if (res.data.status) {
                        toaster.success(res.data.message);
                        localStorage.removeItem('avt_admin');
                        localStorage.removeItem('token_admin');
                        localStorage.removeItem('name_admin');
                        localStorage.removeItem('ten_chuc_vu');
                         this.$router.push('/admin/login');

                    }
                    else {
                        toaster.error(res.data.message);
                        this.$router.push('/admin/login');
                    }

                })
                .catch(() => {
                    this.$router.push('/admin/login');

                });
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
                    if (res.status === 200) {
                    }

                })
                .catch(() => {
                    this.$router.push('/admin/anime');

                });
        },
    },

}
</script>
<style></style>
