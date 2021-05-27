<?php
trait Functions{
	protected function ot_connect($value=TRUE){
		$this->ot_func( __METHOD__ , __FUNCTION__ , func_get_args() );
		$retval = TRUE;
		if ($value){
			if (!$this->conected){
				$retval=FALSE;
				$this->ot_ae('C0010M011',$value);
			}
		}else{
			if ($this->conected){
				$retval=FALSE;
				$this->ot_ae('C0010M021',$value);
			}
		}
		$this->retval=$retval;
		return $retval;
	}	
	protected function ot_qexist($file, $inside='no'){
		$this->ot_func( __METHOD__ , __FUNCTION__ , func_get_args() );
		if($inside=='no'){
			return(file_exists($this->container.'/'.$file));
		}else{
			return(file_exists($this->container.'/'.$inside. '/'.$file));
		}
	}	
	protected function ot_exist($file, $inside='no',$error="C0010M008"){
		$this->ot_func( __METHOD__ , __FUNCTION__ , func_get_args() );
		$retval=FALSE;
		if ($inside=='no'){
			if (file_exists($this->container.'/'.$file)){
				$retval = TRUE;
			} else {
				$this->ot_ae($error,$file,$inside);
			}
		} else{
			if (file_exists($this->container.'/'.$inside. '/'.$file)){
				$retval = TRUE;
			} else {
				$this->ot_ae($error,$file,$inside);				
			}
		}
		$this->retval=$retval;
		return $retval;
	}	
	protected function not_exist($file, $inside='no',$error="C0010M007"){
		$this->ot_func( __METHOD__ , __FUNCTION__ , func_get_args() );
		$retval=FALSE;
		if ($inside=='no') {
			if (!file_exists($this->container.'/'.$file)) {
				$retval = TRUE;
			} else {
				$this->ot_ae($error,$file,$inside);
			}
		} else {
			if (!file_exists($this->container.'/'.$inside. '/'.$file)) {
				$retval = TRUE;
			} else{
				$this->ot_ae($error,$file,$inside);				
			}
		}
		$this->retval=$retval;
		return $retval;
	}	

	protected function ot_pexist($file, $inside='no',$error="C0010M008"){
		$this->ot_func( __METHOD__ , __FUNCTION__ , func_get_args() );
		$retval=FALSE;
		if ($inside=='no'){
			if (file_exists($file)){
				$retval = TRUE;
			} else {
				$this->ot_ae($error,$file,$inside);
			}
		} else{
			if (file_exists($inside. '/'.$file)){
				$retval = TRUE;
			} else {
				$this->ot_ae($error,$file,$inside);				
			}
		}
		$this->retval=$retval;
		return $retval;
	}	

