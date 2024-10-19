<?php
include 'data/config.php';
session_start();

if (isset($_SESSION['message'])) {
    echo '<div class="alert alert-success text-center mt-3">';
    echo $_SESSION['message'];
    echo '</div>';
    unset($_SESSION['message']);
}

if (isset($_SESSION['error'])) {
    echo '<div class="alert alert-danger text-center mt-3">';
    echo $_SESSION['error'];
    echo '</div>';
    unset($_SESSION['error']);
}

try {
    $sql = 'SELECT student_id, first_name, last_name ,email,date_of_birth,gender,major,major,enrollment_year	 FROM students'; 
    $stmt = $conn->query($sql);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($result) > 0) {
        echo '<table class="table table-hover table-bordered text-center">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>date_of_birth</th>
                        <th>gender</th>
                        <th>major</th>
                        <th>enrollment_year</th>
                    </tr>
                </thead>
                <tbody>';
        foreach ($result as $row) {
            echo '<tr>
                    <td>' . htmlspecialchars($row['student_id']) . '</td>
                    <td>' . htmlspecialchars($row['first_name']) . '</td>
                    <td>' . htmlspecialchars($row['last_name']) . '</td>
                    <td>' . htmlspecialchars($row['email']) . '</td>
                    <td>' . $row['date_of_birth'] . '</td>
                    <td>' . htmlspecialchars($row['gender']) . '</td>
                     <td>' . htmlspecialchars($row['major']) . '</td>
                    <td>' . htmlspecialchars($row['enrollment_year']) . '</td>
                   
                    
                </tr>';
        }

        echo '</tbody></table>';
    } else {
        echo '<div class="alert alert-warning text-center">No records found.</div>';
    }
} catch (PDOException $e) {
    echo '<div class="alert alert-danger text-center">Error: ' . htmlspecialchars($e->getMessage()) . '</div>';
}
?>
