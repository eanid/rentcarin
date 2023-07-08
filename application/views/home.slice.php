<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Renctcarin</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #f2f2f2;
            padding: 20px;
            text-align: center;
        }

        .features,
        .why-choose,
        .cta {
            padding: 40px;
        }

        .features ul,
        .why-choose ul {
            list-style-type: disc;
            padding-left: 20px;
        }

        h1,
        h2,
        h3 {
            color: #333;
        }

        .btn-download {
            display: inline-block;
            padding: 12px 20px;
            background-color: #4CAF50;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
        }

        footer {
            background-color: #f2f2f2;
            padding: 20px;
            text-align: center;
            font-size: 14px;
        }

        /* modal */
        .modal {
            display: none;
            /* Modal awalnya disembunyikan */
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
            /* Latar belakang hitam transparan */
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 300px;
        }

        /* CSS untuk tombol penutup modal */
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>

<body>

    <header>
        <h1>Selamat Datang di Aplikasi Rental Mobil Rentcarin</h1>
        <h2>Mudah. Cepat. Efisien.</h2>
    </header>

    <section class="features">
        <h3>Proses mudah di Rentcarin:</h3>
        <ul>
            <li>Lihat Daftar Mobil</li>
            <li>Pemesanan yang Mudah</li>
            <li>Informasi Lengkap Mobil</li>
            <li>Konfirmasi Instan</li>
        </ul>
    </section>

    <section class="why-choose">
        <h3>Mengapa Memilih Aplikasi Rental Mobil Sederhana Kami?</h3>
        <ul>
            <li>Kemudahan Pemesanan</li>
            <li>Akses 24/7</li>
            <li>Harga Terjangkau</li>
            <li>Transparansi dan Keamanan</li>
        </ul>
    </section>

    <section class="why-choose">
        <h3>List mobil kami</h3>
        <ul>
            <?php foreach ($rent as $d) { ?>
                <li><?= $d['name']; ?></li>
            <?php } ?>
        </ul>
    </section>

    <section class="cta">
        <h3>Jangan Tunggu Lagi!</h3>
        <p>Segera pesan di Rentcarin untuk mendapatkan pengalaman sewa mobil yang praktis dan efisien. Mulailah petualangan Anda dengan mobil impian Anda sekarang juga!</p>
        <button onclick="openModal()" class="btn-download">Pesan sekarang!</button>

    </section>

    <footer>
        <p>Hak Cipta &copy; 2023 Aplikasi Rental Mobil Sederhana</p>
    </footer>

    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>Form Sewa</h2>
            <form>
                <label for="name">Nama:</label>
                <input type="text" id="name" name="name" required><br><br>
                <label for="nik">Nik:</label>
                <input type="text" id="nik" name="nik" required><br><br>
                <label for="nomor">Nomor Telepon:</label>
                <input type="tel" id="nomor" name="nomor" required pattern="[0-9]{10,12}"><br><br>
                <label for="tanggal">Tanggal sewa:</label>
                <input type="date" id="tanggal" name="tanggal" required><br><br>
                <label for="todal_day">jumlah hari sewa:</label>
                <input type="number" id="todal_day" name="todal_day" required><br><br>
                <!-- <input type="submit" value="Submit"> -->
                <button onclick="closeModal()" class="btn-download" type="submit" value="submit">Ajukan sewa!</button>
            </form>
        </div>
    </div>

    <script>
        function openModal() {
            document.getElementById("myModal").style.display = "block";
        }

        function closeModal() {
            document.getElementById("myModal").style.display = "none";
        }
    </script>
</body>

</html>