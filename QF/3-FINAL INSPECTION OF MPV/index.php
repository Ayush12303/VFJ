<?php
// Include the Informix database connection file
include_once("../../../informixConnect_ppc.php");

// Define the table name
$table = "final_inspection_of_mpv";

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
        "hull_no", "army_mha_no", "door_fitment", "rubber_beading", "furnishing", "door_lock", 
        "pneumatic_operation", "bonnet_hinges", "bonnet_catcher", "vfj_mono", "gun_port_lock", 
        "gun_port_fitment", "split_pin_spring", "glass_frame_fitment", "any_discrepancies", 
        "reduction_gearbox_fitment", "swc_fitment", "wiper_fitment", "horn_fitment", 
        "rear_view_mirror_fitment", "fuel_tank_cover_fitment", "exhaust_fitment", "exhaust_tail_pipe_fitment", 
        "ladder_fitment", "front_bumper_fitment", "camouflage_pole_fitment", "agb_cover_fitment", 
        "fender_mounting_fitment", "mud_flap_fitment", "hatch_cover_fitment_function", "turret_fitment_function", 
        "ac_mounting_fitment", "floor_gap_near_rear_door", "flooring", "troop_seat_fitment", 
        "safety_belt", "handle", "water_tank", "battery_cover", "isolator_switch", "driver_codriver_seat", 
        "piping_clamping", "dashboard", "switches_gauges", "hand_brake_fitment", 
        "acc_brake_clutch_pedal_position", "electrical_work", "fire_extinguishers", "remarks"
    );

    // Loop through each property and get the status from the form data
    foreach ($properties as $property) {
        // Check if property is set in the POST data
        if (isset($_POST[$property])) {
            // Escape special characters to prevent SQL injection
            $status = $dbo->real_escape_string($_POST[$property]);
            
            // Add property and status to the SQL values array
            $sql_values[] = "($unit_id, '$property', '$status', '$date')";
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
    <title>Final Inspection Form</title>
    <link href="../../images/logovfj.png" rel="icon">
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
        h1{
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
        .section-divider {
            position: absolute;
            top: 0;
            bottom: 0;
            left: 50%;
            width: 2px;
            background-color: #ccc;
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
    </style>
</head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="container">
            <h1>FINAL INSPECTION OF MPV</h1>

    <div class="flex-container">
        <div>
            <label for="date_of_tender">Date of tender:</label>
            <input type="date" id="date_of_tender" name="date_of_tender">
        </div>

    <div>
        <label for="hull_no">Hull No.:</label>
        <input type="text" id="hull_no" name="hull_no">
    </div>

    <div>
        <label for="army_mha_no">Army/MHA No:</label>
        <input type="text" id="army_mha_no" name="army_mha_no">
    </div>

    </div>

        <h3>1. DOOR ASSY.</h3>
            <div style="display: flex;">
                <div>
                    <label for="door_fitment">Fitment/seating:</label>
                </div>            
                <div>
                    <pre>     </pre>
                </div>    
                <div>
                    <input type="radio" name="door_fitment" value="OK" id="door_fitment_ok">Ok
                    <input type="radio" name="door_fitment" value="Not OK" id="door_fitment_not_ok">Not Ok
                </div>
            </div>
            <div style="display: flex;">
                <div>
                    <label for="rubber_beading">Rubber beading:</label>
                </div>            
                <div>
                    <pre>     </pre>
                </div>    
                <div>
                    <input type="radio" name="rubber_beading" value="OK" id="rubber_beading_ok">OK
                    <input type="radio" name="rubber_beading" value="Not OK" id="rubber_beading_not_ok">Not OK
                </div>
            </div>
            
            <div style="display: flex;">
                <div>
                    <label for="furnishing">Furnishing:</label>
                </div>            
                <div>
                    <pre>     </pre>
                </div>    
                <div>
                    <input type="radio" name="furnishing" value="OK" id="furnishing_ok">OK
                    <input type="radio" name="furnishing" value="Not OK" id="furnishing_not_ok">Not OK
                </div>
            </div>
            
            <div style="display: flex;">
                <div>
                    <label for="door_lock">Door lock:</label>
                </div>            
                <div>
                    <pre>     </pre>
                </div>    
                <div>
                    <input type="radio" name="door_lock" value="OK" id="door_lock_ok">OK
                    <input type="radio" name="door_lock" value="Not OK" id="door_lock_not_ok">Not OK
                </div>
            </div>
            
            <div style="display: flex;">
                <div>
                    <label for="pneumatic_operation">Pneumatic Operation & Make:</label>
                </div>            
                <div>
                    <pre>     </pre>
                </div>    
                <div>
                    <input type="radio" name="pneumatic_operation" value="OK" id="pneumatic_operation_ok">OK
                    <input type="radio" name="pneumatic_operation" value="Not OK" id="pneumatic_operation_not_ok">Not OK
                </div>
            </div>
            <h3>2. BONNET ASSY.</h3>
<div style="display: flex;">
    <div>
        <label for="bonnet_hinges">Hinges - grease nipple, fitment:</label>
    </div>            
    <div>
        <pre>     </pre>
    </div>    
    <div>
        <input type="radio" name="bonnet_hinges" value="OK" id="bonnet_hinges_ok">OK
        <input type="radio" name="bonnet_hinges" value="Not OK" id="bonnet_hinges_not_ok">Not OK
    </div>
</div>

<div style="display: flex;">
    <div>
        <label for="bonnet_catcher">Bonnet catcher:</label>
    </div>            
    <div>
        <pre>     </pre>
    </div>    
    <div>
        <input type="radio" name="bonnet_catcher" value="OK" id="bonnet_catcher_ok">OK
        <input type="radio" name="bonnet_catcher" value="Not OK" id="bonnet_catcher_not_ok">Not OK
    </div>
</div>

<div style="display: flex;">
    <div>
        <label for="vfj_mono">VFJ Mono:</label>
    </div>            
    <div>
        <pre>     </pre>
    </div>    
    <div>
        <input type="radio" name="vfj_mono" value="OK" id="vfj_mono_ok">OK
        <input type="radio" name="vfj_mono" value="Not OK" id="vfj_mono_not_ok">Not OK
    </div>
</div>

<div style="display: flex;">
    <div>
        <label for="pneumatic_operation">Pneumatic Operation & Make:</label>
    </div>            
    <div>
        <pre>     </pre>
    </div>    
    <div>
        <input type="radio" name="pneumatic_operation" value="OK" id="pneumatic_operation_ok">OK
        <input type="radio" name="pneumatic_operation" value="Not OK" id="pneumatic_operation_not_ok">Not OK
    </div>
</div>

<h3>3. GUN PORT ASSY.</h3>
<div style="display: flex;">
    <div>
        <label for="gun_port_lock">Gun port lock:</label>
    </div>            
    <div>
        <pre>     </pre>
    </div>    
    <div>
        <input type="radio" name="gun_port_lock" value="OK" id="gun_port_lock_ok">OK
        <input type="radio" name="gun_port_lock" value="Not OK" id="gun_port_lock_not_ok">Not OK
    </div>
</div>

<div style="display: flex;">
    <div>
        <label for="gun_port_fitment">Fitment/ seating:</label>
    </div>            
    <div>
        <pre>     </pre>
    </div>    
    <div>
        <input type="radio" name="gun_port_fitment" value="OK" id="gun_port_fitment_ok">OK
        <input type="radio" name="gun_port_fitment" value="Not OK" id="gun_port_fitment_not_ok">Not OK
    </div>
</div>

<div style="display: flex;">
    <div>
        <label for="split_pin_spring">Split pin and spring:</label>
    </div>            
    <div>
        <pre>     </pre>
    </div>    
    <div>
        <input type="radio" name="split_pin_spring" value="OK" id="split_pin_spring_ok">OK
        <input type="radio" name="split_pin_spring" value="Not OK" id="split_pin_spring_not_ok">Not OK
    </div>
</div>

<h3>4. GLASS ASSY.</h3>
<div style="display: flex;">
    <div>
        <label for="glass_frame_fitment">All Glass Frame fitment:</label>
    </div>            
    <div>
        <pre>     </pre>
    </div>    
    <div>
        <input type="radio" name="glass_frame_fitment" value="OK" id="glass_frame_fitment_ok">OK
        <input type="radio" name="glass_frame_fitment" value="Not OK" id="glass_frame_fitment_not_ok">Not OK
    </div>
</div>

<div style="display: flex;">
    <div>
        <label for="any_discrepancies">Any discrepancies:</label>
    </div>            
    <div>
        <pre>     </pre>
    </div>    
    <div>
        <input type="radio" name="any_discrepancies" value="OK" id="any_discrepancies_ok">OK
        <input type="radio" name="any_discrepancies" value="Not OK" id="any_discrepancies_not_ok">Not OK
    </div>
</div>

<h3>5. REDUCTION GEARBOX (WINCH ASSY.)</h3>
<div style="display: flex;">
    <div>
        <label for="reduction_gearbox_fitment">Fitment & function:</label>
    </div>            
    <div>
        <pre>     </pre>
    </div>    
    <div>
        <input type="radio" name="reduction_gearbox_fitment" value="OK" id="reduction_gearbox_fitment_ok">OK
        <input type="radio" name="reduction_gearbox_fitment" value="Not OK" id="reduction_gearbox_fitment_not_ok">Not OK
    </div>
</div>

<h3>6. SWC</h3>
<div style="display: flex;">
    <div>
        <label for="swc_fitment">Fitment:</label>
    </div>            
    <div>
        <pre>     </pre>
    </div>    
    <div>
        <input type="radio" name="swc_fitment" value="OK" id="swc_fitment_ok">OK
        <input type="radio" name="swc_fitment" value="Not OK" id="swc_fitment_not_ok">Not OK
    </div>
</div>
<h3>7. WIPER</h3>
<div style="display: flex;">
    <div>
        <label for="wiper_fitment">Fitment & function:</label>
    </div>            
    <div>
        <pre>     </pre>
    </div>    
    <div>
        <input type="radio" name="wiper_fitment" value="OK" id="wiper_fitment_ok">OK
        <input type="radio" name="wiper_fitment" value="Not OK" id="wiper_fitment_not_ok">Not OK
    </div>
</div>

<h3>8. HORN</h3>
<div style="display: flex;">
    <div>
        <label for="horn_fitment">Fitment & function:</label>
    </div>            
    <div>
        <pre>     </pre>
    </div>    
    <div>
        <input type="radio" name="horn_fitment" value="OK" id="horn_fitment_ok">OK
        <input type="radio" name="horn_fitment" value="Not OK" id="horn_fitment_not_ok">Not OK
    </div>
</div>

<h3>9. REAR VIEW MIRROR</h3>
<div style="display: flex;">
    <div>
        <label for="rear_view_mirror_fitment">Fitment & function:</label>
    </div>            
    <div>
        <pre>     </pre>
    </div>    
    <div>
        <input type="radio" name="rear_view_mirror_fitment" value="OK" id="rear_view_mirror_fitment_ok">OK
        <input type="radio" name="rear_view_mirror_fitment" value="Not OK" id="rear_view_mirror_fitment_not_ok">Not OK
    </div>
</div>
<h3>10. FUEL TANK COVER</h3>
<div style="display: flex;">
    <div>
        <label for="fuel_tank_cover_fitment">Fuel tank cover fitment:</label>
    </div>            
    <div>
        <pre>     </pre>
    </div>    
    <div>
        <input type="radio" name="fuel_tank_cover_fitment" value="OK" id="fuel_tank_cover_fitment_ok">OK
        <input type="radio" name="fuel_tank_cover_fitment" value="Not OK" id="fuel_tank_cover_fitment_not_ok">Not OK
    </div>
</div>

<h3>11. EXHAUST</h3>
<div style="display: flex;">
    <div>
        <label for="exhaust_fitment">Exhaust fitment:</label>
    </div>            
    <div>
        <pre>     </pre>
    </div>    
    <div>
        <input type="radio" name="exhaust_fitment" value="OK" id="exhaust_fitment_ok">OK
        <input type="radio" name="exhaust_fitment" value="Not OK" id="exhaust_fitment_not_ok">Not OK
    </div>
</div>

<h3>12. EXHAUST TAIL PIPE</h3>
<div style="display: flex;">
    <div>
        <label for="exhaust_tail_pipe_fitment">Exhaust tail pipe fitment:</label>
    </div>            
    <div>
        <pre>     </pre>
    </div>    
    <div>
        <input type="radio" name="exhaust_tail_pipe_fitment" value="OK" id="exhaust_tail_pipe_fitment_ok">OK
        <input type="radio" name="exhaust_tail_pipe_fitment" value="Not OK" id="exhaust_tail_pipe_fitment_not_ok">Not OK
    </div>
</div>

<h3>13. LADDER</h3>
<div style="display: flex;">
    <div>
        <label for="ladder_fitment">Ladder fitment:</label>
    </div>            
    <div>
        <pre>     </pre>
    </div>    
    <div>
        <input type="radio" name="ladder_fitment" value="OK" id="ladder_fitment_ok">OK
        <input type="radio" name="ladder_fitment" value="Not OK" id="ladder_fitment_not_ok">Not OK
    </div>
</div>

<h3>14. FRONT BUMPER</h3>
<div style="display: flex;">
    <div>
        <label for="front_bumper_fitment">Front bumper fitment:</label>
    </div>            
    <div>
        <pre>     </pre>
    </div>    
    <div>
        <input type="radio" name="front_bumper_fitment" value="OK" id="front_bumper_fitment_ok">OK
        <input type="radio" name="front_bumper_fitment" value="Not OK" id="front_bumper_fitment_not_ok">Not OK
    </div>
</div>

<h3>15. CAMOUFLAGE POLE</h3>
<div style="display: flex;">
    <div>
        <label for="camouflage_pole_fitment">Camouflage pole fitment:</label>
    </div>            
    <div>
        <pre>     </pre>
    </div>    
    <div>
        <input type="radio" name="camouflage_pole_fitment" value="OK" id="camouflage_pole_fitment_ok">OK
        <input type="radio" name="camouflage_pole_fitment" value="Not OK" id="camouflage_pole_fitment_not_ok">Not OK
    </div>
</div>

<h3>16. AGB COVER FITMENT</h3>
<div style="display: flex;">
    <div>
        <label for="agb_cover_fitment">AGB cover fitment:</label>
    </div>            
    <div>
        <pre>     </pre>
    </div>    
    <div>
        <input type="radio" name="agb_cover_fitment" value="OK" id="agb_cover_fitment_ok">OK
        <input type="radio" name="agb_cover_fitment" value="Not OK" id="agb_cover_fitment_not_ok">Not OK
    </div>
</div>

<h3>17. FENDER MTG. AND FITMENT</h3>
<div style="display: flex;">
    <div>
        <label for="fender_mounting_fitment">Fender mounting and fitment:</label>
    </div>            
    <div>
        <pre>     </pre>
    </div>    
    <div>
        <input type="radio" name="fender_mounting_fitment" value="OK" id="fender_mounting_fitment_ok">OK
        <input type="radio" name="fender_mounting_fitment" value="Not OK" id="fender_mounting_fitment_not_ok">Not OK
    </div>
</div>

<h3>18. MUD FLAP</h3>
<div style="display: flex;">
    <div>
        <label for="mud_flap_fitment">Mud flap fitment:</label>
    </div>            
    <div>
        <pre>     </pre>
    </div>    
    <div>
        <input type="radio" name="mud_flap_fitment" value="OK" id="mud_flap_fitment_ok">OK
        <input type="radio" name="mud_flap_fitment" value="Not OK" id="mud_flap_fitment_not_ok">Not OK
    </div>
</div>

<h3>19. HATCH COVER (FITMENT & FUNCTION)</h3>
<div style="display: flex;">
    <div>
        <label for="hatch_cover_fitment_function">Hatch cover fitment & function:</label>
    </div>            
    <div>
        <pre>     </pre>
    </div>    
    <div>
        <input type="radio" name="hatch_cover_fitment_function" value="OK" id="hatch_cover_fitment_function_ok">OK
        <input type="radio" name="hatch_cover_fitment_function" value="Not OK" id="hatch_cover_fitment_function_not_ok">Not OK
    </div>
</div>

<h3>20. TURRET (FITMENT & FUNCTION)</h3>
<div style="display: flex;">
    <div>
        <label for="turret_fitment_function">Turret fitment & function:</label>
    </div>            
    <div>
        <pre>     </pre>
    </div>    
    <div>
        <input type="radio" name="turret_fitment_function" value="OK" id="turret_fitment_function_ok">OK
        <input type="radio" name="turret_fitment_function" value="Not OK" id="turret_fitment_function_not_ok">Not OK
    </div>
</div>

<h3>21. AC MOUNTING & FITMENT</h3>
<div style="display: flex;">
    <div>
        <label for="ac_mounting_fitment">AC mounting & fitment:</label>
    </div>            
    <div>
        <pre>     </pre>
    </div>    
    <div>
        <input type="radio" name="ac_mounting_fitment" value="OK" id="ac_mounting_fitment_ok">OK
        <input type="radio" name="ac_mounting_fitment" value="Not OK" id="ac_mounting_fitment_not_ok">Not OK
    </div>
</div>

        <h3>INTERIOR INSPECTION</h3>
<div style="display: flex;">
    <div>
        <label for="floor_gap_near_rear_door">Floor gap near rear door:</label>
    </div>            
    <div>
        <pre>     </pre>
    </div>    
    <div>
        <input type="radio" name="floor_gap_near_rear_door" value="OK" id="floor_gap_near_rear_door_ok">OK
        <input type="radio" name="floor_gap_near_rear_door" value="Not OK" id="floor_gap_near_rear_door_not_ok">Not OK
    </div>
</div>

<div style="display: flex;">
    <div>
        <label for="flooring">Flooring:</label>
    </div>            
    <div>
        <pre>     </pre>
    </div>    
    <div>
        <input type="radio" name="flooring" value="OK" id="flooring_ok">OK
        <input type="radio" name="flooring" value="Not OK" id="flooring_not_ok">Not OK
    </div>
</div>

<div style="display: flex;">
    <div>
        <label for="troop_seat_fitment">Troop seat fitment:</label>
    </div>            
    <div>
        <pre>     </pre>
    </div>    
    <div>
        <input type="radio" name="troop_seat_fitment" value="OK" id="troop_seat_fitment_ok">OK
        <input type="radio" name="troop_seat_fitment" value="Not OK" id="troop_seat_fitment_not_ok">Not OK
    </div>
</div>

<div style="display: flex;">
    <div>
        <label for="safety_belt">Safety belt:</label>
    </div>            
    <div>
        <pre>     </pre>
    </div>    
    <div>
        <input type="radio" name="safety_belt" value="OK" id="safety_belt_ok">OK
        <input type="radio" name="safety_belt" value="Not OK" id="safety_belt_not_ok">Not OK
    </div>
</div>

<div style="display: flex;">
    <div>
        <label for="handle">Handle:</label>
    </div>            
    <div>
        <pre>     </pre>
    </div>    
    <div>
        <input type="radio" name="handle" value="OK" id="handle_ok">OK
        <input type="radio" name="handle" value="Not OK" id="handle_not_ok">Not OK
    </div>
</div>

<div style="display: flex;">
    <div>
        <label for="water_tank">Water tank:</label>
    </div>            
    <div>
        <pre>     </pre>
    </div>    
    <div>
        <input type="radio" name="water_tank" value="OK" id="water_tank_ok">OK
        <input type="radio" name="water_tank" value="Not OK" id="water_tank_not_ok">Not OK
    </div>
</div>

<div style="display: flex;">
    <div>
        <label for="battery_cover">Battery cover:</label>
    </div>            
    <div>
        <pre>     </pre>
    </div>    
    <div>
        <input type="radio" name="battery_cover" value="OK" id="battery_cover_ok">OK
        <input type="radio" name="battery_cover" value="Not OK" id="battery_cover_not_ok">Not OK
    </div>
</div>

<div style="display: flex;">
    <div>
        <label for="isolator_switch">Isolator switch:</label>
    </div>            
    <div>
        <pre>     </pre>
    </div>    
    <div>
        <input type="radio" name="isolator_switch" value="OK" id="isolator_switch_ok">OK
        <input type="radio" name="isolator_switch" value="Not OK" id="isolator_switch_not_ok">Not OK
    </div>
</div>

<div style="display: flex;">
    <div>
        <label for="driver_codriver_seat">Driver /Co-Driver seat:</label>
    </div>            
    <div>
        <pre>     </pre>
    </div>    
    <div>
        <input type="radio" name="driver_codriver_seat" value="OK" id="driver_codriver_seat_ok">OK
        <input type="radio" name="driver_codriver_seat" value="Not OK" id="driver_codriver_seat_not_ok">Not OK
    </div>
</div>

<div style="display: flex;">
    <div>
        <label for="piping_clamping">All piping clamping:</label>
    </div>            
    <div>
        <pre>     </pre>
    </div>    
    <div>
        <input type="radio" name="piping_clamping" value="OK" id="piping_clamping_ok">OK
        <input type="radio" name="piping_clamping" value="Not OK" id="piping_clamping_not_ok">Not OK
    </div>
</div>

<div style="display: flex;">
    <div>
        <label for="dashboard">Dash board:</label>
    </div>            
    <div>
        <pre>     </pre>
    </div>    
    <div>
        <input type="radio" name="dashboard" value="OK" id="dashboard_ok">OK
        <input type="radio" name="dashboard" value="Not OK" id="dashboard_not_ok">Not OK
    </div>
</div>

<div style="display: flex;">
    <div>
        <label for="switches_gauges">All switches and gauges:</label>
    </div>            
    <div>
        <pre>     </pre>
    </div>    
    <div>
        <input type="radio" name="switches_gauges" value="OK" id="switches_gauges_ok">OK
        <input type="radio" name="switches_gauges" value="Not OK" id="switches_gauges_not_ok">Not OK
    </div>
</div>

<div style="display: flex;">
    <div>
        <label for="hand_brake_fitment">Hand brake fitment:</label>
    </div>            
    <div>
        <pre>     </pre>
    </div>    
    <div>
        <input type="radio" name="hand_brake_fitment" value="OK" id="hand_brake_fitment_ok">OK
        <input type="radio" name="hand_brake_fitment" value="Not OK" id="hand_brake_fitment_not_ok">Not OK
    </div>
</div>

<div style="display: flex;">
    <div>
        <label for="acc_brake_clutch_pedal_position">Acc/brake/clutch pedal position:</label>
    </div>            
    <div>
        <pre>     </pre>
    </div>    
    <div>
        <input type="radio" name="acc_brake_clutch_pedal_position" value="OK" id="acc_brake_clutch_pedal_position_ok">OK
        <input type="radio" name="acc_brake_clutch_pedal_position" value="Not OK" id="acc_brake_clutch_pedal_position_not_ok">Not OK
    </div>
</div>

<div style="display: flex;">
    <div>
        <label for="electrical_work">All electrical work (fitment & function):</label>
    </div>            
    <div>
        <pre>     </pre>
    </div>    
    <div>
        <input type="radio" name="electrical_work" value="OK" id="electrical_work_ok">OK
        <input type="radio" name="electrical_work" value="Not OK" id="electrical_work_not_ok">Not OK
    </div>
</div>

<div style="display: flex;">
    <div>
        <label for="fire_extinguishers">Fire Extinguishers:</label>
    </div>            
    <div>
        <pre>     </pre>
    </div>    
    <div>
        <input type="radio" name="fire_extinguishers" value="OK" id="fire_extinguishers_ok">OK
        <input type="radio" name="fire_extinguishers" value="Not OK" id="fire_extinguishers_not_ok">Not OK
    </div>
</div>

    <br><br>


    <div style="margin-bottom: 3rem;">
        <label for="remarks">Other Remarks:</label>
        <textarea id="remarks" name="remarks" class="remarks" ></textarea>
    </div>    

    <div class="signatures">
        <h3>Signature of trainee (Reverse)</h3>
        <h3></h3>
        <h3>Remark of training officer</h3>
        <h3></h3>
        <h3></h3>
        <h3>Training Officer Signature</h3>
    </div>

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
