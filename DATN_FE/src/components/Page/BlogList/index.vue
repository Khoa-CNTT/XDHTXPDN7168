<template>
  <section
    class=" normal-breadcrumb set-bg"
    data-setbg="img/normal-breadcrumb.jpg"
    style="
      background-image: url(https://themewagon.github.io/anime/img/normal-breadcrumb.jpg);
      background-color: #0b0c2a;
    "
  >
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
          <div class="normal__breadcrumb__text">
            <h2>BLOG</h2>
            <p>Chào mừng bạn đến với blog Anime.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Blog Section Begin -->
  <section style="background-color: #0b0c2a" class="blog spad">
    <div class="container mt-3">
      <div class="row">
        <div class="col-lg-12">
          <div class="trending__product">
            <div class="row">
              <div class="col-lg-8 col-md-8 col-sm-8">
                <div class="section-title">
                  <h4>Xem Nhiều Nhất</h4>
                </div>
              </div>
              <div class="col-lg-4 col-md-4 col-sm-4">
                <div class="btn__all">
                  <div class="section-title">
                  <h4>Đăng Bài</h4>
                </div>
                  <!-- <router-link :to="`/index1/${2}`"> -->
                    
                  <!-- </router-link> -->
                </div>
              </div>
            </div>
            <div class="row">
              <div class="row">
                <template v-for="(v, k) in list_blog">
                  <div class="col-lg-4 col-md-6 col-sm-6">
                    <div
                      class="blog__item small__item set-bg"
                      v-bind:style="{
                        'background-image': 'url(' + v.hinh_anh + ')',
                      }"
                    >
                      <div style=" background-color: rgba(35, 33, 33, 0.7);top: 194px; bottom: 0;" class="blog__item__text">
                        <p><span class="icon_calendar"></span> 01 March 2020</p>
                        <h4>
                          <router-link :to="`/index5/${v.id}`">
                            <a v-bind:href="'/index5' + v.id">
                              {{ v.tieu_de }}</a></router-link>
                        </h4>
                      </div>
                    </div>
                  </div>
                </template>
              </div>
            </div>
          </div>
        </div>

        <!-- <div class="col-lg-4 col-md-6 col-sm-8">
          <div class="product__sidebar">
            <div class="product__sidebar__comment">
              <div class="section-title">
                <h5>Hot trong tuần</h5>
              </div>
              <template v-for="(v, k) in list_blog">
                <div class="product__sidebar__comment__item">
                  <div class="product__sidebar__comment__item__pic">
                    <img v-bind:src="v.hinh_anh" style="width: 99px" alt="" />
                  </div>
                  <div class="product__sidebar__comment__item__text">
                    
                    <h5>
                         <router-link :to="`/index2/${v.id}`">
                        <a v-bind:href="'/index2' + v.id">
                          {{ v.tieu_de }}</a
                        ></router-link
                      >
                    </h5>
                  </div>
                </div>
              </template>
            </div>
          </div>
        </div> -->
      </div>
    </div>
  </section>
  <!-- Blog Section End -->
</template>
<script>
import axios from "axios";
import { createToaster } from "@meforma/vue-toaster";
const toaster = createToaster({
  position: "top-right",
});
export default {
  data() {
    return {
      list_blog: [],
      isLoading: true,
    };
  },
  mounted() {
    this.laydataLoaiBlog();
  },

  methods: {
    laydataLoaiBlog() {
      axios
        .get("http://127.0.0.1:8000/api/admin/bai-viet/lay-du-lieu")
        .then((res) => {
          this.list_blog = res.data.bai_viet;
        });
    },
  },
};
</script>
<style></style>
