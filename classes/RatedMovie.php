<?php

class RatedMovie extends Movie {
    private float $rating;
    private int $reviewsCount;

    public function __construct(string $title, string $director, int $year, string $genre, int $runtimeMin, float $rating, int $reviewsCount) {
        parent::__construct($title, $director, $year, $genre, $runtimeMin);
        $this->rating = $rating;
        $this->reviewsCount = $reviewsCount;
    }

    public function getRating(): float {
        return $this->rating;
    }

    public function getInfo(): string {
        $baseInfo = parent::getInfo();
        return $baseInfo . " — " . starsToText($this->rating) . " ({$this->reviewsCount} відгуків)";
    }
}