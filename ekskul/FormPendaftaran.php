<?php 
if(isset($_GET['id'])){
    $qry = $conn->query("SELECT * FROM `ekskul` where id = '{$_GET['id']}' and logo = 0 ");
    if($qry->num_rows > 0 ){
        foreach($qry->fetch_array() as $k => $v){
            if(!is_numeric($k))
            $$k = $v;
        }
    }
}
?>
<div class="section py-5">
    <div class="container">
        <h2 class="text-center"><b>Daftar Pada Ekskul <?= isset($nama_ekskul) ? $nama_ekskul : '' ?></b></h2>
        <center>
            <hr class="border-dark border-4 opacity-100" width="10%" style="height:2.5px">
        </center>

        <form action="" id="application-form" class="pt-5">
            <input type="hidden" name="id">
            <input type="hidden" name="id_ekskul" value="<?= isset($id) ? $id : '' ?>">
            <div class="row mb-2">
                <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                    <div class="form-group mb-3 input-group input-group-dynamic">
                        <label class="form-label" for="nama_lengkap">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" required="required" id="nama_lengkap" name="nama_lengkap">
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                    <div class="form-group mb-3 input-group input-group-dynamic is-filled">
                        <label class="form-label" for="jenis_kelamin">Jenis Kelamin <span class="text-danger">*</span></label>
                        <select type="text" class="form-select" required="required" id="jenis_kelamin" name="jenis_kelamin">
                            <option>Laki-Laki</option>
                            <option>Perempuan</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                    <div class="form-group mb-3 input-group input-group-dynamic">
                        <label class="form-label" for="nisn">Nisn <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" required="required" id="nisn" name="nisn">
                    </div>
                </div>
            </div>
            <div class="row mb-2">
            <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                    <div class="form-group mb-3 input-group input-group-dynamic is-filled">
                        <label class="form-label" for="kelas">Kelas <span class="text-danger">*</span></label>
                        <select type="text" class="form-select" required="required" id="kelas" name="kelas">
                            <option>10</option>
                            <option>11</option>
                            <option>12</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                    <div class="form-group mb-3 input-group input-group-dynamic">
                        <label class="form-label" for="jurusan">Jurusan <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" required="required" id="jurusan" name="jurusan">
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                    <div class="form-group mb-3 input-group input-group-dynamic">
                        <label class="form-label" for="email">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" required="required" id="email" name="email">
                    </div>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                    <div class="form-group mb-3 input-group input-group-dynamic">
                        <label class="form-label" for="no_wa">Nomor Whatsapp <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" required="required" id="no_wa" name="no_wa">
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                    <div class="form-group mb-3 input-group input-group-dynamic">
                        <label class="form-label" for="alamat">Alamat <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" required="required" id="alamat" name="alamat">
                    </div>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                    <div class="form-group mb-3">
                        <label class="form-label" for="alasan">Alasan Mendaftar Pada Ekskul <?= isset($alasan) ? $alasan : '' ?>  <span class="text-danger">*</span></label>
                        <textarea rows="4" class="form-control border px-2 py-3 rounded-0" required="required" id="alasan" name="alasan"></textarea>
                    </div>
                </div>
            </div>
            <div class="text-end pt-3">
                <button class="btn btn-primary btn-sm"><span class="material-icons">send</span> Simpan</button>
                
                <a href="./?page=ekskul/DetailEkskul&id=<?= isset($id) ? $id : '' ?>" class="btn btn-light border btn-sm"><span class="material-icons">arrow_back_ios</span> Kembali</a>
            </div>
        </form>
    </div>
</div>
<script>
    $(function(){
        $('#application-form').submit(function(e){
            e.preventDefault()
            $('.pop-alert').remove()
            var _this = $(this)
            var el = $('<div>')
            el.addClass("pop-alert alert alert-danger text-light")
            el.hide()
            start_loader()
            $.ajax({
                url:'./classes/Master.php?f=simpan_pendaftaran',
                type:'POST',
                method:'POST',
                cache:false,
                contentType:false,
                processData:false,
                data:new FormData(_this[0]),
                dataType:'json',
                error:err=>{
                    console.error(err)
                    el.text("Pendaftaran Gagal Dilakukan")
                    _this.prepend(el)
                    el.show('slow')
                    $('html, body').scrollTop(_this.offset().top - '150')
                    end_loader()
                },
                success:function(resp){
                    if(resp.status == 'success'){
                        location.href= './?page=ekskul/DetailEkskul&id=<?= isset($id) ? $id : '' ?>';
                    }else if(!!resp.msg){
                        el.text(resp.msg)
                        _this.prepend(el)
                        el.show('slow')
                        $('html, body').scrollTop(_this.offset().top - '150')
                    }else{
                        el.text("Pendaftaran Gagal Dilakukan")
                        _this.prepend(el)
                        el.show('slow')
                        $('html, body').scrollTop(_this.offset().top - '150')
                    }
                    end_loader()
                    console

                }
            })
        })
    })
</script>