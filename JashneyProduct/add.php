<?php
include "db/db_connect.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_code = $_POST['product_code']; 
    $product_name = $_POST['product_name']; 
    $category = $_POST['category']; 
    $qty = $_POST['qty']; 
 
     $check_sql = "SELECT product_code FROM product WHERE product_code = '$product_code'";
     $check_result = mysqli_query($conn, $check_sql);

     if (mysqli_num_rows($check_result) > 0) {
        echo "<div class='alert alert-warning text-center'>
                product code <b>$product_code</b> already exists!
              </div>";
    } else {
        $sql = "INSERT INTO product (product_code, product_name, category, qty) 
                VALUES ('$product_code', '$product_name', '$category', '$qty')";

        if (mysqli_query($conn, $sql)) {
            echo "<div class='alert alert-success text-center'>New product added successfully!</div>";
        } else {
            echo "<div class='alert alert-danger text-center'>Error: " . mysqli_error($conn) . "</div>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ADD PRODUCT</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Add New Product</h4>
        </div>
        <div class="card-body">
            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">product_code</label>
                    <input type="text" name="product_code" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">product_name</label>
                    <input type="text" name="product_name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">category</label>
                    <select name="category" class="form-select" required>
                        <option value="">-- category --</option>
                        <option value="Drinks">Drinks</option>
                        <option value="Chips">Chips</option>
                        <option value="Meat">Meat</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">qty</label>
                    <input type="text" name="qty" class="form-control" placeholder="" required>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="index.php" class="btn btn-secondary">Back</a>
                    <button type="submit" class="btn btn-success">Add Product</button>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>