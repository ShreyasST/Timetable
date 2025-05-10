<?php
require 'connect.php';
$teacherId = '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Registration</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../css/styles.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- jQuery for AJAX -->
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
                <li class="active"><a href="teacher-registration.php"><i class="fas fa-user-plus"></i> Teacher Registration</a></li>
                <li><a href="teacher-list.php"><i class="fas fa-users"></i> Teacher List</a></li>
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
                    <input type="text" placeholder="Search...">
                </div>
            </header>

            <div class="page-title">
                <div class="title-wrapper">
                    <h1>Teacher Registration</h1>
                </div>
            </div>

            <div class="registration-container">
                <form id="teacherRegistrationForm" class="registration-form" method="POST" action="reg.php" enctype="multipart/form-data">
                    <div class="form-grid">
                        
                    <div class="photo-upload-section">
    <div class="photo-preview">
        <i class="fas fa-user-circle" id="defaultIcon"></i>
        <img id="previewImage" src="" alt="Preview" style="display: none; max-width: 140px; border-radius: 50%; object-fit: cover;">
    </div>
    <div class="upload-btn-wrapper">
        <button class="upload-btn" type="button">
            <i class="fas fa-camera"></i> Upload Photo
        </button>
        <input type="file" id="photoInput" name="photo" accept="image/*">
    </div>
