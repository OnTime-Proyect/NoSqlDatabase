<?php
trait Debug{
	private $DebugActive=FALSE;
	private $DebugMode='basic';
	private $DebugFor='system';
	private $DebugTo='screen';
	private $SaveError=FALSE;
	public  $Debughold=array();
	
	function DbgStr()
	{
		if ($this->ot_can('owner','debug')) {
			$this->DebugActive=TRUE;
			$this->Debughold=[];
		}
		$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $this->retval );
		return $this->retval;
	}
	function DbgClrMmr()
	{
		if ($this->ot_can('owner','debug')) {
			$this->Debughold=[];
		}
		$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $this->retval );
		return $this->retval;
	}
	function DbgStp()
	{
		if ($this->ot_can('owner','debug')) {
			$this->DebugActive=FALSE;
			$this->Debughold=[];
		}
		$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $this->retval );
		return $this->retval;
	}
	function DbgMdeBsc()
	{
		if ($this->ot_can('owner','debug')) {
			$this->DebugMode='basic';
		}
		$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $this->retval );
		return $this->retval;
	}
	function DbgMdeAdv()
	{
		if ($this->ot_can('owner','debug')) {
			$this->DebugMode='advance';
		}
		$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $this->retval );
		return $this->retval;
	}
	function DbgForUsr()
	{
		if ($this->ot_can('owner','debug')) {
			$this->DebugFor='user';
		}
		$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $this->retval );
		return $this->retval;
	}
	function DbgForSys()
	{
		if ($this->ot_can('owner','debug')) {
			$this->DebugFor='system';
		}
		$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $this->retval );
		return $this->retval;
	}
	function DbgToScr()
	{
		if ($this->ot_can('owner','debug')) {
			$this->DebugTo='screen';
		}
		$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $this->retval );
		return $this->retval;
	}
	function DbgToMmr()
	{
		if ($this->ot_can('owner','debug')) {
			$this->DebugTo='memory';
		}
		$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $this->retval );
		return $this->retval;
	}
	function DbgToDsk()
	{
		if ($this->ot_can('owner','debug')) {
			$this->DebugTo='disk';
		}
		$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $this->retval );
		return $this->retval;
	}
	function DbgErrOn()
	{
		if ($this->ot_can('owner','debug')) {
			$this->SaveError=TRUE;
		}
		$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $this->retval );
		return $this->retval;
	}
	function DbgErrOff()
	{
		if ($this->ot_can('owner','debug')) {
			$this->SaveError=FALSE;
		}
		$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $this->retval );
		return $this->retval;
	}
	function DbgShw()
	{
		if ($this->ot_can('owner','debug')) {
			$retval = $this->ot_getlist('debug/','log*');
		}
		$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $retval );
		return $retval;
	}
	function DbgShwLog($name)
	{
		if ($this->ot_can('owner','debug')) {
			$retval = $this->ot_readif($name,'debug');
		}
		$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $retval );
		return $retval;
	}
	function DbgDltLog($name)
	{
		if ($this->ot_can('owner','debug')) {
			$this->ot_deleteinside($name,'debug');
		}
		$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $this->retval );
		return $this->retval;
	}
	function DbgClrLog()
	{
		if ($this->ot_can('owner','debug')) {
			$tmp=$this->DbgShw();
			foreach ($tmp as $clave => $valor) {
				$this->ot_deleteinside($valor,'debug');
			}
		}
		$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $this->retval );
		return $this->retval;
	}

	function ot_show($trac, $level=1){
		if ($level==1){
			echo '<br>';
		}
		if(is_array($trac)){
			foreach ($trac as $clave=> $valor){
				if (is_array($valor)){
					echo str_repeat ('-', 10*($level-1) ).($level).".- $clave :" ."<br>";
					$this->ot_show($valor,($level+1));
				} else{
					echo str_repeat ('_', 10*($level-1) ).($level-1)."D.- {$clave}=>{$valor}"."<br>";
				}
			}
		} else {
				echo "Empty"."<br>";			
		}
	}	
	function ot_error($retval=''){
		if ($this->err=="0") {
			echo $retval.'<br>';
		} else{
			if (array_key_exists($this->err, $this->errtext)) {
				echo ($this->err.'.-'.$this->errtext[$this->err]).'<br>';
			} else{
				echo ($this->err.'.-Error not defined').'<br>';
			}
		}
	}
	function ot_ed($error){
		if (array_key_exists($error, $this->errtext)) {
			return $this->errtext[$error];
		} else{
			return 'Error not defined';
		}
	}
	function ot_func($in,$from,$parameters){
		$this->dbg_addin($from,array('in'=> str_replace('::'.$from,'',$in ),'parameters'=>count ($parameters)),"OnTime_Development.tas","help");
		if ($this->DebugActive){
			if($this->DebugMode=='advance'){
				$code = uniqid($this->actses , true );				
				$val =  array('kind'=>'func','in'=>$in,'from'=>$from,'param'=>$parameters);
				if ($this->DebugTo=='screen'){
						echo '<br>'.$code.'<br>';
						$this->ot_show($val);		
				}
				if ($this->DebugTo=='memory'){
					$this->Debughold[$code]=$val;
				}
				if ($this->DebugTo=='disk'){
					$ext = date("Ymd");
					if ($this->DebugFor=='user'){
						$this->dbg_addin($code,$val,'log_'.$this->id.'.'.$ext);
					} else{
						$this->dbg_addin($code,$val,'log_system.'.$ext);	
					}
				}
			}
		}
		$this->err='0';
		$this->retval=FALSE;
	}	
	function ot_funct($in,$from,$parameters){
		$this->dbg_addin($from,array('in'=>str_replace('::'.$from,'',$in ),'parameters'=>count ($parameters)),"OnTime_Development.tas","help");
		if ($this->DebugActive){
			if($this->DebugMode=='advance'){
				$code = uniqid($this->actses , true );				
				$val =  array('kind'=>'funct','in'=>$in,'from'=>$from,'param'=>$parameters);
				if ($this->DebugTo=='screen'){
					echo '<br>'.$code.'<br>';
					$this->ot_show($val);		
				}
				if ($this->DebugTo=='memory'){
					$this->Debughold[$code]=$val;
				}
				if ($this->DebugTo=='disk'){
					$ext = date("Ymd");
					if ($this->DebugFor=='user'){
						$this->dbg_addin($code,$val,'log_'.$this->id.'.'.$ext);
					} else{
						$this->dbg_addin($code,$val,'log_system.'.$ext);	
					}
				}
			}
		}
		$this->err='0';
		$this->retval=TRUE;
	}
	function ot_log($in,$from,$parameters,$ret){		
		$this->dbg_addin($from,array('in'=>str_replace('::'.$from,'',$in ),'parameters'=>count ($parameters)),"OnTime_Development.tas","help");
		if (($this->err!="0") and ($this->SaveError)) {
			$val =  array('kind'=>'Error','Code'=>$this->err,'Code'=>$this->id,'in'=>$in,'from'=>$from,'param'=>$parameters, "return"=>$ret);
			$code = uniqid($this->actses , true );			
			$ext = date("Ymd");
				if ($this->DebugFor=='user'){
					$this->dbg_addin($code,$val,'log_error'.$this->id.'.'.$ext);
				} else{
					$this->dbg_addin($code,$val,'log_error.'.$ext);	
				}
		}
		
		if ($this->DebugActive){
			$code = uniqid($this->actses , true );				
			$val =  array('kind'=>'Out','in'=>$in,'from'=>$from,'param'=>$parameters, "return"=>$ret);
			if ($this->DebugTo=='screen'){
				echo '<br>'.$code.'<br>';
				$this->ot_show($val);		
			}
			if ($this->DebugTo=='memory'){
				$this->Debughold[$code]=$val;
			}
			if ($this->DebugTo=='disk'){
				$ext = date("Ymd");
				if ($this->DebugFor=='user'){
					$this->dbg_addin($code,$val,'log_'.$this->id.'.'.$ext);
				} else{
					$this->dbg_addin($code,$val,'log_system.'.$ext);	
				}
			}
		}
		return(TRUE);
	}
	protected function dbg_addin($key, $value, $file, $in ='debug')
	{
		$data = $this->dbg_readif($file, $in);
		$data[$key]=$value;
		$this->dbg_write($file,$data, $in);
		return $data;
	}	
	protected function dbg_readif($file, $in ='debug')
	{
		$file=$this->container.'/'.$in.'/'.$file;
		$aread=[];
		if (file_exists($file)) {
			$stream=fopen($file,"r");
			if ($stream) {
				$vread='';
				while (!feof($stream)) {
					$vread.=fgets($stream);
				}
				$aread=json_decode($vread,true);
				fclose($stream);
			}
		}
		return $aread;
	}	
	protected function dbg_write($file, $data, $in ='debug')
	{
		$file=$this->container.'/'.$in.'/'.$file;
		$stream=fopen($file, "w");
		if ($stream) {
			$save=fwrite($stream,json_encode($data,JSON_UNESCAPED_SLASHES));
			if ($save) {
				fclose($stream);
			}
		}
		return TRUE;
	}	
	
}
