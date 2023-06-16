<section class="py-4">
    <div class="container-fluid">
        <h3 class="fw-bolder text-center">List Pendaftar</h3>
        <center>
            <hr class="bg-primary w-25 opacity-100">
        </center>
        <table class="table table-striped table-bordered dt-init">
            <colgroup>
                <col width="5%">
                <col width="20%">
                <col width="30%">
                <col width="20%">
                <col width="20%">
                <col width="10%">
                <col width="10%">
            </colgroup>
            <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">Diperbarui</th>
                    <th class="text-center">Nama Lengkap</th>
                    <th class="text-center">Nisn</th>
                    <th class="text-center">Kelas - Jurusan</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</section>
<noscript id="action-btn-clone">
<div class="dropdown">
<button class="btn btn-primary btn-sm bg-gradient rounded-0 mb-0" type="button" id="" data-bs-toggle="dropdown" aria-expanded="false">
    Aksi <span class="material-icons">keyboard_arrow_down</span>
</button>
    <ul class="dropdown-menu" aria-labelledby="">
        <li><a class="dropdown-item view_data w-100 d-flex align-items-center" href="javascript:void(0)"><span class="material-icons me-2">wysiwyg</span> Lihat</a></li>
        <li><a class="dropdown-item delete_data w-100 d-flex align-items-center" href="javascript:void(0)"><span class="material-icons me-2">delete</span> Hapus</a></li>
    </ul>
</div>
</noscript>
<script>
    $(function(){
        $('.dt-init').DataTable({
            processing: true,
            serverSide: true,
            searching: false,
            ajax: {
                url:"../classes/Master.php?f=data_pendaftar_ekskul",
                method:"POST"
            },
            columns: [{
                    data: 'no',
                    className: 'py-1 px-2 text-center',
                    width:"5%"
                },
                {
                    data: 'tanggal_diperbarui',
                    className: 'py-1 px-2',
                    width:"20%"
                },
                {
                    data: 'nama_lengkap',
                    className: 'py-1 px-2',
                    width:"30%"
                },
                {
                    data: 'nisn',
                    className: 'py-1 px-2',
                    width:"20%"
                },
                {
                    data: 'kelas_jurusan',
                    className: 'py-1 px-2',
                    width:"20%"
                },
                {
                    className: 'py-1 px-2 text-center',
                    render:function(data, type, row, meta){
                        let stat;
                        switch(parseInt(row.status)){
                            case 0:
                                stat =  '<span class="badge bg-default border text-muted bg-gradient px-3 rounded-pill">Tertunda</span>' ;
                                break;
                            case 1:
                                stat =  '<span class="badge bg-primary bg-gradient px-3 rounded-pill">Terkonfirmasi</span>' ;
                                break;
                            case 2:
                                stat =  '<span class="badge bg-success bg-gradient px-3 rounded-pill">Disetujui</span>' ;
                                break;
                            case 3:
                                stat =  '<span class="badge bg-danger bg-gradient px-3 rounded-pill">Ditolak</span>' ;
                                break;
                            default:
                                stat = ""
                                break;
                        }
                        console.log(stat)
                        return stat;
                    },
                    width:"15%"
                },
                {
                    data: null,
                    orderable: false,
                    className: 'text-center py-1 px-2',
                    render: function(data, type, row, meta) {
                        var el = $('<div>')
                        el.append($($('noscript#action-btn-clone').html()).clone())
                        el.attr('id','dropdown'+row.id)
                        el.find('.dropdown-menu').attr('aria-labelledby','dropdown'+row.id)
                        el.find('.edit_data,.delete_data,.view_data').attr('data-id',row.id).attr('data-name',row.nama_lengkap)
                        el.find('.view_data').attr("href","./?page=pendaftaran/DetailPendaftar&id="+row.id)
                        
                        return el.html();
                        
                    },
                    width:"10%"
                }
            ],
            columnDefs: [{
                orderable: false,
                targets: [2,3,4,5]
            }],
            initComplete: function(settings, json) {
                $('table td, table th').addClass('px-2 py-1 align-middle')
            },
            drawCallback: function(settings) {
                $('table td, table th').addClass('px-2 py-1 align-middle')
                $('.delete_data').click(function(){
                    _conf("Apakah Yakin Ingin Menghapus Pendaftar Dengan Nama <b>"+$(this).attr('data-name')+"</b> Dari List?","hapus_pendaftar",[$(this).attr('data-id')])
                })
            },
            language:{
                oPaginate: {
                    sNext: '<i class="fa fa-angle-right"></i>',
                    sPrevious: '<i class="fa fa-angle-left"></i>',
                    sFirst: '<i class="fa fa-step-backward"></i>',
                    sLast: '<i class="fa fa-step-forward"></i>'
                }
            }
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
                    location.reload()
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