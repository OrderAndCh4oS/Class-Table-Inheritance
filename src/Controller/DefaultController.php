<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends BaseController
{
    /**
     * @Route("/admin/", name="home")
     */
    public function index()
    {
        // replace this line with your own code!
        return $this->render('admin/index.html.twig');
    }
}
