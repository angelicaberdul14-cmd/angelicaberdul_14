<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

// If already logged in, go to home
if (isset($_SESSION["PatientID"])) {
    header("Location: home.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Patient Portal | Login</title>

    <!-- Google Font -->
    <link rel="preconnect"
          href="https://fonts.googleapis.com">

    <link rel="preconnect"
          href="https://fonts.gstatic.com"
          crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- YOUR CSS -->
    <link rel="stylesheet" href="./style.css">

</head>

<body>

    <main class="login-container">

        <!-- =====================================
             LEFT INFORMATION PANEL
        ====================================== -->

        <section class="login-info">

            <div class="brand">

                <div class="brand-icon">
                    +
                </div>

                <div class="brand-text">

                    <h3>Patient Portal</h3>

                    <span>
                        Healthcare Management System
                    </span>

                </div>

            </div>


            <div class="info-content">

                <span class="welcome-label">
                    WELCOME
                </span>

                <h1>
                    Your health,
                    <strong>our priority.</strong>
                </h1>

                <p>
                    Securely access your patient account
                    and manage your personal information
                    through our healthcare portal.
                </p>

            </div>


            <div class="info-footer">

                <div class="security-item">

                    <span class="check-icon">
                        ✓
                    </span>

                    <div>

                        <strong>
                            Secure Access
                        </strong>

                        <small>
                            Your information is protected
                        </small>

                    </div>

                </div>


                <div class="security-item">

                    <span class="check-icon">
                        ✓
                    </span>

                    <div>

                        <strong>
                            Private & Confidential
                        </strong>

                        <small>
                            Your personal information stays private
                        </small>

                    </div>

                </div>

            </div>

        </section>


        <!-- =====================================
             RIGHT LOGIN SECTION
        ====================================== -->

        <section class="login-section">

            <div class="login-form-wrapper">

                <div class="form-header">

                    <span class="form-label">
                        PATIENT ACCOUNT
                    </span>

                    <h2>
                        Sign in
                    </h2>

                    <p>
                        Enter your username and password
                        to continue.
                    </p>

                </div>


                <!-- LOGIN FORM -->

                <form
                    action="check.php"
                    method="POST"
                    class="login-form"
                >

                    <!-- USERNAME -->

                    <div class="form-group">

                        <label for="username">
                            Username
                        </label>

                        <div class="input-wrapper">

                            <span class="input-icon">
                                👤
                            </span>

                            <input
                                type="text"
                                id="username"
                                name="username"
                                placeholder="Enter your username"
                                autocomplete="username"
                                required
                            >

                        </div>

                    </div>


                    <!-- PASSWORD -->

                    <div class="form-group">

                        <label for="password">
                            Password
                        </label>

                        <div class="input-wrapper">

                            <span class="input-icon">
                                🔒
                            </span>

                            <input
                                type="password"
                                id="password"
                                name="password"
                                placeholder="Enter your password"
                                autocomplete="current-password"
                                required
                            >

                        </div>

                    </div>


                    <!-- OPTIONS -->

                    <div class="form-options">

                        <label class="remember">

                            <input
                                type="checkbox"
                                name="remember"
                            >

                            <span>
                                Remember me
                            </span>

                        </label>


                        <a href="#">
                            Forgot password?
                        </a>

                    </div>


                    <!-- LOGIN BUTTON -->

                    <button
                        type="submit"
                        class="login-button"
                    >

                        <span>
                            Sign In
                        </span>

                        <span class="arrow">
                            →
                        </span>

                    </button>

                </form>


                <div class="form-footer">

                    <span>
                        🔒 Authorized patient access only.
                    </span>

                </div>

            </div>

        </section>

    </main>

</body>

</html>