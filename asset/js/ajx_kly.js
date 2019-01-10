function edit_user(id) {

	$("#ed_user").modal('show');
	$.ajax({
		type: "GET",
		url: base_url+"index.php/data_diri/user_v_edit/"+id,
		dataType: "JSON",
		success: function(data) {
			$("#id").val(data.id);
			$("#nama").val(data.name);
			$("#tgllahir").val(data.birthdate);
			$("#alamat").val(data.address);
			$("#alamatemail").val(data.email);
			$("#fileinput").val(data.photo);
		}

	});

	return false;
}

function delete_user(id_user){
	if(confirm('Are you sure to delete this data?')){
		$.ajax({
			type: "GET",
			url: base_url+"index.php/data_diri/delete_data/"+id_user,
			success: function (response) {
				if(response.status == "oke" ){
					window.location.assign(base_url+"data_diri");
				}else{
					console.log('gagal');
				}
			}
		});
	}
return false;
}
