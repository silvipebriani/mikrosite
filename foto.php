<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Foto Kegiatan PKL</title>
  <link rel="stylesheet" href="assets/style.css">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(135deg, #f0f5ff, #ffffff);
      margin: 0;
      display: flex;
    }

    /* ===== Sidebar ===== */
    .sidebar {
      width: 250px;
      height: 100vh;
      background: linear-gradient(180deg, #507882, #507882);
      color: white;
      position: fixed;
      top: 0;
      left: 0;
      display: flex;
      flex-direction: column;
      padding: 20px;
      box-shadow: 2px 0 8px rgba(0,0,0,0.1);
    }

    .sidebar h2 {
      text-align: center;
      margin-bottom: 30px;
      font-size: 22px;
    }

    .sidebar a {
      color: white;
      text-decoration: none;
      padding: 12px 15px;
      margin: 6px 0;
      border-radius: 8px;
      display: block;
      transition: 0.3s;
    }

    .sidebar a:hover,
    .sidebar a.active {
      background: rgba(255,255,255,0.2);
    }

    /* ===== Main Content ===== */
    .main-content {
      margin-left: 250px;
      padding: 40px;
      width: calc(100% - 250px);
    }

    h1 {
      color: #0047b3;
      text-align: center;
      font-size: 28px;
      margin-bottom: 20px;
    }

    .form-card {
      background: linear-gradient(135deg, #eaf5feff , #eaf5feff);
      border: 1px solid #cddffb;
      padding: 20px;
      border-radius: 15px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.08);
      margin-bottom: 25px;
      max-width: 700px;
      margin-left: auto;
      margin-right: auto;
    }

    .form-card h2 {
      text-align: center;
      color: #507882;
      margin-bottom: 15px;
    }

    label {
      display: block;
      margin-top: 10px;
      color: #333;
      font-weight: 500;
    }

    input[type="text"], input[type="file"] {
      width: 100%;
      padding: 10px;
      border-radius: 8px;
      border: 1px solid #ccc;
      margin-top: 5px;
    }

    .form-btn {
      background: linear-gradient(90deg, #507882, #507882);
      color: white;
      border: none;
      border-radius: 8px;
      padding: 10px;
      font-size: 16px;
      cursor: pointer;
      width: 100%;
      margin-top: 15px;
      transition: 0.3s;
    }

    .form-btn:hover {
  background: linear-gradient(90deg, #004d61ff, #004d61ff);
}

    .success-msg, .error-msg {
      padding: 10px;
      border-radius: 8px;
      text-align: center;
      margin-top: 15px;
    }

    .success-msg {
      background-color: #d4edda;
      color: #155724;
      border: 1px solid #c3e6cb;
    }

    .error-msg {
      background-color: #f8d7da;
      color: #721c24;
      border: 1px solid #f5c6cb;
    }

    /* ===== Galeri Foto ===== */
    .gallery {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 20px;
      margin-top: 30px;
    }

    .gallery-item {
      background: white;
      border-radius: 12px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.08);
      overflow: hidden;
      position: relative;
      transition: transform 0.3s;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    .gallery-item:hover {
      transform: scale(1.03);
    }

    .gallery-item img {
      width: 100%;
      height: 180px;
      object-fit: cover;
      border-bottom: 1px solid #eee;
    }

    .gallery-info {
      padding: 12px 15px;
      text-align: center;
      width: 100%;
    }

    .gallery-info h4 {
      margin: 5px 0;
      color: #0047b3;
      font-size: 16px;
      font-weight: 600;
    }

    .gallery-info small {
      color: #666;
      font-size: 13px;
    }

    /* Tombol hapus */
    .delete-btn {
      position: absolute;
      top: 8px;
      right: 8px;
      background: rgba(255, 0, 0, 0.8);
      color: white;
      border: none;
      border-radius: 50%;
      width: 28px;
      height: 28px;
      font-weight: bold;
      cursor: pointer;
      transition: 0.3s;
    }

    .delete-btn:hover {
      background: red;
    }

    footer {
      text-align: center;
      padding: 15px;
      margin-top: 40px;
      color: #666;
      font-size: 14px;
    }
  </style>
</head>
<body>

  <!-- Sidebar -->
  <div class="sidebar">
    <h2>📘 Mikrosite PKL</h2>
    <a href="index.php">🏠 Beranda</a>
    <a href="presensi.php">🧾 Presensi</a>
    <a href="agenda.php">🗓️ Agenda</a>
    <a href="laporan.php">📝 Laporan</a>
    <a href="foto.php" class="active">📸 Foto Kegiatan</a>
  </div>

  <!-- Main Content -->
  <div class="main-content">
    <h1>Foto Kegiatan PKL</h1>

    <div class="form-card">
      <h2>Upload Foto</h2>
      <form method="POST" enctype="multipart/form-data">
        <label>Judul Kegiatan</label>
        <input type="text" name="judul" placeholder="Contoh: Rapat Tim Hari Pertama" required>

        <label>Pilih Foto</label>
        <input type="file" name="foto" accept="image/*" required>

        <button class="form-btn" type="submit" name="upload">💾 Simpan Foto</button>
      </form>

      <?php
      // Proses upload
      if (isset($_POST['upload'])) {
        $judul = $_POST['judul'];
        $nama_file = $_FILES['foto']['name'];
        $tmp = $_FILES['foto']['tmp_name'];
        $folder = "uploads/foto/";

        if (!file_exists($folder)) {
          mkdir($folder, 0777, true);
        }

        $path = $folder . basename($nama_file);

        if (move_uploaded_file($tmp, $path)) {
          $q = "INSERT INTO foto (judul, file_foto, tanggal_upload) VALUES ('$judul','$nama_file', NOW())";
          if (mysqli_query($koneksi, $q)) {
            echo "<p class='success-msg'>✅ Foto berhasil diunggah!</p>";
          } else {
            echo "<p class='error-msg'>❌ Gagal menyimpan ke database.</p>";
          }
        } else {
          echo "<p class='error-msg'>⚠️ Upload foto gagal.</p>";
        }
      }

      // Proses hapus foto
      if (isset($_GET['hapus'])) {
        $id = $_GET['hapus'];
        $result = mysqli_query($koneksi, "SELECT * FROM foto WHERE id='$id'");
        $data = mysqli_fetch_assoc($result);
        if ($data) {
          unlink("uploads/foto/" . $data['file_foto']);
          mysqli_query($koneksi, "DELETE FROM foto WHERE id='$id'");
          echo "<script>alert('Foto berhasil dihapus');window.location='foto.php';</script>";
        }
      }
      ?>
    </div>

    <h2>🖼️ Galeri Kegiatan</h2>
    <div class="gallery">
      <?php
      $data = mysqli_query($koneksi, "SELECT * FROM foto ORDER BY tanggal_upload DESC");
      if (mysqli_num_rows($data) > 0) {
        while ($row = mysqli_fetch_assoc($data)) {
          echo "
            <div class='gallery-item'>
              <form method='GET' onsubmit=\"return confirm('Yakin ingin menghapus foto ini?')\">
                <input type='hidden' name='hapus' value='{$row['id']}'>
                <button class='delete-btn'>×</button>
              </form>
              <img src='uploads/foto/{$row['file_foto']}' alt='{$row['judul']}'>
              <div class='gallery-info'>
                <h4>{$row['judul']}</h4>
                <small>📅 ".date('d M Y - H:i', strtotime($row['tanggal_upload']))."</small>
              </div>
            </div>
          ";
        }
      } else {
        echo "<p style='text-align:center;color:#777;'>Belum ada foto kegiatan.</p>";
      }
      ?>
    </div>

    <footer>
      &copy; 2025 Mikrosite PKL | Galeri Foto Kegiatan
    </footer>
  </div>

</body>
</html>
