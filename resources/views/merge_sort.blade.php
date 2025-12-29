<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Merge Sort</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container mt-5">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Merge Sort</h4>
            </div>

            <div class="card-body">

                {{-- SORT ANGKA --}}
                <h5 class="mb-3">Pengurutan Angka</h5>

                <form method="POST" action="/merge-sort/angka" class="mb-4">
                    @csrf
                    <div class="mb-2">
                        <label class="form-label">Masukkan angka (pisahkan dengan koma)</label>
                        <input type="text" name="angka" class="form-control" placeholder="Contoh: 7,3,9,1,5" required>
                    </div>
                    <button type="submit" class="btn btn-success">Proses</button>
                </form>

                @isset($dataAwalAngka)
                    <div class="alert alert-secondary">
                        <strong>Data Awal:</strong> {{ implode(', ', $dataAwalAngka) }}
                    </div>
                    <div class="alert alert-success">
                        <strong>Hasil Terurut:</strong> {{ implode(', ', $dataTerurutAngka) }}
                    </div>
                @endisset

                <hr>

                {{-- SORT NAMA --}}
                <h5 class="mb-3">Pengurutan Nama</h5>

                <form method="POST" action="/merge-sort/objek">
                    @csrf

                    <div class="row mb-3">
                        <div class="col">
                            <input type="text" name="nama[]" class="form-control" placeholder="Nama pertama">
                        </div>
                        <div class="col">
                            <input type="text" name="nama[]" class="form-control" placeholder="Nama kedua">
                        </div>
                        <div class="col">
                            <input type="text" name="nama[]" class="form-control" placeholder="Nama ketiga">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success">Proses</button>
                </form>

                @isset($dataTerurutObjek)
                    <div class="mt-4">
                        <h6>Hasil Pengurutan:</h6>
                        <ul class="list-group">
                            @foreach($dataTerurutObjek as $item)
                                <li class="list-group-item">{{ $item->nama }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endisset

            </div>
        </div>
    </div>

</body>

</html>