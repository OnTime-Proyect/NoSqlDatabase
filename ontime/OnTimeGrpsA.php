<?php
trait GrpsA{	
	function CrtGrp($group,$name,$nick){
		if ($this->ot_connect()) {
			if ($this->ot_can('create','grp')) {
				if ($this->not_exist($group, 'grp')) {
					if ($this->ot_create($group, 'grp')) {
						$this->ot_array(array('nick'=>$nick,'name'=>$name), 'admin.json', TRUE,'grp/'.$group);	
						$this->ot_addin($this->id,'owner','users.json','grp/'.$group);
						$this->ot_addin($group,'owner','groups.json','usr/'.$this->id);
					}
				}
			}
		}
		$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $this->retval );
		return $this->retval;
	}
	function GrpAddFtr($group, $Feature, $level){
		if ($this->ot_exist($group,'grp')) {
			if ($this->ot_can('access',$Feature)) {
				$atmp=$this->ot_readif('users.json','grp/'.$group);
				if ($this->ot_maxvalue($atmp[$this->id],2,"C0010M012")) {
					if ($this->ot_exist($Feature)) {
						$this->ot_addin($Feature,$level,'features.json','grp/'.$group);
						$this->ot_addin($group,$level,'groups.json',$Feature);										}
				}
			}
		}
		$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $this->retval );
		return $this->retval;
	}	
	function GrpChgFtr($group, $Feature, $level){
		if ($this->ot_exist($group,'grp')) {
			if ($this->ot_can('access',$Feature)) {
				$atmp=$this->ot_readif('users.json','grp/'.$group);
				if ($this->ot_maxvalue($atmp[$this->id],3,"C0010M012")) {
					if ($this->ot_exist($Feature)) {
						$this->ot_changein($Feature,$level,'features.json','grp/'.$group);
						$this->ot_changein($group,$level,'groups.json',$Feature);										}
				}
			}
		}
		$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $this->retval );
		return $this->retval;
	}	
	function GrpDltFtr($group, $Feature){
		if ($this->ot_exist($group,'grp')) {
			if ($this->ot_can('access',$Feature)) {
				$atmp=$this->ot_readif('users.json','grp/'.$group);
				if ($this->ot_maxvalue($atmp[$this->id],3,"C0010M012")) {
					if ($this->ot_exist($Feature)) {
						$this->ot_deletein($Feature,'features.json','grp/'.$group);
						$this->ot_deletein($group,'groups.json',$Feature);											}
				}
			}
		}
		$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $this->retval );
		return $this->retval;
	}	
}
?>