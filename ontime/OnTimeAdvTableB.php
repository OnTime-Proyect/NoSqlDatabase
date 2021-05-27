<?php
trait AdvTableB{	

	function ShwTblMst($table,$feature='table'){
		$this->VldClr();	
		$retval=[];
		if ($this->ot_safety($table,'t',$feature)){
			$retval = $this->ot_readif($table.'.tas',$feature);
		}
		$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $this->errvalid  );
		return $retval;
	}
	function MntATbIn($table, $data, $feature='advance')
	{
		$this->VldClr();	
		$safety= $this->ot_safety_level($table,'b',$feature);
		if ($this->ot_level($safety,"update")) {
			if ( $this->ot_getinside($table,'index.tas',$feature))  {
				if ( $this->ot_lock($table,$feature)) {
					$this->dataresult = array();
					$datamemory = $this->ot_readif($table.'.tas',$feature);
					$index = $this->ot_readif($table.'_RecID.ind',$feature);
					$indexs = $this->ot_readif($table.'.ind',$feature);
					$sort = $this->ot_readif($table.'.srt',$feature);
					foreach ($data as $key=>$value) {
						$error = 0;
						if ( isset($value['movement']) ){
							if ( isset($value['WnrId']) ){
								$error=1; 
								$this -> ot_ae('C0010M060',$table,$key,$value,'WnrId');}
							else if ( isset($value['CtdId']) ){
								$error=1; 
								$this -> ot_ae('C0010M060',$table,$key,$value,'CtdId');}
							else if ( isset($value['CtdDtt']) ){
								$error=1; 
								$this -> ot_ae('C0010M060',$table,$key,$value,'CtdDtt');}
							else if ( isset($value['LstdId']) ){
								$error=1; 
								$this -> ot_ae('C0010M060',$table,$key,$value,'LstdId');}
							else if ( isset($value['LstDtt']) and ($value['movement']=='insert') ){
								$error=1; 
								$this -> ot_ae('C0010M060',$table,$key,$value,'LstDtt');}
							else if ( isset($value['CrrStt']) ){
								$error=1; 
								$this -> ot_ae('C0010M060',$table,$key,$value,'CrrStt');}
							else if ( isset($value['SttID']) ){
								$error=1; 
								$this -> ot_ae('C0010M060',$table,$key,$value,'SttID');}
							else if ( isset($value['CrrStp']) ){
								$error=1; 
								$this -> ot_ae('C0010M060',$table,$key,$value,'CrrStp');}
							else if ( isset($value['StpId']) ){
								$error=1; 
								$this -> ot_ae('C0010M060',$table,$key,$value,'StpId');}
							else if ( isset($value['StpDtt']) ){
								$error=1; 
								$this -> ot_ae('C0010M060',$table,$key,$value,'StpDtt');}
							else if ( isset($value['Id']) and ($value['movement'] == 'insert') ){
								$error=1; 
								$this -> ot_ae('C0010M060',$table,$key,$value,'Id');}
							else if ( !isset($value['Id']) and ($value['movement'] != 'insert') ){
								$error=1; 
								$this -> ot_ae('C0010M060',$table,$key,$value,'Id');}
							else if ( !isset($value['RecId']) and ($value['movement'] != 'insert') ){//
								$error=1; 
								$this -> ot_ae('C0010M061',$table,$key,$value,'RecId');}
							else if ( isset($value['Name']) and ($value['movement'] != 'insert') ){//
								$error=1; 
								$this -> ot_ae('C0010M061',$table,$key,$value,'Name');}
							else if ( isset($value['RecId']) and ($value['movement'] == 'insert') and ($this->info['calc'] == 'yes') ){
								$error=1; 
								$this -> ot_ae('C0010M061',$table,$key,$value,'RecId');}
							else {
								if ($value['movement'] == 'insert'){
									if ($this->ot_level($safety,"insert")) {
										$new = $this->ot_next($this->info['records']);
										if ($this->info['calc'] == 'yes'){
											$next = $this->info['sec']+1;
											$newrec =  $this->info['pre'].$next.$this->info['post'];
											$value ['RecId'] = $newrec;
										};
										foreach ($indexs as $field=>$kind) {
											if ($kind=='unique'){
												if (isset($value[$field])){
													$valor = $value[$field];
													if ($this->ot_getinside($valor,$table.'_'.$field.'.ind',$feature)){
														$error=1; 
														$this -> ot_ae('C0010M063',$table,$key,$value,$field,$valor);
													}
												}
											}
										}
										if ($error!=1){
											$value ['Id'] = $new;
											$value ['WnrId'] = $this->id;
											$value ['CtdId'] = $this->id;
											$value ['CtdDtt'] = $this->TmeStp();
											$value ['LstdId'] = $this->id;
											$value ['LstDtt'] = $this->TmeStp();
											$value ['CrrStt'] = 'Z';
											$value ['SttID'] = $this->id;
											$value ['SttDtt'] = $this->TmeStp();
											$value ['CrrStp'] = 'Z';
											$value ['StpId'] = $this->id;
											$value ['StpDtt'] = $this->TmeStp();
											unset($value['movement']);
											if ($this->ot_validadv($value, $this->info['record'] )){
												$datamemory[$this->retarr['key']]=$this->retarr['record'];
												$this->info['sec'] = $next;
												$this->info['records'] = $new;
												foreach ($indexs as $field=>$kind) {
													$valor = $value[$field];
													if ($kind=='unique'){
														$this->ot_addin($valor,$new,$table.'_'.$field.'.ind'.$feature);
													} else {
														$this->ot_addin($new,$valor,$table.'_'.$field.'.ind'.$feature);
													}
												}
										    	$this->dataresult [$key] = $this->retarr['key'];
										    } else {
												$error=1;
											}
										}
									} else {
										$error=1;										
									}
								} else {
									if (isset($value['Id'])) {
										$record = $value['Id'];
									} else {
										$record = $index[$value['Recid']]; 	
										$value['Id'] = $record;			
									}
									if ( isset($datamemory[$record])){
										$old = $datamemory[$record];  
										if ($old['LstDtt']==$value['LstDtt']){
											if ($value['movement'] == 'delete'){
												if ($this->ot_level($safety,"delete")) {
													foreach ($indexs as $field=>$kind) {
														$valor = $value[$field];
														if ($kind=='unique'){
															$this->ot_deletein($valor,$table.'_'.$field.'.ind'.$feature);
														} else {
															$this->ot_deletein($new,$table.'_'.$field.'.ind'.$feature);
														}
													}
													unset($datamemory[$record]);
												} else {
													$error=1;		
												}
											} else {
												foreach ($indexs as $field=>$kind) {
													$valor = $value[$field];
													if ($old [$field] != $value[$field]){
														if ($this->ot_getinside($valor,$table.'_'.$field.'.ind',$feature)){
															$error=1; 
															$this -> ot_ae('C0010M063',$table,$key,$value,$field,$valor);
														}
													}
												}
												if ($error!=1){
													$value['LstDtt'] = $this->TmeStp();
													$value['LstdId'] = $this->id;
													unset($value['movement']);
													if ($this->ot_validadv($value, $this->info['record'] )){
														foreach ($indexs as $field=>$kind) {
															$valor = $value[$field];
															$anterior = $old[$field];
															if ($old [$field] != $value[$field]){
																if ($kind=='unique'){
																	$this->ot_deletein($anterior,$table.'_'.$field.'.ind'.$feature);
																	$this->ot_addin($valor,$record,$table.'_'.$field.'.ind'.$feature);
																} else {
																	$this->ot_deletein($record,$table.'_'.$field.'.ind'.$feature);																	
																	$this->ot_addin($record,$valor,$table.'_'.$field.'.ind'.$feature);
																}
															}
														}
														$datamemory[$this->retarr['key']]=$this->retarr['record'];
													    $this->dataresult [$key] = $this->retarr['key'];
													}		
												}										
											}
										} else {
											$this -> ot_ae('C0010M062',$table,$key,$value,'LstDtt');
									    	$this->dataresult [$key] ='fail';					
										}
									} else {
										$this -> ot_ae('C0010M008',$table,$key,$value, $record);
								    	$this->dataresult [$key] ='fail';								
									}
								}	
							}
							if ($error==1){
							    $this->dataresult [$key] ='fail';									
							}	
						} else {
							$this -> ot_ae('C0010M058',$table,$key,$value);
						    $this->dataresult [$key] ='fail';	
						}				
					}
					$this->ot_write($table.'..tas',$datamemory,$feature);
					$this->ot_un_lock($table,$feature);
				}
			}
		}
	$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $this->errvalid );
	return $this->retval;
	}
}
?>