<?php
trait GrpsB{
	function GrpShwAll(){
		$tmp=$this->ot_getin('ontime/grp');
		$value=[];
		foreach ($tmp as $iKey=> $iValue) {
			$value[$iKey]=$this->ot_name('grp',$iKey);
		}
		$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $value );
		return $value;
	}	
	function GrpShwUsr($group){
		if ($this->ot_exist($group,'grp')) {
			$atmp=$this->ot_readif('users.json','grp/'.$group);
			if ($this->ot_maxvalue($atmp[$this->id],10,"C0010M012")) {
				$this->retval=$atmp;
			}
		}
		$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $this->retval );
		return $this->retval;
	}
	function GrpAddUsr($group, $User, $level){
		if ($this->ot_exist($group,'grp')) {
			if ($this->ot_exist($User,'usr')) {
				if ($this->ot_group('insert',$group)) {
					if ($this->ot_in($level,$this->level)>=0) {
						$this->ot_addin($User,$level,'users.json','grp/'.$group);
						$this->ot_addin($group,$level,'groups.json','usr/'.$User);
					}		
				}
			}
		}
		$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $this->retval );
		return $this->retval;
	}	
	function GrpChgUsr($group, $User, $level){
		if ($this->ot_exist($group,'grp')) {
			if ($this->ot_group('update',$group)) {
				if ($this->ot_in($level,$this->level)>=0) {
					if ($this->ot_exist($User,'usr')) {
						$this->ot_changein($User,$level,'users.json','grp/'.$group);
						$this->ot_changein($group,$level,'groups.json','usr/'.$User);									}
				}
			}
		}
		$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $this->retval );
		return $this->retval;
	}	
	function GrpDltUsr($group, $User){
		if ($this->ot_exist($group,'grp')) {
			if ($this->ot_group('delete',$group)) {
				$this->ot_deletein($User,'users.json','grp/'.$group);
				$this->ot_deletein($group,'groups.json','usr/'.$User);									}
		}
		$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $this->retval );
		return $this->retval;
	}
	function FtrShwGrp($Feature){
		if ($this->ot_exist($Feature)) {
			$this->retval=$this->ot_readif('groups.json',$Feature);
		}
		$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $this->retval );
		return $this->retval;
	}
	function GrpShwFtr($group){
		if ($this->ot_exist($group,'grp')) {
			$atmp=$this->ot_readif('users.json','grp/'.$group);
			if ($this->ot_maxvalue($atmp[$this->id],10,"C0010M012")) {
				$this->retval=$this->ot_readif('features.json','grp/'.$group);
			}
		}
		$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $this->retval );
		return $this->retval;
	}	
}
?>