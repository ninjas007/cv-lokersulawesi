<div class="card mb-3">
    <div class="card-header">
        <h4 class="font-weight-bold">
            <i class="fa fa-book"></i> Data Diri
        </h4>
    </div>
    <div class="card-body">
        <div class="form-group mb-3">
            <label for="ringkasan_profil" class="mb-1">Ringkasan Profil</label>
            <textarea class="form-control" name="ringkasan_profil" id="ringkasan_profil"
                placeholder="Contoh: Nama saya John Doe, Lahir di Kendari pada tanggal 3 April 1998. Saya adalah seorang web developer. Pernah mengerjakan beberapa project freelance baik itu untuk industri atau pemerintahan."
                cols="30" rows="5">{{ old('ringkasan_profil') }}</textarea>
        </div>
        <div class="form-group mb-3">
            <label for="foto" class="mb-1">Foto Profil</label> 
            <span class="text-primary" style="font-size: 11px; font-style: italic"><i class="fa fa-info text-white bg-info" data-mdb-toggle="tooltip" title="Untuk mendapatkan hasil gambar yang bagus baiknya gambar berukuran 100x100 px" style="font-size: 11px; border-radius: 50%; padding: 2px 5px"></i> (Foto harus berupa: jpg, jpeg, png, gif, max size: 512KB) 
                
            </span>
            <input type="file" class="form-control @error('foto') is-invalid @enderror" name="foto" id="foto">

            @error('foto')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group mb-3">
            <label for="nama" class="mb-1">Nama</label>
            <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" id="nama"
                placeholder="Contoh: John Doe" value="{{ old('nama') }}">
                
            @error('nama')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group mb-3">
            <label for="tempat_lahir" class="mb-1">Tempat Lahir</label>
            <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror" name="tempat_lahir"
                id="tempat_lahir" placeholder="Contoh: Kendari" value="{{ old('tempat_lahir') }}">

            @error('tempat_lahir')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group mb-3">
            <label for="tanggal_lahir" class="mb-1">Tanggal Lahir</label>
            <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" name="tanggal_lahir"
                id="tanggal_lahir" placeholder="Contoh: 3 April 1998" value="{{ old('tanggal_lahir') }}">

            @error('tanggal_lahir')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group mb-3">
            <label for="jenis_kelamin" class="mb-1">Jenis Kelamin</label>
            <select class="form-control @error('jenis_kelamin') is-invalid @enderror" name="jenis_kelamin"
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
            <input type="text" class="form-control @error('email') is-invalid @enderror" name="email"
                id="email" placeholder="Contoh: johndoe@mail.com" value="{{ old('email') }}">

            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group mb-3">
            <label for="no_hp" class="mb-1">No HP</label>
            <input type="text" class="form-control @error('no_hp') is-invalid @enderror" name="no_hp"
                id="no_hp" placeholder="Contoh: 0812345678998" value="{{ old('no_hp') }}">

            @error('no_hp')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group mb-3">
            <label for="alamat_lengkap" class="mb-1">Alamat Lengkap</label>
            <textarea class="form-control @error('alamat_lengkap') is-invalid @enderror" name="alamat_lengkap" id="alamat_lengkap"
                placeholder="Contoh: Jln. MT. Haryono, Lr. Beringin, Kel. Bende, Kec. Mandonga, Sulawesi Tenggara 93231"
                cols="30" rows="5">{{ old('alamat_lengkap') }}</textarea>

            @error('alamat_lengkap')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>
