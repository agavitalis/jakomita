<?php 
sleep(3);
session_start();
$admin_username = $_SESSION['admin_username'];
$number = count($_FILES['attachment']['name']);
$conn = mysqli_connect("localhost","root","","jakomita");
	if (count($_FILES['attachment'])> 0) {
			for ($pixnum=0; $pixnum < count($_FILES['attachment']['name']) ; $pixnum++) { 
				$tmp_name = $_FILES['attachment']['tmp_name'][$pixnum];
				$name = $_FILES['attachment']['name'][$pixnum];
				$size = $_FILES['attachment']['size'][$pixnum];
				$type = $_FILES['attachment']['type'][$pixnum];
				$allowed_ext = array("jpg", "png","gif","jpeg");
				$img_ext = explode('/', $type);
				$img_ext = strtolower(end($img_ext));
				if (in_array($img_ext, $allowed_ext)) {
					$img_ext = $img_ext;
				}else{
					echo "Image type not allowed. (Please upload an image with the following extensions: .jpg, .png, .jpeg or .gif)";
					$err_flag = true;
				}

				if ($size > 512000) {
					echo "Your image size is too large. Please select an image below 500kb file size.";
					$err_flag = true;
				}

				if (!isset($err_flag)) {
					$upload_date= time();
					$random = rand(0,10000);
					$customedName = $upload_date.$random.'.'.$img_ext;
					$file_dir = "../../uploads/".$customedName;
					$filenewpath = "../uploads/".$customedName;
					$send = move_uploaded_file($tmp_name, $file_dir);
					if ($send) {
						$insert_attachment = mysqli_query($conn,"INSERT INTO forum_pictures (file_name,file_path) VALUES ('$customedName','$filenewpath')");
						if ($insert_attachment) {
							$findinputedpix = mysqli_query($conn,"SELECT * FROM forum_pictures where file_name = '$customedName'");
							$row = mysqli_fetch_array($findinputedpix);
							$id= $row['forum_attachment_id'];
							$filename = $row['file_name'];
							$filepath = $row['file_path'];
							echo "<img src='".$filepath."' class='responsive-img selectpix' style='width:100px;height:100px;margin-top:12px;margin-right:12px;cursor:pointer'id='".$id."'>";
						}
					}else{
						echo "an error occured";
					}

				}else{
					echo "error is still set";
				}				
			}
		}
		else{
			echo "not inserted";
		}

 ?>
 <script src="../js/jquery.js"></script>
