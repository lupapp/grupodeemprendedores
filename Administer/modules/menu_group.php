<?php
/**
 * Controller for all menu group actions
 * (add/edit/delete) group
 */
class Menu_group extends GController {

	/**
	 * Constructor. Check if user is logged in.
	 */
	public function __construct() {
		parent::__construct();
		$this->check_user();
	}

	/**
	 * Add group action
	 * or
	 * Show add group form
	 */
	public function add() {
		if (isset($_POST['title'])) {
			$data[MENUGROUP_TITLE] = trim($_POST['title']);
			if (!empty($data[MENUGROUP_TITLE])) {
				if ($this->db->insert(MENUGROUP_TABLE, $data)) {
					$response['status'] = 1;
					$response['id'] = $this->db->Insert_ID();
				} else {
					$response['status'] = 2;
					$response['msg'] = 'Add group error.';
				}
			} else {
				$response['status'] = 3;
			}
			header('Content-type: application/json');
			echo json_encode($response);
		} else {
			$this->view('menu_group_add');
		}
	}

	/**
	 * Edit menu group action
	 */
	public function edit() {
		if (isset($_POST['title'])) {
			$id = (int)$_POST['id'];
			$data[MENUGROUP_TITLE] = trim($_POST['title']);
			$response['success'] = false;
			if ($this->db->update(MENUGROUP_TABLE, $data, MENUGROUP_ID . ' = ' . $id)) {
				$response['success'] = true;
			}
			header('Content-type: application/json');
			echo json_encode($response);
		}
	}

	/**
	 * Delete group action
	 * This will also delete all menu items under this group
	 */
	public function delete() {
		if (isset($_POST['id'])) {
			$id = (int)$_POST['id'];
			if ($id == 1) {
				$response['success'] = false;
				$response['msg'] = 'Cannot delete Group ID = 1';
			} else {
				$sql = sprintf('DELETE FROM %s WHERE %s = %s', MENUGROUP_TABLE, MENUGROUP_ID, $id);
				$delete = $this->db->Execute($sql);
				if ($delete) {
					$sql = sprintf('DELETE FROM %s WHERE %s IN (%s)', MENU_TABLE, MENU_GROUP, $id);
					$this->db->Execute($sql);
					$response['success'] = true;
				} else {
					$response['success'] = false;
				}
			}
			header('Content-type: application/json');
			echo json_encode($response);
		}
	}
}

/* End of menu_group.php */