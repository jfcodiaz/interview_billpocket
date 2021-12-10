<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

class DefaultController extends Controller
{ 
    public function fiids()
    {
        $data = json_decode(Storage::get('data.json'), true);

        return $this->findFiids($data);
    }

    private function findFiids(array $data): array
    {
        $result = [];

        foreach($data as $index  => $item) {
            if(is_array($item)) {
                $subResult = $this->findFiids($item);
                $result = array_merge($result, $subResult);

                continue;
            }

            if($index === 'fiid') {
                $result[] = $item;
            }
        }
        
        return $result;
    }

    public function getN()
    {
        dd($this->n('aba', 1, 'a'));
    }

    private function n(string $s, int $l, string $a): int
    {
        $sLen = strlen($s);
        if($sLen === 0) {

            return 0;
        }

        $top = ceil($l / $sLen);
        $str = substr(str_repeat("$s ", $top), 0, $l + $top - 1);
        $count = 0;
        for($i = 0; $i < strlen($str); $i++) {
            if($str[$i] === $a) {
                $count ++;
            }
        }

        return $count;
    }
}
