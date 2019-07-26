<?php

namespace App\Controller;

use App\Entity\Event;
use App\Form\EventType;
use App\Repository\EventRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EventController extends AbstractController {

    /**
     * @Route("/events", name="events_list")
     */
    public function list(EventRepository $repo)
    {

        $events = $repo->findAll();
        return $this->json($events);


        // $data = array();

        // for ($i = 1; $i <= 10; $i++){
        //     $event[$i] = new Event();
        //     $event[$i]->setName("Titre de l'événement n°$i")
        //           ->setContent("<p>Contenu de l'événement n°$i</p>");
        //     $data[$i] = [
        //         "id" => $event[$i]->getId(),
        //         "name" => $event[$i]->getName(),
        //         "date" => $event[$i]->getDate(),
        //         "createdAt" => $event[$i]->getCreatedAt(),
        //         "updatedAt" => $event[$i]->getUpdatedAt(),
        //         "isPublished" => $event[$i]->getIsPublished(),
        //         "content" => $event[$i]->getContent()
        //     ];
        // }
        
        // return new JsonResponse($data);
    }

     /**
     * @Route("/events/{id}", name="event_show")
     */
    public function show(Event $event)
    {
        return $this->json($event);
    }

     /**
     * @Route("/private/events/create", name="event_create")
     * @Route("/private/events/{id}/edit", name="event_edit")
     */
    public function form(Event $event = null, Request $request, ObjectManager $manager)
    {
        if (!$event){
            $event = new Event();
        }

        $form = $this->createForm(EventType::class, $event);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            if(!$event->getId()) {
                $event->setCreatedAt(new \DateTime);
            }
            $manager->persist($event);
            $manager->flush();

            return $this->redirectToRoute('event_show', ['id' => $event->getId()]);
        }

        return $this->json([
            'formEvent' => $form->createView(),
            'editMode' => $event->getId() !== null
        ]);

    }

     /**
     * @Route
     */
    public function edit()
    {
        return $this->json(['title' => 'événements', 
    'content' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Deleniti provident ipsum enim adipisci tempore sit amet pariatur, praesentium saepe doloribus quisquam quos rerum! Quaerat ratione at iste exercitiatonem id perferendis?']);
    }

     /**
     * @Route("/events/{id}/delete", name="event_delete")
     */
    public function delete()
    {
        return $this->json(['title' => 'événements', 
    'content' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Deleniti provident ipsum enim adipisci tempore sit amet pariatur, praesentium saepe doloribus quisquam quos rerum! Quaerat ratione at iste exercitiatonem id perferendis?']);
    }
}
