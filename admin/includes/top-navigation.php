 <!-- Navbar -->
 <div class="container position-sticky z-index-sticky top-0">
        <div class="row">
            <div class="col-12">
                <nav class="navbar navbar-expand-lg  blur border-radius-xl top-0 z-index-fixed shadow position-absolute my-3 py-2 start-0 end-0 mx-4">
                    <div class="container-fluid px-0">
                        <a class="navbar-brand font-weight-bolder ms-sm-3" href="./" rel="tooltip" title="Designed and Coded by Creative Tim" data-placement="bottom">
                       SIES - SMA NEGERI 1 DAYEUHLUHUR
                        </a>
                            <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon mt-2">
                                    <span class="navbar-toggler-bar bar1"></span>
                                    <span class="navbar-toggler-bar bar2"></span>
                                    <span class="navbar-toggler-bar bar3"></span>
                                </span>
                            </button>
                        <div class="collapse navbar-collapse pt-3 pb-2 py-lg-0 w-100" id="navigation">
                            <ul class="navbar-nav navbar-nav-hover ms-auto">
                                <li class="nav-item dropdown dropdown-hover mx-2">
                                    <a class="nav-link ps-2 d-flex cursor-pointer align-items-center <?= $page == "home" ? "text-primary" : "" ?>" href="./" aria-expanded="false">
                                        <i class="material-icons opacity-6 me-2 text-md">home</i> Home
                                    </a>
                                </li>
                                <li class="nav-item dropdown dropdown-hover mx-2">
                                    <a class="nav-link ps-2 d-flex cursor-pointer align-items-center <?= $page == "ekskul" ? "text-primary" : "" ?>" id="clubsDropDon" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="material-icons opacity-6 me-2 text-md text-center">view_list</i> Data Ekskul
                                        <span class="material-icons">keyboard_arrow_down</span>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-animation dropdown-md dropdown-md-responsive p-3 border-radius-lg mt-0 mt-lg-3" aria-labelledby="clubsDropDon">
                                        <div class="d-lg-block d-sm-block">
                                            <li class="nav-item dropdown dropdown-hover dropdown-subitem">
                                                <a class="dropdown-item py-2 ps-3 border-radius-md" href="./?page=ekskul/FormEkskul">
                                                    <div class="w-100 d-flex align-items-center justify-content-between">
                                                        <div>
                                                            <h6 class="text-dark font-weight-bolder d-flex justify-content-cente align-items-center p-0 text-center">Tambah Ekskul</h6>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                            <li class="nav-item dropdown dropdown-hover dropdown-subitem">
                                                <a class="dropdown-item py-2 ps-3 border-radius-md" href="./?page=ekskul">
                                                    <div class="w-100 d-flex align-items-center justify-content-between">
                                                        <div>
                                                            <h6 class="text-dark font-weight-bolder d-flex justify-content-cente align-items-center p-0">List Ekskul</h6>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                        </div>
                                    </ul>
                                </li>
                                <li class="nav-item dropdown dropdown-hover mx-2">
                                    <a class="nav-link ps-2 d-flex cursor-pointer align-items-center <?= $page == "pengguna" ? "text-primary" : "" ?>" id="usersDropDon" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="material-icons opacity-6 me-2 text-md">people_alt</i> Data Pengguna
                                        <span class="material-icons">keyboard_arrow_down</span>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-animation dropdown-md dropdown-md-responsive p-3 border-radius-lg mt-0 mt-lg-3" aria-labelledby="usersDropDon">
                                        <div class="d-lg-block d-sm-block">
                                            <li class="nav-item dropdown dropdown-hover dropdown-subitem">
                                                <a class="dropdown-item py-2 ps-3 border-radius-md" href="./?page=pengguna/FormPengguna">
                                                    <div class="w-100 d-flex align-items-center justify-content-between">
                                                        <div>
                                                            <h6 class="text-dark font-weight-bolder d-flex justify-content-cente align-items-center p-0">Tambah Pengguna</h6>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                            <li class="nav-item dropdown dropdown-hover dropdown-subitem">
                                                <a class="dropdown-item py-2 ps-3 border-radius-md" href="./?page=pengguna">
                                                    <div class="w-100 d-flex align-items-center justify-content-between">
                                                        <div>
                                                            <h6 class="text-dark font-weight-bolder d-flex justify-content-cente align-items-center p-0">List Pengguna</h6>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                        </div>
                                    </ul>
                                </li>
                                <li class="nav-item my-auto ms-3 ms-lg-0">
                                    <a class="nav-link ps-2 d-flex cursor-pointer align-items-center" id="dropdownMenuUser" data-bs-toggle="dropdown" aria-expanded="false">
                                        <span><img src="<?= validate_image($_settings->userdata('foto_profil')) ?>" alt="<?= $_settings->userdata('nama_pengguna') ?> Image" class="image-user img-thumbnail rounded-circle"></span>
                                        Hello, <?= $_settings->userdata('nama_pengguna') ?>
                                        <img src="<?= base_url ?>assets/img/down-arrow-dark.svg" alt="down-arrow" class="arrow ms-auto ms-md-2">
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-animation dropdown-md dropdown-md-responsive mt-0 mt-lg-3 p-3 border-radius-lg" aria-labelledby="dropdownMenuDocs">
                                        <div class="d-lg-block d-sm-block">
                                        <ul class="list-group">
                                            <li class="nav-item list-group-item border-0 p-0">
                                                <a class="dropdown-item py-2 ps-3 border-radius-md" href="<?= base_url ?>admin/?page=KelolaAkun">
                                                    <h6 class="dropdown-header text-dark font-weight-bolder d-flex justify-content-cente align-items-center p-0"><span class="material-icons me-2">manage_accounts</span> Kelola Akun</h6>
                                                </a>
                                            </li>
                                            <li class="nav-item list-group-item border-0 p-0">
                                                <a class="dropdown-item py-2 ps-3 border-radius-md" href="<?= base_url ?>classes/Login.php?f=admin_logout">
                                                    <h6 class="dropdown-header text-dark font-weight-bolder d-flex justify-content-cente align-items-center p-0"><span class="material-icons me-2">logout</span> Logout</h6>
                                                </a>
                                            </li>
                                        </ul>
                                        </div>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
                <!-- End Navbar -->
            </div>
        </div>
    </div>