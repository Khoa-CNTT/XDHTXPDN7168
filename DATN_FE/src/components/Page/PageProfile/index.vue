<template>
            <!-- Breadcrumb Begin -->
            <div class="breadcrumb-option" style="background-color: #0b0c2a">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="breadcrumb__links">
                                <router-link to="/"><i class="fa fa-home"></i> Home</router-link>
                                <router-link to="/profile"> Profile</router-link>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Breadcrumb End -->

            <section class="product-page spad " style="background-color: #0b0c2a; padding-bottom: 400px" >
                <div class="container" >
						<div  class="row" >
							<div class="col-lg-4 ">
								<div class="card ">
									<div class="card-body " style="background-color: #0b0c2adb">
										<div class="d-flex flex-column align-items-center text-white text-center">
											<img v-bind:src="hinh_anh_user" alt="Admin" class="rounded-circle p-1 bg-primary" width="110">
											<div class="mt-3">
												<h4>{{ ho_ten_user }}</h4>
												<div class="dropdown">
													<div class="cursor-pointer font-24 dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown" aria-expanded="false"><i class="bx bx-dots-horizontal-rounded"></i>
													</div>
													<div class="dropdown-menu dropdown-menu-end" style=" background-color: rgba(35, 33, 33);">

														<!-- <a  class="dropdown-item">Đổi ảnh </a> -->

											  			<a data-bs-toggle="collapse"  href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1" class="btn btn-sm text-white px-4" value="Mật Khẩu	">Đổi mật khẩu</a>

													</div>
												</div>

												<p class="text-secondary mb-1">Thành viên của WAnime</p>

												<input type="file" @change="handleFile"  class="form-control-sm" style="width: 100px;" />

											</div>
										</div>
										<hr class="my-1">



									</div>
								</div>
							</div>
							<div class="col-lg-8">

								<div class="card">
									<div class="card-body text-white" style="background-color: #0b0c2adb">
										<div class="trending__product" style="margin-bottom: 0px;">
											<div class="row">
												<div class="col-lg-8 col-md-8 col-sm-8">
													<div class="section-title">
														<h4> CẬP NHẬT TÀI KHOẢN</h4>
													</div>
												</div>
												<div class="col-lg-4 col-md-4 col-sm-4">
													<div class="section-title">

													</div>
												</div>


											</div>
										</div>
										<div class="row mb-3 mt-1 ">
											<div class="col-sm-3">
												<h6 class="mb-0">Họ Và Tên</h6>
											</div>
											<div class="col-sm-9 text-secondary">
												<input v-model="obj_update_tt.ho_va_ten" type="text" class="form-control" >
											</div>
										</div>
										<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Email</h6>
											</div>
											<div class="col-sm-9 text-secondary">
												<input v-model="obj_update_tt.email" type="text" disabled class="form-control" >
											</div>
										</div>
                    <div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Ngày sinh</h6>
											</div>
											<div class="col-sm-9 text-secondary">
												<input v-model="obj_update_tt.ngay_sinh" type="date"  class="form-control" >
											</div>
										</div>
										<div class="row mb-3 collapse multi-collapse" id="multiCollapseExample1">
											<div class="col-sm-3">
												<h6 class="mb-0">Mật Khẩu Cũ</h6>
											</div>
											<div class="col-sm-9 text-secondary">
												<input v-model="obj_doi_pass.old_pass"  type="password" class="form-control" >
											</div>
										</div>
										<div class="row mb-3 collapse multi-collapse" id="multiCollapseExample1">
											<div class="col-sm-3">
												<h6 class="mb-0">Mật Khẩu Mới</h6>
											</div>
											<div class="col-sm-9 text-secondary">
												<input v-model="obj_doi_pass.new_pass" type="password" class="form-control" >
											</div>
										</div>
										<div class="row">
											<div class="col-sm-3"></div>
											<div class="col-sm-9 text-secondary">
												<input @click="DoiThongTin()"  type="button" class="btn btn-success px-4 me-5" value="Cập Nhât">
												<input @click="DoiPass()"  type="button" class="btn btn-danger px-4 me-5 collapse multi-collapse " id="multiCollapseExample1" value="Đổi Mật Khẩu">
											</div>
										</div>
									</div>
								</div>
							</div>
					    </div>

                </div>
            </section>
</template>
<script>
    import axios from "axios"
    import baseRequest from '../../../core/baseRequestUser';
    import { createToaster } from "@meforma/vue-toaster";
    const toaster = createToaster({
        position: "top-right",
    });

    export default {
        data() {
            return {
       		    // list_khach_khach: [],
              obj_doi_pass : {},
              obj_update_tt : {},
              ho_ten_user : localStorage.getItem('ho_ten_user'),
              hinh_anh_user : localStorage.getItem('hinh_anh_user'),
              id_user : localStorage.getItem('id_user'),



            };
        },
        mounted() {
            this.laydataAdmin();
			// console.log(this.id_user);
        },
        methods: {
			laydataAdmin() {
				axios
            .get("https://wietbe216.trangchudulich.com/api/admin/khach-hang/lay-du-lieu-profile", {
                    params : {
                        id_khach_hang : this.id_user,
                    },
					headers: {
                            Authorization: 'Bearer ' + localStorage.getItem('token_user')
                    }
                })
            .then((res) => {
				// console.log(res.data);
              this.obj_doi_pass = res.data.obj_user;
              this.obj_update_tt = res.data.obj_user;
            });
        },
		DoiPass() {
          baseRequest
            .put('admin/khach-hang/doi-mat-khau', this.obj_doi_pass)
            .then((res) => {
				// console.log(res.data);
              if (res.data.status == true) {
                toaster.success( res.data.message);
                this.laydataAdmin();
              } else {
                toaster.error( res.data.message);
              }
            });
        },
		DoiThongTin() {
          baseRequest
            .put('admin/khach-hang/doi-thong-tin', this.obj_update_tt)
            .then((res) => {
              if (res.data.status == true) {
                toaster.success( res.data.message);
			          this.ho_ten_user = res.data.ho_ten_user;
                localStorage.setItem('ho_ten_user', res.data.ho_ten_user);
                this.laydataAdmin();
              } else {
                toaster.error( res.data.message);
              }
            });
        },

          handleFile(event) {
          const file = event.target.files[0];
          const cloudName = 'dltbjoii4';
          const uploadPreset = 'yvvll2k0';

          const formData = new FormData();
          formData.append('file', file);
          formData.append('upload_preset', uploadPreset);

          fetch(`https://api.cloudinary.com/v1_1/${cloudName}/image/upload`, {
            method: 'POST',
            body: formData,
          })
            .then((response) => response.json())
            .then((data) => {
              // Set the imageUrl to the URL of the uploaded image.
              this.imageUrl = data.secure_url;
              // console.log(this.imageUrl);
              // this.hinh_anh_user = data.secure_url;
              this.obj_update_tt.hinh_anh =  data.secure_url;
              this.DoiThongTin();
               localStorage.setItem('hinh_anh_user',this.obj_update_tt.hinh_anh);
              toaster.success('Thêm ảnh thành công!');
            })
            .catch((error) => {
              toaster.error('Thêm ảnh không thành công!');
              console.error('Error uploading image:', error);
            });
        },

        },
    };
</script>
<style></style>
