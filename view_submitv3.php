<?php

require_once 'pagination.php';
//Connect to database
include("connection.php");

$limit      = (isset($_GET['limit'])) ? $_GET['limit'] : 7;
$page       = (isset($_GET['page'])) ? $_GET['page'] : 1;
$links      = (isset($_GET['links'])) ? $_GET['links'] : 7;
$location   = (isset($_GET['location'])) ? $_GET['location'] : 'All';
$type       = (isset($_GET['type'])) ? $_GET['type'] : 'All';
$sortOrder  = (isset($_GET['sortOrder'])) ? $_GET['sortOrder'] : 'Recent';
$semester = (isset($_GET['semester'])) ? $_GET['semester'] : 'All';


//$sOrder = 'desc';

$files = glob('upload/metadata/' . '*.txt');


if ($sortOrder == 'Recent') {
    $sOrder = 'desc';
} else if ($sortOrder == 'Oldest') {
    $sOrder = 'asc';
}


if (($location == 'All') && ($type == 'All')) {
    $query      = "SELECT jobid, title, description, company, posttime FROM Job_f19a WHERE status='A' order by jobid $sOrder";
} else if ($location == 'All') {
    $query      = "SELECT jobid, title, description, company, posttime FROM Job_f19a WHERE type='$type' AND status='A' order by jobid $sOrder";
} else if ($type == 'All') {
    $query      = "SELECT jobid, title, description, company, posttime FROM Job_f19a WHERE location='$location' AND status='A' order by jobid $sOrder";
} else {
    $query      = "SELECT jobid, title, description, company, posttime FROM Job_f19a WHERE type='$type' AND location='$location' AND status='A' order by jobid $sOrder";
}

$Paginator  = new Paginator($conn, $query);

$results    = $Paginator->getData($limit, $page);


//send parameters location, type, limit and page to the detail post page so the user will return where he where before the click

$actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$ide = "?";
$total = strpos($actual_link, $ide);

$navSelect = 0;
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">

<head>
    <title>JOB FINDER</title>

    <link rel="stylesheet" type="text/css" href="css/job.css">
    <link rel="stylesheet" type="text/css" href="userpage.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

</head>

