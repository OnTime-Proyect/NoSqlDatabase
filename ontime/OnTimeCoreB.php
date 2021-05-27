<?php
trait CoreB{
	public $name;
	public $nick;
	public $conected=FALSE;
	public $id='Anonimus';
	public $user=array();
	public $userp=array();
	public $safety=array();
	public $features=array();
	public $content=array();
	public $groups=array();
	public $err;
	public $errtext=array();
	public $level=array();
	public $status=array();
	private $retval=TRUE;
	private $tmp=array();
	private $container;
protected function Check(){
$this->VldClr();
		$retval=TRUE;
		$this->err="0";
		if ($this->ot_qexist('content.json')) {
			$atmp = $this->ot_readif('content.json');
			foreach ($atmp as $iKey=> $iValue) {
				if (!$this->ot_qexist($iKey)) {
					$retval=false;
					echo $iKey.'<br>';
				}
			}
			if ($this->ot_qexist('features.json')) {
				$atmp = $this->ot_readif('features.json');
				foreach ($atmp as $iKey=> $iValue) {
					if (!$this->ot_qexist($iKey)) {
						echo $iKey.'<br>';
						$retval=false;
					}
				}
			} else {
				$retval=FALSE;
			}
		} else {
			$retval=FALSE;
		}
		if (!$retval) {
			$this->err="C0010M005";
			$this->errtext["C0010M005"]="Mising system file";
		}
		return $retval;
		$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $this->errvalid  );
		return $value;
	}
	function UsrShwAll(){
$this->VldClr();
		$tmp=$this->ot_getin('ontime/usr');
		$value=[];
		foreach ($tmp as $iKey=> $iValue) {
			$value[$iKey]=$this->ot_name('usr',$iKey);
		}
		$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $this->errvalid  );
		return $value;
	}
	
	function PssChk($User, $Password){
$this->VldClr();
		if ($this->ot_exist($User,'usr')) {
			$atmp=$this->ot_read('admin.json','usr/'.$User);
			if ($this->ot_value($atmp['password'],MD5($Password),"C0010M012"))
				if ($this->ot_value($atmp['status'],'active',"C0010M022")) {}
			}
		$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $this->errvalid );
		return $this->retval;
	}
	function MyPssChg($old, $new){
$this->VldClr();
		if ($this->ot_connect())
		if ($this->ot_exist($this->id,'usr')){
			$atmp=$this->ot_read('admin.json','usr/'.$this->id);
			if ($this->ot_value($atmp['password'],MD5($old),"C0010M012"))
				if ($this->ot_value($atmp['status'],'active',"C0010M022")) {
				$atmp['password']=MD5($new);
				$this->ot_write('admin.json',$atmp,'usr/'.$this->id);
				$this->retval=TRUE;
			}
		}	
		$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $this->errvalid );
		return $this->retval;
	}	
	function FrcPssChg($user,$old, $new){
$this->VldClr();
		if ($this->ot_exist($user,'usr')) {
			$atmp=$this->ot_read('admin.json','usr/'.$user);
			if ($this->ot_value($atmp['password'],MD5($old),"C0010M012"))
				if ($this->ot_value($atmp['status'],'force',"C0010M025")) {
				$atmp['password']=MD5($new);
				$atmp['status']='active';
				$this->ot_write('admin.json',$atmp,'usr/'.$user);
				$this->retval=TRUE;
			}
		}
		$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $this->errvalid );
		return $this->retval;
	}	
	function MyChgInf($name, $nick){
$this->VldClr();
		if ($this->ot_connect()) {
			if ($this->ot_exist($this->id,'usr')) {
				$atmp=$this->ot_readif('admin.json','usr/'.$this->id);
				$atmp['name']=$name;
				$atmp['nick']=$nick;
				$this->ot_write('admin.json',$atmp,'usr/'.$this->id);
				$this->retval=TRUE;
			}
		}
		$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $this->errvalid );
		return $this->retval;
	}
	function UsrShwMn(){
		$atmp = [];
		if ($this->ot_can('access','main')) {
			$atmp=$this->ot_readif('users.json');
		}
		$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $this->errvalid );
		return $atmp;
	}
	function UsrShwNln(){
$this->VldClr();
		$tmp=$this->ot_readif('online.json');
		$value=[];
		foreach ($tmp as $iKey=> $iValue) {
			$value[$iKey]=$this->ot_name('usr',$iKey);
		}
		$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $this->errvalid );
		return $value;
	}
	function FrtShwAll(){
$this->VldClr();
		$tmp=$this->ot_getin('ontime');
		$value=[];
		foreach ($tmp as $iKey=> $iValue) {
			$value[$iKey]=$this->ot_name($iKey);
		}
		$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $this->errvalid  );
		return $value;
	}
}
?>