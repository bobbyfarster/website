<?php
try {
    $conn = new PDO("mysql:host=localhost;dbname=thatgmod_sg1122", 'thatgmod_sg2211', 'readbobby123');
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // prepare sql and bind parameters
    $stmt = $conn->prepare("SELECT `steam_id`, `rank`, `last_played`, `data`, `name` FROM `serverguard_users`");
    $result = $stmt->execute();
   

    $ip = $_SERVER['REMOTE_ADDR'] . "\n";  
    $json = file_get_contents('http://ip-api.com/json/' . substr($ip, 0, -1)); 
    $ipData = json_decode($json, true);
    $timezone = $ipData["timezone"]; 
    date_default_timezone_set($timezone);
    //echo date_default_timezone_get();

    if ($result) {
        while ($row = $stmt->fetch()) {
            $epoch = substr($row['data'], 16);

            if ($epoch === "0") {
                $data = "Never";
            } else if (time() <= (int)$epoch) { 
                $data = date("m-d-Y h:i:s A", substr($epoch, 0, 10));
            } else {
                $data = "Expired!"; 
            } 
            $rank = $row['rank']; 

            if (strpos($row['rank'], "founder")=== 0) {
                $rank = "Root";
            }
            
             if (strpos($row['rank'], "council")=== 0) {
                $rank = "Council";
            }
            
            if (strpos($row['rank'], "moderator")=== 0) {
                $rank = "Moderator";
            }
            
            if (strpos($row['rank'], "admin")=== 0) {
                $rank = "Admin";
            }
            
            if (strpos($row['rank'], "advadmin")=== 0) {
                $rank = "Advanced Admin";
            }
            
            if (strpos($row['rank'], "doubleadmin")=== 0) {
                $rank = "Double Admin";
            }
            
            if (strpos($row['rank'], "superadmin")=== 0) {
                $rank = "Super Admin";
            }
            echo "<tr><td><span class='data'>". $row['name'] . "</span></td><td><span class='data'>" . $row['steam_id'] . "</span></td><td><span class='data'>" . $rank . "</span></td><td><span class='data'>" . date("m-d-Y h:i:s A", substr($row['last_played'], 0, 10)) . "</span></td><td><span class='data'>". $data . "</span></td></tr>";
        
        }
    }
}
    catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = true;

?>