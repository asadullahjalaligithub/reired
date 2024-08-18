<?php
// SELECT application.application_Invoice_no AS invoice_no,invoice.invoice_date AS invoice_date,point_of_contact.poc_id AS poc_id,point_of_contact.poc_firstname AS poc_firstname,point_of_contact.poc_lastname AS poc_lastname,application.application_TVACcharges AS application_TVACcharges,application.application_embassycharges AS application_embassycharges,application.application_feestatus AS application_feestatus,application.application_enterby AS application_enterby,application.application_receivedConsulateBy AS recievedby,application.application_sentConsulateBy AS sentby,application.application_deliveredBy AS deliveredby from 
//  application inner join point_of_contact on point_of_contact.poc_id = application.application_poc_id 
//  inner join invoice on application.application_Invoice_no = invoice.invoice_no group by invoice.invoice_no

?>

Lorem ipsum dolor sit amet, consectetur adipisicing elit. Neque cum minima quis autem, velit omnis nobis? Totam, eos
vitae dolore similique quo, praesentium eveniet dolorem consectetur ut, distinctio esse cumque.
<!--
<div class="card card-design">
     <div class="card-header applicant-title">
         <h4 align="left">New Applicant</h4>
     </div>
     <ul class="list-group list-group-flush">
         <form>
             <li class="list-group-item">
                 <div class="row">
                     <div class="form-group col-lg-6"><input type="hidden" name="applicantid"> <input type="search" class="form-control" placeholder="SearchBasedOnPassportNumber" name="applicantsearchbox" onkeyup="searchApplicant(this.form,event)"> </div>
                 </div>
                 <div class="row">
                     <div class="form-group col-lg-3"> <input type="text" class="form-control" placeholder="FirstName" name="firstname"> </div>
                     <div class="form-group col-lg-3"> <input type="text" class="form-control" placeholder="LastName" name="lastname"> </div>
                     <div class="form-group col-lg-3"> <input type="text" class="form-control" placeholder="Phone" name="phone"> </div>
                     <div class="form-group col-lg-3"> <input type="text" class="form-control" placeholder="PassportNo" name="passportno"> </div>
                 </div>
                 <div class="row">
                     <div class="form-group col-lg-3"> <label for="zone">Zone</label> <select class="form-control" id="zone" name="zone" onchange="loadProvince(this.form)">
                             <option value="201">kabul</option>
                             <option value="202">herat</option>
                             <option value="203">kandahar</option>
                             <option value="204">Mazare-sharif</option>
                         </select> </div>
                     <div class="form-group col-lg-3"> <label for="province">Province</label> <select class="form-control" id="province" name="province">
                             <option value="01">kabul</option>
                             <option value="20">khost</option>
                             <option value="21">kunar</option>
                             <option value="22">Laghman</option>
                             <option value="23">Logar</option>
                             <option value="24">Nangarhar</option>
                             <option value="25">Nuristan</option>
                             <option value="26">Paktia</option>
                             <option value="27">Paktika</option>
                             <option value="28">Panjshir</option>
                             <option value="29">Parwan</option>
                             <option value="30">Wardak</option>
                             <option value="31">Bameyan</option>
                             <option value="32">Daikundi</option>
                             <option value="33">Ghazni</option>
                             <option value="34">Kapisa</option>
                         </select> </div>
                     <div class="form-group col-lg-3"> <label for="dob">Date of Birth</label> <input type="date" id="dob" class="form-control" name="dateofbirth"> </div>
                     <div class="form-group col-lg-3"> <label for="passporttype">PassportType</label> <select class="form-control" id="passporttype" name="passporttype">
                             <option value="single">Special</option>
                             <option value="Ordinary">Ordinary</option>
                             <option value="Service">Service</option>
                             <option value="Student">Student</option>
                             <option value="UN Blue">UN Blue</option>
                             <option value="Business">Business</option>
                         </select> </div>
                 </div>
                 <div class="row">
                     <div class="form-group col-lg-3"> <input type="text" class="form-control" placeholder="Occupation" name="occupation"> </div>
                     <div class="form-group col-lg-3"> <input type="text" class="form-control" placeholder="Relation" name="relation"> </div>
                     <div class="form-group col-lg-3"> <label for="male">Male</label> <input type="radio" checked name="gender" value="male" id="male"> <label for="female">Female</label> <input type="radio" name="gender" value="female" id="female"> </div>
                 </div>
                 <div class="row">
                     <div class="form-group col-lg-3"> </div>
                     <div class="form-group col-lg-12 buttons"> <input type="button" name="newbutton" class="btn btn-primary" onclick="newDataApplicant(this.form)" value="New"> <input type="button" name="savebutton" class="btn btn-primary" value="save" onclick="insertDataApplicant(this.form)"> <input disabled type="button" class="btn btn-primary" onclick="updateDataApplicant(this.form)" name="updatebutton" value="update"> <input type="button" class="btn btn-primary" disabled value="Select" name="selectbutton" onclick="selectApplicant(this.form)"> </div>
                 </div>
             </li>
             <li class="list-group-item application-title">
                 <h5>Application</h5>
             </li>
             <li class="list-group-item">
                 <div class="row">
                     <div class="form-group col-lg-9" style="text-align: right;"> <input class="btn btn-primary" name="saveapplication" type="button" value="Send To Cashier" disabled onclick="insertApplication(this.form)"> </div>
                 </div>
                 <div class="row">
                     <div class="form-group col-lg-3"> <label for="embassy">Embassy Charges</label> <select class="form-control" id="embassy" name="embassycharges">
                             <option value="60">60</option>
                             <option value="120">120</option>
                             <option value="200">200</option>
                             <option value="190">190</option>
                             <option value="0">0</option>
                         </select> </div>
                     <div class="form-group col-lg-3"> <label for="tvac">TVAC Charges</label> <select class="form-control" id="tvac" name="tvaccharges">
                             <option value="30">30</option>
                             <option value="50">50</option>
                             <option value="0">0</option>
                         </select> </div>
                     <div class="form-group col-lg-3"> <label for="type">Visa Type</label> <select class="form-control" id="type" name="visatype">
                             <option value="Tourstic">Touristic</option>
                             <option value="Business">Business</option>
                             <option value="Student / Education">Student / Education</option>
                             <option value="Medical / Treatment">Medical / Treatment</option>
                             <option value="Work">Work</option>
                             <option value="Transit">Transit</option>
                             <option value="Conference / Seminar">Conference / Semeinar</option>
                             <option value="Training">Training</option>
                             <option value="Official Medical">Official Medical</option>
                             <option value="Turkey ScholarShip Student">Turkey Scholarship Student</option>
                             <option value="Some Special Meetings / Visit">Some Special Meetings / Visit</option>
                             <option value="Other Scholarship Situation">Other Scholarship Situation</option>
                         </select> </div>
                     <div class="form-group col-lg-3"> <label for="entrytype">Entry Type</label> <select class="form-control" id="entrytype" name="entrytype">
                             <option value="Single Entry"> Single Entry</option>
                             <option value="Double Entry">Double Entry</option>
                             <option value="Transit">Transit</option>
                             <option value="Double Transit">Double Transit</option>
                         </select> </div>
                 </div>
             </li>
         </form>
     </ul>
 </div>'
