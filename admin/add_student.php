<?php
include 'db.php';

// This function is fine
function validateInput($input, $pattern) {
    if (preg_match($pattern, $input)) {
        return $input;
    } else {
        die("Invalid input detected: " . htmlspecialchars($input));
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // --- 1. VALIDATE AND GET FORM DATA ---
    $first_name = validateInput($_POST["first_name"], "/^[a-zA-Z ]+$/");
    $last_name = validateInput($_POST["last_name"], "/^[a-zA-Z ]+$/");
    $register_no = validateInput($_POST["register_no"], "/^[a-zA-Z0-9]{10}$/");
    $roll_no = validateInput($_POST["roll_no"], "/^[a-zA-Z0-9]{7}$/");
    
    // Get the Roman numeral 'year' from the form and convert to uppercase
    $year_roman = validateInput(strtoupper($_POST["year"]), "/^(I|II|III|IV|V)$/"); 
    
    $email = validateInput($_POST["email"], "/^\S+@\S+\.\S+$/");
    $phone = validateInput($_POST["phone"], "/^\d{10}$/"); // From 'phone' field
    $address = validateInput($_POST["address"], "/^.+$/");
    $father = validateInput($_POST["father"], "/^[a-zA-Z ]+$/");
    
    // Get the 'mother' field
    $mother = validateInput($_POST["mother"], "/^[a-zA-Z ]+$/"); 
    
    $aadhar = validateInput($_POST["aadhar"], "/^\d{12}$/");
    $dob = validateInput($_POST["dob"], "/^\d{4}-\d{2}-\d{2}$/"); // From 'dob' field
    $gender = validateInput($_POST["gender"], "/^(Male|Female|Other)$/i");
    $dist = validateInput($_POST["dist"], "/^[a-zA-Z ]+$/");
    $pincode = validateInput($_POST["pincode"], "/^\d{6}$/");
    $uploaded = date('Y-m-d H:i:s');

    // --- 2. FILE UPLOAD PATH AND LOGIC ---
    // We use ../uploads/ to go UP one folder from /admin/
    $target_dir = "../uploads/";

    // Handle the image file
    $image_name = basename($_FILES["image"]["name"]);
    $image_path = $target_dir . $image_name;
    // Note: You should add error checking for file uploads in a real project
    move_uploaded_file($_FILES["image"]["tmp_name"], $image_path);

    // Handle the document file
    $file_name = basename($_FILES["file"]["name"]);
    $file_path = $target_dir . $file_name;
    move_uploaded_file($_FILES["file"]["tmp_name"], $file_path);

    // --- 3. USE PREPARED STATEMENTS (WITH CORRECTED COLUMN NAMES) ---
    
    // THIS IS THE FIX:
    // The SQL query now matches your new database columns:
    // - `year` (instead of class_id)
    // - `phone` (instead of phone_number)
    // - `dob` (instead of birthday)
    // - `mother` (is now included)
    $sql = "INSERT INTO student (
                first_name, last_name, register_no, roll_no, `year`, email, 
                `phone`, address, father, `mother`, aadhar, `dob`, 
                gender, dist, pincode, `file`, `image`, uploaded
            ) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"; // 18 columns

    $stmt = $conn->prepare($sql);
    
    // Bind the 18 variables
    // 's' for string for all
    $stmt->bind_param(
        "ssssssssssssssssss",
        $first_name,
        $last_name,
        $register_no,
        $roll_no,
        $year_roman,  // <-- Use the Roman numeral
        $email,
        $phone,       // <-- Use the $phone variable
        $address,
        $father,
        $mother,      // <-- Add the $mother variable
        $aadhar,
        $dob,         // <-- Use the $dob variable
        $gender,
        $dist,
        $pincode,
        $file_path,
        $image_path,
        $uploaded
    );

    if ($stmt->execute()) {
        echo '<script>alert("New student record created successfully");</script>';
        echo '<script>window.location.href = "view_students.php";</script>';
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>