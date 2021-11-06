<?php
$error="";
    //connecter à notre base
    $database=mysqli_connect("localhost", "root", "", "todoliste");
    
    //condition du button
    if(isset($_POST['submit'])){
          if(empty($_POST['tache'])){
      $error=" Vous devez remplir la tache, SVP.";
      } else{
         $tache=$_POST['tache'];
         $sql ="INSERT INTO taches (tache) VALUES ('$tache')";
        mysqli_query($database, $sql);
    
      }
         
    }
    // delete tach
if (isset($_GET['supprimer_tache'])) {
	$id = $_GET['supprimer_tache'];

	mysqli_query($database, "DELETE FROM taches WHERE id=".$id);
	header('location: index.php');
}
//modifier tache
if(isset($_GET['modifier_tache'])){
    $id =$_GET['modifier_tache'];
    $update = true;
		$record = mysqli_query($database, "SELECT * FROM taches WHERE id=".$id);

		
			$n = mysqli_fetch_array($record);
			$tache = $n['tache'];
			
		
}

if (isset($_POST['update'])) {
	$id = $_POST['id'];
	$tache = $_POST['tache'];
	

	mysqli_query($db, "UPDATE info SET tache='$tache' WHERE id=$id");
	$_SESSION['message'] = "Address updated!"; 
	header('location: index.php');
}

?>