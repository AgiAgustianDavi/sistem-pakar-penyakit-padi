<?php

if (isset($_POST['simpan'])) {
    $nama_keputusan = $_POST['nama_keputusan'];
    //proses simpan
    $sql = "INSERT INTO keputusan VALUES (Null,'$nama_keputusan')";
    if ($conn->query($sql) === TRUE) {
        header("Location:?page=keputusan");
    }
}
?>


<div class="row">
    <div class="col-sm-12">
        <form action="" method="POST">
            <div class="card border-dark">
                <div class="card">
                    <div class="card-header bg-primary text-white border-dark"><strong>Tambah Data Keputusan</strong></div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Nama Keputusan</label>
                            <input type="text" class="form-control" name="nama_keputusan" maxlength="100" required>
                        </div>

                        <input class="btn btn-primary" type="submit" name="simpan" value="Simpan">
                        <a class="btn btn-danger" href="?page=keputusan">Batal</a>

                    </div>
                </div>
        </form>
    </div>
</div>