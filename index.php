<?php 
require_once('config.php');
$page = isset($_GET['page']) ? $_GET['page'] : 'home';
$page_name = explode("/",$page)[count(explode("/",$page)) -1];
?>
<!DOCTYPE html>
<html lang="en" itemscope itemtype="http://schema.org/WebPage">
<!-- CSS CAROUSEL -->
<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
	 <link rel="stylesheet" href="<?= base_url ?>assets/css_custom_dua/css/owl.carousel.min.css">
        <link rel="stylesheet" href="<?= base_url ?>assets/css_custom_dua/css/owl.theme.default.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/4.5.6/css/ionicons.min.css">
		<link rel="stylesheet" href="<?= base_url ?>assets/css_custom_dua/css/style.css">
<?php include_once('includes/header.php') ?>

<body class="index-page bg-gray-200">
    <script>start_loader()</script>
    <?php include_once('includes/top-navigation.php') ?>
    <!-- HEADER -->
    <!-- <header class="header-2"> -->
    <div class="home-slider owl-carousel js-fullheight "
    style="backround-color: red;
    width: 100%;
    transform: translateY(-20px);
    position: relative;
    height: 100px;
    overflow: hidden;
    
    ">
      <div class="slider-item js-fullheight" style="background-image:url(assets/css_custom_dua/images/football-banner-2.png);">
      	<div class="overlay"></div>
        <div class="container">
          <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-center">
	          <div class="col-md-12 ftco-animate">
	          	<div class="text w-100 text-center">
                    
                  <h2>Ekstrakurikuler</h2>
                <h1 class="mb-3">Futsal</h1>
                <p>AYO DAFTAR EKSKUL SEKARANG</p>
                <!-- <div class="buttons" id="part2" >
                <div class="button make-bg-color">
                 <span><a href="./?page=ekskul" style="text-decoration: none;color: black;">Cari Ekskul</a>
                        </span> 
                         </div>
                         </div> -->
	            </div>
	          </div>
	        </div>
        </div>
      </div>
      <!-- </header> -->
      <div class="slider-item js-fullheight" style="background-image:url(assets/css_custom_dua/images/basketball-banner.png);">
      	<div class="overlay"></div>
        <div class="container">
          <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-center">
	          <div class="col-md-12 ftco-animate">
	          	<div class="text w-100 text-center">
                  <h2>Ekstrakurikuler</h2>
                <h1 class="mb-3">Basket</h1>
                <p>AYO DAFTAR EKSKUL SEKARANG</p>
                <!-- <div class="buttons" id="part2" >
                <div class="button make-bg-color">
                 <span><a href="./?page=ekskul" style="text-decoration: none;color: black;">Cari Ekskul</a>
                        </span> 
                         </div>
                         </div> -->
	            </div>
	          </div>
	        </div>
        </div>
      </div>

      <div class="slider-item js-fullheight" style="background-image:url(assets/css_custom_dua/images/pramuka1.png);">
      	<div class="overlay"></div>
        <div class="container">
          <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-center">
	          <div class="col-md-12 ftco-animate">
	          	<div class="text w-100 text-center">
                  <h2>Ekstrakurikuler</h2>
                <h1 class="mb-3">Pramuka</h1>
                <p>AYO DAFTAR EKSKUL SEKARANG</p>
	            </div>
	          </div>
	        </div>
        </div>
      </div>
    </div>

    
    <!-- END HEADER -->
    <div class="card card-body blur shadow-blur mx-3 mx-md-4 mt-n6"
    style="transform: translateY(-120px);"
    >
        <?php 
        if($_settings->chk_flashdata('success')):
        ?>
        <div class="alert alert-success ?> rounded-0 text-light py-3 px-4 mx-3 ">
            <div class="d-flex w-100 align-items-center">
                <div class="col-10">
                    <?= $_settings->flashdata('success') ?>
                </div>
                <div class="col-2 text-end">
                    <button class="btn m-0 text-sm" type="button" onclick="$(this).closest('.alert').remove()"><i class="material-icons mb-0 text-light">close</i></button>
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
    <style>
#part2 {
    display: inline-block;
}
@media (min-width: 600px) {
    #part2 {
        display: grid;
        justify-items: center;
   }
}
.button {
    border-radius: 20px;
    width: 150px;
    padding: 20px 30px;
    margin: 20px;
    color: #000;
    font-weight: bold;
    text-transform: uppercase;
    text-align: center;
    border: 1.5px solid;
    box-shadow: -20px 5px #181213;
    aspect-ratio: 1.125;
    cursor: pointer;
    transition: all 0.13s ease-out;
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: #fff;
}
.button:hover {
    transition: all 0.13s ease-in;
    box-shadow: -20.5px 10px #181213;
    scale: 1.05;
}
.button:active {
    box-shadow: -5.5px 1px #181213;
    transform: translateY(4px);
}
#part1 > :nth-child(1) {
    background-color: #ff70a6;
}
#part1 > :nth-child(2) {
    background-color: #70d6ff;
}
#part1 > :nth-child(3) {
    background-color: #ff9770;
}
.make-bg-color {
    border-radius: 2px;
    box-shadow: none;
    min-width: 200px;
    aspect-ratio: 6;
    padding: 6px 41px;
}
.make-bg-color:hover {
    box-shadow: -7px 10px #181213;
}
.make-bg-color span {
    text-align: center;
    display: block;
}
.make-pink span {
    text-align: center;
    display: block;
}
.shadow-on-active:active {
    box-shadow: -3px 3px #181213;
    transform: translate3d(3px 2px 0px);
}
.shadow-by-default {
    box-shadow: -6px 5px #181213;
}
    </style>
    <?php include_once('includes/footer.php') ?>
    <!-- <script src="<?= base_url ?>assets/css_custom_dua/js/jquery.min.js"></script> -->
    <script src="<?= base_url ?>assets/css_custom_dua/js/popper.js"></script>
    <script src="<?= base_url ?>assets/css_custom_dua/js/bootstrap.min.js"></script>
    <script src="<?= base_url ?>assets/css_custom_dua/js/owl.carousel.min.js"></script>
    <script src="<?= base_url ?>assets/css_custom_dua/js/main.js"></script>
</body>

</html>