<template>
  <div class="chatbot-container">
    <!-- Circular button when closed -->
    <div v-if="!isOpen" class="chatbot-button" @click="toggleChat">
      <div class="chatbot-icon">
        <img src="https://pics.craiyon.com/2023-06-08/8f12f7763653463289268bdca7185690.webp" alt="Chat Icon"
          class="custom-icon" />
      </div>
    </div>

    <!-- Full chatbot when open -->
    <div v-if="isOpen" class="chatbot-panel">
      <div class="chatbot-header">
        <div class="chatbot-title">
          <img src="https://pics.craiyon.com/2023-06-08/8f12f7763653463289268bdca7185690.webp" alt="Chat Icon"
            class="icon-small custom-icon" />
          <span>Trợ Lý WOPAI</span>
        </div>
        <div class="mode-toggle">
          <button 
            @click="switchMode('movie')" 
            class="mode-button" 
            :class="{ 'active': chatMode === 'movie' }">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="icon-small">
              <path d="M18 4l2 4h-3l-2-4h-2l2 4h-3l-2-4H8l2 4H7L5 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V4h-4z"/>
            </svg>
            <span>Phim</span>
          </button>
          <button 
            @click="switchMode('vip')" 
            class="mode-button" 
            :class="{ 'active': chatMode === 'vip' }">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="icon-small">
              <path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm0 10.99h7c-.53 4.12-3.28 7.79-7 8.94V12H5V6.3l7-3.11v8.8z"/>
            </svg>
            <span>VIP</span>
          </button>
        </div>
        <div class="chatbot-actions">
          <button class="action-button" @click="clearChat" title="Xóa lịch sử">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="icon-small">
              <path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z"/>
            </svg>
          </button>
          <button class="action-button minimize-button" @click="minimizeChat">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="icon-small">
              <path d="M19 13H5v-2h14v2z" />
            </svg>
          </button>
          <button class="action-button" @click="toggleChat">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="icon-small">
              <path
                d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z" />
            </svg>
          </button>
        </div>
      </div>

      <div v-if="preferences.genres.length > 0 || preferences.liked_movies.length > 0" class="preference-tags">
        <div v-if="preferences.genres.length > 0" class="preference-section">
          <span class="preference-label">Thể loại yêu thích:</span>
          <div class="tag-container">
            <span v-for="(genre, index) in preferences.genres" :key="'genre-'+index" class="preference-tag">
              {{ genre }}
              <button @click="removePreference('genre', genre)" class="remove-tag">×</button>
            </span>
          </div>
        </div>
        <div v-if="preferences.liked_movies.length > 0" class="preference-section">
          <span class="preference-label">Phim đã thích:</span>
          <div class="tag-container">
            <span v-for="(movie, index) in likedMovieTitles" :key="'movie-'+index" class="preference-tag">
              {{ movie }}
              <button @click="removePreference('movie', preferences.liked_movies[index])" class="remove-tag">×</button>
            </span>
          </div>
        </div>
      </div>

      <div class="chatbot-messages" ref="messagesContainer">
        <div v-if="messages.length === 0" class="welcome-message">
          <h3>Xin chào! 👋</h3>
          <p v-if="chatMode === 'movie'">
            Tôi là trợ lý phim thông minh. Tôi có thể giúp bạn tìm kiếm phim và đề xuất các bộ phim phù hợp với sở
            thích của bạn.
          </p>
          <p v-else>
            Tôi là trợ lý dịch vụ VIP. Tôi có thể giúp bạn tìm hiểu về các gói dịch vụ VIP và các ưu đãi đặc biệt.
          </p>
          <div v-if="chatMode === 'movie'" class="suggestion-chips">
            <button @click="quickReply('Đề xuất phim hành động')" class="chip">Phim hành động</button>
            <button @click="quickReply('Đề xuất phim tình cảm')" class="chip">Phim tình cảm</button>
            <button @click="quickReply('Phim lẻ hay nhất')" class="chip">Phim lẻ hay</button>
            <button @click="quickReply('Đề xuất phim kinh dị')" class="chip">Phim kinh dị</button>
          </div>
          <div v-else class="suggestion-chips">
            <button @click="quickReply('Thông tin gói VIP')" class="chip">Gói VIP</button>
            <button @click="quickReply('Ưu đãi đặc biệt')" class="chip">Ưu đãi</button>
          </div>
        </div>

        <transition-group name="message-transition">
          <div v-for="(msg, index) in messages" :key="index" class="message"
            :class="{ 'user-message': msg.sender === 'Bạn', 'bot-message': msg.sender === 'Bot' }">
            <div class="message-content">
              <div v-if="msg.sender === 'Bot'" class="bot-avatar">
                <img src="https://pics.craiyon.com/2023-06-08/8f12f7763653463289268bdca7185690.webp" alt="Bot Avatar"
                  class="custom-icon" />
              </div>
              <div class="message-bubble">
                
                <div v-if="msg.sender === 'Bot'">
                  <div v-if="hasMovieRecommendations(msg.text)" class="movie-recommendations">
                    <h3 v-if="getMovieRecommendationTitle(msg.text)" class="recommendation-title">
                      {{ getMovieRecommendationTitle(msg.text) }}
                    </h3>

                    <div v-if="getMovieIntroduction(msg.text)" class="movie-introduction">
                      {{ getMovieIntroduction(msg.text) }}
                    </div>

                    <div v-for="(movie, movieIndex) in extractMovies(msg.text)" :key="movieIndex" class="movie-card">
                      <div class="movie-image">
                        <img v-if="movie.image" :src="movie.image" :alt="movie.title" class="movie-poster" />
                      </div>
                      <div class="movie-details">
                        <h4 class="movie-title">{{ movie.title }}</h4>
                        <div class="movie-meta">
                          <span v-if="movie.year" class="movie-year">{{ movie.year }}</span>
                          <span v-if="movie.genre" class="movie-genre">{{ movie.genre }}</span>
                          <span v-if="movie.type" class="movie-type">{{ movie.type }}</span>
                        </div>
                        <p v-if="movie.summary" class="movie-summary">{{ movie.summary }}</p>
                        <div class="movie-actions">
                          <a v-if="movie.link" :href="movie.link" target="_blank" class="movie-link">Xem phim</a>
                          <button @click="likeMovie(movie.title, getMovieId(movie))" class="movie-action-btn like-btn"
                            :class="{ 'liked': isMovieLiked(getMovieId(movie)) }">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="icon-small">
                              <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                            </svg>
                          </button>
                        </div>
                      </div>
                    </div>

                    <div class="chat-question" v-if="getQuestion(msg.text)">
                      {{ getQuestion(msg.text) }}
                    </div>
                  </div>
                  <div v-else-if="msg.is_markdown" class="markdown-content" v-html="renderMarkdown(msg.text)"></div>
                  <div v-else class="plain-text">{{ msg.text }}</div>
                </div>
                <div v-else>{{ msg.text }}</div>
              </div>
            </div>
            <div class="message-time">{{ msg.time }}</div>
          </div>
        </transition-group>

        <div v-if="isTyping" class="typing-indicator">
          <div class="typing-dot"></div>
          <div class="typing-dot"></div>
          <div class="typing-dot"></div>
        </div>
      </div>

      <div class="chatbot-input">
        <input v-model="userInput" @keyup.enter="sendMessage" :placeholder="getInputPlaceholder()" class="input-field"
          ref="inputField" />
        <button @click="sendMessage" class="send-button" :disabled="!userInput.trim() || isTyping">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="icon-small">
            <path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z" />
          </svg>
        </button>
      </div>
      <div class="chatbot-footer">
        <div class="powered-by">
          <span>Powered by @vietvo371</span>
        </div>
        <div class="chatbot-actions-footer">
          <span class="footer-action" @click="clearChat">Xóa lịch sử</span>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { marked } from 'marked';
