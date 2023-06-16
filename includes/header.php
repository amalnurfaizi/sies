
<head>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="apple-touch-icon" sizes="76x76" href="<?= base_url ?>assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="assets/img/logo sekolahh.png">

    <title><?= ucwords(str_replace(["_","/"]," ",$page)) ?> | <?= $_settings->info('name') ?></title>



    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="<?= base_url ?>assets/font-awesome/css/all.min.css" />

    <!-- Font Awesome Icons -->
    <script src="<?= base_url ?>assets/font-awesome/js/all.min.js" crossorigin="anonymous"></script>

    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">

    <script src="<?= base_url ?>assets/bootstrap/js/popper.min.js" type="text/javascript"></script>

    <script src="<?= base_url ?>assets/js/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <!-- CSS Files -->
    <link href="<?= base_url ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?= base_url ?>assets/css/material-kit.css?v=3.0.2" rel="stylesheet" />
    <link href="<?= base_url ?>assets/summernote/summernote-lite.min.css" rel="stylesheet" />
    <link href="<?= base_url ?>assets/DataTables/datatables.min.css" rel="stylesheet" />
    <link href="<?= base_url ?>assets/DataTables/RowReorder-1.2.8/css/dataTables.rowReorder.min.css" rel="stylesheet" />
    <link href="<?= base_url ?>assets/DataTables/Responsive-2.2.9/css/dataTables.responsive.min.css" rel="stylesheet" />
    <link href="<?= base_url ?>assets/select2/dist/css/select2.min.css" rel="stylesheet" />
    <link href="<?= base_url ?>assets/css/custom.css" rel="stylesheet" />

      <!-- HEADER DUA -->
  <!-- Favicons -->
  <link href="<?= base_url ?>assets_dua/img/favicon.png" rel="icon" />
  <link href="<?= base_url ?>assets_dua/img/apple-touch-icon.png" rel="apple-touch-icon" />

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin /> 
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Source+Sans+Pro:ital,wght@0,300;0,400;0,600;0,700;1,300;1,400;1,600;1,700&display=swap" rel="stylesheet" />

  <!-- Vendor CSS Files -->
  <link href="<?= base_url ?>assets_dua/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
  <link href="<?= base_url ?>assets_dua/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet" />
  <link href="<?= base_url ?>assets_dua/vendor/aos/aos.css" rel="stylesheet" />
  <link href="<?= base_url ?>assets_dua/vendor/glightbox/css/glightbox.min.css" rel="stylesheet" />
  <link href="<?= base_url ?>assets_dua/vendor/swiper/swiper-bundle.min.css" rel="stylesheet" />

  <!-- Variables CSS Files. Uncomment your preferred color scheme -->
  <link href="<?= base_url ?>assets_dua/css/variables.css" rel="stylesheet" />
  <!-- <link href="assets/css/variables-blue.css" rel="stylesheet"> -->
  <!-- <link href="assets/css/variables-green.css" rel="stylesheet"> -->
  <!-- <link href="assets/css/variables-orange.css" rel="stylesheet"> -->
  <!-- <link href="assets/css/variables-purple.css" rel="stylesheet"> -->
  <!-- <link href="assets/css/variables-red.css" rel="stylesheet"> -->
  <!-- <link href="assets/css/variables-pink.css" rel="stylesheet"> -->

  <!-- Template Main CSS File -->
  <link href="<?= base_url ?>assets_dua/css/main.css" rel="stylesheet" />

  <!-- =======================================================
  ======================================================== -->


<!-- Template Main JS File -->



    <script>
            var loader = $('<div id="pre-loader">')
            loader.html('<div class="lds-ring"><div></div><div></div><div></div><div></div></div>')
            function start_loader(){
                $('body').find('#pre-loader').remove()
                $('body').prepend(loader)
            }
            function end_loader(){
                $('body').find('#pre-loader').remove()
            }
            $(function(){
                setTimeout(() => {
                    end_loader()
                }, 500);
            })
    </script>

</head>