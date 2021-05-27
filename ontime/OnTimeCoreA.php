<?php
trait CoreA{
function CrtUsr($key, $password, $status, $fullname='None', $Nick='None'){
	$this->VldClr();$this->ot_connect();$this->ot_can('create','usr');$this->not_exist($key, 'usr');$this->ot_in($Value,$this->status);
	if (count($this->errvalid)==0){
		if ($this->ot_create($key, 'usr')) {
			$this->ot_array(array('password'=>MD5($password),'status'=>$status,'nick'=>$Nick,'name'=>$fullname,'crtdat'=>$this->Now()), 'admin.json', TRUE,'usr/'.$key);}}
	$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $this->errvalid );
	return $this->retval;}
function UsrChgInf($user,$name, $nick){
	$this->VldClr();$this->ot_connect();$this->ot_can('change','usr');$this->ot_exist($user,'usr');
	if (count($this->errvalid)==0){
		$atmp=$this->ot_readif('admin.json','usr/'.$user);
		$atmp['name']=$name;
		$atmp['nick']=$nick;
		$this->ot_write('admin.json',$atmp,'usr/'.$user);
		$this->retval=TRUE;}
	$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $this->errvalid );
	return $this->retval;}	
function UserChkStt($key){
	$this->VldClr();$atmp['status']=' ';$this->ot_connect();$this->ot_can('change','usr');$this->ot_exist($key, 'usr');
	if (count($this->errvalid)==0){
		$atmp=$this->ot_readif('admin.json','usr/'.$key);
		return($atmp['status']);}
	$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $this->errvalid  );
	return $atmp['status'];}
function UserChgStt($user,$Value){
	$this->VldClr();$this->ot_connect();$this->ot_can('change','usr');$this->ot_exist($user, 'usr');$this->ot_in($Value,$this->status);
	if (count($this->errvalid)==0){
		$atmp=$this->ot_changein('status',$Value,'admin.json','usr/'.$user);}
	$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $this->errvalid );
	return $this->retval;}
function UsrShwFtr($User){
	$atmp = [];$this->VldClr();$this->ot_can('access','usr');$this->ot_exist($User,'usr');
	if (count($this->errvalid)==0){
		$atmp=$this->ot_readif('features.json','usr/'.$User);}
	$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $this->errvalid );
	return $atmp;}	
function FtrShwUsr($Feature){
	$atmp = [];$this->VldClr();$this->ot_can('access',$Feature);$this->ot_exist($Feature);
	if (count($this->errvalid)==0){
		$atmp=$this->ot_readif('users.json',$Feature);}
	$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $this->errvalid );
	return $atmp;}	
function UsrAddFtr($Feature, $User, $level){
	$this->VldClr();$this->ot_can('create',$Feature);$this->ot_can('create','usr');$this->ot_exist($User,'usr');$this->ot_exist($Feature);$this->ot_in($level,$this->level);
	if (count($this->errvalid)==0){
		$this->ot_addin($Feature,$level,'features.json','usr/'.$User);
		$this->ot_addin($User,$level,'users.json',$Feature);}
	$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $this->errvalid );
	return $this->retval;}
function UsrChgFtr($Feature, $User, $level){
	$this->VldClr();$this->ot_can('change',$Feature);$this->ot_can('change','usr');$this->ot_exist($User,'usr');$this->ot_exist($Feature);$this->ot_in($level,$this->level);$this->not_value($User,'admin','C0010M036');
	if (count($this->errvalid)==0){
		$this->ot_changein($Feature,$level,'features.json','usr/'.$User);		
	$this->ot_changein($User,$level,'users.json',$Feature);}
	$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $this->errvalid );
	return $this->retval;}
function UsrDltFtr($Feature, $User){
	$this->VldClr();$this->ot_can('remove',$Feature);$this->ot_can('remove','usr');$this->ot_exist($User,'usr');$this->ot_exist($Feature);$this->not_value($User,'admin','C0010M036');				
	if (count($this->errvalid)==0){
		$this->ot_deletein($Feature,'features.json','usr/'.$User);		
		$this->ot_deletein($User,'users.json',$Feature);}
	$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $this->errvalid );
	return $this->retval;
}}
?>