<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Beranda | Mikrosite PKL</title>
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
      width: calc(100% - 250px);
      height: 100vh;
      display: flex;
      flex-direction: column;
      justify-content: center; /* Tengah vertikal */
      align-items: center; /* Tengah horizontal */
      text-align: center;
      padding: 0 40px;
    }

    h1 {
      color: #004b9bff;
      font-size: 28px;
      margin-bottom: 15px;
    }

    .welcome-card {
      background: linear-gradient(135deg, #eaf5feff, #eaf5feff);
      border: 1px solid #cddffb;
      border-radius: 15px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
      padding: 25px 30px;
      max-width: 700px;
      line-height: 1.7;
      color: #333;
    }

    footer {
      text-align: center;
      margin-top: 25px;
      color: #666;
      font-size: 14px;
    }
  </style>
</head>
<body>

  <!-- Sidebar -->
  <div class="sidebar">
    <h2>📘 Mikrosite PKL</h2>
    <a href="index.php" class="active">🏠 Beranda</a>
    <a href="presensi.php">🧾 Presensi</a>
    <a href="agenda.php">🗓️ Agenda</a>
    <a href="laporan.php">📝 Laporan</a>
    <a href="foto.php">📸 Foto Kegiatan</a>
  </div>

  <!-- Main Content -->
  <div class="main-content">
    <h1>Selamat Datang di Mikrosite PKL</h1>
    <div class="welcome-card">
      <p>
        Halo! 👋 Selamat datang di <b>Mikrosite PKL</b>.<br>
        Situs ini dibuat untuk memudahkan pelaksanaan dan pelaporan kegiatan
        <b>Praktik Kerja Lapangan (PKL)</b>.<br>
        Silakan pilih menu di samping untuk mengisi presensi, melihat agenda,
        membuat laporan, atau mengunggah foto kegiatan.
      </p>
    </div>

    <footer>
      &copy; 2025 Mikrosite PKL | Semua Hak Dilindungi
    </footer>
  </div>

</body>
</html>
