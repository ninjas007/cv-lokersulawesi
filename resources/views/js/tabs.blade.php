<script>
    $(document).ready(function() {
        //Enable Tooltips
        var tooltipTriggerList = [].slice.call(
            document.querySelectorAll('[data-bs-toggle="tooltip"]')
        );
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });

        //Advance Tabs
        $(".next").click(function() {
            let part = $(this).data("part");

            // validation data diri
            if (part == "datadiri" && errorDataDiri() > 0) {
                return false;
            }

            // save from to local storage
            saveDataForm();

            // next section
            const nextTabLinkEl = $(".nav-tabs .active")
                .closest("li")
                .next("li")
                .find("a")[0];
            const nextTab = new bootstrap.Tab(nextTabLinkEl);

            nextTab.show();
        });

        $(".previous").click(function() {

            // save from to local storage
            saveDataForm();

            // previous section
            const prevTabLinkEl = $(".nav-tabs .active")
                .closest("li")
                .prev("li")
                .find("a")[0];
            const prevTab = new bootstrap.Tab(prevTabLinkEl);
            prevTab.show();
        });

        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
            const error = errorDataDiri();
            if (error > 0) {
                $('a[href="#step1"]').tab('show');

                // remove active tabs
                $(".nav-tabs .active").removeClass("active");

                // add active step1 tabs
                $('a[href="#step1"]').addClass("active");
            } else {
                saveDataForm();
            }
        });

    });
</script>
