<?php
require("connect-db.php");      // include("connect-db.php");
require("debt-db.php");

$list_of_persons = getAllPersons();
$person_to_update = null;      
$person_to_delete = null;
session_start();
?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
  if (!empty($_POST['btnAction']) && $_POST['btnAction'] =='Add') 
  {
      addPerson($_POST['personName'], $_POST['loan_amount']);
      $list_of_persons = getAllPersons();
  }
  else if (!empty($_POST['btnAction']) && $_POST['btnAction'] =='Update')
  {
      $person_to_update = getPersonById($_POST['person_to_update']);
  }
  else if (!empty($_POST['btnAction']) && $_POST['btnAction'] =='Delete')
  {
      deletePerson($_POST['person_to_delete']);
      $list_of_persons = getAllPersons();
  }

  if(!empty($_POST['btnAction']) && $_POST['btnAction'] == 'Confirm update')
  {
    updatePerson($_POST['personId'], $_POST['personName'], $_POST['loan_amount']);
    $list_of_persons = getAllPersons();
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
  <div>
    <input type="submit" value="Add" name="btnAction" class="btn btn-dark" 
           title="Add a student to list of students with debt table." />            
    <input type="submit" value="Confirm update" name="btnAction" class="btn btn-primary" 
           title="Update a student's debt." />            
  </div>  

</form>   

<hr/>
<h3>List of students</h3>
<div class="row justify-content-center">  
<table class="w3-table w3-bordered w3-card-4 center" style="width:70%">
  <thead>
  <tr style="background-color:#B0B0B0">
    <th width="30%"><b>ID</b></th>    
    <th width="30%"><b>Name</b></th>
    <th width="30%"><b>Loan Amount</b></th>
    <th><b>Update?</b></th>
    <th><b>Delete?</b></th>
  </tr>
  </thead>
<?php foreach ($list_of_persons as $student_info): ?>
  <tr>
     <td><?php echo $student_info['personId']; ?></td>
     <td><?php echo $student_info['personName']; ?></td>
     <td><?php echo $student_info['loan_amount']; ?></td>                   
     <td>
        <form action="simpleform.php" method="post">
          <input type="submit" value="Update" name="btnAction" class="btn btn-primary" 
                title="Click to update this person" />
          <input type="hidden" name="person_to_update" 
                value="<?php echo $student_info['personId']; ?>" />
        </form>
     </td>
     <td>
        <form action="simpleform.php" method="post">
          <input type="submit" value="Delete" name="btnAction" class="btn btn-primary" 
                title="Click to delete this person" /> 
          <input type="hidden" name="person_to_delete" 
                value="<?php echo $student_info['personId']; ?>" />
        </form>
      </td>
  </tr>
<?php endforeach; ?>
</table>
</div>   






</div>    

<?php include('footer.html') ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>