<?php

return [
    'attributes' => [
        'name' => 'Imię i nazwisko',
        'email' => 'Email',
        'email_verified_at' => 'Email zweryfikowano',
        'roles' => 'Role',
    ],
    'actions' => [
        'assign_admin_role' => 'Ustaw rolę admina',
        'remove_admin_role' => 'Odbierz rolę admina',
        'assign_artist_role' => 'Ustaw rolę artysty',
        'remove_artist_role' => 'Odbierz rolę artysty',
    ],
    'messages' => [
        'successes' => [
            'admin_role_assigned' => 'Ustawiono rolę admina',
            'admin_role_removed' => 'Odebrano rolę admina',
            'artist_role_assigned' => 'Ustawiono rolę artysty',
            'artist_role_removed' => 'Odebrano rolę artysty',
        ]
    ]
];
