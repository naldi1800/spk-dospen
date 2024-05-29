<?php

namespace App\Helpers;

use App\Models\Title;
use App\Models\Skill;
use App\Models\Teacher;

class NaiveBayes
{
    static function NAIVE($dataskill_input)
    {
        $data = Title::all();
        $dataskill = Skill::all();
        $datadosen = Teacher::all();

        $skill_all = [];

        // [Pembimbing 1, Pembimbing 2, Penguji 1, Penguji 2]
        $attribut = [
            'p1' => [],
            'p2' => [],
            'q1' => [],
            'q2' => [],
            'skill' => [],
        ];

        // Probabilitas Prior Kelas (Prior) [Pembimbing 1, Pembimbing 2, Penguji 1, Penguji 2]
        $ppp = ['p1' => [], 'p2' => [], 'q1' => [], 'q2' => []];
        // Likelihood
        $like = ['p1' => [], 'p2' => [], 'q1' => [], 'q2' => []];
        // posterior
        $posterior = ['p1' => [], 'p2' => [], 'q1' => [], 'q2' => []];

        foreach ($dataskill as $v) {
            array_push($skill_all, [$v->id, $v->skill_name]);
        }
        foreach ($data as $v) {
            array_push($attribut['p1'], $v->pembimbing_i);
            array_push($attribut['p2'], $v->pembimbing_ii);
            array_push($attribut['q1'], $v->penguji_i);
            array_push($attribut['q2'], $v->penguji_ii);
            array_push($attribut['skill'], json_decode($v->skill, true));
        }
        $skill_count_in_data = array_count_values(array_merge(...$attribut['skill']));
        // dd($skill_count_in_data[1]);
        // Mencari nilai prior setiap kelas
        foreach ($datadosen as $v) {
            $id = $v->id;
            $p1 = 0;
            $p2 = 0;
            $q1 = 0;
            $q2 = 0;
            for ($i = 0; $i < count($attribut['p1']); $i++) {
                if ($id == $attribut['p1'][$i]) {
                    $p1 += 1;
                }
                if ($id == $attribut['p2'][$i]) {
                    $p2 += 1;
                }
                if ($id == $attribut['q1'][$i]) {
                    $q1 += 1;
                }
                if ($id == $attribut['q2'][$i]) {
                    $q2 += 1;
                }
            }
            $ppp['p1']["$id"] = $p1 / count($attribut['p1']);
            $ppp['p2']["$id"] = $p2 / count($attribut['p2']);
            $ppp['q1']["$id"] = $q1 / count($attribut['q1']);
            $ppp['q2']["$id"] = $q2 / count($attribut['q2']);
        }

        // Mencari hubungan setiap kelas dengan atribut
        foreach ($dataskill as $v) {
            $id = $v->id;
            if (array_key_exists($id, $skill_count_in_data) && $skill_count_in_data[$id] > 0) {
                $p1arr = [];
                $p2arr = [];
                $q1arr = [];
                $q2arr = [];
                $_p1arr = [];
                $_p2arr = [];
                $_q1arr = [];
                $_q2arr = [];
                foreach ($datadosen as $v2) {
                    //ADA
                    $p1b = 0;
                    $p1a = 0;
                    $p2b = 0;
                    $p2a = 0;
                    $q1b = 0;
                    $q1a = 0;
                    $q2b = 0;
                    $q2a = 0;
                    //TIDAK
                    $_p1b = 0;
                    $_p1a = 0;
                    $_p2b = 0;
                    $_p2a = 0;
                    $_q1b = 0;
                    $_q1a = 0;
                    $_q2b = 0;
                    $_q2a = 0;
                    for ($i = 0; $i < count($attribut['p1']); $i++) {
                        //ADA
                        if ($v2->id == $attribut['p1'][$i] && in_array($id, $attribut['skill'][$i])) {
                            $p1b += 1;
                        }
                        if ($v2->id == $attribut['p1'][$i]) {
                            $p1a += 1;
                        }
                        if ($v2->id == $attribut['p2'][$i] && in_array($id, $attribut['skill'][$i])) {
                            $p2b += 1;
                        }
                        if ($v2->id == $attribut['p2'][$i]) {
                            $p2a += 1;
                        }
                        if ($v2->id == $attribut['q1'][$i] && in_array($id, $attribut['skill'][$i])) {
                            $q1b += 1;
                        }
                        if ($v2->id == $attribut['q1'][$i]) {
                            $q1a += 1;
                        }
                        if ($v2->id == $attribut['q2'][$i] && in_array($id, $attribut['skill'][$i])) {
                            $q2b += 1;
                        }
                        if ($v2->id == $attribut['q2'][$i]) {
                            $q2a += 1;
                        }

                        //TIDAK
                        if ($v2->id == $attribut['p1'][$i] && !in_array($id, $attribut['skill'][$i])) {
                            $_p1b += 1;
                        }
                        if ($v2->id == $attribut['p1'][$i]) {
                            $_p1a += 1;
                        }
                        if ($v2->id == $attribut['p2'][$i] && !in_array($id, $attribut['skill'][$i])) {
                            $_p2b += 1;
                        }
                        if ($v2->id == $attribut['p2'][$i]) {
                            $_p2a += 1;
                        }
                        if ($v2->id == $attribut['q1'][$i] && !in_array($id, $attribut['skill'][$i])) {
                            $_q1b += 1;
                        }
                        if ($v2->id == $attribut['q1'][$i]) {
                            $_q1a += 1;
                        }
                        if ($v2->id == $attribut['q2'][$i] && !in_array($id, $attribut['skill'][$i])) {
                            $_q2b += 1;
                        }
                        if ($v2->id == $attribut['q2'][$i]) {
                            $_q2a += 1;
                        }
                    }
                    $p1arr["$v2->id"] = $p1a == 0 ? 0 : $p1b / $p1a;
                    $p2arr["$v2->id"] = $p2a == 0 ? 0 : $p2b / $p2a;
                    $q1arr["$v2->id"] = $q1a == 0 ? 0 : $q1b / $q1a;
                    $q2arr["$v2->id"] = $q2a == 0 ? 0 : $q2b / $q2a;

                    $_p1arr["$v2->id"] = $_p1a == 0 ? 0 : $_p1b / $_p1a;
                    $_p2arr["$v2->id"] = $_p2a == 0 ? 0 : $_p2b / $_p2a;
                    $_q1arr["$v2->id"] = $_q1a == 0 ? 0 : $_q1b / $_q1a;
                    $_q2arr["$v2->id"] = $_q2a == 0 ? 0 : $_q2b / $_q2a;
                }
                $like['p1'][$id]['ada'] = $p1arr;
                $like['p2'][$id]['ada'] = $p2arr;
                $like['q1'][$id]['ada'] = $q1arr;
                $like['q2'][$id]['ada'] = $q2arr;

                $like['p1'][$id]['tidak'] = $_p1arr;
                $like['p2'][$id]['tidak'] = $_p2arr;
                $like['q1'][$id]['tidak'] = $_q1arr;
                $like['q2'][$id]['tidak'] = $_q2arr;
            }
        }

        // dd($dataskill_input);
        // Posterior
        // dd($ppp);

        for ($i = 0; $i < count($like['p1']); $i++) {
            foreach ($datadosen as $d) {
                $posp1 = 1;
                $posp2 = 1;
                $posq1 = 1;
                $posq2 = 1;
                foreach ($dataskill as $s) {
                    if (array_key_exists($id, $skill_count_in_data) && $skill_count_in_data[$id] > 0) {
                        if (in_array($s->id, $dataskill_input)) {
                            $posp1 *= $like['p1'][$s->id]['ada'][$d->id];
                            $posp2 *= $like['p2'][$s->id]['ada'][$d->id];
                            $posq1 *= $like['q1'][$s->id]['ada'][$d->id];
                            $posq2 *= $like['q2'][$s->id]['ada'][$d->id];
                        } else {
                            $posp1 *= $like['p1'][$s->id]['tidak'][$d->id];
                            $posp2 *= $like['p2'][$s->id]['tidak'][$d->id];
                            $posq1 *= $like['q1'][$s->id]['tidak'][$d->id];
                            $posq2 *= $like['q2'][$s->id]['tidak'][$d->id];
                        }
                    }
                }
                $posp1 *= $ppp['p1'][$d->id];
                $posp2 *= $ppp['p2'][$d->id];
                $posq1 *= $ppp['q1'][$d->id];
                $posq2 *= $ppp['q2'][$d->id];

                $posterior['p1'][$d->id] = $posp1;
                $posterior['p2'][$d->id] = $posp2;
                $posterior['q1'][$d->id] = $posq1;
                $posterior['q2'][$d->id] = $posq2;
            }
        }
        arsort($posterior['p1']);
        arsort($posterior['p2']);
        arsort($posterior['q1']);
        arsort($posterior['q2']);
        return $posterior;
    }
}