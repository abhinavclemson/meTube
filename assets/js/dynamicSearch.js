$( "#employees" ).autocomplete({
    source: 'search.php',
    select: function( event, ui ) {
    window.location.href = 'page.php?id='+ui.item.id;
}
