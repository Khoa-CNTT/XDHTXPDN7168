<template>
    <section class="product-page spad" style="background-color: #0b0c2a">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="product__page__content">
                        <!-- Thanh tìm kiếm -->
                        <div class="search-header mb-4">
                            <h5 class="text-white mb-0">
                                <i class="fa fa-search me-2"></i>
                                Kết quả tìm kiếm: "{{ key_tim.key.substring(0, 30) }}..."
                            </h5>
                            <div class="results-count" v-if="pagination.total">
                                <span class="text-white">Tìm thấy <strong class="text-danger">{{ pagination.total }}</strong> kết quả</span>
                            </div>
                        </div>

                        <!-- Thanh bộ lọc -->
                        <div class="filter-bar mb-4">
                            <div class="filter-bar-inner">
                                <!-- Thể Loại -->
                                <div class="filter-dropdown">
                                    <button class="filter-btn" type="button" id="genreDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fa fa-tags me-2"></i>Thể Loại
                                        <i class="fa fa-chevron-down ms-2"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="genreDropdown">
                                        <div class="px-3 py-2 genre-container">
                                            <div v-for="genre in listTheLoai" :key="genre.id" class="form-check">
                                                <input class="form-check-input" type="checkbox"
                                                    :value="genre.id"
                                                    v-model="selectedFilters.theLoai"
                                                    @change="applyFilters"
                                                    :id="'genre-' + genre.id">
                                                <label class="form-check-label text-white" :for="'genre-' + genre.id">
                                                    {{ genre.ten_the_loai }}
                                                </label>
                                            </div>
                                        </div>
                                    </ul>
                                </div>
                                <div class="filter-dropdown">
                                    <button class="filter-btn" type="button" id="genreDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fa fa-tags me-2"></i>Loại Phim
                                        <i class="fa fa-chevron-down ms-2"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="genreDropdown">
                                        <div class="px-3 py-2 genre-container">
                                            <div v-for="loaiPhim in listLoaiPhim" :key="loaiPhim.id" class="form-check">
                                                <input class="form-check-input" type="checkbox"
                                                    :value="loaiPhim.id"
                                                    v-model="selectedFilters.loaiPhim"
                                                    @change="applyFilters"
                                                    :id="'loaiPhim-' + loaiPhim.id">
                                                <label class="form-check-label text-white" :for="'loaiPhim-' + loaiPhim.id">
                                                    {{ loaiPhim.ten_loai_phim }}
                                                </label>
                                            </div>
                                        </div>
                                    </ul>
                                </div>

                                <!-- Trạng Thái -->
                                <div class="filter-dropdown">
                                    <button class="filter-btn" type="button" id="statusDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fa fa-clock me-2"></i>Trạng Thái
                                        <i class="fa fa-chevron-down ms-2"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="statusDropdown">
                                        <li><a class="dropdown-item" @click="selectStatus('all')" :class="{ active: selectedFilters.trangThai === 'all' }">
                                            <i class="fa" :class="selectedFilters.trangThai === 'all' ? 'fa-dot-circle' : 'fa-circle'"></i> Tất cả
                                        </a></li>
                                        <li><a class="dropdown-item" @click="selectStatus('full')" :class="{ active: selectedFilters.trangThai === 'full' }">
                                            <i class="fa" :class="selectedFilters.trangThai === 'full' ? 'fa-dot-circle' : 'fa-circle'"></i> Hoàn thành
                                        </a></li>
                                        <li><a class="dropdown-item" @click="selectStatus('ongoing')" :class="{ active: selectedFilters.trangThai === 'ongoing' }">
                                            <i class="fa" :class="selectedFilters.trangThai === 'ongoing' ? 'fa-dot-circle' : 'fa-circle'"></i> Đang chiếu
                                        </a></li>
                                    </ul>
                                </div>

                                <!-- Sắp xếp -->
                                <div class="filter-dropdown">
                                    <button class="filter-btn" type="button" id="sortDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fa fa-sort me-2"></i>Sắp xếp
                                        <i class="fa fa-chevron-down ms-2"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="sortDropdown">
                                        <li><a class="dropdown-item" @click="selectSort('newest')" :class="{ active: selectedFilters.sortBy === 'newest' }">
                                            <i class="fa fa-check me-2" v-if="selectedFilters.sortBy === 'newest'"></i><span v-else class="me-4"></span> Mới nhất
                                        </a></li>
                                        <li><a class="dropdown-item" @click="selectSort('most_viewed')" :class="{ active: selectedFilters.sortBy === 'most_viewed' }">
                                            <i class="fa fa-check me-2" v-if="selectedFilters.sortBy === 'most_viewed'"></i><span v-else class="me-4"></span> Xem nhiều
                                        </a></li>
                                        <li><a class="dropdown-item" @click="selectSort('name_asc')" :class="{ active: selectedFilters.sortBy === 'name_asc' }">
                                            <i class="fa fa-check me-2" v-if="selectedFilters.sortBy === 'name_asc'"></i><span v-else class="me-4"></span> A-Z
                                        </a></li>
                                        <li><a class="dropdown-item" @click="selectSort('name_desc')" :class="{ active: selectedFilters.sortBy === 'name_desc' }">
                                            <i class="fa fa-check me-2" v-if="selectedFilters.sortBy === 'name_desc'"></i><span v-else class="me-4"></span> Z-A
                                        </a></li>
                                    </ul>
                                </div>

                                <!-- Đặt lại -->
                                <button class="reset-btn" @click="resetFilters">
                                    <i class="fa fa-redo-alt me-2"></i>Đặt lại
                                </button>
                            </div>
                        </div>

                        <!-- Bộ lọc đang áp dụng -->
                        <div class="active-filters mb-4" v-if="hasActiveFilters">
                            <div class="active-filters-header">
                                <span class="text-white">Bộ lọc đang áp dụng:</span>
                                <button class="clear-all-btn" @click="resetFilters">
                                    <i class="fas fa-times me-1"></i>Xóa tất cả
                                </button>
                            </div>
                            <div class="filter-tags">
                                <span v-for="filter in activeFiltersDisplay" 
                                    :key="filter.id" 
                                    class="filter-tag">
                                    {{ filter.name }}
                                    <i class="fas fa-times" @click="removeFilter(filter.type, filter.id)"></i>
                                </span>
                            </div>
                        </div>

                        <!-- Loading State -->
                        <div v-if="isLoading" class="text-center py-5">
                            <div class="loading-animation mb-4">
                                <div class="spinner">
                                    <div class="double-bounce1"></div>
                                    <div class="double-bounce2"></div>
                                </div>
                            </div>
                            <h5 class="text-white mb-2">Đang tìm kiếm...</h5>
                            <p class="text-muted">Vui lòng đợi trong giây lát</p>
                        </div>

                        <!-- No Results -->
                        <div v-else-if="!isLoading && (!list_phim || list_phim.length === 0)" 
                            class="no-results text-center py-5">
                            <div class="no-results-icon mb-4">
                                <i class="fas fa-search fa-4x text-muted"></i>
                            </div>
                            <h4 class="text-white mb-3">Không tìm thấy kết quả</h4>
                            <p class="text-muted mb-4">
                                Không tìm thấy kết quả nào cho từ khóa "{{ key_tim.key.substring(0, 30) }}..."
                            </p>
                            <div class="suggestions">
                                <h6 class="text-white mb-3">Gợi ý:</h6>
                                <ul class="list-unstyled text-white">
                                    <li><i class="fas fa-check-circle me-2"></i>Kiểm tra lỗi chính tả</li>
                                    <li><i class="fas fa-check-circle me-2"></i>Sử dụng ít từ khóa hơn</li>
                                    <li><i class="fas fa-check-circle me-2"></i>Thử tìm kiếm với từ khóa khác</li>
                                </ul>
                            </div>
                        </div>

                        <!-- Danh sách phim -->
                        <div v-else class="row">
                            <template v-for="(v, k) in list_phim" :key="k">
                                <div v-show="v.tong_tap > 0" class="col-lg-3 col-md-4 col-sm-6 col-6">
                                    <router-link :to="`/${v.slug_phim}`">
                                        <div class="product__item">
                                            <div class="product__item__pic set-bg"
                                                style="background-image: url('undefined')">
                                                <a><img style="height: 105%; width: 275px" v-bind:src="v.hinh_anh" loading="lazy"
                                                        alt="" /></a>
                                                <div class="ep">{{ v.tong_tap }}/{{ v.so_tap_phim }}
                                                    <span v-if="v.tong_tap == v.so_tap_phim">FULL</span>
                                                </div>
                                                <div class="comment b">{{ v.ten_loai_phim }}</div>
                                                <div class="view"><i class="fa fa-eye"></i> {{ v.tong_luot_xem }}
                                                </div>
                                            </div>
                                            <div class="product__item__text">
                                                <ul>
                                                    <template v-for="(item, key) in v.ten_the_loais" :key="key">
                                                        <li v-show="key < 3">{{ item }}</li>
                                                    </template>
                                                </ul>

                                                <h5>
                                                    <a href="http://127.0.0.1:8002/dai-tieu-thu-vuot-qua-chong-gai">{{
                                                        tenPhimLimited(v.ten_phim) }}</a>
                                                </h5>
                                            </div>
                                        </div>
                                    </router-link>
                                </div>
                            </template>
                        </div>

                        <!-- Phân trang -->
                        <div class="product__pagination text-center">
                        <a @click="changPage(1)" type="button"><i class="fa fa-angle-double-left"></i></a>

                        <a type="button" :class="{ current_page: page === pagination.current_page }"
                            v-for="page in pageNumbers" :key="page" @click="page !== '...' && changPage(page)">
                            {{ page }}
                        </a>

                        <a @click="changPage(pagination.last_page)" type="button"><i
                                class="fa fa-angle-double-right"></i></a>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
