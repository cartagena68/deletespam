<?php
/*
*      OSCLass – software for creating and publishing online classified
*                           advertising platforms
*
*                        Copyright (C) 2010 OSCLASS
*
*       This program is free software: you can redistribute it and/or
*     modify it under the terms of the GNU Affero General Public License
*     as published by the Free Software Foundation, either version 3 of
*            the License, or (at your option) any later version.
*
*     This program is distributed in the hope that it will be useful, but
*         WITHOUT ANY WARRANTY; without even the implied warranty of
*        MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*             GNU Affero General Public License for more details.
*
*      You should have received a copy of the GNU Affero General Public
* License along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/
class ModelDeleteSpam extends DAO

{
	private static $instance;
	public static function newInstance()

	{
		if (!self::$instance instanceof self)
		{
			self::$instance = new self;
		}
		return self::$instance;
	}
	public function getSpamItemCron()

	{
		$this->dao->select();
		$this->dao->from(DB_TABLE_PREFIX . 't_item');
		$result = $this->dao->get();
		return $result->result();
	}
	public function GetCronTimeHourly()

	{
		$this->dao->select();
		$this->dao->from(DB_TABLE_PREFIX . 't_cron');
		$this->dao->where('e_type', 'HOURLY');
		$result = $this->dao->get();
		return $result->result();
	}
	public function GetCronTimeDaily()

	{
		$this->dao->select();
		$this->dao->from(DB_TABLE_PREFIX . 't_cron');
		$this->dao->where('e_type', 'DAILY');
		$result = $this->dao->get();
		return $result->result();
	}
	public function GetCronTimeWeekly()

	{
		$this->dao->select();
		$this->dao->from(DB_TABLE_PREFIX . 't_cron');
		$this->dao->where('e_type', 'WEEKLY');
		$result = $this->dao->get();
		return $result->result();
	}
}
?>
