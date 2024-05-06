@extends('template-admin.layout')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tables /</span> Kategori</h4>
        <div class="card">
            <h5 class="card-header">Kategori</h5>
            <div class="table-responsive text-nowrap p-4">
                <table id="example" class="table table-striped nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th>Nama Kategori</th> <!-- Menambah tinggi kolom -->
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($kategori as $key => $kategori)
                            <tr>
                                <td style="height: 50px; font-size:16px;" class="fw-bold">{{ $kategori->nama }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
