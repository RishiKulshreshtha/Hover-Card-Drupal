<?php

/**
 * @file
 * Contains \Drupal\hover_card\Controller\DefaultController.
 */

namespace Drupal\hover_card\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Default controller for the hover_card module.
 */
class DefaultController extends ControllerBase {

  public function hover_card(\Drupal\user\UserInterface $user = NULL) {
    $name = $mail = $roles = $picture = "";
    $name = $user->getUsername();
    $mail = $user->getEmail();
    //    if ($user->getEmail() && \Drupal::config('hover_card.settings')->get('hover_card_user_email_display_status')) {
    //      
    //    }
    //     if ($user->get('user_picture')->entity->url()) {
    //       $user_picture = $user->get('user_picture')->entity->url();
    //     }

    foreach ($user->getRoles() as $value) {
      $roles = $value;
    }

    $user_data = [
      'name' => \Drupal\Component\Utility\SafeMarkup::checkPlain($name),
      'mail' => \Drupal\Component\Utility\SafeMarkup::checkPlain($mail),
      // 'picture' => $user_picture,
      'roles' => \Drupal\Component\Utility\SafeMarkup::checkPlain($roles),
    ];

    $hover_card_template_build = array(
      '#theme' => 'hover_card_template',
      '#details' => $user_data,
    );

    $hover_card_template = drupal_render($hover_card_template_build);

    return array(
      '#markup' => $hover_card_template,
    );
  }
}
