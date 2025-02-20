<template>
    <footer class="footer">
        <div class="page-up">
            <a href="#" id="scrollToTop"><span class="arrow_carrot-up"></span></a>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="footer__logo">
                        <a href="/"><img src="../../assets/assets_Anime/img/logoW.png" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="footer__nav">
                        <ul>
                            <li class="active"><a href="/">Trang chủ</a></li>
                            <li><a href="/categories">Thể Loại</a></li>
                            <li><a href="/blog">Blog</a></li>
                            <li><a  target="_blank" href="https://vietvo371.github.io/Portfolio">Liên Hệ</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4">
                    <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                      Copyright &copy; {{ new Date().getFullYear() }} All rights reserved by <a href="https://vietvo371.github.io/Portfolio" target="_blank">vietdev216</a>
                      <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    </p>
                    <div class="footer__social">
                        <a href="#"><i class="fa fa-facebook"></i></a>
                        <a href="#"><i class="fa fa-twitter"></i></a>
                        <a href="#"><i class="fa fa-pinterest"></i></a>
                        <a href="#"><i class="fa fa-instagram"></i></a>
                        <a href="#"><i class="fa fa-youtube-play"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</template>

<script>
export default {
    name: 'FooterAnime',
    mounted() {
        // Xử lý nút scroll to top
        const scrollBtn = document.getElementById('scrollToTop');
        if (scrollBtn) {
            scrollBtn.addEventListener('click', (e) => {
                e.preventDefault();
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });
        }
    }
}
</script>

<style scoped>
.footer {
    background: #070720;
    padding-top: 60px;
    padding-bottom: 40px;
    position: relative;
}

.footer__logo {
    margin-bottom: 30px;
}

.footer__nav {
    text-align: center;
}

.footer__nav ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.footer__nav ul li {
    display: inline-block;
    margin-right: 45px;
    position: relative;
}

.footer__nav ul li:last-child {
    margin-right: 0;
}

.footer__nav ul li a {
    font-size: 15px;
    color: #b7b7b7;
    text-decoration: none;
    font-weight: 500;
}

.footer__nav ul li a:hover {
    color: #ffffff;
}

.footer__social {
    text-align: right;
    margin-top: 25px;
}

.footer__social a {
    display: inline-block;
    height: 35px;
    width: 35px;
    background: rgba(255, 255, 255, 0.1);
    font-size: 15px;
    color: #ffffff;
    line-height: 35px;
    text-align: center;
    border-radius: 50%;
    margin-right: 10px;
    transition: all 0.3s;
}

.footer__social a:hover {
    background: #e53637;
}

.footer__social a:last-child {
    margin-right: 0;
}

.page-up {
    position: absolute;
    right: 15px;
    top: -25px;
}

.page-up a {
    display: inline-block;
    font-size: 20px;
    color: #ffffff;
    height: 40px;
    width: 40px;
    background: #e53637;
    line-height: 40px;
    text-align: center;
    border-radius: 50%;
}

.page-up a:hover {
    background: #e53637;
}

p {
    color: #b7b7b7;
    margin-bottom: 0;
    text-align: right;
}

/* Tablet Devices (768px and down) */
@media only screen and (max-width: 768px) {
    .footer {
        padding-top: 40px;
        padding-bottom: 30px;
    }

    .footer__logo {
        text-align: center;
        margin-bottom: 20px;
    }

    .footer__nav ul li {
        margin-right: 20px;
        margin-bottom: 10px;
    }

    .footer__nav ul li a {
        font-size: 14px;
    }

    .col-lg-3 p {
        text-align: center;
        margin-top: 20px;
    }

    .footer__social {
        text-align: center;
        margin-top: 20px;
    }

    .page-up {
        right: 10px;
    }
}

/* Mobile Devices (576px and down) */
@media only screen and (max-width: 576px) {
    .footer {
        padding-top: 30px;
        padding-bottom: 20px;
    }

    .footer__nav ul {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
    }

    .footer__nav ul li {
        margin: 0 10px 10px;
    }

    .footer__social a {
        height: 30px;
        width: 30px;
        line-height: 30px;
        font-size: 12px;
        margin-right: 5px;
    }

    .page-up {
        top: -20px;
    }

    .page-up a {
        height: 35px;
        width: 35px;
        line-height: 35px;
        font-size: 16px;
    }

    .footer__logo img {
        max-width: 120px;
    }
}

/* Thêm container fluid cho màn hình lớn */
@media only screen and (min-width: 1200px) {
    .container {
        max-width: 1170px;
    }
}

/* Fix cho màn hình siêu nhỏ */
@media only screen and (max-width: 320px) {
    .footer__nav ul li {
        margin: 0 5px 8px;
    }

    .footer__nav ul li a {
        font-size: 12px;
    }

    .footer__social a {
        margin-right: 3px;
    }
}

/* Thêm styles cho sticky footer */
.footer {
    margin-top: auto;
    width: 100%;
}

/* Fix cho container fluid */
.container {
    width: 100%;
    padding-right: 15px;
    padding-left: 15px;
    margin-right: auto;
    margin-left: auto;
}

/* Fix cho row spacing */
.row {
    display: flex;
    flex-wrap: wrap;
    margin-right: -15px;
    margin-left: -15px;
}

/* Thêm transition mượt mà cho các hover effects */
.footer__nav ul li a,
.footer__social a {
    transition: all 0.3s ease;
}

/* Fix cho spacing giữa các elements */
.footer__nav {
    margin: 15px 0;
}

/* Đảm bảo social icons luôn có khoảng cách đều */
.footer__social {
    display: flex;
    justify-content: flex-end;
    flex-wrap: wrap;
}

@media only screen and (max-width: 768px) {
    .footer__social {
        justify-content: center;
    }
}
</style>

