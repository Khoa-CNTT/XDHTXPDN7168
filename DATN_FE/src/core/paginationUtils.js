// paginationUtils.js
export function getPageNumbers(pagination) {
    let pages = [];
    if (pagination.last_page <= 3) {
        // Nếu tổng số trang <= 3, hiển thị tất cả các trang
        for (let i = 1; i <= pagination.last_page; i++) {
            pages.push(i);
        }
    } else {
        if (pagination.current_page <= 3) {
            // Người dùng đang ở ba trang đầu
            let maxPage = Math.min(3, pagination.last_page); // Đảm bảo không vượt quá tổng số trang
            for (let i = 1; i <= maxPage; i++) {
                pages.push(i);
            }
            if (pagination.last_page > 3) {
                pages.push('...');
                pages.push(pagination.last_page);
            }
        } else if (pagination.current_page >= pagination.last_page - 2) {
            // Người dùng đang ở ba trang cuối
            pages.push(1);
            if (pagination.last_page > 3) {
                pages.push('...');
            }
            let minPage = Math.max(pagination.last_page - 3, 1); // Đảm bảo không nhỏ hơn trang đầu tiên
            for (let i = minPage; i <= pagination.last_page; i++) {
                pages.push(i);
            }
        } else {
            // Người dùng đang ở các trang giữa
            pages.push(1);
            pages.push('...');
            for (let i = pagination.current_page - 1; i <= pagination.current_page + 1; i++) {
                pages.push(i);
            }
            pages.push('...');
            pages.push(pagination.last_page);
        }
    }
    return pages;
}
