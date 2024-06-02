<?php
$insert=false;

// Check if form is submitted
if(isset($_POST['submit'])){
    // Set connection parameters for Informix server
	include_once("../informixConnect_ppc.php"); //PERMANENT - DONT CHANGE
    
    $table = "ledger"; // Specify the table name in your database 

    // Create connection to Informix server
    //$conn = new PDO("informix:host=$host;database=$database", $username, $password);

    // Check for connection success
    if(!$conn){
        die("Connection to the Informix database failed due to ". mysqli_connect_error());
    }
    echo("Successfully connected to the Informix database");

    // Collect post variables
    $letterNumber=$_POST['letterNumber'];
    $date=$_POST['date'];
    $itemNumber=$_POST['itemNumber'];
    $itemDescriptionShort=$_POST['itemDescriptionShort'];
    $itemDescriptionLong=$_POST['itemDescriptionLong'];
    $quantityOrAccountingUnit=$_POST['quantityOrAccountingUnit'];
    $partNumber=$_POST['partNumber'];
    $drawingNumber=$_POST['drawingNumber'];
    $plantCode=$_POST['plantCode'];
    $MMGCode=$_POST['MMGCode'];
    $godownCode=$_POST['godownCode'];
    $checkForEPCode=$_POST['checkForEPCode'];
    $mainAssemblyOrVehicleName=$_POST['mainAssemblyOrVehicleName'];
    $subAssemblyOrPartName=$_POST['subAssemblyOrPartName'];
    $capitalItem=$_POST['capitalItem'];
    $ledgerFolioNumber=$_POST['ledgerFolioNumber'];
    $description=$_POST['description'];
    $vehicleNumber=$_POST['vehicleNumber'];

    // Prepare SQL statement for insertion
    $sql = "INSERT INTO $table(letterNumber, date, itemNumber, itemDescriptionShort, itemDescriptionLong, quantityOrAccountingUnit, partNumber, drawingNumber, plantCode, MMGCode, godownCode, checkForEPCode, mainAssemblyOrVehicleName, subAssemblyOrPartName, capitalItem, ledgerFolioNumber, description, vehicleNumber) 
            VALUES($letterNumber,
    $date,
    $itemNumber,
    '$itemDescriptionShort',
    '$itemDescriptionLong',
    $quantityOrAccountingUnit,
    $partNumber,
    $drawingNumber,
     $plantCode,
     $MMGCode,
     $godownCode,
     '$checkForEPCode',
     '$mainAssemblyOrVehicleName',
     '$subAssemblyOrPartName',
     '$capitalItem',
     $ledgerFolioNumber,
     '$description',
     $vehicleNumber)";
			
    
    $stmt = $conn->prepare($sql);

    /* Bind parameters
    $stmt->bindParam(1, $letterNumber);
    $stmt->bindParam(2, $date);
    $stmt->bindParam(3, $itemNumber);
    $stmt->bindParam(4, $itemDescriptionShort);
    $stmt->bindParam(5, $itemDescriptionLong);
    $stmt->bindParam(6, $quantityOrAccountingUnit);
    $stmt->bindParam(7, $partNumber);
    $stmt->bindParam(8, $drawingNumber);
    $stmt->bindParam(9, $plantCode);
    $stmt->bindParam(10, $MMGCode);
    $stmt->bindParam(11, $godownCode);
    $stmt->bindParam(12, $checkForEPCode);
    $stmt->bindParam(13, $mainAssemblyOrVehicleName);
    $stmt->bindParam(14, $subAssemblyOrPartName);
    $stmt->bindParam(15, $capitalItem);
    $stmt->bindParam(16, $ledgerFolioNumber);
    $stmt->bindParam(17, $description);
    $stmt->bindParam(18, $vehicleNumber);*/

echo $sql;

    // Execute SQL statement
    if ($stmt->execute()) {
        $insert=true;
    } else {
        echo "ERROR: Unable to execute query: " . print_r($stmt->errorInfo());
    }

    // Close database connection
    $conn = null;
} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
    <link rel="stylesheet" href="style1.css">
