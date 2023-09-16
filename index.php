<?php

include 'config/db_con.php';

$sql = 'SELECT title,ingredients, id FROM pizza';

$result = mysqli_query($conn, $sql);

$pizzas = mysqli_fetch_all($result, MYSQLI_ASSOC);

mysqli_free_result($result);
mysqli_close($conn);

?>

<!DOCTYPE html>
<html lang="en">
<?php include 'pizza/header.php';?>
    
    <h4 class="center grey-text">سفارشات اخیر</h4>

<div class="container">
   <div class="row">
      <?php foreach($pizzas as $pizza){ ?>
      
      <div class="col s6 md3">
         <div class="card z-depth-0">
            <img src="pizza/img/pizza.png" class="pizza">
            <div class="card-content center">
               <h6><?php echo htmlspecialchars($pizza['title']); ?></h6>
              <ul>
                  <div><?php foreach(explode(',', $pizza['ingredients']) as $ing){ ?>
                    <li><?php echo htmlspecialchars($ing); ?></li>
                  <?php } ?>
              </ul>
            </div>
            <div class="card-action right-align">
               <a class="brand-text" href="pizza/details.php?id=<?php echo $pizza['id'] ?> ">اطلاعات سفارش</a>
            </div>
         </div>
      </div>
      <?php } ?>
   </div>
</div>

<?php include 'pizza/footer.php'; ?>

</html>