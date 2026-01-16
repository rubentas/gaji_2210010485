<!DOCTYPE html>
<html lang="en">

<head>
    <title>Laporan Data Jabatan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header h1 {
            margin: 0;
            padding: 0;
        }

        .header p {
            margin: 5px 0;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>LAPORAN DATA JABATAN</h1>
        <p>Periode: {{ date('d F Y') }}</p>
        <hr>
    </div>

    <table>
        <thead>
            <tr>
                <th width="5%">NO.</th>
                <th>NAMA JABATAN</th>
                <th>GAJI POKOK</th>
                <th>TUNJANGAN</th>
                <th>UANG MAKAN/HARI</th>
            </tr>
        </thead>
        <tbody>
            @php
                $no = 1;
            @endphp
            @foreach ($jabatan as $jb)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $jb->nama_jabatan }}</td>
                    <td>Rp {{ number_format($jb->gapok_jabatan, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($jb->tunjangan_jabatan, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($jb->uang_makan_perhari, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div style="margin-top: 50px; text-align: right;">
        <p>Dicetak pada: {{ date('d-m-Y H:i:s') }}</p>
    </div>
</body>

</html>
