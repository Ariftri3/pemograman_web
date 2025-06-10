<h1>Tambah Theme</h1>
<form action="{{ route('themes.store') }}" method="POST">
    @csrf
    <label>Nama:</label><br>
    <input type="text" name="name"><br><br>

    <label>Deskripsi:</label><br>
    <textarea name="description"></textarea><br><br>

    <label>Folder:</label><br>
    <input type="text" name="folder"><br><br>

    <label>Status:</label><br>
    <select name="status">
        <option value="1">Aktif</option>
        <option value="0">Tidak Aktif</option>
    </select><br><br>

    <button type="submit">Simpan</button>
</form>