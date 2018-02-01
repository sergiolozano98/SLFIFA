<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\top100;
use AppBundle\Form\top100Type;
use AppBundle\Entity\Usuario;
use AppBundle\Form\UsuarioTypeNew;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\RedirectResponse;

class UsuarioController extends Controller
{

  /**
   * @Route("/listusuarios", name="listusuarios")
   */

  public function Top100Action(Request $request)
  {
      // replace this example code with whatever you need
      $repository = $this->getDoctrine()->getRepository(Usuario::class);
      // find *all* jugadores
      $user = $repository->findAll();
      return $this->render('AppBundle:Default:usuarioslist.html.twig',array("user"=>$user));

  }
  /**
   * @Route("/admin/actualizaruser/{id}",name="actualizaruser")
   */
  public function actuUser( Request $request,$id)
  {
    $usuario = $this->getDoctrine()->getRepository('AppBundle:Usuario')->find($id);
    $form=$this->createForm(UsuarioTypeNew::Class, $usuario);
    $form->handleRequest($request);
    

    if ($form->isSubmitted() && $form->isValid())
       {
           $em = $this->getDoctrine()->getManager();
           $em->persist($usuario);
           $em->flush();
           //Redirecciona
           return new RedirectResponse($this->generateUrl('listusuarios'));;
       }
         return $this->render("AppBundle:Default:formularioUser.html.twig", array('form'=>$form->createView() ));
   }
   /**
    * @Route("/admin/borrarUser/{id}",name="borrarUser")
    */
   public function borrarFormtop100( Request $request,$id)
   {
     $usuario = $this->getDoctrine()->getRepository('AppBundle:Usuario')->find($id);
     $form=$this->createForm(UsuarioTypeNew::Class, $usuario);
     $form->handleRequest($request);

     if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->remove($usuario);
            $em->flush();
            //Redirecciona
            return new RedirectResponse($this->generateUrl('listusuarios'));;
        }
          return $this->render("AppBundle:Default:formularioUser.html.twig", array('form'=>$form->createView() ));
    }

     }
