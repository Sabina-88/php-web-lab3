<?php

class MovieCatalog {
    private array $movies = [];

    public function addMovie(Movie $movie): void {
        $this->movies[] = $movie;
    }

    public function findByGenre(string $genre): array {
        return array_filter($this->movies, function (Movie $movie) use ($genre) {
            return $movie->getGenre() === $genre;
        });
    }

    public function topRated(): ?RatedMovie {
        $best = null;
        foreach ($this->movies as $movie) {
            if ($movie instanceof RatedMovie) {
                if ($best === null || $movie->getRating() > $best->getRating()) {
                    $best = $movie;
                }
            }
        }
        return $best;
    }

    public function getAll(): array {
        return $this->movies;
    }
}