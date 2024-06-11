<script>
    function isMobileDevice() {
        return /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
    }

    function printAndKeepOpen() {
        window.print();
    }

    window.onload = function() {
        printAndKeepOpen();

        // Menangani event saat jendela pencetakan ditutup
        window.onafterprint = function() {
            // Jika pengguna bukan dari perangkat seluler, maka tutup jendela
            if (!isMobileDevice()) {
                // Memberikan jeda sebelum menutup halaman agar jendela pencetakan dapat menyelesaikan prosesnya
                setTimeout(function() {
                    // Menutup jendela pencetakan
                    window.close();
                }, 100);
            }
        };

        // Menangani event saat pencetakan dibatalkan atau disimpan
        window.onbeforeprint = function() {
            // Jika pengguna bukan dari perangkat seluler, maka tutup jendela
            if (!isMobileDevice()) {
                // Memberikan jeda sebelum menutup halaman agar pengguna memiliki kesempatan untuk membatalkan pencetakan
                setTimeout(function() {
                    // Menutup jendela pencetakan
                    window.close();
                }, 100);
            }
        };
    };
</script>
