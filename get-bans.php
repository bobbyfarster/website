<?php
try {
    $conn = new PDO("mysql:host=localhost;dbname=thatgmod_sg1122", 'thatgmod_sg2211', 'readbobby123');
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // prepare sql and bind parameters
    $stmt = $conn->prepare("SELECT `steam_id`, `player`, `reason`, `start_time`, `end_time`, `admin` FROM `serverguard_bans` ORDER BY `start_time` DESC");
    $result = $stmt->execute();
   

    $ip = $_SERVER['REMOTE_ADDR'] . "\n";  
    $json = file_get_contents('http://ip-api.com/json/' . substr($ip, 0, -1)); 
    $ipData = json_decode($json, true);
    $timezone = $ipData["timezone"]; 
    date_default_timezone_set($timezone);
    //echo date_default_timezone_get();

    if ($result) {
        while ($row = $stmt->fetch()) {
            $epoch = $row['end_time'];

            $end_time = "default";
            if ($epoch === "0") {
                $end_time = '<span style="color: red; font-size: 15px;">Permanent ';
            } else if (time() <= (int)$epoch) { 
                $end_time = date("m-d-Y h:i A", $epoch);
            } else {
                $end_time = '<span style="color: green; font-size: 15px;">Expired ';
            }
            
                
            
            $namePos = strpos($row['admin'], ')');
            if ($namePos === false) {
                $namePos = 0;
            } else {
                $namePos = $namePos + 2;
            }
            
            echo "<tr><td><span class='data'>". $row['player'] . "</span></td><td><span class='data'>" . $row['steam_id'] . "</span></td><td><span class='data'>" . date("m-d-Y h:i A", $row['start_time']) . "</span></td><td><span class='data'>". $row['reason'] . "</span></td><td><span class='data'>" . $end_time . "</span></td><td><span class='data'>". substr($row['admin'], $namePos) . "</span></td></tr>";
            
                
                
        
        }
    }
}   
    
    catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = true;

?>