-->

<!-- old one 
<div class="card card-design"> <div class="card-header applicant-title"> <h4>Applicant</h4> </div> <ul class="list-group list-group-flush"> <form> <li class="list-group-item"> <div class="row"> <div class="form-group col-lg-6"><input type="hidden" name="applicantid"> <input type="search" class="form-control" placeholder="SearchBasedOnPassportNumber" name="applicantsearchbox" onkeyup="searchApplicant(this.form,event)"> </div> </div> <div class="row"> <div class="form-group col-lg-3"> <input type="text" class="form-control" placeholder="FirstName" name="firstname"> </div> <div class="form-group col-lg-3"> <input type="text" class="form-control" placeholder="LastName" name="lastname"> </div> <div class="form-group col-lg-3"> <input type="text" class="form-control" placeholder="Phone" name="phone"> </div> <div class="form-group col-lg-3"> <input type="text" class="form-control" placeholder="PassportNo" name="passportno"> </div> </div> <div class="row"> <div class="form-group col-lg-3"> <label for="zone">Zone</label> <select class="form-control" id="zone" name="zone" onchange="loadProvince(this.form)"> <option value="201">kabul</option> <option value="202">herat</option> <option value="203">kandahar</option> <option value="204">Mazare-sharif</option> <option value="205">Other</option> </select> </div> <div class="form-group col-lg-3"> <label for="province">Province</label> <select class="form-control" id="province" name="province"> <option value="01">kabul</option> <option value="20">khost</option> <option value="21">kunar</option> <option value="22">Laghman</option> <option value="23">Logar</option> <option value="24">Nangarhar</option> <option value="25">Nuristan</option> <option value="26">Paktia</option> <option value="27">Paktika</option> <option value="28">Panjshir</option> <option value="29">Parwan</option> <option value="30">Wardak</option> <option value="31">Bameyan</option> <option value="32">Daikundi</option> <option value="33">Ghazni</option> <option value="34">Kapisa</option> </select> </div> <div class="form-group col-lg-3"> <label for="dob">Date of Birth</label> <input type="date" id="dob" class="form-control" name="dateofbirth"> </div> <div class="form-group col-lg-3"> <label for="passporttype">PassportType</label> <select class="form-control" id="passporttype" name="passporttype"> <option value="Special">Special</option> <option value="Ordinary">Ordinary</option> <option value="Service">Service</option> <option value="Student">Student</option> <option value="UN Blue">UN Blue</option> <option value="Business">Business</option> </select> </div> </div> <div class="row"> <div class="form-group col-lg-3"> <select class="form-control" placeholder="Occupation" name="occupation" id="occupation"> <option value="Agriculture">Agriculture</option> <option value="Armed/Security Force">Armed/Security Force</option> <option value="Artist/Performer">Artis/Performer</option> <option value="Business">Business</option> <option value="Caregiver and Babysitter">Caregiver and Babysitter</option> <option value="Construction">Construction</option> <option value="Culinary/Cookery">Culinary/Cookery</option> <option value="Driver/Lorry">Driver/Lorry</option> <option value="Education and Training">Education and Training</option> <option value="Engineer">Engineer</option> <option value="Finance and Banking">Finance and Banking</option> <option value="Governament">Governament</option> <option value="Health/Medical">Health/Medical</option> <option value="Information Technology">Information Technology</option> <option value="Legal Professional">Legal Professional</option> <option value="Press/Media">Press/Media</option> <option value="Professional Sportsperson">Professional Sportsperson</option> <option value="Religious Functionary">Religious Functionary</option> <option value="Researcher/Scienctist">Researcher/Scienctist</option> <option value="Retired">Retired</option> <option value="Seafarer">Seafarer</option> <option value="Self-Employed">Self-Employed</option> <option value="Service Sector">Service Sector</option> <option value="Student/Trainee">Student/Trainee</option> <option value="Tourism">Tourism</option> <option value="Unemployed">Unemployed</option> <option value="Other">Other</option> </select> </div> <div class="form-group col-lg-3"> <input type="text" class="form-control" placeholder="Relation" name="relation"> </div> <div class="form-group col-lg-3"> <label for="male">Male</label> <input type="radio" checked name="gender" value="male" id="male"> <label for="female">Female</label> <input type="radio" name="gender" value="female" id="female"> </div> <div class="form-group col-lg-3"> <input type="text" class="form-control" placeholder="Father Name" name="fathername"> </div> </div> <div class="row"> <div class="form-group col-lg-3"> <input type="text" class="form-control" placeholder="Mother Name" name="mothername"> </div> </div> <div class="row"> <div class="form-group col-lg-3"> </div> <div class="form-group col-lg-12 buttons"> <input type="button" name="newbutton" class="btn btn-primary" onclick="newDataApplicant(this.form)" value="New"> <input type="button" name="savebutton" class="btn btn-primary" value="save" onclick="insertDataApplicant(this.form)"> <input disabled type="button" class="btn btn-primary" onclick="updateDataApplicant(this.form)" name="updatebutton" value="update"> <input type="button" class="btn btn-primary" disabled value="Select" name="selectbutton" onclick="selectApplicant(this.form)"> </div> </div> </li> <li class="list-group-item application-title"> <h5>Application</h5> </li> <li class="list-group-item"> <div class="row"> <div class="form-group col-lg-3"> <input type="text" class="form-control" name="applicationreferenceno" placeholder="ApplicationReferenceNO"> </div> <div class="form-group col-lg-9" style="text-align: right;"> <input class="btn btn-primary" name="saveapplication" type="button" value="Send To Cashier" disabled onclick="insertApplication(this.form)"> </div> </div> <div class="row"> <div class="form-group col-lg-3"> <label for="embassy">Embassy Charges</label> <select class="form-control" id="embassy" name="embassycharges"> <option value="60">60</option> <option value="120">120</option> <option value="200">200</option> <option value="190">190</option> <option value="0">0</option> </select> </div> <div class="form-group col-lg-3"> <label for="tvac">TVAC Charges</label> <select class="form-control" id="tvac" name="tvaccharges"> <option value="50">50</option> <option value="80">80</option> <option value="0">0</option> </select> </div> <div class="form-group col-lg-3"> <label for="type">Visa Type</label> <select class="form-control" id="type" name="visatype"> <option value="Touristic">Touristic</option> <option value="Business">Business</option> <option value="Student / Education">Student / Education</option> <option value="Medical / Treatment">Medical / Treatment</option> <option value="Work">Work</option> <option value="Transit">Transit</option> <option value="Conference / Seminar">Conference / Semeinar</option> <option value="Training">Training</option> <option value="Official Medical">Official Medical</option> <option value="Turkey ScholarShip Student">Turkey Scholarship Student</option> <option value="Some Special Meetings / Visit">Some Special Meetings / Visit</option> <option value="Festival/Fare/Exhibition Visa">Festival/Fare/Exhibition Visa</option> <option value="Sportive Activity Visa">Sportive Activity Visa</option> <option value="Cultural Artist Activity Visa">Cultural Artist Activity Visa</option>  <option value="Other Scholarship Situation">Other Scholarship Situation</option> </select> </div> <div class="form-group col-lg-3"> <label for="entrytype">Entry Type</label> <select class="form-control" id="entrytype" name="entrytype"> <option value="Single Entry"> Single Entry</option> <option value="Multiple Entry">Multiple Entry</option> <option value="Transit">Transit</option> <option value="Double Transit">Double Transit</option> </select> </div> </div> </li> </form> </ul> </div>
-->


