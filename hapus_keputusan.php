<?php

$id_keputusan=$_GET['id'];

$sql = "DELETE FROM keputusan WHERE id_keputusan='$id_keputusan'";
if ($conn->query($sql) === TRUE) {
    header("Location:?page=keputusan");
}
$conn->close();
?>