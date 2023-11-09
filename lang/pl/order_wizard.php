<?php

return [
    'cart' => [
        'title' => 'Koszyk zakupów',
        'columns' => [
            'image' => 'Zdjęcie',
            'product' => 'Produkt',
            'qty' => 'Ilość',
            'unit_price' => 'Cena',
            'cost' => 'Wartość',
        ],
        'labels' => [
            'decrease_qty' => 'Zmniejsz ilość',
            'increase_qty' => 'Zwiększ ilość',
            'empty' => 'Koszyk zakupowy jest pusty',
        ],
        'dialogs' => [
            'remove' => [
                'title' => 'Usuwanie produktu z koszyka',
                'description' => 'Czy na pewno usunąć produkt :name z koszyka',
            ],
        ]
    ],
    'delivery' => [
        'title' => 'Dane dostawy',
        'attributes' => [
            'name' => 'Zamawiający',
            'address' => 'Dane dostawy',
        ]
    ],
    'confirm_order' => [
        'title' => 'Potwierdzenie zamówienia',
        'columns' => [
            'image' => 'Zdjęcie',
            'product' => 'Produkt',
            'qty' => 'Ilość',
            'unit_price' => 'Cena',
            'cost' => 'Wartość',
        ],
        'labels' => [
            'delivery' => 'Dane zamawiającego',
            'delivery_name' => 'Imię i nazwisko',
            'delivery_address' => 'Adres dostawy',
            'total_cost' => 'Koszt całkowity',
            'total_qty_items' => 'Ilość pozycji',
            'total_cost' => 'Całkowity koszt',
            'confirm_order' => 'Złóż zamówienie',
        ],
        'messages' => [
            'successes' => [
                'ordered' => [
                    'title' => 'Złożono zamówienie',
                    'description' => 'Złożono zamówienie na produkty o wartości :total_cost. Podsumowanie wysłano na maila.',
                ],
            ],
        ],
    ],
    'email_notification' => [
        'subject' => 'Zamówienie numer :number',
    ],
];
