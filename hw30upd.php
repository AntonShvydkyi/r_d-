<?php

interface HeroFactoryStrategy {
    public function create(float $health, float $stamina, string $weapon): Heroes;
}

class HeroFactory implements HeroFactoryStrategy {
    public function create(float $health, float $stamina, string $weapon): Heroes {
        switch ($weapon) {
            case 'Sword':
                return new Warrior($health, $stamina, $weapon, new Sword);
            case 'MagicStaff':
                return new Magician($health, $stamina, $weapon, new MagicStaff);
            case 'Crossbow':
                return new Bowman($health, $stamina, $weapon, new Crossbow);
            default:
                throw new Exception("Unknown weapon type: $weapon");
        }
    }
}



$factory = new HeroFactory();

$warrior = $factory->create(100, 100, 'Sword');
$magician = $factory->create(80, 100, 'MagicStaff');
$bowman = $factory->create(90, 100, 'Crossbow');

echo "Воїн: " . get_class($warrior) . "\n";
echo "Маг: " . get_class($magician) . "\n";
echo "Лучник: " . get_class($bowman) . "\n";

?>
