#!/bin/bash

set -e

# Thư mục tạm
TEMP_DIR=temp_merge
REPO_MAIN_PATH=$(pwd)

# Danh sách repo phụ
REPO_URLS=(
  "git@github.com:vietvo371/MovieStreaming_Fe.git"
  "git@github.com:vietvo371/MovieStreaming_Be.git"
)

# Tên thư mục tương ứng
FOLDERS=(
  "DATN_FE"
  "DATN_BE"
)

# Tạo thư mục tạm và xử lý từng repo
mkdir -p "$TEMP_DIR"
cd "$TEMP_DIR" || exit 1

for i in "${!REPO_URLS[@]}"; do
  repo_url="${REPO_URLS[$i]}"
  folder="${FOLDERS[$i]}"

  echo "➡️  Cloning $repo_url vào thư mục $folder ..."
  git clone "$repo_url" "$folder" || { echo "❌ Clone thất bại"; exit 1; }
  cd "$folder" || exit 1

  echo "📦  Di chuyển toàn bộ lịch sử vào thư mục $folder ..."
  git filter-repo --to-subdirectory-filter "$folder"

  echo "🔗  Trở lại repo chính để merge..."
  cd "$REPO_MAIN_PATH" || exit 1
  git remote add "${folder}_remote" "$REPO_MAIN_PATH/$TEMP_DIR/$folder"
  git fetch "${folder}_remote"

  echo "🔀  Merge $folder vào nhánh hiện tại..."
  git merge --allow-unrelated-histories "${folder}_remote/master" -m "Merge $folder vào monorepo"

  echo "🧹  Xoá remote tạm ${folder}_remote ..."
  git remote remove "${folder}_remote"

  cd "$TEMP_DIR" || exit 1
done

# Dọn dẹp
cd "$REPO_MAIN_PATH" || exit 1
rm -rf "$TEMP_DIR"

echo "✅ Hoàn tất merge tất cả repo vào GIT_DATN"
