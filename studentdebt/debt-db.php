
<?php


function getPersonByName($name)
{
    global $db;
    $query = "SELECT * FROM person WHERE name like '%$name%'";
    $statement = $db->prepare($query);
    $statement->bindValue(":name", $name);
    $statement->execute();
    $result = $statement->fetchAll();
    $statement->closeCursor();
    return $result;
}

function getPersonById($personId)
{
    global $db;
    $query = "SELECT * FROM person where personId = :personId";
    $statement = $db->prepare($query);
    $statement->bindValue(":personId", $personId);
    $statement->execute();
    $result = $statement->fetch();
    $statement->closeCursor();
    return $result;
}

function addPerson($name, $loan_amount)
{
    global $db;
    $query = "INSERT INTO person (name, loan_amount) VALUES (:name, :loan_amount)";
    $statement = $db->prepare($query);
    $statement->bindValue(":loan_amount", $loan_amount);
    $statement->bindValue(":name", $name);
    $statement->execute();
    $statement->closeCursor();
}

function getAllPersons()
{
    global $db;
    $query = "SELECT * FROM person";
    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $statement->closeCursor();
    return $result;
}

function getEnrollmentByName($name)
{
    global $db;
    $query = "SELECT * FROM enrolledin WHERE name=:name";
    $statement = $db->prepare($query);
    $statement->bindValue(":name", $name);
    $statement->execute();
    $result = $statement->fetchAll();
    $statement->closeCursor();
    return $result;
}

function getOrgByName($name)
{
    global $db;
    $query = "SELECT * FROM enlistin WHERE name=:name";
    $statement = $db->prepare($query);
    $statement->bindValue(":name", $name);
    $statement->execute();
    $result = $statement->fetchAll();
    $statement->closeCursor();
    return $result;
}

function updatePerson($personId, $name, $loan_amount)
{   
    // get instance of PDO
    // prepare statement
    // 1) prepare
    // 2) bindValue, execute
    global $db;
    $query = "UPDATE person SET name=:name, loan_amount=:loan_amount WHERE personId=:personId";
    $statement = $db->prepare($query);
    $statement->bindValue(":name", $name);
    $statement->bindValue(":loan_amount", $loan_amount);
    $statement->bindValue(":personId", $personId);
    $statement->execute();
    $statement->closeCursor();
}

function updateEnrollment($name, $school , $month)
{   
    // get instance of PDO
    // prepare statement
    // 1) prepare
    // 2) bindValue, execute
    global $db;
    $query = "UPDATE enrolledin SET month=:month, school=:school WHERE name=:name";
    $statement = $db->prepare($query);
    $statement->bindValue(":name", $name);
    $statement->bindValue(":school", $school);
    $statement->bindValue(":month", $month);
    $statement->execute();
    $statement->closeCursor();
}

function updateEnlistment($name, $organ)
{   
    // get instance of PDO
    // prepare statement
    // 1) prepare
    // 2) bindValue, execute
    global $db;
    $query = "UPDATE enlistin SET organ=:organ WHERE name=:name";
    $statement = $db->prepare($query);
    $statement->bindValue(":name", $name);
    $statement->bindValue(":organ", $organ);
    $statement->execute();
    $statement->closeCursor();
}

function deletePerson($personId){
    global $db;
    $query = "DELETE FROM person WHERE personId=:personId";
    $statement = $db->prepare($query);
    $statement->bindValue(':personId', $personId);
    $statement->execute();
    $statement->closeCursor();
}
?>