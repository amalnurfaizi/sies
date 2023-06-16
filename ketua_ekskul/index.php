
<?php 
require_once('../config.php');
$page = isset($_GET['page']) ? $_GET['page'] : 'home';
$page_name = explode("/",$page)[count(explode("/",$page)) -1];
?>
<!DOCTYPE html>
<html lang="en" itemscope itemtype="http://schema.org/WebPage">

<?php include_once('includes/header.php') ?>

<body class="index-page bg-gray-200">
    <script>start_loader()</script>
    <?php include_once('includes/top-navigation.php') ?>
    <header class="header-2">
        <div class="page-header min-vh-70 relative" style="background-image: url('../assets/css_custom_dua/images/foto-background1.png')">
            <span class="mask bg-gradient-dark opacity-4"></span>
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 text-center mx-auto">
                        <h1 class="text-white pt-3 mt-n5"><?= $_settings->info('name') ?></h1>
                        <p class="lead text-white mt-3"><?= ucwords(str_replace(["_","/"]," ",$page)). " Page" ?></p>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="card card-body blur shadow-blur mx-3 mx-md-4 mt-n6">
        <?php 
        if($_settings->chk_flashdata('success')):
        ?>
       
        <div class="alert alert-success ?> rounded-0 text-light py-1 px-4 mx-3">
            <div class="d-flex w-100 align-items-center">
                <div class="col-10">
                    <?= $_settings->flashdata('success') ?>
                </div>
                <div class="col-2 text-end">
                    <button class="btn m-0 text-sm text-light" type="button" onclick="$(this).closest('.alert').remove()"><i class="material-icons mb-0">close</i></button>
                </div>
            </div> 
        </div>
        
        <?php endif; ?>
        <?php
        if(is_file($page.'.php')){
            include $page.'.php';
        }else{
            if(is_dir($page) && is_file($page.'/index.php')){
                include $page.'/index.php';
            }else{
                echo '<h4 class="text-center fw-bolder">Page Not Found</h4>';
            }
        }
        ?>
       
    </div>

    <div class="modal fade" id="uni_modal" role='dialog' data-bs-backdrop="static">
        <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
        <div class="modal-content rounded-0">
            <div class="modal-header">
            <h5 class="modal-title"></h5>
        </div>
        <div class="modal-body">
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary btn-sm rounded-0" id='submit' onclick="$('#uni_modal form').submit()">Simpan</button>
            <button type="button" class="btn btn-secondary btn-sm rounded-0" data-bs-dismiss="modal">Batal</button>
        </div>
        </div>
        </div>
    </div>



    <div class="modal fade" id="uni_modal_right" role='dialog' data-bs-backdrop="static">
        <div class="modal-dialog modal-full-height  modal-md" role="document">
        <div class="modal-content rounded-0">
            <div class="modal-header">
            <h5 class="modal-title"></h5>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span class="fa fa-arrow-right"></span>
            </button>
        </div>
        <div class="modal-body">
        </div>
        </div>
        </div>
    </div>
    <div class="modal fade" id="viewer_modal" role='dialog' data-bs-backdrop="static">
        <div class="modal-dialog modal-md" role="document">
        <div class="modal-content rounded-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal"><span class="fa fa-times"></span></button>
                <img src="" alt="">
        </div>
        </div>
    </div>
    <div class="modal fade" id="confirm_modal" role='dialog' data-bs-backdrop="static">
        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
        <div class="modal-content rounded-0">
            <div class="modal-header">
            <h5 class="modal-title">Konfirmasi</h5>
        </div>
        <div class="modal-body">
            <div id="delete_content"></div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary btn-sm rounded-0" id='confirm' onclick="">Ya</button>
            <button type="button" class="btn btn-secondary btn-sm rounded-0" data-bs-dismiss="modal">Tidak</button>
        </div>
        </div>
        </div>
    </div>
    <?php include_once('includes/footer.php') ?>
    <script>
 $('.select2').select2({
    placeholder:"Pilih Ekstrakurikuler",
    width: "100%",
    padding: "40px"
   
   });
   window.alert_toast= function($msg = 'TEST',$bg = 'success'){
      $('#alert_toast').removeClass('bg-success')
      $('#alert_toast').removeClass('bg-danger')
      $('#alert_toast').removeClass('bg-info')
      $('#alert_toast').removeClass('bg-warning')

    if($bg == 'success')
      $('#alert_toast').addClass('bg-success')
    if($bg == 'danger')
      $('#alert_toast').addClass('bg-danger')
    if($bg == 'info')
      $('#alert_toast').addClass('bg-info')
    if($bg == 'warning')
      $('#alert_toast').addClass('bg-warning')
    $('#alert_toast .toast-body').html($msg)
    $('#alert_toast').toast({delay:3000}).toast('show');
  }



    </script>

</body>

</html>