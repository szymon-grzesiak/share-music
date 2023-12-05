<?php

return [
    'attributes' => [
        'name' => 'Nazwa',
        'image' => 'Zdjęcie playlisty',
        'description' => 'Opis',
    ],
    'actions' => [
        'create' => 'Dodaj playlistę',
        'edit' => 'Edytuj playlistę',
        'destroy' => 'Usuń playlistę',
        'restore' => 'Przywróć playlistę',
    ],
    'labels' => [
        'create_form_title' => 'Tworzenie nowej playlisty',
        'edit_form_title' => 'Edycja playlisty',
    ],
    'messages' => [
        'successes' => [
            'stored' => 'Dodano playliste :name',
            'updated' => 'Zaktualizowano playliste :name',
            'destroyed' => 'Usunięto playliste :name',
            'restored' => 'Przywrócono playliste :name',
        ]
    ],
    'dialogs' => [
        'soft_deletes' => [
            'title' => 'Usuwanie playlisty',
            'description' => 'Czy na pewno usunąć playliste :name',
        ],
        'restore' => [
            'title' => 'Przywracanie playlisty',
            'description' => 'Czy na pewno przywrócić playliste :name',
        ],
    ],
];
