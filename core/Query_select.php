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

require_once 'core/Form_class.php';

class Query_select extends form_class{

	protected $__tableName;



	protected $__data;



	protected $__where;



	protected $sync__join;



	protected $sync__type;



	protected $sync__array;


	protected $ds;


	protected $dt;



	public function connect(){
		return Connect::getConnection();
	}

	public function close(){
		Connect::close();
	}


	/**
	*FUNCTION NAME INSERT DATA
	*@link http://sync-framework.net/core
	*@param $tableName is a string
	*@param $data is an array
	*@return array string
	*===========================================================
	*/

	public static function insert_data($__tableName ='',$__data = array()){
		if(is_array($__data)){
				$dt='';$ds='';
				$sql = "INSERT INTO `".$__tableName."` SET ";
				foreach($__data as $field => $value){
					$ds.= $field."='".$value."',";
				}
				$dsa = rtrim($ds, ',');

				$insert = $sql.$dsa;
				if(defined('QUERY')){
					ob_end_clean();
					echo $insert;
					die();
				}
				$result = mysqli_query(Connect::getConnection(), $sql.$dsa);
				if(!$result){
						throw new Exception('Failed save data to table '.$__tableName.mysqli_error(Connect::getConnection()));
				}
		}else{
				throw new Exception('Cannot read some variable:'.mysqli_error(Connect::getConnection()));
		}
	}



	/**
	*FUNCTION NAME UPDATE_DATA
	*@link http://sync-framework.net
	*@param $tableName is string value
	*@param $data is array multi dimensi value
	*@param @where is array multi dimensi value
	*@return array data
	*=========================================================================
	*/

	public static function update_data($tableName ='',$data = array(), $where = array()){
		$where_data ='';$fields='';
		if($tableName!==''){

				$sql = "UPDATE `".$tableName."` SET";

				if(is_array($data)){
						foreach($data as $field => $val){
							$fields.= $field."='".$val."',";
						}

						$fields =rtrim($fields, ',');
				}

				if(is_array($where)){
						$where_dataS ="WHERE";
						foreach ($where as $key => $value) {
							$where_data.= $key."=".$value." AND";
						}
						$where_data = $where_dataS.' '.rtrim($where_data,"AND");
				}
				$sql = $sql.' '.$fields.' '.$where_data;
				if(defined('QUERY')){
					ob_end_clean();
					echo $sql;
					die();
				}
				$result = mysqli_query(Connect::getConnection(), $sql);

				if(!$result){
						throw new Exception('Failed update data to table '.$tableName.mysqli_error(Connect::getConnection()));
				}
		}else{
				throw new Exception('Cannot read some variable:'.mysqli_error(Connect::getConnection()));
		}
	}



	/**
	*@param $sync__array is array data
	*@param $sync__str is array data
	*@return array data
	*/


	function join($sync_array = '',$sync__str = array()){
			$sync__array = array("INNER","FULL","RIGHT","LEFT","CROSS","OUTER","STRAIGHT","JOIN");
			$sync__type = explode(" ",$sync__array);

			$sql = "";

			if($sync__type>1){
					for($a=0;$a<count($sync__type);$a++){
							if(in_array($sync__type[$a],$sync_array)){
									$sql .= $sync__type[$a]." ";
							}else{
									$sql.= $sync__type[$a];
							}
					}
			}

			foreach ($sync__str as $key => $value) {
					$sql.="ON ".$key."=".$value;
			}

			return $sql;

	}






	/**
	*@param $tableName is a table
	*@param $where is a condition
	*@return array data
	*/

	public static function delete_data($tableName, $where = array()){
		$where_data='';
		if($tableName!==''){
				$sql = "DELETE FROM ".$tableName;
				if(is_array($where)){
						$where_is=" WHERE";
						foreach ($where as $key => $value) {
							$where_data .= $key."=".$value." AND ";
						}
						$where_data = $where_is.' '.rtrim($where_data,"AND ");
				}
				$sql = $sql.$where_data;
				if(defined('QUERY')){
					ob_end_clean();
					echo $sql;
					die();
				}
				$result = mysqli_query(Connect::getConnection(), $sql);
				if(!$result){
						throw new Exception('Failed delete data to table '.$__tableName.mysqli_error(Connect::getConnection()));
				}
		}else{
				throw new Exception('Cannot read some variable:'.mysqli_error(Connect::getConnection()));
		}
	}







	/**
	*@param $field is array
	*@param $tableName is a table
	*@param $where is a condition query
	*@return string array data
	*/
	public static function view_data($field = '',$tableName='',$where='',$order='',$start='',$limit=''){
			$paging='';
			include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'Select.php';
			$data = '*';$wheres='';$where_data='';
			 if(is_array($field)){
			 		foreach ($field as $value) {
			 				$data.=$value.',';
			 		}
			 }else{
			 		$data=$field;
			 }
			 $data = rtrim($data,',');
			$sql = 'SELECT '.$data." FROM ".$tableName;

			if(is_array($where)){
					$wherea = " WHERE ";
					foreach ($where as $key => $value) {
							$wheres.= $key." = ".$value." AND ";
					}
					$wherea = $wherea.rtrim($wheres," AND ");
			}else{
					$wherea='';
			}

			if($start!=='' && $limit!==''){
					$paging = " LIMIT ".$start.",".$limit;
					$this::pagging();
			}
			if(is_array($order)){
					$order_key=" ORDER BY ".$order[0].' '.$order[1];
			}else{
					$order_key='';
			}
			$sql = $sql.$wherea.$order_key.$paging;
			if(defined('QUERY')){
				ob_end_clean();
				echo $sql;
				die();
			}

			return new Select($sql);
	}



	public function select($field = array()){
			$st='';$sql = "SELECT ";
			if(is_array($field)){

					foreach ($field as $value) {
							$st.=$value.',';
					}

					$st = $sql.rtrim($st,',');
			}else{
					$st = $field;
			}

			$sql = $sql.$st;

			return $sql;
	}





	public function from($table=''){
			$st = '';
			$sql ="FROM ";
			if($table!==''){
					$sql.= $table;
			}else{
					$this::error_query('Can nor find '.$tableName);
			}


			return $sql;
	}





	public function where_and($where = array()){
			$st='';
			if(is_array($where)){
					foreach ($where as $key => $value) {
							$st.=$key.'='.$value.' AND ';
					}

					$st = $st.rtrim($st,'AND');
			}


			return $st;
	}




	public function where_or($where = array()){
			$st='';
			if(is_array($where)){
					foreach ($where as $key => $value) {
								$st.=$key.'='.$value.' OR ';
					}

					$st = $st.rtrim($st,'AND');
			}

			return $st;
	}

}
