<template>
    <div class="container mt-2">
        <Carousel v-bind="config">
          <Slide v-for="slide in 10" :key="slide">
            <div class="carousel__item" :style="{ backgroundImage: `url(https://picsum.photos/id/${slide}/1140/585)` }">
              <div class="hero__text">
                <h2 class="carousel__button">Doctor Who</h2>
                <p>Với khả năng du hành vượt thời gian và không gian, Chúa tể thời gian - Doctor thứ 15 bắt...</p>
                <button class="carousel__button">Xem ngay</button>
              </div>
            </div>
          </Slide>

          <template #addons>
            <Navigation class="carousel__navigation">
              <button class="prev"><i class="fa fa-chevron-left"></i></button>
              <button class="next"><i class="fa fa-chevron-right"></i></button>
            </Navigation>
            <pagination class="custom-pagination" />
          </template>
        </Carousel>
    </div>
  </template>


<script setup>
import 'vue3-carousel/dist/carousel.css';
import { Carousel, Slide, Navigation } from 'vue3-carousel';

const config = {
    // autoplay: 2000,
    wrapAround: true,
    pauseAutoplayOnHover: true,
};
</script>
<style scoped>
.carousel__item {
  display: flex;
  align-items: center;
  justify-content: center; /* Center the text horizontally */
  height: 585px;
  width: 1140px;
  background-size: cover;
  background-position: center;
  position: relative;
  border-radius: 12px;
  box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.3);
  overflow: hidden;
}

.carousel__item::before {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.3); /* Reduced opacity */
  border-radius: 12px;
  z-index: 1;
}

.hero__text {
  position: relative; /* Changed from absolute to relative */
  color: white;
  z-index: 3; /* Ensure text appears on top of the overlay */
  text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7); /* Add text shadow for better readability */
  text-align: center; /* Center the text */
}

.hero__text h2 {
  font-size: 36px;
  font-weight: bold;
  margin: 0;
}

.hero__text p {
  font-size: 18px;
  margin: 10px 0;
}

.carousel__button {
  background-color: #e53637;
  border: none;
  border-radius: 8px;
  padding: 12px 25px;
  color: white;
  font-size: 18px;
  font-weight: bold;
  cursor: pointer;
  transition: background-color 0.3s, transform 0.2s;
  box-shadow: 0px 4px 15px rgba(229, 54, 55, 0.3);
  z-index: 3; /* Ensures button is visible above overlay */
}

.carousel__button:hover {
  background-color: #c1282d;
  transform: scale(1.05);
}

.carousel__button:active {
  transform: scale(1);
}
</style>

