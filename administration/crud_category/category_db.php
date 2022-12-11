<?php

//Define empty error message
$nameErr = $descriptionErr = $currentCategory = "";

//Define Description of function
$f_Desc1 = "This page is the create category page and in here you can create and add a new category type.";
$f_Desc2 = "This page is the update category page and in here you can update a category details.";

//Create Category
if (isset($_POST['create_category'])) {

    $name = $_POST['name'];
    $description = $_POST['description'];
    
    if (empty($name)) {
        $nameErr = "Name field cannot empty.";
    } elseif (!empty($name)) {
        if (strlen($name) < 4) {
            $nameErr = "Category name must be at least 4 letter.";
        }
    }

    if (empty($description)) {
        $descriptionErr = "Description field cannot empty.";
    }

    if (empty($nameErr) && empty($descriptionErr)) {

        $sql1 = "INSERT INTO category (category_name, description) VALUES ('$name','$description')";

        $sql_run = mysqli_query($connect, $sql1);
        if ($sql_run) {
            $_SESSION['message'] = "Created successfully.";
            header("Location: http://localhost/Computer-Store-POS-System/administration/category.php");
            exit(0);
        } else {
            $_SESSION['error'] = "Create Fail";
            header("Location: http://localhost/Computer-Store-POS-System/administration/category.php");
            exit(0);
        }
    } else {
        $_SESSION['error'] = "Create Fail. Reason : <br>"
                . "<strong>$nameErr</strong><br>"
                . "<strong>$descriptionErr</strong>";
        header("Location: http://localhost/Computer-Store-POS-System/administration/category.php");
        exit(0);
    }
}


//Update Category
if (isset($_POST['update_category'])) {

    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];

    if (empty($name)) {
        $nameErr = "Name field cannot empty.";
    } elseif (!empty($name)) {
        if (strlen($name) < 4) {
            $nameErr = "Category name must be at least 4 letter.";
        }
    }

    if (empty($description)) {
        $descriptionErr = "Description field cannot empty.";
    }

    if (empty($nameErr) && empty($descriptionErr)) {
        $sql2 = "UPDATE category SET category_name='$name',description='$description' WHERE category_id='$id'";
        $sql_run = mysqli_query($connect, $sql2);
        if ($sql_run) {
            $_SESSION['message'] = "Updated successfully.";
            header("Location: http://localhost/Computer-Store-POS-System/administration/category.php");
            exit(0);
        } else {
            $_SESSION['error'] = "Update Fail.";
            header("Location: http://localhost/Computer-Store-POS-System/administration/category.php");
            exit(0);
        }
    } else {
        $_SESSION['error'] = "Update Fail. Reason : <br>"
                . "<strong>$nameErr</strong><br>"
                . "<strong>$descriptionErr</strong>";
        header("Location: http://localhost/Computer-Store-POS-System/administration/category.php");
        exit(0);
    }
}

//Delete Category 
if (isset($_POST['delete_category'])) {

    $id = $_POST['delete_id'];

    $sql4 = "DELETE FROM category WHERE category_id='$id'";
    $sql_run = mysqli_query($connect, $sql4);
    if ($sql_run) {
        $_SESSION['message'] = "Deleted successfully.";
        header("Location: http://localhost/Computer-Store-POS-System/administration/category.php");
        exit(0);
    } else {
        $_SESSION['error'] = "Delete Failed.";
        header("Location: http://localhost/Computer-Store-POS-System/administration/category.php");
        exit(0);
    }
}
?>