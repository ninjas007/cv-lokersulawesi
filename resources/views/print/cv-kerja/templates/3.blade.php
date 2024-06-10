@extends('menus.preview.index')

@section('css')
    <style>
        * {
            color: #101010e5;
            line-height: 1.5;
            font-size: 28px;
            /* Set font size to 14px */
        }

        tr {
            page-break-before: always;
            page-break-after: always;
        }

        table {
            page-break-before: always;
            width: 100%;
            border-collapse: collapse;
        }

        table tr td {
            padding: 0px;
            border-collapse: collapse;
            line-height: 1.5
        }

        a {
            color: #3f3d3de5;
        }

        #loading {
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #fff;
            z-index: 999;
        }

        #body {
            margin-top: 20px;
        }

        #image {
            display: block;
            margin: 20px auto;
            max-width: 100%;
            height: auto;
        }

        footer.fixed-bottom {
            position: fixed;
            bottom: 0;
            width: 100%;
            background-color: #f8f9fa;
            padding: 10px 0;
            box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.1);
        }

        .footer-buttons {
            display: flex;
            justify-content: center;
            gap: 10px;
        }

        /* Watermark styles */
        #watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 100px;
            color: lightblue;
            opacity: 0.3;
            z-index: 0;
            pointer-events: none;
        }

        .page-break {
            page-break-before: always;
        }
    </style>
@endsection

<body>
    <div id="loading">
        Loading...
    </div>

    <div id="watermark">lokersulawesi.com</div>

    <div id="body">

    </div>

    <div style="margin-bottom: 120px">
        <img id="image" alt="Generated Image" style="padding-bottom: 100px" />
    </div>

    <footer class="fixed-bottom">
        <div class="container text-center footer-buttons">
            <button id="downloadBtn" class="btn btn-primary">Download</button>
            <button id="cancelBtn" class="btn btn-secondary">Batal</button>
        </div>
    </footer>

    <script src='https://code.jquery.com/jquery-3.4.1.min.js'></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.3.3/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script>
        $.ajax({
            url: "{{ route('preview-cv-kerja') }}",
            type: 'POST',
            data: {
                _token: "{{ csrf_token() }}",
            },
            success: function(response) {
                var content = response;
                previewImage(content);
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            }
        });

        function previewImage(content) {
            var element = document.getElementById('body');

            // append body dari content
            element.innerHTML = content;

            html2canvas(element, {
                scale: 2,
                useCORS: true // Untuk memastikan gambar dari sumber luar bisa diambil
            }).then(function(canvas) {
                var imgData = canvas.toDataURL('image/png');

                // Tampilkan gambar di elemen <img>
                var imgElement = document.getElementById('image');
                imgElement.src = imgData;
                imgElement.style.width = '960px';
                imgElement.style.height = 'auto';

                // remove loading preview
                $('#loading').remove();

                // remove content body
                $('#body').remove();

                // Attach download functionality
                document.getElementById('downloadBtn').addEventListener('click', function() {
                    downloadPDF(canvas);
                });
            }).catch(function(error) {
                console.error('Error generating image:', error);
            });
        }

        function downloadPDF(canvas) {
            const {
                jsPDF
            } = window.jspdf;

            // Hide the watermark before generating the PDF
            document.getElementById('watermark').style.display = 'none';

            // Create a new PDF document with A4 dimensions
            var pdf = new jsPDF('p', 'mm', 'a4');

            // Define the margin
            var margin = 15; // margin in mm
            var imgWidth = 210 - 2 * margin; // A4 width in mm minus 2*margin
            var pageHeight = 295 - 2 * margin; // A4 height in mm minus 2*margin

            var position = margin;

            // Function to add page and reset position
            function addNewPage() {
                pdf.addPage();
                position = margin;
            }

            // Add image to PDF document with margin
            function addImageToPDF() {
                var imgHeight = (canvas.height * imgWidth) / canvas.width;
                pdf.addImage(canvas, 'PNG', margin, position, imgWidth, imgHeight);
                position += imgHeight;

                // Check if content exceeds page height
                if (position > pageHeight) {
                    addNewPage(); // Add new page
                }
            }

            // Initial image addition
            addImageToPDF();

            // Save the PDF
            pdf.save('Curriculum Vitae.pdf');

            // Show the watermark again after generating the PDF
            document.getElementById('watermark').style.display = 'block';
        }
    </script>
</body>

</html>
