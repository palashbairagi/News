<div class="comment_list">
	<?php if(isset($comments) && !empty($comments)){
	foreach($comments as $comment){?>
	<div class="comment_box">
		<div class="date_and_time">
			<?php $date = new DateTime($comment['added_on']);?>
			<span class=""><?php echo $date->format('d M Y H:i');?></span>
		</div>
		<div class="name">
			<span>Name: </span><span class=""><?php echo $comment['name'];?></span>
		</div>
		<div class="email">
			<span>E-mail: </span><span class=""><?php echo $comment['email'];?></span>
		</div>
		<div class="comment">
			<span>Comment: </span><span class=""><?php echo $comment['comment'];?></span>
		</div>
	</div>
	<?php }} ?>
</div>