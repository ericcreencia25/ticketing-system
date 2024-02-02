@extends('layouts.login')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
          @if(session()->get('success'))
                    <div class="alert alert-success alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                      <h4><i class="icon fa fa-check"></i> Sent!</h4>
                      Thank you!
                      <br>
                    </div>
                    @endif
            <div class="card">
                <div class="card-header">
                  <h4>2023 Client Satisfaction Survey</h4>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('/send-survey') }}">
                      @csrf
                        <div class="row">
                          <div class="col-12">
                            <div class="form-group">
                              <label for="name">1. Name: (Optional)</label>
                              <input id="name" type="text" class="form-control" placeholder="Enter your answer" name="name" >
                            </div>
                          </div>

                          <div class="col-12">
                            <div class="form-group">
                              <label for="position-designation">2. Position/Designation: (Optional)</label>
                              <input id="position-designation" type="text" class="form-control" placeholder="Enter your answer" name="position-designation" >
                            </div>
                          </div>

                          <div class="col-12">
                            <div class="form-group">
                              <label for="educational-attainment">3. Highest Educational Attainment: <span style="color: red">*</span></label>
                              @error('educational-attainment')
                                  <p class="text-red">{{ $message }}</p>
                              @enderror
                              <select id="educational-attainment" name="educational-attainment"  class="form-control select2bs4" required>
                                <option selected="" disabled="" value="">Select one</option>
                                <option value="Elementary Graduate">Elementary Graduate</option>
                                <option value="High School Graduate">High School Graduate</option>
                                <option value="Technical/Vocational Graduate">Technical/Vocational Graduate</option>
                                <option value="College Graduate">College Graduate</option>
                                <option value="Graduate Studies">Graduate Studies</option>
                              </select>
                            </div>
                          </div>

                          <div class="col-12">
                            <div class="form-group">
                              <label for="company-name">4. Company Name: (Optional)</label>
                              <input id="company-name" type="text" class="form-control" placeholder="Enter your answer" name="company-name" >
                            </div>
                          </div>

                          <div class="col-12">
                            <div class="form-group">
                              <label for="type-of-industry">5. Type of Industry: <span style="color: red">*</span> </label>
                              @error('type-of-industry')
                                  <p class="text-red">{{ $message }}</p>
                              @enderror
                              <select id="type-of-industry" name="type-of-industry"  class="form-control select2bs4" required>
                                <option selected="" disabled="" value="">Select one</option>
                                <option value="Aerospace Industry">Aerospace Industry</option>
                                <option value="Agriculture Industry">Agriculture Industry</option>
                                <option value="Construction Industry">Construction Industry</option>
                                <option value="Computer Industry">Computer Industry</option>
                                <option value="Education Industry">Education Industry</option>s
                                <option value="Entertainment Industry">Entertainment Industry</option>
                                <option value="Energy Industry">Energy Industry</option>
                                <option value="Electronics Industry">Electronics Industry</option>
                                <option value="Food Industry">Food Industry</option>
                                <option value="Health Care Industry">Health Care Industry</option>
                                <option value="Hospitality Industry">Hospitality Industry</option>
                                <option value="Mining Industry">Mining Industry</option>
                                <option value="Music Industry">Music Industry</option>
                                <option value="Manufacturing Industry">Manufacturing Industry</option>
                                <option value="News Media Industry">News Media Industry</option>
                                <option value="Pharmaceutical Industry">Pharmaceutical Industry</option>
                                <option value="Transport Industry">Transport Industry</option>
                                <option value="Telecommunication Industry">Telecommunication Industry</option>
                                <option value="Worldwide web">Worldwide web</option>
                                <option value="Environmental Laboratory Industry">Environmental Laboratory Industry</option>
                                <option value="Government Industry">Government Industry</option>
                              </select>
                            </div>
                          </div>

                          <div class="col-12">
                            <div class="form-group">
                              <label for="location">6. Location/Office: (Place of transaction) <span style="color: red">*</span></label>
                              @error('location')
                                  <p class="text-red">{{ $message }}</p>
                              @enderror
                              <select id="location" name="location"  class="form-control custom-select" required>
                                      <option selected="" disabled="" value="">Select one</option>
                                      <option value="Central Office">Central Office</option>
                                      <option value="Cordillera Administrative Region">Cordillera Administrative Region</option>
                                      <option value="National Capital Region">National Capital Region</option>
                                      <option value="Region 1">Region 1</option>
                                      <option value="Region 2">Region 2</option>
                                      <option value="Region 3">Region 3</option>
                                      <option value="Region 4A (Calabarzon)">Region 4A (Calabarzon)</option>
                                      <option value="Region 4B (Mimaropa)">Region 4B (Mimaropa)</option>
                                      <option value="Region 5">Region 5</option>
                                      <option value="Region 6">Region 6</option>
                                      <option value="Region 7">Region 7</option>
                                      <option value="Region 8">Region 8</option>
                                      <option value="Region 9">Region 9</option>
                                      <option value="Region 10">Region 10</option>
                                      <option value="Region 11">Region 11</option>
                                      <option value="Region 12">Region 12</option>
                                      <option value="Region 13">Region 13</option>
                                  </select>
                            </div>
                          </div>

                          <div class="col-12">
                            <div class="form-group">
                              <label for="location">7. Gender: <span style="color: red">*</span> </label>
                              @error('gender')
                                  <p class="text-red">{{ $message }}</p>
                              @enderror
                              <div class="row"> 
                                <div class="col-md-3">
                                  <div class="icheck-primary d-inline">
                                    <input type="radio" id="gender-male" name="gender" value="Male">
                                    <label for="gender-male"></label>
                                    Male
                                  </div>
                                </div>
                                <div class="col-md-3">
                                  <div class="icheck-primary d-inline">
                                    <input type="radio" id="gender-female" name="gender" value="Female">
                                    <label for="gender-female"></label>
                                    Female
                                  </div>
                                </div>
                                <div class="col-md-3">
                                  <div class="icheck-primary d-inline">
                                    <input type="radio" id="gender-lgbtq" name="gender" value="LGBTQ">
                                    <label for="gender-lgbtq"></label>
                                    LGBTQ++
                                  </div>
                                </div>
                                <div class="col-md-3">
                                  <div class="icheck-primary d-inline">
                                    <input type="radio" id="gender-no" name="gender" value="Prefer not to say">
                                    <label for="gender-no"></label>
                                    Prefer not to say
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>



                          <div class="col-12">
                            <div class="form-group">
                              <label for="location">8. Please select the type of Permit / Clearance / Certificate / Service secured from EMB: <span style="color: red">*</span></label>
                              @error('permit-type')
                                  <p class="text-red">{{ $message }}</p>
                              @enderror
                              <select id="permit-type" name="permit-type"  class="form-control select2bs4" required>
                                      <option selected="" disabled="" value="">Select one</option>
                                      <option>Certificate of Conformity (COC)</option>
                                      <option>3rd Party Testing Firms Accreditation</option>
                                      <option>Certification of Equipment used for Vehicular Emission Testing</option>
                                      <option>Priority Chemical List (PCL) Certificate</option>
                                      <option>Priority Chemical List (PCL) Exemption</option>
                                      <option>Pre-Manufacturing Pre-Importation Notification (PMPIN) Certification</option>
                                      <option>Polymer Exemption</option>
                                      <option>Chemical Control Order (CCO) for Lead Registration Certificate</option>
                                      <option>Chemical Control Order (CCO) for Lead Importation Clearance</option>
                                      <option>Chemical Control Order (CCO) for Arsenic (Registration Certificate)</option>
                                      <option>Chemical Control Order (CCO) for Arsenic (Importation Clearance)</option>
                                      <option>Chemical Control Order (CCO) for Sodium Cyanide (Clearance of Importation)</option>
                                      <option>Chemical Control Order (CCO) for Cadmium and Cadmium Compounds (Registration Certificate)</option>
                                      <option>Chemical Control Order (CCO) for Cadmium and Cadmium Compounds (Importation Clearance)</option>
                                      <option>Chemical Control Order (CCO) for Chromium VI Compounds (Registration Certificate)</option>
                                      <option>Chemical Control Order (CCO) for Chromium VI Compounds (Importation Clearance)</option>
                                      <option>Certificate of Registration (COR) of ODS</option>
                                      <option>Pre-Shipment Importation Clearance (PSIC) for Ozone Depleting Substances and its Alternative</option>
                                      <option>Treatment, Storage and Disposal (TSD) Registration</option>
                                      <option>Issuance of Registration Certificate for Treatment, Storage and Disposal (TSD) Facility through https://hwms.emb.gov.ph</option>
                                      <option>Issuance of Registration Certificate for HW Transporter</option>
                                      <option>Importer of Recyclables Materials Containing Hazardous Substances Registration</option>
                                      <option>Importer of Recyclables Materials Containing Hazardous Substances Registration through https://opms.emb.gov.ph</option>
                                      <option>Importation Clearance for Recyclable Material Containing Hazardous Substances</option>
                                      <option>Application for Importation Clearance for Recyclable Materials Containing Hazardous Substance through https://opms.emb.gov.oh</option>
                                      <option>Export Clearance - Transmittal of Notification</option>
                                      <option>Export Clearance</option>
                                      <option>Recognition as Training Organization / Institution for Pollution Control Officer (PCOs) - Basic Training</option>
                                      <option>Recognition as Training Organization / Institution for Pollution Control Officer (PCOs) - Advance Training</option>
                                      <option>Environmental Laboratory Recognition</option>
                                      <option>Laboratory Process</option>
                                      <option>Environmental Compliance Certificate</option>
                                      <option>Environmental Compliance Certificate (Catergory B)</option>
                                      <option>Action of Pollution Complaint (NBR)</option>
                                      <option>Certificate of Non-Coverage (Category C)</option>
                                      <option>Certificate of Non-Coverage (Category D / Prior to 1982 Projects)</option>
                                      <option>Chemical Control Order (CCO) Importation Clearance (CHEM)</option>
                                      <option>Application for Philippine Inventory of Chemicals Substance (PICC)</option>
                                      <option>Application for Chemical Control Order (CCO) - Polychlorinated Biphenyl (PCB) - Online Application</option>
                                      <option>Chemical Control Order (CCO) Registration for Mercury, Cyanide, Asbestos, ODS & PCBs</option>
                                      <option>Evaluation of Ten (10) - Year Solid Waste Management Plan</option>
                                      <option>Hazardous Waste Generator Registration (HAZ)</option>
                                      <option>Hazardous Waste Transport Manifest Form</option>
                                      <option>Issuance of Order of Payment and Official Receipt</option>
                                      <option>Notice of Proceed for Dismantling of Asbestos-Containing Materials</option>
                                      <option>Permit to Operate Air Pollution Sources and Corresponding Air Pollution Control Facilities (New) (AIR)</option>
                                      <option>Permit to Operate Air Pollution Sources and Corresponding Air Pollution Control Facilities (Renewal)</option>
                                      <option>Permit to Transport (PTT)</option>
                                      <option>Document Authentication</option>
                                      <option>Pollution Control Officer (PCO) Accreditation (Renewal)</option>
                                      <option>Request for Information, Official Receipt/Documents</option>
                                      <option>Small Quantity Importation (SQI) Clearance</option>
                                      <option>Submission of Self-Monitoring Reports and Compliance</option>
                                      <option>Wastewater Discharge Permit (New)</option>
                                      <option>Wastewater Discharge Permit (Renewal)</option>
                                  </select>


                            </div>
                          </div>


                          <div class="col-12">
                            <label for="location">9. Please check the box on the level of your satisfaction on the following items: <span style="color: red">*</span></label>
                            <table class="table table-bordered">
                              <tbody>
                                <tr>
                                  <td></td>
                                  <td>Very Satisfied</td>
                                  <td>Satisfied</td>
                                  <td>Neither Satisfied or Dissatisfied</td>
                                  <td>Dissatisfied</td>
                                  <td>Very Dissatisfied</td>
                                </tr>
                                <tr>
                                  <td>Responsiveness (The willingness to help, assist, and provide prompt service to citizens/clients) 
                                    @error('first-row')
                                          <p class="text-red">Rating this is a must.</p>
                                    @enderror
                                  </td>
                                  <td>
                                    <center>
                                      <div class="icheck-primary d-inline">
                                        <input type="radio" id="first-first-col" name="first-row" value="5">
                                        <label for="first-first-col"></label>
                                      </div>
                                    </center>
                                  </td>
                                  <td>
                                    <center>
                                      <div class="icheck-primary d-inline">
                                        <input type="radio" id="first-second-col" name="first-row" value="4">
                                        <label for="first-second-col"></label>
                                      </div>
                                    </center>
                                  </td>
                                  <td>
                                    <center>
                                      <div class="icheck-primary d-inline">
                                        <input type="radio" id="first-third-col" name="first-row" value="3">
                                        <label for="first-third-col"></label>
                                      </div>
                                    </center>
                                  </td>
                                  <td>
                                    <center>
                                      <div class="icheck-primary d-inline">
                                        <input type="radio" id="first-fourth-row" name="first-row" value="2">
                                        <label for="first-fourth-row"></label>
                                      </div>
                                    </center>
                                  </td>
                                  <td>
                                    <center>
                                      <div class="icheck-primary d-inline">
                                        <input type="radio" id="first-fifth-row" name="first-row" value="1">
                                        <label for="first-fifth-row"></label>
                                      </div>
                                    </center>
                                  </td>
                                </tr>
                                <tr>
                                  <td>Reliability (the provision of what is needed and what was promised, following the policy and standards, with zero to a minimal error rate)
                                    @error('second-row')
                                          <p class="text-red">Rating this is a must.</p>
                                    @enderror
                                  </td>
                                  <td>
                                    <center>
                                      <div class="icheck-primary d-inline">
                                        <input type="radio" id="second-first-col" name="second-row" value="5">
                                        <label for="second-first-col"></label>
                                      </div>
                                    </center>
                                  </td>
                                  <td>
                                    <center>
                                      <div class="icheck-primary d-inline">
                                        <input type="radio" id="second-second-col" name="second-row" value="4">
                                        <label for="second-second-col"></label>
                                      </div>
                                    </center>
                                  </td>
                                  <td>
                                    <center>
                                      <div class="icheck-primary d-inline">
                                        <input type="radio" id="second-third-col" name="second-row" value="3">
                                        <label for="second-third-col"></label>
                                      </div>
                                    </center>
                                  </td>
                                  <td>
                                    <center>
                                      <div class="icheck-primary d-inline">
                                        <input type="radio" id="second-fourth-row" name="second-row" value="2">
                                        <label for="second-fourth-row"></label>
                                      </div>
                                    </center>
                                  </td>
                                  <td>
                                    <center>
                                      <div class="icheck-primary d-inline">
                                        <input type="radio" id="second-fifth-row" name="second-row" value="1">
                                        <label for="second-fifth-row"></label>
                                      </div>
                                    </center>
                                  </td>
                                </tr>
                                <tr>
                                  <td>Access & Facilities including Online Platforms (The convenience of location, ample amenities for comfortable transactions, use of clear signages and modes of technology) @error('third-row')
                                          <p class="text-red">Rating this is a must.</p>
                                    @enderror
                                  </td>
                                  <td>
                                    <center>
                                      <div class="icheck-primary d-inline">
                                        <input type="radio" id="third-first-col" name="third-row" value="5">
                                        <label for="third-first-col"></label>
                                      </div>
                                    </center>
                                  </td>
                                  <td>
                                    <center>
                                      <div class="icheck-primary d-inline">
                                        <input type="radio" id="third-second-col" name="third-row" value="4">
                                        <label for="third-second-col"></label>
                                      </div>
                                    </center>
                                  </td>
                                  <td>
                                    <center>
                                      <div class="icheck-primary d-inline">
                                        <input type="radio" id="third-third-col" name="third-row" value="3">
                                        <label for="third-third-col"></label>
                                      </div>
                                    </center>
                                  </td>
                                  <td>
                                    <center>
                                      <div class="icheck-primary d-inline">
                                        <input type="radio" id="third-fourth-row" name="third-row" value="2">
                                        <label for="third-fourth-row"></label>
                                      </div>
                                    </center>
                                  </td>
                                  <td>
                                    <center>
                                      <div class="icheck-primary d-inline">
                                        <input type="radio" id="third-fifth-row" name="third-row" value="1">
                                        <label for="third-fifth-row"></label>
                                      </div>
                                    </center>
                                  </td>
                                </tr>
                                <tr>
                                  <td>Communication (The act of keeping citizens and clients informed in a language they can easily understand, as well as listening to their feedback)
                                    @error('fourth-row')
                                          <p class="text-red">Rating this is a must.</p>
                                    @enderror
                                  </td>
                                  <td>
                                    <center>
                                      <div class="icheck-primary d-inline">
                                        <input type="radio" id="fourth-first-col" name="fourth-row" value="5">
                                        <label for="fourth-first-col"></label>
                                      </div>
                                    </center>
                                  </td>
                                  <td>
                                    <center>
                                      <div class="icheck-primary d-inline">
                                        <input type="radio" id="fourth-second-col" name="fourth-row" value="4">
                                        <label for="fourth-second-col"></label>
                                      </div>
                                    </center>
                                  </td>
                                  <td>
                                    <center>
                                      <div class="icheck-primary d-inline">
                                        <input type="radio" id="fourth-third-col" name="fourth-row" value="3">
                                        <label for="fourth-third-col"></label>
                                      </div>
                                    </center>
                                  </td>
                                  <td>
                                    <center>
                                      <div class="icheck-primary d-inline">
                                        <input type="radio" id="fourth-fourth-row" name="fourth-row" value="2">
                                        <label for="fourth-fourth-row"></label>
                                      </div>
                                    </center>
                                  </td>
                                  <td>
                                    <center>
                                      <div class="icheck-primary d-inline">
                                        <input type="radio" id="fourth-fifth-row" name="fourth-row" value="1">
                                        <label for="fourth-fifth-row"></label>
                                      </div>
                                    </center>
                                  </td>
                                </tr>
                                <tr>
                                  <td>Costs (The satisfacition with timeliness of the billing, billing process/es, preferred methods of payment, reasonable payment period, value for money, the acceptable range of costs, and qualitative information on the cost of each service.) 
                                    @error('fifth-row')
                                          <p class="text-red">Rating this is a must.</p>
                                    @enderror
                                  </td>
                                  <td>
                                    <center>
                                      <div class="icheck-primary d-inline">
                                        <input type="radio" id="fifth-first-col" name="fifth-row" value="5">
                                        <label for="fifth-first-col"></label>
                                      </div>
                                    </center>
                                  </td>
                                  <td>
                                    <center>
                                      <div class="icheck-primary d-inline">
                                        <input type="radio" id="fifth-second-col" name="fifth-row" value="4">
                                        <label for="fifth-second-col"></label>
                                      </div>
                                    </center>
                                  </td>
                                  <td>
                                    <center>
                                      <div class="icheck-primary d-inline">
                                        <input type="radio" id="fifth-third-col" name="fifth-row" value="3">
                                        <label for="fifth-third-col"></label>
                                      </div>
                                    </center>
                                  </td>
                                  <td>
                                    <center>
                                      <div class="icheck-primary d-inline">
                                        <input type="radio" id="fifth-fourth-row" name="fifth-row" value="2">
                                        <label for="fifth-fourth-row"></label>
                                      </div>
                                    </center>
                                  </td>
                                  <td>
                                    <center>
                                      <div class="icheck-primary d-inline">
                                        <input type="radio" id="fifth-fifth-row" name="fifth-row" value="1">
                                        <label for="fifth-fifth-row"></label>
                                      </div>
                                    </center>
                                  </td>
                                </tr>
                                <tr>
                                  <td>Integrity (The assurance that there is honesty, justice, fairness, and trust in each service while dealing with the citizens/clients.) 
                                    @error('sixth-row')
                                          <p class="text-red">Rating this is a must.</p>
                                    @enderror
                                  </td>
                                  <td>
                                    <center>
                                      <div class="icheck-primary d-inline">
                                        <input type="radio" id="sixth-first-col" name="sixth-row" value="5">
                                        <label for="sixth-first-col"></label>
                                      </div>
                                    </center>
                                  </td>
                                  <td>
                                    <center>
                                      <div class="icheck-primary d-inline">
                                        <input type="radio" id="sixth-second-col" name="sixth-row" value="4">
                                        <label for="sixth-second-col"></label>
                                      </div>
                                    </center>
                                  </td>
                                  <td>
                                    <center>
                                      <div class="icheck-primary d-inline">
                                        <input type="radio" id="sixth-third-col" name="sixth-row" value="3">
                                        <label for="sixth-third-col"></label>
                                      </div>
                                    </center>
                                  </td>
                                  <td>
                                    <center>
                                      <div class="icheck-primary d-inline">
                                        <input type="radio" id="sixth-fourth-row" name="sixth-row" value="2">
                                        <label for="sixth-fourth-row"></label>
                                      </div>
                                    </center>
                                  </td>
                                  <td>
                                    <center>
                                      <div class="icheck-primary d-inline">
                                        <input type="radio" id="sixth-fifth-row" name="sixth-row" value="1">
                                        <label for="sixth-fifth-row"></label>
                                      </div>
                                    </center>
                                  </td>
                                </tr>
                                <tr>
                                  <td>Assurance (The capability of frontline staff to perform their duties, product and service knowledge, understanding citizen/client needs, helpfulness, and good work relationships)
                                    @error('seventh-row')
                                          <p class="text-red">Rating this is a must.</p>
                                    @enderror
                                  </td>
                                  <td>
                                    <center>
                                      <div class="icheck-primary d-inline">
                                        <input type="radio" id="seventh-first-col" name="seventh-row" value="5">
                                        <label for="seventh-first-col"></label>
                                      </div>
                                    </center>
                                  </td>
                                  <td>
                                    <center>
                                      <div class="icheck-primary d-inline">
                                        <input type="radio" id="seventh-second-col" name="seventh-row" value="4">
                                        <label for="seventh-second-col"></label>
                                      </div>
                                    </center>
                                  </td>
                                  <td>
                                    <center>
                                      <div class="icheck-primary d-inline">
                                        <input type="radio" id="seventh-third-col" name="seventh-row" value="3">
                                        <label for="seventh-third-col"></label>
                                      </div>
                                    </center>
                                  </td>
                                  <td>
                                    <center>
                                      <div class="icheck-primary d-inline">
                                        <input type="radio" id="seventh-fourth-row" name="seventh-row" value="2">
                                        <label for="seventh-fourth-row"></label>
                                      </div>
                                    </center>
                                  </td>
                                  <td>
                                    <center>
                                      <div class="icheck-primary d-inline">
                                        <input type="radio" id="seventh-fifth-row" name="seventh-row" value="1">
                                        <label for="seventh-fifth-row"></label>
                                      </div>
                                    </center>
                                  </td>
                                </tr>
                                <tr>
                                  <td>Outcome (The extent of achieving outcomes or realizing the intended benefits of government services)
                                    @error('eight-row')
                                          <p class="text-red">Rating this is a must.</p>
                                    @enderror
                                  </td>
                                  <td>
                                    <center>
                                      <div class="icheck-primary d-inline">
                                        <input type="radio" id="eight-first-col" name="eight-row" value="5">
                                        <label for="eight-first-col"></label>
                                      </div>
                                    </center>
                                  </td>
                                  <td>
                                    <center>
                                      <div class="icheck-primary d-inline">
                                        <input type="radio" id="eight-second-col" name="eight-row" value="4">
                                        <label for="eight-second-col"></label>
                                      </div>
                                    </center>
                                  </td>
                                  <td>
                                    <center>
                                      <div class="icheck-primary d-inline">
                                        <input type="radio" id="eight-third-col" name="eight-row" value="3">
                                        <label for="eight-third-col"></label>
                                      </div>
                                    </center>
                                  </td>
                                  <td>
                                    <center>
                                      <div class="icheck-primary d-inline">
                                        <input type="radio" id="eight-fourth-row" name="eight-row" value="2">
                                        <label for="eight-fourth-row"></label>
                                      </div>
                                    </center>
                                  </td>
                                  <td>
                                    <center>
                                      <div class="icheck-primary d-inline">
                                        <input type="radio" id="eight-fifth-row" name="eight-row" value="1">
                                        <label for="eight-fifth-row"></label>
                                      </div>
                                    </center>
                                  </td>
                                </tr>

                              </tbody>
                            </table>

                          </div>

                          <div class="col-12">
                            <div class="form-group">
                              <label for="suggestions">10. Do you have any suggestion/s to further improve our service?</label>
                              <input id="suggestions" type="text" class="form-control" placeholder="Enter your answer" name="suggestions" >
                            </div>
                          </div>

                          <div class="col-12">
                                {!! NoCaptcha::renderJs() !!}
                                {!! NoCaptcha::display() !!}

                                @error('g-recaptcha-response')
                                  <p class="text-red">{{ $message }}</p>
                                @enderror
                              </div>

                          <div class="col-12">
                            <div class="form-group">
                              <button type="submit" class="btn btn-success" id="submit">Submit</button>
                            </div>
                          </div>
                              

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