import DOMPurify from 'dompurify';
import Api from '@meforma/vue-toaster/src/api';

export default {
  data() {
    return {
      isOpen: false,
      isMinimized: false,
      userInput: "",
      messages: [],
      chatHistory: [],
      preferences: {
        liked_movies: [],
        disliked_movies: [],
        genres: [],
        film_types: [],
        mentioned_movies: []
      },
      isTyping: false,
      chatMode: 'movie', // 'movie' or 'vip'
      apiEndpoint: import.meta.env.VITE_CHATBOT_API,
      movieGenres: [],
      sessionId: null,
      movieIdMap: {} // Map để lưu trữ ID phim
    };
  },
  computed: {
    likedMovieTitles() {
      // Chuyển đổi movie_id thành tiêu đề
      return this.preferences.liked_movies.map(id => {
        // Tìm tiêu đề trong movieIdMap
        for (const [title, movieId] of Object.entries(this.movieIdMap)) {
          if (movieId === id) return title;
        }
        return `Phim #${id}`;
      });
    }
  },
  mounted() {
    // Khởi tạo session
    this.initSession();
    
    // Cấu hình marked với các tùy chọn nâng cao
    this.setupMarked();
    
    // Khôi phục tin nhắn từ localStorage
    this.loadChatFromStorage();

    // Focus input field khi chat mở
    this.$watch('isOpen', (isOpen) => {
      if (isOpen) {
        this.$nextTick(() => {
          if (this.$refs.inputField) {
            this.$refs.inputField.focus();
          }
        });
      }
    });

    // Thêm phím tắt để đóng/mở chat (Esc)
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape' && this.isOpen) {
        this.toggleChat();
      }
    });

    // Lấy danh sách thể loại phim từ API
    this.fetchGenres();
  },
  watch: {
    messages: {
      deep: true,
      handler(newMessages) {
        localStorage.setItem('chatMessages', JSON.stringify(newMessages));
        this.$nextTick(() => {
          this.scrollToBottom();
        });
      }
    },
    movie_id: {
      deep: true,
      handler(newPreferences) {
        localStorage.setItem('chatPreferences', JSON.stringify(newPreferences));
      }
    },
    chatMode(newMode) {
      localStorage.setItem('chatMode', newMode);
    }
  },
  methods: {
    // Khởi tạo session
    initSession() {
      // Kiểm tra session ID từ cookie
      this.sessionId = this.getCookie('session_id');
      
      // Nếu không có, thực hiện request đầu tiên để khởi tạo session
      if (!this.sessionId) {
        this.fetchInitialSession();
      } else {
        console.log("Đã tìm thấy session ID:", this.sessionId);
        // Tải sở thích người dùng từ server
        this.fetchUserPreferences();
      }
    },
    
    // Lấy giá trị cookie
    getCookie(name) {
      const value = `; ${document.cookie}`;
      const parts = value.split(`; ${name}=`);
      if (parts.length === 2) return parts.pop().split(';').shift();
      return null;
    },
    
    // Thiết lập cookie
    setCookie(name, value, days) {
      const date = new Date();
      date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
      const expires = `expires=${date.toUTCString()}`;
      document.cookie = `${name}=${value};${expires};path=/;SameSite=Lax`;
    },
    
    // Khởi tạo session từ server
    async fetchInitialSession() {
      try {
        // Gọi bất kỳ endpoint nào để server tạo session
        const response = await fetch(`${this.apiEndpoint}/`, {
          method: 'GET',
          // credentials: 'include' 
        });
        
        // Kiểm tra cookie sau khi gọi API
        this.sessionId = this.getCookie('session_id');
        
        if (this.sessionId) {
          console.log("Đã nhận session ID mới:", this.sessionId);
          // Tải sở thích người dùng
          this.fetchUserPreferences();
        }
      } catch (error) {
        console.error("Lỗi khi khởi tạo session:", error);
      }
    },
    
    // Tải sở thích người dùng từ server
    async fetchUserPreferences() {
      try {
        const response = await fetch(`${this.apiEndpoint}/user-preferences`, {
          method: 'GET',
          // credentials: 'include',
          headers: {
            'Content-Type': 'application/json'
          }
        });
        
        if (response.ok) {
          const data = await response.json();
          if (data.success && data.preferences) {
            // Cập nhật sở thích
            this.preferences = data.preferences;
            console.log("Đã tải sở thích người dùng:", this.preferences);
          }
        }
      } catch (error) {
        console.error("Lỗi khi tải sở thích người dùng:", error);
      }
    },
    
    // Tải dữ liệu từ localStorage
    loadChatFromStorage() {
      const savedMessages = localStorage.getItem('chatMessages');
      if (savedMessages) {
        this.messages = JSON.parse(savedMessages);
      }

      const savedPreferences = localStorage.getItem('chatPreferences');
      if (savedPreferences) {
        this.preferences = JSON.parse(savedPreferences);
      }

      const savedMode = localStorage.getItem('chatMode');
      if (savedMode) {
        this.chatMode = savedMode;
      }
    },
    
    // Lưu dữ liệu vào localStorage
    saveChatToStorage() {
      localStorage.setItem('chatMessages', JSON.stringify(this.messages));
      localStorage.setItem('chatPreferences', JSON.stringify(this.preferences));
      localStorage.setItem('chatMode', this.chatMode);
    },
    
    async resetPreferencesOnServer() {
      try {
        await fetch(`${this.apiEndpoint}/reset-preferences`, {
          method: "POST",
          // credentials: 'include',
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify({
            reset_history: true,
            reset_preferences: true
          }),
        });
        console.log("Đã đặt lại dữ liệu người dùng trên server");
      } catch (error) {
        console.error("Lỗi khi đặt lại sở thích trên server:", error);
      }
    },
    
    setupMarked() {
      // Cấu hình nâng cao cho marked
      marked.setOptions({
        breaks: true,
        gfm: true,
        headerIds: true,
        mangle: false,
        pedantic: false,
        smartLists: true,
        smartypants: true,
        xhtml: false
      });

      // Tùy chỉnh renderer để xử lý các phần tử đặc biệt
      const renderer = new marked.Renderer();
      
      // Tùy chỉnh cách hiển thị tiêu đề
      renderer.heading = (text, level) => {
        const escapedText = text.toLowerCase().replace(/[^\w]+/g, '-');
        return `
          <h${level} class="markdown-heading markdown-h${level}" id="${escapedText}">
            ${text}
          </h${level}>
        `;
      };
      
      // Tùy chỉnh cách hiển thị liên kết
      renderer.link = (href, title, text) => {
        const titleAttr = title ? `title="${title}"` : '';
        return `<a href="${href}" ${titleAttr} target="_blank" class="markdown-link">${text}</a>`;
      };
      
      // Tùy chỉnh cách hiển thị hình ảnh
      renderer.image = (href, title, text) => {
        const titleAttr = title ? `title="${title}"` : '';
        return `
          <div class="markdown-image-container">
            <img src="${href}" alt="${text}" ${titleAttr} class="markdown-image">
            ${title ? `<em class="markdown-image-caption">${title}</em>` : ''}
          </div>
        `;
      };
      
      // Áp dụng renderer tùy chỉnh
      marked.use({ renderer });
    },
    
    toggleChat() {
      this.isOpen = !this.isOpen;
      this.isMinimized = false;
      if (this.isOpen) {
        this.$nextTick(() => {
          this.scrollToBottom();
          if (this.$refs.inputField) {
            this.$refs.inputField.focus();
          }
        });
      }
    },
    
    minimizeChat() {
      this.isMinimized = true;
      this.isOpen = false;
    },
    
    switchMode(mode) {
      if (this.chatMode !== mode) {
        this.chatMode = mode;
        // Thêm tin nhắn thông báo khi chuyển mode
        this.messages.push({
          sender: "Bot",
          text: mode === 'movie' 
            ? "Bạn đã chuyển sang chế độ trợ lý phim. Tôi có thể giúp bạn tìm kiếm và đề xuất phim." 
            : "Bạn đã chuyển sang chế độ trợ lý VIP. Tôi có thể tư vấn về các gói dịch vụ và thanh toán.",
          time: this.formatTime(),
          is_markdown: false
        });
        this.$nextTick(() => {
          this.scrollToBottom();
        });
      }
    },
    
    getInputPlaceholder() {
      return this.chatMode === 'movie' 
        ? "Hỏi về phim hoặc yêu cầu đề xuất..." 
        : "Hỏi về gói VIP, ưu đãi, hoặc thanh toán...";
    },
    
    renderMarkdown(text) {
      if (!text) return '';
      try {
        // Sử dụng marked để chuyển đổi Markdown sang HTML
        const rawHtml = marked(text);
        
        // Sử dụng DOMPurify để làm sạch HTML ngăn ngừa XSS
        const cleanHtml = DOMPurify.sanitize(rawHtml, {
          ADD_ATTR: ['target'],  // Cho phép thuộc tính target cho liên kết
          ADD_TAGS: ['iframe']   // Cho phép thẻ iframe nếu cần
        });
        
        return cleanHtml;
      } catch (error) {
        console.error("Lỗi khi render Markdown:", error);
        return `<p>${text}</p>`;
      }
    },
    
    hasMovieRecommendations(text) {
      if (!text) return false;
      // Kiểm tra nếu văn bản chứa các mẫu đề xuất phim
      const patterns = [
        /# Đề Xuất Phim/i,
        /# Phim Ngẫu Nhiên/i,
        /# Kết Quả Tìm Kiếm/i,
        /\*\*Năm phát hành\*\*/i,
        /\*\*Thể loại\*\*/i,
        /\*\*Loại phim\*\*/i,
        /\*\*Tóm tắt phim\*\*/i
      ];
      return patterns.some(pattern => pattern.test(text));
    },
    
    getMovieRecommendationTitle(text) {
      if (!text) return '';
      // Trích xuất tiêu đề chính từ đề xuất
      const titleMatch = text.match(/# (.*?)(\n|$)/);
      return titleMatch ? titleMatch[1] : '';
    },
    
    getMovieIntroduction(text) {
      if (!text) return '';
      
      // Trích xuất phần giới thiệu giữa tiêu đề và phim đầu tiên
      const intro = text.split(/## /)[0];
      if (!intro) return '';
      
      // Loại bỏ tiêu đề và làm sạch
      const titleRemoved = intro.replace(/# .*\n+/, '').trim();
      return titleRemoved;
    },
    
    extractMovies(text) {
      if (!text) return [];

      const movies = [];
      const sections = text.split('---');

      for (const section of sections) {
        if (!section.trim()) continue;

        // Trích xuất tiêu đề phim
        const titleMatch = section.match(/## (.*?)(\n|$)/);
        if (!titleMatch) continue;

        const movieTitle = titleMatch[1].trim();

        // Trích xuất chi tiết phim
        const yearMatch = section.match(/\*\*Năm phát hành\*\*:\s*(.*?)(\n|$)/);
        const genreMatch = section.match(/\*\*Thể loại\*\*:\s*(.*?)((\n|\|))/);
        const typeMatch = section.match(/\*\*Loại phim\*\*:\s*(.*?)(\n|$)/);
        const directorMatch = section.match(/\*\*Đạo diễn\*\*:\s*(.*?)(\n|$)/);
        const summaryMatch = section.match(/\*\*Tóm tắt phim\*\*:\s*(.*?)(\n|$)/);
        const linkMatch = section.match(/\*\*Đường dẫn\*\*:\s*(https?:\/\/[^\s)]+)/);
        const imageMatch = section.match(/!\[.*?\]\((https?:\/\/[^\s)]+)/);
        
        // Trích xuất ID phim từ đường dẫn nếu có
        let movieId = null;
        if (linkMatch) {
          const urlParts = linkMatch[1].split('/');
          const lastPart = urlParts[urlParts.length - 1];
          // Nếu ID là số, lấy nó
          if (/^\d+$/.test(lastPart)) {
            movieId = parseInt(lastPart);
          } else {
            // Tạo ID giả từ tiêu đề
            movieId = this.hashCode(movieTitle);
          }
        } else {
          // Tạo ID giả từ tiêu đề
          movieId = this.hashCode(movieTitle);
        }
        
        // Lưu ID phim vào map
        this.movieIdMap[movieTitle] = movieId;

        movies.push({
          id: movieId,
          title: movieTitle,
          year: yearMatch ? yearMatch[1].trim() : '',
          genre: genreMatch ? genreMatch[1].trim() : '',
          type: typeMatch ? typeMatch[1].trim() : '',
          director: directorMatch ? directorMatch[1].trim() : '',
          summary: summaryMatch ? summaryMatch[1].trim() : '',
          link: linkMatch ? linkMatch[1].trim() : '',
          image: imageMatch ? imageMatch[1].trim() : ''
        });
      }

      return movies;
    },
    
    // Tạo mã hash từ chuỗi để làm ID
    hashCode(str) {
      let hash = 0;
      for (let i = 0; i < str.length; i++) {
        const char = str.charCodeAt(i);
        hash = ((hash << 5) - hash) + char;
        hash = hash & hash; // Convert to 32bit integer
      }
      return Math.abs(hash);
    },
    
    getMovieId(movie) {
      return movie.id || this.hashCode(movie.title);
    },
    
    isMovieLiked(movieId) {
      return this.preferences.liked_movies.includes(movieId);
    },
    
    getQuestion(text) {
      if (!text) return '';
      // Trích xuất câu hỏi ở cuối đề xuất
      const lines = text.split('\n');
      
      // Tìm dòng cuối cùng có dấu hỏi
      for (let i = lines.length - 1; i >= 0; i--) {
        const line = lines[i].trim();
        if (line && line.includes('?')) {
          return line;
        }
      }
      return '';
    },
    
    scrollToBottom() {
      if (this.$refs.messagesContainer) {
        const container = this.$refs.messagesContainer;
        container.scrollTop = container.scrollHeight;
      }
    },
    
    formatTime() {
      const now = new Date();
      return `${now.getHours().toString().padStart(2, '0')}:${now.getMinutes().toString().padStart(2, '0')}`;
    },
    
    quickReply(message) {
      this.userInput = message;
      this.sendMessage();
    },
    
    async fetchGenres() {
      try {
        const response = await fetch(`${this.apiEndpoint}/genres`);
        const data = await response.json();
        if (data.success && data.genres) {
          this.movieGenres = data.genres;
        }
      } catch (error) {
        console.error("Lỗi khi lấy danh sách thể loại phim:", error);
      }
    },
    
    async likeMovie(movieTitle, movieId) {
      try {
        // Nếu không có ID, tạo ID từ tiêu đề
        if (!movieId) {
          movieId = this.hashCode(movieTitle);
        }
        
        // Kiểm tra nếu đã thích
        if (this.preferences.liked_movies.includes(movieId)) {
          console.log(`Phim "${movieTitle}" đã được thích trước đó`);
          return;
        }
        
        // Thêm vào danh sách phim đã thích
        if (!this.preferences.liked_movies.includes(movieId)) {
          this.preferences.liked_movies.push(movieId);
        }
        
        // Lưu ID phim vào map
        this.movieIdMap[movieTitle] = movieId;
        
        // Gửi tương tác lên server
        const response = await fetch(`${this.apiEndpoint}/movie-interaction`, {
          method: 'POST',
          // credentials: 'include',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify({
            movie_id: movieId,
            interaction_type: 'like',
            movie_title: movieTitle
          })
        });
        
        if (response.ok) {
          const data = await response.json();
          
          if (data.success) {
            // Thông báo nhỏ
            this.messages.push({
              sender: "Bot",
              text: `Đã thêm "${movieTitle}" vào danh sách phim bạn thích.`,
              time: this.formatTime(),
              is_markdown: false
            });
            
            // Cập nhật sở thích nếu có
            if (data.preferences) {
              this.preferences = data.preferences;
            }
            
            this.$nextTick(() => {
              this.scrollToBottom();
            });
          }
        }
      } catch (error) {
        console.error(`Lỗi khi thích phim "${movieTitle}":`, error);
      }
    },
    
    async removePreference(type, value) {
      try {
        // Gửi yêu cầu xóa sở thích
        const response = await fetch(`${this.apiEndpoint}/remove-preference`, {
          method: 'POST',
          // credentials: 'include',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify({
            preference_type: type,
            preference_value: value
          })
        });
        
        if (response.ok) {
          const data = await response.json();
          
          if (data.success) {
            // Cập nhật sở thích cục bộ
            if (type === 'genre') {
              this.preferences.genres = this.preferences.genres.filter(g => g !== value);
            } else if (type === 'movie') {
              this.preferences.liked_movies = this.preferences.liked_movies.filter(id => id !== value);
            }
            
            // Thông báo nhỏ
            this.messages.push({
              sender: "Bot",
              text: type === 'genre' 
                ? `Đã xóa thể loại "${value}" khỏi sở thích.`
                : `Đã xóa phim khỏi danh sách yêu thích.`,
              time: this.formatTime(),
              is_markdown: false
            });
            
            this.$nextTick(() => {
              this.scrollToBottom();
            });
          }
        }
      } catch (error) {
        console.error(`Lỗi khi xóa sở thích ${type}:`, error);
      }
    },
    
    async sendFeedback(message) {
      try {
        await fetch(`${this.apiEndpoint}/chat`, {
          method: "POST",
          // credentials: 'include',
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify({
            message: message,
            mode: this.chatMode
          }),
        });
        // Xử lý phản hồi bằng cách cập nhật sở thích
      } catch (error) {
        console.error("Lỗi khi gửi phản hồi:", error);
      }
    },
    
    async sendMessage() {
      if (!this.userInput.trim() || this.isTyping) return;

      // Thêm tin nhắn người dùng vào hiển thị
      this.messages.push({
        sender: "Bạn",
        text: this.userInput,
        time: this.formatTime(),
        is_markdown: false
      });

      const message = this.userInput;
      this.userInput = "";

      // Cuộn xuống dưới sau khi thêm tin nhắn
      this.$nextTick(() => {
        this.scrollToBottom();
      });

      // Hiển thị chỉ báo đang nhập
      this.isTyping = true;

      try {
        const res = await fetch(`${this.apiEndpoint}/chat`, {
          method: "POST",
          // credentials: 'include', // Quan trọng để gửi cookie session
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify({
            message: message,
            mode: this.chatMode
          }),
        });

        const data = await res.json();

        // Ẩn chỉ báo đang nhập sau một khoảng thời gian ngắn để trông tự nhiên hơn
        setTimeout(() => {
          this.isTyping = false;

          if (data.success) {
            // Thêm phản hồi của bot vào hiển thị
            this.messages.push({
              sender: "Bot",
              text: data.response,
              time: this.formatTime(),
              is_markdown: data.is_markdown !== undefined ? data.is_markdown : true
            });

            // Cập nhật lịch sử trò chuyện với dữ liệu từ server
            if (data.history) {
              this.chatHistory = data.history;
            }

            // Cập nhật sở thích và ngữ cảnh
            if (data.preferences) {
              this.preferences = data.preferences;
            }
            
            if (data.context) {
              this.chatMode = data.context;
            }

            // Cuộn xuống dưới sau khi nhận phản hồi
            this.$nextTick(() => {
              this.scrollToBottom();
            });
          } else {
            this.messages.push({
              sender: "Bot",
              text: "Xin lỗi, tôi không thể xử lý yêu cầu của bạn.",
              time: this.formatTime(),
              is_markdown: false
            });
            this.$nextTick(() => {
              this.scrollToBottom();
            });
          }
        }, 800); // Độ trễ mô phỏng đang nhập
      } catch (e) {
        console.error(e);
        setTimeout(() => {
          this.isTyping = false;
          this.messages.push({
            sender: "Bot",
            text: "Lỗi kết nối server.",
            time: this.formatTime(),
            is_markdown: false
          });
          this.$nextTick(() => {
            this.scrollToBottom();
          });
        }, 800);
      }
    },
    
    async clearChat() {
      try {
        // Hiển thị xác nhận
        const confirmClear = confirm("Bạn có muốn xóa lịch sử trò chuyện và sở thích?");
        if (confirmClear) {
          // Gửi yêu cầu đặt lại sở thích lên server
          const response = await fetch(`${this.apiEndpoint}/reset-preferences`, {
            method: 'POST',
            // credentials: 'include',
            headers: {
              'Content-Type': 'application/json'
            },
            body: JSON.stringify({
              reset_genres: true,
              reset_film_types: true,
              reset_interactions: true,
              reset_history: true
            })
          });
          
          // Xóa dữ liệu cục bộ
          this.messages = [];
          this.preferences = {
            liked_movies: [],
            disliked_movies: [],
            genres: [],
            film_types: [],
            mentioned_movies: []
          };
          this.movieIdMap = {};
          
          // Xóa localStorage
          localStorage.removeItem('chatMessages');
          localStorage.removeItem('chatPreferences');
          
          // Thêm thông báo
          this.messages.push({
            sender: "Bot",
            text: "Lịch sử trò chuyện và sở thích của bạn đã được xóa.",
            time: this.formatTime(),
            is_markdown: false
          });
        }
      } catch (error) {
        console.error("Lỗi khi xóa dữ liệu:", error);
        this.messages.push({
          sender: "Bot",
          text: "Có lỗi xảy ra khi xóa dữ liệu. Vui lòng thử lại sau.",
          time: this.formatTime(),
          is_markdown: false
        });
      }
    }
  },
};
</script>

