<?php
require_once dirname(__FILE__) . '/../renderer/inverse.php';

/**
 * @group plugin_edittable
 * @group plugins
 */
class edittable_test_inverse extends DokuWikiTest {

    function test() {
        $this->externallink();
    }

    function externallink() {
        $text = '[[file:///x:\folder\file.zip]]';
        $this->render($text);
    }

    protected function render($text) {
        $instructions = p_get_instructions($text);
        $Renderer = new renderer_plugin_edittable_inverse();

        foreach ( $instructions as $instruction ) {
            // Execute the callback against the Renderer
            call_user_func_array(array(&$Renderer, $instruction[0]),$instruction[1]);
        }

        $this->assertEquals($Renderer->doc, $text);
    }
}
