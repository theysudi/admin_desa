@include('layouts.shared.report_head')

<html>

<body>


    <table style="width: 100%; font-size:10pt; margin-bottom:10px;" border="0">
        <tr>
            <td colspan="2" style="text-align: center;  "> <b><u>SURAT KETERANGAN</u></b></td>
        </tr>
        <tr style=" line-height: 10%;">
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td colspan="2" style="text-align: center; " width="20%;">Nomor Surat : {{ $data->nomor_surat }}</td>
        </tr>
        <tr style=" line-height: 10%;">
            <td>&nbsp;</td>
        </tr>
    </table>

    {{--  --}}

    <table style="width: 100%; font-size:10pt; margin-bottom:10px;" border="0">
        <tr style=" line-height: 10%;">
            <td colspan="2" style="text-align: left; padding-left:100px;  line-height: 150%; ">Yang bertanda tangan
                dibawah ini : &nbsp;

        </tr>
    </table>
    <table style="width: 100%; font-size:10pt; margin-bottom:10px; margin-left:5%;" border="0">
        <tr>
            <td style="text-align: left; padding-left:100px;  line-height: 150%; ">Nama &nbsp;
            <td width="5%">: </td>
            <td> I Wayan Sadiarna,SH. </td>
            </td>
            <td>&nbsp; &nbsp;</td>
        </tr>
        <tr>
            <td style="text-align: left; padding-left:100px;  line-height: 150%; ">Jabatan
            <td width="5%">: </td>
            <td> Perbekel Desa Gunaksa </td>
            </td>
        </tr>
    </table>

    <table style="width: 100%; font-size:10pt; margin-bottom:10px;" border="0">
        <tr style=" line-height: 10%;">
            <td colspan="2" style="text-align: left; padding-left:100px;  line-height: 150%; ">Dengan ini menerangkan
                bahwa ; &nbsp;

        </tr>
    </table>

    <table style="width: 100%; font-size:10pt; margin-bottom:10px; margin-left:5%;" border="0">
        <tr>
            <td style="text-align: left; padding-left:100px;  line-height: 150%; ">1. Nama &nbsp;
            <td width="5%">: </td>
            <td>{!! $data->nama !!}</td>
            </td>
            <td>&nbsp; &nbsp;</td>
        </tr>
        <tr style=" line-height: 10%;">
        </tr>
        <tr>
            <td style="text-align: left; padding-left:100px;  line-height: 150%; ">2. NIK
            <td width="5%">: </td>
            <td>{!! $data->nik !!} </td>
            </td>
        </tr>
        <tr style=" line-height: 10%;">
        </tr>
        <tr>
            <td style="text-align: left; padding-left:100px;  line-height: 150%; ">3. Tempat, Tanggal
                Lahir
            <td width="5%">: </td>
            <td> {!! $data->tempat_lahir !!}, {{ $tanggallhr }} {{ $bulanlhr }} {{ $tahunlhr }} </td>
            </td>
        </tr>
        <tr style=" line-height: 10%;">
        </tr>
        <tr>
            <td style="text-align: left; padding-left:100px;  line-height: 150%; ">5. Pekerjaan
            <td width="5%">: </td>
            <td> {!! $data->pekerjaan !!} </td>

            </td>
        </tr>
        <tr style=" line-height: 10%;">
        </tr>
        <tr>
            <td style="text-align: left; padding-left:100px;  line-height: 150%; ">6. Alamat
            <td width="5%">:</td>
            <td>{!! $data->alamat !!}</td>

            </td>
        </tr>
        <tr style=" line-height: 10%;">
        </tr>
        <tr style=" line-height: 10%;">
            <td>&nbsp;</td>
        </tr>
    </table>

    <table style="width: 100%; font-size:10pt; margin-bottom:10px;" border="0">
        <tr>
            <td style="text-align: center; " width="10%;"></td>
            <td> {{ $data->deskripsi_1 }}</td>
        </tr>
    </table>
    <table style="width: 100%; font-size:10pt; margin-bottom:10px;" border="0">
        <tr>
            <td style="text-align: center; " width="10%;"></td>
            <td> {{ $data->deskripsi_2 }}</td>
        </tr>
    </table>

    <table style="width: 100%; font-size:10pt; margin-right:70px;  margin-top:50px;" border="0">
        <tr>
            <td>
            <td style="text-align: right; ">Gunaksa, {{ $tanggal }}
                {{ $bulan }}
                {{ $tahun }}</td>
            </td>
        </tr>
    </table>
    {{-- <table align="right">
        <tr>
            <td>
                <img src="assets/images/tandatangan.png" height="110px" align="right">
            </td>
        </tr>
    </table>
    <table align="right">
        <tr>
            <td style="padding-right:100px;">
                <img src="assets/images/ttd-siguna.jpg" height="110px" align="right">
            </td>
        </tr>
    </table> --}}
</body>

</html>
