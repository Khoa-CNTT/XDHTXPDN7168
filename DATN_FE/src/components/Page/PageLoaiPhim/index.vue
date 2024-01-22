<template>
    <template v-for="(v,k) in list_loai_phim">
        <template v-if="v.id == loai_phim.id">
            <!-- Breadcrumb Begin -->
            <div class="breadcrumb-option" style="background-color: #0b0c2a">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="breadcrumb__links">
                                <router-link to="/"><i class="fa fa-home"></i> Home</router-link>
                                <router-link to="/"> Loại Phim</router-link>
                                <router-link to="/">  {{ v.ten_loai_phim }}</router-link>
                                <span>{{ v.ten_phim }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Breadcrumb End -->

            <section class="product-page spad" style="background-color: #0b0c2a"> 
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="product__page__content">
                                <div class="product__page__title">
                                    <div class="row">
                                        <div class="col-lg-8 col-md-8 col-sm-6">
                                            <div class="section-title">
                                                <h4>{{ v.ten_loai_phim }}</h4>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-6">
                                            <div class="product__page__filter">
                                                <p>Sắp xếp theo:</p>
                                                <select v-model="bien" @change="Sapxep(v.id)" >
                                                    <option value="az">A-Z</option>
                                                    <option value="za">Z-A</option>
                                                    <option value="1to10">1-9</option>
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
                                    <template v-for="(v1,k1) in list_phim">
                                        <div v-if="v1.id_loai_phim == v.id" class="col-lg-4 col-md-6 col-sm-6">
                                        <div class="product__item">
                                           <router-link :to="{ name: 'PageDelist', params: { id: v1.id, slug: v1.slug_phim }}" >
                                                <div class="product__item__pic set-bg"
                                                v-bind:style="{'background-image': 'url(' + v1.hinh_anh + ')',}">
                                                <div v-if="v1.ten_loai_phim === 'Phim Bộ'" class="ep">
                                                    ??/{{v1.so_tap_phim  }}
                                                </div>
                                                <div v-else-if="v1.ten_loai_phim === 'Phim Lẻ'" class="ep">
                                                    Movie
                                                </div>
                                                <div v-else class="ep">RAW</div>
                                                    <div class="comment"><i class="fa fa-comments"></i> 1</div>
                                                    <div class="view"><i class="fa fa-eye"></i> 9141</div>
                                                </div>
                                           </router-link>
                                            <div class="product__item__text">
                                                <ul>
                                                    <li>{{ v1.ten_the_loai }}</li>
                                                     <li>{{ v1.ten_loai_phim }}</li>
                                                </ul>
                                                <h5>
                                                            <router-link :to="{ name: 'PageDelist', params: { id: v1.id, slug: v1.slug_phim }}">
                                                        <a v-bind:href="'/index2' + v1.id">
                                                        {{ v1.ten_phim }}</a></router-link>
                                                     </h5>
                                            </div>
                                        </div>
                                    </div>

                                    </template>
                                    
                                </div>
                            </div>
                            <div class="product__pagination">
                                <a href="#" class="current-page">1</a>
                                <a href="#">2</a>
                                <a href="#">3</a>
                                <a href="#">4</a>
                                <a href="#">5</a>
                                <a href="#"><i class="fa fa-angle-double-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-8">
                            <div class="product__sidebar">
                                
                                <div class="product__sidebar__comment">
                                    <div class="section-title">
                                        <h5>Hot Phim</h5>
                                    </div>
                                    <template v-for="(v,k) in list_9_phim ">
                                <div class="product__sidebar__comment__item">
                                    
                                    <router-link :to="{ name: 'PageDelist', params: { id: v.id, slug: v.slug_phim }}" >
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
                                    <router-link :to="{ name: 'PageDelist', params: { id: v.id, slug: v.slug_phim }}">
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


        </template>
        
    </template>


</template>
<script>
    import axios from "axios"
    import baseRequest from '../../../core/baseRequest';
    import { createToaster } from "@meforma/vue-toaster";
    const toaster = createToaster({
        position: "top-right",
    });

    export default {
        props : ['id', 'slug'],
        data() {
            return {
                // id: this.$route.params.id,
                loai_phim        : {},
                list_loai_phim: [],
                list_tac_gia: [],
                list_phim: [],
                list_9_phim: [],
                bien: '',

            };
        },
        mounted() {
            this.laydataLoaiPhim();
              this.loadataLoaiPhimAndPhim();
        },
        watch: {
        $route(to, from){
          this.laydataLoaiPhim();
          this.loadataLoaiPhimAndPhim();
        }
        },
        methods: {
            loadataLoaiPhimAndPhim() {
                    axios
                        .get("http://127.0.0.1:8000/api/loai-phim/lay-du-lieu-show-tat-ca", {
                        params :{
                        id_lp : this.id,
                        } }) 
                        .then((res) => {
                        this.loai_phim = res.data.loai_phim;
                        this.list_phim = res.data.phim;
                        this.list_9_phim = res.data.phim_9_obj;
                        });
                    },
            Sapxep(id_loai_phim) {
                    axios
                        .get("http://127.0.0.1:8000/api/loai-phim/sap-xep", {
                            params : {
                                id_lp : id_loai_phim,
                                catagory: this.bien
                            }
                        })
                        .then((res)=>{
                                this.list_phim = res.data.phim;
                        });
                },
            
            laydataLoaiPhim() {
                axios
                    .get("http://127.0.0.1:8000/api/loai-phim/lay-du-lieu-show")
                    .then((res) => {
                        this.list_loai_phim = res.data.loai_phim;
                    });
            },
           

        },
    };
</script>
<style></style>