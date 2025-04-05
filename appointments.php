<?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit();
}

include 'includes/db_config.php';
include 'includes/header.php';

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $patient_id = $_POST['patient_id'];
    $doctor_id = $_POST['doctor_id'];
    $appointment_date = $_POST['appointment_date'];
    $status = $_POST['status'];

    $sql = "INSERT INTO appointments (patient_id, doctor_id, appointment_date, status, created_at) 
            VALUES ('$patient_id', '$doctor_id', '$appointment_date', '$status', NOW())";

    if (mysqli_query($conn, $sql)) {
        echo "<p style='color: green; text-align: center;'>✅ Appointment added successfully!</p>";
    } else {
        echo "<p style='color: red; text-align: center;'>❌ Error: " . mysqli_error($conn) . "</p>";
    }
}

// Fetch patients and doctors
$patients = mysqli_query($conn, "SELECT id, name FROM patients");
$doctors = mysqli_query($conn, "SELECT id, name FROM doctors");

// Fetch appointments
$appointments = mysqli_query($conn, "
    SELECT a.*, p.name as patient_name, d.name as doctor_name
    FROM appointments a
    JOIN patients p ON a.patient_id = p.id
    JOIN doctors d ON a.doctor_id = d.id
    ORDER BY a.appointment_date DESC
");
?>

<div style="max-width: 900px; margin: 30px auto; padding: 20px; border-radius: 10px; background: #f9f9f9; box-shadow: 0 0 10px rgba(0,0,0,0.1);">

    <h2 style="text-align:center; color: #007bff;">📅 Add Appointment</h2>

    <form method="POST" style="display: grid; gap: 15px;">
        <label>Select Patient:
            <select name="patient_id" required style="width: 100%; padding: 10px;">
                <option value="">-- Select Patient --</option>
                <?php while ($p = mysqli_fetch_assoc($patients)) {
                    echo "<option value='{$p['id']}'>{$p['name']}</option>";
                } ?>
            </select>
        </label>

        <label>Select Doctor:
            <select name="doctor_id" required style="width: 100%; padding: 10px;">
                <option value="">-- Select Doctor --</option>
                <?php while ($d = mysqli_fetch_assoc($doctors)) {
                    echo "<option value='{$d['id']}'>{$d['name']}</option>";
                } ?>
            </select>
        </label>

        <label>Appointment Date & Time:
            <input type="datetime-local" name="appointment_date" required style="width: 100%; padding: 10px;">
        </label>

        <label>Status:
            <select name="status" required style="width: 100%; padding: 10px;">
                <option value="Scheduled">Scheduled</option>
                <option value="Completed">Completed</option>
                <option value="Cancelled">Cancelled</option>
            </select>
        </label>

        <input type="submit" value="Add Appointment" style="padding: 10px; background: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer;">
    </form>

    <hr style="margin: 40px 0;">

    <h2 style="text-align:center; color: #28a745;">📖 Appointment History</h2>

    <table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
        <thead>
            <tr style="background-color: #007bff; color: white;">
                <th style="padding: 10px;">Patient</th>
                <th style="padding: 10px;">Doctor</th>
                <th style="padding: 10px;">Date & Time</th>
                <th style="padding: 10px;">Status</th>
                <th style="padding: 10px;">Created At</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (mysqli_num_rows($appointments) > 0) {
                while ($row = mysqli_fetch_assoc($appointments)) {
                    $status = $row['STATUS'] ?? 'Unknown';

                    $statusColor = match ($status) {
                        "Scheduled" => "#ffc107",
                        "Completed" => "#28a745",
                        "Cancelled" => "#dc3545",
                        default => "#6c757d"
                    };

                    echo "<tr style='border-bottom: 1px solid #ddd; text-align: center;'>
                        <td style='padding: 10px;'>{$row['patient_name']}</td>
                        <td style='padding: 10px;'>{$row['doctor_name']}</td>
                        <td style='padding: 10px;'>" . date("d M Y, h:i A", strtotime($row['appointment_date'])) . "</td>
                        <td style='padding: 10px;'>
                            <span style='background-color: {$statusColor}; color: white; padding: 5px 12px; border-radius: 12px;'>{$status}</span>
                        </td>
                        <td style='padding: 10px;'>" . date("d M Y", strtotime($row['created_at'])) . "</td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='5' style='padding: 20px; text-align:center;'>No appointments found</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php include 'includes/footer.php'; ?>
