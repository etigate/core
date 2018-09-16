<?php

/*
 * This file is part of Glugox.
 *
 * (c) Glugox <glugox@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Glugox\Core\Models;

use Illuminate\Support\Arr;

/**
 * Description of Config
 *
 * @author User
 */
class Config {
    
    
    private $data;


    /**
     * 
     * @param string $xml
     */
    public function __construct( string $xml='' ) {
        if(!empty($xml)){
            $this->data = simplexml_load_string(self::removeNamespaceFromXML($xml), null,  LIBXML_NOBLANKS);
            $this->data = json_encode($this->data);
            $this->data = json_decode($this->data, true);
        }
        
    }
    
    /**
     * 
     * @return type
     */
    public function toArray(){
        return $this->data;
    }


    /**
     * 
     * @param type $xml
     * @return type
     */
    static function removeNamespaceFromXML( $xml )
    {
        // Because I know all of the the namespaces that will possibly appear in 
        // in the XML string I can just hard code them and check for 
        // them to remove them
        $toRemove = ['rap', 'turss', 'crim', 'cred', 'j', 'rap-code', 'evic'];
        // This is part of a regex I will use to remove the namespace declaration from string
        $nameSpaceDefRegEx = '(\S+)=["\']?((?:.(?!["\']?\s+(?:\S+)=|[>"\']))+.)["\']?';

        // Cycle through each namespace and remove it from the XML string
       foreach( $toRemove as $remove ) {
            // First remove the namespace from the opening of the tag
            $xml = str_replace('<' . $remove . ':', '<', $xml);
            // Now remove the namespace from the closing of the tag
            $xml = str_replace('</' . $remove . ':', '</', $xml);
            // This XML uses the name space with CommentText, so remove that too
            $xml = str_replace($remove . ':commentText', 'commentText', $xml);
            // Complete the pattern for RegEx to remove this namespace declaration
            $pattern = "/xmlns:{$remove}{$nameSpaceDefRegEx}/";
            // Remove the actual namespace declaration using the Pattern
            $xml = preg_replace($pattern, '', $xml, 1);
        }

        // Return sanitized and cleaned up XML with no namespaces
        return $xml;
    }

}