<body>
    <div class="container-fluid">

        <div class="col-md-6 text-center">

            <img id="logo" src="resources/nplogo5.png">

        </div>
        <div class="col-md-6 text-center ">
            <a href="loginnew.php" class="btn btn-info btn-lg buttonright ">
                <span class="glyphicon glyphicon-log-in"></span> Login to Post
            </a>
        </div>

    </div>
    <br>
    <div class="container-fluid">
        <div class="row justify-content-md-center">
            <div class="col-md-12 text-center">
                <h1 style="color:#ffffff">
                    NEW PALTZ CS EVENTS
                </h1>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="col-md-12 text-center" style="width:92%;margin-left:3.5%;">
            <?php include('nav2.php'); ?>
        </div>
    </div>

    <div class="container">
        <div class="col-md-12 text-center">
            <img class="imgbar" style="width:92%;" src="resources/colorbar.jpg">
        </div>
    </div>

    <form action="" method="get">

        <div class="container" style="padding-top:10px">
            <div class="col-md-4">
                <div class="panel panel-primary">
                    <div class="panel-heading text-center">SEMESTER</div>
                    <div class="panel-body">
                        <select name="semester" id="val1" class="form-control center-block">
                            <option selected>All</option>
			 <?php if ($semester == 'Fall 2019') { ?>
                            <option selected value="Fall 2019"> Fall 2019</option>
			<?php } else {?>
			   <option value="Fall 2019"> Fall 2019</option><?php } ?>
			 <?php if ($semester == 'Spring 2020') { ?>
                            <option selected value="Spring 2020"> Spring 2020</option>
			<?php } else {?>
			   <option value="Spring 2020"> Spring 2020</option><?php } ?>
			 <?php if ($semester == 'Fall 2020') { ?>
                            <option selected value="Fall 2020"> Fall 2020</option>
			<?php } else {?>
			   <option value="Fall 2020"> Fall 2020</option><?php } ?>
			 <?php if ($semester == 'Spring 2021') { ?>
                            <option selected value="Spring 2021"> Spring 2021</option>
			<?php } else {?>
			   <option value="Spring 2021"> Spring 2021</option><?php } ?>
			 <?php if ($semester == 'Fall 2021') { ?>
                            <option selected value="Fall 2021"> Fall 2021</option>
			<?php } else {?>
			   <option value="Fall 2021"> Fall 2021</option><?php } ?>
			 <?php if ($semester == 'Spring 2022') { ?>
                            <option selected value="Spring 2022"> Spring 2022</option>
			<?php } else {?>
			   <option value="Spring 2022"> Spring 2022</option><?php } ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="panel panel-primary">
                    <div class="panel-heading text-center">TYPE</div>
                    <div class="panel-body">
                        <select name="type" id="val2" class="form-control center-block">
                            <option selected value="All">All</option>
			 <?php if ($type == 'Event') { ?>
                            <option selected value="Event"> Event</option>
			<?php } else {?>
			   <option value="Event"> Event</option><?php } ?>

			 <?php if ($type == 'News') { ?>
                            <option selected value="News"> News</option>
			<?php } else {?>
			   <option value="News"> News</option><?php } ?>

                    	<?php if ($type == 'Jobs') { ?>
                            <option selected value="Jobs"> Jobs</option>
			<?php } else {?>
			   <option value="Jobs"> Jobs</option><?php } ?>

                        <?php if ($type == 'Club') { ?>
                            <option selected value="Club"> Club</option>
			<?php } else {?>
			   <option value="Club"> Club</option><?php } ?>


                        </select>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="panel panel-primary">
                    <div class="panel-heading text-center">SORT BY</div>
                    <div class="panel-body">
                        <select name="sortOrder" id="val3" class="form-control center-block">
                            <?php if ($sortOrder == 'Recent') { ?>

                                <option selected value="Recent">Recent</option>

                            <?php } else { ?>

                                <option value="Recent">Recent</option>

                            <?php
                            }
                            ?>
                            <?php if ($sortOrder == 'Oldest') { ?>

                                <option selected value="Oldest">Oldest</option>

                            <?php } else { ?>

                                <option value="Oldest">Oldest</option>

                            <?php
                            }
                            ?>


                        </select>
                    </div>
                </div>

            </div>
            <input type="submit" class="btn btn-primary col-md-12" value="Search" />
        </div>

    </form>

    </div>
    <br>
    <!-- Peter EDITS MADE HERE 11/4 ------------------------------------------------------------------>
    <div class="container">
        <div class="jobContent col-md-12">
            <div class="panel text-center panel-primary ">
                <div class="panel-heading">
                    <div>POSTS</div>
                </div>

                <ul class="list-group table">
                    <?php //to read all files in the metadata directory:

                    //EDITS HERE FOR SORTING BY DATE 11/12 -----------------------------------------------------------------------------------
                    if ($sortOrder == 'Recent') {
                        $sOrder = 'desc';
                        usort($files, function ($a, $b) {
                            return filemtime($a) < filemtime($b);
                        });
                    } else if ($sortOrder == 'Oldest') {
                        $sOrder = 'asc';
                        usort($files, function ($a, $b) {
                            return filemtime($a) > filemtime($b);
                        });
                    }

//-------------Filter by Type 11/14-----------------------------------------------------------------

		if($type != 'All'){
                    foreach ($files as $file) {
                        $lines = file($file);
		$count = $lines[0];
		$findme = $type;
		$mystring  = (string)$lines[3];
		$pos = strpos($mystring, $findme);

		if ($pos !== false) 
		{
  			continue;
		} 
		else 
		{
			unset($files[array_search($file, $files)]);
		}			
                  }
	}
