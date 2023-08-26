<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Report</title>
    <style>
        /** Define the margins of your page **/
        @page {
            /* margin-top: 208px; */
            margin-left: 25px;
            margin-right: 25px;
            margin-bottom: 60px;
            font-size: 10pt;
        }

        body {
            font-family: "Times New Roman", Times, serif;
        }

        header {
            font-family: "Times New Roman", Times, serif;
            /* position: fixed; */
            /* top: -180px; */
            left: 0px;
            right: 0px;
            /* height: 170px; */
            margin-bottom: 15px;

            /** Extra personal styles **/
            background-color: white;
            color: white;
            text-align: center;
            /* line-height: 35px; */
        }

        main {
            font-family: "Times New Roman", Times, serif;
            margin-bottom: 8px;
        }

        footer {
            font-family: "Times New Roman", Times, serif;
            position: fixed;
            bottom: -50px;
            left: 0px;
            right: 0px;
            height: 30px;

            /** Extra personal styles **/
            /* background-color: #FE0000; */
            color: white;
            line-height: 21px;
            padding-left: 25px;
            padding-right: 30px;
            border-top-left-radius: 0%;
            border-top-right-radius: 0%;
            border-bottom-left-radius: 5%;
            border-bottom-right-radius: 5%;
        }

        table {
            border-collapse: collapse;
        }

        td,
        th {
            padding: 3px;
            vertical-align: top;
        }
    </style>
</head>

<body>
    <header>
        <table style="width: 100%;" border="0">
            <tr>
                <td style="width: 100%;">
                    <img src="{{ asset('assets/images/report_head2.png') }}" alt="Kop Surat" class="img-fluid">
                </td>
            </tr>
        </table>
    </header>
    <footer>
        <table style="width: 100%;">
            <tr>
                <td style="text-align: left; font-size:10px; ">
                    Copyright &copy; <?php echo date('Y'); ?>
                    {{ getSetting()->nama_sistem }}
                </td>
                <td style="text-align: right; font-size:10px;">
                    Cetak: {{ Str::limit(Auth::user()->name, 15, '...') }}-{{ date('d/m/Y') }}
                </td>
            </tr>
        </table>
    </footer>
