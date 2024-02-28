<template>
   <div class="row">
							<div class="col-lg-4">
								<div class="card">
									<div class="card-body">
										<div class="d-flex flex-column align-items-center text-center ">
											<img v-bind:src="hinh_anh" alt="Admin" class="rounded-circle p-1 bg-primary" width="110">
											<div class="mt-3">
												<h4>{{ ho_ten }}</h4>
												<div class="dropdown">
													<div class="cursor-pointer font-24 dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown" aria-expanded="false"><i class="bx bx-dots-horizontal-rounded"></i>
													</div>
													<div class="dropdown-menu dropdown-menu-end text-dark"> 
												
														<!-- <a  class="dropdown-item">Đổi ảnh </a> -->
														
											  			<a data-bs-toggle="collapse"  href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1" class="btn btn-sm px-4" value="Mật Khẩu">Đổi mật khẩu</a>

													</div>
												</div>
												<p class="text-secondary mb-1"><b>{{ obj_doi_pass.ten_chuc_vu }}</b></p>
												<input type="file" @change="handleFile" class="form-control-sm" style="width: 100px;" />
											</div>
										</div>
										<hr class="my-4">
										
									</div>
								</div>
							</div>
							<div class="col-lg-8">
								<div class="card">
									<div class="card-body " >
										<div class="trending__product" style="margin-bottom: 0px;"> 
											<div class="row">
												<div class="col-lg-8 col-md-8 col-sm-8">
												<div class="section-title">
													<h4 style="color: rgb(21, 20, 20);"> CẬP NHẬT TÀI KHOẢN</h4>
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
												<input v-model="obj_update_tt.email" disabled type="text" class="form-control" >
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
												<input  @click="DoiThongTin()" type="button" class="btn btn-success px-4 me-5" value="Cập Nhật">
												<input @click="DoiPass()"  role="button"  class="btn btn-danger px-4 collapse multi-collapse" id="multiCollapseExample1" value="Đổi Mật Khẩu">
											</div>
										</div>
									</div>
								</div>
								
							</div>
						</div>
</template>
<script>
import axios from "axios"
import baseRequest from '../../../core/baseRequest';
import { createToaster } from "@meforma/vue-toaster";
const toaster = createToaster({
position: "top-right",
});

export default {
data() {
    return {
        obj_doi_pass : {},
        obj_update_tt : {},
        id_admin : localStorage.getItem('id_admin'),
		ho_ten	 : localStorage.getItem('ho_ten'),
		hinh_anh : localStorage.getItem('hinh_anh'),



    };
},
mounted() {
    this.laydataAdmin();
    // console.log(this.id);
},
methods: {
    laydataAdmin() {
        axios
			.get("http://127.0.0.1:8000/api/admin/admin/lay-du-lieu-profile", {
				params : {
					id_admin : this.id_admin,
				},
				headers: {
						Authorization: 'Bearer ' + localStorage.getItem('token')
				}
				})
			.then((res) => {
					// console.log(res.data);
				this.obj_doi_pass = res.data.obj_admin;
				this.obj_update_tt = res.data.obj_admin;
				});
		},
		DoiPass() {
			baseRequest
				.put('admin/admin/doi-mat-khau', this.obj_doi_pass)
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
            .put('admin/admin/doi-thong-tin', this.obj_update_tt)
            .then((res) => {
              if (res.data.status == true) {
                toaster.success( res.data.message);
				this.ho_ten = res.data.ho_ten;
                localStorage.setItem('ho_ten', res.data.ho_ten);

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
			this.hinh_anh = data.secure_url;
			localStorage.setItem('hinh_anh', this.hinh_anh);
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