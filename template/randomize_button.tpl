{combine_script id='randomize_order' require='jquery' load='footer' path='plugins/sortorders/template/js/randomize.js'}
{if !empty($image_orders)}
<li class="nav-item">
{strip}<a class="nav-link" id="randomize_order_button" title="{'randomize'|@translate}" rel="nofollow">
<i class="fas fa-random fa-fw" aria-hidden="true"></i><span class="d-lg-none ml-2">{'display all photos in all sub-albums'|@translate}</span>
</a>{/strip}
</li>
{/if}