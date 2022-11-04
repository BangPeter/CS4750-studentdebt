
<?php



function getFriendByName($name)
{
    global $db;
    $query = "SELECT * FROM friends where name = :name";
    $statement = $db->prepare($query);
    $statement->bindValue(":name", $name);
    $statement->execute();
    $result = $statement->fetch();
    $statement->closeCursor();
    return $result;
}

function addFriend($name, $major, $year)
{
    global $db;
    $query = "INSERT INTO friends VALUES (:name, :major, :year)";
    $statement = $db->prepare($query);
    $statement->bindValue(":name", $name);
    $statement->bindValue(":major", $major);
    $statement->bindValue(":year", $year);
    $statement->execute();
    $statement->closeCursor();
}

function getAllFriends()
{
    global $db;
    $query = "SELECT * FROM friends";
    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $statement->closeCursor();
    return $result;
}

function updateFriends($name, $major, $year)
{   
    // get instance of PDO
    // prepare statement
    // 1) prepare
    // 2) bindValue, execute
    global $db;
    $query = "UPDATE friends SET major=:major, year=:year WHERE name=:name";
    $statement = $db->prepare($query);
    $statement->bindValue(":name", $name);
    $statement->bindValue(":major", $major);
    $statement->bindValue(":year", $year);
    $statement->execute();
    $statement->closeCursor();
}

function deleteFriend($name){
    global $db;
    $query = "DELETE FROM friends WHERE name=:name";
    $statement = $db->prepare($query);
    $statement->bindValue(':name', $name);
    $statement->execute();
    $statement->closeCursor();
}
?>