
<x-layouts>


    <div class="bg-bgMain w-full p-7">
          <form>  
        <div class="flex flex-col sm:flex-row items-center justify-between">
    
            <div>
                <h1 class="text-4xl py-4">LC Dashboard</h1>
            </div>
            <div class="flex items-center justify-center">
                <div class=" relative form-floating  ">
                    <input type="date"
                    name="datestart"
                    placeholder="SELECT A DATE" 
                    value="{{isset($_GET['datestart']) ? $_GET['datestart'] : ''}}"
                    />

                </div>
                <p class="px-2">- </p>
                <div class=" relative form-floating  ">
                    <input type="date"
                    name="dateend"
                    placeholder="SELECT A DATE" 
                    value="{{isset($_GET['dateend']) ? $_GET['dateend'] : ''}}"
                    />

                </div>
                
            </div>
            
            <!--<div class="flex flex-row items-center text-lg py-2 ">-->
            <!--    <p class="px-2 font-bold {{$datestart || $dateend || $getSalesOfficer || $getLeadCapture || $getCountry ? 'block' : 'hidden'}}">Search: </p>-->
            <!--    <p class="px-2  text-sm italic {{$datestart && $dateend ? 'block' : 'hidden'}}">-->
            <!--        {{$datestart && $dateend ? '"' : "" }}-->
            <!--            {{$datestart}} - {{$dateend}}-->
            <!--        {{!$rawSales && !$getLeadCapture && !$getCountry ? '"': ""}}-->
            <!--    </p>-->
            <!--    <p class="px-2  text-sm italic">-->
            <!--        {{!$datestart && !$dateend && $rawSales ? '"' : ""}}-->
            <!--            {{$rawSales}}-->
            <!--        {{!$getLeadCapture && $rawSales && !$getCountry ? '"' : ""}}-->
            <!--    </p>-->
            <!--    <p class="px-2  text-sm italic">-->
            <!--        {{!$datestart && !$dateend && !$rawSales && $getLeadCapture && !$getCountry? '"' : ""}}-->
            <!--        {{!$datestart && !$dateend && !$rawSales && $getLeadCapture && $getCountry? '"' : ""}}-->
            <!--            {{ $getLeadCapture}}-->
            <!--        {{ $datestart && $dateend && $getLeadCapture && !$getCountry ? '"' : ""}}{{!$datestart && !$dateend && $rawSales && $getLeadCapture && !$getCountry ? '"' : ""}}{{!$datestart && !$dateend && !$rawSales && $getLeadCapture && !$getCountry ? '"' : ""}}-->
            <!--    </p>-->
            <!--    <p class="px-2  text-sm italic">-->
            <!--        {{!$datestart && !$dateend && !$rawSales && !$getLeadCapture && $getCountry ? '"' : ""}}-->
            <!--            {{ $getCountry}}-->
            <!--        {{ $datestart && $dateend && $getCountry ? '"' : ""}}-->
            <!--        {{!$datestart && !$dateend && $rawSales && !$getLeadCapture && $getCountry ? '"' : ""}}-->
            <!--        {{!$datestart && !$dateend && !$rawSales && $getLeadCapture && $getCountry ? '"' : ""}}-->
            <!--        {{!$datestart && !$dateend && $rawSales && $getLeadCapture && $getCountry ? '"' : ""}}-->
            <!--        {{!$datestart && !$dateend && !$rawSales && !$getLeadCapture && $getCountry ? '"' : ""}}-->
            <!--    </p>-->
            <!--</div>-->
        </div>

        
            <div class="flex flex-col lg:justify-between  py-4">
                
            <div class="flex flex-row lg:justify-between lg:items-center py-4 ">
            <div class="pr-2 hidden lg:flex justify-evenly items-center w-full">
                <p class="lg:pr-4 py-[4px]  font-bold">Inquiry</p>
              
                <select name="inquirytype" id="inquirytype" onchange="getText(this)" class="border px-4 py-2 w-full border-gray-600">
                         @php $ref = (isset($_GET['inquirytype'])) ? $_GET['inquirytype'] : ''; @endphp
                    <option value="" @if( $ref == "" ) selected @endif>All</option>
                    @foreach ($inquiryTypes as $list)
                        <option value="{{$list->itID}}" @if( $ref == $list->itID ) selected @endif>
                            {{$list->itName}}
                        </option>
                        
                    @endforeach
                </select>
            </div>
        
            <div class="px-2 hidden lg:flex justify-evenly items-center w-full">
                <p class="lg:px-4 py-[4px]  font-bold">Sales Officer</p>
              
                <select name="salesofficer" id="salesofficer" onchange="getText(this)" class="border px-4 py-2 w-full border-gray-600">
                         @php $ref = (isset($_GET['salesofficer'])) ? $_GET['salesofficer'] : ''; @endphp
                    <option value="" @if( $ref == "" ) selected @endif>All</option>
                    @foreach ($salesofficer as $list)
                        <option value="{{$list->id}}" @if( $ref == $list->id ) selected @endif>
                            {{$list->firstName . ' ' . $list->lastName}}
                        </option>
                        
                    @endforeach
                </select>
            </div>

            <div class="flex flex-col lg:flex-row justify-evenly lg:items-center py-[2px] w-full p-2">
                <p class="lg:px-4 py-[4px] font-bold">Lead Capture</p>
                <select name="leadcapture" id="leadcapture" class="border px-4 py-2 w-full border-gray-600">
                    @php $ref = (isset($_GET['leadcapture'])) ? $_GET['leadcapture'] : ''; @endphp
                    <option value="" @if( $ref == "") selected @endif>All</option>
                    @foreach ($leadcapture as $list)
                        <option value="{{$list->leadsourceID}}" @if( $ref == $list->leadsourceID ) selected @endif>{{$list->leadSourceName}}</option>
                        
                    @endforeach
            
                </select>
            </div>
            <div class="flex flex-col lg:flex-row justify-evenly lg:items-center py-[2px] w-full p-2">
                <p class="lg:px-4 py-[4px]  font-bold ">country Reside</p>
                <select  id="countryReside" name="countryReside" class="border px-4 py-2 w-full border-gray-600">
                    @php $ref = (isset($_GET['countryReside'])) ? $_GET['countryReside'] : ''; @endphp
                    <option value="" @if( $ref == "" ) selected @endif >Select</option>
                    <option value="Unknown" @if( $ref == "Unknown" ) selected @endif>Unknown</option>
                    <option value="Afghanistan" @if( $ref == "Afghanistan" ) selected @endif>Afghanistan</option>
                    <option value="Åland Islands" @if( $ref == "Åland Islands" ) selected @endif>Åland Islands</option>
                    <option value="Albania" @if( $ref == "Albania" ) selected @endif>Albania</option>
                    <option value="Algeria" @if( $ref == "Algeria" ) selected @endif>Algeria</option>
                    <option value="American Samoa" @if( $ref == "American Samoa" ) selected @endif>American Samoa</option>
                    <option value="Andorra" @if( $ref == "Andorra" ) selected @endif>Andorra</option>
                    <option value="Angola" @if( $ref == "Angola" ) selected @endif>Angola</option>
                    <option value="Anguilla" @if( $ref == "Anguilla" ) selected @endif>Anguilla</option>
                    <option value="Antarctica" @if( $ref == "Antarctica" ) selected @endif>Antarctica</option>
                    <option value="Antigua and Barbuda" @if( $ref == "Antigua and Barbuda" ) selected @endif>Antigua and Barbuda</option>
                    <option value="Argentina" @if( $ref == "Argentina" ) selected @endif>Argentina</option>
                    <option value="Armenia" @if( $ref == "Armenia" ) selected @endif>Armenia</option>
                    <option value="Aruba" @if( $ref == "Aruba" ) selected @endif>Aruba</option>
                    <option value="Australia" @if( $ref == "Australia" ) selected @endif>Australia</option>
                    <option value="Austria" @if( $ref == "Austria" ) selected @endif>Austria</option>
                    <option value="Azerbaijan" @if( $ref == "Azerbaijan" ) selected @endif>Azerbaijan</option>
                    <option value="Bahamas" @if( $ref == "Bahamas" ) selected @endif>Bahamas</option>
                    <option value="Bahrain" @if( $ref == "Bahrain" ) selected @endif>Bahrain</option>
                    <option value="Bangladesh" @if( $ref == "Bangladesh" ) selected @endif>Bangladesh</option>
                    <option value="Barbados" @if( $ref == "Barbados" ) selected @endif>Barbados</option>
                    <option value="Belarus" @if( $ref == "Belarus" ) selected @endif>Belarus</option>
                    <option value="Belgium" @if( $ref == "Belgium" ) selected @endif>Belgium</option>
                    <option value="Belize" @if( $ref == "Belize" ) selected @endif>Belize</option>
                    <option value="Benin" @if( $ref == "Benin" ) selected @endif>Benin</option>
                    <option value="Bermuda" @if( $ref == "Bermuda" ) selected @endif>Bermuda</option>
                    <option value="Bhutan" @if( $ref == "Bhutan" ) selected @endif>Bhutan</option>
                    <option value="Bolivia" @if( $ref == "Bolivia" ) selected @endif>Bolivia</option>
                    <option value="Bosnia and Herzegovina" @if( $ref == "Bosnia and Herzegovina" ) selected @endif>Bosnia and Herzegovina</option>
                    <option value="Botswana" @if( $ref == "Botswana" ) selected @endif>Botswana</option>
                    <option value="Bouvet Island" @if( $ref == "Bouvet Island" ) selected @endif>Bouvet Island</option>
                    <option value="Brazil" @if( $ref == "Brazil" ) selected @endif>Brazil</option>
                    <option value="British Indian Ocean Territory" @if( $ref == "British Indian Ocean Territory" ) selected @endif>British Indian Ocean Territory</option>
                    <option value="Brunei Darussalam" @if( $ref == "Brunei Darussalam" ) selected @endif>Brunei Darussalam</option>
                    <option value="Bulgaria" @if( $ref == "Bulgaria" ) selected @endif>Bulgaria</option>
                    <option value="Burkina Faso" @if( $ref == "Burkina Faso" ) selected @endif>Burkina Faso</option>
                    <option value="Burundi" @if( $ref == "Burundi" ) selected @endif>Burundi</option>
                    <option value="Cambodia" @if( $ref == "Cambodia" ) selected @endif>Cambodia</option>
                    <option value="Cameroon" @if( $ref == "Cameroon" ) selected @endif>Cameroon</option>
                    <option value="Canada" @if( $ref == "Canada" ) selected @endif>Canada</option>
                    <option value="Cape Verde" @if( $ref == "Cape Verde" ) selected @endif>Cape Verde</option>
                    <option value="Cayman Islands" @if( $ref == "Cayman Islands" ) selected @endif>Cayman Islands</option>
                    <option value="Central African Republic" @if( $ref == "Central African Republic" ) selected @endif>Central African Republic</option>
                    <option value="Chad" @if( $ref == "Chad" ) selected @endif>Chad</option>
                    <option value="Chile" @if( $ref == "Chile" ) selected @endif>Chile</option>
                    <option value="China" @if( $ref == "China" ) selected @endif>China</option>
                    <option value="Christmas Island" @if( $ref == "Christmas Island" ) selected @endif>Christmas Island</option>
                    <option value="Cocos (Keeling) Islands" @if( $ref == "Cocos (Keeling) Islands" ) selected @endif>Cocos (Keeling) Islands</option>
                    <option value="Colombia" @if( $ref == "Colombia" ) selected @endif>Colombia</option>
                    <option value="Comoros" @if( $ref == "Comoros" ) selected @endif>Comoros</option>
                    <option value="Congo" @if( $ref == "Congo" ) selected @endif>Congo</option>
                    <option value="Congo, The Democratic Republic of The" @if( $ref == "Congo, The Democratic Republic of The" ) selected @endif>Congo, The Democratic Republic of The</option>
                    <option value="Cook Islands" @if( $ref == "Cook Islands" ) selected @endif>Cook Islands</option>
                    <option value="Costa Rica" @if( $ref == "Costa Rica" ) selected @endif>Costa Rica</option>
                    <option value="Cote D'ivoire" @if( $ref == "Cote D'ivoire" ) selected @endif>Cote D'ivoire</option>
                    <option value="Croatia" @if( $ref == "Croatia" ) selected @endif>Croatia</option>
                    <option value="Cuba" @if( $ref == "Cuba" ) selected @endif>Cuba</option>
                    <option value="Cyprus" @if( $ref == "Cyprus" ) selected @endif>Cyprus</option>
                    <option value="Czech Republic" @if( $ref == "Czech Republic" ) selected @endif>Czech Republic</option>
                    <option value="Denmark" @if( $ref == "Denmark" ) selected @endif>Denmark</option>
                    <option value="Djibouti" @if( $ref == "Djibouti" ) selected @endif>Djibouti</option>
                    <option value="Dominica" @if( $ref == "Dominica" ) selected @endif>Dominica</option>
                    <option value="Dominican Republic" @if( $ref == "Dominican Republic" ) selected @endif>Dominican Republic</option>
                    <option value="Ecuador" @if( $ref == "Ecuador" ) selected @endif>Ecuador</option>
                    <option value="Egypt" @if( $ref == "Egypt" ) selected @endif>Egypt</option>
                    <option value="El Salvador" @if( $ref == "El Salvador" ) selected @endif>El Salvador</option>
                    <option value="Equatorial Guinea" @if( $ref == "Equatorial Guinea" ) selected @endif>Equatorial Guinea</option>
                    <option value="Eritrea" @if( $ref == "Eritrea" ) selected @endif>Eritrea</option>
                    <option value="Estonia" @if( $ref == "Estonia" ) selected @endif>Estonia</option>
                    <option value="Ethiopia" @if( $ref == "Ethiopia" ) selected @endif>Ethiopia</option>
                    <option value="Falkland Islands (Malvinas)" @if( $ref == "Falkland Islands (Malvinas)" ) selected @endif>Falkland Islands (Malvinas)</option>
                    <option value="Faroe Islands" @if( $ref == "Faroe Islands" ) selected @endif>Faroe Islands</option>
                    <option value="Fiji" @if( $ref == "Fiji" ) selected @endif>Fiji</option>
                    <option value="Finland" @if( $ref == "Finland" ) selected @endif>Finland</option>
                    <option value="France" @if( $ref == "France" ) selected @endif>France</option>
                    <option value="French Guiana" @if( $ref == "French Guiana" ) selected @endif>French Guiana</option>
                    <option value="French Polynesia" @if( $ref == "French Polynesia" ) selected @endif>French Polynesia</option>
                    <option value="French Southern Territories" @if( $ref == "French Southern Territories" ) selected @endif>French Southern Territories</option>
                    <option value="Gabon" @if( $ref == "Gabon" ) selected @endif>Gabon</option>
                    <option value="Gambia" @if( $ref == "Gambia" ) selected @endif>Gambia</option>
                    <option value="Georgia" @if( $ref == "Georgia" ) selected @endif>Georgia</option>
                    <option value="Germany" @if( $ref == "Germany" ) selected @endif>Germany</option>
                    <option value="Ghana" @if( $ref == "Ghana" ) selected @endif>Ghana</option>
                    <option value="Gibraltar" @if( $ref == "Gibraltar" ) selected @endif>Gibraltar</option>
                    <option value="Greece" @if( $ref == "Greece" ) selected @endif>Greece</option>
                    <option value="Greenland" @if( $ref == "Greenland" ) selected @endif>Greenland</option>
                    <option value="Grenada" @if( $ref == "Grenada" ) selected @endif>Grenada</option>
                    <option value="Guadeloupe" @if( $ref == "Guadeloupe" ) selected @endif>Guadeloupe</option>
                    <option value="Guam" @if( $ref == "Guam" ) selected @endif>Guam</option>
                    <option value="Guatemala" @if( $ref == "Guatemala" ) selected @endif>Guatemala</option>
                    <option value="Guernsey" @if( $ref == "Guernsey" ) selected @endif>Guernsey</option>
                    <option value="Guinea" @if( $ref == "Guinea" ) selected @endif>Guinea</option>
                    <option value="Guinea-bissau" @if( $ref == "Guinea-bissau" ) selected @endif>Guinea-bissau</option>
                    <option value="Guyana" @if( $ref == "Guyana" ) selected @endif>Guyana</option>
                    <option value="Haiti" @if( $ref == "Haiti" ) selected @endif>Haiti</option>
                    <option value="Heard Island and Mcdonald Islands" @if( $ref == "Heard Island and Mcdonald Islands" ) selected @endif>Heard Island and Mcdonald Islands</option>
                    <option value="Holy See (Vatican City State)" @if( $ref == "Holy See (Vatican City State)" ) selected @endif>Holy See (Vatican City State)</option>
                    <option value="Honduras" @if( $ref == "Honduras" ) selected @endif>Honduras</option>
                    <option value="Hong Kong" @if( $ref == "Hong Kong" ) selected @endif>Hong Kong</option>
                    <option value="Hungary" @if( $ref == "Hungary" ) selected @endif>Hungary</option>
                    <option value="Iceland" @if( $ref == "Iceland" ) selected @endif>Iceland</option>
                    <option value="India" @if( $ref == "India" ) selected @endif>India</option>
                    <option value="Indonesia" @if( $ref == "Indonesia" ) selected @endif>Indonesia</option>
                    <option value="Iran, Islamic Republic of" @if( $ref == "Iran, Islamic Republic of" ) selected @endif>Iran, Islamic Republic of</option>
                    <option value="Iraq" @if( $ref == "Iraq" ) selected @endif>Iraq</option>
                    <option value="Ireland" @if( $ref == "Ireland" ) selected @endif>Ireland</option>
                    <option value="Isle of Man" @if( $ref == "Isle of Man" ) selected @endif>Isle of Man</option>
                    <option value="Israel" @if( $ref == "Israel" ) selected @endif>Israel</option>
                    <option value="Italy" @if( $ref == "Italy" ) selected @endif>Italy</option>
                    <option value="Jamaica" @if( $ref == "Jamaica" ) selected @endif>Jamaica</option>
                    <option value="Japan" @if( $ref == "Japan" ) selected @endif>Japan</option>
                    <option value="Jersey" @if( $ref == "Jersey" ) selected @endif>Jersey</option>
                    <option value="Jordan" @if( $ref == "Jordan" ) selected @endif>Jordan</option>
                    <option value="Kazakhstan" @if( $ref == "Kazakhstan" ) selected @endif>Kazakhstan</option>
                    <option value="Kenya" @if( $ref == "Kenya" ) selected @endif>Kenya</option>
                    <option value="Kiribati" @if( $ref == "Kiribati" ) selected @endif>Kiribati</option>
                    <option value="Korea, Democratic People's Republic of" @if( $ref == "Korea, Democratic People's Republic of" ) selected @endif>Korea, Democratic People's Republic of</option>
                    <option value="Korea, Republic of" @if( $ref == "Korea, Republic of" ) selected @endif>Korea, Republic of</option>
                    <option value="Kuwait" @if( $ref == "Kuwait" ) selected @endif>Kuwait</option>
                    <option value="Kyrgyzstan" @if( $ref == "Kyrgyzstan" ) selected @endif>Kyrgyzstan</option>
                    <option value="Lao People's Democratic Republic" @if( $ref == "Lao People's Democratic Republic" ) selected @endif>Lao People's Democratic Republic</option>
                    <option value="Latvia" @if( $ref == "Latvia" ) selected @endif>Latvia</option>
                    <option value="Lebanon" @if( $ref == "Lebanon" ) selected @endif>Lebanon</option>
                    <option value="Lesotho" @if( $ref == "Lesotho" ) selected @endif>Lesotho</option>
                    <option value="Liberia" @if( $ref == "Liberia" ) selected @endif>Liberia</option>
                    <option value="Libyan Arab Jamahiriya" @if( $ref == "Libyan Arab Jamahiriya" ) selected @endif>Libyan Arab Jamahiriya</option>
                    <option value="Liechtenstein" @if( $ref == "Liechtenstein" ) selected @endif>Liechtenstein</option>
                    <option value="Lithuania" @if( $ref == "Lithuania" ) selected @endif>Lithuania</option>
                    <option value="Luxembourg" @if( $ref == "Luxembourg" ) selected @endif>Luxembourg</option>
                    <option value="Macao" @if( $ref == "Macao" ) selected @endif>Macao</option>
                    <option value="Macedonia, The Former Yugoslav Republic of" @if( $ref == "Macedonia, The Former Yugoslav Republic of" ) selected @endif>Macedonia, The Former Yugoslav Republic of</option>
                    <option value="Madagascar" @if( $ref == "Madagascar" ) selected @endif>Madagascar</option>
                    <option value="Malawi" @if( $ref == "Malawi" ) selected @endif>Malawi</option>
                    <option value="Malaysia" @if( $ref == "Malaysia" ) selected @endif>Malaysia</option>
                    <option value="Maldives" @if( $ref == "Maldives" ) selected @endif>Maldives</option>
                    <option value="Mali" @if( $ref == "Mali" ) selected @endif>Mali</option>
                    <option value="Malta" @if( $ref == "Malta" ) selected @endif>Malta</option>
                    <option value="Marshall Islands" @if( $ref == "Marshall Islands" ) selected @endif>Marshall Islands</option>
                    <option value="Martinique" @if( $ref == "Martinique" ) selected @endif>Martinique</option>
                    <option value="Mauritania" @if( $ref == "Mauritania" ) selected @endif>Mauritania</option>
                    <option value="Mauritius" @if( $ref == "Mauritius" ) selected @endif>Mauritius</option>
                    <option value="Mayotte" @if( $ref == "Mayotte" ) selected @endif>Mayotte</option>
                    <option value="Mexico" @if( $ref == "Mexico" ) selected @endif>Mexico</option>
                    <option value="Micronesia, Federated States of" @if( $ref == "Micronesia, Federated States of" ) selected @endif>Micronesia, Federated States of</option>
                    <option value="Moldova, Republic of" @if( $ref == "Moldova, Republic of" ) selected @endif>Moldova, Republic of</option>
                    <option value="Monaco" @if( $ref == "Monaco" ) selected @endif>Monaco</option>
                    <option value="Mongolia" @if( $ref == "Mongolia" ) selected @endif>Mongolia</option>
                    <option value="Montenegro" @if( $ref == "Montenegro" ) selected @endif>Montenegro</option>
                    <option value="Montserrat" @if( $ref == "Montserrat" ) selected @endif>Montserrat</option>
                    <option value="Morocco" @if( $ref == "Morocco" ) selected @endif>Morocco</option>
                    <option value="Mozambique" @if( $ref == "Mozambique" ) selected @endif>Mozambique</option>
                    <option value="Myanmar" @if( $ref == "Myanmar" ) selected @endif>Myanmar</option>
                    <option value="Namibia" @if( $ref == "Namibia" ) selected @endif>Namibia</option>
                    <option value="Nauru" @if( $ref == "Nauru" ) selected @endif>Nauru</option>
                    <option value="Nepal" @if( $ref == "Nepal" ) selected @endif>Nepal</option>
                    <option value="Netherlands" @if( $ref == "Netherlands" ) selected @endif>Netherlands</option>
                    <option value="Netherlands Antilles" @if( $ref == "Netherlands Antilles" ) selected @endif>Netherlands Antilles</option>
                    <option value="New Caledonia" @if( $ref == "New Caledonia" ) selected @endif>New Caledonia</option>
                    <option value="New Zealand" @if( $ref == "New Zealand" ) selected @endif>New Zealand</option>
                    <option value="Nicaragua" @if( $ref == "Nicaragua" ) selected @endif>Nicaragua</option>
                    <option value="Niger" @if( $ref == "Niger" ) selected @endif>Niger</option>
                    <option value="Nigeria" @if( $ref == "Nigeria" ) selected @endif>Nigeria</option>
                    <option value="Niue" @if( $ref == "Niue" ) selected @endif>Niue</option>
                    <option value="Norfolk Island" @if( $ref == "Norfolk Island" ) selected @endif>Norfolk Island</option>
                    <option value="Northern Mariana Islands" @if( $ref == "Northern Mariana Islands" ) selected @endif>Northern Mariana Islands</option>
                    <option value="Norway" @if( $ref == "Norway" ) selected @endif>Norway</option>
                    <option value="Oman" @if( $ref == "Oman" ) selected @endif>Oman</option>
                    <option value="Pakistan" @if( $ref == "Pakistan" ) selected @endif>Pakistan</option>
                    <option value="Palau" @if( $ref == "Palau" ) selected @endif>Palau</option>
                    <option value="Palestinian Territory, Occupied" @if( $ref == "Palestinian Territory, Occupied" ) selected @endif>Palestinian Territory, Occupied</option>
                    <option value="Panama" @if( $ref == "Panama" ) selected @endif>Panama</option>
                    <option value="Papua New Guinea" @if( $ref == "Papua New Guinea" ) selected @endif>Papua New Guinea</option>
                    <option value="Paraguay" @if( $ref == "Paraguay" ) selected @endif>Paraguay</option>
                    <option value="Peru" @if( $ref == "Peru" ) selected @endif>Peru</option>
                    <option value="Philippines" @if( $ref == "Philippines" ) selected @endif>Philippines</option>
                    <option value="Pitcairn" @if( $ref == "Pitcairn" ) selected @endif>Pitcairn</option>
                    <option value="Poland" @if( $ref == "Poland" ) selected @endif>Poland</option>
                    <option value="Portugal" @if( $ref == "Portugal" ) selected @endif>Portugal</option>
                    <option value="Puerto Rico" @if( $ref == "uerto Rico" ) selected @endif>Puerto Rico</option>
                    <option value="Qatar" @if( $ref == "Qatar" ) selected @endif>Qatar</option>
                    <option value="Reunion" @if( $ref == "Reunion" ) selected @endif>Reunion</option>
                    <option value="Romania" @if( $ref == "Romania" ) selected @endif>Romania</option>
                    <option value="Russian Federation" @if( $ref == "Russian Federation" ) selected @endif>Russian Federation</option>
                    <option value="Rwanda" @if( $ref == "Rwanda" ) selected @endif>Rwanda</option>
                    <option value="Saint Helena" @if( $ref == "Saint Helena" ) selected @endif>Saint Helena</option>
                    <option value="Saint Kitts and Nevis" @if( $ref == "Saint Kitts and Nevis" ) selected @endif>Saint Kitts and Nevis</option>
                    <option value="Saint Lucia" @if( $ref == "Saint Lucia" ) selected @endif>Saint Lucia</option>
                    <option value="Saint Pierre and Miquelon" @if( $ref == "Saint Pierre and Miquelon" ) selected @endif>Saint Pierre and Miquelon</option>
                    <option value="Saint Vincent and The Grenadines" @if( $ref == "Saint Vincent and The Grenadines" ) selected @endif>Saint Vincent and The Grenadines</option>
                    <option value="Samoa" @if( $ref == "Samoa" ) selected @endif>Samoa</option>
                    <option value="San Marino" @if( $ref == "San Marino" ) selected @endif>San Marino</option>
                    <option value="Sao Tome and Principe" @if( $ref == "Sao Tome and Principe" ) selected @endif>Sao Tome and Principe</option>
                    <option value="Saudi Arabia" @if( $ref == "Saudi Arabia" ) selected @endif>Saudi Arabia</option>
                    <option value="Senegal" @if( $ref == "Senegal" ) selected @endif>Senegal</option>
                    <option value="Serbia" @if( $ref == "Serbia" ) selected @endif>Serbia</option>
                    <option value="Seychelles" @if( $ref == "Seychelles" ) selected @endif>Seychelles</option>
                    <option value="Sierra Leone" @if( $ref == "Sierra Leone" ) selected @endif>Sierra Leone</option>
                    <option value="Singapore" @if( $ref == "Singapore" ) selected @endif>Singapore</option>
                    <option value="Slovakia" @if( $ref == "Slovakia" ) selected @endif>Slovakia</option>
                    <option value="Slovenia" @if( $ref == "Slovenia" ) selected @endif>Slovenia</option>
                    <option value="Solomon Islands" @if( $ref == "Solomon Islands" ) selected @endif>Solomon Islands</option>
                    <option value="Somalia" @if( $ref == "Somalia" ) selected @endif>Somalia</option>
                    <option value="South Africa" @if( $ref == "South Africa" ) selected @endif>South Africa</option>
                    <option value="South Georgia and The South Sandwich Islands" @if( $ref == "South Georgia and The South Sandwich Islands" ) selected @endif>South Georgia and The South Sandwich Islands</option>
                    <option value="Spain" @if( $ref == "Spain" ) selected @endif>Spain</option>
                    <option value="Sri Lanka" @if( $ref == "Sri Lanka" ) selected @endif>Sri Lanka</option>
                    <option value="Sudan" @if( $ref == "Sudan" ) selected @endif>Sudan</option>
                    <option value="Suriname" @if( $ref == "Suriname" ) selected @endif>Suriname</option>
                    <option value="Svalbard and Jan Mayen" @if( $ref == "Svalbard and Jan Mayen" ) selected @endif>Svalbard and Jan Mayen</option>
                    <option value="Swaziland" @if( $ref == "Swaziland" ) selected @endif>Swaziland</option>
                    <option value="Sweden" @if( $ref == "Sweden" ) selected @endif>Sweden</option>
                    <option value="Switzerland" @if( $ref == "Switzerland" ) selected @endif>Switzerland</option>
                    <option value="Syrian Arab Republic" @if( $ref == "Syrian Arab Republic" ) selected @endif>Syrian Arab Republic</option>
                    <option value="Taiwan" @if( $ref == "Taiwan" ) selected @endif>Taiwan</option>
                    <option value="Tajikistan" @if( $ref == "Tajikistan" ) selected @endif>Tajikistan</option>
                    <option value="Tanzania, United Republic of" @if( $ref == "Tanzania, United Republic of" ) selected @endif>Tanzania, United Republic of</option>
                    <option value="Thailand" @if( $ref == "Thailand" ) selected @endif>Thailand</option>
                    <option value="Timor-leste" @if( $ref == "Timor-leste" ) selected @endif>Timor-leste</option>
                    <option value="Togo" @if( $ref == "Togo" ) selected @endif>Togo</option>
                    <option value="Tokelau" @if( $ref == "Tokelau" ) selected @endif>Tokelau</option>
                    <option value="Tonga" @if( $ref == "Tonga" ) selected @endif>Tonga</option>
                    <option value="Trinidad and Tobago" @if( $ref == "Trinidad and Tobago" ) selected @endif>Trinidad and Tobago</option>
                    <option value="Tunisia" @if( $ref == "Tunisia" ) selected @endif>Tunisia</option>
                    <option value="Turkey" @if( $ref == "Turkey" ) selected @endif>Turkey</option>
                    <option value="Turkmenistan" @if( $ref == "Turkmenistan" ) selected @endif>Turkmenistan</option>
                    <option value="Turks and Caicos Islands" @if( $ref == "Turks and Caicos Islands" ) selected @endif>Turks and Caicos Islands</option>
                    <option value="Tuvalu" @if( $ref == "Tuvalu" ) selected @endif>Tuvalu</option>
                    <option value="Uganda" @if( $ref == "Uganda" ) selected @endif>Uganda</option>
                    <option value="Ukraine" @if( $ref == "Ukraine" ) selected @endif>Ukraine</option>
                    <option value="United Arab Emirates" @if( $ref == "United Arab Emirates" ) selected @endif>United Arab Emirates</option>
                    <option value="United Kingdom" @if( $ref == "United Kingdom" ) selected @endif>United Kingdom</option>
                    <option value="United States" @if( $ref == "United States" ) selected @endif>United States</option>
                    <option value="United States Minor Outlying Islands" @if( $ref == "United States Minor Outlying Islands" ) selected @endif>United States Minor Outlying Islands</option>
                    <option value="Uruguay" @if( $ref == "Uruguay" ) selected @endif>Uruguay</option>
                    <option value="Uzbekistan" @if( $ref == "Uzbekistan" ) selected @endif>Uzbekistan</option>
                    <option value="Vanuatu" @if( $ref == "Vanuatu" ) selected @endif>Vanuatu</option>
                    <option value="Venezuela" @if( $ref == "Venezuela" ) selected @endif>Venezuela</option>
                    <option value="Vietnam" @if( $ref == "Vietnam" ) selected @endif>Vietnam</option>
                    <option value="Virgin Islands, British" @if( $ref == "Virgin Islands, British" ) selected @endif>Virgin Islands, British</option>
                    <option value="Virgin Islands, U.S." @if( $ref == "Virgin Islands, U.S." ) selected @endif>Virgin Islands, U.S.</option>
                    <option value="Wallis and Futuna" @if( $ref == "Wallis and Futuna" ) selected @endif>Wallis and Futuna</option>
                    <option value="Western Sahara" @if( $ref == "Western Sahara" ) selected @endif>Western Sahara</option>
                    <option value="Yemen" @if( $ref == "Yemen" ) selected @endif>Yemen</option>
                    <option value="Zambia" @if( $ref == "Zambia" ) selected @endif>Zambia</option>
                    <option value="Zimbabwe" @if( $ref == "Zimbabwe" ) selected @endif>Zimbabwe</option>
                </select>
            </div>

            
            
            <input type="hidden" id="salesdestination" name="salesdestination">
            </div>
            <div>
                {{-- <button class="border border-blue-600 px-4 py-2 bg-blue-600 text-white"> --}}
                <button class="
                px-6
                py-3
                bg-yellow-500
                text-white
                font-medium
                text-xs
                leading-tight
                uppercase
                shadow-md
                hover:bg-yellow-600 hover:shadow-lg
                focus:bg-yellow-600 focus:shadow-lg focus:outline-none focus:ring-0
                active:bg-yellow-600 active:shadow-lg
                transition-all
                duration-350
                ease-in-out
                border-yellow-600
                ">   
                    Search
                </button>
                <a href="{{url('/lcdashboard')}}" class="
            px-6
            py-3
            bg-red-600
            text-white
            font-medium
            text-xs
            leading-tight
            uppercase
            shadow-md
            hover:bg-red-700 hover:shadow-lg
            focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0
            active:bg-red-700 active:shadow-lg
            transition-all
            duration-350
            ease-in-out
            border-amber-600
            ">   
                Clear
            </a>
            </div>
            </div>
        </form>
       
    
     
        <div class="w-full  flex flex-col  items-center mx-auto  ">
            <div class=" flex justify-center items-center " id="myTab" data-tabs-toggle="#myTabContent" role="tablist">
                <button class="lcdashboard px-4" id="applicants-tab" data-tabs-target="#applicants" type="button" role="tab" aria-controls="applicants" aria-selected="true" onclick="show()">List of Applicants</button>
                <button class="lcdashboard px-4" id="closingratio-tab" data-tabs-target="#closingratio" type="button" role="tab" aria-controls="closingratio" aria-selected="false  " onclick="hide()">Closing Ratio</button>
                {{-- <ul class="flex -mb-px  " id="myTab" data-tabs-toggle="#myTabContent" role="tablist">
                    <li class="mr-2" role="closingratio">
                        <button class="uppercase p-4 rounded-t-lg hover:border-b-2 " id="closingratio-tab" data-tabs-target="#closingratio" type="button" role="tab" aria-controls="closingratio" aria-selected="true">Closing Ratio</button>
                    </li>
                    <li class="mr-2" role="applicants">
                        <button class="uppercase  p-4 rounded-t-lg hover:border-b-2 " id="applicants-tab" data-tabs-target="#applicants" type="button" role="tab" aria-controls="applicants" aria-selected="false">List of Applicants</button>
                    </li>
                
                </ul> --}}
            </div>
           
            <div id="myTabContent" class="h-screen">
                
                <div class="px-4 overflow-auto h-[65%] " id="closingratio" role="tabpanel" aria-labelledby="closingratio-tab">
                    <table class="table-auto text-left text-xs w-full  bg-white  shadow-md shadow-black ">
                        <thead class="border-b border-black ">
                            <tr class="">
                                <th class="px-4 py-2">Lead Source</th>
                                <th class="px-4 py-2">Lead Number</th>
                                <th class="px-4 py-2">Lead Signup</th>
                                <th class="px-4 py-2">Closing Ratio</th>
                            </tr>
                            </thead>
                            <tbody>
                                @if(count($closingratio) > 0)
                                    @foreach ($closingratio as $list)
                                        <tr class="border-b-2 py-2">    
                                            <td class="px-4 py-2">{{$list->lead}}</td>
                                            <td class="px-4 py-2">{{$list->leadnumber}}</td>                               
                                            <td class="px-4 py-2">{{$list->signedup}}</td>
                                            <td class="px-4 py-2">{{$list->ClosingRatio}}%</td>
                                            
                                        </tr>
                                    @endforeach
                                    @foreach ($closingratio as $total)
                                    @if ($loop->first)
                                        
                               
                                        <tr class="border-b-2 py-2">  
                                            <td class="px-4 py-2 font-bold">total</td>
                                            <td class="px-4 py-2 font-bold">{{$total->totalleadnumbers}}</td>                               
                                            <td class="px-4 py-2 font-bold">{{$total->totalsignedup}}</td>
                                            <td class="px-4 py-2 font-bold">{{$total->otp}}%</td>
    
                                        </tr>
                                    @endif
                                    @endforeach
                                @else
                                    <tr class="border-b-2 py-2">    
                                            <td class="px-4 py-2 text-center" colspan="4">No Record</td>
                                            
                                    </tr>
                                @endif
                           
                                
                               
                            </tbody>
                    </table>
                
                </div>
                      <div class="px-4 py-2" id="pagination1">
                        {{-- {{$applicants->links()}} --}}
                        
                        {{ $applicants->appends(request()->all())->links() }}
                    </div>
                <div class="px-4 overflow-auto h-[65%] " id="applicants" role="tabpanel" aria-labelledby="applicants-tab">
                  
                    <table class="table-auto text-left text-sm w-full  max-w-[50%] lg:max-w-[100%] bg-white shadow-md shadow-black  ">
                        <thead class="border-b bg-white shadow-sm sticky top-0 ">
                            <tr class="">
                                <th class="px-4 py-2">#</th>
                                <th class="px-4 py-2">Date Paid</th>
                                <th class="px-4 py-2">Country</th>
                                <th class="px-4 py-2">Applicant Name</th>
                                <th class="px-4 py-2">Facebook Name</th>
                                <th class="px-4 py-2">Lead Source</th>
                                <th class="px-4 py-2">LC</th>
                                <th class="px-4 py-2">Date Created</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($closingratio) > 0)
                                @foreach ($applicants as $list)
                                    <tr class="border-b-2 py-2">
                            
                                            <!--<td class="px-4 py-2">{{$list->dateCreated ? \Carbon\Carbon::parse( $list->dateCreated)->isoFormat('MMMM DD YYYY, H:MM A') : '' }} </td>-->
                                
                                            <td class="px-4 py-2">{{$list->inquiryID}}</td>
                                            <td class="px-4 py-2">{{$list->datePaid ? \Carbon\Carbon::parse( $list->datePaid)->isoFormat('MMMM DD YYYY') : 'Not Paid' }}</td>
                                            <td class="px-4 py-2">{{$list->countryReside}}</td>
                                            <td class="px-4 py-2">{{$list->applicantName}}</td>
                                            <td class="px-4 py-2">{{$list->fbName}}</td>
                                            <td class="px-4 py-2">{{$list->lead}}</td>
                                            <td class="px-4 py-2">{{$list->firstName}} {{$list->lastName}}</td>
                                            <td class="px-4 py-2">{{ \Carbon\Carbon::parse($list->datecreated)->isoFormat('MMMM DD YYYY, h:mm a') }}</td>
                                            {{-- <td class="px-4 py-2">{{$list->datePaid ? $list->datePaid : 'Not Paid'}}</td> --}}
                                    
                                    
                                    </tr>
                                @endforeach
                            @else
                                <tr class="border-b-2 py-2">    
                                    <td class="px-4 py-2 text-center" colspan="7">No Record</td>
                                        
                                </tr>
                            @endif
                            
                        </tbody>
                        </table>
                        
                </div>
                <div class="mt-2 p-4 " id="pagination2">
                            {{-- {{$applicants->links()}} --}}
                            {{ $applicants->appends(request()->all())->links() }}
                        </div>
            
            </div>
        </div>
        
    </div>
</x-layouts>

<script>
    var getrep = document.getElementById('salesofficer');
    var salesdestination = document.getElementById('salesdestination');
   	    var e = document.getElementById("pagination1");
   	    var f = document.getElementById("pagination2");
    function getText(selTag) {
        var x = selTag.options[selTag.selectedIndex].text;
        document.getElementById("salesdestination").value = x;
        }
    function show() {

   	    e.style.display =  'block';
   	    f.style.display = 'block';
    }
    function hide() {
   	    e.style.display =  'none';
   	    f.style.display = 'none';
    }

</script>