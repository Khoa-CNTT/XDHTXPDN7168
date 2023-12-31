<template>

  <div>
    <!-- Hero Section Begin -->
    <section class="hero" style="background-color: #0b0c2a">
      <div class="container">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
          <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
          </ol>
          <div class="carousel-inner">
            <div class="carousel-item active" data-interval="2000">
              <img
                src="https://s199.imacdn.com/vg/2023/10/15/db226b83e19a0db4_de40f7bcb1b25a83_38908116973670493118684.jpg"
                class="d-block w-100" alt="..." />
            </div>
            <div class="carousel-item" data-interval="2000">
              <img
                src="https://s199.imacdn.com/vg/2023/12/28/f4e15980a7b1abbf_fdd63a20e3d8d9cf_1945637170376963341.jpg"
                class="d-block w-100" alt="..." />
            </div>
            <div class="carousel-item" data-interval="2000">
              <img
                src="https://s199.imacdn.com/vg/2023/10/25/3bf3b03a63b3cacc_996e45a57ccb35dd_30496816982129028118684.jpg"
                class="d-block w-100" alt="..." />
            </div>
            <div class="carousel-item" data-interval="2000">
              <img
                src="https://s199.imacdn.com/vg/2023/10/15/3fbae7beddcc5654_997100d400a26fe7_29875616973672775118684.jpg"
                class="d-block w-100" alt="..." />
            </div>
            <div class="carousel-item" data-interval="2000">
              <img
                src="https://s199.imacdn.com/vg/2023/10/15/a1e02d861cfd2757_b37b7dd1c0ade623_32888916973670718118684.jpg"
                class="d-block w-100" alt="..." />
            </div>
          </div>
          <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
      </div>
    </section>
    <!-- Hero Section End -->

    <!-- Product Section Begin -->
    <section class="product spad" style="background-color: #0b0c2a">
      <div class="container">
        <div class="row">
          <div class="col-lg-8">
            <div class="trending__product">
              <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-8">
                  <div class="section-title">
                    <h4>Xem Nhiều Nhất</h4>
                  </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4">
                  <div class="btn__all">
                    <router-link :to="`/index1/${2}`">
                        <a  class="primary-btn">View All <span
                            class="arrow_right"></span></a>
                      </router-link>
                  </div>
                </div>
              </div>
              <div class="row">
                <template v-for="(v, k) in Show3object">
                  <div v-if="k < 3" class="col-lg-4 col-md-6 col-sm-6">
                    <div class="product__item">
                      <img src="" alt="" />
                      <div class="product__item__pic" v-bind:style="{
                          'background-image': 'url(' + v.hinh_anh + ')',
                        }">
                        <div v-if="v.ten_loai_phim === 'Phim Bộ'" class="ep">12 / 12</div>
                        <div class="comment">
                        </div>
                        <div class="view"><i class="fa fa-eye"></i> 13401</div>
                      </div>
                      <div class="product__item__text">
                        <ul>
                          <li>{{ v.ten_the_loai }}</li>
                          <li>{{ v.ten_loai_phim }}</li>
                        </ul>
                        <h5>
                          <router-link :to="`/index2/${v.id}`">
                            <a v-bind:href="'/index2' + v.id">
                              {{ v.ten_phim }}</a></router-link>

                        </h5>
                      </div>
                    </div>
                  </div>
                </template>
              </div>
            </div>
            <template v-for="(v1,k1) in list_the_loai">
              <div class="trending__product">
                <div class="row">
                  <div class="col-lg-8 col-md-8 col-sm-8">
                    <div class="section-title">
                      <h4> {{ v1.ten_the_loai }}</h4>
                    </div>
                  </div>
                  <div class="col-lg-4 col-md-4 col-sm-4">
                    <div class="btn__all">
                      <router-link :to="`/index1/${v1.id}`">
                        <a v-bind:href="'/index1' + v1.id" class="primary-btn">View All <span
                            class="arrow_right"></span></a>
                      </router-link>
                      <!-- <<router-link :to="`/index2/${v.id}`">
                            <a v-bind:href="'/index2' + v.id">
                            {{ v.ten_phim }}</a></router-link>> -->
                    </div>
                  </div>
                </div>
                <div class="row">
                  <template v-for="(v, k) in list_phim">
                    <template v-if="v.id_the_loai == v1.id ">
                      <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="product__item">
                          <img src="" alt="" />
                          <div class="product__item__pic" v-bind:style="{
                            'background-image': 'url(' + v.hinh_anh + ')',}">
                            <div v-if="v.ten_loai_phim === 'Phim Bộ'" class="ep">1??/99</div>
                            <div class="comment">
                            </div>
                            <div class="view"><i class="fa fa-eye"></i> 2106</div>
                          </div>
                          <div class="product__item__text">
                            <ul>
                              <li>{{ v.ten_the_loai }}</li>
                              <li>{{ v.ten_loai_phim }}</li>
                            </ul>
                            <h5>
                              <router-link :to="`/index2/${v.id}`">
                                <a v-bind:href="'/index2' + v.id">
                                  {{ v.ten_phim }}</a></router-link>
                            </h5>
                          </div>
                        </div>
                      </div>
                    </template>
                  </template>
                </div>
              </div>
            </template>
          </div>

          <div class="col-lg-4 col-md-6 col-sm-8">
            <div class="product__sidebar">
              <div class="product__sidebar__view">
                <div class="section-title">
                  <h5>Mới Cập Nhật</h5>
                </div>

                <div class="filter__gallery" id="MixItUpF5B6EA">
                  <template v-for="(v,k) in Show1object">
                    <div class="product__sidebar__view__item set-bg mix month week" data-setbg="img/sidebar/tv-2.jpg"
                      v-bind:style="{'background-image': 'url(https://lh6.googleusercontent.com/cDPX0RMhR9r5WIz34hyHEVS4OGH7OEd5Tbbq-X30qNNSx37qRDzC5Up6afJLTCE0w2ZXY6_OSRfI96znna8fl3f9TSncQo-EmM1g7fQ7EopmHDPpszbHnCH74F4BdTvDMU8ZTG0=s0)',}">
                      <div class="ep">18 / ?</div>
                      <div class="view"><i class="fa fa-eye"></i> 567</div>
                      <h5>
                        <router-link :to="`/index2/${v.id}`">
                          <a v-bind:href="'/index2' + v.id">
                            {{ v.ten_phim }}</a></router-link>
                      </h5>
                    </div>
                  </template>
                  <template v-for="(v,k) in Show2object">
                    <div class="product__sidebar__view__item set-bg mix month week" data-setbg="img/sidebar/tv-2.jpg"
                      v-bind:style="{'background-image': 'url(https://i0.wp.com/www.animefeminist.com/wp-content/uploads/2022/01/Orient-1.jpg?fit=810%2C453&ssl=1)',}">
                      <div class="ep">18 / ?</div>
                      <div class="view"><i class="fa fa-eye"></i> 567</div>
                      <h5>
                        <router-link :to="`/index2/${v.id}`">
                          <a v-bind:href="'/index2' + v.id">
                            {{ v.ten_phim }}</a></router-link>
                      </h5>
                    </div>
                  </template>



                </div>
              </div>
              <div class="product__sidebar__comment">
                <div class="section-title">
                  <h5>Hot trong tuần</h5>
                </div>
                <template v-for="(v,k) in Show9object ">
                  <div class="product__sidebar__comment__item">
                    <div class="product__sidebar__comment__item__pic">
                      <img v-bind:src="v.hinh_anh" style="width: 99px ;" alt="" />
                    </div>
                    <div class="product__sidebar__comment__item__text">
                      <ul>
                        <li>{{ v.ten_the_loai }}</li>
                        <li>{{ v.ten_loai_phim }}</li>
                      </ul>
                      <h5>
                        <router-link :to="`/index2/${v.id}`">
                          <a v-bind:href="'/index2' + v.id">
                            {{ v.ten_phim }}</a></router-link>
                      </h5>
                      <span><i class="fa fa-eye"></i> 19.141 Viewes</span>
                    </div>
                  </div>
                </template>


              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
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
        list_loai_phim: [],
        list_the_loai: [],
        list_phim: [],
        test: 0,
        // list_phimHD     : [],
        x: 3,
      };
    },
    mounted() {

      this.laydataLoaiPhim();
      this.loaddataTheLoai();
      this.laydataPhim();
    },
    computed: {
      // Tính toán để lấy ba phần tử cuối cùng của mảng items
      Show3object() {
        const totalItems = this.list_phim.length;
        // Sử dụng slice để lấy ba phần tử cuối cùng của mảng
        return this.list_phim.slice(totalItems - 3, totalItems);
      },
      Show1object() {
        const totalItems = this.list_phim.length;
        // Sử dụng slice để lấy ba phần tử cuối cùng của mảng
        return this.list_phim.slice(totalItems - 1, totalItems);
      },
      Show2object() {
        const totalItems = this.list_phim.length;
        // Sử dụng slice để lấy ba phần tử cuối cùng của mảng
        return this.list_phim.slice(totalItems - 2, totalItems - 1);
      },
      Show9object() {
        const totalItems = this.list_phim.length;
        // Sử dụng slice để lấy ba phần tử cuối cùng của mảng
        return this.list_phim.slice(totalItems - 9, totalItems);
      }

    },

    methods: {

      laydataPhim() {
        baseRequest
          .get("admin/phim/lay-du-lieu")
          .then((res) => {
            this.list_phim = res.data.phim;
          });
      },
      laydataLoaiPhim() {
        axios
          .get("http://127.0.0.1:8000/api/admin/loai-phim/lay-du-lieu")
          .then((res) => {
            this.list_loai_phim = res.data.loai_phim;
          });
      },
      loaddataTheLoai() {
        axios
          .get("http://127.0.0.1:8000/api/admin/the-loai/lay-du-lieu")
          .then((res) => {
            this.list_the_loai = res.data.the_loai;
          });
      },

    },

  };
</script>
<style></style>