<?php 
if(isset($_GET['id_anggota'])){
    $qry = $conn->query("SELECT * FROM `anggota` where id_anggota = '{$_GET['id_anggota']}'");
    if($qry->num_rows > 0 ){
        foreach($qry->fetch_array() as $k => $v){
            if(!is_numeric($k))
            $$k = $v;
        }
    }
}

?>

<section class="py-5">
    <div class="container">
        <h2 class="fw-bolder text-center"><b><?= isset($id_anggota) ? "Edit Anggota" : "Tambah Anggota Baru" ?></b></h2>
        <hr>
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-10 col-sm-12 col-xs-12">
                <form action="" id="application-form" class="py-3">
                    <input type="hidden" name="id" value="<?= isset($id_anggota) ? $id_anggota : '' ?>">
                    <div class="input-group mb-3 input-group-dynamic <?= isset($nama_lengkap) ? 'is-filled' : '' ?>">
                        <label for="nama_lengkap" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" id="nama_lengkap" name="nama_lengkap" autofocus value="<?= isset($nama_lengkap) ? $nama_lengkap : "" ?>" class="form-control" required>
                    </div>
                    <div class="input-group mb-3 input-group-dynamic <?= isset($nisn) ? 'is-filled' : '' ?>">
                        <label for="nisn" class="form-label">Nisn <span class="text-danger">*</span></label>
                        <input type="text" id="nisn" name="nisn" autofocus value="<?= isset($nisn) ? $nisn : "" ?>" class="form-control" required>
                    </div>
                    <div class="input-group mb-3 input-group-dynamic <?= isset($email) ? 'is-filled' : '' ?>">
                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="text" id="email" name="email" value="<?= isset($email) ? $email : "" ?>" class="form-control" required>
                    </div>
                    <div class="input-group mb-3 input-group-dynamic <?= isset($no_hp) ? 'is-filled' : '' ?>">
                        <label for="no_hp" class="form-label">Nomor Hp<span class="text-danger">*</span></label>
                        <input type="text" id="no_hp" name="no_hp" value="<?= isset($no_hp) ? $no_hp : "" ?>" class="form-control" required>
                    </div>
                    <div class="input-group mb-3 input-group-dynamic <?= isset($alamat) ? 'is-filled' : '' ?>">
                        <label for="alamat" class="form-label">Alamat<span class="text-danger">*</span></label>
                        <input type="text" id="alamat" name="alamat" value="<?= isset($alamat) ? $alamat : "" ?>" class="form-control" required>
                    </div>
                   
                    <div class="form-group mb-3">
                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                        <select name="jenis_kelamin" id="jenis_kelamin" class="form-select rounded-0" required>
                            <!-- PILIHAN -->
                            <!--  -->
                            <option class="px-2 py-2" value="laki-laki" <?= isset($jenis_kelamin) && $jenis_kelamin == "laki-laki" ? 'selected': '' ?>>Laki-Laki</option>
                            <option class="px-2 py-2" value="perempuan" <?= isset($jenis_kelamin) && $jenis_kelamin == "perempuan" ? 'selected': '' ?>>Perempuan</option>
                            
                              <!-- PILIHAN -->
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="kelas" class="form-label">Kelas <span class="text-danger">*</span></label>
                        <select name="kelas" id="kelas" class="form-select rounded-0" required>
                            <!-- PILIHAN -->
                            <!--  -->
                            <option class="px-2 py-2" value="10" <?= isset($kelas) && $kelas == 10 ? 'selected': '' ?>>10</option>
                            <option class="px-2 py-2" value="11" <?= isset($kelas) && $kelas == 11 ? 'selected': '' ?>>11</option>
                            <option class="px-2 py-2" value="12" <?= isset($kelas) && $kelas == 12 ? 'selected': '' ?>>12</option>
                            
                              <!-- PILIHAN -->
                        </select>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                    <div class="form-group mb-3 input-group input-group-dynamic">
                        <label class="form-label" for="jurusan">Jurusan <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" required="required" id="jurusan" name="jurusan" value="<?= isset($jurusan) ? $jurusan : "" ?>">
                    </div>
                </div>
                    <div id="club-field" class="input-group mb-3 input-group-static is-filled">
                        <label for="id_ekskul" class="form-label">Ekskul <span class="text-danger">*</span></label>
                        <select id="id_ekskul" name="id_ekskul" class="form-select" <?= (isset($tipe) && $tipe == 3) ? 'required': '' ?> required>
                        <option value="" <?= !isset($id_ekskul) ? "selected" : "" ?> disabled="disabled"></option>
                        <?php 
                     
                        $ekskul = $conn->query("SELECT * FROM `ekskul` where id = '{$_settings->userdata('id_ekskul')}' order by `nama_ekskul` asc");
                        while($row = $ekskul->fetch_assoc()):
                        ?>
                        <option value="<?= $row['id'] ?>" <?= isset($id_ekskul) && $id_ekskul == $row['id'] ? "selected" : "" ?>><?= $row['nama_ekskul'] ?></option>
                        <?php endwhile; ?>
                        </select>
                    </div>
                  
                    
                  
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn bg-primary bg-gradient btn-sm text-light w-25"><span class="material-icons">save</span> Simpan</button>
                            <a href="./?page=anggota" class="btn bg-deafult border bg-gradient btn-sm w-25"><span class="material-icons">keyboard_arrow_left</span> Kembali</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<script>  
         var fuser_ajax;
    function displayImg(input,_this) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#cimg').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }else{
            $('#cimg').attr('src', '<?php echo validate_image(isset($logo_path) ? $logo_path : '') ?>');
        }
    }
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
                url:'../classes/Master.php?f=simpan_anggota',
                type:'POST',
                method:'POST',
                cache:false,
                contentType:false,
                processData:false,
                data:new FormData(_this[0]),
                dataType:'json',
                error:err=>{
                    console.error(err)
                    el.text("An error occured while saving data")
                    _this.prepend(el)
                    el.show('slow')
                    $('html, body').scrollTop(_this.offset().top - '150')
                    end_loader()
                },
                success:function(resp){
                    if(resp.status == 'success'){
                        location.href= './?page=anggota'
                    }else if(!!resp.msg){
                        el.text(resp.msg)
                        _this.prepend(el)
                        el.show('slow')
                        $('html, body').scrollTop(_this.offset().top - '150')
                    }else{
                        el.text("An error occured while saving data")
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