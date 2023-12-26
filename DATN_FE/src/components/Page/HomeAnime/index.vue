<template>
  <div v-if="isLoading" id="preloder">
    <div class="loader"></div>
  </div>
  <div v-else>
    <!-- Hero Section Begin -->
    <section class="hero" style="background-color: #0b0c2a">
      <div class="container">
        <div
          id="carouselExampleIndicators"
          class="carousel slide"
          data-ride="carousel"
        >
          <ol class="carousel-indicators">
            <li
              data-target="#carouselExampleIndicators"
              data-slide-to="0"
              class="active"
            ></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
          </ol>
          <div class="carousel-inner">
            <div class="carousel-item active" data-interval="2000">
              <img
                src="https://s199.imacdn.com/vg/2023/10/15/db226b83e19a0db4_de40f7bcb1b25a83_38908116973670493118684.jpg"
                class="d-block w-100"
                alt="..."
              />
            </div>
            <div class="carousel-item" data-interval="2000">
              <img
                src="https://s199.imacdn.com/vg/2023/10/15/864d8df1112ef262_371d215a8d1d0379_150454216973679299118684.jpg"
                class="d-block w-100"
                alt="..."
              />
            </div>
            <div class="carousel-item" data-interval="2000">
              <img
                src="https://s199.imacdn.com/vg/2023/10/25/3bf3b03a63b3cacc_996e45a57ccb35dd_30496816982129028118684.jpg"
                class="d-block w-100"
                alt="..."
              />
            </div>
            <div class="carousel-item" data-interval="2000">
              <img
                src="https://s199.imacdn.com/vg/2023/10/15/3fbae7beddcc5654_997100d400a26fe7_29875616973672775118684.jpg"
                class="d-block w-100"
                alt="..."
              />
            </div>
            <div class="carousel-item" data-interval="2000">
              <img
                src="https://s199.imacdn.com/vg/2023/10/15/a1e02d861cfd2757_b37b7dd1c0ade623_32888916973670718118684.jpg"
                class="d-block w-100"
                alt="..."
              />
            </div>
          </div>
          <a
            class="carousel-control-prev"
            href="#carouselExampleIndicators"
            role="button"
            data-slide="prev"
          >
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a
            class="carousel-control-next"
            href="#carouselExampleIndicators"
            role="button"
            data-slide="next"
          >
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
                    <a href="#" class="primary-btn"
                      >View All <span class="arrow_right"></span
                    ></a>
                  </div>
                </div>
              </div>
              <div class="row">
                <template v-for="(v, k) in list_anh">
                  <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="product__item">
                      <img src="" alt="" />
                      <div
                        class="product__item__pic"
                        v-bind:style="{
                          'background-image': 'url(' + v.img + ')',
                        }"
                      >
                        <div class="ep">18 / 18</div>
                        <div class="comment">
                          <i class="fa fa-comments"></i> 11
                        </div>
                        <div class="view"><i class="fa fa-eye"></i> 9141</div>
                      </div>
                      <div class="product__item__text">
                        <ul>
                          <li>Active</li>
                          <li>Movie</li>
                        </ul>
                        <h5>
                          <a href="#"
                            >The Seven Deadly Sins: Wrath of the Gods</a
                          >
                        </h5>
                      </div>
                    </div>
                  </div>
                </template>
              </div>
            </div>
            <div class="popular__product">
              <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-8">
                  <div class="section-title">
                    <h4>Thể Loại</h4>
                  </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4">
                  <div class="btn__all">
                    <a href="#" class="primary-btn"
                      >View All <span class="arrow_right"></span
                    ></a>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-6">
                  <div class="product__item">
                    <div
                      class="product__item__pic set-bg"
                      data-setbg="img/popular/popular-1.jpg"
                      style="
                        background-image: url(https://cdn.animevietsub.fan/data/poster/2022/02/14/animevsub-SOESV0gsCC.jpg);
                      "
                    >
                      <div class="ep">18 / 18</div>
                      <div class="comment">
                        <i class="fa fa-comments"></i> 11
                      </div>
                      <div class="view"><i class="fa fa-eye"></i> 9141</div>
                    </div>
                    <div class="product__item__text">
                      <ul>
                        <li>Active</li>
                        <li>Movie</li>
                      </ul>
                      <h5><a href="#">Sen to Chihiro no Kamikakushi</a></h5>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                  <div class="product__item">
                    <div
                      class="product__item__pic set-bg"
                      data-setbg="img/popular/popular-2.jpg"
                      style="background-image: url()"
                    >
                      <div class="ep">18 / 18</div>
                      <div class="comment">
                        <i class="fa fa-comments"></i> 11
                      </div>
                      <div class="view"><i class="fa fa-eye"></i> 9141</div>
                    </div>
                    <div class="product__item__text">
                      <ul>
                        <li>Active</li>
                        <li>Movie</li>
                      </ul>
                      <h5><a href="#">Kizumonogatari III: Reiket su-hen</a></h5>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                  <div class="product__item">
                    <div
                      class="product__item__pic set-bg"
                      data-setbg="img/popular/popular-3.jpg"
                      style="background-image: url('img/popular/popular-3.jpg')"
                    >
                      <div class="ep">18 / 18</div>
                      <div class="comment">
                        <i class="fa fa-comments"></i> 11
                      </div>
                      <div class="view"><i class="fa fa-eye"></i> 9141</div>
                    </div>
                    <div class="product__item__text">
                      <ul>
                        <li>Active</li>
                        <li>Movie</li>
                      </ul>
                      <h5><a href="#">Shirogane Tamashii hen Kouhan sen</a></h5>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                  <div class="product__item">
                    <div
                      class="product__item__pic set-bg"
                      data-setbg="img/popular/popular-4.jpg"
                      style="background-image: url('img/popular/popular-4.jpg')"
                    >
                      <div class="ep">18 / 18</div>
                      <div class="comment">
                        <i class="fa fa-comments"></i> 11
                      </div>
                      <div class="view"><i class="fa fa-eye"></i> 9141</div>
                    </div>
                    <div class="product__item__text">
                      <ul>
                        <li>Active</li>
                        <li>Movie</li>
                      </ul>
                      <h5>
                        <a href="#">Rurouni Kenshin: Meiji Kenkaku Romantan</a>
                      </h5>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                  <div class="product__item">
                    <div
                      class="product__item__pic set-bg"
                      data-setbg="img/popular/popular-5.jpg"
                      style="background-image: url('img/popular/popular-5.jpg')"
                    >
                      <div class="ep">18 / 18</div>
                      <div class="comment">
                        <i class="fa fa-comments"></i> 11
                      </div>
                      <div class="view"><i class="fa fa-eye"></i> 9141</div>
                    </div>
                    <div class="product__item__text">
                      <ul>
                        <li>Active</li>
                        <li>Movie</li>
                      </ul>
                      <h5><a href="#">Mushishi Zoku Shou 2nd Season</a></h5>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                  <div class="product__item">
                    <div
                      class="product__item__pic set-bg"
                      data-setbg="img/popular/popular-6.jpg"
                      style="background-image: url('img/popular/popular-6.jpg')"
                    >
                      <div class="ep">18 / 18</div>
                      <div class="comment">
                        <i class="fa fa-comments"></i> 11
                      </div>
                      <div class="view"><i class="fa fa-eye"></i> 9141</div>
                    </div>
                    <div class="product__item__text">
                      <ul>
                        <li>Active</li>
                        <li>Movie</li>
                      </ul>
                      <h5><a href="#">Monogatari Series: Second Season</a></h5>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="recent__product">
              <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-8">
                  <div class="section-title">
                    <h4>Recently Added Shows</h4>
                  </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4">
                  <div class="btn__all">
                    <a href="#" class="primary-btn"
                      >View All <span class="arrow_right"></span
                    ></a>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-6">
                  <div class="product__item">
                    <div
                      class="product__item__pic set-bg"
                      data-setbg="img/recent/recent-1.jpg"
                      style="background-image: url('img/recent/recent-1.jpg')"
                    >
                      <div class="ep">18 / 18</div>
                      <div class="comment">
                        <i class="fa fa-comments"></i> 11
                      </div>
                      <div class="view"><i class="fa fa-eye"></i> 9141</div>
                    </div>
                    <div class="product__item__text">
                      <ul>
                        <li>Active</li>
                        <li>Movie</li>
                      </ul>
                      <h5><a href="#">Great Teacher Onizuka</a></h5>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                  <div class="product__item">
                    <div
                      class="product__item__pic set-bg"
                      data-setbg="img/recent/recent-2.jpg"
                      style="background-image: url('img/recent/recent-2.jpg')"
                    >
                      <div class="ep">18 / 18</div>
                      <div class="comment">
                        <i class="fa fa-comments"></i> 11
                      </div>
                      <div class="view"><i class="fa fa-eye"></i> 9141</div>
                    </div>
                    <div class="product__item__text">
                      <ul>
                        <li>Active</li>
                        <li>Movie</li>
                      </ul>
                      <h5>
                        <a href="#"
                          >Fate/stay night Movie: Heaven's Feel - II. Lost</a
                        >
                      </h5>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                  <div class="product__item">
                    <div
                      class="product__item__pic set-bg"
                      data-setbg="img/recent/recent-3.jpg"
                      style="background-image: url('img/recent/recent-3.jpg')"
                    >
                      <div class="ep">18 / 18</div>
                      <div class="comment">
                        <i class="fa fa-comments"></i> 11
                      </div>
                      <div class="view"><i class="fa fa-eye"></i> 9141</div>
                    </div>
                    <div class="product__item__text">
                      <ul>
                        <li>Active</li>
                        <li>Movie</li>
                      </ul>
                      <h5>
                        <a href="#">Mushishi Zoku Shou: Suzu no Shizuku</a>
                      </h5>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                  <div class="product__item">
                    <div
                      class="product__item__pic set-bg"
                      data-setbg="img/recent/recent-4.jpg"
                      style="background-image: url('img/recent/recent-4.jpg')"
                    >
                      <div class="ep">18 / 18</div>
                      <div class="comment">
                        <i class="fa fa-comments"></i> 11
                      </div>
                      <div class="view"><i class="fa fa-eye"></i> 9141</div>
                    </div>
                    <div class="product__item__text">
                      <ul>
                        <li>Active</li>
                        <li>Movie</li>
                      </ul>
                      <h5><a href="#">Fate/Zero 2nd Season</a></h5>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                  <div class="product__item">
                    <div
                      class="product__item__pic set-bg"
                      data-setbg="img/recent/recent-5.jpg"
                      style="background-image: url('img/recent/recent-5.jpg')"
                    >
                      <div class="ep">18 / 18</div>
                      <div class="comment">
                        <i class="fa fa-comments"></i> 11
                      </div>
                      <div class="view"><i class="fa fa-eye"></i> 9141</div>
                    </div>
                    <div class="product__item__text">
                      <ul>
                        <li>Active</li>
                        <li>Movie</li>
                      </ul>
                      <h5><a href="#">Kizumonogatari II: Nekket su-hen</a></h5>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                  <div class="product__item">
                    <div
                      class="product__item__pic set-bg"
                      data-setbg="img/recent/recent-6.jpg"
                      style="background-image: url('img/recent/recent-6.jpg')"
                    >
                      <div class="ep">18 / 18</div>
                      <div class="comment">
                        <i class="fa fa-comments"></i> 11
                      </div>
                      <div class="view"><i class="fa fa-eye"></i> 9141</div>
                    </div>
                    <div class="product__item__text">
                      <ul>
                        <li>Active</li>
                        <li>Movie</li>
                      </ul>
                      <h5>
                        <a href="#">The Seven Deadly Sins: Wrath of the Gods</a>
                      </h5>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="live__product">
              <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-8">
                  <div class="section-title">
                    <h4>Live Action</h4>
                  </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4">
                  <div class="btn__all">
                    <a href="#" class="primary-btn"
                      >View All <span class="arrow_right"></span
                    ></a>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-6">
                  <div class="product__item">
                    <div
                      class="product__item__pic set-bg"
                      data-setbg="img/live/live-1.jpg"
                      style="background-image: url('img/live/live-1.jpg')"
                    >
                      <div class="ep">18 / 18</div>
                      <div class="comment">
                        <i class="fa fa-comments"></i> 11
                      </div>
                      <div class="view"><i class="fa fa-eye"></i> 9141</div>
                    </div>
                    <div class="product__item__text">
                      <ul>
                        <li>Active</li>
                        <li>Movie</li>
                      </ul>
                      <h5><a href="#">Shouwa Genroku Rakugo Shinjuu</a></h5>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                  <div class="product__item">
                    <div
                      class="product__item__pic set-bg"
                      data-setbg="img/live/live-2.jpg"
                      style="background-image: url('img/live/live-2.jpg')"
                    >
                      <div class="ep">18 / 18</div>
                      <div class="comment">
                        <i class="fa fa-comments"></i> 11
                      </div>
                      <div class="view"><i class="fa fa-eye"></i> 9141</div>
                    </div>
                    <div class="product__item__text">
                      <ul>
                        <li>Active</li>
                        <li>Movie</li>
                      </ul>
                      <h5><a href="#">Mushishi Zoku Shou 2nd Season</a></h5>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                  <div class="product__item">
                    <div
                      class="product__item__pic set-bg"
                      data-setbg="img/live/live-3.jpg"
                      style="background-image: url('img/live/live-3.jpg')"
                    >
                      <div class="ep">18 / 18</div>
                      <div class="comment">
                        <i class="fa fa-comments"></i> 11
                      </div>
                      <div class="view"><i class="fa fa-eye"></i> 9141</div>
                    </div>
                    <div class="product__item__text">
                      <ul>
                        <li>Active</li>
                        <li>Movie</li>
                      </ul>
                      <h5>
                        <a href="#">Mushishi Zoku Shou: Suzu no Shizuku</a>
                      </h5>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                  <div class="product__item">
                    <div
                      class="product__item__pic set-bg"
                      data-setbg="img/live/live-4.jpg"
                      style="background-image: url('img/live/live-4.jpg')"
                    >
                      <div class="ep">18 / 18</div>
                      <div class="comment">
                        <i class="fa fa-comments"></i> 11
                      </div>
                      <div class="view"><i class="fa fa-eye"></i> 9141</div>
                    </div>
                    <div class="product__item__text">
                      <ul>
                        <li>Active</li>
                        <li>Movie</li>
                      </ul>
                      <h5>
                        <a href="#">The Seven Deadly Sins: Wrath of the Gods</a>
                      </h5>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                  <div class="product__item">
                    <div
                      class="product__item__pic set-bg"
                      data-setbg="img/live/live-5.jpg"
                      style="background-image: url('img/live/live-5.jpg')"
                    >
                      <div class="ep">18 / 18</div>
                      <div class="comment">
                        <i class="fa fa-comments"></i> 11
                      </div>
                      <div class="view"><i class="fa fa-eye"></i> 9141</div>
                    </div>
                    <div class="product__item__text">
                      <ul>
                        <li>Active</li>
                        <li>Movie</li>
                      </ul>
                      <h5>
                        <a href="#"
                          >Fate/stay night Movie: Heaven's Feel - II. Lost</a
                        >
                      </h5>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                  <div class="product__item">
                    <div
                      class="product__item__pic set-bg"
                      data-setbg="img/live/live-6.jpg"
                      style="background-image: url('img/live/live-6.jpg')"
                    >
                      <div class="ep">18 / 18</div>
                      <div class="comment">
                        <i class="fa fa-comments"></i> 11
                      </div>
                      <div class="view"><i class="fa fa-eye"></i> 9141</div>
                    </div>
                    <div class="product__item__text">
                      <ul>
                        <li>Active</li>
                        <li>Movie</li>
                      </ul>
                      <h5><a href="#">Kizumonogatari II: Nekketsu-hen</a></h5>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 col-sm-8">
            <div class="product__sidebar">
              <div class="product__sidebar__view">
                <div class="section-title">
                  <h5>Mới Cập Nhật</h5>
                </div>

                <div class="filter__gallery" id="MixItUpF5B6EA">
                  <div
                    class="product__sidebar__view__item set-bg mix month week"
                    data-setbg="img/sidebar/tv-2.jpg"
                    style="
                      background-image: url(https://pic6.iqiyipic.com/image/20210502/e8/51/a_100457958_m_601_zh-CN_m2_720_405.jpg);
                    "
                  >
                    <div class="ep">18 / ?</div>
                    <div class="view"><i class="fa fa-eye"></i> 9141</div>
                    <h5>
                      <a href="#">The Seven Deadly Sins: Wrath of the Gods</a>
                    </h5>
                  </div>

                  <div
                    class="product__sidebar__view__item set-bg mix years month"
                    data-setbg="img/sidebar/tv-4.jpg"
                    style="
                      background-image: url(data:image/jpeg;base64,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);
                    "
                  >
                    <div class="ep">18 / ?</div>
                    <div class="view"><i class="fa fa-eye"></i> 9141</div>
                    <h5>
                      <a href="#"
                        >Fate/stay night: Heaven's Feel I. presage flower</a
                      >
                    </h5>
                  </div>
                  <div
                    class="product__sidebar__view__item set-bg mix day"
                    data-setbg="img/sidebar/tv-5.jpg"
                    style="
                      background-image: url(https://themewagon.github.io/anime/img/sidebar/tv-5.jpg);
                    "
                  >
                    <div class="ep">18 / ?</div>
                    <div class="view"><i class="fa fa-eye"></i> 9141</div>
                    <h5>
                      <a href="#">Fate stay night unlimited blade works</a>
                    </h5>
                  </div>
                </div>
              </div>
              <div class="product__sidebar__comment">
                <div class="section-title">
                  <h5>New Comment</h5>
                </div>
                <div class="product__sidebar__comment__item">
                  <div class="product__sidebar__comment__item__pic">
                    <img src="img/sidebar/comment-1.jpg" alt="" />
                  </div>
                  <div class="product__sidebar__comment__item__text">
                    <ul>
                      <li>Active</li>
                      <li>Movie</li>
                    </ul>
                    <h5>
                      <a href="#">The Seven Deadly Sins: Wrath of the Gods</a>
                    </h5>
                    <span><i class="fa fa-eye"></i> 19.141 Viewes</span>
                  </div>
                </div>
                <div class="product__sidebar__comment__item">
                  <div class="product__sidebar__comment__item__pic">
                    <img src="img/sidebar/comment-2.jpg" alt="" />
                  </div>
                  <div class="product__sidebar__comment__item__text">
                    <ul>
                      <li>Active</li>
                      <li>Movie</li>
                    </ul>
                    <h5><a href="#">Shirogane Tamashii hen Kouhan sen</a></h5>
                    <span><i class="fa fa-eye"></i> 19.141 Viewes</span>
                  </div>
                </div>
                <div class="product__sidebar__comment__item">
                  <div class="product__sidebar__comment__item__pic">
                    <img src="img/sidebar/comment-3.jpg" alt="" />
                  </div>
                  <div class="product__sidebar__comment__item__text">
                    <ul>
                      <li>Active</li>
                      <li>Movie</li>
                    </ul>
                    <h5><a href="#">Kizumonogatari III: Reiket su-hen</a></h5>
                    <span><i class="fa fa-eye"></i> 19.141 Viewes</span>
                  </div>
                </div>
                <div class="product__sidebar__comment__item">
                  <div class="product__sidebar__comment__item__pic">
                    <img src="img/sidebar/comment-4.jpg" alt="" />
                  </div>
                  <div class="product__sidebar__comment__item__text">
                    <ul>
                      <li>Active</li>
                      <li>Movie</li>
                    </ul>
                    <h5><a href="#">Monogatari Series: Second Season</a></h5>
                    <span><i class="fa fa-eye"></i> 19.141 Viewes</span>
                  </div>
                </div>
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
import { createToaster } from "@meforma/vue-toaster";
const toaster = createToaster({
  position: "top-right",
});
export default {
  data() {
    return {
      list_loai_phim: [],
      list_the_loai: [],
    };
  },
  mounted() {
   
    this.laydataLoaiPhim();
    this.loaddataTheLoai();
  },
 
  methods: {
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
