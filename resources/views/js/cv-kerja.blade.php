<script type="text/javascript">
    const data = [];

    // remove pendidikan, pengalaman, portofolio
    function removeFormCard(elem) {
        elem.parentElement.remove();
    }

    // remove sosial, keahlian
    function removeFormInline(elem) {
        elem.parentElement.parentElement.remove();
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
        // addTinyMce()
    })

    $('#tambahPortofolio').on('click', function() {
        let konten = `@include('pages.parts.cv-kerja.contents.portofolio-konten')`;

        $('#cardBodyPortofolio').append(konten);
        // addTinyMce()
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
        if (validation() > 0) {
            swal({
                    title: 'Info',
                    text: 'Terdapat data yang harus di isi',
                    icon: 'info',
                    button: true,
                })
                .then(() => {
                    $('#modalPilihTemplate').modal('hide');
                });

            return
        }

        $(`#formCvKerja`).attr('action', `{{ url('download') }}`);
        $(`#formCvKerja`).submit();
    }

    function validation() {
        let is_valid = 0;

        $('.custom_validation').each(function() {
            $(this).removeClass('is-invalid');
            $(this).removeClass('custom_invalid');
            if ($(this).val() == '') {
                const fieldText = $(this).prev('label').text();

                $(this).addClass('is-invalid');
                $(this).after(
                    `<div class="invalid-feedback mt-1 custom_invalid">${fieldText} harus diisi.</div>`);

                is_valid++;
            }
        });

        return is_valid;
    }

    function preview() {
        $(`#formCvKerja`).attr('action', `{{ url('preview') }}`);
        $(`#formCvKerja`).attr('target', '_blank');
        $(`#formCvKerja`).submit();
    }

    function showModalChooseLanguage() {
        $('#modalChooseLanguage').modal('show');
    }

    function addTinyMce() {
        tinymce.init({
            selector: 'textarea.tiny',
            forced_root_block: 'div'
        });
    }

    // addTinyMce()

    function saveDataToLocalStorage() {
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
        console.log(imageFile);
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
                if (key === 'image') {
                    // Display the image
                    const imgElement = document.getElementById('displayImage');
                    imgElement.src = formObject[key];
                    imgElement.style.display = 'block';
                } else if (typeof formObject[key] === 'object') {
                    Object.keys(formObject[key]).forEach(subKey => {
                        formObject[key][subKey].forEach((value, index) => {
                            const input = document.querySelector(
                                `[name="${key}[${subKey}][]"]:nth-of-type(${index + 1})`);
                            if (input) {
                                input.value = value;
                            }
                        });
                    });
                } else {
                    const input = document.querySelector(`[name="${key}"]`);
                    if (input) {
                        input.value = formObject[key];
                    }
                }
            });
        }
    }

    document.addEventListener('DOMContentLoaded', getDataFromLocalStorage);
</script>
