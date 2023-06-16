<?php include 'db_connect.php' ?>
<section class="py-4">
    <div class="container">
        <h3 class="fw-bolder text-center">Laporan Absensi</h3>
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
					<input type="hidden" name="id" value="">
					<div class="row justify-content-center">
						<div class="col-sm-4">
				            <select name="id_ekskul" id="class_subject_id" class="custom-select select2 input-sm" required>
							<option value="" ></option>
                        <?php  
                        $ekskul = $conn->query("SELECT * FROM `ekskul` where id = '{$_settings->userdata('id_ekskul')}' order by `nama_ekskul` asc");
                        while($row = $ekskul->fetch_assoc()):
                        ?>
						<option value="<?php echo $row['id'] ?>" <?php echo isset($id_ekskul) && $id_ekskul == $row['id'] ? 'selected' : (isset($id_ekskul) && $id_ekskul == $row['id'] ? 'selected' :'') ?>><?php echo $row['nama_ekskul'] ?></option>
				        <?php endwhile; ?>				         
				            </select>
						</div>
						<div class="col-sm-3">
							<input type="month" name="doc" id="doc" value="<?php echo date('Y-m') ?>" class="form-control">
						</div>
						<div class="col-sm-2">
							<button class="btn  btn-primary" type="button" id="filter">Cari</button>
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-md-12" id='att-list'>
							<center><b><h4><i>Silahkan Pilih Ekstrakurikuler</i></h4></b></center>
						</div>
						<div class="col-md-12"  style="display: none" id="submit-btn-field">
							<center>
								<button class="btn btn-success btn-sm col-sm-3" type="button" id="print_att"><i class="fa fa-print"></i> Print</button>
							</center>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
</section>
</div>
<div id="table_clone" style="display: none">
	<table width="100%">
		<tr>
			<td width="50%">
				<p>Nama Ekstrakurikuler: <b class="ekskul"></b></p>
				<p>Bulan: <b class="doc"></b></p>
				<p>Total Absensi: <b class="noc"></b></p>
			</td>
		</tr>
	</table>
	<table class='table table-bordered table-hover att-list'>
		<thead>
			<tr>
				<th class="text-center" width="5%">#</th>
				<th width="20%" class="text-center">Nama Lengkap</th>
				<th width="15%" class="text-center">Nisn</th>
				<th class="text-center">Hadir</th>
				<th class="text-center">Alpha</th>
				<th class="text-center">Terlambat</th>
				<th class="text-center">Sakit / Izin</th>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
</div>
<div id="chk_clone" style="display: none">
	<div class="d-flex justify-content-center chk-opts">
		<div class="form-check form-check-inline">
		  <input class="form-check-input present-inp" type="checkbox" value="1" readonly="">
		  <label class="form-check-label present-lbl">Hadir</label>
		</div>
		<div class="form-check form-check-inline">
		  <input class="form-check-input absent-inp" type="checkbox" value="0" readonly="">
		  <label class="form-check-label absent-lbl">Alpha</label>
		</div>
		<div class="form-check form-check-inline">
		  <input class="form-check-input late-inp" type="checkbox" value="2" readonly="">
		  <label class="form-check-label late-lbl">Terlambat</label>
		</div>
		<div class="form-check form-check-inline">
		  <input class="form-check-input sick-inp" type="checkbox" value="3" readonly="">
		  <label class="form-check-label sick-lbl">Sakit</label>
		</div>
	</div>
</div>
<style>
	.present-inp,.absent-inp,.late-inp,.present-lbl,.absent-lbl,.late-lbl,.sick-lbl{
		cursor: pointer;
	}
</style>
<noscript>
	<style>
		table.att-list{
			width:100%;
			border-collapse:collapse
		}
		table.att-list td,table.att-list th{
			border:1px solid
		}
		.text-center{
			text-align:center
		}
	</style>
