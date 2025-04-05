<?php
include 'includes/header.php';   // Include the header for layout
include 'includes/db_config.php'; // DB connection

// Fetch doctor data
$sql = "SELECT * FROM doctors";
$result = mysqli_query($conn, $sql);
?>

<style>
    .doctor-section {
        padding: 40px 20px;
        max-width: 1200px;
        margin: auto;
    }

    .doctor-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 20px;
    }

    .doctor-card {
        background: linear-gradient(to right, #e0f7fa, #ffffff);
        border-radius: 15px;
        padding: 20px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        transition: transform 0.3s ease;
    }

    .doctor-card:hover {
        transform: translateY(-5px);
    }

    .doctor-name {
        font-size: 20px;
        font-weight: bold;
        color: #007BFF;
        margin-bottom: 10px;
    }

    .specialization {
        font-style: italic;
        color: #555;
        margin-bottom: 8px;
    }

    .contact {
        color: #444;
    }

    .created-date {
        font-size: 12px;
        color: #888;
        margin-top: 10px;
    }
</style>

<div class="doctor-section">
    <h2 style="text-align:center; color:#007BFF;">Our Doctors</h2>
    <div class="doctor-grid">
        <?php
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo '
                <div class="doctor-card">
                    <div class="doctor-name">' . htmlspecialchars($row['NAME']) . '</div>
                    <div class="specialization">Specialization: ' . htmlspecialchars($row['specialization']) . '</div>
                    <div class="contact">Contact: ' . htmlspecialchars($row['contact']) . '</div>
                    <div class="created-date">Joined: ' . date("F j, Y", strtotime($row['created_at'])) . '</div>
                </div>';
            }
        } else {
            echo '<p style="text-align:center;">No doctors found.</p>';
        }
        ?>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
