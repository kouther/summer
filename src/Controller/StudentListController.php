<?php

namespace App\Controller;

use Dompdf\Dompdf;
use Dompdf\Options;
use App\Repository\UserRepository;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Attachment;

#[Route('/student')]

class StudentListController extends AbstractController
{

    #[Route('/list', name: 'app_student_list')]
    public function index(UserRepository $userRepository): Response
    {
        $students = $userRepository->findAll();
        return $this->render('student_list/index.html.twig', [
            'students' => $students,
        ]);
    }
    #[Route('/{id}', name: 'app_validate', methods: ['GET', 'POST'])]
    public function validate(EntityManagerInterface $entityManager, User $user, Request $request, MailerInterface $mailer): Response
    {
        if ($request->isMethod(Request::METHOD_POST)) {
            $status = $request->request->get('select-status');
            $commentaire = $request->request->get('commentaire');
            $user->setStatus($status);
            $user->setCommentaire($commentaire);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();


            if ($status == "approuve") {
                $pdfOptions = new Options();
                $pdfOptions->set('defaultFont', 'Arial');
                $dompdf = new Dompdf($pdfOptions);
                $html = $this->renderView('generate_card/index.html.twig', [
                    'user' => $user,
                ]);
                $dompdf->loadHtml($html);
                $dompdf->setPaper('A4', 'portrait');
                $dompdf->render();
                $output = $dompdf->output();


                $email = (new Email())
                    ->from('contact@bmsconstruction.fr')
                    ->to($user->getEmail())
                    ->subject('Your PDF Subject')
                    ->text('Your request has been approved! Attached to this message, you will find your official student ID card. This card serves as proof of your student status and grants you access to various student services and benefits. Please review the attached card carefully and notify us immediately if you notice any errors or discrepancies. If you have any questions or need further assistance, feel free to contact us. Thank you for your cooperation, and we wish you all the best in your studies!')
                    ->attach(new Attachment(
                        $output,
                        'pdf_file.pdf',
                        'application/pdf'
                    ));

                $this->get('mailer')->send($email);
                return new Response('PDF sent successfully.');

            }
        }
        return $this->render('student_list/validate.html.twig', [
            'user' => $user,
        ]);
    }
}
