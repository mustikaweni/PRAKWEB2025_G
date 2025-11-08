<div class="container mt-4">
    <h3>Tambah Menu Baru</h3>

    <form action="<?= BASEURL; ?>/menu/tambah" method="post">
        <div>
            <label for="nama">Nama Menu</label><br>
            <input type="text" id="nama" name="nama" placeholder="Contoh: Nasi Goreng" required>
        </div>

        <div>
            <label for="harga">Harga (angka)</label><br>
            <input type="number" id="harga" name="harga" placeholder="15000" required>
        </div>

        <div>
            <label for="kategori">Kategori</label><br>
            <input type="text" id="kategori" name="kategori" placeholder="Makanan / Minuman" required>
        </div>

        <div style="margin-top:10px;">
            <button type="submit">Simpan</button>
            <a href="<?= BASEURL; ?>/menu">Batal</a>
        </div>
    </form>
</div>