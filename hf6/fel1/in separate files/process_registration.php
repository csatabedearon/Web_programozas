<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = array();

    $firstName = trim($_POST['firstName'] ?? '');
    $lastName = trim($_POST['lastName'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $attend = $_POST['attend'] ?? array();
    $tshirt = $_POST['tshirt'] ?? 'P';
    $terms = $_POST['terms'] ?? '';
    $abstract = $_FILES['abstract'] ?? null;

    if (empty($firstName)) {
        $errors['firstName'] = "First name is required.";
    }
    if (empty($lastName)) {
        $errors['lastName'] = "Last name is required.";
    }
    if (empty($email)) {
        $errors['email'] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email format.";
    }
    if (empty($attend)) {
        $errors['attend'] = "Please select at least one event.";
    }
    if (empty($abstract) || $abstract['error'] != 0) {
        $errors['abstract'] = "Please upload your abstract.";
    } else {
        $fileType = $abstract['type'];
        $fileSize = $abstract['size'];
        if ($fileType != 'application/pdf') {
            $errors['abstract'] = "Only PDF files are allowed.";
        }
        if ($fileSize > 3 * 1024 * 1024) {
            $errors['abstract'] = "File size must be less than 3MB.";
        }
    }
    if (empty($terms)) {
        $errors['terms'] = "You must agree to the terms.";
    }

    if ($errors) {
        include 'registration_form.php';
        foreach ($errors as $field => $error) {
            echo "<p style='color:red;'>$error</p>";
        }
    } else {
        echo "<p>First Name: " . htmlspecialchars($firstName) . "</p>";
        echo "<p>Last Name: " . htmlspecialchars($lastName) . "</p>";
        echo "<p>Email: " . htmlspecialchars($email) . "</p>";
        echo "<p>Attending: " . implode(', ', $attend) . "</p>";
        echo "<p>T-Shirt Size: " . htmlspecialchars($tshirt) . "</p>";

        $uploadDir = 'uploads/';
        if (!is_dir($uploadDir)) {
            if (!mkdir($uploadDir, 0755, true)) {
                echo "<p style='color:red;'>Failed to create upload directory.</p>";
                exit();
            }
        }

        $uploadFile = $uploadDir . basename($abstract['name']);

        if (move_uploaded_file($abstract['tmp_name'], $uploadFile)) {
            echo "<p>Abstract uploaded successfully.</p>";
        } else {
            echo "<p style='color:red;'>Failed to upload abstract.</p>";
        }

        echo "<p>Terms accepted.</p>";
    }
} else {
    header("Location: registration_form.php");
    exit();
}
?>