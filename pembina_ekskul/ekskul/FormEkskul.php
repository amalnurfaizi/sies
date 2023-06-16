
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
<style>
	img#cimg{
		height: 15vh;
		width: 15vh;
		object-fit: cover;
		border-radius: 100% 100%;
	}
    .jqte_editor{
		min-height: 30vh !important
	}
	#drop {
   	min-height: 15vh;
    max-height: 30vh;
    overflow: auto;
    width: calc(100%);
    border: 5px solid #929292;
    margin: 10px;
    border-style: dashed;
    padding: 10px;
    display: flex;
    align-items: center;
    flex-wrap: wrap;
}
	#uploads {
		min-height: 15vh;
	width: calc(100%);
	margin: 10px;
	padding: 10px;
	display: flex;
	align-items: center;
	flex-wrap: wrap;
	}
	#uploads .img-holder{
	    position: relative;
	    margin: 1em;
	    cursor: pointer;
	}
	#uploads .img-holder:hover{
	    background: #0095ff1f;
	}
	#uploads .img-holder .form-check{
	    display: none;
	}
	#uploads .img-holder.checked .form-check{
	    display: block;
	}
	#uploads .img-holder.checked{
	    background: #0095ff1f;
	}
	#uploads .img-holder img {
		height: 39vh;
    width: 22vw;
    margin: .5em;
		}
	#uploads .img-holder span{
	    position: absolute;
	    top: -.5em;
	    left: -.5em;
	}
	#dname{
		margin: auto 
	}
img.imgDropped {
    height: 16vh;
    width: 7vw;
    margin: 1em;
}
.imgF {
    border: 1px solid #0000ffa1;
    border-style: dashed;
    position: relative;
    margin: 1em;
}
span.rem.badge.badge-primary {
    position: absolute;
    top: -.5em;
    left: -.5em;
    cursor: pointer;
}
label[for="chooseFile"]{
	color: #0000ff94;
	cursor: pointer;
}
label[for="chooseFile"]:hover{
	color: #0000ffba;
}
.opts {
    position: absolute;
    top: 0;
    right: 0;
    background: #00000094;
    width: calc(100%);
    height: calc(100%);
    justify-items: center;
    display: flex;
    opacity: 0;
    transition: all .5s ease;
}
.img-holder:hover .opts{
    opacity: 1;

}
</style>
<section class="py-5">
    <div class="container">
        <h2 class="fw-bolder text-center"><b><?= isset($id) ? "Edit Ekskul" : "Tambah Ekskul Baru" ?></b></h2>
        <hr>
       
                <form action="" id="club-form" class="py-3">
                    <input type="hidden" name="id" value="<?= isset($id) ? $id : '' ?>">
            <div class="row">
            <div class="col-lg-5 col-md-10 col-sm-12 col-xs-12">
                    <div id="filter-holder">
                        <div class="input-group mb-3 input-group-dynamic <?= isset($nama_ekskul) ? 'is-filled' : '' ?>">
                            <label for="name" class="form-label">Nama Ekstrakurikuler</> <span class="text-danger">*</span></label>
                            <input type="text" id="nama_ekskul" name="nama_ekskul" value="<?= isset($nama_ekskul) ? $nama_ekskul : "" ?>" autofocus class="form-control" required="required">
                        </div>
                    </div>
                    <!--  -->
                    <div id="club-field" class="input-group mb-3 input-group-static is-filled">
                        <label for="id_pembina" class="form-label">Nama Pembina <span class="text-danger">*</span></label>
                        <select id="id_pembina" name="id_pembina" class="form-select" required>
                        <option value=""></option>
                        <?php 
                        $pembina = $conn->query("SELECT *,CONCAT(nama_depan,' ',nama_tengah,' ',nama_belakang) as `nama_lengkap` FROM `pengguna` where tipe = '2' order by `nama_depan` asc");
                        while($row = $pembina->fetch_assoc()):
                        ?>
                        <!--  -->
                        <option value="<?= $row['id'] ?>" <?= isset($id_pembina) && $id_pembina == $row['id'] ? "selected" : "" ?>><?= $row['nama_lengkap'] ?></option>

                 
                        <?php endwhile; ?>
                        </select>
                    </div>
                    <div id="club-field" class="input-group mb-3 input-group-static is-filled">
                        <label for="id_ketua" class="form-label">Nama Ketua <span class="text-danger">*</span></label>
                        <select id="id_ketua" name="id_ketua" class="form-select" required>
                        <option value=""></option>
                        <?php 
                        $ketua = $conn->query("SELECT *,CONCAT(nama_depan,' ',nama_tengah,' ',nama_belakang) as `nama_lengkap` FROM `pengguna` where tipe = '3' order by `nama_depan` asc");
                        while($row = $ketua->fetch_assoc()):
                        ?>
                        <!--  -->
                        <option value="<?= $row['id'] ?>" <?= isset($id_ketua) && $id_ketua == $row['id'] ? "selected" : "" ?>><?= $row['nama_lengkap'] ?></option>
                        <?php endwhile; ?>
                        </select>
                    </div>
                  <!-- DISINI -->
                    <div class="form-group mb-3">
                        <label for="jadwal" class="form-label">Jadwal <span class="text-danger">*</span></label>
                        <textarea rows="4" id="jadwal" name="jadwal" class="form-control border rounded-0" required="required"><?= isset($jadwal) ? $jadwal : '' ?></textarea>
                    </div>
                   
                    <div class="form-group mb-4">
                        <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                        <select name="status" id="status" class="form-select rounded-0" required>
                            <option class="px-2 py-2" value="1" <?= isset($status) && $status == 1 ? 'selected': '' ?>>Aktif</option>
                            <option class="px-2 py-2" value="2" <?= isset($status) && $status == 2 ? 'selected': '' ?>>Tidak Aktif</option>
                        </select>
                    </div>

                  
                   
                 
                    </div>
                    <div class="col-lg-7 col-md-10 col-sm-12 col-xs-12">
                    <div id="filter-holder">
                    <div class="form-group mb-3">
                        <label for="content" class="form-label">Tentang Ekskul<span class="text-danger">*</span></label>
                        <textarea rows="4" id="content" name="content" class="form-control border rounded-0" required="required"><?= isset($id) && is_file(base_app."/ekskul_konten/{$id}.html") ? file_get_contents(base_app."/ekskul_konten/{$id}.html") : '' ?></textarea>
                    </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-12 text-center">
                              <div class="form-group mb-3 input-group input-group-dynamic is-filled">
                        <label for="" class="form-label mb-2">Logo Ekskul</label>
                        <input type="file" class="px-2" id="customFile" name="img" onchange="displayImg(this,$(this))">
                    </div>
                    <div class="form-group mb-3 d-flex justify-content-center">
                        <img src="<?php echo validate_image(isset($logo_path) ? $logo_path : '') ?>" alt="" id="cimg" class="img-fluid img-thumbnail">
                    </div>
                            <button type="submit" class="btn bg-primary bg-gradient btn-sm text-light w-25"><span class="material-icons">save</span> Simpan</button>
                            <a href="./?page=ekskul" class="btn bg-deafult border bg-gradient btn-sm w-25"><span class="material-icons">keyboard_arrow_left</span> Kembali</a>
                        </div>
                    </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</section>
