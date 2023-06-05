@if (!auth()->check())
    <!-- Informasi Login -->
    <div class="alert alert-info" style="font-size: 14px">
        Anda perlu login terlebih dahulu untuk menyimpan data.
        <br>
        Data yang disimpan nantinya bisa digunakan kembali untuk membuat surat lainnya
    </div>
@endif
