<?php
session_start();


    //connecter à notre base
    $database=mysqli_connect("localhost", "root", "", "todoliste");


    //initialiser les variable
$error="";
$update = false;
    
    //condition du button
    if(isset($_POST['submit'])){
          if(empty($_POST['tache'])){
      $error=" Vous devez remplir la tache, SVP.";
      } else{
         $tache=$_POST['tache'];
         $sql ="INSERT INTO taches (tache) VALUES ('$tache')";
         $_SESSION['message'] = "tache saved";
        mysqli_query($database, $sql);
    
      }
         
    }
    // delete tach
if (isset($_GET['supprimer_tache'])) {
	$id = $_GET['supprimer_tache'];
    
     $sql ="DELETE FROM taches WHERE id=".$id;
    $_SESSION['message'] = "tache supprimée!";
        mysqli_query($database, $sql);

	
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
	 $sql ="UPDATE taches SET tache='$tache' WHERE id=$id";
    $_SESSION['message'] = "tache updated!";
        mysqli_query($database, $sql);

	
	 
	
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title> ToDolist</title>
        <link rel="stylesheet" type="text/css" href="todolist_css.css">
    </head>
    <body>
        
       <h1>ToDo List<span id="point">.</span></h1>
        
        <?php if (isset($_SESSION['message'])): ?>
	<div class="message">
		<?php 
			echo $_SESSION['message']; 
			unset($_SESSION['message']);
		?>
	</div>
<?php endif ?>
        
        <form method="post" action="index.php" class="input_form"> 
             <?php if(isset($error)){?>
            <p><?php echo $error; ?></p>
                  
             <?php } ?>
            <input type="text" name="tache" class="tache_input">
            <!-- <button type="submit"
             name="submit" id="button_add" class="button_add">Ajouter Tache</button>  -->
            <?php if ($update == true):?>
            
	<button class="button_add" type="submit" name="update" style="background: #556B2F;" >update</button>
<?php else: ?>
	<button class="button_add" type="submit" name="submit" > Ajouter tache </button>
<?php endif ?>
            
            <input type="hidden" name="id" value="<?php echo $id; ?>">
        </form>
        <table>
            <thead>
                <tr>
                    <th>Numéro</th>
                    <th>Tâches</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>
               
            <tbody>
                <?php
                  $taches =mysqli_query($database, "SELECT * FROM taches");
                $num=1;
                  while ($row = mysqli_fetch_array($taches))  { ?>
                <tr>
                    <td><?php echo $num; ?></td>
                    <td class="tache"> <?php echo $row['tache']; ?> </td>
                    <td class="supprimer"><a href="index.php?supprimer_tache=<?php echo $row['id'] ?>">X</a></td>
                    <td class="modifier"><a href="index.php?modifier_tache=<?php echo $row['id'] ?>">modifier</a></td>
                </tr>
                <?php $num++; } ?>
            </tbody>
        
        
        </table>
        
        
        
        
        
    </body>

</html>