<?php
$servername = "localhost:3306";
$username = "root";
$password = "";
$dbname = "realestate";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$start_date = $_GET['start-date'];
$end_date = $_GET['end-date'];

$sql = "SELECT name, email, phone, date, time FROM report WHERE date BETWEEN ? AND ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $start_date, $end_date);
$stmt->execute();
$result = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            overflow: hidden;
        }
        header {
            background: #35424a;
            color: #ffffff;
            padding-top: 30px;
            min-height: 70px;
            border-bottom: #e8491d 3px solid;
            text-align: center;
        }
        .results-content {
            padding: 20px;
            background: #ffffff;
            margin: 20px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #35424a;
            color: white;
        }
        footer {
            padding: 20px;
            background: #35424a;
            color: #ffffff;
            text-align: center;
        }
        .back-to-home {
            display: block;
            margin: 20px 0;
            text-align: center;
        }
        .back-to-home a {
            color: #e8491d;
            text-decoration: none;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <div id="branding">
                <h1>Search Results</h1>
            </div>
        </div>
    </header>

    <section class="container results-content">
        <h2>Buyers Listed Between <?php echo htmlspecialchars($start_date); ?> and <?php echo htmlspecialchars($end_date); ?></h2>
        <?php if ($result->num_rows > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Date</th>
                        <th>Time</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['name']); ?></td>
                            <td><?php echo htmlspecialchars($row['email']); ?></td>
                            <td><?php echo htmlspecialchars($row['phone']); ?></td>
                            <td><?php echo htmlspecialchars($row['date']); ?></td>
                            <td><?php echo htmlspecialchars($row['time']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No Buyers on the selected dates.</p>
        <?php endif; ?>
        <?php $stmt->close(); $conn->close(); ?>
    </section>

    <div class="back-to-home">
        <a href="homepage.html">Back to Home</a>
    </div>

    <footer>
        <p>Contact us: (123) 456-7890 | email@example.com</p>
    </footer>
</body>
</html>