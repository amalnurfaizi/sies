<?php 
if(isset($_GET['id'])){
    $qry = $conn->query("SELECT * FROM `pengguna` where id = '{$_GET['id']}'");
    if($qry->num_rows > 0 ){
        foreach($qry->fetch_array() as $k => $v){
            if(!is_numeric($k))
            $$k = $v;
        }
    }
}
?>
<style>
	img#cimg{
		height: 15vh;
		width: 15vh;
		object-fit: cover;
		border-radius: 100% 100%;
	}
</style>
<section class="py-5">
    <div class="container">
        <h2 class="fw-bolder text-center"><b><?= isset($id) ? "Edit Ketua" : "Tambah Ketua" ?></b></h2>
        <hr>
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-10 col-sm-12 col-xs-12">
                <form action="" id="user-form" class="py-3">
                    <input type="hidden" name="id" value="<?= isset($id) ? $id : '' ?>">
                    <div class="input-group mb-3 input-group-dynamic <?= isset($nama_depan) ? 'is-filled' : '' ?>">
                        <label for="nama_depan" class="form-label">Nama Depan <span class="text-danger">*</span></label>
                        <input type="text" id="nama_depan" name="nama_depan" autofocus value="<?= isset($nama_depan) ? $nama_depan : "" ?>" class="form-control" required>
                    </div>
                    <div class="input-group mb-3 input-group-dynamic <?= isset($nama_tengah) ? 'is-filled' : '' ?>">
                        <label for="nama_tengah" class="form-label">Nama Tengah</label>
                        <input type="text" id="nama_tengah" name="nama_tengah" value="<?= isset($nama_tengah) ? $nama_tengah : "" ?>" class="form-control">
                    </div>
                    <div class="input-group mb-3 input-group-dynamic <?= isset($nama_belakang) ? 'is-filled' : '' ?>">
                        <label for="nama_belakang" class="form-label">Nama Belakang <span class="text-danger">*</span></label>
                        <input type="text" id="nama_belakang" name="nama_belakang" value="<?= isset($nama_belakang) ? $nama_belakang : "" ?>" class="form-control" required>
                    </div>
                    <div class="input-group mb-3 input-group-dynamic <?= isset($nama_pengguna) ? 'is-filled' : '' ?>">
                        <label for="nama_pengguna" class="form-label">Nama Pengguna <span class="text-danger">*</span></label>
                        <input type="text" id="nama_pengguna" name="nama_pengguna" value="<?= isset($nama_pengguna) ? $nama_pengguna : "" ?>" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="tipe" class="form-label">Tipe <span class="text-danger">*</span></label>
                        <select name="tipe" id="tipe" class="form-select rounded-0" required>
                        <option class="px-2 py-2" value="3" <?= isset($tipe) && $tipe == 3 ? 'selected': '' ?>>Ketua</option>
                        </select>
                    </div>
                    <div id="club-field" class="input-group mb-3 input-group-static is-filled ">
                        <label for="id_ekskul" class="form-label">Ekskul <span class="text-danger">*</span></label>
                        <select id="id_ekskul" name="id_ekskul" class="form-select" <?= (isset($tipe) && $tipe == 2) ? 'required': '' ?> required>
                        <option value="" <?= !isset($id_ekskul) ? "selected" : "" ?> disabled="disabled"></option>
                        <?php 
                        $ekskul = $conn->query("SELECT * FROM `ekskul` where logo = 0 and `status` = 1 and id = '{$_settings->userdata('id_ekskul')}' order by `nama_ekskul` asc");
                        while($row = $ekskul->fetch_assoc()):
                        ?>
                        <option value="<?= $row['id'] ?>" <?= isset($id_ekskul) && $id_ekskul == $row['id'] ? "selected" : "" ?>><?= $row['nama_ekskul'] ?></option>
                        <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="form-group mb-3 input-group input-group-dynamic is-filled">
                        <label for="" class="form-label mb-2">Foto Profil</label>
                        <input type="file" class="px-2" id="customFile" name="img" onchange="displayImg(this,$(this))">
                        <!-- <input type="file" class="form-control" id="customFile" name="img" onchange="displayImg(this,$(this))"> -->
                    </div>
                    <div class="form-group mb-3 d-flex justify-content-center">
                        <img src="<?php echo validate_image(isset($foto_profil) ? $foto_profil : '') ?>" alt="" id="cimg" class="img-fluid img-thumbnail">
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn bg-primary bg-gradient btn-sm text-light w-25"><span class="material-icons">save</span> Simpan</button>
                            <a href="./?page=ketua" class="btn bg-deafult border bg-gradient btn-sm w-25"><span class="material-icons">keyboard_arrow_left</span> Kembali</a>
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
            $('#cimg').attr('src', '<?php echo validate_image(isset($foto_profil) ? $foto_profil : '') ?>');
        }
    }
    $(function(){
        $('#club_id').select2({
            placeholder:"Please Select Here",
            width:"100%",
        })
        $('#tipe').change(function(){
            var tipe = $(this).val()
            if(tipe == 1){
                $('#club-field').addClass('d-none')
                $('#club_id').removeAttr('required')
            }else{
                $('#club-field').removeClass('d-none')
                $('#club_id').attr('required',true)
            }
        })
        
       
        $('#user-form').submit(function(e){
            e.preventDefault()
            $('.pop-alert').remove()
            var _this = $(this)
            var el = $('<div>')
            el.addClass("pop-alert alert alert-danger text-light")
            el.hide()
            if($('[name="to_user"]').val() == ''){
                el.text('Recepient is required.')
                _this.prepend(el)
                el.show('slow')
                $('html, body').scrollTop(_this.offset().top - '150')
                return false;
            }
            start_loader()
            $.ajax({
                url:'../classes/Master.php?f=simpan_ketua',
                type:'POST',
                method:'POST',
                cache:false,
                contentType:false,
                processData:false,
                data:new FormData(_this[0]),
                dataType:'json',
                error:err=>{
                    console.error(err)
                    el.text("Gagal Menyimpan")
                    _this.prepend(el)
                    el.show('slow')
                    $('html, body').scrollTop(_this.offset().top - '150')
                    end_loader()
                },
                success:function(resp){
                    if(resp.status == 'success'){
                        location.href= './'
                    }else if(!!resp.msg){
                        el.text(resp.msg)
                        _this.prepend(el)
                        el.show('slow')
                        $('html, body').scrollTop(_this.offset().top - '150')
                    }else{
                        el.text("Gagal Menyimpan")
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