</head>
<body>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <?php
    if($insert==true){
        echo "<p>Thank you for submitting the form.</p><br>";
    } 
    ?>
    <h2>Requisition For Allotment Of New Ledger Folio Number Item Code</h2>
    <label for="letterNumber">Letter number:</label>
    <input type="text" id="letterNumber" name="letterNumber" required>

    <label for="date">Date:</label>
    <input type="date" id="date" name="date" required>

    <h4>To,<br> The Deputy General Manager,or, I.T.C</h4>

    <div> 
        <label for="itemNumber">(i) Item code/ L.F Number (13 digit):</label>
        <input type="number" id="itemNumber" name="itemNumber" required>
    </div>
    <br>

    <label for="itemDescriptionShort">(ii) Item description in short (max. 30 words):</label>
    <textarea name="itemDescriptionShort" id="itemDescriptionShort" cols="30" rows="3" placeholder="Enter item description (short)"></textarea>
    <br>

    <label for="itemDescriptionLong">(iii) Item description in full (max. 300 words):</label>
    <textarea name="itemDescriptionLong" id="itemDescriptionLong" cols="30" rows="6" placeholder="Enter item description (long)"></textarea>
    <br>

    <label for="quantityOrAccountingUnit">(iv) Unit of Quantity/ Accounting Unit:</label>
    <input type="number" id="quantityOrAccountingUnit" name="quantityOrAccountingUnit" required>
    <br>

    <label for="partNumber">(v) Part number (max. 13 characters):</label>
    <input type="text" id="partNumber" name="partNumber" required>
    <br>

    <label for="drawingNumber">(vii) Drawing Number (max. 20 characters):</label>
    <input type="text" id="drawingNumber" name="drawingNumber" required>
    <br>

    <label for="plantCode">(vi) Plant Code (1 character):</label>
    <input type="text" id="plantCode" name="plantCode" required>
    <br>

    <label for="MMGCode">(viii) MMG Code (3 characters):</label>
    <input type="text" id="MMGCode" name="MMGCode" required>
    <br>

    <label for="godownCode">(ix) Godown Code (5 characters):</label>
    <input type="text" id="godownCode" name="godownCode" required>
    <br>

    <label for="checkForEPCode">(x) Whether meant for EP Code (Yes/No):</label>
    <input type="radio" name="checkForEPCode" id="checkForEPCode" value="Yes">
    <label for="capitalItemNo" class="radio-label">Yes</label>
    <input type="radio" name="checkForEPCode" id="checkForEPCode" value="No">
    <label for="capitalItemNo" class="radio-label">No</label>
    <br>

    <label for="mainAssemblyOrVehicleName">(xi) Main Assembly/Vehicle Name:</label>
    <input type="text" id="mainAssemblyOrVehicleName" name="mainAssemblyOrVehicleName" required>
    <br>

    <label for="subAssemblyOrPartName">(xiii) Sub Assembly/Part name:</label>
    <input type="text" id="subAssemblyOrPartName" name="subAssemblyOrPartName" required>
    <br>

    <label for="capitalItem">(xiv) Capital item (Yes/No):</label>
    <input type="radio" name="capitalItem" id="capitalItem" value="Yes">
    <label for="capitalItemNo" class="radio-label">Yes</label>
    <input type="radio" name="capitalItem" id="capitalItem" value="No"> 
    <label for="capitalItemNo" class="radio-label">No</label>
    <br>

    <p>It is certified that this laser foil will not be produced again or identical. Copy folio will be created. It is also certified that this folio carries the:</p>
    
    <label for="ledgerFolioNumber">Ledger Folio number:</label>
    <input type="number" id="ledgerFolioNumber" name="ledgerFolioNumber" required>  

    <label for="description">Description:</label>
    <input type="text" id="description" name="description" required>  

    <label for="vehicleNumber">Vehicle number:</label>
    <input type="number" id="vehicleNumber" name="vehicleNumber" required>

    <button type="submit" name="submit">Submit</button>
</form>
<button type="button" onclick="printForm()" class="btn">Print</button>

<script>
    function printForm() {
    // Apply styles for printing
    var style = document.createElement('style');
    style.innerHTML = `
        body {
            font-family: Arial, sans-serif;
            color: black !important;
        }
        .form-group {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
            border-bottom: 1px solid #ccc;
            padding-bottom: 10px;
        }
        .label {
            width: 30%;
            text-align: right;
            font-weight: bold;
            padding-right: 10px;
        }
        .input {
            width: 68%;
            border: none;
            padding: 5px;
            background-color: transparent;
        }
        button {
            display: none;
        }
        h2 {
            text-align: center;
        }
    `;
    document.head.appendChild(style);

    // Print the form
    window.print();
    
    // Remove the added styles after printing
    style.remove();
}

</script>

</body>
</html>
