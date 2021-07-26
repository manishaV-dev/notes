<?php
 $showAlert = false;
 $showError = false;
if($_SERVER["REQUEST_METHOD"] == "POST")
{
   
    include 'partial/_dbconnect.php';
    $name = $_POST['cname'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    // $exists=false;

    //check if email id exits or not.
    $exitSql = "SELECT * FROM users WHERE email = '$email'";
    
    $result = mysqli_query($conn, $exitSql);
    $numExitRows = mysqli_num_rows($result);

    if($numExitRows >0)
    {
        // $exists = true;
        $showError = "Email id already exists";
    }
    else
    {
        // $exists = false;
    

    if($password == $cpassword){

        $sql = "INSERT INTO `users` (`name`, `email`, `address`, `contact`, `password`, `date`) 
        VALUES ('$name', '$email', '$address', '$contact', '$password', current_timestamp())";    

        $result = mysqli_query($conn, $sql);
        if($result){
            $showAlert = true;
        }
    }
    else
    {
        $showError = "Password do not match";
    }
}

}

?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Signup</title>
</head>

<body>
    <!-- Navbar -->

    <?php
        require 'partial/_nav.php'
    ?>

    <!-- alert -->

    <?php
        if($showAlert){
            
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> Your account is now created now you can log in.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
        }

        if($showError){
            
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error!</strong> '. $showError . '
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
        }
    ?>


     <!-- main -->

    <div class="container my-4">
        <h2 class="text-center">Sign up to My iNotes</h2>
        
        <form action="signup.php" method="post" class="row g-3 my-4">

            <div class="mb-3 col-md-6">
                <label for="cname" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="name" name="cname" aria-describedby="emailHelp">
            </div>

            <div class="mb-3 col-md-6">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
            </div>

            <div class="mb-3 col-md-6">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control" id="address" name="address" aria-describedby="emailHelp">
            </div>

            <div class="mb-3 col-md-6">
                <label for="contact" class="form-label">Contact No.</label>
                <input type="number" class="form-control" id="contact" name="contact" aria-describedby="emailHelp">
            </div>


            <div class="mb-3 col-md-6">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" maxlength="12">
            </div>

            <div class="mb-3 col-md-6">
                <label for="cpassword" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="cpassword" name="cpassword" maxlength="12">
            </div>

            <button type="submit" class="btn btn-primary">Sign up</button>
        </form>
    </div>








    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>

</html>