</noscript>
<script>

	$('#filter').click(function(){
		// start_loader()
		$.ajax({
			url:'ajax.php?action=laporan_absensi',
			method:'POST',
			data:{id_ekskul:$('#class_subject_id').val(),doc:$('#doc').val()},
			success:function(resp){
				if(resp){
					resp = JSON.parse(resp)
					var _table = $('#table_clone').clone()
					$('#att-list').html('')
					$('#att-list').append(_table)
					var _type = ['Alpha','Hadir','Terlambat', 'Sakit / Izin'];
					var data = !!resp.data ? resp.data : [] ;
					var record = !!resp.record ? resp.record :[];
					var id_kehadiran = !!resp.id_kehadiran ? resp.id_kehadiran : 0;
					if(Object.keys(data).length > 0){
						var i = 1;
						Object.keys(data).map(function(k){
							var nama_lengkap = data[k].nama_lengkap;
							var id_anggota = data[k].id_anggota;
							var nisn = data[k].nisn;
							var tr = $('<tr></tr>')

							// opts.find('.present-inp').attr({'name':'type['+id+']','id':'present_'+id})
							// opts.find('.absent-inp').attr({'name':'type['+id+']','id':'absent_'+id})
							// opts.find('.late-inp').attr({'name':'type['+id+']','id':'late_'+id})

							// opts.find('.present-lbl').attr({'for':'present_'+id})
							// opts.find('.absent-lbl').attr({'for':'absent_'+id})
							// opts.find('.late-lbl').attr({'for':'late_'+id})
							var present=0;
							var	late=0;
							var	absent=0;
							var sick=0;
							console.log(Object.keys(record).length)
							// record = JSON.parse(record)
								if(Object.keys(record).length > 0){
								if(record[id_anggota].length > 0){
									Object.keys(record[id_anggota]).map(i=>{
										if(record[id_anggota][i].type == 0)
											absent = parseInt(absent) + 1;
										if(record[id_anggota][i].type == 1)
											present = parseInt(present) + 1;
										if(record[id_anggota][i].type == 2)
											late = parseInt(late) + 1;
										if(record[id_anggota][i].type == 3)
											sick = parseInt(sick) + 1;
									})
								}  
								}  

							tr.append('<td class="text-center">'+(i++)+'</td>')
							tr.append('<td class="">'+(nama_lengkap)+'</td>')
							tr.append('<td class="">'+(nisn)+'</td>')
							var td = '<td class="text-center">';
								td += present;
								td += '</td>';
								td += '<td class="text-center">';
								td += late;
								td += '</td>';
								td += '<td class="text-center">';
								td += absent;
								td += '</td>';
								td += '<td class="text-center">';
								td += sick;
								td += '</td>';
							tr.append(td)

							_table.find('table.att-list tbody').append(tr)
						})
						$('#submit-btn-field').show()
						$('#edit_att').attr('data-id',id_kehadiran)
					}else{
							var tr = $('<tr></tr>')
							tr.append('<td class="text-center" colspan="5">No data.</td>')
							_table.find('table.att-list tbody').append(tr)
						$('#submit-btn-field').attr('data-id','').hide()
						$('#edit_att').attr('data-id','')
					} 
					$('#att-list').html('')
					
					_table.find('.ekskul').text(!!resp.details.ekskul ? resp.details.ekskul : '')
					_table.find('.doc').text(!!resp.details.doc ? resp.details.doc : '')
					_table.find('.noc').text(!!resp.details.noc ? resp.details.noc : '')

					_table.find('.noc').text(!!resp.details.noc ? resp.details.noc : '')
					$('#att-list').append(_table.html())
					if(Object.keys(record).length > 0){
						Object.keys(record).map(k=>{
							// console.log('[name="type['+record[k].student_id+']"][value="'+record[k].type+'"]')
							$('#att-list').find('[name="type['+record[k].id_anggota+']"][value="'+record[k].type+'"]').prop('checked',true)
						})
					}
				}
			},
			complete:function(){
				$("input[readonly]").on('keyup keypress change',function(e){
					e.preventDefault()
					return false;
				});
				$('#edit_att').click(function(){
					location.href = 'index.php?page=isi_absen&id_kehadiran='+$(this).attr('data-id')
				})
				// end_loader()
			}
		})
	})
	$('#manage-attendance').submit(function(e){
		e.preventDefault()
		start_load()
		$.ajax({
			url:'ajax.php?action=simpan_absensi',
			method:'POST',
			data:$(this).serialize(),
			success:function(resp){
				if(resp==1){
					  alert_toast("Data successfully saved.",'success')
                        setTimeout(function(){
                            location.reload()
                        },1000)
				}else if(resp ==2){
					  alert_toast("Class already has an attendance record with the slected subject and date.",'danger')
					  end_load();
				}
			}
		})
	})
	$('#print_att').click(function(){
		var _c = $('#att-list').html();
		var ns = $('noscript').clone();
		var nw = window.open('','_blank','width=900,height=600')
		nw.document.write(_c)
		nw.document.write(ns.html())
		nw.document.close()
		nw.print()
		setTimeout(() => {
			nw.close()
		}, 500);
	})
</script>