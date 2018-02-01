<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\top100;
use AppBundle\Form\top100Type;
use AppBundle\Entity\Usuario;
use AppBundle\Form\UsuarioType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\RedirectResponse;

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
     * @Route("/user/contactanos", name="contactanos")
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
     * @Route("/admin/formtop100", name="formtop100")
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

          //Redirecciona
          return new RedirectResponse($this->generateUrl('top100'));;
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
             //Redirecciona
             return new RedirectResponse($this->generateUrl('top100'));;
         }
           return $this->render("AppBundle:Default:formulario.html.twig", array('form'=>$form->createView() ));
     }
     /**
      * @Route("/admin/borrarformtop100/{id}",name="borrarjugador")
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
              //Redirecciona
              return new RedirectResponse($this->generateUrl('top100'));;
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

      /**
       * @Route("/usuarios", name="usuario")
       */
      public function usuariosAction()
      {
          return $this->render('default/index.html.twig');
      }

      /**
       * @Route("/registro", name="registro")
       */
    public function registerAction(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        // 1) build the form
        $user = new Usuario();
        $form = $this->createForm(UsuarioType::class, $user);

        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            // 3) Encode the password (you could also do this via Doctrine listener)
            $password = $this->get('security.password_encoder')
            ->encodePassword($user,$user->getPlainPassword());
            $user->setPassword($password);
            // 4) save the User!
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            // ... do any other work - like sending them an email, etc
            // maybe set a "flash" success message for the user

            return new Response("Usuario insertado correctamente");
        }

        return $this->render(
            'AppBundle:Default:registro.html.twig',
            array('form' => $form->createView())
        );
    }
    /**
     * @Route("/login", name="login")
     */
    public function loginAction(Request $request)
    {
      $authenticationUtils = $this->get('security.authentication_utils');

       // get the login error if there is one
       $error = $authenticationUtils->getLastAuthenticationError();

       // last username entered by the user
       $lastUsername = $authenticationUtils->getLastUsername();

       return $this->render('AppBundle:Default:login.html.twig', array(
           'last_username' => $lastUsername,
           'error'         => $error,
       ));
    }

    /**
     * @Route("/logout", name="logout")
     */
     public function logout()
     {

     }
     }
