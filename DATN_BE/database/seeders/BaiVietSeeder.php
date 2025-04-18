<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BaiVietSeeder extends Seeder
{
    public function run()
    {
        DB::table('bai_viets')->truncate();

        DB::table('bai_viets')->insert([
            [
                'tieu_de' => 'One Piece: Giả thuyết đen tối của fan tiết lộ Luffy sẽ ra đi trẻ?',
                'slug_tieu_de' => 'one-piece-gia-thuyet-den-toi-cua-fan-tiet-lo-luffy-se-ra-di-tre',
                'hinh_anh' => 'https://gamek.mediacdn.vn/133514250583805952/2023/12/27/photo-1703651571559-17036515716502019562140.png',
                'mo_ta' => 'Người hâm mộ One Piece đưa ra suy đoán về tương lai của Luffy, so sánh anh với Gol D. Roger.',
                'mo_ta_chi_tiet' => 'Monkey D. Luffy là nhân vật chính mang tính biểu tượng của One Piece, cậu đã phải đối mặt với vô số thử thách trong suốt các phần khác nhau của bộ truyện. Những cuộc phiêu lưu thường xuyên nguy hiểm này khiến mạng sống của Luffy gặp nguy hiểm hết lần này đến lần khác. Xem xét lối sống mạo hiểm của cậu ta và tính tàn bạo của các trận chiến, nhiều fan đặt ra câu hỏi là "Liệu Luffy có thể sống được bao lâu?"',
                'id_chuyen_muc' => 1,
                'tinh_trang' => 1
            ],
            [
                'tieu_de' => 'Tại sao Rồng thần Shenron lại sợ Beerus trong Dragon Ball Super?',
                'slug_tieu_de' => 'tai-sao-rong-than-shenron-lai-so-beerus-trong-dragon-ball-super',
                'hinh_anh' => 'https://gamek.mediacdn.vn/133514250583805952/2023/12/26/base64-1703570256670530666608.png',
                'mo_ta' => 'Nguyên nhân khiến Shenron sợ hãi trở nên rõ ràng khi chúng ta xem xét sức mạnh khổng lồ của Beerus với tư cách là Thần hủy diệt.',
                'mo_ta_chi_tiet' => 'Shenron là là Rồng thần trái đất, xuất hiện trong suốt chiều dài lịch sử của series Dragon Ball. Nó nổi tiếng với khả năng ban điều ước và là trung tâm của nhiều cuộc phiêu lưu sử thi trong loạt phim.',
                'id_chuyen_muc' => 1,
                'tinh_trang' => 1
            ],
            [
                'tieu_de' => 'Tại sao mắt của Tobirama Senju trong Naruto lại có màu đỏ?',
                'slug_tieu_de' => 'tai-sao-mat-cua-tobirama-senju-trong-naruto-lai-co-mau-do',
                'hinh_anh' => 'https://gamek.mediacdn.vn/133514250583805952/2023/12/29/photo-1703825363855-17038253642581779386748.png',
                'mo_ta' => 'Tobirama Senju có đôi mắt đỏ màu đỏ trong anime Naruto, khiến nhiều người đặt ra giả thuyết về đặc điểm ngoại hình này.',
                'mo_ta_chi_tiet' => 'Trong câu chuyện của Naruto, nhân vật Hokage đệ nhị Tobirama Senju có một đặc điểm hấp dẫn: đó là đôi mắt đỏ. Điểm đặc biệt về mặt hình ảnh này là nguồn gốc của nhiều suy đoán khác nhau giữa những người hâm mộ bộ truyện. Có một giả thuyết được đặt ra là Tobirama mắc bệnh bạch tạng, vì trên thực tế, những người mắc bệnh này thường có mắt đỏ hoặc hồng do thiếu sắc tố.',
                'id_chuyen_muc' => 1,
                'tinh_trang' => 1
            ],
            [
                'tieu_de' => '8 sự ra đi buồn nhất của nhân vật fan yêu mến trong anime năm 2023',
                'slug_tieu_de' => '8-su-ra-di-buon-nhat-cua-nhan-vat-fan-yeu-men-trong-anime-nam-2023',
                'hinh_anh' => 'https://gamek.mediacdn.vn/thumb_w/640/133514250583805952/2023/12/29/base64-17038237692711199395634.png',
                'mo_ta' => 'Những nhân vật đã rời bỏ khán giả đã tại ra nỗi mất mát khó quên của anime năm 2023.',
                'mo_ta_chi_tiet' => 'Khi năm 2023 sắp kết thúc, người hâm mộ anime trên toàn thế giới đã tạm biệt nhiều câu chuyện cảm động. Đồng thETIME, kỳ vọng ngày càng tăng đối với các bộ phim phát hành mới vào năm 2024, bao gồm cả những bộ phim được chờ đợi từ lâu như Solo Leveling và Suicide Squad Isekai',
                'id_chuyen_muc' => 1,
                'tinh_trang' => 1
            ],
            [
                'tieu_de' => 'Họa sĩ One Punch Man tái hiện trang bìa Dragon Ball',
                'slug_tieu_de' => 'hoa-si-one-punch-man-tai-hien-trang-bia-dragon-ball',
                'hinh_anh' => 'https://gamek.mediacdn.vn/thumb_w/690/133514250583805952/2023/12/28/photo-1703742089806-1703742089969604534140-0-83-675-1163-crop-1703742309550355505991.png',
                'mo_ta' => 'Nhiều trang bìa manga do một số tác giả nổi tiếng của Shonen Jump vẽ sẽ được trưng bày để kỉ niệm 40 năm Dragon Bal ra mắt.',
                'mo_ta_chi_tiet' => 'Vào năm 2024, Dragon Ball - bộ truyện tranh mang tính biểu tượng của Akira Toriyama sẽ đạt được một cột mốc lịch sử: kỷ niệm 40 năm thành lập. Kể từ khi xuất hiện lần đầu trên các trang tạp chí Weekly Shonen Jump của Shueisha vào năm 1984, Dragon Ball đã trở thành một hiện tượng toàn cầu. Để đánh dấu sự kiện này, Shueisha đang lên kế hoạch tổ chức lễ kỷ niệm quy mô lớn, bao gồm một triển lãm nghệ thuật độc đáo tại Nhật Bản.',
                'id_chuyen_muc' => 1,
                'tinh_trang' => 1
            ],
            [
                'tieu_de' => 'Không phải KnY hay One Piece, đây mới là anime được nhắc đến nhiều nhất trên Twitter năm 2023',
                'slug_tieu_de' => 'khong-phai-kny-hay-one-piece-day-moi-la-anime-duoc-nhac-den-nhieu-nhat-tren-twitter-nam-2023',
                'hinh_anh' => 'https://gamek.mediacdn.vn/thumb_w/640/133514250583805952/2023/12/28/82a3403c073edde0703175ad8c0f9bee-1703740179635-17037401797391237485002.jpg',
                'mo_ta' => 'Mobile Suit GTA: The Witch From Mercury là anime được nhắc đến nhiều nhất trên Twitter năm 2023.',
                'mo_ta_chi_tiet' => 'Vừa qua, tài khoản @TrendAward đã tỉ mỉ xem xét siêu dữ liệu của các bài đăng bằng tiếng Nhật. Giống như một thám tử kỹ thuật số" với kính lúp trong tay, tài khoản này xác định rằng Frieren: Beyond Journey s End, Mobile Suit GTA: The Witch From Mercury và các tác phẩm đáng ngạc nhiên khác đã chinh phục bục thảo luận của cư dân mạng trên Twitter. Quá trình truy xét của @TrendAward đã biến những dòng tweet đơn giản thành dữ liệu có giá trị',
                'id_chuyen_muc' => 1,
                'tinh_trang' => 1
            ],
            [
                'tieu_de' => 'Top 10 anime isekai hay nhất năm 2023',
                'slug_tieu_de' => 'top-10-anime-isekai-hay-nhat-nam-2023',
                'hinh_anh' => 'https://gamek.mediacdn.vn/133514250583805952/2023/12/26/base64-1703499929978265862019-1703562956622-17035629567681010844098-1703567561585-1703567562290966755689.png',
                'mo_ta' => 'Sức hấp dẫn của Isekai nằm ở khả năng đưa các nhân vật thực tế vào thế giới giả tưởng, cung cấp nền tảng để khám phá những câu chuyện sáng tạo và độc đáo.',
                'mo_ta_chi_tiet' => 'Trong những năm gần đây, thể loại Isekai đã định nghĩa lại thế giới anime, thu hút người hâm mộ cũng như những người sáng tạo bằng tiền đề đổi mới và sự tự do sáng tạo. Xu hướng này vẫn tiếp tục mạnh mẽ vào năm 2023, với một số tựa phim isekai nổi bật trên thị trường.',
                'id_chuyen_muc' => 1,
                'tinh_trang' => 1
            ],
            [
                'tieu_de' => 'Suicide Squad Isekai',
                'slug_tieu_de' => 'suicide-squad-isekai',
                'hinh_anh' => 'https://img.youtube.com/vi/TtwBgQ82Pls/maxresdefault.jpg',
                'mo_ta' => 'Suicide Squad Isekai" đưa các nhân vật mang tính biểu tượng của DC',
                'mo_ta_chi_tiet' => 'Suicide Squad Isekai" đưa các nhân vật mang tính biểu tượng của DC, như Harley Quinn và Joker, đến một thế giới giả tưởng khác. Loạt phim sáng tạo này sẽ kết hợp thể loại isekai với các nhân vật nổi tiếng từ vũ trụ DC, hứa hẹn mang lại trải nghiệm độc đáo và hấp dẫn cho người hâm mộ của cả hai thế giới',
                'id_chuyen_muc' => 2,
                'tinh_trang' => 1
            ],
            [
                'tieu_de' => 'Devil May Cry',
                'slug_tieu_de' => 'devil-may-cry',
                'hinh_anh' => 'https://gamek.mediacdn.vn/133514250583805952/2023/12/22/photo-1703237487622-1703237487777128710843.png',
                'mo_ta' => 'Bộ phim hoạt hình chuyển thể từ Devil May Cry của Netflix do Adi Shankar sản xuất',
                'mo_ta_chi_tiet' => 'Bộ phim hoạt hình chuyển thể từ Devil May Cry của Netflix do Adi Shankar sản xuất hứa hẹn sẽ là một sự bùng nổ về hành động và phong cách. Bộ phim sẽ tập trung vào hai anh em nửa quỷ Dante và Vergil, mang những trận chiến thú vị trong trò chơi đến với thế giới anime.',
                'id_chuyen_muc' => 2,
                'tinh_trang' => 1
            ],
            [
                'tieu_de' => 'One Piece arc Egghead',
                'slug_tieu_de' => 'one-piece-arc-egghead',
                'hinh_anh' => 'https://gamek.mediacdn.vn/133514250583805952/2023/12/22/one-piece-anime-1024x576-1703237488617-17032374887422069848365.jpg',
                'mo_ta' => 'Arc Egghead của One Piece được kỳ vọng sẽ vượt qua thành công của anime năm 2023',
                'mo_ta_chi_tiet' => 'Arc Egghead của One Piece được kỳ vọng sẽ vượt qua thành công của anime năm 2023, hứa hẹn gây bất ngờ với những tiết lộ lớn và các trận chiến ngoạn mục. Sau phần Wano đầy kịch tính, arc Egghead hứa hẹn sẽ khiến người hâm mộ đứng ngồi không yên khi những kẻ phản diện cuối cùng sẽ tiết lộ ý định thực sự của chúng.',
                'id_chuyen_muc' => 2,
                'tinh_trang' => 1
            ],
            [
                'tieu_de' => 'Dandadan',
                'slug_tieu_de' => 'dandadan',
                'hinh_anh' => 'https://gamek.mediacdn.vn/133514250583805952/2023/12/22/photo-1703237571625-1703237571817250223128.png',
                'mo_ta' => 'Dandadan theo chân hai học sinh trung học trên một hành trình bất thường để chứng minh sự tồn tại của người ngoài hành tinh.',
                'mo_ta_chi_tiet' => 'Dandadan theo chân hai học sinh trung học trên một hành trình bất thường để chứng minh sự tồn tại của người ngoài hành tinh.',
                'id_chuyen_muc' => 2,
                'tinh_trang' => 1
            ],
            [
                'tieu_de' => 'Bleach: Thousand Year Blood War Phần 3',
                'slug_tieu_de' => 'bleach-thousand-year-blood-war-phan-3',
                'hinh_anh' => 'https://gamek.mediacdn.vn/thumb_w/640/133514250583805952/2023/12/22/bleach-thousand-year-blood-war-arc-1703237572626-17032375727312064364717.jpg',
                'mo_ta' => 'Phần thứ ba của loạt phim Bleach: Thousand Year Blood War hứa hẹn sẽ giúp nâng tầm thương hiệu',
                'mo_ta_chi_tiet' => 'Phần thứ ba của loạt phim Bleach: Thousand Year Blood War hứa hẹn sẽ giúp nâng tầm thương hiệu. Với nhiều cải tiến so với manga, phần này tập trung vào những trận chiến hoành tráng và cuộc đối đầu cuối cùng với Vua Quincy Yhwach, hứa hẹn một kết cục kịch tính và mạnh mẽ.',
                'id_chuyen_muc' => 2,
                'tinh_trang' => 1
            ],
            [
                'tieu_de' => 'Kaiju số 8',
                'slug_tieu_de' => 'kaiju-so-8',
                'hinh_anh' => 'https://gamek.mediacdn.vn/thumb_w/640/133514250583805952/2023/12/22/6912585-1-1659694205-62-e1659694223288-1703237591406-1703237591517774877253.jpg',
                'mo_ta' => 'Kaiju số 8 lấy bối cảnh một thế giới bị tàn phá bởi các cuộc tấn công từ những con quái vật khổng lồ',
                'mo_ta_chi_tiet' => 'Kaiju số 8 lấy bối cảnh một thế giới bị tàn phá bởi các cuộc tấn công từ những con quái vật khổng lồ, tập trung vào Kafka Hibino, một người đàn ông có được khả năng của kaiju. Hành trình trở thành một phần của lực lượng phòng thủ chống lại những con quái vật của Kafka Hibino hứa hẹn sẽ đầy rẫy những pha hành động và diễn biến nhân vật hấp dẫn.',
                'id_chuyen_muc' => 2,
                'tinh_trang' => 1
            ],
            [
                'tieu_de' => 'My Hero Academia mùa 7',
                'slug_tieu_de' => 'my-hero-academia-mua-7',
                'hinh_anh' => 'https://gamek.mediacdn.vn/133514250583805952/2023/12/22/photo-1703237260908-17032372619231329486932.png',
                'mo_ta' => 'Mùa thứ bảy của anime My Hero Academia hứa hẹn sẽ chuyển thể một phần quan trọng của bộ truyện',
                'mo_ta_chi_tiet' => 'Mùa thứ bảy của anime My Hero Academia hứa hẹn sẽ chuyển thể một phần quan trọng của bộ truyện, đánh dấu sự khởi đầu của những trận chiến cuối cùng. Với việc All For One ngày càng trở nên mạnh mẽ hơn, Deku, Bakugo và Lớp 1A sẽ phải đối mặt với những thử thách chưa từng có, tiếp tục câu chuyện hấp dẫn của bộ truyện.',
                'id_chuyen_muc' => 2,
                'tinh_trang' => 1
            ],
            [
                'tieu_de' => 'Solo Leveling',
                'slug_tieu_de' => 'solo-leveling',
                'hinh_anh' => 'https://gamek.mediacdn.vn/thumb_w/640/133514250583805952/2023/12/22/dpo1696581732-1703237629781-17032376299621943280956.jpg',
                'mo_ta' => 'Solo Leveling có thể so sánh với One-Punch Man trong quỹ đạo thành công của nó',
                'mo_ta_chi_tiet' => 'Solo Leveling có thể so sánh với One-Punch Man trong quỹ đạo thành công của nó. Tác phẩm sẽ được chuyển thể bởi A-1 Pictures, kể về hành trình của thợ săn yếu nhất thế giới trở thành người mạnh nhất, sau trải nghiệm cận kề cái chết mang lại cho anh một sức mạnh độc nhất.',
                'id_chuyen_muc' => 2,
                'tinh_trang' => 1
            ],
        ]);
    }
}
