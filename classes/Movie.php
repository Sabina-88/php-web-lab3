<?php

class Movie {
    protected string $title;
    protected string $director;
    protected int $year;
    protected string $genre;
    protected int $runtimeMin;

    public function __construct(string $title, string $director, int $year, string $genre, int $runtimeMin) {
        $this->title = $title;
        $this->director = $director;
        $this->year = $year;
        $this->genre = $genre;
        $this->runtimeMin = $runtimeMin;
    }

    public function getGenre(): string {
        return $this->genre;
    }

    public function getInfo(): string {
        return "{$this->title} ({$this->director}, {$this->year}), жанр: {$this->genre}, " . formatRuntime($this->runtimeMin);
    }
}