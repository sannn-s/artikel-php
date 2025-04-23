<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'db.php';


$query = "SELECT 
    a.judul AS judul,
    a.hari_tgl AS tanggal,
    a.isi_artikel AS isi_artikel,
    a.gambar AS gambar,
    au.nama_lengkap AS nama_penulis,
    c.nama_kategori AS nama_kategori
FROM artikel a
JOIN artikel_penulis ap ON a.id = ap.id_artikel
JOIN penulis au ON ap.id_penulis = au.id
JOIN artikel_kategori ak ON a.id = ak.id_artikel
JOIN kategori_artikel c ON ak.id_kategori = c.id;
";


$result = mysqli_query($conn, $query);

if (!$result) {
  die("Query gagal: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Daftar Artikel</title>
  <link rel="stylesheet" href="style/styles.css">
</head>
<body>
<div class="header-artikel">
  <h2>Artikel</h2>
  <div class="artikel-container">
  <?php while ($row = mysqli_fetch_assoc($result)): ?>
    <div class="artikel">
      <img src="images/<?= $row['gambar']; ?>" alt="gambar artikel">
      <div class="judul"><?= $row['judul']; ?></div>
      <div class="tanggal"><?= date("d M Y", strtotime($row['tanggal'])); ?></div>
      <div class="meta">
        <strong>Penulis:</strong> <?= $row['nama_penulis']; ?> |
        <strong>Kategori:</strong> <?= $row['nama_kategori']; ?>
      </div>
      <div class="isi"><?= nl2br($row['isi_artikel']); ?></div>
    </div>
  <?php endwhile; ?>
</div>
</body>
</html>
