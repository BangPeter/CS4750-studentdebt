<?php
require("connect-db.php");      // include("connect-db.php");
require("debt-db.php");

$person_to_update = null;      
$enrollment = null;
$enlistment = null;
session_start();
?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
  if (!empty($_POST['btnAction']) && $_POST['btnAction'] =='Update')
  {
      $person_to_update = getPersonById($_POST['person_to_update']);
      $enrollment = getEnrollmentByName($_POST['studentname']);
      $enlistment = getOrgByName($_POST['studentname']);
  }
  if(!empty($_POST['btnAction']) && $_POST['btnAction'] == 'Confirm update')
  {
    updatePerson($_POST['personId'], $_POST['name'], $_POST['loan_amount']);
    header("location: simpleform.php");
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">  
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="your name">
  <meta name="description" content="include some description about your page">      
  <title>DB interfacing</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="icon" type="image/png" href="http://www.cs.virginia.edu/~up3f/cs4750/images/db-icon.png" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
* {box-sizing: border-box;}

body {
  margin: 0;
}

.search-container input[type=text] {
  padding: 3.3px;
  margin-top: 8px;
  font-size: 17px;
  border-color:black;
  border-width:2px;
  width: 50%;
}

.search-container button {
  padding: 8px 10px;
  margin-top: 10px;
  margin-right: 16px;
  background: #ddd;
  font-size: 17px;
  cursor: pointer;
  border-color:black;
  border-width:2px;
}

.nav-item {
  margin-top: 1px;
  font-size: 16px;
}

</style>
</head>

<body>
  <?php include('header.html') ?> 

  <?php //if htmlspecialchars($_SESSION["permission_level"]) == "admin" : ?>
    
<div class="container">

<h3>Edit Detailed Information</h3>
<div class="row justify-content-center">  
<form name="mainForm" action="simpleform.php" method="post">   
  <div class="row mb-3 mx-3">
    Student's name:
    <input type="text" class="form-control" name="name" required 
          value="<?php if ($person_to_update!=null) echo $person_to_update['name'] ?>"
          <?php if (htmlspecialchars($_SESSION["role"])=="student") echo 'readonly'?>
    />            
  </div>  
  <div class="row mb-3 mx-3">
    Loan Amount:
    <input type="text" class="form-control" name="loan_amount" required 
    value="<?php if ($person_to_update!=null) echo $person_to_update['loan_amount'] ?>"
    <?php if (htmlspecialchars($_SESSION["role"])=="student") echo 'readonly'?>
    />            
  </div> 
  <input type="hidden" name="personId"
    value="<?php if ($person_to_update!=null) echo $person_to_update['personId'] ?>"
  />
  <div class="row mb-3 mx-3">
    School:
    <input type="text" class="form-control" name="school"
    value="<?php if ($enrollment!=null) echo $enrollment[0]['school'] ?>"
    <?php if (htmlspecialchars($_SESSION["role"])=="student") echo 'readonly'?>
    />            
  </div> 
  <div class="row mb-3 mx-3">
    Enrollment Month:
    <input type="text" class="form-control" name="month"
    value="<?php if ($enrollment!=null) echo $enrollment[0]['month'] ?>"
    <?php if (htmlspecialchars($_SESSION["role"])=="student") echo 'readonly'?>
    />            
  </div> 
  <div class="row mb-3 mx-3">
    Enlistment:
    <input type="text" class="form-control" name="enlist"
    value="<?php if ($enlistment!=null) echo $enlistment[0]['organ'] ?>"
    <?php if (htmlspecialchars($_SESSION["role"])=="student") echo 'readonly'?>
    />            
  </div> 

  <!-- Every other relevant field in the ER diagram goes here!!!!!!! -->

  <?php if (htmlspecialchars($_SESSION["role"])=="teacher"):?>
  <div>
    <input type="submit" value="Confirm update" name="btnAction" class="btn btn-primary" 
           title="Update a student's debt." />                     
  </div>  
  <?php else: ?>
    <a href="simpleform.php">Back</a>
  <?php endif;?>
</form>
</div>   






</div>    

<?php include('footer.html') ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>