<?php
error_reporting(E_ALL & ~E_NOTICE);
ini_set('display_errors', 0);

$insert = false;
$error_message = "";

if (isset($_POST['submit'])) {
    include_once("../../informixConnect_ppc.php");

    $table = "ims_schedule";

    if (!$dbo) {
        die("Connection to the Informix database failed.");
    }

    $rowCountStmt = $dbo->prepare("SELECT COUNT(*) as count FROM $table");
    $rowCountStmt->execute();
    $rowCountResult = $rowCountStmt->fetch(PDO::FETCH_ASSOC);
    $id = $rowCountResult['count'] + 1;

    $auditArea = $_POST['auditArea'];
    $auditeeResponsible = $_POST['auditeeResponsible'];
    $auditScope = $_POST['auditScope'];
    $periodOfAudit = $_POST['periodOfAudit'];
    $teamLeaderResponsible = $_POST['teamLeaderResponsible'];
    $teamMembers = $_POST['teamMembers'];
    $date = date('d-m-Y', strtotime($_POST['date']));

    // Construct SQL query
    $sql = "INSERT INTO $table 
            VALUES ($id, '$auditArea', '$auditeeResponsible', '$auditScope', '$periodOfAudit', '$teamLeaderResponsible', '$teamMembers', '$date')";

    $stmt = $dbo->prepare($sql);

    // Execute SQL statement
    if ($stmt->execute()) {
        $insert = true;
        echo "Data Inserted Successfully!";
    } else {
        $error_message = "Error occurred while inserting data into the database.";
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
    <title>Internal IMS Audit Schedule</title>
    <link rel = "icon" href = "images/logovfj.png" type ="image/x-icon">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 90%;
            margin: 0 auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: center;
        }
        input[type="text"], input[type="date"] {
            width: calc(100% - 16px); /* Adjusted width for padding */
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            margin-bottom: 10px;
        }
        button[type="submit"], button[type="button"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-right: 10px;
        }
        button[type="submit"]:hover, button[type="button"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <h2>INTERNAL IMS AUDIT SCHEDULE</h2>
            <table>
                <tr>
                    <th>AUDITEE AREA</th>
                    <th>AUDITEE RESPONSIBLE</th>
                    <th>AUDIT SCOPE</th>
                    <th>PERIOD OF AUDIT</th>
                    <th>TEAM LEADER RESPONSIBLE</th>
                    <th>TEAM MEMBERS</th>
                </tr>
                <tr>
                    <td><input type="text" id="auditArea" name="auditArea" ></td>
                    <td><input type="text" id="auditeeResponsible" name="auditeeResponsible" ></td>
                    <td><input type="text" id="auditScope" name="auditScope" ></td>
                    <td><input type="text" id="periodOfAudit" name="periodOfAudit" ></td>
                    <td><input type="text" id="teamLeaderResponsible" name="teamLeaderResponsible" ></td>
                    <td><input type="text" id="teamMembers" name="teamMembers" ></td>
                </tr>
                
                <tr>
                    <td colspan="4">DATE</td>
                    <td colspan="2"><input type="date" name="date" id="date" ></td>
                </tr>
                <tr>
                    <td colspan="6" style="text-align: right;">
                        <h3 style="margin-right: 2rem;">
                            Signature of MR
                        </h3>
                    </td>
                </tr>
            </table>
            <br><br>
            <button type="submit" name="submit">Submit</button>
            <button type="button" onclick="printForm()">Print</button>
        </form>
    </div>

    <script>
        function printForm() {
            var style = document.createElement('style');
            style.innerHTML = 'body * { visibility: hidden; } .container, .container * { visibility: visible; } .container { position: absolute; left: 0; top: 0; }';
            document.head.appendChild(style);
            window.print();
            style.remove();
        }
    </script>
    <script>
        // Function to get the current date in the format YYYY-MM-DD
        function getCurrentDate() {
            const today = new Date();
            const year = today.getFullYear();
            const month = (today.getMonth() + 1).toString().padStart(2, '0');
            const day = today.getDate().toString().padStart(2, '0');
            return `${year}-${month}-${day}`;
        }
    
        // Set the current date as the default value of the date input field
        document.getElementById('date').value = getCurrentDate();
    </script>
</body>
</html>
