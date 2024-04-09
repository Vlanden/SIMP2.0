<?php
    $sql = mysqli_query($conn, "SELECT * FROM usuarios WHERE ID = {$_SESSION['ID']}");
    if (mysqli_num_rows($sql) > 0) {
        $args = mysqli_fetch_assoc($sql);
    }
?>