<style>
.chatbot-container {
  position: fixed;
  bottom: 20px;
  right: 20px;
  z-index: 9999;
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

/* Circular button when closed */
.chatbot-button {
  width: 75px; /* Increased size */
  height: 75px; /* Increased size */
  border-radius: 50%;
  background: linear-gradient(135deg, #e52d27, #b31217);
  box-shadow: 0 6px 16px rgba(0, 0, 0, 0.3); /* Improved shadow */
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  transition: all 0.3s ease;
  overflow: hidden;
}

.chatbot-button:hover {
  transform: scale(1.08); /* Larger hover effect */
  box-shadow: 0 8px 20px rgba(0, 0, 0, 0.35);
}

.chatbot-icon {
  width: 100%;
  height: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
}

.custom-icon {
  width: 100%;
  height: 100%;
  object-fit: cover;
  border-radius: 50%;
}

/* Full chatbot panel when open */
.chatbot-panel {
  width: 600px; /* Set width to 50% of viewport width on large screens */
  max-width: 720px; /* Add a max-width so it doesn't get too large */
  height: 800px; /* Increased height */
  background-color: #fff;
  border-radius: 16px; /* More rounded corners */
  box-shadow: 0 15px 35px rgba(0, 0, 0, 0.25); /* Deeper, more attractive shadow */
  display: flex;
  flex-direction: column;
  overflow: hidden;
  animation: slideIn 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}

@keyframes slideIn {
  from {
    opacity: 0;
    transform: translateY(20px) scale(0.95);
  }

  to {
    opacity: 1;
    transform: translateY(0) scale(1);
  }
}

.chatbot-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 22px 24px; /* More padding */
  background: linear-gradient(135deg, #e52d27, #b31217);
  color: white;
  box-shadow: 0 3px 8px rgba(0, 0, 0, 0.15); /* Improved shadow */
}

.chatbot-title {
  display: flex;
  align-items: center;
  font-weight: 600;
  font-size: 20px; /* Larger font */
}

.chatbot-title .icon-small {
  width: 32px; /* Larger icon */
  height: 32px; /* Larger icon */
  margin-right: 12px;
  border-radius: 50%;
}

.mode-toggle {
  display: flex;
  background: rgba(0, 0, 0, 0.15);
  border-radius: 28px;
  padding: 3px;
  margin-left: auto;
  margin-right: 12px;
}

.mode-button {
  background: none;
  border: none;
  color: white;
  padding: 6px 12px;
  border-radius: 24px;
  display: flex;
  align-items: center;
  font-size: 14px;
  cursor: pointer;
  transition: background-color 0.3s;
}

.mode-button.active {
  background: rgba(255, 255, 255, 0.25);
  font-weight: 500;
}

.mode-button:hover:not(.active) {
  background: rgba(255, 255, 255, 0.15);
}

.mode-button .icon-small {
  width: 18px;
  height: 18px;
  margin-right: 6px;
}

.preference-tags {
  background-color: rgba(229, 45, 39, 0.05);
  padding: 12px 22px;
  border-bottom: 1px solid rgba(229, 45, 39, 0.1);
}

.preference-section {
  margin-bottom: 8px;
}

.preference-section:last-child {
  margin-bottom: 0;
}

.preference-label {
  font-size: 13px;
  color: #666;
  margin-right: 8px;
}

.tag-container {
  display: flex;
  flex-wrap: wrap;
  gap: 8px;
  margin-top: 4px;
}

.preference-tag {
  background-color: rgba(229, 45, 39, 0.1);
  color: #b31217;
  font-size: 12px;
  padding: 4px 10px;
  border-radius: 12px;
  font-weight: 500;
  display: flex;
  align-items: center;
}

.remove-tag {
  background: none;
  border: none;
  color: #b31217;
  margin-left: 5px;
  cursor: pointer;
  font-size: 16px;
  line-height: 1;
  padding: 0 2px;
}

.remove-tag:hover {
  color: #e52d27;
}

.chatbot-actions {
  display: flex;
  gap: 8px; /* Space between buttons */
}

.action-button {
  background: none;
  border: none;
  color: white;
  cursor: pointer;
  padding: 8px; /* Larger clickable area */
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: background-color 0.2s;
}

.action-button:hover {
  background-color: rgba(255, 255, 255, 0.25); /* More visible hover effect */
}

.minimize-button {
  background-color: rgba(255, 255, 255, 0.1);
}

.icon-small {
  width: 22px; /* Slightly larger icon */
  height: 22px; /* Slightly larger icon */
}

.chatbot-messages {
  flex-grow: 1;
  padding: 22px; /* More padding */
  overflow-y: auto;
  display: flex;
  flex-direction: column;
  gap: 18px; /* More space between messages */
  background-color: #f8f9fb;
}

.welcome-message {
  text-align: center;
  padding: 30px; /* More padding */
  background-color: rgba(255, 255, 255, 0.9); /* More solid white */
  border-radius: 14px; /* More rounded */
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08); /* Better shadow */
  margin-bottom: 18px;
  border: 1px solid rgba(229, 45, 39, 0.1); /* Subtle border */
}

.welcome-message h3 {
  margin-top: 0;
  margin-bottom: 12px;
  color: #b31217;
  font-size: 24px; /* Larger font */
}

.welcome-message p {
  margin-bottom: 24px;
  color: #555;
  font-size: 16px; /* Larger font */
  line-height: 1.6;
}

.suggestion-chips {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  gap: 12px; /* More space between chips */
}

.chip {
  background-color: #e52d27;
  color: white;
  border: none;
  border-radius: 24px; /* More rounded */
  padding: 12px 20px; /* Larger padding */
  font-size: 15px; /* Larger font */
  cursor: pointer;
  transition: all 0.2s;
  font-weight: 500; /* Semi-bold */
  box-shadow: 0 2px 5px rgba(229, 45, 39, 0.2); /* Subtle shadow */
}

.chip:hover {
  background-color: #b31217;
  transform: translateY(-3px);
  box-shadow: 0 4px 8px rgba(229, 45, 39, 0.3); /* Enhanced shadow on hover */
}

.message {
  display: flex;
  flex-direction: column;
  margin-bottom: 12px;
}

.message-transition-enter-active,
.message-transition-leave-active {
  transition: all 0.3s ease;
}

.message-transition-enter-from {
  opacity: 0;
  transform: translateY(20px);
}

.message-transition-leave-to {
  opacity: 0;
}

.bot-message .message-content {
  display: flex;
  align-items: flex-start;
}

.bot-avatar {
  width: 46px; /* Larger avatar */
  height: 46px; /* Larger avatar */
  border-radius: 50%;
  background-color: #e52d27;
  display: flex;
  align-items: center;
  justify-content: center;
  margin-right: 12px;
  flex-shrink: 0;
  overflow: hidden;
  box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1); /* Added shadow */
}

