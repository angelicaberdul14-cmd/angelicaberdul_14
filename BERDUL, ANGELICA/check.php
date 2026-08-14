<?php

session_start();

error_reporting(E_ALL);
ini_set("display_errors", 1);

/* ==========================================
   DATABASE CONNECTION
========================================== */

$host = "127.0.0.1";
$port = 3306;
$dbUser = "root";
$dbPassword = "";
$database = "angelicabsis3c";

$conn = new mysqli(
    $host,
    $dbUser,
    $dbPassword,
    $database,
    $port
);

/* Check database connection */

if ($conn->connect_error) {
    die(
        "Database Connection Failed!<br><br>" .
        $conn->connect_error
    );
}

$conn->set_charset("utf8mb4");


/* ==========================================
   ONLY ACCEPT POST
========================================== */

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: index.php");
    exit();
}


/* ==========================================
   GET LOGIN DATA
========================================== */

/*
   IMPORTANT:
   These names MUST match index.php:

   name="username"
   name="password"
*/

$username = trim($_POST["username"] ?? "");
$loginPassword = trim($_POST["password"] ?? "");


/* ==========================================
   CHECK EMPTY INPUT
========================================== */

if ($username === "" || $loginPassword === "") {

    echo "<script>
            alert('Please enter your username and password.');
            window.location.href = 'index.php';
          </script>";

    exit();
}


/* ==========================================
   FIND PATIENT
========================================== */

$sql = "SELECT
            PatientID,
            FirsName,
            LastName,
            Gender,
            UserName,
            Pasword
        FROM patient
        WHERE UserName = ?
        LIMIT 1";


$stmt = $conn->prepare($sql);


/* Check SQL */

if (!$stmt) {

    die(
        "SQL Prepare Error: " .
        $conn->error
    );
}


/* ==========================================
   BIND USERNAME
========================================== */

$stmt->bind_param("s", $username);


/* ==========================================
   EXECUTE QUERY
========================================== */

if (!$stmt->execute()) {

    die(
        "SQL Execute Error: " .
        $stmt->error
    );
}


/* ==========================================
   GET RESULT
========================================== */

$result = $stmt->get_result();


/* ==========================================
   CHECK PATIENT
========================================== */

if ($result->num_rows === 1) {

    $patient = $result->fetch_assoc();


    /* ======================================
       CHECK PASSWORD
    ====================================== */

    if ($loginPassword === $patient["Pasword"]) {

        /* Create new session ID */

        session_regenerate_id(true);


        /* ==================================
           SAVE PATIENT INFORMATION
        ================================== */

        $_SESSION["Username"] = $patient["UserName"];
        $_SESSION["PatientID"] = $patient["PatientID"];
        $_SESSION["FirsName"] = $patient["FirsName"];
        $_SESSION["LastName"] = $patient["LastName"];
        $_SESSION["Gender"] = $patient["Gender"];


        /* ==================================
           LOGIN SUCCESS
        ================================== */

        $stmt->close();
        $conn->close();

        header("Location: home.php");
        exit();
    }
}


/* ==========================================
   LOGIN FAILED
========================================== */

$stmt->close();
$conn->close();

echo "<script>
        alert('Invalid Username or Password!');
        window.location.href = 'index.php';
      </script>";

exit();

?>