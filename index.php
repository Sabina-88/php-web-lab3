<?php

require_once 'lib/functions.php';
require_once 'classes/Movie.php';
require_once 'classes/RatedMovie.php';
require_once 'classes/MovieCatalog.php';

$catalog = new MovieCatalog();

$catalog->addMovie(new Movie('Земля', 'О. Довженко', 1930, 'драма', 75));
$catalog->addMovie(new RatedMovie('Хоббіт', 'Пітер Джексон', 2012, 'фентезі', 169, 8.0, 850000));
$catalog->addMovie(new RatedMovie('Той, що біжить лабіринтом', 'Вес Болл', 2014, 'фантастика', 113, 6.8, 420000));
$catalog->addMovie(new RatedMovie('Аватар', 'Джеймс Кемерон', 2009, 'фантастика', 162, 9.0, 1200000));

?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Кінотека — ООП</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background: #f7f7f7; max-width: 700px; }
        .movie { background: #fff; border: 1px solid #ccc; padding: 12px; margin-bottom: 10px; }
        .top { margin-top: 25px; padding: 15px; background: #eaffea; border: 1px solid #1a7a1a; }
    </style>
</head>
<body>

<h1>Кінотека</h1>

<?php foreach ($catalog->getAll() as $movie): ?>
    <div class="movie"><?= $movie->getInfo() ?></div>
<?php endforeach; ?>

<?php $top = $catalog->topRated(); ?>
<?php if ($top): ?>
    <div class="top">
        Найкращий фільм за рейтингом: <?= $top->getInfo() ?>
    </div>
<?php endif; ?>

</body>
</html>
