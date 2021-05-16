<?php 
// ini_set('session.cookie_lifetime', 60 * 60 * 24 * 100);
// ini_set('session.gc_maxlifetime', 60 * 60 * 24 * 100);
// ini_set('session.save_path', '/tmp');

session_start();
include_once("database.php");

ini_set('display_errors', '0');

//
$logged=0;
if (isset($_SESSION['email'])&&isset($_SESSION['password']))
{
        $session_password = $_SESSION['password'];
        $session_email =  $_SESSION['email'];
        $query = "SELECT *  FROM gpxCollaborate_users WHERE email='$session_email' AND password='$session_password'";
        $result = $con->query($query);
        if ($result->num_rows > 0){
            while($row = $result->fetch_assoc()) 
            {
            $logged=1;
            $session_role = $row['role'];
            $session_id = $row['id'];
            $session_userId = $row['id'];
            $session_name = $row['name'];
            $session_email = $row['email'];
            $session_phone = $row['phone'];
            $session_address = $row['address'];
            $session_about = $row['about'];
            $session_pic = $row['pic'];
            $session_dob = $row['dob'];
            $session_password = $row['password'];
            $session_city = $row['city'];
            $session_state = $row['state'];
            $session_data = $row;

            }
        }
        else
        {
                $logged=0;
        }
}


if(isset($_SESSION['usernumber'])){
    $usernumber = $_SESSION['usernumber'];
    $sq     = "SELECT * from gpxCollaborate_users where usernumber = '$usernumber'  ";
        $result = $con->query($sq);
        $num    = mysqli_num_rows($result);
        
        if ($num == 1) {
        	$logged = 1;
    	    	while ($row = $result->fetch_assoc()) {
    	    		$_SESSION['id'] = $row['id'];
    	    		$session_name = $row['name'];
    	            $session_email = $email;
    	            $session_userId = $row['id'];
    	            $session_role = $row['role'];
    	    }
        }
}




function mb_htmlentities($string, $hex = true, $encoding = 'UTF-8') {
    global $con;
    return mysqli_real_escape_string($con, $string);
    /**
    return preg_replace_callback('/[\x{80}-\x{10FFFF}]/u', function ($match) use ($hex) {
        return (sprintf($hex ? '&#x%X;' : '&#%d;', mb_ord($match[0])));
    }, $string);
    **/

}


function generateRandomString($length = 10) {
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}


function editDelete($table, $row, $id, $id_value, $whichBtns="ed"){
    global $session_role;
    global $g_main_admin_id;
    if($session_role=="admin" && $g_main_admin_id=="admin"){
        if (strpos($whichBtns, 'e') !== false) {
        ?>
        <a class="btn btn-sm btn-warning" href="./g_edit.php?t=<?php echo $table?>&r=<?php echo $row?>&i=<?php echo $id?>&iv=<?php echo $id_value?>&c=<?php echo (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";?>" style="color:white;background:orange;">Edit</a>
        <?php }
            if (strpos($whichBtns, 'd') !== false) {
        ?>
        <a class="btn btn-sm btn-danger" href="./g_delete.php?t=<?php echo $table?>&r=<?php echo $row?>&i=<?php echo $id?>&iv=<?php echo $id_value?>&c=<?php echo (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";?>" style="color:white;background:red;">Delete</a>
        <?php 
        }
    }
}


function sendEmailNotification($subject, $message, $email){
    
    
    $to = $email; 
    $from = 'dev.email.sender1@anomoz.com'; 
    $fromName = 'gpxCollaborate'; 
     

    $email_body = $message;
    $htmlContent = $email_body; 
    
        
    // Set content-type header for sending HTML email 
    $headers = "MIME-Version: 1.0" . "\r\n"; 
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
     
    // Additional headers 
    $headers .= 'From: '.$fromName.'<'.$from.'>' . "\r\n"; 

    // Send email 
    if(mail($to, $subject, $htmlContent, $headers)){ 
         //echo "Email sent to: ".$email;
    }else{ 
       echo 'Email sending failed.'; 
    }        
}

function uploadFile($file){
    $randomName = generateRandomString();
    $target_dir = "./uploads/";
    $fileName_db = $randomName.basename($file["name"]);
    $target_file = $target_dir . $fileName_db;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    // Check if image file is a actual image or fake image
    if($file["tmp_name"]!="") {
        $uploadOk = 1;
        // Check if file already exists
        if (file_exists($target_file)) {
            //echo "Sorry, file already exists.";
            $filename=basename( $file["name"]);
            $uploadOk = 1;
        }
            // Check file size
        if ($file["size"] > 5000000000000) {
            $uploadOk = 0;
            return "Sorry, your file is too large.";
        }
        
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            return "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($file["tmp_name"], $target_file)) {
                //echo "The file ". basename( $file["name"]). " has been uploaded.";
                $filename=basename( $file["name"]);
                $uploadOk = 1;
                return $fileName_db;
            } else {
                return "Sorry, there was an error uploading your file.";
            }
        }
    }
}

$g_project_url = "https://projects.anomoz.com/gpxCollaborate/";

$g_project_name = "GPX Collaborate";
$g_main_admin_id = "admin";

$g_routes = array( "Paths (walking/cycling)", "Roads (driving/riding a motorbike)", "Horse tracks", "4x4 tracks");


?>