<table>
    <thead>
    <tr>
        <th style="font-weight: bold">Tanggal Sewa</th>
        <th style="font-weight: bold">Nama Kendaraan</th>
        <th style="font-weight: bold">Nama Driver</th>
        <th style="font-weight: bold">Penyetuju 1</th>
        <th style="font-weight: bold">Penyetuju 2</th>
        <th style="font-weight: bold">Status 1</th>
        <th style="font-weight: bold">Status 2</th>
    </tr>
    </thead>
    <tbody>
    @foreach($sewa as $item)
        @php
            $data1 = DB::table('users')->where('users.id', $item->pihak_1)->get();
            $data2 = DB::table('users')->where('users.id', $item->pihak_2)->get();
        @endphp
        <tr>
            <td>{{ $item->tanggal_sewa }}</td>
            <td>{{ $item->kendaraan->nama_kendaraan }}</td>
            <td>{{ $item->driver->nama_driver }}</td>
            @foreach ($data1 as $d1)
            <td>{{ $d1->name }}</td>
            @endforeach
            @foreach ($data2 as $d2)
            <td>{{ $d2->name }}</td>
            @endforeach
            @if ($item->acc_1 == 1)
            <td>Disetujui</td>
            @else
            <td>Belum Disetujui</td>
            @endif
            @if ($item->acc_2 == 1)
            <td>Disetujui</td>
            @else
            <td>Belum Disetujui</td>
            @endif
        </tr>
    @endforeach
    </tbody>
</table>