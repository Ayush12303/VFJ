<?php
error_reporting(E_ALL & ~E_NOTICE);
ini_set('display_errors', 0);

$insert = false;
$error_message = "";

if (isset($_POST['submit'])) {
    include_once("../../informixConnect_ppc.php"); 

    $table = "ims_schedule_multiple"; 

    if (!$dbo) {
        die("Connection to the Informix database failed.");
    }

    $rowCountStmt = $dbo->prepare("SELECT COUNT(*) as count FROM $table");
    $rowCountStmt->execute();
    $rowCountResult = $rowCountStmt->fetch(PDO::FETCH_ASSOC);
    $id = $rowCountResult['count'] + 1;

    // Assign POST data to variables
    $auditAreacol1 = $_POST['auditAreacol1'];
    $auditeeResponsiblecol1 = $_POST['auditeeResponsiblecol1'];
    $auditScopecol1 = $_POST['auditScopecol1'];
    $periodOfAuditcol1 = $_POST['periodOfAuditcol1'];
    $teamLeaderResponsiblecol1 = $_POST['teamLeaderResponsiblecol1'];
    $teamMemberscol1 = $_POST['teamMemberscol1'];

    $auditAreacol2 = $_POST['auditAreacol2'];
    $auditeeResponsiblecol2 = $_POST['auditeeResponsiblecol2'];
    $auditScopecol2 = $_POST['auditScopecol2'];
    $periodOfAuditcol2 = $_POST['periodOfAuditcol2'];
    $teamLeaderResponsiblecol2 = $_POST['teamLeaderResponsiblecol2'];
    $teamMemberscol2 = $_POST['teamMemberscol2'];

    $auditAreacol3 = $_POST['auditAreacol3'];
    $auditeeResponsiblecol3 = $_POST['auditeeResponsiblecol3'];
    $auditScopecol3 = $_POST['auditScopecol3'];
    $periodOfAuditcol3 = $_POST['periodOfAuditcol3'];
    $teamLeaderResponsiblecol3 = $_POST['teamLeaderResponsiblecol3'];
    $teamMemberscol3 = $_POST['teamMemberscol3'];

    $auditAreacol4 = $_POST['auditAreacol4'];
    $auditeeResponsiblecol4 = $_POST['auditeeResponsiblecol4'];
    $auditScopecol4 = $_POST['auditScopecol4'];
    $periodOfAuditcol4 = $_POST['periodOfAuditcol4'];
    $teamLeaderResponsiblecol4 = $_POST['teamLeaderResponsiblecol4'];
    $teamMemberscol4 = $_POST['teamMemberscol4'];

    $auditAreacol5 = $_POST['auditAreacol5'];
    $auditeeResponsiblecol5 = $_POST['auditeeResponsiblecol5'];
    $auditScopecol5 = $_POST['auditScopecol5'];
    $periodOfAuditcol5 = $_POST['periodOfAuditcol5'];
    $teamLeaderResponsiblecol5 = $_POST['teamLeaderResponsiblecol5'];
    $teamMemberscol5 = $_POST['teamMemberscol5'];

    $auditAreacol6 = $_POST['auditAreacol6'];
    $auditeeResponsiblecol6 = $_POST['auditeeResponsiblecol6'];
    $auditScopecol6 = $_POST['auditScopecol6'];
    $periodOfAuditcol6 = $_POST['periodOfAuditcol6'];
    $teamLeaderResponsiblecol6 = $_POST['teamLeaderResponsiblecol6'];
    $teamMemberscol6 = $_POST['teamMemberscol6'];

    $date = date('d-m-Y', strtotime($_POST['date']));

    // Prepare SQL statement for insertion
    $sql = "INSERT INTO $table 
            VALUES ($id,'$auditAreacol1', '$auditeeResponsiblecol1', '$auditScopecol1', '$periodOfAuditcol1', '$teamLeaderResponsiblecol1', '$teamMemberscol1', '$auditAreacol2', '$auditeeResponsiblecol2', '$auditScopecol2', '$periodOfAuditcol2', '$teamLeaderResponsiblecol2', '$teamMemberscol2', '$auditAreacol3', '$auditeeResponsiblecol3', '$auditScopecol3', '$periodOfAuditcol3', '$teamLeaderResponsiblecol3', '$teamMemberscol3', '$auditAreacol4', '$auditeeResponsiblecol4', '$auditScopecol4', '$periodOfAuditcol4', '$teamLeaderResponsiblecol4', '$teamMemberscol4', '$auditAreacol5', '$auditeeResponsiblecol5', '$auditScopecol5', '$periodOfAuditcol5', '$teamLeaderResponsiblecol5', '$teamMemberscol5', '$auditAreacol6', '$auditeeResponsiblecol6', '$auditScopecol6', '$periodOfAuditcol6', '$teamLeaderResponsiblecol6', '$teamMemberscol6', '$date')";
//echo $sql;
    $stmt = $dbo->prepare($sql);

    // Execute SQL statement
    if ($stmt->execute()) {
        $insert = true;
		echo "INSERTED...";
    } else {
        $error_message = "Error occurred while inserting data into the database."; // This message will be used for alert popup
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
                    <td><input type="text" id="auditArea" name="auditAreacol1" ></td>
                    <td><input type="text" id="auditeeResponsible" name="auditeeResponsiblecol1" ></td>
                    <td><input type="text" id="auditScope" name="auditScopecol1" ></td>
                    <td><input type="text" id="periodOfAudit" name="periodOfAuditcol1" ></td>
                    <td><input type="text" id="teamLeaderResponsible" name="teamLeaderResponsiblecol1" ></td>
                    <td><input type="text" id="teamMembers" name="teamMemberscol1" ></td>
                </tr>
                <tr>
                    <td><input type="text" id="auditArea" name="auditAreacol2" ></td>
                    <td><input type="text" id="auditeeResponsible" name="auditeeResponsiblecol2" ></td>
                    <td><input type="text" id="auditScope" name="auditScopecol2" ></td>
                    <td><input type="text" id="periodOfAudit" name="periodOfAuditcol2" ></td>
                    <td><input type="text" id="teamLeaderResponsible" name="teamLeaderResponsiblecol2" ></td>
                    <td><input type="text" id="teamMembers" name="teamMemberscol2" ></td>
                </tr>
                <tr>
                    <td><input type="text" id="auditArea" name="auditAreacol3" ></td>
                    <td><input type="text" id="auditeeResponsible" name="auditeeResponsiblecol3" ></td>
                    <td><input type="text" id="auditScope" name="auditScopecol3" ></td>
                    <td><input type="text" id="periodOfAudit" name="periodOfAuditcol3" ></td>
                    <td><input type="text" id="teamLeaderResponsible" name="teamLeaderResponsiblecol3" ></td>
                    <td><input type="text" id="teamMembers" name="teamMemberscol3" ></td>
                </tr>
                <tr>
                    <td><input type="text" id="auditArea" name="auditAreacol4" ></td>
                    <td><input type="text" id="auditeeResponsible" name="auditeeResponsiblecol4" ></td>
                    <td><input type="text" id="auditScope" name="auditScopecol4" ></td>
                    <td><input type="text" id="periodOfAudit" name="periodOfAuditcol4" ></td>
                    <td><input type="text" id="teamLeaderResponsible" name="teamLeaderResponsiblecol4" ></td>
                    <td><input type="text" id="teamMembers" name="teamMemberscol4" ></td>
                </tr>
                <tr>
                    <td><input type="text" id="auditArea" name="auditAreacol5" ></td>
                    <td><input type="text" id="auditeeResponsible" name="auditeeResponsiblecol5" ></td>
                    <td><input type="text" id="auditScope" name="auditScopecol5" ></td>
                    <td><input type="text" id="periodOfAudit" name="periodOfAuditcol5" ></td>
                    <td><input type="text" id="teamLeaderResponsible" name="teamLeaderResponsiblecol5" ></td>
                    <td><input type="text" id="teamMembers" name="teamMemberscol5" ></td>
                </tr>
                <tr>
                    <td><input type="text" id="auditArea" name="auditAreacol6" ></td>
                    <td><input type="text" id="auditeeResponsible" name="auditeeResponsiblecol6" ></td>
                    <td><input type="text" id="auditScope" name="auditScopecol6" ></td>
                    <td><input type="text" id="periodOfAudit" name="periodOfAuditcol6" ></td>
                    <td><input type="text" id="teamLeaderResponsible" name="teamLeaderResponsiblecol6" ></td>
                    <td><input type="text" id="teamMembers" name="teamMemberscol6" ></td>
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
