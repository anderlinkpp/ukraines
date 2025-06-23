<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240410111200 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE utilisateurs CHANGE adresse adresse VARCHAR(100) DEFAULT NULL, CHANGE ville ville VARCHAR(100) NOT NULL, CHANGE adhesion adhesion TINYINT(1) NOT NULL, CHANGE role role VARCHAR(20) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE utilisateurs CHANGE adresse adresse VARCHAR(255) DEFAULT NULL, CHANGE ville ville VARCHAR(255) NOT NULL, CHANGE adhesion adhesion TINYINT(1) DEFAULT NULL, CHANGE role role VARCHAR(20) DEFAULT NULL');
    }
}
