<?php
// Initialize the session
ob_start();
session_start();

include("GetPost.php");

if(isset( $_SESSION["iduser"] ) && ($_SESSION["super"] == "Super")){

$jid=$_POST["jobid"];

$array= array();
$array=GetPost2($jid);

//Navigation Highlight Selection
$navSelect=6;
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

        <form class="form-horizontal InputPost" action="SaveNewUser.php" method="post">
            <div class="form-group" style="text-align:center;">
                <label class="col-sm-2 col-md-offset-3 control-label">Username</label>
                <div class="col-sm-2">
                    <input id="NEWUSER_username" class="form-control" type='text' name="NEWUSER_username" placeholder="Username" required value="">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 col-md-offset-3 control-label">Passkey</label>
                <div class="col-sm-2">
                    <input id="NEWUSER_pass" class="form-control" type='text' name="NEWUSER_pass" placeholder="Passkey" required value="">
                </div>
            </div>
          <div class="form-group">
            <label class="col-sm-2 col-md-offset-3 control-label">Email</label>
            <div class="col-sm-2">
              <input type="text" class="form-control" id="NEWUSER_email" name="NEWUSER_email" placeholder="Email" value="">
            </div>
          </div>
          <br>
          <div class="form-group">
            <div class="col-sm-offset-5 col-sm-2">
              <button type="submit" name="submit" class="btn btn-default">Submit</button>
              <input name="iduser" value="<?php echo $_SESSION["iduser"]; ?>" hidden >

            </div>
          </div>
        </form>
        
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
        <script src="js/InsertPost.js"></script>
    </body>
</html>

<?php }

else{
    header("location: loginnew.php");
}

ob_end_flush(); ?>