.message-bubble {
  max-width: 85%;
  padding: 16px 20px; /* More padding */
  border-radius: 20px; /* More rounded */
  white-space: pre-wrap;
  word-break: break-word;
  box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1); /* Better shadow */
  font-size: 16px; /* Larger font */
  line-height: 1.5;
  transition: all 0.2s ease;
}

.message-bubble:hover {
  box-shadow: 0 5px 12px rgba(0, 0, 0, 0.15);
}

.message-time {
  font-size: 12px;
  color: #888;
  margin-top: 6px;
  margin-left: 58px; /* Adjusted for larger avatar */
  align-self: flex-start;
}

.user-message .message-time {
  align-self: flex-end;
  margin-right: 12px;
  margin-left: 0;
}

.user-message {
  align-items: flex-end;
}

.user-message .message-content {
  justify-content: flex-end;
}

.user-message .message-bubble {
  background-color: #e52d27;
  color: white;
  border-top-right-radius: 4px;
  box-shadow: 0 3px 8px rgba(229, 45, 39, 0.2); /* Custom shadow */
}

.bot-message .message-bubble {
  background-color: white;
  color: #333;
  border-top-left-radius: 4px;
}

/* Movie Recommendations Styling - Enhanced */
.movie-recommendations {
  display: flex;
  flex-direction: column;
  gap: 18px;
}

