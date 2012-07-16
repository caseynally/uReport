<?php
/**
 * A collection class for Media
 *
 * @copyright 2011-2012 City of Bloomington, Indiana
 * @license http://www.gnu.org/licenses/agpl.txt GNU/AGPL, see LICENSE.txt
 * @author Cliff Ingham <inghamn@bloomington.in.gov>
 */
class MediaList extends ZendDbResultIterator
{
	/**
	 * @param array $fields
	 */
	public function __construct($fields=null)
	{
		parent::__construct();

		$this->select->from('media');

		if (is_array($fields)) {
			$this->find($fields);
		}
	}

	/**
	 * Populates the collection
	 *
	 * @param array $fields
	 * @param string|array $order Multi-column sort should be given as an array
	 * @param int $limit
	 * @param string|array $groupBy Multi-column group by should be given as an array
	 */
	public function find($fields=null,$order='uploaded',$limit=null,$groupBy=null)
	{
		if (count($fields)) {
			foreach ($fields as $key=>$value) {
				if ($value) {
					$this->select->where("$key=?", $value);
				}
			}
		}
		$this->select->order($order);
		if ($limit) {
			$this->select->limit($limit);
		}
		if ($groupBy) {
			$this->select->group($groupBy);
		}
	}

	/**
	 * Loads a single object for the row returned from ZendDbResultIterator
	 *
	 * @param array $key
	 */
	protected function loadResult($key)
	{
		return new Media($this->result[$key]);
	}
}