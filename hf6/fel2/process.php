<?php

$errors = array();
$data = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"])) {
        $errors[] = "A név mező nem lehet üres.";
    } else {
        $data['name'] = htmlspecialchars(trim($_POST["name"]));
    }

    if (empty($_POST["email"])) {
        $errors[] = "Az e-mail cím megadása kötelező.";
    } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Az e-mail cím formátuma érvénytelen.";
    } else {
        $data['email'] = htmlspecialchars(trim($_POST["email"]));
    }

    if (empty($_POST["password"])) {
        $errors[] = "A jelszó megadása kötelező.";
    } else {
        $password = $_POST["password"];
        if (strlen($password) < 8) {
            $errors[] = "A jelszónak minimum 8 karakterből kell állnia.";
        }
        if (!preg_match('/[A-Z]/', $password)) {
            $errors[] = "A jelszónak tartalmaznia kell legalább egy nagybetűt.";
        }
        if (!preg_match('/[0-9]/', $password)) {
            $errors[] = "A jelszónak tartalmaznia kell legalább egy számot.";
        }
        if (!preg_match('/[\W]/', $password)) {
            $errors[] = "A jelszónak tartalmaznia kell legalább egy speciális karaktert.";
        }
        $data['password'] = htmlspecialchars($password);
    }

    if (empty($_POST["confirm_password"])) {
        $errors[] = "A jelszó megerősítése kötelező.";
    } else {
        $confirm_password = $_POST["confirm_password"];
        if ($password !== $confirm_password) {
            $errors[] = "A jelszó és a jelszó megerősítése nem egyezik.";
        }
    }

    if (empty($_POST["dob"])) {
        $errors[] = "A születési dátum megadása kötelező.";
    } else {
        $dob = $_POST["dob"];
        $date_arr = explode('-', $dob);
        if (!checkdate($date_arr[1], $date_arr[2], $date_arr[0])) {
            $errors[] = "A születési dátum érvénytelen.";
        } else {
            $data['dob'] = htmlspecialchars($dob);
        }
    }

    if (!empty($_POST["gender"])) {
        $data['gender'] = htmlspecialchars($_POST["gender"]);
    }

    if (!empty($_POST["interests"])) {
        $data['interests'] = $_POST["interests"];
    }

    if (!empty($_POST["country"])) {
        $data['country'] = htmlspecialchars($_POST["country"]);
    }

    if (!empty($errors)) {
        echo "<h1>Hibák:</h1>";
        echo "<ul>";
        foreach ($errors as $error) {
            echo "<li>" . $error . "</li>";
        }
        echo "</ul>";
        echo '<a href="register.html">Vissza az űrlaphoz</a>';
    } else {
        echo "<h1>Sikeres regisztráció!</h1>";
        echo "<p><strong>Név:</strong> " . $data['name'] . "</p>";
        echo "<p><strong>E-mail cím:</strong> " . $data['email'] . "</p>";
        echo "<p><strong>Születési dátum:</strong> " . $data['dob'] . "</p>";
        if (isset($data['gender'])) {
            echo "<p><strong>Nem:</strong> " . $data['gender'] . "</p>";
        }
        if (isset($data['interests'])) {
            echo "<p><strong>Érdeklődési területek:</strong> " . implode(", ", $data['interests']) . "</p>";
        }
        if (isset($data['country'])) {
            echo "<p><strong>Ország:</strong> " . $data['country'] . "</p>";
        }
    }
} else {
    header("Location: register.html");
    exit();
}
?>