	protected function ot_can($can, $safety){
		$this->ot_func( __METHOD__ , __FUNCTION__ , func_get_args() );
		if ($this->id == 'admin') {
			$this->retval=TRUE;
		} else {
			if ($this->conected) {
				if (array_key_exists($safety, $this->safety)) {
					$value1 = $this->level[$this->safety[$safety]];
					$value2 = $this->level[$can];
					if ($value1>$value2) {
						$this->ot_ae("C0010M012",$can,$safety);

					} else {
						$this->retval=TRUE;
					}
				} else {
					$this->ot_ae("C0010M012",$can,$safety);
				}
			} else {
				$this->ot_ae("C0010M011",$can,$safety);
			}
		}
		return $this->retval;
	}	
	protected function ot_group($can, $group){
		$this->ot_func( __METHOD__ , __FUNCTION__ , func_get_args() );
		if($this->conected){
			if(array_key_exists($group, $this->groups)){
				$value1 = $this->level[$this->groups[$group]];
				$value2 = $this->level[$can];
				if($value1>$value2){
					$this->ot_ae("C0010M012",$can,$group);
				}else{
					$this->retval=TRUE;
				}
			}else{
				$this->ot_ae("C0010M012",$can,$group);
			}
		}else{
			$this->ot_ae("C0010M011",$can,$group);
		}
		return $this->retval;
	}	
	protected function ot_remove($content, $inside='no'){
		$this->ot_func( __METHOD__ , __FUNCTION__ , func_get_args() );
		if($inside=='no'){
			$content=$this->container.'/'.$content;
		}else{
			$content=$this->container.'/'.$inside. '/'.$content;
		}
		if(file_exists($content)){
			$this->ot_destroy($content);
		}else{
			$this->ot_ae("C0010M008",$content,$inside);
		}
		return $this->retval;
	}	
	protected function ot_deleteinside($content, $inside='no', $error='C0010M008')
	{
		$this->ot_func( __METHOD__ , __FUNCTION__ , func_get_args() );
		if($inside=='no'){
			$content=$this->container.'/'.$content;
		}else{
			$content=$this->container.'/'.$inside. '/'.$content;
		}
		if(file_exists($content)){
			unlink($content);
		}else{
			if ($error!='no') {
				$this->ot_ae($error,$content,$inside);
			}
		}
		return $this->retval;
	}	
	protected function ot_create($content, $inside='no'){
		$this->ot_funct( __METHOD__ , __FUNCTION__ , func_get_args() );
		if($inside=='no'){
			$content2=$this->container.'/'.$content;
		}else{
			$content2=$this->container.'/'.$inside. '/'.$content;
		}		
		if ($this->not_exist($content, $inside='no')) {
			if (! mkdir($content2 , 0777)) {
				$this->ot_ae("C0010M012",$content,$inside);
				$this->retval=FALSE;
			}
		}
		return $this->retval;
	}	
	protected function ot_destroy($what){
		$this->ot_funct( __METHOD__ , __FUNCTION__ , func_get_args() );
		foreach(glob($what . "/*") as $eachone){
			if(is_dir($eachone)){
				ot_destroy($eachone);
			}else{
				unlink($eachone);
			}
		}
		rmdir($what);
	}	
	protected function ot_getin($what){
		$this->ot_func( __METHOD__ , __FUNCTION__ , func_get_args() );
		$retval=[];
		foreach (glob($what . "/*")as $eachone) {
			if (is_dir($eachone)) {
				$eachone = str_replace ( $what."/" , '',  $eachone);
				$retval[$eachone]=$eachone;
			}
		}
		return $retval;
	}	
	protected function ot_RandomString($large){
		$characters='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$randstring='X';
		for ($i=0;$i<$large;$i++){
			$randstring=$randstring.$characters[rand(0,strlen($characters)-1)];}
		return $randstring;
	}	
	protected function ot_clean($data){
		$data=trim($data);
		$data=stripslashes($data);
		$data=htmlspecialchars($data);
		return $data;
	}	
	protected function ot_value($data,$value,$error){
		$this->ot_funct( __METHOD__ , __FUNCTION__ , func_get_args() );
		if ($data!=$value) {
			$this->retval=FALSE;
			if ($error!='no'){
				$this->ot_ae($error,$data,$value);
			}
		}
		return $this->retval;
	}	
	
	protected function not_value($data, $value, $error){
		$this->ot_funct( __METHOD__ , __FUNCTION__ , func_get_args() );
		if ($data==$value) {
			$this->retval=FALSE;
			if ($error!='no'){
				$this->ot_ae($error,$data,$value);
			}
		}
		return $this->retval;
	}

	protected function ot_maxvalue($data, $value, $error='C0010M012'){
		$this->ot_funct( __METHOD__ , __FUNCTION__ , func_get_args() );
		if ($data>$value) {
			$this->retval=FALSE;
			if ($error!='no'){
				$this->ot_ae($error,$data,$value);
			}
		}
		return $this->retval;
	}	

	protected function ot_maxeqvalue($data, $value, $error='C0010M012'){
		$this->ot_funct( __METHOD__ , __FUNCTION__ , func_get_args() );
		if ($data>=$value) {
			$this->retval=FALSE;
			if ($error!='no'){
				$this->ot_ae($error,$data,$value);
			}
		}
		return $this->retval;
	}	

	protected function ot_minvalue($data, $value, $error='C0010M012'){
		$this->ot_funct( __METHOD__ , __FUNCTION__ , func_get_args() );
		if ($data<$value) {
			$this->retval=FALSE;
			if ($error!='no'){
				$this->ot_ae($error,$data,$value);
			}
		}
		return $this->retval;
	}	

