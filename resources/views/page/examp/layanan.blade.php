@extends('template-admin.layout')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tables /</span> Layanan Game</h4>
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 text-center">
                    <h5 class="card-header">UPDATE LAYANAN GAME</h5>
                    <div class="card-body">
                        <p class="card-text">
                        <div class="alert alert-danger" role="alert">Sebelum atur <b>KEUNTUNGAN</b> atau <b>UPDATE</b>
                            layanan,pastikan
                            <b>HAPUS SEMUA LAYANAN TERLEBIH DAHULU !</b>
                        </div>
                        <form id="delete-all-form" method="POST" action="{{ route('delete.allgame.data') }}">
                            @csrf
                            <button type="button" class="btn btn-danger me-1" id="delete-all-button">
                                HAPUS LAYANAN
                            </button>
                        </form>
                        </p>
                        <p class="demo-inline-spacing">
                            <a class="btn btn-success me-1" href="/getgamelayanan">
                                UPDATE LAYANAN
                            </a>


                            <a class="btn btn-warning me-1" href="#collapseExample">
                                ATUR KEUNTUNGAN
                            </a>
                        <div class="alert alert-primary mt-2">KEUNTUNGAN SAAT INI: {{ $apis->profit_percentage }} /
                            {{ number_format($apis->profit_percentage, 2) }}</div>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <h5 class="card-header">Layanan Game</h5>
            <div class="table-responsive text-nowrap p-4">
                <table id="example" class="display compact nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th>Code</th>
                            <th>Nama Game</th>
                            <th>Harga</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($getLayanans as $key => $layanan)
                            <tr>
                                <td class="fw-bold text-warning">{{ $layanan->code }}</td>
                                <td class="fw-bold text-primary">{{ $layanan->game }}</td>
                                <td class="fw-bold text-danger">Rp {{ number_format($layanan->basic_price) }}
                                    <span class="badge bg-label-success" style="font-size: 0.8rem;">
                                        <i class='bx bx-up-arrow-circle' style="font-size: 0.8rem;"></i>
                                        {{ number_format($apis->profit_percentage) }}
                                    </span>

                                </td>
                                <td class="fw-bold">
                                    <span class="badge bg-label-success">{{ $layanan->status }}</span>
                                </td>


                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('delete-all-button').addEventListener('click', function() {
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Anda akan menghapus semua data. Tindakan ini tidak dapat dibatalkan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus semua data!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('delete-all-form').submit();
                    }
                });
            });
        });
    </script>
@endsection
