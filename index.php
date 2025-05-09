<?php
// koneksi database
include "config.php"
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Pakar</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <!-- datatabel CSS -->
    <link rel="stylesheet" href="assets/css/datatables.min.css">
    <!-- font awesome CSS -->
    <link rel="stylesheet" href="assets/css/all.css">
</head>

<body>
    <!-- navbar -->
    <nav class="navbar navbar-expand-sm bg-primary navbar-dark">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="?page=gejala">Gejala</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="#">Diagnosa</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link " href="#">Basis Aturan</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link " href="#">Logout</a>
            </li>
        </ul>
    </nav>

    <!-- container -->
    <div class="container-fluid mt-2">
        <!-- Setting Menu -->
        <?php

        $page = isset($_GET['page']) ? $_GET['page'] : "";
        $action = isset($_GET['action']) ? $_GET['action'] : "";

        if ($page == "") {
            include "welcome.php";
        } elseif ($page == "gejala") {
            if ($action == "") {
                include "tampil_gejala.php";
            } elseif ($action == "tambah") {
                include "tambah_gejala.php";
            } elseif ($action == "update") {
                include "update_gejala.php";
            } else {
                include "NAMA_HALAMAN";
            }
        } else {
            include "NAMA_HALAMAN";
        }
        ?>
    </div>

    <!-- jquery -->
    <script src="assets/js/jquery-3.7.0.min.js"></script>
    <!-- Bootstrap Js -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- Datatabels Js -->
    <script src="assets/js/datatables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
    <!-- font awesome js -->
    <script src="assets/js/all.js"></script>

</body>

</html>