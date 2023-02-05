@extends('layouts.app')

@section('title', 'Penyewaan')
@section('content')

<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <a href="" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#tambahData">Tambah Data</a>
        <a href="export" class="btn btn-success mb-3">Print Excel</a>
        <!-- Basic Bootstrap Table -->
        <div class="card">
            <h5 class="card-header">Data Sewa</h5>
            <div class="table-responsive">
                <table class="table" class="table table-striped" id="example">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal Sewa</th>
                            <th>Nama Kendaraan</th>
                            <th>Nama Driver</th>
                            <th>Pihak 1</th>
                            <th>Pihak 2</th>
                            <th>Persetujuan 1</th>
                            <th>Persetujuan 2</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($data as $item)
                            @php
                                $data1 = DB::table('users')->where('users.id', $item->pihak_1)->get();
                                $data2 = DB::table('users')->where('users.id', $item->pihak_2)->get();
                            @endphp
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->tanggal_sewa }}</td>
                            <td>{{ $item->kendaraan->nama_kendaraan }}</td>
                            <td>{{ $item->driver->nama_driver }}</td>
                            @foreach ($data1 as $d1)
                            <td>{{ $d1->name }}</td>
                            @endforeach
                            @foreach ($data2 as $d2)
                            <td>{{ $d2->name }}</td>
                            @endforeach
                            @if ($item->acc_1 == 0)
                            <td><a href="/acc1/{{ $item->id }}"><span class="badge bg-label-warning">Belum Disetujui</span></a></td>
                            @else
                            <td><span class="badge bg-label-success">Disetujui</span></td>
                            @endif
                            @if ($item->acc_2 == 0)
                            <td><a href="/acc2/{{ $item->id }}"><span class="badge bg-label-warning">Belum Disetujui</span></a></td>
                            @else
                            <td><span class="badge bg-label-success">Disetujui</span></td>
                            @endif
                            <td>
                                <a class="btn rounded-pill btn-icon btn-outline-danger" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#del{{ $item->id }}">
                                    <i class="bx bx-trash "></i></a>
                            
                            </td>
                        </tr>

                        {{-- MODAL DELETE --}}
                        <div class="modal fade" id="del{{ $item->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalCenterTitle">Hapus Penyewaan</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('sewa.destroy', $item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <div class="modal-body">
                                            Anda yakin ingin menghapus?
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                                    Tutup
                                                </button>
                                                <button type="submit" class="btn btn-primary">Hapus</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            {{-- MODAL CLOSE --}}
                        </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!--/ Basic Bootstrap Table -->
    </div>
    
    <!-- Modal -->
    <div class="modal fade" id="tambahData" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">Tambah Penyewaan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('sewa.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Tanggal Sewa</label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                        <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                                class="bx bx-user"></i></span>
                                        <input type="date" class="form-control" id="basic-icon-default-fullname"
                                            placeholder="Masukkan Nama..." name="tanggal_sewa" aria-describedby="basic-icon-default-fullname2" />
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-icon-default-email">Nama Kendaraan</label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i class='bx bx-car'></i></span>
                                        <select name="kendaraan_id" id="" class="form-select">
                                            @foreach ($kendaraan as $item)
                                            <option value="{{ $item->id }}">{{ $item->nama_kendaraan }}</option>
                                            @endforeach
                                        </select>
                                </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-icon-default-email">Nama Driver</label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i class='bx bx-user'></i></span>
                                        <select name="driver_id" id="" class="form-select">
                                            @foreach ($driver as $item)
                                            <option value="{{ $item->id }}">{{ $item->nama_driver }}</option>
                                            @endforeach
                                        </select>
                                </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-icon-default-email">Pihak 1</label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i class='bx bx-user-pin'></i></span>
                                        <select name="pihak_1" id="" class="form-select">
                                            @foreach ($user as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-icon-default-email">Pihak 2</label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i class='bx bx-user-pin'></i></span>
                                        <select name="pihak_2" id="" class="form-select">
                                            @foreach ($user as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            Tutup
                        </button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
        {{-- MODAL CLOSE --}}
    </div>


@endsection
