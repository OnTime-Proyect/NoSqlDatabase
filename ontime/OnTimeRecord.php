<?php
trait Record{	
	function CrtRcd($record, $desc)
	{
		$this->VldClr();	
		if ($this->ot_can('create','record')) {
			$this->ot_addin($record,$desc,'index.rcd','record');
		}
		$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $this->errvalid );
		return $this->retval;
	}	
	function ChgRcd($record, $desc)
	{
		$this->VldClr();	
		if ($this->ot_can('change','record')) {
			$this->ot_changein($record,$desc,'index.rcd','record');
		}
		$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $this->errvalid );
		return $this->retval;
	}
	function RmvRcd($record)
	{
		$this->VldClr();	
		if ($this->ot_can('remove','record')) {
			$this->ot_deletein($record,'index.rcd','record');
		}
		$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $this->errvalid );
		return $this->retval;
	}
	function RcdAddIn($record, $field, $data, $like='no')
	{
		$this->VldClr();	
		if ($this->ot_can('change','record')) {
			if ($this->ot_getinside($record,'index.rcd','record')) {
				if ($like=='no'){
					$like=$field;
				}
	   			if ($this->ot_getinside($like,'ddd.tas','ddd')){
	   				$rec = array('ByField'=>$this->retval,'ByRecord'=>$data);
					if ($this->retval['FldTpe']=='K') {
						$this->ot_addchangein('key',$field, $record.'.rcd','record');				
	   				}
				   	$this->ot_addin($field, $rec, $record.'.rcd','record');
				    $this->ot_addin('record/'.$record.'.rcd'.' like '.$field , $this->id, $like.'.nrc','ddd');
	   			}			
			}
		}
		$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $this->errvalid );
		return $this->retval;
	}
	function RcdChgIn($record, $field, $data, $like='no')
	{
		$this->VldClr();	
		if ($this->ot_can('change','record')) {
			if ($this->ot_getinside($record,'index.rcd','record')) {
				if ($like=='no'){
					$like=$field;
				}
				if ($this->ot_getinside($like,'ddd.tas','ddd')) {
					$rec = array('ByField'=>$this->retval,'ByRecord'=>$data);
					if ($this->retval['FldTpe']=='K') {
						$this->ot_addchangein('key',$field,$record.'.rcd','record');
					}
					$this->ot_changein($field, $rec, $record.'.rcd','record');
					$this->ot_changein('record/'.$record.'.rcd'.' like '.$field , $this->id, $like.'.nrc','ddd');
				}
			}
		}
		$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $this->errvalid );
		return $this->retval;
	}
	function RcdDltIn($record, $field, $like='no')
	{
		$this->VldClr();	
		if ($this->ot_can('change','record')) {
			if ($this->ot_getinside($record,'index.rcd','record')) {
				if ($like=='no'){
					$like=$field;
				}
				if ($this->ot_getinside($like,'ddd.tas','ddd')) {
					$rec = array('ByField'=>$this->retval,'ByRecord'=>$data);
					if ($this->retval['FldTpe']=='K') {
						$this->ot_addchangein('key',$field,$record.'.rcd','record');
					}			
					$this->ot_deletein($field, $record.'.rcd','record');
					$this->ot_deletein('record/'.$record.'.rcd'.' like '.$field , $like.'.nrc','ddd');
				}
			}
		}
		$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $this->errvalid );
		return $this->retval;
	}

	function ShwRecLst()
	{
		$this->VldClr();	
		if ($this->ot_can('change','record')) {
			$retval = $this->ot_readif('index.rcd','record');
		}
		$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $retval );
		return $retval;
	}

	function ShwRec($record)
	{
		$this->VldClr();
		if ($this->ot_can('change','record')) {
			$tmp = $this->ot_readif($record.'.rcd','record');
			$tmp2 = $this->ot_readif($record.'.ntb','record');
			$retval = array('definition'=>$tmp,'in'=>$tmp2);
		}
		$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $retval );
		return $retval;
	}

}
?>