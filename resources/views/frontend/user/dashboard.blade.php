@extends('layouts.userinner')
@section('title', 'Dashboard')
@section('content')
<div class="col-md-9 col-sm-8 col-xs-12 col9flex">
    @if($users->roll_id ==1)
    <div class="dashboardbox">
        <div class="dashrow">
            <div class="dashcolumn">
                <div class="dashcboxouter">
                    <div class="dashcboxinner">
                        <h6> Service Status </h6>
                        
                        @if($order_status)
                        <p>{{ $order_status->order_status }} </p>
                        @else
                        <p>You haven't ordered any services yet </p>
                        @endif
                        
                        
                    </div>
                </div>
            </div>
            <div class="dashcolumn">
                <div class="dashcboxouter">
                    <div class="dashcboxinner">
                        <h6>QA will expire in</h6>
                        <div class="qtsize">{{ $expiry }}</div>
                    </div>
                </div>
            </div>
            <div class="dashcolumn">
                <div class="dashcboxouter">
                    <div class="dashcboxinner">
                        <h6>Profile Completion</h6>
                        <div class="qtsize">{{ $profile_percentage }}</div>
                    </div>
                </div>
            </div>
            <div class="dashcolumn">
                <div class="dashcboxouter">
                    <div class="dashcboxinner">
                        <h6>Account Status</h6>
                        
                        @if($users->otp_varification == 0)
                        
                        <p><i class="fa fa-times"></i> Not Verified</p>
                        
                        @else
                        <p class="verified"><i class="fa fa-check"></i>Verified</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="dashrow">
            <div class="dashcolumn12">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Type of equipment</th>
                                <th>Manufacturer</th>
                                <th>Model Name</th>
                                <th class="text-center">Quantity</th>
                                <th>Branch</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if(!empty($equipments))
                        @foreach($equipments as $equipment)
                            <tr>
                                <td>{{ $equipment->machine_type }}</td>
                                <td>{{ $equipment->manufacturer }}</td>
                                <td>{{ $equipment->model }}</td>
                                <td class="text-center">1</td>
                                <td>{{ $equipment->city}} - {{ $equipment->pincode }}</td>
                            </tr>
                        @endforeach
                        @endif
                            <!--<tr>-->
                            <!--    <td>Radiography (Fixed)</td>-->
                            <!--    <td>M/s. Medicaid Equipements Private Limited</td>-->
                            <!--    <td>Zenition 50</td>-->
                            <!--    <td class="text-center">2</td>-->
                            <!--    <td>Kolkata - 700009</td>-->
                            <!--</tr>-->
                            <!--<tr>-->
                            <!--    <td>CT Computerized Tomography</td>-->
                            <!--    <td>Philips India Limited</td>-->
                            <!--    <td>CLINODIGIT OMEGA R&F</td>-->
                            <!--    <td class="text-center">2</td>-->
                            <!--    <td>Bhubaneswer - 751003</td>-->
                            <!--</tr>-->
                            <!--<tr>-->
                            <!--    <td>Radiography and Fluoroscopy</td>-->
                            <!--    <td>M/s. Medicaid Equipements Private Limited</td>-->
                            <!--    <td>Vision-300 RF</td>-->
                            <!--    <td class="text-center">1</td>-->
                            <!--    <td>Howrah - 711102</td>-->
                            <!--</tr>-->
                            <!--<tr>-->
                            <!--    <td colspan="5">&nbsp;</td>-->
                            <!--</tr>-->
                            <!--<tr>-->
                            <!--    <td colspan="5">&nbsp;</td>-->
                            <!--</tr>-->
                            <!--<tr>-->
                            <!--    <td colspan="5">&nbsp;</td>-->
                            <!--</tr>-->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection