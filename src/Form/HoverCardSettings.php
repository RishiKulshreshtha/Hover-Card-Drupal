<?php

/**
 * @file
 * Contains \Drupal\system\Form\RssFeedsForm.
 */

namespace Drupal\hover_card\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class HoverCardSettings extends ConfigFormBase {
  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'hover_card_settings';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    
    $config = \Drupal::config('hover_cart.settings');

    $form['personalization'] = array(
      '#type' => 'fieldset',
      '#title' => t('Personalization'),
    );
    $form['personalization']['hover_card_user_email_display_status'] = array(
      '#type' => 'checkbox',
      '#title' => t('Enable User Emails on Hover'),
      '#default_value' => $config->get('hover_card_user_email_display_status'),
    );
    
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

    $config = \Drupal::config('hover_cart.settings');
    $userInputValues = $form_state->getUserInput();
    
    $config->set('hover_card_user_email_display_status', $userInputValues['hover_card_user_email_display_status']);
    $config->save();
    parent::submitForm($form, $form_state);
  }
}
