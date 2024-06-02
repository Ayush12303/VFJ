<?php
$insert = false;
// INTERNAL IMS_Audit_Report
// Check if form is submitted
if (isset($_POST['submit'])) {
    // Set connection parameters for Informix server
    include_once("../../informixConnect_ppc.php"); // PERMANENT - DON'T CHANGE

    $table = "ims_report"; // Specify the table name in your database 

    // Check for connection success
    if (!$dbo) {
        die("Connection to the Informix database failed due to " . mysqli_connect_error());
    }
    
    $rowCountStmt = $dbo->prepare("SELECT COUNT(*) as count FROM $table");
    $rowCountStmt->execute();
    $rowCountResult = $rowCountStmt->fetch(PDO::FETCH_ASSOC);
    $id = $rowCountResult['count'] + 1;

    // Collect post variables
    $audit_number = $_POST['audit_number'];
    $audit_date = date('d-m-Y', strtotime($_POST['audit_date']));
    $section = $_POST['section'];
    $team_leader = $_POST['team_leader'];
    $team_member1 = $_POST['team_member1'];
    $team_member2 = $_POST['team_member2'];
    $team_member3 = $_POST['team_member3'];
    $team_member4 = $_POST['team_member4'];
    $team_member5 = $_POST['team_member5'];
    $team_member6 = $_POST['team_member6'];
    $team_member7 = $_POST['team_member7'];
    $team_member8 = $_POST['team_member8'];
    $auditee_rep1 = $_POST['auditee_rep1'];
    $auditee_rep2 = $_POST['auditee_rep2'];
    $auditee_rep3 = $_POST['auditee_rep3'];
    $auditee_rep4 = $_POST['auditee_rep4'];
    $audited_areas = $_POST['audited_areas'];
    $summary_result = $_POST['summary_result'];
    $audit_notes = $_POST['audit_notes'];
    $audit_leader = $_POST['audit_leader'];
    $audit_date_sign = date('d-m-Y', strtotime($_POST['audit_date_sign']));
    $distribution = $_POST['distribution'];

    // Prepare SQL statement for insertion
    $sql = "INSERT INTO $table 
            VALUES ($id, $audit_number, $audit_date, '$section', '$team_leader', '$team_member1', '$team_member2', '$team_member3', '$team_member4', '$team_member5', '$team_member6', '$team_member7', '$team_member8', '$auditee_rep1', '$auditee_rep2', '$auditee_rep3', '$auditee_rep4', '$audited_areas', '$summary_result', '$audit_notes', '$audit_leader', '$audit_date_sign', '$distribution')";

    $stmt = $dbo->prepare($sql);

    // Execute SQL statement
    if ($stmt->execute()) {
        $insert = true;
		echo "inserted successfully......";
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
    <title>INTERNAL IMS_Audit_Report </title>
    <link rel = "icon" href = "images/logovfj.png" type ="image/x-icon">
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 16px;
            background-color: #f0f0f0;
            margin: 0;
            padding: 20px;
        }
        
        h2 {
            text-align: center;
        }
        
        .container {
            display: flex;
            /* margin: 10px; */
            gap: 4rem;
        }
        
        .container > div {
            width: 48%; /* Adjust the width as needed */
        }

        .input {
            width: 100%;
            border: none;
            padding: 10px;
        }
        
        form {
            max-width: 800px;
            margin: 50px auto 0;
            background-color: #fff;
            padding: 30px;
            border: 2px solid grey;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        
        input[type="text"],
        input[type="number"],
        input[type="date"],
        textarea {
            width: calc(100% - 22px);
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
        
        .flex-container {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }
        
        .flex-container > div {
            width: 48%;
        }
        
        .page-break {
            page-break-before: always;
        }
        
        /* Modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }
        
        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            animation-name: modalopen;
            animation-duration: 0.4s;
        }
        
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
        
        @keyframes modalopen {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
        
        @media print {
            body {
                padding: 0;
            }
            form {
                box-shadow: none;
                padding: 0;
                border: none;
                margin: 0;
                width: 100%;
            }
            input[type="text"],
            input[type="number"],
            input[type="date"],
            textarea {
                width: 100%;
            }
            .flex-container > div {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <h2>VEHICLE FACTORY JABALPUR</h2>
        <hr>

        <h4>INTERNAL IMS Audit Report Number:</h4> <input type="number" name="audit_number">
        <div class="container">
        <div>
        <h4>Plant/Concerned Section:</h4><input type="text" name="section">
        </div>
        <div>
        <h4>Date:</h4><input type="date" name="audit_date">
        </div>
        </div>
        <hr>
        <div class="container">
            <div>
                <h4>Audit Team Leader:</h4><br>
                Team Leader Name: <input type="text" name="team_leader"><br>
                Member: <input type="text" name="team_member1"><br>
                Member: <input type="text" name="team_member2"><br>
            </div>
            <div> <h4>Designations:</h4>
                <ol>
                    <li><input type="text" name="team_member3">
                    <li><input type="text" name="team_member4">
                    <li><input type="text" name="team_member5">
                    <li><input type="text" name="team_member6">
                    <li><input type="text" name="team_member7">
                    <li><input type="text" name="team_member8">
                </ol>
            </div>
        </div>
        <hr>
         <h4>Representatives from Auditee:</h4>
        <ol>
            <div class="container">
            <div>
                <li><input type="text" name="auditee_rep1">
                <li><input type="text" name="auditee_rep2">
            </div>
            <div>
                <li><input type="text" name="auditee_rep3">
                <li><input type="text" name="auditee_rep4">
            </div>
        </div>
        </ol>
         <h4>Audited Areas:</h4><textarea name="audited_areas"></textarea>
         <h4>Summary of Result:</h4><textarea name="summary_result"></textarea><br>
        <u><h3>IMS(ISO 9001:2015, ISO 14001:2015 & 45001:2018) Clause No. of NCR's </h3></u><br>
        <h4> <h4>Audit Notes (if any):</h4> </h4><textarea name="audit_notes"></textarea><br><br>
        <div>
            <h3>Signature</h3> 
        </div><br><br>
         <h4>Audit Leader:</h4><input type="text" name="audit_leader"><br>
         <h4>Date:</h4><input type="date" name="audit_date_sign" id="audit_sign_date"><br>
        <h4>Distribution:</h4> <input type="text" name="distribution"><br>
        <button type="submit" name="submit">Submit</button>
        <button type="button" onclick="printForm()" class="btn">Print</button>
    </form>

    <script>
        function printForm() {
            var style = document.createElement('style');
            style.innerHTML = `
                @media print {
                    body {
                        visibility: hidden;
                    }
                    form, form * {
                        visibility: visible;
                    }
                    form {
                        position: absolute;
                        left: 0;
                        top: 0;
                    }
                }
            `;
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
        document.getElementById('audit_sign_date').value = getCurrentDate();
    </script>
</body>
</html>
