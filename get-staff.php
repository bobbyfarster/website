<?php
try {
    $conn = new PDO("mysql:host=localhost;dbname=thatgmod_sg1122", 'thatgmod_sg2211', 'readbobby123');
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // prepare sql and bind parameters
    $stmt = $conn->prepare("SELECT `steam_id`, `rank`, `last_played`, `data`, `name` FROM `serverguard_users` 
                WHERE `rank` != 'user' AND `rank` != 'vip' AND `rank` != 'vip+' ORDER BY FIELD(
                                                                       `rank`, 'founder', 'council', 'superadmin', 
                                                                       'doubleadmin', 'advadmin', 'admin', 'moderator') ASC");
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
                $data = date("m-d-Y h:i A", substr($epoch, 0, 10));
            } else {
                $data = '<span style="color: red; font-size: 15px;">Expired! '; 
            } 
            $rank = $row['rank']; 

            if (strpos($row['rank'], "founder")=== 0) {
                $rank = '<span style="color: grey; font-size: 15px;">Root ';
            }
            
             if (strpos($row['rank'], "council")=== 0) {
                $rank = '<span style="color: lightgreen; font-size: 15px;">Council ';
            }
            
            if (strpos($row['rank'], "moderator")=== 0) {
                $rank = '<span style="color: orange; font-size: 15px;">Moderator ';
            }
            
            if (strpos($row['rank'], "admin")=== 0) {
                $rank = '<span style="color: purple; font-size: 15px;">Admin ';
            }
            
            if (strpos($row['rank'], "advadmin")=== 0) {
                $rank = '<span style="color: purple; font-size: 15px;">Advanced Admin ';
            }
            
            if (strpos($row['rank'], "doubleadmin")=== 0) {
                $rank = '<span style="color: lightpink; font-size: 15px;">Double Admin ';
            }
            
            if (strpos($row['rank'], "superadmin")=== 0) {
                $rank = '<span style="color: red; font-size: 15px;">Super Admin ';
            }
           
            echo "<tr><td><span class='data'>". $row['name'] . "</span></td><td><span class='data'>" . $row['steam_id'] . "</span></td><td><span class='data'>" . $rank . "</span></td><td><span class='data'>" . date("m-d-Y h:i A", substr($row['last_played'], 0, 10)) . "</span></td><td><span class='data'>". $data . "</span></td></tr>";
        
        }
    }
}

    catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = true;

?>