@extends('layouts.userinner')
@section('title', 'Profile')
@section('content')

<div class="col-md-9 col-sm-8 col-xs-12 col9flex">
  <div class="profile_block myorderouter">
    <div class="logheading">
      <h2>Service Request</h2>
    </div>
    <!-- <div class="service_tab">       
      <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#New" aria-controls="New" role="tab" data-toggle="tab">new</a></li>
        <li role="presentation"><a href="#Bidding" aria-controls="Bidding" role="tab" data-toggle="tab">bidding</a></li>
        <li role="presentation"><a href="#Won" aria-controls="Won" role="tab" data-toggle="tab">Won</a></li>
        <li role="presentation"><a href="#Lost" aria-controls="Lost" role="tab" data-toggle="tab">Lost</a></li>
        <li role="presentation"><a href="#Completed" aria-controls="Completed" role="tab" data-toggle="tab">Completed</a></li>
        <li role="presentation"><a href="#DeclinedExpired" aria-controls="DeclinedExpired" role="tab" data-toggle="tab">Declined/Expired</a></li>
      </ul>
      <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="New">
          <div class="plan_history">
            <div class="cheadbx">
              <h3>New</h3>
            </div>
            <div class="plan_details_table">
              <div class="table-responsive">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Offer Placed</th>
                      <th class="text-center"># Of Offer</th>
                      <th class="text-center">Total Equipment</th>
                      <th class="text-center">Total Location</th>
                      <th>Offer # 406-9392-31523 </th>                             
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>3 February 2020</td>
                      <td class="text-center">5</td>
                      <td class="text-center">10</td>
                      <td class="text-center">5</td>
                      <td>&nbsp;</td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="tableheading">
                <div class="tbleft">
                  <h4>Quality Assurance</h4>
                </div>
                <div class="tbright">
                  <div class="tbrightinner">
                    <span class="ptext">&#8377; 19,000</span>
                  </div>
                </div>
              </div>
              <div class="table-responsive">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Equipments</th>
                      <th class="text-center">Quantity</th>
                      <th>Location</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Radiography (Fixed)</td>
                      <td class="text-center">1</td>
                      <td>A-19 Saheed Nagar, maharishi college road, Bhubaneswar, Odisha 751007</td>
                      <td class="nowrap">
                        
                      </td>
                    </tr>
                    <tr>
                      <td>CT-Scan</td>
                      <td class="text-center">1</td>
                      <td></td>
                      <td class="nowrap">
                        <div class="acebtngroup">                                        
                            <a class="acebtn" href="javascript:void(0);">Accept Job</a>
                            <a class="acebtn" href="javascript:void(0);">Decline Job</a>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>C-Arm</td>
                      <td class="text-center">1</td>
                      <td>A-19 Saheed Nagar, maharishi college Cuttack, Odisha</td>
                      <td></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div role="tabpanel" class="tab-pane" id="Bidding">
          <div class="plan_history">
            <div class="cheadbx">
              <h3>Bidding</h3>
            </div>
            <div class="plan_details_table">
              <div class="table-responsive">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Offer Placed</th>
                      <th class="text-center"># Of Offer</th>
                      <th class="text-center">Total Equipment</th>
                      <th class="text-center">Total Location</th>
                      <th>Offer # 406-9392-31523</th>                             
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>3 February 2020</td>
                      <td class="text-center">5</td>
                      <td class="text-center">10</td>
                      <td class="text-center">5</td>
                      <td>&nbsp;</td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="tableheading">
                <div class="tbleft">
                  <h4>Quality Assurance</h4>
                </div>
                <div class="tbright">
                  <div class="tbrightinner">
                    <span class="ptext">&#8377; 19,000</span>
                    <p>(Bid Placed, Underbid, Winning) </p>
                  </div>
                </div>
              </div>
              <div class="table-responsive">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Equipments</th>
                      <th class="text-center">Quantity</th>
                      <th>Location</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>
                        Radiography (Fixed)
                        <div><a class="plusbtn" href="javascript:void(0);">+</a></div>
                      </td>
                      <td class="text-center">1</td>
                      <td>A-19 Saheed Nagar, maharishi college road, Bhubaneswar, Odisha 751007</td>
                      <td class="nowrap">
                        <div class="qtywrap">
                          <div class="qtyinner">
                            <div class="input-group">
                              <a class="incr-btn input-group-addon" data-action="decrease" href="#">-</a>
                              <input class="quantity form-control" type="text" name="quantity" value="18900">
                              <a class="incr-btn input-group-addon" data-action="increase" href="#">+</a>
                            </div>
                          </div>
                        </div>
                        <div class="acebtngroup">                                        
                            <a class="acebtn" href="javascript:void(0);" style="min-width: 100px;">BID</a>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>CT-Scan</td>
                      <td class="text-center">1</td>
                      <td></td>
                      <td class="nowrap"></td>
                    </tr>
                    <tr>
                      <td>C-Arm</td>
                      <td class="text-center">1</td>
                      <td>A-19 Saheed Nagar, maharishi college Cuttack, Odisha</td>
                      <td></td>
                    </tr>
                    <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>
                        <p>Want it now?  &#8377; 8,000</p>
                        <div class="acebtngroup">
                          <a class="acebtn" href="javascript:void(0);">Make an offer</a>
                          <a class="acebtn" href="javascript:void(0);">Get it Now</a>
                        </div>
                        <div class="acebtngroup">
                          <span>Minimum Bid: &#8377; 1000</span>
                          <a class="acebtn" href="javascript:void(0);" data-toggle="modal" data-target="#BidModal">Bid Now</a>
                        </div> 
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="activitybx">
              <div class="acnch"><a role="button" data-toggle="collapse" href="#Activity" aria-expanded="false" aria-controls="Activity">Activity <i class="fa fa-caret-down"></i></a></div>
              <div class="acnchtable collapse" id="Activity">
                <div class="table-responsive">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>Time</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>10:15 AM</td>
                        <td>Accepted the project</td>
                      </tr>
                      <tr>
                        <td>10:20 AM</td>
                        <td>Made an offer of &#8377;13,000</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="minimumbidbox">
              <h5>Minimum bid* &#8377; 1000</h5>
              <h3>Enter minimum bid and calculate the profit you can earn with your service </h3>
              <div class="mintable">
                <div class="table-responsive">
                  <table class="table table-bordered">
                    <tbody>
                      <tr>
                        <td>
                          <span class="thto">Enter the minimum bid</span>
                          <span class="thbo">Excluding GST</span>
                          <span class="thprleft ththmecolor">&#8377;1000.00</span>
                          <button class="sutablebtn">Submit</button>
                        </td>
                        <td>
                          <span class="thto">GST on Minimum Bid</span>
                          <span class="thbo">@ 18%</span>
                          <span class="thprleft">&#8377;180.00</span>
                        </td>
                        <td>
                          <span class="thto">Total Minimum Bid</span>
                          <span class="thbo">Including GST</span>
                          <span class="thprleft">&#8377;1180.00</span>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <span class="thto">Altibbe Referral Fee</span>
                          <span class="thbo">15%</span>
                          <span class="thprleft">&#8377;150.00</span>
                        </td>
                        <td>
                          <span class="thto">GST on Total Altibbe fee</span>
                          <span class="thbo">@ 18%</span>
                          <span class="thprleft">&#8377;27.00</span>
                        </td>
                        <td>
                          <span class="thto">Total Altibbe Service Fees</span>
                          <span class="thbo">Including GST</span>
                          <span class="thprleft">&#8377;177.00</span>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <span class="thto">You Make</span>
                          <span class="thbo">Excluding GST</span>
                          <span class="thprleft">&#8377;850.00</span>
                        </td>
                        <td>
                          <span class="thto">GST on You Make</span>
                          <span class="thbo">@ 18%</span>
                          <span class="thprleft">&#8377;153.00</span>
                        </td>
                        <td>
                          <span class="thto">Total You Make</span>
                          <span class="thbo">Including GST</span>
                          <span class="thprleft">&#8377;1003.00</span>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <span class="thto">Cost of Service</span>
                          <br>
                          <span class="thprleft ththmecolor">&#8377;500.00</span>
                          <button class="sutablebtn">Submit</button>
                        </td>
                        <td valign="middle">
                          <span class="thto profitc">Your Profit </span>
                        </td>
                        <td>
                          <span class="thprleft bigpthbo">&#8377;503.00</span>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="modal fade bidmodal" id="BidModal" tabindex="-1" role="dialog" aria-labelledby="BidModalLabel">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <div class="row">
                        <div class="col-xs-12">
                            <h4>Bid Now</h4>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                  <thead>
                                    <tr>
                                      <th>Equipments</th>
                                      <th class="text-center">Quantity</th>
                                      <th>Location</th>
                                      <th>Action</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <tr>
                                      <td>Radiography (Fixed)</td>
                                      <td class="text-center">1</td>
                                      <td>A-19 Saheed Nagar, maharishi college road, Bhubaneswar, Odisha 751007</td>
                                      <td class="nowrap">
                                          <div class="bidbtngroup"></div><a class="bidbtn" href="javascript:void(0);">Bid Now</a></div>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>Radiography (Fixed)</td>
                                      <td class="text-center">1</td>
                                      <td>A-19 Saheed Nagar, maharishi college road, Bhubaneswar, Odisha 751007</td>
                                      <td class="nowrap">
                                          <div class="bidbtngroup"></div><a class="bidbtn" href="javascript:void(0);">Bid Now</a></div>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>Radiography (Fixed)</td>
                                      <td class="text-center">1</td>
                                      <td>A-19 Saheed Nagar, maharishi college road, Bhubaneswar, Odisha 751007</td>
                                      <td class="nowrap">
                                          <div class="bidbtngroup"></div><a class="bidbtn" href="javascript:void(0);">Bid Now</a></div>
                                      </td>
                                    </tr>
                                  </tbody>
                                </table>
                              </div>
                        </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div role="tabpanel" class="tab-pane" id="Won">
          <div class="plan_history">
            <div class="cheadbx">
              <h3>Won</h3>
            </div>
            <div class="plan_details_table">
              <div class="table-responsive">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Offer Placed</th>
                      <th class="text-center">Total</th>
                      <th class="text-center">Total Equipment</th>
                      <th class="text-center">Total Location</th>
                      <th>Offer # 406-9662-31523</th>                             
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>3 February 2020</td>
                      <td class="text-center">&#8377; 15,000.00</td>
                      <td class="text-center">10</td>
                      <td class="text-center">5</td>
                      <td>&nbsp;</td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="tableheading">
                <div class="tbleft">
                  <h4>Quality Assurance</h4>
                </div>
                <div class="tbright">
                  <div class="tbrightinner">
                    <a class="managebtn" href="javascript:void(0);">Manage Order</a>
                  </div>
                </div>
              </div>
              <div class="table-responsive">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Equipments</th>
                      <th class="text-center">Quantity</th>
                      <th>Location</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Radiography (Fixed)</td>
                      <td class="text-center">1</td>
                      <td>A-19 Saheed Nagar, maharishi college road, Bhubaneswar, Odisha 751007</td>
                      <td class="nowrap">
                        
                      </td>
                    </tr>
                    <tr>
                      <td>CT-Scan</td>
                      <td class="text-center">1</td>
                      <td></td>
                      <td class="nowrap">
                        <div class="acebtngroup">                                        
                            <a class="acebtn" href="javascript:void(0);">Accept Job</a>
                            <a class="acebtn" href="javascript:void(0);">Decline Job</a>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>C-Arm</td>
                      <td class="text-center">1</td>
                      <td>A-19 Saheed Nagar, maharishi college Cuttack, Odisha</td>
                      <td></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div role="tabpanel" class="tab-pane" id="Lost">
          <div class="plan_history">
            <div class="cheadbx">
              <h3>Lost</h3>
            </div>
            <div class="plan_details_table">
              <div class="table-responsive">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Offer Placed</th>
                      <th class="text-center">Total Equipment</th>
                      <th class="text-center">Total Location</th>
                      <th>Offer # 406-9392-31523</th>                             
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>3 February 2020</td>
                      <td class="text-center">10</td>
                      <td class="text-center">2</td>
                      <td>&nbsp;</td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="tableheading">
                <div class="tbleft">
                  <h4>Quality Assurance</h4>
                </div>
                <div class="tbright">
                  <div class="tbrightinner">
                    <span class="ptext">&#8377; 19,000</span>
                  </div>
                </div>
              </div>
              <div class="table-responsive">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Equipments</th>
                      <th class="text-center">Quantity</th>
                      <th>Location</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Radiography (Fixed)</td>
                      <td class="text-center">1</td>
                      <td>A-19 Saheed Nagar, maharishi college road, Bhubaneswar, Odisha 751007</td>
                      <td class="nowrap">
                        
                      </td>
                    </tr>
                    <tr>
                      <td>CT-Scan</td>
                      <td class="text-center">1</td>
                      <td></td>
                      <td class="nowrap">
                        <div class="acebtngroup">                                        
                            <a class="acebtn" href="javascript:void(0);">Accept Job</a>
                            <a class="acebtn" href="javascript:void(0);">Decline Job</a>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>C-Arm</td>
                      <td class="text-center">1</td>
                      <td>A-19 Saheed Nagar, maharishi college Cuttack, Odisha</td>
                      <td></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div role="tabpanel" class="tab-pane" id="Completed">
          <div class="plan_history">
            <div class="cheadbx">
              <h3>Completed</h3>
            </div>
            <div class="plan_details_table">
              <div class="table-responsive">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Offer Placed</th>
                      <th class="text-center">Total Equipment</th>
                      <th class="text-center">Total Location</th>
                      <th>Offer # 406-9392-31523</th>                             
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>3 February 2020</td>
                      <td class="text-center">10</td>
                      <td class="text-center">2</td>
                      <td>&nbsp;</td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="tableheading">
                <div class="tbleft">
                  <h4>Quality Assurance</h4>
                </div>
                <div class="tbright">
                  <div class="tbrightinner">
                    <span class="ptext">&#8377; 19,000</span>
                  </div>
                </div>
              </div>
              <div class="table-responsive">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Equipments</th>
                      <th class="text-center">Quantity</th>
                      <th>Location</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Radiography (Fixed)</td>
                      <td class="text-center">1</td>
                      <td>A-19 Saheed Nagar, maharishi college road, Bhubaneswar, Odisha 751007</td>
                      <td class="nowrap"></td>
                    </tr>
                    <tr>
                      <td>CT-Scan</td>
                      <td class="text-center">1</td>
                      <td></td>
                      <td class="nowrap">
                        <div class="acebtngroup">                                        
                            <a class="acebtn" href="javascript:void(0);">Accept Job</a>
                            <a class="acebtn" href="javascript:void(0);">Decline Job</a>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>C-Arm</td>
                      <td class="text-center">1</td>
                      <td>A-19 Saheed Nagar, maharishi college Cuttack, Odisha</td>
                      <td></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div role="tabpanel" class="tab-pane" id="DeclinedExpired">
          <div class="plan_history">
            <div class="cheadbx">
              <h3>Declined/Expired</h3>
            </div>
            <div class="plan_details_table">
              <div class="table-responsive">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Offer Placed</th>
                      <th class="text-center">Total Equipment</th>
                      <th class="text-center">Total Location</th>
                      <th>Offer # 406-9392-31523</th>                             
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>3 February 2020</td>
                      <td class="text-center">10</td>
                      <td class="text-center">2</td>
                      <td>&nbsp;</td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="tableheading">
                <div class="tbleft">
                  <h4>Quality Assurance</h4>
                </div>
                <div class="tbright">
                  <div class="tbrightinner">
                    <span class="ptext">&#8377; 19,000</span>
                  </div>
                </div>
              </div>
              <div class="table-responsive">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Equipments</th>
                      <th class="text-center">Quantity</th>
                      <th>Location</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Radiography (Fixed)</td>
                      <td class="text-center">1</td>
                      <td>A-19 Saheed Nagar, maharishi college road, Bhubaneswar, Odisha 751007</td>
                      <td class="nowrap"></td>
                    </tr>
                    <tr>
                      <td>CT-Scan</td>
                      <td class="text-center">1</td>
                      <td></td>
                      <td class="nowrap">
                        <div class="acebtngroup">                                        
                          <a class="acebtn" href="javascript:void(0);">Accept Job</a>
                          <a class="acebtn" href="javascript:void(0);">Decline Job</a>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>C-Arm</td>
                      <td class="text-center">1</td>
                      <td>A-19 Saheed Nagar, maharishi college Cuttack, Odisha</td>
                      <td></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div> -->
  </div>
</div>

<script type="text/javascript">
  // Quantity JavaScript
  $(".increase-btn").on("click", function (e) {
  var $button = $(this);
  var oldValue = $button.parent().find('.quantity').val();
  $button.parent().find('.incr-btn[data-action="decrease"]').removeClass('inactive');
  if ($button.data('action') == "increase") {
  var newVal = parseFloat(oldValue) + 1;
  } else {
  // Don't allow decrementing below 1
  if (oldValue > 1) {
  var newVal = parseFloat(oldValue) - 1;
  } else {
  newVal = 1;
  $button.addClass('inactive');
  }
  }
  $button.parent().find('.quantity').val(newVal);
  e.preventDefault();
  });
</script>

@endsection