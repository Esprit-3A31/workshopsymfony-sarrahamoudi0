<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StudentController extends AbstractController
{
    #[Route('/student', name: 'app_student')]
    public function index(): Response
    {
        return $this->render('student/index.html.twig', [
            'controller_name' => 'StudentController',
        ]);
    }

    public function addStudentForm(Request  $request,ManagerRegistry $doctrine)
    {
        $student= new  Student();
        $form= $this->createForm(StudentType::class,$student);
        $form->handleRequest($request) ;
        if($form->isSubmitted()){
             $em= $doctrine->getManager();
             $em->persist($student);
             $em->flush();
             return  $this->redirectToRoute("addStudentForm");
         }
        return $this->renderForm("student/add.html.twig",array("FormStudentForm"=>$form));
    }

    #[Route('/removestudent/{id}', name: 'remove_student')]
    public function remove(ManagerRegistry $doctrine,$id,ClassroomsRepository $repository)
    {
        $student= $repository->find($id);
        $em= $doctrine->getManager();
        $em->remove($student);
        $em->flush();
        return $this->redirectToRoute("addStudent");
    }



}