	protected function ot_mineqvalue($data, $value, $error='C0010M012'){
		$this->ot_funct( __METHOD__ , __FUNCTION__ , func_get_args() );
		if ($data<=$value) {
			$this->retval=FALSE;
			if ($error!='no'){
				$this->ot_ae($error,$data,$value);
			}
		}
		return $this->retval;
	}	

	protected function ot_name($inside, $name='no'){
		$this->ot_funct( __METHOD__ , __FUNCTION__ , func_get_args() );
		$retval='Not exist';
		if ($name=='no') {
			$tmp=$this->ot_read('admin.json',$inside);
		} else {
			$tmp=$this->ot_read('admin.json',$inside.'/'.$name);
		}
		$retval = $tmp['name'].'('.$tmp['nick'].')';
		return $retval;
	}
	
	protected function ot_in($value, $data, $error='C0010M008'){
		$this->ot_func( __METHOD__ , __FUNCTION__ , func_get_args() );
		$retval= '';
		if (is_array($data)){
			if (array_key_exists($value, $data)){
				$this->retval=TRUE;
				$retval = $data[$value];
			} else {
				if ($error!='no'){
					$this->ot_ae($error,$data,$value);
				}
			}
		} else {
			$this->ot_ae('C0010M016',$data,$value);
		}
		return $retval;
	}

	protected function ot_ina($value, $data, $error='C0010M008'){
		$this->ot_func( __METHOD__ , __FUNCTION__ , func_get_args() );
		$retval= '';
		if (is_array($data)){
			if (array_exists($value, $data)){
				$this->retval=TRUE;
			} else {
				if ($error!='no'){
					$this->ot_ae($error,$data,$value);
				}
			}
		} else {
			$this->ot_ae('C0010M016',$data,$value);
		}
		return $this->retval;
	}
		
