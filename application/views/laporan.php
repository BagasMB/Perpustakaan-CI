<!-- <!DOCTYPE html>
<html lang="en">

<head>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
    }

    .invoice-container {
      width: 100%;
      max-width: 800px;
      margin: auto;
      padding: 20px;
      /* box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); */
    }

    .invoice-header,
    .invoice-footer {
      text-align: center;
      margin-bottom: 20px;
    }

    .invoice-header h2,
    .invoice-header h4,
    .invoice-header p {
      margin: 0;
    }

    .invoice-header h2 {
      margin-bottom: 10px;
    }

    .invoice-header h4 {
      margin-bottom: 5px;
    }

    .invoice-details {
      margin-bottom: 20px;
    }

    .invoice-details p {
      margin: 5px 0;
    }

    .invoice-table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 20px;
      table-layout: auto;
    }

    .invoice-table th,
    .invoice-table td {
      border: 1px solid #000000;
      padding: 8px;
      word-wrap: break-word;
    }

    .invoice-table th {
      background-color: #f2f2f2;
    }

    .invoice-footer {
      margin-top: 30px;
    }

    .invoice-footer p {
      margin: 5px 0;
    }

    .invoice-footer .signature {
      margin-top: 40px;
    }
  </style>
</head>

<body>
  <div class="invoice-container">
    <div class="invoice-header">
      <h2>Laporan Data Peminjaman</h2>
      <p>JL. Sriwijaya, Padangan, Jungke, Karanganyar, Jawa Tengah</p>
      <p>Telp/Fax. 09201089892 Email: bgsagsa@gmail.com</p>
    </div>
    <table class="invoice-table">
      <thead>
        <tr>
          <th>Kode Peminjaman</th>
          <th>Tanggal Peminjaman</th>
          <th>Nama</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $days = [
          'Sunday' => 'Minggu',
          'Monday' => 'Senin',
          'Tuesday' => 'Selasa',
          'Wednesday' => 'Rabu',
          'Thursday' => 'Kamis',
          'Friday' => 'Jumat',
          'Saturday' => 'Sabtu'
        ];

        foreach ($peminjaman as $jam):
          $date = new DateTime($jam['tanggal_peminjaman']);
          // Mendapatkan nama hari dalam bahasa Inggris
          $day_name = $date->format('l');
          // Menerjemahkan nama hari ke bahasa Indonesia
          $day_name_indonesian = $days[$day_name];
          // Format tanggal menjadi DD-MM-YYYY
          $formatted_date = $date->format('d-m-Y');
        ?>
          <tr>
            <td><?= $jam['kode_peminjaman']; ?></td>
            <td><?= $day_name_indonesian . ', ' . $formatted_date; ?></td>
            <td><?= $jam['nama']; ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</body>
<script>
  window.print();
  setTimeout(function() {
    window.close();
  }, 100);
</script>

</html> -->

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Laporan Peminjaman Buku</title>
  <style>
    /* Umum */
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f9f9f9;
      color: #333;
    }

    .container {
      width: 80%;
      margin: 0 auto;
      padding: 20px;
      background-color: #fff;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    header {
      text-align: center;
      margin-bottom: 30px;
    }

    header h1 {
      margin: 0;
      font-size: 24px;
      text-transform: uppercase;
      letter-spacing: 1px;
      color: #444;
    }

    .tanggal {
      margin-top: 5px;
      font-size: 14px;
      color: #777;
    }

    /* Tabel */
    table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 20px;
    }

    table th,
    table td {
      border: 1px solid #ddd;
      padding: 8px;
      text-align: left;
    }

    table th {
      background-color: #f2f2f2;
      text-transform: uppercase;
      font-size: 12px;
      letter-spacing: 1px;
    }

    table tr:nth-child(even) {
      background-color: #f9f9f9;
    }

    table tr:hover {
      background-color: #f1f1f1;
    }

    /* Footer */
    footer {
      text-align: right;
      font-size: 12px;
      color: #777;
      margin-top: 20px;
    }

    /* CSS untuk cetak */
    @media print {
      body {
        background-color: #fff;
      }

      .container {
        box-shadow: none;
        width: 100%;
        margin: 0;
        padding: 0;
      }

      header h1 {
        font-size: 20px;
      }

      footer {
        margin-top: 50px;
      }

      table th,
      table td {
        font-size: 12px;
      }

      .tanggal {
        font-size: 12px;
      }
    }
  </style>
</head>

<body>
  <div class="container">
    <header>
      <h1>Laporan Peminjaman Buku <br>
        Perpustakaan XX
      </h1>
      <p class="tanggal"><?= $judul; ?></p>
    </header>

    <table>
      <thead>
        <tr>
          <th>No</th>
          <th>Judul Buku</th>
          <th>Nama Peminjam</th>
          <th>Tanggal Peminjaman</th>
          <th>Tanggal Pengembalian</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        <?php if (!empty($peminjaman)) :
          $days = [
            'Sunday' => 'Minggu',
            'Monday' => 'Senin',
            'Tuesday' => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis',
            'Friday' => 'Jumat',
            'Saturday' => 'Sabtu'
          ];
          $no = 1;
          foreach ($peminjaman as $jam):
            $date = new DateTime($jam['tanggal_peminjaman']);
            // Mendapatkan nama hari dalam bahasa Inggris
            $day_name = $date->format('l');
            // Menerjemahkan nama hari ke bahasa Indonesia
            $day_name_indonesian = $days[$day_name];
            // Format tanggal menjadi DD-MM-YYYY
            $formatted_date = $date->format('d-m-Y');

            $date1 = new DateTime($jam['tanggal_pengembalian']);
            // Mendapatkan nama hari dalam bahasa Inggris
            $day_name1 = $date1->format('l');
            // Menerjemahkan nama hari ke bahasa Indonesia
            $day_name_indonesian1 = $days[$day_name1];
            // Format tanggal menjadi DD-MM-YYYY
            $formatted_date1 = $date1->format('d-m-Y');
        ?>
            <tr>
              <td><?= $no++; ?></td>
              <td><?= $jam['judul']; ?></td>
              <td><?= $jam['nama']; ?></td>
              <td><?= $day_name_indonesian . ', ' . $formatted_date; ?></td>
              <td><?= $day_name_indonesian1 . ', ' . $formatted_date1; ?></td>
              <td><?= $jam['status']; ?></td>
            </tr>
          <?php endforeach;
        else : ?>
          <div class="col-12">
            <div class="alert alert-warning text-center" role="alert">
              Data koleksi belum ada.
            </div>
          </div>
        <?php endif; ?>

      </tbody>
    </table>

    <footer>
      <p>Dicetak pada: <span id="tanggal-cetak"></span></p>
      <p>Perpustakaan X</p>
    </footer>
  </div>

  <script>
    // Script untuk menampilkan tanggal cetak secara dinamis
    document.getElementById('tanggal-cetak').innerText = new Date().toLocaleDateString('id-ID');

    window.print();
    setTimeout(function() {
      window.close();
    }, 100);
  </script>
</body>

</html>