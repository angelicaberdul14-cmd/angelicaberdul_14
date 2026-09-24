<?php
include 'auth_guard.php';
include 'database.php';

$query = "SELECT id, firstname, lastname FROM students ORDER BY id DESC";
$result = $conn->query($query);

if (!$result) {
    die("Database error: " . $conn->error);
}

$students = [];

while ($row = $result->fetch_assoc()) {
    $students[] = $row;
}

$totalStudents = count($students);
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Student Management | Guevara Jasper</title>

    <!-- Bootstrap CSS -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <!-- Google Font -->
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css?v=3">
    <link rel="stylesheet" href="auth.css?v=1">

</head>

<body>

    <!-- BACKGROUND DECORATIONS -->

    <div class="background-decoration decoration-one"></div>
    <div class="background-decoration decoration-two"></div>
    <div class="background-decoration decoration-three"></div>


    <!-- MAIN CONTAINER -->

    <div class="container main-container">


        <!-- ==========================
             PAGE HEADER
        =========================== -->

        <div class="page-header">

            <div class="header-content">

                <div class="brand-icon">
                    ✦
                </div>

                <div>

                    <h1>
                        Student <span>Management</span>
                    </h1>

                    <p>
                        Manage your student records easily
                    </p>

                </div>

            </div>


            <!-- STUDENT COUNT -->

            <div class="student-count">

                <div class="count-icon">
                    👥
                </div>

                <div>

                    <small>
                        TOTAL STUDENTS
                    </small>

                    <h2>
                        <?php echo $totalStudents; ?>
                    </h2>

                </div>

            </div>


            <!-- USER / LOGOUT -->

            <div class="user-box">

                <span class="user-box-name">
                    👤 <?php echo htmlspecialchars($_SESSION['username'], ENT_QUOTES, 'UTF-8'); ?>
                </span>

                <a href="logout.php" class="btn logout-btn" onclick="return confirm('Sigurado ka bang gusto mong mag-logout?');">
                    ⏻ Logout
                </a>

            </div>

        </div>



        <!-- ==========================
             STUDENT TABLE CARD
        =========================== -->

        <div class="student-card">


            <!-- CARD TOP -->

            <div class="card-top">

                <div>

                    <h3>
                        Student Records
                    </h3>

                    <p>
                        View and manage all registered students
                    </p>

                </div>


                <!-- ADD BUTTON -->

                <button
                    type="button"
                    class="btn add-student-btn"
                    data-bs-toggle="modal"
                    data-bs-target="#addModal">

                    <span class="plus-icon">+</span>
                    Add Student

                </button>

            </div>



            <!-- TABLE -->

            <div class="table-responsive">

                <table class="table student-table">

                    <thead>

                        <tr>

                            <th>
                                #
                            </th>

                            <th>
                                First Name
                            </th>

                            <th>
                                Last Name
                            </th>

                            <th>
                                Action
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        <?php if ($totalStudents > 0): ?>

                            <?php foreach ($students as $index => $row): ?>

                                <tr>

                                    <!-- NUMBER -->

                                    <td>

                                        <span class="student-number">
                                            <?php echo $index + 1; ?>
                                        </span>

                                    </td>


                                    <!-- FIRST NAME -->

                                    <td>

                                        <div class="student-name">

                                            <span class="user-icon">
                                                ♙
                                            </span>

                                            <?php
                                            echo htmlspecialchars(
                                                $row['firstname'],
                                                ENT_QUOTES,
                                                'UTF-8'
                                            );
                                            ?>

                                        </div>

                                    </td>


                                    <!-- LAST NAME -->

                                    <td>

                                        <?php
                                        echo htmlspecialchars(
                                            $row['lastname'],
                                            ENT_QUOTES,
                                            'UTF-8'
                                        );
                                        ?>

                                    </td>


                                    <!-- ACTIONS -->

                                    <td>

                                        <!-- EDIT -->

                                        <button
                                            type="button"
                                            class="btn edit-btn"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editModal<?php echo $row['id']; ?>">

                                            ✎ Edit

                                        </button>


                                        <!-- DELETE -->

                                        <a
                                            href="delete.php?id=<?php echo $row['id']; ?>"
                                            class="btn delete-btn"
                                            onclick="return confirm('Are you sure you want to delete this student?');">

                                            🗑 Delete

                                        </a>

                                    </td>

                                </tr>

                            <?php endforeach; ?>

                        <?php else: ?>

                            <!-- EMPTY TABLE -->

                            <tr>

                                <td
                                    colspan="4"
                                    class="empty-state">

                                    <div class="empty-icon">
                                        ✦
                                    </div>

                                    <h4>
                                        No Students Yet
                                    </h4>

                                    <p>
                                        Click "Add Student" to create your first record.
                                    </p>

                                </td>

                            </tr>

                        <?php endif; ?>

                    </tbody>

                </table>

            </div>


            <!-- CARD FOOTER -->

            <div class="card-footer-custom">

                <span>
                    ● System Online
                </span>

                <span>
                    Student Database
                </span>

            </div>

        </div>

    </div>



    <!-- =========================================
         ADD STUDENT MODAL
    ========================================== -->

    <div
        class="modal fade"
        id="addModal"
        tabindex="-1"
        aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content custom-modal">


                <form
                    action="insert.php"
                    method="post">


                    <!-- MODAL HEADER -->

                    <div class="modal-header">

                        <div class="modal-heading">

                            <div class="modal-icon">
                                +
                            </div>

                            <div>

                                <h5 class="modal-title">
                                    Add Student
                                </h5>

                                <p class="modal-description">
                                    Enter the student's information below.
                                </p>

                            </div>

                        </div>


                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close">
                        </button>

                    </div>



                    <!-- MODAL BODY -->

                    <div class="modal-body">


                        <div class="mb-3">

                            <label class="form-label">
                                First Name
                            </label>

                            <input
                                type="text"
                                name="firstname"
                                class="form-control custom-input"
                                placeholder="Enter first name"
                                required>

                        </div>


                        <div class="mb-3">

                            <label class="form-label">
                                Last Name
                            </label>

                            <input
                                type="text"
                                name="lastname"
                                class="form-control custom-input"
                                placeholder="Enter last name"
                                required>

                        </div>

                    </div>



                    <!-- MODAL FOOTER -->

                    <div class="modal-footer">

                        <button
                            type="button"
                            class="btn cancel-btn"
                            data-bs-dismiss="modal">

                            Cancel

                        </button>


                        <button
                            type="submit"
                            class="btn save-btn">

                            Add Student

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>



    <!-- =========================================
         EDIT STUDENT MODALS
    ========================================== -->

    <?php foreach ($students as $row): ?>

        <div
            class="modal fade"
            id="editModal<?php echo $row['id']; ?>"
            tabindex="-1"
            aria-hidden="true">

            <div class="modal-dialog modal-dialog-centered">

                <div class="modal-content custom-modal">


                    <form
                        action="update.php"
                        method="post">


                        <!-- MODAL HEADER -->

                        <div class="modal-header">

                            <div class="modal-heading">

                                <div class="modal-icon">
                                    ✎
                                </div>

                                <div>

                                    <h5 class="modal-title">
                                        Edit Student
                                    </h5>

                                    <p class="modal-description">
                                        Update the student's information.
                                    </p>

                                </div>

                            </div>


                            <button
                                type="button"
                                class="btn-close"
                                data-bs-dismiss="modal"
                                aria-label="Close">
                            </button>

                        </div>



                        <!-- MODAL BODY -->

                        <div class="modal-body">


                            <!-- ID -->

                            <input
                                type="hidden"
                                name="id"
                                value="<?php echo $row['id']; ?>">


                            <div class="mb-3">

                                <label class="form-label">
                                    First Name
                                </label>

                                <input
                                    type="text"
                                    name="firstname"
                                    class="form-control custom-input"
                                    value="<?php echo htmlspecialchars($row['firstname'], ENT_QUOTES, 'UTF-8'); ?>"
                                    required>

                            </div>


                            <div class="mb-3">

                                <label class="form-label">
                                    Last Name
                                </label>

                                <input
                                    type="text"
                                    name="lastname"
                                    class="form-control custom-input"
                                    value="<?php echo htmlspecialchars($row['lastname'], ENT_QUOTES, 'UTF-8'); ?>"
                                    required>

                            </div>

                        </div>



                        <!-- MODAL FOOTER -->

                        <div class="modal-footer">

                            <button
                                type="button"
                                class="btn cancel-btn"
                                data-bs-dismiss="modal">

                                Cancel

                            </button>


                            <button
                                type="submit"
                                class="btn save-btn">

                                Save Changes

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    <?php endforeach; ?>



    <!-- BOOTSTRAP JS -->

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
    </script>


</body>

</html>