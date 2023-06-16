<?php 
require_once("./../../config.php");
if(isset($_GET['id_anggota'])){
    $qry = $conn->query("SELECT * FROM `anggota` where id_anggota = '{$_GET['id_anggota']}' ");
    if($qry->num_rows > 0 ){
        foreach($qry->fetch_array() as $k => $v){
            if(!is_numeric($k))
            $$k = $v;
        }
    }
}
?>
<div class="container-fluid">
    <form action="" id="application-form" class="py-3">
        <input type="hidden" name="id" value="<?= isset($id_anggota) ? $id_anggota : '' ?>">
        <div class="input-group mb-3 input-group-dynamic <?= isset($nama_depan) ? 'is-filled' : '' ?>">
                        <label for="nama_depan" class="form-label">Nama Depan <span class="text-primary">*</span></label>
                        <input type="text" id="nama_depan" name="nama_depan" autofocus value="<?= isset($nama_depan) ? $nama_depan : "" ?>" class="form-control">
                    </div>
        <div class="input-group mb-3 input-group-dynamic <?= isset($nama_tengah) ? 'is-filled' : '' ?>">
                        <label for="nama_tengah" class="form-label">Nama Tengah <span class="text-primary">*</span></label>
                        <input type="text" id="nama_tengah" name="nama_tengah" autofocus value="<?= isset($nama_tengah) ? $nama_tengah : "" ?>" class="form-control">
                    </div>
        <div class="input-group mb-3 input-group-dynamic <?= isset($nama_belakang) ? 'is-filled' : '' ?>">
                        <label for="nama_belakang" class="form-label">Nama Belakang <span class="text-primary">*</span></label>
                        <input type="text" id="nama_belakang" name="nama_belakang" autofocus value="<?= isset($nama_belakang) ? $nama_belakang : "" ?>" class="form-control">
                    </div>
                    
        <div class="input-group mb-3 input-group-dynamic <?= isset($id_ekskul) ? 'is-filled' : '' ?>">
        <label for="club_id" class="form-label">Club <span class="text-primary">*</span></label>
                        <select id="club_id" name="club_id" class="form-select" <?= (isset($type) && $type == 2) ? 'required': '' ?>>
                        <option value="" <?= !isset($club_id) ? "selected" : "" ?> disabled="disabled"></option>
                        <?php 
                     
                        $clubs = $conn->query("SELECT * FROM `club_list` where id = '{$_settings->userdata('club_id')}' order by `name` asc");
                        while($row = $clubs->fetch_assoc()):
                        ?>
                        <option value="<?= $row['id'] ?>" <?= isset($club_id) && $club_id == $row['id'] ? "selected" : "" ?>><?= $row['name'] ?></option>
                        <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin <span class="text-primary">*</span></label>
                        <select name="jenis_kelamin" id="jenis_kelamin" class="form-select rounded-0" required>
                            <!-- PILIHAN -->
                            <!--  -->
                            <option class="px-2 py-2" value="laki-laki" <?= isset($jenis_kelamin) && $jenis_kelamin == "laki-laki" ? 'selected': '' ?>>Laki-Laki</option>
                            <option class="px-2 py-2" value="perempuan" <?= isset($jenis_kelamin) && $jenis_kelamin == "perempuan" ? 'selected': '' ?>>Perempuan</option>
                            
                              <!-- PILIHAN -->
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="kelas" class="form-label">Kelas <span class="text-primary">*</span></label>
                        <select name="kelas" id="kelas" class="form-select rounded-0" required>
                            <!-- PILIHAN -->
                            <!--  -->
                            <option class="px-2 py-2" value="1" <?= isset($kelas) && $kelas == 1 ? 'selected': '' ?>>10</option>
                            <option class="px-2 py-2" value="2" <?= isset($kelas) && $kelas == 2 ? 'selected': '' ?>>11</option>
                            <option class="px-2 py-2" value="3" <?= isset($kelas) && $kelas == 3 ? 'selected': '' ?>>12</option>
                            
                              <!-- PILIHAN -->
                        </select>
                    </div>
                    <div class="input-group mb-3 input-group-dynamic <?= isset($email) ? 'is-filled' : '' ?>">
                        <label for="email" class="form-label">Email <span class="text-primary">*</span></label>
                        <input type="text" id="email" name="email" value="<?= isset($email) ? $email : "" ?>" class="form-control">
                    </div>
                    <div class="input-group mb-3 input-group-dynamic <?= isset($no_hp) ? 'is-filled' : '' ?>">
                        <label for="no_hp" class="form-label">Nomor Hp<span class="text-primary">*</span></label>
                        <input type="text" id="no_hp" name="no_hp" value="<?= isset($no_hp) ? $no_hp : "" ?>" class="form-control">
                    </div>
                    <div class="input-group mb-3 input-group-dynamic <?= isset($alamat) ? 'is-filled' : '' ?>">
                        <label for="alamat" class="form-label">Alamat<span class="text-primary">*</span></label>
                        <input type="text" id="alamat" name="alamat" value="<?= isset($alamat) ? $alamat : "" ?>" class="form-control">
                    </div>
     
    </form>
</div>
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
        $('#content').summernote({
            height: 200,
            theme:'bootstrap',
            toolbar: [
                [ 'style', [ 'style' ] ],
                [ 'font', [ 'bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear'] ],
                [ 'fontname', [ 'fontname' ] ],
                [ 'fontsize', [ 'fontsize' ] ],
                [ 'color', [ 'color' ] ],
                [ 'para', [ 'ol', 'ul', 'paragraph', 'height' ] ],
                [ 'table', [ 'table' ] ],
                [ 'insert', [ 'picture', 'video' ] ],
                [ 'view', [ 'undo', 'redo', 'help' ] ]
            ]
        })
        $('.note-modal').find('.close').addClass('btn-close')
        $('.note-modal').find('.close').attr('data-bs-dismiss','modal')
        $('#application-form').submit(function(e){
            e.preventDefault()
            $('.pop-alert').remove()
            var _this = $(this)
            var el = $('<div>')
            el.addClass("pop-alert alert alert-danger text-light")
            el.hide()
            start_loader()
            $.ajax({
                url:'../classes/Master.php?f=save_anggota',
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
                    console

                }
            })
        })

    })
</script>