<?php
isset($home) ? '' : $home = 'text-light';
isset($about) ? '' : $about = 'text-light';
isset($category) ? '' : $category = 'text-light';
isset($active) ? '' : $active = '';
isset($login) ? '' : $login = 'text-light';
isset($upload) ? '' : $upload = 'text-light';
isset($profile) ? '' : $profile = 'text-light';
isset($editAbout) ? '' : $editAbout = 'text-light';

?>



<nav class="navbar navbar-expand-lg sticky-top navbar-light bg-light shadow" style="width: 100%;">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?= base_url() ?>home"><img src="<?= base_url() ?>assets/img/phone-icon.svg" alt="" />Mobile
            Photography</a>


        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
            <ol class="breadcrumb">


                <?php
                if ($home === 'text-warning') {
                    echo '<li class="breadcrumb-item">Home</li>';
                } else if ($about === 'text-warning') {
                    echo '<li class="breadcrumb-item">About</li>';
                } else if ($login === 'text-warning') {
                    echo '<li class="breadcrumb-item">Admin Login</li>';
                } else if ($category === 'text-warning') {
                    echo '<li class="breadcrumb-item">Category</li>';
                    echo '<li class="breadcrumb-item active text-capitalize" aria-current="page">' . $active . '</li>';
                } else if ($upload === 'text-warning') {
                    echo '<li class="breadcrumb-item">Upload Image</li>';
                } else if ($profile === 'text-warning') {
                    echo '<li class="breadcrumb-item">Edit Profile</li>';
                } else if ($editAbout === 'text-warning') {
                    echo '<li class="breadcrumb-item">Edit About</li>';
                }
                ?>

            </ol>
        </div>
    </div>
</nav>
<div class="container-fluid">
    <div class="row">
        <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block text-light bg-dark sidebar collapse">
            <div class="position-sticky sidebar-sticky pt-5">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link <?= $home ?>" aria-current="page" href="<?= base_url() ?>home">
                            <span data-feather="home"></span>
                            Home
                        </a>
                    </li>
                    <li class="nav-item dropdown mx-auto w-100">
                        <a class="nav-link <?= $category ?>" id="navbarLightDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Categories
                        </a>
                        <?php
                        if ($active !== '') { ?>
                            <span class="dropdown-item text-success text-capitalize mx-2" style="cursor: pointer;" id="hide-show"><?= $active ?></span>
                        <?php
                        }
                        ?>

                        <div class="dropdownmenu px-2 dropdown-menu-dark text-light" style="display: none;" id="DropdownMenuLink">


                            <?php

                            foreach ($menu as $row) {
                                if ($active === $row['category']) {
                                    echo '<a class="dropdown-item text-success text-capitalize" href="' . base_url() . 'categories?data=' . $row['category'] . '">' . $row['category'] . '</a>';
                                } else {
                                    echo '<a class="dropdown-item text-light text-capitalize" href="' . base_url() . 'categories?data=' . $row['category'] . '">' . $row['category'] . '</a>';
                                }
                            }
                            ?>

                        </div>
                        <script>
                            $('#navbarLightDropdownMenuLink').click(function(e) {
                                // e.preventDefault();
                                $('#DropdownMenuLink').toggle(1000);
                                $('#hide-show').toggle(1000);


                            });
                        </script>

                    </li>


                    <li class="nav-item">
                        <a class="nav-link <?= $about ?>" aria-current="page" href="<?= base_url() ?>about">About</a>
                    </li>

                    <?php if (!isset($_SESSION['adminonline'])) { ?>

                        <li class="nav-item">
                            <a class="nav-link <?= $login ?>" aria-current="page" href="<?= base_url() ?>login">Admin Login</a>
                        </li>
                    <?php } ?>

                    <?php if (isset($_SESSION['adminonline'])) { ?>

                        <li class="nav-item">
                            <a class="nav-link <?= $upload ?>" aria-current="page" href="<?= base_url() ?>upload">Upload Images</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link <?= $profile ?>" aria-current="page" href="<?= base_url() ?>profile">Edit Profile</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link <?= $editAbout ?>" aria-current="page" href="<?= base_url() ?>edit_about">Edit About</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link text-danger" id="logout" aria-current="page" href="<?= base_url() ?>maincontroller/logout">Logout</a>
                        </li>
                    <?php } ?>


                </ul>
                <div class="copyright">
                    <div class="text-center">
                        <span> <a class="text-light text-decoration-none font-monospace" href="mailto:payalsi87011@gmail.com"><i class="fas fa-envelope"></i> payalsi87011@gmail.com</a> </span>
                        <p class="font-monospace mt-2"><i class="fa fa-copyright" aria-hidden="true"></i> Payal Singh 2021</p>
                    </div>
                </div>
                <style>
                    .copyright {
                        width: 100%;
                        font-size: 15px;
                        position: absolute;
                        bottom: 0;
                    }

                    .nav-link {
                        font-size: 1.1rem;

                    }
                </style>
            </div>
        </nav>