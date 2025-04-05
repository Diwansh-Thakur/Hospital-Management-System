<?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: login.php');
    exit();
}

include 'includes/db_config.php';
include 'includes/header.php';

// Handle report submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $patient_id = $_POST['patient_id'];
    $report_title = $_POST['report_title'];
    $report_details = $_POST['report_details'];

    $sql = "INSERT INTO reports (patient_id, report_title, report_details) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "iss", $patient_id, $report_title, $report_details);
    mysqli_stmt_execute($stmt);
    $message = "📄 Report added successfully!";
}

// Fetch patients for dropdown
$patients = mysqli_query($conn, "SELECT id, name FROM patients");

// Fetch all reports
$reports = mysqli_query($conn, "
    SELECT r.*, p.name 
    FROM reports r 
    JOIN patients p ON r.patient_id = p.id 
    ORDER BY r.report_date DESC
");
?>

<div style="max-width: 900px; margin: 30px auto; padding: 25px; background-color: #f9f9f9; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1);">

    <h2 style="text-align:center; color:#007bff;">📝 Add Patient Report</h2>

    <?php if (isset($message)) echo "<p style='color: green; text-align: center;'>$message</p>"; ?>

    <form method="POST" action="" style="display: grid; gap: 15px;">
        <label>Patient:
            <select name="patient_id" required style="width: 100%; padding: 10px;">
                <option value="">-- Select Patient --</option>
                <?php while ($row = mysqli_fetch_assoc($patients)) {
                    echo "<option value='{$row['id']}'>{$row['name']}</option>";
                } ?>
            </select>
        </label>

        <label>Report Title:
            <input type="text" name="report_title" required style="width: 100%; padding: 10px;">
        </label>

        <label>Report Details:
            <textarea name="report_details" rows="4" style="width: 100%; padding: 10px;"></textarea>
        </label>

        <input type="submit" value="Add Report" style="padding: 10px; background: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer;">
    </form>

    <hr style="margin: 40px 0;">

    <h3 style="text-align:center; color:#28a745;">📚 Report History</h3>

    <table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
        <thead>
            <tr style="background-color: #007bff; color: white;">
                <th style="padding: 10px;">Patient</th>
                <th style="padding: 10px;">Title</th>
                <th style="padding: 10px;">Details</th>
                <th style="padding: 10px;">Date</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (mysqli_num_rows($reports) > 0) {
                while ($report = mysqli_fetch_assoc($reports)) {
                    echo "<tr style='border-bottom: 1px solid #ddd; text-align: center;'>
                            <td style='padding: 10px;'>{$report['name']}</td>
                            <td style='padding: 10px;'>{$report['report_title']}</td>
                            <td style='padding: 10px;'>{$report['report_details']}</td>
                            <td style='padding: 10px;'>" . date("d M Y, h:i A", strtotime($report['report_date'])) . "</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='4' style='text-align: center; padding: 20px;'>No reports found.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php include 'includes/footer.php'; ?>
