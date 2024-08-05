<?
$games = [
    ["완", "성", "원", "진"],
    ["성", "완", "원", "진"],
    ["원", "완", "성", "진"],
    ["성", "완", "원", "진"],
    ["완", "진", "성", "원"],
    ["진", "완", "성", "원"]
];

$drinkDistribution = [];

foreach ($games as $game) {
    list($first, $second, $third, $fourth) = $game;

    // 4등은 1등에게 술 2잔
    if (!isset($drinkDistribution[$fourth][$first])) {
        $drinkDistribution[$fourth][$first] = 0;
    }
    $drinkDistribution[$fourth][$first] += 2;

    // 3등은 2등에게 술 1잔
    if (!isset($drinkDistribution[$third][$second])) {
        $drinkDistribution[$third][$second] = 0;
    }
    $drinkDistribution[$third][$second] += 1;
}

// 상쇄 계산
foreach ($drinkDistribution as $giver => $receivers) {
    foreach ($receivers as $receiver => $amount) {
        if (isset($drinkDistribution[$receiver][$giver])) {
            $offset = min($amount, $drinkDistribution[$receiver][$giver]);
            $drinkDistribution[$giver][$receiver] -= $offset;
            $drinkDistribution[$receiver][$giver] -= $offset;

            if ($drinkDistribution[$giver][$receiver] == 0) {
                unset($drinkDistribution[$giver][$receiver]);
            }

            if ($drinkDistribution[$receiver][$giver] == 0) {
                unset($drinkDistribution[$receiver][$giver]);
            }
        }
    }
}

print_r($drinkDistribution);

?>