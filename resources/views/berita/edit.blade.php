<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Data Berita</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body style="background: lightgray">
    <div class="container mt-5 mb-5">
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
                        <form action="{{ route('berita.update', $berita->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label class="font-weight-bold">GAMBAR</label>
                                <input type="file" class="form-control" name="gambar">
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">KATEGORI</label>
                                <select class="form-control @error('kategori') is-invalid @enderror" name="kategori" >
                                @forelse ($kategori as $v)
                                    <option value="{{$v->id}}" >{{$v->nama}}</option>
                                @empty
                                    <option value="" >Belum ada data</option>
                                @endforelse
                                </select>

                                <!-- error message untuk Kategori -->
                                @error('kategori')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>


                            <div class="form-group">
                                <label class="font-weight-bold">JUDUL</label>
                                <input type="text" class="form-control @error('judul') is-invalid @enderror" name="judul" value="{{ old('judul', $berita->judul) }}" placeholder="Masukkan Judul Berita">
                            
                                <!-- error message untuk judul -->
                                @error('judul')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">ISI</label>
                                <textarea class="form-control @error('isi') is-invalid @enderror" name="isi" rows="5" placeholder="Masukkan Isi Berita">{{ old('content', $berita->isi) }}</textarea>
                            
                                <!-- error message untuk isi -->
                                @error('isi')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-md btn-primary">UPDATE</button>
                            <button type="reset" class="btn btn-md btn-warning">RESET</button>

                        </form> 
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('isi');
</script>
</body>
</html>