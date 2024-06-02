<?php
error_reporting(E_ALL & ~E_NOTICE);
ini_set('display_errors', 0);

$insert = false;
$error_message = "";

if (isset($_POST['submit'])) {
    include_once("../../informixConnect_ppc.php");

    $table = "training_report"; // Adjust table name as needed

    if (!$dbo) {
        die("Connection to the Informix database failed.");
    }

    $name = $_POST['Name'];
    $designation = $_POST['Designation'];
    $personalNo = $_POST['PersonalNo'];
    $instituteName = $_POST['NameOfInstitute'];
    $trainingPeriod = $_POST['PeriodOfTraining'];
    $trainingType = $_POST['TypeOfTraining'];
    $qualification = $_POST['Qualification'];
    $trainingEvent = $_POST['TrainingSeminarWorkshop'];
    $topicsCovered = $_POST['TopicsCovered'];
    $topicsAssimilated = $_POST['TopicsAssimilated'];
    $faculties = $_POST['Faculties'];
    $useful = $_POST['WhetherTrainingUseful'];
    $objective = $_POST['ObjectiveToAttend'];
    $objectivesMet = $_POST['WhetherObjectivesMet'];
    $knowledgeImproved = $_POST['ImprovedKnowledge'];
    $useInWork = $_POST['UseInWork'];
    $noWhy = $_POST['NoWhy'];
    $repeatCourses = $_POST['RepeatCourses'];
    $graduationLevel = $_POST['GraduationLevel'];
    $suggestionRemark = $_POST['SuggestionRemark'];
    //$date = $_POST['date'];
	$date=date(dmy);

    $sql = "INSERT INTO $table (name, designation, personalNo, instituteName, trainingPeriod, trainingType, qualification, trainingEvent, topicsCovered, topicsAssimilated, faculties, useful, objective, objectivesMet, knowledgeImproved, useInWork, noWhy, repeatCourses, graduationLevel, suggestionRemark, date) 
            VALUES ('$name', '$designation', '$personalNo', '$instituteName', '$trainingPeriod', '$trainingType', '$qualification', '$trainingEvent', '$topicsCovered', '$topicsAssimilated', '$faculties', '$useful', '$objective', '$objectivesMet', '$knowledgeImproved', '$useInWork', '$noWhy', '$repeatCourses', '$graduationLevel', '$suggestionRemark', '$date')";
//echo $sql;
    $stmt = $dbo->prepare($sql);

    if ($stmt->execute()) {
        $insert = true;
		echo "Data Inserted Successfully!!!!!";
    } else {
        $error_message = "Error occurred while inserting data into the database.";
    }

    $dbo = null;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Training Report Form</title>
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
        h2, h5 {
            text-align: center;
        }
        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }
        input[type="text"], input[type="number"], input[type="date"], textarea {
            width: calc(100% - 22px);
            padding: 7px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
        }
        input[type="radio"] {
            margin-right: 5px;
            margin-bottom: 10px;
        }
        button[type="submit"], button[type="button"] {
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
        button[type="submit"]:hover, button[type="button"]:hover {
            background-color: #45a049;
        }
        .signatures {
            text-align: center;
            margin-top: 20px;
        }
        .signatures h5 {
            display: inline-block;
            margin: 0 20px;
        }
        .flex-container {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }
        .flex-container > div {
            width: 48%; /* Adjust the width as needed */
        }
        .page-break {
            page-break-before: always;
        }

        @media print {
            body {
                padding: 0;
            }
            .container {
                box-shadow: none;
                padding: 0;
                border: none;
                margin: 0;
                width: 100%;
            }
            input[type="text"], input[type="number"], input[type="date"], textarea {
                width: 100%;
            }
            .flex-container > div {
                width: 100%;
            }
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
            background-color: rgba(0,0,0,0.4);
        }
        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);
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
            from {opacity: 0;}
            to {opacity: 1;}
        }
    </style>
</head>
<body>

