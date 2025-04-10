
<?php
include 'connect.php';

$deptColors = [];
$sql = "SELECT DISTINCT dept_id FROM departments";
$results = $conn->query($sql);

if ($results->num_rows > 0) {
    while ($row = $results->fetch_assoc()) {
        $department = $row['dept_id'];

        // Assign alternating colors based on the hash value
        $hash = hexdec(substr(md5($department), 0, 6));
        $deptColors[$department] = ($hash % 2 == 0) ? "#a0afc5" : "#4361ee"; // Alternates between blue and silver
    }
}
/*$deptColors = [];
$sql = "SELECT DISTINCT dept_id FROM departments";
$results = $conn->query($sql);

if ($results->num_rows > 0) {
    while ($row = $results->fetch_assoc()) {
        $department = $row['dept_id'];

        // Generate a consistent random color for each department using md5 hash
        $hash = md5($department);
        $deptColors[$department] = "#" . substr($hash, 0, 6);
    }
}*/

$sql = "SELECT t.*, d.department_name FROM teachers t 
        INNER JOIN departments d ON t.department = d.dept_id"; 
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher List</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <div class="container">
        <nav class="sidebar">
            <div class="logo">
                <i class="fas fa-graduation-cap fa-2x"></i>
                <h2>Timetable</h2>
            </div>
            <ul class="nav-links">
                <li><a href="../index.html"><i class="fas fa-home"></i> Dashboard</a></li>
                <li><a href="teacher-registration.html"><i class="fas fa-user-plus"></i> Teacher Registration</a></li>
                <li class="active"><a href="teacher-list.php"><i class="fas fa-users"></i> Teacher List</a></li>
                <li><a href="timetable-generator.html"><i class="fas fa-calendar-alt"></i> Timetable Generator</a></li>
            </ul>
            <div class="user-info">
                <i class="fas fa-user-circle fa-2x"></i>
                <div>
                    <h4>Admin User</h4>
                    <p>Administrator</p>
                </div>
            </div>
        </nav>

        <main class="content">
            <header>
                <div class="search-bar">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Search teachers...">
                </div>
                <div class="header-icons">
                    <div class="icon-wrapper">
                        <i class="fas fa-bell"></i>
                        <span class="notification-badge">3</span>
                    </div>
                    <div class="icon-wrapper">
                        <i class="fas fa-envelope"></i>
                        <span class="notification-badge">5</span>
                    </div>
                    <i class="fas fa-cog"></i>
                </div>
            </header>

            <div class="page-title">
                <div class="title-wrapper">
                    <h1>Teacher List</h1>
                </div>
            </div>

            <div class="table-container">
                <table class="teacher-table">
                    <thead>
                        <tr>
                            <th>Teacher</th>
                            <th>Department</th>
                            <th>Qualification</th>
                            <th>Contact</th>
                            <th>Experience</th>
                            <th>Subjects</th> 
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $deptColor = $deptColors[$row['department']];
                                echo "<tr>
                                    <td>
                                        <div class='teacher-cell'>
                                            <div class='teacher-avatar'>
                                                <i class='fas fa-user-circle'></i>
                                            </div>
                                            <div class='teacher-basic-info'>
                                                <h4>{$row['full_name']}</h4>
                                                <p>ID: {$row['teacher_id']}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class='department-badge' style='background: {$deptColor}; color: #fff; padding: 5px 7px; display: flex; align-items: center; justify-content: center;'>
                                            <span style='text-align: center;'>{$row['department_name']}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class='qualification-info'>
                                            <span class='degree'>{$row['qualification']}</span>
                                            <span class='specialization'>{$row['specialization']}</span>
                                        </div>
                                    </td>
                                    
                                    <td>
                                        <div class='contact-info'>
                                            <div><i class='fas fa-envelope'></i> {$row['email']}</div>
                                            <div><i class='fas fa-phone'></i> {$row['phone']}</div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class='experience-cell'>
                                            <span class='years'>{$row['experience']} Years</span>
                                            
                                        </div>
                                    </td>
                                    <td>
                                        <div class='experience-cell'>
                                        
                                            <span class='subjects'>{$row['subjects']}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class='status-badge " . strtolower($row['status']) . "'>{$row['status']}</span>
                                    </td>
                                    <td>
                                        <div class='action-buttons'>
                                            <button class='action-btn edit' title='Edit'><i class='fas fa-edit'></i></button>
                                            <button class='action-btn view' title='View'><i class='fas fa-eye'></i></button>
                                            <button class='action-btn delete' title='Delete'><i class='fas fa-trash'></i></button>
                                        </div>
                                    </td>
                                </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='7'>No teachers found</td></tr>";
                        }
                        $conn->close();
                        ?>
                    </tbody>
                </table>

                <div class="table-footer">
                    <div class="table-info">
                        Showing <span>1</span> to <span>10</span> of <span>50</span> entries
                    </div>
                    <div class="pagination">
                        <button class="page-btn" disabled><i class="fas fa-chevron-left"></i></button>
                        <button class="page-btn active">1</button>
                        <button class="page-btn">2</button>
                        <button class="page-btn">3</button>
                        <button class="page-btn">4</button>
                        <button class="page-btn">5</button>
                        <button class="page-btn"><i class="fas fa-chevron-right"></i></button>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
