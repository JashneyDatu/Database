<?php
include "db/db_connect.php"; 

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM product WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc(); 
    } else {
        echo "<div class='alert alert-danger text-center'>Student not found!</div>";
        exit;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_code = $_POST['product_code']; 
    $product_name = $_POST['product_name']; 
    $category = $_POST['category']; 
    $qty = $_POST['qty']; 

    $sql = "UPDATE product 
            SET product_code='$product_code', product_name='$product_name', category='$category', qty='$qty'
            WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success text-center'>Product updated successfully!</div>";
    } else {
        echo "<div class='alert alert-danger text-center'>Error: " . $conn->error . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-warning text-dark">
            <h4 class="mb-0">Edit product</h4>
        </div>
        <div class="card-body">
            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">product_code</label>
                    <input type="number" name="product_code" class="form-control" value="<?php echo $product['product_code']; ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">product_name</label>
                    <input type="number" name="product_name" class="form-control" value="<?php echo $product['product_name']; ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">category</label>
                    <input type="number" name="category" class="form-control" value="<?php echo $product['category']; ?>" required>
                   
                </div>

                <div class="mb-3">
                    <label class="form-label">qty</label>
                    <input type="number" name="qty" class="form-control" value="<?php echo $product['qty']; ?>" required>
                   
                </div>

                <div class="d-flex justify-content-between">
                    <a href="index.php" class="btn btn-secondary">Back</a>
                    <button type="submit" class="btn btn-primary">Update product</button>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>