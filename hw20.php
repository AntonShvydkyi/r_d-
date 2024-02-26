<?php

class Arsenal
{
    public const DAMAGE = 0;

    public function getDamage(): int
    {
        return static::DAMAGE;
    }
}

class Sword extends Arsenal
{
    public const DAMAGE = 15;
}

class Pistol extends Arsenal
{
    public const DAMAGE = 90;
}

class MagicStaff extends Arsenal
{
    public const DAMAGE = 60;
}

class Onion extends Arsenal
{
    public const DAMAGE = 40;
}

class Crossbow extends Arsenal
{
    public const DAMAGE = 30;
}

class Heroes
{
    protected float $health;
    protected float $stamina;
    protected string $weapon;

    public function __construct(float $health, float $stamina, string $weapon)
    {
        $this->health = $health;
        $this->stamina = $stamina;
        $this->weapon = $weapon;
    }

    public function getMaxHealth(): float
    {
        return $this->health;
    }

    public function getCurrentHealth(): float
    {
        $damagePercent = $this->getDamagePercent();
        return $this->health - ($this->health * $damagePercent);
    }

    protected function getDamagePercent(): float
    {
        return $this->weapon::DAMAGE / 100;
    }
}

class Warrior extends Heroes
{
    protected Arsenal $arsenal;

    public function __construct(float $health, float $stamina, string $weapon, Arsenal $arsenal)
    {
        $this->arsenal = $arsenal;
        parent::__construct($health, $stamina, $weapon);
    }
}

class Magician extends Heroes
{
    protected Arsenal $arsenal;

    public function __construct(float $health, float $stamina, string $weapon, Arsenal $arsenal)
    {
        $this->arsenal = $arsenal;
        parent::__construct($health, $stamina, $weapon);
    }
}

class Bowman extends Heroes
{
    protected Arsenal $arsenal;

    public function __construct(float $health, float $stamina, string $weapon, Arsenal $arsenal)
    {
        $this->arsenal = $arsenal;
        parent::__construct($health, $stamina, $weapon);
    }
}


$swordStrike = new Sword;
$pistolStrike = new Pistol;
$magicStaffStrike = new MagicStaff;
$onionStrike = new Onion;
$crossbowStrike = new Crossbow;

class Battle
{
    public function fight(Heroes $hero1, Heroes $hero2): Heroes
    {
        $health1 = $hero1->getCurrentHealth();
        $health2 = $hero2->getCurrentHealth();

        while ($health1 > 0 && $health2 > 0) {

            $health2 -= $hero1->getDamage();
            if ($health2 <= 0) {
                return $hero1;
            }

            $health1 -= $hero2->getDamage();
            if ($health1 <= 0) {
                return $hero2;
            }
        }

        return $hero1;
    }
}

$battle = new Battle();

$hero1 = new Warrior(100, 100, 'Sword', new Sword);
$hero2 = new Magician(80, 100, 'MagicStaff', new MagicStaff);

$winner = $battle->fight($hero1, $hero2);

echo "Переможець: " . get_class($winner);

?>
