<?php

/**
 * @author  ryan <cumt.xiaochi@gmail.com>
 */

class Version extends BasicModel
{
    public static $relationMap = array(
        'editor' => 'user',
        'entry' => 'entry');
    
    public static function create($info)
    {
        $info = array(
            'edited = NOW()' => null);
        return parent::create($info);
    }

    public function toHtml()
    {
        $content = $this->content;
        $content = markdown_parse($content);

        // I don't know why it works, but, it DOES work
        $dangerList = array(
            '<script>' => htmlspecialchars('<script>'), 
            '<\/script>' => htmlspecialchars('</script>'));
        foreach ($dangerList as $exp => $replStr) {
            $content = preg_replace('/' . $exp . '/', $replStr, $content);
        }
        
        return $content;
    }

    public function editor()
    {
        return new User($this->editor);
    }
}
