@extends('template-admin.layout')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tables /</span> Kategori Game</h4>
        <div class="card">
            <h5 class="card-header">Kategori Game</h5>
            <div class="table-responsive text-nowrap p-4">
                <table id="example" class="display compact nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th>Nama Kategori</th>
                            <th>Logo</th>
                            <th>Petunjuk</th>

                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($getKategoris as $key => $kategori)
                            <tr>
                                <td class="fw-bold">{{ $kategori->name }}</td>

                                <td>
                                    @if ($kategori->logo)
                                        <!-- Tampilkan logo yang sudah ada -->


                                        <!-- Form untuk menghapus logo -->
                                        <form action="{{ route('kategorigame.reset-logo', $kategori->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <button type="button" class="btn btn-sm btn-outline-primary"
                                                onclick="showImage('{{ asset($kategori->logo) }}')">
                                                Lihat logo </button>
                                            <button type="submit" class="btn btn-sm btn-outline-danger">Reset</button>
                                        </form>
                                    @else
                                        <!-- Form untuk mengunggah logo baru -->
                                        <form action="{{ route('kategorigame.update-logo', $kategori->id) }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            {{-- <input type="file" name="logo" id="logo" style="width: 150px;"> --}}
                                            <input class="form-control mb-2" type="file" id="logo" name="logo"
                                                style="width: 250px;">
                                            <button type="submit" class="btn btn-sm btn-outline-success">Update
                                                logo</button>
                                        </form>
                                    @endif
                                </td>
                                <td>
                                    @if ($kategori->petunjuk)
                                        <!-- Tampilkan petunjuk yang sudah ada -->


                                        <!-- Form untuk menghapus petunjuk -->
                                        <form action="{{ route('kategorigame.reset-petunjuk', $kategori->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="alert alert-warning alert-dismissible" role="alert">
                                                {{ $kategori->petunjuk }}
                                                <button type="submit" class="btn-close"></button>
                                            </div>
                                        </form>
                                    @else
                                        <!-- Form untuk mengunggah petunjuk baru -->
                                        <form action="{{ route('kategorigame.update-petunjuk', $kategori->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('PUT')

                                            <textarea id="petunjuk" class="form-control mb-2" placeholder="Hi Admin, Petunjuk apa ni?"
                                                aria-label="Hi, Do you have a moment to talk Joe?" aria-describedby="basic-icon-default-message2" name="petunjuk"></textarea>
                                            <button type="submit" class="btn btn-sm btn-outline-success">Update
                                                Petunjuk</button>
                                        </form>
                                    @endif
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function showImage(imageUrl) {
            // Tampilkan alert SweetAlert dengan gambar di dalamnya
            Swal.fire({
                imageUrl: imageUrl,
                imageWidth: 500,
                imageHeight: 500,
                imageAlt: 'Logo',
            });
        }
    </script>
@endsection
