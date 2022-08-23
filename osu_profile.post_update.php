<?php

use Drupal\Core\Config\FileStorage;
use Drupal\field\Entity\FieldConfig;

/**
 * Update osu profile to create a new field type.
 */
function osu_profile_post_update_add_field_osu_organizations(&$sandbox) {
  $install_path = \Drupal::service('module_handler')
    ->getModule('osu_profile')
    ->getPath();
  $config_path = realpath($install_path . '/config/install');
  $source = new FileStorage($config_path);
  FieldConfig::create($source->read('field.field.node.osu_profile.field_osu_organizations'))
    ->save();
  /** @var \Drupal\Core\Config\CachedStorage $config_storage */
  $config_storage = \Drupal::service('config.storage');
  $config_storage->write('core.entity_form_display.node.osu_profile.default', $source->read('core.entity_form_display.node.osu_profile.default'));
  $config_storage->write('core.entity_view_display.node.osu_profile.default', $source->read('core.entity_view_display.node.osu_profile.default'));
}
