<?php include 'koneksi.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pemesanan Lapangan</title>
</head>
<body>
    <h1>Form Pemesanan Lapangan</h1>
    <form action="process_booking.php" method="POST">
        <label for="nama_pemesan">Nama Pemesan:</label>
        <input type="text" id="nama_pemesan" name="nama_pemesan" required><br>

        <label for="nomor_telepon">Nomor Telepon:</label>
        <input type="text" id="nomor_telepon" name="nomor_telepon" required><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>

        <label for="tanggal_booking">Tanggal Booking:</label>
        <input type="date" id="tanggal_booking" name="tanggal_booking" required><br>

        <label for="jam_mulai">Jam Mulai:</label>
        <input type="time" id="jam_mulai" name="jam_mulai" required><br>

        <label for="lama_booking">Lama Booking (jam):</label>
        <select id="lama_booking" name="lama_booking" required>
            <option value="1">1 Jam</option>
            <option value="2">2 Jam</option>
            <option value="3">3 Jam</option>
            <!-- Tambahkan opsi lainnya sesuai kebutuhan -->
        </select><br>

        <input type="hidden" name="id_lapangan" value="<?php echo $_GET['id_lapangan']; ?>">

        <input type="submit" value="Pesan">
    </form>
</body>
</html>
