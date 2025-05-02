<?php
include 'connect.php';

if (!isset($_GET['id'])) {
    echo "Invalid request.";
    exit();
}

$teacher_id = $_GET['id'];
$action = $_GET['action'] ?? 'view';

// DELETE
if ($action === 'delete') {
    $delete_sql = "DELETE FROM teachers WHERE teacher_id='$teacher_id'";
    if ($conn->query($delete_sql) === TRUE) {
        header("Location: teacher-list.php?msg=deleted");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
        exit();
    }
}

// UPDATE
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $action === 'edit') {
    $full_name = $_POST['full_name'];
    $qualification = $_POST['qualification'];
    $specialization = $_POST['specialization'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $experience = $_POST['experience'];
    $status = $_POST['status'];

    $update_sql = "UPDATE teachers SET 
        full_name='$full_name', 
        qualification='$qualification', 
        specialization='$specialization',
        email='$email',
        phone='$phone',
        experience='$experience',
        status='$status' 
        WHERE teacher_id='$teacher_id'";

    if ($conn->query($update_sql) === TRUE) {
        header("Location: manage-teacher.php?id=$teacher_id&action=view");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
        exit();
    }
}

// FETCH
$sql = "SELECT * FROM teachers WHERE teacher_id='$teacher_id'";
$result = $conn->query($sql);
if ($result->num_rows === 0) {
    echo "Teacher not found.";
    exit();
}
$teacher = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Teacher</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
    body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f4f6f8;
    margin: 0;
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    text-align: justify;
    padding: 20px;
}

.form-container, .views {
    background-color: #ffffff;
    max-width: 600px;
    width: 100%;
    padding: 30px 40px;
    text-align: center;
    border-radius: 12px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}



.views h2, .form-container h2 {
    margin-bottom: 25px;
    color: #333;
    text-align: center;
}

label {
    display: block;
    margin-top: 15px;
    font-weight: 600;
    color: #555;
}

input[type="text"],
input[type="email"],
input[type="number"],
select {
    width: 100%;
    padding: 10px 12px;
    margin-top: 5px;
    border: 1px solid #ccc;
    border-radius: 6px;
    box-sizing: border-box;
    transition: border 0.3s ease;
}

input:focus,
select:focus {
    border-color: #007bff;
    outline: none;
}

button {
    background-color: #007bff;
    color: white;
    padding: 10px 20px;
    margin-top: 20px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-size: 16px;
    transition: background-color 0.3s ease;
}

button:hover {
    background-color: #0056b3;
}
.edit{
    text-align: justify;
}

</style>

</head>
<body>

<?php if ($action === 'view'): ?>
    <div class="views">
    <h2>View Teacher Details</h2>
    <?php
$default_image = 'def.png'; // path to your default image
$photo = !empty($teacher['photo']) ? $teacher['photo'] : $default_image;
?>
<p><img src="<?= $photo ?>" alt="Teacher Photo" style="width: 150px; height: 150px; object-fit: cover; border-radius: 8px;"></p>

    <p><strong>Name:</strong> <?= $teacher['full_name'] ?></p>
    <p><strong>Qualification:</strong> <?= $teacher['qualification'] ?></p>
    <p><strong>Specialization:</strong> <?= $teacher['specialization'] ?></p>
    <p><strong>Email:</strong> <?= $teacher['email'] ?></p>
    <p><strong>Phone:</strong> <?= $teacher['phone'] ?></p>
    <p><strong>Experience:</strong> <?= $teacher['experience'] ?> years</p>
    <p><strong>Status:</strong> <?= $teacher['status'] ?></p>
    <a href="manage-teacher.php?id=<?= $teacher_id ?>&action=edit"><button style="background-color: #32cd32";>Edit</button></a>
    <a href="manage-teacher.php?id=<?= $teacher_id ?>&action=delete" onclick="return confirm('Are you sure?')"><button style="background-color: red; margin-left: 7px">Delete</button></a>
    <a href="teacher-list.php"><button style="margin-left: 7px">Back</button></a>
</div>

<?php elseif ($action === 'edit'): ?>
    <div class="form-container">
        <h2>Edit Teacher</h2>
        <form method="POST" class="edit">
            <label>Name:
                <input type="text" name="full_name" value="<?= $teacher['full_name'] ?>" required>
            </label>
            <label>Qualification:
                <input type="text" name="qualification" value="<?= $teacher['qualification'] ?>" required>
            </label>
            <label>Specialization:
                <input type="text" name="specialization" value="<?= $teacher['specialization'] ?>" required>
            </label>
            <label>Email:
                <input type="email" name="email" value="<?= $teacher['email'] ?>" required>
            </label>
            <label>Phone:
                <input type="text" name="phone" value="<?= $teacher['phone'] ?>" required>
            </label>
            <label>Experience:
                <input type="number" name="experience" value="<?= $teacher['experience'] ?>" required>
            </label>
            <label>Status:
                <select name="status" required>
                    <option value="Active" <?= $teacher['status'] === 'Active' ? 'selected' : '' ?>>Active</option>
                    <option value="Inactive" <?= $teacher['status'] === 'Inactive' ? 'selected' : '' ?>>Inactive</option>
                </select>
            </label>

            <div style="text-align: center">
                <button type="submit">Update</button>
                <a href="manage-teacher.php?id=<?= $teacher_id ?>&action=view" style="flex: 1;">
                    <button type="button" style="background-color: gray; margin-left: 10px">Cancel</button>
                </a>
            </div>
        </form>
    </div>
<?php endif; ?>


</body>
</html>