<script>
import axios from "axios"
import baseRequest from '../../../core/baseRequestUser';
import { createToaster } from "@meforma/vue-toaster";
import { getPageNumbers } from "../../../core/paginationUtils.js";
const toaster = createToaster({
    position: "top-right",
});

export default {
    data() {
        return {
            key_tim: { key: this.$route.params.id },
            list_phim: [],
            pagination: {
                last_page: 1,
                per_page: 20,
                current_page: 1,
                from: 0,
                to: 0,
                total: 0
            },
            check_page: 0,
            listTheLoai: [],
            listLoaiPhim: [],
            selectedFilters: {
                theLoai: [],
                loaiPhim: [],
                trangThai: 'all',
                sortBy: 'newest'
            },
            isLoading: false,
            dropdowns: {
                genre: false,
                status: false,
                sort: false
            }
        };
    },

    mounted() {
        this.loadInitialData();
        document.addEventListener('click', this.closeDropdowns);
    },
    
    computed: {
        pageNumbers() {
            return getPageNumbers(this.pagination);
        },
        hasActiveFilters() {
            return this.selectedFilters.theLoai.length > 0 || 
                   this.selectedFilters.loaiPhim.length > 0 || 
                   this.selectedFilters.trangThai !== 'all' ||
                   this.selectedFilters.sortBy !== 'newest';
        },
        activeFiltersDisplay() {
            let filters = [];
            
            // Thể loại
            this.selectedFilters.theLoai.forEach(id => {
                const theLoai = this.listTheLoai.find(tl => tl.id === id);
                if (theLoai) {
                    filters.push({
                        type: 'theLoai',
                        id: id,
                        name: theLoai.ten_the_loai
                    });
                }
            });

            // Loại phim
            this.selectedFilters.loaiPhim.forEach(id => {
                const loaiPhim = this.listLoaiPhim.find(lp => lp.id === id);
                if (loaiPhim) {
                    filters.push({
                        type: 'loaiPhim',
                        id: id,
                        name: loaiPhim.ten_loai_phim
                    });
                }
            });

            // Trạng thái
            if (this.selectedFilters.trangThai !== 'all') {
                filters.push({
                    type: 'trangThai',
                    id: this.selectedFilters.trangThai,
                    name: this.selectedFilters.trangThai === 'full' ? 'Hoàn thành' : 'Đang chiếu'
                });
            }
            
            // Sắp xếp
            if (this.selectedFilters.sortBy !== 'newest') {
                let sortName = '';
                switch(this.selectedFilters.sortBy) {
                    case 'most_viewed': sortName = 'Xem nhiều'; break;
                    case 'name_asc': sortName = 'A-Z'; break;
                    case 'name_desc': sortName = 'Z-A'; break;
                }
                
                if (sortName) {
                    filters.push({
                        type: 'sortBy',
                        id: this.selectedFilters.sortBy,
                        name: 'Sắp xếp: ' + sortName
                    });
                }
            }

            return filters;
        }
    },
    
    methods: {
        tenPhimLimited(tenphim) {
            return tenphim.length > 42 ? tenphim.substring(0, 42) + '...' : tenphim;
        },
        
        changPage(page) {
            if (page !== this.pagination.current_page) {
                this.searchPhim(page);
                // Cuộn lên đầu trang khi chuyển trang
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            }
        },
        
        async loadInitialData() {
            try {
                this.$store.dispatch('showLoader');
                this.isLoading = true;
                await Promise.all([
                    this.loadTheLoai(),
                    this.loadLoaiPhim(),
                    this.searchPhim()
                ]);
            } catch (error) {
                console.error('Error loading initial data:', error);
                toaster.error('Có lỗi xảy ra khi tải dữ liệu');
            } finally {
                this.$store.dispatch('hideLoader');
                this.isLoading = false;
            }
        },
        
        async loadTheLoai() {
            const response = await baseRequest.get('lay-data-the-loai-home');
            this.listTheLoai = response.data.the_loai;
        },
        
        async loadLoaiPhim() {
            const response = await baseRequest.get('lay-data-loai-phim-home');
            this.listLoaiPhim = response.data.loai_phim_home;
        },
        
        async searchPhim(page = 1) {
            try {
                this.isLoading = true;
                const params = {
                    ...this.key_tim,
                    page,
                    filters: this.selectedFilters
                };

                const response = await baseRequest.post(
                    "phim/load-thong-tin-tim",
                    params
                );

                this.pagination = response.data.phim.pagination;
                this.list_phim = response.data.phim.dataPhim.data;
                this.list_phim.forEach(value => {
                    value.ten_the_loais = value.ten_the_loais.split(',');
                });
            } catch (error) {
                console.error('Error searching movies:', error);
                toaster.error('Có lỗi xảy ra khi tìm kiếm phim');
            } finally {
                this.isLoading = false;
            }
        },
        
        applyFilters() {
            this.isLoading = true;
            try {
                // Đóng tất cả dropdown khi áp dụng bộ lọc
                Object.keys(this.dropdowns).forEach(key => {
                    this.dropdowns[key] = false;
                });
                this.searchPhim(1); // Reset về trang 1 khi áp dụng bộ lọc
            } finally {
                this.isLoading = false;
            }
        },
        
        resetFilters() {
            this.selectedFilters = {
                theLoai: [],
                loaiPhim: [],
                trangThai: 'all',
                sortBy: 'newest'
            };
            this.applyFilters();
        },
        
        removeFilter(type, id) {
            if (type === 'theLoai') {
                this.selectedFilters.theLoai = this.selectedFilters.theLoai.filter(x => x !== id);
            } else if (type === 'loaiPhim') {
                this.selectedFilters.loaiPhim = this.selectedFilters.loaiPhim.filter(x => x !== id);
            } else if (type === 'trangThai') {
                this.selectedFilters.trangThai = 'all';
            } else if (type === 'sortBy') {
                this.selectedFilters.sortBy = 'newest';
            }
            this.applyFilters();
        },
        
        toggleDropdown(type) {
            // Đóng các dropdown khác
            Object.keys(this.dropdowns).forEach(key => {
                if (key !== type) this.dropdowns[key] = false;
            });
            // Chuyển đổi trạng thái dropdown hiện tại
            this.dropdowns[type] = !this.dropdowns[type];
        },
        
        // Đóng dropdown khi click bên ngoài
        closeDropdowns(event) {
            if (!event.target.closest('.filter-dropdown')) {
                Object.keys(this.dropdowns).forEach(key => {
                    this.dropdowns[key] = false;
                });
            }
        },
        
        selectStatus(status) {
            this.selectedFilters.trangThai = status;
            this.applyFilters();
        },
        
        selectSort(sort) {
            this.selectedFilters.sortBy = sort;
            this.applyFilters();
        }
    },
    
    beforeDestroy() {
        document.removeEventListener('click', this.closeDropdowns);
    }
};
</script>
<style scoped>
/* Thanh tìm kiếm */
.search-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px 20px;
    background: rgba(255, 255, 255, 0.05);
    border-radius: 8px;
}

