<?php

namespace App\DataFixtures;

use App\Entity\Page;
use App\Entity\User;
use App\Entity\Event;
use Nelmio\Alice\Loader\NativeLoader;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    public function __construct(UserPasswordEncoderInterface $encoder)
        {
            $this->encoder = $encoder;
        }

    public function load(ObjectManager $manager)
    {
        $loader = new NativeLoader();
        
            
        $entities = $loader->loadFile(__DIR__.'/fixtures.yml')->getObjects();
        
        foreach ($entities as $entity) {
            if($entity instanceof User) {
                $entity->setPassword($this->encoder->encodePassword(
                    $entity, 
                    $entity->getPassword()));
            }
            $manager->persist($entity);
        };

        $pageML = new Page(); 
        $pageML->setTitle('Mentions Légales'); 
        $pageML->setContent('Editeur du site

        Site Internet Qualité
        par Natural-net
        49 boulevard Antoine Gautier
        33000 Bordeaux
        France
        Tél. : + 33 (0)6 62 79 25 55
        Fax : + 33 (0)5 40 00 02 66
        https://www.site-internet-qualite.fr
        
        Natural net est une EURL au capital de 3500€
        RCS B 497 553 71 - Siret : 49755371900020 - APE : 6201Z
        N° déclaration CNIL : 1522193
        '); 
        $manager->persist($pageML);

        $pageCGV = new Page(); 
        $pageCGV->setTitle('Conditions générales de vente'); 
        $pageCGV->setContent(' Exemple de CGV

        A retenir :
        
        Cet exemple n’intègre pas toutes les spécificités liées aux produits offerts, à une éventuelle activité de service, des contenus numériques, des abonnements…
        En principe, toutes les rubriques figurant dans le modèle doivent être présentes dans toutes les CGV, quelle que soit par ailleurs l’offre de vente.
        Les différentes dispositions sont à adapter selon le produit vendu.
        Cet exemple concerne les ventes simples de produits par exemple artisanaux, d’habillement ou de papeterie.
        
        "Préambule :
        
        L’association [nom de l\'association] propose à la vente des produits destinés à (par exemple: contribuer au financement de son activité).
        Les offres sont valables dans la limite des stocks disponibles et pour autant qu’elles figurent sur le site.
        La vente n’est proposée que pour les acheteurs résidant et se faisant livrer sur le territoire métropolitain.
        En passant commande sur le site, nos clients reconnaissent en avoir pris connaissance et les avoir acceptées.
        
        Données personnelles :
        
        Les données collectées ne sont utilisées que pour pouvoir honorer la commande ; elles sont accessibles par les personnes chargées de la préparation et de l’envoi de la commande. Elles peuvent être transmises aux établissements bancaires pour exécution du paiement.
        Le responsable du traitement est[nom et fonction/qualité du responsable légal de l\'association]
        Conformément à la Loi informatique et Libertés du 6 janvier 1978, un droit d’accès et de rectification est possible en nous contactant à l’adresse suivante [e-mail]
        
        Objet :
        
        Les présentes conditions générales de vente régissent  exclusivement les ventes réalisées sur son site internet par l’association [coordonnées complètes de l\'association] et dont la présidente est [prénom nom]
        
        Produits :
        
        Les produits proposés sont (à préciser, par exemple : issus de l’agriculture biologique, du commerce équitable, de nos ateliers protégés….)
        
        Prix :
        
        Les prix sont indiqués en euros TTC hors frais d’envoi ; ce sont les prix en vigueur au moment de la commande qui sont applicables à celle-ci.
        
        Les commandes :
        
        Le processus de commande comprend plusieurs étapes :
        1) L’internaute sélectionne sur le site les produits qu’il choisit et indique la quantité désirée ; 2) Un récapitulatif de sa commande lui est proposé ; l’internaute a la possibilité de rectifier sa commande
        3) L’internaute valide sa commande : en confirmant la commande, l’internaute reconnait son obligation de paiement
        4) Une fois la commande validée, l’association Les Coquelicots envoie dans les meilleurs délais un accusé de réception de la commande.
        
        Paiement :
        
        Le paiement en ligne peut se faire par carte bancaire ou Paypal (ou à partir de notre site sécurisé ou géré par notre site) ; vos informations de paiement ne seront pas conservées après le paiement
        Le paiement par chèque est admis ; il doit être envoyé dans les meilleurs délais par voie postale à l’adresse suivante [adresse postale de l\'association], accompagné d’une copie de la commande
        Les commandes payées par chèque ne feront l’objet d’une prise en compte qu’après encaissement du chèque, domicilié auprès d’une banque française.
        
        Livraison :
        
        Nous ne pouvons assurer l’envoi des produits proposés qu’aux personnes domiciliées en France métropolitaine à l’adresse indiquée lors de la commande. Les délais ou la période de livraison sont indiqués pour chaque produit au moment de la commande ; dans la mesure du possible, nous procédons à un envoi groupé. Si cela n’est pas possible, les frais de livraison des envois complémentaires sont à la charge de l’association. Les colis sont acheminés par la poste et le transfert de propriété s’opère au moment de la remise du colis par la poste.
        
        Droit de rétractation :
        
        En application de l’article L121-17 I du code de la consommation, vous avez le droit de vous rétracter de la présente vente, sans donner de motif, dans un délai de quatorze jours.
        Le délai de rétractation expire quatorze jours après le jour où vous-même, ou un tiers autre que le transporteur et désigné par vous, prend physiquement possession du bien(ou du dernier bien si plusieurs colis issus de la même commande sont nécessaires).
        Pour exercer le droit de rétractation, vous devez nous notifier à [coordonnées de l\'association] votre décision de rétractation, au moyen d\'une déclaration dénuée d\'ambiguïté (par exemple, lettre envoyée par la poste, télécopie ou courrier électronique). Vous pouvez utiliser le modèle de formulaire de rétractation mais ce n\'est pas obligatoire (https://www.service-public.fr/particuliers/vosdroits/R38397)
        Pour que le délai de rétractation soit respecté, il suffit que vous transmettiez votre décision de rétractation avant l\'expiration du délai de rétractation.
        
        Effets de rétractation
        En cas de rétractation de votre part, nous vous rembourserons tous les paiements reçus de vous, y compris les frais de livraison (à l\'exception des frais supplémentaires découlant du fait que vous avez choisi, le cas échéant, un mode de livraison autre que le mode moins coûteux de livraison standard proposé par nous).
        Ce remboursement sera fait  sans retard excessif et au plus tard quatorze jours à compter du jour où nous sommes informés de votre décision de rétractation.
        Nous procéderons au remboursement en utilisant le même moyen de paiement que celui que vous aurez utilisé pour la transaction initiale; en tout état de cause, ce remboursement n\'occasionnera pas de frais pour vous .Nous pouvons différer le remboursement jusqu\'à ce que nous ayons reçu le bien ou jusqu\'à ce que vous ayez fourni une preuve d\'expédition du bien, la date retenue étant celle du premier de ces faits
        Vous devrez renvoyer ou rendre le bien, à nous-mêmes sans retard excessif,  au plus tard quatorze jours après que vous nous aurez communiqué votre décision de rétractation du présent contrat. Ce délai est réputé respecté si vous renvoyez le bien avant l\'expiration du délai de quatorze jours. Votre responsabilité n\'est engagée qu\'à l\'égard de la dépréciation du bien résultant de manipulations autres que celles nécessaires pour établir la nature, les caractéristiques et le bon fonctionnement de ce bien.
        Vous devrez prendre en charge les frais directs de renvoi du bien.
        
        Garanties :
        
        En application du code de la consommation (article L211-4, L133-3 et R111-1), nous sommes garants de la conformité des produits commandés pendant les 2 ans qui suivent l’achat. Vous devez nous prévenir par courrier et nous envisagerons la réparation, le remplacement ou le remboursement si les deux premières solutions ne peuvent être mises en œuvre
        
        (Les mentions concernant la garantie légale doivent figurer dans un encadré)
        La garantie des vices cachés prévues aux articles 1641 à 1648 et 2232du code civil s’applique également.
        Ces garanties s’appliquent sans préjudice du droit de rétractation.
        
        Réclamations :
        
        Vos réclamations concernant votre commande sont à adresser à
        [adresse mail]
        Vous pouvez également nous téléphoner au [téléphone]
        Si la réponse que nous vous apportons ne vous satisfait pas, vous pouvez contacter la plateforme de règlement des litiges en ligne mise en place par la commission européenne.
        https://webgate.ec.europa.eu/odr/main/index.cfm?event=main.adr.show
        
        Médiation :
        
        Conformément au décret du 30 octobre 2015, vous pouvez recourir à un service de médiation  ; des informations complémentaires vous seront données  sur le site suivant : http://www.economie.gouv.fr/mediation-conso.
        
        Loi applicable et juridiction :
        
        Les éventuels litiges survenant à l’occasion de votre commande sont régis par les tribunaux français selon la loi française."
        
        Depuis le 1° janvier 2016 cette mention est obligatoire ; son absence est sanctionnée par une amende de 3 000€ à 15 000€ ; il appartient au commerçant électronique d’adhérer à un service de médiation'); 
        $manager->persist($pageCGV);

        $pageCGU = new Page(); 
        $pageCGU->setTitle('Conditions générales d\'utilisation'); 
        $pageCGU->setContent('Le site accessible par les url suivants : www.site-internet-qualite.fr est exploité dans le respect de la législation française. L\'utilisation de ce site est régie par les présentes conditions générales. En utilisant le site, vous reconnaissez avoir pris connaissance de ces conditions et les avoir acceptées. Celles-ci pourront êtres modifiées à tout moment et sans préavis par la société Natural net.
        Natural net ne saurait être tenu pour responsable en aucune manière d’une mauvaise utilisation du service. 
        
        Limitation de responsabilité
        Les informations contenues sur ce site sont aussi précises que possibles et le site est périodiquement remis à jour, mais peut toutefois contenir des inexactitudes, des omissions ou des lacunes. Si vous constatez une lacune, erreur ou ce qui parait être un dysfonctionnement, merci de bien vouloir le signaler par email en décrivant le problème de la manière la plus précise possible (page posant problème, action déclenchante, type d’ordinateur et de navigateur utilisé, …).

        Tout contenu téléchargé se fait aux risques et périls de l\'utilisateur et sous sa seule responsabilité. En conséquence, Natural net ne saurait être tenu responsable d\'un quelconque dommage subi par l\'ordinateur de l\'utilisateur ou d\'une quelconque perte de données consécutives au téléchargement.   

        Les photos sont non contractuelles.

        Les liens hypertextes mis en place dans le cadre du présent site internet en direction d\'autres ressources présentes sur le réseau Internet ne sauraient engager la responsabilité de Natural net.

        Litiges
        Les présentes conditions sont régies par les lois françaises et toute contestation ou litiges qui pourraient naître de l\'interprétation ou de l\'exécution de celles-ci seront de la compétence exclusive des tribunaux dont dépend le siège social de la société Natural net. La langue de référence, pour le règlement de contentieux éventuels, est le français.
        Déclaration à la CNIL
        Conformément à la loi 78-17 du 6 janvier 1978 (modifiée par la loi 2004-801 du 6 août 2004 relative à la protection des personnes physiques à l\'égard des traitements de données à caractère personnel) relative à l\'informatique, aux fichiers et aux libertés, le site a fait l\'objet d\'une déclaration auprès de la Commission nationale de l\'informatique et des libertés (www.cnil.fr). 
        Droit d\'accès
        En application de cette loi, les internautes disposent d’un droit d’accès, de rectification, de modification et de suppression concernant les données qui les concernent personnellement. Ce droit peut être exercé par voie postale auprès de Natural net 49, Boulevard Antoine Gautier 33000 Bordeaux ou par voie électronique à l’adresse email suivante : contact@natural-net.fr.
        Les informations personnelles collectées ne sont en aucun cas confiées à des tiers hormis pour l’éventuelle bonne exécution de la prestation commandée par l’internaute.

        Confidentialité
        Vos données personnelles sont confidentielles et ne seront en aucun cas communiquées à des tiers hormis pour la bonne exécution de la prestation.
        Propriété intellectuelle

        Tout le contenu du présent site, incluant, de façon non limitative, les graphismes, images, textes, vidéos, animations, sons, logos, gifs et icônes ainsi que leur mise en forme sont la propriété exclusive de la société Natural net à l\'exception des marques, logos ou contenus appartenant à d\'autres sociétés partenaires ou auteurs.
        Toute reproduction, distribution, modification, adaptation, retransmission ou publication, même partielle, de ces différents éléments est strictement interdite sans l\'accord exprès par écrit de Natural net. Cette représentation ou reproduction, par quelque procédé que ce soit, constitue une contrefaçon sanctionnée par les articles L.3335-2 et suivants du Code de la propriété intellectuelle. Le non-respect de cette interdiction constitue une contrefaçon pouvant engager la responsabilité civile et pénale du contrefacteur. En outre, les propriétaires des Contenus copiés pourraient intenter une action en justice à votre encontre.

        Natural net est identiquement propriétaire des "droits des producteurs de bases de données" visés au Livre III, Titre IV, du Code de la Propriété Intellectuelle (loi n° 98-536 du 1er juillet 1998) relative aux droits d\'auteur et aux bases de données.

        Les utilisateurs et visiteurs du site internet peuvent mettre en place un hyperlien en direction de ce site, mais uniquement en direction de la page d’accueil, accessible à l\’URL suivante : www.site-internet-qualite.fr, à condition que ce lien s’ouvre dans une nouvelle fenêtre. En particulier un lien vers une sous page (« lien profond ») est interdit, ainsi que l’ouverture du présent site au sein d’un cadre (« framing »), sauf l\'autorisation expresse et préalable de Natural net.

        Pour toute demande d\'autorisation ou d\'information, veuillez nous contacter par email : contact@natural-net.fr. Des conditions spécifiques sont prévues pour la presse.

        Par ailleurs, la mise en forme de ce site a nécessité le recours à des sources externes dont nous avons acquis les droits ou dont les droits d\'utilisation sont ouverts : Seosight, Designed by themefire Developed by Crumina​. Les illustrations ont été acquises sur Adobe Stock. 

        Ce site est proposé en langages HTML5 et CSS3, pour un meilleur confort d\'utilisation et un graphisme plus agréable, nous vous recommandons de recourir à des navigateurs modernes comme Safari, Firefox, Chrome,...
        Informations et exclusion
        Natural net met en œuvre tous les moyens dont elle dispose, pour assurer une information fiable et une mise à jour fiable de ses sites internet. Toutefois, des erreurs ou omissions peuvent survenir. L\'internaute devra donc s\'assurer de l\'exactitude des informations auprès de Natural net, et signaler toutes modifications du site qu\'il jugerait utile. Natural net n\'est en aucun cas responsable de l\'utilisation faite de ces informations, et de tout préjudice direct ou indirect pouvant en découler.
        Cookies
        Pour des besoins de statistiques et d\'affichage, le présent site utilise des cookies. Il s\'agit de petits fichiers textes stockés sur votre disque dur afin d\'enregistrer des donné

        '); 
        $manager->persist($pageCGU);
        
        $pageAbout = new Page(); 
        $pageAbout->setTitle('Qui sommes-nous ?'); 
        $pageAbout->setContent('Une association de parents d\'élèves a pour objet la défense des intérêts moraux et matériels communs aux parents d\'élèves. Elle ne regroupe que des parents d\'élèves, auxquels sont assimilées les personnes ayant la responsabilité légale d\'un ou plusieurs élèves. Elle représente les parents d\'élèves en participant aux conseils d\'écoles, aux conseils d\'administration des établissements scolaires et aux conseils de classe.

        Les associations ne peuvent fixer le siège social dans l\'enceinte scolaire. 
        
        L\'organisation, par une association de parents d\'élèves, d\'activités autres que celles se rattachant directement aux nécessités de la formation comme des kermesses, des bourses aux vêtements, etc. oblige à recourir à la procédure prévue à l\'article L. 212-15 susvisé, qui est explicitée par les deux circulaires précitées. Le maire est, en effet, compétent pour décider de l\'utilisation des locaux scolaires en dehors des périodes où ils sont utilisés pour les besoins de la formation initiale et continue. En conséquence, toute demande de cette nature formulée par une association suppose l\'autorisation préalable du maire et l\'accord de la collectivité territoriale propriétaire des locaux. Elle peut, éventuellement, faire l\'objet d\'une convention.
        
        '); 
        $manager->persist($pageAbout);

        $pageContact = new Page(); 
        $pageContact->setTitle('Contact'); 
        $pageContact->setContent('Responsable éditorial

        Eric Emery
        Site Internet Qualité
        par Natural-net
        49 boulevard Antoine Gautier
        33000 Bordeaux
        France
        Tél. : + 33 (0)6 62 79 25 55
        Fax : + 33 (0)5 40 00 02 66
        http://www.site-internet-qualite.fr
        '); 
        $manager->persist($pageContact);
        
        $manager->flush();
    }
}
