<?php 
    if($_SERVER["REQUEST_METHOD"] != "POST"){
    	$newPageURL = "index.php";
    	header("Location: $newPageURL");
    	exit();
    }
    
    
    date_default_timezone_set("Asia/Dhaka");
    
    function convertGpaToLetterGrade($gpa) {
    	if ($gpa >= 4.00) {
    		return 'A+';
    	}
		elseif ($gpa >= 3.75) {
    		return 'A';
    	}
		elseif ($gpa >= 3.50) {
    		return 'A-';
    	}
		elseif ($gpa >= 3.25) {
    		return 'B+';
    	}
		elseif ($gpa >= 3.00) {
    		return 'B';
    	}
		elseif ($gpa >= 2.75) {
    		return 'B-';
    	}
		elseif ($gpa >= 2.50) {
    		return 'C+';
    	}
		elseif ($gpa >= 2.25) {
    		return 'C';
    	}
		elseif ($gpa >= 2.00) {
    		return 'D';
    	}
		else {
    		return 'F';
    	}
    }
    
    
    function get_ip() {
    	$ip = '';
    	if (isset($_SERVER['HTTP_CLIENT_IP'])){
    		$ip = $_SERVER['HTTP_CLIENT_IP'];
    	}
		else if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])){
    		$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    	}
		else if(isset($_SERVER['HTTP_X_FORWARDED'])){
    		$ip = $_SERVER['HTTP_X_FORWARDED'];
    	}
		else if(isset($_SERVER['HTTP_FORWARDED_FOR'])){
    		$ip = $_SERVER['HTTP_FORWARDED_FOR'];
    	}
		else if(isset($_SERVER['HTTP_FORWARDED'])){
    		$ip = $_SERVER['HTTP_FORWARDED'];
    	}
		else if(isset($_SERVER['REMOTE_ADDR'])){
    		$ip = $_SERVER['REMOTE_ADDR'];
    	}
    	if( empty($ip) || $ip == '0.0.0.0' || substr( $ip, 0, 2 ) == '::' ){
    		$ip = file_get_contents('https://api.ipify.org/');
    		$ip = ($ip===false?$ip:'');
    	}
    	return $ip;
    }
    
    
    $student_id = $_POST['student_id'];
    $current_semester = intval($_POST['current_semester']);
    	
    	
    $servername = "localhost:3306";
    $username = "kkcedubd_bsfmstu";
    $password = "Tumi*Ami";
    $dbname = "kkcedubd_bsfmstu";
    
    $conn = new mysqli($servername, $username, $password, $dbname);
    $sql = "SELECT name, department, session FROM student WHERE ID=$student_id";
    $result = $conn->query($sql)->fetch_assoc();
    
    $name = $result["name"];
    $session = $result["session"];
    $department = $result['department'];
    
    
    if($current_semester==1){
    	$exam_name = "1<sup>st</sup> Year - 1<sup>st</sup> Semester";
    }
    if($current_semester==2){
    	$exam_name = "1<sup>st</sup> Year - 2nd Semester";
    }
    if($current_semester==3){
    	$exam_name = "2<sup>nd</sup> Year - 1<sup>st</sup> Semester";
    }
    if($current_semester==4){
    	$exam_name = "2<sup>nd</sup> Year - 2<sup>nd</sup> Semester";
    }
    if($current_semester==5){
    	$exam_name = "3<sup>rd</sup> Year - 1<sup>st</sup> Semester";
    }
    if($current_semester==6){
    	$exam_name = "3<sup>rd</sup> Year - 2<sup>nd</sup> Semester";
    }
    if($current_semester==7){
    	$exam_name = "4<sup>th</sup> Year - 1<sup>st</sup> Semester";
    }
    if($current_semester==8){
    	$exam_name = "4<sup>th</sup> Year - 2<sup>nd</sup> Semester";
    }
    
    
    
    $sql = "SELECT result.grade_point, course.credit FROM course JOIN result ON course.course_code = result.course_code WHERE course.semester = $current_semester and result.id=$student_id";						
    $result = $conn->query($sql);
    
    $credit_sum = 0;
    $sum = 0;
    while($row = $result->fetch_assoc()){
    	$credit_sum += $row["credit"];
    	$sum += $row["credit"] * $row["grade_point"];
    }
    if($credit_sum) {
    	$GPA = $sum / $credit_sum;
    	$GPA = number_format($GPA, 2);
    }
    else $GPA = "";
    
    
    
    
    $sql = "SELECT result.grade_point, course.credit FROM course JOIN result ON course.course_code = result.course_code WHERE result.id=$student_id";						
    $result = $conn->query($sql);
    
    $credit_sum = 0;
    $sum = 0;
    while($row = $result->fetch_assoc()){
    	$credit_sum += $row["credit"];
    	$sum += $row["credit"] * $row["grade_point"];
    }
    if($credit_sum) {
    	$CGPA = $sum / $credit_sum;
    	$CGPA = number_format($CGPA, 2);
    }
    else $CGPA = "";
    
    
    if($CGPA >= 2.50 && $GPA >= 2.0) $res_text = "Passed";
    else $res_text = "Failed";
    
    if($GPA == "") {
    	$res_text = "";
    }
    
    
    ?>
	
	
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <script type="text/javascript" src="js/jquery.min.js"></script>
        <link href="css/toastr.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <script src="js/toastr.js"></script>
        <script src="js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <link href="css/select.min.css" rel="stylesheet">
        <script src="js/select.min.js"></script>
        <title>Result Archive | Bangamata Sheikh Fojilatunnesa Mujib Science & Technology University</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- App favicon -->
        <link rel="shortcut icon" href="images/logo.png">
        <!-- Plugins css-->
        <link href="css/sweetalert.min.css" rel="stylesheet" type="text/css">
        <!-- App css -->
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bootstrap-stylesheet">
        <link href="css/icons.min.css" rel="stylesheet" type="text/css">
        <link href="css/app.min.css" rel="stylesheet" type="text/css" id="app-stylesheet">
    </head>
    <body data-layout="horizontal" data-new-gr-c-s-check-loaded="14.1149.0" data-gr-ext-installed="">
        <!-- Begin page -->
		<header class="" style="background-color: #265077;height: 50px;    position: sticky;    top: 0;    z-index: 1000;">
			<div class="container-fluid" style="max-width: 100%;">
				<div class="row">
					<nav class="navbar navbar-expand-lg navbar-dark bg-custom" style="margin-top: -9px;">
						<a class="navbar-brand" href="http://bsfmstu.ac.bd/">
							 <img src="https://profile.bsfmstu.ac.bd/img/logo.png" width="40" height="40" alt="">
							 <span class="ml-2">Result Archive, BSFMSTU</span>


						</a>
        
					</nav>
				</div>
			</div>
		</header>
			
			
        <div id="wrapper" style=" margin-top: -12px;">

            <div class="ggcontent-page" data-select2-id="select2-data-11-2xcl">
                <div class="ggcontent" data-select2-id="select2-data-10-pyh3">
                    <!-- Start Content-->
                    <div class="ggcontainer-fluid" data-select2-id="select2-data-9-qbm6">
                        <div class="ddcol-12 " data-select2-id="select2-data-8-dz71">
                            <!-- Portlet card -->
                            <div class="card" id="for_print" style="justify-content:center; margin:2%;" data-select2-id="select2-data-for_print">
                                
                                <div id="cardCollpase9" class="collapse show" data-select2-id="select2-data-cardCollpase9">
                                    <div class="card-body" data-select2-id="select2-data-7-9872" style="    padding: 0.5rem;">
                                        <div class="row" id="result_preview" onload="get_exam()" data-select2-id="select2-data-result_preview">
                                            <div class="container-fluid" style="    max-width: 100%;">
                                                <div class="card-header bg-infos py-3 text-white" style="padding: 1px !important;
