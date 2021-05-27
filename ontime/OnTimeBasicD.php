<?php
trait BasicD{	
	function AddCntIn($code,$desc, $feature='basic'){
		$safety= $this->ot_safety_level('index','b',$feature);
		if ($this->ot_level($safety,"change")){
   			$tmp = $this->ot_readif('index.bas',$feature);
			if ( $this->not_in($code,$tmp) ){
				$this->ot_addin($code,$desc,'index.bas',$feature);
				$this->ot_addin($this->id,'owner',$code.'.bus',$feature);
				$this->ot_addin($code,'owner',$feature.'.acc','usr/'.$this->id);
			}
		}
		$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $this->retval );
		return $this->retval;
	}
	function AnnBscInAdd($code, $feature='basic'){
		$safety= $this->ot_safety_level($code,'b',$feature);
		if ($this->ot_level($safety,"create")){
			if ($this->not_exist($code.'.ban',$feature)){
				$this->ot_addin($this->id,'owner',$code.'.ban',$feature);				
			}
		}
		$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $this->retval );
		return $this->retval;
	}
	function AnnBscInRmv($code, $feature='basic'){
		$safety= $this->ot_safety_level($code,'b',$feature);
		if ($this->ot_level($safety,"remove")){
			if ($this->ot_exist($code.'.ban',$feature)){
				$this->ot_deleteinside($code.'.ban',$feature);
			}
		}
		$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $this->retval );
		return $this->retval;
	}
	function PblBscInAdd($code, $feature='basic'){
		$safety= $this->ot_safety_level($code,'b',$feature);
		if ($this->ot_level($safety,"create")){
			if ($this->not_exist($code.'.ban',$feature,"C0010M038")){
				if ($this->not_exist($code.'.bpl',$feature)){			
					$this->ot_addin($this->id,'owner',$code.'.bpl',$feature);
				}				
			}
		}
		$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $this->retval );
		return $this->retval;
	}
	function PblBscInRmv($code, $feature='basic'){
		$safety= $this->ot_safety_level($code,'b',$feature);
		if ($this->ot_level($safety,"remove")){
			if ($this->ot_exist($code.'.bpl',$feature)){
				$this->ot_deleteinside($code.'.bpl',$feature);
			}
		}
		$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $this->retval );
		return $this->retval;
	}
	function UsrBscInAdd($code, $user, $level ,$feature='basic'){
		$safety= $this->ot_safety_level($code,'b',$feature);
		if ($this->ot_level($safety,"create")){
			if ($this->ot_exist($user,'usr')) {
				if ($this->ot_in($level,$this->level)) {
					if ($this->ot_exist($code.'.bas',$feature)) {
						$this->ot_addin($user,$level,$code.'.bus',$feature);
						$this->ot_addin($code,$level,$feature.'.acc','usr/'.$user);	
					}
				}				
			}
		}
		$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $this->retval );
		return $this->retval;
	}
	function GrpBscInAdd($code, $group, $level ,$feature='basic'){
		if ($this->ot_feature('grp')){
			$safety= $this->ot_safety_level($code,'b',$feature);
			if ($this->ot_level($safety,"create")){
				if ($this->ot_exist($group,'grp')) {
					if ($this->ot_in($level,$this->level)) {
						if ($this->ot_exist($code.'.bas',$feature)) {
							$this->ot_addin($group,$level,$code.'.bgr',$feature);
							$this->ot_addin($code,$level,$feature.'.acc','grp/'.$group);	
						}				
					}
				}
			}
		}
		$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $this->retval );
		return $this->retval;
	}
	function UsrBscInChg($code, $user, $level ,$feature='basic'){
		$safety= $this->ot_safety_level($code,'b',$feature);
		if ($this->ot_level($safety,"change")){
			if ($this->ot_exist($user,'usr')) {
				if ($this->ot_in($level,$this->level)) {
					if ($this->ot_exist($code.'.bas',$feature)) {
						$this->ot_changein($user,$level,$code.'.bus',$feature);
						$this->ot_changein($code,$level,$feature.'.acc','usr/'.$user);	
					}
				}				
			}
		}
		$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $this->retval );
		return $this->retval;
	}
	function GrpBscInChg($code, $group, $level ,$feature='basic'){
		if ($this->ot_feature('grp')){
			$safety= $this->ot_safety_level($code,'b',$feature);
			if ($this->ot_level($safety,"create")){
				if ($this->ot_exist($group,'grp')) {
					if ($this->ot_in($level,$this->level)) {
						if ($this->ot_exist($code.'.bas',$feature)) {
							$this->ot_changein($group,$level,$code.'.bgr',$feature);
							$this->ot_changein($code,$level,$feature.'.acc','grp/'.$group);	
						}				
					}
				}
			}
		}
		$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $this->retval );
		return $this->retval;
	}
	function UsrBscInDlt($code, $user, $feature='basic'){
		$safety= $this->ot_safety_level($code,'b',$feature);
		if ($this->ot_level($safety,"remove")){
			if ($this->ot_exist($user,'usr')) {
				if ($this->ot_exist($code.'.bas',$feature)) {
					$this->ot_deletein($user,$code.'.bus',$feature);
					$this->ot_deletein($code,$feature.'.acc','usr/'.$user);	
				}				
			}
		}
		$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $this->retval );
		return $this->retval;
	}
	function GrpBscInDlt($code, $group, $level ,$feature='basic'){
		if ($this->ot_feature('grp')){
			$safety= $this->ot_safety_level($code,'b',$feature);
			if ($this->ot_level($safety,"remove")){
				if ($this->ot_exist($group,'grp')) {
					if ($this->ot_exist($code.'.bas',$feature)) {
						$this->ot_deletein($group,$level,$code.'.bgr',$feature);
						$this->ot_deletein($code,$level,$feature.'.acc','grp/'.$group);	
					}
				}
			}
		}
		$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $this->retval );
		return $this->retval;
	}
}
?>