.search-header h5 {
    margin: 0;
    font-weight: 500;
}

.results-count {
    color: #e53637;
    font-weight: 500;
}

/* Thanh bộ lọc */
.filter-bar {
    background: rgba(255, 255, 255, 0.05);
    border-radius: 8px;
    padding: 15px;
}

.filter-bar-inner {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
}

/* Dropdown bộ lọc */
.filter-dropdown {
    position: relative;
}

.filter-btn {
    display: flex;
    align-items: center;
    background-color: rgba(0, 0, 0, 0.2);
    color: white;
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 6px;
    padding: 10px 15px;
    font-size: 14px;
    cursor: pointer;
    transition: all 0.2s ease;
}

.filter-btn:hover {
    background-color: rgba(0, 0, 0, 0.4);
    border-color: rgba(255, 255, 255, 0.2);
}

.dropdown-menu {
    min-width: 220px;
    background-color: #1c1c3a;
    border: 1px solid rgba(255, 255, 255, 0.1);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    padding: 0;
    margin-top: 5px;
}

.dropdown-item {
    padding: 10px 15px;
    color: white;
    cursor: pointer;
    display: flex;
    align-items: center;
    transition: background-color 0.2s ease;
}

.dropdown-item:hover {
    background-color: rgba(255, 255, 255, 0.1);
}

