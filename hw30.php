<?php
//реалізація патерну Стратегія
interface HeroFactory {
    public function createHero(): Heroes;
}

class WarriorFactory implements HeroFactory {
    public function createHero(): Heroes {
        return new Warrior(100, 100, 'Sword', new Sword);
    }
}

class MagicianFactory implements HeroFactory {
    public function createHero(): Heroes {
        return new Magician(80, 100, 'MagicStaff', new MagicStaff);
    }
}

class BowmanFactory implements HeroFactory {
    public function createHero(): Heroes {
        return new Bowman(90, 100, 'Crossbow', new Crossbow);
    }
}

class HeroDirector {
    private HeroFactory $factory;

    public function __construct(HeroFactory $factory) {
        $this->factory = $factory;
    }

    public function createHero(): Heroes {
        return $this->factory->createHero();
    }
}
$warriorFactory = new WarriorFactory();
$warriorDirector = new HeroDirector($warriorFactory);
$warrior = $warriorDirector->createHero();

echo "Створений воїн: " . get_class($warrior);
?>




<?php

//реалізація патерну Фабрика
interface HeroesFactory
{
    public function create(float $health, float $stamina, string $weapon): Heroes;
}

class WarriorsFactory implements HeroesFactory
{
    public function create(float $health, float $stamina, string $weapon): Heroes
    {
        return new Warrior($health, $stamina, $weapon, new Sword);
    }
}

class MagiciansFactory implements HeroesFactory
{
    public function create(float $health, float $stamina, string $weapon): Heroes
    {
        return new Magician($health, $stamina, $weapon, new MagicStaff);
    }
}

class BowmansFactory implements HeroesFactory
{
    public function create(float $health, float $stamina, string $weapon): Heroes
    {
        return new Bowman($health, $stamina, $weapon, new Crossbow);
    }
}


$warriorFactory = new WarriorFactory();
$magicianFactory = new MagicianFactory();
$bowmanFactory = new BowmanFactory();

$warrior = $warriorFactory->create(100, 100, 'Sword');
$magician = $magicianFactory->create(80, 100, 'MagicStaff');
$bowman = $bowmanFactory->create(90, 100, 'Crossbow');

echo "Переможець: " . get_class($warrior);

?>
