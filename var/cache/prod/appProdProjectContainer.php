<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerGclbwfd\appProdProjectContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerGclbwfd/appProdProjectContainer.php') {
    touch(__DIR__.'/ContainerGclbwfd.legacy');

    return;
}

if (!\class_exists(appProdProjectContainer::class, false)) {
    \class_alias(\ContainerGclbwfd\appProdProjectContainer::class, appProdProjectContainer::class, false);
}

return new \ContainerGclbwfd\appProdProjectContainer([
    'container.build_hash' => 'Gclbwfd',
    'container.build_id' => '237bf21d',
    'container.build_time' => 1613770634,
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerGclbwfd');
