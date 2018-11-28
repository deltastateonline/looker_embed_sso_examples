<?php
class Embedurl{
    
   
    
    private $nonce = NULL;
    
    private $current_time = NULL;
    
    private $session_length = NULL;
    
    private $external_user_id = NULL;
    
    private $first_name = NULL;
    private $last_name = NULL;
    private $permission = NULL;
    
    private $model = NULL;
    private $group_id = NULL;
    private $external_group_id  = NULL;
    
    private $user_attributes = NULL;
    private $accessfilters = NULL;
    
    private $path = NULL;   
    
    public function __construct($host = NULL, $embedpath  = NULL , $secret = NULL)
    {
        
       $this->host = $host;
       $this->path = "/login/embed/" . urlencode($embedpath);       
       $this->secret = $secret;       
       $this->setNonce(md5(uniqid()))->setCurrent_time(time())->setSession_length(3600*24);
    }
    
    public function getName(){        
        return $this->name;
    }
    
    
    private function getSignature(){  
        
        $sringstosign = array();
        
        $sringstosign[] = $this->host ;
        $sringstosign[] = $this->path ;
        $sringstosign[] = $this->getNonce() ;
        $sringstosign[] = $this->getCurrent_time() ;
        $sringstosign[] = $this->getSession_length() ;
        $sringstosign[] = $this->getExternal_user_id() ;
        $sringstosign[] = $this->getPermission() ;
        $sringstosign[] = $this->getModel() ;
        $sringstosign[] = $this->getGroup_id() ;
        $sringstosign[] = $this->getExternal_group_id() ;
        $sringstosign[] = $this->getUser_attributes() ;
        $sringstosign[] = $this->getAccessfilters();        
        
        $stringtosign = implode("\n",$sringstosign);        
        
        $signature = trim(base64_encode(hash_hmac("sha1", utf8_encode($stringtosign), $this->secret, $raw_output = true)));
        
        return $signature;
        
    }
    
    

    
    function getUrl(){
        
        $signature = $this->getSignature();        
        
        $queryparams = array (
            'nonce' =>  $this->getNonce(),
            'time'  =>  $this->getCurrent_time(),
            'session_length'  =>  $this->getSession_length(),
            'external_user_id'  =>  $this->getExternal_user_id(),
            'permissions' =>  $this->getPermission(),
            'models'  =>  $this->getModel(),
            'group_ids' => $this->getGroup_id(),
            'external_group_id' => $this->getExternal_group_id(),
            'user_attributes' => $this->getUser_attributes(),
            'access_filters'  =>  $this->getAccessfilters(),
            'first_name'  =>  $this->getFirst_name(),
            'last_name' =>  $this->getLast_name(),
            'force_logout_login'  =>  false,
            'signature' =>  $signature
        );
        $querystring = "";
        foreach ($queryparams as $key => $value) {
            if (strlen($querystring) > 0) {
                $querystring .= "&";
            }
            if ($key == "force_logout_login") {
                $value = "true";
            }
            $querystring .= "$key=" . urlencode($value);
        }        
        
        $final = "https://" . $this->host . $this->path . "?" . $querystring;
        return $final;
    }
    /**
     * @return mixed
     */
    public function getNonce()
    {
        return json_encode($this->nonce);
    }

    /**
     * @return mixed
     */
    public function getCurrent_time()
    {
        return json_encode($this->current_time);
    }

    /**
     * @return mixed
     */
    public function getSession_length()
    {
        return json_encode($this->session_length);
    }

    /**
     * @return mixed
     */
    public function getExternal_user_id()
    {
        return json_encode($this->external_user_id);
    }

    /**
     * @return mixed
     */
    public function getFirst_name()
    {
        return json_encode($this->first_name);
    }

    /**
     * @return mixed
     */
    public function getLast_name()
    {
        return json_encode($this->last_name);
    }

    /**
     * @return mixed
     */
    public function getPermission()
    {
        return json_encode($this->permission);
    }

    /**
     * @return mixed
     */
    public function getModel()
    {
        return json_encode($this->model);
    }

    /**
     * @return mixed
     */
    public function getGroup_id()
    {
        return json_encode($this->group_id);
    }

    /**
     * @return mixed
     */
    public function getExternal_group_id()
    {
        return json_encode($this->external_group_id);
    }

    /**
     * @return mixed
     */
    public function getUser_attributes()
    {
        return json_encode($this->user_attributes);
    }

    /**
     * @return mixed
     */
    public function getAccessfilters()
    {
        return json_encode($this->accessfilters);
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param mixed $nonce
     */
    public function setNonce($nonce)
    {       
        $this->nonce = $nonce;
        return $this;
    }

    /**
     * @param mixed $current_time
     */
    public function setCurrent_time($current_time)
    {
        $this->current_time = $current_time;
        return $this;
    }

    /**
     * @param mixed $session_length
     */
    public function setSession_length($session_length)
    {
        $this->session_length = $session_length;
        return $this;
    }

    /**
     * @param mixed $external_user_id
     */
    public function setExternal_user_id($external_user_id)
    {
        $this->external_user_id = $external_user_id;
        return $this;
    }

    /**
     * @param mixed $first_name
     */
    public function setFirst_name($first_name)
    {
        $this->first_name = $first_name;
        return $this;
    }

    /**
     * @param mixed $last_name
     */
    public function setLast_name($last_name)
    {
        $this->last_name = $last_name;
        return $this;
    }

    /**
     * @param mixed $permission
     */
    public function setPermission($permission)
    {
        $this->permission = $permission;
        return $this;
    }

    /**
     * @param mixed $model
     */
    public function setModel($model)
    {
        $this->model = $model;
        return $this;
    }

    /**
     * @param mixed $group_id
     */
    public function setGroup_id($group_id)
    {
        $this->group_id = $group_id;
        return $this;
    }

    /**
     * @param mixed $external_group_id
     */
    public function setExternal_group_id($external_group_id)
    {
        $this->external_group_id = $external_group_id;
        return $this;
    }

    /**
     * @param mixed $user_attributes
     */
    public function setUser_attributes($user_attributes)
    {
        $this->user_attributes = $user_attributes;
        return $this;
    }

    /**
     * @param mixed $accessfilters
     */
    public function setAccessfilters($accessfilters)
    {
        $this->accessfilters = $accessfilters;
        return $this;
    }
    
}
?>
