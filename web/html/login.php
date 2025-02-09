<?php
require_once 'includes/database.php';
include "includes/header.php";

session_name('mbelisar_phpFinal');
session_start();
?>
<div class="container login-container">
    <div class="row">
        <div class="col-md-6 login-form-1">
            <h3>Sign Up</h3>
            <?php
            $accountCreated = false;

            if (isset($_POST['signup'])) {
                // get form values
                $email = $_POST['email'];
                $password = $_POST['password'];

                // TODO: Validate email/password BEFORE encryption

                // encrypt password (after validation)
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                // add user to database
                $query = "INSERT INTO `phpFinal__User` 
                    (`UserID`, `Email`, `Password`, `Role`) 
                VALUES 
                    (NULL, ?, ?, 'user');";
                $stmt = mysqli_prepare($db, $query);
                mysqli_stmt_bind_param($stmt, "ss", $email, $hashed_password);
                mysqli_stmt_execute($stmt);

                // check if record was created
                if (mysqli_insert_id($db)) {
                    $accountCreated = true;
                    echo '<div class="alert alert-success">
                          <b>Account created!</b><br>Please login.
                        </div>';

                } else {
                    echo '<div class="alert alert-danger">
                          <b>Error creating account!</b><br> (Tell the user what to do...email already used?)
                        </div>';
                }
            }
            ?>

            <?php if (!$accountCreated): ?>
                <form method="post">
                    <div class="form-group">
                        <input type="text" name="email" class="form-control" placeholder="Your Email *" value="">
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="Your Password *"
                               value="">
                    </div>
                    <div class="form-group">
                        <input type="submit" name="signup" class="btnSubmit" value="Sign Up">
                    </div>
                </form>
            <?php endif; ?>
        </div>
        <div class="col-md-6 login-form-2">
            <h3>Login</h3>
            <?php
            if (isset($_POST['login'])) {
                // get form values
                $email = $_POST['email'];
                $password = $_POST['password'];

                // get user record from database and check login
                $query = "SELECT Email, Password, role FROM phpFinal__User WHERE Email = ?";
                $stmt = mysqli_prepare($db, $query);
                mysqli_stmt_bind_param($stmt, "s", $email);
                mysqli_stmt_bind_result($stmt, $email, $hashed_password, $role);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_fetch($stmt);

                // make sure we have a user
                if($email && $hashed_password){
                    if(password_verify($password, $hashed_password)){
                        // the password is correct, but we still need to check if it needs to be updated
                        if(password_needs_rehash($hashed_password, PASSWORD_DEFAULT)){
                            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                            // TODO: update database record
                        }

                        // store the logged-in user in the session
                        $_SESSION['phpFinal__User']['email'] = $email;
                        $_SESSION['phpFinal__User']['role'] = $role;

                        // redirect to the secure area
                        header('Location: protected.php');
                    }else{
                        // wrong password
                        echo '<div class="alert alert-danger">Email or password was incorrect.</div>';
                    }
                }else{
                    // wrong email
                    echo '<div class="alert alert-danger">Email or password was incorrect.</div>';
                }
            }

            // logout and redirect to login page
            if (isset($_GET['logout'])) {
                // remove session data
                unset($_SESSION['phpFinal__User']);

                // destroy the session (and cookie)
                session_destroy();

                // redirect
                header("Location: login.php");
            }

            ?>
            <?php if (isset($_SESSION['phpFinal__User'])): ?>
                <form method="get">
                    <input type="submit" name="logout" class="btnSubmit" value="Log Out">
                </form>
            <?php else: ?>
                <form method="post">
                    <div class="form-group">
                        <input type="text" name="email" class="form-control" placeholder="Your Email *" value="">
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="Your Password *"
                               value="">
                    </div>
                    <div class="form-group">
                        <input type="submit" name="login" class="btnSubmit" value="Login">
                    </div>
                </form>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php
include "includes/footer.php";
?>
