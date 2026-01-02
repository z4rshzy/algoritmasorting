<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minimalist Insertion Sort</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .card-float { transform: translateY(-1.5rem); border-color: #6366f1; }
        .card-comparing { background-color: #fef2f2; border-color: #ef4444; transform: scale(1.05); }
        .card-sorted { border-color: #10b981; background-color: #f0fdf4; }
    </style>
</head>
<body class="bg-[#F8FAFC] text-slate-800">

    <div class="max-w-4xl mx-auto px-6 py-16">
        <header class="text-center mb-16">
            <h1 class="text-4xl font-light tracking-tight mb-2">Insertion <span class="font-semibold text-indigo-600">Sort</span></h1>
            <p class="text-slate-500">Visualisasi algoritma pengurutan kartu yang intuitif.</p>
        </header>

        <div id="card-container" class="flex justify-center items-end gap-4 h-64 mb-12">
            @foreach($cards as $index => $val)
                <div id="card-{{ $index }}" 
                     class="group relative w-20 h-32 bg-white border border-slate-200 rounded-xl shadow-sm flex flex-col items-center justify-center transition-all duration-500 ease-in-out">
                    <span class="text-sm text-slate-400 absolute top-2 left-2 font-mono">{{ $index }}</span>
                    <span class="text-3xl font-semibold text-slate-700">{{ $val }}</span>
                    <div class="absolute bottom-2 right-2 text-indigo-200 opacity-20 text-4xl font-bold italic">#</div>
                </div>
            @endforeach
        </div>

        <div class="bg-white/80 backdrop-blur-md border border-slate-200 rounded-2xl p-6 shadow-xl shadow-slate-200/50">
            <div class="flex flex-wrap items-center justify-between gap-6">
                <div class="flex-1 min-w-[250px]">
                    <span class="text-[10px] uppercase tracking-widest text-slate-400 font-bold block mb-1">Status Log</span>
                    <p id="status-text" class="text-sm text-slate-600 italic">Siap untuk memulai pengurutan...</p>
                </div>

                <div class="flex gap-3">
                    <button onclick="window.location.reload()" class="px-5 py-2.5 text-sm font-medium text-slate-600 bg-slate-100 rounded-lg hover:bg-slate-200 transition-colors">
                        Reset
                    </button>
                    <button id="btn-start" onclick="runInsertionSort()" class="px-6 py-2.5 text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 shadow-lg shadow-indigo-200 transition-all active:scale-95">
                        Mulai Animasi
                    </button>
                </div>
            </div>
        </div>
        
        <div class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-8 text-center text-sm text-slate-500">
            <div>
                <span class="font-semibold text-slate-800 block mb-1">Ambil</span>
                Elemen dipilih satu per satu dari bagian yang belum urut.
            </div>
            <div>
                <span class="font-semibold text-slate-800 block mb-1">Bandingkan</span>
                Geser ke kiri selama elemen lebih besar dari kartu di tangan.
            </div>
            <div>
                <span class="font-semibold text-slate-800 block mb-1">Sisipkan</span>
                Letakkan pada posisi kosong yang tepat.
            </div>
        </div>
    </div>

    <script>
        let values = @json($cards);
        const sleep = (ms) => new Promise(resolve => setTimeout(resolve, ms));

        async function runInsertionSort() {
            const btn = document.getElementById('btn-start');
            btn.disabled = true;
            btn.classList.add('opacity-50', 'cursor-not-allowed');

            let n = values.length;

            for (let i = 1; i < n; i++) {
                let key = values[i];
                let j = i - 1;

                // 1. Highlight kartu yang sedang diambil
                updateStatus(`Mengambil kartu <strong>${key}</strong>`);
                document.getElementById(`card-${i}`).classList.add('card-float');
                await sleep(800);

                while (j >= 0 && values[j] > key) {
                    // 2. Highlight proses perbandingan
                    updateStatus(`Bandingkan: ${values[j]} > ${key}? Ya, geser.`);
                    document.getElementById(`card-${j}`).classList.add('card-comparing');
                    await sleep(600);
                    
                    values[j + 1] = values[j];
                    renderCards(j + 1); // Render ulang posisi yang berubah
                    
                    document.getElementById(`card-${j}`).classList.remove('card-comparing');
                    j = j - 1;
                }

                values[j + 1] = key;
                renderCards();
                
                // 3. Tandai posisi sisip
                updateStatus(`Sisipkan <strong>${key}</strong> di posisi ${j + 1}`);
                document.getElementById(`card-${j+1}`).classList.add('card-sorted');
                await sleep(1000);
                document.getElementById(`card-${j+1}`).classList.remove('card-sorted');
            }

            updateStatus("✨ Pengurutan selesai dengan sempurna!");
            btn.innerHTML = "Selesai";
        }

        function updateStatus(msg) {
            document.getElementById('status-text').innerHTML = msg;
        }

        function renderCards(highlightIdx = null) {
            const container = document.getElementById('card-container');
            container.innerHTML = values.map((v, i) => `
                <div id="card-${i}" class="group relative w-20 h-32 bg-white border border-slate-200 rounded-xl shadow-sm flex flex-col items-center justify-center transition-all duration-500 ease-in-out">
                    <span class="text-sm text-slate-400 absolute top-2 left-2 font-mono">${i}</span>
                    <span class="text-3xl font-semibold text-slate-700">${v}</span>
                    <div class="absolute bottom-2 right-2 text-indigo-200 opacity-20 text-4xl font-bold italic">#</div>
                </div>
            `).join('');
        }
    </script>
</body>

</html>