//-------------Filter by Semester 11/14-----------------------------------------------------------------
		

		if($semester != 'All'){
                    foreach ($files as $file) {
                        $lines = file($file);
			$findme = $semester;
			$mystring  = (string)$lines[5];
			$pos = strpos($mystring, $findme);

			if ($pos !== false) 
			{
  				continue;
			} 
			else 
			{
				unset($files[array_search($file, $files)]);
			}			
                    }
		}

  //-----------------------------------------------------------------------------------------------------
                    foreach ($files as $filename) : ?>
                        <?php
                            unset($files[$filename]);
                            $fn = fopen("$filename", "r");
                            $postID = fgets($fn);
                            $postID = str_replace('PostID: ', '', $postID);
                            $ownerName = fgets($fn);
                            $ownerName = str_replace('Owner Name: ', '', $ownerName);
                            $names = explode(" ", $ownerName);
                            $firstname = $names[0];
                            $lastname = $names[1];
                            $title = fgets($fn);
                            $title = str_replace('Title: ', '', $title);
                            $category = fgets($fn);
                            $category = str_replace('Category: ', '', $category);
                            $picture = fgets($fn);
                            $picture = str_replace('Picture: ', '', $picture);
                            $imageFileName = $lastname . "_" . $firstname . "_hw" . $semester . $picture;
                            $semester = fgets($fn);
                            $semester = str_replace('Semester: ', '', $semester);
                            $file = fgets($fn);
                            $file = str_replace('File Name: ', '', $file);
                            $email = fgets($fn);
                            $email = str_replace('Email: ', '', $email);
                            $url = fgets($fn);
                            $url = str_replace('URL: ', '', $url);
                            $summary = fgets($fn);
                            $summary = str_replace('Summary: ', '', $summary);

                            while (!feof($fn)) {
                                $summary .= fgets($fn);
                            }
                            fclose($fn);



                            ?>

                        <li class="list-group-item">
                            <br>
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-sm-4 text-left">
                                        <strong>POST ID: </strong>
                                        <?php echo $postID; ?><br>

                                    </div>
                                    <div class="col-sm-8 text-left">
                                        <strong>TITLE: </strong>
                                        <?php echo "$title"; ?>

                                    </div>

                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-sm-4 text-left">
                                        <strong>TIME: </strong>
                                        <?php echo date("F d Y", filemtime($filename)); ?>
                                    </div>
                                    <div class="col-sm-4 text-left">
                                        <strong>SUMMARY: </strong>
                                    </div>
                                    <div class="col-sm-4 text-left">
                                        <strong>SEMESTER: </strong>
                                        <?php echo "$semester"; ?>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-sm-4 text-left"> 
                                        <strong>CATEGORY: </strong>
                                        <?php echo $category; ?>
                                        <!-- EDITS MADE HERE 11/11 FOR IMAGE DISPLAY------------------------------------------------------------------------------- -->
                                        <br>
                                        <img src="upload/goc/<?php echo $semester ?>/<?php echo $picture; ?>" style="max-width:75%">
                                    </div>
                                    <div class="col-sm-8 text-left" style="max-height:300px; overflow:hidden; white-space:normal; text-overflow:ellipsis; display:block;">
                                        <?php echo "$summary"; ?>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-sm-4">
                                    </div>
                                    <div class="col-sm-4 text-left"> 
					<strong>DOCUMENT</strong>
					<a href ="https://cs.newpaltz.edu/p/f19-02/f19va-upload/upload/goc/<?php echo $semester?>/<?php echo $file;?>"> Here</a>

                                        <strong>URL: </strong>
					 <?php 
                                        if($url == "\n") {
                                            echo 'None';
                                        } else {
                                            //echo $url; 
                                            echo "<a href='http://".$url."'>Link</a>";
                                        }
                                        ?>
                                    </div>
                                    <div class="col-sm-4 text-left">
                                        <?php
                                            if ($total == null) {  ?>
                                            <a class="btn btn-primary" href="PostDetails2.php?jobid=<?php echo $postID; ?>">Detail</a>
                                        <?php } else {
                                                $total = $total + 1;
                                                $final = substr($actual_link, $total); ?>
                                            <a class="btn btn-primary" href="PostDetails2.php?jobid=<?php echo $postID; ?>&<?php echo $final; ?>">Detail</a>
                                        <?php } ?>
                                    </div>
                                </div>
                                <br>
                        </li>
                    <?php endforeach; ?>

                </ul>
            </div>
        </div>






    </div>
    <!-- END OF EDITS 11/5 -->


    </div>
    </div>


</body>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css" />

<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>

</html>