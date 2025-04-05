<?php
session_start();

// Check login status
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: login.php');
    exit();
}

include 'includes/header.php';
include 'includes/db_config.php';

// Fetch patients
$sql = "SELECT * FROM patients";
$result = mysqli_query($conn, $sql);

if (!$result) {
    echo "<p style='color: red;'>Error: " . mysqli_error($conn) . "</p>";
    exit();
}
?>

<!-- ✅ Custom CSS for styling -->
<style>
    .patients-section {
        padding: 40px 20px;
        max-width: 1200px;
        margin: auto;
    }

    .patient-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
    }

    .patient-card {
        background: #fefefe;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
        border-left: 6px solid #007BFF;
    }

    .patient-card:hover {
        transform: scale(1.03);
    }

    .patient-name {
        font-size: 20px;
        font-weight: bold;
        color: #007BFF;
        margin-bottom: 10px;
    }

    .patient-detail {
        color: #555;
        font-size: 16px;
        margin: 4px 0;
    }

    h2 {
        text-align: center;
        color: #007BFF;
        margin-bottom: 30px;
    }
</style>

<!-- ✅ Patients content section -->
<div class="patients-section">
    <h2>Patient Records</h2>
    <div class="patient-grid">
        <?php
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $name = isset($row['NAME']) ? htmlspecialchars($row['NAME']) : "N/A";
                $age = isset($row['age']) ? htmlspecialchars($row['age']) : "N/A";
                $gender = isset($row['gender']) ? htmlspecialchars($row['gender']) : "N/A";

                echo "
                <div class='patient-card'>
                    <div class='patient-name'>{$name}</div>
                    <div class='patient-detail'>Age: {$age}</div>
                    <div class='patient-detail'>Gender: {$gender}</div>
                </div>";
            }
        } else {
            echo "<p style='text-align:center;'>No patients found.</p>";
        }
        ?>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
