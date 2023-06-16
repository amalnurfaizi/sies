<?php 
if(isset($_GET['id'])){
    $qry = $conn->query("SELECT *, CONCAT(nama_depan,' ',nama_tengah,' ',nama_belakang) as `nama_lengkap` FROM `pengguna` where id = '{$_GET['id']}' ");
    if($qry->num_rows > 0 ){
        foreach($qry->fetch_array() as $k => $v){
            if(!is_numeric($k))
            $$k = $v;
        }
        if($id_ekskul > 0)
        $ekskul = $conn->query("SELECT * FROM ekskul where id = '{$id_ekskul}'")->fetch_array()['nama_ekskul'];
    }
}
?>
<style>
    .user-avatar{
        width:10rem;
        height:10rem;
        object-fit: scale-down;
        object-position:center center
    }
</style>
<section class="py-5">
    <div class="container">
        <h2 class="fw-bolder text-center"><b>Detail Ketua</b></h2>
        <hr>
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10 col-sm-12 col-xs-12">
                <div class="text-center">
                    <img src="<?= validate_image(isset($foto_profil) ? $foto_profil : '') ?>" alt="" class="image-thumbnail rounded-circle user-avatar border">
                </div>
                <dl class="row">
                    <dt class="col-3 px-2">Nama Lengkap</dt>
                    <dd class="col-9 px-2"><?= isset($nama_lengkap)? $nama_lengkap : "" ?></dd>
                    <dt class="col-3 px-2">Nama Pengguna</dt>
                    <dd class="col-9 px-2"><p class="mb-0"><?= isset($nama_pengguna) ? $nama_pengguna : '' ?></p></dd>
                    <dt class="col-3 px-2">Ekskul</dt>
                    <dd class="col-9 px-2"><p class="mb-0"><?= isset($ekskul) ? $ekskul : 'N/A' ?></p></dd>
                    <dt class="col-3 px-2">Tipe</dt>
                    <dd class="col-9 px-2">
                        <?php
                            if(isset($tipe)){
                                if($tipe == 1){
                                    echo 'Admin';
                                }elseif($tipe == 2){
                                    echo 'Pembina';
                                }else{
                                    echo 'ketua';
                                }
                            }
                        ?>
                    </dd>
                    <hr class="dark">
                    <div class="d-flex w-100 justify-content-end">
                        <div class="col-auto me-2">
                            <a href=".?page=ketua/FormKetua&id=<?= isset($id) ? $id : '' ?>" class="btn btn-primary bg-gradient btn-sm rounded-0 d-flex align-items-center"><span class="material-icons">edit</span> Edit</a>
                        </div>
                        <div class="col-auto">
                            <a href="javascript:void(0)" class="btn btn-danger bg-gradient btn-sm rounded-0 d-flex align-items-center" id="delete_data"><span class="material-icons">delete</span> Hapus</a>
                        </div>
                    </div>
                </dl>
            </div>
        </div>
    </div>
</section>
<script>
    $(function(){
        $('#delete_data').click(function(){
            _conf("Apakah Yakin Ingin Menghapus Ketua?","hapus_ketua",['<?= isset($id) ? $id : '' ?>'])
        })
    })
    function hapus_ketua($id){
        start_loader();
        var _this = $(this)
        $('.err-msg').remove();
        var el = $('<div>')
        el.addClass("alert alert-danger err-msg")
        el.hide()
        $.ajax({
            url: '../classes/Master.php?f=hapus_ketua',
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
                    location.replace('./?page=ketua')
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