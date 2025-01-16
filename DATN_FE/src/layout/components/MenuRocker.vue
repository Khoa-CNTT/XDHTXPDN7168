<template>
    <div class="sidebar-wrapper" data-simplebar="true">
        <div class="sidebar-header">
            <div>
                <!-- {{-- <img src="/assets_client_xem_phim/img/net-club1.png" class="logo-icon" alt="logo icon"> --}} -->
            </div>
            <div>
                <h4 class="logo-text text-primary fw-bold" style="font-family: 'Oswald', sans-serif;"> ADMIN-WOPAI</h4>
            </div>
            <div class="toggle-icon ms-auto"><i class="bx bx-arrow-to-left"></i></div>
        </div>
        <!--navigation-->
        <ul class="metismenu" id="menu">
            <li>
                <router-link to="/admin">
                    <div class="parent-icon"><i class="bx bx-home-circle"></i></div>
                    <div class="menu-title">Dashboard</div>
                </router-link>
            </li>
            <li class="menu-label">Quản lý phim</li>
            <li>
                <router-link to="/admin/the-loai" class="nav-link">
                    <div class="parent-icon">
                        <i class="bx bx-bookmark-heart"></i>
                    </div>
                    <div class="menu-title">Thể loại</div>
                </router-link>
            </li>
            <li>
                <router-link to="/admin/loai-phim" class="nav-link">
                    <div class="parent-icon">
                        <i class="bx bx-grid"></i>
                    </div>
                    <div class="menu-title">Loại phim</div>
                </router-link>
            </li>
            <li>
                <router-link to="/admin/anime" class="nav-link">
                    <div class="parent-icon">
                        <i class="bx bx-grid-alt"></i>
                    </div>
                    <div class="menu-title">Phim</div>
                </router-link>
            </li>
            <li>
                <router-link to="/admin/tap-phim" class="nav-link">
                    <div class="parent-icon">
                        <i class="bx bx-video-recording"></i>
                    </div>
                    <div class="menu-title">Tập phim</div>
                </router-link>
            </li>
            <li class="menu-label">Quản lý bài viết</li>
            <li>
                <router-link to="/admin/bai-viet" class="nav-link">
                    <div class="parent-icon">
                        <i class="bx bx-message-square-edit"></i>
                    </div>
                    <div class="menu-title">Bài viết</div>
                </router-link>
            </li>
            <li>
                <router-link to="/admin/chuyen-muc" class="nav-link">
                    <div class="parent-icon">
                        <i class="fa-solid fa-layer-group fa-sm"></i>
                    </div>
                    <div class="menu-title">Chuyên mục</div>
                </router-link>
            </li>
            <li class="menu-label">Quản Lý WEBSITE</li>
            <li>
                <router-link to="/admin/danh-muc" class="nav-link">
                    <div class="parent-icon">
                        <i class="fa-solid fa-list fa-sm"></i>
                    </div>
                    <div class="menu-title">Config Menu</div>
                </router-link>
            </li>
            <li>
                <router-link to="/admin/config-slide" class="nav-link">
                    <div class="parent-icon">
                        <i class="fa-solid fa-sliders"></i>
                    </div>
                    <div class="menu-title">Config Slide</div>
                </router-link>
            </li>
            <li class="menu-label">Quản Lý Admin</li>
            <li>
                <router-link to="/admin/tk-admin" class="nav-link">
                    <div class="parent-icon">
                        <i class="bx bx-user-plus"></i>
                    </div>
                    <div class="menu-title">Admin</div>
                </router-link>
            </li>
            <li>
                <router-link to="/admin/khach-hang" class="nav-link">
                    <div class="parent-icon">
                        <i class="bx bx-user-circle"></i>
                    </div>
                    <div class="menu-title">Khách hàng</div>
                </router-link>
            </li>
            <li>
                <router-link to="/admin/goi-vip" class="nav-link">
                    <div class="parent-icon">
                        <i class="bx bx-package"></i>
                    </div>
                    <div class="menu-title">Gói Vip</div>
                </router-link>
            </li>
            <li>
                <router-link to="/admin/quan-li-thanh-toan" class="nav-link">
                    <div class="parent-icon">
                        <i class="fa-solid fa-money-bill-wave fa-sm"></i>
                    </div>
                    <div class="menu-title">Quản Lí Thanh Toán</div>
                </router-link>
            </li>
            <li>
                <router-link to="/admin/chuc-vu" class="nav-link">
                    <div class="parent-icon">
                        <i class="fa-solid fa-user-tie fa-sm"></i>
                    </div>
                    <div class="menu-title">Chức vụ</div>
                </router-link>
            </li>
            <li>
                <router-link to="/admin/phan-quyen" class="nav-link">
                    <div class="parent-icon">
                        <i class="bx bx-shield"></i>
                    </div>
                    <div class="menu-title">Phân quyền</div>
                </router-link>
            </li>
            <li class="nav-item dropdown">
                <router-link to="" class="nav-link dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown">
                    <div class="parent-icon">
                        <i class="fa-solid fa-chart-simple fa-sm"></i>
                    </div>
                    <div class="menu-title">Thống kê</div>
                </router-link>
                <ul class="dropdown-menu">
                    <li>
                        <router-link to="/admin/thong-ke/doanh-thu" class="dropdown-item">
                            <div class="menu-title">Doanh thu theo gói</div>
                        </router-link>
                    </li>
                    <li>
                        <router-link to="/admin/thong-ke/loai-phim" class="dropdown-item">
                            <div class="menu-title">Phim theo loại phim</div>
                        </router-link>
                    </li>
                    <li>
                        <router-link to="/admin/thong-ke/luot-xem" class="dropdown-item">
                            <div class="menu-title">Lượt xem</div>
                        </router-link>
                    </li>
                    <li>
                        <router-link to="/admin/thong-ke/yeu-thich" class="dropdown-item">
                            <div class="menu-title">Yêu thích</div>
                        </router-link>
                    </li>

                    <li>
                        <router-link to="/admin/thong-ke/binh-luan" class="dropdown-item">
                            <div class="menu-title">Đánh giá phim</div>
                        </router-link>
                    </li>
                </ul>
            </li>
            <li class="menu-label">Quản lý Leech Phim</li>
            <li>
                <router-link to="/admin/leech-phim" class="nav-link">
                    <div class="parent-icon">
                        <i class="bx bx-message-square-edit"></i>
                    </div>
                    <div class="menu-title">Leech Phim</div>
                </router-link>
            </li>
        </ul>
        <!--end navigation-->
    </div>
</template>
<script>
export default {};
</script>
<style></style>
