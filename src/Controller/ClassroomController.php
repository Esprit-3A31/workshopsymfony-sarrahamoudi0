<?php

namespace App\Controller;

use App\Entity\Claassrooms;
use App\Repository\ClassroomsFormType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClassroomController extends AbstractController
{
    #[Route('/classroom', name: 'app_classroom')]
    public function index(): Response
    {
        return $this->render('classroom/index.html.twig', [
            'controller_name' => 'ClassroomController',
        ]);
    }

    #[Route('/addclassroom', name: 'add_classroom')]
    public function addClassroom(ManagerRegistry  $doctrine)
    {
        $classroom= new claassrooms();
        $classroom->setname("3a31");
        $classroom->setnbStudent("18");
        $em= $doctrine->getManager();
        $em->persist($classroom);
        $em->flush();
        return new Response("add classroom");
    }
    #[Route('/addClassroomForm', name: 'addClassroomForm')]
    public function addClassroomForm(Request  $request,ManagerRegistry $doctrine)
    {
        $classroom= new  Claassrooms();
        $form= $this->createForm(ClasssroomsFormType::class,$classroom);
        $form->handleRequest($request) ;
        if($form->isSubmitted()){
             $em= $doctrine->getManager();
             $em->persist($classroom);
             $em->flush();
             return  $this->redirectToRoute("addClassroomForm");
         }
        return $this->renderForm("classroom/add.html.twig",array("FormClassroomsForm"=>$form));
    }

    #[Route('/updateclassroom/{id}', name: 'update_classroom')]
    public function updateClassroomForm($id,ClassroomsRepository  $repository,Request  $request,ManagerRegistry $doctrine)
    {
        $classroom= $repository->find($id);
        $form= $this->createForm(ClassroomsFormType::class,$classroom);
        $form->handleRequest($request) ;
        if($form->isSubmitted()){
            $em= $doctrine->getManager();
            $em->flush();
            return  $this->redirectToRoute("addClassroomForm");
        }
        return $this->renderForm("classroom/update.html.twig",array("FormClassroomsForm"=>$form));
    }

    #[Route('/removeclassroom/{id}', name: 'remove_classroom')]
    public function remove(ManagerRegistry $doctrine,$id,ClassroomsRepository $repository)
    {
        $classroom= $repository->find($id);
        $em= $doctrine->getManager();
        $em->remove($classroom);
        $em->flush();
        return $this->redirectToRoute("addClassroom");
    }

    #[Route('/listClassroom', name: 'listClassroom')]
    public function listClassroom(ClassroomsRepository  $repository)
    {
        $classrooms= $repository->findAll();
        return $this->render("classroom/list.html.twig",array("tabClassroom"=>$classroom));
    }

}
