<div class="form">

<? if(!empty($message)): ?>
	<div class="errorSummary" >
	<? echo $message; ?>
	</div>
<? endif; ?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'offer-form',
	'enableAjaxValidation'=>false,
)); ?>
<script  type="text/javascript" >
function appendOptionLast(num, select_obj)
{
	var option = document.createElement('option');
	option.text = num;
	option.value = num;
	//if (num == 4) option.selected = "selected";

	try {
	select_obj.add(option, null); // standards compliant; doesn't work in IE
	}
	catch(ex) {
	select_obj.add(option); // IE only
	}
}
function AddControls()
{
	var table_threads = document.getElementById('table_threads');
	new_threads_count = document.getElementById('new_threads_count').value;
	resp_threads_count = document.getElementById('resp_threads_count').value;
	
	//alert(parseInt(resp_threads_count));
	//alert(parseInt(new_threads_count));
	
	var thr_no = parseInt(resp_threads_count) + parseInt(new_threads_count) + 1;
		
	//Content
	id_content = "NEW_THR_CONTENT_" + new_threads_count;

	var lastRow = table_threads.rows.length;
	var row = table_threads.insertRow(lastRow);
	row.setAttribute('class', thr_no % 2 == 0 ? 'even' : 'odd');
  
	// 1 cell
	var cell0 = row.insertCell(0);
	var textNode = document.createTextNode("thread #" + thr_no);
	cell0.appendChild(textNode);

	var cell1 = row.insertCell(1);
	cell1.className = "td_content";

	var newTextBox_content = document.createElement('textarea');
	newTextBox_content.setAttribute('id',id_content);
	newTextBox_content.setAttribute('name',id_content);
	
	cell1.appendChild(newTextBox_content);
	
	//Importance
	//alert("2");
	var cell2 = row.insertCell(2);
	cell2.className = "td_importance";
	id_importance = "NEW_THR_IMPORTANCE_" + new_threads_count;

	var select_obj = document.createElement('select');
	//select_obj.setAttribute('id',id_importance);
	select_obj.setAttribute('name',id_importance);
	
	for(var i = 1; i <= 7; i++)
		appendOptionLast(i, select_obj);
	
	var divTag = document.createElement("div");
	divTag.id = "NEW_THR_IMPORTANCE_" + new_threads_count;
	divTag.style.width = "80px";
	
	
	divTag.appendChild(select_obj);
	cell2.appendChild(divTag);
	//alert("3");

	// var cell3 = row.insertCell(3);
	// var textNode = document.createTextNode(" ");
	// cell3.appendChild(textNode);

	document.getElementById('new_threads_count').value = ++new_threads_count;
	
	var $stars2 = $("#" + divTag.id);

	$stars2.children().not("select").hide();
	$stars2.stars({
		inputType: "select",
		cancelShow: false,
		disableValue: false,
		//callback: function(ui, type, value, event){
			//alert("callback: {\n type: " + type + ",\n value: " + value + ",\n event: " + event.type + "\n}");
		//},
	});
	
	$stars2.stars("select", 4);
}
</script>

		<script type="text/javascript">
		$(function(){
			
		
			//alert("halo");
			<?
			if ($respondeeOffer != null){
			foreach($respondeeOffer->Offer_threads as $thread)
			{
			?>

				var $stars2 = $("#THR_IMPORTANCE_<? echo $thread->THR_ID; ?>");
				//alert($stars2.attr('id'));


					$stars2.children().not("select").hide();
					$stars2.stars({
						inputType: "select",
						cancelShow: false,
						disableValue: false,
						//callback: function(ui, type, value, event){
							//alert("callback: {\n type: " + type + ",\n value: " + value + ",\n event: " + event.type + "\n}");
						//},
					});

			<?
			}}
			?>
			
			var sliderValues = new Array(); // regular array (add an optional integer
			sliderValues[1]="neg_3";
			sliderValues[2]="neg_2";
			sliderValues[3]="neg_1";
			sliderValues[4]="0";
			sliderValues[5]="pos_1";
			sliderValues[6]="pos_2";
			sliderValues[7]="pos_3";

				$(".slider").each(function() {
					$(this).slider({
						value:4,
						min: 1,
						max: 7,
						step: 1,
						slide: function( event, ui ) {//THR_TYPE
							//alert(sliderValues[ui.value]);
							$("[name="+"THR_"+$(this).attr("id")+"]").filter("[value="+sliderValues[ui.value]+"]").attr("checked","checked");
						}
					});
					$("[name="+"THR_"+$(this).attr("id")+"]").filter("[value=4]").attr("checked","checked");
				});

		});
		</script>
	<?php 
	echo $form->hiddenField($model,'OFR_COMPROMISE'); 

	$negotiationCase = $model->Offer_negotiation->negotiation_case;
	$CaseCriterias = $negotiationCase->Criterias;
	
	?>
	<h2 style="display: none;">General</h2>
	
	<!--<div class="slider"></div>-->
	
	
	<table class="detail-view" style="display: none;" >
	<tr class="even" ><th><?php echo $form->labelEx($model,'OFR_SCORE_NAD'); ?></th>
	<td><?php echo $form->textField($model,'OFR_SCORE_NAD'); ?>
	<?php echo $form->error($model,'OFR_SCORE_NAD'); ?></td></tr></table>
	<br />
	<h2>Offer details</h2><table class="detail-view" >
	<?
	foreach($CaseCriterias as $key=>$caseCriteria){
	  ?>
		<tr class='<? echo (($key+1) % 2 == 0 ? "even":"odd"); ?>' >
		<th><!--<label for="DET_VALUE_<? echo $caseCriteria->CRT_ID."_$key"; ?>">-->
		<? echo $caseCriteria->CRT_NAME."<br />(".$caseCriteria->CRT_MIN."-".$caseCriteria->CRT_MAX.")"; ?><!--</label>--></th>
		<td><input name="DET_VALUE_<? echo $caseCriteria->CRT_ID."_$key"; ?>" id="DET_VALUE_<? echo $caseCriteria->CRT_ID."_$key"; ?>" type="text" /></td>
		</tr>
	  <?
	}
	?></table><?

	?>
	
	<div id="panel_threads" style="display: none;" ><br /><h2>Threads</h2>
	<div class="grid-view" ><table id="table_threads" class="items" style="margin-bottom: 3px;" >
		<thead><tr><th>Thread No.</th><th>Content</th><th>Importance</th><tr/></thead>
	<?	
	
	$_key = 0;	
	if ($respondeeOffer != null)
	{
	foreach($respondeeOffer->Offer_threads as $thread)
	{
		//echo $thread->THR_ID; 
		
		?>
		<tr class='<? echo (($_key+1) % 2 == 0 ? "even":"odd"); ?>' >
		<td class="td_thredno" ><div>thread #<? echo ($_key+1); ?></div></td>
		<td class="td_content" ><span style="font-weight: bold;" >Respond to:</span>
		<div><? echo $thread->THR_CONTENT; ?></div>
		<br />	
		<div>
		<textarea name="THR_CONTENT_<? echo $thread->THR_ID; ?>" id="THR_CONTENT_<? echo $thread->THR_ID; ?>" ></textarea>
		</div>
		<br /><br />
		<label style="font-weight: bold; " >My response is:</label>
		<div style="clear: both;"></div>
		
		<div style="float: left; clear: both; width: auto;" >negative</div>
				<div  style="float: left; width: 200px; padding: 5px 10px 15px 10px;" >
				<div class="slider" id="TYPE_<? echo $thread->THR_ID; ?>" style="width: 100%; " ></div>
				</div>
				<div style="float: left; width: auto;" >positive</div>

		<div style="clear: both; display: none;">
		negative
		<input type="radio" name="THR_TYPE_<? echo $thread->THR_ID; ?>" id="THR_TYPE_<? echo $thread->THR_ID; ?>" value="neg_3" />
		<input type="radio" name="THR_TYPE_<? echo $thread->THR_ID; ?>" id="THR_TYPE_<? echo $thread->THR_ID; ?>" value="neg_2" />
		<input type="radio" name="THR_TYPE_<? echo $thread->THR_ID; ?>" id="THR_TYPE_<? echo $thread->THR_ID; ?>" value="neg_1" />
		<input type="radio" name="THR_TYPE_<? echo $thread->THR_ID; ?>" id="THR_TYPE_<? echo $thread->THR_ID; ?>" value="0" checked="checked" />
		<input type="radio" name="THR_TYPE_<? echo $thread->THR_ID; ?>" id="THR_TYPE_<? echo $thread->THR_ID; ?>" value="pos_1" />
		<input type="radio" name="THR_TYPE_<? echo $thread->THR_ID; ?>" id="THR_TYPE_<? echo $thread->THR_ID; ?>" value="pos_2" />
		<input type="radio" name="THR_TYPE_<? echo $thread->THR_ID; ?>" id="THR_TYPE_<? echo $thread->THR_ID; ?>" value="pos_3" />
		positive
		</div>
		
		</td>
		
		<td class="td_importance" >	
		<div id="THR_IMPORTANCE_<? echo $thread->THR_ID; ?>"  style="width: 80px;" >&nbsp;&nbsp;
		<select name="THR_IMPORTANCE_<? echo $thread->THR_ID; ?>"  >
			<?
			for ($i = 1; $i <= 7; $i++)
			{
				?><option value="<?echo $i;?>" <? if ($i == 4) echo "selected='selected'"; ?> ><?echo $i;?></option><?
			}
			?>
		</select>
		</div>
		<!--<input name="THR_IMPORTANCE_<? echo $thread->THR_ID; ?>" id="THR_IMPORTANCE_<? echo $thread->THR_ID; ?>" type="text" />		-->
		</td>
		
		<!--<td>	
		<input name="THR_TYPE_<? echo $thread->THR_ID; ?>" id="THR_TYPE_<? echo $thread->THR_ID; ?>" type="text" />		
		</td>-->
		</tr>
		
		<?
		
		$_key++;
	}
	}
	?>
	</table>
	<input type="hidden" name="resp_threads_count" id="resp_threads_count" value="<?echo ($_key);?>" />
	<a id="b_add_thread" style="float: right;" href="#" onclick="javascript:AddControls(); return false;" >Add new thread</a>
	<input type="hidden" name="new_threads_count" id="new_threads_count" value="0" />
	</div>
	
	
	</div>

	
	<br />
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Send offer' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->