<?php
defined('BASEPATH') or exit('No direct script access allowed');

class App extends CI_Controller
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function index()
	{
		$this->load->view('main');
	}

	/**
	 * Handles mailing address entries
	 */
	public function mailingAddressHandler()
	{
		// Get a clean post
		$post = $this->input->post(null, true);
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
		$post = $this->input->post('finalMailingAddressObj', true);
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
		$this->db->insert('mailing_address', $ins);
		//
		$insertId = $this->db->insert_id();
		//
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
