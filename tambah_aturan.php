<?php
if (isset($_POST['simpan'])) {
    $id_keputusan = $_POST['id_keputusan'];

    if (empty($id_keputusan)) {
        echo "<div class='alert alert-danger'>Pilih keputusan terlebih dahulu.</div>";
        exit;
    }

    // Validasi duplikat data
    $sql = "SELECT * FROM basis_aturan WHERE id_keputusan='$id_keputusan'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "<div class='alert alert-danger alert-dismissible fade show'>
                <button type='button' class='close' data-dismiss='alert'>&times;</button>
                <strong>Data basis aturan tersebut sudah ada.</strong>
              </div>";
    } else {
        // Simpan ke tabel basis_aturan
        $sql = "INSERT INTO basis_aturan (id_aturan, id_keputusan) VALUES (NULL, '$id_keputusan')";
        mysqli_query($conn, $sql);

        // Ambil id_aturan terbaru
        $sql = "SELECT id_aturan FROM basis_aturan ORDER BY id_aturan DESC LIMIT 1";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $id_aturan = $row['id_aturan'];

        // Simpan detail_basis_aturan
        $id_gejala = $_POST['id_gejala'];
        foreach ($id_gejala as $id_gejala_i) {
            $sql = "INSERT INTO detail_basis_aturan (id_aturan, id_gejala) VALUES ('$id_aturan', '$id_gejala_i')";
            mysqli_query($conn, $sql);
        }

        header("Location:?page=aturan");
        exit;
    }
}
?>

<div class="row">
    <div class="col-sm-12">
        <form action="" method="POST" name="Form" onsubmit="return validasiForm()">
            <div class="card border-dark">
                <div class="card">
                    <div class="card-header bg-primary text-white border-dark"><strong>Tambah Data Basis Aturan</strong></div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Nama Keputusan</label>
                            <select class="form-control chosen" data-placeholder="Pilih Keputusan" name="id_keputusan">
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

                        <!-- Tabel gejala -->
                        <div class="form-group">
                            <label for="">Pilih Gejala-gejala berikut:</label>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th width="20px"></th>
                                        <th width="30px">No.</th>
                                        <th width="700px">Nama Gejala</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    $sql = "SELECT * FROM gejala ORDER BY nama_gejala ASC";
                                    $result = $conn->query($sql);
                                    while ($row = $result->fetch_assoc()) {
                                    ?>
                                        <tr>
                                            <td align="center">
                                                <input type="checkbox" class="check-item" name="id_gejala[]" value="<?php echo $row['id_gejala']; ?>">
                                            </td>
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo $row['nama_gejala']; ?></td>
                                        </tr>
                                    <?php
                                    }
                                    $conn->close();
                                    ?>
                                </tbody>
                            </table>
                        </div>

                        <input class="btn btn-primary" type="submit" name="simpan" value="Simpan">
                        <a class="btn btn-danger" href="?page=aturan">Batal</a>
                    </div>
                </div>
        </form>
    </div>
</div>

<script type="text/javascript">
    function validasiForm() {
        var nama_keputusan = document.forms['Form']['id_keputusan'].value;
        if (nama_keputusan === '') {
            alert("Pilih nama keputusannya");
            return false;
        }

        var checkbox = document.getElementsByName('id_gejala[]');
        var isChecked = false;

        for (var i = 0; i < checkbox.length; i++) {
            if (checkbox[i].checked) {
                isChecked = true;
                break;
            }
        }

        if (!isChecked) {
            alert("Pilih setidaknya satu gejala!");
            return false;
        }

        return true;
    }
</script>