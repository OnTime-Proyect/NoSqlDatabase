<?php
trait AdvTableA{	
	function CrtATbIn($table, $desc,   $recname ='same' , $autocalc ='no', $feature='advance')
	{
		$this->VldClr();	
		if ($this->ot_can('change','advance') and $this->ot_can('change',$feature)) {
   			$tmp = $this->ot_readif('index.tas',$feature);
			if ($this->not_in($table,$tmp) ){
				if ( $recname == 'same' ) {
					$recname=$table;
				}
				$this->RcdAddIn($recname,'Id', array('FldEmp'=>FALSE));
				$this->RcdAddIn($recname,'RecId', array('FldEmp'=>FALSE));
				$this->RcdAddIn($recname,'Name', array('FldEmp'=>FALSE));
				$this->RcdAddIn($recname,'WnrId', array('FldEmp'=>FALSE));
				$this->RcdAddIn($recname,'CtdId', array('FldEmp'=>FALSE));
				$this->RcdAddIn($recname,'CtdDtt', array('FldEmp'=>FALSE));
				$this->RcdAddIn($recname,'LstdId', array('FldEmp'=>FALSE));
				$this->RcdAddIn($recname,'LstDtt', array('FldEmp'=>FALSE));
				$this->RcdAddIn($recname,'CrrStt', array('FldEmp'=>FALSE));
				$this->RcdAddIn($recname,'SttID', array('FldEmp'=>FALSE));
				$this->RcdAddIn($recname,'SttDtt', array('FldEmp'=>FALSE));
				$this->RcdAddIn($recname,'CrrStp', array('FldEmp'=>TRUE));
				$this->RcdAddIn($recname,'StpId', array('FldEmp'=>FALSE));
				$this->RcdAddIn($recname,'StpDtt', array('FldEmp'=>FALSE));
				if ($this->ot_exist($recname.'.rcd','record')) {
					$this->ot_addin($table,$desc,'index.tas',$feature);
					$this->ot_addin($feature.'/'.$table, $this->id, $recname.'.ntb','record');
					$this->ot_addin('table',$table, $table.'.tin',$feature);
					$this->ot_addin('in',$feature, $table.'.tin',$feature);
					$this->ot_addin('record',$recname, $table.'.tin',$feature);
					$this->ot_addin('status','open',$table.'.tin',$feature);
					$this->ot_addin('records','0',$table.'.tin',$feature);
					$this->ot_addin('Advance','yes',$table.'.tin',$feature);
					$this->ot_addin('pre','',$table.'.tin',$feature);
					$this->ot_addin('sec',0,$table.'.tin',$feature);
					$this->ot_addin('post','',$table.'.tin',$feature);
					$this->ot_addin('calc',$autocalc,$table.'.tin',$feature);
					$this->ot_addin('RecId','unique',$table.'.ind',$feature);
					$this->ot_addin($this->id,'owner',$table.'.tus',$feature);
					$this->ot_addin($feature.'/'.$table.'.tus','owner','basic.acc','usr/'.$this->id);
				}
			}
		}
		$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $this->errvalid );
		return $this->retval;
	}

	function SetPfxIn($table, $prefix, $feature='advance'){
		if ($this->ot_can('change','advance') and $this->ot_can('change',$feature)) {
			$safety= $this->ot_safety_level($table,'b',$feature);
			if ($this->ot_level($safety,"change")) {
				if ( $this->ot_getinside($table,'index.tas',$feature))  {
					$this->ot_changein('pre',$prefix,$table.'.tin',$feature);
				}
			}
		}
	}

	function SetPstIn($table, $postfix, $feature='advance'){
		if ($this->ot_can('change','advance') and $this->ot_can('change',$feature)) {
			$safety= $this->ot_safety_level($table,'b',$feature);
			if ($this->ot_level($safety,"change")) {
				if ( $this->ot_getinside($table,'index.tas',$feature))  {
					$this->ot_changein('post',$postfix,$table.'.tin',$feature);
				}
			}
		}
	}

	function SetAutIn($table, $feature='advance'){
		if ($this->ot_can('change','advance') and $this->ot_can('change',$feature)) {
			$safety= $this->ot_safety_level($table,'b',$feature);
			if ($this->ot_level($safety,"change")) {
				if ( $this->ot_getinside($table,'index.tas',$feature))  {
					$this->ot_changein('calc','yes',$table.'.tin',$feature);
				}
			}
		}
	}

	function SetMnlIn($table, $feature='advance'){
		if ($this->ot_can('change','advance') and $this->ot_can('change',$feature)) {
			$safety= $this->ot_safety_level($table,'b',$feature);
			if ($this->ot_level($safety,"change")) {
				if ( $this->ot_getinside($table,'index.tas',$feature))  {
					$this->ot_addin('calc','no',$table.'.tin',$feature);
				}
			}
		}
	}

	function CrtIndIn($table, $Index, $feature='advance'){
		if ($this->ot_can('change','advance') and $this->ot_can('change',$feature)) {
			$safety= $this->ot_safety_level($table,'b',$feature);
			if ($this->ot_level($safety,"change")) {
				if ( $this->ot_getinside($table,'index.tas',$feature))  {
					$this->ot_addin($Index,$this->id,$table.'.ind',$feature);
				}
			}
		}
	}
		
	function CrtMDIn($Master,$Detail, $desc, $recname ='same' , $feature='advance'){
		
		
		
	}


}
?>