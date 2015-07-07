{combine_css path=$SORTORDERS_PATH|@cat:"admin/template/style.css"}

{footer_script}
jQuery('input[name="option2"]').change(function() {
  $('.option1').toggle();
});

jQuery(".showInfo").tipTip({
  delay: 0,
  fadeIn: 200,
  fadeOut: 200,
  maxWidth: '300px',
  defaultPosition: 'bottom'
});
{/footer_script}


<div class="titlePage">
	<h2>SortOrders</h2>
</div>

<form method="post" action="" class="properties">
<fieldset>
  <legend>{'Active sort orders'|translate}</legend>
  <label>{', '|implode:$disabled}</label>
  {foreach from=$sort_ids item=ids name=item}
    <label>    
      <input type="checkbox" name={$ids} {if ! in_array($ids, $disabled)}checked="checked"{/if}>
      <b>{$sort_names[$smarty.foreach.item.index]}</b>
    </label>
    <br/>
  {/foreach}  

</fieldset>

<p class="formButtons"><input type="submit" name="save_config" value="{'Save Settings'|translate}"></p>

</form>
