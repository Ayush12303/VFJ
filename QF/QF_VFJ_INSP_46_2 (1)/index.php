<!-- Section 1: VEHICLE INSPECTION REPORT
"BA_NO", "ENGINE_NO", "CHASSIS_NO", "KM_READING_INITIAL", "FINAL"

Section 2: STATIC CHECK
"CAB_TILTING", "CAB_TILTING_DATE", "SPARE_WHEEL_CARRIER", "CAMOUFLAGE_BRACKETS", "1ST_TIME_RETENDERED", "2ND_TIME_RETENDERED", "ACCEPTED_REJECTED", "STATIC_CHECK_SIGNATURE", "STATIC_CHECK_DATE"

Section 3: ANY OTHER POINTS ON MUA'S
"transmission-maxspeed", "transmission-oilpressure", "transmission-RECT.PROD", "front-axle-maxspeed", "front-axle-oilpressure", "front-axle-RECT.PROD", "rear-axle-maxspeed", "rear-axle-oilpressure", "rear-axle-RECT.PROD", "propeller-shaft-maxspeed", "propeller-shaft-oilpressure", "propeller-shaft-RECT.PROD", "brakes-maxspeed", "brakes-oilpressure", "brakes-RECT.PROD", "transfer-case-maxspeed", "transfer-case-oilpressure", "transfer-case-RECT.PROD"

