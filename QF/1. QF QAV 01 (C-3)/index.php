<?php
// Include the Informix database connection file
include_once("../../../informixConnect_ppc.php");

// Define the table name
$table = "inspection_mpv_hull";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get current date
    $date = date(dmy);
    
    // Initialize unit_id
    $unit_id = 0;

    // Query to get the max id from the table
    $query = "SELECT MAX(id) FROM $table";
    $result= $dbo->query($query);

    // Check if query executed successfully
    if ($result) {
        // Fetch the result using a foreach loop
        foreach ($result as $row) {
            // Extract the max id
            $unit_id = $row['id'] + 1;
        }
    } else {
        echo "Error: " . $query . "<br>" . $dbo->error;
        exit; // Exit the script if there's an error
    }

    // Initialize SQL statement
    $sql_values = array();
    
    // List of properties
    $properties = array(
        "V-PLATE LOWER (16MM) HOLES FOR SPRING HANGER BKT, CUTTING OF AGB & AXLE PORT", "V-PLATE UPPER (12MM),- HOLE POSITION & ALIGNMENT OF SPARE WHEEL MTG BKT", "WELDING JOINTS INSPECTION OF V PLATE ASSY. (16MM , 12MM & 6MM)", "SIDE PLATE ASSY LH & RH- HOLE POSITION OF STEERING MTG BKT- GLASS", "FRAME MTG & SPARE WHEEL BKT", "ROOF PLATE ASSY", "REAR DOOR ASSY & BKTS", "GUNPORT ASSY.", "BONNET ASSY", "VENTILATION PORT ASSY. LH & RH", "COMPOSITE ARMOUR STRIPS & REINFORNCEMENT", "RADIATOR MTG BRACKET LH & RH", "RADIATOR BASE MTG BRACKET LH & RH", "ENGINE MTG BRACKET -FRONT", "ENGINE MTG BRACKET -REAR", "PNEUMATIC CYLINDER MTG BRACKET FOR BONNET & DOOR OPERATION", "AIR CLEANER MTG BRACKET (LH SIDE)", "AIR RESERVOIR (15 LTR) MTG BRACKET", "AIR COOLANT PUMP MTG BRACKET FOR HEATING", "FUEL FILTER & WATER SEPARATOR MTG BRACKET", "BOSSES FOR PURGE TANK(LH SIDE)", "BOSSES FOR AIR DRIER(LH SIDE)", "REAR DOOR OPENING", "STEERING ANGLE DASH BOARD", "COMPOSITE ARMOUR FITMENT", "4 MM COVER PLATE FITMENT", "BOSSES FOR PRESSURE HORN", "BOSSES FOR WATER TANK FITMENT", "BOSSES FOR FIRE EXTINGUISHER", "FLOORING TROOPER COMPARTMENT", "GUN PORT HOOK", "BOLT FOR GUN PORT LOCK ASSLY.", "PLAIN WASHER FOR GUN PORT LOCK ASSLY.", "CATCHER", "CATCHER HOOK", "TROOPER HATCH HOOK", "ELECTRICAL BOSSES", "ANGLE ASSY", "LADDER", "A.C. MTG BKT", "TROOPER SEAT CHANNEL & BOSSES", "FRONT ANGLE LH", "FRONT ANGLE RH", "REAR ANGLE LHS", "REAR ANGLE RHS", "GLASS FRAME", "WIND SHIELD GLASS", "DRIVER SIDE GLASS", "CO-DRIVER SIDE GLASS", "GLASS FRAME SIDE", "GLASS REAR", "SOLENOID BKT 4 NOS.", "RELAY MTG BRKT ASSY", "RELAY MTG BRKT", "CHANNEL FOR RELAY MTG BRKT", "HORN BKT", "STEERING BKT WITH LOCKING PLATE ASSY ON STEERING BEAM", "STRENGTHENING STRIP FOR ABC CONTROL ANGLE ASSY", "M6 THREADED BUSHES", "FUEL TANK FILTER NECK", "AIR TANK CLIPS 4 NOS. LH & RH", "DASH BOARD ANGLE WITH PARTITION PLATE", "REAR ANGLE LHS", "REAR ANGLE RHS", "FUSE BOX", "GUN PORT LOCK (PIN & BOSSES)", "DRIVER FLOOR"
    );

    // Loop through each property and get the remark from the form data
    foreach ($properties as $property) {
        // Check if property is set in the POST data
        if (isset($_POST[$property])) {
            // Escape special characters to prevent SQL injection
            $remark = $dbo->real_escape_string($_POST[$property]);
            
            // Add property and remark to the SQL values array
            $sql_values[] = "($unit_id, '$property', '$remark', '$date')";
        }
    }
    
    // Combine SQL values into a single string
    $sql_values_str = implode(", ", $sql_values);

    // Prepare SQL statement
    $sql = "INSERT INTO $table VALUES $sql_values_str";
    
    // Execute SQL statement
    if ($dbo->query($sql) === TRUE) {
        echo "New records created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $dbo->error;
    }
}

