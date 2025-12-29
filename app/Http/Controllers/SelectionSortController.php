<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SelectionSortController extends Controller
{
    public function index()
    {
        return view('selection_sort');
    }

    public function sortAngka(Request $request)
    {
        $data = array_map('intval', explode(',', $request->angka));

        $sorted = $this->selectionSortAngka($data);

        return view('selection_sort', [
            'dataAwalAngka' => $data,
            'dataTerurutAngka' => $sorted
        ]);
    }

    private function selectionSortAngka($data)
    {
        $n = count($data);

        for ($i = 0; $i < $n - 1; $i++) {
            $min = $i;

            for ($j = $i + 1; $j < $n; $j++) {
                if ($data[$j] < $data[$min]) {
                    $min = $j;
                }
            }

            $temp = $data[$i];
            $data[$i] = $data[$min];
            $data[$min] = $temp;
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

        $sorted = $this->selectionSortObjek($data);

        return view('selection_sort', [
            'dataAwalObjek' => $data,
            'dataTerurutObjek' => $sorted
        ]);
    }

    private function selectionSortObjek($data)
    {
        $n = count($data);

        for ($i = 0; $i < $n - 1; $i++) {
            $min = $i;

            for ($j = $i + 1; $j < $n; $j++) {
                if (strtolower($data[$j]->nama) < strtolower($data[$min]->nama)) {
                    $min = $j;
                }
            }

            // Tukar objek
            $temp = $data[$i];
            $data[$i] = $data[$min];
            $data[$min] = $temp;
        }

        return $data;
    }
}
