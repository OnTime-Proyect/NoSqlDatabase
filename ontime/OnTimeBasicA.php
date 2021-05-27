<?php
trait BasicA{	
	function CrtFtrBsc($feature){
		if ($this->ot_can('create','basic')) {
			If ($this->ot_can('create',$feature)) {
				if ($this->ot_exist($feature)){
					if ($this->not_exist('index.bas',$feature)){
						$this->ot_addin('index','Main index','index.bas',$feature);
						$this->ot_addin($this->id,'owner','index.bus',$feature);
						$this->ot_addin($feature.'/index.bus','owner','basic.acc','usr/'.$this->id);
					}
				}
			}
		}
		$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $this->retval );
		return $this->retval;
	}
	function CrtBscIn($code, $desc, $feature='basic')
	{
		$safety= $this->ot_safety_level('index','b',$feature);
		if ($this->ot_level($safety,"change")){
   			$tmp = $this->ot_readif('index.bas',$feature);
			if ( $this->not_in($code,$tmp) ){
				$this->ot_addin($code,$desc,'index.bas',$feature);
				$this->ot_addin($this->id,'owner',$code.'.bus',$feature);
				$this->ot_addin($feature.'/'.$code.'.bus','owner','basic.acc','usr/'.$this->id);
			}
		}
		$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $this->retval );
		return $this->retval;
	}
	function InsCntIn($data,$value,$code, $feature='basic'){
		$safety= $this->ot_safety_level($code,'b',$feature);
		if ($this->ot_level($safety,"insert")){
   			$tmp = $this->ot_readif('index.bas',$feature);
			if ( $this->ot_in($code,$tmp) ){
				$this->ot_addin($data,$value,$code.'.bas',$feature);
			}
		}
		$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $this->retval );
		return $this->retval;
	}
	function UpnCntIn($data,$value,$code, $feature='basic'){
		$safety= $this->ot_safety_level($code,'b',$feature);
		if ($this->ot_level($safety,"insert")){
   			$tmp = $this->ot_readif('index.bas',$feature);
			if ( $this->ot_in($code,$tmp) ){
				$this->ot_addchangein($data,$value,$code.'.bas',$feature);
			}
		}
		$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $this->retval );
		return $this->retval;
	}
	function UpdCntIn($data,$value,$code, $feature='basic'){
		$safety= $this->ot_safety_level($code,'b',$feature);
		if ($this->ot_level($safety,"update")){
   			$tmp = $this->ot_readif('index.bas',$feature);
			if ( $this->ot_in($code,$tmp) ){
				$this->ot_changein($data,$value,$code.'.bas',$feature);
			}
		}
		$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $this->retval );
		return $this->retval;
	}
	function DltCntIn($data,$code, $feature='basic'){
		$safety= $this->ot_safety_level($code,'b',$feature);
		if ($this->ot_level($safety,"delete")){
   			$tmp = $this->ot_readif('index.bas',$feature);
			if ( $this->ot_in($code,$tmp) ){
				$this->ot_deletein($data,$code.'.bas',$feature);
			}
		}
		$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $this->retval );
		return $this->retval;
	}
	function RmvBscIn($code, $feature='basic')
	{
		$safety= $this->ot_safety_level('index','b',$feature);
		if ($this->ot_level($safety,"change")){
   			$tmp = $this->ot_readif('index.bas',$feature);
			if ( $this->ot_in($code,$tmp) ){
				$this->ot_deleteinside($code.'.ban',$feature);
				$this->ot_deleteinside($code.'.bpl',$feature);
	   			$tmp = $this->ot_readif($code.'.bgr',$feature);
				foreach ($tmp as $clave => $valor) {
					$this->ot_deletein($code, $feature.'.acc','grp/'.$clave);
				}
				$this->ot_deleteinside($code.'.bgr',$feature);
	   			$tmp = $this->ot_readif($code.'.bus',$feature);
				foreach ($tmp as $clave => $valor) {
					$this->ot_deletein($code, $feature.'.acc','usr/'.$clave);
				}
				$this->ot_deleteinside($code.'.bus',$feature);
				$this->ot_deleteinside($code.'.bas',$feature);
				$this->ot_deletein($code,'index.bas',$feature);
			}
		}
		$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $this->retval );
		return $this->retval;
	}
}
?>