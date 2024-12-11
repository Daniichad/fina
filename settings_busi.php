<?php
    session_start(); 
    include("conne.php");

    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];

        $sql = "SELECT * FROM user WHERE user_id = $user_id";
        $result = mysqli_query($db, $sql);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            // Store user details in variables
            $username = $row['username'];
            $email = $row['email'];
            $password = $row['password'];
            $profile_picture = isset($row['profile_picture']) ? $row['profile_picture'] : 'profiles_of_users/default_profile.png';
        }
    }

    // Handle form submission for updating user details
    if (isset($_POST['submit'])) {
        // Sanitize input data to prevent SQL injection
        $username = mysqli_real_escape_string($db, $_POST['username']);
        $email = mysqli_real_escape_string($db, $_POST['email']);
        $password = mysqli_real_escape_string($db, $_POST['password']);

        // Handle profile picture upload process
        if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
            // Set upload directory
            $target_dir = "profiles_of_users/profile_pictures/";
            // Create directory if it doesn't exist
            if (!file_exists($target_dir)) {
                mkdir($target_dir, 0777, true);
            }
            
            // Create unique filename using user ID and timestamp
            $file_extension = strtolower(pathinfo($_FILES["profile_picture"]["name"], PATHINFO_EXTENSION));
            $new_filename = "profile_" . $user_id . "_" . time() . "." . $file_extension;
            $target_file = $target_dir . $new_filename;

            if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file)) {
                $update_query = "UPDATE user SET username=?, email=?, password=?, profile_picture=? WHERE user_id=?";
                $stmt = mysqli_prepare($db, $update_query);
                mysqli_stmt_bind_param($stmt, "ssssi", $username, $email, $password, $target_file, $user_id);
            }
        } else {
            $update_query = "UPDATE user SET username=?, email=?, password=? WHERE user_id=?";
            $stmt = mysqli_prepare($db, $update_query);
            mysqli_stmt_bind_param($stmt, "sssi", $username, $email, $password, $user_id);
        }

        if (mysqli_stmt_execute($stmt)) {
            echo "<script>
            alert('User details updated successfully.');
            window.location.href='dashboard_business_user.php'; 
            </script>";
        } else {
            echo "<script>
            alert('Failed to update user details.');
            window.location.href='dashboard_business_user.php'; 
            </script>";
        }
    }


    if (isset($_POST['return'])) {
        echo "<script>window.location.href='dashboard_business_user.php';</script>";
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="settings_busi.css">
    <link rel="icon" href="SAD.jpg" type="image/x-icon"/> 
    <title>Financial Compass: Navigating your Budgeting Journey with an Interactive Website</title>
</head>
<body>
    <div class="container">
        <form method="POST" enctype="multipart/form-data">
            <div class="login-box">
                <div class="headertext">
                    <p>Profile</p>
                </div>
                <div class="profile-picture-container">
                    <div class="profile-picture">
                        <img src="<?php echo htmlspecialchars($profile_picture); ?>" alt="Profile Picture" id="preview-image">
                    </div>
                    <div class="profile-upload">
                        <label for="profile_picture" class="upload-label">Change Profile Picture</label>
                        <input type="file" id="profile_picture" class="field file-input" name="profile_picture" accept="image/*" onchange="previewImage(this)">
                    </div>
                </div>
                <div class="input">
    
                    <input type="text" class="field" name="username" placeholder="Username" value="<?php echo isset($username) ? htmlspecialchars($username) : ''; ?>" required>
                </div>
                <div class="input">
                    <input type="email" class="field" name="email" placeholder="Email" value="<?php echo isset($email) ? htmlspecialchars($email) : ''; ?>" required>
                </div>
                <div class="input">
                    <input type="text" class="field" name="password" placeholder="Password" value="<?php echo isset($password) ? htmlspecialchars($password) : ''; ?>" required>
                </div>
                <div class="button-group">
                    <button type="submit" class="input-submit" name="submit">Save</button>
                    <button type="submit" name="return" class="input-submit cancel">Cancel</button>
                </div>
            </div>
        </form>
    </div>
    <script>
        function previewImage(input) {
            // Show preview of selected image before upload
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('preview-image').src = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</body>
</html>