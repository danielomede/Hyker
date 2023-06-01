<?
include 'auth.php';

function generateCode($limit){
    $code = '';
    for ($i = 0; $i < $limit; $i++) { 
        $code .= mt_rand(0, 9); 
        
    }
    return $code;
}

if(isset($_POST['updateavatar'])){
    $thisuser = mysqli_real_escape_string($conn, $_POST['user']);
    $newImageName= generateCode(10);
	$file_tmp = $_FILES["fileImg2"]["tmp_name"];
	$file_name = $_FILES["fileImg2"]["name"];
	$file_path = "media/".$newImageName;
	
	if(file_exists($file_path)){
    	    
    	 $error = "Error: The image <b>".$file_name."</b> already exists.";
    			
    } else {
    	
        $didUpload = move_uploaded_file($file_tmp, $file_path);
        
        if ($didUpload) {
          echo "The file " . basename($file_name) . " has been uploaded";
        }            
           
    	$updateuser = "UPDATE `users` SET  `imgurl`='$file_path' WHERE `users`.`id` ='$thisuser'";
    	
        	if (mysqli_query($conn, $updateuser)) {
        	     
            	echo "<script>window.open('index.php','_self')</script>";
            } else {
                echo "Error: " . $updateuser . "<br>" . mysqli_error($conn);
            }    
   }
    
}

if(isset($_POST['updateprofile'])){
    
    
    $newusername = mysqli_real_escape_string($conn, $_POST['username']);
    $newemail = mysqli_real_escape_string($conn, $_POST['email']);
    
    $newphone = mysqli_real_escape_string($conn, $_POST['phone']);
    $newuser = mysqli_real_escape_string($conn, $_POST['user']);
	
	/*
	echo $newusername; 
	echo $newemail;
	echo $newphone;
	echo $newuser; 
	*/
     if ($didUpload) {
          echo "The file " . basename($file_name) . " has been uploaded";
        }            
           
    	$updateuser = "UPDATE `users` SET `username`='$newusername', `email`='$newemail', `phone`='$newphone',  WHERE `users`.`id` ='$newuser'";
    	
        	if (mysqli_query($conn, $updateuser)) {
        	     
            	echo "<script>window.open('index.php','_self')</script>";
            } else {
                echo "Error: " . $updateuser . "<br>" . mysqli_error($conn);
            }    
   
	
	
}


if(isset($_POST['creategroup'])){
    
    function generateCode($limit){
    $code = '';
    for($i = 0; $i < $limit; $i++) { $code .= mt_rand(0, 9); }
    return $code;
    }
    
    //Form metadata
    $ref = generateCode(10);
    
    $groupname = mysqli_real_escape_string($conn, $_POST['groupname']);
    $createdby = mysqli_real_escape_string($conn, $_POST['createdby']);
    $reference = 'GRP'.$ref;
    $datecreated = date("Y-m-d h:i:sa");
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $state = mysqli_real_escape_string($conn, $_POST['state']);
	
	
	//image data
	$newImageName= generateCode(10);
	$file_tmp = $_FILES["fileImg"]["tmp_name"];
	$file_name = $_FILES["fileImg"]["name"];
	$file_path = "media/".$newImageName;
	
    if(file_exists($file_path)){
    	    
    	 $error = "Error: The image <b>".$file_name."</b> already exists.";
    			
    	} else {
    	
            $didUpload = move_uploaded_file($file_tmp, $file_path);
            
            if ($didUpload) {
              echo "The file " . basename($file_name) . " has been uploaded";
            }            
               
        	$newGRP = "INSERT INTO `groups` (`id`, `name`, `description`, `reference`, `state`, `status`, `datecreated`, `createdby`, `imgurl`)
        	                        VALUES (NULL, '$groupname', '$description', '$reference', '$state', 'new', CURRENT_TIMESTAMP, '$createdby', '$file_path')";
        	
        	 
            	if (mysqli_query($conn, $newGRP)) {
            	     $addmember = "INSERT INTO `group_members` (`id`, `group_reference`, `userid`, `timestamp`) VALUES (NULL, '$reference', '$createdby', CURRENT_TIMESTAMP)";
                     mysqli_query($conn, $addmember);
                	#echo "<script>alert('channel Created')</script>";
                	
                	echo "<script>window.open('group.php?ref=$reference','_self')</script>";
                } else {
                    echo "Error: " . $newGRP . "<br>" . mysqli_error($conn);
                }    
       } 
}


if(isset($_POST['createevent'])){
    
    function generateCode($limit){
    $code = '';
    for($i = 0; $i < $limit; $i++) { $code .= mt_rand(0, 9); }
    return $code;
    }
    
    //Form metadata
    $ref = generateCode(10);
    
    $eventname = mysqli_real_escape_string($conn, $_POST['eventname']);
    $createdby = mysqli_real_escape_string($conn, $_POST['createdby']);
    $admin = mysqli_real_escape_string($conn, $_POST['admin']);
    $reference = 'EVNT'.$ref;
    $details = mysqli_real_escape_string($conn, $_POST['details']);
    $datecreated = date("Y-m-d");
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    $eventdate = $_POST['eventdate'];
	$eventtime = $_POST['eventtime'];
	
	$location = $_POST['location'];
	$rallypoint = $_POST['rallypoint'];
	$category = $_POST['category'];
	$cost = $_POST['cost'];
	//image data
	$newImageName= generateCode(10);
	$file_tmp = $_FILES["fileImg"]["tmp_name"];
	$file_name = $_FILES["fileImg"]["name"];
	$file_path = "media/".$newImageName;
	
    if(file_exists($file_path)){
    	    
    	 $error = "Error: The image <b>".$file_name."</b> already exists.";
    			
    	} else {
    	
            $didUpload = move_uploaded_file($file_tmp, $file_path);
            
            if ($didUpload) {
              echo "The file " . basename($file_name) . " has been uploaded";
            }            
               
        	$newEVNT = "INSERT INTO `events` (`id`, `name`, `createdby`, `admin`, `reference`, `details`, `datecreated`, `status`, `eventdate`, `eventtime`, `location`, `rallypoint`, `imgurl`, `category`, `cost`) 
        	                         VALUES (NULL, '$eventname', '$createdby', '$admin', '$reference', '$details', '$datecreated', 'Upcoming', '$eventdate', '$eventtime', '$location', '$rallypoint', '$filepath', '$category', '$cost')";
        	
        	 
            	if (mysqli_query($conn, $newEVNT)) {
            	     $addmember = "INSERT INTO `event_members` (`id`, `event_reference`, `userid`, `timestamp`) VALUES (NULL, '$reference', '$createdby', CURRENT_TIMESTAMP)";
                     mysqli_query($conn, $addmember);
                	#echo "<script>alert('channel Created')</script>";
                	
                	echo "<script>window.open('event.php?ref=$reference','_self')</script>";
                } else {
                    echo "Error: " . $newEVNT . "<br>" . mysqli_error($conn);
                }    
            
    	} 
}

?>