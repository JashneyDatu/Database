<?php
// Include the database connection file (db_connect.php contains $conn = new mysqli(...) )
include "db/db_connect.php";

// Default SQL query: this will select all rows from the 'students' table
$sql = "SELECT * FROM students";

// Initialize variables for search input (text box) and filter option (dropdown)
$search = "";
$filter = "";

// Check if the user submitted the search form (using GET method)
if (isset($_GET['search']) && isset($_GET['filter'])) {
    // Get the search keyword from the input field
    $search = $_GET['search'];
    // Get the selected column to filter by (student_no, fullname, course, year_level)
    $filter = $_GET['filter'];

    // If both the keyword and filter are not empty
    if (!empty($search) && !empty($filter)) {
        // Modify the SQL query to include a WHERE condition
        // Example: SELECT * FROM students WHERE fullname LIKE '%Juan%'
        $sql = "SELECT * FROM students WHERE $filter LIKE '%$search%'";
    }
}

// Execute the final SQL query and store the result set in $result
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student List</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white text-center">
            <h3>Student List</h3>
        </div>
        <div class="card-body">
            
            <!-- Search Form -->
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
            <!-- Student Table -->
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

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>