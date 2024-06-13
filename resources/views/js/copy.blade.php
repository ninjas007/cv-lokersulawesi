<script>
    function copyToClipboard(text) {
        // Buat elemen sementara untuk menyalin teks
        var $temp = $("<input>");

        // Tambahkan elemen sementara ke dalam dokumen
        $("body").append($temp);

        // Salin teks ke elemen sementara
        $temp.val(text).select();

        // Salin teks ke clipboard
        document.execCommand("copy");

        // Hapus elemen sementara dari dokumen
        $temp.remove();

        swal({
            title: "Sukses",
            text: `Text berhasil di copy: ${text}`,
            icon: "success",
            button: "Ok",
        });
    }
</script>
