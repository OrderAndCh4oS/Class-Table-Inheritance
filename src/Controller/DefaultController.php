<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends BaseController
{
    /**
     * @Route("/admin/", name="admin_dashboard")
     */
    public function index()
    {
        // replace this line with your own code!
        return $this->render('admin/index.html.twig');
    }
}