.dropdown-item.active {
    background-color: rgba(229, 54, 55, 0.2);
    color: #e53637;
}

.dropdown-item i {
    width: 16px;
    margin-right: 8px;
}

/* Container thể loại */
.genre-container {
    max-height: 300px;
    overflow-y: auto;
}

.form-check {
    margin-bottom: 8px;
}

.form-check-input {
    margin-top: 0.3em;
}

.form-check-input:checked {
    background-color: #e53637;
    border-color: #e53637;
}

.form-check-label {
    cursor: pointer;
    font-size: 14px;
}

/* Nút đặt lại */
.reset-btn {
    display: flex;
    align-items: center;
    background-color: #e53637;
    color: white;
    border: none;
    border-radius: 6px;
    padding: 10px 15px;
    font-size: 14px;
    cursor: pointer;
    transition: all 0.2s ease;
}

.reset-btn:hover {
    background-color: #c62828;
}

/* Bộ lọc đang áp dụng */
.active-filters {
    background: rgba(255, 255, 255, 0.03);
    border-radius: 6px;
    padding: 15px;
    border-left: 3px solid #e53637;
}

.active-filters-header {
    display: flex;
    justify-content: space-between; 
    align-items: center;
    margin-bottom: 10px;
}

.clear-all-btn {
    background: none;
    border: none;
    color: white;
    cursor: pointer;
}

