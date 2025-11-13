<?php
include "db/db_connect.php";

$sql = "SELECT * FROM students";
$search = "";
$filter = "";

if (isset($_GET['search']) && isset($_GET['filter'])) {
    $search = $_GET['search'];
    $filter = $_GET['filter'];

    if (!empty($search) && !empty($filter)) {
        $sql = "SELECT * FROM students WHERE $filter LIKE '%$search%'";
    }
}
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white text-center">
            <h3>Student List</h3>
        </div>
        <div class="card-body">
            
            <form method="GET" class="row g-3 mb-4">
                <div class="col-md-4">
                    <input type="text" name="search" value="<?= htmlspecialchars($search) ?>" class="form-control" placeholder="Enter search keyword">
                </div>
                <div class="col-md-3">
                    <select name="filter" class="form-select">
                        <option value="">-- Select Filter --</option>
                        <option value="student_no" <?= ($filter=="student_no")?"selected":"" ?>>Student No</option>
                        <option value="fullname" <?= ($filter=="fullname")?"selected":"" ?>>Full Name</option>
                        <option value="course" <?= ($filter=="course")?"selected":"" ?>>Course</option>
                        <option value="year_level" <?= ($filter=="year_level")?"selected":"" ?>>Year Level</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-success w-100">Search</button>
                </div>
                <div class="col-md-2">
                    <a href="index.php" class="btn btn-secondary w-100">Reset</a>
                </div>
            </form>
            <div class="mb-3">
                <a href="create.php" class="btn btn-success">+ Add New Student</a>
            </div>
            <table class="table table-bordered table-striped text-center align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Student No</th>
                        <th>Full Name</th>
                        <th>Course</th>
                        <th>Year Level</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>".$row["id"]."</td>
                                    <td>".$row["student_no"]."</td>
                                    <td>".$row["fullname"]."</td>
                                    <td>".$row["course"]."</td>
                                    <td>".$row["year_lvl"]."</td>
                                    <td>
                                        <a href='edit.php?id=".$row["id"]."' class='btn btn-sm btn-warning'>Edit</a>
                                        <a href='delete.php?id=".$row["id"]."' class='btn btn-sm btn-danger' onclick=\"return confirm('Are you sure you want to delete this student?');\">Delete</a>
                                    </td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6' class='text-muted'>No records found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>