
<?php


function getPersonByName($personName)
{
    global $db;
    $query = "SELECT * FROM person where personName = :personName";
    $statement = $db->prepare($query);
    $statement->bindValue(":personName", $personName);
    $statement->execute();
    $result = $statement->fetch();
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

function addPerson($personName, $loan_amount)
{
    global $db;
    $query = "INSERT INTO person (personName, loan_amount) VALUES (:personName, :loan_amount)";
    $statement = $db->prepare($query);
    $statement->bindValue(":loan_amount", $loan_amount);
    $statement->bindValue(":personName", $personName);
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

function updatePerson($personId, $personName, $loan_amount)
{   
    // get instance of PDO
    // prepare statement
    // 1) prepare
    // 2) bindValue, execute
    global $db;
    $query = "UPDATE person SET personName=:personName, loan_amount=:loan_amount WHERE personId=:personId";
    $statement = $db->prepare($query);
    $statement->bindValue(":personName", $personName);
    $statement->bindValue(":loan_amount", $loan_amount);
    $statement->bindValue(":personId", $personId);
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