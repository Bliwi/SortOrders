{* <!-- load CSS files --> *}
{combine_css id="sortorders" path=$SORTORDERS_PATH|cat:"template/style.css"}

{* <!-- load JS files --> *}
{* {combine_script id="sortorders" require="jquery" path=$SORTORDERS_PATH|cat:"template/script.js"} *}

{* <!-- add inline JS --> *}
{footer_script require="jquery"}
  jQuery('#sortorders').on('click', function(){
    alert('{'Hello world!'|translate}');
  });
{/footer_script}

{* <!-- add inline CSS --> *}
{html_style}
  #sortorders {
    display:block;
  }
{/html_style}


{* <!-- add page content here --> *}
<h1>{'What SortOrders can do for me?'|translate}</h1>

<blockquote>
  {$INTRO_CONTENT}
</blockquote>

<div id="sortorders">{'Click for fun'|translate}</div>