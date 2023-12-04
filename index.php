<?php
// koneksi database
$server = "localhost";
$user = "root";
$password = "";
$database = "dbcrud2022";

// buat koneksi
$koneksi = mysqli_connect($server, $user, $password, $database) or die(mysqli_error($koneksi));

//Kode Otomatis
$q=mysqli_query($koneksi,"SELECT kode FROM tbarang order by kode desc limit 1");
$datax = mysqli_fetch_array($q);
if ($datax){
    $no_terakhir = substr($datax['kode'],-3);
    $no = $no_terakhir+1;

    if ($no > 0 and $no <10){
        $kode ="00".$no;
    } else if ($no < 10 and $no < 100){
        $kode = "0".$no;
    } else if ($no > 100){
        $kode = $no;
    }
} else {
    $kode = "001";
}

$tahun = date('Y');
$vkode = "INV-" . $tahun . '-' . $kode;
//INV_2023_001

// jika tombol simpan di klik
if (isset($_POST["bsimpan"])) {

    // edit data disimpan
    if (isset($_GET['hal']) == "edit") {

        $edit = mysqli_query($koneksi, "UPDATE tbarang SET 
                                            nama = '$_POST[tnama]',
                                            kondisi = '$_POST[tkondisi]',
                                            jumlah = '$_POST[tjumlah]',
                                            satuan = '$_POST[tsatuan]',
                                            tanggal_diterima = '$_POST[ttanggal_diterima]'
                                         WHERE id_barang = '$_GET[id]'
                                        ");
        if ($edit) {
            echo "<script>
                        alert('Edit data sukses');
                        document.location='index.php';
                    </script>";
        } else {
            echo "<script>
                        alert('Edit data gagal');
                        document.location='index.php';
                    </script>";
        }

    } else {
        //Data akan disimpan baru
        $simpan = mysqli_query($koneksi, " INSERT INTO tbarang (kode, nama, kondisi, jumlah, satuan, tanggal_diterima)
                                        VALUE  ( '$_POST[tkode]',
                                                '$_POST[tnama]',
                                                '$_POST[tkondisi]',
                                                '$_POST[tjumlah]',
                                                '$_POST[tsatuan]',
                                                '$_POST[ttanggal_diterima]' )
                                        ");
        if ($simpan) {
            echo "<script>
                        alert('Simpan data sukses');
                        document.location='index.php';
                    </script>";
        } else {
            echo "<script>
                        alert('simpan data gagal');
                        document.location='index.php';
                    </script>";
        }
    }
}

//deklarasi varible data edit
$vnama = "";
$vkondisi = "";
$vjumlah = "";
$vsatuan = "";
$vtanggal_diterima = "";


//pengujian tombol edit & hapus 
if (isset($_GET['hal'])) {
    //pengujian edit data
    if ($_GET['hal'] == "edit") {
        //tampilkan data diedit
        $tampil = mysqli_query($koneksi, "SELECT *FROM tbarang WHERE id_barang ='$_GET[id]' ");
        $data = mysqli_fetch_array($tampil);
        if ($data) {
            // jika data ditemukan akan ditampung di variable
            $vkode = $data["kode"];
            $vnama = $data["nama"];
            $vkondisi = $data["kondisi"];
            $vjumlah = $data["jumlah"];
            $vsatuan = $data["satuan"];
            $vtanggal_diterima = $data["tanggal_diterima"];

        }
    } else if ($_GET["hal"] == "hapus") {
        //lakukan hapus data
        $hapus = mysqli_query($koneksi, "DELETE FROM tbarang WHERE id_barang = '$_GET[id]'");

        if ($hapus) {
            echo "<script>
                        alert('Hapus data sukses');
                        document.location='index.php';
                    </script>";
        } else {
            echo "<script>
                        alert('Hapus data gagal');
                        document.location='index.php';
                    </script>";
        }
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRUD PHP & MySQL + Bpptstrap 5</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <!-- awal container -->
    <div class="container">
        <h2 class="text-center">Data Inventaris</h2>
        <h2 class="text-center">Lab Aplikasi Komputer</h2>
        <h2 class="text-center">Departemen Pendidikan Teknik Elektro - UNY</h2>
        <!-- awal col -->
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="card" style="background-color: #FFA500;">
                    <div class="card-header bg-info text-light" style="background-color: #FFA500;">
                        Form Input Barang Inventaris
                    </div>
                    <div class="card-body">
                        <!-- awal from -->
                        <form method="POST">
                            <div class="mb-3">
                                <label class="form-label">Kode Barang</label>
                                <input type="text" name="tkode" value="<?= $vkode ?>" class="form-control"
                                    placeholder="Masukan Kode Barang">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Nama Barang</label>
                                <input type="text" name="tnama" value="<?= $vnama ?>" class="form-control"
                                    placeholder="Masukan Nama Barang">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Kondisi Barang</label>
                                <select class="form-select" name="tkondisi">
                                    <option value="<?= $vkondisi ?>">
                                        <?= $vkondisi ?>
                                    </option>
                                    <option value="Normal">Normal</option>
                                    <option value="Rusak">Rusak</option>
                                </select>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label">Jumlah</label>
                                        <input type="number" name="tjumlah" value="<?= $vjumlah ?>" class="form-control"
                                            placeholder="Masukan Jumlah Barang">
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label">Satuan</label>
                                        <select class="form-select" name="tsatuan">
                                            <option value="<?= $vsatuan ?>">
                                                <?= $vsatuan ?>
                                            </option>
                                            <option value="Pcs">Pcs</option>
                                            <option value="Unit">Unit</option>
                                            <option value="Box">Box</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label">Tanggal Diterima</label>
                                        <input type="date" name="ttanggal_diterima" value="<?= $vtanggal_diterima ?>"
                                            class="form-control" placeholder="Masukan Tanggal Diterima">
                                    </div>
                                </div>

                                <div class="text-center">
                                    <hr>
                                    <button class="btn btn-primary" name="bsimpan" type="submit"> Simpan</button>
                                    <button class="btn btn-danger" name="bhapus" type="reset"> Hapus</button>

                                </div>

                            </div>
                        </form>
                        <!-- akhir form -->

                    </div>
                    <div class="card-footer bg-info" style="background-color: #FFA500;">

                    </div>
                </div>
            </div>
        </div>
        <div class="card mt-4">
            <div class="card-header bg-info text-light">
                Data Barang Inventaris
            </div>
            <div class="card-body">
                <div class="col-md-6 mx-auto">
                    <form method="POST">
                        <div class="input-group mb-2">
                            <input type="text" name="tcari" value="<?= isset($_POST['tcari']) ? $_POST['tcari'] : '' ?>"  class="form-control" 
                            placeholder="Masukkan kata kunci">
                            <button class="btn btn-primary" name="bcari" type="submit"> Cari</button>
                            <button class="btn btn-danger" name="breset" type="submit"> Reset</button>
                        </div>
                    </form>
                </div>


                <table class="table table-striped table-hover table-bordered">
                    <tr>
                        <th>No.</th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Kondisi Barang</th>
                        <th>Jumlah</th>
                        <th>Tanggal Diterima</th>
                        <th>Aksi</th>
                    <tr>
                        <?php
                        // persiapan menampilkan data
                        $no = 1;

                        // pencarian data
                        // jika klik tombol cari
                        if (isset($_POST['bcari'])) {
                            // tampilkan data yang dicari
                            $keyword = $_POST['tcari'];
                            $q = "SELECT * FROM tbarang WHERE kode like '%$keyword%' or nama like '%$keyword%' 
                            or kondisi like '%$keyword%'order by id_barang desc ";
                        } else {
                            $q = "SELECT * FROM tbarang order by id_barang desc";
                        }


                        $tampil = mysqli_query($koneksi, $q);
                        while ($data = mysqli_fetch_array($tampil)):
                        ?>

                        <tr>
                            <td>
                                <?= $no++ ?>
                            </td>
                            <td>
                                <?= $data['kode'] ?>
                            </td>
                            <td>
                                <?= $data['nama'] ?>
                            </td>
                            <td>
                                <?= $data['kondisi'] ?>
                            </td>
                            <td>
                                <?= $data['jumlah'] ?>
                                <?= $data['satuan'] ?>
                            </td>
                            <td>
                                <?= $data['tanggal_diterima'] ?>
                            </td>
                            <td>
                                <a href="index.php?hal=edit&id=<?= $data['id_barang'] ?>" class="btn btn-warning">Edit </a>

                                <a href="index.php?hal=hapus&id=<?= $data['id_barang'] ?>" class="btn btn-danger"
                                    onclick="return confirm('Yakin menghapus data ini?')">Hapus </a>
                            </td>
                        <tr>
                        <?php endwhile; ?>

                        <table>
            </div>
            <div class="card-footer bg-info" style="background-color: #FFA500;">
            </div>
        </div>
    </div>





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>