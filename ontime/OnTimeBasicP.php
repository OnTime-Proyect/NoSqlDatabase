<?php
trait BasicP{	
	function ShwCntSrt($content,$feature='basic', $sort='key', $asc='yes',$csv='no',$name='no'){
		$this->VldClr();	
		$arreglo=[];
		if ($this->ot_safety($content,'b',$feature)){
			$arreglo = $this->ot_readif($content.'.bas',$feature);
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
				$ret='feature,container,key,data'.chr(13).chr(10);
				foreach ($arreglo as $key => $val) {
   					$ret.= "$feature,$content,$key, $val".chr(13).chr(10);
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