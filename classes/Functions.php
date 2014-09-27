<?php

Class Functions {

    public $count = 1;

    public function __construct() {
        
    }

    public function alert($type, $alert, $msg = '') {
        echo '<div class="alert alert-' . $type . '"><strong>' . $alert . '</strong> ' . $msg . '</div>';
    }

    public function tableHeadings($headings = array()) {
        $heading_row = '';
        foreach ($headings as $heading) {

            $heading_row .= '<th style="align: center;">' . $heading . '</th>';
        }
        return $heading_row;
    }

    public function generalTableBody($query, $fields, $additional_td = '', $numbering = false, $warning = true) {
        $info = DB::getInstance()->query($query);
        $table_body = '';
        $no = '';
        $id = 0;
        if (!$info->count() && $warning) {
            self::alert('warning', 'No data found!');
        } else {
            $table_data = '';

            foreach ($info->results() as $infor) {
                if ($numbering) {
                    if (strlen($this->count) == 1) {
                        $this->count = '0' . $this->count;
                    }
                    $no = '<td style="text-align:center; vertical-align:middle;">' . $this->count . '</td>';
                    $id = $infor->id;
                }
                foreach ($fields as $value) {
                    $td = $infor->$value;

                    if ($td == '') {
                        $td = '&nbsp;';
                    }
                    if (is_string($td)) {
                        $align = 'left';
                    }
                    if (doubleval($td)) {
                        $align = 'right';
                    }
                    if (strtotime($td)) {
                        $align = 'center';
                    }

                    $table_data.= '<td style="text-align:' . $align . '; vertical-align:middle;">' . $td . '</td>';
                }

                $table_body .='<tr id="' . $id . '">' . $no . $table_data . $additional_td . '</tr>' . "\n";
                $this->count++;
                $table_data = '';
            }
        }
        return $table_body;
    }

    public function selectOption($query) {
        $info = DB::getInstance()->query($query);
        $options = '';
        if ($info->count()) {
            foreach ($info->results() as $infor) {
                $options .= '<option value="' . $infor->id . '">' . $infor->optionName . '</option>';
            }
        }
        return $options;
    }

    public function checkOption($query) {
        $info = DB::getInstance()->query($query);
        //$options = '';
        $check = '';
        if ($info->count()) {
            foreach ($info->results() as $infor) {
                $check.= '<div class = "col-md-12">';
                $check = '<input id = "' . $infor->id . '" name = "' . $infor->optionName . '" type = "checkbox" class = "add-on ">
            <label class = "control-label add-on">
            ' . $infor->optionName . '</label>
            </div>';
                //$options .= '<option value="' . $infor->id . '">' . $infor->optionName . '</option>';
            }
        }
        return $check;
    }

    public function selectCountry() {
        $options = '';
        $countries = array("Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, the Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "France Metropolitan", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia, The Former Yugoslav Republic of", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands", "Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan, Province of China", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe");
        for ($x = 0; $x < count($countries); $x++) {
            $options .= '<option value="' . $x . '">' . $countries[$x] . '</option>';
        }
        return $options;
    }

    public function selectGuestMealPlan() {
        $query = "SELECT `id`, `meal` FROM `meal_basis`;";
        $info = DB::getInstance()->query($query);
        foreach ($info as $infor) {
            ?>
            <label class="radio-inline" for="<?php echo $infor->id; ?>">
                <input type="radio" name="meal_basis" id="<?php echo $infor->id; ?>" value="<?php echo $infor->id; ?>" >
                <?php echo $infor->meal; ?>
            </label>
            <?php
        }
    }

    public function getDistance($start, $end) {

            $routes = json_decode(file_get_contents('http://maps.googleapis.com/maps/api/distancematrix/json?origins=' . $start . '&destinations=' . $end . '&mode=driving&language=en-EN'))->rows;
            $dis = $routes[0]->elements[0]->distance->value;
            return $distance = (int) ((int) $dis / 1000);
    }

    public function getVehicleRate($vehicle_id) {
        $query = "SELECT `vehicle_type`.`rate` FROM `vehicle_type`, `vehicles` WHERE `vehicles`.`id` = '$vehicle_id' AND `vehicles`.`vehicle_type_id` = `vehicle_type`.`id` ;";
        $info = DB::getInstance()->query($query);
        foreach ($info->results() as $infor) {
            $rate = $infor->rate;
        }
        return (float)$rate;
    }

    public function generatePaymentHistoryTotal() {
        $query = "SELECT SUM(`amount`) as sum_amount FROM `booking`;";
        $info = DB::getInstance()->query($query);
        $infof = $info->first();
        $booking_total = doubleval($infof->sum_amount);
        $query = "SELECT SUM(`amount`) as sum_amount FROM `payment`;";
        $info = DB::getInstance()->query($query);
        $infof = $info->first();
        $payment_total = doubleval($infof->sum_amount);
        $total = $booking_total - $payment_total;
        return $total;
    }

    public function loadModal($title, $topic, $content) {

        $modal = '<div class="row">
            <div id="myModal" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <div class="modal-header">
                            <a class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span></a>
                            <h3 class="modal-title" id="myModalLabel">' . $title . '</h3>
                        </div>
                        <div class="modal-body">
                            <h4>' . $topic . '</h4>
                            <p>' . $content . '</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>';
        return $modal;
    }

}
