<section class="py-3">
    <div class="container">
        <div class="row">
            <div class="col-md-3 position-relative bg-gradient bg-opacity-50">
                <div class="p-3 text-center">
                    <?php 
                    $pendaftar = $conn->query("SELECT * FROM `pendaftar` where id_ekskul = '{$_settings->userdata('id_ekskul')}' and `status` = 0")->num_rows;
                    ?>
                    <h1 class=""><span id="state1" countto="70"><?= number_format($pendaftar) ?></span></h1>
                    <h5 class="mt-3 ">Pendaftar Tertunda</h5>
                    <p class="text-lg h2 font-weight-normal text-muted"><span style="font-size:3rem" class="material-icons">text_snippet</span></p>
                </div>
                <hr class="vertical dark border-dark">
            </div>
            <div class="col-md-3 position-relative bg-gradient bg-opacity-50">
                <div class="p-3 text-center">
                    <?php 
                    $pendaftar = $conn->query("SELECT * FROM `pendaftar` where id_ekskul = '{$_settings->userdata('id_ekskul')}' and `status` = 1")->num_rows;
                    ?>
                    <h1 class=""><span id="state1" countto="70"><?= number_format($pendaftar) ?></span></h1>
                    <h5 class="mt-3 ">Pendaftar Terkonfirmasi</h5>
                    <p class="text-lg h2 font-weight-normal text-primary"><span style="font-size:3rem" class="material-icons">text_snippet</span></p>
                </div>
                <hr class="vertical dark border-dark">
            </div>
            <div class="col-md-3 position-relative bg-gradient bg-opacity-50">
                <div class="p-3 text-center">
                    <?php 
                    $pendaftar = $conn->query("SELECT * FROM `pendaftar` where id_ekskul = '{$_settings->userdata('id_ekskul')}' and `status` = 2")->num_rows;
                    ?>
                    <h1 class=""><span id="state1" countto="70"><?= number_format($pendaftar) ?></span></h1>
                    <h5 class="mt-3 ">Pendaftar Disetujui</h5>
                    <p class="text-lg h2 font-weight-normal text-success"><span style="font-size:3rem" class="material-icons">text_snippet</span></p>
                </div>
                <hr class="vertical dark border-dark">
            </div>
            <div class="col-md-3 position-relative bg-gradient bg-opacity-50">
                <div class="p-3 text-center">
                    <?php 
                    $pendaftar = $conn->query("SELECT * FROM `pendaftar` where id_ekskul = '{$_settings->userdata('id_ekskul')}' and `status` = 3")->num_rows;
                    ?>
                    <h1 class=""><span id="state1" countto="70"><?= number_format($pendaftar) ?></span></h1>
                    <h5 class="mt-3 ">Pendaftar Ditolak</h5>
                    <p class="text-lg h2 font-weight-normal text-danger"><span style="font-size:3rem" class="material-icons">text_snippet</span></p>
                </div>
                <hr class="vertical dark border-dark">
            </div>
        </div>
    </div>
</section>

