<body class="g-sidenav-show  bg-gray-200">
    <!-- body part 1 of 3 左側主內容 -->
    <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
        <div class="sidenav-header">
            <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
            <a class="navbar-brand m-0" href="#" target="_blank">
                <img src="/colorful-room/assets/img/logo-ct.png" class="navbar-brand-img h-100" alt="main_logo">
                <span class="ms-1 font-weight-bold text-white">Colorful Room</span>
            </a>
        </div>
        <hr class="horizontal light mt-0 mb-2">
        <div class="collapse navbar-collapse  w-auto  max-height-vh-100" id="sidenav-collapse-main">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <!-- 依照當前當按路徑替換 <a> class -->
                    <?php if (str_contains($_SERVER['PHP_SELF'], 'index.php')) : ?>
                        <a class="nav-link text-white active bg-gradient-primary" href="<?= $url_page_index ?>">
                        <?php else : ?>
                            <a class="nav-link text-white" href="<?= $url_page_index ?>">
                            <?php endif; ?>
                            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="material-icons opacity-10">dashboard</i>
                            </div>
                            <span class="nav-link-text ms-1">Summary</span>
                            </a>
                </li>
                <li class="nav-item">
                    <!-- 依照當前當按路徑替換 <a> class -->
                    <?php if (str_contains($_SERVER['PHP_SELF'], 'pages/order')) : ?>
                        <a class="nav-link text-white active bg-gradient-primary" href="<?= $url_page_order_search ?>">
                        <?php else : ?>
                            <a class="nav-link text-white " href="<?= $url_page_order_search ?>">
                            <?php endif; ?>
                            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="material-icons opacity-10">format_textdirection_r_to_l</i>
                            </div>
                            <span class="nav-link-text ms-1">Order Search</span>
                            </a>
                </li>
                <li class="nav-item">
                    <!-- 依照當前當按路徑替換 <a> class -->
                    <?php if (str_contains($_SERVER['PHP_SELF'], 'pages/order')) : ?>
                        <a class="nav-link text-white active bg-gradient-primary" href="<?= $url_page_order ?>">
                        <?php else : ?>
                            <a class="nav-link text-white " href="<?= $url_page_order ?>">
                            <?php endif; ?>
                            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="material-icons opacity-10">table_view</i>
                            </div>
                            <span class="nav-link-text ms-1">Order</span>
                            </a>
                </li>
                <li class="nav-item">
                    <!-- 依照當前當按路徑替換 <a> class -->
                    <?php if (str_contains($_SERVER['PHP_SELF'], 'pages/product')) : ?>
                        <a class="nav-link text-white active bg-gradient-primary" href="<?= $url_page_product ?>">
                        <?php else : ?>
                            <a class="nav-link text-white " href="<?= $url_page_product ?>">
                            <?php endif; ?>
                            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="material-icons opacity-10">receipt_long</i>
                            </div>
                            <span class="nav-link-text ms-1">Product</span>
                            </a>
                </li>
                <li class="nav-item">
                    <!-- 依照當前當按路徑替換 <a> class -->
                    <?php if (str_contains($_SERVER['PHP_SELF'], 'pages/customer')) : ?>
                        <a class="nav-link text-white active bg-gradient-primary" href="<?= $url_page_user_list ?>">
                        <?php else : ?>
                            <a class="nav-link text-white " href="<?= $url_page_user_list ?>">
                            <?php endif; ?>
                            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="material-icons opacity-10">view_in_ar</i>
                            </div>
                            <span class="nav-link-text ms-1">Customer</span>
                            </a>
                </li>
            </ul>
        </div>
    </aside>