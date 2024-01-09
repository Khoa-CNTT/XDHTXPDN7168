<template>
   <div class="row">
							<div class="col-lg-4">
								<div class="card">
									<div class="card-body">
										<div class="d-flex flex-column align-items-center text-center ">
											<img v-bind:src="obj_doi_pass.hinh_anh" alt="Admin" class="rounded-circle p-1 bg-primary" width="110">
											<div class="mt-3">
												<h4>{{ obj_doi_pass.ho_va_ten }}</h4>
												<p class="text-secondary mb-1">ADMIN WEB WANIME</p>
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
												<input v-model="obj_doi_pass.ho_va_ten" type="text" class="form-control" >
											</div>
										</div>
										<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Email</h6>
											</div>
											<div class="col-sm-9 text-secondary">
												<input v-model="obj_doi_pass.email" type="text" class="form-control" >
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
												<input @click="DoiPass()"  type="button" class="btn btn-success px-4 me-5" value="Cập Nhật">
												<input @click="Object.assign(obj_doi_pass,v);"  data-bs-toggle="collapse" type="button" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1" class="btn btn-danger px-4" value="Đổi Mật Khẩu">
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
        // id: this.$route.params.id,
           list_khach_khach: [],
        obj_doi_pass : {},
        obj_update_tt : {},
        // ho_ten_user : localStorage.getItem('ho_ten_user'),
        id_admin : localStorage.getItem('id_admin'),



    };
},
mounted() {
    this.laydataAdmin();
    // console.log(this.id_user);
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

},
};
</script>
<style></style>