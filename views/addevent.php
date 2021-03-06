<!DOCTYPE html>
<html>
    <head>
        <link href="css/styles.css" rel="stylesheet" type="text/css"/>
        <title>GigMate - Add Event</title>
    </head>
    <?php
// show potential errors / feedback (from addingevent object)
    if (isset($addingevent)) {
        if ($addingevent->errors) {
            foreach ($addingevent->errors as $error) {
                echo $error;
            }
        }
        if ($addingevent->messages) {
            foreach ($addingevent->messages as $message) {
                echo $message;
            }
        }
    }
    ?>
    <body>
        <h1>GigMate</h1>
        <?php include 'views/navigationbar.php' ?>
        
        <h2>Add Event</h2>

        <!--         entry form -->
        <form method="post" action="addevent.php" name="addeventform">
            <!--        <form method="post" action="addvenue_dump.php" name="addeventform">-->
            <!--             the user name input field uses a HTML5 pattern check -->
            <table id="addstuff">
                <tbody>
                    <tr>
                        <td><label for="event_input_name">Event name</label></td>
                        <td><input id="event_input_name" class="field_input" type="text" name="event_name" required /></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><label for="event_input_eventdate">Event date <br/>(if no date picker: yyyy-mm-dd)</label></td>
                        <td><input id="event_input_eventdate" class="field_input" type="date" name="event_date" required /></td>

                    </tr>
                    <tr>
                        <td><label for="event_input_eventtime">Event time</label></td>
                        <td><input id="event_input_eventtime" class="field_input" type="time" name="event_time"></td>
                    </tr>
                    <tr>
                        <td>Please select a venue or </td>
                        <td colspan="2"><select name="venue_name">
                                <option value="">Please select a venue</option>
                                <?php
                                $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                                if ($conn->connect_error) {
                                    die("DB connection failed: " . $conn->connect_error);
                                }
                                $sqlquery_name = "SELECT venue_name, venue_town from venues";
                                $result = $conn->query($sqlquery_name);

                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo '<option value="' . $row['venue_name'] . '">' .
                                        $row['venue_name'] . ' / ' . $row['venue_town'] . '</option>' . "\n";
                                    }
//                                    echo "</select>";
                                } else {
                                    echo "0 results";
                                }
                                $conn->close();
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr><td><label for="event_input_eventvenue">&nbsp;&nbsp;&nbsp;&nbsp;enter a venue name: </label></td>
                        <td><input id="event_input_eventvenue" class="field_input" type="text" name="event_venue"></td>
                    </tr>
                    <tr>
                        <td><label for="event_input_town">Town</label></td>
                        <td><input id="event_input_town" class="field_input" type="text" name="event_town" required /></td>
                    </tr>
