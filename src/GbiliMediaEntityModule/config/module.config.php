<?php
namespace GbiliMediaEntityModule;
return array(
    'controller_plugins' => include __DIR__ . '/controller_plugins.config.php',
    'doctrine' => include __DIR__ . '/doctrine.config.php',
    'doctrine_event_listeners' => include __DIR__ . '/doctrine_event_listeners.config.php',
    'service_manager' => include __DIR__ . '/service_manager.config.php',
);
