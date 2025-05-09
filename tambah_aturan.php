<div class="row">
    <div class="col-sm-12">
        <form action="" method="POST">
            <div class="card border-dark">
                <div class="card">
                    <div class="card-header bg-primary text-white border-dark"><strong>Tambah Data Basis Aturan</strong></div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Nama Keputusan</label>
                            <select class="form-control chosen" data-placeholder="Pilih Keputusan" name="nama_penyakit">
                                <option value=""></option>
                                <?php
                                $sql = "SELECT * FROM keputusan";
                                $result = $conn->query($sql);
                                while ($row = $result->fetch_assoc()) {
                                ?>
                                    <option value="<?php echo $row['id_keputusan']; ?>"><?php echo $row['nama_keputusan']; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>

                        <input class="btn btn-primary" type="submit" name="simpan" value="Simpan">
                        <a class="btn btn-danger" href="?page=keputusan">Batal</a>

                    </div>
                </div>
        </form>
    </div>
</div>