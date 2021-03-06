$(document).ready(function () {
	$("#clients-list").dataTable({
		"aaSorting": [[ 0, "asc" ]],
		 "aoColumns": [
		      null,
		      null,
		      null,
		      { "bSortable": false }
		 ],
		"fnRowCallback": function( nRow, aData, iDisplayIndex ) {
			/* Append the grade to the default row class name */
			var str = aData[0];
			var arr = str.split(":::");
			$('td:eq(0)', nRow).html( '<a href="' + arr[1] + '">' + arr[0] + '</a>' );

			var str = aData[2];
			var arr = str.split(" ");
			var str = arr[0];
			var arr = str.split("-");

			$('td:eq(2)', nRow).html($.datepicker.formatDate( "dd M, yy", new Date(arr[0], arr[1] - 1, arr[2])));

			$(nRow).show();
		},
		"aoColumnDefs": [ {
			"sClass": "center",
			"aTargets": [ -1, -2 ]
		} ],
			"fnFooterCallback": function() {
				$("#clients-list").show();
			}
		});
});

$('.delete-client-btn').click(function() {
	return confirm('Are you sure to delete this client?');
});
