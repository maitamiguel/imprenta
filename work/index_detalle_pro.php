<!DOCTYPE html>
<html>
	<head>
		<title>DATOS DETALLE PRODUCTO</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	</head>
	<body>
		<div class="container">
			<br />
			
			<h3 align="center">ADMINISTRADOR DATOS DETALLE PRO.</h3>
			<br />
			<div align="right" style="margin-bottom:5px;">
				<button type="button" name="add_button" id="add_button" class="btn btn-success btn-xs">Add</button>
			</div>

			<div class="table-responsive">
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>ID SUB</th>
							<th>IMG DETALLE</th>
							<th>PRECIO</th>
							<th>CANTIDAD MIN.</th>
							<th>CANTIDAD MAX</th>
							<th>MODIFICAR</th>
							<th>ELIMINAR</th>
						</tr>
					</thead>
					<tbody></tbody>
				</table>
			</div>
		</div>
	</body>
</html>

<div id="apicrudModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<form method="post" id="api_crud_form">
				<div class="modal-header">
		        	<button type="button" class="close" data-dismiss="modal">&times;</button>
		        	<h4 class="modal-title">Datos usuarios</h4>
		      	</div>
		      	<div class="modal-body">
		      		<div class="form-group">
			        	<label>id_sub</label>
			        	<select id="id_sub" name="id_sub" runat="server" class="form-control" required="required"></select>
			        </div>
			        <div class="form-group">
			        	<label>img_detalle</label>
			        	<input type="text" name="img_detalle" id="img_detalle" class="form-control" />
			        </div>
					<div class="form-group">
			        	<label>precio</label>
			        	<input type="text" name="precio" id="precio" class="form-control" />
			        </div>
					<div class="form-group">
			        	<label>cantidad_min</label>
			        	<input type="text" name="cantidad_min" id="cantidad_min" class="form-control" />
			        </div>
					<div class="form-group">
			        	<label>cantidad_max</label>
			        	<input type="text" name="cantidad_max" id="cantidad_max" class="form-control" />
			        </div>
			    </div>
			    <div class="modal-footer">
			    	<input type="hidden" name="hidden_id" id="hidden_id" />
			    	<input type="hidden" name="action" id="action" value="insert" />
			    	<input type="submit" name="button_action" id="button_action" class="btn btn-info" value="Insert" />
			    	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      		</div>
			</form>
		</div>
  	</div>
</div>


<script type="text/javascript">
$(document).ready(function(){

	fetch_data();
	var sub_productos = $('#id_sub');
	$.ajax({
			 url: 'http://localhost/imprenta/api/test_api_sub_productos.php?action=fetch_all&pal=',
			 method: 'post',
			 dataType: 'json',
			 success: function (data) {
				 $(data).each(function (index, item) {
					 sub_productos.append($('<option/>', { value: item.id_sub, text: item.tipo }));
				 });
			 },
			 error: function (err) {
				 console.log(err.responseText);
				 alert(err);
			 }
		 });
	function fetch_data()
	{
		$.ajax({
			url:"fetch_detalle_pro.php",
			success:function(data)
			{
				$('tbody').html(data);
			}
		})
	}

	$('#add_button').click(function(){
		$('#action').val('insert');
		$('#button_action').val('Insert');
		$('.modal-title').text('datos usuarios');
		$('#apicrudModal').modal('show');
	});

	$('#api_crud_form').on('submit', function(event){
		event.preventDefault();
		if($('#id_sub').val() == '')
		{
			alert("Ingresar id_sub");
		}
		else if($('#img_detalle').val() == '')
		{
			alert("Ingrese img_detalle");
		}
		else if($('#precio').val() == '')
		{
			alert("Ingresar precio");
		}
		else if($('#cantidad_min').val() == '')
		{
			alert("Ingrese cantidad_min");
		}
		else if($('#cantidad_max').val() == '')
		{
			alert("Ingresar cantidad_max");
		}
		else
		{
			var form_data = $(this).serialize();
			$.ajax({
				url:"action_detalle_pro.php",
				method:"POST",
				data:form_data,
				success:function(data)
				{
					fetch_data();
					$('#api_crud_form')[0].reset();
					$('#apicrudModal').modal('hide');
					if(data == 'insert')
					{
						alert("Data Inserted using PHP API");
					}
					if(data == 'update')
					{
						alert("Data Updated using PHP API");
					}
				}
			});
			console.info("luego de ajax")
		}
	});

	$(document).on('click', '.edit', function(){
		var id = $(this).attr('id');
		var action = 'fetch_single';
		$.ajax({
			url:"action_detalle_pro.php",
			method:"POST",
			data:{id:id, action:action},
			dataType:"json",
			success:function(data)
			{
				$('#hidden_id').val(data.id_detalle);
				$('#id_sub').val(data.id_sub);
				$('#img_detalle').val(data.img_detalle);
				$('#precio').val(data.precio);
				$('#cantidad_min').val(data.cantidad_min);
				$('#cantidad_max').val(data.cantidad_max);
				$('#action').val('update');
				$('#button_action').val('Update');
				$('.modal-title').text('Modificar Datos ');
				$('#apicrudModal').modal('show');
			}
		})
	});

	$(document).on('click', '.delete', function(){
		var id = $(this).attr("id");
		var action = 'delete';
		if(confirm("Esta seguro de eliminar el Dato"))
		{
			$.ajax({
				url:"action_detalle_pro.php",
				method:"POST",
				data:{id:id, action:action},
				success:function(data)
				{
					fetch_data();
					alert("Data Deleted using PHP API");
				}
			});
		}
	});

});
</script>