<?php
    $conn = new mysqli("wwydh-mysql.cqqq2sesxkkq.us-east-1.rds.amazonaws.com", "wwydh_a_team", "nzqbzNU3drDhVsgHsP4f", "wwydh");

    $q = $conn->prepare("SELECT * FROM users WHERE id = 1");
    $q->execute();

    $data = $q->get_result();

    print_r($data->fetch_array(MYSQLI_ASSOC));
?>
