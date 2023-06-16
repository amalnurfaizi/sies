<?php 

// if(isset($_GET['id'])){
//     $qry = $conn->query("SELECT * FROM `ekskul` where id = '{$_GET['id']}' and logo = 0 ");
//     if($qry->num_rows > 0 ){
//         foreach($qry->fetch_array() as $k => $v){
//             if(!is_numeric($k))
//             $$k = $v;
//         }
//     }
// }
if(isset($_GET['id'])){
    $memuat_ekskul = $conn->query("SELECT e.*, p.nama_depan, p.nama_tengah, p.nama_belakang, CONCAT(nama_depan,' ',nama_tengah,' ',nama_belakang) as `nama_lengkap` FROM `ekskul` e inner join pengguna p on p.id = e.id_pembina where e.id = ".$_GET['id']);
    if($memuat_ekskul->num_rows > 0 ){
        foreach($memuat_ekskul->fetch_array() as $k => $v){
            if(!is_numeric($k))
            $$k = $v;
        }
    }
}
if(isset($_GET['id'])){
    $memuat_ekskul = $conn->query("SELECT e.*, p.nama_depan, p.nama_tengah, p.nama_belakang, CONCAT(nama_depan,' ',nama_tengah,' ',nama_belakang) as `nama_lengkap_dua` FROM `ekskul` e inner join pengguna p on p.id = e.id_ketua where e.id = ".$_GET['id']);
    if($memuat_ekskul->num_rows > 0 ){
        foreach($memuat_ekskul->fetch_array() as $k => $v){
            if(!is_numeric($k))
            $$k = $v;
        }
    }
}

?>
<style>
    .club-logo{
        width:10rem;
        height:10rem;
        object-fit: scale-down;
        object-position:center center
    }
</style>
<section class="py-4">
    <div class="container">
        <div class="text-center">
            <img src="<?= validate_image(isset($logo_path) ? $logo_path : '') ?>" alt="" class="image-thumbnail rounded-circle club-logo border">
        </div>
        <dl>
            <dt>Nama Ekstrakurikuler</dt>
            <dd class="ps-4"><?= isset($nama_ekskul) ? $nama_ekskul : "" ?></dd>
            <dt>Nama Pembina</dt>
            <dd class="ps-4"><?= isset($nama_lengkap) ? $nama_lengkap : "" ?></dd>
            <dt>Nama Ketua</dt>
            <dd class="ps-4"><?= isset($nama_lengkap_dua) ? $nama_lengkap_dua : "" ?></dd>
            
            <dt>Jadwal</dt>
            <dd class="ps-4"><?= isset($jadwal) ? $jadwal : "" ?></dd>
            <dt>Tentang Ekskul</dt>
            <dd class="ps-4"><?= isset($id) && is_file(base_app."/ekskul_konten/{$id}.html") ? file_get_contents(base_app."/ekskul_konten/{$id}.html") : '' ?></dd>
            <dt>Status</dt>
            <dd class="ps-4">
                <?php 
                if(isset($status)):
                    if($status == 1):
                        echo '<span class="badge bg-success bg-gradient px-3 rounded-pill">Aktif</span>' ;
                    else:
                        echo '<span class="badge bg-danger bg-gradient px-3 rounded-pill">Tidak Aktif</span>' ;
                    endif;
                endif;
                ?>    
            </dd>
        </dl>
        <div class="text-end pt-3">
        
            <a href=".?page=ekskul/FormEkskul&id=<?= isset($id) ? $id : ''  ?>" class="btn btn-primary bg-gradient btn-sm"><span class="material-icons">edit</span> Edit</a>
            <a href="./?page=ekskul" class="btn btn-light border btn-sm"><span class="material-icons">arrow_back_ios</span> Kembali Ke List</a>
        </div>
    </div>
</section>
