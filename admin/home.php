<section class="py-3">
    <div class="container">
        <div class="row">
            <div class="col-md-4 position-relative bg-gradient bg-opacity-25">
                <div class="p-3 text-center">
                    <?php 
                    $ekskul = $conn->query("SELECT * FROM `ekskul` where logo = 0")->num_rows;
                    ?>
                    <h1 class=""><span id="state1" countto="70"><?= number_format($ekskul) ?></span></h1>
                    <h5 class="mt-3 ">Ekskul Yang Aktif</h5>
                    <p class="text-lg h2 font-weight-normal text-dark"><span style="font-size:3rem" class="material-icons">sports_soccer</span></p>
                </div>
            </div>
            <div class="col-md-4 position-relative bg-gradient bg-opacity-50">
                <div class="p-3 text-center">
                    <?php 
                    $pengguna = $conn->query("SELECT * FROM `pengguna` where `tipe` = 2 ")->num_rows;
                    ?>
                    <h1 class=""><span id="state1" countto="70"><?= number_format($pengguna) ?></span></h1>
                    <h5 class="mt-3 ">Pembina Ekskul</h5>
                    <p class="text-lg h2 font-weight-normal text-muted"><span style="font-size:3rem" class="material-icons">people_alt</span></p>
                </div>
                <hr class="vertical dark border-dark">
            </div>
            <div class="col-md-4 position-relative bg-gradient bg-opacity-50">
                <div class="p-3 text-center">
                    <?php 
                    $pengguna = $conn->query("SELECT * FROM `pengguna` where `tipe` = 3 ")->num_rows;
                    ?>
                    <h1 class=""><span id="state1" countto="70"><?= number_format($pengguna) ?></span></h1>
                    <h5 class="mt-3 ">Ketua Ekskul</h5>
                    <p class="text-lg h2 font-weight-normal text-muted"><span style="font-size:3rem" class="material-icons">people_alt</span></p>
                </div>
                <hr class="vertical dark border-dark">
            </div>
            
        </div>
    </div>
</section>

