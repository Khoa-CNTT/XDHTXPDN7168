// store.js
import { h } from "vue";
import { notification } from "ant-design-vue";
import {
  CheckCircleOutlined,
  CloseCircleOutlined,
  ExclamationCircleOutlined,
  InfoCircleOutlined,
} from "@ant-design/icons-vue";
import { createStore } from "vuex";

const store = createStore({
  state: {
    isLoading: false,
    avatarUrl: localStorage.getItem("avt_admin"),
  },
  mutations: {
    setLoading(state, loading) {
      state.isLoading = loading;
    },
    setAvatar(state, avatarUrl) {
      state.avatarUrl = avatarUrl;
    },
  },
  actions: {
    updateAvatar({ commit }, avatarUrl) {
      commit("setAvatar", avatarUrl);
    },
    showLoader({ commit }) {
      commit("setLoading", true);
    },
    hideLoader({ commit }) {
      commit("setLoading", false);
    },
    showSuccess(_, { description }) {
      notification.open({
        message: "Success",
        description,
        icon: h(CheckCircleOutlined, { style: { color: "#52c41a" } }),
        style: {
          border: "1px solid #b7eb8f",
          backgroundColor: "#f6ffed",
        },
      });
    },
    showError(_, { description }) {
      notification.open({
        message: "Error",
        description,
        icon: h(CloseCircleOutlined, { style: { color: "#f5222d" } }),
        style: {
          border: "1px solid #ffa39e",
          backgroundColor: "#fff1f0",
        },
      });
    },
    showWarning(_, { description }) {
      notification.open({
        message: "Warning",
        description,
        icon: h(ExclamationCircleOutlined, { style: { color: "#faad14" } }),
        style: {
          border: "1px solid #ffe58f",
          backgroundColor: "#fffbe6",
        },
      });
    },
    showInfo(_, { description }) {
      notification.open({
        message: "Info",
        description,
        icon: h(InfoCircleOutlined, { style: { color: "#1890ff" } }),
        style: {
          border: "1px solid #91d5ff",
          backgroundColor: "#e6f7ff",
        },
      });
    },
  },
});

export default store;
