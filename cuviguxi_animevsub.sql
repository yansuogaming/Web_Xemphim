-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost:3306
-- Thời gian đã tạo: Th1 21, 2025 lúc 02:25 PM
-- Phiên bản máy phục vụ: 5.7.41-cll-lve
-- Phiên bản PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `cuviguxi_animevsub`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `backlink`
--

CREATE TABLE `backlink` (
  `id` int(10) NOT NULL,
  `tieude` varchar(225) NOT NULL,
  `mota` varchar(225) NOT NULL,
  `url` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `backlink`
--

INSERT INTO `backlink` (`id`, `tieude`, `mota`, `url`) VALUES
(1, 'Youtube', 'Kênh Youtube nhạc phim Remix', 'https://www.youtube.com/@tienlongmusic'),
(2, 'Facebook', 'Facebook liên hệ', 'https://www.facebook.com/dinhlong0510/');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loaiphim`
--

CREATE TABLE `loaiphim` (
  `id` int(11) NOT NULL,
  `ten_loai` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `mo_ta` text,
  `ngay_tao` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ngay_cap_nhat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `loaiphim`
--

INSERT INTO `loaiphim` (`id`, `ten_loai`, `slug`, `mo_ta`, `ngay_tao`, `ngay_cap_nhat`) VALUES
(8, 'Phim bộ', 'phim-bo', 'Phim nhiều tập', '2024-11-19 03:42:34', '2024-11-19 08:06:52'),
(9, 'Phim lẻ', 'phim-le', 'Phim chỉ có một tập duy nhất', '2024-11-19 03:42:48', '2024-11-19 08:06:59');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phim`
--

CREATE TABLE `phim` (
  `id` int(10) NOT NULL,
  `tenphim` varchar(225) COLLATE utf8mb4_unicode_ci NOT NULL,
  `thumbnail` varchar(225) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(225) COLLATE utf8mb4_unicode_ci NOT NULL,
  `theloai` varchar(225) COLLATE utf8mb4_unicode_ci NOT NULL,
  `namphim` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mota` varchar(9999) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `loaiphim` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tenkhac` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thoiluong` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tag` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tongsotap` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updatephim` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thoigian` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `phim`
--

INSERT INTO `phim` (`id`, `tenphim`, `thumbnail`, `link`, `theloai`, `namphim`, `mota`, `loaiphim`, `tenkhac`, `thoiluong`, `tag`, `tongsotap`, `updatephim`, `thoigian`) VALUES
(89, 'Doraemon New Season', 'https://i.ibb.co/ZL3SHn9/IMG-0106.png', 'doraemon', '1', '2000', 'Doraemon, được gọi thân mật là Mèo ú ở Việt Nam, là một nhân vật huyền thoại xuất hiện trong bộ truyện tranh cùng tên của họa sĩ Fujiko F. Fujio. Không chỉ trở thành biểu tượng văn hóa của Nhật Bản, Doraemon còn được biết đến và yêu mến ở nhiều quốc gia trên toàn thế giới.', '8', 'Chú Mèo Máy Đến Từ Tương Lai', '25 phút', 'doraemon', '800', '5', '2024-12-20 09:49:11'),
(76, 'Your Name - Kimi no Na wa', 'https://i.imgur.com/5fu55qs.jpg', 'your-name-kimi-no-na-wa', '2', '2015', 'Một bộ phim cùng tác giả với 5 centimet trên giây. Kể về câu chuyện của cặp đôi thường xuyên bị hoán đổi cơ thể và nổ lực cứu lấy nữ chính khỏi thảm cảnh, cũng như nổ lực nhớ lấy tên đối phương.', '9', 'Tên cậu là gì ?', '1 giờ', '', 'Full', '2', '2024-11-19 06:31:32'),
(90, 'Gã Hề Điên Loạn 3', 'https://image.tmdb.org/t/p/original/qWwwzjkkoQo22GpVEa7DkxsRZzn.jpg', 'ga-he-dien-loan-3', '3', '2024', 'Tiếp tục câu chuyện rùng rợn của Art the Clown (do David Howard Thornton thủ vai), diễn ra trong bối cảnh mùa Giáng sinh. Lần này Art tái xuất và tàn phá dân cư tại quận Miles với những hành vi tàn ác đẫm máu từ xâm nhập các quán bar, giả dạng ông già Noel và mang \"quà\" đầy kinh dị đến cho trẻ em tại trung tâm thương mại. Các món quà mà Art trao cho bọn trẻ chứa đựng những quả bom gây ra cảnh tượng hỗn loạn khi hàng loạt người chết.', '9', 'Terrifier 3 (2024)', '124 phút', 'ga he dien loan, terrifier 3', 'Full', '2', '2024-11-20 11:50:27'),
(92, 'Mồ Tra Tấn ', 'https://cinematrace.com/wp-content/uploads/2024/09/2400.33x400.3x.jpg?w=1024', 'mo-tra-tan', '3', '2024', 'Sau khi cha mẹ Sita thiệt mạng bất ngờ trong một vụ đánh bom liều chết, chỉ vì câu chuyện truyền miệng về Mồ Tra Tấn. Đau đớn và phẫn nộ, Sita quyết dành cả đời mình để chứng minh rằng Mồ Tra Tấn không tồn tại. Cho đến khi Sita quyết định ngủ trong ngôi mộ của một xác chết, sự thật kinh hoàng hé lộ, tất cả vượt xa sự hiểu biết của loài người...', '9', 'Grave Torture', '116 phút', 'mo tra tan, grave torture', 'Full', '2', '2024-11-20 12:31:29'),
(98, 'Đố Anh Còng Được Tôi', 'https://m.media-amazon.com/images/M/MV5BNmFkM2E2ODYtOGMxZC00YWMwLTgxNTAtNGUyNDFkNDQwYWE1XkEyXkFqcGc@._V1_.jpg', 'do-anh-cong-duoc-toi', '4', '2024', 'Các thanh tra kỳ cựu nổi tiếng đã hoạt động trở lại! Thám tử Seo Do-cheol (HWANG Jung-min) và đội điều tra tội phạm nguy hiểm của anh không ngừng truy lùng tội phạm cả ngày lẫn đêm, đặt cược cả cuộc sống cá nhân của họ. Nhận một vụ án sát hại một giáo sư, đội thanh tra nhận ra những mối liên hệ với các vụ án trong quá khứ và nảy sinh những nghi ngờ về một kẻ giết người hàng loạt. Điều này đã khiến cả nước rơi vào tình trạng hỗn loạn. Khi đội thanh tra đi sâu vào cuộc điều tra, kẻ sát nhân đã chế nhạo họ bằng cách công khai tung ra một đoạn giới thiệu trực tuyến, chỉ ra nạn nhân tiếp theo và làm gia tăng sự hỗn loạn. Để giải quyết mối đe dọa ngày càng leo thang, nhóm đã kết nạp một sĩ quan tân binh trẻ Park Sun-woo (JUNG Hae-in), dẫn đến những khúc mắc và đầy rẫy bất ngờ trong vụ án.', '9', 'The Executioner', '118 phút', 'do anh cong duoc toi, The Executioner', 'Full', '2', '2024-11-22 09:15:42'),
(103, 'Thiếu Niên Và Chim Diệc', 'https://upload.wikimedia.org/wikipedia/vi/8/88/THI%E1%BA%BEU_NI%C3%8AN_V%C3%80_CHIM_DI%E1%BB%86C_-_Vietnam_poster.jpg', 'thieu-nien-va-chim-diec', '1', '2023', 'Đến từ Studio Ghibli và đạo diễn Miyazaki Hayao, bộ phim là câu chuyện về hành trình kỳ diệu của cậu thiếu niên Mahito trong một thế giới hoàn toàn mới lạ. Trải qua nỗi đau mất mẹ cùng mối quan hệ chẳng mấy vui vẻ với gia đình cũng như bạn học, Mahito dần cô lập bản thân... cho đến khi cậu gặp một chú chim diệc biết nói kỳ lạ. Mahito cùng chim diệc bước vào một tòa tháp bí ẩn, nơi một thế giới thần kỳ mở ra, đưa cậu gặp gỡ những người mình yêu thương... trong một nhân dạng hoàn toàn khác.', '9', 'The Boy And The Heron', '124 phút', 'thieu nien va chim diec', 'Full', '2', '2024-11-26 06:22:20'),
(102, 'Máy Bay Ném Bom', 'https://m.media-amazon.com/images/M/MV5BN2ZhMmUzZmYtYTFjNC00OThlLWE0MDAtZWVhZTgyZWQ3ZDJlXkEyXkFqcGc@._V1_FMjpg_UX1000_.jpg', 'may-bay-nem-bom', '6', '2024', 'Câu chuyện về phi công chiến đấu người Ireland Brendan \"Paddy\" Finucane, khi mới 21 tuổi, đã trở thành chỉ huy phi đoàn trẻ nhất trong Không quân Hoàng gia và là một trong những phi công chiến đấu vĩ đại và nổi tiếng nhất của lực lượng này trong Thế chiến II.', '9', 'The Shamrock Spitfire', '108 phút', 'may bay nem bom', 'Full', '2', '2024-11-26 06:22:40'),
(104, 'Những Người Bạn Tưởng Tượng', 'https://iguov8nhvyobj.vcdn.cloud/media/catalog/product/cache/1/image/c5f0a1eff4c394a251036189ccddaacd/i/f/if_movie_poster_700x1000.jpg', 'nhung-nguoi-ban-tuong-tuong', '1', '2024', '', '9', 'If', '104 phút', 'nhung nguoi ban tuong tuong', 'Full', '2', '2024-11-26 06:27:24'),
(111, 'Cười 2', 'https://m.media-amazon.com/images/M/MV5BNDRjZmZhZTEtMzdlYi00MmE0LTgyZGMtZDc5ZWI0MjcxZTliXkEyXkFqcGc@._V1_.jpg', 'cuoi-2', '3', '2024', 'Ngôi sao nhạc pop Skye Riley chuẩn bị bắt đầu chuyến lưu diễn vòng quanh thế giới và trải qua những sự kiện đáng sợ không thể giải thích. Nỗi kinh hoàng ngày càng leo thang và áp lực của sự nổi tiếng, Skye buộc phải đối mặt với quá khứ của mình.', '9', 'Smile 2', '129 phút', 'smile 2, cuoi 2', 'Full', '2', '2024-12-06 10:33:07');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `taikhoan`
--

CREATE TABLE `taikhoan` (
  `id` int(10) NOT NULL,
  `username` varchar(225) NOT NULL,
  `password` varchar(225) NOT NULL,
  `quyen` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `taikhoan`
--

INSERT INTO `taikhoan` (`id`, `username`, `password`, `quyen`) VALUES
(1, 'vohuunhan', 'vohuunhan241201', 'Admin'),
(2, 'yansuogaming', 'long2002', 'Admin');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tap`
--

CREATE TABLE `tap` (
  `id` int(10) NOT NULL,
  `tap` varchar(225) NOT NULL,
  `link` varchar(999) NOT NULL,
  `player` varchar(9999) NOT NULL,
  `slug` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `tap`
--

INSERT INTO `tap` (`id`, `tap`, `link`, `player`, `slug`) VALUES
(286, 'Tập 1 (Full)', 'your-name-kimi-no-na-wa', 'https://ok.ru/videoembed/7268533602865?autoplay=1&nochat=1&muted=0', 'tap-1'),
(394, 'Tập 1 (Full)', 'do-anh-cong-duoc-toi', 'https://ok.ru/videoembed/7926818212511?autoplay=1', 'tap-1'),
(395, 'Tập 1(Full)', 'may-bay-nem-bom', 'https://ok.ru/videoembed/7926895807135?autoplay=1', 'tap-1'),
(396, 'Tập 1 (Full)', 'thieu-nien-va-chim-diec', 'https://ok.ru/videoembed/7441195797175?autoplay=1', 'tap-1'),
(397, 'Tập 1 (Full)', 'nhung-nguoi-ban-tuong-tuong', 'https://ok.ru/videoembed/8159885331120?autoplay=1', 'tap-1'),
(398, 'Tập 1', 'doraemon', 'https://geo.dailymotion.com/player.html?video=x5cbzzh', 'tap-1'),
(399, 'Tập 1 (Full)', 'cuoi-2', 'https://ok.ru/videoembed/9658843728566?autoplay=1', 'tap-1'),
(392, 'Tập 1 (Full)', 'mo-tra-tan', 'https://ok.ru/videoembed/9134442089142?autoplay=1', 'tap-1'),
(393, 'Tập 2', 'doraemon', 'https://mega.nz/file/BQMzlTwL#j3IxmpThz-lh8doQu_vIRUljHu3td-G1QFt1xeMviz0', 'tap-2'),
(401, 'Tập 4', 'doraemon', 'https://www.dailymotion.com/video/x4kkwg4', 'tap-4'),
(388, 'Tập 3', 'doraemon', 'https://geo.dailymotion.com/player.html?video=x5cbzzh2', 'tap-3'),
(389, 'Tập 1 (Full)', 'ga-he-dien-loan-3', 'https://ok.ru/videoembed/9103260781238?autoplay=1', 'tap-1');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `theloai`
--

CREATE TABLE `theloai` (
  `id` int(11) NOT NULL,
  `ten_theloai` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mo_ta` mediumtext COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `theloai`
--

INSERT INTO `theloai` (`id`, `ten_theloai`, `slug`, `mo_ta`) VALUES
(1, 'Hoạt Hình', 'hoat-hinh', 'Phim dành cho trẻ thiếu nhi'),
(2, 'Tình cảm, lãng mạn', 'tinh-cam', 'Phim cho tình yêu đôi lứa'),
(3, 'Kinh Dị', 'kinh-di', 'Phim dành cho người yếu tim '),
(4, 'Hành Động', 'hanh-dong', 'Phim mạo hiểm'),
(5, 'Hài Hước', 'hai-huoc', 'Phim hài dành cho mọi lứa tuổi'),
(6, 'Chiến Tranh', 'chien-tranh', 'Phim về thời kháng chiến'),
(7, 'Võ Thuật', 'vo-thuat', 'Phim võ thuật đỉnh cao của các nhà võ thuật đình đám');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thongtin`
--

CREATE TABLE `thongtin` (
  `id` int(10) NOT NULL,
  `tieude` varchar(255) NOT NULL,
  `mota` varchar(999) NOT NULL,
  `appid` varchar(255) NOT NULL,
  `google` varchar(255) NOT NULL,
  `facebook` varchar(255) NOT NULL,
  `linktrang` varchar(255) NOT NULL,
  `style` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `thongtin`
--

INSERT INTO `thongtin` (`id`, `tieude`, `mota`, `appid`, `google`, `facebook`, `linktrang`, `style`) VALUES
(1, 'Xem phim Online miễn phí', 'Xem phim hoạt hình, phim Việt Nam miễn phí, phim HD online', '2074563556000505', 'Q6h9cufNBCWNK9i8roIVZY-Rw_GZzldll9AWSNl_-G0', '100035048220321', 'https://dinhtlong.com', 'style.css');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `backlink`
--
ALTER TABLE `backlink`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `loaiphim`
--
ALTER TABLE `loaiphim`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `phim`
--
ALTER TABLE `phim`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `taikhoan`
--
ALTER TABLE `taikhoan`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tap`
--
ALTER TABLE `tap`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `theloai`
--
ALTER TABLE `theloai`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `thongtin`
--
ALTER TABLE `thongtin`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `backlink`
--
ALTER TABLE `backlink`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `loaiphim`
--
ALTER TABLE `loaiphim`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `phim`
--
ALTER TABLE `phim`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT cho bảng `taikhoan`
--
ALTER TABLE `taikhoan`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `tap`
--
ALTER TABLE `tap`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=402;

--
-- AUTO_INCREMENT cho bảng `theloai`
--
ALTER TABLE `theloai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `thongtin`
--
ALTER TABLE `thongtin`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
