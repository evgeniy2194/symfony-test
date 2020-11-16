<?php


namespace App\Controller;


use App\Entity\Postcode;
use App\Form\PostcodeType;
use App\Service\PostcodeService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostcodeController extends AbstractController
{
    /**
     * @Route("/postcode", methods={"GET", "POST"}, name="postcode")
     * @param Request $request
     * @param PostcodeService $postcodeService
     * @return Response
     */
    public function postcodeAction(Request $request, PostcodeService $postcodeService)
    {
        $form = $this->createForm(PostcodeType::class, new Postcode());
        $form->handleRequest($request);
        $message = null;

        if ($form->isSubmitted() && $form->isValid()) {
            /**
             * @var Postcode $postcode
             */
            $postcode = $form->getData();
            $message = "SUCCESS - {$postcode->getPostcode()} Within M25";
        }

        return $this->render('postcode.html.twig', [
            "form" => $form->createView(),
            "message" => $message
        ]);
    }
}
