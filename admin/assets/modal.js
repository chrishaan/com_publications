function createWindow( source, target_element, width, height)
{
   //$( 'dm' ).blur();
   var left = parseInt( (document.documentElement.clientWidth  / 2) - (width  / 2) );
   var top  = parseInt( (document.documentElement.clientHeight / 2) - (height / 2) );
   var blocker = new Element ( 'div', { 'id' : 'blocker' });
   var div_style = 'width: '+width+'px;'
				  +'height: '+height+'px;'
				  +'z-index: 2000;'
			      +'border: 1px solid black;'
			      +'position: fixed;'
			      +'top: '+top+'px;'
			      +'left: '+left+'px;'
				  +'overflow: hidden;'
			      ;

   var my_div = new Element ( 'div' ,
      { 'id' : 'modalWindow' ,
        'style' : div_style
	  });
   blocker.injectInside( $( 'minwidth-body' ) );
   //$$( '.mceButtonDisabled').setStyle('visibility', 'hidden');
   my_div.injectInside( $( 'minwidth-body' ) );
   var myMove = new Drag.Move( my_div );
   var iframe_style = 'width:100%;'
					 +'height:100%;'
				     +'border: none;'
				     +'border-top: 1px solid black;'
				     +'border-bottom: 1px solid black;'
				     +'background-color: #dddddd;';
   var my_iframe = new Element ( 'iframe',
      { 'id' : 'modalFrame',
        'name': 'modalFrame',
        'src': source + "&target=" + target_element,
        'style' : iframe_style } );
   my_iframe.injectInside( my_div );

   my_div.setStyle('top',top+'px')
}

function closeWindow() {
	$( 'modalWindow' ).remove(); //mootools 1.12
	$( 'blocker' ).remove(); //mootools 1.12
	//$$( '.mceButtonDisabled').setStyle('visibility', 'inherit');
	//$( 'modalWindow').destroy(); //mootools 1.2.5
	//$( 'blocker' ).destroy(); //mootools 1.2.5
}

// the following two functions run in the modal popup window
function getUrl() {
	$( 'url' ).value = $( 'file_select' ).options[ $( 'file_select' ).selectedIndex ].value;
}

function returnUrl( target_element_name ) {
	parent.document.getElementById(target_element_name).value = $( 'url' ).value;
	parent.closeWindow();
}

function getQueryHash( qkey ){
	query = location.search;
	if (query.substr(0,1) == '?'){
		query = query.substr(1);
	}
	var pairs = query.split( '&' );
	var dict = new Array();
	for (var i = 0; i < pairs.length; i++ ) {
		key = pairs[i].split( '=' )[0];
		value = pairs[i].split('=' )[1];
		dict[ key ] = value;
	}
	if (qkey == null ){
		return dict;
	} else if (dict[qkey]) {
		return dict[qkey];
	} else {
		return false;
	}
}