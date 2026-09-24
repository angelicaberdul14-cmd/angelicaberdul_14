<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include 'database.php';

if (isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirmPassword = $_POST['confirm_password'] ?? '';

    if ($username === '' || $password === '' || $confirmPassword === '') {
        $error = 'Pakipunan ang lahat ng fields.';
    } elseif (strlen($username) < 3) {
        $error = 'Dapat hindi bababa sa 3 characters ang username.';
    } elseif (strlen($password) < 6) {
        $error = 'Dapat hindi bababa sa 6 characters ang password.';
    } elseif ($password !== $confirmPassword) {
        $error = 'Hindi magkatugma ang password at confirm password.';
    } else {

        $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $error = 'May account na gamit ang username na ito.';
            $stmt->close();
        } else {
            $stmt->close();

            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $insertStmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
            $insertStmt->bind_param("ss", $username, $hashedPassword);

            if ($insertStmt->execute()) {
                $success = 'Successfully na-create ang account. Puwede ka nang mag-login.';
            } else {
                $error = 'May naganap na error. Subukan ulit.';
            }

            $insertStmt->close();
        }
    }
}

$conn->close();

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Create Account | Student Management</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="style.css?v=3">
    <link rel="stylesheet" href="auth.css?v=1">

</head>

<body>

    <div class="background-decoration decoration-one"></div>
    <div class="background-decoration decoration-two"></div>
    <div class="background-decoration decoration-three"></div>

    <div class="auth-wrapper">

        <div class="auth-card">

            <div class="auth-icon">+</div>

            <h1 class="auth-title">Create <span>Account</span></h1>
            <p class="auth-subtitle">Gumawa ng account para makapag-login</p>

            <?php if ($error !== ''): ?>
                <div class="auth-alert">
                    <?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?>
                </div>
            <?php endif; ?>

            <?php if ($success !== ''): ?>
                <div class="auth-alert auth-alert-success">
                    <?php echo htmlspecialchars($success, ENT_QUOTES, 'UTF-8'); ?>
                </div>
            <?php endif; ?>

            <form method="post" action="register.php">

                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input
                        type="text"
                        name="username"
                        class="form-control custom-input"
                        placeholder="Gumawa ng username"
                        value="<?php echo isset($username) ? htmlspecialchars($username, ENT_QUOTES, 'UTF-8') : ''; ?>"
                        required
                        autofocus>
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input
                        type="password"
                        name="password"
                        class="form-control custom-input"
                        placeholder="Gumawa ng password"
                        required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Confirm Password</label>
                    <input
                        type="password"
                        name="confirm_password"
                        class="form-control custom-input"
                        placeholder="Ulitin ang password"
                        required>
                </div>

                <button type="submit" class="btn save-btn auth-submit-btn">
                    Create Account
                </button>

            </form>

            <p class="auth-footer-text">
                May account ka na?
                <a href="login.php">Login</a>
            </p>

        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>