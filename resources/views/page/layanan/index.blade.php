@extends('template-admin.layout')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tables /</span> Layanan</h4>
        <div class="card">
            <h5 class="card-header">Layanan</h5>

            <div class="table-responsive text-nowrap p-4">
                <table id="example" class="table table-striped nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th>Kategori</th>
                            <th>Nama Layanan</th>
                            <th>Kode</th>
                            <th>Harga</th>
                            <th>Min</th>
                            <th>Max</th>
                            <th>Refill Status</th>
                            <th>Average Time</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($layanan as $key => $layanan)
                            <tr>
                                <td style="height: 50px; font-size:16px;" class="fw-bold text-success">
                                    {{ $layanan->kategori->nama }}
                                </td>
                                <td style="height: 50px; font-size:16px;" class="fw-bold text-warning">{{ $layanan->name }}
                                </td>
                                <td style="height: 50px; font-size:16px; " class="fw-bold text-primary">{{ $layanan->id }}
                                </td>
                                <td style="height: 50px; font-size:16px;" class="fw-bold text-success">Rp
                                    {{ number_format($layanan->price) }}</td>
                                <td style="height: 50px; font-size:16px;" class="fw-bold text-danger">{{ $layanan->min }}
                                </td>
                                <td style="height: 50px; font-size:16px;" class="fw-bold text-primary">{{ $layanan->max }}
                                </td>
                                <td style="font-size:16px;" class="fw-bold">
                                    @if ($layanan->refill == 0)
                                        <span class="badge rounded-pill bg-danger">Refill Tidak Tersedia</span>
                                    @elseif ($layanan->refill == 1)
                                        <span class="badge rounded-pill bg-success">Refill Tersedia</span>
                                    @endif
                                </td>
                                <td style="height: 50px; font-size:16px;" class="fw-bold">{{ $layanan->average_time }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
