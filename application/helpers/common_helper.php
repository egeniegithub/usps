<?php



if (!function_exists('getStates')) {
    /**
     * Get the locally stored states
     *
     * @return array
     */
    function getStates()
    {
        //
        return json_decode(
            file_get_contents(baseUrl('assets/states.json')),
            true
        );
    }
}

if (!function_exists('verifyAddressFromUSPS')) {
    /**
     * Verify address from USPS
     *
     * @param array $mailingAddressArray
     * @return array
     */
    function verifyAddressFromUSPS($mailingAddressArray)
    {
        $template = '';
        $template .= '<AddressValidateRequest USERID="300EGENI6381">';
        $template .= '<Revision>1</Revision>';
        $template .= '<Address ID="0">';
        $template .= '<Address1>' . ($mailingAddressArray['address_1']) . '</Address1>';
        $template .= '<Address2>' . ($mailingAddressArray['address_2']) . '</Address2>';
        $template .= '<City>' . ($mailingAddressArray['city']) . '</City>';
        $template .= '<State>' . ($mailingAddressArray['state']) . '</State>';
        $template .= '<Zip5>' . ($mailingAddressArray['zipcode']) . '</Zip5>';
        $template .= '<Zip4/>';
        $template .= '</Address>';
        $template .= '</AddressValidateRequest>';

        // prepare xml doc for query string
        $templateString = urlencode(preg_replace('/[\t\n]/', '', $template));

        $url = "http://production.shippingapis.com/ShippingAPI.dll?API=Verify&XML=" . $templateString;

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET'
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        //
        return simplexml_load_string($response);
    }
}


/**
 * Handles user IP
 *
 * @return string
 */
if (!function_exists('getUserIP')) {

    function getUserIP()
    {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if (getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if (getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if (getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if (getenv('HTTP_FORWARDED'))
            $ipaddress = getenv('HTTP_FORWARDED');
        else if (getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
        return strpos($ipaddress, ',') !== FALSE ? explode(',', $ipaddress)[0] : $ipaddress;
    }
}
