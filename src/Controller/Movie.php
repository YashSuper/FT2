<?php
namespace Drupal\moviedb\Controller;

// Using required resources.
use Drupal\Core\Controller\ControllerBase;
use Drupal\node\Entity\Node;
use Drupal\paragraphs\Entity\Paragraph;
use Drupal\node\NodeInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
/**
 * Movie controller class.
 *  This class provides performes all the functions for various pages.
 */
class Movie extends ControllerBase {

  /**
   * Function list returns the data of all movies.
   * @return mixed
   *  Returns array where multiple properties are defined.
   */
  public function list () {
    $form = $this->formBuilder()->getForm('Drupal\moviedb\Form\FilterByName');
    // Get render html of form
    $form_rendered = \Drupal::service('renderer')->render($form);
    // Get query parameter value
    $name = \Drupal::request()->query->get('word');
    //Query fired to fetch node id of actor content type where title equal to $name.
    $bundle = 'actors';
    $query = \Drupal::entityQuery('node')
     ->condition('status', 1)
     ->condition('type', $bundle)
     ->condition('title', $name, 'CONTAINS');
    $act_id = $query->execute();
    //Query fired to fetch node id of movie content type where title equal to $name.
    $bundle = 'movie';
    if(empty($act_id) && $name) {
     $query = \Drupal::entityQuery('node')
         ->condition('status', 1)
         ->condition('type', $bundle)
         ->condition('title', $name, 'CONTAINS');
    }
    elseif(!empty($act_id) && $name) {
    // Query fired to fetch node ids of movie where actor node id existing paragraph field.
     $query = \Drupal::entityQuery('node')
       ->condition('type', $bundle)
       ->condition('field_actor_role.entity:paragraph.field_actor.target_id',$act_id);
    }
    else {
     $query = \Drupal::entityQuery('node')
     ->condition('status', 1)
     ->condition('status', 1)
     ->condition('type', $bundle);
    }
    $nids = $query->execute();
    if(empty($nids)) {
     drupal_set_message("No Results Found");
     return $this->redirect('moviedb.list');
   }
    else{
      $movie_nodes = entity_load_multiple('node', $nids);
      $items = array();
      foreach($movie_nodes as $node){
        $temp = $node->id();
        $database = \Drupal::database();
        $query = $database->query("SELECT value FROM {votingapi_result} where function = 'vote_average' and entity_id = $temp");
        $result = $query->fetchAll();
        $rating = $result[0]->value/20;
        $halfStarFlag = false;
        if($result[0]->value%20 !=0) {
          $halfStarFlag = true;

        }
        $node_title = $node->title->value;
        $node_id = $node->nid->value;
        $node_des = $node->field_s->value;
        $node_image_fid = $node->field_poster->target_id;
        if ( !is_null($node_image_fid) ){
           $image_entity = \Drupal\file\Entity\File::load($node_image_fid);
           $node_poster = $image_entity->url();
         }
         else{
           $image_entity_url = "/sites/default/files/default_images/obama.jpg";
         }

         $target_id = array();
         $target_id = $node ->field_actor_role->getValue();
         $actors = array();
         $j = 0;
         foreach ($target_id as $value) {
          $paragraph = Paragraph::load($value['target_id']);
          $actor_id = $paragraph->field_actor->target_id;
          $actor = Node::load($actor_id);
          $actors[$j]['name'] = $actor->title->value;
          $actors[$j]['nid'] = $actor->nid->value;
          // kint($actors[$j]);
          $j++;
         }
         'poster' => $node_poster,
        $items[] = [
          'name' => $node_title,
          'nid' => $node_id,
          'des' => $node_des,
          'actors' =>$actors,
          'ratings' =>$rating,
          'halfStarFlag' => $halfStarFlag,
        ];
      }

      return array(
      '#theme' => 'article_list',
      '#items' => $items,
      '#title' => 'Movies list',
      '#form' => $form_rendered,
    );

    }
  }


