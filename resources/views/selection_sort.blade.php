<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Selection Sort</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container mt-5 mb-5">
        <div class="card">
            <div class="card-body">
                <h3 class="mb-4">Selection Sort</h3>
                <!-- SORT ANGKA -->
                <h5>Pengurutan Angka</h5>
                <form method="POST" action="{{ url('/selection-sort/angka') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Masukkan angka (pisahkan dengan koma)</label>
                        <input type="text" name="angka" class="form-control" placeholder="Contoh: 5,3,8,1,4"
                            required>
                    </div>
                    <button type="submit" class="btn btn-primary">Urutkan</button>
                </form>

                @if (isset($dataAwalAngka))
                    <div class="alert alert-secondary mt-3">
                        <p class="mb-1"><strong>Data Awal:</strong></p>
                        <p>{{ implode(', ', $dataAwalAngka) }}</p>

                        <p class="mb-1"><strong>Data Terurut:</strong></p>
                        <p>{{ implode(', ', $dataTerurutAngka) }}</p>
                    </div>
                @endif

                <hr>

                <!-- SORT NAMA -->
                <h5>Pengurutan Nama</h5>
                <form method="POST" action="{{ url('/selection-sort/objek') }}">
                    @csrf

                    <div class="mb-2">
                        <label class="form-label">Nama 1</label>
                        <input type="text" name="nama[]" class="form-control" required>
                    </div>

                    <div class="mb-2">
                        <label class="form-label">Nama 2</label>
                        <input type="text" name="nama[]" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nama 3</label>
                        <input type="text" name="nama[]" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Urutkan</button>
                </form>

                @if (isset($dataAwalObjek))
                    <div class="alert alert-secondary mt-3">
                        <p><strong>Data Awal:</strong></p>
                        <ul class="mb-3">
                            @foreach ($dataAwalObjek as $item)
                                <li>{{ $item->nama }}</li>
                            @endforeach
                        </ul>

                        <p><strong>Data Terurut (A-Z):</strong></p>
                        <ul>
                            @foreach ($dataTerurutObjek as $item)
                                <li>{{ $item->nama }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </div>
</body>

</html>
