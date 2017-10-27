<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\top100;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }
    /**
     * @Route("/login", name="login")
     */

    public function loginAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/login.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }
    /**
     * @Route("/contactanos", name="contactanos")
     */

    public function ContactoAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/contactanos.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }
    /**
     * @Route("/miequipo", name="miequipo")
     */

    public function MiEquipoAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/miequipo.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }
    /**
     * @Route("/mijugador", name="mijugador")
     */

    public function MiJugadorAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/mijugador.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }
    /**
     * @Route("/registro", name="registro")
     */

    public function RegistroAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/registro.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }
    /**
     * @Route("/top100", name="top100")
     */

    public function Top100Action(Request $request)
    {
        // replace this example code with whatever you need
        $repository = $this->getDoctrine()->getRepository(top100::class);
        // find *all* jugadores
        $jugadores = $repository->findAll();
        return $this->render('AppBundle:Default:top100.html.twig',array("top100"=>$jugadores));

    }

    /**
     * @Route("/topequipos", name="topequipos")
     */

    public function TopEquiposAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/topequipos.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }

}
