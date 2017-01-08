<?php


/****************************************************************************************
   **************************************************************************************
   ***                ****     *********     ****      ********    *****           ******
   ***      ***************     *******     *****       *******    ****     ****   ******
   ***         **************     ****     ******        ******    ****    **************
   ********           ********     **     *******    *    *****    ****    **************
   **************     **********        *********    **    ****    ****    **************
   *****              ***********      **********    ***     **    ****     *****   *****
   *****            *************      **********    ****          ******           *****
   **************************************************************************************
   **************************************************************************************
  *SYNC FRAMEWORK
  *IS DEVELOPMENT FORM FREE USED AND DEVELOP BY TERM AND CONDITION
  *AUTHOR BY SYNC FRAMEWORK TEAM
  *
  *FINAL PRODUCT 2016
  *REDISTRIBUTED BY FREE LICENSE
**/


include_once 'Connect.php';

class Select implements Iterator{

	protected $_query;
	protected $_sql;
	protected $_pointer = 0;
	protected $_numResult = 0;
	protected $_results = array();

	function __construct($sql){
		$this->_sql = $sql;
	}

	function rewind(){
		$this->_pointer = 0;
	}

	function key(){
		return $this->_pointer;
	}

	protected function _getQuery(){
		if(!$this->_query){
			$connection = Connect::getConnection();
			$this->_query = mysqli_query($connection, $this->_sql);
			if(!$this->_query){
				throw new Exception('Failed to read database:'.mysqli_error($connection));
			}
		}
		return $this->_query;
	}

	protected function _getNumResult(){
		if(!$this->_numResult){
			$this->_numResult = mysqli_num_rows($this->_getQuery());
		}
		return $this->_numResult;
	}

	function valid(){
		if($this->_pointer >= 0 && $this->_pointer < $this->_getNumResult()){
			return true;
		}
		return false;
	}

	protected function _getRow($pointer){
		if(isset($this->_results[$pointer])){
			return $this->_results[$pointer];
		}
		$row = mysqli_fetch_object($this->_getQuery());
		if($row){
			$this->_results[$pointer] = $row;
		}
		return $row;
	}

	function next(){
		$row = $this->_getRow($this->_pointer);
		if($row){
			$this->_pointer ++;
		}
		return $row;
	}

	function current(){
		return $this->_getRow($this->_pointer);
	}

	function close(){
		mysqli_free_result($this->_getQuery());
		Connect::close();
	}

}