  /**
   * Function actorsmovie takes in id of actor and provide it details.
   * @param  NodeInterface $node
   *  This contains node id of interface.
   * @return mixed
   *  Returns the render array.
   */
  public function actorMovie (NodeInterface $node) {

    // Get Name of the actor whose id is passed.
    $title = $node->title->value;
    // Get nid of the current node.
    $nid = $node->nid->value;
    // Query for fetching out all movies in which actor has worked.
    $query = \Drupal::entityQuery('node')
        ->condition('status', 1)
        ->condition('type','movie')
        ->condition('field_actor_role.entity:paragraph.field_actor.target_id',$nid);
        $nids = $query->execute();
    // check if query returned something or not.
    if (empty($nids)){
      $data = array("#markup" => "No Results Found");
      }
    else{
      $movie_nodes = entity_load_multiple('node', $nids);
      $items = array();
      foreach ($movie_nodes as $node) {
        $ratings = $node->field_rating->getValue ();
        $rating = $ratings[0]['rating'];
        $rating = $rating/20;
        $rating = $rating."/"."5";
        $node_title = $node->title->value;
        $node_id = $node->nid->value;
        $node_des = $node->field_s->value;
        $node_image_fid = $node->field_poster->target_id;
        if ( !is_null($node_image_fid) ) {
          $image_entity = \Drupal\file\Entity\File::load($node_image_fid);
          $node_poster = $image_entity->url();
        }
        else {
               $image_entity_url = "/sites/default/files/default_images/obama.jpg";
        }

        $target_id = array();
        $target_id = $node ->field_actor_role->getValue();
        $actors = array();
        $j = 0;
        $coactors = array ();
        foreach ($target_id as $value) {
          $paragraph = Paragraph::load($value['target_id']);
          $actor_id = $paragraph->field_actor->target_id;

          $actor = Node::load($actor_id);
          $actors[$j]['name'] = $actor->title->value;
          $actors[$j]['nid'] = $actor->nid->value;
          if ($actor_id != $nid ) {
            $coactors[$j]['name'] = $actor->title->value;
            $coactors[$j]['nid'] = $actor->nid->value;
          }
          $j++;
        }
        // kint ($coactors);

        $items[] = [
          'name' => $node_title,
          'nid' => $node_id,
          'des' => $node_des,
          'poster' => $node_poster,
          'actors' =>$actors,
          'ratings' =>$rating,
          'costars' => $coactors
        ];
      }
      $mTitle = 'List of '.$title.' movies';
      return array (
        '#theme' => 'actormovie_list',
        '#items' => $items,
        '#title' => $mTitle,
      );
    }
  }

  /**
   * Function getactors renders out the list of all actors.
   * @return mixed
   *  This function returns the render array.
   */
  public function getActors () {
      $query = \Drupal::entityQuery('node')
      ->condition('status', 1)
      ->condition('type', 'actors');
      $nids = $query->execute();
      if (empty($nids)){
        $data = array("#markup" => "No Results Found");
      }
      else {
        $items = array();
        $actor_nodes = entity_load_multiple('node', $nids);
        foreach ($actor_nodes as $node) {
          $name = $node->title->value;
          $nid = $node->nid->value;
          $items[] = [
            'name' => $name,
            'nid' => $nid,
          ];
        }
        return array(
          '#theme' => 'actors_list',
          '#items' => $items,
          '#title' => t('List of all actors'),
        );

      }
    }

    /**
     * Function costar computes the costar of the particular actor in movie.
     * @param  int $movie
     *  This contains the nid of the movie.
     * @param  int $nid
     *  This contains the nid of the actor
     * @return mixed
     */
    public function costar($movie=NULL, $nid=NULL) {
    $node = Node::load($movie);
    $target_id = array();
    $target_id = $node->field_actor_role->getValue();
    foreach ($target_id as $value) {
      $paragraph = Paragraph::load($value['target_id']);
      $actor_id = $paragraph->field_actor->target_id;
      if($actor_id == $nid) {
        $role = $paragraph->field_role->value;
        $actor = Node::load($actor_id);
        $node_image_fid = $actor->field_dp->target_id;
        if ( !is_null($node_image_fid) ){
          $image_entity = \Drupal\file\Entity\File::load($node_image_fid);
          $image_entity_url = $image_entity->url();
        }
        else{
          $image_entity_url = "/sites/default/files/default_images/obama.jpg";
        }
        $node_title = $actor->title->value;
        $actors['nid'] = $actor->nid->value;
      }
    }
    $items = [
       'name' => $node_title,
       'image' => $image_entity_url,
       'role' => $role,
     ];
    return new JsonResponse($items);
  }


?>
