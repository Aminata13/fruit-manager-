<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller;

use FOS\RestBundle\Controller\AbstractFOSRestController;

/**
 * Description of ExceptionHandler
 *
 * @author bambo
 */
class ExceptionHandler extends AbstractFOSRestController {

    //put your code here
    public function showAction($exception) {
        return $this->handleView($this->view($exception));
    }

}