Section 4: ROAD TEST REPORT
"steering-defects", "steering-rect.prod", "elect-equipment-defects", "elect-equipment-rect.prod", "car-and-body-defects", "car-and-body-rect.prod", "general-defects", "general-rect.prod" -->


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehicle Inspection Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #ffffff; /* White background */
            margin: 0;
            padding: 20px;
        }
        .container {
            width: 85%;
            margin: 0 auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border: 2px solid #000000; /* Black border */
        }
        h1 {
            margin-bottom: 2rem;
        }
        h1, h2, h3 {
            text-align: center; /* Center align headings */
        }
        h2 {
            margin-bottom: 30px;
        }
        h3 {
            margin-top: 20px;
            margin-bottom: 2rem;
        }
        
        section {
            margin-top: 20px;
            border-top: 1px solid #ccc;
            padding-top: 20px;
            position: relative;
        }
        textarea {
            width: 50%;
            height: 20vh;
        }
        .signatures {
            text-align: center;
            margin-top: 20px;
            margin-bottom: 3rem;
        }
        .signatures h3 {
            display: inline-block;
            margin: 0 20px;
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
            font-size: 1.2em;
        }
        input[type="text"],
        input[type="number"],
        input[type="date"],
        input[type="time"] {
            width: calc(100% - 22px);
            padding: 7px;
            margin-bottom: 10px;
            border: 1px solid #878686;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
        }
        button[type="submit"],
        button[type="button"],
        button#print-button {
            background-color: #007bff;
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
        button[type="button"]:hover,
        button#print-button:hover {
            background-color: #0056b3;
        }
        ul {
            list-style-type: none;
            padding-left: 0;
        }
        li {
            margin-bottom: 5px;
        }
        .button-container {
            text-align: center; /* Center align buttons */
            margin-top: 20px;
        }
        .button-container button {
            margin-right: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table td {
            padding: 10px;
            border: 1px solid #878686;
        }
        .form-section {
            display: none;
        }
        .form-section.active {
            display: block;
        }
    </style>
</head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div id="section1" class="container form-section active">
            <h2>VEHICLE INSPECTION REPORT</h2>
            <h3>STALLION MK-IV - 4X4</h3>
            <div class="flex-container">
                <div>
                    <label for="BA_NO">BA NO.:</label>
                    <input type="number" id="BA_NO" name="BA_NO" required>
                </div>
                <div>
                    <label for="ENGINE_NO">ENGINE NO.:</label>
                    <input type="number" id="ENGINE_NO" name="ENGINE_NO" required>
                </div>
            </div>
            <div class="flex-container">
                <div>
                    <label for="CHASSIS_NO">CHASSIS NO.:</label>
                    <input type="number" id="CHASSIS_NO" name="CHASSIS_NO" required>
                </div>
                <div>
                    <label for="KM_READING_INITIAL">KM.READING-INITIAL:</label>
                    <input type="text" id="KM_READING_INITIAL" name="KM_READING_INITIAL" required>
                </div>
                <div>
                    <label for="FINAL">FINAL:</label>
                    <input type="text" id="FINAL" name="FINAL" required>
                </div>
            </div>

            
             
            <div class="button-container">
                <button type="button" onclick="showSection(2)">Next</button>
            </div>
        </div>
        
        <div id="section2" class="container form-section">
            <h2><u>STATIC CHECK</u></h2>
            <div class="flex-container">
                <div>
                    <label for="CAB_TILTING">CAB TILTING:</label>
                    <input type="text" id="CAB_TILTING" name="CAB_TILTING" required>
                </div>
                <div>
                    <label for="CAB_TILTING_DATE">DATE:</label>
                    <input type="date" id="CAB_TILTING_DATE" name="CAB_TILTING_DATE" required>
                </div>
            </div>
            <div class="flex-container">
                <div>
                    <label for="SPARE_WHEEL_CARRIER">SPARE WHEEL CARRIER:</label>
                    <input type="text" id="SPARE_WHEEL_CARRIER" name="SPARE_WHEEL_CARRIER" required>
                </div>
                <div>
                    <label for="CAMOUFLAGE_BRACKETS">CAMOUFLAGE BRACKETS:</label>
                    <input type="text" id="CAMOUFLAGE_BRACKETS" name="CAMOUFLAGE_BRACKETS" required>
                </div>
            </div>
            <div class="flex-container">
                <div>
                    <label for="1ST_TIME_RETENDERED">1st Time:</label>
                    <input type="time" id="1ST_TIME_RETENDERED" name="1ST_TIME_RETENDERED" required>
                </div>
                <div>
                    <label for="2ND_TIME_RETENDERED">2nd Time:</label>
                    <input type="time" id="2ND_TIME_RETENDERED" name="2ND_TIME_RETENDERED" required>
                </div>
            </div>
            <div class="flex-container">
                <div>
                    <label for="ACCEPTED_REJECTED">ACCEPTED/REJECTED:</label>
                    <input type="text" id="ACCEPTED_REJECTED" name="ACCEPTED_REJECTED" required>
                </div>
                <div>
                    <label for="STATIC_CHECK_SIGNATURE">SIGNATURE OF INSPECTOR CQA(OFV):</label>
                    <input type="text" id="STATIC_CHECK_SIGNATURE" name="STATIC_CHECK_SIGNATURE" required>
                </div>
                <div>
                    <label for="STATIC_CHECK_DATE">DATE:</label>
                    <input type="date" id="STATIC_CHECK_DATE" name="STATIC_CHECK_DATE" required>
                </div>
            </div>
            <div class="button-container">
                <button type="button" onclick="showSection(1)">Previous</button>
                <button type="button" onclick="showSection(3)">Next</button>
            </div>
        </div>
        
        <div id="section3" class="container form-section">
            <table style= "width: 100%">
                <h2> ANY OTHER POINTS ON MUA'S</h2>
            <tr>
               <td style="text-align: center;font-weight: bold;">ENGINE       </td> 
               <td style="text-align: center;font-weight: bold;"> MAX SPEED </td>
               <td style="text-align: center;font-weight: bold;"> MAX OIL PRESSURE</td>
               <td style="text-align: center;font-weight: bold;"> RECT.PROD.</td>         
            </tr>
            
            <tr>
                <td style="text-align: center;font-weight: bold;">TRANSMISSION</td>
                <td>
                    <input type="text" name="transmission-maxspeed">
                </td>
                <td>
                    <input type="text" name="transmission-oilpressure">
                </td>
                <td>
                    <input type="text" name="transmission-RECT.PROD">
                </td>

            </tr>
           <tr>
                <td style="text-align: center;font-weight: bold;">FRONT AXLE</td>
                <td>
                    <input type="text" name="front-axle-maxspeed">
                </td>
                <td>
                    <input type="text" name="front-axle-oilpressure">
                </td>
                <td>
                    <input type="text" name="front-axle-RECT.PROD">
                </td>
           </tr>
     
            
            <tr>
                <td style="text-align: center;font-weight: bold;">REAR AXLE</td>
                <td>
                    <input type="text" name="rear-axle-maxspeed">
                </td>
                <td>
                    <input type="text" name="rear-axle-oilpressure">
                </td>
                <td>
                    <input type="text" name="rear-axle-RECT.PROD">
                </td>
           </tr>
            <tr>
                <td style="text-align: center;font-weight: bold;">PROPELLER SHAFT</td>
                <td>
                    <input type="text" name="propeller-shaft-maxspeed">
                </td>
                <td>
                    <input type="text" name="propeller-shaft-oilpressure">
                </td>
                <td>
                    <input type="text" name="propeller-shaft-RECT.PROD">
                </td>
           </tr>
            <tr>
                <td style="text-align: center;font-weight: bold;">BRAKES</td>
                <td>
                    <input type="text" name="brakes-maxspeed">
                </td>
                <td>
                    <input type="text" name="brakes-oilpressure">
                </td>
                <td>
                    <input type="text" name="brakes-RECT.PROD">
                </td>
           </tr>
            <tr>
                <td style="text-align: center;font-weight: bold;">TRANSFER CASE</td>
                <td>
                    <input type="text" name="transfer-case-maxspeed">
                </td>
                <td>
                    <input type="text" name="transfer-case-oilpressure">
                </td>
                <td>
                    <input type="text" name="transfer-case-RECT.PROD">
                </td>
           </tr>
            
            
            </table>   
            
    
    
            <div class="button-container">
                <button type="button" onclick="showSection(2)">Previous</button>
                <button type="button" onclick="showSection(4)">Next</button>
            </div>
        </div>
        
        <!-- Add other sections similarly -->

        <div id="section4" class="container form-section">
            <!-- Add fields for the ROAD TEST REPORT section here -->
            
            <table style= "width: 100%">
                <h2> ROAD TEST REPORT:</h2>
            <tr>
                <td></td>
                <td>DEFECTS</td> 
                <td>RECT.PROD</td>        
            </tr>
             <tr>
                <td style="text-align: center;font-weight: bold;">STEERING</td>
                <td><input type="text" name="steering-defects"></td>
                <td><input type="text" name="steering-rect.prod"></td>
            </tr>
            <tr>
                <td style="text-align: center;font-weight: bold;">ELECT. EQUIPMENT</td>
                <td><input type="text" name="elect-equipment-defects"></td>
                <td><input type="text" name="elect-equipment-rect.prod"></td>
            </tr>
            <tr>
                <td style="text-align: center;font-weight: bold;">CAB & BODY</td>
                <td><input type="text" name="car-and-body-defects"></td>
                <td><input type="text" name="car-and-body-rect.prod"></td>
            </tr>
            <tr>
                <td style="text-align: center;font-weight: bold;">GENERAL</td>
                <td><input type="text" name="general-defects"></td>
                <td><input type="text" name="general-rect.prod"></td>
            </tr>
            
            <tr style="height: 4rem;"><td></td>
                <td></td>
            <td style="text-align: center; font-weight: bold;"> SIGNATURE & DATE CQA(OFV) INSPECTOR</tr>
                        </td>
            <tr style="height: 4rem;">
                <td style="text-align: center; font-weight: bold;"> RECTIFICATION</td>
                <td style="text-align: center; font-weight: bold;">ABOVE DEFFECTS RECTIFIED</td> 
                <td style="text-align: center; font-weight: bold;">SIGNATURE OF PROD.STAFF</td>

            </tr>
            <TR>
            <TD style="text-align: center;font-weight: bold;"> INSPECTION OF RECTIFICATION</TD>
            <td style="text-align: center;font-weight: bold;"> ACCEPTED
                SIGNATURE OF INSPECTOR CQA(OFV)
            </td>
            <td></td>
            </TR>
                        
            </table>


            <div class="button-container">
                <button type="button" onclick="showSection(3)">Previous</button>
                <button type="submit">Submit</button>
                <button id="print-button" onclick="printForm()">Print</button>
            </div>
        </div>
    </form>

    <script>
        function showSection(sectionNumber) {
            const sections = document.querySelectorAll('.form-section');
            sections.forEach((section, index) => {
                section.classList.remove('active');
                if (index + 1 === sectionNumber) {
                    section.classList.add('active');
                }
            });
        }
        function showSection(sectionNumber) {
            const sections = document.querySelectorAll('.form-section');
            sections.forEach((section, index) => {
                section.classList.remove('active');
                if (index + 1 === sectionNumber) {
                    section.classList.add('active');
                }
            });
        }

        function printForm() {
            // Show all sections before printing
            const sections = document.querySelectorAll('.form-section');
            sections.forEach(section => {
                section.classList.add('active');
            });

            // Hide the print button
            document.getElementById('print-button').style.display = 'none';

            // Trigger the print dialog
            window.print();

            // Restore the visibility of sections and the print button
            sections.forEach(section => {
                section.classList.remove('active');
            });
            document.getElementById('print-button').style.display = '';
        }
    </script>
</body>
</html>
