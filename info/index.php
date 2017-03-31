<?php

   if (isset($_POST['upload'])) {
	    // the path to store the uploaded image
		$target = "images/".basename($_FILES['image']['name']);
		
		//connect to the database
		$db = mysqli_connect('localhost', 'root', "", 'info');
		
		// Get all the submitted data from the form
		$image = $_FILES['image']['name'];
		$path = "images/$image";
		$sql = "INSERT INTO filter (image,path) VALUES ('$image','$path')";
		mysqli_query($db, $sql); //stores the submitted data into the database tables: images
		
		//Now let's move the uploaded image into the folder: images
		if(move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
			$msg = "Image uploaded successfully";
				
		}else{
			$msg = "There was a problem uploading image";
		}
		
   }



?>



<!DOCTYPE html>
<html>
<head>
<title>mockup generator</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <div id="content">
            <form method="post" action="index.php" enctype="multipart/form-data">
            <input type="hidden" name="size" value="1000000">
            <div>
	          <input class="choose" type="file" name="image">
		    </div>
            <div>
		    <input class="submit" type="submit" name="upload" value="Upload Image">
		  </div>
        </form>
            <?php
            
            $db = mysqli_connect('localhost', 'root', "", 'info');
            $sql = "SELECT * FROM filter";
            $result = mysqli_query($db, $sql);
            
            while ($row = mysqli_fetch_array($result)) {
	         echo "<div id='img_div'>";
	         echo "<img src='images/".$row['image']."' >";
	         echo "</div>"; 
                $id = $row['id'];
                $image = $row['image'];
                $path = $row['path'];
              echo "<button><a href='download.php?dow=$path'>Download</a></button><br>";
            }
            
            ?>
            
        
        </div>
    </body>
</html>