.recommendation-title {
  font-size: 20px; /* Larger font */
  font-weight: 600;
  margin: 0 0 12px 0;
  color: #b31217;
  text-align: center;
}

.movie-introduction {
  margin: 0 0 20px 0;
  padding: 12px 18px;
  background-color: rgba(229, 45, 39, 0.05);
  border-left: 3px solid #e52d27;
  border-radius: 0 8px 8px 0;
  font-style: italic;
  color: #555;
  line-height: 1.6;
}

.movie-card {
  display: flex;
  flex-direction: column;
  background-color: #fff;
  border-radius: 12px; /* More rounded */
  overflow: hidden;
  box-shadow: 0 5px 12px rgba(0, 0, 0, 0.1); /* Better shadow */
  margin-bottom: 18px;
  border: 1px solid #eee;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.movie-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
}

.movie-image {
  width: 100%;
  position: relative;
  overflow: hidden;
  height: 200px; /* Taller images */
}

.movie-poster {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.3s ease;
}

.movie-card:hover .movie-poster {
  transform: scale(1.08);
}

.movie-details {
  padding: 18px; /* More padding */
}

.movie-title {
  font-size: 18px; /* Larger font */
  font-weight: 600;
  margin: 0 0 10px 0;
  color: #333;
}

.movie-meta {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin-bottom: 12px;
  font-size: 14px;
  color: #777;
}

