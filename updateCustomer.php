<?php
session_start();
if (isset($_SESSION['ID'])) {
   $ID = $_SESSION['ID'];
}
require_once('DBconnect.php');


// Fetch customer information (assuming customer ID is provided)
$customerId = $ID; // Replace with dynamic user ID if needed
$customer = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Update customer information
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phone']);

    $updateSql = "UPDATE customer SET name = '$name', email = '$email', phone = '$phone' WHERE id = $customerId";

    if ($conn->query($updateSql)) {
        header("Location: home.php");
    } else {
        $message = "Error updating customer information: " . $conn->error;
    }
}

// Fetch customer details after update
$sql = "SELECT id, name, email, phone FROM customer WHERE id = $customerId";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $customer = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Customer Information</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-top: 10px;
            font-weight: bold;
        }
        input {
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        button {
            margin-top: 20px;
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        .message {
            text-align: center;
            color: green;
            margin-top: 20px;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Update Customer Information</h1>

    <?php if (isset($message)): ?>
        <p class="message"><?php echo $message; ?></p>
    <?php endif; ?>

    <?php if ($customer): ?>
        <form method="POST">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($customer['name']); ?>" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($customer['email']); ?>" required>

            <label for="phone">Phone:</label>
            <input type="phone" id="phone" name="phone" value="<?php echo htmlspecialchars($customer['phone']); ?>" required>


            <button type="submit">Update</button>
        </form>
    <?php else: ?>
        <p>Customer not found.</p>
    <?php endif; ?>
</div>
</body>
</html>
