<?php

$id_keputusan = $_GET['id'];

if (isset($_POST['update'])) {
    $nama_keputusan = $_POST['nama_keputusan'];

    // proses update
    $sql = "UPDATE keputusan SET nama_keputusan='$nama_keputusan' WHERE id_keputusan='$id_keputusan'";
    if ($conn->query($sql) === TRUE) {
        header("Location:?page=keputusan");
    }
}



$sql = "SELECT * FROM keputusan WHERE id_keputusan='$id_keputusan'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<div class="row">
    <div class="col-sm-12">
        <form action="" method="POST">
            <div class="card border-dark">
                <div class="card">
                    <div class="card-header bg-primary text-white border-dark"><strong>Update Data Keputusan</strong></div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Nama Keputusan</label>
                            <input type="text" class="form-control" name="nama_keputusan" value="<?php echo $row['nama_keputusan']?>" maxlength="100" required>
                        </div>

                        <input class="btn btn-primary" type="submit" name="update" value="Update">
                        <a class="btn btn-danger" href="?page=keputusan">Batal</a>

                    </div>
                </div>
        </form>
    </div>
</div>