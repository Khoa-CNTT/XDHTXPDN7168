<template>
    <div class="row">
      <div class="col-3">
        <div class="card border-5 border-primary border-top">
          <div class="card-header">
            <b>THÊM GÓI VIP</b>
          </div>
          <div class="card-body">
            <div class="mb-3 mt-1">
              <label for="" class="form-label mb-1 mt-1">
                <b>Tên Gói Vip</b>
              </label>
              <input v-model="obj_add_goi_vip.ten_goi_vip" v-on:keyup="addSlug()" v-on:change="kiemTraSlug()"  type="text" class="form-control" placeholder="nhập gói vip..." />
            </div>
            <div class="mb-3 mt-1">
              <label for="" class="form-label mb-1 mt-1">
                <b>Slug Gói Vip</b>
              </label>
              <input v-model="obj_add_goi_vip.slug_goi_vip" type="text" disabled class="form-control" placeholder="slug gói vip..">
            </div>
            <div class="mb-3 mt-1">
              <label for="" class="form-label mb-1 mt-1">
                <b>Giá tiền</b>
              </label>
              <input v-model="obj_add_goi_vip.gia_tien" type="number" class="form-control" placeholder="nhập giá gói vip..." />
            </div>
            <div class="mb-3">
              <label class="form-label mb-1 mt-1">
                <b>Tình Trạng</b>
              </label>
              <select v-model="obj_add_goi_vip.tinh_trang" name="" id="" class="form-control">
                <option value="0">Tạm Dừng</option>
                <option value="1">Hoạt động</option>
              </select>
            </div>
          </div>
          <div class="card-footer text-end">
            <button @click="taodataGoiVip()" class="btn btn-primary">Thêm Mới</button>
          </div>
        </div>
      </div>
      <div class="col-8">
        <div class="card border-5 border-primary border-top">
          <div class="card-header">
            <b>DANH SÁCH GÓI VIP</b>
          </div>
          <div class="card-body">
            <table class="table table-bordered">
              <thead>
                <tr>
                     <th colspan="100%">
                            <div class="input-group mb-3">
                                <input v-on:keyup="searchGoiVip()" v-model="key_tim.key"  type="text"
                                    class="form-control" placeholder="Nhập thông tin cần tìm">
                                                <button class="btn btn-primary" v-on:click="searchGoiVip()">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </button>
                            </div>
                      </th>
               </tr>
                <tr class="text-center">
                  <th class="text-center align-middle text-nowrap">#</th>
                  <th class="text-center align-middle text-nowrap">Tên Gói Vip</th>
                  <th class="text-center align-middle text-nowrap">Slug Gói Vip</th>
                  <th class="text-center align-middle text-nowrap">Tình Trạng</th>
                  <th class="text-center align-middle text-nowrap">Action</th>
                </tr>
              </thead>
              <tbody>

                <tr v-for="(v, k) in list_goi_vip" class="text-center" :key="k" >
                  <td class="text-center align-middle text-nowrap">{{ k + 1 }}</td>
                  <td class="text-center align-middle text-nowrap">{{ v.ten_goi_vip }}</td>
                  <td class="text-center align-middle text-nowrap">{{ v.slug_goi_vip }}</td>
                  <td class="text-center align-middle text-nowrap">{{ v.gia_tien }}</td>

                  <td class="text-center align-middle text-nowrap">
                    <button @click="doiTrangThai(v)" v-if="v.tinh_trang == 1" class="btn btn-success">
                      Hoạt Động
                    </button>
                    <button @click="doiTrangThai(v)" v-if="v.tinh_trang == 0" class="btn btn-warning">
                      Tạm Dừng
                    </button>
                  </td>
                  <td class="text-center align-middle text-nowrap">
                    <button @click="Object.assign(obj_update_goi_vip,v)" type="button" class="btn btn-success me-1" data-bs-toggle="modal" data-bs-target="#Chinhsua">
                      Chỉnh Sửa
                    </button>

                    <button @click="Object.assign(obj_delete_goi_vip,v)" data-bs-target="#Xoa" data-bs-toggle="modal" class="btn btn-danger">
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

                    <h4 class="modal-title fs-5" id="exampleModalLabel"><b>CHỈNH Sửa GÓI VIP</b>
                    </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body ">
                    <div class="mb-3 mt-1">
                      <label for="" class="form-label mb-1 mt-1">
                        <b>Tên Thể Loại</b>
                      </label>
                      <input v-model="obj_update_goi_vip.ten_goi_vip" v-on:keyup="addSlugUpdate()" v-on:change="kiemTraSlugUpdate()" type="text" class="form-control" placeholder="nhập gói vip..." />
                    </div>
                    <div class="mb-3 mt-1">
                        <label for="" class="form-label mb-1 mt-1">
                            <b>Slug Gói Vip</b>
                        </label>
                        <input v-model="obj_update_goi_vip.slug_goi_vip" type="text" disabled class="form-control" placeholder="slug gói vip..">
                    </div>
                    <div class="mb-3 mt-1">
                        <label for="" class="form-label mb-1 mt-1">
                            <b>Giá tiền</b>
                        </label>
                        <input v-model="obj_update_goi_vip.gia_tien" type="number" class="form-control" placeholder="nhập giá gói vip..." />
                    </div>
                    <div class="mb-3">
                      <label class="form-label mb-1 mt-1">
                        <b>Tình Trạng</b>
                      </label>
                      <select  v-model="obj_update_goi_vip.tinh_trang" name="" id="" class="form-control">
                        <option value="0">Tạm Dừng</option>
                        <option value="1">Hoạt động</option>
                      </select>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Đóng
                    </button>
                    <button @click="updateGoiVip()" type="button" class="btn btn-success" data-bs-dismiss="modal">Xong</button>
                  </div>
                </div>
              </div>
            </div>

            <!-- {{-- // modol xoa --}} -->
            <div class="modal fade" id="Xoa" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Xoá Thể Loại Phim
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body text-start">
                    <div class="alert alert-danger" role="alert">
                      Bạn muốn xoá gói vip phim <b>{{ obj_delete_goi_vip.ten_goi_vip }}</b> !!!
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Đóng </button>
                    <button @click="deleteGoiVip()" type="button" data-bs-dismiss="modal" class="btn btn-danger">Vẫn Xoá</button>
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
        list_goi_vip    : [],
        key_tim          : {},
        obj_add_goi_vip : {},
        obj_update_goi_vip : {},
        obj_delete_goi_vip : {},
      };
    },
    mounted() {
      this.loaddataGoiVip();
    },
    methods: {
      convertToSlug(str) {
            str = str.toLowerCase();
            str = str
                .normalize('NFD')
                .replace(/[\u0300-\u036f]/g, '');
            str = str.replace(/[đĐ]/g, 'd');
            str = str.replace(/([^0-9a-z-\s])/g, '');
            str = str.replace(/(\s+)/g, '-');
            str = str.replace(/-+/g, '-');
            str = str.replace(/^-+|-+$/g, '');
            return str;
        },
        addSlug() {
            this.obj_add_goi_vip.slug_goi_vip = this.convertToSlug(this.obj_add_goi_vip.ten_goi_vip);
        },

        addSlugUpdate() {
            this.obj_update_goi_vip.slug_goi_vip = this.convertToSlug(this.obj_update_goi_vip.ten_goi_vip);
        },

        kiemTraSlug() {
            var payload = {
                'slug' : this.obj_add_goi_vip.slug_goi_vip
            }
            baseRequest
                .post('admin/goi-vip/kiem-tra-slug', payload)
                .then((res) => {
                    if(res.data.status) {
                        toaster.success(res.data.message);
                        this.is_create = 1;
                    } else {
                        toaster.error(res.data.message);
                        this.is_create = 0;
                    }
                });
        },

        kiemTraSlugUpdate() {
            var payload = {
                'slug' : this.obj_update_goi_vip.slug_goi_vip,
                'id'   : this.obj_update_goi_vip.id
            }
            baseRequest
                .post('admin/goi-vip/kiem-tra-slug-update', payload)
                .then((res) => {
                    if(res.data.status) {
                        toaster.success(res.data.message);
                    } else {
                        toaster.error(res.data.message);
                    }
                });
        },
      loaddataGoiVip() {
        baseRequest
          .get("admin/goi-vip/lay-du-lieu")
          .then((res) => {
            this.list_goi_vip = res.data.goi_vips;
          });
      },
      taodataGoiVip() {
        baseRequest
          .post(
            "admin/goi-vip/thong-tin-tao",
            this.obj_add_goi_vip
          )
          .then((res) => {
            if (res.data.status == true) {
              this.obj_add_goi_vip = {};
              toaster.success(res.data.message);
              this.loaddataGoiVip();
            } else {
              toaster.error(res.data.message);
            }
          });
      },
      searchGoiVip() {
            baseRequest
                .post('admin/goi-vip/thong-tin-tim', this.key_tim)
                .then((res) => {
                    this.list_goi_vip = res.data.goi_vips;
                });
        },
        deleteGoiVip() {
          baseRequest
                .delete('admin/goi-vip/thong-tin-xoa/' + this.obj_delete_goi_vip.id)
                .then((res) => {
                    if (res.data.status == true) {
                        toaster.success('Thông báo<br>' + res.data.message);
                        this.loaddataGoiVip();
                    }
                    else {
                        toaster.danger('Thông báo<br>' + res.data.message);
                    }
                });
        },
        updateGoiVip() {
            baseRequest
                .put('admin/goi-vip/thong-tin-cap-nhat', this.obj_update_goi_vip)
                .then((res) =>  {
                    if(res.data.status == true) {
                        toaster.success('Thông báo<br>' + res.data.message);
                        this.loaddataGoiVip();
                    } else {
                        toaster.danger('Thông báo<br>' + res.data.message);
                    }
                });
        },

        doiTrangThai(xyz) {
            baseRequest
                .put('admin/goi-vip/thong-tin-thay-doi-trang-thai', xyz)
                .then((res) =>  {
                    if(res.data.status == true) {
                        toaster.success('Thông báo<br>' + res.data.message);
                        this.loaddataGoiVip();
                    } else {
                        toaster.error(res.data.message);
                    }
                });
        }
    },
  };
</script>
<style lang=""></style>
