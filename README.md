# 🎬 Movie Streaming Platform

![Banner](assets/images/movie-banner.png)

> *"🎥 Trải nghiệm giải trí không giới hạn 🌟"*

[![MIT License](https://img.shields.io/badge/License-MIT-green.svg)](https://github.com/yourusername/movie-streaming-platform/blob/main/LICENSE)
[![Open issues](https://img.shields.io/github/issues/yourusername/movie-streaming-platform.svg 'Open issues')](https://github.com/yourusername/movie-streaming-platform/issues)
[![Open Pull Requests](https://img.shields.io/github/issues-pr/yourusername/movie-streaming-platform.svg 'Open Pull Requests')](https://github.com/yourusername/movie-streaming-platform/pulls)
[![Commit activity](https://img.shields.io/github/commit-activity/m/yourusername/movie-streaming-platform.svg 'Commit activity')](https://github.com/yourusername/movie-streaming-platform/graphs/commit-activity)
[![GitHub contributors](https://img.shields.io/github/contributors/yourusername/movie-streaming-platform.svg 'Github contributors')](https://github.com/yourusername/movie-streaming-platform/graphs/contributors)

## 📱 Giới thiệu

Nền tảng xem phim đa nền tảng với trải nghiệm người dùng tối ưu, tích hợp công nghệ AI để đề xuất nội dung thông minh. Dự án bao gồm ứng dụng di động React Native, hệ thống đề xuất AI, và nền tảng web đầy đủ.

### Cấu trúc dự án:

- **DATN_Mobile**: Ứng dụng di động được phát triển bằng React Native
- **DATN_SERVER_AI**: Hệ thống đề xuất phim thông minh sử dụng Python
- **DATN_BE**: Backend API được xây dựng trên Laravel
- **DATN_FE**: Frontend web application

## 💫 Tính năng nổi bật

### 📱 Ứng dụng di động (DATN_Mobile)
- Giao diện người dùng trực quan, dễ sử dụng
- Xem phim trực tuyến với chất lượng cao
- Tải phim để xem offline
- Đồng bộ hóa watchlist và tiến độ xem phim
- Push notifications cho nội dung mới
- Hỗ trợ cả iOS và Android

### 🤖 Hệ thống đề xuất AI (DATN_SERVER_AI)
- Phân tích hành vi người dùng
- Đề xuất phim dựa trên lịch sử xem
- Collaborative filtering cho đề xuất phim
- Content-based filtering theo thể loại và đặc điểm phim
- Real-time recommendation updates

### 🖥️ Backend API (DATN_BE)
- RESTful API endpoints
- Xác thực và phân quyền người dùng
- Quản lý metadata phim
- Xử lý thanh toán an toàn
- Quản lý người dùng và nội dung
- Tích hợp với hệ thống AI

### 🌐 Frontend Web (DATN_FE)
- Giao diện web responsive
- Streaming video chất lượng cao
- Quản lý profile người dùng
- Tìm kiếm và lọc phim nâng cao
- Tích hợp thanh toán đa nền tảng

## 🏗 Cấu trúc thư mục

```
GIT_DATN/
├── DATN_Mobile/           # Ứng dụng React Native
│   ├── src/              # Mã nguồn
│   ├── assets/           # Tài nguyên
│   └── ...
├── DATN_SERVER_AI/       # Server Python AI
│   ├── models/           # ML models
│   ├── api/              # API endpoints
│   └── ...
├── DATN_BE/             # Laravel Backend
│   ├── app/             # Application code
│   ├── database/        # Migrations
│   └── ...
└── DATN_FE/            # Frontend
    ├── src/            # Source code
    ├── public/         # Public assets
    └── ...
```

## 🚀 Hướng dẫn cài đặt

### 1. DATN_Mobile (React Native)
```bash
# Clone repository
git clone [repository-url]
cd DATN_Mobile

# Cài đặt dependencies
npm install

# Chạy ứng dụng trên iOS
cd ios && pod install && cd ..
npx react-native run-ios

# Chạy ứng dụng trên Android
npx react-native run-android
```

### 2. DATN_SERVER_AI (Python)
```bash
# Di chuyển vào thư mục AI server
cd DATN_SERVER_AI

# Tạo môi trường ảo
python -m venv venv

# Kích hoạt môi trường ảo
source venv/bin/activate  # Unix
venv\Scripts\activate     # Windows

# Cài đặt dependencies
pip install -r requirements.txt

# Chạy server
python main.py
```

### 3. DATN_BE (Laravel)
```bash
# Di chuyển vào thư mục backend
cd DATN_BE

# Cài đặt dependencies
composer install

# Cấu hình môi trường
cp .env.example .env
php artisan key:generate

# Chạy migrations
php artisan migrate

# Khởi động server
php artisan serve
```

### 4. DATN_FE (Frontend)
```bash
# Di chuyển vào thư mục frontend
cd DATN_FE

# Cài đặt dependencies
npm install

# Chạy ứng dụng trong môi trường development
npm run dev

# Build cho production
npm run build
```

## 📚 Tài liệu API

### Mobile API Endpoints
- `GET /api/movies`: Lấy danh sách phim
- `GET /api/movies/{id}`: Chi tiết phim
- `POST /api/auth/login`: Đăng nhập
- `POST /api/auth/register`: Đăng ký

### AI Server Endpoints
- `POST /api/recommend`: Lấy đề xuất phim
- `GET /api/trending`: Phim thịnh hành
- `GET /api/similar/{movie_id}`: Phim tương tự

## 🔒 Bảo mật

- Sử dụng JWT cho xác thực
- HTTPS cho mọi request
- Mã hóa dữ liệu nhạy cảm
- Rate limiting cho API
- Input validation

## �� Liên hệ & Hỗ trợ

### 👥 Thành viên nhóm
- **Product Owner**: Võ Văn Việt
  - Email: [vietvo371@gmail.com](mailto:vietvo371@gmail.com)
  - SĐT: 0708585120

### 👨‍💻 Các thành viên
- **Trần Đức Cường**
  - Email: [duccuong24122002@gmail.com](mailto:duccuong24122002@gmail.com)
  - SĐT: 0914816238

- **Bạch Đình Quý**
  - Email: [dinhquy220403@gmail.com](mailto:dinhquy220403@gmail.com)
  - SĐT: 0947068227

- **Nguyễn Thị Quỳnh Như**
  - Email: [ntqn293@gmail.com](mailto:ntqn293@gmail.com)
  - SĐT: 0905249733

- **Huỳnh Văn Trọng**
  - Email: [huynhvantrong9909@gmail.com](mailto:huynhvantrong9909@gmail.com)
  - SĐT: 0777054735

### 🌐 Kênh hỗ trợ
- GitHub Issues: Tạo issue trên GitHub repository
- Project Management: Võ Văn Việt (Scrum Master)

## 📄 License

Dự án này được phát hành dưới giấy phép [MIT License](LICENSE)

```bash
git clone https://github.com/yourusername/movie-streaming-platform.git
cd movie-streaming-platform
npm install
