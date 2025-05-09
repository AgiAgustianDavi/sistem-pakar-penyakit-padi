<?php

if(isset($_POST['simpan'])){

    //mengambil data dari form
    $namakeputusan=$_POST['namakeputusan'];

    //validasi nama penyakit
    $sql = "SELECT basis_aturan.idaturan,basis_aturan.idkeputusan,keputusan.namakeputusan
                FROM basis_aturan INNER JOIN keputusan
                ON basis_aturan.idkeputusan=keputusan.idkeputusan WHERE namakeputusan='$namakeputusan'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0){
            ?>
                <div class="alert alert-danger alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Data basis aturan keputusan tersebut sudah ada</strong>
                </div>
            <?php
        }else{

        //mengambil data keputusan
        $sql = "SELECT * FROM keputusan WHERE namakeputusan"
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $idpenyakit=$row['idkeputusan'];

        // proses simpan basis aturan
        $sql = "INSERT INTO basis_aturan VALUES (Null, '$idpenyakit')";
        mysqli_query($conn, $sql);

        // mengambil idgejala
        $idgejala = $_POST['idgejala'];

        // proses mengambil data aturan
        $sql = "SELECT * FROM basis_aturan ORDER BY idaturan DESC";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $idaturan = $row['idaturan'];

        // proses simpan detail basis aturan
        $jumlah = count($idgejala);
        $i = 0;
        while ($i < $jumlah) {
                $idgejalane=$idgejala[$i];  
            $sql = "INSERT INTO detail_basis_aturan VALUES ($idaturan, '$idgejalane')";
            mysqli_query($conn,$sql);
            $i++;
        }
        header("Location:?page=aturan");
    }
}
?>

<div class="row">
    <div class="col-sm-12">
        <form action ="" method="POST" onsubmit="return validasiform()">
            <div class="card border-dark">
                <div class="card">
                <div class="card-header bg-primary text-white border-dark"><strong>Tambah Data Basis Aturan</strong>
                <div class="card-body">
                    <div class="form-group">
                        <label for="">Nama Keputusan</label>
                        <select class="form-control chosen" data-placehorder="Pilih Nama Keputusan" name="namakeputusan" //dak tau ni kurang
                            <option value=""></option>
                            <?php
                                $sql = "SELECT * FROM keputusan ORDER BY namakeputusan ASC";
                                $result = $conn->query($sql);
                                whi;e($row = $result->fetch_assoc()){
                            ?>
                                <option value="<?php echo $row['namakeputusan']; ?>"><?php echo $row['namakeputusan'] //kurang
                            <?php
                                }
                            ?>
                        </select>
                    </div>

                    
                    <div class="form-group">
                        <label for="">Pilih gejala-gejala berikut :</label>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th width="30px"></th>
                                    <th width="30px">No.</th>
                                    <th width="700px">Nama Gejala</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $no=1;
                                    $sql = "SELECT * FROM gejala ORDER BY namagejala ASC";
                                    $result = $conn->query($sql);
                                    while($row = $result->fetch_assoc()){
                                ?>
                                <tr>
                                    <td align="center"><input type="checkbox" class="check-item" name="<?php echo 'idgejala[]';" value="<?php echo $row['idgejala']?>"></td>  //kurang
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $row['namakeputusan']; ?></td>
                                </tr>
                                <?php
                                    }
                                    $conn->close();
                                ?>
                            </tbody>
                        <table>
                    </div>

                    <input class="btn btn-primary" type="submit" name="simpan" value="Simpan">
                    <a class="btn btn-danger" href="?page=aturan">Batal</a>
                </div>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">
    function validasiForm() 
    {
        // validasi nama penyakit
        var nmpenyakit = document.forms["Form"]["nmpenyakit"].value;

        if(nmpenyakit=="")
        {
            alert("Pilih nama penyakit");
            return false;
        }

        // validasi gejala yang belum dipilih
        var checkbox = document.getElementsByName('<?php echo 'idgejala[]'; ?>');

        var isChecked = false;

        for (var i = 0; i < checkbox.length; i++) {
            if (checkbox[i].checked) {
                isChecked = true;
                break;
            }
        }

        // jika belum ada yang di check
        if (!isChecked) {
            alert('Pilih setidaknya satu gejala !!');
            return false;
        }

        return true;
    }

</script>

            



                            
                            
                                

                    