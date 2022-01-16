<h1>Новости</h1>

<?php foreach($news as $item): ?>
    <div>
        <strong><?=$item['category']?></strong>
        <a href="/news/<?=$item['category']?>/<?=$item['id']?>"><?=$item['title']?></a>
        <p><?=$item['description']?></p>
        <em><?=$item['author']?></em>
        <em><?=$item['date']?></em>
    </div>
    <br>
    <hr>

<?php endforeach; ?>