<?php
trait GrpsD{	
	function GrpAddPrv($group, $code, $value){
		if ($this->ot_exist($group,'grp')) {
			$atmp=$this->ot_readif('users.json','grp/'.$group);
			if ($this->ot_maxvalue($atmp[$this->id],2,"C0010M012")) {
				$this->ot_addin($code,$value,'private.json','grp/'.$group);
			}
		}
		$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $this->retval );
		return $this->retval;
	}	
	function GrpChgPrv($group, $code, $value){
		if ($this->ot_exist($group,'grp')) {
			$atmp=$this->ot_readif('users.json','grp/'.$group);
			if ($this->ot_maxvalue($atmp[$this->id],3,"C0010M012")) {
				$this->ot_changein($code,$value,'private.json','grp/'.$group);
			}
		}
		$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $this->retval );
		return $this->retval;
	}	
	function GrpDltPrv($group, $code){
		if ($this->ot_exist($group,'grp')) {
			$atmp=$this->ot_readif('users.json','grp/'.$group);
			if ($this->ot_maxvalue($atmp[$this->id],1,"C0010M012")) {
				$this->ot_deletein($code,'private.json','grp/'.$group);
			}
		}
		$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $this->retval );
		return $this->retval;
	}

	function GrpShwPbl($group){
		$this->retval=[];
		if ($this->ot_exist($group,'grp')) {
			$this->retval=$this->ot_readif('public.json','grp/'.$group);
		}
		$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $this->retval );
		return $this->retval;
	}	
	function GrpAddPbl($group, $code, $value){
		if ($this->ot_exist($group,'grp')) {
			$atmp=$this->ot_readif('users.json','grp/'.$group);
			if ($this->ot_maxvalue($atmp[$this->id],2,"C0010M012")) {
				$this->ot_addin($code,$value,'public.json','grp/'.$group);
			}
		}
		$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $this->retval );
		return $this->retval;
	}
	function GrpChgPbl($group, $code, $value){
		if ($this->ot_exist($group,'grp')) {
			$atmp=$this->ot_readif('users.json','grp/'.$group);
			if ($this->ot_maxvalue($atmp[$this->id],3,"C0010M012")) {
				$this->ot_changein($code,$value,'public.json','grp/'.$group);
			}
		}
		$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $this->retval );
		return $this->retval;
	}	
	function GrpDltPbl($group, $code){
		if ($this->ot_exist($group,'grp')) {
			$atmp=$this->ot_readif('users.json','grp/'.$group);
			if ($this->ot_maxvalue($atmp[$this->id],1,"C0010M012")) {
				$this->ot_deletein($code,'public.json','grp/'.$group);
			}
		}
		$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $this->retval );
		return $this->retval;
	}	
	function GrpShwPrv($group){
		$this->retval=[];
		if ($this->ot_exist($group,'grp')) {
			$atmp=$this->ot_readif('users.json','grp/'.$group);
			if ($this->ot_maxvalue($atmp[$this->id],10,"C0010M012")) {
				$this->retval=$this->ot_readif('private.json','grp/'.$group);
			}
		}
		$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $this->retval );
		return $this->retval;
	}
	
}
?>