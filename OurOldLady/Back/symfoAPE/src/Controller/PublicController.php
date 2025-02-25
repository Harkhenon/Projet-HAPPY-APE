<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\NewsRepository;
use App\Repository\EventRepository;

class PublicController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function home(NewsRepository $newsRepository, EventRepository $eventRepository)
    {
        $lastNewses = $newsRepository->findNext(3, true);
        $nextEvent = $eventRepository->findNext(1, true);
        foreach($lastNewses as &$news){
            //$text = $this->truncate($event->getContent(), 150);
            $news['content_short'] = $this->excerpt($news['content'], 150);
        }
        foreach($nextEvent as &$event){
            //$text = $this->truncate($event->getContent(), 150);
            $event['content_short'] = $this->excerpt($event['content'], 150);
        }
        return $this->json([
            'title' => 'homepage',
            'news' => $lastNewses,
            'nextEvent' => $nextEvent,
        ]);
    }

    /**
     * Excerpt avec des délimiteurs de phrase.
     *
     * @param string $text
     * @param integer $limit_characters
     * @return string
     */
    public function excerpt($text, $limit_characters = 300){
        $excerpt = '';
        $end_string = '[...]';
        if(empty($limit_characters))
        {
            $limit_characters=300; //maximum de caracteres que je veux dans l'excerpt
        }
        if(strlen($text)>$limit_characters) //on coupe la chaine seulement si elle est supérieure à la limite
        {
            $limit_characters -= strlen($end_string);
            $position_character = 0;
            $limited_text = substr($text,0,$limit_characters);
            
            $delimiteurs=['.',';',',','?','!']; // caractères de fin de phrase
            foreach($delimiteurs as $delimiteur)
            {
                if(
                    strrpos($limited_text , $delimiteur) !== FALSE //retourne faux si le délimiteur n'est pas trouvé
                    && strrpos($limited_text , $delimiteur) > $position_character //prend seulement le délimiteur le plus proche de la limite
                )
                {
                    $position_character = strrpos($limited_text , $delimiteur);
                    $excerpt=substr( $limited_text , 0 , $position_character+1 );
                }

            }
            if(empty($position_character)){
                $excerpt = substr($text,0,($limit_characters));
            }

            $excerpt .= $end_string;
        }else{
            $excerpt = $text;
        }
        return $excerpt;
    }

    // /**
    //  * Truncate avec Wordwrap
    //  *
    //  * @param string $text
    //  * @param integer $width
    //  * @return string
    //  */
    // private function truncate($text, $width = 300){
    //     if(empty($text)){
    //         return $text;
    //     }
    //     if(empty($width)){
    //         $width = 300;
    //     }
    //     $delimiter = '__DELIMITER__';
    //     $text = wordwrap($text, $width, $delimiter, false);

    //     $width = strpos($text, $delimiter);

    //     $text = substr($text, 0, $width);

    //     return $text;
    // }
}

