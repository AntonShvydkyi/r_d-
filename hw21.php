<?php

class Arsenal
{
    protected const BASE_DAMAGE = 0;
    protected int $damage = self::BASE_DAMAGE;

    public function setWeaponDamage(int $damage): void
    {
        $this->damage = $damage;
    }

    public function getDamage(): int
    {
        return $this->damage;
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

    public function sayOnWin(): string
    {
        $phrases = ["Я виграв!", "Перемога!"];
        return $phrases[array_rand($phrases)];
    }

    public function sayOnLose(): string
    {
        $phrases = ["Я програв...", "Наступного разу переможу!"];
        return $phrases[array_rand($phrases)];
    }

    public function say(): string
    {
        $phrases = ["Я готовий до бою!", "За перемогу!"];
        return $phrases[array_rand($phrases)];
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

class HeroFactory
{
    public function createHeroWithWeapon(float $health, float $stamina, string $weaponName): Heroes
    {
        switch ($weaponName) {
            case 'Sword':
                $weapon = new Sword;
                break;
            case 'Pistol':
                $weapon = new Pistol;
                break;
            case 'MagicStaff':
                $weapon = new MagicStaff;
                break;
            case 'Onion':
                $weapon = new Onion;
                break;
            case 'Crossbow':
                $weapon = new Crossbow;
                break;
            default:
                throw new InvalidArgumentException("Unknown weapon: $weaponName");
        }

        $heroClassName = ucfirst(strtolower($weaponName));
        return new $heroClassName($health, $stamina, $weaponName, $weapon);
    }
}

class Battle
{
    public function fight(Heroes $hero1, Heroes $hero2): Heroes
    {
        $health1 = $hero1->getCurrentHealth();
        $health2 = $hero2->getCurrentHealth();
        $attackPhrases = [];

        while ($health1 > 0 && $health2 > 0) {
            $health2 -= $hero1->getDamage();
            if ($health2 <= 0) {
                $attackPhrases[] = $hero1->sayOnWin();
                return $hero1;
            }

            $health1 -= $hero2->getDamage();
            if ($health1 <= 0) {
                $attackPhrases[] = $hero2->sayOnWin();
                return $hero2;
            }

            $attackPhrases[] = $hero1->say() . ' Нанесено ' . $hero1->getDamage() . ' урону.';
            $attackPhrases[] = $hero2->say() . ' Нанесено ' . $hero2->getDamage() . ' урону.';
        }

        echo implode("<br>", $attackPhrases);

        return $hero1;
    }
}

$heroFactory = new HeroFactory();
$battle = new Battle();

$hero1 = $heroFactory->createHeroWithWeapon(100, 100, 'Sword');
$hero2 = $heroFactory->createHeroWithWeapon(80, 100, 'MagicStaff');

$winner = $battle->fight($hero1, $hero2);

echo "Переможець: " . get_class($winner);
?>
