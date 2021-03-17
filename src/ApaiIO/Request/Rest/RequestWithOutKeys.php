<?php
/*
 * Copyright 2013 Jan Eichhorn <exeu65@googlemail.com>
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace ApaiIO\Request\Rest;

use ApaiIO\Request\Rest\Request;

/**
 * Basic implementation of the rest request
 *
 * @see    http://docs.aws.amazon.com/AWSECommerceService/2011-08-01/DG/AnatomyOfaRESTRequest.html
 * @author Jan Eichhorn <exeu65@googlemail.com>
 */
class RequestWithOutKeys extends Request
{   
   /**
     * The requestscheme
     *
     * @var string
     */
    protected $requestScheme = "http://odp.tuxfamily.org/onca/xml?Country=%s&%s";
    
    /**
     * Initialize instance
     *
     * @param array $options
     */
    public function __construct(array $options = array())
    {
        parent::__construct($options) ;
        $newOptions = array(
            self::CONNECTION_TIMEOUT => 30,
            self::TIMEOUT            => 30
        );
        $this->setOptions($newOptions);
    }
}
