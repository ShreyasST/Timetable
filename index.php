<?php
    // Example query
    include('pages/connect.php');
    $active = $conn->query("SELECT COUNT(*) as count FROM teachers WHERE status='active'")->fetch_assoc()['count'];
    $inactive = $conn->query("SELECT COUNT(*) as count FROM teachers WHERE status='inactive'")->fetch_assoc()['count'];
    $teachers = $conn->query("SELECT COUNT(*) as count FROM teachers")->fetch_assoc()['count'];
    $subjects = $conn->query("SELECT COUNT(DISTINCT subject_name) as count FROM subjects")->fetch_assoc()['count'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<style>
    .welcome-heading {
    background: var(--primary-color); /* smooth blue gradient */
    color: white;
    margin-top: -30px;
    margin-left: -30px;
    height: 10vh;
    width: 180vh;
    padding-top: 10px;
    text-align: center;
}

</style>
<body>
    <div class="container">
        <nav class="sidebar">
            <div class="logo">
                <i class="fas fa-graduation-cap"></i>
                <h2>Timetable</h2>
            </div>
            <ul class="nav-links">
                <li class="active">
                    <a href="index.html">
                        <i class="fas fa-home"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="pages/teacher-registration.html">
                        <i class="fas fa-user-plus"></i>
                        <span>Teacher Registration</span>
                    </a>
                </li>
                <li>
                    <a href="pages/teacher-list.php">
                        <i class="fas fa-users"></i>
                        <span>Teacher List</span>
                    </a>
                </li>
                <li>
                    <a href="pages/timetable-generator.html">
                        <i class="fas fa-calendar-alt"></i>
                        <span>Timetable Generator</span>
                    </a>
                </li>
                <li>
                    <a href="../dev_proj1/login.php">
                        <i class="fas fa-calendar-alt"></i>
                        <span>Teacher Preferences Entry</span>
                    </a>
                </li>
            </ul>
            <div class="user-info">
                <i class="fas fa-user-circle"></i>
                <div>
                    <h4>Admin User</h4>
                    <p>Administrator</p>
                </div>
            </div>
        </nav>

        <main class="content">
            <!--<header>
                <div class="search-bar">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Search...">
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
            </header>-->
            <h1 class="welcome-heading">Welcome BNM School!</h1>
            <div class="dashboard-overview">
                <div class="stats-container">
                    <div class="stat-card">
                        <div class="stat-icon" style="background: linear-gradient(135deg, #4CAF50 0%, #45a049 100%); margin-left: 85px">
                            <i class="fas fa-chalkboard-teacher" style="color: white;"></i>
                        </div>
                        <div class="stat-info">
                            <center><h3>Total Teachers</h3></center>
                            <div class="stat-number" style="justify-content: center; text-align: center;">
                            <span class="number"><?= $teachers ?></span>
 
                                </div> 
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon" style="background: linear-gradient(135deg, #2196F3 0%, #1976D2 100%); margin-left: 89px">
                            <i class="fas fa-book" style="color: white;"></i>
                        </div>
                        <div class="stat-info">
                            <center><h3>Subjects</h3></center>
                            <div class="stat-number" style="justify-content: center; text-align: center;">
                                <span class="number"><?= $subjects ?></span>
                                
                            </div>
    
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon" style="background: linear-gradient(135deg, #FF9800 0%, #F57C00 100%); margin-left: 89px">
                            <i class="fas fa-clock" style="color: white;"></i>
                        </div>
                        <div class="stat-info">
                            <center><h3>Classes Today</h3></center>
                            <div class="stat-number" style="justify-content: center; text-align: center;">
                                <span class="number">24</span>
                               
                            </div>
                        
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon" style="background: linear-gradient(135deg, #9C27B0 0%, #7B1FA2 100%); margin-left: 89px">
                            <i class="fas fa-user-graduate" style="color: white;"></i>
                        </div>
                        <div class="stat-info">
                            <center><h3>Departments</h3></center>
                            <div class="stat-number" style="justify-content: center; text-align: center;">
                                <span class="number">12</span>
                                
                            </div>
                          
                        </div>
                    </div>
                </div>
                <div class="chart-container" style="width: 400px; margin-top: 40px;">
                    <center><h2>Teacher Status</h2><center><br>
                    <canvas id="teacherStatusChart"></canvas>
                </div>
                


    <script src="js/dashboard.js"></script>
    <script>
    const ctx = document.getElementById('teacherStatusChart').getContext('2d');
    const teacherStatusChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Active Teachers', 'Inactive Teachers'],
            datasets: [{
                label: 'Teacher Status',
                data: [<?= $active ?>, <?= $inactive ?>],
                backgroundColor: [
                    '#2196F3',  // Blue for Active
                    '#E91E63'   // Pink for Inactive
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                },
                tooltip: {
                    callbacks: {
                        label: function (context) {
                            let total = context.dataset.data.reduce((a, b) => a + b, 0);
                            let value = context.raw;
                            let percentage = ((value / total) * 100).toFixed(1);
                            return `${value} (${percentage}%)`;
                        }
                    }
                }
            }
        }
    });
</script>

    
</body>
</html> 