.movie-year {
  background-color: rgba(229, 45, 39, 0.1);
  padding: 3px 8px;
  border-radius: 12px;
  font-weight: 500;
  color: #e52d27;
}

.movie-genre,
.movie-type {
  background-color: #f1f1f1;
  padding: 4px 12px; /* More padding */
  border-radius: 6px; /* More rounded */
  font-weight: 500;
  box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05); /* Subtle shadow */
}

.movie-summary {
  font-size: 15px; /* Larger font */
  color: #555;
  margin-bottom: 15px;
  line-height: 1.5;
}

.movie-actions {
  display: flex;
  align-items: center;
  gap: 12px;
}

.movie-link {
  display: inline-block;
  background-color: #e52d27;
  color: white;
  padding: 10px 18px; /* More padding */
  border-radius: 8px; /* More rounded */
  text-decoration: none;
  font-size: 15px; /* Larger font */
  font-weight: 500;
  transition: all 0.3s;
  box-shadow: 0 3px 6px rgba(229, 45, 39, 0.2); /* Added shadow */
  flex-grow: 1;
  text-align: center;
}

.movie-link:hover {
  background-color: #b31217;
  transform: translateY(-3px);
  box-shadow: 0 5px 10px rgba(229, 45, 39, 0.3); /* Enhanced shadow on hover */
}

