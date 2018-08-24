<?php
namespace OC\WestoryBundle\Controller;
 
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use OC\WestoryBundle\Entity\Story;
 
class AjaxStoryController extends Controller
{
    public function updateDataAction(Request $request)
    {
        $data = $request->get('input');
        
        $em = $this->getDoctrine()->getManager();
 
        $query = $em->createQuery(''
                . 'SELECT s.id, s.title, s.author, s.postNumber, s.postLimit '
                . 'FROM OCWestoryBundle:Story s ' 
                . 'WHERE s.title LIKE :data '
                . 'ORDER BY s.title ASC'
                )
                ->setParameter('data', '%' . $data . '%');
        $results = $query->getResult();

        $storyRep = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository(Story::class)
        ;
        
        $storyList = '<div id="matchList">';
        foreach ($results as $result) {

            $story = $storyRep->find($result['id']);

            $storyList .= '<div class="storySearch">
                                <div class="storyInfo">
                                    <span class="title">
                                        <i class="fas fa-book-open"></i>
                                        <a href="../app_dev.php/histoires-en-cours/'.$story->getId().'">'.$story->getTitle().'</a>
                                    </span>
                                    <div class="date">Par 
                                        <i class="fas fa-user"></i>
                                        <a href="../app_dev.php/page-membre/'.$story->getAuthor().'">'. $story->getAuthor().'</a>
                                        débutée le ' .$story->getCreationDate()->format('d/m/Y').'.
                                    </div>
                                </div>
                                <div class="chapters">
                                    <h6>Chapitres</h6>
                                    <div class="chaptersInfo">';
                                    if($result['postNumber'] == 1){
                                        $storyList .= '<p>'. $story->getPostNumber() .' validé</p>';
                                    }else{
                                        $storyList .= '<p>'. $story->getPostNumber() .' validés</p>';
                                    }
                                    $storyList .= '<p>'. ($story->getPostLimit() - $story->getPostNumber()). ' restants</p>
                                    </div>
                                </div>
                            </div>';
        }
        $storyList .= '</div>';
 
        $response = new JsonResponse();
        $response->setData(array('storyList' => $storyList));
        return $response;
    }
}