</div>



                        <!-- Personal Information -->
                        <div class="form-section">
                            <h3><i class="fas fa-user"></i> Personal Information</h3>
                            <div class="form-row">
                                <div class="form-group">
                                    <label>Full Name</label>
                                    <div class="input-with-icon">
                                        <i class="fas fa-user"></i>
                                        <input type="text" placeholder="Enter full name" name="full_name" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Date of Birth</label>
                                    <div class="input-with-icon">
                                        <i class="fas fa-calendar"></i>
                                        <input type="date" name="dob" required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label>Email</label>
                                    <div class="input-with-icon">
                                        <i class="fas fa-envelope"></i>
                                        <input type="email" name="email" placeholder="Enter email address" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Phone</label>
                                    <div class="input-with-icon">
                                        <i class="fas fa-phone"></i>
                                        <input type="tel" name="phone" placeholder="Enter phone number" required>
                                    </div>
                                </div>
                            </div>

                            <!-- Gender -->
                            <div class="form-row">
                                <div class="form-group">
                                    <label>Gender</label>
                                    <div class="gender-options">
                                        <div class="gender-option">
                                            <input type="radio" id="male" name="gender" value="male">
                                            <label for="male" class="gender-card">
                                                <div class="gender-icon">
                                                    <i class="fas fa-mars"></i>
                                                </div>
                                                <div class="gender-info">
                                                    <span>Male</span>
                                                </div>
                                            </label>
                                        </div>
                                        <div class="gender-option">
                                            <input type="radio" id="female" name="gender" value="female">
                                            <label for="female" class="gender-card">
                                                <div class="gender-icon">
                                                    <i class="fas fa-venus"></i>
                                                </div>
                                                <div class="gender-info">
                                                    <span>Female</span>
                                                </div>
                                            </label>
                                        </div>
                                        <div class="gender-option">
                                            <input type="radio" id="other" name="gender" value="other">
                                            <label for="other" class="gender-card">
                                                <div class="gender-icon">
                                                    <i class="fas fa-genderless"></i>
                                                </div>
                                                <div class="gender-info">
                                                    <span>Other</span>
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>



                        <!-- Professional Details -->
                        <div class="form-section">
                            <h3><i class="fas fa-graduation-cap"></i> Professional Details</h3>
                            <div class="form-row">
                                <div class="form-group">
                                    <label>Qualification</label>
                                    <div class="input-with-icon">
                                        <i class="fas fa-graduation-cap"></i>
                                        <input type="text" name="qualification" placeholder="Enter Qualification" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Specialization</label>
                                    <div class="input-with-icon">
                                        <i class="fas fa-graduation-cap"></i>
                                        <input type="text" name="specialization" placeholder="Enter Specialization" required>
                                    </div>
                                </div>
                            </div>
                            

                            <div class="form-row">
                                <div class="form-group">
                                    <label>Experience (Years)</label>
                                    <div class="input-with-icon">
                                        <i class="fas fa-briefcase"></i>
                                        <input type="number" min="0" name="experience" placeholder="Years of experience" required>
                                    </div>
                                </div>
                        
                                <div class="form-group">
                                    <label>Category</label>
                                    <div class="input-with-icon">
                                    <i class="fa-solid fa-layer-group"></i>
                                    <select name="category" id="category" required>
                                        <option>Select category</option>
                                        <option value="primary">Primary (1-4 std)</option>
                                        <option value="middle">Middle (5-7 std)</option>
                                        <option value="secondary">Secondary (8-10 std)</option>
                                        </select>
                                    </div>
                                </div>
                            </div>


                            <!-- Standard Dropdown -->
                            <div class="form-group" style="width: 60%;">
                                <label>Standard</label>
                                <div class="input-with-icon">
                                    <i class="fas fa-layer-group"></i>
                                    <select name="standard" id="standard" required>
                                        <option value="">Select Standard</option>
                                        <?php
                                        for ($i = 1; $i <= 10; $i++) {
                                            echo "<option value='$i'>Standard $i</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                                    <br>
                            <!-- Dynamic Subjects -->
                            <div class="form-group full-width">
                                <label>Subjects</label>
                                <div id="subjects-container" class="subjects-grid">
                                    <p>Select a standard to view available subjects.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Teacher ID & Password -->
                    <div class="form-group full-width">
                        <label>Teacher ID</label>
                        <div class="input-with-icon">
                            <i class="fas fa-id-badge"></i>
                            <input type="text" id="teacherId" name="teacher_id" value="<?php echo htmlspecialchars($teacherId); ?>" readonly>
                        </div>
                        <br>
                        <button type="button" class="btn btn-secondary" id="generateIdBtn">Generate ID</button>
                    </div>
                    <br>
                    <div class="form-group full-width">
                        <label>Password</label>
                        <div class="input-with-icon">
                            <i class="fas fa-lock"></i>
                            <input type="password" name="password" placeholder="Enter a password" required>
                        </div>
                    </div>

                    <!-- Submit -->
                    <div class="form-actions">
                        <button type="reset" class="btn btn-secondary">Cancel</button>
                        <button type="submit" class="btn btn-primary">Register Teacher</button>
                    </div>
                </form>
            </div>
        </main>
    </div>

    <script>
        $(document).ready(function () {
    $('#category').on('change', function () {
        const category = $(this).val();
        const standardDropdown = $('#standard');

        standardDropdown.empty(); // clear previous options
        standardDropdown.append('<option value="">Select Standard</option>');

        if (category === 'primary') {
    for (let i = 1; i <= 4; i++) {
        standardDropdown.append(`<option value="${i}">Standard ${i}</option>`);
    }
} else if (category === 'middle') {
    for (let i = 5; i <= 7; i++) {
        standardDropdown.append(`<option value="${i}">Standard ${i}</option>`);
    }
} else if (category === 'secondary') {
    for (let i = 8; i <= 10; i++) {
        standardDropdown.append(`<option value="${i}">Standard ${i}</option>`);
    }
}

    });
});
    $(document).ready(function () {
        $('#standard').on('change', function () {
            const selectedStandard = $(this).val();
            if (selectedStandard) {
                $.ajax({
                    url: 'fetch_subjects.php',
                    method: 'POST',
                    data: { standard: selectedStandard },
                    success: function (response) {
                        $('#subjects-container').html(response);
                    },
                    error: function () {
                        $('#subjects-container').html('<p>Error loading subjects.</p>');
                    }
                });
            } else {
                $('#subjects-container').html('<p>Select a standard to view available subjects.</p>');
            }
        });

        $('#generateIdBtn').click(function () {
            const id = 'TCH' + Math.floor(100 + Math.random() * 900);
            $('#teacherId').val(id);
        });
    });
    // Photo preview script
document.getElementById("photoInput").addEventListener("change", function (event) {
    const file = event.target.files[0];
    const preview = document.getElementById("previewImage");
    const defaultIcon = document.getElementById("defaultIcon");

    if (file && file.type.startsWith("image/")) {
        const reader = new FileReader();
        reader.onload = function (e) {
            preview.src = e.target.result;
            preview.style.display = "block";
            if (defaultIcon) defaultIcon.style.display = "none";
        };
        reader.readAsDataURL(file);
    } else {
        preview.src = "";
        preview.style.display = "none";
        if (defaultIcon) defaultIcon.style.display = "block";
    }
});

    </script>
</body>
</html>
