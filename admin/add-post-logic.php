<?php
require 'config/database.php';

if(isset($_POST['submit'])) {
    $author_id = $_SESSION['user-id'];
    $title = filter_var($_POST['title'] , FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $body = filter_var($_POST['body'] , FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $category_id = filter_var($_POST['category'] , FILTER_SANITIZE_NUMBER_INT);
    $is_featured = filter_var($_POST['is_featured'] , FILTER_SANITIZE_NUMBER_INT);
    $thumbnail = $_FILES['thumbnail'];

    $is_featured = $is_featured == 1 ?: 0;

    if(!$title){
        $_SESSION['add-post'] = "Enter Post Title";
    }
    elseif(!$category_id){
        $_SESSION['add-post'] = "Select Post Category";
    }
    elseif(!$body){
        $_SESSION['add-post'] = "Enter Post Body";
    }
    elseif(!$thumbnail['name']){
        $_SESSION['add-post'] = "Choose Post Thumbnail";
    }
    else{
        $time = time();
        $thumbnail_name = $time . $thumbnail['name'];
        $thumbnail_tmp_name = $thumbnail['tmp_name'];
        $thumbnail_destination_path = '../images/' . $thumbnail_name;

        $allowed_files = ['png' , 'jpg' , 'jpeg'];
        $extension = explode('.' , $thumbnail_name);
        $extension = end($extension);

        if(in_array($extension , $allowed_files)){
            if($thumbnail['size'] < 2000000){
                move_uploaded_file($thumbnail_tmp_name , $thumbnail_destination_path);
            }
            else{
                $_SESSION['add-post'] = "File Size Should Be Less Than 2 MB.";
            }
        }
        else{
            $_SESSION['add-post'] = "File Type Not Supported. Please Upload A Valid File";
        }
    }

    if($_SESSION['add-post']){
        $_SESSION['add-post-data'] = $_POST;
        header('location: '. ROOT_URL . 'admin/add-post.php');
        die();
    }
    else{
        if($is_featured == 1){
            $zero_all_is_featured_query = "UPDATE posts SET is_featured = 0";
            $zero_all_is_featured_query_result = mysqli_query($connection , $zero_all_is_featured_query);
        }
            $query = "INSERT INTO posts(title , body , thumbnail , category_id , author_id , is_featured) VALUES ('$title' , '$body' , '$thumbnail_name' , $category_id , $author_id , $is_featured)";
            $result = mysqli_query($connection , $query);

            if(mysqli_errno($connection)){
                $_SESSION['add-post-success'] = "New Post Added successfully";
                header('location:' . ROOT_URL . 'admin/');
            }
        }
    }

header('location:' . ROOT_URL . 'admin/');
die();