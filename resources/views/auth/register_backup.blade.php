  @extends('layouts.master_new')
  @section('title', 'register')
  @section('content')

<section class="registrationcontainer">
  <a class="homebtn" href="{{ url('/') }}"><i class="fa fa-home"></i></a>
  <div class="maincontainer">

    <div class="row">
      <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 col-lg-push-1 col-md-push-1">
          @if (session('success'))
          <div class="alert alert-success alert-dismissible">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              {{ session('success') }}
          </div>
          @endif
          @if (session('error'))
          <div class="alert alert-danger alert-dismissible">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              {{ session('error') }}
          </div>
          @endif
      </div>
    </div>

    <div class="row">
      <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 col-lg-push-1 col-md-push-1">
        <div class="wizard">
          <div class="wizard-inner">
            <ul class="nav nav-tabs nav-tabs-login" role="tablist">
              <li role="presentation" class="active">
                <a href="#Step01" data-toggle="tab" aria-controls="Step01" role="tab" title="" data-original-title="Operating Location">
                  <span class="round-tab">
                    <i></i>
                    <span class="tabtext">Operating Location</span>
                  </span>
                </a>
              </li>
              <li role="presentation" class="disabled">
                <a href="#Step02" data-toggle="tab" aria-controls="Step02" role="tab" title="" data-original-title="Equipment Deatails">
                  <span class="round-tab">
                    <i></i>
                    <span class="tabtext">Equipment Deatails</span>
                  </span>
                </a>
              </li>
              <li role="presentation" class="disabled">
                <a href="#Step03" data-toggle="tab" aria-controls="Step03" role="tab" title="" data-original-title="Select Services">
                  <span class="round-tab">
                    <i></i>
                    <span class="tabtext">Select Services</span>
                  </span>
                </a>
              </li>
              <li role="presentation" class="disabled">
                <a href="#Step04" data-toggle="tab" aria-controls="Step04" role="tab" title="" data-original-title="Get Quotes">
                  <span class="round-tab">
                    <i></i>
                    <span class="tabtext">Get Quotes</span>
                  </span>
                </a>
              </li>
            </ul>
          </div>
          <div class="wizardformouter">
            <form role="form" class="wizardform" action="{{ url('register') }}">
              <div class="tab-content">
                <div class="tab-pane active" role="tabpanel" id="Step01">
                  <div class="formtypebox">
                    <div class="row">
                      <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 col-lg-push-2 col-md-push-2">
                        <div class="form-group">
                          <label>Tell us your location</label>
                          <div class="groupinner">
                            <i class="fa fa-search"></i>
                            <input type="text" class="form-control" value="Shyambazar, Kolkata" name="">
                          </div>
                        </div>
                        <div class="checkpanel">
                          <div class="checklabel">Do you have branch Institute?</div>
                          <div class="checkyn">
                            <div class="switchToggle">
                              <input type="checkbox" id="switch" value="1">
                              <label for="switch">Toggle</label>
                            </div>
                          </div>
                        </div>
                        <div id="branch-div" style="display: none;">
                          <div class="form-group" id="showbranch">
                            <label>Branch</label>
                            <div class="groupinner">
                              <i class="fa fa-search"></i>
                              <input type="text" class="form-control" value="Lorem Ipsum" name="">
                            </div>
                          </div>
                          <div class="form-group text-center">
                            <a class="addmore" id="addbranch">Add more +</a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="formtypebtnbox">
                    <div class="formbtncontent">
                      <h5>Operating Location</h5>
                      <ol>
                        <li>Shyambazar, Kolkata</li>
                        <li>Saheed Nagar, Bhubneshwar</li>
                      </ol>
                    </div>
                    <div class="formtypebtngroup">
                      <button type="button" class="nextformbtn next-step-btn">Next</button>
                    </div>
                  </div>
                </div>
                <div class="tab-pane" role="tabpanel" id="Step02">
                  <div class="formtypebox">
                    <div class="row">
                      <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 equipmentb">
                        <div class="form-group">
                          <label>Find your equipment</label>
                          <div class="groupinner">
                            <i class="fa fa-search"></i>
                            <input type="text" class="form-control" value="" placeholder="Search by model name or make" name="">
                          </div>
                        </div>
                        <div class="form-group text-center">
                          <span class="or">Or</span>
                        </div>
                        <div class="equipmentscroll customscroll">
                          <div class="form-group">
                            <label>Select the equipment below</label>
                            <div class="groupinner">
                              <select class="form-control" name="equipment">
                                <option>Type of equipment</option>
                                <option>Lorem ipsum dolor sit amet</option>
                                <option>Nunc varius libero vitae pretium</option>
                                <option>Aliquam posuere tortor ac lobortis</option>
                              </select>
                            </div>
                            <div class="groupinner">
                              <select class="form-control" name="manufacturer">
                                <option>Manufacturer</option>
                                <option>Lorem ipsum dolor sit amet</option>
                                <option>Nunc varius libero vitae pretium</option>
                                <option>Aliquam posuere tortor ac lobortis</option>
                              </select>
                            </div>
                            <div class="groupinner">
                              <select class="form-control" name="model">
                                <option>Model Name</option>
                                <option>Lorem ipsum dolor sit amet</option>
                                <option>Nunc varius libero vitae pretium</option>
                                <option>Aliquam posuere tortor ac lobortis</option>
                              </select>
                            </div>
                            <div class="groupinner">
                              <select class="form-control" name="branch">
                                <option>Branch</option>
                                <option>Lorem ipsum dolor sit amet</option>
                                <option>Nunc varius libero vitae pretium</option>
                                <option>Aliquam posuere tortor ac lobortis</option>
                              </select>
                            </div>
                          </div>
                          <div class="form-group">
                            <label>Select the equipment below</label>
                            <div class="groupinner">
                              <select class="form-control">
                                <option>Type of equipment</option>
                                <option>Lorem ipsum dolor sit amet</option>
                                <option>Nunc varius libero vitae pretium</option>
                                <option>Aliquam posuere tortor ac lobortis</option>
                              </select>
                            </div>
                            <div class="groupinner">
                              <select class="form-control">
                                <option>Manufacturer</option>
                                <option>Lorem ipsum dolor sit amet</option>
                                <option>Nunc varius libero vitae pretium</option>
                                <option>Aliquam posuere tortor ac lobortis</option>
                              </select>
                            </div>
                            <div class="groupinner">
                              <select class="form-control">
                                <option>Model Name</option>
                                <option>Lorem ipsum dolor sit amet</option>
                                <option>Nunc varius libero vitae pretium</option>
                                <option>Aliquam posuere tortor ac lobortis</option>
                              </select>
                            </div>
                            <div class="groupinner">
                              <select class="form-control">
                                <option>Branch</option>
                                <option>Lorem ipsum dolor sit amet</option>
                                <option>Nunc varius libero vitae pretium</option>
                                <option>Aliquam posuere tortor ac lobortis</option>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="qtybox">
                          <div class="qtylabel">Number of equipment</div>
                          <div class="qtybuttons">
                            <div class="count-input">
                              <div class="input-group">
                                <a class="incr-btn input-group-addon" data-action="decrease" href="#">
                                  <i class="fa fa-minus"></i>
                                </a>
                                <input class="quantity form-control" type="text" name="quantity" value="1"/>
                                <a class="incr-btn input-group-addon" data-action="increase" href="#">
                                  <i class="fa fa-plus"></i>
                                </a>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="form-group text-center">
                          <a class="addmore" href="javascript:void();" id="add-equipment">Add +</a>
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 listequipmentb">
                        <div class="tableheading">
                          <label>List of the equipment added</label>
                        </div>
                        <div class="tablescroll customscroll">
                          <div class="equipmentbox">
                            <dl class="dl-horizontal">
                              <dt>Type of equipment:</dt>
                              <dd>Radiography(Fixed)</dd>
                              <dt>Manufacturer:</dt>
                              <dd>Skanray Technologies Pvt. Ltd.</dd>
                              <dt>Model Name:</dt>
                              <dd>SKAN DR 630i</dd>
                              <dt>Branch:</dt>
                              <dd>Shyambazar, Kolkata</dd>
                              <dt>Quality:</dt>
                              <dd>1 Nos</dd>
                            </dl>
                            <div class="actiongroup">
                              <a class="editbtn" href="javascript:void(0);"><i class="fa fa-pencil"></i></a>
                              <a class="trashbtn" href="javascript:void(0);">x</a>
                            </div>
                          </div>
                          <div class="equipmentbox">
                            <dl class="dl-horizontal">
                              <dt>Type of equipment:</dt>
                              <dd>C-Arm</dd>
                              <dt>Manufacturer:</dt>
                              <dd>Nil</dd>
                              <dt>Model Name:</dt>
                              <dd>Nil</dd>
                              <dt>Branch:</dt>
                              <dd>Saheed Nagar, Bhubaneswar</dd>
                              <dt>Quality:</dt>
                              <dd>2 Nos</dd>
                            </dl>
                            <div class="actiongroup">
                              <a class="editbtn" href="javascript:void(0);"><i class="fa fa-pencil"></i></a>
                              <a class="trashbtn" href="javascript:void(0);">x</a>
                            </div>
                          </div>
                          <div class="equipmentbox">
                            <dl class="dl-horizontal">
                              <dt>Type of equipment:</dt>
                              <dd>Computed Tomography</dd>
                              <dt>Manufacturer:</dt>
                              <dd>Nil</dd>
                              <dt>Model Name:</dt>
                              <dd>Nil</dd>
                              <dt>Branch:</dt>
                              <dd>Saheed Nagar, Bhubaneswar</dd>
                              <dt>Quality:</dt>
                              <dd>1 Nos</dd>
                            </dl>
                            <div class="actiongroup">
                              <a class="editbtn" href="javascript:void(0);"><i class="fa fa-pencil"></i></a>
                              <a class="trashbtn" href="javascript:void(0);">x</a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="formtypebtnbox">
                    <div class="formbtncontent">
                      <div class="row">
                        <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                          <h5>Operating Location</h5>
                          <ol>
                            <li>Shyambazar, Kolkata</li>
                            <li>Saheed Nagar, Bhubneshwar</li>
                          </ol>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                          <h5>Equipment Details</h5>
                          <ol>
                            <li>Radiology(Fixed), Kolkata</li>
                            <li>C-Arm, Bhubneshwar</li>
                          </ol>
                        </div>
                      </div>
                    </div>
                    <div class="formtypebtngroup">
                      <button type="button" class="nextformbtn next-step-btn">Next</button>
                    </div>
                  </div>
                </div>
                <div class="tab-pane" role="tabpanel" id="Step03">
                  <div class="formtypebox">
                    <div class="row">
                      <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 equipmentaddressoutercolumn">
                        <div class="tableheading">
                          <label>Select equipment for Service</label>
                        </div>
                        <div class="equipmentaddressouter customscroll">
                          <div class="equipmentbox equipmentaddress">
                            <input type="radio" checked="" id="Equipment" name="equipment">
                            <label for="Equipment" class="equipmentlabel">
                              <div class="active"><i class="fa fa-check"></i></div>
                              <dl class="dl-horizontal">
                                <dt>Type of equipment:</dt>
                                <dd>Radiography(Fixed)</dd>
                                <dt>Manufacturer:</dt>
                                <dd>Not given</dd>
                                <dt>Model Name:</dt>
                                <dd>Not given</dd>
                                <dt>Branch:</dt>
                                <dd>Shyambazar, Kolkata</dd>
                                <dt>Quality:</dt>
                                <dd>1 Nos</dd>
                              </dl>
                              <div class="requestbox">
                                <h5>Your Request so Far</h5>
                                <p>Quality Assurance(QA)</p>
                                <a class="trashbtn" href="javascript:void(0);">x</a>
                              </div>
                            </label>
                          </div>
                          <div class="equipmentbox equipmentaddress">
                            <input type="radio" id="Equipment2" name="equipment">
                            <label for="Equipment2" class="equipmentlabel">
                              <div class="active"><i class="fa fa-check"></i></div>
                              <dl class="dl-horizontal">
                                <dt>Type of equipment:</dt>
                                <dd>C-Arm</dd>
                                <dt>Manufacturer:</dt>
                                <dd>Philips India Limited</dd>
                                <dt>Model Name:</dt>
                                <dd>Zenition 50</dd>
                                <dt>Branch:</dt>
                                <dd>Shaheed Nagar, Bhubaneswar</dd>
                                <dt>Quality:</dt>
                                <dd>1 Nos</dd>
                              </dl>
                            </label>
                          </div>
                          <div class="equipmentbox equipmentaddress">
                            <input type="radio" id="Equipment3" name="equipment">
                            <label for="Equipment3" class="equipmentlabel">
                              <div class="active"><i class="fa fa-check"></i></div>
                              <dl class="dl-horizontal">
                                <dt>Type of equipment:</dt>
                                <dd>C-Arm</dd>
                                <dt>Manufacturer:</dt>
                                <dd>Philips India Limited</dd>
                                <dt>Model Name:</dt>
                                <dd>Zenition 50</dd>
                                <dt>Branch:</dt>
                                <dd>Shaheed Nagar, Bhubaneswar</dd>
                                <dt>Quality:</dt>
                                <dd>1 Nos</dd>
                              </dl>
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="tableheading">
                          <label>Services</label>
                        </div>
                        <div class="equipmentbox">
                          <div class="equipmentboxscroll customscroll">
                            <div class="checkbox">
                              <input type="checkbox" id="checkbox1" name="Services">
                              <label for="checkbox1">Quality Assurance(QA)</label>
                            </div>
                            <div class="checkbox">
                              <input type="checkbox" id="checkbox2" name="Services">
                              <label for="checkbox2">Repairing & Servicing</label>
                            </div>
                            <div class="checkbox">
                              <input type="checkbox" id="checkbox3" name="Services">
                              <label for="checkbox3">Maintenance</label>
                            </div>
                            <div class="checkbox">
                              <input type="checkbox" id="checkbox4" name="Services">
                              <label for="checkbox4">License for Operation</label>
                            </div>
                            <div class="checkbox">
                              <input type="checkbox" id="checkbox5" name="Services">
                              <label for="checkbox5">Decommissioning</label>
                            </div>
                            <div class="checkbox">
                              <input type="checkbox" id="checkbox6" name="Services">
                              <label for="checkbox6">Procurement</label>
                            </div>
                            <div class="checkbox">
                              <input type="checkbox" id="checkbox7" name="Services">
                              <label for="checkbox7">Lead Apron Test</label>
                            </div>
                            <div class="checkbox">
                              <input type="checkbox" id="checkbox8" name="Services">
                              <label for="checkbox8">Area Surveilance Test</label>
                            </div>
                            <div class="checkbox">
                              <input type="checkbox" id="checkbox9" name="Services">
                              <label for="checkbox9">Change in the Layout</label>
                            </div>
                            <div class="checkbox">
                              <input type="checkbox" id="checkbox10" name="Services">
                              <label for="checkbox10">TLD Badge Assistance</label>
                            </div>
                            <div class="checkbox">
                              <input type="checkbox" id="checkbox11" name="Services">
                              <label for="checkbox11">Room Layout</label>
                            </div>
                          </div>
                        </div>
                        <div class="eqicontent">
                          <p><a class="modala" href="javascript:void(0);" data-toggle="modal" data-target="#AnswerModal">Answer a few question to know what regulatory compliance you need and we will offer the services accordingly.</a></p>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="formtypebtnbox">
                    <div class="formbtncontent">
                      <div class="row">
                        <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                          <h5>Operating Location</h5>
                          <ol>
                            <li>Shyambazar, Kolkata</li>
                            <li>Saheed Nagar, Bhubneshwar</li>
                          </ol>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                          <h5>Equipment Details</h5>
                          <ol>
                            <li>Radiology(Fixed), Kolkata</li>
                            <li>C-Arm, Bhubneshwar</li>
                          </ol>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                          <h5>Service Selected</h5>
                          <ol>
                            <li>Radiology(Fixed), Kolkata Quality assurance(QA)</li>
                            <li>C-Arm, Bhubneshwar License for operation</li>
                          </ol>
                        </div>
                      </div>
                    </div>
                    <div class="formtypebtngroup">
                      <button type="button" class="nextformbtn next-step-btn">Next</button>
                    </div>
                  </div>
                </div>
                <div class="tab-pane" role="tabpanel" id="Step04">
                  <div class="formtypebox">
                    <div class="row">
                      <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 col-lg-push-3 col-md-push-3">
                        <div class="tableheading">
                          <label>Create Account</label>
                        </div>
                        <div class="form-group">
                          <div class="groupinner">
                            <input type="text" class="form-control" value="" placeholder="Contact Person name" name="">
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="groupinner">
                            <input type="text" class="form-control mobilenumber" value="" placeholder="Mobile number" name="">
                            <a class="otpsend" href="javascript:void(0);">Send OTP</a>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="groupinner">
                            <input type="text" class="form-control" value="" placeholder="Enter OTP" name="">
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="groupinner">
                            <input type="text" class="form-control" value="" placeholder="Email(optional)" name="">
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="groupinner">
                            <input type="text" class="form-control" value="" placeholder="Password" name="">
                          </div>
                        </div>
                        <div class="eqicontent">
                          <p>Password must be atleast 6 character</p>
                          <p>We will send you a text to verify your phone.</p>
                          <p>Already have an account? <a href="javascript:void(0);">Sign in</a></p>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="formtypebtnbox">
                    <div class="formbtncontent">
                      <div class="row">
                        <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                          <h5>Operating Location</h5>
                          <ol>
                            <li>Shyambazar, Kolkata</li>
                            <li>Saheed Nagar, Bhubneshwar</li>
                          </ol>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                          <h5>Equipment Details</h5>
                          <ol>
                            <li>Radiology(Fixed), Kolkata</li>
                            <li>C-Arm, Bhubneshwar</li>
                          </ol>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                          <h5>Service Selected</h5>
                          <ol>
                            <li>Radiology(Fixed), Kolkata Quality assurance(QA)</li>
                            <li>C-Arm, Bhubneshwar License for operation</li>
                          </ol>
                        </div>
                      </div>
                    </div>
                    <div class="formtypebtngroup">
                      <button type="button" class="nextformbtn next-step-btn">Next</button>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Modal -->
