<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends BaseController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        // replace this line with your own code!
        return $this->render('index.html.twig');
    }
}
