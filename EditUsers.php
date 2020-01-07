<?php
// Initialize the session
ob_start();
session_start();

include("GetPost.php");

if(isset( $_SESSION["iduser"] ) && ($_SESSION["super"] == "Super")){

$jid=$_POST["jobid"];

$array= array();
$array=GetPost2($jid);

//Connect to database
include("connection.php");

//Navigation Highlight Selection
$navSelect=7;
?>

<!DOCTYPE html>
<html lang="en">
    <head>
    <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>New paltz</title>
        <link rel="icon" type="image/png" href="resources/LogoFav.png">
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
        <link rel="stylesheet" href="css/InsertPost.css">
        <script type="text/javascript" src="js/nicEdit.js"></script>
        <script type="text/javascript">
            bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
        </script>
    </head>
    <body>
        <br>
        <div class="container-fluid">
            <div class="col-sm-6 text-center">
                <h1><img height="65" src="resources/LogoImg.png "> New Paltz</h1>
            </div>
            <div class="col-sm-4 text-center SpaceAbove">
                <p>You are logged in as: <?php echo $_SESSION['username']; ?> </p>
            </div>
            <div class="col-sm-2 text-center">
                <a href="Logout.php" class="btn SpaceAboveBtn">Logout</a>
            </div>
            <br>
        </div>
        <!-- Navigation -->
        <?php include('nav.php'); ?>



<!-- List all Users in PHP -->

        <form class="form-horizontal InputPost" method = get>
<table width="100%" border="1" style="border-collapse:collapse;">
<thead>
<tr>
<th><strong>userid</strong></th>
<th><strong>username</strong></th>
<th><strong>password</strong></th>
<th><strong>type</strong></th>
<th><strong>email</strong></th>
<th><strong>Edit</strong></th>
<th><strong>Delete</strong></th>
</tr>
</thead>
<tbody>
<?php
$count=1;
$sel_query="Select * from Users_f19_2;";
$result = mysqli_query($conn,$sel_query);
while($row = mysqli_fetch_assoc($result)) { ?>
<tr><td align="center"><?php echo $row["userid"]?></td>
<td align="center"><?php echo $row["username"]; ?></td>
<td align="center"><?php echo $row["password"]; ?></td>
<td align="center"><?php echo $row["type"]; ?></td>
<td align="center"><?php echo $row["email"]; ?></td>
<td align="center">
<a href="edit.php?id=<?php echo $row["userid"]; ?> name = <?php echo $row["userid"]; ?>">Edit</a>
</td>
<td align="center">
<a href="DeleteUser.php?id=<?php echo $row["userid"]; ?>">Delete</a>
</td>
</tr>
<?php $count++; } ?>
</tbody>
</table>


                 </form>
<!-- List all Users in PHP -->

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
        <script src="js/InsertPost.js"></script>
        <script src="js/EditDefaultMsg.js"></script>
    </body>
</html>

<?php }

else{
    header("location: loginnew.php");
}

ob_end_flush(); ?>