<?php
trait Content{	
	protected function ot_add($key, $value, $data, $file, $inside="no"){
		$this->ot_func( __METHOD__ , __FUNCTION__ , func_get_args() );
		if (array_key_exists($key,$data)) {
			$this->ot_ae('C0010M007',$inside.'/'.$file,$key);
		} else {
			$data[$key]=$value;
			$this->ot_write($file,$data,$inside);
			$this->retval=TRUE;
		}
		return $data;
	}	
	protected function ot_change($key, $value, $data, $file, $inside="no"){
		$this->ot_func( __METHOD__ , __FUNCTION__ , func_get_args() );
		if (array_key_exists($key,$data)) {
			$data[$key]=$value;
			$this->ot_write($file,$data,$inside);
			$this->retval=TRUE;
		} else {
			$this->ot_ae('C0010M008',$inside.'/'.$file,$key);
		}
		return $data;
	}	
	protected function ot_delete($key, $data, $file, $inside="no"){
		$this->ot_func( __METHOD__ , __FUNCTION__ , func_get_args() );
		if (array_key_exists($key,$data)) {
			unset($data[$key]);
			$this->ot_write($file,$data,$inside);
			$this->retval=TRUE;
		} else {
			$this->ot_ae('C0010M008',$inside.'/'.$file,$key);

		}
		return $data;
	}	
	protected function ot_addin($key, $value, $file, $inside="no"){
		$data = $this->ot_readif($file, $inside);
		$this->ot_func( __METHOD__ , __FUNCTION__ , func_get_args() );
		if (array_key_exists($key,$data)) {
			$this->ot_ae('C0010M007',$inside.'/'.$file,$key);
		} else {
			$data[$key]=$value;
			$this->ot_write($file,$data,$inside);
			$this->retval=TRUE;
		}
		return $data;
	}	
	protected function ot_changein($key, $value, $file, $inside="no"){
		$data = $this->ot_readif($file, $inside);
		$this->ot_func( __METHOD__ , __FUNCTION__ , func_get_args() );
		if (array_key_exists($key,$data)) {
			$data[$key]=$value;
			$this->ot_write($file,$data,$inside);
			$this->retval=TRUE;
		} else {
			$this->ot_ae('C0010M008',$inside.'/'.$file,$key);
		}
		return $data;
	}	
	protected function ot_getinside($key,  $file, $inside="no", $error= 'no'){
		$data = $this->ot_readif($file, $inside);
		$this->ot_func( __METHOD__ , __FUNCTION__ , func_get_args() );
		$retval = FALSE;
		if (array_key_exists($key,$data)) {
			$this->retval=$data[$key];
			$retval=TRUE;
		} else {
			if ($error!='no') {
				$this->ot_ae($error,$inside.'/'.$file,$key);
			}
		}
		return $retval;
	}	
	protected function ot_addchangein($key, $value, $file, $inside="no"){
		$this->ot_func( __METHOD__ , __FUNCTION__ , func_get_args() );
		$data = $this->ot_readif($file, $inside);
		$data[$key]=$value;
		$this->ot_write($file,$data,$inside);
		$this->retval=TRUE;
		return $data;
	}	
	protected function ot_deletein($key, $file, $inside="no"){
		$data = $this->ot_readif($file, $inside);
		$this->ot_func( __METHOD__ , __FUNCTION__ , func_get_args() );
		if (array_key_exists($key,$data)) {
			unset($data[$key]);
			$this->ot_write($file,$data,$inside);
			$this->retval=TRUE;
		} else {
			$this->ot_ae('C0010M008',$inside.'/'.$file,$key);
		}
		return $data;
	}	
	protected function ot_array($array, $file, $overwrite, $inside="no"){
		$this->ot_funct( __METHOD__ , __FUNCTION__ , func_get_args() );
		if (is_array($array)) {
			if ($overwrite) {
				$atmp=[];
			} else {
				$atmp=$this->ot_readif($file,$inside);
			}
			foreach ($array as $iKey=> $iValue) {
				$atmp[$iKey]=$iValue;
			}
			$this->ot_write($file,$atmp,$inside);
		} else {
			$this->retval=FALSE;
			$this->ot_ae('C0010M016',$inside.'/'.$file);
		}
		return $this->retval;
	}
}	
