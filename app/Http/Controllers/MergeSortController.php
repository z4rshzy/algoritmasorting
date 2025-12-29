<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MergeSortController extends Controller
{
    public function index()
    {
        return view('merge_sort');
    }

    public function sortAngka(Request $request)
    {
        $data = array_map('intval', explode(',', $request->angka));
        $sorted = $this->mergeSortAngka($data);

        return view('merge_sort', [
            'dataAwalAngka' => $data,
            'dataTerurutAngka' => $sorted
        ]);
    }

    private function mergeSortAngka($data)
    {
        if (count($data) <= 1)
            return $data;

        $mid = floor(count($data) / 2);
        $left = array_slice($data, 0, $mid);
        $right = array_slice($data, $mid);

        return $this->merge(
            $this->mergeSortAngka($left),
            $this->mergeSortAngka($right)
        );
    }

    private function merge($left, $right)
    {
        $result = [];

        while (count($left) > 0 && count($right) > 0) {
            if ($left[0] <= $right[0]) {
                $result[] = array_shift($left);
            } else {
                $result[] = array_shift($right);
            }
        }

        return array_merge($result, $left, $right);
    }

    public function sortObjek(Request $request)
    {
        $data = [];

        foreach ($request->nama as $nama) {
            $data[] = (object) [
                'nama' => trim($nama)
            ];
        }

        $sorted = $this->mergeSortObjek($data);

        return view('merge_sort', [
            'dataAwalObjek' => $data,
            'dataTerurutObjek' => $sorted
        ]);
    }

    private function mergeSortObjek($data)
    {
        if (count($data) <= 1)
            return $data;

        $mid = floor(count($data) / 2);
        $left = array_slice($data, 0, $mid);
        $right = array_slice($data, $mid);

        return $this->mergeObjek(
            $this->mergeSortObjek($left),
            $this->mergeSortObjek($right)
        );
    }

    private function mergeObjek($left, $right)
    {
        $result = [];

        while (count($left) > 0 && count($right) > 0) {
            if (strtolower($left[0]->nama) <= strtolower($right[0]->nama)) {
                $result[] = array_shift($left);
            } else {
                $result[] = array_shift($right);
            }
        }

        return array_merge($result, $left, $right);
    }
}
