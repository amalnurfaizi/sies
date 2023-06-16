<?php 
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
        width:20rem;
        height:20rem;
        object-fit: cover;
        object-position:center center
    }
    .text-gray-600{
        color:var(--bs-gray-600)
    }
    
    .text-gray-700{
        color:var(--bs-gray-700)
    }
</style>
<section class="py-4 w-100">
    <div class="container">
        <div class="text-center mb-3">
            <img src="<?= validate_image(isset($logo_path) ? $logo_path : '') ?>" alt="" class="image-thumbnail rounded-circle club-logo border">
        </div>
        <h2 class="text-center"><b><?= isset($nama_ekskul) ? $nama_ekskul : '' ?></b></h2>
        <center>
            <hr class="border-dark border-4 opacity-100" width="10%" style="height:2.5px">
        </center>
        <div class="d-flex gap-2 justify-content-center" >
       
        </div>
        
        <h4 class="text-center text-gray-600"><b>Pengelola</b></h4>
        <center>
            <hr class="border-dark border-4 opacity-100" width="10%" style="height:2.5px">
        </center>
      
                       


        <div class="d-flex justify-content-center gap-1">
        <p  class="text-center">Nama Pembina :</p>
        <p class="text-center text-gray-600"><?= isset($nama_lengkap) ? $nama_lengkap : "" ?></p>
   
    </div>
        <div class="d-flex justify-content-center gap-1">
        <p class="text-center">Nama Ketua :</p>
        <p class="text-center text-gray-600"><?= isset($nama_lengkap_dua) ? $nama_lengkap_dua : "" ?></p>
  
        </div>
        <h4 class="text-center text-gray-600"><b>Jadwal Ekskul</b></h4>
        <center>
            <hr class="border-dark border-4 opacity-100" width="10%" style="height:2.5px">
        </center>
        <p class="text-center text-gray-600"><?= isset($jadwal) ? $jadwal : "" ?></p>
        <h4 class="text-center text-gray-600"><b>Tentang Ekskul</b></h4>
        <center>
            <hr class="border-dark border-4 opacity-100" width="10%" style="height:2.5px">
        </center>
        <div class="text-gray-500 text-center"><?= isset($id) && is_file(base_app."/ekskul_konten/{$id}.html") ? file_get_contents(base_app."/ekskul_konten/{$id}.html") : '' ?></div>

        <div class="text-end pt-3">
            <a href="./?page=ekskul/FormPendaftaran&id=<?= isset($id) ? $id : '' ?>" class="btn btn-primary btn-sm"><span class="material-icons">text_snippet</span> Daftar</a>
            <a href="./?page=ekskul" class="btn btn-light border btn-sm"><span class="material-icons">arrow_back_ios</span> Kembali</a>
        </div>
    </div>
</section>
<script>
    $(function(){
        $('#delete_data').click(function(){
            _conf("Are you sure to delete this from list?","hapus_ekskul",['<?= isset($id) ? $id : '' ?>'])
        })
    })
    function hapus_ekskul($id){
        start_loader();
        var _this = $(this)
        $('.err-msg').remove();
        var el = $('<div>')
        el.addClass("alert alert-danger err-msg")
        el.hide()
        $.ajax({
            url: '../classes/Master.php?f=hapus_ekskul',
            method: 'POST',
            data: {
                id: $id
            },
            dataType: 'json',
            error: err => {
                console.log(err)
                el.text('An error occurred.')
                el.show('slow')
                end_loader()
            },
            success: function(resp) {
                if (resp.status == 'success') {
                    location.replace('./?page=user')
                } else if (!!resp.msg) {
                    el.text('An error occurred.')
                    el.show('slow')
                } else {
                    el.text('An error occurred.')
                    el.show('slow')
                }
                end_loader()
            }
        })
    }
</script>