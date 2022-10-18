<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Berita</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>
<body style="background: lightgray">
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <a href="{{ route('kategori.index') }}" class="btn btn-md btn-info mb-3">KATEGORI</a>
                        <a href="{{ route('berita.index') }}" class="btn btn-md btn-info mb-3">BERITA</a>
                    </div>
                </div>
            </div>
            <br><br>
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <a href="{{ route('berita.create') }}" class="btn btn-md btn-success mb-3">TAMBAH BERITA</a>
                        <table class="table table-bordered">
                            <thead>
                              <tr>
                                <th scope="col">GAMBAR</th>
                                <th scope="col">KATEGORI</th>
                                <th scope="col">JUDUL</th>
                                <th scope="col">ISI</th>
                                <th scope="col">AKSI</th>
                              </tr>
                            </thead>
                            <tbody>
                              @forelse ($berita as $v)
                              <tr>
                                    <td class="text-center">
                                        <img src="{{ Storage::url('public/berita/').$v->gambar }}" class="rounded" style="width: 150px">
                                    </td>
                                    <td>{{isset($v->P_Kategori->nama) ? $v->P_Kategori->nama : 'Tidak ada' }}</td>
                                    <td>{{ $v->judul }}</td>
                                    <td>{!! $v->isi !!}</td>
                                    <td class="text-center">
                                        <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('berita.destroy', $v->id) }}" method="POST">
                                            <a href="{{ route('berita.edit', $v->id) }}" class="btn btn-sm btn-primary">EDIT</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                        </form>
                                    </td>
                                </tr>
                              @empty
                                  <div class="alert alert-danger">
                                      Data Berita belum Tersedia.
                                  </div>
                              @endforelse
                            </tbody>
                        </table>  
                        {{ $berita->links() }}
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
        
            toastr.success('{{ session('success') }}', 'BERHASIL!'); 

        @elseif(session()->has('error'))

            toastr.error('{{ session('error') }}', 'GAGAL!'); 
            
        @endif
    </script>

</body>
</html>