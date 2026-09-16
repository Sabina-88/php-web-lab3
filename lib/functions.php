<?php

function formatRuntime(int $minutes): string {
    $hours = intdiv($minutes, 60);
    $mins = $minutes % 60;
    if ($hours > 0) {
        return "{$hours}г {$mins}хв";
    }
    return "{$mins}хв";
}

function starsToText(float $rating): string {
    // рейтинг за шкалою 1-10 переводимо у 5 зірок
    $fullStars = (int) round($rating / 2);
    $fullStars = max(0, min(5, $fullStars));
    return str_repeat('★', $fullStars) . str_repeat('☆', 5 - $fullStars);
}