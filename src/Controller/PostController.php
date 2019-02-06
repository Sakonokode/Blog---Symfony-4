<?php
/**
 * Created by PhpStorm.
 * User: coltluger
 * Date: 06/02/19
 * Time: 15:49
 */

namespace Blog\Controller;

use Blog\Entity\Post;
use Blog\Form\PostType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * Class PostController
 * @package Blog\Controller
 */
class PostController extends AbstractController
{
    /**
     * @Route("/post/read/{slug}", name="read")
     * @Method("GET")
     * @param Post $post
     * @return Response
     */
    public function read(Post $post): Response
    {
        $parameters = [
            'post' => $post,
        ];

        return $this->render('post/read.html.twig', $parameters);
    }

    /**
     * @Route("/post/new", name="post_new")
     * @Method("POST")
     * @IsGranted("ROLE_USER")
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $post = new Post();
        $post->setAuthor($this->getUser());

        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();
        }

        $this->addFlash('success', 'post.created_successfully');

        return $this->render('/post/new.html.twig', [
            'form' => $form->createView(),
            'post' => $post,
        ]);
    }
}