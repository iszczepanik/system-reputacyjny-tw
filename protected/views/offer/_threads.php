<br />
<h2>Threads</h2>
<div class="grid-view" >
<table class="items" >
	<thead>
	<tr>
		<th>Content</th>
		<th>Responding to</th>
		<? if ($isMyOffer): ?>
		<th>Importance</th>
		<th>Type</th>
		<? endif; ?>
	<tr/>
	</thead>

<?php foreach($threads as $key=>$thread): ?>
	<tr class='<? echo (($key+1) % 2 == 0 ? "even":"odd"); ?>' >
	<td><? echo $thread->THR_CONTENT; ?></td>
	<td>
	<?
		$respondeeThread = Thread::model()->findByPk($thread->THR_RESP_THR_ID);
		if ($respondeeThread != null)
			echo $respondeeThread->THR_CONTENT;
		else
		{
			?><span style="font-style:italic;" >(none)</span><?
		}
	?>
	</td>
	<? if ($isMyOffer): ?>
	<td><? echo $thread->THR_IMPORTANCE; ?></td>
	<td><? echo $thread->THR_TYPE; ?></td>
	<? endif; ?>
	<tr/>
<?php endforeach; ?>
</table></div>
