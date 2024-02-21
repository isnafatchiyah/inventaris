<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Peminjaman - Inventaris</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>

<body style="background: lightgray">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('siswa.index') }}">SISWA</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('barang.index') }}">BARANG</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('peminjaman.index') }}">PEMINJAMAN</a>
                    </li>
                </ul>
            </div>
            <ul class="nav nav-pills ms-auto">
                <li class="nav-item"><a href="{{('/sesi/logout') }}" class="nav-link active" aria-current="page" style="color: rgb(238, 255, 0);">LOGOUT</a></li>
            </ul>
    </nav>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">

                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <a href="{{ route('peminjaman.create') }}" class="btn btn-md btn-success mb-3">TAMBAH PEMINJAMAN</a>


                        <table class="table table-bordered">
                            <thead>
                                <tr>

                                    <th scope="col">ID</th>
                                    <th scope="col">SISWA</th>
                                    <th scope="col">ID</th>
                                    <th scope="col">NAMA BARANG</th>
                                    <th scope="col">TANGGAL PINJAM</th>
                                    <th scope="col">TANGGAL KEMBALI</th>
                                    <th scope="col">AKSI</th>

                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($peminjamans as $peminjaman)
                                <tr>

                                    <td>{{ $peminjaman->id_siswa }}</td>
                                    <td>{{ $peminjaman->siswa->nama }}</td>
                                    <td>{{ $peminjaman->id_barang }}</td>
                                    <td>{{ $peminjaman->barang->nama_barang }}</td>
                                    <td>{{ $peminjaman->tgl_pinjam }}</td>
                                    <td>{{ $peminjaman->tgl_kembali }}</td>

                                    <td class="text-center">
                                        <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('peminjaman.destroy', $peminjaman->id) }}" method="POST">
                                            <a href="{{ route('peminjaman.edit', $peminjaman->id) }}" class="btn btn-sm btn-primary">EDIT</a>

                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>

                                        </form>
                                    </td>

                                </tr>
                                @empty
                                <div class="alert alert-danger">
                                    Data Peminjaman belum Tersedia.
                                </div>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $peminjamans ->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        //message with toastr
        @if(session()->has('success'))

        toastr.success('{{ session('
            success ') }}', 'BERHASIL!');

        @elseif(session()->has('error'))

        toastr.error('{{ session('
            error ') }}', 'GAGAL!');

        @endif

    </script>

</body>

</html>