<!--                    <tr>
                        <td><label for="event_input_country">Country</label></td>
                        <td><input id="event_input_country" class="field_input" type="text" name="event_country" required />
                    </tr>-->
                    <tr>
                        <td>Country</td>
                        <td colspan="2"><select name="event_country" required/>
                <option value="">Please select a country</option>
                <option value="Afganistan">Afghanistan</option>
                <option value="Albania">Albania</option>
                <option value="Algeria">Algeria</option>
                <option value="American Samoa">American Samoa</option>
                <option value="Andorra">Andorra</option>
                <option value="Angola">Angola</option>
                <option value="Anguilla">Anguilla</option>
                <option value="Antigua &amp; Barbuda">Antigua &amp; Barbuda</option>
                <option value="Argentina">Argentina</option>
                <option value="Armenia">Armenia</option>
                <option value="Aruba">Aruba</option>
                <option value="Australia">Australia</option>
                <option value="Austria">Austria</option>
                <option value="Azerbaijan">Azerbaijan</option>
                <option value="Bahamas">Bahamas</option>
                <option value="Bahrain">Bahrain</option>
                <option value="Bangladesh">Bangladesh</option>
                <option value="Barbados">Barbados</option>
                <option value="Belarus">Belarus</option>
                <option value="Belgium">Belgium</option>
                <option value="Belize">Belize</option>
                <option value="Benin">Benin</option>
                <option value="Bermuda">Bermuda</option>
                <option value="Bhutan">Bhutan</option>
                <option value="Bolivia">Bolivia</option>
                <option value="Bonaire">Bonaire</option>
                <option value="Bosnia &amp; Herzegovina">Bosnia &amp; Herzegovina</option>
                <option value="Botswana">Botswana</option>
                <option value="Brazil">Brazil</option>
                <option value="British Indian Ocean Ter">British Indian Ocean Ter</option>
                <option value="Brunei">Brunei</option>
                <option value="Bulgaria">Bulgaria</option>
                <option value="Burkina Faso">Burkina Faso</option>
                <option value="Burundi">Burundi</option>
                <option value="Cambodia">Cambodia</option>
                <option value="Cameroon">Cameroon</option>
                <option value="Canada">Canada</option>
                <option value="Canary Islands">Canary Islands</option>
                <option value="Cape Verde">Cape Verde</option>
                <option value="Cayman Islands">Cayman Islands</option>
                <option value="Central African Republic">Central African Republic</option>
                <option value="Chad">Chad</option>
                <option value="Channel Islands">Channel Islands</option>
                <option value="Chile">Chile</option>
                <option value="China">China</option>
                <option value="Christmas Island">Christmas Island</option>
                <option value="Cocos Island">Cocos Island</option>
                <option value="Colombia">Colombia</option>
                <option value="Comoros">Comoros</option>
                <option value="Congo">Congo</option>
                <option value="Cook Islands">Cook Islands</option>
                <option value="Costa Rica">Costa Rica</option>
                <option value="Cote DIvoire">Cote D'Ivoire</option>
                <option value="Croatia">Croatia</option>
                <option value="Cuba">Cuba</option>
                <option value="Curacao">Curacao</option>
                <option value="Cyprus">Cyprus</option>
                <option value="Czech Republic">Czech Republic</option>
                <option value="Denmark">Denmark</option>
                <option value="Djibouti">Djibouti</option>
                <option value="Dominica">Dominica</option>
                <option value="Dominican Republic">Dominican Republic</option>
                <option value="East Timor">East Timor</option>
                <option value="Ecuador">Ecuador</option>
                <option value="Egypt">Egypt</option>
                <option value="El Salvador">El Salvador</option>
                <option value="Equatorial Guinea">Equatorial Guinea</option>
                <option value="Eritrea">Eritrea</option>
                <option value="Estonia">Estonia</option>
                <option value="Ethiopia">Ethiopia</option>
                <option value="Falkland Islands">Falkland Islands</option>
                <option value="Faroe Islands">Faroe Islands</option>
                <option value="Fiji">Fiji</option>
                <option value="Finland">Finland</option>
                <option value="France">France</option>
                <option value="French Guiana">French Guiana</option>
                <option value="French Polynesia">French Polynesia</option>
                <option value="French Southern Ter">French Southern Ter</option>
                <option value="Gabon">Gabon</option>
                <option value="Gambia">Gambia</option>
                <option value="Georgia">Georgia</option>
                <option value="Germany">Germany</option>
                <option value="Ghana">Ghana</option>
                <option value="Gibraltar">Gibraltar</option>
                <option value="Great Britain">Great Britain</option>
                <option value="Greece">Greece</option>
                <option value="Greenland">Greenland</option>
                <option value="Grenada">Grenada</option>
                <option value="Guadeloupe">Guadeloupe</option>
                <option value="Guam">Guam</option>
                <option value="Guatemala">Guatemala</option>
                <option value="Guinea">Guinea</option>
                <option value="Guyana">Guyana</option>
                <option value="Haiti">Haiti</option>
                <option value="Hawaii">Hawaii</option>
                <option value="Honduras">Honduras</option>
                <option value="Hong Kong">Hong Kong</option>
                <option value="Hungary">Hungary</option>
                <option value="Iceland">Iceland</option>
                <option value="India">India</option>
                <option value="Indonesia">Indonesia</option>
                <option value="Iran">Iran</option>
                <option value="Iraq">Iraq</option>
                <option value="Ireland">Ireland</option>
                <option value="Isle of Man">Isle of Man</option>
                <option value="Israel">Israel</option>
                <option value="Italy">Italy</option>
                <option value="Jamaica">Jamaica</option>
                <option value="Japan">Japan</option>
                <option value="Jordan">Jordan</option>
                <option value="Kazakhstan">Kazakhstan</option>
                <option value="Kenya">Kenya</option>
                <option value="Kiribati">Kiribati</option>
                <option value="Korea North">Korea North</option>
                <option value="Korea Sout">Korea South</option>
                <option value="Kuwait">Kuwait</option>
                <option value="Kyrgyzstan">Kyrgyzstan</option>
                <option value="Laos">Laos</option>
                <option value="Latvia">Latvia</option>
                <option value="Lebanon">Lebanon</option>
                <option value="Lesotho">Lesotho</option>
                <option value="Liberia">Liberia</option>
                <option value="Libya">Libya</option>
                <option value="Liechtenstein">Liechtenstein</option>
                <option value="Lithuania">Lithuania</option>
                <option value="Luxembourg">Luxembourg</option>
                <option value="Macau">Macau</option>
                <option value="Macedonia">Macedonia</option>
                <option value="Madagascar">Madagascar</option>
                <option value="Malaysia">Malaysia</option>
                <option value="Malawi">Malawi</option>
                <option value="Maldives">Maldives</option>
                <option value="Mali">Mali</option>
                <option value="Malta">Malta</option>
                <option value="Marshall Islands">Marshall Islands</option>
                <option value="Martinique">Martinique</option>
                <option value="Mauritania">Mauritania</option>
                <option value="Mauritius">Mauritius</option>
                <option value="Mayotte">Mayotte</option>
                <option value="Mexico">Mexico</option>
                <option value="Midway Islands">Midway Islands</option>
                <option value="Moldova">Moldova</option>
                <option value="Monaco">Monaco</option>
                <option value="Mongolia">Mongolia</option>
                <option value="Montserrat">Montserrat</option>
                <option value="Morocco">Morocco</option>
                <option value="Mozambique">Mozambique</option>
                <option value="Myanmar">Myanmar</option>
                <option value="Nambia">Nambia</option>
                <option value="Nauru">Nauru</option>
                <option value="Nepal">Nepal</option>
                <option value="Netherland Antilles">Netherland Antilles</option>
                <option value="Netherlands">Netherlands (Holland, Europe)</option>
                <option value="Nevis">Nevis</option>
                <option value="New Caledonia">New Caledonia</option>
                <option value="New Zealand">New Zealand</option>
                <option value="Nicaragua">Nicaragua</option>
                <option value="Niger">Niger</option>
                <option value="Nigeria">Nigeria</option>
                <option value="Niue">Niue</option>
                <option value="Norfolk Island">Norfolk Island</option>
                <option value="Norway">Norway</option>
                <option value="Oman">Oman</option>
                <option value="Pakistan">Pakistan</option>
                <option value="Palau Island">Palau Island</option>
                <option value="Palestine">Palestine</option>
                <option value="Panama">Panama</option>
                <option value="Papua New Guinea">Papua New Guinea</option>
                <option value="Paraguay">Paraguay</option>
                <option value="Peru">Peru</option>
                <option value="Phillipines">Philippines</option>
                <option value="Pitcairn Island">Pitcairn Island</option>
                <option value="Poland">Poland</option>
                <option value="Portugal">Portugal</option>
                <option value="Puerto Rico">Puerto Rico</option>
                <option value="Qatar">Qatar</option>
                <option value="Republic of Montenegro">Republic of Montenegro</option>
                <option value="Republic of Serbia">Republic of Serbia</option>
                <option value="Reunion">Reunion</option>
                <option value="Romania">Romania</option>
                <option value="Russia">Russia</option>
                <option value="Rwanda">Rwanda</option>
                <option value="St Barthelemy">St Barthelemy</option>
                <option value="St Eustatius">St Eustatius</option>
                <option value="St Helena">St Helena</option>
                <option value="St Kitts-Nevis">St Kitts-Nevis</option>
                <option value="St Lucia">St Lucia</option>
                <option value="St Maarten">St Maarten</option>
                <option value="St Pierre &amp; Miquelon">St Pierre &amp; Miquelon</option>
                <option value="St Vincent &amp; Grenadines">St Vincent &amp; Grenadines</option>
                <option value="Saipan">Saipan</option>
                <option value="Samoa">Samoa</option>
                <option value="Samoa American">Samoa American</option>
                <option value="San Marino">San Marino</option>
                <option value="Sao Tome &amp; Principe">Sao Tome &amp; Principe</option>
                <option value="Saudi Arabia">Saudi Arabia</option>
                <option value="Senegal">Senegal</option>
                <option value="Serbia">Serbia</option>
                <option value="Seychelles">Seychelles</option>
                <option value="Sierra Leone">Sierra Leone</option>
                <option value="Singapore">Singapore</option>
                <option value="Slovakia">Slovakia</option>
                <option value="Slovenia">Slovenia</option>
                <option value="Solomon Islands">Solomon Islands</option>
                <option value="Somalia">Somalia</option>
                <option value="South Africa">South Africa</option>
                <option value="Spain">Spain</option>
                <option value="Sri Lanka">Sri Lanka</option>
                <option value="Sudan">Sudan</option>
                <option value="Suriname">Suriname</option>
                <option value="Swaziland">Swaziland</option>
                <option value="Sweden">Sweden</option>
                <option value="Switzerland">Switzerland</option>
                <option value="Syria">Syria</option>
                <option value="Tahiti">Tahiti</option>
                <option value="Taiwan">Taiwan</option>
                <option value="Tajikistan">Tajikistan</option>
                <option value="Tanzania">Tanzania</option>
                <option value="Thailand">Thailand</option>
                <option value="Togo">Togo</option>
                <option value="Tokelau">Tokelau</option>
                <option value="Tonga">Tonga</option>
                <option value="Trinidad &amp; Tobago">Trinidad &amp; Tobago</option>
                <option value="Tunisia">Tunisia</option>
                <option value="Turkey">Turkey</option>
                <option value="Turkmenistan">Turkmenistan</option>
                <option value="Turks &amp; Caicos Is">Turks &amp; Caicos Is</option>
                <option value="Tuvalu">Tuvalu</option>
                <option value="Uganda">Uganda</option>
                <option value="Ukraine">Ukraine</option>
                <option value="United Arab Erimates">United Arab Emirates</option>
                <option value="United Kingdom">United Kingdom</option>
                <option value="United States of America">United States of America</option>
                <option value="Uraguay">Uruguay</option>
                <option value="Uzbekistan">Uzbekistan</option>
                <option value="Vanuatu">Vanuatu</option>
                <option value="Vatican City State">Vatican City State</option>
                <option value="Venezuela">Venezuela</option>
                <option value="Vietnam">Vietnam</option>
                <option value="Virgin Islands (Brit)">Virgin Islands (Brit)</option>
                <option value="Virgin Islands (USA)">Virgin Islands (USA)</option>
                <option value="Wake Island">Wake Island</option>
                <option value="Wallis &amp; Futana Is">Wallis &amp; Futana Is</option>
                <option value="Yemen">Yemen</option>
                <option value="Zaire">Zaire</option>
                <option value="Zambia">Zambia</option>
                <option value="Zimbabwe">Zimbabwe</option>
                </select></td>
                </tr>
                <tr>
                    <td><label for="event_input_contactname">Event Contact name</label></td>
                    <td><input id="event_input_contactname" class="field_input" type="text" name="event_contactname"></td>
                    <td></td>
                </tr>
                <tr>
                    <td><label for="event_input_contactphone">Event Contact phone</label></td>
                    <td><input id="event_input_contactphone" class="field_input" type="tel" name="event_contactphone"></td>
                    <td></td>
                </tr>
                <tr>
                    <td><label for="event_input_buspowertime">Bus power time</label></td>
                    <td><input id="event_input_buspowertime" class="field_input" type="time" name="event_buspowertime"></td>
                    <td></td>
                </tr>
                <tr>
                    <td><label for="event_input_loadintime">Load in time</label></td>
                    <td><input id="event_input_loadintime" class="field_input" type="time" name="event_loadintime"></td>
                    <td></td>
                </tr>
                <tr>
                    <td><label for="event_input_cateringtime">Catering time</label></td>
                    <td><input id="event_input_cateringtime" class="field_input" type="time" name="event_cateringtime"></td>
                    <td></td>
                </tr>
                <tr>
                    <td><label for="event_input_soundchecktime">Soundcheck time</label></td>
                    <td><input id="event_input_soundchecktime" class="field_input" type="time" name="event_soundchecktime"></td>
                    <td></td>
                </tr>
                <tr>
                    <td><label for="event_input_doorsopentime">Doors open time</label></td>
                    <td><input id="event_input_doorsopentime" class="field_input" type="time" name="event_doorsopentime"></td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="3"><h3>Artists and order</h3></td>
                </tr>
                <tr>
                    <td colspan="3"><i>Please use the Other information field if needed</i></td>
                </tr>
                <tr>
                    <td></td>
                    <td><strong>Time</strong></td>
                    <td><strong>Artist Name</strong></td>
                </tr>
                <tr>
                    <td>Artist slot 1</td>
                    <td><input class="field_input" type="time" name="event_artistslot1time"></td>
                    <td><input class="field_input" type="text" name="event_artist1name"></td>
                </tr>
                <tr>
                    <td>Artist slot 2</td>
                    <td><input class="field_input" type="time" name="event_artistslot2time"></td>
                    <td><input class="field_input" type="text" name="event_artist2name"></td>
                </tr><tr>
                    <td>Artist slot 3</td>
                    <td><input class="field_input" type="time" name="event_artistslot3time"></td>
                    <td><input class="field_input" type="text" name="event_artist3name"></td>
                </tr>
                </tbody>
            </table>
            <p><label for="event_input_otherinfo">Other information</label></p>
            <p><textarea name="event_otherinfo" style="width:400px; height:200px"></textarea></p>

            <p><input type="submit" name="addevent" value="Add Event" /> 
                <input type="reset" name="reset" value="Reset Form" /></p>

        </form>

        <!--         back link -->
        <p></p>
        <p><a href="home.php">Back to Home Page</a></p>
    </body>
</html>