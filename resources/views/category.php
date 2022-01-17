<h1>Категории новостей</h1>

<?php foreach($categories as $category): ?>
<a href="/news/<?=$category?>"><?= $category?></a>

<?php endforeach; ?>