<div class="card card-design">
    <div class="card-header applicant-title">
        <h4>Applicant</h4>
    </div>
    <ul class="list-group list-group-flush">
        <form>
            <li class="list-group-item">
                <div class="row">
                    <div class="form-group col-lg-6"><input type="hidden" name="applicantid"> <input type="search"
                            class="form-control" placeholder="SearchBasedOnPassportNumber" name="applicantsearchbox"
                            onkeyup="searchApplicant(this.form,event)"> </div>
                </div>
                <div class="row">
                    <div class="form-group col-lg-3"> <input type="text" class="form-control" placeholder="FirstName"
                            name="firstname"> </div>
                    <div class="form-group col-lg-3"> <input type="text" class="form-control" placeholder="LastName"
                            name="lastname"> </div>
                    <div class="form-group col-lg-3"> <input type="text" class="form-control" placeholder="Phone"
                            name="phone"> </div>
                    <div class="form-group col-lg-3"> <input type="text" class="form-control" placeholder="PassportNo"
                            name="passportno"> </div>
                </div>
                <div class="row">
                    <div class="form-group col-lg-3"> <label for="zone">Zone</label> <select class="form-control"
                            id="zone" name="zone" onchange="loadProvince(this.form)">
                            <option value="201">kabul</option>
                            <option value="202">herat</option>
                            <option value="203">kandahar</option>
                            <option value="204">Mazare-sharif</option>
                            <option value="205">Other</option>
                        </select> </div>
                    <div class="form-group col-lg-3"> <label for="province">Province</label> <select
                            class="form-control" id="province" name="province">
                            <option value="01">kabul</option>
                            <option value="20">khost</option>
                            <option value="21">kunar</option>
                            <option value="22">Laghman</option>
                            <option value="23">Logar</option>
                            <option value="24">Nangarhar</option>
                            <option value="25">Nuristan</option>
                            <option value="26">Paktia</option>
                            <option value="27">Paktika</option>
                            <option value="28">Panjshir</option>
                            <option value="29">Parwan</option>
                            <option value="30">Wardak</option>
                            <option value="31">Bameyan</option>
                            <option value="32">Daikundi</option>
                            <option value="33">Ghazni</option>
                            <option value="34">Kapisa</option>
                        </select> </div>
                    <div class="form-group col-lg-3"> <label for="dob">Date of Birth</label> <input type="date" id="dob"
                            class="form-control" name="dateofbirth"> </div>
                    <div class="form-group col-lg-3"> <label for="passporttype">PassportType</label> <select
                            class="form-control" id="passporttype" name="passporttype">
                            <option value="Special">Special</option>
                            <option value="Ordinary">Ordinary</option>
                            <option value="Service">Service</option>
                            <option value="Student">Student</option>
                            <option value="UN Blue">UN Blue</option>
                            <option value="Business">Business</option>
                        </select> </div>
                </div>
                <div class="row">
                    <div class="form-group col-lg-3"> <select class="form-control" placeholder="Occupation"
                            name="occupation" id="occupation">
                            <option value="Agriculture">Agriculture</option>
                            <option value="Armed/Security Force">Armed/Security Force</option>
                            <option value="Artist/Performer">Artis/Performer</option>
                            <option value="Business">Business</option>
                            <option value="Caregiver and Babysitter">Caregiver and Babysitter</option>
                            <option value="Construction">Construction</option>
                            <option value="Culinary/Cookery">Culinary/Cookery</option>
                            <option value="Driver/Lorry">Driver/Lorry</option>
                            <option value="Education and Training">Education and Training</option>
                            <option value="Engineer">Engineer</option>
                            <option value="Finance and Banking">Finance and Banking</option>
                            <option value="Governament">Governament</option>
                            <option value="Health/Medical">Health/Medical</option>
                            <option value="Information Technology">Information Technology</option>
                            <option value="Legal Professional">Legal Professional</option>
                            <option value="Press/Media">Press/Media</option>
                            <option value="Professional Sportsperson">Professional Sportsperson</option>
                            <option value="Religious Functionary">Religious Functionary</option>
                            <option value="Researcher/Scienctist">Researcher/Scienctist</option>
                            <option value="Retired">Retired</option>
                            <option value="Seafarer">Seafarer</option>
                            <option value="Self-Employed">Self-Employed</option>
                            <option value="Service Sector">Service Sector</option>
                            <option value="Student/Trainee">Student/Trainee</option>
                            <option value="Tourism">Tourism</option>
                            <option value="Unemployed">Unemployed</option>
                            <option value="Other">Other</option>
                        </select> </div>
                    <div class="form-group col-lg-3"> <input type="text" class="form-control" placeholder="Relation"
                            name="relation"> </div>
                    <div class="form-group col-lg-3"> <label for="male">Male</label> <input type="radio" checked
                            name="gender" value="male" id="male"> <label for="female">Female</label> <input type="radio"
                            name="gender" value="female" id="female"> </div>
                    <div class="form-group col-lg-3"> <input type="text" class="form-control" placeholder="Father Name"
                            name="fathername"> </div>
                </div>
                <div class="row">
                    <div class="form-group col-lg-3"> <input type="text" class="form-control" placeholder="Mother Name"
                            name="mothername"> </div>
                </div>
                <div class="row">
                    <div class="form-group col-lg-3"> </div>
                    <div class="form-group col-lg-12 buttons"> <input type="button" name="newbutton"
                            class="btn btn-primary" onclick="newDataApplicant(this.form)" value="New"> <input
                            type="button" name="savebutton" class="btn btn-primary" value="save"
                            onclick="insertDataApplicant(this.form)"> <input disabled type="button"
                            class="btn btn-primary" onclick="updateDataApplicant(this.form)" name="updatebutton"
                            value="update"> <input type="button" class="btn btn-primary" disabled value="Select"
                            name="selectbutton" onclick="selectApplicant(this.form)"> </div>
                </div>
            </li>
            <li class="list-group-item application-title">
                <h5>Application</h5>
            </li>
            <li class="list-group-item">
                <div class="row">
                    <div class="form-group col-lg-3"> <input type="text" class="form-control"
                            name="applicationreferenceno" placeholder="ApplicationReferenceNO"> </div>
                    <div class="form-group col-lg-9" style="text-align: right;"> <input class="btn btn-primary"
                            name="saveapplication" type="button" value="Send To Cashier" disabled
                            onclick="insertApplication(this.form)"> </div>
                </div>
                <div class="row">
                    <div class="form-group col-lg-3"> <label for="embassy">Embassy Charges</label><input type="text"
                            id="embassy" class="form-control" name="embassycharges"> </div>
                    <div class="form-group col-lg-3"> <label for="tvac">TVAC Charges</label> <input type="text"
                            class="form-control" id="tvac" name="tvaccharges"> </div>
                    <div class="form-group col-lg-3"> <label for="type">Visa Type</label> <select class="form-control"
                            id="type" name="visatype">
                            <option value="Touristic">Touristic</option>
                            <option value="Business">Business</option>
                            <option value="Student / Education">Student / Education</option>
                            <option value="Medical / Treatment">Medical / Treatment</option>
                            <option value="Work">Work</option>
                            <option value="Transit">Transit</option>
                            <option value="Conference / Seminar">Conference / Semeinar</option>
                            <option value="Training">Training</option>
                            <option value="Official Medical">Official Medical</option>
                            <option value="Turkey ScholarShip Student">Turkey Scholarship Student</option>
                            <option value="Some Special Meetings / Visit">Some Special Meetings / Visit</option>
                            <option value="Festival/Fare/Exhibition Visa">Festival/Fare/Exhibition Visa</option>
                            <option value="Sportive Activity Visa">Sportive Activity Visa</option>
                            <option value="Cultural Artist Activity Visa">Cultural Artist Activity Visa</option>
                            <option value="Other Scholarship Situation">Other Scholarship Situation</option>
                        </select> </div>
                    <div class="form-group col-lg-3"> <label for="entrytype">Entry Type</label> <select
                            class="form-control" id="entrytype" name="entrytype">
                            <option value="Single Entry"> Single Entry</option>
                            <option value="Multiple Entry">Multiple Entry</option>
                            <option value="Transit">Transit</option>
                            <option value="Double Transit">Double Transit</option>
                        </select> </div>
                </div>
            </li>
        </form>
    </ul>
</div>