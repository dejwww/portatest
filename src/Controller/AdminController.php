<?php


namespace App\Controller;


use App\Entity\NewsletterEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use League\Csv\Writer;


class AdminController extends AbstractController
{
    /**
     * @Route(path="/admin", name="admin")
     * @return Response
     */
    public function adminPage(){

        return $this->render(
            'admin.html.twig',
                [
                "emails" => $this->getDoctrine()->getManager()->getRepository(NewsletterEmail::class)->findAll()
            ]);
    }

    /**
     * @Route (path="/delete", name="emaildelete")
     * @param Request $request
     * @return Response
     */
    public function deleteEmail(Request $request){
        $manager = $this->getDoctrine()->getManager();
        $emailId = $request->get("email");
        $email = $manager->getRepository(NewsletterEmail::class)->find($emailId);

        if ($email){
            $manager->remove($email);
            $manager->flush();
            $this->addFlash("success","Email successfuly deleted!");
            return $this->redirectToRoute("admin");
        }

        $this->addFlash("warning","Such database entry does not exist!");
        return $this->redirectToRoute("admin");
    }

    /**
     * @Route (path="exportdb", name="export")
     * @param Request $request
     * @throws \League\Csv\CannotInsertRecord
     */
    public function export(Request $request){
        $manager = $this->getDoctrine()->getManager();
        $emails = $manager->getRepository(NewsletterEmail::class)->findAll();

        $header = ['ID', 'Date and time', 'Email', "IP"];
        $data = [];
        foreach ($emails as $email){
            $data [] = [
                $email->getId(),
                $email->getDateTime(),
                $email->getEmail(),
                $email->getIp()];
        }

        $csv = Writer::createFromString('');
        $csv->insertOne($header);
        $csv->insertAll($data);

        $csv->output('emails');
        die;
    }
}