<div class="modal fade signuppoup signuppoup_reg" id="AnswerModal" tabindex="-1" role="dialog" aria-labelledby="AnswerModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <div class="row">
          <div class="col-xs-12">
            <div class="poupupheading poupupheading_modal">
              <p>Below are the some questionnaire, according to the response of client, the system will display/show the client what compliance he/she need to fulfil and also what services we offer to fulfill those compliances</p>
              <p>What kind of activity/action you are doing and/or about to do</p>

              <ol class="reg_upper_alpha">
                <li>Operating x-ray equipment</li>
                <li>Purchasing x-ray equipment</li>
                <li>Changing /moving the location/position of x-ray equipment</li>
                <li>Shutting down/closing the operation of x-ray equipment</li>
              </ol>
              <ol class="reg_upper_alpha reg_upper_alpha_first">
                <li>Question for “Regulatory Compliance for operating X-Ray Equipment”
                  <ol class="reg_number">
                <li>Tell us where your institute is located. (next Q-2)
                  <ol class="reg_lower_alpha">
                  <li>pincode/city/state/address</li>
                </ol>
                </li>
                <li>Do you have the branch institute? (if yes Q-3, if No Q-4)
                  <ol class="reg_lower_alpha">
                  <li>Yes</li>
                  <li>No</li>
                </ol>
                </li>
                <li>Tell us where your branch institute is located. (Next Q-4)
                  <ol class="reg_lower_alpha">
                  <li>pincode/city/state/address*</li>
                </ol>
                </li>
                <li>Is your institute accredited from NABH/NABL (next Q-5)
                  <ol class="reg_lower_alpha">
                  <li>Yes</li>
                  <li>No</li>
                </ol>
                </li>
                <li>Tell us a few details about the equipment you have.(Next Q-6)
                  <ol class="reg_lower_alpha">
                  <li>Type of equipment*</li>
                  <li>Branch where machine is operated*</li>
                  <li>Model name</li>
                  <li>Manufacturer</li>
                  <li>Serial number</li>
                </ol>
                </li>
                <li>Do you have a license for the operation of the following machines? (If Yes Q-7, If No Q-8)
                  <ol class="reg_lower_latter">
                  <li>Display the list of machines that he/she declared</li>
                </ol>
                  <ol class="reg_lower_alpha">
                  <li>Yes</li>
                  <li>No</li>
                </ol>
                </li>
                <li>Tell us a few details of the license you have for the following machines.(Next Q-09)
                  <ol class="reg_lower_alpha">
                  <li>Select the equipment for which you have the license for operation*</li>
                  <li>Issuance Date</li>
                  <li>Expiry Date</li>
                </ol>
                </li>
               <li>Do you have a Quality Assurance test report of the following machines? (If yes than Next Q-9 or Q-10)
                  <ol class="reg_lower_alpha">
                  <li>Yes</li>
                  <li>No </li>
                </ol>
                </li>
              <li>Tell us when last Quality Assurance test for the following machines were performed?(If Q-6=yes then jump to Q-15)
                  <ol class="reg_lower_alpha">
                  <li>Date of last QA Test performed or --months ago*</li>
                </ol>
               </li>
               <li>Do you have a room shielding layout for the following machines? (Next Q-11)
                  <ol class="reg_lower_alpha">
                  <li>Yes</li>
                  <li>No</li>
                </ol>
               </li>
               <li>Tell us a few details about your staff working in the Radiology department (e.g. X-Ray technician/Radiologist) (Next Q-13)</li>
               <li>Do you have the TLD Badges for these Radiation workers? (Next Q-14)
                <ol class="reg_lower_latter">
                  <li>Display the list of Radiation Worker</li>
                </ol>
                  <ol class="reg_lower_alpha">
                  <li>Yes</li>
                  <li>No</li>
                </ol>
               </li>
               <li>Do you have these radiation protection Accessories/Instruments? (Next Q-15)
                <ol class="reg_lower_latter">
                  <li>List of the instrument mandatory to have</li>
                </ol>
                  <ol class="reg_lower_alpha">
                  <li>Yes</li>
                  <li>No</li>
                </ol>
               </li>
               <li>Have you done recently any servicing of the following machines?
                <ol class="reg_lower_alpha">
                  <li>Yes</li>
                  <li>No</li>
                </ol>
               </li>
            </ol>
                </li>
                <li>Purchasing X-Ray Equipment
                  <ol class="reg_number">
                <li>Tell a few details of the equipment you are buying
                  <ol class="reg_lower_alpha">
                    <li>I am purchasing the New equipment/Pre-owned equipment</li>
                    <li>For New machine
                      <ol class="reg_lower_latter">
                      <li>What Type of equipment you are about to buy?*
                        <ol class="reg_number">
                          <li>Radiography (fixed)</li>
                          <li>Radiography (mobile)</li>
                          <li>Radiography (portable)</li>
                          <li>Radiography & Fluoroscopy</li>
                          <li>C-Arm</li>
                          <li>6.O-Arm</li>
                          <li>Interventional Radiology</li>
                          <li>Computed Tomography (CT-Scan)</li>
                          <li>Mammography</li>
                          <li>Dental Cone Beam CT</li>
                          <li>Ortho Pantomography (OPG)</li>
                          <li>Dental (Intra Oral)</li>
                          <li>Dental (Hand Held)</li>
                          <li>Bone Densitometer (BMD)</li>
                        </ol>
                      </li>
                      <li>Do you have room Layout*
                        <ol class="reg_number">
                          <li>Yes</li>
                          <li>No</li>
                        </ol>
                      </li>
                      <li>Do you have a Copy of authenticated QA report from the earlier user*
                        <ol class="reg_number">
                          <li>Yes</li>
                          <li>No</li>
                        </ol>
                      </li>
                    </ol>
                    </li>
                  </ol>
                </li>
             </ol>
                </li>
                <li>Change in Layout
                  <ol class="reg_number">
                  <li>Select the equipment for which layout is to be change</li>
                  <li>What type of changes are you supposed to do
                    <ol class="reg_lower_alpha">
                      <li>Layout modification in an existing facility</li>
                      <li>Repositioning of equipment</li>
                      <li>Relocation of equipment</li>
                    </ol>
                  </li>
                </ol>
                </li>
                <li>Decommissioning of X-Ray Equipment
                  <ol class="reg_number">
                  <li>Which of the following equipment do you want to decommission
                    <ol class="reg_lower_alpha">
                      <li>List of the equipment</li>
                    </ol>
                  </li>
                </ol>
                </li>
              </ol>

          </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

@endsection
