<template>
  <div class="nav-container primary-menu ">
      <div class="mobile-topbar-header">
          <div>
              <img src="/assets/images/logo-icon.png" class="logo-icon" alt="logo icon">
          </div>
          <div>
              <h4 class="logo-text">Rukada</h4>
          </div>
          <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
          </div>
      </div>
      <nav class="navbar navbar-expand-xl w-100">
          <ul class="navbar-nav justify-content-start flex-grow-1 gap-1">
            <li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle dropdown-toggle-nocaret show" data-bs-toggle="dropdown" aria-expanded="true">
						<div class="parent-icon"> <i class="fa-solid fa-film"></i>
						</div>
						<div class="menu-title"><b>Quản Lý Phim</b></div>
					  </a>
					  <ul class="dropdown-menu show" data-bs-popper="static">
						<li> 
                            <router-link to="/admin/the-loai">
                                <a href="/admin/the-loai" class="nav-link">
                                    <div class="parent-icon">
                                        <i class="fa-solid fa-list"></i>
                                    </div>
                                    <div class="menu-title">Thể Loại</div>
                                </a>
                            </router-link>
						</li>
						<li> 
                            <router-link to="/admin/loai-phim">
                                <a href="/admin/loai-phim" class="nav-link">
                                    <div class="parent-icon">
                                        <i class="fa-solid fa-map"></i>
                                    </div>
                                    <div class="menu-title">Loại Phim</div>
                                </a>
                            </router-link>
						</li>
						<li>    
                            <router-link to="/admin/tac-gia">
                                <a href="/admin/tac-gia" class="nav-link">
                                    <div class="parent-icon">
                                        <i class="fa-solid fa-user-pen"></i>
                                    </div>
                                    <div class="menu-title">Tác Giả</div>
                                </a>
                            </router-link>
						</li>
						<li> 
                            <router-link to="/admin/anime">
                                <a href="/admin/anime" class="nav-link">
                                    <div class="parent-icon">
                                        <i class="fa-solid fa-video"></i>
                                    </div>
                                    <div class="menu-title">Phim</div>
                                </a>
                            </router-link>
						</li>
                        <li> 
                            <router-link to="/admin/tap-phim">
                                <a href="/admin/anime" class="nav-link">
                                    <div class="parent-icon">
                                        <i class="fa-solid fa-file-video"></i>
                                    </div>
                                    <div class="menu-title">Tập Phim</div>
                                </a>
                            </router-link>
						</li>
					  </ul>
			</li>  
            <li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle dropdown-toggle-nocaret show" data-bs-toggle="dropdown" aria-expanded="true">
						<div class="parent-icon"> <i class="fa-solid fa-list-check"></i>
						</div>
						<div class="menu-title"><b>Quản Lý Bài Viết</b></div>
					  </a>
					  <ul class="dropdown-menu show" data-bs-popper="static">
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
					  </ul>
			</li>  
            <li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle dropdown-toggle-nocaret show" data-bs-toggle="dropdown" aria-expanded="true">
						<div class="parent-icon"> <i class="fa-solid fa-user-gear"></i>
						</div>
						<div class="menu-title"><b>Quản Lý Tài Khoản</b></div>
					  </a>
					  <ul class="dropdown-menu show" data-bs-popper="static">
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
                            <router-link to="/admin/khach-hang">
                                <a href="/admin/khach-hang" class="nav-link">
                                    <div class="parent-icon">
                                        <i class="fa-solid fa-users"></i>
                                    </div>
                                    <div class="menu-title">Khách Hàng</div>
                                </a>
                            </router-link>
						</li>
					  </ul>
			</li> 

              
            
             
            
             
              
              
          </ul>
      </nav>
  </div>
  </template>
  <script>
  export default {
      
  }
  </script>
  <style>
      
  </style>