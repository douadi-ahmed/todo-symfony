<?php

namespace App\DataFixtures;

use App\Entity\Task;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TaskFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Créons 5 tâches de test
        for ($i = 1; $i <= 5; $i++) {
            $task = new Task();
            $task->setTitle("Tâche $i")
                ->setDescrption("Ceci est la description de la tâche numéro $i.")
                ->setDueDate(new \DateTime("+$i days"))
                ->setIsDone($i % 2 === 0)
                ->setCreatedAt(new \DateTimeImmutable("-1 days"))
                ->setUpdatedAt(new \DateTimeImmutable("now"));

            $manager->persist($task);
        }

        $manager->flush();
    }
}
