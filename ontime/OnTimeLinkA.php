<?php
trait LinkA{	
	function CrtLtbIn($table, $desc, $recname ='same' , $feature='table', $kind=array('linked'))
	{
		$this->VldClr();	
		if ($this->ot_can('change','table') and $this->ot_can('change',$feature)) {
   			$tmp = $this->ot_readif('index.tas',$feature);
			if ($this->not_in($table,$tmp) ){
				if ($recname=='same') {
					$recname=$table;
				}
				if ($this->ot_exist($recname.'.rcd','record')) {
					$this->ot_addin($table,$desc,'index.tas',$feature);
					$this->ot_addin($feature.'/'.$table, $this->id, $recname.'.ntb','record');
					$this->ot_addin('record',$recname, $table.'.tin',$feature);
					$this->ot_addin('status','open',$table.'.tin',$feature);
					$this->ot_addin('records','0',$table.'.tin',$feature);
					$this->ot_addin('linked','yes',$table.'.tin',$feature);
					$this->ot_addin('mode','none',$table.'.tin',$feature);
					$this->ot_addin($this->id,'owner',$table.'.tus',$feature);
					$this->ot_addin($feature.'/'.$table.'.tus','owner','basic.acc','usr/'.$this->id);
				}
			}
		}
		$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $this->retval );
		return $this->retval;
	}	
	function RmvLbbIn($table,  $feature='table')
	{
		$this->VldClr();	
		if ($this->ot_can('change','table') and $this->ot_can('change',$feature)) {
			$tmp = $this->ot_readif('index.tas',$feature);
			if ($this->ot_in($table,$tmp) ) {
				if ($this->ot_getinside('record',$table.'.tin',$feature)) {
					$recname= $this->retval;
					$this->ot_deletein($table,'index.tas',$feature);
					$this->ot_deletein($feature.'/'.$table.'.tas', $this->id, $recname.'.ntb','record');
					$this->ot_deleteinside($table.'.tin',$feature,'no');
					$this->ot_deleteinside($table.'.tgr',$feature,'no');
					$this->ot_deleteinside($table.'.tus',$feature,'no');
					$this->ot_deleteinside($table.'.tan',$feature,'no');
					$this->ot_deleteinside($table.'.tpl',$feature,'no');
					$this->ot_deleteinside($table.'.lnk',$feature,'no');
					$this->ot_deleteinside($table.'.tas',$feature,'no');
				}
			}
		}
		$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $this->retval );
		return $this->retval;
	}
}
?>