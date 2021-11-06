

<!DOCTYPE html>
<html>
    <head>
        <title> ToDolist</title>
        <link rel="stylesheet" type="text/css" href="todolist_css.css">
    </head>
    <body>
       <h1>ToDo List<span id="point">.</span></h1>
        <form method="post" action="action.php" class="input_form"> 
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
                    <td class="supprimer"><a href="index.php?supprimer_tache=<?php echo $row['id'] ?>">X</a></td>
                    <td class="modifier"><a href="index.php?modifier_tache=<?php echo $row['id'] ?>">modifier</a></td>
                </tr>
                <?php $num++; } ?>
            </tbody>
        
        
        </table>
    </body>

</html>