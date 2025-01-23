<?php $currentUri = uri_string(); ?>

<body>
    <div id="app">
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="logo">
                            <img src="<?= base_url('images/' . $yogi->logo_website) ?>" alt="logo" style="max-width: 150%; height: auto; max-height: 100px;"/>
                        </div>
                        <div class="toggler">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>

                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-title">Menu</li>

                        <!-- Dashboard -->
                        <li class="sidebar-item <?= ($currentUri == 'home/dashboard') ? 'active' : '' ?>">
                            <a href="<?= base_url('home/dashboard') ?>" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>

                        <!-- Menu -->
                        <li class="sidebar-item <?= ($currentUri == 'home/lowongan') ? 'active' : '' ?>">
                            <a href="<?= base_url('home/lowongan') ?>" class='sidebar-link'>
                                <i class="fa fa-folder"></i>
                                <span>Lowongan</span>
                            </a>
                        </li>
                        <li class="sidebar-item <?= ($currentUri == 'home/lamaran') ? 'active' : '' ?>">
                            <a href="<?= base_url('home/lamaran') ?>" class='sidebar-link'>
                                <i class="fa fa-user"></i>
                                <span>Lamaran</span>
                            </a>
                        </li>

                        <li class="sidebar-item <?= ($currentUri == 'home/karyawan') ? 'active' : '' ?>">
                            <a href="<?= base_url('home/karyawan') ?>" class='sidebar-link'>
                                <i class="fa fa-user"></i>
                                <span>Karyawan</span>
                            </a>
                        </li>

                        <!-- Pemesanan -->

                        <!-- Modal - Submenu with multiple items -->

                        <!-- Settings -->
                        <li class="sidebar-item <?= ($currentUri == 'home/setting') ? 'active' : '' ?>">
                            <a href="<?= base_url('home/setting') ?>" class='sidebar-link'>
                                <i class="bi bi-file-earmark-medical-fill"></i>
                                <span>Settings</span>
                            </a>
                        </li>

                        <!-- Soft Delete -->
                        <li class="sidebar-item <?= ($currentUri == 'home/soft_delete') ? 'active' : '' ?>">
                            <a href="<?= base_url('home/soft_delete') ?>" class='sidebar-link'>
                                <i class="bi bi-file-earmark-medical-fill"></i>
                                <span>Soft Delete</span>
                            </a>
                        </li>

                        <!-- Restore Edit -->
                        <li class="sidebar-item <?= ($currentUri == 'home/restore_edit_user') ? 'active' : '' ?>">
                            <a href="<?= base_url('home/restore_edit_user') ?>" class='sidebar-link'>
                                <i class="bi bi-file-earmark-medical-fill"></i>
                                <span>Restore Edit</span>
                            </a>
                        </li>

                        <!-- Log Activity -->
                        <li class="sidebar-item <?= ($currentUri == 'home/log_activity') ? 'active' : '' ?>">
                            <a href="<?= base_url('home/log_activity') ?>" class='sidebar-link'>
                                <i class="bi bi-file-earmark-medical-fill"></i>
                                <span>Log Activity</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div id="main">
            <header class="mb-3"></header>
