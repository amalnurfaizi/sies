<?php 
if(isset($_GET['id'])){
    $qry = $conn->query("SELECT p.*,e.nama_ekskul as ekskul, CONCAT(p.kelas,' - ',p.jurusan) as `kelas_jurusan` FROM `pendaftar` p inner join ekskul e on p.id_ekskul = e.id where p.id = '{$_GET['id']}'");
    if($qry->num_rows > 0 ){
        foreach($qry->fetch_array() as $k => $v){
            if(!is_numeric($k))
            $$k = $v;
        }
    }
}
?>
<style>
    .application-logo{
        width:10rem;
        height:10rem;
        object-fit: scale-down;
        object-position:center center
    }
</style>
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
            <dt class="col-4 border py-1">Nomor Whatsapp</dt>
            <dd class="col-8 px-2 border py-1 mb-0"><?= isset($no_wa) ? $no_wa : "" ?></dd>
            <dt class="col-4 border py-1">Email</dt>
            <dd class="col-8 px-2 border py-1 mb-0"><?= isset($email) ? $email : "" ?></dd>
            <dt class="col-4 border py-1">Alamat</dt>
            <dd class="col-8 px-2 border py-1 mb-0"><?= isset($alamat) ? $alamat : "" ?></dd>
            <dt class="col-4 border py-1">Alasan</dt>
            <dd class="col-8 px-2 border py-1 mb-0"><?= isset($alasan) ? $alasan : "" ?></dd>
            <dt class="col-4 border py-1">Status</dt>
            <dd class="col-8 px-2 border py-1 mb-0">
                <?php 
                $status = isset($status)? $status : '';
                    switch($status){
                        case 0:
                            echo '<span class="badge bg-default border text-muted bg-gradient px-3 rounded-pill">Tertunda</span>' ;
                            break;
                        case 1:
                            echo '<span class="badge bg-primary bg-gradient px-3 rounded-pill">Terkonfirmasi</span>' ;
                            break;
                        case 2:
                            echo '<span class="badge bg-success bg-gradient px-3 rounded-pill">Disetujui</span>' ;
                            break;
                        case 3:
                            echo '<span class="badge bg-danger bg-gradient px-3 rounded-pill">Ditolak</span>' ;
                            break;
                    }
                ?>    
            </dd>
        </dl>
        <div class="text-end pt-3">
            <button id="update_status" type="button" class="btn btn-primary bg-gradient btn-sm"><span class="material-icons">edit</span> Ganti Status</button>
            <a href="javascript:void(0)" class="btn btn-danger bg-gradient btn-sm" id="delete_data"><span class="material-icons">delete</span> Hapus</a>
            <a href="./?page=pendaftaran" class="btn btn-light border btn-sm"><span class="material-icons">arrow_back_ios</span> Kembali Ke List</a>
        </div>
    </div>
</section>
<script>
    $(function(){
        $('#delete_data').click(function(){
            _conf("Apakah Yakin Ingin Menghapus Pendaftar Dari List?","hapus_pendaftar",['<?= isset($id) ? $id : '' ?>'])
        })
        $('#update_status').click(function(){
            uni_modal("Perbarui Status Pendaftar", 'pendaftaran/GantiStatus.php?id=<?= isset($id) ? $id : '' ?>')
        })
    })
    function hapus_pendaftar($id){
        start_loader();
        var _this = $(this)
        $('.err-msg').remove();
        var el = $('<div>')
        el.addClass("alert alert-danger err-msg")
        el.hide()
        $.ajax({
            url: '../classes/Master.php?f=hapus_pendaftar',
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
                    location.replace('./?page=pendaftaran')
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