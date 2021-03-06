<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_privacy
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\Component\Privacy\Administrator\Table;

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Table\Table;
use Joomla\Database\DatabaseDriver;

/**
 * Table interface class for the #__privacy_requests table
 *
 * @property   integer  $id                        Item ID (primary key)
 * @property   string   $email                     The email address of the individual requesting the data
 * @property   string   $requested_at              The time the request was created at
 * @property   integer  $status                    The status of the information request
 * @property   string   $request_type              The type of information request
 * @property   string   $confirm_token             Hashed token for confirming the information request
 * @property   string   $confirm_token_created_at  The time the confirmation token was generated
 *
 * @since  3.9.0
 */
class RequestTable extends Table
{
	/**
	 * The class constructor.
	 *
	 * @param   DatabaseDriver  $db  DatabaseDriver connector object.
	 *
	 * @since   3.9.0
	 */
	public function __construct(DatabaseDriver $db)
	{
		parent::__construct('#__privacy_requests', 'id', $db);
	}

	/**
	 * Method to store a row in the database from the Table instance properties.
	 *
	 * @param   boolean  $updateNulls  True to update fields even if they are null.
	 *
	 * @return  boolean  True on success.
	 *
	 * @since   3.9.0
	 */
	public function store($updateNulls = false)
	{
		$date = Factory::getDate();

		// Set default values for new records
		if (!$this->id)
		{
			if (!$this->status)
			{
				$this->status = '0';
			}

			if (!$this->requested_at)
			{
				$this->requested_at = $date->toSql();
			}
		}

		return parent::store($updateNulls);
	}
}
