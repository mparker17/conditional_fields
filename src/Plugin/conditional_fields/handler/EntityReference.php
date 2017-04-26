<?php

namespace Drupal\conditional_fields\Plugin\conditional_fields\handler;

use Drupal\conditional_fields\ConditionalFieldsHandlerBase;
use Drupal\node\Entity\Node;

/**
 * Provides states handler for entity reference fields.
 *
 * @ConditionalFieldsHandler(
 *   id = "states_handler_entity_reference_autocomplete",
 * )
 */
class EntityReference extends ConditionalFieldsHandlerBase {

  /**
   * {@inheritdoc}
   */
  public function statesHandler($field, $field_info, $options) {
    $state = [];
    $values_set = $options['values_set'];

    switch ($values_set) {
      case CONDITIONAL_FIELDS_DEPENDENCY_VALUES_WIDGET:
        if (!empty($options['value_form'][0]['target_id'])) {
          $node = Node::load($options['value_form'][0]['target_id']);
          // Create an array of valid formats of title for autocomplete.
          $state[$options['state']][$options['selector']] = [
            // Node title (nid).
            ['value' => $node->label() . ' (' . $node->id() . ')'],
            // Node title.
            ['value' => $node->label()]
          ];
        }
        break;

      default:
        break;
    }

    return $state;
  }

}
