<style>
    .club-item{
        /* backdrop-filter: brightness(0.9); */
        border: grey solid 0.5px;
        border-radius: 20px;
    }
    .club-item:nth-child(2n-5){
        backdrop-filter: brightness(0.9);
        /* border: black solid 1px; */
    }
    .club-item:hover{
        backdrop-filter: brightness(0.90);
        
        
    }
    .club-item:hover .club-logo{
        transition: all ease-in-out 0.5s;
        transform:scale(1.3) rotate(10deg);

    }
    .club-item:hover .nama_ekskul{
        transition: all ease-in-out 0.5s;
        transform:scale(1.3);

    }
    .img-holder{
        width:15rem;
        height:15rem;
    }
    .club-logo{
        width:100%;
        height:100%;
        object-fit:cover;
        object-position:center center;
        transition: all .2s ease-in-out;
    }
    .truncate-3{
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

</style>
<div class="alert alert-danger rounded-1 text-light py-1 px-4 mx-3">
            <div class="d-flex w-100 align-items-center">
                <div class="col-10">
                   Jika Mendaftar Lebih Dari Satu Ekskul Pastikan Jadwal Tidak Bentrok!
                </div>
                <div class="col-2 text-end">
                    <button class="btn m-0 text-sm" type="button" onclick="$(this).closest('.alert').remove()"><i class="material-icons mb-0 text-light">close</i></button>
                </div>
            </div> 
        </div>
<section class="py-4">
    <div class="container">
        <h3 class="fw-bolder text-center mt-4">Daftar Ekstrakurikuler</h3>
   <center>
       <hr class="bg-primary w-25 opacity-100">
       
    </center>
  
    <div class="row justify-content-center py-5">
    

      <?php 
      $memuat_semua_ekskul = $conn->query("SELECT * FROM `ekskul` where `status` = 1 and logo = 0 order by `nama_ekskul` asc ");
      while($row = $memuat_semua_ekskul->fetch_assoc()):
      ?>
       
            <a href='./?page=ekskul/DetailEkskul&id=<?= $row['id'] ?>' class="col-md-4 club-item px-3 py-4 ">
                <div class="d-flex justify-content-center">
                    <div class="img-holder position-relative overflow-hidden border rounded-circle">
                        <img src="<?= validate_image($row['logo_path']) ?>" alt="<?= $row['nama_ekskul'] ?>" class="image-thumbnail club-logo">
                    </div>
                </div>
                <h5 class="text-center nama_ekskul"><b><?= $row['nama_ekskul'] ?></b></h5>
                <p class="text-sm text-muted text-center truncate-3"><?= $row['jadwal'] ?></p>
            </a>
  
            <?php endwhile?>
        </div>
    </div>
</section>
<script>
//     $( document ).ready(function() {
//         $('.club-item')({
//             processing: true,
//             serverSide: true,
//             ajax: {
//                 url:"../classes/Master.php?f=memuat_semua_ekskul",
//                 method:"POST"
//             }
//         })
// });
</script>