// Close connection
$dbo->close();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
         body {
            font-family: Arial, sans-serif;
            background-color: #ffffff;
            /* White background */
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
            border: 2px solid #000000;
            /* Black border */
        }
        h3{
            text-align: center;
        }
         
        td,th{
                border: 1px solid black;
                height: 2em;
                text-align: center;

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


.button-container {
    text-align: center;
    /* Center align buttons */
    margin-top: 20px;
}

td input {
    height: 2em;
    width: 15rem;
    border-radius: 5px;
}

.button-container button {
    margin-right: 10px;
}

    </style>
</head>
<body>

       <form action="your_backend_processing_script.php" method="post">
        <div class="container">
            
            <table style="width: 100%">
                 
                <tr>
                    <th > INSPECTION OF MPV HULL</th>
                    <th colspan ="2"  >V-PLATE NO: width</th>
                    <th >STAGE-I (BEFORE SR) </th>
                </tr>
                <tr>
                    <th>ITEM </th>
                    <th>DRG.NO </th>
                    <th>QTY</th>
                    <th>INSPECTION & REMARKS </th>
                
                </tr>
                <tr>
                    <td> V-PLATE LOWER (16MM)   HOLES FOR SPRING HANGER BKT, CUTTING OF AGB & AXLE PORT </td>
                    <td>MPV/HULL/073 , 640-01-1000-2/E </td>
                    <td>1</td>
                    <td><input type="text" name="" ></td>
                </tr>
                
                        
                <tr>
                     <td> V-PLATE UPPER (12MM),-  HOLE 
                        POSITION & ALIGNMENT OF SPARE 
                        WHEEL MTG BKT </td>
                    <td> MPV/HULL/074</td>
                    <td>2</td>
                    <td><input type="text" name="" ></td>
                </tr>
                
                <tr>
                    <td> WELDING JOINTS INSPECTION OF V
                        PLATE ASSY. (16MM , 12MM & 6MM) </td>
                   <td> </td>
                   <td>1</td>
                   <td><input type="text" name="" ></td>
                </tr>
                
                <tr>
                    <td>SIDE PLATE ASSY LH & RH-   HOLE 
                        POSITION OF STEERING MTG BKT-   
                        GLASS FRAME MTG & SPARE WHEEL 
                        BKT  </td>
                   <td> 645-01-1000-1/C </td>
                   <td>1</td>
                   <td><input type="text" name="" ></td>
                </tr>
                
                <tr>
                    <td>ROOF PLATE ASSY  </td>
                   <td>645-01-1560-1 </td>
                   <td>1</td>
                   <td><input type="text" name="" ></td>
                </tr>
                
                <tr>
                    <td>REAR DOOR ASSY & BKTS  </td>
                   <td>645-01-1315-1/A </td>
                   <td>1</td>
                   <td><input type="text" name="" ></td>
                </tr>
                
                <tr>
                    <td>GUNPORT ASSY.  </td>
                   <td>645-01-2100-1 </td>
                   <td>12</td>
                   <td><input type="text" name="" ></td>
                </tr>
                
                <tr>
                    <td>BONNET ASSY </td>
                   <td> 620-01 </td>
                   <td></td>
                   <td><input type="text" name="" ></td>
                </tr>
                
                <tr>
                    <td>VENTILATION PORT ASSY. LH & RH  </td>
                   <td> </td>
                   <td>1</td>
                   <td><input type="text" name="" ></td>
                </tr>
                
                <tr>
                    <td> COMPOSITE ARMOUR STRIPS & 
                        REINFORNCEMENT  </td>
                   <td> 645-15-1100-1 
                    RHS                             
                    645-15-1150-1/C 
                    LHS</td>
                   <td>1 SET</td>
                   <td><input type="text" name="" ></td>
                </tr>
                
                <tr>
                    <td>RADIATOR MTG BRACKET LH & RH </td>
                   <td>620-03-1540-1/B  
                    620-03-1530-1/B  </td>
                   <td>2</td>
                   <td><input type="text" name="" ></td>
                </tr>
                
                <tr>
                    <td>RADIATOR BASE MTG BRACKET LH & 
                        RH </td>
                   <td>620-03-1510-1  </td>
                   <td>1</td>
                   <td><input type="text" name="" ></td>
                </tr>
                
                <tr>
                    <td>ENGINE MTG BRACKET -FRONT  </td>
                   <td>645-03-1120-1 
                    645-03-1130-1  </td>
                   <td>2</td>
                   <td><input type="text" name="" ></td>
                </tr>
                
                <tr>
                    <td>ENGINE MTG BRACKET -REAR </td>
                   <td>610-03-1110-L
                    1/C 610-03
                    1110-R-1/C  </td>
                   <td>2</td>
                   <td><input type="text" name="" ></td>
                </tr>
                
                <tr>
                    <td>PNEUMATIC CYLINDER MTG BRACKET 
                        FOR BONNET & DOOR OPERATION 
                         </td>
                   <td>645-01-1354-1 
                    645-01-1355-1 </td>
                   <td>1</td>
                   <td><input type="text" name="" ></td>
                </tr>
                
                <tr>
                    <td>AIR CLEANER MTG BRACKET (LH SIDE)</td>
                   <td> 115-43-0038-1 </td>
                   <td>2</td>
                   <td><input type="text" name="" ></td>
                </tr>
                
                <tr>
                    <td> AIR RESERVOIR (15 LTR) MTG 
                        BRACKET </td>
                   <td>B-3910101HA  </td>
                   <td>1</td>
                   <td><input type="text" name="" ></td>
                </tr>
                
                <tr>
                    <td>AIR COOLANT PUMP MTG BRACKET 
                        FOR HEATING </td>
                   <td> HULL/MPV/107</td>
                   <td>1</td>
                   <td><input type="text" name="" ></td>
                </tr>
                
                <tr>
                    <td>FUEL FILTER & WATER SEPARATOR 
                        MTG BRACKET </td>
                   <td> 620-03-1140-1/B</td>
                   <td>1</td>
                   <td><input type="text" name="" ></td>
                </tr>
                
                <tr>
                    <td>BOSSES FOR PURGE TANK(LH SIDE)  </td>
                   <td> </td>
                   <td>2</td>
                   <td><input type="text" name="" ></td>
                </tr>
                
                <tr>
                    <td>BOSSES FOR AIR DRIER(LH SIDE) </td>
                   <td> </td>
                   <td>2</td>
                   <td><input type="text" name="" ></td>
                </tr>

                <tr>
                    <td> REAR DOOR OPENING </td>
                    <td></td>
                    <td></td>
                    <td><input type="text" name="" > </td>
                
                </tr>
            
                <tr>
                    <td>STEERING ANGLE  DASH BOARD  </td>
                    <td> </td>
                    <td></td>
                    <td><input type="text" name="" > </td>
                
                </tr>
            
                <tr>
                    <td> COMPOSITE ARMOUR FITMENT</td>
                    <td> </td>
                    <td></td>
                    <td><input type="text" name="" > </td>
                
                </tr>
            
                <tr>
                    <td> 4 MM COVER PLATE FITMENT </td>
                    <td> </td>
                    <td></td>
                    <td><input type="text" name="" > </td>
                
                </tr>
            
                <tr>
                    <td> BOSSES FOR PRESSURE HORN</td>
                    <td> </td>
                    <td>2</td>
                    <td><input type="text" name="" > </td>
                
                </tr>
            
                <tr>
                    <td> BOSSES FOR WATER TANK FITMENT </td>
                    <td> </td>
                    <td>6</td>
                    <td><input type="text" name="" > </td>
                
                </tr>
            
                <tr>
                    <td>BOSSES FOR FIRE EXTINGUISHER  </td>
                    <td> </td>
                    <td>2</td>
                    <td><input type="text" name="" > </td>
                
                </tr>
            
                <tr>
                    <td>FLOORING TROOPER COMPARTMENT </td>
                    <td>  115-36-0019-1 </td>
                    <td>1 SET </td>
                    <td><input type="text" name="" > </td>
                
                </tr>
            
                <tr>
                    <td>GUN PORT HOOK </td>
                    <td> 645-01-2253</td>
                    <td>12/SET</td>
                    <td> <input type="text" name="" ></td>
                
                </tr>
            
                <tr>
                    <td>BOLT FOR GUN PORT LOCK ASSLY. </td>
                    <td> </td>
                    <td>12/SET</td>
                    <td><input type="text" name="" > </td>
                
                </tr>
            
                <tr>
                    <td>PLAIN WASHER FOR GUN PORT LOCK 
                        ASSLY. </td>
                    <td> </td>
                    <td>12/SET </td>
                    <td><input type="text" name="" > </td>
                
                </tr>
            
                <tr>
                    <td>CATCHER  </td>
                    <td>9013100239000 </td>
                    <td>2</td>
                    <td><input type="text" name="" > </td>
                
                </tr>
            
                <tr>
                    <td>CATCHER HOOK  </td>
                    <td> </td>
                    <td>2</td>
                    <td> <input type="text" name="" ></td>
                
                </tr>
            
                <tr>
                    <td>TROOPER HATCH HOOK  </td>
                    <td>115-31-0059-1  </td>
                    <td>10</td>
                    <td> <input type="text" name="" ></td>
                
                </tr>
                <tr>
                    <td> ELECTRICAL BOSSES </td>
                    <td>640-06-1020-1A</td>
                    <td>1 SET</td>
                    <td><input type="text" name="" > </td>
                
                </tr>
        
                <tr>
                    <td> ANGLE ASSY  </td>
                    <td>640-01-4050 </td>
                    <td>8</td>
                    <td><input type="text" name="" > </td>
                
                </tr>
        
                <tr>
                    <td> LADDER  </td>
                    <td>640-01-2750-1A </td>
                    <td>1</td>
                    <td><input type="text" name="" > </td>
                
                </tr>
        
                <tr>
                    <td>A.C. MTG BKT   </td>
                    <td>610-03-1701-1/E</td>
                    <td>1</td>
                    <td><input type="text" name="" > </td>
                
                </tr>
        
                <tr>
                    <td><b> TROOPER SEAT CHANNEL & 
                        BOSSES </b></td>
                    <td></td>
                    <td>1 SET  </td>
                    <td><input type="text" name="" > </td>
                
                </tr>
        
                <tr>
                    <td> FRONT ANGLE  LH  </td>
                    <td>640-07-1023</td>
                    <td></td>
                    <td><input type="text" name="" > </td>
                
                </tr>
        
                <tr>
                    <td> FRONT ANGLE RH </td>
                    <td>640-07-1024</td>
                    <td></td>
                    <td><input type="text" name="" > </td>
                
                </tr>
        
                <tr>
                    <td> REAR ANGLE LHS  </td>
                    <td>640-07-1025 </td>
                    <td></td>
                    <td><input type="text" name="" > </td>
                
                </tr>
        
                <tr>
                    <td> REAR ANGLE RHS  </td>
                    <td>640-07-1026  </td>
                    <td></td>
                    <td><input type="text" name="" > </td>
                
                </tr>
        
                <tr>
                    <td> GLASS FRAME </td>
                    <td></td>
                    <td>1 SET</td>
                    <td><input type="text" name="" > </td>
                
                </tr>
        
                <tr>
                    <td> WIND SHIELD GLASS  </td>
                    <td>640-10-1021-1 </td>
                    <td></td>
                    <td><input type="text" name="" > </td>
                
                </tr>
        
                <tr>
                    <td> DRIVER SIDE  GLASS  </td>
                    <td>640-10-1022-1/A </td>
                    <td></td>
                    <td><input type="text" name="" > </td>
                
                </tr>
        
                <tr>
                    <td>CO-DRIVER SIDE GLASS   </td>
                    <td>640-10-1023 </td>
                    <td></td>
                    <td><input type="text" name="" > </td>
                
                </tr>
        
                <tr>
                    <td> GLASS FRAME SIDE </td>
                    <td>640-10-1024-1</td>
                    <td></td>
                    <td><input type="text" name="" > </td>
                
                </tr>
        
                <tr>
                    <td> GLASS REAR   </td>
                    <td>640-10-1025-1 </td>
                    <td></td>
                    <td><input type="text" name="" > </td>
                
                </tr>
        
                <tr>
                    <td> SOLENOID  BKT 4 NOS.  </td>
                    <td>X 0487314</td>
                    <td>1</td>
                    <td><input type="text" name="" > </td>
                
                </tr>
        
                <tr>
                    <td> RELAY MTG BRKT ASSY  </td>
                    <td></td>
                    <td>1</td>
                    <td><input type="text" name="" > </td>
                
                </tr>
        
                <tr>
                    <td>RELAY MTG BRKT   </td>
                    <td>HULL MPV/108</td>
                    <td></td>
                    <td><input type="text" name="" > </td>
                
                </tr>
        
                <tr>
                    <td> CHANNEL FOR  RELAY MTG BRKT  </td>
                    <td>115-31-0086-1</td>
                    <td></td>
                    <td><input type="text" name="" > </td>
                
                </tr>
        
                <tr>
                    <td> HORN BKT  </td>
                    <td>X 0450610 </td>
                    <td>1</td>
                    <td><input type="text" name="" > </td>
                
                </tr>
        
                <tr>
                    <td>STEERING BKT WITH LOCKING PLATE 
                        ASSY ON STEERING BEAM   </td>
                    <td>620-04-1131-1  
                        620-04-1130-1/A</td>
                    <td>1</td>
                    <td><input type="text" name="" > </td>
                
                </tr>
        
                <tr>
                    <td> STRENGTHENING STRIP FOR ABC 
                        CONTROL ANGLE ASSY  </td>
                    <td>115-31-0085-1 </td>
                    <td>2</td>
                    <td><input type="text" name="" > </td>
                
                </tr>
        
                <tr>
                    <td> M6 THREADED BUSHES  </td>
                    <td></td>
                    <td>6</td>
                    <td><input type="text" name="" > </td>
                
                </tr>
        
                <tr>
                    <td> FUEL TANK FILTER NECK </td>
                    <td>640-01-2575-1</td>
                    <td>1</td>
                    <td><input type="text" name="" > </td>
                
                </tr>
        
                <tr>
                    <td> AIR TANK CLIPS 4 NOS. LH & RH  </td>
                    <td>VC-509856 </td>
                    <td>4</td>
                    <td><input type="text" name="" > </td>
                
                </tr>
        
                <tr>
                    <td> DASH BOARD ANGLE WITH 
                        PARTITION PLATE  </td>
                    <td>620-07-2005-1</td>
                    <td>1 SET</td>
                    <td><input type="text" name="" > </td>
                
                </tr>
        
                <tr>
                    <td>  REAR ANGLE LHS</td>
                    <td>640-01-3317-1/A </td>
                    <td></td>
                    <td><input type="text" name="" > </td>
                
                </tr>
        
                <tr>
                    <td> REAR ANGLE RHS  </td>
                    <td>640-01-3318-1/A</td>
                    <td></td>
                    <td><input type="text" name="" > </td>
                
                </tr>
        
                <tr>
                    <td> FUSE BOX  </td>
                    <td>645-01-3313-1</td>
                    <td>2</td>
                    <td><input type="text" name="" > </td>
                
                </tr>
        
                <tr>
                    <td> GUN PORT LOCK (PIN & BOSSES) </td>
                    <td>645-01-2251/A             
                        645-01-2252 </td>
                    <td>12 EACH</td>
                    <td><input type="text" name="" > </td>
                
                </tr>
        
                <tr>
                    <td> DRIVER FLOOR  </td>
                    <td>640-07-1075-1                
                        640-07-1050-1 </td>
                    <td>1 SET</td>
                    <td><input type="text" name="" > </td>
                
                </tr>
                <tr> 
                    <th> EXAM/QAV</th>
                    <th>I/C QAV</th>
                    <th colspan="2">I/C PRODN</th>
                </tr>
                     


                </table>


                <div class="button-container">
                    <button type="submit">Submit</button>
                    <button id="print-button" onclick="window.print()">Print</button>
                </div>
              </div>

            </form>

            <script>

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
        </script>


          



</body>
</html>