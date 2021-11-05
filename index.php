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
?>

<!DOCTYPE html>
<html>
    <head>
        <title> ToDolist</title>
        <link rel="stylesheet" type="text/css" href="todolist_css.css">
    </head>
    <body>
       <h1>ToDo List<span id="point">.</span></h1>
        <form method="post" action="index.php" class="input_form"> 
             <?php if(isset($error)){?>
            <p><?php echo $error; ?></p>
                  
             <?php } ?>
            <input type="text" name="tache" class="tache_input">
            <button type="submit"
             name="submit" id="button_add" class="button_add">Ajouter Tache</button>  
        </form>
        <table>
            <thead>
                <tr>
                    <th>Numéro</th>
                    <th>Tâches</th>
                    <th>Action</th>
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
                    <td class="supprimer"><a href="index.php?del_task=<?php echo $row['id'] ?>">x</a></td>
                </tr>
                <?php $num++; } ?>
            </tbody>
        
        
        </table>
    </body>

</html>