@include('layouts.shared.report_head')
<table style="width: 100%; font-size:10pt; margin-right:70px;" border="0">
    <tr>
        <td>
        <td colspan="2" style="text-align: right; ">Gunaksa, {{ $tanggal }}
            {{ $bulan }}
            {{ $tahun }}
        </td>
        </td>
    </tr>
</table>
<table style="width: 100%; font-size:10pt; margin-bottom:10px;" border="0">
    <tr>
        <td colspan="2" style="text-align: center;  "> <b><u>SURAT KETERANGAN</u></b></td>
    </tr>
    <tr>
        <td colspan="2" style="text-align: center; " width="20%;">Nomor :
            {{ $data->nomor_surat }}</td>
    </tr>
    <tr style=" line-height: 10%;">
        <td>&nbsp;</td>
    </tr>
</table>

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
    <tr>
        <td style="text-align: left; padding-left:100px;  line-height: 150%; ">Alamat
        <td width="5%">: </td>
        <td> Desa Gunaksa Kecamatan Dawan Kab. Klungkung. </td>
        </td>
    </tr>
</table>

<table style="width: 100%; font-size:10pt; margin-bottom:10px;" border="0">
    <tr>
        <td colspan="2" style="text-align: left; padding-left:100px;  line-height: 150%; ">Menyatakan dengan
            sesungguhnya bahwa : &nbsp;
    </tr>
</table>

<table style="width: 100%; font-size:10pt; margin-bottom:10px; margin-left:5%;" border="0">
    <tr>
        <td style="text-align: left; padding-left:100px;  line-height: 150%; ">Nama
        <td width="5%">: </td>
        <td> {!! $data->nama_hidup !!} </td>
        </td>
        <td>&nbsp; &nbsp;</td>
    </tr>
    <tr>
        <td style="text-align: left; padding-left:100px;  line-height: 150%; ">Alamat
        <td width="5%">: </td>
        <td> {!! $data->alamat_hidup !!} </td>
        </td>
        <td>&nbsp; &nbsp;</td>
    </tr>
</table>

<table style="width: 100%; font-size:10pt; margin-bottom:10px;" border="0">
    <tr style=" line-height: 10%;">
        <td colspan="2" style="text-align: left; padding-left:100px;  line-height: 150%; ">Adalah Janda / Duda dari
            almarhum / almarhumah yang semasa hidupnya : &nbsp;
    </tr>
</table>

<table style="width: 100%; font-size:10pt; margin-bottom:10px; margin-left:5%;" border="0">
    <tr>
        <td style="text-align: left; padding-left:100px;  line-height: 150%; ">1. Nama &nbsp;
        <td width="5%">: </td>
        <td> {!! $data->nama !!} </td>
        </td>
        <td>&nbsp; &nbsp;</td>
    </tr>
    <tr>
        <td style="text-align: left; padding-left:100px;  line-height: 150%; ">2. Pangkat/Golongan
        <td width="5%">: </td>
        <td>{!! $data->pangkat !!}</td>
        </td>
    </tr>
    <tr>
        <td style="text-align: left; padding-left:100px;  line-height: 150%; ">3. NRP/NIP/NPP
        <td width="5%">: </td>
        <td>{!! $data->nip !!}</td>
        </td>
    </tr>
    <tr>
        <td style="text-align: left; padding-left:100px;  line-height: 150%; ">4. Nomor Pensiun
        <td width="5%">: </td>
        <td>{!! $data->nomor_pensiun !!}</td>
        </td>
    </tr>
    <tr>
        <td style="text-align: left; padding-left:100px;  line-height: 150%; ">5. Instansi
        <td width="5%">: </td>
        <td>{!! $data->instansi !!}</td>
        </td>
    </tr>
    <tr>
        <td style="text-align: left; padding-left:100px;  line-height: 150%; ">6. Meninggal Dunia / Tewas
        <td width="5%"> </td>
        <td></td>
        </td>
    </tr>
    <tr>
        <td style="text-align: left; padding-left:100px;  line-height: 150%; ">
            Pada tanggal
        <td width="5%">:</td>
        <td>{{ $tanggalmeninggal }} {{ $bulanmeninggal }} {{ $tahunmeninggal }}</td>
        </td>
    </tr>
</table>

<table style="width: 100%; font-size:10pt; margin-bottom:10px;" border="0">
    <tr>
        <td style="text-align: justify; " width="10%;"></td>
        <td> {{ $data->deskripsi }}</td>
    </tr>
</table>

<table align="right">
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
</table>



</body>

</html>
