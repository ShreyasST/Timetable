<?php
include 'connect.php';

$limit = 10; // entries per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start_from = ($page - 1) * $limit;

// Fetch paginated records
$sql = "SELECT * FROM teachers LIMIT $start_from, $limit";
$result = $conn->query($sql);

// Fetch total records for pagination
$total_query = "SELECT COUNT(*) AS total FROM teachers";
$total_result = $conn->query($total_query);
$total_row = $total_result->fetch_assoc();
$total_entries = $total_row['total'];
$total_pages = ceil($total_entries / $limit);
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
                <li><a href="../index.php"><i class="fas fa-home"></i> Dashboard</a></li>
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
                            <th>Qualification</th>
                            <th>Contact</th>
                            <th>Experience</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
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
                                        <span class='status-badge " . strtolower($row['status']) . "'>{$row['status']}</span>
                                    </td>
                                    <td>
                                        <div class='action-buttons'>
                                            <a href='manage-teacher.php?id={$row['teacher_id']}&action=edit' class='action-btn edit' title='Edit'>
                                                <i class='fas fa-edit'></i>
                                            </a>
                                            <a href='manage-teacher.php?id={$row['teacher_id']}&action=view' class='action-btn view' title='View'>
                                                <i class='fas fa-eye'></i>
                                            </a>
                                            <a href='manage-teacher.php?id={$row['teacher_id']}&action=delete' class='action-btn delete' title='Delete' onclick=\"return confirm('Are you sure?');\">
                                                <i class='fas fa-trash'></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='6'>No teachers found</td></tr>";
                        }
                        $conn->close();
                        ?>
                    </tbody>
                </table>

                <div class="table-footer">
                    <div class="table-info">
                        Showing <span><?= min($start_from + $limit, $total_entries) ?></span> 
                        of <span><?= $total_entries ?></span> entries
                    </div>
                    <div class="pagination">
                        <?php if ($page > 1): ?>
                            <a class="page-btn" href="?page=<?= $page - 1 ?>"><i class="fas fa-chevron-left"></i></a>
                        <?php else: ?>
                            <button class="page-btn" disabled><i class="fas fa-chevron-left"></i></button>
                        <?php endif; ?>

                        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                            <a class="page-btn <?= $i == $page ? 'active' : '' ?>" href="?page=<?= $i ?>"><?= $i ?></a>
                        <?php endfor; ?>

                        <?php if ($page < $total_pages): ?>
                            <a class="page-btn" href="?page=<?= $page + 1 ?>"><i class="fas fa-chevron-right"></i></a>
                        <?php else: ?>
                            <button class="page-btn" disabled><i class="fas fa-chevron-right"></i></button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
