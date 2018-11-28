<?php
date_default_timezone_set('Australia/Brisbane');

    // load the embedUrl.php class, using require once or namespacing
    
    $embedUrl = new Embedurl("<your_looker_endpoint>","/embed/dashboards/3","<your_secret_here>");  
            $embedUrl->setFirst_name("<first_name>")
                ->setLast_name("<last_name>")
                ->setExternal_user_id("<db_user_id>")
                ->setUser_attributes(Userattributes::fromRoles($roleDetails,$stakeholders))
                ->setExternal_group_id(Externalgroup::fromRoles($roleDetails))
                ->setPermission(array ("access_data", "see_lookml_dashboards"))
                ->setModel(array ("<your_model_name>"))
                ->setGroup_id(array(2))
                ->setAccessfilters(array (                        
                    "<your_model_name>"  =>  array ( "view_name.dimension_name" => "<value>" )
                ));               

                $pageData["iframeUrl"] =  $embedUrl->getUrl();          
?>
