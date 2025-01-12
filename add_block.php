<?php
session_start();

$servername = "mariadb.vamk.fi";
$username = "e2203076";
$password = "uGeEFE2YmuF";
$database = "e2203076_health";

// Creating connection to the database
$conn = new mysqli($servername, $username, $password, $database);

// Check connection status
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the blockchain table exists, if not, create it
$sqlCreateTable = "CREATE TABLE IF NOT EXISTS blockchain (
    blockchain_index INT AUTO_INCREMENT PRIMARY KEY,
    timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    previous_hash VARCHAR(64) DEFAULT '0',
    current_hash VARCHAR(64),
    start_point VARCHAR(255),
    end_point VARCHAR(255),
    km DECIMAL(10, 2)
)";
if ($conn->query($sqlCreateTable) === TRUE) {
    echo "Blockchain table created successfully<br>";
} else {
    echo "Error creating table: " . $conn->error;
}

// Check if the blockchain table is empty
$sqlCheckBlockchainEmpty = "SELECT COUNT(*) AS count FROM blockchain";
$result = $conn->query($sqlCheckBlockchainEmpty);
$row = $result->fetch_assoc();
$count = $row['count'];

if ($count == 0) {
    // Creating the genesis block
    $genesisBlock = array(
        'timestamp' => '2024-01-01 00:00:00',
        'previous_hash' => '0',
        'current_hash' => 'genesis_hash_value',
        'start_point' => 'Genesis Start',
        'end_point' => 'Genesis End',
        'km' => 0.00
    );

    // Insert the genesis block into the blockchain table
    $sqlInsertGenesisBlock = "INSERT INTO blockchain (timestamp, previous_hash, current_hash, start_point, end_point, km)
                              VALUES ('{$genesisBlock['timestamp']}', '{$genesisBlock['previous_hash']}', '{$genesisBlock['current_hash']}', '{$genesisBlock['start_point']}', '{$genesisBlock['end_point']}', {$genesisBlock['km']})";
    if ($conn->query($sqlInsertGenesisBlock) === TRUE) {
        echo "Genesis block created successfully<br>";
    } else {
        echo "Error creating genesis block: " . $conn->error;
    }
}

// Check if the current request method is POST, indicating that form data has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $start_point = $_POST['start_point'];
    $end_point = $_POST['end_point'];
    $km = $_POST['km'];

    // Get the current hash of the last block in the blockchain
    $sqlGetPreviousHash = "SELECT current_hash FROM blockchain ORDER BY blockchain_index DESC LIMIT 1";
    $result = $conn->query($sqlGetPreviousHash);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $previousHash = $row['current_hash'];
    } else {
        $previousHash = '0';
    }

    // Calculate the current hash
    $currentHash = hash('sha256', $previousHash . $start_point . $end_point . $km);

    // Insert the new block into the blockchain table
    $sqlInsertBlock = "INSERT INTO blockchain (previous_hash, current_hash, start_point, end_point, km)
                       VALUES ('$previousHash', '$currentHash', '$start_point', '$end_point', '$km')";
    if ($conn->query($sqlInsertBlock) === TRUE) {
        echo "Your data has been inserted successfully<br>";
    } else {
        echo "Error adding new block: " . $conn->error;
    }
}

// Showing the blockchain table
$sqlSelectBlockchain = "SELECT blockchain_index, timestamp, previous_hash, current_hash, start_point, end_point, km FROM blockchain";
$result = $conn->query($sqlSelectBlockchain);

if ($result->num_rows > 0) {
    echo "<h2>All Data is here:</h2>";
    echo "<table>";
    echo "<tr><th>Blockchain Index</th><th>Timestamp</th><th>Previous Hash</th><th>Current Hash</th><th>Start destination</th><th>Final destination</th><th>The whole route (km)</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["blockchain_index"] . "</td>";
        echo "<td>" . $row["timestamp"] . "</td>";
        echo "<td>" . $row["previous_hash"] . "</td>";
        echo "<td>" . $row["current_hash"] . "</td>";
        echo "<td>" . $row["start_point"] . "</td>";
        echo "<td>" . $row["end_point"] . "</td>";
        echo "<td>" . $row["km"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No data found";
}

// Close database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="fi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="favicon.ico" type="image/x-icon" />
    <title>Add block</title>
    <style>

        /* CSS styles */
        body {
            text-align: center;
        }
        

        table {
            border-collapse: collapse;
            width: 80%;
            margin: 20px auto; 
            background-color: #ffffff;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #C08081;
            color: #ffffff;
        }

        form {
            margin: 20px auto; 
            display: inline-block; 
            text-align: left;
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input[type="text"],
        input[type="number"],
        input[type="submit"],
        .logout-button {
            width: 100%; 
            padding: 8px;
            margin-bottom: 10px;
            box-sizing: border-box; 
        }
        input[type="submit"] {
           
           display: block;
           width: 100%;
           padding: 10px;
           margin-bottom: 15px;#C08081
           border: 1px solid #ccc;
           border-radius: 4px;
           box-sizing: border-box;
       }
        input[type="submit"],
        .logout-button {
            background-color: #8E3A59;
            color: #fff;
            cursor: pointer;
            width: 120px; 
            margin: 0 auto; 
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

       

        input[type="submit"]:hover,
        .logout-button:hover {
            background-color: #C08081;

        }
        p {
            margin-bottom: 10px;
            font-style: italic; 
        }
        h2 {
            padding-top: 60px; 
            font-family: 'Libre Baskerville', serif; 
            color: #8E3A59;
           
        }
        .background {
            background-image: url('bg2.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            height: 100%;
            
        }
        
      
    </style>
</head>

<body class="background">
    
    <div class="container">
        <!-- displaying username -->
        <p>You are logged in as: <?php echo $_SESSION['username']; ?></p>
        <form action="logout.php" method="post">
            <input type="submit" class="logout-button" value="Logout">
            <!-- Tech support link-->
            <p>For technical support, <a href="support.php">click here</a>.</p>
        </form>
    </div>
</body>
</html>