	protected function ot_in_mygroup($data, $error='no'){
		$this->ot_func( __METHOD__ , __FUNCTION__ , func_get_args() );
		$retval = 'vmine';
		if (is_array($data)){
			foreach ($this->groups as $clave => $valor) {
				if (array_key_exists($clave, $data)){
					$this->retval=TRUE;
					if ($retval > $data[$value]){
						$retval = $data[$value];
					}
				} else {
					if ($error!='no'){
						$this->ot_ae($error,$data,$clave);
					}
				}
			}
		} else {
			$this->ot_ae('C0010M016',$data,$value);
		}
		return $retval;
	}	
	protected function ot_in_group($data, $user ,$error='no'){
		$this->ot_func( __METHOD__ , __FUNCTION__ , func_get_args() );
		$retval = 100;
		if (is_array($data)){
		 	$tmp=$this->ot_readif('groups.json','usr/'.$user);
			foreach ($tmp as $clave => $valor) {
				if (array_key_exists($clave, $data)){
					$this->retval=TRUE;
					if ($retval > $data[$value]){
						$retval = $data[$value];
					}
				} else {
					if ($error!='no'){
						$this->ot_ae($error,$data,$clave);
					}
				}
			}
		} else {
			$this->ot_ae('C0010M016',$data,$value);
		}
		return $retval;
	}	
	protected function not_in($value, $data, $error='C0010M007'){
		$this->ot_func( __METHOD__ , __FUNCTION__ , func_get_args() );
		if (is_array($data)){
			if (array_key_exists($value, $data)){
				$this->ot_ae($error,$value,$data);
			} else {
				$this->retval=TRUE;
			}
		} else {
			$this->ot_ae('C0010M016',$data,$value);
		}
		return $this->retval;
	}	
	protected function ot_inside($value, $data, $back, $error= 'C0010M026'){
		$this->ot_func( __METHOD__ , __FUNCTION__ , func_get_args() );
		$retval = '';
		if (is_array($data)){
			if (array_key_exists($value, $data)){
				$record = $data[$value];
				if (is_array($data)){
					if (array_key_exists($back, $record)){
						$this->retval=TRUE;
						$retval = $record[$back];
					} else {
						$this->err=$error;											
					}
				} else {
					$this->ot_ae('C0010M016',$data,$value);
				}
			} else {
				$this->ot_ae('C0010M008',$data,$value);
			}
		} else {
			$this->ot_ae('C0010M016',$data,$value);
		}
		return $retval;
	}	
	protected function ot_isopen($level){
		$this->ot_func( __METHOD__ , __FUNCTION__ , func_get_args() );
		if ($this->opent==TRUE){
			if ($this->levelt<=$level){
				$this->retval=TRUE;
			} else {
				$this->err='C0010M030';				
			}
		} else {
			$this->err='C0010M032';
		}
		return $this->retval;
	}	
	protected function ot_getlike($what,$in){
		$this->ot_func( __METHOD__ , __FUNCTION__ , func_get_args() );
		$retval=[];
		foreach (glob($what . "/*")as $eachone) {
			if (is_dir($eachone)) {
				$eachone = str_replace ( $what."/" , '',  $eachone);
				$retval[$eachone]=$eachone;
			}
		}
		return $retval;
	}	
	function ot_feature($feature, $error='C0010M019'){
		$this->ot_func( __METHOD__ , __FUNCTION__ , func_get_args() );
		if (array_key_exists($feature, $this->features)){
			$this->err='0';						
			$this->retval = TRUE;			
		} else {
			$this->err=$error;						
			$this->retval = FALSE;			
		}
		return $this->retval;
	}
	function ot_safety($name,$kind='b',$in='basic'){
		$this->ot_func( __METHOD__ , __FUNCTION__ , func_get_args() );
		$retval = False;
		$retval = $this->ot_qexist($name.'.'.$kind.'an',$in);
		if ($this->ot_connect()){
			$retval = $this->ot_qexist($name.'.'.$kind.'pl',$in);
			if (!$retval){
				if ($this->ot_qexist($name.'.'.$kind.'gr',$in)){
					$tmp=$this->ot_readif($name.'.'.$kind.'gr',$in);
					foreach ($tmp as $clave => $valor) {
						$this->ot_in_mygroup($clave);
						if($this->retval){
							$retval=TRUE;	
						}
					}				
				}
				if (!$retval){
					$tmp=$this->ot_readif($name.'.'.$kind.'us',$in);					
					$this->ot_in($this->id,$tmp);
					$retval=$this->retval;
				}
			}
		}
		return $retval;
	}
	function ot_safety_level($name,$kind='b',$in='basic'){
		$this->ot_func( __METHOD__ , __FUNCTION__ , func_get_args() );
		$retval = 'vmine';
		if ($this->ot_connect()){
			if ($this->ot_qexist($name.'.'.$kind.'us',$in)){
				$tmp=$this->ot_readif($name.'.'.$kind.'us',$in);
				$newval= $this->ot_in($this->id,$tmp);	
				if ($this->retval){
				   $retval=$newval;
				}
			} else {				
				if ($this->ot_qexist($name.'.'.$kind.'gr',$in)){
					$tmp=$this->ot_readif($name.'.'.$kind.'gr',$in);
					foreach ($tmp as $clave => $valor) {
						$newval=$this->ot_in_mygroup($clave);
						if($this->level[$retval] > $this->level[$newval]){
							$retval=$newval;	
						}
					}
				}				
			}
		}
		return $retval;
	}
	function ot_level($level,$base='owner',$error='C0010M012'){
		$this->ot_func( __METHOD__ , __FUNCTION__ , func_get_args() );
		if ($this->id=='admin') {
			$this->retval=TRUE;
		} else {
			if($this->level[$level]>=$this->level[$base]){
				$this->err=$error;
			$this->ot_ae($error,$level,$base);
			} else {
				$this->retval=TRUE;
			}
		}
		return $this->retval;
	}	
	protected function ot_getlist($from,$ext, $select=1){
		$this->ot_func( __METHOD__ , __FUNCTION__ , func_get_args() );
		$retval=[];
		$record = 0;
		$from=$this->container.'/'.$from;
		foreach (glob($from.$ext) as $eachone) {
			if ($select!=2){
				$eachone=str_replace($from,'',$eachone);
				$record += 1; 
				if (!is_dir($eachone)) {
					$retval[$record]=$eachone;
				} 
			}
			if ($select!=1){
				if (is_dir($eachone)) {
					$retval[$record]=$eachone;
				} 
			}
		}
		return $retval;
	}

}	
