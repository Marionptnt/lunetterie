<?php

namespace App\DataFixtures;

use App\Entity\Glasses;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class GlassesFixtures extends Fixture
{
    private const BRAND = ['Ray Ban', 'Lafont', 'Clément Lunettier', 'Izipizi', 'Gaston'];
    private const GLASSES_NAME = ['Wayfarer', 'ToutRond', 'L\'audacieuse','T0345', 'TitanLine', 'Albert', 'JolieMinois', 'L\'extravaguante'];
    private const COLOR = ['noir', 'écaille', 'gun métal', 'or', 'rosegold', 'métal brossé'];
    private const SIZE = [ 58, 47, 49, 55, 52];
    private const IMAGE = ['images/1.png', 'images/2.jpeg', 'images/3.png',
        'images/4.png', 'images/5.png', 'images/6.png', 'images/7.png'];
    private const SHAPE = ['ronde', 'pantos', 'carré', 'rectangulaire', 'papillon'];
    private const GLASSES_COUNT = 12;

    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i <= self::GLASSES_COUNT; $i++) {

            $glasses = new Glasses();

            $brandGlasses = array_rand (self::BRAND);
            $glasses->setBrand(self::BRAND[$brandGlasses]);

            $nameGlasses = array_rand (self::GLASSES_NAME);
            $glasses->setName(self::GLASSES_NAME[$nameGlasses]);

            $imageGlasses = array_rand (self::IMAGE);
            $glasses->setImage(self::IMAGE[$imageGlasses]);

            $glasses->setPrice((rand(1, 10) / 10) * rand(100, 200));

            $colorGlasses = array_rand(self::COLOR);
            $glasses->setColor(self::COLOR[$colorGlasses]);

            $shapeGlasses = array_rand(self::SHAPE);
            $glasses->setShape(self::SHAPE[$shapeGlasses]);

            $sizeGlasses = array_rand(self::SIZE);
            $glasses->setSize(self::SIZE[$sizeGlasses]);
           
            $manager->persist($glasses);
        }

        $manager->flush();
    }
}
