<?php
trait OTcore{
function InstallCore(){

	$this->ot_addchangein('features.json','file','content.json');
	$this->ot_addchangein('container.json','file','content.json');

	$name='usr';
	$this->ot_create($name);
	if ($this->not_exist('usr/admin')) {
		$this->ot_create('usr/admin');
	}
	
	$this->ot_array(array('password'=>MD5('OT2021Free'),'status'=>'active','nick'=>'Administrator','name'=>'System Administrator','crtdat'=>$this->Now()), '/usr/admin/admin.json', TRUE);

	if ($this->not_exist('usr/public')) {
		$this->ot_create('usr/public');
	}
	$this->ot_array(array('nick'=>'Public','name'=>'All conected User','crtdat'=>$this->Now()), '/usr/public/admin.json', TRUE);

	if ($this->not_exist('usr/anonimus')) {
		$this->ot_create('usr/anonimus');
	}
	$this->ot_array(array('nick'=>'Anonimus','name'=>"Don't care user",'crtdat'=>$this->Now()), '/usr/anonimus/admin.json', TRUE);

	$this->ot_addchangein($name,$name,'features.json');
	$this->ot_addchangein($name,'owner','features.json','usr/admin');
	$this->ot_addchangein($name,array('Name'=>'User feature','limit'=>0,'OnUse'=>0),'container.json');
	$this->ot_array(array('nick'=>$name,'name'=>'User feature'), 'admin.json', TRUE,$name);

	$name='main';
	$this->ot_create($name);		
	$this->ot_addchangein('admin','owner','users.json',$name);			
	$this->ot_addchangein($name,$name,'features.json');
	$this->ot_addchangein($name,'owner','features.json','usr/admin');
	$this->ot_addchangein($name,array('Name'=>'Main feature','limit'=>0,'OnUse'=>0),'container.json');
	$this->ot_array(array('nick'=>$name,'name'=>'Main feature'), 'admin.json', TRUE,$name);

	$name='help';
	$this->ot_create($name);
	$this->ot_addchangein('admin','owner','users.json',$name);
	$this->ot_addchangein($name,$name,'features.json');
	$this->ot_addchangein($name,'owner','features.json','usr/admin');
	$this->ot_addchangein($name,array('Name'=>'Main feature','limit'=>0,'OnUse'=>0),'container.json');
	$this->ot_array(array('nick'=>$name,'name'=>'Main feature'), 'admin.json', TRUE,$name);
		
	$name='grp';
	$this->ot_create($name);		
	$this->ot_addchangein('admin','owner','users.json',$name);			
	$this->ot_addchangein($name,$name,'features.json');
	$this->ot_addchangein($name,'owner','features.json','usr/admin');
	$this->ot_addchangein($name,array('Name'=>'Group feature','limit'=>0,'OnUse'=>0),'container.json');
	$this->ot_array(array('nick'=>$name,'name'=>'Group feature'), 'admin.json', TRUE,$name);
		
	$name='basic';
	$this->ot_create($name);		
	$this->ot_addchangein('admin','owner','users.json',$name);			
	$this->ot_addchangein($name,$name,'features.json');
	$this->ot_addchangein($name,'owner','features.json','usr/admin');
	$this->ot_addchangein($name,array('Name'=>'Basic feature','limit'=>0,'OnUse'=>0),'container.json');
	$this->ot_array(array('nick'=>$name,'name'=>'Basic feature'), 'admin.json', TRUE,$name);
		
	$name='date';
	$this->ot_create($name);		
	$this->ot_addchangein('admin','owner','users.json',$name);			
	$this->ot_addchangein($name,$name,'features.json');
	$this->ot_addchangein($name,'owner','features.json','usr/admin');
	$this->ot_addchangein($name,array('Name'=>'Date feature','limit'=>0,'OnUse'=>0),'container.json');
	$this->ot_array(array('nick'=>$name,'name'=>'Date feature'), 'admin.json', TRUE,$name);
		
	$name='ddd';
	$this->ot_create($name);		
	$this->ot_addchangein('admin','owner','users.json',$name);			
	$this->ot_addchangein($name,$name,'features.json');
	$this->ot_addchangein($name,'owner','features.json','usr/admin');
	$this->ot_addchangein($name,array('Name'=>'Data dictionary feature','limit'=>0,'OnUse'=>0),'container.json');
	$this->ot_array(array('nick'=>$name,'name'=>'Data dictionary feature'), 'admin.json', TRUE,$name);

	$name='record';
	$this->ot_create($name);
	$this->ot_addchangein('admin','owner','users.json',$name);
	$this->ot_addchangein($name,$name,'features.json');
	$this->ot_addchangein($name,'owner','features.json','usr/admin');
	$this->ot_addchangein($name,array('Name'=>'Record feature','limit'=>0,'OnUse'=>0),'container.json');
	$this->ot_array(array('nick'=>$name,'name'=>'Record feature'), 'admin.json', TRUE,$name);

	$name='table';
	$this->ot_create($name);		
	$this->ot_addchangein('admin','owner','users.json',$name);			
	$this->ot_addchangein($name,$name,'features.json');
	$this->ot_addchangein($name,'owner','features.json','usr/admin');
	$this->ot_addchangein($name,array('Name'=>'Table feature','limit'=>0,'OnUse'=>0),'container.json');
	$this->ot_array(array('nick'=>$name,'name'=>'Table feature'), 'admin.json', TRUE,$name);

	$name='advance';
	$this->ot_create($name);		
	$this->ot_addchangein('admin','owner','users.json',$name);			
	$this->ot_addchangein($name,$name,'features.json');
	$this->ot_addchangein($name,'owner','features.json','usr/admin');
	$this->ot_addchangein($name,array('Name'=>'Advance Table feature','limit'=>0,'OnUse'=>0),'container.json');
	$this->ot_array(array('nick'=>$name,'name'=>'Advance Table feature'), 'admin.json', TRUE,$name);

	$name='page';
	$this->ot_create($name);
	$this->ot_addchangein('admin','owner','users.json',$name);			
	$this->ot_addchangein($name,$name,'features.json');
	$this->ot_addchangein($name,'owner','features.json','usr/admin');
	$this->ot_addchangein($name,array('Name'=>'Html page feature','limit'=>0,'OnUse'=>0),'container.json');
	$this->ot_array(array('nick'=>$name,'name'=>'Html page feature'), 'admin.json', TRUE,$name);

	$name='debug';
	$this->ot_create($name);		
	$this->ot_addchangein('admin','owner','users.json',$name);			
	$this->ot_addchangein($name,$name,'features.json');
	$this->ot_addchangein($name,'owner','features.json','usr/admin');
	$this->ot_addchangein($name,array('Name'=>'Debug Feature','limit'=>0,'OnUse'=>0),'container.json');
	$this->ot_array(array('nick'=>$name,'name'=>'Debug Feature'), 'admin.json', TRUE,$name);

	$name='multi';
	$this->ot_create($name);		
	$this->ot_addchangein('admin','owner','users.json',$name);			
	$this->ot_addchangein($name,$name,'features.json');
	$this->ot_addchangein($name,'owner','features.json','usr/admin');
	$this->ot_addchangein($name,array('Name'=>'Multilenuage Feature','limit'=>0,'OnUse'=>0),'container.json');
	$this->ot_array(array('nick'=>$name,'name'=>'Multilenuage Feature'), 'admin.json', TRUE,$name);



}
}
?>