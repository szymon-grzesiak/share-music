<?php

return [
    'attributes' => [
        'name' => 'Nazwa',
        'address' => 'Adres',
    ],
    'actions' => [
        'create' => 'Dodaj wytwórnie muzyczną',
        'edit' => 'Edytuj wytwórnie muzyczną',
        'destroy' => 'Usuń wytwórnie muzyczną',
        'restore' => 'Przywróć wytwórnie muzyczną',
    ],
    'labels' => [
        'create_form_title' => 'Tworzenie nowej wytwórni muzycznej',
        'edit_form_title' => 'Edycja wytwórni muzycznej',
    ],
    'messages' => [
        'successes' => [
            'stored' => 'Dodano wytwórnie muzyczną :name',
            'updated' => 'Zaktualizowano wytwórnie muzyczną :name',
            'destroyed' => 'Usunięto wytwórnie muzyczną :name',
            'restored' => 'Przywrócono wytwórnie muzyczną :name',
        ]
    ],
    'dialogs' => [
        'soft_deletes' => [
            'title' => 'Usuwanie wytwórnie muzyczną',
            'description' => 'Czy na pewno usunąć wytwórnie muzyczną :name',
        ],
        'restore' => [
            'title' => 'Przywracanie wytwórni muzycznej',
            'description' => 'Czy na pewno przywrócić wytwórnie muzyczną :name',
        ],
    ]
];
