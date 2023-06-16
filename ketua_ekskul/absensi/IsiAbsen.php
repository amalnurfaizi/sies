<!-- <?php include 'db_connect.php' ?> -->
<?php


if(isset($_GET['id_kehadiran'])){
	// echo "SELECT * FROM attendance_list where id = {$_GET['attendance_id']}";
$qry = $conn->query("SELECT * FROM daftar_kehadiran where id = {$_GET['id_kehadiran']}");
foreach($qry->fetch_array() as $k => $v){
	$$k = $v;
}
}

?>

<section class="py-4">

    <div class="container">
        <h3 class="fw-bolder text-center">Absen Anggota</h3>
        <center>
			<div class="toast" id="alert_toast" role="alert" aria-live="assertive" aria-atomic="true">
		<div class="toast-body text-white">
		</div>
	  </div>
            <hr class="bg-primary w-25 opacity-100">
        </center>
<div class="container-fluid">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-body">
				<form id="manage-attendance">
					<input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
					<div class="row justify-content-center">
					<div class="col-sm-12 text-center ">
						<p class="color-grey">Ekskul Yang dikelola</p> 
						</div>
						<div class="coldir col-sm-4">
						<div class="col my-2">
				            <select name="id_ekskul" id="class_subject_id" class="form-select select2 input-sm border border-2 border-primary p-2">
							<option value="" ></option>
						<?php  
                        $ekskul = $conn->query("SELECT * FROM `ekskul` where id = '{$_settings->userdata('id_ekskul')}' order by `nama_ekskul` asc");
                        while($row = $ekskul->fetch_assoc()):
                        ?>
						<option value="<?php echo $row['id'] ?>" <?php echo isset($id_ekskul) && $id_ekskul == $row['id'] ? 'selected' : (isset($id_ekskul) && $id_ekskul == $row['id'] ? 'selected' :'') ?>><?php echo $row['nama_ekskul'] ?></option>
				        <?php endwhile; ?>
				            </select>
						</div>
						<div class="col ">
							<input type="date" name="doc" value="<?php echo isset($doc) ? date('Y-m-d',strtotime($doc)) :date('Y-m-d') ?>" class="form-control border border-primary ">
						</div>
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-md-12" id='att-list'>
							<center><b><h4><i>Silahkan Pilih Ekskul</i></h4></b></center>
						</div>
						<div class="col-md-12"  style="display: none" id="submit-btn-field">
							<center>
								<button class="btn btn-primary btn-sm col-sm-5">Simpan</button>
							</center>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- </div>
</section> -->
<!-- DATA TABEL ANGGOTA -->
<div id="table_clone" style="display: none">
	<table class='table table-bordered table-hover'>
		<thead>
			<tr>
				<th>No</th>
				<th class="text-center">Nama Lengkap</th>
				<th class="text-center">Nisn</th>
				<th class="text-center">Keterangan</th>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
</div>
<!--  -->
<div id="chk_clone" style="display: none">
	<div class="d-flex justify-content-center chk-opts">
		<div class="form-check form-check-inline">
		  <input class="form-check-input present-inp" type="checkbox" value="1">
		  <label class="form-check-label present-lbl">Hadir</label>
		</div>
		<div class="form-check form-check-inline">
		  <input class="form-check-input absent-inp" type="checkbox" value="0">
		  <label class="form-check-label absent-lbl">Alpha</label>
		</div>
		<div class="form-check form-check-inline">
		  <input class="form-check-input late-inp" type="checkbox" value="2">
		  <label class="form-check-label late-lbl">Terlambat</label>
		</div>
		<div class="form-check form-check-inline">
		  <input class="form-check-input sick-inp" type="checkbox" value="3">
		  <label class="form-check-label sick-lbl">Sakit / Izin</label>
		</div>
	</div>
</div>
<style>
	.present-inp,.absent-inp,.late-inp,.present-lbl,.absent-lbl,.late-lbl,.sick-lbl{
		cursor: pointer;
	}
