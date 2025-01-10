<?php

declare(strict_types=1);


function displayAvailableCitiesKeys(array $availableCitiesKeys): string
{
    $cities = '';

    foreach ($availableCitiesKeys as $key => $value) {
        $cities = $cities . ' ' . $key;
    };

    return $cities;
};

function calculateDeliveryCost(float $orderCost = 0, string $cityName = ''): string
{
    if ($orderCost == 0 || $cityName == '') return "Please provide order cost & city name";

    $availableCities = [
        'Subotica' => 190, // predsednice smanjio sam da bude izmedju 100 i 200, ovako je bilo tri preko 200 km
        'Pancevo' => 10,
        'Sarajevo' => 292,
        'Split' => 799,
    ];

    $availableCitiesKeys = displayAvailableCitiesKeys($availableCities);
    if (!array_key_exists($cityName, $availableCities)) return "Delivery is only available if the following cities: {$availableCitiesKeys}";

    $deliveryCost = 0;
    $deliveryDistance = $availableCities[$cityName];

    if ($deliveryDistance <= 100) {
        $deliveryCost = 200;
    } elseif ($deliveryDistance > 100 && $deliveryDistance <= 200) {
        $deliveryCost = 350;
    } else {
        $deliveryCost = 500;
    }

    (float) $totalCost = $orderCost + $deliveryCost;

    return "Distance between {$cityName} - Beograd is {$deliveryDistance} km. The order cost is {$orderCost} DIN. The delivery cost is {$deliveryCost} DIM. The grand total is {$totalCost} DIN";
};


$deliveryCost = calculateDeliveryCost(100, 'Subotica');
echo $deliveryCost;