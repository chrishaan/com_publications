function addtopic( doc_id ){
	var topic = $('topic');
	var topic_id = topic.options[ topic.selectedIndex ].value;
	if(topic_id == 0){
		return;
	}
	var link = 'index.php?option=com_publications&controller=document&task=addtopic&doc_id=' + doc_id + '&topic_id=' + topic_id;
	window.location = link;
}

function load_select_opts( x, opt_array){
	// inserts options into a select from an associative array
	// value is take from id
	var x_s = $( x + '_select' );
	x_s.options.length = 0; //clear options
	if(opt_array[0] == null || opt_array.length < 1) return;
	opt_array.each( function(item){
		var y = document.createElement('option');
		y.text = item[x];
		y.value = item['id'];
		try {
			x_s.add( y, null ); // standards compliant
		}
		catch( ex ) {
			x_s.add( y ); // IE only
		}
	})
}
