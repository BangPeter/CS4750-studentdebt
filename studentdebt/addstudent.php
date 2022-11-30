<?php
$person_to_update = null;
require("connect-db.php");  
require("debt-db.php");
session_start();
?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
  if (!empty($_POST['btnAction']) && $_POST['btnAction'] =='Add') 
  {
      addPerson($_POST['personName'], $_POST['loan_amount']);
      header("location: simpleform.php");
  }
  else if (!empty($_POST['btnAction']) && $_POST['btnAction'] =='Update')
  {
      $person_to_update = getPersonById($_POST['person_to_update']);
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
    
<div class="container">

  <h1>Add Students:</h1>

<form name="mainForm" action="simpleform.php" method="post">   
  <div class="row mb-3 mx-3">
    Student's name:
    <input type="text" class="form-control" name="personName" required 
          value="<?php if ($person_to_update!=null) echo $person_to_update['personName'] ?>"
    />            
  </div>  
  <div class="row mb-3 mx-3">
    Loan Amount:
    <input type="text" class="form-control" name="loan_amount" required 
    value="<?php if ($person_to_update!=null) echo $person_to_update['loan_amount'] ?>"
    />            
  </div> 
  <input type="hidden" name="personId"
    value="<?php if ($person_to_update!=null) echo $person_to_update['personId'] ?>"
  />
  <!-- <div class="row mb-3 mx-3"> -->
  <?php if (htmlspecialchars($_SESSION["role"])=="teacher"):?>
  <div>
    <input type="submit" value="Add" name="btnAction" class="btn btn-dark" 
           title="Add a student to list of students with debt table." />               
  </div>  
    <?php endif; ?>
</form>   

</div>    

<?php include('footer.html') ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>