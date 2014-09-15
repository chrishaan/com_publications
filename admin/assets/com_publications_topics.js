window.addEvent('domready', function(){
	load_select_opts( 'topic',  topic_array);
	load_select_opts( 'type',   type_array);
	load_select_opts( 'format', format_array);
})

function populate_form( x )
{
	var index = $( x+'_select' ).selectedIndex;
	if( index < 0 ) return;
	x_array = window[x + '_array'];
	for (var i in x_array[index])
	{
		//alert( x + '_' + i );
		$( x + '_' + i ).value = x_array[index][i];
	}
}

function edit_entry( x )
{
	populate_form( x );
	$( x + '_form' ).setStyle('display','');
}

function new_entry( x )
{
	$( x+'_select' ).selectedIndex = -1;
	x_array = window[x + '_array'];
	for (var i in x_array[0])
	{
	    $( x + '_' + i ).value = '';
	}
	$( x+'_id' ).value = '0';
	$( x+'_form' ).setStyle('display','')
}

function save_entry( x )
{
	var url = "index.php?option=com_publications&view=topics&controller=topics&task=save_" + x;
		x_array = window[x + '_array']; // get reference to the 'x' array where 'x' is type, topic, or format
		//formats has more elements, so we loop through the keys to access each of the values
		for (var i in x_array[0]) // loop through keys of x_array - e.g. for topics will be id, topic, description
		{
			var key = x + '_' + i;
			//alert( key );
			url += "&" + key + "=" + $( key ).value;
		}
		url += "&" + $('token').name + "=1";
		url += "&tab=" + x; //passed so we can display same tab when page is refreshed
	//alert( url );
	window.location = url;
}

function delete_entry( x )
{
	var index = $( x + '_select').selectedIndex;
	if (index == -1)
	{
		alert( 'No ' + x + ' selected.');
		return;
	}
	var url = "index.php?option=com_publications&view=topics&controller=topics&task=delete_" + x;
		url += "&" + x + "_id=" + $( x + '_id').value;
		url += "&tab=" + x;
		url += "&" + $('token').name + "=1";
	//alert( url );
	window.location = url;
}
