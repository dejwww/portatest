<?php


namespace App\Controller;


use App\Entity\NewsletterEmail;
use App\Form\NewsletterEmailForm;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route(path="/", name="main")
     * @param Request $request
     * @return Response
     */
    public function main(Request $request){
        $form = $this->createForm(NewsletterEmailForm::class)->handleRequest($request);

        if($form->isSubmitted() and $form->isValid()){
            $verification = $form->get("verify")->getViewData();

            if ($verification != "porta"){
                $this->addFlash("warning","Bots don't have human rights");
                return $this->redirectToRoute("main");
            }

            $data = $form->getData();

            $manager = $this->getDoctrine()->getManager();

            $email = $data->getEmail();
            $searchedMail = $manager->getRepository(NewsletterEmail::class)->findOneBy(["email" => $email]);

            if(!$searchedMail) {
                $data->setIp($request->getClientIp());
                $data->setDateTime(new \DateTime("now"));

                $manager->persist($data);
                $manager->flush();

                $this->addFlash("success", "You have successfully joined our newsletter!");
            }
            else{
                $this->addFlash("warning","You are already receiving our newsletter");
            }
        }

        return $this->render(
            'base.html.twig',
            [
                "form" => $form->createView()
            ]);
    }
}