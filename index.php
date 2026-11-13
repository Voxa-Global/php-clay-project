<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD</title>
    <link rel="stylesheet" href="./style.css">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>

<body>
    <h1 class="text-center">
        CRUD<span>actions</span>
    </h1>

    <section class="container mx-auto row">
        <aside class="col-md-4">

            <?php
                $con = mysqli_connect("localhost", "root", "", "crud_db");

                // if($con){
                //     echo "You are connected to the DB";
                // }else{
                //     echo "You are not  connected to the DB";
                // }

                if(isset($_POST['submit'])){
                    $fn = $_POST['firstname'];
                    $ln = $_POST['lastname'];
                    $dob = $_POST['dob'];
                    $country = $_POST['country'];
                    
                    $sql = "INSERT INTO student (firstname, lastname, age, country) VALUES ('$fn', '$ln', '$dob', '$country')";
                    $insert = mysqli_query($con, $sql);

                    if($insert){
                        echo "Student is registered successfully!";
                    }else{
                        echo "Something went wrong!";
                    }
                }

                if(isset($_POST['update'])){
                    $fn = $_POST['firstname'];
                    $ln = $_POST['lastname'];
                    $dob = $_POST['dob'];
                    $country = $_POST['country'];

                    $id = $_GET['id'];

                    $sql = "UPDATE student SET firstname='$fn', lastname='$ln', age='$dob', country='$country' WHERE id='$id'";
                    $update = mysqli_query($con, $sql);

                    if($update){
                        echo "Student is updated successfully!";
                    }else{
                        echo "Something went wrong!";
                    }
                }
            ?>

            <?php
                if(isset($_GET['id'])){
                    $id = $_GET['id'];
                    $sql = "SELECT * FROM student WHERE id = '$id'";
                    $result = mysqli_query($con, $sql);
                    $row = mysqli_fetch_assoc($result);

                    if(empty($row)){
                        $row = null;
                        $row['firstname'] = '';
                        $row['lastname'] = '';
                        $row['age'] = '';
                        $row['country'] = '';
                        echo "<div class='alert alert-danger'>Student not found!</div>";
                    }
                }
            ?>
            <form action="" method="POST">
                <div class="form-group">
                    <label for="fn">First name</label>
                    <input type="text" name="firstname" id="fn" placeholder="Enter the first name"
                        class="form-control" value="<?php if(isset($_GET['id'])){ echo $row['firstname']; } ?>">
                </div>
                <div class="form-group">
                    <label for="ln">Last name</label>
                    <input type="text" name="lastname" id="ln" placeholder="Enter the last name"
                        class="form-control" value="<?php if(isset($_GET['id'])){ echo $row['lastname']; } ?>">
                </div>
                <div class="form-group">
                    <label for="dob">Date of birth</label>
                    <input type="date" name="dob" id="dob" class="form-control" value="<?php if(isset($_GET['id'])){ echo $row['age']; } ?>">
                </div>

                <div class="form-group">
                    <label for="countrySelect" class="">Country</label> 
                        <?php if(isset($_GET['id'])):?> 
                            <?php if(empty($row)):?>
                                <span class="badge badge-pill badge-success">
                                    <?php echo $row['country'];?>
                                </span> 
                            <?php endif; ?>
                        <?php endif; ?>
                    <select name="country" class="form-control" id="countrySelect">
                        <option value="">-- Select --</option>
                        <option value="RW">Rwanda</option>
                        <option value="CD">DR Congo</option>
                        <option value="UG">Uganda</option>
                        <option value="US">USA</option>
                        <option value="FR">France</option>
                        <option value="CA">Canadae</option>
                        <option value="SP">Spain</option>
                    </select>
                </div>

                <div class="form-group">
                    <?php 
                        if(isset($_GET['id'])):?>
                            <?php if(!empty($row)):?>
                                <input type="submit" name="update" value="Update" class="cursor-disabled btn btn-block btn-success">
                            <?php endif; ?>
                        <?php else: ?>
                        <input type="submit" name="submit" value="Register" class="btn btn-block btn-primary">
                    <?php endif; ?>
                    <?php if(isset($_GET['id'])): ?>
                        <a href="index.php" class="btn btn-secondary mt-3">Cancel</a>
                    <?php endif; ?>
                </div>
            </form>
        </aside>
        <main class="col-md-8">
            <!-- Our data -->

            <table class="table table-stripe">
                <thead>
                    <tr>
                        <th>First name</th>
                        <th>Last name</th>
                        <th>Age</th>
                        <th>Date of Birth</th>
                        <th>Country</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                        $sql = "SELECT * FROM student";
                        $result = mysqli_query($con, $sql);


                        while($row = mysqli_fetch_assoc($result)){
                            echo "<tr>";
                            echo "<td>".$row['firstname']."</td>";
                            echo "<td>".$row['lastname']."</td>";
                            echo "<td>".$row['age']."</td>";
                            echo "<td>Age</td>";
                            echo "<td>".$row['country']."</td> ";
                            echo "<td>
                                    <div class='action-form-group btn btn-sm btn-group'>
                                        <a href='index.php?id=".$row['id']."' type='button' class='btn btn-info'>Edit</a>
                                        <button type='button' class='btn btn-primary'>View</button>
                                        <a href='delete.php?id=".$row['id']."' type='button' class='btn btn-danger'>Delete</a>
                                    </div>
                                </td>";
                            echo "</tr>";
                        }
                    ?>
                    
                </tbody>
            </table>
        </main>
    </section>

    <!-- jQuery library -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>