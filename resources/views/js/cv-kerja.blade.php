<script type="text/javascript">
    const data = [];

    // remove pendidikan, pengalaman, portofolio
    function removeFormCard(elem) {
        elem.parentElement.remove();
        saveDataForm();
    }

    // remove sosial, keahlian
    function removeFormInline(elem) {
        elem.parentElement.parentElement.remove();
        saveDataForm();
    }

    function moveUpFormCard(elem) {
        let parent = elem.parentElement;
        parent.parentElement.insertBefore(parent, parent.previousElementSibling);
        saveDataForm();
    }

    function moveDownFormCard(elem) {
        let parent = elem.parentElement;
        parent.parentElement.insertBefore(parent, parent.nextElementSibling.nextElementSibling);
        saveDataForm();
    }

    function moveUpFormInline(elem) {
        let parent = elem.closest('.row');
        if (parent.previousElementSibling && parent.previousElementSibling.classList.contains('row')) {
            parent.parentElement.insertBefore(parent, parent.previousElementSibling);
            saveDataForm();
        }
    }

    function moveDownFormInline(elem) {
        let parent = elem.closest('.row');
        if (parent.nextElementSibling && parent.nextElementSibling.classList.contains('row')) {
            parent.parentElement.insertBefore(parent.nextElementSibling, parent);
            saveDataForm();
        }
    }

    $('#tambahPendidikan').on('click', function() {
        let konten = `@include('pages.parts.cv-kerja.contents.pendidikan-konten')`;

        $('#cardBodyPendidikan').append(konten)
    })

    $('#tambahKeahlian').on('click', function() {
        let konten = `@include('pages.parts.cv-kerja.contents.keahlian-konten-2')`;

        $('#cardBodyKeahlian #tipeListKeahlian').append(konten);
    });

    $('#tambahSosialMedia').on('click', function() {
        let konten = `@include('pages.parts.cv-kerja.contents.sosial-konten')`;

        $('#cardBodySosial').append(konten)
    })

    $('#tambahPengalaman').on('click', function() {
        let konten = `@include('pages.parts.cv-kerja.contents.pengalaman-konten')`;

        $('#cardBodyPengalaman').append(konten)
        addNote()
    })

    $('#tambahPortofolio').on('click', function() {
        let konten = `@include('pages.parts.cv-kerja.contents.portofolio-konten')`;

        $('#cardBodyPortofolio').append(konten);
        addNote()
    })


    function changeTipeInputKeahlian(elem) {
        let value = elem.value;

        if (value == 'text') {
            $('#tipeTextKeahlian').show();
            $('#tipeListKeahlian').hide();
            $('#tambahKeahlian').parent().hide();
        } else {
            $('#tipeTextKeahlian').hide();
            $('#tipeListKeahlian').show();
            $('#tambahKeahlian').parent().show();
        }
    }

    function selectTemplate() {
        template_use = $('input[name="template"]:checked').val();

        $('#templateUse').val(template_use);
    }

    function download() {
        selectTemplate();

        $(`#formCvKerja`).attr('action', `{{ route('order') }}`);
        $(`#formCvKerja`).submit();
    }

    function preview() {
        selectTemplate();
        $(`#formCvKerja`).attr('action', `{{ url('cv-kerja/preview') }}`);
        $(`#formCvKerja`).attr('target', '_blank');
        $(`#formCvKerja`).submit();
    }

    function showModalChooseLanguage() {
        $('#modalChooseLanguage').modal('show');
    }

    function addNote() {
        $('textarea.tiny').summernote({
            tabsize: 0,
            height: 200,
            focus: true,
            popattribution: false,
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['para', ['ul', 'ol', 'paragraph']],
            ]
        });
    }

    addNote()

    function setLang(lang) {
        $('#langUse').val(lang);
    }

    function errorDataDiri() {
        let error = 0;

        $('.text-validasi').remove();

        $('.validasi-datadiri').each(function() {
            $(this).removeClass('is-invalid');
            // $(this).after('text-validasi');
            if ($(this).val() == '') {
                const fieldText = $(this).prev('label').text();

                $(this).addClass('is-invalid');
                $(this).after(
                    `<div class="text-danger text-validasi">${fieldText} harus diisi.</div>`);

                error += 1;
            }
        });

        // Validasi ukuran file gambar
        const imageFile = $('#foto')[0].files[0]; // Ganti '#foto' dengan id input file gambar Anda
        if (imageFile) {
            const fileSizeKB = imageFile.size / 1024; // Ukuran dalam KB
            if (fileSizeKB > 1024) { // Batas ukuran 1024 KB (1 MB)
                const fieldText = $('#foto').prev('label').text(); // Ganti '#foto' dengan id input file gambar Anda

                $('#foto').addClass('is-invalid'); // Ganti '#foto' dengan id input file gambar Anda
                $('#foto').after(
                    `<div class="text-danger text-validasi">${fieldText} harus kurang dari 1024 KB.</div>`
                );

                error += 1;
            }
        }

        return error;
    }

    function addRowBySection(formObject, key) {
        switch (key) {
            case 'pendidikan':
                // empty cardBodyPendidikan
                $('#cardBodyPendidikan').empty();

                // count row from formObject
                for (let i = 0; i < formObject[key].sekolah.length; i++) {
                    $('#tambahPendidikan').trigger('click');
                }

                break;

            case 'pengalaman':
                // empty cardBodyPendidikan
                $('#cardBodyPengalaman').empty();

                // count row from formObject
                for (let i = 0; i < formObject[key].posisi.length; i++) {
                    $('#tambahPengalaman').trigger('click');
                }

                break;

            case 'portofolio':
                // empty cardBodyPendidikan
                $('#cardBodyPortofolio').empty();

                // count row from formObject
                for (let i = 0; i < formObject[key].nama_portofolio.length; i++) {
                    $('#tambahPortofolio').trigger('click');
                }

                break;

            case 'keahlian':
                $('#tambahKeahlian').trigger('click');
                break;

            case 'sosial_media':
                // empty cardBodyPendidikan
                $('#cardBodySosial').empty();

                // count row from formObject
                for (let i = 0; i < formObject[key].nama.length; i++) {
                    $('#tambahSosialMedia').trigger('click');
                }

                break;
        }
    }

    function saveDataForm() {
        const form = document.getElementById('formCvKerja');
        const formData = new FormData(form);
        const formObject = {};

        // Handle non-image form fields
        formData.forEach((value, key) => {
            if (key !== '_token' && key !== 'snap_token' && key !== 'image') {
                if (key.includes('[')) {
                    const name = key.substring(0, key.indexOf('['));
                    const subName = key.substring(key.indexOf('[') + 1, key.indexOf(']'));
                    if (!formObject[name]) {
                        formObject[name] = {};
                    }
                    if (!formObject[name][subName]) {
                        formObject[name][subName] = [];
                    }
                    formObject[name][subName].push(value);
                } else {
                    formObject[key] = value;
                }
            }
        });

        // Handle image file
        const imageFile = formData.get('foto');
        if (imageFile) {
            const reader = new FileReader();
            reader.onloadend = function() {
                formObject['foto'] = reader.result;

                // Store the form data in localStorage
                localStorage.setItem('data', JSON.stringify(formObject));
            };
            reader.readAsDataURL(imageFile);
        } else {
            // Store the form data in localStorage
            localStorage.setItem('data', JSON.stringify(formObject));
        }
    }

    function getDataFromLocalStorage() {
        const data = localStorage.getItem('data');
        if (data) {
            const formObject = JSON.parse(data);
            Object.keys(formObject).forEach(key => {
                if (key === 'foto') {
                    // Isi input file dengan URL dari LocalStorage
                    const base64Image = localStorage.getItem('foto');
                    if (base64Image) {
                        const imgElement = document.getElementById('displayImage');
                        imgElement.src = base64Image;
                        imgElement.style.display = 'block';

                        // Buat objek File dari base64 URL dan tambahkan ke input file
                        const byteString = atob(base64Image.split(',')[1]);
                        const mimeString = base64Image.split(',')[0].split(':')[1].split(';')[0];
                        const ab = new ArrayBuffer(byteString.length);
                        const ia = new Uint8Array(ab);
                        for (let i = 0; i < byteString.length; i++) {
                            ia[i] = byteString.charCodeAt(i);
                        }
                        const blob = new Blob([ab], {
                            type: mimeString
                        });
                        const file = new File([blob], "photo-profile.jpg");

                        // Membuat DataTransfer untuk mengisi input file
                        const dataTransfer = new DataTransfer();
                        dataTransfer.items.add(file);
                        document.getElementById('foto').files = dataTransfer.files;
                    }
                } else if (typeof formObject[key] === 'object') {

                    // tambahkan row untuk setiap bagian
                    // contoh pendidikan, pengalaman, sosial media, dll
                    addRowBySection(formObject, key);

                    // input value
                    setTimeout(() => {
                        // Setelah semua konten ditambahkan, isi nilai input
                        Object.keys(formObject[key]).forEach((subKey) => {
                            formObject[key][subKey].forEach((value, index) => {
                                // Looping lagi untuk memastikan elemen input ditemukan
                                const inputs = document.querySelectorAll(
                                    `[name="${key}[${subKey}][]"]`);

                                // check inputs text area class tiny
                                if (inputs[index] && inputs[index].classList.contains(
                                        'tiny')) {
                                    // input by name tag
                                    $(inputs[index]).summernote('code', value);
                                    // $('textarea.tiny').summernote('code', value);
                                }

                                if (inputs[index]) {
                                    inputs[index].value = value;
                                }
                            });
                        });
                    }, 100);
                } else {
                    const input = document.querySelector(`[name="${key}"]`);
                    if (input) {
                        input.value = formObject[key];
                    }
                }
            });
        }
    }

    function handleFileUpload(event) {
        const file = event.target.files[0];
        if (file) {
            // Validasi ukuran file
            const fileSizeKB = file.size / 1024; // Ukuran dalam KB
            if (fileSizeKB > 1024) { // Batas ukuran 1024 KB (1 MB)
                swal({
                    title: 'Ukuran file terlalu besar',
                    text: 'Ukuran file harus kurang dari 1024 KB.',
                    icon: 'error',
                })
                event.target.value = null; // Kosongkan nilai input file
                imgElement.src = '';
                imgElement.style.display = 'none';
                return; // Batalkan pemrosesan file
            }

            const reader = new FileReader();
            reader.onloadend = function() {
                const base64Image = reader.result;
                // Simpan URL base64 ke LocalStorage
                localStorage.setItem('foto', base64Image);

                // Perbarui displayImage
                const imgElement = document.getElementById('displayImage');
                imgElement.src = base64Image;
                imgElement.style.display = 'block';
            };
            reader.readAsDataURL(file);
        } else {
            // Kosongkan displayImage jika tidak ada file yang dipilih
            const imgElement = document.getElementById('displayImage');
            imgElement.src = '';
            imgElement.style.display = 'none';
        }
    }

    function resetForm() {
        swal({
                title: 'Yakin untuk mereset form?',
                text: 'Semua data yang telah di inputkan akan direset.',
                icon: 'warning',
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    // clear localstorage key data
                    localStorage.removeItem('data');
                    localStorage.removeItem('foto');

                    // reload page
                    window.location.reload();
                }
            });
    }

    document.getElementById('foto').addEventListener('change', handleFileUpload);
    document.addEventListener('DOMContentLoaded', getDataFromLocalStorage);
</script>
