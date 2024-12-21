<template>
    <header class="header">
        <div class="container">
            <div class="row">
                <div class="col-lg-2">
                    <div class="header__logo">
                        <router-link to="/">
                            <a href="./index.html">
                                <img src="../../assets/assets_Anime/img/logoW.png" alt="">
                            </a>
                        </router-link>

                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="header__nav">
                        <nav class="header__menu mobile-menu">
                            <ul>
                                <!-- Main Menu Items -->
                                <template v-for="(item, index) in list_danh_muc" :key="index">
                                    <li class="menu" v-if="!item.id_danh_muc_cha">
                                        <!-- Check if there are subcategories -->
                                        <a href="#" v-if="hasSubCategories(item)">
                                            {{ item.ten_danh_muc }} <span class="arrow_carrot-down"></span>
                                        </a>
                                        <router-link :to="item.link" v-else>
                                            {{ item.ten_danh_muc }}
                                        </router-link>

                                        <!-- Submenu for items with subcategories -->
                                        <ul class="dropdown" v-if="hasSubCategories(item)"
                                            :style="item.ten_danh_muc === 'Thể Loại' ? 'column-count: 3; width: 385px;' : ''">
                                            <template v-for="(subItem, subIndex) in getSubCategories(item.id)"
                                                :key="subIndex">
                                                <li class="menu text-nowrap">
                                                    <router-link
                                                        :to="{ name: getRouteName(item.slug_danh_muc), params: { slug: subItem.slug_danh_muc } }">
                                                        {{ subItem.ten_danh_muc }}
                                                    </router-link>
                                                </li>
                                            </template>
                                        </ul>
                                    </li>
                                </template>
                                <!-- <li class="menu">
                                    <a class="dropdown-toggle" type="button" data-bs-toggle="modal"
                                        data-bs-target="#modalAi"><i class="fa-solid fa-robot fa-lg"></i> <span>Hỏi
                                            AI</span>
                                    </a>
                                </li> -->
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="header__right">
                        <div class="dropdown-center">
                            <a class="dropdown-toggle" type="button" data-bs-toggle="modal"
                                data-bs-target="#modalBuyVip">
                                <i class="fa-solid fa-gem fa-lg"></i>
                            </a>

                            <a class="dropdown-toggle" type="button" data-bs-toggle="modal" data-bs-target="#TimKiem">
                                <i class="fa-solid fa-magnifying-glass fa-lg"></i>
                            </a>

                            <a type="button" class=" dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-user fa-lg"></i>
                            </a>

                            <ul class="dropdown-menu" style=" background-color: rgba(35, 33, 33, 0.9);">
                                <!-- Dropdown menu links -->
                                <li class="user-avatar" v-show="is_login == false">
                                    <router-link to="/login" class="dropdown-item with-100 d-flex align-items-center">
                                        <i class="fa-solid fa-right-to-bracket me-2"></i>
                                        <span>Đăng Nhập</span>
                                    </router-link>
                                </li>
                                <li class="user-avatar" v-show="is_login == false">
                                    <router-link to="/register"
                                        class="dropdown-item with-100 d-flex align-items-center">
                                        <i class="fa-solid fa-user-plus me-2"></i>
                                        <span>Đăng Ký</span>
                                    </router-link>
                                </li>
                                <li class="user-avatar"
                                    :style="is_login ? 'padding-left: 20px; border-bottom: 1px solid #4e5155;' : ''">
                                    <router-link to="/profile">
                                        <a v-show="is_login" class="dropdown-item text-center" type="button">
                                            <div class="d-flex align-items-center">
                                                <div class="chat-user-online">
                                                    <img v-bind:src="img" width="30" height="30" class="rounded-circle"
                                                        alt="">
                                                </div>
                                                <div class="flex-grow-1 ms-2">
                                                    <b class="mb-0">Profile</b>
                                                </div>
                                            </div>
                                        </a>
                                    </router-link>
                                </li>
                                <li v-show="is_login" class="user-avatar mt-2">
                                    <a class="dropdown-item d-flex align-items-center gap-2" data-bs-toggle="modal"
                                        type="button" data-bs-target="#modalGiaoDich">
                                        <i class="fa-solid fa-receipt fa-lg me-3 ms-1"></i>
                                        <span>Hoá đơn</span>
                                    </a>
                                </li>
                                <li class="user-avatar mt-2">
                                    <a v-show="is_login" class="dropdown-item" data-bs-toggle="modal" type="button"
                                        @click="laydataYeuThich()" data-bs-target="#DanhSachYT"><i
                                            class="fa-solid fa-heart fa-lg me-3 ms-1"></i><span>Yêu thích</span></a>
                                </li>

                                <li class="user-avatar mt-2 ">
                                    <router-link to="/" v-show="is_login" class="with-100">
                                        <a @click="removeToken()" class="dropdown-item"><i
                                                class="fa-solid fa-power-off fa-lg me-3 ms-1"></i><span>Đăng
                                                xuất</span></a>
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
                                        <div v-if="list_yeu_thich.length > 0" class="row sctrollspy-example"
                                            data-bs-spy="sctroll">
                                            <template v-for="(v, k) in list_yeu_thich" :key="k">
                                                <div v-if="v.id_khach_hang == id_user" class="row ">
                                                    <div class="col-10">
                                                        <div class="product__sidebar__comment__item">
                                                            <a v-bind:href="v.slug_phim">
                                                                <div class="product__sidebar__comment__item__pic">
                                                                    <img v-bind:src="v.hinh_anh" style="width: 99px ;"
                                                                        alt="" />
                                                                </div>
                                                            </a>
                                                            <div class="product__sidebar__comment__item__text">
                                                                <ul>
                                                                    <li>hành động</li>
                                                                    <li>phim lẻ</li>
                                                                </ul>
                                                                <h5>
                                                                    <!-- <router-link :to="`/de-list/${v.id}`"> -->
                                                                    <a v-bind:href="v.slug_phim">
                                                                        {{ v.ten_phim }}</a>
                                                                    <!-- </router-link> -->
                                                                </h5>
                                                                <span><i class="fa fa-eye"></i> 19.141 Viewes</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-2">
                                                        <a @click="xoaYeuThich(v)" type="button"
                                                            class="mt-5 text-danger">
                                                            <h4 style="color: red;"><i class="fa-solid fa-trash"></i>
                                                            </h4>
                                                        </a>
                                                    </div>
                                                </div>
                                            </template>
                                        </div>
                                        <div v-else class="d-flex justify-content-center mt-5">
                                            <div class="text-center">
                                                <h4 class="display-5 text-light fw-bolder">¯\_( ͡° ͜ʖ
                                                    ͡°)_/¯</h4>
                                                <br />
                                                <h5 class="display-6 text-light fw-bolder">BẠN CHƯA CÓ PHIM YÊU THÍCH
                                                    NÀO!...</h5>
                                            </div>
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
                            <div class="modal-content" style="background-color: rgba(35, 33, 33, 0.9); border-radius: 10px;">
                                <div class="modal-body p-4">
                                    <div class="product__sidebar__comment">
                                        <div class="section-title mb-4">
                                            <div class="input-group">
                                                <input v-on:keyup="debouncedSearch" v-model="key_tim.key"
                                                    class="form-control" placeholder="Tìm kiếm phim.." style="border-radius: 5px;">
                                                <a v-bind:href="'/tim-kiem/' + key_tim.key" type="button"
                                                    class="input-group-text serch bg-primary text-white" style="border-radius: 5px;">
                                                    <i class="fa-solid fa-magnifying-glass"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="row overflow-auto" style="max-height: 400px;" data-bs-spy="sctroll">
                                            <template v-for="(v, k) in list_phim_search" :key="k">
                                                <div class="row mb-3">
                                                    <div class="col-10">
                                                        <div class="product__sidebar__comment__item d-flex align-items-center">
                                                            <a v-bind:href="v.slug_phim">
                                                                <div class="product__sidebar__comment__item__pic me-3">
                                                                    <img v-bind:src="v.hinh_anh" style="width: 99px; border-radius: 5px;" alt="" />
                                                                </div>
                                                            </a>
                                                            <div class="product__sidebar__comment__item__text">
                                                                <ul class="list-inline mb-2">
                                                                    <li class="list-inline-item">{{ v.ten_loai_phim }}</li>
                                                                    <template v-for="(value, key) in v.ten_the_loais" :key="key">
                                                                        <li class="list-inline-item">{{ value }}</li>
                                                                    </template>
                                                                </ul>
                                                                <h5 class="mb-1">
                                                                    <a v-bind:href="v.slug_phim" class="text-decoration-none text-white">
                                                                        {{ v.ten_phim }}
                                                                    </a>
                                                                </h5>
                                                                <div class="text-muted">
                                                                    Số Tập: {{ v.tong_tap }} / {{ v.so_tap_phim }}
                                                                </div>
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

                    <!-- Modal Gói Víp -->
                    <div class="modal fade" id="modalBuyVip" data-bs-keyboard="false" tabindex="-1"
                        aria-labelledby="modalBuyVipLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div style="background-color: rgba(35, 33, 33, 0.8);" class="modal-content">

                                <div class="modal-body ">
                                    <div class="product__sidebar__comment">
                                        <div class="section-title ">
                                            <h5>CÁC GÓI ĐĂNG KÝ</h5>
                                        </div>
                                        <div class="container">
                                            <div class="row text-center " data-bs-spy="sctroll">
                                                <template v-for="(value, index) in list_goi_vip" :key="index">
                                                    <div class="col-lg-4 col-md-4 mt-2" type="button">
                                                        <div style="box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19); transition: transform 0.3s, box-shadow 0.3s;"
                                                            class="card border-primary"
                                                            onmouseover="this.style.transform='scale(1.03)'; this.style.boxShadow='0 8px 16px rgba(0,0,0,0.3)';"
                                                            onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='0 4px 8px rgba(0,0,0,0.2)';">
                                                            <div class="card-header bg-primary text-white"
                                                                style="font-size: 1.2rem; font-weight: bold;">
                                                                {{ value.thoi_han }} Tháng
                                                            </div>
                                                            <div class="card-body" style="padding: 20px;">
                                                                <h5 class="card-title text-decoration-line-through text-secondary"
                                                                    style="font-size: 1rem;">
                                                                    <del>{{ convertVND(value.tien_goc) }}</del>
                                                                </h5>
                                                                <div style="display: flex; align-items: center;">
                                                                    <h5 class="mr-2"
                                                                        style="color: red; font-size: 1.1rem;">Sale:
                                                                    </h5>
                                                                    <h5 class="text-primary" style="font-size: 1.2rem;">
                                                                        {{
                                                                            convertVND(value.tien_sale) }}</h5>
                                                                </div>
                                                                <p class="card-text"
                                                                    style="color: #666; font-size: 0.9rem;">
                                                                    <span class="text-success">✓</span> Bạn sẽ có {{
                                                                        value.thoi_han
                                                                    }} tháng xem phim không giới hạn
                                                                </p>
                                                                <p class="card-text"
                                                                    style="color: #666; font-size: 0.9rem;">
                                                                    <span class="text-success">✓</span> Xem phim không
                                                                    chứa quảng
                                                                    cáo
                                                                </p>
                                                                <a v-if="is_login"
                                                                    :href="`/platform/checkout/process/${value.id}`"
                                                                    class="btn btn-primary"
                                                                    style="font-weight: bold; transition: background-color 0.3s;"
                                                                    onmouseover="this.style.backgroundColor='#004085';"
                                                                    onmouseout="this.style.backgroundColor='#007bff';">
                                                                    Mua ngay <i class="fa fa-shopping-cart"></i>
                                                                </a>
                                                                <a v-else
                                                                    @click="$store.dispatch('showError', { description: 'Chức năng này yêu cầu đăng nhập', })"
                                                                    class="btn btn-primary text-white"
                                                                    style="font-weight: bold; transition: background-color 0.3s;"
                                                                    onmouseover="this.style.backgroundColor='#004085';"
                                                                    onmouseout="this.style.backgroundColor='#007bff';">
                                                                    Mua ngay <i class="fa fa-shopping-cart"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </template>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Đóng</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal Hỏi AI-->
                    <div class="modal fade" id="modalAi" data-bs-keyboard="false" tabindex="-1"
                        aria-labelledby="DTimKiemLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content" style="background-color: #f8f9fa; border-radius: 10px;">
                                <div class="modal-body" style="max-height: 80vh; overflow-y: auto;">
                                    <!-- Chat Section -->
                                    <div class="product__sidebar__comment">
                                        <div class="section-title text-center">
                                            <h5 style="font-size: 20px; font-weight: 600; color: #000;">Chúng tôi có thể
                                                hỗ trợ bạn như thế
                                                nào?</h5>
                                            <p style="font-size: 16px;">Vui lòng nhập câu hỏi của bạn dưới đây, chúng
                                                tôi sẽ hỗ trợ bạn.</p>
                                        </div>
                                        <!-- Search Input Area -->
                                        <div class="input-group mb-3">
                                            <input v-on:keyup="debouncedSearch" v-model="key_tim.key"
                                                class="form-control" placeholder="Hỏi một câu hỏi..."
                                                style="font-size: 16px; border-radius: 10px;">
                                            <a v-bind:href="'/tim-kiem/' + key_tim.key" type="button"
                                                class="input-group-text serch bg-primary text-white"
                                                style="border-radius: 10px;">
                                                <i class="fa-solid fa-magnifying-glass"></i>
                                            </a>
                                        </div>
                                        <!-- Example Suggestions List (Similar to the image) -->
                                        <div class="suggestions-list">
                                            <ul style="list-style-type: none; padding: 0; margin: 0;">
                                                <li class="suggestion-item"
                                                    style="font-size: 14px; padding: 5px 0; border-radius: 10px;">
                                                    <a href="#">Làm thế nào để cài đặt Appsmith sử dụng Docker?</a>
                                                </li>
                                                <li class="suggestion-item"
                                                    style="font-size: 14px; padding: 5px 0; border-radius: 10px;">
                                                    <a href="#">Làm thế nào để kết nối với cơ sở dữ liệu PostgreSQL của
                                                        tôi?</a>
                                                </li>
                                                <li class="suggestion-item"
                                                    style="font-size: 14px; padding: 5px 0; border-radius: 10px;">
                                                    <a href="#">Làm thế nào để truyền đầu vào từ widget đến một truy
                                                        vấn?</a>
                                                </li>
                                                <li class="suggestion-item"
                                                    style="font-size: 14px; padding: 5px 0; border-radius: 10px;">
                                                    <a href="#">Làm thế nào để kích hoạt nhiều truy vấn có điều
                                                        kiện?</a>
                                                </li>
                                                <li class="suggestion-item"
                                                    style="font-size: 14px; padding: 5px 0; border-radius: 10px;">
                                                    <a href="#">Làm thế nào để sửa lỗi: Giá trị này không đánh giá thành
                                                        kiểu
                                                        Array?</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Modal Thông Tin Giao Dichj -->
                    <div class="modal fade" id="modalGiaoDich" data-bs-keyboard="false" tabindex="-1"
                        aria-labelledby="modalGiaoDichLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div style="background-color: rgba(35, 33, 33, 0.8);" class="modal-content">
                                <div class="modal-body ">
                                    <div class="product__sidebar__comment">
                                        <div class="section-title ">
                                            <h5>Danh sách giao dịch</h5>
                                        </div>
                                        <div class="container">
                                            <div class="row text-center  sctrollspy-example" data-bs-spy="sctroll">
                                                <div class="table-responsive">
                                                    <template v-if="check_giao_dich">
                                                        <table style="background-color: rgba(255, 255, 255, 0.7);"
                                                            class="table table-bordered">
                                                            <thead class="table-dark">
                                                                <tr>
                                                                    <th>Mã hóa đơn</th>
                                                                    <th>Tên gói</th>
                                                                    <th>Tổng tiền</th>
                                                                    <th>Trạng thái</th>
                                                                    <th>Ngày khởi tạo</th>
                                                                    <th>Ngày hết hạn</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr v-for="(value, key) in list_giao_dich" :key="key">
                                                                    <th>{{ value.ma_hoa_don }}</th>
                                                                    <th>{{ value.ten_goi }}</th>
                                                                    <th>{{ value.tong_tien }} VND</th>
                                                                    <th
                                                                        :class="(value.trang_thai === 0) ? 'text-secondary' : 'text-success'">
                                                                        {{
                                                                            (value.trang_thai === 0) ?
                                                                                'Đang xử lý' : 'Đã thanh toán' }}</th>
                                                                    <th>{{ new
                                                                        Date(value.ngay_bat_dau).toLocaleString('en-GB',
                                                                            {
                                                                                year:
                                                                                    'numeric', month: '2-digit', day: '2-digit'
                                                                            }) }}
                                                                    </th>
                                                                    <th>{{ new
                                                                        Date(value.ngay_ket_thuc).toLocaleString('en-GB',
                                                                            {
                                                                                year:
                                                                                    'numeric', month: '2-digit', day: '2-digit'
                                                                            }) }}
                                                                    </th>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </template>
                                                    <template v-else>
                                                        <div class="d-flex justify-content-center mt-5">
                                                            <div class="text-center">
                                                                <h4 class="display-5 text-light fw-bolder">¯\_( ͡° ͜ʖ
                                                                    ͡°)_/¯</h4>
                                                                <br />
                                                                <h5 class="display-6 text-light fw-bolder">BẠN CHƯA CÓ
                                                                    GIAO DỊCH NÀO...</h5>
                                                            </div>
                                                        </div>
                                                    </template>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Đóng</button>
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
            list_yeu_thich: [],
            list_phim_search: [],
            list_danh_muc: [],
            list_giao_dich: [],
            list_goi_vip: [],
            list_phim: [],
            key_tim: {},
            timeout: null,
            is_login: false,
            check_giao_dich: false,
            user_name: {},
            id_user: {},
            img: 'https://static.vecteezy.com/system/resources/thumbnails/007/407/996/small/user-icon-person-icon-client-symbol-login-head-sign-icon-design-vector.jpg',
        };
    },
    beforeRouteUpdate(to, from, next) {
        if (to.localStorage.getItem('ho_ten_user')) {
            this.img = localStorage.getItem('hinh_anh_user');
            this.user_name = localStorage.getItem('ho_ten_user');
            this.id_user = localStorage.getItem('id_user');
        }
        next();
    },
    mounted() {
        this.img = localStorage.getItem('hinh_anh_user');
        this.user_name = localStorage.getItem('ho_ten_user');
        this.id_user = localStorage.getItem('id_user');
        this.loadDataMenu();
        this.loadDataGiaoDich();
        this.checkToken();
        this.laydataYeuThich();
        this.goiVipOpen();
    },
    methods: {
        convertVND(money) {
            money = money.toLocaleString('it-IT', { style: 'currency', currency: 'VND' });
            return money;
        },
        hasSubCategories(item) {
            return this.list_danh_muc.some(subItem => subItem.id_danh_muc_cha === item.id);
        },
        getSubCategories(parentId) {
            return this.list_danh_muc.filter(subItem => subItem.id_danh_muc_cha === parentId);
        },
        getRouteName(slug_danh_muc) {
            return slug_danh_muc === 'the-loai' ? 'PageList' : 'PageLoaiPhim';
        },
        laydataYeuThich() {
            baseRequest
                .get("khach-hang/yeu-thich/lay-du-lieu")
                .then((res) => {
                    this.list_yeu_thich = res.data.yeu_thich || [];
                });
        },

        goiVipOpen() {
            baseRequest
                .get("lay-data-goi-vip-open")
                .then((res) => {
                    this.list_goi_vip = res.data.data;
                }).catch(() => {
                    this.$router.push('/'); // Ẩn loader nếu có listring
                    this.$store.dispatch('hideLoader'); // Ẩn loader nếu có lỗi
                });
        },
        loadDataMenu() {
            axios
                .get("http://127.0.0.1:8000/api/loai-phim/lay-du-lieu-show")
                .then((res) => {
                    this.list_danh_muc = res.data.danh_muc_webs;

                });
        },
        loadDataGiaoDich() {
            baseRequest
                .get("get-data-transaction-open")
                .then((res) => {
                    if (res.data.status) {
                        this.list_giao_dich = res.data.data;
                        this.check_giao_dich = true;
                    } else {
                        this.check_giao_dich = false;

                    }

                });
        },
        debouncedSearch() {
            clearTimeout(this.timeout);
            // Đặt khoảng thời gian debounce (300ms)
            this.timeout = setTimeout(() => {
                this.searchPhim();
            }, 600);
        },
        removeToken() {
            localStorage.removeItem('token_user');
            localStorage.removeItem('hinh_anh_user');
            localStorage.removeItem('ho_ten_user');
            localStorage.removeItem('id_user');
            this.img = 'https://static.vecteezy.com/system/resources/previews/009/292/244/original/default-avatar-icon-of-social-media-user-vector.jpg',
                this.checkToken()
            window.location.href = '/';
            this.$store.dispatch('showSuccess', { description: 'Đăng xuất thành công', });
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
                        this.img = res.data.hinh_anh_user;
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
                .post('khach-hang/yeu-thich/thong-tin-xoa', v)
                .then((res) => {
                    if (res.data.status == true) {
                        this.$store.dispatch('showSuccess', { description: res.data.message, });
                        this.laydataYeuThich();
                    }
                    else {
                        toaster.danger(res.data.message);
                    }
                })
                .catch((res) => {
                    this.$store.dispatch('showError', { description: 'Xảy ra lỗi', });
                });
        },
        searchPhim() {
            axios
                .post("http://127.0.0.1:8000/api/phim/thong-tin-tim", this.key_tim)
                .then((res) => {
                    this.list_phim_search = res.data.phim;
                    this.list_phim_search.forEach((value, index) => {
                        value.ten_the_loais = value.ten_the_loais.split(",");
                    });
                });
        },

    },



};
</script>
<style>
.product__sidebar__comment__item__text h5 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: normal;
}

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

/* Chia danh sách thành 2 cột */

/* Thêm padding cho từng mục menu nếu cần */
ul.dropdown-menu li {
    padding: 5px 0;
    /* Khoảng cách giữa các mục trong menu */
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
}

.with-100 {
    width: 100%;
}
</style>
