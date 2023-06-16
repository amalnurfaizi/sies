<?php 
$qry = $conn->query("SELECT * FROM `pengguna` where id = '{$_settings->userdata('id')}'");
if($qry->num_rows > 0){
    foreach($qry->fetch_array() as $k => $v){
        if(!is_numeric($k)){
            $$k = $v;
        }
    }
}

?>
<section class="py-4">
    <div class="container">
    <h4 class="fw-bolder text-center">Perbarui Akun</h4>
            <hr class="bg-primary">
            <br>
            <form action="" id="update-user-form">
                <input type="hidden" name="id" value="<?= $_settings->userdata('id') ?>">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3 input-group input-group-dynamic is-filled">
                            <label for="nama_depan" class="form-label">Nama Depan <span class="text-danger">*</span></label>
                            <input type="text" name="nama_depan" id="nama_depan" autofocus class="form-control form-control-lg" value="<?= isset($nama_depan) ?  $nama_depan : '' ?>" required="required">
                        </div>
                        <div class="form-group mb-3 input-group input-group-dynamic is-filled">
                            <label for="nama_tengah" class="form-label">Nama Tengah</label>
                            <input type="text" name="nama_tengah" id="nama_tengah" class="form-control form-control-lg" value="<?= isset($nama_tengah) ?  $nama_tengah : '' ?>">
                        </div>
                        <div class="form-group mb-3 input-group input-group-dynamic is-filled">
                            <label for="nama_belakang" class="form-label">Nama Belakang <span class="text-danger">*</span></label>
                            <input type="text" name="nama_belakang" id="nama_belakang" class="form-control form-control-lg" value="<?= isset($nama_belakang) ?  $nama_belakang : '' ?>" required="required">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3 input-group input-group-dynamic is-filled">
                            <label for="nama_pengguna" class="form-label">Nama Pengguna</label>
                            <span class="input-group-text"><i class="material-icons" aria-hidden="true">person_outline</i></span>
                            <input type="text" name="nama_pengguna" id="nama_pengguna" class="form-control form-control-lg" value="<?= isset($nama_pengguna) ?  $nama_pengguna : '' ?>" required="required">
                        </div>

                        <!-- MATA DAJAL -->
                        <div class="form-group mb-3 input-group input-group-dynamic is-filled">
                            <label for="password" class="form-label">Password Baru</label>
                            <input type="password" id="password" name="password" class="myInput form-control form-control-lg"> 
                            <button type="button" class="btn btn-default" onclick="showPass()" id="showBtn"><i class="fa fa-eye" id="icon"></i></button>
                        </div>

                        <!-- MATA DAJAL -->
                        <div class="form-group mb-3 input-group input-group-dynamic is-filled">
                            <label for="password" class="form-label">Konfirmasi Password Baru</label>
                            <input type="password" id="cpassword" class="myInput2 form-control form-control-lg"> 
                            <button type="button" class="btn btn-default" onclick="showPass2()" id="showBtn2"><i class="fa fa-eye" id="icon2"></i></button>
                        </div>
                        <div class="form-group input-group input-group-dynamic is-filled">
                            <label for="image" class="form-label">Foto Profil <span class="text-primary">*</span></label>
                            <input type="file" name="image" id="image" class="form-control form-control-lg" accept="image/jpeg, image/png">
                        </div>
                        <div class="form-group">
                            <small><span class="text-muted">Current Avatar: <a target="_blank" class="text-primary" href="<?= base_url. (isset($foto_profil) ? $foto_profil : '') ?>"><?= (isset($foto_profil) ? str_replace("uploads/pengguna/","",explode("?", $foto_profil)[0]) : '') ?></a></span></small>
                        </div>
                    </div>
                </div>
                
            <br>
            <div class="row justify-content-between align-items-center">
                <div class="col-sm-6">
                </div>
                <div class="col-sm-6 text-end">
                    <button class="btn btn-primary bg-gradient rounded-0 mb-0">Perbarui Akun</button>
                </div>
            </div>
            </form>
    </div>
</section>
<script  type="text/javascript">
   function showPass() {
	var icon = document.getElementById('icon');
	var btn = document.getElementById('showBtn');
	var x = document.querySelector('.myInput');
	if (x.type === 'password') {
	    x.type = 'text';
        icon.className = "fa fa-eye";
	    btn.className = 'btn btn-primary';
	 } else {
	     x.type = 'password';
	     btn.className = 'btn btn-default';
	      icon.className = 'fa fa-eye-slash';
	 }
}
   function showPass2() {
	var icon = document.getElementById('icon2');
	var btn = document.getElementById('showBtn2');
	var x = document.querySelector('.myInput2');
	if (x.type === 'password') {
	    x.type = 'text';
        icon.className = "fa fa-eye";
	    btn.className = 'btn btn-primary';
	 } else {
	     x.type = 'password';
	     btn.className = 'btn btn-default';
	      icon.className = 'fa fa-eye-slash';
	 }
}
    $(function(){
        $('#update-user-form').submit(function(e){
                e.preventDefault()
                $('.pop-alert').remove()
                var _this = $(this)
                var el = $('<div>')
                el.addClass("pop-alert alert alert-danger text-light mb-3 rounded-0 px-1 py-2")
                el.hide()
                if($('#password').val() != $('#cpassword').val()){
                    el.text('Passwords do not match.')
                    _this.prepend(el)
                    el.show('slow')
                    $('html, body').scrollTop(_this.offset().top - '150')
                    return false;
                }
                start_loader()
                $.ajax({
                    url:'../classes/Users.php?f=simpan_pengguna',
                    data: new FormData($(this)[0]),
                    cache: false,
                    contentType: false,
                    processData: false,
                    method: 'POST',
                    type: 'POST',
                    dataType: 'json',
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
                            location.reload();
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
                    }
                })
            })
    })
</script>