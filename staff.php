<?php
include 'includes/header.php';
include 'includes/db_config.php';

$sql = "SELECT * FROM staff WHERE status = 'Active'";
$result = mysqli_query($conn, $sql);
?>

<!-- ✅ Styling -->
<style>
    .staff-section {
        padding: 40px 20px;
        max-width: 1200px;
        margin: auto;
    }

    .staff-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 20px;
    }

    .staff-card {
        background: #ffffff;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
        border-left: 6px solid #28a745;
    }

    .staff-card:hover {
        transform: scale(1.02);
    }

    .staff-name {
        font-size: 20px;
        font-weight: bold;
        color: #28a745;
        margin-bottom: 10px;
    }

    .staff-detail {
        font-size: 16px;
        color: #555;
        margin: 5px 0;
    }

    h2 {
        text-align: center;
        color: #28a745;
        margin-bottom: 30px;
    }
</style>

<!-- ✅ Main section -->
<div class="staff-section">
    <h2>Active Staff Members</h2>
    <div class="staff-grid">
        <?php
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $name = htmlspecialchars($row['name']);
                $position = htmlspecialchars($row['position']);
                $contact = htmlspecialchars($row['contact_number']);
                $email = htmlspecialchars($row['email']);
                $joined = htmlspecialchars($row['date_joined']);

                echo "
                <div class='staff-card'>
                    <div class='staff-name'>{$name}</div>
                    <div class='staff-detail'><strong>Position:</strong> {$position}</div>
                    <div class='staff-detail'><strong>Contact:</strong> {$contact}</div>
                    <div class='staff-detail'><strong>Email:</strong> {$email}</div>
                    <div class='staff-detail'><strong>Joined:</strong> {$joined}</div>
                </div>";
            }
        } else {
            echo "<p style='text-align:center;'>No active staff members found.</p>";
        }
        ?>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
