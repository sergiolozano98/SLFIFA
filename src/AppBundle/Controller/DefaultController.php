<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\top100;
use AppBundle\Form\top100Type;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

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
    /**
     * @Route("/formtop100", name="formtop100")
     */
    public function Top100FormAction(Request $request)
    {
         $jugador = new top100();
         $form = $this->createForm(top100Type::Class);
         $form->handleRequest($request);

         if ($form->isSubmitted() && $form->isValid()) {
         // $form->getData() holds the submitted values
         // but, the original `$task` variable has also been updated
         $jugador = $form->getData();

         // ... perform some action, such as saving the task to the database
         // for example, if Task is a Doctrine entity, save it!
          $em = $this->getDoctrine()->getManager();
          $em->persist($jugador);
          $em->flush();

          return $this->render('AppBundle:Default:insertada.html.twig');
   }
         //le pasamos a la vista el formulario ya pintado
         return $this->render('AppBundle:Default:formulario.html.twig',array("form"=>$form->createView() ));
    }
    /**
     * @Route("/actualizarformtop100/{id}",name="actualizarjugador")
     */
    public function actuFormtop100( Request $request,$id)
    {
      $jugador = $this->getDoctrine()->getRepository('AppBundle:top100')->find($id);
      $form=$this->createForm(top100Type::Class, $jugador);
      $form->handleRequest($request);

      if ($form->isSubmitted() && $form->isValid())
         {
             $em = $this->getDoctrine()->getManager();
             $em->persist($jugador);
             $em->flush();
             return $this->render("AppBundle:Default:update.html.twig");
         }
           return $this->render("AppBundle:Default:formulario.html.twig", array('form'=>$form->createView() ));
     }
     /**
      * @Route("/borrarformtop100/{id}",name="borrarjugador")
      */
     public function borrarFormtop100( Request $request,$id)
     {
       $jugador = $this->getDoctrine()->getRepository('AppBundle:top100')->find($id);
       $form=$this->createForm(top100Type::Class, $jugador);
       $form->handleRequest($request);

       if ($form->isSubmitted() && $form->isValid())
          {
              $em = $this->getDoctrine()->getManager();
              $em->remove($jugador);
              $em->flush();
              return $this->render("AppBundle:Default:delete.html.twig");
          }
            return $this->render("AppBundle:Default:formulario.html.twig", array('form'=>$form->createView() ));
      }
      /**
       * @Route("/jugador/{nombre}")
       */
       //en la ruta le pasamos el nombre del jugador a buscar
       public function buscarJugador($nombre='Lionel')
      {
        //Recuperar el repositorio de la entidad
        $repository = $this->getDoctrine()->getRepository(top100::class);
        //metemos en la variable jugador la info del jugador filtrado por el nombre
        $jugador = $repository->findByNombre($nombre);
        //devolvemos y metemos en el array jugador la info de antes metida en esa variable $jugador
        return $this->render('AppBundle:Default:jugadorbuscado.html.twig',array('jugador' => $jugador));

      }
      //es necesario el name para el path y buscar la vista del jugador
      /**
       * @Route("/vistajugador/{id}" ,name="vista")
       */
       public function buscarVistaJugador($id)
      {
        //Recuperar el repositorio de la entidad
        $repository = $this->getDoctrine()->getRepository(top100::class);
        //metemos en la variable jugador la info del jugador filtrado por el id
        $jugador = $repository->find($id);
        //devolvemos y metemos en el array cerveza la info de antes metida en esa variable $jugador
        return $this->render('AppBundle:Default:vistajugador.html.twig',array('jugador' => $jugador));

      }


     }
