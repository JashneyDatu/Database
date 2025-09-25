<?php
 include "db/db_connect.php";
 $sql = "SELECT * FROM students";
 $search = "";
 $filter = "";
 if(isset($_GET['search'])&& isset($_GET['filter'])){
    $search = $_GET['search'];
    $filter = $_GET['filter'];
    
    if(!empty($search)&&!empty($filter)){
        $sql = "SELECT * FROM students WHERE $filter LIKE '%$search%";

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
    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
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
                    <input type="text" name="search" value="" class="form-control" placeholder="Enter search keyword">
                </div>
                <div class="col-md-3">
                    <select name="filter" class="form-select">
                        <option value="">-- Select Filter --</option>
                        <option value="student_no" >Student No</option>
                        <option value="fullname" >Full Name</option>
                        <option value="course" >Course</option>
                        <option value="year_level" >Year Level</option>
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

                   if ($result->num_rows > 0 ) {
                    while($row=$result->fetch_assoc()){
                        ?>
                        <tr>
                            <td><?=$row['id'];?></td>
                            <td><?=$row['student_no'];?></td>
                            <td><?=$row['fullname'];?></td>
                            <td><?=$row['course'];?></td>
                            <td><?=$row['year_level'];?></td>
                            <td>
                            <a href='edit.php?id=5' class='btn btn-sm btn-warning'>Edit</a>
                            <a href='delete.php?id=5' class='btn btn-sm btn-danger' onclick="return confirm('Are you sure you want to delete this student?');">Delete</a>

                            </td>
                        </tr>

                    <?php

                    }
                    
                   } else {
                     echo "<tr><td colspan=6>No Records Found</td><?tr>";
                   }
                   
                   ?>

                </tbody>
            </table>
        </div>
    </div>
</div>
 

<!-- Bootstrap JS -->
<script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>