<?php
trait TableP{
	
	function ShwTblSrt($table,$feature='table', $sort='key', $asc='yes',$csv='yes',$name='yes'){
		$this->VldClr();	
		$arreglo=[];
		if ($this->ot_safety($table,'t',$feature)){
			$arreglo = $this->ot_readif($table.'.tas',$feature);
			if ($sort=='key'){
				if ($asc=='yes'){
					ksort($arreglo);
				} else {
					krsort($arreglo);					
				}
			} else {
				if ($asc=='yes'){
					asort($arreglo);
				} else {
					arsort($arreglo);					
				}				
			}
			if ($csv=='yes'){
				$info=$this->ot_readif($table.'.tin',$feature);
				if ( $this->ot_getinside('key',$info['record'].'.rcd' , 'record')){
					$keyfield = $this->retval;
					$rec=$this->ot_readif($info['record'].'.rcd','record');
					unset($rec[$keyfield]);
					unset($rec['key']);
					$ret="feature,container,$keyfield";					
					foreach ($rec as $head => $value) {
					   $ret .= ','.$head;	
					}					
					$ret .= chr(13).chr(10);
					foreach ($arreglo as $key => $val) {
   						$ret.= "$feature,$table,$key";
						foreach ($rec as $head => $value) {
							$this->ot_in($head, $val, $error='no');
							if ($this->retval){
							   	$ret .= ','.$val[$head];									
							} else {
								$ret .= ',';
							}
						}					
						$ret .= chr(13).chr(10);   						
					}
				}  
				$arreglo=$ret;
				if ($name!='no'){
					$this->ot_write_public($name,$arreglo);
				}		
			}
		}
		$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $this->errvalid );
		return $arreglo;
	}	

}
?>