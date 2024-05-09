<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\StudentProgramType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;


class StudentFormController extends AbstractController
{
    #[Route('/student/form', name: 'app_student_form', methods: ['GET', 'POST'])]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(StudentProgramType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $destination = $this->getParameter('kernel.project_dir') . '/public/uploads';
            //payment
            $payment = $form->get('payment')->getData();
            $originalFilenamepayment = pathinfo($payment->getClientOriginalName(), PATHINFO_FILENAME);
            $filenamepayment = md5(uniqid()) . '.' . $payment->guessExtension();
            $payment->move(

                $destination,
                $filenamepayment
            );
            $user->setPayment($filenamepayment);            
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash('message', 'Profil mis à jour');
        }


        return $this->render('student_form/index.html.twig', [
            'ProgramForm' => $form->createView(),
        ]);
    }
}
