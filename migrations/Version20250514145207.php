<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250514145207 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE archive (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, date_debut DATETIME NOT NULL, date_fin DATETIME NOT NULL, lieu VARCHAR(100) DEFAULT NULL, adresse VARCHAR(100) DEFAULT NULL, ville VARCHAR(100) DEFAULT NULL, code_postal VARCHAR(10) DEFAULT NULL, slug VARCHAR(255) NOT NULL, activation TINYINT(1) NOT NULL, date_creation DATETIME NOT NULL, date_modification DATETIME DEFAULT NULL, creation_par VARCHAR(50) NOT NULL, illustration VARCHAR(255) NOT NULL, modification_par VARCHAR(50) DEFAULT NULL, is_homepage TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE evenements CHANGE illustration illustration VARCHAR(255) NOT NULL, CHANGE is_homepage is_homepage TINYINT(1) DEFAULT NULL
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            DROP TABLE archive
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE evenements CHANGE illustration illustration VARCHAR(255) DEFAULT NULL, CHANGE is_homepage is_homepage TINYINT(1) NOT NULL
        SQL);
    }
}
