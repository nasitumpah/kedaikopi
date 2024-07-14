<!DOCTYPE html>
<?php
	include "connection/koneksi.php";
	session_start();
	if(isset ($_SESSION['username'])){
		header('location:entri_referensi.php');
	} else {
?>
<html lang="en">
<head>
	<title>Masuk || Keda Kopi</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<audio id="bgMusic" src="audio/Persona 3 Reload - Color Your Night (with Lyrics).mp3" autoplay loop></audio>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Mendapatkan elemen audio
        var bgMusic = document.getElementById("bgMusic");

        // Cek apakah terdapat data posisi musik yang disimpan di sessionStorage
        if (sessionStorage.getItem("bgMusicPos")) {
            // Jika ada, set posisi audio ke posisi yang disimpan
            bgMusic.currentTime = parseFloat(sessionStorage.getItem("bgMusicPos"));
        }

        // Set volume ke 50% (0.5)
        bgMusic.volume = 0.1;

        // Simpan posisi audio saat halaman ditutup atau di-refresh
        window.addEventListener("beforeunload", function() {
            sessionStorage.setItem("bgMusicPos", bgMusic.currentTime);
        });
    });
</script>

	
<!--===============================================================================================-->

	<link rel="icon" type="image/png" href="template/masuk/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="template/masuk/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="template/masuk/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="template/masuk/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="template/masuk/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="template/masuk/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="template/masuk/vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="template/masuk/css/util.css">
	<link rel="stylesheet" type="text/css" href="template/masuk/css/main.css">
<!--===============================================================================================-->
	<style>
		.full-height {
			min-height: 100vh;
		}
		.background-center {
			background-image: url('gambar/cafeleblanc.png');
			background-position: center;
			background-size: cover;
			
		}
	</style>
</head>

<body>
	<div class="limiter">
		<div class="d-flex justify-content-center align-items-center full-height background-center">
			<div class="wrap-login100 p-t-120 p-b-30">
				<form action="" method="post" class="login100-form validate-form">
					<?php 
						if(isset($_SESSION['eror'])){
					?>
						<div class='container'>	
							<div class = 'alert alert-danger'>
								<span>
									<center>Mungkin Akun Anda Salah Atau Belum Divalidasi</center>
								</span>
							</div> 
						</div>
					<?php 
						unset($_SESSION['eror']);
						}
					?>
					<div class="login100-form-avatar">
					</div>

					<span class="login100-form-title p-t-20 p-b-45">
						KEDAI KOPI
					</span>
					<div class="wrap-input100 validate-input m-b-10" data-validate = "Username is required">
						<input class="input100" type="text" name="username" placeholder="Username">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input m-b-10" data-validate = "Password is required">
						<input class="input100" type="password" name="password" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock"></i>
						</span>
					</div>

					<div class="container-login100-form-btn p-t-10">
						<button type="submit" name="login" class="login100-form-btn">
							Login
						</button>
					</div>
					<?php 
						if(isset($_SESSION['username'])){
					?>
					<div class="text-center w-full">
						<a class="txt1" href="logout.php">
							Log Out
							<i class="fa fa-long-arrow-right"></i>						
						</a>
					</div>
					<?php
						} else {
					?>
					<br><br><br><br><br>
					<div class="text-center w-full">
						<a class="txt1" href="daftar.php">
							<i class="fa fa-long-arrow-right"></i>						
						</a>
					</div>
					<?php
						}
					?>
				</form>
			</div>
		</div>
	</div>

	<?php
		if(isset ($_REQUEST['login'])){
			$arr_level = array();
			$c_level = mysqli_query($conn, "select * from tb_level");

			while($r = mysqli_fetch_array($c_level)){
				array_push($arr_level, $r['nama_level']);
			}
			foreach ($arr_level as $kontens) {
				//echo $kontens." || ";
			}
			$username = $_REQUEST['username'];
			$password = $_REQUEST['password'];

			$akun = mysqli_query($conn, "select * from tb_user natural join tb_level");
			echo mysqli_error($conn);
			while($r = mysqli_fetch_array($akun)){
				if($r['username'] == $username and $r['password'] == $password and $r['status'] == 'aktif'){
					$_SESSION['username'] = $username;
					$_SESSION['id_user'] = $r['id_user'];
					$_SESSION['level'] = $r['id_level'];
					if(isset($_SESSION['eror'])){
						unset($_SESSION['eror']);
					}
					header('location: entri_referensi.php');
					//echo "<br>";
					//echo $r['username'] . " || " . $r['password'] . " || " . $r['id_level'] . " || " . $r['nama_level'];
					//echo "<br></br>";
					break;
				} else {
					$_SESSION['eror'] = 'salah';
					header('location: index.php');
				}
			} 
		} 
	?>
	
	

	
<!--===============================================================================================-->	
	<script src="template/masuk/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="template/masuk/vendor/bootstrap/js/popper.js"></script> 
	<script src="template/masuk/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="template/masuk/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="template/masuk/js/main.js"></script>

</body>
</html>
<?php
	}
?>
