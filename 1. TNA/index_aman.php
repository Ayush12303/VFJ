<?php
error_reporting(E_ALL & ~E_NOTICE);
ini_set('display_errors', 0);

$insert = false;
$error_message = "";

if (isset($_POST['submit'])) {
    include_once("../../informixConnect_ppc.php");

    $table = "training_need"; // Adjust table name as needed

    if (!$dbo) {
        die("Connection to the Informix database failed.");
    }

    // Function to get the next ID based on row count
    function getNextID($dbo, $table) {
        $rowCountStmt = $dbo->prepare("SELECT COUNT(*) as count FROM $table");
        $rowCountStmt->execute();
        $rowCountResult = $rowCountStmt->fetch(PDO::FETCH_ASSOC);
        return $rowCountResult['count'] + 1;
    }

    // Collect post variables
    $id = getNextID($dbo, $table);
    $name = $_POST['Name'];
    $personalNo = $_POST['PersonalNo'];
    $designation = $_POST['Designation'];
    $dateOfBirth = date('d-m-Y', strtotime($_POST['DateOfBirth'])); // Format date to match Informix format
    $section = $_POST['Section'];
    $dateOfJoiningService = date('d-m-Y', strtotime($_POST['DateOfJoiningService'])); // Format date to match Informix format
    $qualification = $_POST['Qualification'];
    $natureOfPresentJob = $_POST['NatureOfPresentJob'];
    $course1 = $_POST['Course1'];
    $course2 = $_POST['Course2'];
    $course3 = $_POST['Course3'];
    $trainingArea1 = $_POST['TrainingArea1'];
    $trainingArea2 = $_POST['TrainingArea2'];
    $trainingArea3 = $_POST['TrainingArea3'];
    $knowledgeImprove = $_POST['KnowledgeImprove'];
    $technologyDevelopments = $_POST['TechnologyDevelopments'];
    $selfDevelopments = $_POST['SelfDevelopments'];
    $futureAssignments = $_POST['FutureAssignments'];
    //$recommendation1 = $_POST['Recommendation1'];
    //$recommendation2 = $_POST['Recommendation2'];
    //$recommendation3 = $_POST['Recommendation3'];
    //$recommendation4 = $_POST['Recommendation4'];
    //$recommendation5 = $_POST['Recommendation5'];
    //$recommendation6 = $_POST['Recommendation6'];

    // Prepare SQL statement for insertion
    $sql = "INSERT INTO $table 
            VALUES ($id, '$name', $personalNo, '$designation', '$dateOfBirth', '$section', '$dateOfJoiningService', '$qualification', '$natureOfPresentJob', '$course1', '$course2', '$course3', '$trainingArea1', '$trainingArea2', '$trainingArea3', '$knowledgeImprove', '$technologyDevelopments', '$selfDevelopments', '$futureAssignments')";

    // Execute SQL statement
    $stmt = $dbo->prepare($sql);

    if ($stmt->execute()) {
        $insert = true;
        echo "Inserted Successfully";
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
    <title>Training Need Assessment Form</title>
    <link rel="stylesheet" href="style/tna_style.css">
    <link rel = "icon" href = "images/logovfj.png" type ="image/x-icon">
</head>
<body>
    <div class="container">
        <h2>TRAINING NEED ASSESSMENT FORM</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div>
                <label for="name">Name of personnel recommended:</label>
                <input type="text" id="name" name="Name" >
            </div>
            <div>
                <label for="personnel_no">Personnel No./T No.:</label>
                <input type="number" id="personnel_no" name="PersonalNo" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="10">
            </div>
			<div class="flex-container">
            <div>
                <label for="designation">Designation:</label>
                <input type="text" id="designation" name="Designation" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="254"  >
            </div>
            <div>
                <label for="section">Section:</label>
                <input type="text" id="section" name="Section" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="254" >
            </div>
			</div>
			
			<div class="flex-container">
            <div>
                <label for="dob">Date of Birth:</label>
                <input type="date" id="dob" name="DateOfBirth" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="254" >
            </div>
            <div>
                <label for="joining_date">Date of joining Service:</label>
                <input type="date" id="joining_date" name="DateOfJoiningService" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="254" >
            </div>
			</div>
            <div>
                <label for="qualification">Qualification:</label>
                <input type="text" id="qualification" name="Qualification" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="254" >
            </div>
            <div>
                <label for="nature_of_job">Nature of present job:</label>
                <input type="text" id="nature_of_job" name="NatureOfPresentJob"  oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="254" >
            </div>
            <h4>(9) Training course attended during last 3 years:</h4>
            <div class="flex-container">
			<div>
                <label for="course1">i.</label>
                <textarea id="course1" name="Course1" rows="5"   oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="254" ></textarea>
            </div>
            <div>
                <label for="course2">ii.</label>
                <textarea id="course2" name="Course2" rows="5"   oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="254" ></textarea>
            </div>
            <div>
                <label for="course3">iii.</label>
                <textarea id="course3" name="Course3" rows="5"   oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="254" ></textarea>
            </div>
			</div>
            <h4>(10) Areas in which individual should to be trained:</h4>
			<div class="flex-container">
            <div>
                <label for="area1">i.</label>
                <textarea id="area1" name="TrainingArea1" rows="5"   oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="254" ></textarea>
            </div>
            <div>
                <label for="area2">ii.</label>
                <textarea id="area2" name="TrainingArea2" rows="5"   oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="254" ></textarea>
            </div>
            <div>
                <label for="area3">iii.</label>
                <textarea id="area3" name="TrainingArea3" rows="5"   oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="254" ></textarea>
            </div>
			</div>
            <h4>(11) The course will serve the purpose of improving:</h4>
            <div class="radio-group">
            <label>i. Present working knowledge (Yes/No):</label>
            <input type="radio" name="KnowledgeImprove" value="Yes">
            <label for="knowledge_improve_yes">Yes</label>
            <input type="radio" name="KnowledgeImprove" value="No">
            <label for="knowledge_improve_no">No</label>
        </div>
        <div class="radio-group">
            <label>ii. New technology developments (Yes/No):</label>
            <input type="radio" name="TechnologyDevelopments" value="Yes">
            <label for="technology_developments_yes">Yes</label>
            <input type="radio" name="TechnologyDevelopments" value="No">
            <label for="technology_developments_no">No</label>
        </div>
        <div class="radio-group">
            <label>iii. Self developments (Yes/No):</label>
            <input type="radio" name="SelfDevelopments" value="Yes">
            <label for="self_developments_yes">Yes</label>
            <input type="radio" name="SelfDevelopments" value="No">
            <label for="self_developments_no">No</label>
        </div>
        <div class="radio-group">
            <label>iv. Future assignments (Yes/No):</label>
            <input type="radio" name="FutureAssignments" value="Yes">
            <label for="future_assignments_yes">Yes</label>
            <input type="radio" name="FutureAssignments" value="No">
            <label for="future_assignments_no">No</label>
        </div>
		<br>
		<div  style="text-align: right;">
                <h4>(Signature of reporting officer)</h4>
                
        </div>
		<br><br>
		<h4>(12) Select Recommending Officer (DO/GO/Concerned Section)</h4>
         <?php
		$qry_stmt="select pmt_per_no, pmt_name from eadmin:pis_mstr_table where pmt_emp_type='4' order by pmt_name";
		echo $qry_stmt;
		$stmt = $dbo->prepare($qry_stmt);
		if ($stmt->execute()) {
          } else {
        $error_message = "Error occurred while selecting the data."; // This message will be used for alert popup
    }
		
		 ?>		
		<select id="do" name="do" >
		<option value=''>Select</option>
		<option value=''>NA</option>
		<?php while($rows = $stmt->fetch(PDO::FETCH_OBJ))
		{
			?>		   
		<option value='<?php echo $rows->PMT_PER_NO?>' <?php if($do==$rows->PMT_PER_NO) echo 'selected'?>><?php echo $rows->PMT_NAME?></option>
		<?php
		}
		?>
</select>


		<h4>(13) Select Recommending Officer of Trg Officer</h4>
		
            <div style="display:flex;">
                <div>
                    <button type="submit" name="submit">Submit</button>
                </div>
                <div>
                    <button type="button" onclick="printForm()">Print</button>
                </div>
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
            var personalNo = document.getElementById("personnel_no").value;

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
