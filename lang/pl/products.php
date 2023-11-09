<?php

return [
    'attributes' => [
        'image' => 'Zdjęcie',
        'name' => 'Nazwa',
        'description' => 'Opis',
        'manufacturer' => 'Producent',
        'categories' => 'Kategorie',
        'price' => 'Cena',
    ],
    'filters' => [
        'categories' => 'Nazwa kategorii',
        'manufacturer' => 'Nazwa producenta',
    ],
    'actions' => [
        'create' => 'Dodaj produkt',
        'add_to_cart' => 'Dodaj',
    ],
    'labels' => [
        'create_form_title' => 'Tworzenie nowego produktu',
        'edit_form_title' => 'Edycja produktu',
    ],
    'messages' => [
        'successes' => [
            'stored' => 'Dodano produkt :name',
            'updated' => 'Zaktualizowano produkt :name',
            'destroyed' => 'Usunięto produkt :name',
            'restored' => 'Przywrócono produkt :name',
            'image_deleted' => 'Zdjęcia dla produktu :name zostało usunięte',
            'added_to_cart' => 'Dodano do koszyka produkt :name',
        ],
        'errors' => [
            'image_deleted' => 'Nie udało się usunąć zdjęcia dla produktu :name',
        ]
    ],
    'dialogs' => [
        'soft_deletes' => [
            'title' => 'Usuwanie produktu',
            'description' => 'Czy na pewno usunąć produkt :name',
        ],
        'restore' => [
            'title' => 'Przywracanie produktu',
            'description' => 'Czy na pewno przywrócić produkt :name',
        ],
        'image_delete' => [
            'title' => 'Usuwanie zdjęcia',
            'description' => 'Czy na pewno usunąć zdjęcie dla produktu :name'
        ]
    ],
];
