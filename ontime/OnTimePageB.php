<?php
trait PageB{

	
//  background-image: linear-gradient(180deg, red, yellow);
	
	function GetFtrCnt($coneiner){
		$this->err='0';
		$this->retval=[];
		if ($this->ot_qexist($coneiner)) {
				$this->retval = $this->ot_readif('content.json',$coneiner);
		} else {
			$this->err="C0010M019";
		}
		$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $this->retval );
		return $this->retval;
	}	
}
?>