<script src="../../AdminLTE-3.2.0/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../AdminLTE-3.2.0/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<!-- <script src="../../AdminLTE-3.2.0/dist/js/demo.js"></script> -->
<script src="../../AdminLTE-3.2.0/plugins/sweetalert2/sweetalert2.min.js"></script>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
<script src="https://kit.fontawesome.com/0e706b6aa8.js" crossorigin="anonymous"></script>
<!-- dropzonejs -->
<script src="../../AdminLTE-3.2.0/plugins/dropzone/min/dropzone.min.js"></script>

<!-- Select2 -->
<script src="../../AdminLTE-3.2.0/plugins/select2/js/select2.full.min.js"></script>

<script src="https://www.google.com/recaptcha/api.js?render=6LdFlVopAAAAAGsNwyWp54ML8GK46Yrg1VbUtMs3" async defer></script>


<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    });

    // $("#submit").on("click", function() {
    //   var name = $("#name").val();
    //   var positiondesignation = $("#position-designation").val();
    //   var educationalattainment = $("#educational-attainment").val();
    //   var companyname = $("#company-name").val();
    //   var typeofindustry = $("#type-of-industry").val();
    //   var location = $("#location").val();
    //   var gender = $("input[type='radio'][name='gender']:checked").val();
    //   var permittype = $("#permit-type").val();
    //   var responsiveness = $("input[type='radio'][name='first-row']:checked").val();
    //   var reliability = $("input[type='radio'][name='second-row']:checked").val();
    //   var accessfacilities = $("input[type='radio'][name='third-row']:checked").val();
    //   var communication = $("input[type='radio'][name='fourth-row']:checked").val();
    //   var costs = $("input[type='radio'][name='fifth-row']:checked").val();
    //   var integrity = $("input[type='radio'][name='sixth-row']:checked").val();
    //   var assurance = $("input[type='radio'][name='seventh-row']:checked").val();
    //   var outcome = $("input[type='radio'][name='eight-row']:checked").val();
    //   var suggestion = $("#suggestion").val();


    //   const arr_error = [];
    //   const satisfaction_error = [];

    //   if(educationalattainment == null) {
    //     $("#educational-attainment-error").removeAttr('hidden');

    //     arr_error.push(3);
    //   } else {
    //     $("#educational-attainment-error").attr('hidden', 'hidden');
    //   }
    //   console.log(typeofindustry);
    //   if(typeofindustry == null) {
    //     $("#type-of-industry-error").removeAttr('hidden');

    //     arr_error.push(5);
    //   } else {
    //     $("#type-of-industry-error").attr('hidden', 'hidden');
    //   }

    //   if(location == null) {
    //     $("#location-error").removeAttr('hidden');

    //     arr_error.push(6);
    //   } else {
    //     $("#location-error").attr('hidden', 'hidden');
    //   }

    //   if(gender == null) {
    //     $("#gender-error").removeAttr('hidden');

    //     arr_error.push(7);
    //   } else {
    //     $("#gender-error").attr('hidden', 'hidden');
    //   }

    //   if(permittype == null) {
    //     $("#permit-type-error").removeAttr('hidden');

    //     arr_error.push(8);
    //   } else {
    //     $("#permit-type-error").attr('hidden', 'hidden');
    //   }

    //   if(responsiveness == null) {
    //     satisfaction_error.push(1);
    //   }

    //   if(reliability == null) {
    //     satisfaction_error.push(2);
    //   }

    //   if(accessfacilities == null) {
    //     satisfaction_error.push(3);
    //   }

    //   if(communication == null) {
    //     satisfaction_error.push(4);
    //   }

    //   if(costs == null) {
    //     satisfaction_error.push(5);
    //   }

    //   if(integrity == null) {
    //     satisfaction_error.push(6);
    //   }

    //   if(assurance == null) {
    //     satisfaction_error.push(7);
    //   }

    //   if(outcome == null) {
    //     satisfaction_error.push(8);
    //   }

    //   console.log(satisfaction_error);
    //   if(satisfaction_error.length > 0) {
    //     $("#satisfaction-error").removeAttr('hidden');

    //     arr_error.push(9);
    //   } else {
    //     $("#satisfaction-error").attr('hidden', 'hidden');
    //   }

    //   if(arr_error.length == 0 ) {

    //     $.ajax({
    //       url: "{{route('/send-survey')}}",
    //       type: 'POST',
    //       data: {
    //         name : name,
    //         positiondesignation : positiondesignation,
    //         educationalattainment : educationalattainment,
    //         companyname : companyname,
    //         typeofindustry : typeofindustry,
    //         location : location,
    //         gender : gender,
    //         permittype : permittype,
    //         responsiveness : responsiveness,
    //         reliability : reliability,
    //         accessfacilities : accessfacilities,
    //         communication : communication,
    //         costs : costs,
    //         integrity : integrity,
    //         assurance : assurance,
    //         outcome : outcome,
    //         suggestion : suggestion,
    //         _token: '{{csrf_token()}}',
    //       },
    //       beforeSend: function () {

    //         // $('.loading-overlay').show();
    //         // $('.loading-overlay-image-container').show();
    //       },
    //       complete: function () {

    //         // $('.loading-overlay').hide();
    //         // $('.loading-overlay-image-container').hide();

    //       },
    //       success: function (response) {

    //         Swal.fire({
    //             position: "center",
    //             icon: "success",
    //             title: "Sent! Thank you",
    //             showConfirmButton: false,
    //             timer: 5500,
    //             timerProgressBar: true,
    //             didOpen: (toast) => {
    //               toast.addEventListener('mouseenter', Swal.stopTimer)
    //               toast.addEventListener('mouseleave', Swal.resumeTimer)
    //             },
    //             didClose: (toast) => {
    //               location.reload();
    //             }
    //         });
    //       }

    //     });

    //   }

          

    // });


  });
  
</script>

@endsection
