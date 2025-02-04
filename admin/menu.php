<div class="br-logo"><a href="/AdminQL"><span>[</span>Admin<span>]</span></a></div>
<div class="br-sideleft overflow-y-auto ps ps--theme_default ps--active-y"
     data-ps-id="38e997f2-8cca-66ec-1e2e-7fb777e56fb8">
    <label class="sidebar-label pd-x-15 mg-t-20">Navigation</label>
    <div class="br-sideleft-menu">
        <a href="/AdminQL" class="br-menu-link">
            <div class="br-menu-item">
                <i class="menu-item-icon icon ion-ios-home-outline tx-22"></i>
                <span class="menu-item-label">Quản lý</span>
            </div><!-- menu-item -->
        </a><!-- br-menu-link -->
        <a href="film" class="br-menu-link">
            <div class="br-menu-item">
                <i class="menu-item-icon icon ion-ios-email-outline tx-24"></i>
                <span class="menu-item-label">Thêm phim</span>
            </div>
        </a>
        <a href="khophim" class="br-menu-link">
            <div class="br-menu-item">
                <i class="menu-item-icon icon ion-ios-photos-outline tx-20"></i>
                <span class="menu-item-label">Kho phim</span>
            </div><!-- menu-item -->
        </a>

<!--        <a href="UP.php" class="br-menu-link">-->
<!--            <div class="br-menu-item">-->
<!--                <i class="menu-item-icon icon ion-ios-book-outline tx-22"></i>-->
<!--                <span class="menu-item-label">Upload ảnh lên IMGUR</span>-->
<!--            </div> menu-item -->
<!--        </a>-->

        <a href="upload_loaiphim" class="br-menu-link">
            <div class="br-menu-item">
                <i class="menu-item-icon icon ion-ios-book-outline tx-22"></i>
                <span class="menu-item-label">Upload loại phim </span>
            </div>
        </a>
<!--        <a href="backlink" class="br-menu-link">-->
<!--            <div class="br-menu-item">-->
<!--                <i class="menu-item-icon icon ion-ios-book-outline tx-22"></i>-->
<!--                <span class="menu-item-label">Liên kết bạn bè</span>-->
<!--            </div>-->
<!--        </a>-->
        <a href="upload_theloaiphim" class="br-menu-link">
            <div class="br-menu-item">
                <i class="menu-item-icon icon ion-ios-book-outline tx-22"></i>
                <span class="menu-item-label">Thể loại phim</span>
            </div><!-- menu-item -->
        </a>
        <a href="caidat" class="br-menu-link">
            <div class="br-menu-item">
                <i class="menu-item-icon icon ion-ios-gear-outline tx-24"></i>
                <span class="menu-item-label">Cài đặt</span>
            </div><!-- menu-item -->
        </a>
    </div>

    <br>
    <div class="ps__scrollbar-x-rail" style="left: 0px; bottom: 0px;">
        <div class="ps__scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div>
    </div>
    <div class="ps__scrollbar-y-rail" style="top: 0px; height: 607px; right: 0px;">
        <div class="ps__scrollbar-y" tabindex="0" style="top: 0px; height: 428px;"></div>
    </div>
</div>
<div class="br-header">
    <div class="br-header-left">
        <div class="navicon-left hidden-md-down"><a id="btnLeftMenu" href=""><i class="icon ion-navicon-round"></i></a>
        </div>
        <div class="navicon-left hidden-lg-up"><a id="btnLeftMenuMobile" href=""><i class="icon ion-navicon-round"></i></a>
        </div>
        <div class="input-group hidden-xs-down wd-170 transition">
            <input id="searchbox" type="text" class="form-control" placeholder="Search">
            <span class="input-group-btn">
            <button class="btn btn-secondary" type="button"><i class="fa fa-search"></i></button>
          </span>
        </div><!-- input-group -->
    </div><!-- br-header-left -->

</div>
<script>
    // Đảm bảo jQuery được tải trước khi sử dụng
    function loadScript(scriptUrl, callback) {
        const script = document.createElement('script');
        script.src = scriptUrl;
        script.type = 'text/javascript';

        script.onload = function () {
            if (callback) callback();
        };

        document.head.appendChild(script);
    }

    // Tải jQuery trước tiên
    loadScript('https://code.jquery.com/jquery-3.6.0.min.js', function () {

        // Đặt $ thành jQuery để tránh xung đột
        const $ = jQuery;

        // Tải các thư viện khác sau jQuery
        loadScript('https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js', function () {
            loadScript('https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js', function () {

                // Đặt logic vào đây, đảm bảo jQuery sẵn sàng
                $(document).ready(function () {
                    const currentUrl = window.location.href;

                    // Không chạy logic trên "khophim" và "caidat"
                    if (currentUrl.includes('/AdminQL/khophim') || currentUrl.includes('/AdminQL/caidat')) {
                        console.log('Bỏ qua logic JavaScript trên trang khophim và caidat.');
                        return; // Dừng thực thi
                    }

                    const body = $('body');
                    const sideMenu = $('.br-sideleft');
                    const menuLabels = $('.br-sideleft .menu-item-label');

                    // Xử lý sự kiện nhấn nút thu gọn/mở rộng menu
                    $('#btnLeftMenu').on('click', function (e) {
                        e.preventDefault();
                        body.toggleClass('collapsed-menu');

                        if (body.hasClass('collapsed-menu')) {
                            // Khi menu thu gọn
                            menuLabels.addClass('op-lg-0-force d-lg-none');
                        } else {
                            // Khi menu mở rộng
                            menuLabels.removeClass('op-lg-0-force d-lg-none');
                        }
                    });

                    // Xử lý khi di chuột vào menu
                    sideMenu.on('mouseenter', function () {
                        if (body.hasClass('collapsed-menu')) {
                            body.addClass('expand-menu');
                            menuLabels.removeClass('op-lg-0-force d-lg-none');
                        }
                    });

                    // Xử lý khi di chuột ra khỏi menu
                    sideMenu.on('mouseleave', function () {
                        if (body.hasClass('collapsed-menu')) {
                            body.removeClass('expand-menu');
                            menuLabels.addClass('op-lg-0-force d-lg-none');
                        }
                    }); // Đóng dấu ngoặc bị thiếu ở đây
                });
            });
        });
    });
</script>


