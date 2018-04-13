<?php

function getUserDetails($db_con, $userId){
    $stmt = $db_con->prepare("SELECT * FROM users u left join company c on u.company_id = c.id left join geopoliticalzones g on c.geo_politicalzone_id=g.id WHERE u.id=:uid");
    $stmt->execute(array(":uid"=>$userId));
    $row=$stmt->fetch(PDO::FETCH_ASSOC);
    return $row;
}
?>