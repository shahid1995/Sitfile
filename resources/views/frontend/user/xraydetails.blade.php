@extends('layouts.userinner')
@section('title', 'Profile')
@section('content')

<?php //echo "<pre>";print_r($xdet); ?>

	<div class="col-md-9 col-sm-8 col-xs-12 col9flex">
		<div class="xray_box_main">
			<div class="row xray_box_main_row">
			<label><h2><?php echo $xdet[0]->model_title; ?></h2></label>
			<table class="table">
				<tr>
					<th>Model Number:</th>
					<td><?php echo $xdet[0]->model_number; ?></td>
				</tr>
				<tr>
					<th>Brand:</th>
					<td><?php echo $xdet[0]->brand_title; ?></td>
				</tr>
				<tr>
					<th>Price:</th>
					<td><?php echo $xdet[0]->price; ?></td>
				</tr>
				<tr>
					<th>Product Image:</th>
					<td><img src="{{url('/')}}/<?php echo $xdet[0]->image; ?>" style="height: 165px;width: 225px;" ></td>
				</tr>
				<tr>
					<th>Properties:</th>
					<td><?php echo $xdet[0]->properties ; ?></td>
				</tr>
				<tr>
					<th>Place of Origin:</th>
					<td><?php echo $xdet[0]->place_of_origin ; ?></td>
				</tr>
				<tr>
					<th>Instrument Classification:</th>
					<td><?php echo $xdet[0]->instrument_classification ; ?></td>
				</tr>
				<tr>
					<th>Certificate:</th>
					<td><?php echo $xdet[0]->certificate ; ?></td>
				</tr>
				<tr>
					<th>OEM:</th>
					<td><?php echo $xdet[0]->oem ; ?></td>
				</tr>
				<tr>
					<th>X-Ray Packing Size:</th>
					<td><?php echo $xdet[0]->xray_packing_size ; ?></td>
				</tr>
				<tr>
					<th>Packing Size:</th>
					<td><?php echo $xdet[0]->packing_size ; ?></td>
				</tr>

				<tr>
					<th>Detection Method:</th>
					<td><?php echo $xdet[0]->detection_method ; ?></td>
				</tr>
				<tr>
					<th>Description:</th>
					<td><?php echo $xdet[0]->description ; ?></td>
				</tr>
				<tr>
					<th>Brand Details:</th>
					<td><?php echo $xdet[0]->brand_description ; ?></td>
				</tr>
			</table>
			<a href="{{url('/')}}/user/xray"><button class="submitbtn">Back</button></a>
		</div>
	</div>
</div>

@endsection