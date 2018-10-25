<!DOCTYPE html>
<html>
<head>
    <title>Staff</title>

    
    <meta charset="UTF-8">
	<!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<body>
<?php include '../nav.php';?>
<div class="container-fluid">
    <div class="header-boxes">
        <div class="row">
            <img src="../forum/images/netpen/logo.png" id="logo" alt="Dank RP Logo" style="margin-left: auto;margin-right: auto;display: block;">
        </div>
        <div class="row">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="data">Name</th>
                            <th class="data">Steam ID</th>
                            <th class="data">Rank</th>
                            <th class="data">Last Played</th>
                            <th class="data">Expire</th>
                        </tr>
                    </thead>
                    <tbody id="staff_list">
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

     <script type="text/javascript">
    
    $(function () {
        var xhttp = new XMLHttpRequest();
        xhttp.open("GET", "../get-staff.php", true);

        xhttp.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
                $("#staff_list").html(xhttp.responseText);
            }
        }
        
        xhttp.send();
        
    });
    </script>
</body>
</html>