<template>
  <div class="container">
    <div class="row mb-3">
      <div class="col-12 text-end">
        <button class="btn btn-outline-primary px-5 radius-30" data-bs-toggle="modal" data-bs-target="#themMoiModal">
          <b>Thêm Mới</b>
        </button>
      </div>
    </div>
    <div class="modal fade" id="themMoiModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Thêm Mới Phim</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="row">
                <div class="col-6">
                  <label for="" class="form-label mb-1 mt-1">
                    <b>Tên Phim</b>
                  </label>
                  <input v-model="obj_add_phim.ten_phim" type="text" class="form-control" placeholder="nhập phim..." />
                </div>
                <div class="col-6">
                  <label for="" class="form-label mb-1 mt-1">
                    <b>Mô Tả</b>
                  </label>
                  <input v-model="obj_add_phim.mo_ta" type="text" class="form-control"
                    placeholder="nhập slug phim..." />
                </div>
              </div>
              <div class="row">
                <div class="col-6">
                  <label for="" class="form-label mb-1 mt-1">
                    <b>Url Phim</b>
                  </label>
                  <input v-model="obj_add_phim.url" type="text" class="form-control" placeholder="nhập url..." />
                </div>
                <div class="col-6">
                  <label for="" class="form-label mb-1 mt-1">
                    <b>Hình Ảnh</b>
                  </label>
                  <input type="file" @change="handleFileChange" class="form-control" />
                </div>
              </div>
              <div class="row">
                <div class="col-6">
                  <label class="form-label mb-1 mt-1">
                    <b>Loại Phim</b>
                  </label>
                  <select v-model="obj_add_phim.id_loai_phim" name="" id="" class="form-control">
                    <template v-for="(v, k) in list_loai_phim">
                      <option v-bind:value="v.id">{{ v.ten_loai_phim }}</option>
                    </template>
                  </select>
                </div>
                <div class="col-6">
                  <label class="form-label mb-1 mt-1">
                    <b>Thể Loại</b>
                  </label>
                  <select v-model="obj_add_phim.id_the_loai" name="" id="" class="form-control">
                    <template v-for="(v, k) in list_the_loai">
                      <option v-bind:value="v.id">{{ v.ten_the_loai }}</option>
                    </template>
                  </select>
                </div>
                <div class="col-6">
                  <label class="form-label mb-1 mt-1">
                    <b>Tác Giả</b>
                  </label>
                  <select v-model="obj_add_phim.id_tac_gia" name="" id="" class="form-control">
                    <template v-for="(v, k) in list_tac_gia">
                      <option v-bind:value="v.id">{{ v.ten_tac_gia }}</option>
                    </template>
                  </select>
                </div>
                <div class="col-6">
                  <label class="form-label mb-1 mt-1">
                    <b>Tình Trạng</b>
                  </label>
                  <select v-model="obj_add_phim.tinh_trang" class="form-control mb-3">
                    <option value="0">Tạm Dừng</option>
                    <option value="1">Hiển Thị</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Thoát</button>
            <button type="button" class="btn btn-primary" data-bs-dismiss="modal" v-on:click="taoDataPhim()">Thêm
              Mới</button>
          </div>
        </div>
      </div>
    </div>
    <div class="row">

      <div class="col-12">
        <div class="card border-5 border-primary border-top">
          <div class="card-header">
            <b>DANH SÁCH PHIM</b>
          </div>
          <div class="card-body">
            <table class="table table-bordered table-responsive ">
              <thead>
                <tr>
                  <th colspan="100%">
                    <div class="input-group mb-3">
                      <input v-on:keyup.enter="searchPhim()" v-model="key_tim.key" type="text" class="form-control"
                        placeholder="Nhập thông tin cần tìm">
                      <button class="btn btn-primary" v-on:click="searchPhim()">
                        <i class="fa-solid fa-magnifying-glass"></i>
                      </button>
                    </div>
                  </th>
                </tr>
                <tr class="text-center">
                  <th>#</th>
                  <th class="text-center align-middle text-nowrap">Tên Phim</th>
                  <th class="text-center align-middle text-nowrap">Mô Tả</th>
                  <th class="text-center align-middle text-nowrap">Hình Ảnh</th>
                  <th class="text-center align-middle text-nowrap">Loại Phim</th>
                  <th class="text-center align-middle text-nowrap">Thể Loại</th>
                  <th class="text-center align-middle text-nowrap">Tác Giả</th>
                  <th class="text-center align-middle text-nowrap">Url Phim</th>
                  <th class="text-center align-middle text-nowrap">Tình Trạng</th>
                  <th class="text-center align-middle text-nowrap">Action</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(v, k) in list_phim" class="text-center">
                  <td class="text-center align-middle text-nowrap">{{ k + 1 }}</td>
                  <td class="text-center align-middle text-nowrap">{{ v.ten_phim }}</td>
                  <td class="text-center align-middle text-nowrap">
                    <button @click="Object.assign(obj_mo_ta,v)" type="button" class="btn text-info" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa-solid fa-info"></i>
                    </button>
                  </td>
                  <td class="text-center align-middle text-nowrap">
                    <img v-bind:src="v.hinh_anh" class="img-fluid" style="width: 70px; height: auto;" alt="">
                  </td>
                  <td class="text-center align-middle text-nowrap">{{ v.ten_loai_phim }}</td>
                  <td class="text-center align-middle text-nowrap">{{ v.ten_the_loai }}</td>
                  <td class="text-center align-middle text-nowrap">{{ v.ten_tac_gia }}</td>
                  <td class="text-center align-middle text-nowrap">{{ v.url }}</td>

                  <td class="text-center align-middle text-nowrap">
                    <button @click="doiTrangThai(v)" v-if="v.tinh_trang == 1" class="btn btn-success">
                      Hoạt Động
                    </button>
                    <button @click="doiTrangThai(v)" v-if="v.tinh_trang == 0" class="btn btn-warning">
                      Tạm Dừng
                    </button>
                  </td>
                  <td class="text-center align-middle text-nowrap">
                    <button @click="Object.assign(obj_update_phim,v)" type="button" class="btn btn-warning me-1"
                      data-bs-toggle="modal" data-bs-target="#Chinhsua">
                      Chỉnh Sữa
                    </button>

                    <button @click="Object.assign(obj_delete_phim,v)" data-bs-target="#Xoa" data-bs-toggle="modal"
                      class="btn btn-danger">
                      Xoá
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Mô Tả</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    {{ obj_mo_ta.mo_ta }}
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Đóng</button>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal fade" id="Chinhsua" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">CHỈNH SỮA PHIM
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body text-start">
                    <div class="row">
              <div class="row">
                <div class="col-6">
                  <label for="" class="form-label mb-1 mt-1">
                    <b>Tên Phim</b>
                  </label>
                  <input v-model="obj_update_phim.ten_phim" type="text" class="form-control" placeholder="nhập phim..." />
                </div>
                <div class="col-6">
                  <label for="" class="form-label mb-1 mt-1">
                    <b>Mô Tả</b>
                  </label>
                  <input v-model="obj_update_phim.mo_ta" type="text" class="form-control"
                    placeholder="nhập slug phim..." />
                </div>
              </div>
              <div class="row">
                <div class="col-6">
                  <label for="" class="form-label mb-1 mt-1">
                    <b>Url Phim</b>
                  </label>
                  <input v-model="obj_update_phim.url" type="text" class="form-control" placeholder="nhập url..." />
                </div>
                <div class="col-6">
                  <label for="" class="form-label mb-1 mt-1">
                    <b>Hình Ảnh</b>
                  </label>
                  <input type="file" @change="handleFileChange" class="form-control" />
                </div>
              </div>
              <div class="row">
                <div class="col-6">
                  <label class="form-label mb-1 mt-1">
                    <b>Loại Phim</b>
                  </label>
                  <select v-model="obj_update_phim.id_loai_phim" name="" id="" class="form-control">
                    <template v-for="(v, k) in list_loai_phim">
                      <option v-bind:value="v.id">{{ v.ten_loai_phim }}</option>
                    </template>
                  </select>
                </div>
                <div class="col-6">
                  <label class="form-label mb-1 mt-1">
                    <b>Thể Loại</b>
                  </label>
                  <select v-model="obj_update_phim.id_the_loai" name="" id="" class="form-control">
                    <template v-for="(v, k) in list_the_loai">
                      <option v-bind:value="v.id">{{ v.ten_the_loai }}</option>
                    </template>
                  </select>
                </div>
                <div class="col-6">
                  <label class="form-label mb-1 mt-1">
                    <b>Tác Giả</b>
                  </label>
                  <select v-model="obj_update_phim.id_tac_gia" name="" id="" class="form-control">
                    <template v-for="(v, k) in list_tac_gia">
                      <option v-bind:value="v.id">{{ v.ten_tac_gia }}</option>
                    </template>
                  </select>
                </div>
                <div class="col-6">
                  <label class="form-label mb-1 mt-1">
                    <b>Tình Trạng</b>
                  </label>
                  <select v-model="obj_update_phim.tinh_trang" class="form-control mb-3">
                    <option value="0">Tạm Dừng</option>
                    <option value="1">Hiển Thị</option>
                  </select>
                </div>
              </div>
            </div>
                    
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Đóng
                    </button>
                    <button @click="updatePhim()" type="button" class="btn btn-success"
                      data-bs-dismiss="modal">Lưu</button>
                  </div>
                </div>
              </div>
            </div>

            <!-- {{-- // modol xoa --}} -->
            <div class="modal fade" id="Xoa" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"> Xoá Phim
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body text-start">
                    <div class="alert alert-danger" role="alert">
                      Bạn có muốn xoá Phim <b>{{ obj_delete_phim.ten_phim }}</b>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Đóng </button>
                    <button @click="deletePhim()" type="button" class="btn btn-danger" data-bs-dismiss="modal">Vẫn
                      Xoá</button>
                  </div>
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
        list_loai_phim : [],
        obj_mo_ta      : {},
        list_the_loai  : [],
        list_tac_gia   : [],
        list_phim      : [],
        obj_add_phim   : {},
        key_tim        : {},
        obj_update_phim: {},
        obj_delete_phim: {},
      };
    },
    mounted() {
      this.laydataPhim();
      this.laydataLoaiPhim();
      this.loaddataTheLoai();
      this.loaddataTacGia();

    },
    methods: {
      loaddataTacGia() {
          baseRequest
            .get("admin/tac-gia/lay-du-lieu")
            .then((res) => {
              this.list_tac_gia = res.data.tac_gia_admin;
            });
        },
      laydataLoaiPhim() {
        baseRequest
          .get("admin/loai-phim/lay-du-lieu")
          .then((res) => {
            this.list_loai_phim = res.data.loai_phim_admin;
          });
      },
      loaddataTheLoai() {
        baseRequest
          .get("admin/the-loai/lay-du-lieu")
          .then((res) => {
            this.list_the_loai = res.data.the_loai_admin;
          });
      },
      laydataPhim() {
        baseRequest
          .get("admin/phim/lay-du-lieu")
          .then((res) => {
            this.list_phim = res.data.phim_admin;
            console.log(this.list_phim_admin);
          });
      },
      taoDataPhim() {
        baseRequest
          .post(
            "admin/phim/thong-tin-tao",
            this.obj_add_phim
          )
          .then((res) => {
            if (res.data.status == true) {
              toaster.success(res.data.message);
              this.obj_add_phim = {};
              this.laydataPhim();
            } else {
              toaster.error(res.data.message);
            }
          });
      },
      searchPhim() {
        baseRequest
          .post('admin/phim/thong-tin-tim', this.key_tim)
          .then((res) => {
            this.list_phim = res.data.phim;
          });
      },
      deletePhim() {
        baseRequest
          .delete('admin/phim/thong-tin-xoa/' + this.obj_delete_phim.id)
          .then((res) => {
            if (res.data.status == true) {
              toaster.success('Thông báo<br>' + res.data.message);
              this.laydataPhim();
            }
            else {
              toaster.danger('Thông báo<br>' + res.data.message);
            }
          });
      },
      updatePhim() {
        baseRequest
          .put('admin/phim/thong-tin-cap-nhat', this.obj_update_phim)
          .then((res) => {
            if (res.data.status == true) {
              toaster.success('Thông báo<br>' + res.data.message);
              this.laydataPhim();
            } else {
              toaster.danger('Thông báo<br>' + res.data.message);
            }
          });
      },

      doiTrangThai(xyz) {
        baseRequest
          .put('admin/phim/thong-tin-thay-doi-trang-thai', xyz)
          .then((res) => {
            if (res.data.status == true) {
              toaster.success('Thông báo<br>' + res.data.message);
              this.laydataPhim();
            } else {
              toaster.error(res.data.message);
            }
          });
      },
      /// file base 64
      async imageToBase64(file) {
        return new Promise((resolve, reject) => {
          const reader = new FileReader();
          reader.readAsDataURL(file);

          reader.onload = () => resolve(reader.result);
          reader.onerror = (error) => reject(error);
        });
      },

      async handleFileChange(event) {
        const file = event.target.files[0];

        if (file) {
          try {
            const base64Data = await this.imageToBase64(file);
            console.log('Base64 Data:', base64Data);
            this.obj_add_phim.hinh_anh = base64Data;
            // Thực hiện các hành động khác với base64Data ở đây
          } catch (error) {
            console.error('Error converting image to base64:', error);
          }
        }
      },
    },

  };
</script>
<style lang=""></style>