/**
 * 
 * 
 */
function likedislikedis(field_iddis){
	var base_url = $("#mybaseurldis").val();
	$.post( base_url, {field_id:field_iddis} ,
	function(datadis) {
			if(datadis.status==true){
				$("#displaytextdis_"+field_iddis).html(datadis.displaytext);
				$("#likedislikecountdis_"+field_iddis).html(datadis.count);
			}
	},'json');
}