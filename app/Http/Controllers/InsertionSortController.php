<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InsertionSortController extends Controller
{
    public function index()
    {
        return view('insertion_sort');
    }

    public function sortAngka(Request $request)
    {
        $data = array_map('intval', explode(',', $request->angka));

        $sorted = $this->insertionSortAngka($data);

        return view('insertion_sort', [
            'dataAwalAngka' => $data,
            'dataTerurutAngka' => $sorted
        ]);
    }

    private function insertionSortAngka($data)
    {
        $n = count($data);

        for ($i = 1; $i < $n; $i++) {
            $key = $data[$i];
            $j = $i - 1;

            while ($j >= 0 && $data[$j] > $key) {
                $data[$j + 1] = $data[$j];
                $j = $j - 1;
            }
            $data[$j + 1] = $key;
        }

        return $data;
    }

    public function sortObjek(Request $request)
    {
        $data = [];

        for ($i = 0; $i < count($request->nama); $i++) {
            $data[] = (object)[
                'nama' => trim($request->nama[$i])
            ];
        }

        $sorted = $this->insertionSortObjek($data);

        return view('insertion_sort', [
            'dataAwalObjek' => $data,
            'dataTerurutObjek' => $sorted
        ]);
    }

    private function insertionSortObjek($data)
    {
        $n = count($data);

        for ($i = 1; $i < $n; $i++) {
            $key = $data[$i];
            $j = $i - 1;

            while ($j >= 0 && strtolower($data[$j]->nama) > strtolower($key->nama)) {
                $data[$j + 1] = $data[$j];
                $j = $j - 1;
            }
            $data[$j + 1] = $key;
        }

        return $data;
    }
}
