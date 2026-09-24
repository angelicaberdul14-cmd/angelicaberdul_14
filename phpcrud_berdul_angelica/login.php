<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include 'database.php';

// Kung naka-login na, diretso na sa dashboard.
if (isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username === '' || $password === '') {
        $error = 'Pakipunan ang username at password.';
    } else {

        $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        $stmt->close();

        if ($user && password_verify($password, $user['password'])) {

            // I-regenerate ang session id para maiwasan ang session fixation.
            session_regenerate_id(true);

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];

            header('Location: index.php');
            exit();

        } else {
            $error = 'Mali ang username o password.';
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

    <title>Login | Student Management</title>

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

            <div class="auth-icon">✦</div>

            <h1 class="auth-title">Welcome <span>Back</span></h1>
            <p class="auth-subtitle">Mag-login para makapasok sa dashboard</p>

            <?php if ($error !== ''): ?>
                <div class="auth-alert">
                    <?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?>
                </div>
            <?php endif; ?>

            <form method="post" action="login.php">

                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input
                        type="text"
                        name="username"
                        class="form-control custom-input"
                        placeholder="Ilagay ang username"
                        required
                        autofocus>
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input
                        type="password"
                        name="password"
                        class="form-control custom-input"
                        placeholder="Ilagay ang password"
                        required>
                </div>

                <button type="submit" class="btn save-btn auth-submit-btn">
                    Login
                </button>

            </form>

            <p class="auth-footer-text">
                Wala ka pang account?
                <a href="register.php">Create Account</a>
            </p>

        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>