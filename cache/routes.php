<?php $o = array();

// ** THIS IS AN AUTO GENERATED FILE. DO NOT EDIT MANUALLY ** 

//==================== v1 ====================

$o['v1'] = array();

//==== v1 usuario ====

$o['v1']['usuario'] = array (
    'GET' => 
    array (
        'url' => 'usuario',
        'className' => 'usuario',
        'path' => 'usuario',
        'methodName' => 'get',
        'arguments' => 
        array (
        ),
        'defaults' => 
        array (
        ),
        'metadata' => 
        array (
            'description' => 'Created by PhpStorm.',
            'longDescription' => 'User: victormanuel Date: 03/06/14 Time: 04:04 AM',
            'scope' => 
            array (
                '*' => '',
            ),
            'resourcePath' => 'usuario/',
            'classDescription' => 'Created by PhpStorm.',
            'param' => 
            array (
            ),
            'return' => 
            array (
                'type' => 'array',
            ),
        ),
        'accessLevel' => 0,
    ),
);

//==== v1 resources/{s0} ====

$o['v1']['resources/{s0}'] = array (
    'GET' => 
    array (
        'url' => 'resources/{id}',
        'className' => 'Luracast\\Restler\\Resources',
        'path' => 'resources',
        'methodName' => 'get',
        'arguments' => 
        array (
            'id' => 0,
        ),
        'defaults' => 
        array (
            0 => '',
        ),
        'metadata' => 
        array (
            'description' => '',
            'longDescription' => '',
            'access' => 'hybrid',
            'param' => 
            array (
                0 => 
                array (
                    'type' => 'string',
                    'name' => 'id',
                    'label' => 'Id',
                    'default' => '',
                    'required' => false,
                    'children' => 
                    array (
                    ),
                    'properties' => 
                    array (
                        'from' => 'path',
                    ),
                ),
            ),
            'throws' => 
            array (
                0 => 
                array (
                    'code' => 500,
                    'reason' => 'RestException',
                ),
            ),
            'return' => 
            array (
                'type' => 'array',
                'description' => '',
            ),
            'url' => 'GET {id}',
            'category' => 'Framework',
            'package' => 'Restler',
            'author' => 
            array (
                0 => 
                array (
                    'email' => 'arul@luracast.com',
                    'name' => 'R.Arul Kumaran',
                ),
            ),
            'copyright' => '2010 Luracast',
            'license' => 'http://www.opensource.org/licenses/lgpl-license.php LGPL',
            'link' => 
            array (
                0 => 'http://luracast.com/products/restler/',
            ),
            'version' => '3.0.0rc5',
            'scope' => 
            array (
                '*' => 'Luracast\\Restler\\',
                'String' => 'Luracast\\Restler\\Data\\String',
                'stdClass' => 'stdClass',
            ),
            'resourcePath' => 'resources/',
            'classDescription' => 'API Class to create Swagger Spec 1.1 compatible id and operation listing',
        ),
        'accessLevel' => 1,
    ),
);

//==== v1 resources ====

$o['v1']['resources'] = array (
    'GET' => 
    array (
        'url' => 'resources',
        'className' => 'Luracast\\Restler\\Resources',
        'path' => 'resources',
        'methodName' => 'index',
        'arguments' => 
        array (
        ),
        'defaults' => 
        array (
        ),
        'metadata' => 
        array (
            'description' => '',
            'longDescription' => '',
            'access' => 'hybrid',
            'return' => 
            array (
                'type' => 'stdClass',
                'description' => '',
                'children' => 
                array (
                ),
            ),
            'category' => 'Framework',
            'package' => 'Restler',
            'author' => 
            array (
                0 => 
                array (
                    'email' => 'arul@luracast.com',
                    'name' => 'R.Arul Kumaran',
                ),
            ),
            'copyright' => '2010 Luracast',
            'license' => 'http://www.opensource.org/licenses/lgpl-license.php LGPL',
            'link' => 
            array (
                0 => 'http://luracast.com/products/restler/',
            ),
            'version' => '3.0.0rc5',
            'scope' => 
            array (
                '*' => 'Luracast\\Restler\\',
                'String' => 'Luracast\\Restler\\Data\\String',
                'stdClass' => 'stdClass',
            ),
            'resourcePath' => 'resources/',
            'classDescription' => 'API Class to create Swagger Spec 1.1 compatible id and operation listing',
            'param' => 
            array (
            ),
        ),
        'accessLevel' => 1,
    ),
);

