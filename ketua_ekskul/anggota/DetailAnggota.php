<?php 
if(isset($_GET['id_anggota'])){
    $qry = $conn->query("SELECT *,CONCAT(kelas,' - ',jurusan) as `kelas_jurusan` FROM `anggota` where id_anggota = '{$_GET['id_anggota']}' ");
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

<section class="py-4">
    <div class="container">
        <dl class="row">
            <dt class="col-4 border py-1">Nama Lengkap</dt>
            <dd class="col-8 px-2 border py-1 mb-0"><?= isset($nama_lengkap) ? $nama_lengkap : "" ?></dd>
            <dt class="col-4 border py-1">Nisn</dt>
            <dd class="col-8 px-2 border py-1 mb-0"><?= isset($nisn) ? $nisn : "" ?></dd>
            <dt class="col-4 border py-1">Kelas - Jurusan</dt>
            <dd class="col-8 px-2 border py-1 mb-0"><?= isset($kelas_jurusan) ? $kelas_jurusan : "" ?></dd>
            <dt class="col-4 border py-1">Jenis Kelamin</dt>
            <dd class="col-8 px-2 border py-1 mb-0"><?= isset($jenis_kelamin) ? $jenis_kelamin : "" ?></dd>
            <dt class="col-4 border py-1">Nomor Hp</dt>
            <dd class="col-8 px-2 border py-1 mb-0"><?= isset($no_hp) ? $no_hp : "" ?></dd>
            <dt class="col-4 border py-1">Email</dt>
            <dd class="col-8 px-2 border py-1 mb-0"><?= isset($email) ? $email : "" ?></dd>
            <dt class="col-4 border py-1">Alamat</dt>
            <dd class="col-8 px-2 border py-1 mb-0"><?= isset($alamat) ? $alamat : "" ?></dd>
        </dl>
        <div class="text-end pt-3">
            <a href=".?page=anggota/FormAnggota&id_anggota=<?= isset($id_anggota) ? $id_anggota : '' ?>" class="btn btn-primary bg-gradient btn-sm" ><span class="material-icons">edit</span> Edit</a>
            <a href="javascript:void(0)" class="btn btn-danger bg-gradient btn-sm" id="delete_data"><span class="material-icons">delete</span> Hapus</a>
            <a href="./?page=anggota" class="btn btn-light border btn-sm"><span class="material-icons">arrow_back_ios</span> Kembali</a>
        </div>
    </div>
</section>
<script>
    $(function(){
        $('#delete_data').click(function(){
            _conf("Apakah Yakin Ingin Menghapus Anggota?","hapus_anggota",['<?= isset($id_anggota) ? $id_anggota : '' ?>'])
        })
    })
    function hapus_anggota($id){
        start_loader();
        var _this = $(this)
        $('.err-msg').remove();
        var el = $('<div>')
        el.addClass("alert alert-danger err-msg")
        el.hide()
        $.ajax({
            url: '../classes/Master.php?f=hapus_anggota',
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
                    location.replace('./?page=anggota')
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