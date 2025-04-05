<?php
session_start(); // Start the session
include 'includes/db_config.php'; // Database connection
include 'includes/header.php'; 
?>

<!-- 🌟 Styles for the homepage -->
<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        margin: 0;
        background: #f0f4f8;
        color: #333;
    }

    main {
        max-width: 1000px;
        margin: 60px auto;
        padding: 40px 20px;
        text-align: center;
    }

    h1 {
        color: #007BFF;
        margin-bottom: 10px;
    }

    p {
        font-size: 18px;
        color: #555;
        margin-bottom: 40px;
    }

    .nav-cards {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 20px;
        justify-content: center;
        align-items: center;
    }

    .nav-card {
        background-color: #ffffff;
        padding: 25px;
        border-radius: 12px;
        text-align: center;
        box-shadow: 0 8px 16px rgba(0, 123, 255, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .nav-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 20px rgba(0, 123, 255, 0.2);
    }

    .nav-card a {
        text-decoration: none;
        font-weight: 600;
        color: #007BFF;
        font-size: 18px;
        display: block;
    }

    .nav-card a:hover {
        color: #0056b3;
    }

    @media (max-width: 600px) {
        main {
            padding: 20px 10px;
        }
    }
</style>

<!-- ✅ Main Homepage Layout -->
<main>
    <h1>Welcome to the Hospital Management System</h1>
    <p>Select an option below to get started:</p>

    <div class="nav-cards">
        <div class="nav-card">
            <a href="view_patients.php">👨‍⚕️ View Patients</a>
        </div>
        <div class="nav-card">
            <a href="add_patient.php">➕ Add New Patient</a>
        </div>
        <div class="nav-card">
            <a href="doctors.php">🩺 View Doctors</a>
        </div>
        <div class="nav-card">
            <a href="appointments.php">📅 Manage Appointments</a>
        </div>
        
    </div>
</main>

<?php include 'includes/footer.php'; ?>
