<?php
error_reporting(E_ALL & ~E_NOTICE);
ini_set('display_errors', 0);

$insert = false;
$error_message = "";

if (isset($_POST['submit'])) {
    include_once("../../informixConnect_ppc.php");

    $table = "non_conformance_report"; // Adjust table name as needed

    if (!$dbo) {
        die("Connection to the Informix database failed.");
    }

    // Function to get the next ID based on row count
    $rowCountStmt = $dbo->prepare("SELECT COUNT(*) as count FROM $table");
    $rowCountStmt->execute();
    $rowCountResult = $rowCountStmt->fetch(PDO::FETCH_ASSOC);
    

    $id = $rowCountResult['count'] + 1;
    $nonConformanceReport = $_POST['nonConformanceReport'];
    $concernedSection = $_POST['Concerned_section'];
    $department = $_POST['department'];
    $audited = $_POST['audited'];
    $auditor = $_POST['auditor'];
    $audited_date = date('d-m-Y', strtotime($_POST['audited_date']));
    $nonConformityAgainstISOnumber = $_POST['nonConformityAgainstISOnumber'];
    $nonConformityAgainstIMSnumber = $_POST['nonConformityAgainstIMSnumber'];
    $paragraphNo = $_POST['paragraphNo'];
    $category = isset($_POST['category']) ? implode(",", $_POST['category']) : "";
    $nameOfAuditor1 = $_POST['nameOfAuditor1'];
    $observationAgreedOrNot = $_POST['observationAgreedOrNot'];
    $comments = $_POST['comments'];
    $nameOfAuditee1 = $_POST['nameOfAuditee1'];
    $design1 = $_POST['design1'];
    $date = date('d-m-Y', strtotime($_POST['date2']));

    // Prepare SQL statement for insertion
    $sql = "INSERT INTO $table 
            VALUES ($id, $nonConformanceReport, '$concernedSection', '$department', '$audited', '$auditor', '$audited_date', $nonConformityAgainstISOnumber, $nonConformityAgainstIMsnumber, $paragraphNo, '$category', '$nameOfAuditor1', '$observationAgreedOrNot', '$comments', '$nameOfAuditee1', '$design1', '$date')";
echo $sql;
    // Execute SQL statement
    $stmt = $dbo->prepare($sql);

    /*if ($stmt->execute()) {
        $insert = true;
        echo "Inserted Successfully";
    } else {
        $error_message = "Error occurred while inserting data into the database."; // This message will be used for alert popup
    }
*/
    // Close database connection
    $dbo = null;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Non Conformance Report</title>
    <link rel = "icon" href = "images/logovfj.png" type ="image/x-icon">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 800px;
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
        hr {
            margin-top: 20px;
            border: 0;
            border-top: 2px solid #ccc;
        }
        form {
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input[type="text"],
        .form-group input[type="date"],
        .form-group input[type="number"] {
            width: calc(100% - 22px);
            padding: 7px;
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
            transition: background-color 0.3s ease;
        }
        button[type="submit"]:hover,
        button[type="button"]:hover {
            background-color: #45a049;
        }
        .error-message {
            color: red;
            margin-bottom: 20px;
        }
        .flex-container {
            display: flex;
            margin-bottom: 20px;
        }
        .flex-container > div {
            flex: 1;
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>VEHICLE FACTORY JABALPUR</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            
            <div class="form-group">
                <label for="nonConformanceReport">Non Conformance Report No.</label>
                <input type="number" name="nonConformanceReport">
            </div>

            
            <div class="flex-container">
                <div class="form-group" style="margin-top: 2rem;">
                    <label for="Concerned_section">Plant / Concerned Section</label>
                    <input type="text" name="Concerned_section">
                </div>
                
                <div>
                    <div class="form-group">
                        <label for="department">Department/Section</label>
                        <input type="text" name="department">
                    </div>
                    <div class="form-group">
                        <label for="audited">Audited</label>
                        <input type="text" name="audited">
                    </div>
                </div>
            </div>
            
            <div class="flex-container">
                <div class="form-group">
                    <label for="auditor">Auditor (Name)</label>
                    <input type="text" name="auditor">
                </div>
                <div class="form-group">
                    <label for="audited_date">Audited Date</label>
                    <input type="date" name="audited_date">
                </div>
            </div>
             <br>
            <hr>
            <br><br>
            <div class="form-group">
                <label for="nonConformityAgainstISOnumber">Non-conformity against ISO 9001:2015, ISO 14001:2015 & ISO 54001:2018 CLAUSE No.</label>
                <input type="number" name="nonConformityAgainstISOnumber">
            </div>
            <div class="form-group">
                <label for="nonConformityAgainstIMSnumber">Non-conformity against IMS Manual or IMS Procedure No.</label>
                <input type="number" name="nonConformityAgainstIMSnumber">
            </div>
            <div class="form-group">
                <label for="paragraphNo">Paragraph No.</label>
                <input type="number" name="paragraphNo">
            </div>
            <br>
            <hr>
            <br>
            <div class="form-group">
                <label for="category">Category</label>
                <input type="checkbox" name="category" value="major"> Major
                <input type="checkbox" name="category" value="minor"> Minor
            </div>
            <br><br>
            <div class="flex-container">
                <div class="form-group">
                    <H3>Sign of Auditor</h3>
                </div>
                <div class="form-group">
                    <label for="nameOfAuditor1">Name of Auditor</label>
                    <input type="text" name="nameOfAuditor1">
                </div>
            </div>
            <br><br>
            
            <div class="form-group">
                <label for="observationAgreedOrNot">Observation agreed/Not Agreed</label>
                <input type="text" name="observationAgreedOrNot">
            </div>
            <div class="form-group">
                <label for="comments">Comments/Agreed action with PDC</label>
                <input type="text" name="comments">
            </div>
            
            <br>
            <div class="form-group" style="text-align: right;margin-right: 2rem;" >
                <h4> Sign of Auditee </h4>
            </div>
            <br>
            <div class="form-group">
                <label for="nameOfAuditee1">Name of Auditee</label>
                <input type="text" name="nameOfAuditee1">
            </div>
            <div class="form-group">
                <label for="design1">Design</label>
                <input type="text" name="design1">
            </div>
            <div class="form-group">
                <label for="date2">Date</label>
                <input type="date" name="date2" id="date">
            </div>
            
            <!-- Additional fields go here -->
            <button type="submit" name="submit">Submit</button>
            <button type="button" onclick="printForm()">Print</button>
        </form>
        <div class="error-message" id="error-message"></div>
    </div>

    <script>
        function printForm() {
            // Apply styles for printing
            var style = document.createElement('style');
            style.innerHTML =
                'body, button { display: none; }' +
                'form { max-width: 800px; margin: 0 auto; }' +
                'h2 { text-align: center; border-bottom: 2px solid black; }' +
                'label { width: 30%; text-align: right; font-weight: bold; padding-right: 10px; }' +
                '.input { width: 68%; border: none; padding: 5px; background-color: transparent; }' +
                '.signatures { position: static; margin-top: 40px; }';
            document.head.appendChild(style);

            // Print the form
            window.print();

            // Remove the added styles after printing
            style.remove();
        }

        function closeModal() {
            var modal = document.getElementById('myModal');
            modal.style.display = 'none';
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
