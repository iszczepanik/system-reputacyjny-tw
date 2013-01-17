

<?
$crt = Criteria::model()->findByPk($model->WGH_CRT_ID);
?>
<tr class='<? echo (($key+1) % 2 == 0 ? "even":"odd"); ?>' >
	<? if ($model->WGH_VALUES == NULL): ?>
	<td><?php echo $crt->CRT_NAME." (".$crt->CRT_MIN."-".$crt->CRT_MAX.")";?></td>
	<? else: ?>
	<td><?php echo $crt->CRT_NAME;?></td>
	<? endif; ?>

<? if ($model->WGH_VALUES == NULL): ?>
	<td>
	<select name="Weighing_<?echo $model->WGH_CRT_ID;?>[WGH_PREF]" id="Weighing_<?echo $model->WGH_CRT_ID;?>_WGH_PREF" >
		<option value="min" <? if ($model->WGH_PREF == "min") echo "selected='selected'"; ?> >min</option>
		<option value="max" <? if ($model->WGH_PREF == "max") echo "selected='selected'"; ?> >max</option>
	</select>
	</td>
<? else: ?>
	<td>
	<? $values = array_filter(explode(",", $model->WGH_VALUES)); ?>
	<ul class="sortable" id="Weighing_<?echo $model->WGH_CRT_ID;?>_WGH_VALUES" >
		<? foreach ($values as $value) :?>
		<li id="<? echo $value; ?>" ><? echo $value; ?></li>
		<? endforeach; ?>
	</ul>
	<input type="hidden" name="Weighing_<?echo $model->WGH_CRT_ID;?>[WGH_VALUES]" id="Weighing_<?echo $model->WGH_CRT_ID;?>_WGH_VALUES_sorted"
	value="<? echo $crt->CRT_VALUES; ?>" />
	</td>
<? endif; ?>

	<td>
	<div>Set score for <span class="b"><?echo $crt->CRT_NAME;?></span> avarage value: 
	<span class="b" id="Weighing_<?echo $model->WGH_CRT_ID;?>_WGH_VALUES_span" ><? if ($model->WGH_VALUES == NULL) echo (($crt->CRT_MAX + $crt->CRT_MIN)/2); else echo $model->MiddleValue; ?></span> </div><br />
	<div style="float: left; clear: both; width: auto;" ><!--10--></div>
					<div  style="float: left; width: 280px; padding: 5px 10px 15px 10px;" >
					<div class="slider_score" id="Weighing_<?echo $model->WGH_CRT_ID;?>" style="width: 100%; " ></div>
					</div>
					<div style="float: left; width: auto;" ><!--90--></div>
					
					<input name="Weighing_<?echo $model->WGH_CRT_ID;?>[WGH_MIDLESCORE]" 
			id="Weighing_<?echo $model->WGH_CRT_ID;?>_WGH_AVG" 
			type="text" value="<? if ($model->WGH_MIDLESCORE != "") echo $model->WGH_MIDLESCORE; else echo "50"; ?>" />
	</td>

<td>
<div>How much is criterion <span class="b"><?echo $crt->CRT_NAME;?></span> important to you?</div><br />
<div style="float: left; clear: both; width: auto;" ><!--1--></div>
				<div  style="float: left; width: 280px; padding: 5px 10px 15px 10px;" >
				<div class="slider" id="Weighing_<?echo $model->WGH_CRT_ID;?>" style="width: 100%; " ></div>
				</div>
				<div style="float: left; width: auto;" ><!--100--></div>
				
<input name="Weighing_<?echo $model->WGH_CRT_ID;?>[WGH_WEIGHT]" 
		id="Weighing_<?echo $model->WGH_CRT_ID;?>_WGH_WEIGHT" 
		type="text" value="<? if ($model->WGH_IMPORTANCE != "") echo $model->WGH_IMPORTANCE; else echo "50"; ?>" />

</td>
</tr>

