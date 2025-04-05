<?php
session_start(); // Start session to check login status

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: login.php');
    exit();
}

include 'includes/header.php';
?>

<!-- ✅ Stylish Form CSS -->
<style>
    .add-patient-section {
        max-width: 500px;
        margin: 40px auto;
        padding: 30px;
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    .add-patient-section h2 {
        text-align: center;
        margin-bottom: 25px;
        color: #007BFF;
    }

    .add-patient-section label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: #333;
    }

    .add-patient-section input,
    .add-patient-section select {
        width: 100%;
        padding: 10px 12px;
        margin-bottom: 20px;
        border: 1px solid #ccc;
        border-radius: 6px;
        font-size: 16px;
        background: #f9f9f9;
        transition: border 0.3s ease;
    }

    .add-patient-section input:focus,
    .add-patient-section select:focus {
        border-color: #007BFF;
        outline: none;
    }

    .add-patient-section button {
        width: 100%;
        padding: 12px;
        background-color: #28a745;
        border: none;
        color: white;
        font-size: 16px;
        border-radius: 6px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .add-patient-section button:hover {
        background-color: #218838;
    }

    @media (max-width: 600px) {
        .add-patient-section {
            margin: 20px;
            padding: 20px;
        }
    }
</style>

<!-- ✅ Form UI -->
<div class="add-patient-section">
    <h2>Add New Patient</h2>
    <form method="POST" action="add_patient_process.php">
        <label for="name">Full Name:</label>
        <input type="text" id="name" name="name" placeholder="e.g. John Doe" required>

        <label for="age">Age:</label>
        <input type="number" id="age" name="age" placeholder="e.g. 30" required>

        <label for="gender">Gender:</label>
        <select id="gender" name="gender" required>
            <option value="">-- Select Gender --</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Other">Other</option>
        </select>

        <button type="submit">Add Patient</button>
    </form>
</div>

<?php include 'includes/footer.php'; ?>