<div class="container">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <h2>TRAINING REPORT</h2>
		<h2> (TO BE FILLED BY TRAINEE)</h2>
		<br>
        <div>
            <label for="Name">(1) Name:</label>
            <input type="text" id="name" name="Name" required>
        </div>
        <div class="flex-container">
            <div>
                <label for="Designation">(2) Designation:</label>
                <input type="text" id="designation" name="Designation" required>
            </div>
            <div>
                <label for="PersonalNo">(3) Personal No.:</label>
                <input type="number" id="personal_no" name="PersonalNo" required>
            </div>
        </div>
		<div>
            <label for="NameOfInstitute">(4) Name of Institute:</label>
            <input type="text" id="institute_name" name="NameOfInstitute" required>
        </div>
		<div>
			<label for="PeriodOfTraining">(5) Period of Training:</label>
			<input type="text" id="training_period" name="PeriodOfTraining" required>
		</div>
		<div class="flex-container">
			<div>
				<label for="TypeOfTraining">(6) Type of Training:</label>
				<input type="text" id="training_type" name="TypeOfTraining" required>
			</div>
			<div>
				<label for="Qualification">(7) Qualification:</label>
				<input type="text" id="qualification" name="Qualification" required>
			</div>
		</div>
        <div>
            <label for="TrainingSeminarWorkshop">(8) Training/Seminar/Workshop:</label>
            <input type="text" id="training_event" name="TrainingSeminarWorkshop" required>
        </div>
        <div>
            <label for="TopicsCovered">(9) Topics Covered:</label>
            <input type="text" id="topics_covered" name="TopicsCovered" required>
        </div>
        <div>
            <label for="TopicsAssimilated">(10) Topics Assimilated:</label>
            <input type="text" id="topics_assimilated" name="TopicsAssimilated" required>
        </div>
		<div class="flex-container">
			<div>
				<label for="Faculties">(11) Faculties:</label>
				<input type="text" id="faculties" name="Faculties" required>
			</div>
			<div>
				<label for="WhetherTrainingUseful">(12) Whether the training was useful (Yes/No):</label><br>
				<input type="radio" id="useful_yes" name="WhetherTrainingUseful" value="Yes" required> Yes
				<input type="radio" id="useful_no" name="WhetherTrainingUseful" value="No" required> No
			</div>
		</div>
        <div class="page-break"></div> <!-- Page break before this section -->
        <div>
            <label for="ObjectiveToAttend">(13) Objective to attend this training:</label>
            <input type="text" id="objective" name="ObjectiveToAttend" required>
        </div>
        <div>
            <label for="WhetherObjectivesMet">(14) Whether the objectives were met:</label>
            <input type="text" id="objectives_met" name="WhetherObjectivesMet" required>
        </div>
		<div class="flex-container" style="margin-bottom: 2rem">
			<div>
				<label for="ImprovedKnowledge">(15) Whether training has improved your knowledge (Yes/No):</label><br>
				<input type="radio" id="knowledge_yes" name="ImprovedKnowledge" value="Yes" required> Yes
				<input type="radio" id="knowledge_no" name="ImprovedKnowledge" value="No" required> No
			</div>
			<div>
				<label for="UseInWork">(16) If yes, will you be able to use it in your work? (Yes/No):</label><br>
				<input type="radio" id="use_in_work_yes" name="UseInWork" value="Yes" required> Yes
				<input type="radio" id="use_in_work_no" name="UseInWork" value="No" required> No
			</div>
		</div>
		<div class="flex-container" >
			<div>
				<label for="NoWhy">(17) If no, why? (Yes/No):</label><br>
				<input type="radio" id="no_why_yes" name="NoWhy" value="Yes" required> Yes
				<input type="radio" id="no_why_no" name="NoWhy" value="No" required> No
			</div>
			<div>
				<label for="RepeatCourses">(18) Should this type of courses be repeated, if yes, for what categories and why?:</label>
				<input type="text" id="repeat_courses" name="RepeatCourses" required>
			</div>
		</div>
        <div style="margin-bottom: 2rem">
            <label for="GraduationLevel">(19) Graduation level of training as per your view:</label><br>
            <input type="radio" id="graduation_excellent" name="GraduationLevel" value="Excellent" required> Excellent
            <input type="radio" id="graduation_very_good" name="GraduationLevel" value="Very good" required> Very good
            <input type="radio" id="graduation_good" name="GraduationLevel" value="Good" required> Good
            <input type="radio" id="graduation_bad" name="GraduationLevel" value="Bad" required> Bad
        </div>
        <div>
            <label for="SuggestionRemark">(20) Suggestion Remark:</label>
            <textarea id="suggestion_remark" name="SuggestionRemark" rows="4" required></textarea>
        </div>
        <div>
            <label for="date">Date:</label>
            <input type="date" id="date_of_birth" name="date" required>
        </div>
		<div class="signatures">
            <h5>Signature of trainee (Reverse)</h5>
			<h5></h5>
            <h5>Remark of training officer</h5>
			<h5></h5>
			<h5></h5>
            <h5>Training Officer Signature</h5>
        </div>
        <div style="text-align: center;">
            <button type="submit" name="submit">Submit</button>
            <button type="button" onclick="printForm()">Print</button>
        </div>
    </form>
</div>

<div id="myModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <p id="error-message">
            <!-- Error messages will be displayed here -->
        </p>
    </div>
</div>

<script>
    function validateForm() {
        var name = document.getElementById("name").value;
        var designation = document.getElementById("designation").value;
        var personalNo = document.getElementById("personal_no").value;

        var errorMessage = "";

        if (name === "") {
            errorMessage += "Name is required.\n";
        }
        if (designation === "") {
            errorMessage += "Designation is required.\n";
        }
        if (personalNo === "") {
            errorMessage += "Personal No. is required.\n";
        }

        if (errorMessage !== "") {
            document.getElementById("error-message").innerText = errorMessage;
            var modal = document.getElementById('myModal');
            modal.style.display = 'block';
            return false;
        }

        return true;
    }

    function printForm() {
        // Apply styles for printing
        var style = document.createElement('style');
        style.innerHTML = `
            body * {
                visibility: hidden;
            }
            .container, .container * {
                visibility: visible;
            }
            .container {
                position: absolute;
                left: 0;
                top: 0;
            }
        `;
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

</body>
</html>
