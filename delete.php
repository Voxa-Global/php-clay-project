<?php
    $con = mysqli_connect("localhost", "root", "", "crud_db");
    $id = $_GET['id'];
    $sql = "SELECT * FROM student WHERE id = '$id'";
    
    $result = mysqli_query($con, $sql);
    
    $row = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete <?php echo $row['firstname'];?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <div class="col-md-6 mx-auto mt-5">
            <h4 class="text-center">Delete <?php echo $row['firstname'];?></h4>
            <p>Are you sure you want to delete this student?</p>
            <form action="" method="POST">
                <input type="submit" name="delete" value="Yes, Delete" class="btn btn-danger">
                <a href="index.php" class="btn btn-secondary">Cancel</a>
            </form>

            <?php
                if(isset($_POST['delete'])){
                    $sql = "DELETE FROM student WHERE id = '$id'";
                    $delete = mysqli_query($con, $sql);

                    if($delete){
                        echo "Student is deleted successfully!";
                        header("Location: index.php");
                    }else{
                        echo "Something went wrong!";
                    }
                }
            ?>
        </div>
    </div>
</body>

</html>