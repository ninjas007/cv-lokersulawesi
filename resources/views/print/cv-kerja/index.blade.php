<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Curicullum Vitae</title>
    <style>
        html {
            margin: 0px;
        }

        * {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 13px;
        }

        table {
            width: 100%;
            border-collapse: none;
        }

        table tr td {
            vertical-align: top;
        }

        .bold {
            font-weight: bold;
        }

        .uppercase {
            text-transform: uppercase;
        }

        .center {
            text-align: center;
        }

        .garis {
            border: .7px solid #3f3d3de5;
        }

        .page-break {
            page-break-before: always;
        }

        .fixed-button-container {
            position: fixed;
            bottom: 0;
            right: 0;
            left: 0;
            z-index: 100;
            font-size: 20;
            background-color: lightblue;
            text-align: center;
            padding: 10px;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
            color: white;
            padding: 10px 20px;
            font-size: 20;
            cursor: pointer;
            border-radius: 5px;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .btn-primary i {
            margin-right: 10px;
        }

        .subheading {
            font-size: 16px;
            font-weight: bold;
            text-transform: uppercase;
            border-bottom: .7px solid #3f3d3de5;
        }
    </style>
    @yield('css')
</head>

<body>
    <div id="content">
        @if (isset($preview))
            <div
                style="position: absolute; top: 5%; left: 55%; transform-origin: 0 0; width: 100%; transform:rotate(90deg); z-index: -1; font-size: 5rem; font-weight: bold; color: lightblue">
                LOKERSULAWESI.COM
            </div>
        @endif
        @yield('content')
    </div>

    <script src="{{ asset('js/html2pdf.bundle.min.js') }}"></script>
    @yield('js')
</body>

</html>
