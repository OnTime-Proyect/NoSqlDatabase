<?php
trait CoreD{
		function ErrAdd($key, $value){
		if ($this->ot_can('create','main')){
			$this->errtext=$this->ot_add($key,$value,$this->errtext,'error.json');
		}
		$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $this->retval );
		return $this->retval;
	}	
	function ErrChg($key, $value){
		if ($this->ot_can('change','main')){
			$this->errtext=$this->ot_change($key,$value,$this->errtext,'error.json');
		}
		$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $this->retval );
		return $this->retval;
	}	
	function ErrDlt($key){
		if ($this->ot_can('remove','main')){
			$this->errtext=$this->ot_delete($key,$this->errtext,'error.json');
		}
		$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $this->retval );
		return $this->retval;
	}

	function UsrAddMn($User, $level){
		if ($this->ot_can('create','main')) {
			if ($this->ot_exist($User,'usr')) {
				if ($this->ot_in($level,$this->level)) {
					$this->ot_addin('main',$level,'features.json','usr/'.$User);
					$this->ot_addin($User,$level,'users.json');
				}
			}
		}
		$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $this->retval );
		return $this->retval;
	}
	
	
	function UsrChgMn($User, $level){
		if ($this->ot_can('change','main')) {
			if ($this->ot_exist($User,'usr')) {
				if ($this->ot_in($level,$this->level)) {
					if ($this->not_value($User,'admin','C0010M036')) {				
						$this->ot_changein('main',$level,'features.json','usr/'.$User);
						$this->ot_changein($User,$level,'users.json');
					}
				}
			}
		}
		$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $this->retval );
		return $this->retval;
	}	
	function UsrDltMn($User){
		if ($this->ot_can('remove','main')) {
			if ($this->ot_exist($User,'usr')) {
				if ($this->not_value($User,'admin','C0010M036')) {				
					$this->ot_deletein('main','features.json','usr/'.$User);
					$this->ot_deletein($User,'users.json');
				}
			}
		}
		$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $this->retval );
		return $this->retval;
	}	
	function FtrAddPrv($feature,$key,$value){
		if ($this->ot_exist($feature)) {
			if ($this->ot_can('change',$feature)) {
				$this->ot_addin($key,$value,'private.json',$feature);
			}
		}
		$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $this->retval );
		return $this->retval;
	}
	function FtrChgPrv($feature, $key, $value){
		if ($this->ot_exist($feature)) {
			if ($this->ot_can('change',$feature)) {
				$this->ot_changein($key,$value,'private.json',$feature);
			}
		}
		$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $this->retval );
		return $this->retval;
	}
	function FtrDltPrv($feature, $key){
		if ($this->ot_exist($feature)) {
			if ($this->ot_can('change',$feature)) {
				$this->ot_deletein($key,'private.json',$feature);
			}
		}
		$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $this->retval );
		return $this->retval;
	}	
	function FtrAddPbl($feature, $key, $value){
		if ($this->ot_exist($feature)) {
			if ($this->ot_can('change',$feature)) {
				$this->ot_addin($key,$value,'public.json',$feature);
			}
		}
		$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $this->retval );
		return $this->retval;
	}	
	function FtrChgPbl($feature, $key, $value){
		if ($this->ot_exist($feature)) {
			if ($this->ot_can('change',$feature)) {
				$this->ot_changein($key,$value,'public.json',$feature);
			}
		}
		$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $this->retval );
		return $this->retval;
	}	
	function FtrDltPbl($feature, $key){
		if ($this->ot_exist($feature)) {
			if ($this->ot_can('change',$feature)) {
				$this->ot_deletein($key,'public.json',$feature);
			}
		}
		$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $this->retval );
		return $this->retval;
	}
	function FtrShwPrv($feature){
		$this->retval=[];
		if ($this->ot_can('access',$feature)) {
			if ($this->ot_exist($feature)) {
				$this->retval=$this->ot_readif('private.json',$feature);
			}
		}
		$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $this->retval );
		return $this->retval;
	}		
	function UserShwPbl($User){
		$atmp=[];
		if ($this->ot_connect()) {
			if ($this->ot_exist($User,'usr')) {
				$atmp=$this->ot_readif('public.json','usr/'.$User);
				$atmp2=$this->ot_readif('admin.json','usr/'.$User);
				$atmp['name']=$atmp2['name'];
				$atmp['nick']=$atmp2['nick'];
			}
		}
		$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $atmp );
		return $atmp;
	}
	function MyAddPbl($key, $value){
		if ($this->ot_connect()) {
			$this->user=$this->ot_add($key,$value,$this->user,'public.json','usr/'.$this->id);
		}
		$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $this->retval );
		return $this->retval;
	}	
	function MyChgPbl($key, $value){
		if ($this->ot_connect()) {
			$this->user=$this->ot_change($key,$value,$this->user,'public.json','usr/'.$this->id);
		}
		$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $this->retval );
		return $this->retval;
	}
	function MyDltPbl($key){
		if ($this->ot_connect()) {
			$this->user=$this->ot_delete($key,$this->user,'public.json','usr/'.$this->id);
		}
		$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $this->retval );
		return $this->retval;
	}	
	function MyAddPrv($key, $value){
		if ($this->ot_connect()) {
			$this->userp=$this->ot_add($key,$value,$this->userp,'private.json','usr/'.$this->id);
		}
		$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $this->retval );
		return $this->retval;
	}	
	function MyChgPrv($key, $value){		
		if ($this->ot_connect()) {
			$this->userp=$this->ot_change($key,$value,$this->userp,'private.json','usr/'.$this->id);
		}
		$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $this->retval );
		return $this->retval;
	}	
	function MyDltPrv($key){	
		if ($this->ot_connect()) {
			$this->userp=$this->ot_delete($key,$this->userp,'private.json','usr/'.$this->id);
		}
		$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $this->retval );
		return $this->retval;
	}	
	function FtrShwPbl($feature){
		$this->retval=[];
		$this->retval=$this->ot_readif('public.json',$feature);;
		$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $this->retval );
		return $this->retval;
	}

}
?>