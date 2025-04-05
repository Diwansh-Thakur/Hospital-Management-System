<?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: login.php');
    exit();
}

include 'includes/db_config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hospital Dashboard</title>
    <link rel="stylesheet" href="script.css">
    <style>
        body {
            background: linear-gradient(to right, #e0f7fa, #e1bee7);
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .navbar {
            background-color: #3949ab;
            color: white;
            padding: 20px;
            text-align: center;
            font-size: 24px;
            font-weight: bold;
        }

        .dashboard-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            padding: 40px;
        }

        .card {
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 30px;
            text-align: center;
            transition: transform 0.3s ease-in-out;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card h3 {
            font-size: 20px;
            margin-bottom: 15px;
            color: #5e35b1;
        }

        .card p {
            font-size: 28px;
            font-weight: bold;
            color: #00796b;
        }

        .footer {
            text-align: center;
            background-color: #3949ab;
            color: white;
            padding: 15px;
            position: relative;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="navbar">🏥 Hospital Management Dashboard</div>

    <div class="dashboard-container">
        <div class="card">
            <h3>Total Patients</h3>
            <p>
                <?php
                $result = mysqli_query($conn, "SELECT COUNT(*) as count FROM patients");
                $data = mysqli_fetch_assoc($result);
                echo $data['count'];
                ?>
            </p>
        </div>

        <div class="card">
            <h3>Total Doctors</h3>
            <p>
                <?php
                $result = mysqli_query($conn, "SELECT COUNT(*) as count FROM doctors");
                $data = mysqli_fetch_assoc($result);
                echo $data['count'];
                ?>
            </p>
        </div>

        <div class="card">
            <h3>Total Appointments</h3>
            <p>
                <?php
                $result = mysqli_query($conn, "SELECT COUNT(*) as count FROM appointments");
                $data = mysqli_fetch_assoc($result);
                echo $data['count'];
                ?>
            </p>
        </div>

        <div class="card">
            <h3>Reports Uploaded</h3>
            <p>
                <?php
                $result = mysqli_query($conn, "SELECT COUNT(*) as count FROM reports");
                $data = mysqli_fetch_assoc($result);
                echo $data['count'];
                ?>
            </p>
        </div>
    </div>

    <div class="footer">
        &copy; <?php echo date("Y"); ?> Hospital Management System | Made with ❤️
    </div>
</body>
</html>