//==== v1 resources/index ====

$o['v1']['resources/index'] = array (
    'GET' => 
    array (
        'url' => 'resources',
        'className' => 'Luracast\\Restler\\Resources',
        'path' => 'resources',
        'methodName' => 'index',
        'arguments' => 
        array (
        ),
        'defaults' => 
        array (
        ),
        'metadata' => 
        array (
            'description' => '',
            'longDescription' => '',
            'access' => 'hybrid',
            'return' => 
            array (
                'type' => 'stdClass',
                'description' => '',
                'children' => 
                array (
                ),
            ),
            'category' => 'Framework',
            'package' => 'Restler',
            'author' => 
            array (
                0 => 
                array (
                    'email' => 'arul@luracast.com',
                    'name' => 'R.Arul Kumaran',
                ),
            ),
            'copyright' => '2010 Luracast',
            'license' => 'http://www.opensource.org/licenses/lgpl-license.php LGPL',
            'link' => 
            array (
                0 => 'http://luracast.com/products/restler/',
            ),
            'version' => '3.0.0rc5',
            'scope' => 
            array (
                '*' => 'Luracast\\Restler\\',
                'String' => 'Luracast\\Restler\\Data\\String',
                'stdClass' => 'stdClass',
            ),
            'resourcePath' => 'resources/',
            'classDescription' => 'API Class to create Swagger Spec 1.1 compatible id and operation listing',
            'param' => 
            array (
            ),
        ),
        'accessLevel' => 1,
    ),
);

//==== v1 resources/verifyaccess ====

$o['v1']['resources/verifyaccess'] = array (
    'GET' => 
    array (
        'url' => 'resources/verifyaccess',
        'className' => 'Luracast\\Restler\\Resources',
        'path' => 'resources',
        'methodName' => 'verifyAccess',
        'arguments' => 
        array (
            'route' => 0,
        ),
        'defaults' => 
        array (
            0 => NULL,
        ),
        'metadata' => 
        array (
            'description' => 'Verifies that the requesting user is allowed to view the docs for this API',
            'longDescription' => '',
            'param' => 
            array (
                0 => 
                array (
                    'name' => 'route',
                    'type' => 'mixed',
                    'label' => 'Route',
                    'default' => NULL,
                    'required' => true,
                    'children' => 
                    array (
                    ),
                    'properties' => 
                    array (
                        'from' => 'query',
                    ),
                ),
            ),
            'return' => 
            array (
                'type' => 'array',
                'description' => 'True if the user should be able to view this API\'s docs',
            ),
            'category' => 'Framework',
            'package' => 'Restler',
            'author' => 
            array (
                0 => 
                array (
                    'email' => 'arul@luracast.com',
                    'name' => 'R.Arul Kumaran',
                ),
            ),
            'copyright' => '2010 Luracast',
            'license' => 'http://www.opensource.org/licenses/lgpl-license.php LGPL',
            'link' => 
            array (
                0 => 'http://luracast.com/products/restler/',
            ),
            'version' => '3.0.0rc5',
            'scope' => 
            array (
                '*' => 'Luracast\\Restler\\',
                'String' => 'Luracast\\Restler\\Data\\String',
                'stdClass' => 'stdClass',
            ),
            'resourcePath' => 'resources/',
            'classDescription' => 'API Class to create Swagger Spec 1.1 compatible id and operation listing',
        ),
        'accessLevel' => 3,
    ),
);

//==================== apiVersionMap ====================

$o['apiVersionMap'] = array();

//==== apiVersionMap usuario ====

$o['apiVersionMap']['usuario'] = array (
    1 => 'usuario',
);

//==== apiVersionMap Luracast\Restler\Resources ====

$o['apiVersionMap']['Luracast\Restler\Resources'] = array (
    1 => 'Luracast\\Restler\\Resources',
);
return $o;