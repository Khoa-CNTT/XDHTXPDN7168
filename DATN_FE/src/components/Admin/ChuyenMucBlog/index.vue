<template>
      <div class="row">
        <div class="col-3">
          <div class="card border-5 border-primary border-top">
            <div class="card-header">
              <b>THÊM CHUYÊN MỤC</b>
            </div>
            <div class="card-body">
              <div class="mb-3 mt-1">
                <label for="" class="form-label mb-1 mt-1">
                  <b>Tên Chuyên Mục</b>
                </label>
                <input v-model="obj_add_chuyen_muc.ten_chuyen_muc" type="text" class="form-control" placeholder="nhập thể loại..." />
              </div>
              <div class="mb-3 mt-1">
                <label for="" class="form-label mb-1 mt-1">
                  <b>Slug Chuyên Mục</b>
                </label>
                <input v-model="obj_add_chuyen_muc.slug_chuyen_muc" type="text" class="form-control" placeholder="nhập slug thể loại..." />
              </div>
              <div class="mb-3">
                <label class="form-label mb-1 mt-1">
                  <b>Tình Trạng</b>
                </label>
                <select v-model="obj_add_chuyen_muc.tinh_trang" name="" id="" class="form-control">
                  <option value="0">Tạm Dừng</option>
                  <option value="1">Hoạt động</option>
                </select>
              </div>
            </div>
            <div class="card-footer text-end">
              <button @click="taoDataChuyenMuc()" class="btn btn-primary">Thêm Mới</button>
            </div>
          </div>
        </div>
        <div class="col-8">
          <div class="card border-5 border-primary border-top">
            <div class="card-header">
              <b>DANH SÁCH CHUYÊN MỤC</b>
            </div>
            <div class="card-body">
              <table class="table table-bordered">
                <thead>
                  <tr>
                       <th colspan="100%">
                              <div class="input-group mb-3">
                                  <input v-on:keyup.enter="searchChuyenMuc()" v-model="key_tim.key"  type="text"
                                      class="form-control" placeholder="Nhập thông tin cần tìm">
                                                  <button class="btn btn-primary" v-on:click="searchChuyenMuc()">
                                      <i class="fa-solid fa-magnifying-glass"></i>
                                  </button>
                              </div>
                        </th>
                 </tr>
                  <tr class="text-center">
                    <th class="text-center align-middle text-nowrap">#</th>
                    <th class="text-center align-middle text-nowrap">Tên Chuyên Mục</th>
                    <th class="text-center align-middle text-nowrap">Slug Chuyên Mục</th>
                    <th class="text-center align-middle text-nowrap">Tình Trạng</th>
                    <th class="text-center align-middle text-nowrap">Action</th>
                  </tr>
                </thead>
                <tbody>
                  
                  <tr v-for="(v, k) in list_chuyen_muc" class="text-center">
                    <td class="text-center align-middle text-nowrap">{{ k + 1 }}</td>
                    <td class="text-center align-middle text-nowrap">{{ v.ten_chuyen_muc }}</td>
                    <td class="text-center align-middle text-nowrap">{{ v.slug_chuyen_muc }}</td>
  
                    <td class="text-center align-middle text-nowrap">
                      <button @click="doiTrangThai(v)" v-if="v.tinh_trang == 1" class="btn btn-success">
                        Hoạt Động
                      </button>
                      <button @click="doiTrangThai(v)" v-if="v.tinh_trang == 0" class="btn btn-warning">
                        Tạm Dừng
                      </button>
                    </td>
                    <td class="text-center align-middle text-nowrap">
                      <button @click="Object.assign(obj_update_chuyen_muc,v)" type="button" class="btn btn-success me-1" data-bs-toggle="modal" data-bs-target="#Chinhsua">
                        Chỉnh Sữa
                      </button>
  
                      <button @click="Object.assign(obj_delete_chuyen_muc,v)" data-bs-target="#Xoa" data-bs-toggle="modal" class="btn btn-danger">
                        Xoá
                      </button>
                    </td>
                  </tr>
                </tbody>
              </table>
              <div class="modal fade" id="Chinhsua" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                       
                      <h4 class="modal-title fs-5" id="exampleModalLabel"><b>CHỈNH SỮA CHUYÊN MỤC</b>
                      </h4>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body ">
                      <div class="mb-3 mt-1">
                        <label for="" class="form-label mb-1 mt-1">
                          <b>Tên Chuyên Mục</b>
                        </label>
                        <input v-model="obj_update_chuyen_muc.ten_chuyen_muc" type="text" class="form-control" placeholder="nhập thể loại..." />
                      </div>
                      <div class="mb-3 mt-1">
                        <label for="" class="form-label mb-1 mt-1">
                          <b>Slug Chuyên Mục</b>
                        </label>
                        <input  v-model="obj_update_chuyen_muc.slug_chuyen_muc" type="text" class="form-control" placeholder="nhập slug thể loại..." />
                      </div>
                      <div class="mb-3">
                        <label class="form-label mb-1 mt-1">
                          <b>Tình Trạng</b>
                        </label>
                        <select  v-model="obj_update_chuyen_muc.tinh_trang" name="" id="" class="form-control">
                          <option value="0">Tạm Dừng</option>
                          <option value="1">Hoạt động</option>
                        </select>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Đóng
                      </button>
                      <button @click="updateTheLoai()" type="button" class="btn btn-success" data-bs-dismiss="modal">Xong</button>
                    </div>
                  </div>
                </div>
              </div>
  
              <!-- {{-- // modol xoa --}} -->
              <div class="modal fade" id="Xoa" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="exampleModalLabel">Xoá Chuyên Mục Phim
                      </h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-start">
                      <div class="alert alert-danger" role="alert">
                        Bạn muốn xoá thể loại phim <b>{{ obj_delete_chuyen_muc.ten_chuyen_muc }}</b> !!!
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Đóng </button>
                      <button @click="deleteTheLoai()" type="button" data-bs-dismiss="modal" class="btn btn-danger">Vẫn Xoá</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  </template>
  <script>
    import axios from "axios";
    import baseRequest from '../../../core/baseRequest';
    import { createToaster } from "@meforma/vue-toaster";
    const toaster = createToaster({
      position: "top-right",
    });
    export default {
      data() {
        return {
          list_chuyen_muc    : [],
          key_tim          : {},
          obj_add_chuyen_muc : {},
          obj_update_chuyen_muc : {},
          obj_delete_chuyen_muc : {},
        };
      },
      mounted() {
        this.loaddataChuyenMuc();
      },
      methods: {
        loaddataChuyenMuc() {
          baseRequest
            .get("admin/chuyen-muc/lay-du-lieu")
            .then((res) => {
              this.list_chuyen_muc = res.data.chuyen_muc_admin;
            });
        },
        taoDataChuyenMuc() {
          baseRequest
            .post(
              "admin/chuyen-muc/thong-tin-tao",
              this.obj_add_chuyen_muc
            )
            .then((res) => {
              if (res.data.status == true) {
                this.obj_add_chuyen_muc = {};
                toaster.success(res.data.message);
                this.loaddataChuyenMuc();
              } else {
                toaster.error(res.data.message);
              }
            });
        },
        searchChuyenMuc() {
              baseRequest
                  .post('admin/chuyen-muc/thong-tin-tim', this.key_tim)
                  .then((res) => {
                      this.list_chuyen_muc = res.data.chuyen_muc;
                  });
          },
          deleteTheLoai() {
            baseRequest
                  .delete('admin/chuyen-muc/thong-tin-xoa/' + this.obj_delete_chuyen_muc.id)
                  .then((res) => {
                      if (res.data.status == true) {
                          toaster.success('Thông báo<br>' + res.data.message);
                          this.loaddataChuyenMuc();
                      }
                      else {
                          toaster.danger('Thông báo<br>' + res.data.message);
                      }
                  });
          },
          updateTheLoai() {
              baseRequest
                  .put('admin/chuyen-muc/thong-tin-cap-nhat', this.obj_update_chuyen_muc)
                  .then((res) =>  {
                      if(res.data.status == true) {
                          toaster.success('Thông báo<br>' + res.data.message);
                          this.loaddataChuyenMuc();
                      } else {
                          toaster.danger('Thông báo<br>' + res.data.message);
                      }
                  });
          },
  
          doiTrangThai(xyz) {
              baseRequest
                  .put('admin/chuyen-muc/thong-tin-thay-doi-trang-thai', xyz)
                  .then((res) =>  {
                      if(res.data.status == true) {
                          toaster.success('Thông báo<br>' + res.data.message);
                          this.loaddataChuyenMuc();
                      } else {
                          toaster.error(res.data.message);
                      }
                  });
          }
      },
    };
  </script>
  <style lang=""></style>