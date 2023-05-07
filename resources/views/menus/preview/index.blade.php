<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Preview</title>
    <style>
        html {
            margin: 0px;
        }

        * {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 13px;
        }

        table {
            width: 101%;
            border-collapse: none;
        }

        table tr td {
            vertical-align: top;
        }

        .page-break {
            page-break-inside: always !important;
        }
    </style>
</head>

<body>
    @if(isset($preview))
        <div style="position: absolute; top: 45%; bottom: 0; left: -140px; right: 0; transform: rotate(45deg); z-index: -1; font-size: 5rem; font-weight: bold; color: lightblue">
            LOKERSULAWESI.COM
        </div>
    @endif
    @yield('content')
</body>

</html>