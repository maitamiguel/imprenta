<!DOCTYPE html>
<html>
	<head>
		<title>DATOS VENTA</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	</head>
	<body>
		<div class="container">
			<br />
			
			<h3 align="center">ADMINISTRADOR DATOS VENTA</h3>
			<br />
			<div align="right" style="margin-bottom:5px;">
				<button type="button" name="add_button" id="add_button" class="btn btn-success btn-xs">Add</button>
			</div>

			<div class="table-responsive">
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>ID USER</th>
							<th>DESCRIPCION</th>
							<th>FECHA PEDIDO</th>
							<th>FECHA ENTREGA</th>
							<th>OBSERVACION</th>
							<th>ID DETALLE</th>
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
			        	<label>id_user</label>
			        	<select id="id_user" name="id_user" runat="server" class="form-control" required="required"></select>
			        </div>
			        <div class="form-group">
			        	<label>descripcion</label>
			        	<input type="text" name="descripcion" id="descripcion" class="form-control" />
			        </div>
					<div class="form-group">
			        	<label>fecha_pedido</label>
			        	<input type="date" name="fecha_pedido" id="fecha_pedido" class="form-control" />
			        </div>
					<div class="form-group">
			        	<label>fecha_entrega</label>
			        	<input type="date" name="fecha_entrega" id="fecha_entrega" class="form-control" />
			        </div>
					<div class="form-group">
			        	<label>observacion</label>
			        	<input type="text" name="observacion" id="observacion" class="form-control" />
			        </div>
			        <div class="form-group">
			        	<label>id_detalle</label>
			        	<select id="id_detalle" name="id_detalle" runat="server" class="form-control" required="required"></select>
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
	var usuarios = $('#id_user');
	$.ajax({
			 url: 'http://localhost/imprenta/api/test_api_usuarios.php?action=fetch_all&pal=',
			 method: 'post',
			 dataType: 'json',
			 success: function (data) {
				 $(data).each(function (index, item) {
					 usuarios.append($('<option/>', { value: item.id_user, text: item.nombre }));
				 });
			 },
			 error: function (err) {
				 console.log(err.responseText);
				 alert(err);
			 }
		 });

	var detalle_pro = $('#id_detalle');
	$.ajax({
			 url: 'http://localhost/imprenta/api/test_api_detalle_pro.php?action=fetch_all&pal=',
			 method: 'post',
			 dataType: 'json',
			 success: function (data) {
				 $(data).each(function (index, item) {
					 detalle_pro.append($('<option/>', { value: item.id_detalle, text: item.img_detalle }));
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
			url:"fetch_venta.php",
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
		if($('#id_user').val() == '')
		{
			alert("Ingresar id_user");
		}
		else if($('#descripcion').val() == '')
		{
			alert("Ingrese descripcion");
		}
		else if($('#fecha_pedido').val() == '')
		{
			alert("Ingresar fecha_pedido");
		}
		else if($('#fecha_entrega').val() == '')
		{
			alert("Ingrese fecha_entrega");
		}
		else if($('#observacion').val() == '')
		{
			alert("Ingresar observacion");
		}
		else if($('#id_detalle').val() == '')
		{
			alert("Ingrese id_detalle ");
		}
		else
		{
			var form_data = $(this).serialize();
			$.ajax({
				url:"action_venta.php",
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
			url:"action_venta.php",
			method:"POST",
			data:{id:id, action:action},
			dataType:"json",
			success:function(data)
			{
				$('#hidden_id').val(data.id_venta);
				$('#id_user').val(data.id_user);
				$('#descripcion').val(data.descripcion);
				$('#fecha_pedido').val(data.fecha_pedido);
				$('#fecha_entrega').val(data.fecha_entrega);
				$('#observacion').val(data.observacion);
				$('#id_detalle').val(data.id_detalle);
				$('#action').val('update');
				$('#button_action').val('Update');
				$('.modal-title').text('Modificar Datos');
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
				url:"action_venta.php",
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