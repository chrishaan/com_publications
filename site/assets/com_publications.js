window.addEvent('domready', function(){
	$('docsearch').addEvent('submit', function(e){
		new Event(e).stop();
		fixSubmitUrl();
	});

	if($('limit')){
		$('limit').onchange = '';
		$('limit').addEvent('change', function(){
			fixSubmitUrl( this );
		});
	}
});

function fixSubmitUrl( element )
{
	var topic = $('topic').options[ $('topic').selectedIndex ].value;
	var type = $('type').options[ $('type').selectedIndex ].value;
	var year = $('year').options[ $('year').selectedIndex ].value;
	var search = $('search').value;
	var url = $('docsearch').action + topic + "/" + type;
	if( parseInt(year) != 0 ){
		url += "/" + year;
	}
	var params = new Array();
	if( $('limit') && $('limit') == element ) {
		params.push( 'limit=' + $('limit').options[ $('limit').selectedIndex ].value );
	}
	if( search != '' ) {
		params.push( 'search=' + $('search').value );
	}
	//params.push( 'layout=default' );
	if( params.length > 0){
		url += '?' + params.join('&');
	}
	document.location.href = url;
	return false;

}
