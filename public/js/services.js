$(document).ready(function(){

});

function addService(id,val)
{
	$(".show-services").append(
		'<div id="service-'+id+'"><h3 class="text-left">'+val+'</h3> <div class="signuprightformrow"> <div class="signupcformcolum1"> <div class="form-group"> <input type="text" class="form-control" placeholder="Equipment # 1" name=""> </div>	</div> <div class="signupcformcolum2"> <div class="form-group">	<input type="text" class="form-control" placeholder="Radiography (fixed)" name=""> <div class="actiongroup"> <a class="editbtn" href="javascript:void(0);"><i class="fa fa-pencil"></i></a>	<a class="trashbtn" href="javascript:void();" onclick="removeservice('+id+')">x</a> </div>	</div> </div> </div></div>');
}

function removeservice(id)
{
	$("#service-"+id).remove();
}