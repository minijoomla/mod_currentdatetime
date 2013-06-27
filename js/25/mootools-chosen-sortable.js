/*
 * Author: Mohammad Hasani Eghtedar
 * Created at: 2012-07-05
 *
 *
 * Version: 1.0.0
 */
window.addEvent('domready', function() {
	var chosenlist = $$('.chzn-select');
	chosenlist.chosen();

	var sortlist = $$('.chzn-choices');
	var mySortables = new Sortables(sortlist, {
		clone: true,
		opacity: 0.5,
		revert: true,
		onComplete: function(el) {
			changeorder();
		}
	});

	chosenlist.addEvent('change', function() {
		mySortables.removeLists(sortlist);
		mySortables.addLists(sortlist);
		changeorder();
	});

	function changeorder() {
		var sort_order = mySortables.serialize();
		for(i=0; i<sort_order.length; i++) {
			if(sort_order[i])
			{
				sort_order[i] = sort_order[i].replace('jform_params_items_chzn_c_','');
			}
		}
		var options = chosenlist.getElements('option');
		alert(sort_order);
		alert(options[0].get('html'));
	}
});