.movie-action-btn {
  background: #f1f1f1;
  border: none;
  width: 40px;
  height: 40px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  transition: all 0.2s ease;
}

.movie-action-btn:hover {
  background: #e0e0e0;
  transform: scale(1.1);
}

.like-btn {
  color: #777;
}

.like-btn:hover {
  color: #e52d27;
}

.like-btn.liked {
  background: rgba(229, 45, 39, 0.1);
  color: #e52d27;
}

.chat-question {
  text-align: center;
  margin-top: 12px;
  font-weight: 500;
  color: #555;
  font-style: italic;
  background-color: #f8f8f8;
  padding: 12px;
  border-radius: 10px; /* More rounded */
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05); /* Subtle shadow */
}

/* Plain text style */
.plain-text {
  white-space: pre-wrap;
  line-height: 1.6;
  font-size: 16px; /* Larger font */
}

/* Markdown Content - Enhanced */
.markdown-content {
  font-size: 16px; /* Larger font */
  line-height: 1.6;
  color: #333;
}

.markdown-heading {
  margin-top: 24px;
  margin-bottom: 12px;
  color: #222;
  font-weight: 600;
  line-height: 1.3;
}

.markdown-h1 {
  font-size: 26px; /* Larger font */
  border-bottom: 2px solid #eee;
  padding-bottom: 10px;
  color: #b31217;
}

.markdown-h2 {
  font-size: 22px; /* Larger font */
  border-bottom: 1px solid #eee;
  padding-bottom: 6px;
  color: #c43a36;
}

.markdown-h3 {
  font-size: 20px; /* Larger font */
}

.markdown-h4, .markdown-h5, .markdown-h6 {
  font-size: 18px; /* Larger font */
}

.markdown-paragraph {
  margin: 14px 0;
}

.markdown-list {
  margin: 12px 0;
  padding-left: 28px; /* More indentation */
}

.markdown-list-item {
  margin-bottom: 8px;
}

.markdown-link {
  color: #e52d27;
  text-decoration: none;
  border-bottom: 1px solid rgba(229, 45, 39, 0.3);
  padding-bottom: 1px;
  transition: all 0.2s;
}

.markdown-link:hover {
  color: #b31217;
  border-bottom-color: #b31217;
}

.markdown-image-container {
  max-width: 100%;
  margin: 18px 0;
  text-align: center;
}

.markdown-image {
  max-width: 100%;
  height: auto;
  border-radius: 10px; /* More rounded */
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15); /* Better shadow */
}

.markdown-image-caption {
  display: block;
  margin-top: 10px;
  color: #777;
  font-size: 14px; /* Larger font */
}

