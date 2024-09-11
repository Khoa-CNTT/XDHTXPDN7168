<template>
    <div class="sidebar-wrapper" data-simplebar="true">
        <div class="sidebar-header">
            <div>
                <!-- {{-- <img src="/assets_client_xem_phim/img/net-club1.png" class="logo-icon" alt="logo icon"> --}} -->
            </div>
            <div>
                <h4 class="logo-text text-danger">WANIME</h4>
            </div>
            <div class="toggle-icon ms-auto"><i class="bx bx-arrow-to-left"></i></div>
        </div>
        <!--navigation-->
        <ul class="metismenu" id="menu">
            <li>
                <a href="/admin/dashboard">
                    <div class="parent-icon"><i class="bx bx-home-circle"></i></div>
                    <div class="menu-title">Dashboard</div>
                </a>
            </li>
            <li class="menu-label">Quản lý phim</li>
            <li>
                <router-link to="/admin/the-loai">
                    <a href="/admin/the-loai" class="nav-link">
                        <div class="parent-icon">
                            <i class="fa-sm fa-solid fa-list"></i>
                        </div>
                        <div class="menu-title">Thể Loại</div>
                    </a>
                </router-link>
            </li>
            <li>
                <router-link to="/admin/loai-phim">
                    <a href="/admin/loai-phim" class="nav-link">
                        <div class="parent-icon">
                            <i class="fa-sm fa-solid fa-map"></i>
                        </div>
                        <div class="menu-title">Loại Phim</div>
                    </a>
                </router-link>
            </li>
            <!-- <li>
                <router-link to="/admin/tac-gia">
                    <a href="/admin/tac-gia" class="nav-link">
                        <div class="parent-icon">
                            <i class="fa-sm fa-solid fa-user-pen"></i>
                        </div>
                        <div class="menu-title">Tác Giả</div>
                    </a>
                </router-link>
            </li> -->
            <li>
                <router-link to="/admin/anime">
                    <a href="/admin/anime" class="nav-link">
                        <div class="parent-icon">
                            <i class="fa-sm fa-solid fa-video"></i>
                        </div>
                        <div class="menu-title">Phim</div>
                    </a>
                </router-link>
            </li>
            <li>
                <router-link to="/admin/tap-phim">
                    <a href="/admin/anime" class="nav-link">
                        <div class="parent-icon">
                            <i class="fa-sm fa-solid fa-file-video"></i>
                        </div>
                        <div class="menu-title">Tập Phim</div>
                    </a>
                </router-link>
            </li>
            <li class="menu-label">Quản lý phim</li>
            <li>
                <router-link to="/admin/bai-viet">
                    <a href="/admin/bai-viet" class="nav-link">
                        <div class="parent-icon">
                            <i class="fa-solid fa-pen"></i>
                        </div>
                        <div class="menu-title">Bài Viết</div>
                    </a>
                </router-link>
            </li>
            <li>
                <router-link to="/admin/chuyen-muc">
                    <a href="/admin/loai-phim" class="nav-link">
                        <div class="parent-icon">
                            <i class="fa-solid fa-layer-group"></i>
                        </div>
                        <div class="menu-title">Chuyên Mục</div>
                    </a>
                </router-link>
            </li>
            <li class="menu-label">Quản Lý Admin</li>
            <li>
                <router-link to="/admin/danh-muc">
                    <a href="/admin/danh-muc" class="nav-link">
                        <div class="parent-icon">
                            <i class="fa-solid fa-list"></i>
                        </div>
                        <div class="menu-title">Danh Mục</div>
                    </a>
                </router-link>
            </li>
            <li>
                <router-link to="/admin/tk-admin">
                    <a href="/admin/tk-admin" class="nav-link">
                        <div class="parent-icon">
                            <i class="fa-solid fa-user-tie"></i>
                        </div>
                        <div class="menu-title">Admin</div>
                    </a>
                </router-link>
            </li>
            <li>
                <router-link to="/admin/chuc-vu">
                    <a href="/admin/tk-admin" class="nav-link">
                        <div class="parent-icon">
                            <i class="fa-solid fa-user-tie"></i>
                        </div>
                        <div class="menu-title">Chức vụ</div>
                    </a>
                </router-link>
            </li>
            <li>
                <router-link to="/admin/khach-hang">
                    <a href="/admin/khach-hang" class="nav-link">
                        <div class="parent-icon">
                            <i class="fa-solid fa-users"></i>
                        </div>
                        <div class="menu-title">Khách Hàng</div>
                    </a>
                </router-link>
            </li>
            <li>
                <router-link to="/admin/phan-quyen">
                    <a href="/admin/phan-quyen" class="nav-link">
                        <div class="parent-icon">
                            <i class="fa-solid fa-users"></i>
                        </div>
                        <div class="menu-title">Phân Quyền</div>
                    </a>
                </router-link>
            </li>
            <li>
                  <router-link to="/admin/thong-ke">
                      <a href="/admin/thong-ke" class="nav-link">
                          <div class="parent-icon">
                              <i class="fa-solid fa-chart-simple"></i>
                          </div>
                          <div class="menu-title">Thống Kế</div>
                      </a>
                  </router-link>
              </li>
              <li>
                  <router-link to="/admin/goi-vip">
                      <a href="/admin/goi-vip" class="nav-link">
                          <div class="parent-icon">
                              <i class="fa-regular fa-gem"></i>
                          </div>
                          <div class="menu-title">Gói Vip</div>
                      </a>
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
