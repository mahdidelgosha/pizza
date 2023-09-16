<?php
    include '../config/db_con.php';

    $email = $title = $ingredients = '';

    $errors = array('email'=> '', 'title'=> '', 'ingredients'=>'');

    if(isset($_POST['submit'])){
        // echo htmlspecialchars($_POST['email']);
        // echo '<br>';
        // echo htmlentities($_POST['title']);
        // echo '<br>';
        // echo htmlspecialchars($_POST['ingredients']);
        // echo '<br>';

        if(empty($_POST['email'])){
            $errors['email'] = 'ایمیل صحیح نمیباشد<br>';
        }else{
            $email = $_POST['email'];
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $errors['email'] = 'ایمیل خود را صحیح وارد کنید<br>';
            }
        }
        if(empty($_POST['title'])){
            $errors['title'] =  'عنوان خود را وارد کنید<br>';
        }else{
            $title = $_POST['title'];
            if(!preg_match('/^[a-zA-Z\s]+$/', $title)){
                $errors['title'] =  'عنوان صحیح نمیباشد<br>';
            }
        }
        if(empty($_POST['ingredients'])){
            $errors['ingredients'] = 'موارد خود را وارد کنید <br>';
        }else{
            $ingredients = $_POST['ingredients'];
            if(!preg_match('/^[a-zA-Z\s]+(,\s?[a-zA-Z\s]*)*$/', $ingredients)){
                $errors['ingredients'] = 'موارد صحیح نمیباشد<br>';
        }
    }
    if(!array_filter($errors)){
        $email = mysqli_real_escape_string($conn,$_POST['email']);
        $title = mysqli_real_escape_string($conn,$_POST['title']);
        $ingredients = mysqli_real_escape_string($conn,$_POST['ingredients']);

        $sql = "INSERT INTO pizza(title, email, ingredients) VALUES ('$title','$email',' $ingredients')";

        if(mysqli_query($conn, $sql)){
            header('location: ../index.php');
        }else{
            echo 'Query Error' . mysqli_error($conn);
        }
        
       

    }
}

?>

<!DOCTYPE html>
<html>
    
<style>
        body{
            background-image: url(../pizza/img/m.png);
            background-attachment: fixed;
            margin-left: auto;
        }
    </style>

    <?php include ('../pizza/header.php'); ?>
    
    <section class="container grey-text">
        <h4 class="center">خوش آمدید</h4>
        <form class="white" action="add.php" method="POST">
            <label>ایمیل خود را وارد کنید</label>
            <input type="text" name="email"  value="<?php echo htmlspecialchars($email); ?>">
            <div class="red-text"><?php echo $errors['email']; ?></div>
            <label>عنوان پیتزا</label>
            <input type="text" name="title"  value="<?php echo htmlspecialchars($title); ?>">
            <div class="red-text"><?php echo $errors['title']; ?></div>
            <label>مواد مورد نیاز</label>
            <input type="text" name="ingredients" value="<?php echo htmlspecialchars($ingredients); ?>">
            <div class="red-text"><?php echo $errors['ingredients']; ?></div>
            <div class="center">
                <input type="submit" name="submit" value="ارسال" class="btn brand z-depth-0">
            </div>
        </form>
    </section>

    <?php include ('../pizza/footer.php'); ?>

</html>