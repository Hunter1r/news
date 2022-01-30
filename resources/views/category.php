<h1>Категории новостей</h1>

<?php foreach($categories as $category): ?>
<a href="/news/<?=$category->name?>"><?= $category->name?></a>

<?php endforeach; ?>