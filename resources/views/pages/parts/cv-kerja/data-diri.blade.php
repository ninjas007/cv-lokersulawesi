<div class="card">
    @include('pages.parts.cv-kerja.contents.card-title')

    <div class="card-body">
        <div class="form-group mb-3">
            <div class="mb-3 d-flex justify-content-center">
                <img id="displayImage" style="border-radius: 5%; object-fit: cover; display: none; height: 110px; width: 100px"/>
            </div>
            <label for="foto" class="mb-1">Foto Profil</label>
            <span class="text-primary" style="font-size: 11px; font-style: italic"><i class="fa fa-info text-white bg-info" data-mdb-toggle="tooltip" title="Disarankan gambar berukuran height: 110px dan width: 100px" style="font-size: 11px; border-radius: 50%; padding: 2px 5px"></i> (Foto harus berupa: jpg, jpeg, png, max size: 1024KB)

            </span>
            <input type="file" class="form-control validasi-datadiri @error('foto') is-invalid @enderror" name="foto" accept="image/*" id="foto">

            @error('foto')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group mb-3">
            <label for="ringkasan_profil" class="mb-1">Ringkasan Profil</label>
            <textarea class="form-control validasi-datadiri" name="ringkasan_profil" id="ringkasan_profil"
                placeholder="Contoh: Nama saya John Doe, Lahir di Kendari pada tanggal 3 April 1998. Saya adalah seorang web developer. Pernah mengerjakan beberapa project freelance baik itu untuk industri atau pemerintahan."
                cols="30" rows="5">{{ old('ringkasan_profil') }}</textarea>
        </div>
        <div class="form-group mb-3">
            <label for="nama" class="mb-1">Nama</label>
            <input type="text" class="form-control validasi-datadiri @error('nama') is-invalid @enderror" name="nama" id="nama"
                placeholder="Contoh: John Doe" value="{{ old('nama') }}">

            @error('nama')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group mb-3">
            <label for="tempat_lahir" class="mb-1">Tempat Lahir</label>
            <input type="text" class="form-control validasi-datadiri @error('tempat_lahir') is-invalid @enderror" name="tempat_lahir"
                id="tempat_lahir" placeholder="Contoh: Kendari" value="{{ old('tempat_lahir') }}">

            @error('tempat_lahir')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group mb-3">
            <label for="tanggal_lahir" class="mb-1">Tanggal Lahir</label>
            <input type="date" class="form-control validasi-datadiri @error('tanggal_lahir') is-invalid @enderror" name="tanggal_lahir"
                id="tanggal_lahir" placeholder="Contoh: 3 April 1998" value="{{ old('tanggal_lahir') }}">

            @error('tanggal_lahir')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group mb-3">
            <label for="jenis_kelamin" class="mb-1">Jenis Kelamin</label>
            <select class="form-control validasi-datadiri @error('jenis_kelamin') is-invalid @enderror" name="jenis_kelamin"
                id="jenis_kelamin">
                <option value="">Pilih Jenis Kelamin</option>
                <option value="Pria">Pria</option>
                <option value="Wanita">Wanita</option>
            </select>

            @error('jenis_kelamin')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group mb-3">
            <label for="email" class="mb-1">Email</label>
            <input type="text" class="form-control validasi-datadiri @error('email') is-invalid @enderror" name="email"
                id="email" placeholder="Contoh: johndoe@mail.com" value="{{ old('email') }}">

            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group mb-3">
            <label for="no_hp" class="mb-1">No HP</label>
            <input type="text" class="form-control validasi-datadiri @error('no_hp') is-invalid @enderror" name="no_hp"
                id="no_hp" placeholder="Contoh: 0812345678998" value="{{ old('no_hp') }}">

            @error('no_hp')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group mb-3">
            <label for="alamat_lengkap" class="mb-1">Alamat Lengkap</label>
            <textarea class="form-control validasi-datadiri @error('alamat_lengkap') is-invalid @enderror" name="alamat_lengkap" id="alamat_lengkap"
                placeholder="Contoh: Jln. MT. Haryono, Lr. Beringin, Kel. Bende, Kec. Mandonga, Sulawesi Tenggara 93231"
                cols="30" rows="5">{{ old('alamat_lengkap') }}</textarea>

            @error('alamat_lengkap')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>

<div class="fixed-bottom-container">
    <div class="container">
        <div class="form-group d-flex justify-content-center">
            <a class="btn btn-info next" data-part="datadiri">Continue <i class="fas fa-angle-right"></i></a>
        </div>
    </div>
</div>
