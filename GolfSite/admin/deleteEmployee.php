<?php  
    include('../config/constants.php');

    echo $id = $_GET['id'];
    $sql = "SELECT * FROM employees WHERE `id` = $id";
    $res = mysqli_query($conn, $sql);
    $row=mysqli_fetch_assoc($res);
    $category = $row['category'];
    $discount = $row['percent_off'];

    $sql = "DELETE FROM promotions WHERE `id` = $id";
    $res = mysqli_query($conn, $sql);

    $sql = "UPDATE `products` SET `Price` = Price/(1-$discount) WHERE `products`.`Description` = '$category';";
    $res = mysqli_query($conn, $sql);

    if($res==true)
    {
        $_SESSION['delete'] = "<div class='success'>Deleted Successfully</div>";
        header("location:".SITEURL.'admin/manage-promos.php');
    }
    else{
        $_SESSION['delete'] = "<div class='error'>Failed to Delete Product</div>";
    }
        
?>