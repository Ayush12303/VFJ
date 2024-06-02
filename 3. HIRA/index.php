<?php
//hazard identification adn risk assessment form 
// Set error reporting level
error_reporting(E_ALL & ~E_NOTICE);
ini_set('display_errors', 0);

$insert = false;
$error_message = "";

// Check if form is submitted
if (isset($_POST['submit'])) {
    // Include database connection
    include_once("../../informixConnect_ppc.php");

    $table = "hira";
    // Check for database connection
    if (!$dbo) {
        die("Connection to the Informix database failed.");
//		 die("Connection to the Informix database failed due to ". mysqli_connect_error());
    }

    $rowCountStmt = $dbo->prepare("SELECT COUNT(*) as count FROM $table");
    $rowCountStmt->execute();
    $rowCountResult = $rowCountStmt->fetch(PDO::FETCH_ASSOC);
    $id = $rowCountResult['count'] + 1;
    // Collect form data
    $activity = $_POST['activity'];
    $hazard = $_POST['hazard'];
    $risks = $_POST['risks'];
    $s = $_POST['s'];
    $c = $_POST['c'];
    $p = $_POST['p'];
    $risk_rating = $_POST['risk_rating'];
    $significant = $_POST['significant'];
    $action_plan = $_POST['action_plan'];
    $review_control = $_POST['review_control'];
    $issue_number = $_POST['issue_number'];
    $issue_date = date('d-m-Y', strtotime($_POST['issue_date']));
    $revision_number = $_POST['revision_number'];
    //$revision_date = date(Ymd);
	$revision_date =date('d-m-Y', strtotime($_POST['revision_date']));
	//echo "DATE".$revision_date;

    // Prepare SQL statement for insertion
    $sql = "INSERT INTO $table
            VALUES ($id, '$activity', '$hazard', '$risks', $s, $c, $p, $risk_rating, '$significant', '$action_plan', '$review_control', $issue_number, '$issue_date', $revision_number, '$revision_date')";
//echo $sql;
    // Execute SQL statement
    $stmt = $dbo->prepare($sql);
    if ($stmt->execute()) {
        $insert = true;
		echo "Successfully inserted one record!!";
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
    <title>Hazard Identification & Risk Assessment Form</title>
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
            margin-bottom: 30px;
        }
        h3 {
            margin-top: 20px;
            margin-bottom: 10px;
        }
        section {
            margin-top: 20px;
            border-top: 1px solid #ccc;
            padding-top: 20px;
            position: relative;
        }
        .section-divider {
            position: absolute;
            top: 0;
            bottom: 0;
            left: 50%;
            width: 2px;
            background-color: #ccc;
        }
        .flex-container {
            display: flex;
            margin-bottom: 20px;
        }
        .flex-container > div {
            flex: 1;
            margin-right: 10px;
        }
        label {
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
        }
        input[type="text"],
        input[type="number"],
        input[type="date"] {
            width: calc(100% - 22px);
            padding: 7px;
            margin-bottom: 10px;
            border: 1px solid #878686;
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
            margin-top: 20px;
            font-size: 16px;
        }
        button[type="submit"]:hover,
        button[type="button"]:hover {
            background-color: #45a049;
        }
        button#print-button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-top: 20px;
            font-size: 16px;
        }
        button#print-button:hover {
            background-color: #45a049;
        }
        ul {
            list-style-type: none;
            padding-left: 0;
        }
        li {
            margin-bottom: 5px;
        }
        .button-container {
            text-align: center;
            margin-top: 20px;
        }
        .button-container button {
            margin-right: 10px;
        }

    </style>
</head>
<body>

<div class="container">
    <h2>Hazard Identification & Risk Assessment (HIRA)</h2>

    <section>
        <h3>Department/Function</h3>
        <div class="flex-container">
            <div>
                <h3>Factors</h3>
                <ul>
                    <li><strong>Severity - S:</strong></li>
                    <li><strong>Consequences - C:</strong></li>
                    <li><strong>Point of likelihood - P:</strong></li>
                </ul>
            </div>
            <div>
                <h3>Rating Scale</h3>
                <ul>
                    <li>Low: 5,</li>
                    <li> Medium: 10,</li>
                    <li> High: 30,</li>
                    <li>Likely: 10, Unlikely: 5</li>
                </ul>
            </div>
            <div>
                <h3>Risk Rating</h3>
                <ul>
                    <li>Risk Rating is multiplication of all factors (S x C x P)</li>
                    <li>S - Significant above 5000</li>
                    <li>M - Medium above 500</li>
                    <li>L - Low below 500</li>
                    <li>V - Very low below 130</li>
                </ul>
            </div>
        </div>
    </section>

    <section>
        <h3>SECTION</h3>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div>
                <label for="activity">Activity:</label>
                <input type="text" id="activity" name="activity" >
            </div>
            <div>
                <label for="hazard">Hazard:</label>
                <input type="text" id="hazard" name="hazard" >
            </div>
            <div>
                <label for="risks">Risks:</label>
                <input type="text" id="risks" name="risks" >
            </div>
            <div class="flex-container">
                <div>
                    <label for="s">S (Severity):</label>
                    <input type="number" id="s" name="s" >
                </div>
                <div>
                    <label for="c">C (Consequences):</label>
                    <input type="number" id="c" name="c" >
                </div>
                <div>
                    <label for="p">P (Point of likelihood):</label>
                    <input type="number" id="p" name="p" >
                </div>
            </div>
            <div>
                <label for="risk_rating">Risk Rating: (SXPXC)</label>
                <input type="text" id="risk_rating" name="risk_rating" >
            </div>
            <div>
                <label for="significant">Significant Of any:</label>
                <input type="text" id="significant" name="significant" >
            </div>
            <div>
                <label for="action_plan">Action plan for Controlling Significant:</label>
                <input type="text" id="action_plan" name="action_plan" >
            </div>
            <div>
                <label for="review_control">Review of adequacy of Controlling:</label>
                <input type="text" id="review_control" name="review_control" >
            </div>

            <div style="display: flex;">
                <div style="flex: 1;">
                    <h4>Prepared and Issued by</h4>
                    <h4>JWM/HOS:</h4> <br>
                    <div>
                        <label for="issue_number">Issue Number:</label>
                        <input type="text" id="issue_number" name="issue_number" >
                    </div>
                    <div>
                        <label for="issue_date">Issue Date:</label>
                        <input type="date" id="issue_date" name="issue_date" >
                    </div>
                </div>
                <div style="flex: 1;">
                    <h4>Approved by</h4>
                    <h4>DO/GO:</h4> <br>
                    <div>
                        <label for="revision_number">Revision Number:</label>
                        <input type="text" id="revision_number" name="revision_number" >
                    </div>
                    <div>
                        <label for="revision_date">Revision Date:</label>
                        <input type="date" id="revision_date" name="revision_date" >
                    </div>
                </div>
            </div>

            <div class="button-container">
                <button type="submit" name="submit">Submit</button>
                <button id="print-button" onclick="window.print()">Print</button>
            </div>
        </form>
    </section>

</div>

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
    document.getElementById('revision_date').value = getCurrentDate();
</script>

</body>
</html>