<div class="imgF" style="display: none " id="img-clone">
			<span class="rem badge badge-primary" onclick="rem_func($(this))"><i class="fa fa-times"></i></span>
	</div>
<noscript id="user-filter-clone">
<a href="javascript:void(0)" class="list-group-item list-group-item"></div>
    <div class="d-flex w-100 align-items-center">
        <div class="col-1 text-center">
            <img src="" class="image-thumbnail border rounded-circle image-user-avatar-filter" alt="">
        </div>
        <div class="col-11">
            <div class="lh-1">
                <h4 class="fw-bolder uname mb-0">Mark Cooper</h4>
                <small class="username">mcooper</small>
            </div>
        </div>
    </div>
</a>
</noscript>
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
        $('#club-form').submit(function(e){
            e.preventDefault()
            $('.pop-alert').remove()
            var _this = $(this)
            var el = $('<div>')
            el.addClass("pop-alert alert alert-danger text-light")
            el.hide()
            start_loader()
            $.ajax({
                url:'../classes/Master.php?f=simpan_ekskul',
                type:'POST',
                method:'POST',
                cache:false,
                contentType:false,
                processData:false,
                data:new FormData(_this[0]),
                dataType:'json',
                error:err=>{
                    console.error(err)
                    el.text("Gagal Menyimpan Ekstrakurikuler")
                    _this.prepend(el)
                    el.show('slow')
                    $('html, body').scrollTop(_this.offset().top - '150')
                    end_loader()
                },
                success:function(resp){
                    if(resp.status == 'success'){
                        location.href= './?page=ekskul';
                    }else if(!!resp.msg){
                        el.text(resp.msg)
                        _this.prepend(el)
                        el.show('slow')
                        $('html, body').scrollTop(_this.offset().top - '150')
                    }else{
                        el.text("Gagal Menyimpan Data")
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