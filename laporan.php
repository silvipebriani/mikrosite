<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Laporan PKL</title>
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
  box-shadow: 2px 0 8px rgba(0, 0, 0, 0.1);
}

.sidebar h2 {
  text-align: center;
  margin-bottom: 30px;
  font-size: 22px;
  letter-spacing: 1px;
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
  background: rgba(255, 255, 255, 0.2);
}

/* ===== Main Content ===== */
.main-content {
  margin-left: 250px;
  padding: 40px;
  width: calc(100% - 250px);
}

h1 {
  color: #004b9bff;
  text-align: center;
  font-size: 28px;
  margin-bottom: 20px;
}

/* ===== Form Card ===== */
.form-card {
  background: linear-gradient(135deg, #eaf5feff, #eaf5feff);
  border: 1px solid #cddffb;
  padding: 20px;
  border-radius: 15px;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
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

input[type="text"],
input[type="date"],
textarea {
  width: 100%;
  padding: 10px;
  border-radius: 8px;
  border: 1px solid #ccc;
  margin-top: 5px;
}

textarea {
  resize: vertical;
  height: 80px;
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

.success-msg,
.error-msg {
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

/* ===== Table ===== */
table {
  width: 100%;
  border-collapse: collapse;
  table-layout: fixed; /* supaya kolom sejajar */
  margin-top: 20px;
  border-radius: 10px;
  overflow: hidden;
}

th,
td {
  padding: 12px;
  text-align: center;
  vertical-align: middle;
  border: 1px solid #ddd;
}

th {
  background: #004d61ff;
  color: white;
  font-weight: bold;
}

td {
  background: #fdfdfd;
  color: #333;
}

tr:nth-child(even) td {
  background: #f4f8ff;
}

/* Pastikan tidak ada padding aneh dari container */
.container,
.card,
.table-wrapper {
  padding: 0;
  margin: 0;
}

/* ===== Footer ===== */
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
    <a href="laporan.php" class="active">📝 Laporan</a>
    <a href="foto.php">📸 Foto Kegiatan</a>
  </div>

  <!-- Main Content -->
  <div class="main-content">
    <h1>Laporan Kegiatan PKL</h1>

    <div class="form-card">
      <h2>Tambah Laporan</h2>
      <form method="POST">
        <label>Nama</label>
        <input type="text" name="nama" placeholder="Masukkan nama Anda" required>

        <label>Tanggal</label>
        <input type="date" name="tanggal" required>

        <label>Isi Laporan</label>
        <textarea name="isi_laporan" placeholder="Tuliskan laporan kegiatan Anda..." required></textarea>

        <button class="form-btn" type="submit" name="simpan">💾 Simpan Laporan</button>
      </form>

      <?php
      if (isset($_POST['simpan'])) {
        $nama = $_POST['nama'];
        $tanggal = $_POST['tanggal'];
        $isi_laporan = $_POST['isi_laporan'];

        $q = "INSERT INTO laporan (nama, tanggal, isi_laporan) VALUES ('$nama','$tanggal','$isi_laporan')";
        if (mysqli_query($koneksi, $q)) {
          echo "<p class='success-msg'>✅ Laporan berhasil disimpan!</p>";
        } else {
          echo "<p class='error-msg'>❌ Gagal menyimpan ke database: " . mysqli_error($koneksi) . "</p>";
        }
      }
      ?>
    </div>

    <h2>🗂️ Daftar Laporan</h2>
    <?php
    $data = mysqli_query($koneksi, "SELECT * FROM laporan ORDER BY tanggal DESC");
    if (mysqli_num_rows($data) > 0) {
      echo "<table><tr><th>No</th><th>Nama</th><th>Tanggal</th><th>Isi Laporan</th></tr>";
      $no = 1;
      while ($row = mysqli_fetch_assoc($data)) {
        echo "<tr>
                <td>$no</td>
                <td>{$row['nama']}</td>
                <td>".date('d-m-Y', strtotime($row['tanggal']))."</td>
                <td>{$row['isi_laporan']}</td>
              </tr>";
        $no++;
      }
      echo "</table>";
    } else {
      echo "<p style='text-align:center;color:#777;'>Belum ada laporan yang disimpan.</p>";
    }
    ?>

    <footer>
      &copy; 2025 Mikrosite PKL | Laporan Kegiatan
    </footer>
  </div>

</body>
</html>
