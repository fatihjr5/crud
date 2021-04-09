<?php
//koneksi database
$server = "localhost";
$user = "root";
$pass = "";
$database = "aplikasi";

$koneksi = mysqli_connect($server, $user, $pass, $database) or die(mysqli_error($koneksi));
//setup
if(isset($_POST['submit'])){
    if($_GET['pages']=='update'){
        //update
        $updet = mysqli_query($koneksi, "UPDATE rate SET
        nama = '$_GET[nama]', komentar = '$_GET[komentar]' WHERE nama='$_GET[nama]' ");
        if ($updet){
        echo "<script>
        alert('Edit berhasil');
        document.location = 'index.php';
             </script>";
    }
        else{
        echo "<script>
        alert('Yah gagal');
        document.location = 'index.php';
             </script>";
    }
    }

    else{
        //new data
        $oke = mysqli_query($koneksi, "INSERT INTO rate (nama, komentar)
    VALUES ('$_POST[nama]', '$_POST[komentar]')
    ");
    if ($oke){
        echo "<script>
        alert('Data berhasil ditambahkan');
        document.location = 'index.php';
             </script>";
    }
    else{
        echo "<script>
        alert('Yah gagal');
        document.location = 'index.php';
             </script>";
    }
    }




    $oke = mysqli_query($koneksi, "INSERT INTO rate (nama, komentar)
    VALUES ('$_POST[nama]', '$_POST[komentar]')
    ");
    if ($oke){
        echo "<script>
        alert('Data berhasil ditambahkan');
        document.location = 'index.php';
             </script>";
    }
    else{
        echo "<script>
        alert('Yah gagal');
        document.location = 'index.php';
             </script>";
    }
}
//testing
if(isset($_GET['pages'])){
    //show data
    if($_GET['pages']=="update"){
        // show data now
        $show = mysqli_query($koneksi, "SELECT * FROM rate WHERE nama ='$_GET[nama]' ");
        $data = mysqli_fetch_array($show);
        if($data){
            //found
            $vnama = $data['nama'];
            $vkomentar = $data['komentar']; 
        }
    }
    else if($_GET['pages']="hapus"){
        //delete
        $hapus = mysqli_query($koneksi, "DELETE FROM rate WHERE nama ='$_GET[nama]'");
        if($hapus){
            echo"<script>
            alert('berhasil di hapus');
            document.location = 'index.php';
                 </script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Project</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
     <div class="header">
      <h4>Aplikasi Penilaian website statis</h4>
      <p>19.01.31.0024</p>
      <a target="blank" href="https://fervent-goldberg-414274.netlify.app/">Hit me</a>
     </div>
    </div>
    <!--Awal-->
    <div class="container">
     <div class="card tbl">
      <h5 class="card-header">Masukkan Data yang tersedia</h5>
     <div class="card-body">
         <form action="" method="post">
             <div class="form-group">
                 <label>Nama</label>
                 <input type="text" name="nama" value="<?=@$vnama?>" class="form-control" placeholder="Masukkan nama anda" required>
             </div>

             <div class="form-group mt-4">
                 <label>Komentar</label>
                 <input type="text" name="komentar" value="<?=@$vkomentar?>" class="form-control" placeholder="Masukkan Komentar anda" required>
             </div>

             <div class="text-center tombol">
             <button type="submit" class="btn btn-success mt-4 text-white" name="submit">Kirim</button>
             <button type="reset" class="btn btn-warning mt-4 text-white" name="reset">Reset</button>
             </div>
             
         </form>
     </div>
     </div>
    </div>
    <!--Akhir-->

    <!--Awal tabel-->
    <div class="container">
     <div class="card tbl">
      <h5 class="card-header">Hasil penilaian</h5>
     <div class="card-body">
         <table class="table table-striped table-bordered">
             <tr>
                 <th>No.</th>
                 <th>Nama</th>
                 <th>Komentar</th>
                 <th>Action</th>
             </tr>
             <?php
             $no = 1;
             $show = mysqli_query($koneksi, "SELECT * FROM rate order by nama desc");
             while($data = mysqli_fetch_array($show)) :
             
             
             ?>
             <tr>
                 <td><?=$no++;?></td>
                 <td><?=$data['nama']?></td>
                 <td><?=$data['komentar']?></td>
                 <td>
                     <a href="index.php?pages=update&nama=<?=$data['nama']?>" class="btn btn-danger text-white">Update</a>
                     <a href="index.php?pages=delete&nama=<?=$data['nama']?>" 
                     onclick="return confirm('Are you sure?')"class="btn btn-secondary text-white">Delete</a>
                 </td>
             </tr>
             <?php endwhile; ?>
         </table>
     </div>
     </div>
    </div>
    <!--Akhir tabel-->
    <script src="/js/bootstrap.min.js"></script>
</body>
</html>