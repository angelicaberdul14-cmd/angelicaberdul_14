<?php

session_start();


// ==================================================
// CHECK IF PATIENT IS LOGGED IN
// ==================================================

if (!isset($_SESSION["PatientID"])) {
    header("Location: index.php");
    exit();

}

?>

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Patient ID</title>


    <!-- Bootstrap -->

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >


    <!-- Your CSS -->

    <link rel="stylesheet" href="style.css">

</head>


<body>


<div class="container">


    <div class="welcome-box text-center">


        <!-- Login message -->

        <h1>
            Successfully Logged In!
        </h1>


        <!-- Patient ID -->

        <h3>

            Welcome,

            <?php
            echo htmlspecialchars(
                $_SESSION["FirsName"]
            );
            ?>

            <?php
            echo htmlspecialchars(
                $_SESSION["LastName"]
            );
            ?>

        </h3>


        <!-- Username -->

        <p>

            Username:

            <strong>

                <?php
                echo htmlspecialchars(
                    $_SESSION["Username"]
                );
                ?>

            </strong>

        </p>


        <!-- Patient ID -->

        <p>

            Patient ID:

            <strong>

                <?php
                echo htmlspecialchars(
                    $_SESSION["PatientID"]
                );
                ?>

            </strong>

        </p>


        <!-- Position -->

        <p>

            Gender:

            <strong>

                <?php
                echo htmlspecialchars(
                    $_SESSION["Gender"]
                );
                ?>

            </strong>

        </p>


        <p>
            You have successfully logged in
            as a patient.
        </p>


        <!-- Logout -->

        <a
            href="logout.php"
            class="btn btn-danger mt-3"
        >
            Logout
        </a>


    </div>


</div>


</body>

</html>