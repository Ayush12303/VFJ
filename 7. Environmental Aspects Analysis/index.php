<?php
$insert = false;
//environmental_aspects_analysis
// Check if form is submitted
if (isset($_POST['submit'])) {
    // Set connection parameters for Informix server
    include_once("../../informixConnect_ppc.php"); // PERMANENT - DON'T CHANGE

    $table = "ea_analysis"; // Specify the table name in your database 

    // Check for connection success
    if (!$dbo) {
        die("Connection to the Informix database failed.");
    }
    
    $rowCountStmt = $dbo->prepare("SELECT COUNT(*) as count FROM $table");
    $rowCountStmt->execute();
    $rowCountResult = $rowCountStmt->fetch(PDO::FETCH_ASSOC);
    $id = $rowCountResult['count'] + 1;

    // Collect post variables
    $sn = $_POST['sn'];
    $process_description = $_POST['process_description'];
    $environmental_aspects = $_POST['environmental_aspects'];
    $in_stream = $_POST['in_stream'];
    $occurrence = $_POST['occurrence'];
    $disposal_mode = $_POST['disposal_mode'];
    $direct_indirect = $_POST['direct_indirect'];
    $env_impact = $_POST['env_impact'];
    $likely_hood_rating = $_POST['likely_hood_rating'];
    $severity_rating = $_POST['severity_rating'];
    $operation = $_POST['operation'];
    $legal_compliance = $_POST['legal_compliance'];
    $total_score = $_POST['total_score'];
    $action_required = $_POST['action_required'];
    $date = date('d-m-Y', strtotime($_POST['date']));

    // Prepare SQL statement for insertion
    $sql = "INSERT INTO $table 
            VALUES ($id,'$sn', '$process_description', '$environmental_aspects', '$in_stream', '$occurrence', '$disposal_mode', '$direct_indirect', '$env_impact', '$likely_hood_rating', '$severity_rating', '$operation', '$legal_compliance', '$total_score', '$action_required', '$date'  )";

    $stmt = $dbo->prepare($sql);

    // Execute SQL statement
    if ($stmt->execute()) {
        $insert = true;
    } else {
        echo "ERROR: Unable to execute query: " . print_r($stmt->errorInfo());
    }

    // Close database connection
    $dbo = null;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Environmental Aspects Analysis</title>
    <link rel = "icon" href = "images/logovfj.png" type ="image/x-icon">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 20px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid black;
            padding: 10px;
            text-align: center;
        }

        form {
            max-width: 100%;
            padding: 15px;
            border: 2px solid grey;
            border-radius: 10px;
            overflow-x: auto;
            background-color: white; /* Set form background color to white */
        }

        input[type="text"] {
            width: 200px; /* Set a fixed width for input fields */
            padding: 7px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
        }

        button[type="submit"],
        button[type="button"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 20px;
            transition: background-color 0.3s ease;
            display: inline-block;
            margin-right: 10px;
        }

        button[type="submit"]:hover,
        button[type="button"]:hover {
            background-color: #45a049;
        }

        .content-section {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 30px;
        }

        .content-section p {
            margin-bottom: 10px;
        }

        /* Print specific styles */
        @media print {
            body {
                background-color: white;
                padding: 0;
                margin: 0;
            }

            form {
                border: none;
            }

            input[type="text"] {
                width: 100%; /* Set input fields to 100% width for printing */
            }

            button[type="submit"],
            button[type="button"] {
                display: none;
            }
        }
    </style>
</head>

<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <h2>Environmental Aspects Analysis </h2>
        <table>
            <tr>
                <th>S No.</th>
                <th>Process Description</th>
                <th>Environmental Aspects</th>
                <th>In Stream(I) Out Stream (O) During Process(P)</th>
                <th>Occurrence</th>
                <th>DisposalMode/Final Destination</th>
                <th>Direct(D) Indirect(I)</th>
                <th>Env. Impact</th>
                <th>Likely Hood Rating</th>
                <th>Serverity Rating</th>
                <th>Operation</th>
                <th>Legal compliance</th>
                <th>Total Score</th>
                <th>Action Required</th>
            </tr>
            <!-- Sample row, you can add more rows as needed -->
            <tr>
                <td><input type="text" name="sn" id="sn"></td>
                <td><input type="text" name="process_description" id="process_description"></td>
                <td><input type="text" name="environmental_aspects" id="environmental_aspects"></td>
                <td><input type="text" name="in_stream" id="in_stream"></td>
                <td><input type="text" name="occurrence" id="occurrence"></td>
                <td><input type="text" name="disposal_mode" id="disposal_mode"></td>
                <td><input type="text" name="direct_indirect" id="direct_indirect"></td>
                <td><input type="text" name="env_impact" id="env_impact"></td>
                <td><input type="text" name="likely_hood_rating" id="likely_hood_rating"></td>
                <td><input type="text" name="severity_rating" id="severity_rating"></td>
                <td><input type="text" name="operation" id="operation"></td>
                <td><input type="text" name="legal_compliance" id="legal_compliance"></td>
                <td><input type="text" name="total_score" id="total_score"></td>
                <td><input type="text" name="action_required" id="action_required"></td>
            </tr>
        </table>
        <button type="submit" name="submit">Submit</button>
        <button type="button" onclick="printForm()" class="btn">Print</button>
    </form>
    <script>
        function printForm() {
            var style = document.createElement('style');
            style.innerHTML =
                document.head.appendChild(style);
            window.print();
            style.remove();
        }
    </script>
</body>
</html>