background-color: #265077; margin-top:-1px;">
                                                    <!-- App css -->
													<h4 id="univ_name" class="text-white" style="text-align:center;font-size: 30px;">Result Archive</h4>
                                                    <h4 class="text-white" style="text-align:center;font-size: 18px;"><?php echo $exam_name; ?>, BSFMSTU</h4>
                                                    <input type="hidden" id="exam_name" value="">
                                                </div>
                                                <div class="row">
                                                    <!-- Start Profile Widget -->
                                                    <div class="col-xl-4">
                                                        <div class="card">
                                                            <div class="profile-widget text-center">
                                                                <div class="bg-infos p-5 bg-profile" style="background-color: #265077;"></div>
                                                                <img src="images/student.png" class="avatar-lg rounded-circle img-thumbnail" alt="img" style="margin-top: -54px;height: 10.5rem;width: 10.5rem;">
                                                                <h4 id="" class="mt-4"><?php echo $name; ?></h4>
                                                                <input type="hidden" id="student_name" value="PARTHO SUTRA DHOR - 2016013539">
                                                                <p class="mt-2"></p>
                                                                <div class="table-responsive">
                                                                    <table class="table table-bordered" style="text-align: left;">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td>Student ID No.</td>
                                                                                <td><?php echo $student_id; ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Department</td>
                                                                                <td><?php echo $department; ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Session</td>
                                                                                <td><?php echo $session; ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td><b>GPA</b></td>
                                                                                <td><b><?php echo $GPA; ?></b></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td><b>CGPA</b> </td>
                                                                                <td><b><?php echo $CGPA; ?></b></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td><b>Result</b> </td>
                                                                                <td><b><?php echo $res_text; ?></b></td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- End Profile Widget -->
                                                    <!-- COURSE MARKS INFO END -->
                                                    <div class="col-xl-8" style="">
                                                        <div class="table-responsive">
                                                            <table class="table table-bordered">
                                                                <thead>
                                                                    <tr style="background: #265077;
                                                                        color: white;">
                                                                        <th style="text-align:center;">Course Code</th>
                                                                        <th style="text-align:center;">Course Title</th>
                                                                        <th style="text-align:center;">Grade Point</th>
                                                                        <th style="text-align:center;">Letter Grade</th>
                                                                        <th style="text-align:center;">Credit</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php
                                                                        $sql = "SELECT result.course_code, course.course_title, result.grade_point, course.credit FROM course JOIN result ON course.course_code = result.course_code WHERE course.semester = $current_semester and result.id=$student_id";
                                                                        
                                                                        $result = $conn->query($sql);
                                                                        
                                                                        $count = 0;
                                                                        while($row = $result->fetch_assoc()){
                                                                        	$count++;
                                                                        	echo "<tr class='table-row-animate' style='animation-delay: " . $count * 0.3 . "s;'><td style='text-align:center;'>" . $row["course_code"] . "</td><td style='text-align:left;'>" . $row["course_title"] . "</td><td style='text-align:center;'>" . round($row["grade_point"], 2) . "</td><td style='text-align:center;'>" . convertGpaToLetterGrade($row["grade_point"]) . "</td><td style='text-align:center;'>" . $row["credit"] . "</td></tr>";
                                                                        
                                                                        }

                                                                        
                                                                    ?>
                                                                </tbody>
                                                            </table>
                                                            <div class="alert alert-icon alert-success alert-dismissible fade show" role="alert">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-check" viewBox="0 0 16 16">
                                                                    <path d="M10.854 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708 0"/>
                                                                    <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z"/>
                                                                </svg>
                                                                <?php
                                                                    if($count>0){
                                                                    	echo "<strong>Result found.</strong> This document is system generated. It doesn't require any signature.";
                                                                    }
                                                                    else{
                                                                    	echo "<strong>Result not found.</strong>";
                                                                    }
                                                                                                                                       
                                                                ?>
                                                            </div>
                                                            <strong>
                                                            </strong>
                                                        </div>
                                                        <p class="mb-0">
                                                            <strong><span id="time" class="typing-animation"></span></strong>
                                                        </p>
                                                        <strong>
                                                        </strong>
                                                    </div>
                                                    <strong>
                                                    </strong>
                                                </div>
                                                <strong>
                                                    <!-- COURSE MARKS INFO END -->
                                                </strong>
                                            </div>
                                            <strong>
                                            </strong>
                                        </div>
                                        <div class="row d-print-none" id="pr" style="text-align: center;margin-bottom: 30px;margin-top: 20px;margin-left: 35%;">
                                            <div class="button-list">
                                                <!--
                                                    <button type="button" id="save_pdf" class="btn btn-info waves-effect width-md waves-light" onclick="saveAsPDF()">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                                                    <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5"/>
                                                    <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708z"/>
                                                    </svg>
                                                    
                                                    PDF Download</button>
                                                    
                                                    -->
                                                <button id="print_btn" style="margin-bottom: 40px; margin-left: 50px;" type="button" onclick="print()" class="btn btn-success waves-effect width-md waves-light">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
                                                        <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1"/>
                                                        <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1"/>
                                                    </svg>
                                                    Print Now
                                                </button>
                                                <button style="margin-bottom: 40px; margin-left: 30px;" type="button" onclick="redirectToIndex()" class="btn btn-purple waves-effect width-md waves-light">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                                                    </svg>
                                                    Search Again
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end card-->
                            </div>
                        </div>
                        <!-- end container-fluid -->
                    </div>
                    <!-- end content -->
                </div>
            </div>
            <!-- END wrapper -->
            <footer class="footer" style="position: fixed; background-color: #265077;">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12" style="color:white">
                            2024 © Result Archive | Developed and Maintaing By <a href="" style="color:#a7a6a6">Office of the controller of Examinations, BSFSTMU </a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        <script type="text/javascript">
            function redirectToIndex() {
				// Redirect to the index page
				window.location.href = 'index.php';
			}
            		
            		
			// JavaScript to update date, time, and IP dynamically and display with typing animation
			const dateElement = document.getElementById('date');
			const timeElement = document.getElementById('time');
			const ipElement = document.getElementById('ip');

			const dateText = '<?php echo date("d-m-Y"); ?>';
			const timeText = '<?php echo date("h:i:s A"); ?>';
			const ipText = '<?php echo get_ip(); ?>';
            
              // Function to display text character by character with a delay
			function displayText(element, text) {
				let index = 0;
				const intervalId = setInterval(() => {
					if (index < text.length) {
						element.innerHTML += text.charAt(index);
						index++;
					} else {
						clearInterval(intervalId);
					}
				}, 60); // Adjust the delay (in milliseconds) between characters as needed
			}
            
            // Display text with typing animation
			displayText(dateElement, dateText);
			setTimeout(() => displayText(timeElement, "Auto generated on " + dateText + " at " + timeText + " from IP: " + ipText), 500); // Delay for the next element
             
        </script>
        <style type="text/css">
			@media only screen and (max-width: 700px) {
				#print_btn {
					margin-left: -90px !important;
				}
			}
		</style>
        
    </body>
</html>


<?php $conn->close(); ?>
