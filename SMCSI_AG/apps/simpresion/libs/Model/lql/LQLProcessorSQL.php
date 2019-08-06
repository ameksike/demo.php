<?php
/**
 * @description LQL it's alternative LQL Processor suport for SQL
 * @author		Antonio Membrides Espinosa
 * @package    	model
 * @date		15/05/2013
 * @license    	GPL
 * @version    	1.0
 * @require		SQLDriver
 */
class LQLProcessorSQL extends LQLProcessor
{
	public function __construct($jobs=false){
		$this->jobs = $jobs ? $jobs : array(
				array('select', 'addSelect', 'delete', 'update', 'insert', 'drop', 'altee', 'create'),
                array('from', 'set'),
				array("leftJoin", "innerJoin", "rightJoin"),
				array("where", "andWhere", "orWhere", "addWhere"),
				array("groupBy", "having", "orderBy", "limit", "offset")
		);
	}
	public function clear(){
		$this->cache = '';
	}
	public function setting($cache=false){
		$this->cache = $cache ? $cache : $this->cache;
		return $this;
	}
	public function compile($struct, $force=false){
		if($force) $this->cache = '';
		if(empty($this->cache)) $this->cache = $this->generate($struct);
		return $this->cache;
	}
	protected function evaltype($value, $quote=false){
        switch(gettype($value)) {
            case "boolean":
                return $value ? 'true' : 'false';
            break;
            case "double":
            case "integer":
                return $value;
            break;
            case "string":
                return $quote ? is_string($value) ? "'$value'" : $value : $value;
            break;
            case "NULL":
            case "array":
            case "object":
            case "resource":
            case "unknown type":
                return "''";
            break;
        }
	}
	protected function evaluate($value, $quote=false){
		return is_a($value, 'LQL') ? "(" . $value->compile() . ")" : $this->evaltype($value, $quote);
	}
	protected function compare($data){
		$count = count($data);
		$field = $this->evaluate( $data[0] );
		$value = $count > 1 ? $this->evaluate($data[1], true) : '';
		$operator = $count > 2 ? $this->evaluate($data[2]) : ($count > 1 ? '=' : '');
		return "$field $operator $value";
	}
	protected function format($key, $value){
		if(empty($value)) return '';
		$index = strtoupper($key);
		switch($index){
			case "ADDSELECT": 	
				$name = is_string($value[1]) ? $value[1] : 'tmp';
				$alias = is_a($value[0], 'LQL') ? " AS $name " : (is_string($value[1]) ? " AS $name " : '');
				return ", ".$this->evaluate($value[0]).$alias; 
			break;
			case "ANDWHERE": 
			case "ADDWHERE": return " AND ". $this->compare($value); break;
			case "ORWHERE": return " OR ". $this->compare($value); break;
			case "WHERE": return " WHERE ". $this->compare($value); break;
            case "WHEREIN":
                $list = '';
                foreach($value[1] as $i)
                {
                    $pre = !empty($list) ? ', ' : '';
                    $list .=  $pre . $this->evaluate($i, true);
                }
                return " AND ".  $this->evaluate($value[0])  . ' IN (' . $list . ' )';
            break;
			case "DROP": 	return " DROP TABLE ".$this->evaluate($value[0]); break;
			case "ALTER": 	return " ALTER TABLE ".$this->evaluate($value[0]); break;
			case "CREATE": return "--Falta por implementar el CREATE;";  break;
			case "UPDATE": return " UPDATE ".$this->evaluate($value[0]) . ' SET ';  break;
            case "SET": return $this->evaluate($value[0]).'='.$this->evaluate($value[1]);  break;
			case "INSERT": 	
				return 	" INSERT INTO ".$this->evaluate($value[0]).
						" ( ".$this->evaluate($value[1])." ) ".
						" VALUE ( ".$this->evaluate($value[2], true)." ) "							
				; 
			break;
			case "RIGHTJOIN": 	
				$on = isset($value[1]) ? ' ON '.$this->evaluate($value[1]): '';
				$on .= isset($value[2]) ? ' = '.$this->evaluate($value[2]): '';	
				return " RIGHT JOIN ".$this->evaluate($value[0]).$on; 
			break; 
			case "LEFTJOIN": 	
				$on = isset($value[1]) ? ' ON '.$this->evaluate($value[1]): '';
				$on .= isset($value[2]) ? ' = '.$this->evaluate($value[2]): '';
				return " LEFT JOIN ".$this->evaluate($value[0]).$on; 
			break;
			case "INNERJOIN": 	
				$on = isset($value[1]) ? ' ON '.$this->evaluate($value[1]): '';
				$on .= isset($value[2]) ? ' = '.$this->evaluate($value[2]): '';
				return " INNER JOIN ".$this->evaluate($value[0]).$on; 
			break;
            case "FROM":
                $name = is_string($value[1]) ? $value[1] : 'tmp';
                $alias = is_a($value[0], 'LQL') ? " AS $name " : (is_string($value[1]) ? " AS $name " : '');
                return " ".$index." ".$this->evaluate($value[0]).$alias;
            break;
			case "GROUPBY": 	return " GROUP BY ".$this->evaluate($value[0]); break;
			default: 			return " ".$index." ".$this->evaluate($value[0]); break;
		}
	}
	protected function generate(&$tmp=false, $jobs=false){
		$str = '';
		$end = false;
		if(!$jobs){
			$jobs = $this->jobs;
			$end = true;
		}
		foreach($jobs as $job){
			if(is_array($job)){
				$str .= $this->generate($tmp, $job);
			}else{
				if(isset($tmp[$job])){
					foreach($tmp[$job] as $item)
						$str .= $this->format($job, $item);
					unset ($tmp[$job]);
				}
			}
		}
		if($end){
			foreach($tmp as $k=>$i){
				foreach($i as $item)
					$str .= $this->format($k, $item);
				unset ($tmp[$k]);
			}
		}
		return $str;
	}
}