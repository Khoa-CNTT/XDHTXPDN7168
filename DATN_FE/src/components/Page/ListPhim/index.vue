<template>
        <!-- Breadcrumb Begin -->
         <div class="breadcrumb-option" style="background-color: #0b0c2a">
          <div class="container">
            <div class="row">
              <div class="col-lg-12">
                <div class="breadcrumb__links">
                  <router-link to="/"><i class="fa fa-home"></i> Home</router-link>
                  <!-- <router-link to="/"> Thể Loại</router-link> -->
                  <span>Tất cả phim</span>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Breadcrumb End -->
        <div>
    </div>
        <section class="product-page spad" style="background-color: #0b0c2a">
          <div class="container">
            <div class="row">
              <div class="col-lg-8">
                <div class="product__page__content">
                  <div class="product__page__title">
                    <div class="row">
                      <div class="col-lg-8 col-md-8 col-sm-6">
                        <div class="section-title">
                          <!-- <h4>{{ v.ten_the_loai }}</h4> -->
                          <h4> Tất cả Phim</h4>
                        </div>
                      </div>
                      <div class="col-lg-4 col-md-4 col-sm-6">
                        <div class="product__page__filter">
                          <p>Sắp xếp theo:</p>
                          <select v-model="bien" @change="Sapxep()" >
                            <option value="az">A-Z</option>
                            <option value="za">Z-A</option>
                          </select>
                          <!-- <div class="nice-select" tabindex="0"><span class="current">A-Z</span>
                            <ul class="list">
                              <li data-value="" class="option selected">A-Z</li>
                              <li data-value="" class="option">1-10</li>
                              <li data-value="" class="option">10-50</li>
                            </ul>
                          </div> -->
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <template v-for="(v1,k1) in paginatedData">
                      <div  class="col-lg-4 col-md-6 col-sm-6">
                        <div class="product__item">
                          <router-link :to="{ name: 'PageDelist', params: { id: v1.id, slug: v1.slug_phim }}">
                            <div class="product__item__pic set-bg"
                              v-bind:style="{'background-image': 'url(' + v1.hinh_anh + ')',}">
                              <div v-if="v1.ten_loai_phim === 'Phim Bộ'" class="ep">
                                    ??/{{v1.so_tap_phim  }}
                                  </div>
                                  <div v-else-if="v1.ten_loai_phim === 'Phim Lẻ'" class="ep">
                                    Movie
                                  </div>
                                  <div v-else class="ep">RAW</div>
                              <div class="comment"><i class="fa fa-comments"></i> 11</div>
                              <div class="view"><i class="fa fa-eye"></i> 9141</div>
                            </div>
                          </router-link>
                          <div class="product__item__text">
                            <ul>
                              <li>{{ v1.ten_the_loai }}</li>
                              <li>{{ v1.ten_loai_phim }}</li>
                            </ul>
                            <h5>
                              <router-link :to="`/de-list/${v1.id}`">
                                <a v-bind:href="'/de-list' + v1.id">
                                  {{ v1.ten_phim }}</a></router-link>
                            </h5>
                          </div>
                        </div>
                      </div>
                    </template>

                  </div>
                </div>
                <div class="product__pagination text-center">
                  <button type="button" @click="changePage(-1)" :disabled="currentPage === 1" class="current-page " ><i class="fa-solid fa-chevron-left"></i></button>
                  <span style="padding: 0 28px;" class="text-white">{{ currentPage }} / {{ totalPages }}</span>
                  <button type="button" @click="changePage(1)" :disabled="currentPage === totalPages"  class="current-page" ><i class="fa-solid fa-chevron-right"></i></button>
                </div>
              </div>
              <div class="col-lg-4 col-md-6 col-sm-8 ">
                <div class="product__sidebar">

                  <div class="product__sidebar__comment">
                    <div class="section-title">
                      <h5>Hot Phim</h5>
                    </div>
                    <template v-for="(v,k) in list_9_phim ">
                      <div class="product__sidebar__comment__item">
                        <router-link :to="{ name: 'PageDelist', params: { id: v.id, slug: v.slug_phim }}">
                          <div class="product__sidebar__comment__item__pic">
                            <img v-bind:src="v.hinh_anh" style="width: 99px ;" alt="" />
                          </div>
                        </router-link>

                        <div class="product__sidebar__comment__item__text">
                          <ul>
                            <li>{{ v.ten_the_loai }}</li>
                            <li>{{ v.ten_loai_phim }}</li>
                          </ul>
                          <h5>
                            <router-link :to="`/de-list/${v.id}`">
                              <a v-bind:href="'/de-list' + v.id">
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
  </template>
  <script>
    import axios from "axios"
    import { mapState, mapGetters, mapMutations } from 'vuex';
    import baseRequest from '../../../core/baseRequest';
    import { createToaster } from "@meforma/vue-toaster";
    const toaster = createToaster({
      position: "top-right",
    });

    export default {
      data() {
        return {
          id: this.$route.params.id,
          list_loai_phim: [],
          list_the_loai: [],
          list_tac_gia: [],
          list_9_phim: [],
          list_phim: [],
          bien: '',
        };
      },
      computed: {
      ...mapState(['currentPage']),
      ...mapGetters(['paginatedData', 'totalPages'])
    },
      mounted() {
        this.laydataLoaiPhim();
        this.loaddataTheLoai();
        this.laydataPhim();
        this.fetchData();
      },
      methods: {
        // Sapxep(id_the_loai) {
        //     axios
        //         .get("https://wietfe216.trangchudulich.com/api/list-phim/sap-xep", {
        //             params : {
        //                 catagory: this.bien
        //             }
        //         })
        //         .then((res)=>{
        //                 this.list_phim = res.data.phim;
        //         });
        // },
        laydataPhim() {
          axios
            .get("https://wietfe216.trangchudulich.com/api/phim/lay-du-lieu-show")
            .then((res) => {
              this.list_phim = res.data.phim;
              this.list_9_phim = res.data.phim_9_obj;

            });
        },
        laydataLoaiPhim() {
          axios
            .get("https://wietfe216.trangchudulich.com/api/loai-phim/lay-du-lieu-show")
            .then((res) => {
              this.list_loai_phim = res.data.loai_phim;
            });
        },
        loaddataTheLoai() {
          axios
            .get("https://wietfe216.trangchudulich.com/api/the-loai/lay-du-lieu-show")
            .then((res) => {
              this.list_the_loai = res.data.the_loai;
            });
        },
        ...mapMutations(['setPage']),
        changePage(amount) {
        this.setPage(this.currentPage + amount);
       },
      async fetchData() {
      try {
        // Gửi yêu cầu API để lấy dữ liệu list_9_phim bằng Axios
        const response = await axios.get('https://wietfe216.trangchudulich.com/api/phim/lay-du-lieu-show');
        const data = response.data.phim;
        // Cập nhật dữ liệu trong store Vuex
        this.$store.commit('setList_9_Phim', data);
      } catch (error) {
        console.error('Error fetching data:', error);
      }
    },
    async Sapxep() {
      try {
        const params = {
          catagory: this.bien
        };
        // Gửi yêu cầu API để lấy dữ liệu list_9_phim bằng Axios
        const response = await axios.get('https://wietfe216.trangchudulich.com/api/list-phim/sap-xep', {
          params: params,
        });
        const data = response.data.phim;
        // Cập nhật dữ liệu trong store Vuex
        this.$store.commit('setList_9_Phim', data);
      } catch (error) {
        console.error('Error fetching data:', error);
      }
    },
      },
    };
  </script>
  <style></style>
