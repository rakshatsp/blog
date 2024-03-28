<?php
require 'config/database.php';


if(isset($_POST['submit'])){
    //get updated form data
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $is_admin = filter_var($_POST['userrole'], FILTER_SANITIZE_NUMBER_INT);

    //check for valid inputs
    if(!$firstname || !$lastname){
        $_SESSION['edit-user'] = "Invalid form Input on edit page.";
    }else{
        // update user
        $query = "UPDATE users SET firstname='$firstname', lastname='$lastname', is_admin=$is_admin WHERE id=$id LIMIT 1";
        $result = mysqli_query($connection, $query);

        if(mysqli_errno($connection)){
            $_SESSION['edit-user'] = "Failed to update user";
        }else{
            $_SESSION['edit-user-success'] = "User $firstname $lastname updated successfully";
        }
    }
}

header('location: ' . ROOT_URL . 'Admin/manage-users.php');
die();
