<!DOCTYPE html>
<html lang="id" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="<?= base_url('assets/') ?>" data-template="vertical-menu-template">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title><?= $title ?? 'Dashboard Klub' ?> - PTMSI Sumbar</title>
    <meta name="description" content="Dashboard Klub PTMSI Sumatera Barat" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?= base_url('assets/img/gambar-ptmsi.png') ?>" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="<?= base_url('assets/vendor/fonts/boxicons.css') ?>" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/vendor/css/core.css') ?>" class="template-customizer-core-css" />
    <link rel="stylesheet" href="<?= base_url('assets/vendor/css/theme-default.css') ?>" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="<?= base_url('assets/css/demo.css') ?>" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('assets/vendor/libs/apex-charts/apex-charts.css') ?>" />

    <!-- Page CSS -->
    <?= $this->renderSection('styles') ?>
    <style>
        .klub-full-width {
            width: 100%;
            padding-left: 1.5rem;
            padding-right: 1.5rem;
        }

        .klub-content-inner {
            width: 100%;
            max-width: none;
        }

        .container-xxl {
            max-width: none !important;
        }

        .content-wrapper {
            width: 100%;
        }

        .layout-page {
            width: 100%;
        }

        .klub-content-inner .row {
            margin-left: -0.75rem;
            margin-right: -0.75rem;
        }

        .klub-content-inner .col-12,
        .klub-content-inner .col-lg-4,
        .klub-content-inner .col-lg-6,
        .klub-content-inner .col-xl-3,
        .klub-content-inner .col-md-6 {
            padding-left: 0.75rem;
            padding-right: 0.75rem;
        }

        .klub-content-inner .card {
            width: 100%;
        }

        .layout-page .container-fluid {
            max-width: none !important;
            padding-left: 0 !important;
            padding-right: 0 !important;
        }

        .klub-full-width {
            margin-left: 0 !important;
            margin-right: 0 !important;
        }
    </style>

    <!-- Helpers -->
    <script src="<?= base_url('assets/vendor/js/helpers.js') ?>"></script>
    <script src="<?= base_url('assets/js/config.js') ?>"></script>
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">

            <!-- Menu -->
            <?= $this->include('user/layouts/sidebar') ?>
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">

                <!-- Navbar -->
                <?= $this->include('user/layouts/header') ?>
                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">

                    <!-- Content -->
                    <div class="flex-grow-1 klub-full-width">
                        <div class="klub-content-inner">
                            <?= $this->renderSection('content') ?>
                        </div>
                    </div>
                    <!-- / Content -->

                    <!-- Footer -->
                    <?= $this->include('user/layouts/footer') ?>
                    <!-- / Footer -->

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <script src="<?= base_url('assets/vendor/libs/jquery/jquery.js') ?>"></script>
    <script src="<?= base_url('assets/vendor/libs/popper/popper.js') ?>"></script>
    <script src="<?= base_url('assets/vendor/js/bootstrap.js') ?>"></script>
    <script src="<?= base_url('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') ?>"></script>
    <script src="<?= base_url('assets/vendor/js/menu.js') ?>"></script>

    <!-- Vendors JS -->
    <script src="<?= base_url('assets/vendor/libs/apex-charts/apexcharts.js') ?>"></script>

    <!-- Main JS -->
    <script src="<?= base_url('assets/js/main.js') ?>"></script>

    <!-- Page JS -->
    <?= $this->renderSection('scripts') ?>
</body>

</html>