.markdown-blockquote {
  margin: 18px 0;
  padding: 12px 18px; /* More padding */
  border-left: 4px solid #e52d27;
  background-color: #f9f9f9;
  color: #555;
  font-style: italic;
  border-radius: 0 8px 8px 0; /* Rounded right corners */
}

.markdown-code-block {
  margin: 15px 0;
  border-radius: 8px; /* More rounded */
  overflow: hidden;
  background-color: #282c34;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15); /* Better shadow */
}

.markdown-code-header {
  background-color: #21252b;
  padding: 10px 14px; /* More padding */
  font-size: 13px; /* Larger font */
  color: #abb2bf;
  display: flex;
  justify-content: space-between;
}

.markdown-code-language {
  font-family: monospace;
  font-weight: 500;
}

.markdown-pre {
  margin: 0;
  padding: 0;
  overflow-x: auto;
}

.markdown-pre code {
  display: block;
  padding: 14px 18px; /* More padding */
  color: #abb2bf;
  font-family: monospace;
  font-size: 15px; /* Larger font */
  line-height: 1.5;
}

/* Typing indicator - Enhanced */
.typing-indicator {
  display: flex;
  margin-top: 6px;
  margin-bottom: 12px;
  margin-left: 58px; /* Adjusted for larger avatar */
  align-items: center;
}


.typing-dot {
width: 10px; /* Larger dots */
height: 10px; /* Larger dots */
background-color: #e52d27;
border-radius: 50%;
margin-right: 6px;
animation: typingAnimation 1.5s infinite ease-in-out;
}

.typing-dot:nth-child(1) {
animation-delay: 0s;
}

.typing-dot:nth-child(2) {
animation-delay: 0.3s;
}

.typing-dot:nth-child(3) {
animation-delay: 0.6s;
margin-right: 0;
}

@keyframes typingAnimation {
0% {
  transform: translateY(0px);
  opacity: 0.6;
}

50% {
  transform: translateY(-5px);
  opacity: 1;
}

100% {
  transform: translateY(0px);
  opacity: 0.6;
}
}

.chatbot-footer {
padding: 10px 18px; /* More padding */
background-color: #f8f9fb;
border-top: 1px solid #eee;
font-size: 13px; /* Larger font */
color: #999;
display: flex;
justify-content: space-between;
align-items: center;
}

.chatbot-actions-footer {
display: flex;
gap: 15px;
}

.footer-action {
color: #e52d27;
cursor: pointer;
font-size: 13px; /* Larger font */
transition: all 0.2s;
text-decoration: underline;
text-underline-offset: 2px;
}

.footer-action:hover {
color: #b31217;
font-weight: 500;
}

.chatbot-input {
display: flex;
align-items: center;
padding: 18px 22px; /* More padding */
border-top: 1px solid #e0e0e0;
background-color: white;
position: relative;
}

.input-field {
flex-grow: 1;
border: 1px solid #e0e0e0;
border-radius: 28px; /* More rounded */
padding: 16px 20px; /* More padding */
margin-right: 14px;
outline: none;
font-size: 16px; /* Larger font */
transition: all 0.3s;
box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05) inset;
}

.input-field:focus {
border-color: #e52d27;
box-shadow: 0 0 0 3px rgba(229, 45, 39, 0.1);
}

.send-button {
width: 52px; /* Larger button */
height: 52px; /* Larger button */
border: none;
border-radius: 50%;
background: linear-gradient(135deg, #e52d27, #b31217);
color: white;
cursor: pointer;
display: flex;
align-items: center;
justify-content: center;
transition: all 0.3s;
box-shadow: 0 3px 8px rgba(229, 45, 39, 0.2); /* Added shadow */
}

.send-button:hover:not(:disabled) {
transform: scale(1.08);
box-shadow: 0 5px 10px rgba(229, 45, 39, 0.3); /* Enhanced shadow on hover */
}

.send-button:disabled {
background: #cccccc;
cursor: not-allowed;
opacity: 0.7;
box-shadow: none;
}

/* Responsive styles - Enhanced */
@media (max-width: 1200px) {
  .chatbot-panel {
    width: 65vw;
  }
}

@media (max-width: 992px) {
  .chatbot-panel {
    width: 75vw;
  }
}

@media (max-width: 768px) {
  .chatbot-panel {
    width: 100%;
    height: 100%;
    position: fixed;
    bottom: 0;
    right: 0;
    border-radius: 0;
    animation: slideUpMobile 0.3s ease;
    max-width: 100%; /* Remove max-width limit for mobile */
  }

  @keyframes slideUpMobile {
    from {
      transform: translateY(100%);
    }

    to {
      transform: translateY(0);
    }
  }

  .chatbot-messages {
    padding: 18px;
  }

  .chatbot-input {
    padding: 15px 18px;
  }

  .welcome-message {
    padding: 22px;
  }

  .preference-tags {
    padding: 10px 18px;
  }

  .mode-toggle {
    margin-left: 10px;
    margin-right: 10px;
  }
}

@media (max-width: 480px) {
  .message-bubble {
    max-width: 90%;
    padding: 14px 16px;
    font-size: 15px;
  }

  .bot-avatar {
    width: 40px;
    height: 40px;
  }

  .input-field {
    padding: 14px 16px;
    font-size: 15px;
  }

  .send-button {
    width: 46px;
    height: 46px;
  }

  .chatbot-header {
    padding: 14px 16px;
  }

  .chatbot-title {
    font-size: 18px;
  }

  .welcome-message h3 {
    font-size: 20px;
  }

  .welcome-message p {
    font-size: 15px;
  }

  .chatbot-button {
    width: 60px;
    height: 60px;
    bottom: 15px;
    right: 15px;
  }

  .message-time {
    margin-left: 50px;
  }

  .typing-indicator {
    margin-left: 50px;
  }

  .mode-button {
    padding: 5px 10px;
    font-size: 13px;
  }

  .mode-button .icon-small {
    margin-right: 4px;
    width: 16px;
    height: 16px;
  }

  .preference-tags {
    padding: 8px 15px;
  }

  .preference-tag {
    font-size: 11px;
    padding: 3px 8px;
  }

  .movie-actions {
    flex-direction: column;
    align-items: stretch;
    gap: 8px;
  }

  .movie-action-btn {
    align-self: flex-end;
  }
}
</style>
