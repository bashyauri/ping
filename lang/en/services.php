<?php

declare(strict_types=1);
return [
    'v1' => [
        'create' => [
            'success' => 'Your service will be created in the background.',
            'failure' => 'You must verify your email before creating a new service',
        ],
        'update' => [
            'success' => 'We will update your service in the background.',
            'failure' => 'You are not able to update a service that you do not own.',
        ],
        'delete' => [
            'success' => 'Your service will be deleted in the background.',
            'failure' => 'You cannot delete a service that you do not own.',
        ]
    ],
];