</style>
<script>
$(document).ready(function(){
	if('<?php echo isset($id_ekskul) ? 1 : 0 ?>' == 1){
		start_loader()
		$.ajax({
			url:'ajax.php?action=data_anggota',
			method:'POST',
			data:{id_ekskul:$('#class_subject_id').val(),doc:$('#doc').val(),att_id :'<?php echo isset($id) ? $id : '' ?>' },
			success:function(resp){
				if(resp){
					resp = JSON.parse(resp)
					var _table = $('#table_clone table').clone()
					$('#att-list').html('')
					$('#att-list').append(_table)				
					var _type = ['Absen','Hadir','Terlambat', 'Sakit / Izin'];
					var data = resp.data;
					var record = resp.record;
					var id_kehadiran = !!resp.id_kehadiran ? resp.id_kehadiran : '';
					if(Object.keys(data).length > 0){
						var i = 1;
						Object.keys(data).map(function(k){
							var nama_lengkap = data[k].nama_lengkap;
							var id_anggota = data[k].id_anggota;
							var nisn = data[k].nisn
							var tr = $('<tr></tr>')
							var opts = $('#chk_clone').clone()

							opts.find('.present-inp').attr({'name':'type['+id_anggota+']','id':'present_'+id_anggota})
							opts.find('.absent-inp').attr({'name':'type['+id_anggota+']','id':'absent_'+id_anggota})
							opts.find('.late-inp').attr({'name':'type['+id_anggota+']','id':'late_'+id_anggota})
							opts.find('.sick-inp').attr({'name':'type['+id_anggota+']','id':'sick_'+id_anggota})

							opts.find('.present-lbl').attr({'for':'present_'+id_anggota})
							opts.find('.absent-lbl').attr({'for':'absent_'+id_anggota})
							opts.find('.late-lbl').attr({'for':'late_'+id_anggota})
							opts.find('.sick-lbl').attr({'for':'sick_'+id_anggota})

							tr.append('<td class="text-center">'+(i++)+'</td>')
							tr.append('<td class="">'+(nama_lengkap)+'</td>')
							tr.append('<td class="">'+(nisn)+'</td>')
							var td = '<td>';
								td += '<input type="hidden" name="id_anggota['+id_anggota+']" value="'+id_anggota+'">';
								td += opts.html();
								td += '</td>';
							tr.append(td)

							_table.find('tbody').append(tr)
						})
						$('#submit-btn-field').show()
						$('#edit_att').attr('data-id',id_kehadiran)
					}else{
							var tr = $('<tr></tr>')
							tr.append('<td class="text-center" colspan="3">No data.</td>')
							_table.find('tbody').append(tr)
						$('#submit-btn-field').attr('data-id','').hide()
						$('#edit_att').attr('data-id','')
					} 
					$('#att-list').html('')
					$('#att-list').append(_table)
					if(Object.keys(record).length > 0){
						Object.keys(record).map(k=>{
							// console.log('[name="type['+record[k].student_id+']"][value="'+record[k].type+'"]')
							$('#att-list').find('[name="type['+record[k].id_anggota+']"][value="'+record[k].type+'"]').prop('checked',true)
						})
					}
				}
			},
			complete:function(){
				$("input:checkbox").on('keyup keypress change',function(){
				    var group = "input:checkbox[name='"+$(this).attr("name")+"']";
				    $(group).prop("checked",false);
				    $(this).prop("checked",true);
				});
				$('#edit_att').click(function(){
					location.href = 'index.php?page=isi_absen&id_kehadiran='+$(this).attr('data-id')
				})
				end_loader()
			}
		})
	}
	
})



	$('#class_subject_id').change(function(){
		get_data($(this).val())
	})
	window.get_data = function(id){
		start_loader()
		$.ajax({
			url:'ajax.php?action=data_anggota',
			method:'POST',
			data:{id_ekskul:id},
			success:function(resp){
				if(resp){
					resp = JSON.parse(resp)
					var _table = $('#table_clone table').clone()
					$('#att-list').html('')
					$('#att-list').append(_table)
					if(Object.keys(resp).length > 0){
						var i = 1;
						Object.keys(resp.data).map(function(k){
							var nama_lengkap = resp.data[k].nama_lengkap;
							var id_anggota = resp.data[k].id_anggota;
							var nisn = resp.data[k].nisn;
							var tr = $('<tr></tr>')
							var opts = $('#chk_clone').clone()
							opts.find('.present-inp').attr({'name':'type['+id_anggota+']','id':'present_'+id_anggota})
							opts.find('.absent-inp').attr({'name':'type['+id_anggota+']','id':'absent_'+id_anggota})
							opts.find('.late-inp').attr({'name':'type['+id_anggota+']','id':'late_'+id_anggota})
							opts.find('.sick-inp').attr({'name':'type['+id_anggota+']','id':'sick_'+id_anggota})

							opts.find('.present-lbl').attr({'for':'present_'+id_anggota})
							opts.find('.absent-lbl').attr({'for':'absent_'+id_anggota})
							opts.find('.late-lbl').attr({'for':'late_'+id_anggota})
							opts.find('.sick-lbl').attr({'for':'sick_'+id_anggota})

							tr.append('<td class="text-center">'+(i++)+'</td>')
							tr.append('<td class="">'+(nama_lengkap)+'</td>')
							tr.append('<td class="">'+(nisn)+'</td>')
							var td = '<td>';
								td += '<input type="hidden" name="id_anggota['+id_anggota+']" value="'+id_anggota+'">';
								td += opts.html();
								td += '</td>';
							tr.append(td)

							_table.find('tbody').append(tr)
						})
						$('#submit-btn-field').show()
					}else{
							var tr = $('<tr></tr>')
							tr.append('<td class="text-center" colspan="3">No data.</td>')
							_table.find('tbody').append(tr)
						$('#submit-btn-field').hide()
					} 
					$('#att-list').html('')
					$('#att-list').append(_table)
				}
			},
			complete:function(){
				$("input:checkbox").on('keyup keypress change',function(){
					// console.log(test)
				    var group = "input:checkbox[name='"+$(this).attr("name")+"']";
				    $(group).prop("checked",false);
				    $(this).prop("checked",true);
				});
				end_loader();
			}
		})
	}
	$('#manage-attendance').submit(function(e){
		e.preventDefault()
		// start_loader()
		$.ajax({
			url:'ajax.php?action=simpan_absensi',
			method:'POST',
			data:$(this).serialize(),
			success:function(resp){
				if(resp==1){
					  alert_toast("Absensi Telah Berhasil Disimpan",'success')
                        setTimeout(function(){
                            location.reload()
                        },1500)
				}else if(resp ==2){
					  alert_toast("Absensi Sudah Dilakukan Di Tanggal Ini",'danger')
					//   end_loader()
				}
			}
		})
	})
	
</script>
