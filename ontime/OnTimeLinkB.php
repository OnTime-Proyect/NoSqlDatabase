<?php
trait LinkB{

	function InsLtbIn($table, $field, $data, $kind='last', $related='key', $feature='table')
	{
		$this->VldClr();	
		$safety= $this->ot_safety_level($table,'b',$feature);
		if ($this->ot_level($safety,"insert")) {
			if ( $this->ot_getinside($table,'index.tas',$feature))  {
				if ( $this->ot_lock($table,$feature)) {
					if ($this->ot_valid($field, $data, $this->info['record'])) {
						if ($this->ot_addin($this->retarr['key'], $this->retarr['record'],$table.'.tas',$feature)){
							if ($this->ot_value($this->info['linked'],'yes','no')){
								if ($this->not_qexist($table.'.lnk',$feature)){
									$this->info['first']=$this->retarr['key'];
									$this->info['last']=$this->retarr['key'];
								 	$this->ot_addin($this->retarr['key'],array('Prev'=>'%nome%','Next'=>'%nome%') ,$table.'.lnk',$feature);
								} else {
									$tmp = $this->not_read($table.'.lnk',$feature);
									$tmp2 = $this->ot_in($related, $tmp, 'C0010M056');
									if (!$this->retval){$kind='last';} 
									if ($kind=='last'){
										$last = $this->info['last'];
										$llast = $tmp[$last];
										$llast['Next'] = $this->retarr['key'];
										$this->info['last'] = $this->retarr['key'];
										$tmp [$last] = $llast;
										$tmp [ $this->retarr['key'] ] = array('Prev'=> $last,'Next'=>'%nome%'); 
									} else {
										if ($kind=='first'){
											$first = $this->info['last'];
											$ffirst = $tmp[$first];
											$ffirst['Prev'] = $this->retarr['key'];
											$this->info['first'] = $this->retarr['key'];
											$tmp [$first] = $ffirst;
											$tmp [ $this->retarr['key'] ] = array('Prev'=> '%nome%','Next'=>$first);
										} else {
											if ($this->ot_ina($kind,array('up','down','C0010M055'))){
												if ($kind=='up'){
													$up = $tmp2['Prev'];
													$tmp3 = $tmp[$up];
													$tmp [$related] = array('Prev'=>  $this->retarr['key'] ,'Next'=>$tmp2['Next']);
													$tmp [$up] = array('Prev'=>  $tmp3['Prev'] ,'Next'=> $this->retarr['key']);
													$tmp [ $this->retarr['key'] ] = array('Prev'=> $up,'Next'=>$related);
												} else {
													$down = $tmp2['Next'];
													$tmp3 = $tmp[$down];
													$tmp [$related] = array('Next'=>  $this->retarr['key'] ,'Prev'=>$tmp2['Prev']);
													$tmp [$down] = array('Next'=>  $tmp3['Next'] ,'Prev'=> $this->retarr['key']);
													$tmp [ $this->retarr['key'] ] = array('Next'=> $down,'Prev'=>$related);
												}
											}										
										}				
									}
									//save
								}						
							}
						}
					}
					$this->ot_un_lock($table,$feature);
				}
			}
		}
		$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $this->retarr );
		return $this->retval;
	}
	
	function dlLtblIn($table, $field, $feature='table')
	{
		$this->VldClr();	
		$safety= $this->ot_safety_level($table,'b',$feature);
		if ($this->ot_level($safety,"delete")) {
			if ( $this->ot_getinside($table,'index.tas',$feature))  {
				if ( $this->ot_lock($table,$feature)) {
					$this->ot_deletein($field, $table.'.tas',$feature);
					$this->ot_un_lock($table,$feature);
				}
			}
		}
		$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $this->retval );
		return $this->retval;
	}

	function UpdLtbIn($table, $field, $data, $feature='table')
	{
		$this->VldClr();	
		$safety= $this->ot_safety_level($table,'b',$feature);
		if ($this->ot_level($safety,"update")) {
			if ( $this->ot_getinside($table,'index.tas',$feature))  {
				if ( $this->ot_lock($table,$feature)) {
					if ($this->ot_valid($field, $data, $this->info['record'])) {
						$this->ot_changein($this->retarr['key'], $this->retarr['record'],$table.'.tas',$feature);
					}
					$this->ot_un_lock($table,$feature);
				}
			}
		}
		$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() ,  $this->retarr  );
		return $this->retval;
	}
	
	function UpmLtbIn($table, $field, $data, $feature='table')
	{
		$this->VldClr();	
		$safety= $this->ot_safety_level($table,'b',$feature);
		if ($this->ot_level($safety,"update")) {
			if ( $this->ot_getinside($table,'index.tas',$feature))  {
				if ( $this->ot_lock($table,$feature)) {
					if ($this->ot_getinside($field,  $table.'.tas', $feature, 'C0010M008')){	
						$data = array_merge ($this->retval,$data);
						if ($this->ot_valid($field, $data, $this->info['record'])) {
							$this->ot_changein($this->retarr['key'], $this->retarr['record'],$table.'.tas',$feature);
						}
					}
					$this->ot_un_lock($table,$feature);
				}
			}
		}
		$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $this->retarr  );
		return $this->retval;
	}

	
	
	
	function UpxLtbIn($table, $field, $feature='table', $kind='last', $related='key'){
		$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $this->retarr  );
		
		
		return $this->retval;		
	}


}
?>