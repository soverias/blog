<div class="wrapper">
	<div class="container news">
<?php 
if(count($news)== 0){
	
	echo "No hay ninguna noticia";
}
else {
	foreach ($news as $new) { ?>
<article>
			<header>
				<a href="<?php echo URL.'article/id/'.$new->id ?>"><h1><?php if (isset($new->title)) echo $new->title; ?></h1></a>
				<p>
					<time pubdate
						datetime="<?php if (isset($new->creationDate)) echo $new->creationDate; ?>"></time>
				</p>
			</header>
			<p><?php if (isset($new->content)) echo nl2br($new->short_content); ?></p>
		</article>
		<div class="article_date"><?php if (isset($new->creationDate)) echo $new->creationDate; ?></div><div class="article_comments_count"><?php if (isset($new->comments_count)) echo $new->comments_count; ?> comentarios</div>
		<div class="clear"></div>
		<hr class="hr_article">
<?php }} ?>
</div>
	<div class="container side"></div>
	<div style="clear: both"></div>
</div>