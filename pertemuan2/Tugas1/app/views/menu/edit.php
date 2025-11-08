<div class="container mt-5">
    <h3>Edit Menu</h3>
    <form action="<?= BASEURL; ?>/menu/update" method="post">
        <input type="hidden" name="id" value="<?= $data['menu']['id']; ?>">
        <input type="text" name="nama" value="<?= $data['menu']['nama']; ?>" required><br>
        <input type="number" name="harga" value="<?= $data['menu']['harga']; ?>" required><br>
        <input type="text" name="kategori" value="<?= $data['menu']['kategori']; ?>" required><br>
        <button type="submit">Simpan Perubahan</button>
    </form>
</div>
