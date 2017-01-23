<h1>MAIN PAGE</h1>
<div class="panelTopMenuDiv">
	<ul class="topnav">
		<li><a href="post/add">НОВЫЙ ПОСТ</a></li>
		<li><a href="post/add">НОВЫЙ ПОСТ</a></li>
		<li><a href="post/add">НОВЫЙ ПОСТ</a></li>
		<li><a href="post/add">НОВЫЙ ПОСТ</a></li>
		<li><a href="post/add">НОВЫЙ ПОСТ</a></li>
	</ul>
</div>
<div class="indexArticlesPanel">
<? if($allPosts != false){?>
<?foreach ($allPosts as $key => $post) {?>
	<article class="main_article">
		<a href="post/<?=$post['id']?>">открыть</a><h3>автор:<span style="font-color: red;"><?=$post['author']?></span></h3><?=$post['text']?>
	</article>
<?}?>
<?} else {?>
<h1>Постов пока нет!</h1>
<?}?>
</div>