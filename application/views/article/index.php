
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
				<h1><?php if (isset($new->title)) echo $new->title; ?></h1>
				<p>
					<time pubdate
						datetime="<?php if (isset($new->creationDate)) echo $new->creationDate; ?>"></time>
				</p>
			</header>
			<p><?php if (isset($new->content)) echo nl2br($new->content); ?></p>
		</article>
		<div class="article_date"><?php if (isset($new->content)) echo $new->creationDate; ?></div>
		<div class="article_comments_count"><span id="comments_number"><?php if (isset($new->content)) echo $new->comments_count; ?></span> comentarios</div>
		<div class="clear"></div>
		<hr class="hr_article">
<?php }} ?>
<div id="comments" class="comments">
<?php 
	foreach ($comments as $comment) { ?>
<?php if (isset($comment->commenter)) echo $comment->commenter; ?>
<p><?php if (isset($comment->comment)) echo nl2br($comment->comment); ?></p>
<?php } ?>
</div>
<div class="new_comment">
<table>
<tr>
<td>Nombre:</td><td> <input id="new_comment_commenter" style="width:10em" type="text" maxlength="10" /></td>
</tr>
<tr><td>Comentario:</td><td> <textarea id="new_comment_comment" style="width:500px; height:200px;" ></textarea></td></tr>
<tr><td colspan="2"><span onclick="addNewComment('<?php echo $new->id;?>')">Enviar</span></td></tr>
</table>
</div>
	</div>
	<div class="container side"></div>
	<div style="clear: both"></div>
</div>