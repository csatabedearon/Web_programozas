<?php
$errors = array();
$firstName = $lastName = $email = '';
$attend = array();
$tshirt = 'P';
$terms = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

    if (!$errors) {
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
        exit();
    }
}
?>
<h3>Online conference registration</h3>
<form method="post" action="" enctype="multipart/form-data">
    <label for="fname"> First name:
        <input type="text" name="firstName" value="<?php echo htmlspecialchars($firstName); ?>">
        <?php if (isset($errors['firstName'])) echo "<span style='color:red;'>{$errors['firstName']}</span>"; ?>
    </label>
    <br><br>
    <label for="lname"> Last name:
        <input type="text" name="lastName" value="<?php echo htmlspecialchars($lastName); ?>">
        <?php if (isset($errors['lastName'])) echo "<span style='color:red;'>{$errors['lastName']}</span>"; ?>
    </label>
    <br><br>
    <label for="email"> E-mail:
        <input type="text" name="email" value="<?php echo htmlspecialchars($email); ?>">
        <?php if (isset($errors['email'])) echo "<span style='color:red;'>{$errors['email']}</span>"; ?>
    </label>
    <br><br>
    <label for="attend"> I will attend:<br>
        <?php
        $events = ['Event1', 'Event2', 'Event3', 'Event4'];
        foreach ($events as $event) {
            $checked = in_array($event, $attend) ? 'checked' : '';
            echo "<input type='checkbox' name='attend[]' value='$event' $checked>$event<br>";
        }
        if (isset($errors['attend'])) echo "<span style='color:red;'>{$errors['attend']}</span>";
        ?>
    </label>
    <br><br>
    <label for="tshirt"> What's your T-Shirt size?<br>
        <select name="tshirt">
            <?php
            $sizes = ['P' => 'Please select', 'S' => 'S', 'M' => 'M', 'L' => 'L', 'XL' => 'XL'];
            foreach ($sizes as $value => $label) {
                $selected = ($tshirt == $value) ? 'selected' : '';
                echo "<option value='$value' $selected>$label</option>";
            }
            ?>
        </select>
    </label>
    <br><br>
    <label for="abstract"> Upload your abstract<br>
        <input type="file" name="abstract"/>
        <?php if (isset($errors['abstract'])) echo "<span style='color:red;'>{$errors['abstract']}</span>"; ?>
    </label>
    <br><br>
    <input type="checkbox" name="terms" value="1" <?php echo $terms ? 'checked' : ''; ?>>I agree to terms & conditions.<br>
    <?php if (isset($errors['terms'])) echo "<span style='color:red;'>{$errors['terms']}</span>"; ?>
    <br><br>
    <input type="submit" name="submit" value="Send registration"/>
</form>
