<!DOCTYPE html>
<html>

<head>
  <title>CRUD Petani Kode</title>
  <link rel="icon" href="http://www.petanikode.com/favicon.ico" />
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body class="container">

  <?php
  // --- koneksi ke database
  $koneksi = mysqli_connect("localhost", "skye", "nevergone", "pertanian") or die(mysqli_error($koneksi));
  // --- Fngsi tambah data (Create)
  function tambah($koneksi)
  {

    if (isset($_POST['btn_simpan'])) {
      $id = time();
      $nm_tanaman = $_POST['nm_tanaman'];
      $hasil = $_POST['hasil'];
      $lama = $_POST['lama'];
      $tgl_panen = $_POST['tgl_panen'];

      if (!empty($nm_tanaman) && !empty($hasil) && !empty($lama) && !empty($tgl_panen)) {
        $sql = "INSERT INTO tabel_panen (id,nama_tanaman, hasil_panen, lama_tanam, tanggal_panen) VALUES(" . $id . ",'" . $nm_tanaman . "','" . $hasil . "','" . $lama . "','" . $tgl_panen . "')";
        $simpan = mysqli_query($koneksi, $sql);
        if ($simpan && isset($_GET['aksi'])) {
          if ($_GET['aksi'] == 'create') {
            header('location: index.php');
          }
        }
      } else {
        $pesan = "Tidak dapat menyimpan, data belum lengkap!";
      }
    }
  ?>

    <div class='d-flex align-items-center justify-content-center'>
      <form action="" method="POST">
        <h2 class='d-flex align-items-center justify-content-center'>Tambah Data</h2>
        <div class="mb-3">
          <label for="nm_tanaman" class="form-label">Nama tanaman</label>
          <input type="text" class="form-control" id="nm_tanaman" name="nm_tanaman">
        </div>
        <label for="hasil" class="form-label">Hasil Panen</label>
        <div class="input-group mb-3">
          <input type="number" class="form-control" id="hasil" name="hasil">
          <span class="input-group-text">kg</span>
        </div>
        <label for="lama" class="form-label">Lama tanam</label>
        <div class="input-group mb-3">
          <input type="number" class="form-control" id="lama" name="lama">
          <span class="input-group-text">bulan</span>
        </div>
        <div class="mb-3">
          <label for="tgl_panen" class="form-label">Tanggal Panen</label>
          <input type="date" class="form-control" id="tgl_panen" name="tgl_panen">
        </div>
        <br>
        <div class="d-grid gap-2">
          <div class="btn-group">
            <button type="submit" class="btn btn-primary" name="btn_simpan">Simpan</button>
            <button type="reset" class="btn btn-warning" name="reset">Bersihkan</button>
          </div>
        </div>
        <br>
        <?php if (isset($pesan)) : ?>
          <div class="alert alert-danger" role="alert">
            <?php echo isset($pesan) ? $pesan : "" ?>
          </div>
        <?php endif ?>
      </form>
    </div>
    <?php
  }
  // --- Tutup Fngsi tambah data
  // --- Fungsi Baca Data (Read)
  function tampil_data($koneksi)
  {
    $sql = "SELECT * FROM tabel_panen";
    $query = mysqli_query($koneksi, $sql);

    echo "<h2 class='d-flex align-items-center justify-content-center'>Data Panen</h2>";

    echo "<div class='d-flex align-items-center justify-content-center'>";
    echo "<div class='row'>";
    echo "<div class='col'>";
    echo "<table class='table table-hover table-striped' border='1' cellpadding='10'>";
    echo "<tr>
            <th>ID</th>
            <th>Nama Tanaman</th>
            <th>Hasil Panen</th>
            <th>Lama Tanam</th>
            <th>Tanggal Panen</th>
            <th>Tindakan</th>
          </tr>";

    while ($data = mysqli_fetch_array($query)) {
    ?>
      <tr>
        <td><?php echo $data['id']; ?></td>
        <td><?php echo $data['nama_tanaman']; ?></td>
        <td><?php echo $data['hasil_panen']; ?> Kg</td>
        <td><?php echo $data['lama_tanam']; ?> bulan</td>
        <td><?php echo $data['tanggal_panen']; ?></td>
        <td>
          <a href="index.php?aksi=update&id=<?php echo $data['id']; ?>&nama=<?php echo $data['nama_tanaman']; ?>&hasil=<?php echo $data['hasil_panen']; ?>&lama=<?php echo $data['lama_tanam']; ?>&tanggal=<?php echo $data['tanggal_panen']; ?>">Ubah</a> |
          <a href="index.php?aksi=delete&id=<?php echo $data['id']; ?>">Hapus</a>
        </td>
      </tr>
    <?php
    }
    echo "</table>";
    echo "<div>";
    echo "<div>";
    echo "</div>";
  }
  // --- Tutup Fungsi Baca Data (Read)
  // --- Fungsi Ubah Data (Update)
  function ubah($koneksi)
  {
    // ubah data
    if (isset($_POST['btn_ubah'])) {
      $id = $_POST['id'];
      $nm_tanaman = $_POST['nm_tanaman'];
      $hasil = $_POST['hasil'];
      $lama = $_POST['lama'];
      $tgl_panen = $_POST['tgl_panen'];

      if (!empty($nm_tanaman) && !empty($hasil) && !empty($lama) && !empty($tgl_panen)) {
        $perubahan = "nama_tanaman='" . $nm_tanaman . "',hasil_panen=" . $hasil . ",lama_tanam=" . $lama . ",tanggal_panen='" . $tgl_panen . "'";
        $sql_update = "UPDATE tabel_panen SET " . $perubahan . " WHERE id=$id";
        $update = mysqli_query($koneksi, $sql_update);
        if ($update && isset($_GET['aksi'])) {
          if ($_GET['aksi'] == 'update') {
            header('location: index.php');
          }
        }
      } else {
        $pesan = "Data tidak lengkap!";
      }
    }

    // tampilkan form ubah
    if (isset($_GET['id'])) {
    ?>
      <a href="index.php"> &laquo; Home</a> |
      <a href="index.php?aksi=create"> (+) Tambah Data</a>
      <hr>

      <div class='d-flex align-items-center justify-content-center'>
        <form action="" method="POST">
          <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>" />
          <h2 class='d-flex align-items-center justify-content-center'>Ubah Data</h2>
          <div class="mb-3">
            <label for="nm_tanaman" class="form-label">Nama tanaman</label>
            <input type="text" class="form-control" id="nm_tanaman" name="nm_tanaman" value="<?= $_GET["nama"] ?>">
          </div>
          <label for="hasil" class="form-label">Hasil Panen</label>
          <div class="input-group mb-3">
            <input type="number" class="form-control" id="hasil" name="hasil" value="<?= $_GET["hasil"] ?>">
            <span class="input-group-text">kg</span>
          </div>
          <label for="lama" class="form-label">Lama tanam</label>
          <div class="input-group mb-3">
            <input type="number" class="form-control" id="lama" name="lama" value="<?= $_GET["lama"] ?>">
            <span class="input-group-text">bulan</span>
          </div>
          <div class="mb-3">
            <label for="tgl_panen" class="form-label">Tanggal Panen</label>
            <input type="date" class="form-control" id="tgl_panen" name="tgl_panen" value="<?= $_GET["tanggal"] ?>">
          </div>
          <br>
          <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary" name="btn_ubah">Simpan</button>
          </div>
          <br>
          <?php if (isset($pesan)) : ?>
            <div class="alert alert-danger" role="alert">
              <?php echo isset($pesan) ? $pesan : "" ?>
            </div>
          <?php endif ?>
        </form>
      </div>
  <?php
    }
  }
  // --- Tutup Fungsi Update
  // --- Fungsi Delete
  function hapus($koneksi)
  {
    if (isset($_GET['id']) && isset($_GET['aksi'])) {
      $id = $_GET['id'];
      $sql_hapus = "DELETE FROM tabel_panen WHERE id=" . $id;
      $hapus = mysqli_query($koneksi, $sql_hapus);

      if ($hapus) {
        if ($_GET['aksi'] == 'delete') {
          header('location: index.php');
        }
      }
    }
  }
  // --- Tutup Fungsi Hapus
  // ===================================================================
  // --- Program Utama
  if (isset($_GET['aksi'])) {
    switch ($_GET['aksi']) {
      case "create":
        echo '<a href="index.php"> &laquo; Home</a>';
        tambah($koneksi);
        break;
      case "read":
        tampil_data($koneksi);
        break;
      case "update":
        ubah($koneksi);
        tampil_data($koneksi);
        break;
      case "delete":
        hapus($koneksi);
        break;
      default:
        echo "<h3>Aksi <i>" . $_GET['aksi'] . "</i> tidaka ada!</h3>";
        tambah($koneksi);
        tampil_data($koneksi);
    }
  } else {
    tambah($koneksi);
    tampil_data($koneksi);
  }
  ?>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>
