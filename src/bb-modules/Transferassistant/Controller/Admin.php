<?php
/**
 * BoxBilling
 *
 * @copyright BoxBilling, Inc (http://www.boxbilling.com)
 * @license   Apache-2.0
 *
 * Copyright BoxBilling, Inc
 * This source file is subject to the Apache-2.0 License that is bundled
 * with this source code in the file LICENSE
 */

namespace Box\Mod\Transferassistant\Controller;

class Admin implements \Box\InjectionAwareInterface
{
    protected $di;

    /**
     * @param mixed $di
     */
    public function setDi($di)
    {
        $this->di = $di;
    }

    /**
     * @return mixed
     */
    public function getDi()
    {
        return $this->di;
    }

    public function fetchNavigation()
    {
        return array(
            'subpages'=> array(
                array(
                    'location'  => 'extensions',
                    'label'     => 'Transfer Assistant',
                    'index'     => 2000,
                    'uri'       => $this->di['url']->adminLink('transferassistant'),
                    'class'     => '',
                ),
            ),
        );

    }
    
    public function register(\Box_App &$app)
    {
        $app->get('/transferassistant', 'get_index', array(), get_class($this));
        $app->get('/transferassistant/:id',  'get_page', array('id'=>'[0-9]+'), get_class($this));
    }

    public function get_index(\Box_App $app)
    {
        $this->di['is_admin_logged'];
        return $app->render('mod_transferassistant_wizard');
    }

    public function get_page(\Box_App $app, $id)
    {
        return $app->render('mod_transferassistant_page', array('page_id' => $id));
    }
}