<?php
namespace App\Traits;

use Carbon\Carbon;

trait Calculate
{
    public function calculate(mixed $items) : array
    {
        $results = [
            'daily'=>0,
            'weekly'=>0,
            'monthly'=>0,
            'yearly'=>0,
        ];
        foreach ($items as $item) {
            $carbon = new Carbon('Asia/Yangon');
            if($carbon->toDateString() == $item->created_at->toDateString()) {
                $results['daily'] += 1;
            }
            if($carbon->now()->subDay(7)->toDateString() <= $item->created_at->toDateString() && $carbon->now()->toDateString() >= $item->created_at->toDateString()) {
                $results['weekly'] += 1;
            }
            if($carbon->now()->subMonth()->toDateString() <= $item->created_at->toDateString() && $carbon->now()->toDateString() >= $item->created_at->toDateString()) {
                $results['monthly'] += 1;
            }
            if($carbon->now()->subYear()->toDateString() <= $item->created_at->toDateString() && $carbon->now()->toDateString() >= $item->created_at->toDateString()) {
                $results['yearly'] += 1;
            }
        }
        return $results;
    }
}
