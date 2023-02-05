@extends('layouts.app')

@section('title', 'Data Kendaraan')
@section('content')

<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Pendataan /</span> Data Kendaraan</h4>
        <a href="" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#tambahData">Tambah Data</a>
        <!-- Basic Bootstrap Table -->
        <div class="card">
            <h5 class="card-header">Data Kendaraan</h5>
            <div class="table-responsive">
                <table class="table" class="table table-striped" id="example">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Kendaraan</th>
                            <th>Jenis</th>
                            <th>Konsumsi BBM</th>
                            <th>Jadwal</th>
                            <th>Asal</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($data as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->nama_kendaraan }}</td>
                            <td>{{ $item->jenis }}</td>
                            <td>{{ $item->konsumsi_bbm }}</td>
                            <td>{{ $item->jadwal }}</td>
                            <td>{{ $item->asal }}</td>
                            @if ($item->status == 0)
                            <td>Tersedia</td>
                            @else
                            <td>Tidak Tersedia</td>
                            @endif
                            <td>
                                <a class="btn rounded-pill btn-icon btn-outline-info" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#edit{{ $item->id }}">
                                    <i class="bx bx-edit-alt"></i></a>
                                <a class="btn rounded-pill btn-icon btn-outline-danger" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#del{{ $item->id }}">
                                    <i class="bx bx-trash "></i></a>

                            </td>
                        </tr>

                        {{-- MODAL EDIT --}}
                        <div class="modal fade" id="edit{{ $item->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-lg modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalCenterTitle">Ubah Data Kendaraan</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('kendaraan.update', $item->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-body">
                                            <div class="row">
                                                    <div class="row mb-3">
                                                        <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Nama
                                                            Kendaraan</label>
                                                        <div class="col-sm-10">
                                                            <div class="input-group input-group-merge">
                                                                <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                                                        class="bx bx-user"></i></span>
                                                                <input type="text" class="form-control" id="basic-icon-default-fullname"
                                                                    placeholder="Masukkan Nama..." name="nama_kendaraan" value="{{ $item->nama_kendaraan }}"
                                                                    aria-describedby="basic-icon-default-fullname2" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label class="col-sm-2 col-form-label" for="basic-icon-default-email">Jenis</label>
                                                        <div class="col-sm-10">
                                                            <div class="input-group input-group-merge">
                                                                <span class="input-group-text"><i class='bx bx-list-minus'></i></span>
                                                                <select name="jenis" id="" class="form-select">
                                                                    <option value="Angkutan Barang" @if ($item->jenis == 'Angkutan Barang')
                                                                        @selected($item->jenis == 'Angkutan Barang')
                                                                    @endif>Angkutan Barang</option>
                                                                    <option value="Angkutan Orang" @if ($item->jenis == 'Angkutan Orang')
                                                                        @selected($item->jenis == 'Angkutan Orang')
                                                                    @endif>Angkutan Orang</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label class="col-sm-2 form-label" for="basic-icon-default-phone">Konsumsi BBM</label>
                                                        <div class="col-sm-10">
                                                            <div class="input-group input-group-merge">
                                                                <span id="basic-icon-default-phone2" class="input-group-text"><i
                                                                        class="bx bx-wallet"></i></span>
                                                                <input type="text" id="basic-icon-default-phone"
                                                                    class="form-control phone-mask" placeholder="Masukkan Biaya..." value="{{ $item->konsumsi_bbm }}"
                                                                    name="konsumsi_bbm" aria-describedby="basic-icon-default-phone2" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label class="col-sm-2 form-label" for="basic-icon-default-phone">Jadwal</label>
                                                        <div class="col-sm-10">
                                                            <div class="input-group input-group-merge">
                                                                <span id="basic-icon-default-phone2" class="input-group-text"><i
                                                                        class="bx bx-calendar-check"></i></span>
                                                                <input type="date" id="basic-icon-default-phone"
                                                                    class="form-control phone-mask" placeholder="Masukkan Jadwal..." value="{{ $item->jadwal }}"
                                                                    name="jadwal" aria-describedby="basic-icon-default-phone2" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label class="col-sm-2 col-form-label" for="basic-icon-default-email">Asal Kendaraan</label>
                                                        <div class="col-sm-10">
                                                            <div class="input-group input-group-merge">
                                                                <span class="input-group-text"><i class='bx bx-home'></i></span>
                                                                <select name="asal" id="" class="form-select">
                                                                    <option value="Perusahaan" @if ($item->asal == 'Perusahaan')
                                                                        @selected($item->asal == 'Perusahaan')
                                                                    @endif>Perusahaan</option>
                                                                    <option value="Penyewaan" @if ($item->asal == 'Penyewaan')
                                                                        @selected($item->asal == 'Penyewaan')
                                                                    @endif>Penyewaan</option>
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
                                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            {{-- MODAL CLOSE --}}
                        </div>

                        {{-- MODAL DELETE --}}
                        <div class="modal fade" id="del{{ $item->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalCenterTitle">Hapus Data Kendaraan</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('kendaraan.destroy', $item->id) }}" method="POST">
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
        <div class="modal-lg modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">Tambah Data Kendaraan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('kendaraan.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Nama
                                        Kendaraan</label>
                                    <div class="col-sm-10">
                                        <div class="input-group input-group-merge">
                                            <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                                    class="bx bx-user"></i></span>
                                            <input type="text" class="form-control" id="basic-icon-default-fullname"
                                                placeholder="Masukkan Nama..." name="nama_kendaraan"
                                                aria-describedby="basic-icon-default-fullname2" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="basic-icon-default-email">Jenis</label>
                                    <div class="col-sm-10">
                                        <div class="input-group input-group-merge">
                                            <span class="input-group-text"><i class='bx bx-list-minus'></i></span>
                                            <select name="jenis" id="" class="form-select">
                                                <option value="Angkutan Barang">Angkutan Barang</option>
                                                <option value="Angkutan Orang">Angkutan Orang</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 form-label" for="basic-icon-default-phone">Konsumsi BBM</label>
                                    <div class="col-sm-10">
                                        <div class="input-group input-group-merge">
                                            <span id="basic-icon-default-phone2" class="input-group-text"><i
                                                    class="bx bx-wallet"></i></span>
                                            <input type="text" id="basic-icon-default-phone"
                                                class="form-control phone-mask" placeholder="Masukkan Biaya..."
                                                name="konsumsi_bbm" aria-describedby="basic-icon-default-phone2" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 form-label" for="basic-icon-default-phone">Jadwal</label>
                                    <div class="col-sm-10">
                                        <div class="input-group input-group-merge">
                                            <span id="basic-icon-default-phone2" class="input-group-text"><i
                                                    class="bx bx-calendar-check"></i></span>
                                            <input type="date" id="basic-icon-default-phone"
                                                class="form-control phone-mask" placeholder="Masukkan Jadwal..."
                                                name="jadwal" aria-describedby="basic-icon-default-phone2" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="basic-icon-default-email">Asal Kendaraan</label>
                                    <div class="col-sm-10">
                                        <div class="input-group input-group-merge">
                                            <span class="input-group-text"><i class='bx bx-home'></i></span>
                                            <select name="asal" id="" class="form-select">
                                                <option value="Perusahaan">Perusahaan</option>
                                                <option value="Penyewaan">Penyewaan</option>
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
                    </div>
                </form>
            </div>
        </div>
        {{-- MODAL CLOSE --}}
    </div>


@endsection