.filter-tags {
    display: flex;
    flex-wrap: wrap;
    gap: 5px;
}

.filter-tag {
    background-color: rgba(255, 255, 255, 0.1); 
    padding: 5px 10px;
    border-radius: 4px;
    font-size: 14px;
    color: white;
}

.filter-tag i {
    cursor: pointer;
    margin-left: 5px;
}

.filter-tag i:hover {
    color: #e53637;
}

/* Loading Animation */
.spinner {
    width: 60px;
    height: 60px;
    position: relative;
    margin: 0 auto;
}

.double-bounce1, .double-bounce2 {
    width: 100%;
    height: 100%;
    border-radius: 50%;
    background-color: #e53637;
    opacity: 0.6;
    position: absolute;
    top: 0;
    left: 0;
    animation: sk-bounce 2.0s infinite ease-in-out;
}

.double-bounce2 {
    animation-delay: -1.0s;
}

@keyframes sk-bounce {
    0%, 100% { 
        transform: scale(0.0);
    } 
    50% { 
        transform: scale(1.0);
    }
}

/* No Results Styling */
.no-results {
    background: rgba(255, 255, 255, 0.05);
    border-radius: 12px;
    padding: 3rem;
}

.no-results-icon {
    color: #e53637;
    opacity: 0.5;
    animation: pulse 2s infinite;
}

.suggestions {
    max-width: 400px;
    margin: 0 auto;
}

.suggestions li {
    margin-bottom: 10px;
    opacity: 0.8;
    transition: all 0.3s ease;
}

.suggestions li:hover {
    opacity: 1;
    transform: translateX(5px);
}

.suggestions i {
    color: #28a745;
}

@keyframes pulse {
    0% {
        transform: scale(1);
        opacity: 0.5;
    }
    50% {
        transform: scale(1.05);
        opacity: 0.7;
    }
    100% {
        transform: scale(1);
        opacity: 0.5;
    }
}

@media (max-width: 768px) {
    .no-results {
        padding: 2rem;
    }
    
    .spinner {
        width: 50px;
        height: 50px;
    }
    
    .no-results-icon i {
        font-size: 3em;
    }
}

</style>    
