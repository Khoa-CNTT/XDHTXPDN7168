// store.js
import { createStore } from 'vuex';

const store = createStore({
  state: {
    currentPage: 1,
    itemsPerPage: 12,
    list_9_phim: [] // Dữ liệu danh sách 9 phim bạn muốn hiển thị
  },
  mutations: {
    setPage(state, page) {
      state.currentPage = page;
    },
    setList_9_Phim(state, data) {
      state.list_9_phim = data;
    }
  },
  getters: {
    paginatedData: (state) => {
      const startIndex = (state.currentPage - 1) * state.itemsPerPage;
      const endIndex = startIndex + state.itemsPerPage;
      return state.list_9_phim.slice(startIndex, endIndex);
    },
    totalPages: (state) => {
      return Math.ceil(state.list_9_phim.length / state.itemsPerPage);
    }
  }
});

export default store;
