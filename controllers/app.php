<?php defined('PATH') or die('NO DIRECT ACCESS');
class App
{
    /**
     * Default route handler
     */
    public function main()
    {
        loadPage('main');
    }

    /**
     * Handles mailing address entries
     */
    public function mailingAddress()
    {
        // Get a clean post
        $post = getPost();

        //
        if (!array_key_exists('action', $post)) {
            return $this->sendResponse(401);
        }
        //
        $response = verifyAddressFromUSPS($post['data']);
        //
        if (isset($response->Address->Error)) {
            return $this->sendResponse(200, ['errors' => [
                $response->Address->Error->Description
            ]]);
        }
        //
        return $this->sendResponse(200, ['success' => $response]);
    }

    /**
     * Handles mailing address entries
     */
    public function saveMailingAddress()
    {
        // Get a clean post
        $post = getPost()['finalMailingAddressObj'];
        //
        if (empty($post)) {
            return $this->sendResponse(401);
        }
        // Prepare insert array
        $ins = [];
        $ins['ip_address'] = getUserIP();
        $ins['country_code'] = $post['country'];
        $ins['state_code'] = $post['state'];
        $ins['city'] = $post['city'];
        $ins['zipcode'] = $post['zipcode'];
        $ins['address_1'] = $post['address_1'];
        $ins['address_2'] = $post['address_2'];
        $ins['zipcode5'] = isset($post['zipcode5']) ? $post['zipcode5'] : NULL;
        $ins['created_at'] = $ins['updated_at'] = date('Y-m-d H:i:s', strtotime('now'));

        //
        $db = new App_model();
        $insertId = $db->insert(
            'mailing_address',
            $ins
        );
        if ($insertId != 0) {
            return $this->sendResponse(200, ['success' => true]);
        }
        return $this->sendResponse(200, ['error' => true]);
    }

    /**
     * Sends response to client
     *
     * @param int   $statusCode
     * @param array $response
     */
    private function sendResponse(int $statusCode, array $response = [])
    {
        if ($statusCode == 401) {
            header("HTTP/1.1 401 Unauthorized");
        }
        //
        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    }
}
